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
		require_once APPPATH . 'third_party/rocketshipit/autoload.php';
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
	
	
	private function calculateShipping($userId, $chosenAddress = 1) {
		/* Get recipient info to get the rates. */
			$userInfo = $this->User_model->get_data($userId);

			$rate = new \RocketShipIt\Rate('USPS');

			$rate->setParameter('toName', $userInfo['user_first_name'] . ' ' . $userInfo['user_last_name']);
			if ($userInfo['user_country'] == 'USA' or $userInfo['user_country'] == 'United States')
				$rate->setParameter('toCode', $userInfo['user_zip']);

			if ($chosenAddress == 1)
				$userCountry = getCountryISOCodeByCountryName($userInfo['user_country']);
			else
				$userCountry = getCountryISOCodeByCountryName($userInfo['user_country2']);

			$rate->setParameter('toCountry', $userCountry);

			// For testing purposes, values are fixed.
			// lbl should be mandatory
			$shippingDetails	= $this->Yourshop_model->getShippingDetails($this->input->post('id'));
			if (empty($shippingDetails['lbs']));
				$shippingDetails['lbs'] = '2';	// those should be variable
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
			file_put_contents("c:\\tmp\\test.txt", print_r($response, TRUE));
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
			$shippingCost = $this->calculateShipping($usid);
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
			'qty' => $this->input->post('quantity')
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

		$data['shippingCost'] = (!empty($shippingCost[0]['rate'])) ? $shippingCost[0]['rate'] : 0;
		$data['chosenAddress'] = 1; //default is always 1. Chose between 1 or 2.
		
		$this->load->view('page/cart', $data);
	}
	
	
	
	
	
	function remove($rowid) {
		
		if ($rowid === "all"){
			$this->cart->destroy();
		}else{
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);

			$this->cart->update($data);
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
		
		$data['message'] = '<p class="bg-success" id="msg"><i class="fa fa-times-circle"></i> 1 Item removed from your cart!</p>';
		$this->load->view('page/cart', $data);
	}
	

	
	
	function update_cart(){
 		// file_put_contents('c:\\tmp\\update_cart.txt', print_r($_POST, TRUE));
		
		foreach($_POST['cart'] as $id => $cart)
		{			
			$price = $cart['price'];
			$amount = $price * $cart['qty'];
			
			$this->cart_model->update_cart($cart['rowid'], $cart['qty'], $price, $amount);
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

		$userId = $this->session->userdata('userid');
		$chosenAddress = $this->input->post('chosenAddress');
		$shippingCost = $this->calculateShipping($userId, $chosenAddress);

		// file_put_contents('c:\\tmp\\test.txt', print_r($shippingCost, TRUE));

		$data['shippingCost'] = (!empty($shippingCost[0]['rate'])) ? $shippingCost[0]['rate'] : 0;
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