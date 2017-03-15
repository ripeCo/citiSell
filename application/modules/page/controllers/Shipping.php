<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Shipping extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$userlogged = $this->session->userdata('userid');
		if ($userlogged === null)
			redirect('page/login/dologin');
	}
	
	// Default load this function
	public function index() {
		// 
	}

	/* 	Descrption - Call by $this->confirmAndBuy(). We always assume data being passed are all been sanitized already.
		@param $orderId - the order id
		@param $shopOwner - the shipper.
		@param $buyer - the recipient
		@param $package - package information like weight.
		@param $addOns - optional if there are other services your shipper wants to add
		@return  - returns response from RocketShipIt
	*/
	private function confirmShipment($orderId, array $shopOwner, array $buyer, array $package, array $addOns=null) {
		require_once APPPATH . 'third_party/RocketShipIt/autoload.php';
		$this->load->helper('myhelp');

		$toName = $buyer['name'];
		$toCompany = $buyer['display_name'];
		$toPhone = $buyer['user_phone'];

		/*if ($buyer['preferredAddress'] == 1) {
			$toAddr1 = $buyer['user_address'];
			$toCity = $buyer['user_city'];
			$toState = $buyer['user_state'];
			$toCode = $buyer['user_zip'];
		} elseif ($buyer['preferredAddress'] == 2) {
			$toAddr1 = $buyer['user_address2'];
			$toCity = $buyer['user_city2'];
			$toState = $buyer['user_state2'];
			$toCode = $buyer['user_zip2'];
		} else { // unknown recipient
			return array('error' => 'Invalid buyer preferred address.');
		}*/
		$toAddr1 = $buyer['user_address'];
		$toCity = $buyer['user_city'];
		$toState = $buyer['user_state'];
		$toCode = $buyer['user_zip'];

		// create the config
		$config = new \RocketShipIt\Config;
		$config->setDefault('generic', 'shipper', $shopOwner['shipper']);
		$config->setDefault('generic', 'fromName', $shopOwner['shipper']);
		$config->setDefault('generic', 'shipContact', $shopOwner['shipContact']);
		$config->setDefault('generic', 'shipPhone', $shopOwner['user_phone']);

		/*if ($shopOwner['preferredAddress'] == 1) {
			$shipAddr1 = $shopOwner['user_address'];
			$shipAddr2 = '';
			$shipCity = $shopOwner['user_city'];
			$shipState = $shopOwner['user_state'];
			$shipCode = $shopOwner['user_zip'];
			$shipCountry = $shopOwner['user_country'];
		} elseif ($shopOwner['preferredAddress'] == 2) {
			$shipAddr1 = $shopOwner['user_address2'];
			$shipAddr2 = '';
			$shipCity = $shopOwner['user_city2'];
			$shipState = $shopOwner['user_state2'];
			$shipCode = $shopOwner['user_zip2'];
			$shipCountry = $shopOwner['user_country2'];
		} else {	// unknown address.
			return array('error' => 'Invalid shop owner preferred address.');
		}*/

		$shipAddr1 = $shopOwner['user_address'];
		$shipAddr2 = '';
		$shipCity = $shopOwner['user_city'];
		$shipState = $shopOwner['user_state'];
		$shipCode = $shopOwner['user_zip'];
		$shipCountry = $shopOwner['user_country'];

		$config->setDefault('generic', 'shipAddr1', $shipAddr1);
		// $config->setDefault('generic', 'shipAddr2', $shipAddr2);
		$config->setDefault('generic', 'shipCity', $shipCity);
		$config->setDefault('generic', 'shipState', $shipState);
		$config->setDefault('generic', 'shipCode', $shipCode);
		$config->setDefault('generic', 'shipCountry', $shipCountry);
		$config->setDefault('generic', 'toCode', $toCode);
		
		// check the package
		if (!isNumericAndPositive($package['weight']))
			return array('error' => 'Invalid weight value.');
		if (!isNumericAndPositive($package['length']))
			return array('error' => 'Invalid length value.');
		if (!isNumericAndPositive($package['width']))
			return array('error' => 'Invalid width value.');
		if (!isNumericAndPositive($package['height']))
			return array('error' => 'Invalid height value.');

		// create the Rate object
		$rate = new \RocketShipIt\Rate('STAMPS', array('config' => $config));
		$rate->setParameter('toCode', $toCode);
		$rate->setParameter('weight', $package['weight']);
		$rate->setParameter('length', $package['length']);
		$rate->setParameter('width', $package['width']);
		$rate->setParameter('height', $package['height']);
		$response = $rate->getAllRates();

		file_put_contents('c:\tmp\responseRate.txt', print_r($response, true));

		$rates = $response->Rates;
		$rate = $rates->Rate;

		# Select the rate/service you want
		# from a list of all available
		$package = $rate[$package['shippingMethod']];
		// $package = $rate[3];

		# Remove all addons
		$package->AddOns = null;

		# Add the addons you want for this
		# shipment
		/*$addons = array();
		$a = new \stdClass();
		$a->AddOnType = 'US-A-DC';
		array_push($addons, $a);
		$package->AddOns = $addons;*/
		//print_r($package);


		$shipment = new \RocketShipIt\Shipment('STAMPS');
		$shipment->setParameter('toCompany', $toCompany);
		$shipment->setParameter('toName', $toName);		
		$shipment->setParameter('toPhone', $toPhone);
		$shipment->setParameter('toAddr1', $toAddr1);
		$shipment->setParameter('toCity', $toCity);
		$shipment->setParameter('toState', $toState);
		$shipment->setParameter('toCode', $toCode);
		// $shipment->setParameter('emailTo', $buyer['emailTo']);
		// $shipment->setParameter('shipDate', $package['shipDate']);

		/* Add-ons definitions here. */
		if (isset($addOns['insuredValue'])) {
			$shipment->setParameter('insuredCurrency','USD');
			$shipment->setParameter('insuredValue', $addOns['insuredValue']);			
		}
		if (isset($addOns['signatureType']))
			$shipment->setParameter('signatureType','2');
			// $shipment->setParameter('signatureType','STAMPS');


		// The rate can suggest a new zipcode
		// Set this new zipcode on the shipment to avoid:
		// "Rate ToZIPCode and Destination Address ZIPCode field must match."
		$shipment->setParameter('toCode', $package->ToZIPCode);
		// $shipment->setParameter('toCode', $toCode);

		$shipment->addPackageToShipment($package);

		// return;

		// Now let's submit it.
		$response = $shipment->submitShipment();
		// file_put_contents('c:\tmp\shipper.txt', print_r($shopOwner, true));
		// file_put_contents('c:\tmp\buyer.txt', print_r($buyer, true));
		file_put_contents('c:\tmp\usps_response.txt', print_r($response, true));
		file_put_contents('c:\tmp\package.txt', print_r($package, true));
		file_put_contents('c:\tmp\shipmentDebug.txt', print_r($shipment->debug(), true));

		// Save label as a pdf
		if (isset($response['pkgs'])) {
			$shipment->toFile($response['pkgs'][0]['label_img'], 'c:\tmp\label_img.pdf');

			$this->load->model('Shipping_model');
			$this->Shipping_model->saveTrackingDetails($orderId, $response);
		}

		return $response;
	}

	/*	Description - Call by confirm and buy button in the shipping page through AJAX.
		POST @params			
	*/
	public function confirmAndBuy() {
		$orderNumber = $this->input->post('orderNumber');

		$this->load->model('order_model');
		$orderDetails = $this->order_model->getOrderDetailsByOrderNumber($orderNumber);

		// request will always output json.
		$this->output->set_content_type('application/json');

		if (!$orderDetails) {
			$responseData['error'] = 'Order number not found.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}
		if ($orderDetails[0]['order_status'] != "Pending") {
			$responseData['error'] = 'This item has already been processed.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		$this->load->model('user_model');
		$data['shopInfo'] = $this->user_model->getShopInfo($orderDetails[0]['shopid']);

		if (!$data['shopInfo']) {
			$responseData['error'] = 'Shop is unknown.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		$this->load->helper('address');

		if (!addressIsValid($data['shopInfo'])) {
			$responseData['error'] = 'Shop address is invalid.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}
		if (!addressIsValid($orderDetails[0])) {
			$responseData['error'] = 'Buyer address is invalid.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		/* data for the shop owner */
		$shopOwner['shipper'] = $data['shopInfo']['shop_name'];
		$shopOwner['shipContact'] = $data['shopInfo']['display_name'];
		$shopOwner['user_phone'] = $data['shopInfo']['user_phone'];
		$shopOwner['preferredAddress'] = $data['shopInfo']['preferredAddress'];

		if ($data['shopInfo']['preferredAddress'] == 1) {
			if ($data['shopInfo']['user_country'] == "USA") {
				$shopOwner['user_address'] = $data['shopInfo']['user_address'];
				$shopOwner['user_city'] = $data['shopInfo']['user_city'];
				$shopOwner['user_state'] = $data['shopInfo']['user_state'];
				$shopOwner['user_zip'] = $data['shopInfo']['user_zip'];
			} else {
				$shopOwner['notUSfullAddress'] = $data['shopInfo']['notUSfullAddress'];
			}

			$shopOwner['user_country'] = $data['shopInfo']['user_country'];
		} elseif ($data['shopInfo']['preferredAddress'] == 2) {
			if ($data['shopInfo']['user_country2'] == "USA") {
				$shopOwner['user_address'] = $data['shopInfo']['user_address2'];
				$shopOwner['user_city'] = $data['shopInfo']['user_city2'];
				$shopOwner['user_state'] = $data['shopInfo']['user_state2'];
				$shopOwner['user_zip'] = $data['shopInfo']['user_zip2'];
			} else {
				$shopOwner['notUSfullAddress'] = $data['shopInfo']['notUSfullAddress2'];
			}

			$shopOwner['user_country'] = $data['shopInfo']['user_country2'];
		}


		/* data for the buyer */
		$buyer['name'] = $orderDetails[0]['user_first_name'] . ' ' . $orderDetails[0]['user_last_name'];
		$buyer['display_name'] = $orderDetails[0]['display_name'];
		$buyer['user_phone'] = $orderDetails[0]['user_phone'];
		$buyer['preferredAddress'] = $orderDetails[0]['preferredAddress'];
		$buyer['emailTo'] = $orderDetails[0]['user_email'];

		if ($orderDetails[0]['preferredAddress'] == 1) {
			if ($orderDetails[0]['user_country'] == "USA") {
				$buyer['user_address'] = $orderDetails[0]['user_address'];
				$buyer['user_city'] = $orderDetails[0]['user_city'];
				$buyer['user_state'] = $orderDetails[0]['user_state'];
				$buyer['user_zip'] = $orderDetails[0]['user_zip'];
			} else {
				$buyer['notUSfullAddress'] = $orderDetails[0]['notUSfullAddress'];
			}

			$buyer['user_country'] = $orderDetails[0]['user_country'];
		} elseif ($orderDetails[0]['preferredAddress'] == 2) {
			if ($orderDetails[0]['user_country2'] == "USA") {
				$buyer['user_address'] = $orderDetails[0]['user_address2'];
				$buyer['user_city'] = $orderDetails[0]['user_city2'];
				$buyer['user_state'] = $orderDetails[0]['user_state2'];
				$buyer['user_zip'] = $orderDetails[0]['user_zip2'];
			} else {
				$buyer['notUSfullAddress'] = $orderDetails[0]['notUSfullAddress2'];
			}

			$buyer['user_country'] = $orderDetails[0]['user_country2'];
		}

		// we cannot calculate rate if shop owner's address is not from US because there's no USPS outside US.
		if (trim($shopOwner['user_country']) != "USA") {
			$responseData['error'] = 'We don\'t deliver shipment outside USA.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		$addOns = array();
		$this->load->helper('number');

		if ($this->input->post('insuredValue')) {
			$addOns['insuredValue'] = $this->input->post('insuredValue');
			if (!isNumericAndPositive($addOns['insuredValue'])) {
				$responseData['error'] = 'Invalid insurace amount.';
				$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
				$this->output->set_output(json_encode($response));
				return;
			}
		}

		if ($this->input->post('signature'))
			$addOns['signatureType'] = $this->input->post('signature');
		
		// check the width
		$package['width'] = $this->input->post('width');
		if ($package['width']) {
			if (!isNumericAndPositive($package['width'])) {
				$responseData['error'] = 'Invalid width number.';
				$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
				$this->output->set_output(json_encode($response));
				return;
			}
		} else {
			$responseData['error'] = 'Please input width.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		// let's check length
		$package['length'] = $this->input->post('length');
		if ($package['length']) {
			if (!isNumericAndPositive($package['length'])) {
				$responseData['error'] = 'Invalid length number.';
				$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
				$this->output->set_output(json_encode($response));
				return;
			}
		} else {
			$responseData['error'] = 'Please length width.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		// let's check height
		$package['height'] = $this->input->post('height');
		if ($package['height']) {
			if (!isNumericAndPositive($package['height'])) {
				$responseData['error'] = 'Invalid height number.';
				$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
				$this->output->set_output(json_encode($response));
				return;
			}
		} else {
			$responseData['error'] = 'Please height width.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}
		
		// let's check lbs
		$lbs = $this->input->post('lbs');
		if ($lbs) {
			if (!isNumericAndPositive($lbs)) {
				$responseData['error'] = 'Invalid pound number.';
				$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
				$this->output->set_output(json_encode($response));
				return;
			} else {
				$lbs = (float) $lbs;
			}
		} else {
			$responseData['error'] = 'Please input weight in pounds.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}
		// let's check oz
		$oz = $this->input->post('oz');
		if ($oz) {
			if (!isNumericAndPositive($oz)) {
				$responseData['error'] = 'Invalid oz. number.';
				$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
				$this->output->set_output(json_encode($response));
				return;
			} else {
				$oz = (float) $oz;
			}
		} else {
			$oz = 0;
		}

		$ozToPounds = $oz * 0.0625;	// 1 oz = 0.0625 pounds
		$package['weight'] = $ozToPounds + $lbs;

		$shippingMethod = $this->input->post('shippingMethod');
		$shippingMethod = strstr($shippingMethod, ',', true);
		if (!isNumericAndPositive($shippingMethod)) {
			$responseData['error'] = 'Invalid shipping method.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		$package['shippingMethod'] = $shippingMethod;

		$shipDate = $this->input->post('shippingDate');
		$shipDate = new DateTime($shipDate);
		$shipDate_string = $shipDate->format("Y-m-d");
		$currentDate = new DateTime();
		$currentDate_string = $currentDate->format("Y-m-d");
		if ($shipDate_string < $currentDate_string) {
			$responseData['error'] = 'Ship date must be current or future date.';
			$response['meta'] = ['statusCode' => 202, 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		if (empty($shipDate)) {
			$responseData['error'] = 'Ship date is missing.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}
		$package['shipDate'] = $shipDate->format(DateTime::ATOM);

		// now let's confirm shipment
		$USPSresponse = $this->confirmShipment($orderDetails[0]['orderid'], $shopOwner, $buyer, $package, $addOns);
		// $uspsResponse['error'] = 'Server was unable to process request. ---> Layout not supported.';
		if (isset($USPSresponse['error']))
			$response['meta'] = ['statusCode' => 202, 'data' => $USPSresponse];
		else
			$response['meta'] = ['statusCode' => 200, 'data' => $USPSresponse];

		$this->output->set_output(json_encode($response));
	}

	/* We delete unnecessary shipping method like postcard.
		@param $data - array of objects.
	*/
	private function deleteUnnecessaryShippingMethods(array $data) {
		foreach ($data as $index => $obj)
			if (($obj->PackageType == "Postcard") || ($obj->PackageType == "Letter"))
				unset($data[$index]);

		return $data;
	}


	/* 	@param $shopOwner - the shipper
		@param $buyer - the recipient
		@param $options - optional if there are other service you shipper wants to add
		@return  - returns response from RocketShipIt
	*/
	private function calculateShippingRate(array $shopOwner, array $buyer, array $packageParam) {
		require_once APPPATH . 'third_party/RocketShipIt/autoload.php';
		$this->load->helper('myhelp');

		$config = new \RocketShipIt\Config;
		$config->setDefault('generic', 'shipper', $shopOwner['shipper']);
		$config->setDefault('generic', 'shipContact', $shopOwner['shipContact']);
		$config->setDefault('generic', 'shipPhone', $shopOwner['user_phone']);

		if ($shopOwner['preferredAddress'] == 1) {
			$shipAddr1 = $shopOwner['user_address'];
			$shipAddr2 = '';
			$shipCity = $shopOwner['user_city'];
			$shipState = $shopOwner['user_state'];
			$shipCode = $shopOwner['user_zip'];
			$shipCountry = $shopOwner['user_country'];
		} elseif ($shopOwner['preferredAddress'] == 2) {
			$shipAddr1 = $shopOwner['user_address2'];
			$shipAddr2 = '';
			$shipCity = $shopOwner['user_city2'];
			$shipState = $shopOwner['user_state2'];
			$shipCode = $shopOwner['user_zip2'];
			$shipCountry = $shopOwner['user_country2'];
		} else {	// unknown address.
			$responseData['error'] = 'Invalid shop owner preferred address.';
			return $responseData;
		}

		$config->setDefault('generic', 'shipAddr1', $shipAddr1);
		$config->setDefault('generic', 'shipAddr2', $shipAddr2);
		$config->setDefault('generic', 'shipCity', $shipCity);
		$config->setDefault('generic', 'shipState', $shipState);
		$config->setDefault('generic', 'shipCode', $shipCode);
		$config->setDefault('generic', 'shipCountry', $shipCountry);


		$rate = new \RocketShipIt\Rate('STAMPS', array('config' => $config));
		if (isset($packageParam['service']))
			$rate->setParameter('service', $packageParam['service']);	// this can be set in the config level.

		$package = new \RocketShipIt\Package('STAMPS');

		if ($buyer['preferredAddress'] == 1) {
			$toCountry = getCountryISOCodeByCountryName(trim($buyer['user_country']));

			if ($toCountry == "US") {
				$rate->setParameter('toCode', $buyer['user_zip']);
			} else {
				$rate->setParameter('toCountry', $toCountry);
				// $package->setparameter('container', 'RECTANGULAR');
			}
		} elseif ($buyer['preferredAddress'] == 2) {
			$toCountry = getCountryISOCodeByCountryName(trim($buyer['user_country2']));

			if ($toCountry == "US") {
				$rate->setParameter('toCode', $buyer['user_zip2']);
			} else {
				$rate->setParameter('toCountry', $toCountry);
				// $package->setparameter('container', 'RECTANGULAR');
			}
		} else {	// unknown address
			return array('error' => 'Invalid buyer preferred address.');
		}

		// Defaults to 5 lbs as RocketShipIt needs it.
		if (!isset($packageParam['weight']))
			$package->setParameter('weight', '5');
		else
			$package->setParameter('weight', $packageParam['weight']);	

		// Optionally you can set dimensions
		if (isset($packageParam['length']) && isset($packageParam['width']) && isset($packageParam['height'])) {
			$package->setParameter('length', $packageParam['length']);
			$package->setParameter('width', $packageParam['width']);
			$package->setParameter('height', $packageParam['height']);
		}
		if(isset($packageParam['insuredValue']))
			$package->setParameter('insuredValue', $packageParam['insuredValue']);

		$rate->addPackageToShipment($package);

		// simple rates doesn't have description property so I request them both and later set it to.
		$shippingRates = $rate->getAllRates()->Rates->Rate;
		$simpleShippingRates = $rate->getSimpleRates();

		file_put_contents('c:\tmp\shippingRates.txt', print_r($shippingRates, true));
		file_put_contents('c:\tmp\simpleShippingRates.txt', print_r($simpleShippingRates, true));

		if (isset($simpleShippingRates['error']) || isset($shippingRates['error'])) {
			$responseData['error'] = $simpleShippingRates['error'] . ' ' . $shippingRates['error'];
			return $responseData;
		} else {	// simple rates doesn't have description property so I request them both and set it to the shippingRates.
			foreach ($shippingRates as $index => $classObj)
				$classObj->desc = $simpleShippingRates[$index]['desc'];

			return $this->deleteUnnecessaryShippingMethods($shippingRates);
		}
	}


	/* 	Description - call by $this->reciept().
		@param $data - includes shopInfo index for the shop owner's info
			$data['orderDetails'] - for the order details
	
		@return  - calculated rates passed to calculateShippinhRate();
	*/
	private function prepareCalculatingShipment(array $data) {
		// we cannot calculate rate if shop owner's address is not from US because there's no USPS outside US.
		if (trim($data['shopInfo']['user_country']) != "USA") {
			$responseData['error'] = 'Cannot send shipment from outside USA.';
			return $responseData;
		}

		$this->load->helper('address');
		if (!addressIsValid($data['shopInfo'])) {
			$responseData['error'] = 'Invalid shipper\'s address.';
			return $responseData;
		}
		if (!addressIsValid($data['orderDetails'][0])) {
			$responseData['error'] = 'Invalid recipient address.';
			return $responseData;
		}

		/* data for the shop owner */
		$shopOwner['shipper'] = $data['shopInfo']['shop_name'];
		$shopOwner['shipContact'] = $data['shopInfo']['display_name'];
		$shopOwner['user_phone'] = $data['shopInfo']['user_phone'];
		$shopOwner['preferredAddress'] = $data['shopInfo']['preferredAddress'];

		if ($data['shopInfo']['preferredAddress'] == 1) {
			if ($data['shopInfo']['user_country'] == "USA") {
				$shopOwner['user_address'] = $data['shopInfo']['user_address'];
				$shopOwner['user_city'] = $data['shopInfo']['user_city'];
				$shopOwner['user_state'] = $data['shopInfo']['user_state'];
				$shopOwner['user_zip'] = $data['shopInfo']['user_zip'];
			} else {
				$shopOwner['notUSfullAddress'] = $data['shopInfo']['notUSfullAddress'];
			}

			$shopOwner['user_country'] = $data['shopInfo']['user_country'];
		} elseif ($data['shopInfo']['preferredAddress'] == 2) {
			if ($data['shopInfo']['user_country2'] == "USA") {
				$shopOwner['user_address'] = $data['shopInfo']['user_address2'];
				$shopOwner['user_city'] = $data['shopInfo']['user_city2'];
				$shopOwner['user_state'] = $data['shopInfo']['user_state2'];
				$shopOwner['user_zip'] = $data['shopInfo']['user_zip2'];
			} else {
				$shopOwner['notUSfullAddress'] = $data['shopInfo']['notUSfullAddress2'];
			}

			$shopOwner['user_country'] = $data['shopInfo']['user_country2'];
		}

		/* data for the buyer */
		$buyer['name'] = $data['orderDetails'][0]['user_first_name'] . ' ' . $data['orderDetails'][0]['user_last_name'];
		$buyer['display_name'] = $data['orderDetails'][0]['display_name'];
		$buyer['user_phone'] = $data['orderDetails'][0]['user_phone'];
		$buyer['preferredAddress'] = $data['orderDetails'][0]['preferredAddress'];

		if ($data['orderDetails'][0]['preferredAddress'] == 1) {
			if ($data['orderDetails'][0]['user_country'] == "USA") {
				$buyer['user_address'] = $data['orderDetails'][0]['user_address'];
				$buyer['user_city'] = $data['orderDetails'][0]['user_city'];
				$buyer['user_state'] = $data['orderDetails'][0]['user_state'];
				$buyer['user_zip'] = $data['orderDetails'][0]['user_zip'];
			} else {
				$buyer['notUSfullAddress'] = $data['orderDetails'][0]['notUSfullAddress'];
			}

			$buyer['user_country'] = $data['orderDetails'][0]['user_country'];
		} elseif ($data['orderDetails'][0]['preferredAddress'] == 2) {
			if ($data['orderDetails'][0]['user_country2'] == "USA") {
				$buyer['user_address'] = $data['orderDetails'][0]['user_address2'];
				$buyer['user_city'] = $data['orderDetails'][0]['user_city2'];
				$buyer['user_state'] = $data['orderDetails'][0]['user_state2'];
				$buyer['user_zip'] = $data['orderDetails'][0]['user_zip2'];
			} else {
				$buyer['notUSfullAddress'] = $data['orderDetails'][0]['notUSfullAddress2'];
			}

			$buyer['user_country'] = $data['orderDetails'][0]['user_country2'];
		}

		$packageParam = [];
		if (isset($data['weight']))
			$packageParam['weight'] = $data['weight'];
		if (isset($data['service']))
			$packageParam['service'] = $data['service'];
		if(isset($data['length']) && isset($data['width']) && isset($data['height'])) {
			$packageParam['length'] = $data['length'];
			$packageParam['width'] = $data['width'];
			$packageParam['height'] = $data['height'];
		}
		if(isset($data['insuredValue']))
			$packageParam['insuredValue'] = $data['insuredValue'];
		
		return $this->calculateShippingRate($shopOwner, $buyer, $packageParam);
	}
	
	// returns web
	public function reciept($orderNumber) {
		$data['orderNumber'] = $orderNumber;

		$this->load->model('order_model');
		$orderDetails = $this->order_model->getOrderDetailsByOrderNumber($orderNumber);
		$data['orderDetails'] = $orderDetails;

		$this->load->model('user_model');
		$data['shopInfo'] = $this->user_model->getShopInfo($orderDetails[0]['shopid']);

		$data['orderStatus'] = $orderDetails[0]['order_status'];

		foreach ($orderDetails as $row) {
			// http://localhost/projects/citisellv2/assets/frontend/images/shops/mostak-shop/images12.jpg
			if ($row['productImage'] == NULL) {
				$pimglocationRec = base_url()."assets/frontend/images/shops/default-img.jpg";
			} else {
				$shopName = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $data['shopInfo']['shop_name']))));				
				$imageSrc = base_url()."assets/frontend/images/shops/{$shopName}/{$row['productImage']}";
			}

			$data['images'][] = $imageSrc;
		}

		if ($data['orderStatus'] == "Pending") {
			$response = $this->prepareCalculatingShipment($data);

			if (isset($response['error']))
				$data['meta'] = ['statusCode' => 202, 'data' => $response];
			else
				$data['meta'] = ['statusCode' => 200, 'data' => $response];
		}

		$data['breadcrumb'] =	'Shipping.';

		file_put_contents('c:\tmp\data.txt', print_r($data, true));

		$this->load->view('shipping/shipping_label', $data);
	}

	// return json; similar to $this->reciept() but ajax request.
	public function shippingRates($orderNumber) {
		$this->output->set_content_type('application/json');

		$data['orderNumber'] = $orderNumber;

		$oz = trim($this->input->get("oz"));
		($oz == "" ? $oz = 0 : "");

		$this->load->helper('number');

		if (!isNumericAndPositive($oz)) {
			$response['error'] = 'Invalid onze value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		}
		$lbs = $this->input->get("lbs");
		if (!isNumericAndPositive($lbs)) {
			$response['error'] = 'Invalid pounds value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		}

		$ozToPounds = $oz * 0.0625;	// 1 oz = 0.0625 pounds
		$data['weight'] = $ozToPounds + $lbs;

		$data['length'] = $this->input->get("length");
		$data['width'] = $this->input->get("width");
		$data['height'] = $this->input->get("height");

		$this->load->model('order_model');
		$orderDetails = $this->order_model->getOrderDetailsByOrderNumber($orderNumber);
		$data['orderDetails'] = $orderDetails;

		$this->load->model('user_model');
		$data['shopInfo'] = $this->user_model->getShopInfo($orderDetails[0]['shopid']);

		$data['orderStatus'] = $orderDetails[0]['order_status'];

		$shippingMethod = $this->input->get("shippingMethod");
		$shippingMethod = strstr($shippingMethod, ',');
		$data['service'] = ltrim($shippingMethod, ',');

		$data['insuredValue'] = $this->input->get("insuredValue");


		if ($data['orderStatus'] == "Pending") {
			$response = $this->prepareCalculatingShipment($data);

			if (isset($response['error']))
				$jsonResponse['meta'] = ['statusCode' => 202, 'data' => $response];
			else
				$jsonResponse['meta'] = ['statusCode' => 200, 'data' => $response];
		}
		
		$jsonResponse['orderNumber'] = $data['orderNumber'];
		$jsonResponse['orderStatus'] = $data['orderStatus'];
		
		$this->output->set_output(json_encode($jsonResponse));
	}
	
	function purchasedlbl() {
		$this->load->view('shipping/purchased_label');
	}
	
	function refundedlbl() {
		$this->load->view('shipping/refunded_label');
	}
	
	function optionlbl() {
		$this->load->view('shipping/options');
	}
}
