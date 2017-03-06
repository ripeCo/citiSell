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
		/*$this->output
			->set_content_type('application/json')
			->set_output(json_encode(["fName" => "Jhunexjun", "lName" => "Morcilla"]));*/
	}


	/* 	@param $shopOwner - the shipper
			@param $buyer - the recipient
			@param $shipment - shipment information like packaging type.
			@param $options - optional if there are other service you shipper wants to add like add-ons
			@return  - returns response from RocketShipIt
	*/
	private function confirmShipment(array $shopOwner, array $buyer, array $shipment, array $options=null) {
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
			return [];
		}

		$config->setDefault('generic', 'shipAddr1', $shipAddr1);
		$config->setDefault('generic', 'shipAddr2', $shipAddr2);
		$config->setDefault('generic', 'shipCity', $shipCity);
		$config->setDefault('generic', 'shipState', $shipState);
		$config->setDefault('generic', 'shipCode', $shipCode);
		$config->setDefault('generic', 'shipCountry', $shipCountry);


		/* After the shipper configuration, shipment. */
		/* Note: We need Stamps.com for international shipping. */

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
			return [];
		}
		
		$shipment = new \RocketShipIt\Shipment('USPS');
		$shipment->setParameter('toName', $toName);
		$shipment->setParameter('toCompany', $toCompany);
		$shipment->setParameter('toPhone', $toPhone);
		$shipment->setParameter('toAddr1', $toAddr1);
		$shipment->setParameter('toCity', $toCity);
		$shipment->setParameter('toState', $toState);
		$shipment->setParameter('toCode', $toCode);
		$shipment->setParameter('packagingType', $shipment['packagingType']);

		$shipment->setParameter('weight', $shipment['weight']);

		$response = $shipment->submitShipment();

		// Save label as a pdf
		$shipment->toFile($response['pkgs'][0]['label_img'], 'c:\tmp\shipping_label.pdf');

		return $response;
	}


	/*	POST @params
			
	*/
	public function confirmAndBuy() {
		$data['orderNumber'] = $this->input->post('orderNumber');

		// end here...

		$this->load->model('order_model');
		$orderDetails = $this->order_model->getOrderDetailsByOrderNumber($orderNumber);
		$data['orderDetails'] = $orderDetails;

		$this->load->model('user_model');
		$data['shopInfo'] = $this->user_model->getShopInfo($orderDetails[0]['shopid']);

		// $data['shippingRates'] = $this->prepareCalculatingShipment($data);

		$data['packagingTypes'] = $this->packagingTypes;

		// file_put_contents('/tmp/packagingTypes.txt', print_r($data['packagingTypes'], TRUE));

		$this->load->view('shipping/shipping_label', $data);
	}


	/* 	@param $shopOwner - the shipper
		@param $buyer - the recipient
		@param $options - optional if there are other service you shipper wants to add
		@return  - returns response from RocketShipIt
	*/
	private function calculateShippingRate(array $shopOwner, array $buyer, $options = null) {
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
			return [];
		}

		$config->setDefault('generic', 'shipAddr1', $shipAddr1);
		$config->setDefault('generic', 'shipAddr2', $shipAddr2);
		$config->setDefault('generic', 'shipCity', $shipCity);
		$config->setDefault('generic', 'shipState', $shipState);
		$config->setDefault('generic', 'shipCode', $shipCode);
		$config->setDefault('generic', 'shipCountry', $shipCountry);
		

		/* Get recipient info for the rates. */

		$rate = new \RocketShipIt\Rate('USPS', array('config' => $config));
		$rate->setParameter('service', 'PRIORITY');	// this can be set in the config level.

		$package = new \RocketShipIt\Package('USPS');

		if ($buyer['preferredAddress'] == 1) {
			$toCountry = getCountryISOCodeByCountryName(trim($buyer['user_country']));

			if ($toCountry == "US") {
				$rate->setParameter('toCode', $buyer['user_zip']);
			} else {
				$rate->setParameter('toCountry', $toCountry);
				$package->setparameter('container', 'RECTANGULAR');
			}
		} elseif ($buyer['preferredAddress'] == 2) {
			$toCountry = getCountryISOCodeByCountryName(trim($buyer['user_country2']));

			if ($toCountry == "US") {
				$rate->setParameter('toCode', $buyer['user_zip2']);
			} else {
				$rate->setParameter('toCountry', $toCountry);
				$package->setparameter('container', 'RECTANGULAR');
			}
		} else {	// unknown address
			return [];
		}

		$package->setParameter('weight', '5');	// I don't know why this is needed on calculating rates but RocketShipIt needs it.

		// Optionally you can set dimensions
		/*$package->setParameter('length', '1');
		$package->setParameter('width', '2');
		$package->setParameter('height', '3');*/
		$rate->addPackageToShipment($package);

		return $rate->getSimpleRates();
		
		/////////////////////////
		/*
			$shipment = new \RocketShipIt\Shipment('USPS');
			$shipment->setParameter('toName', $toName);
			$shipment->setParameter('toCompany', $toName);
			$shipment->setParameter('toPhone', $toPhone);
			$shipment->setParameter('toCountry', $toCountry);
			if ($toCountry == "US") {	//converted into ISO
				$shipment->setParameter('toAddr1', $toAddrLine1);
				$shipment->setParameter('toCity', $toCity);
				$shipment->setParameter('toState', $toState);
				$shipment->setParameter('toCode', $toCode);
			}

			// $shipment->setParameter('packagingType','PADDED FLAT RATE ENVELOPE');
			$shipment->setParameter('packagingType','VARIABLE');
			$shipment->setParameter('weight', $weight);
			$shipment->setParameter('length', $length);
			$shipment->setParameter('width', $width);
			$shipment->setParameter('height', $height);
			$response = $shipment->submitShipment();

			if (isset($response['trk_main']))
				$shipment->toFile($response['pkgs'][0]['label_img'], 'c:\\tmp\\label_img1.pdf');

			file_put_contents("c:\\tmp\\calculated_shipping.txt", print_r($response, TRUE));
			return $response;
		*/
	}


	/* 	@param $data - includes shopInfo index for the shop owner's info
	*		$data['orderDetails'] - for the order details
	*
	*	@return  - calculated rates passed to calculateShippinhRate();
	*/
	private function prepareCalculatingShipment(array $data) {
		$this->load->helper('address');

		if (!addressIsValid($data['shopInfo']))
			return [];
		if (!addressIsValid($data['orderDetails'][0]))
			return [];

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

		// we cannot calculate rate if shop owner's address is not from US.
		if (trim($shopOwner['user_country']) != "USA")
			return [];
		else
			return $this->calculateShippingRate($shopOwner, $buyer);
	}
	
	public function reciept($orderNumber) {
		$data['orderNumber'] = $orderNumber;

		$this->load->model('order_model');
		$orderDetails = $this->order_model->getOrderDetailsByOrderNumber($orderNumber);
		$data['orderDetails'] = $orderDetails;

		$this->load->model('user_model');
		$data['shopInfo'] = $this->user_model->getShopInfo($orderDetails[0]['shopid']);

		$data['shippingRates'] = $this->prepareCalculatingShipment($data);

		foreach ($orderDetails as $row)
			$data['images'][] = $row['productImage'];

		$data['packagingTypes'] = $this->packagingTypes;

		// file_put_contents('/tmp/packagingTypes.txt', print_r($data['packagingTypes'], TRUE));

		$this->load->view('shipping/shipping_label', $data);
	}
	
	function purchasedlbl()
	{
		$this->load->view('shipping/purchased_label');
	}
	
	function refundedlbl()
	{
		$this->load->view('shipping/refunded_label');
	}
	
	function optionlbl()
	{
		$this->load->view('shipping/options');
	}
}
