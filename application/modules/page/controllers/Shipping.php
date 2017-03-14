<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Shipping extends CI_Controller 
{
	private $packagingTypes = ['VARIABLE (default)', 'FLAT RATE ENVELOPE', 'LEGAL FLAT RATE ENVELOPE', 'PADDED FLAT RATE ENVELOPE', 'GIFT CARD FLAT RATE ENVELOPE', 'SM FLAT RATE ENVELOPE',
		'WINDOW FLAT RATE ENVELOPE', 'SM FLAT RATE BOX', 'MD FLAT RATE BOX', 'LG FLAT RATE BOX', 'REGIONALRATEBOXA', 'REGIONALRATEBOXB', 'RECTANGULAR', 'NONRECTANGULAR'];

	public function __construct() {
		parent::__construct();
		$userlogged = $this->session->userdata('userid');
		if ($userlogged === null)
			redirect('page/login/dologin');
	}
	
	// Default load this function
	public function index() {
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(["meta" => "", "data" => ""]));
	}

	/* 	Descrption - Call by $this->confirmAndBuy().
		@param $orderId - the order id
		@param $shopOwner - the shipper.
		@param $buyer - the recipient
		@param $package - package information like weight.
		@param $addOns - optional if there are other services your shipper wants to add
		@return  - returns response from RocketShipIt
	*/
	// private function confirmShipment(array $shopOwner, array $buyer, array $package, array $options=null) {
	private function confirmShipment($orderId, array $shopOwner, array $buyer, array $package, array $addOns=null) {
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
			return ['error' => [0 => ['code' => -1, 'description' => 'Invalid shop owner preferred address.']]];
		}

		$config->setDefault('generic', 'shipAddr1', $shipAddr1);
		$config->setDefault('generic', 'shipAddr2', $shipAddr2);
		$config->setDefault('generic', 'shipCity', $shipCity);
		$config->setDefault('generic', 'shipState', $shipState);
		$config->setDefault('generic', 'shipCode', $shipCode);
		$config->setDefault('generic', 'shipCountry', $shipCountry);


		/* After the shipper configuration, shipment. */

		$toName = $buyer['name'];
		$toCompany = $buyer['display_name'];
		$toPhone = $buyer['user_phone'];

		if ($buyer['preferredAddress'] == 1) {
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
			return ['error' => [0 => ['code' => -1, 'description' => 'Invalid buyer preferred address.']]];
		}
		
		$shipment = new \RocketShipIt\Shipment('STAMPS');
		$shipment->setParameter('toName', $toName);
		$shipment->setParameter('toCompany', $toCompany);
		$shipment->setParameter('toPhone', $toPhone);
		$shipment->setParameter('toAddr1', $toAddr1);
		$shipment->setParameter('toCity', $toCity);
		$shipment->setParameter('toState', $toState);
		$shipment->setParameter('emailTo', $buyer['emailTo']);
		$shipment->setParameter('shipDate', $package['shipDate']);

		/* Add-ons definitions here. */
		if (isset($addOns['insuredValue'])) {
			$shipment->setParameter('insuredCurrency','USD');
			$shipment->setParameter('insuredValue', $addOns['insuredValue']);			
		}
		if (isset($addOns['signatureType']))
			$shipment->setParameter('signatureType','STAMPS');

		if (!isNumericAndPositive($package['weight']))
			return ['error' => [0 => ['code' => -1, 'description' => 'Invalid weight value.']]];
		if (!isNumericAndPositive($package['length']))
			return ['error' => [0 => ['code' => -1, 'description' => 'Invalid length value.']]];
		if (!isNumericAndPositive($package['width']))
			return ['error' => [0 => ['code' => -1, 'description' => 'Invalid width value.']]];
		if (!isNumericAndPositive($package['height']))
			return ['error' => [0 => ['code' => -1, 'description' => 'Invalid height value.']]];

		$rate = new \RocketShipIt\Rate('Stamps', array('config' => $config));
		$rate->setParameter('toCode', $toCode);
		$rate->setParameter('weight', $package['weight']);
		$rate->setParameter('length', $package['length']);
		$rate->setParameter('width', $package['width']);
		$rate->setParameter('height', $package['height']);
		$response = $rate->getAllRates();

		file_put_contents('c:\tmp\rateDebug.txt', print_r($rate->debug(), true));

		$rates = $response->Rates;
		$rate = $rates->Rate;

		# Select the rate/service you want
		# from a list of all available
		$package = $rate[$package['shippingMethod']];

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

		$statusCode = 200; $responseData = [];
		$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
		$this->output->set_content_type('application/json');

		if (!$orderDetails) {
			$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Order number not found.']]];
			$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}
		if ($orderDetails[0]['itemStatus']) {
			$responseData = ['error' => [0 => ['code' => -1, 'description' => 'This item has already been processed.']]];
			$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		$this->load->model('user_model');
		$data['shopInfo'] = $this->user_model->getShopInfo($orderDetails[0]['shopid']);

		if (!$data['shopInfo']) {
			$statusCode = 200;
			$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Shop is unknown.']]];
			$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		$this->load->helper('address');

		if (!addressIsValid($data['shopInfo'])) {
			$statusCode = 200;
			$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Shop address is invalid.']]];
			$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}
		if (!addressIsValid($orderDetails[0])) {
			$statusCode = 200;
			$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Buyer address is invalid.']]];
			$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
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
			$responseData = ['error' => [0 => ['code' => -1, 'description' => 'We don\'t deliver shipment outside USA.']]];
			$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		$addOns = array();

		$this->load->helper('number');
		if ($this->input->post('insurance')) {
			$addOns['insuredValue'] = $this->input->post('insurance');
			if (!isNumericAndPositive($addOns['insuredValue'])) {
				$statusCode = 200;
				$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Invalid insurace amount.']]];
				$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
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
				$statusCode = 200;
				$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Invalid width number.']]];
				$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
				$this->output->set_output(json_encode($response));
				return;
			}
		} else {
			$statusCode = 200;
			$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Please input width.']]];
			$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		// let's check length
		$package['length'] = $this->input->post('length');
		if ($package['length']) {
			if (!isNumericAndPositive($package['length'])) {
				$statusCode = 200;
				$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Invalid length number.']]];
				$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
				$this->output->set_output(json_encode($response));
				return;
			}
		} else {
			$statusCode = 200;
			$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Please length width.']]];
			$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		// let's check height
		$package['height'] = $this->input->post('height');
		if ($package['height']) {
			if (!isNumericAndPositive($package['height'])) {
				$statusCode = 200;
				$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Invalid height number.']]];
				$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
				$this->output->set_output(json_encode($response));
				return;
			}
		} else {
			$statusCode = 200;
			$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Please height width.']]];
			$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}
		
		// let's check lbs
		$lbs = $this->input->post('lbs');
		if ($lbs) {
			if (!isNumericAndPositive($lbs)) {
				$statusCode = 200;
				$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Invalid pound number.']]];
				$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
				$this->output->set_output(json_encode($response));
				return;
			} else {
				$lbs = (float) $lbs;
			}
		} else {
			$statusCode = 200;
			$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Please input weight in pounds.']]];
			$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}
		// let's check oz
		$oz = $this->input->post('oz');
		if ($oz) {
			if (!isNumericAndPositive($oz)) {
				$statusCode = 200;
				$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Invalid oz. number.']]];
				$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
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
		if (!isNumericAndPositive($shippingMethod)) {
			$statusCode = 200;
			$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Invalid shipping method.']]];
			$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
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
			$statusCode = 200;
			$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Ship date must be current or future date.']]];
			$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		if (empty($shipDate)) {
			$statusCode = 200;
			$responseData = ['error' => [0 => ['code' => -1, 'description' => 'Ship date is missing.']]];
			$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}
		$package['shipDate'] = $shipDate->format(DateTime::ATOM);

		// now let's confirm shipment
		$uspsResponse = $this->confirmShipment($orderDetails[0]['orderid'], $shopOwner, $buyer, $package, $addOns);
		// $uspsResponse['error'] = 'Server was unable to process request. ---> Layout not supported.';
		if ($uspsResponse['error']) {
			$statusCode = 202;
			$responseData = ['error' => [0 => ['code' => -1, 'description' => $uspsResponse['error']]]];
		} else {
			$responseData = ['error' => [], 'response' => $uspsResponse];
		}

		$response = ['meta' => ['statusCode' => $statusCode], 'data' => $responseData];
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
	private function calculateShippingRate(array $shopOwner, array $buyer, array $packageParam=null) {
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
		$rate->setParameter('service', 'PRIORITY');	// this can be set in the config level.

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
			$responseData['error'] = 'Invalid buyer preferred address.';
			return $responseData;
		}

		// Default to 5 lbs as I don't know why this is needed on calculating rates but RocketShipIt needs it.
		if (!isset($packageParam['weight']))
			$package->setParameter('weight', '5');
		else
			$package->setParameter('weight', $packageParam['weight']);	

		// Optionally you can set dimensions
		/*$package->setParameter('length', '1');
		$package->setParameter('width', '2');
		$package->setParameter('height', '3');*/
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
		
		return $this->calculateShippingRate($shopOwner, $buyer);
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

	// return json; similar to $this->reciept().
	public function shippingRates($orderNumber) {
		$data['orderNumber'] = $orderNumber;
		$weight = $this->input->get("weight");

		$ozToPounds = $oz * 0.0625;	// 1 oz = 0.0625 pounds
		$package['weight'] = $ozToPounds + $lbs;
		

		$this->load->model('order_model');
		$orderDetails = $this->order_model->getOrderDetailsByOrderNumber($orderNumber);
		$data['orderDetails'] = $orderDetails;

		$this->load->model('user_model');
		$data['shopInfo'] = $this->user_model->getShopInfo($orderDetails[0]['shopid']);

		$data['orderStatus'] = $orderDetails[0]['order_status'];

		if ($data['orderStatus'] == "Pending") {
			$response = $this->prepareCalculatingShipment($data);

			if (isset($response['error']))
				$data['meta'] = ['statusCode' => 202, 'data' => $response];
			else
				$data['meta'] = ['statusCode' => 200, 'data' => $response];
		}

		unset($data['orderDetails']);	// not needed
		unset($data['shopInfo']);	// not needed
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
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
