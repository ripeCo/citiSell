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

	public function tracking($trackingNumber) {
		$this->output->set_content_type('application/json');

		$trackingNumber = trim($trackingNumber);

		if (!$trackingNumber) {
			$response['Meta'] = ['Code' => 200, 'ErrorMessage' => ''];
			$response['Data'] = ['Errors' => ['Code' => null, 'Description' => 'Failed to get tracking events.', 'Type' => 'Error']];
			$response['Data'] = ['ShipmentId' => '', "Destination" => null, "EstimatedDelivery" => "", "DeliveredTime" => "", "Packages" => []];

			$this->output->set_output(json_encode($response));
			return;
		}

		$t = new \RocketShipIt\Track('Stamps');
		$response = $t->track($trackingNumber);

		$this->load->model('order_model');
	    $shipDate = $this->order_model->getShippingInfoBytrackingNumber($trackingNumber)['shipDate'];
	    $shipDate = new DateTime($shipDate);
	    $response['shipDate'] = $shipDate->format('M d, Y');

		$this->output->set_output(json_encode($response));
	}

	private function purchasePostage($amount) {
		$stamps = new \RocketShipIt\Carrier\Stamps();
		$response = $stamps->purchasePostage($amount + 5); // // we add 5 here to avoid insufficient balance.
		// file_put_contents('c:\tmp\purchasePostage.txt', print_r($response, TRUE));
		return $response;
	}

	private function getAccountInfo() {
		$stamps = new \RocketShipIt\Carrier\Stamps();
		$response = $stamps->getAccountInfo();
	}

	/* 	Descrption - Call by $this->confirmAndBuy(). We always assume data being passed are all been sanitized already. Meaning no more conditional statements.
		@param $orderNumber - the ordernumber in mega_order db table.
		@param $shopOwner - the shipper.
		@param $buyer - the recipient
		@param $packageParam - package information like weight.
		@param $addOnsParam - optional if there are other services your shipper wants to add
		@return  - returns response from RocketShipIt plus other data.
	*/
	private function confirmShipment($orderNumber, array $shopOwner, array $buyer, array $packageParam, array $addOnsParam) {
		file_put_contents('c:\tmp\addOnsParam.txt', print_r($addOnsParam, true));

		$config = new \RocketShipIt\Config;
		$config->setDefault('generic', 'shipper', $shopOwner['shipper']);
		$config->setDefault('generic', 'fromName', $shopOwner['shipper']);
		$config->setDefault('generic', 'shipContact', $shopOwner['shipContact']);
		$config->setDefault('generic', 'shipPhone', $shopOwner['shipPhone']);
		$config->setDefault('generic', 'shipAddr1', $shopOwner['shipAddr1']);
		$config->setDefault('generic', 'shipAddr2', $shopOwner['shipAddr2']);
		$config->setDefault('generic', 'shipCity', $shopOwner['shipCity']);
		$config->setDefault('generic', 'shipState', $shopOwner['shipState']);
		$config->setDefault('generic', 'shipCode', $shopOwner['shipCode']);

		$shipment = new \RocketShipIt\Shipment('STAMPS', array('config' => $config));
		$shipment->setParameter('toName', $buyer['name']);
		$shipment->setParameter('toAddr1', $buyer['toAddr1']);
		$shipment->setParameter('toAddr2', $buyer['toAddr2']);
		$shipment->setParameter('toCity', $buyer['toCity']);
		$shipment->setParameter('toState', $buyer['toState']);
		$shipment->setParameter('toCode', $buyer['toCode']);
		if ($buyer['toCountry'] != "US")		// country should be in ISO code. If this is international shipment.
			$shipment->setParameter('toCountry', $buyer['toCountry']);		
		// $shipment->setParameter('referenceValue', '123adsf'); // may be we need this in the future.

		$rate = new \RocketShipIt\Rate('STAMPS', array('config' => $config));

		$rate->setParameter('toAddr1', $buyer['toAddr1']);
		$rate->setParameter('toAddr2', $buyer['toAddr2']);
		$rate->setParameter('toCity', $buyer['toCity']);
		$rate->setParameter('toState', $buyer['toState']);
		$rate->setParameter('toCode', $buyer['toCode']);
		if ($buyer['toCountry'] != "US")		// country should be in ISO code. If this is international shipment.
			$rate->setParameter('toCountry', $buyer['toCountry']);
		
		if ($buyer['toCountry'] != "US") { // country should be in ISO code. If this is international shipment.
			# customs
			$shipment->setParameter('customsContentType', 'Merchandise');
			# customs lines
			$custLines = new \RocketShipIt\Customs('STAMPS');
			$custLines->setParameter('customsDescription', 'Merchandise item(s).');
			$custLines->setParameter('customsQuantity', '1');
			$custLines->setParameter('customsWeight', $packageParam['weight']);
			$custLines->setParameter('customsValue', '0.00');
			$custLines->setParameter('customsHsTariff', '');
			$custLines->setParameter('customsOriginCountry', 'US');

			$shipment->addCustomsLineToShipment($custLines);

			$rate->setParameter('customsValue', '0.00');
			$rate->setParameter('toCountry', $buyer['toCountry']);

			$shipment->setParameter('toPhone', $buyer['toPhone']);
		} else {	// if only going to US it needs toCode.
			$rate->setParameter('toCode', $buyer['toCode']);
		}

		$rate->setParameter('weight', $packageParam['weight']);

		if (isset($packageParam['length']) && isset($packageParam['width']) && isset($packageParam['height'])) {
			$rate->setParameter('length', $packageParam['length']);
			$rate->setParameter('width', $packageParam['width']);
			$rate->setParameter('height', $packageParam['height']);
		}

		if (isset($addOnsParam['insuredValue'])) {
			$rate->setParameter('insuredCurrency', 'USD');
			$rate->setParameter('insuredValue', $addOnsParam['insuredValue']);
		}

		$rate->setParameter('shipDate', $packageParam['shipDate']);	// Y-m-d format

		$response = $rate->getAllRates();
		file_put_contents('c:\tmp\getAllRates.txt', print_r($response, true));
		
		$rates = $response->Rates;
		$rate = $rates->Rate;

		# Select the rate/service you want
		# from a list of all available
		$package = $rate[$packageParam['shippingMethod']];

		// we can only purchase postage in production
		if (ENVIRONMENT == 'production') {
			$myAccountInfo = $this->getAccountInfo();
			if (method_exists($myAccountInfo, 'AccountInfo')) {
				$myAvailablePostage = $myAccountInfo->AccountInfo->PostageBalance->AvailablePostage;
				if ($myAvailablePostage <= $package->Amount)
					$purchasePostageResponse = $this->purchasePostage($package->Amount);
			} else {
				return $myAccountInfo->getMessage();
			}
		}

		# Remove all addons
		$package->AddOns = null;

		/* Add the addons you want for this shipment. */
		$addons = array();
		if (isset($addOnsParam['insuredValue'])) {
			$a = new \stdClass();
			$a->AddOnType = 'SC-A-INS';	// Stamps.com insurance add-on. Similar to USPS only lower cost and less paperwork.
			array_push($addons, $a);
		}
		if (isset($addOnsParam['signatureConfirmation'])) {
			$a = new \stdClass();
			$a->AddOnType = 'US-A-SC';	// Include Signature Confirmation service.
			array_push($addons, $a);
		}

		$package->AddOns = $addons;

		if ($buyer['toCountry'] == "US") { // country should be in ISO code. If this is international shipment.
			// The rate can suggest a new zipcode
			// Set this new zipcode on the shipment to avoid:
			// "Rate ToZIPCode and Destination Address ZIPCode field must match."
			$shipment->setParameter('toCode', $package->ToZIPCode);
		}		

		$shipment->addPackageToShipment($package);

		$response = $shipment->submitShipment();
		file_put_contents('c:\tmp\submitShipment.txt', print_r($response, true));
		file_put_contents('c:\tmp\shipmentDebug.txt', print_r($shipment->debug(), true));

		$response['shipDate'] = $packageParam['shipDate'];

		// Save label as a pdf
		if (isset($response['pkgs'])) {
			// $shipment->toFile($response['pkgs'][0]['label_img'], 'c:\tmp\label_img.pdf');

			$this->load->model('Shipping_model');
			$this->Shipping_model->saveTrackingDetails($orderNumber, $response);
		}

		return $response;
	}

	private function prepareCalculatingShipmentRatesForConfirmShipment(array $data) {
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

		$shopOwner['shipper'] = $data['shopInfo']['shop_name'];
		$shopOwner['shipContact'] = $data['shopInfo']['shop_name'];
		$shopOwner['shipPhone'] = $data['shopInfo']['user_phone'];

		if ($data['shopInfo']['preferredAddress'] == 1) {
			$shopOwner['shipAddr1'] = $data['shopInfo']['user_address'];
			$shopOwner['shipAddr2'] = $data['shopInfo']['addrLine2Of1'];
			$shopOwner['shipCity'] = $data['shopInfo']['user_city'];
			$shopOwner['shipState'] = $data['shopInfo']['user_state'];
			$shopOwner['shipCode'] = $data['shopInfo']['user_zip'];
		} elseif ($data['shopInfo']['preferredAddress'] == 2) {
			$shopOwner['shipAddr1'] = $data['shopInfo']['user_address2'];
			$shopOwner['shipAddr2'] = $data['shopInfo']['addrLine2Of2'];
			$shopOwner['shipCity'] = $data['shopInfo']['user_city2'];
			$shopOwner['shipState'] = $data['shopInfo']['user_state2'];
			$shopOwner['shipCode'] = $data['shopInfo']['user_zip2'];
		}


		/* data for the buyer */
		$buyer['name'] = $data['orderDetails'][0]['user_first_name'] . ' ' . $data['orderDetails'][0]['user_last_name'];
		$buyer['display_name'] = $data['orderDetails'][0]['display_name'];
		$buyer['toPhone'] = $data['orderDetails'][0]['user_phone'];

		$this->load->helper("myhelp");
		if ($data['orderDetails'][0]['preferredAddress'] == 1) {
			$buyer['toAddr1'] = $data['orderDetails'][0]['user_address'];
			$buyer['toAddr2'] = $data['orderDetails'][0]['addrLine2Of1'];
			$buyer['toCity'] = $data['orderDetails'][0]['user_city'];
			$buyer['toState'] = $data['orderDetails'][0]['user_state'];
			$buyer['toCode'] = $data['orderDetails'][0]['user_zip'];
			$buyer['toCountry'] = getCountryISOCodeByCountryName($data['orderDetails'][0]['user_country']);
		} elseif ($data['orderDetails'][0]['preferredAddress'] == 2) {
			$buyer['toAddr1'] = $data['orderDetails'][0]['user_address2'];
			$buyer['toAddr2'] = $data['orderDetails'][0]['addrLine2Of2'];
			$buyer['toCity'] = $data['orderDetails'][0]['user_city2'];
			$buyer['toState'] = $data['orderDetails'][0]['user_state2'];
			$buyer['toCode'] = $data['orderDetails'][0]['user_zip2'];
			$buyer['toCountry'] = getCountryISOCodeByCountryName($data['orderDetails'][0]['user_country2']);
		} else {	// unknown address
			return array('error' => 'Invalid buyer preferred address.');
		}

		$packageParam = [];
		$packageParam['weight'] = $data['weight'];
		$packageParam['length'] = $data['length'];
		$packageParam['width'] = $data['width'];
		$packageParam['height'] = $data['height'];

		$packageParam['shippingMethod'] = $data['shippingMethod'];

		$addOnsParam = [];
		if($data['insuredValue'] > 0)
			$addOnsParam['insuredValue'] = $data['insuredValue'];
		if(isset($data['signatureConfirmation']))
			$addOnsParam['signatureConfirmation'] = $data['signatureConfirmation'];

		$packageParam['shipDate'] = $data['shipDate'];

		if ($buyer['toCountry'] == 'US')
			if (!$this->validateRecipientAddress($buyer)->AddressMatch)
				return array('error' => 'Invalid buyer address. USPS cannot verify the US address.');
		
		return $this->confirmShipment($data['orderNumber'], $shopOwner, $buyer, $packageParam, $addOnsParam);
	}

	/*	Description - Call by confirm and buy button in the shipping page through AJAX.
		POST @params			
	*/
	public function confirmAndBuy() {
		$this->output->set_content_type('application/json');
		$this->load->helper('number');

		$shippingMethod = $this->input->post("shippingMethod");
		$orderNumber = $this->input->post("orderNumber");
		$width = $this->input->post("width");
		$length = $this->input->post("length");
		$height = $this->input->post("height");
		$lbs = $this->input->post("lbs");
		$oz = $this->input->post("oz");
		$insuredValue = $this->input->post("insuredValue");
		$shipDate = $this->input->post("shippingDate");
		$signatureConfirmation = $this->input->post("signature");

		// Let's process each of them.

		$data['orderNumber'] = $orderNumber;

		if (!isNumericAndPositive($lbs)) {
			$response['error'] = 'Invalid pounds value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		}

		($oz == "" ? $oz = 0 : "");

		if (!isNumericAndPositive($oz)) {
			$response['error'] = 'Invalid onze value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		} else {
			$ozToPounds = $oz * 0.0625;	// 1 oz = 0.0625 pounds
			$data['weight'] = $ozToPounds + $lbs;
		}		

		if (!isNumericAndPositive($width)) {
			$response['error'] = 'Invalid width value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		} else 
			$data['width'] = $width;
		
		if (!isNumericAndPositive($length)) {
			$response['error'] = 'Invalid length value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		} else 
			$data['length'] = $length;

		if (!isNumericAndPositive($height)) {
			$response['error'] = 'Invalid height value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		} else
			$data['height'] = $height;

		($insuredValue == "" ? $insuredValue = 0 : "");
		if (!isNumericAndPositive($insuredValue)) {
			$response['error'] = 'Invalid insurance value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		} else
			$data['insuredValue'] = $insuredValue;

		// ship date
		if (empty($shipDate)) {
			$responseData['error'] = 'Ship date is missing.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		} else {
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

			$data['shipDate'] = $shipDate_string;
		}

		if ($signatureConfirmation)
			$data['signatureConfirmation'] = $signatureConfirmation;	
		

		$this->load->model('order_model');
		$orderDetails = $this->order_model->getOrderDetailsByOrderNumber($data['orderNumber']);
		$data['orderDetails'] = $orderDetails;

		$this->load->model('user_model');
		$data['shopInfo'] = $this->user_model->getShopInfo($orderDetails[0]['shopid']);

		$data['orderStatus'] = $orderDetails[0]['order_status'];

		$shippingMethod = $this->input->post('shippingMethod');
		$shippingMethod = strstr($shippingMethod, ',', true);
		if (!isNumericAndPositive($shippingMethod)) {
			$responseData['error'] = 'Invalid shipping method.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		} else
			$data['shippingMethod'] = $shippingMethod;

		if ($data['orderStatus'] == "Pending") {
			$preparecalculateResponse = $this->prepareCalculatingShipmentRatesForConfirmShipment($data);

			if (isset($preparecalculateResponse['error']))
				$jsonResponse['meta'] = ['statusCode' => 202];
			else
				$jsonResponse['meta'] = ['statusCode' => 200];

			$jsonResponse['data'] = $preparecalculateResponse;
		}
		
		$jsonResponse['orderNumber'] = $data['orderNumber'];
		$jsonResponse['orderStatus'] = $data['orderStatus'];
		
		$this->output->set_output(json_encode($jsonResponse));
	}

	/* 	Description - We always assume data being passed are all been sanitized already.
		@param $shopOwner - the shipper
		@param $buyer - the recipient
		@param $options - optional if there are other service you shipper wants to add
		@return  - returns response from RocketShipIt
	*/
	private function calculateShippingRates(array $shopOwner, array $buyer, array $packageParam, array $addOnsParam) {
		// file_put_contents('c:\tmp\packageParam.txt', print_r($packageParam, true)); return;
		$config = new \RocketShipIt\Config;
		$config->setDefault('generic', 'shipper', $shopOwner['shipper']);
		$config->setDefault('generic', 'fromName', $shopOwner['shipper']);
		$config->setDefault('generic', 'shipContact', $shopOwner['shipContact']);
		$config->setDefault('generic', 'shipPhone', $shopOwner['shipPhone']);
		$config->setDefault('generic', 'shipAddr1', $shopOwner['shipAddr1']);
		$config->setDefault('generic', 'shipAddr2', $shopOwner['shipAddr2']);
		$config->setDefault('generic', 'shipCity', $shopOwner['shipCity']);
		$config->setDefault('generic', 'shipState', $shopOwner['shipState']);
		$config->setDefault('generic', 'shipCode', $shopOwner['shipCode']);

		$shipment = new \RocketShipIt\Shipment('STAMPS', array('config' => $config));
		$shipment->setParameter('toName', $buyer['name']);
		$shipment->setParameter('toAddr1', $buyer['toAddr1']);
		$shipment->setParameter('toAddr2', $buyer['toAddr2']);
		$shipment->setParameter('toCity', $buyer['toCity']);
		$shipment->setParameter('toState', $buyer['toState']);
		$shipment->setParameter('toCode', $buyer['toCode']);
		if ($buyer['toCountry'] != "US")		// country should be in ISO code. If this is international shipment.
			$shipment->setParameter('toCountry', $buyer['toCountry']);		
		// $shipment->setParameter('referenceValue', '123adsf'); // may be we need this in the future.

		$rate = new \RocketShipIt\Rate('STAMPS', array('config' => $config));

		$rate->setParameter('toAddr1', $buyer['toAddr1']);
		$rate->setParameter('toAddr2', $buyer['toAddr2']);
		$rate->setParameter('toCity', $buyer['toCity']);
		$rate->setParameter('toState', $buyer['toState']);
		$rate->setParameter('toCode', $buyer['toCode']);
		if ($buyer['toCountry'] != "US")		// country should be in ISO code. If this is international shipment.
			$rate->setParameter('toCountry', $buyer['toCountry']);
		
		if ($buyer['toCountry'] != "US") { // country should be in ISO code. If this is international shipment.
			# customs
			$shipment->setParameter('customsContentType', 'Merchandise');
			# customs lines
			$custLines = new \RocketShipIt\Customs('STAMPS');
			$custLines->setParameter('customsDescription', 'Merchandise item(s).');
			$custLines->setParameter('customsQuantity', '1');
			$custLines->setParameter('customsWeight', $packageParam['weight']);
			$custLines->setParameter('customsValue', '0.00');
			$custLines->setParameter('customsHsTariff', '');
			$custLines->setParameter('customsOriginCountry', 'US');

			$shipment->addCustomsLineToShipment($custLines);

			$rate->setParameter('customsValue', '0.00');
			$rate->setParameter('toCountry', $buyer['toCountry']);

			$shipment->setParameter('toPhone', $buyer['toPhone']);
		} else {	// if only going to US it needs toCode.
			$rate->setParameter('toCode', $buyer['toCode']);
		}

		$rate->setParameter('weight', $packageParam['weight']);

		if (isset($packageParam['length']) && isset($packageParam['width']) && isset($packageParam['height'])) {
			$rate->setParameter('length', $packageParam['length']);
			$rate->setParameter('width', $packageParam['width']);
			$rate->setParameter('height', $packageParam['height']);
		}

		if (isset($addOnsParam['insuredValue'])) {
			$rate->setParameter('insuredCurrency', 'USD');
			$rate->setParameter('insuredValue', $addOnsParam['insuredValue']);
		}

		if (isset($packageParam['shipDate']))	//Y-m-d format
			$rate->setParameter('shipDate', $packageParam['shipDate']);		

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
		$av->setParameter('toState', $recipient['toState']);
		$av->setParameter('toCity', $recipient['toCity']);
		$av->setParameter('toAddr1', $recipient['toAddr1']);
		$av->setParameter('toCode', $recipient['toCode']);
		return $av->validate();
	}


	/* 	Description - call by $this->reciept(). This sanitizes all input into $this->calculateShippingRates().
		@param $data - includes shopInfo index for the shop owner's info
			$data['orderDetails'] - for the order details
	
		@return  - calculated rates passed to calculateShippingRates();
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

		$shopOwner['shipper'] = $data['shopInfo']['shop_name'];
		$shopOwner['shipContact'] = $data['shopInfo']['shop_name'];
		$shopOwner['shipPhone'] = $data['shopInfo']['user_phone'];

		if ($data['shopInfo']['preferredAddress'] == 1) {
			$shopOwner['shipAddr1'] = $data['shopInfo']['user_address'];
			$shopOwner['shipAddr2'] = $data['shopInfo']['addrLine2Of1'];
			$shopOwner['shipCity'] = $data['shopInfo']['user_city'];
			$shopOwner['shipState'] = $data['shopInfo']['user_state'];
			$shopOwner['shipCode'] = $data['shopInfo']['user_zip'];
		} elseif ($data['shopInfo']['preferredAddress'] == 2) {
			$shopOwner['shipAddr1'] = $data['shopInfo']['user_address2'];
			$shopOwner['shipAddr2'] = $data['shopInfo']['addrLine2Of2'];
			$shopOwner['shipCity'] = $data['shopInfo']['user_city2'];
			$shopOwner['shipState'] = $data['shopInfo']['user_state2'];
			$shopOwner['shipCode'] = $data['shopInfo']['user_zip2'];
		}


		/* data for the buyer */
		$buyer['name'] = $data['orderDetails'][0]['user_first_name'] . ' ' . $data['orderDetails'][0]['user_last_name'];
		$buyer['display_name'] = $data['orderDetails'][0]['display_name'];
		$buyer['toPhone'] = $data['orderDetails'][0]['user_phone'];

		$this->load->helper("myhelp");
		if ($data['orderDetails'][0]['preferredAddress'] == 1) {
			$buyer['toAddr1'] = $data['orderDetails'][0]['user_address'];
			$buyer['toAddr2'] = $data['orderDetails'][0]['addrLine2Of1'];
			$buyer['toCity'] = $data['orderDetails'][0]['user_city'];
			$buyer['toState'] = $data['orderDetails'][0]['user_state'];
			$buyer['toCode'] = $data['orderDetails'][0]['user_zip'];
			$buyer['toCountry'] = getCountryISOCodeByCountryName($data['orderDetails'][0]['user_country']);
		} elseif ($data['orderDetails'][0]['preferredAddress'] == 2) {
			$buyer['toAddr1'] = $data['orderDetails'][0]['user_address2'];
			$buyer['toAddr2'] = $data['orderDetails'][0]['addrLine2Of2'];
			$buyer['toCity'] = $data['orderDetails'][0]['user_city2'];
			$buyer['toState'] = $data['orderDetails'][0]['user_state2'];
			$buyer['toCode'] = $data['orderDetails'][0]['user_zip2'];
			$buyer['toCountry'] = getCountryISOCodeByCountryName($data['orderDetails'][0]['user_country2']);
		} else {	// unknown address
			return array('error' => 'Invalid buyer preferred address.');
		}

		$packageParam = [];
		if (isset($data['weight']))
			$packageParam['weight'] = $data['weight'];
		else
			$packageParam['weight'] = 5;

		if (isset($data['length']) && isset($data['width']) && isset($data['height'])) {
			$packageParam['length'] = $data['length'];
			$packageParam['width'] = $data['width'];
			$packageParam['height'] = $data['height'];
		}

		$addOnsParam = [];
		if(isset($data['insuredValue']))
			$addOnsParam['insuredValue'] = $data['insuredValue'];
		if(isset($data['signatureConfirmation']))
			$addOnsParam['signature'] = $data['signatureConfirmation'];

		if(isset($data['shipDate']))
			$packageParam['shipDate'] = $data['shipDate'];		

		if ($buyer['toCountry'] == 'US')
			if (!$this->validateRecipientAddress($buyer)->AddressMatch)
				return array('error' => 'Invalid buyer address. USPS cannot verify the US address.');
		
		return $this->calculateShippingRates($shopOwner, $buyer, $packageParam, $addOnsParam);
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
	public function shippingRates() {
		$this->output->set_content_type('application/json');
		$this->load->helper('number');

		$orderNumber = $this->input->get("orderNumber");
		$width = $this->input->get("width");
		$length = $this->input->get("length");
		$height = $this->input->get("height");
		$lbs = $this->input->get("lbs");
		$oz = $this->input->get("oz");
		$insuredValue = $this->input->get("insuredValue");
		$shipDate = $this->input->get("shippingDate");
		$signatureConfirmation = $this->input->get("signature");

		// Let's process each of them.

		$data['orderNumber'] = $orderNumber;

		if (!isNumericAndPositive($lbs)) {
			$response['error'] = 'Invalid pounds value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		}

		($oz == "" ? $oz = 0 : "");

		if (!isNumericAndPositive($oz)) {
			$response['error'] = 'Invalid onze value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		} else {
			$ozToPounds = $oz * 0.0625;	// 1 oz = 0.0625 pounds
			$data['weight'] = $ozToPounds + $lbs;
		}		

		if (!isNumericAndPositive($width)) {
			$response['error'] = 'Invalid width value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		} else 
			$data['width'] = $width;
		
		if (!isNumericAndPositive($length)) {
			$response['error'] = 'Invalid length value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		} else 
			$data['length'] = $length;

		if (!isNumericAndPositive($height)) {
			$response['error'] = 'Invalid height value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		} else
			$data['height'] = $height;

		($insuredValue == "" ? $insuredValue = 0 : "");
		if (!isNumericAndPositive($insuredValue)) {
			$response['error'] = 'Invalid insurance value.';
			$data['meta'] = ['statusCode' => 202, 'data' => $response];
			$this->output->set_output(json_encode($data));
			return;
		} else {
			if ($insuredValue != 0)
				$data['insuredValue'] = $insuredValue;
		}

		// ship date
		if (empty($shipDate)) {
			$responseData['error'] = 'Ship date is missing.';
			$response = ['meta' => ['statusCode' => 202], 'data' => $responseData];
			$this->output->set_output(json_encode($response));
			return;
		} else {
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

			$data['shipDate'] = $shipDate_string;
		}

		if ($signatureConfirmation)
			$data['signatureConfirmation'] = $signatureConfirmation;
		

		$this->load->model('order_model');
		$orderDetails = $this->order_model->getOrderDetailsByOrderNumber($data['orderNumber']);
		$data['orderDetails'] = $orderDetails;

		$this->load->model('user_model');
		$data['shopInfo'] = $this->user_model->getShopInfo($orderDetails[0]['shopid']);

		$data['orderStatus'] = $orderDetails[0]['order_status'];

		$jsonResponse['data'] = [];

		if ($data['orderStatus'] == "Pending") {
			$preparecalculateResponse = $this->prepareCalculatingShipmentRates($data);

			if (isset($preparecalculateResponse['error']))
				$jsonResponse['meta'] = ['statusCode' => 202];
			else
				$jsonResponse['meta'] = ['statusCode' => 200];

			$jsonResponse['data'] = $preparecalculateResponse;
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
