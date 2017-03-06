<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->library('paypal_lib');
		$this->load->model('cart_model');
		$this->load->model('page_model');
		$this->load->model('User_model');
		$this->load->model('Yourshop_model');
		//require_once APPPATH . 'third_party/RocketShipIt/autoload.php';
	}
	
	
	public function index()
	{	
		$this->load->model('Msmodel');
		$this->load->view('page/cart');
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
	
	function savecrt(){
		$this->load->model('Msmodel');
		$price = intval($this->input->post('quantity')) * intval($this->input->post('price'));
		
		$posted_id = $this->input->post('id');
		// check existing product
		$check_exist_product = $this->Msmodel->check_existing_product($posted_id);
		
		if ($check_exist_product == true) {
			
			$variation = array(
							'size' => $this->input->post('size'),
							'color' => $this->input->post('color')
						);
			if( $check_exist_product['craw_size'] !== null && $check_exist_product['craw_size'] !== $variation['size'] || $check_exist_product['craw_color'] !== null && $check_exist_product['craw_color'] !== $variation['color']){
					$data = array(
								'craw_shopid'        => $this->input->post('shopid'),
								'craw_prodctid'      => $this->input->post('id'),
								'craw_qty'           => $this->input->post('quantity'),
								'craw_size'          => $this->input->post('size'),
								'craw_color'         => $this->input->post('color'),
								'craw_price'         => $price,
								'craw_shipping'      => $this->input->post('shipping_cost_itself'),
								'craw_userid'        => $this->input->post('buyerid'),
								'craw_pseller_id'    => $this->input->post('shopuserid'),
							);
					$setrules = array(
									array(
										'field' => 'shopid',
										'label' => '',
										'rules' => 'required'
									),
								);
					$this->form_validation->set_rules($setrules);
					if($this->form_validation->run() == true){
						$this->Msmodel->savecrt_info($data);
						redirect('page/cart', 'refresh', true);
					}else{
						echo "error uccered !";
					}
			}else{
				$posted_qnty = $this->input->post('quantity');
				$quantity = intval($posted_qnty) + intval($check_exist_product['craw_qty']);
				$price = intval($quantity) * intval($this->input->post('price'));
				$data = array(
							'craw_qty' => $quantity,
							'craw_price' => $price,
						);
				// update cart product quantity
				$this->Msmodel->update_crtinfo($check_exist_product['craw_id'], $data);
				redirect('page/cart', 'refresh', true);
			}
		}else{
			$data = array(
						'craw_shopid'        => $this->input->post('shopid'),
						'craw_prodctid'      => $this->input->post('id'),
						'craw_qty'           => $this->input->post('quantity'),
						'craw_size'          => $this->input->post('size'),
						'craw_color'         => $this->input->post('color'),
						'craw_price'         => $price,
						'craw_shipping'      => $this->input->post('shipping_cost_itself'),
						'craw_userid'        => $this->input->post('buyerid'),
						'craw_pseller_id'    => $this->input->post('shopuserid'),
					);
			$setrules = array(
							array(
								'field' => 'shopid',
								'label' => '',
								'rules' => 'required'
							),
						);
			$this->form_validation->set_rules($setrules);
			if($this->form_validation->run() == true){
				$this->Msmodel->savecrt_info($data);
				redirect('page/cart', 'refresh', true);
			}else{
				echo "error uccered !";
			}
		}
			
	}
	
	function removeitm(){
		$this->load->model('Msmodel');
		$result = $this->Msmodel->removecrt_item($this->input->post('rawid'));
		if($result == true){
			$result = array('status'=>'ok');
		}else{
			$result = array('status'=>'no');
		}
		echo json_encode($result);
	}
	function pqnty(){
		$this->load->model('Msmodel');
		$getprice = $this->Msmodel->pricerange($this->input->post('rawid'));
		$change_price = intval($getprice['product_price']) * intval($this->input->post('qnty'));
		
		$data['craw_qty'] = $this->input->post('qnty');
		if($this->input->post('qnty') === '1'){
			$data['craw_price'] = $getprice['product_price'];
		}else{
			$data['craw_price'] = $change_price;
		}
		$result = $this->Msmodel->itemqnty($this->input->post('rawid'), $data);
		if($result == true){
			$result = array('status'=>'ok');
		}else{
			$result = array('status'=>'no');
		}
		echo json_encode($result);
	}
	
	
	function remove($rowid) {
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
		//$data['chosenAddress'] = $chosenAddress;
		$this->load->view('page/cart', $data);
	}
	

	
	
	function update_cart(){		
		foreach($_POST['cart'] as $id => $cart) {
			$userId = $this->session->userdata('userid');
			$chosenAddress = $this->input->post('chosenAddress');	// i.e. 1 or 2
			//$shippingInfo = $this->calculateShipping($userId, $cart['shopid'], $chosenAddress);

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
		//Set variables for paypal form
		$paypalURL = 'https://api-3t.sandbox.paypal.com/nvp'; //test PayPal api url
		//$paypalURL = 'https://www.paypal.com/cgi-bin/webscr'; //test PayPal api url
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
		
		/*Insert product array*/
		$shoperid = $this->input->post('shoperid');
		$this->load->model('Msmodel');
		$getproducts = $this->Msmodel->getproductby_shopid($shoperid);
		
		for($i=0;$i<count($getproducts);$i++){
			$this->paypal_lib->add_field('item_name', $getproducts[$i]['product_name']);
			$this->paypal_lib->add_field('amount', $getproducts[$i]['product_price']);
			$this->paypal_lib->add_field('quantity', $getproducts[$i]['craw_qty']);
		}
		$this->paypal_lib->image($logo);
		$breadcrumb = ' Please wait, your order is being processed!';
		$this->paypal_lib->paypal_auto_form($this->input->post('buyername'),$breadcrumb);
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