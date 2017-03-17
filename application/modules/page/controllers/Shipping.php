<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

require_once APPPATH . 'third_party/RocketShipIt/autoload.php';

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

	/* 	Descrption - Call by $this->confirmAndBuy(). We always assume data being passed are all been sanitized already. Meaning no more conditional statements.
		@param $orderId - the order id
		@param $shopOwner - the shipper.
		@param $buyer - the recipient
		@param $package - package information like weight.
		@param $addOns - optional if there are other services your shipper wants to add
		@return  - returns response from RocketShipIt
	*/
	private function confirmShipment($orderId, array $shopOwner, array $buyer, array $packageParam, array $addOns=null) {
		// file_put_contents('c:\tmp\packageParam.txt', print_r($packageParam, true)); return;
		$config = new \RocketShipIt\Config;
		$config->setDefault('generic', 'shipper', $shopOwner['shipper']);
		$config->setDefault('generic', 'fromName', $shopOwner['shipper']);
		$config->setDefault('generic', 'shipContact', $shopOwner['shipContact']);
		$config->setDefault('generic', 'shipPhone', $shopOwner['user_phone']);
		$config->setDefault('generic', 'shipAddr1', $shopOwner['user_address']);
		$config->setDefault('generic', 'shipAddr2', $shopOwner['shipAddr2']);
		$config->setDefault('generic', 'shipCity', $shopOwner['user_city']);
		$config->setDefault('generic', 'shipState', $shopOwner['user_state']);
		$config->setDefault('generic', 'shipCode', $shopOwner['user_zip']);

		$shipment = new \RocketShipIt\Shipment('STAMPS', array('config' => $config));
		// $shipment->setParameter('toCompany', 'RocketShipIt');
		$shipment->setParameter('toName', $buyer['user_name']);
		$shipment->setParameter('toAddr1', $buyer['user_address']);
		$shipment->setParameter('toAddr2', $buyer['toAddr2']);
		$shipment->setParameter('toCity', $buyer['user_city']);
		$shipment->setParameter('toState', $buyer['user_city']);
		$shipment->setParameter('toCode', $buyer['user_zip']);
		if ($buyer['user_country'] != "US")		// country should be in ISO code. If this is international shipment.
			$shipment->setParameter('toCountry', $buyer['user_country']);		
		// $shipment->setParameter('referenceValue', '123adsf'); // may be we need this in the future.

		/*$shipment->setParameter('weight', $packageParam['weight']);
		$shipment->setParameter('length', $packageParam['length']);
		$shipment->setParameter('width', $packageParam['width']);
		$shipment->setParameter('height', $packageParam['height']);*/

		$rate = new \RocketShipIt\Rate('STAMPS', array('config' => $config));

		/* Add-ons definitions here. */
		if (isset($addOns['insuredValue'])) {
			$rate->setParameter('insuredCurrency', 'USD');
			$rate->setParameter('insuredValue', $addOns['insuredValue']);
		}
		if (isset($addOns['signatureType']))
			$rate->setParameter('signatureType','2');
		
		if ($buyer['user_country'] != "US") { // country should be in ISO code. If this is international shipment.
			# customs
			$shipment->setParameter('customsContentType', 'Merchandise');
			# customs lines
			$custLines = new \RocketShipIt\Customs('STAMPS');
			$custLines->setParameter('customsDescription', 'For personal use.');
			$custLines->setParameter('customsQuantity', '1');
			$custLines->setParameter('customsWeight', $packageParam['weight']);
			$custLines->setParameter('customsValue', '0.00');
			$custLines->setParameter('customsHsTariff', '');
			$custLines->setParameter('customsOriginCountry', 'US');

			$shipment->addCustomsLineToShipment($custLines);

			$rate->setParameter('customsValue', '0.00');
			$rate->setParameter('toCountry', $buyer['user_country']);

			$shipment->setParameter('toPhone', $buyer['user_phone']);
		} else {	// if only going to US it needs toCode.
			$rate->setParameter('toCode', $buyer['user_zip']);
		}

		if (isset($packageParam['shipDate']))	//Y-m-d format
			$rate->setParameter('shipDate', $packageParam['shipDate']); 
		
		$rate->setParameter('weight', $packageParam['weight']);
		$rate->setParameter('length', $packageParam['length']);
		$rate->setParameter('width', $packageParam['width']);
		$rate->setParameter('height', $packageParam['height']);

		$response = $rate->getAllRates();

		// file_put_contents('c:\tmp\response.txt', print_r($response, true));

		$rates = $response->Rates;
		$rate = $rates->Rate;

		# Select the rate/service you want
		# from a list of all available
		$package = $rate[$packageParam['shippingMethod']];

		# Remove all addons
		$package->AddOns = null;

		/*# Add the addons you want for this
		# shipment
		$addons = array();
		$a = new \stdClass();
		$a->AddOnType = 'US-A-DC';
		array_push($addons, $a);
		$package->AddOns = $addons;*/

		if ($buyer['user_country'] == "US") { // country should be in ISO code. If this is international shipment.
			// The rate can suggest a new zipcode
			// Set this new zipcode on the shipment to avoid:
			// "Rate ToZIPCode and Destination Address ZIPCode field must match."
			$shipment->setParameter('toCode', $package->ToZIPCode);
		}

		$shipment->setParameter('weight', $package->WeightLb);
		$shipment->setParameter('length', $package->Length);
		$shipment->setParameter('width', $package->Width);
		$shipment->setParameter('height', $package->Height);
		

		$shipment->addPackageToShipment($package);

		$response = $shipment->submitShipment();

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

		// we cannot calculate rate if shop owner's address is not from US because there's no USPS outside US.
		if (trim($data['shopInfo']['user_country']) != "USA") {
			$responseData['error'] = 'We don\'t deliver shipment outside USA.';
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

		if ($data['shopInfo']['preferredAddress'] == 1) {
			$shopOwner['user_address'] = $data['shopInfo']['user_address'];
			$shopOwner['shipAddr2'] = $data['shopInfo']['addrLine2Of1'];
			$shopOwner['user_city'] = $data['shopInfo']['user_city'];
			$shopOwner['user_state'] = $data['shopInfo']['user_state'];
			$shopOwner['user_zip'] = $data['shopInfo']['user_zip'];
			$shopOwner['user_country'] = $data['shopInfo']['user_country'];
		} elseif ($data['shopInfo']['preferredAddress'] == 2) {
			$shopOwner['user_address'] = $data['shopInfo']['user_address2'];
			$shopOwner['shipAddr2'] = $data['shopInfo']['addrLine2Of2'];
			$shopOwner['user_city'] = $data['shopInfo']['user_city2'];
			$shopOwner['user_state'] = $data['shopInfo']['user_state2'];
			$shopOwner['user_zip'] = $data['shopInfo']['user_zip2'];
			$shopOwner['user_country'] = $data['shopInfo']['user_country2'];
		}


		/* data for the buyer */
		$buyer['user_name'] = $orderDetails[0]['user_first_name'] . ' ' . $orderDetails[0]['user_last_name'];
		$buyer['display_name'] = $orderDetails[0]['display_name'];
		$buyer['user_phone'] = $orderDetails[0]['user_phone'];
		$buyer['preferredAddress'] = $orderDetails[0]['preferredAddress'];
		$buyer['emailTo'] = $orderDetails[0]['user_email'];

		$this->load->helper('myhelp');
		if ($orderDetails[0]['preferredAddress'] == 1) {
			$buyer['user_address'] = $orderDetails[0]['user_address'];
			$buyer['toAddr2'] = $orderDetails[0]['addrLine2Of1'];
			$buyer['user_city'] = $orderDetails[0]['user_city'];
			$buyer['user_state'] = $orderDetails[0]['user_state'];
			$buyer['user_zip'] = $orderDetails[0]['user_zip'];
			$buyer['user_country'] = getCountryISOCodeByCountryName($orderDetails[0]['user_country']);
		} elseif ($orderDetails[0]['preferredAddress'] == 2) {
			$buyer['user_address'] = $orderDetails[0]['user_address2'];
			$buyer['toAddr2'] = $orderDetails[0]['addrLine2Of2'];
			$buyer['user_city'] = $orderDetails[0]['user_city2'];
			$buyer['user_state'] = $orderDetails[0]['user_state2'];
			$buyer['user_zip'] = $orderDetails[0]['user_zip2'];
			$buyer['user_country'] = getCountryISOCodeByCountryName($orderDetails[0]['user_country2']);
		}

		if (!$buyer['user_country']) {	//ISO country code
			$responseData['error'] = 'Unknown buyer country.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}


		/* data for add-ons */
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
		$packageParam['width'] = $this->input->post('width');
		if ($packageParam['width']) {
			if (!isNumericAndPositive($packageParam['width'])) {
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
		$packageParam['length'] = $this->input->post('length');
		if ($packageParam['length']) {
			if (!isNumericAndPositive($packageParam['length'])) {
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
		$packageParam['height'] = $this->input->post('height');
		if ($packageParam['height']) {
			if (!isNumericAndPositive($packageParam['height'])) {
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
		$packageParam['weight'] = $ozToPounds + $lbs;

		$shippingMethod = $this->input->post('shippingMethod');
		$shippingMethod = strstr($shippingMethod, ',', true);
		if (!isNumericAndPositive($shippingMethod)) {
			$responseData['error'] = 'Invalid shipping method.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		}

		$packageParam['shippingMethod'] = $shippingMethod;

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
		$packageParam['shipDate'] = $shipDate_string;

		// now let's confirm shipment
		$StampsResponse = $this->confirmShipment($orderDetails[0]['orderid'], $shopOwner, $buyer, $packageParam, $addOns);
		// $StampsResponse['error'] = 'Server was unable to process request. ---> Layout not supported.';
		if (isset($StampsResponse['error']))
			$response['meta'] = ['statusCode' => 202, 'data' => $StampsResponse];
		else
			$response['meta'] = ['statusCode' => 200, 'data' => $StampsResponse];

		$this->output->set_output(json_encode($response));
	}

	/* 	Description - We always assume data being passed are all been sanitized already. Meaning no more conditional statements.
		@param $shopOwner - the shipper
		@param $buyer - the recipient
		@param $options - optional if there are other service you shipper wants to add
		@return  - returns response from RocketShipIt
	*/
	private function calculateShippingRates(array $shopOwner, array $buyer, array $packageParam) {		
		$this->load->helper('myhelp');

		$config = new \RocketShipIt\Config;
		$config->setDefault('generic', 'shipCode', $shopOwner['user_zip']);

		$rate = new \RocketShipIt\Rate('STAMPS', array('config' => $config));
		$rate->setParameter('toCode', $buyer['user_zip']);
		
		if ($buyer['user_country'] != "US")
			$rate->setParameter('toCountry', $buyer['user_country']);

		$package = new \RocketShipIt\Package('STAMPS');
		if (!isset($packageParam['weight']))
			$package->setParameter('weight', '5');
		else
			$package->setParameter('weight', $packageParam['weight']);

		// Set dimensions
		if (isset($packageParam['length']) && isset($packageParam['width']) && isset($packageParam['height'])) {
			$package->setParameter('length', $packageParam['length']);
			$package->setParameter('width', $packageParam['width']);
			$package->setParameter('height', $packageParam['height']);
		}

		if(isset($packageParam['insuredValue']))
			$package->setParameter('insuredValue', $packageParam['insuredValue']);
		if (isset($packageParam['shipDate']))	//Y-m-d format
			$rate->setParameter('shipDate', $packageParam['shipDate']); 


		$rate->addPackageToShipment($package);

		// simple rates doesn't have description property so I request them both and later set it to.
		$shippingRates = $rate->getAllRates();		

		if (!property_exists($shippingRates, 'Rates')) {
			$responseData['error'] = $shippingRates->getMessage();
			return $responseData;
		}

		$shippingRates = $shippingRates->Rates->Rate;
		$simpleShippingRates = $rate->getSimpleRates();

		if (isset($simpleShippingRates['error']) || isset($shippingRates['error'])) {
			$responseData['error'] = $simpleShippingRates['error'] . ' ' . $shippingRates['error'];
			return $responseData;
		} else {	// simple rates doesn't have description property so I request them both and set it to the shippingRates.
			foreach ($shippingRates as $index => $classObj)
				$classObj->desc = $simpleShippingRates[$index]['desc'];

			return $shippingRates;
		}
	}

	/* This verifies US addresses. */
	private function validateRecipientAddress(array $recipient) {
		$av = new \RocketShipIt\AddressValidate('STAMPS');
		$av->setParameter('toState', $recipient['user_state']);
		$av->setParameter('toCity', $recipient['user_city']);
		$av->setParameter('toAddr1', $recipient['user_address']);
		$av->setParameter('toCode', $recipient['user_zip']);
		return $av->validate();
	}


	/* 	Description - call by $this->reciept(). This sanitizes all input into $this->calculateShippingRates().
		@param $data - includes shopInfo index for the shop owner's info
			$data['orderDetails'] - for the order details
	
		@return  - calculated rates passed to calculateShippinhRate();
	*/
	private function prepareCalculatingShipmentRates(array $data) {
		// we cannot calculate rate if shop owner's address is not from US because there's no USPS outside US.
		if (trim($data['shopInfo']['user_country']) != "USA") {
			$responseData['error'] = 'Cannot send shipment from outside USA.';
			return $responseData;
		}

		$this->load->helper('address');
		if (!addressIsValid($data['shopInfo'])) {
			$responseData['error'] = "Invalid shipper's address.";
			return $responseData;
		}
		if (!addressIsValid($data['orderDetails'][0])) {
			$responseData['error'] = 'Invalid recipient address.';
			return $responseData;
		}

		/* data for the shop owner */

		if ($data['shopInfo']['preferredAddress'] == 1) {			
			$shopOwner['user_address'] = $data['shopInfo']['user_address'];
			$shopOwner['user_city'] = $data['shopInfo']['user_city'];
			$shopOwner['user_state'] = $data['shopInfo']['user_state'];
			$shopOwner['user_zip'] = $data['shopInfo']['user_zip'];
		} elseif ($data['shopInfo']['preferredAddress'] == 2) {
			$shopOwner['user_address'] = $data['shopInfo']['user_address2'];
			$shopOwner['user_city'] = $data['shopInfo']['user_city2'];
			$shopOwner['user_state'] = $data['shopInfo']['user_state2'];
			$shopOwner['user_zip'] = $data['shopInfo']['user_zip2'];
		}


		/* data for the buyer */
		$buyer['name'] = $data['orderDetails'][0]['user_first_name'] . ' ' . $data['orderDetails'][0]['user_last_name'];
		$buyer['display_name'] = $data['orderDetails'][0]['display_name'];
		$buyer['user_phone'] = $data['orderDetails'][0]['user_phone'];

		$this->load->helper("myhelp");
		if ($data['orderDetails'][0]['preferredAddress'] == 1) {
			$buyer['user_address'] = $data['orderDetails'][0]['user_address'];
			$buyer['user_city'] = $data['orderDetails'][0]['user_city'];
			$buyer['user_state'] = $data['orderDetails'][0]['user_state'];
			$buyer['user_zip'] = $data['orderDetails'][0]['user_zip'];
			$buyer['user_country'] = getCountryISOCodeByCountryName($data['orderDetails'][0]['user_country']);
		} elseif ($data['orderDetails'][0]['preferredAddress'] == 2) {
			$buyer['user_address'] = $data['orderDetails'][0]['user_address2'];
			$buyer['user_city'] = $data['orderDetails'][0]['user_city2'];
			$buyer['user_state'] = $data['orderDetails'][0]['user_state2'];
			$buyer['user_zip'] = $data['orderDetails'][0]['user_zip2'];
			$buyer['user_country'] = getCountryISOCodeByCountryName($data['orderDetails'][0]['user_country2']);
		} else {	// unknown address
			return array('error' => 'Invalid buyer preferred address.');
		}

		$packageParam = [];
		if (isset($data['weight']))
			$packageParam['weight'] = $data['weight'];
		if (isset($data['service']))
			$packageParam['service'] = $data['service'];
		if (isset($data['length']) && isset($data['width']) && isset($data['height'])) {
			$packageParam['length'] = $data['length'];
			$packageParam['width'] = $data['width'];
			$packageParam['height'] = $data['height'];
		}
		if(isset($data['insuredValue']))
			$packageParam['insuredValue'] = $data['insuredValue'];
		if(isset($data['shipDate']))
			$packageParam['shipDate'] = $data['shipDate'];

		if ($buyer['user_country'] == 'US')
			if (!$this->validateRecipientAddress($buyer)->AddressMatch)
				return array('error' => 'Invalid buyer address. USPS cannot verify the address.');
		
		return $this->calculateShippingRates($shopOwner, $buyer, $packageParam);
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
			$response = $this->prepareCalculatingShipmentRates($data);

			if (isset($response['error']))
				$data['meta'] = ['statusCode' => 202, 'data' => $response];
			else
				$data['meta'] = ['statusCode' => 200, 'data' => $response];
		}

		$data['breadcrumb'] =	'Shipping.';

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
		if (!isNumericAndPositive($data['length'])) {
			$response['error'] = 'Invalid length value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		}
		$data['width'] = $this->input->get("width");
		if (!isNumericAndPositive($data['width'])) {
			$response['error'] = 'Invalid width value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		}
		$data['height'] = $this->input->get("height");
		if (!isNumericAndPositive($data['height'])) {
			$response['error'] = 'Invalid height value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		}

		$this->load->model('order_model');
		$orderDetails = $this->order_model->getOrderDetailsByOrderNumber($orderNumber);
		$data['orderDetails'] = $orderDetails;

		$this->load->model('user_model');
		$data['shopInfo'] = $this->user_model->getShopInfo($orderDetails[0]['shopid']);

		$data['orderStatus'] = $orderDetails[0]['order_status'];

		$shippingMethod = $this->input->get("shippingMethod");	// Sample: shippingMethod = 2,US-PM
		$shippingMethod = strstr($shippingMethod, ',');
		$data['service'] = ltrim($shippingMethod, ',');

		$data['insuredValue'] = $this->input->get("insuredValue");

		$shipDate = $this->input->get("shippingDate");
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
		$data['shipDate'] = $shipDate_string;


		if ($data['orderStatus'] == "Pending") {
			$response = $this->prepareCalculatingShipmentRates($data);

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
