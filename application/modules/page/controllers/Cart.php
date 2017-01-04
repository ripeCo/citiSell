<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('paypal_lib');
		$this->load->model('cart_model');
		$this->load->model('page_model');
		$this->load->model('User_model');
		$this->load->model('Yourshop_model');
		require_once APPPATH . 'third_party/RocketShipIt/autoload.php';
	}
	
	
	public function index()
	{	
		
		if (!$this->cart->contents()){
			$data['message'] = '<p class="bg-success" id="msg"><i class="fa fa-times-circle"></i> Your cart is empty!</p>';
		}else{
			$data['message'] = $this->session->flashdata('message');
		}
		
		$data['last2items'] 		= $this->page_model->getlastnumberofproducts(2);
		$data['last4items'] 		= $this->page_model->getlastnumberofrandomproducts(8);
		$data['last5items'] 		= $this->page_model->getlastnumberofrandomproducts(5);
		
		//echo $this->page_model->totalrecommaddeduiprecords();
		
		if($this->page_model->totalrecommaddeduiprecords($_SERVER['REMOTE_ADDR']) >0){
			
			$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproductsbyUserip($_SERVER['REMOTE_ADDR'],20);
			
		}else{
			$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproducts(20);
		}

		$data['breadcrumb'] = sitename().' - Shopping Cart';
		
		$this->load->view('page/cart', $data);
	}
	
	
	
	
	public function removeownitems()
	{	
		
		$data['last2items'] 		= $this->page_model->getlastnumberofproducts(2);
		$data['last4items'] 		= $this->page_model->getlastnumberofrandomproducts(8);
		$data['last5items'] 		= $this->page_model->getlastnumberofrandomproducts(5);
		
		//echo $this->page_model->totalrecommaddeduiprecords();
		
		if($this->page_model->totalrecommaddeduiprecords($_SERVER['REMOTE_ADDR']) >0){
			
			$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproductsbyUserip($_SERVER['REMOTE_ADDR'],20);
			
		}else{
			$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproducts(20);
		}

		$data['message'] = '<p class="bg-danger" id="msg0"><i class="fa fa-times-circle"></i> Your own shop item available in your cart. Please delete all items for place order!</p>';
		$data['breadcrumb'] = sitename().' - Shopping Cart';
		
		$this->load->view('page/cart', $data);
	}
	
	
	
	
	
	// ctSell checkout page function
	public function checkout() 
	{
		/*$pid 			= $this->uri->segment(4);
		$data['pdetails'] 	= $this->page_model->getproductdetails($pid);
		$this->page_model->recommendedproductsave($pid); // Insert user recommended products
		*/
		if(isset($_POST['cart']) && isset($_POST['updatecart'])){
			$this->update_cart();
		}else{
			$data['breadcrumb'] = sitename().' :: Checkout';
			$this->load->view('page/checkout',$data);
		}
	}
	
	
	private function calculateShipping($userId, $shopId, $chosenAddress = 1) {
		/* Get recipient info for the rates. */
		$buyer = $this->User_model->get_data($userId);
		/* Get Shop owner. */
		// $shopInfo = $this->Yourshop_model->getshopdata($this->input->post('shopid'));
		$shopInfo = $this->Yourshop_model->getshopdata($shopId);
		$shopOwnerInfo = $this->Yourshop_model->get_data($shopInfo['userid']);

		$shopOwnerName = $shopOwnerInfo['user_first_name'] . ' ' . $shopOwnerInfo['user_last_name'];

		$config = new \RocketShipIt\Config;
		$config->setDefault('generic', 'shipper', $shopInfo['shop_name']);
		$config->setDefault('generic', 'shipContact', $shopOwnerName);
		$shipAddr1 = $shopOwnerInfo['user_address'];
		$config->setDefault('generic', 'shipAddr1', $shipAddr1);
		$config->setDefault('generic', 'shipCity', $shopOwnerInfo['user_city']);
		$config->setDefault('generic', 'shipState', $shopOwnerInfo['user_state']);
		$config->setDefault('generic', 'shipCountry', getCountryISOCodeByCountryName($shopOwnerInfo['user_country']));
		$config->setDefault('generic', 'shipCode', $shopOwnerInfo['user_zip']);

		$rate = new \RocketShipIt\Rate('USPS', array('config' => $config));
		$toName = $buyer['user_first_name'] . ' ' . $buyer['user_last_name'];
		$rate->setParameter('toName', $toName);
		if ($buyer['user_country'] == 'USA' or $buyer['user_country'] == 'United States')
			$rate->setParameter('toCode', $buyer['user_zip']);

		if ($chosenAddress == 1)
			$userCountry = getCountryISOCodeByCountryName($buyer['user_country']);
		else
			$userCountry = getCountryISOCodeByCountryName($buyer['user_country2']);

		$rate->setParameter('toCountry', $userCountry);

		// For testing purposes, values are fixed.
		// lbl should be mandatory and extracted from db but it's nullable and sometimes no value for a certain product like product id 26
		$shippingDetails	= $this->Yourshop_model->getShippingDetails($this->input->post('id'));
		if (empty($shippingDetails['lbs']));
			$shippingDetails['lbs'] = '5';	// those should be variable but default for now.
		if (empty($shippingDetails['length']))
			$shippingDetails['length'] = '5';
		if (empty($shippingDetails['width']))
			$shippingDetails['width'] = '5';
		if (empty($shippingDetails['height']))
			$shippingDetails['height'] = '5';

		$package = new \RocketShipIt\Package('usps');
		$package->setparameter('weight', $shippingDetails['lbs']);

		/* From https://docs.rocketship.it/php/1-0/rate-parameters.html#usps, length, wid height units are inches.
		Required when service contains one of the PRIORITY variants and Size is LARGE */

		$package->setparameter('length', $shippingDetails['length']);
		$package->setparameter('width', $shippingDetails['width']);
		$package->setparameter('height', $shippingDetails['height']);
		$package->setparameter('container', 'VARIABLE');
		$rate->addPackageToShipment($package);
		$response = $rate->getSimpleRates();


		
		// Note: We do not use RocketShipIt for USPS with Stamps.com so we do not have postage. We just calculated it throught \RocketShipIt\Rate() level.

		$shipment = new \RocketShipIt\Shipment('USPS', array('config' => $config));
		$shipment->setParameter('toName', $toName);
		$shipment->setParameter('toPhone', ($buyer['user_phone']) ?: '');

		if ($chosenAddress == 1) {
			$toAddr1 = $buyer['user_address'];
			$toCity = $buyer['user_city'];
			$toState = $buyer['user_state'];
			$toCode = $buyer['user_zip'];
			$toCountry = $buyer['user_country'];
		} else {
			$toAddr1 = $buyer['user_address2'];
			$toCity = $buyer['user_city2'];
			$toState = $buyer['user_state2'];
			$toCode = $buyer['user_zip2'];
			$toCountry = $buyer['user_country2'];
		}		

		$shipment->setParameter('toAddr1', $toAddr1);
		$shipment->setParameter('toCity', $toCity);
		$shipment->setParameter('toState', $toState);
		$shipment->setParameter('toCode', $toCode);
		$shipment->setParameter('toCountry', $toCountry);

		// $shipment->setParameter('packagingType','PADDED FLAT RATE ENVELOPE');
		$shipment->setParameter('packagingType','VARIABLE');
		$shipment->setParameter('weight',$shippingDetails['lbs']);
		$response = $shipment->submitShipment();

		if (isset($response['trk_main']))
			$shipment->toFile($response['pkgs'][0]['label_img'], 'c:\\tmp\\label_img1.pdf');

		file_put_contents("c:\\tmp\\calculated_shipping.txt", print_r($response, TRUE));
		return $response;
	}

	private function calculateShipping2($userId, $shopId, $chosenAddress = 1) {
		/* Get recipient info for the rates. */
		$buyer = $this->User_model->get_data($userId);
		$toName = $buyer['user_first_name'] . ' ' . $buyer['user_last_name'];
		$toPhone = $buyer['user_phone'];
		// $countryName = $buyer['user_country'];
		$countryName = 'Mexico';
		$toCountry = getCountryISOCodeByCountryName($countryName);
		if ($chosenAddress == 1 && $toCountry == "US") {
			$toAddrLine1 = $buyer['user_address'];
			$toCity = $buyer['user_city'];
			$toState = $buyer['user_state'];
			$toCode = $buyer['user_zip'];
		} elseif ($chosenAddress == 2 && $toCountry == "US") {
			$toAddrLine1 = $buyer['user_address2'];
			$toCity = $buyer['user_city2'];
			$toState = $buyer['user_state2'];
			$toCode = $buyer['user_zip2'];
		}
		/* Get Shop owner. */
		// $shopInfo = $this->Yourshop_model->getshopdata($this->input->post('shopid'));
		$shopInfo = $this->Yourshop_model->getshopdata($shopId);
		$shopOwnerInfo = $this->Yourshop_model->get_data($shopInfo['userid']);
		$shopOwnerName = $shopOwnerInfo['user_first_name'] . ' ' . $shopOwnerInfo['user_last_name'];

		$config = new \RocketShipIt\Config;
		$config->setDefault('generic', 'shipper', $shopInfo['shop_name']);
		$config->setDefault('generic', 'shipContact', $shopOwnerName);
		$weight = '20.3';
		$length = '1';
		$width = '2';
		$height = '3';

		$rate = new \RocketShipIt\Rate('USPS', array('config' => $config));
		$rate->setParameter('toName', $toName);
		$rate->setParameter('toCompany', $toName);
		
		if ($toCountry == "US")
			$rate->setParameter('toCode', $toCode);

		$rate->setParameter('toCountry', $toCountry);
		$rate->setParameter('service', 'PRIORITY');

		$package = new \RocketShipIt\Package('usps', array('config' => $config));
		$package->setparameter('weight', $weight);
		$package->setparameter('length', $length);
		$package->setparameter('width', $width);
		$package->setparameter('height', $height);
		$package->setparameter('container', 'VARIABLE');
		$rate->addPackageToShipment($package);

		$response = $rate->getSimpleRates();

		// print_r($response);
		// exit();
		/////////////////////////
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
	}

	function add()
	{
		$pname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $this->input->post('name')))))))));
		
		if($this->input->post('color') !== NULL){$color = $this->input->post('color');}else{$color = '';}
		if($this->input->post('size') !== NULL){$size = $this->input->post('size');}else{$size = '';}
		;
		// Get buyer info
		if($this->session->userdata('isLogin') == TRUE){			
			$usid = $this->session->userdata('userid');
			
			$sqlBuyer = $this->db->query("select userid,display_name from mega_users where userid=$usid");
			$sqlBuyerfetch = $sqlBuyer->row_array();
			extract($sqlBuyerfetch);
		
			$buyername = $display_name;
			$buyerid = $userid;
			$shopId = $this->input->post('shopid');
			$shippingInfo = $this->calculateShipping($usid, $shopId);
		}else{
			$buyername = '';
			$buyerid = '';
		}

		
		$insert_room = array(
			'id' => $this->input->post('id'),
			'name' => $pname,
			'pimg' => $this->input->post('pimg'),
			'shopid' => $this->input->post('shopid'),
			'shopuserid' => $this->input->post('shopuserid'),
			'buyername' => $buyername,
			'buyerid' => $buyerid,
			'shopname' => $this->input->post('shopname'),
			/*'shipping_cost_itself' => $this->input->post('shipping_cost_itself'),
			'shipping_cost_with_another_items' => $this->input->post('shipping_cost_with_another_items'),
			'shipping_cost_int_by_itself' => $this->input->post('shipping_cost_int_by_itself'),
			'shipping_cost_int_with_another_items' => $this->input->post('shipping_cost_int_with_another_items'),*/
			'shipprocessingtime' => $this->input->post('shipprocessingtime'),
			'color' => $color,
			'size' => $size,
			'price' => $this->input->post('price'),
			'qty' => $this->input->post('quantity'),
			'shippingCostPerRow' => (!empty($shippingInfo['charges']) ? $shippingInfo['charges'] : "0.00"),
			'trk_main' => (!empty($shippingInfo['trk_main']) ? $shippingInfo['trk_main'] : ""),
			'label_fmt' => (!empty($shippingInfo['pkgs'][0]['label_fmt']) ? $shippingInfo['pkgs'][0]['label_fmt'] : ""),
			'label_img' => (!empty($shippingInfo['pkgs'][0]['label_img']) ? $shippingInfo['pkgs'][0]['label_img'] : ""),
		);

		$this->cart->insert($insert_room);
		
		$data['last2items'] 		= $this->page_model->getlastnumberofproducts(2);
		$data['last4items'] 		= $this->page_model->getlastnumberofrandomproducts(8);
		$data['last5items'] 		= $this->page_model->getlastnumberofrandomproducts(5);
		
		//echo $this->page_model->totalrecommaddeduiprecords();
		
		if($this->page_model->totalrecommaddeduiprecords($_SERVER['REMOTE_ADDR']) >0){
			
			$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproductsbyUserip($_SERVER['REMOTE_ADDR'],20);
			
		}else{
			$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproducts(20);
		}
		
		$data['message'] = '<p class="bg-success" id="msg"><i class="fa fa-check-square-o"></i> New item added in your cart!</p>';
		$data['breadcrumb'] = sitename().' - Shopping Cart';
		$data['chosenAddress'] = 1; //default is always 1. Chose between 1 or 2.
		
		$this->load->view('page/cart', $data);
	}
	
	
	
	
	
	function remove($rowid, $chosenAddress) {
		
		if ($rowid === "all")
			$this->cart->destroy();
		else
			$this->cart->remove($rowid);
		
		$data['breadcrumb'] = sitename().' - Shopping Cart';
		
		$data['last2items'] 		= $this->page_model->getlastnumberofproducts(2);
		$data['last4items'] 		= $this->page_model->getlastnumberofrandomproducts(8);
		$data['last5items'] 		= $this->page_model->getlastnumberofrandomproducts(5);
		
		//echo $this->page_model->totalrecommaddeduiprecords();
		
		if($this->page_model->totalrecommaddeduiprecords($_SERVER['REMOTE_ADDR']) >0){
			
			$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproductsbyUserip($_SERVER['REMOTE_ADDR'],20);
			
		}else{
			$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproducts(20);
		}
		
		$data['message'] = '<p class="bg-success" id="msg"><i class="fa fa-times-circle"></i> 1 Item removed from your cart!</p>';
		$data['chosenAddress'] = $chosenAddress;
		$this->load->view('page/cart', $data);
	}
	

	
	
	function update_cart(){		
		foreach($_POST['cart'] as $id => $cart) {
			$userId = $this->session->userdata('userid');
			$chosenAddress = $this->input->post('chosenAddress');	// i.e. 1 or 2
			$shippingInfo = $this->calculateShipping($userId, $cart['shopid'], $chosenAddress);

			$shippingDetails = array();
			$shippingDetails['shippingCostPerRow'] = (!empty($shippingInfo['charges']) ? $shippingInfo['charges'] : "0.00");
			$shippingDetails['trk_main'] = (!empty($shippingInfo['trk_main']) ? $shippingInfo['trk_main'] : "");
			$shippingDetails['label_fmt'] = (!empty($shippingInfo['pkgs'][0]['label_fmt']) ? $shippingInfo['pkgs'][0]['label_fmt'] : "");
			$shippingDetails['label_img'] = (!empty($shippingInfo['pkgs'][0]['label_img']) ? $shippingInfo['pkgs'][0]['label_img'] : "");

			$price = $cart['price'];
			$amount = $price * $cart['qty'];
			
			$this->cart_model->update_cart($cart['rowid'], $cart['qty'], $price, $amount, $shippingDetails);
		}
		
		
		$data['breadcrumb'] = sitename().' - Shopping Cart';
		
		$data['last2items'] 		= $this->page_model->getlastnumberofproducts(2);
		$data['last4items'] 		= $this->page_model->getlastnumberofrandomproducts(8);
		$data['last5items'] 		= $this->page_model->getlastnumberofrandomproducts(5);
		
		//echo $this->page_model->totalrecommaddeduiprecords();
		
		if($this->page_model->totalrecommaddeduiprecords($_SERVER['REMOTE_ADDR']) >0){
			
			$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproductsbyUserip($_SERVER['REMOTE_ADDR'],20);
			
		}else{
			$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproducts(20);
		}
		
		$data['message'] = '<p class="bg-success" id="msg"><i class="fa fa-pencil-square-o"></i> Your item quantity updated in your cart!</p>';
		$data['chosenAddress'] = $chosenAddress;
		
		$this->load->view('page/cart', $data);
	}

	
	
	
	
	function placeorder()
	{
		if($this->session->userdata('userid') !== NULL){
			
			if(isset($_POST['cart']) && isset($_POST['updatecart'])){
				$this->update_cart(); // Cart update
			}else{
				
				$ssspid = $this->input->post('shpid');
				
				// Gel all shopid from current shopping cart
				for($spod=0;$spod<count($this->input->post('shpid')); $spod++){
			
					$shhpid[] = $ssspid[$spod];
				}
				$shppid = $shhpid; // echo shopid
				
				if( in_array($this->session->userdata('shopopen'),$shppid) ){ // Check current user product added or not in shopping cart for order
				
					redirect('page/cart/removeownitems'); // Redirect to index
					
				}else{
					$this->cart_model->placeorder(); // Insert into mega_orders,mega_ordershop,mega_orderdetails
					
					//Set variables for paypal form
					$paypalURL = 'https://api-3t.sandbox.paypal.com/nvp'; //test PayPal api url
					
					/*echo $url = $this->uri->segment(3);
					if($url == 1){
						$this->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
					}
					if($url == 2){
						$this->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
					}*/
					//$this->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
					
					$paypalID = 'citisell-facilitator@citisell.com'; //business email
					//$paypalID = 'citisell@citisell.com'; //business email
					$returnURL = base_url().'page/paypal/success'; //payment success url
					$cancelURL = base_url().'page/paypal/cancel'; //payment cancel url
					$notifyURL = base_url().'page/paypal/ipn'; //ipn url
					//get particular product data
					//$product = $this->product->getRows($id);
					$userID = $this->input->post('userid'); //current user id
					$orderamounts = $this->input->post('order_amount'); //Order Amounts
					//$logo = base_url().'assets/frontend/images/interface/logo.png';
					$logo = 'http://wanitltd.com/citiS/assets/frontend/images/interface/logo.png';
					
					$this->paypal_lib->add_field('business', $paypalID);
					$this->paypal_lib->add_field('return', $returnURL);
					$this->paypal_lib->add_field('cancel_return', $cancelURL);
					$this->paypal_lib->add_field('notify_url', $notifyURL);
					//$this->paypal_lib->add_field('item_name', $product['name']);
					$this->paypal_lib->add_field('item_name', sitename().'::'. $this->input->post('buyername') .' order');
					$this->paypal_lib->add_field('custom', $userID);
					//$this->paypal_lib->add_field('item_number',  $product['id']);
					
					/*for($od=0;$od<count($this->input->post('pid')); $od++){
						
						$this->paypal_lib->add_field('item_name', $this->input->post('name')[$od]);
						$this->paypal_lib->add_field('item_number',  $this->input->post('pid')[$od]);
						$this->paypal_lib->add_field('amount',  $this->input->post('unitprice')[$od]);
					}*/
					
					$this->paypal_lib->add_field('amount', $orderamounts);		
					$this->paypal_lib->image($logo);
					
					$breadcrumb = ' Please wait, your order is being processed!';
					
					$this->paypal_lib->paypal_auto_form($this->input->post('buyername'),$breadcrumb);
					
					//$data['message'] = '<p class="bg-success" id="msg"><i class="fa fa-check-square-o"></i> Order place confirm!</p>';
					//$this->load->view('page/placeorder', $data);
				}
			}
			
		}else{
			redirect('page'); // Redirect to index
		}
		
	}

	
	
	function billpayment()
	{
		if($this->session->userdata('userid') !== NULL){
			
			$userID = $this->input->post('userid'); //current user id
			
			if($this->input->post('paymentamount_choice') == 'total_balance'){
				
				$billpaymentamounts = $this->input->post('totalbill'); //Bill Payment Amounts
				
			}else if($this->input->post('paymentamount_choice') == 'other'){
				
				$billpaymentamounts = $this->input->post('other_amount'); //Bill Payment Amounts
				
			}else{
				
				$billpaymentamounts = 0; //Bill Payment Amounts
				
			}
			
			
			$this->cart_model->outstandingbillpay(); // Update into mega_bill and Insert into mega_billdetails
			
			//Set variables for paypal form
			$paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //test PayPal api url
			
			/*echo $url = $this->uri->segment(3);
			if($url == 1){
				$this->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
			}
			if($url == 2){
				$this->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
			}*/
			//$this->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
			
			$paypalID = 'citisell-facilitator@citisell.com'; //business email
			//$paypalID = 'citisell@citisell.com'; //business email
			$returnURL = base_url().'page/paypal/billsuccess'; //payment success url
			$cancelURL = base_url().'page/paypal/billcancel'; //payment cancel url
			$notifyURL = base_url().'page/paypal/ipn'; //ipn url
			//get particular product data
			//$product = $this->product->getRows($id);
			
			//$logo = base_url().'assets/frontend/images/interface/logo.png';
			$logo = 'http://wanitltd.com/citiS/assets/frontend/images/interface/logo.png';
			
			$this->paypal_lib->add_field('business', $paypalID);
			$this->paypal_lib->add_field('return', $returnURL);
			$this->paypal_lib->add_field('cancel_return', $cancelURL);
			$this->paypal_lib->add_field('notify_url', $notifyURL);
			//$this->paypal_lib->add_field('item_name', $product['name']);
			$this->paypal_lib->add_field('item_name', sitename().'::'. $this->input->post('shopname') .' outstanding bill');
			$this->paypal_lib->add_field('custom', $userID);
			//$this->paypal_lib->add_field('item_number',  $product['id']);
			
			/*for($od=0;$od<count($this->input->post('pid')); $od++){
				
				$this->paypal_lib->add_field('item_name', $this->input->post('name')[$od]);
				$this->paypal_lib->add_field('item_number',  $this->input->post('pid')[$od]);
				$this->paypal_lib->add_field('amount',  $this->input->post('unitprice')[$od]);
			}*/
			
			$this->paypal_lib->add_field('amount', $billpaymentamounts);		
			$this->paypal_lib->image($logo);
			
			$breadcrumb = ' Please wait, your outstanding bill is being processed!';
			
			$this->paypal_lib->paypal_auto_form($this->input->post('shopname'),$breadcrumb);
			
			
			//$this->load->view('page/placeorder', $data);
		}else{
			redirect('page/login/logout');
		}
				
	}

	
}