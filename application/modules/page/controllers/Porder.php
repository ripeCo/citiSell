<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
Sample controller for Paypal_ec.php Library

18 November 2012

PayPal Express Checkout Library for CodeIgniter
based on paypalfunctions.php by Paypal Integration Wizard
---------------------------------------------
by Khairil Iszuddin Ismail
https://github.com/kidino/paypal_ec

Paypal_ec Sample Controller -- How To Use Guide
-----------------------------------------------

This is sample controller for Paypal_ec Library, a Paypal Express Checkout library
for CodeIgniter. For now it only handles normal Sale transaction -- no recurring, no
Order and Authorization. I am not familiar and have no experience with those yet.

Again, this is just a sample controller. Use this to learn how to implement Paypal
Express Checkout with your own Controller.

Basically the main functions are

- buy()    -- which calls the SetExpressCheckout, get the token and redirect to Paypal.
You can also detect visitor's browser and redirect to Paypal's Mobile Checkout
if they are on mobile devices. More info below

- return() -- this the location where Paypal will send back your customers. Arriving back
here, we should call GetExpressCheckoutDetails to get the details of the
transaction. And then call DoExpressCheckoutPayment to complete the transaction.

What more to do
---------------

You should build your system to store products and transactions details. At any point between,
before 	and/or after the API calls, you might want to log the data, or store them into the database.
This is different from system to system as each may have different requirements. So I believe you
are wise to think on your on for that part.

*/
class Porder extends CI_Controller {
	// This is just sample products -- you can name your
	// products anything and use any variables you like.
	// But you should be storing and calling product info
	// from your database though, and not like this.
	
	//private $product = array();
	private $product = array(
		'soap' => array('name' => 'Brand X Soap', 'desc' => 'a bar of soap for showering', 'price' => '2.95', 'code' => 'sp001', 'quantity' => 3), 
		'lotion' => array('name' => 'Skin Lotion', 'desc' => '100ml - Dry skins no more', 'price' => '4.50', 'code' => 'lt004', 'quantity' => 5)
	);
	private $currency = 'USD'; // currency for the transaction
	private $ec_action = 'Authorization'; // for PAYMENTREQUEST_0_PAYMENTACTION, it's either Sale, Order or Authorization
	
	function __construct() {
		parent::__construct();
		$paypal_details = array(
			// you can get this from your Paypal account, or from your
			// porder accounts in Sandbox
			'API_username' => 'mostak-facilitator_api1.wanitbd.com',
			'API_signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AAfEpb1RNHQi5fB3IdwpnTVfoL4v', 
			'API_password' => '428ADPB339CVPRWR',
			// Paypal_ec defaults sandbox status to true
			// Change to false if you want to go live and
			// update the API credentials above
			//'sandbox_status' => TRUE,
		);
		$this->load->library('paypal_ec', $paypal_details);
		$this->load->model('cart_model');
	}
	
	/* -------------------------------------------------------------------------------------------------
	* a sample order page, which just iterate $this->product and display them
	* --------------------------------------------------------------------------------------------------
	*/
	/*
	function index() {
		echo "<p>You are about to buy</p>";
		echo "<ul>";
		foreach($this->product as $p) {
			echo "<li>{$p['name']} - \${$p['price']}</li>";
		}
		echo "</ul>";
		echo "<h1><a href='" . site_url('page/porder/buy') . "'>BUY NOW</a></h1>";
	}
	*/
	
	
	/* -------------------------------------------------------------------------------------------------
	* a sample buy function in your Controller that does the SetExpressCheckout and redirects to Paypal
	* --------------------------------------------------------------------------------------------------
	*/
	function buy() {
		$to_buy = array(
			'desc' => 'Purchase from ACME Store', 
			'currency' => $this->currency, 
			'type' => $this->ec_action, 
			'return_URL' => site_url('page/porder/success'),
			'hdrimg' => 'https://www.angelleye.com/images/angelleye-paypal-header-750x90.jpg', 			// URL for the image displayed as the header during checkout.  Max size of 750x90.  Should be stored on an https:// server or you'll get a warning message in the browser.
			'logoimg' => 'https://www.angelleye.com/images/angelleye-logo-190x60.jpg', 
			'paypalID' => 'mostak-facilitator@wanitbd.com', //business email
			// see below have a function for this -- function back()
			// whatever you use, make sure the URL is live and can process
			// the next steps
			'cancel_URL' => site_url('page/cart'), // this goes to this controllers index()
			'shipping_amount' => 5.00, 
			'get_shipping' => true
			);
		// I am just iterating through $this->product from defined
		// above. In a live case, you could be iterating through
		// the content of your shopping cart.
		$shoperid = $this->input->post('shoperid');
		$payment_type = $this->input->post('paymentmethod');
		$this->session->set_userdata('paymnttype', $payment_type);
		$this->load->model('Msmodel');
		$getproducts = $this->Msmodel->getproductby_shopid($shoperid);
		
		foreach($getproducts as $p) {
			$temp_product = array(
					'name' => $p['product_name'], 
					//'desc' => $p['desc'], 
					//'number' => $p['code'], 
					'quantity' => $p['craw_qty'], // simple example -- fixed to 1
					'amount' => $p['product_price'],
					'number' => $p['craw_prodctid']
				);
				
			// add product to main $to_buy array
			$to_buy['products'][] = $temp_product;
		}
		// enquire Paypal API for token
		$set_ec_return = $this->paypal_ec->set_ec($to_buy);
		if (isset($set_ec_return['ec_status']) && ($set_ec_return['ec_status'] === true)){
			// redirect to Paypal
			$this->paypal_ec->redirect_to_paypal($set_ec_return['TOKEN']);
			// You could detect your visitor's browser and redirect to Paypal's mobile checkout
			// if they are on a mobile device. Just add a true as the last parameter. It defaults
			// to false
			// $this->paypal_ec->redirect_to_paypal( $set_ec_return['TOKEN'], true);
		} else {
			$this->_error($set_ec_return);
		}
	}
	
	/* -------------------------------------------------------------------------------------------------
	* a sample back function that handles
	* --------------------------------------------------------------------------------------------------
	*/
	function success() {
		
			// we are back from Paypal. We need to do GetExpressCheckoutDetails
			// and DoExpressCheckoutPayment to complete.
			$token = $_GET['token'];
			$payer_id = $_GET['PayerID'];
			// GetExpressCheckoutDetails
			$get_ec_return = $this->paypal_ec->get_ec($token);
			if (isset($get_ec_return['ec_status']) && ($get_ec_return['ec_status'] === true)) {
				// at this point, you have all of the data for the transaction.
				// you may want to save the data for future action. what's left to
				// do is to collect the money -- you do that by call DoExpressCheckoutPayment
				// via $this->paypal_ec->do_ec();
				//
				// I suggest to save all of the details of the transaction. You get all that
				// in $get_ec_return array
				$ec_details = array(
					'token' => $token, 
					'payer_id' => $payer_id, 
					'currency' => $this->currency, 
					'amount' => $get_ec_return['PAYMENTREQUEST_0_AMT'], 
					'IPN_URL' => site_url('page/porder/ipn'), 
					// in case you want to log the IPN, and you
					// may have to in case of Pending transaction
					'type' => $this->ec_action);
					
				// DoExpressCheckoutPayment
				$do_ec_return = $this->paypal_ec->do_ec($ec_details);
				
				
				if (isset($do_ec_return['ec_status']) && ($do_ec_return['ec_status'] === true)) {
					
					//echo "Hi Mostak Your Order has placed successfuly"."<br />";
					//echo "<strong>Your Paid Amount - ".$do_ec_return['PAYMENTINFO_0_AMT'];
					
					$productid = $get_ec_return['L_NUMBER0'];
					$this->load->model('Msmodel');
					$getshopid = $this->Msmodel->getshopid_byproid($productid);
					
					$shopid = $getshopid['shopid'];
					
					//Place Order Mostak's Code
					
					$getcrt_info = $this->Msmodel->placeordr_shopid($shopid);
					$data['payment_type'] = $this->session->userdata('paymnttype');
					$data['amount'] = $do_ec_return['PAYMENTINFO_0_AMT'];
					$data['shippingamnt'] = $get_ec_return['SHIPPINGAMT'];
					$gettotalorder = $this->Msmodel->gettotalorder();
					/*--------Insert Product order details-----------------*/
					$ordernumber = date('Ymd').$gettotalorder;
					$order = array(
								'ordernumber' => $ordernumber,
								'order_userid' => $getcrt_info['userid'],
								'order_buyerid ' => $this->session->userdata('userid'),
								'order_paymenttype' => $data['payment_type'],
								'order_amount' => $data['amount'],
								'order_shipping_amount' => $data['shippingamnt'],
								'order_shippingtype' => $getcrt_info['ship_to'],
								'order_usercountry' => $getcrt_info['user_country'],
								'order_ship_address' => 'test',
								'buyerAddress' => '',
								'order_tax' => $do_ec_return['PAYMENTINFO_0_TAXAMT'],
								'order_shipped' => 0,
								'payment_status' => 'Paid',
								'orderreasons' => $do_ec_return['PAYMENTINFO_0_PAYMENTSTATUS'],
							);
					$getinsrt_id = $this->Msmodel->insertorder($order);
					$insert_ordrid = $this->db->insert_id($getinsrt_id);
					
					$order_shop['orderid'] = $insert_ordrid;
					$order_shop['shopid'] = $shopid;
					$order_shop['shippingstatus'] = 'Pending';
					$this->db->insert('mega_ordershop', $order_shop);
					
					
					$place_order_details = $this->Msmodel->getproductby_shopid($shopid);
					
					
					foreach($place_order_details as $orderd){
							$order_details = array(
										'shopid' => $shopid,
										'orderid' => $insert_ordrid,
										'productid' => $orderd['craw_prodctid'],
										'unitprice' => $orderd['product_price'],
										'quantity' => $orderd['craw_qty'],
										'subtotal' => number_format($orderd['craw_price'], 2),
										'shippping_cost' => 0.00,
										'productVariations' => '',
										'shipprocessingtime' => $orderd['processing_time']
									);
					
							$this->db->insert('mega_orderdetails', $order_details);
					}
					
					
					
					/*--------/end this proccess-----------------*/
					
					$this->db->query("delete from mega_cart where mega_cart.craw_shopid='$shopid' ");
					
					$data['itemamnt'] = $get_ec_return['ITEMAMT'];
					$data['currency'] = $do_ec_return['PAYMENTINFO_0_CURRENCYCODE'];
					$this->load->view('page/paypal/success', $data);
					$this->session->set_userdata('chktokn', FALSE);
					
					// at this point, you have collected payment from your customer
					// you may want to process the order now.
					/*
					echo "<h1>Thank you. We will process your order now.</h1>";
					echo "<pre>";
					echo "\nGetExpressCheckoutDetails Data\n" . print_r($get_ec_return, true);
					echo "\n\nDoExpressCheckoutPayment Data\n" . print_r($do_ec_return, true);
					echo "</pre>";
					*/
				} else {
					//$this->_error($do_ec_return);
					redirect('page/user/userarea', 'refresh');
				}
			} else {
				//$this->_error($get_ec_return);
				redirect('page/user/userarea', 'refresh');
			}
	}
	
	/* -------------------------------------------------------------------------------------------------
	* The location for your IPN_URL that you set for $this->paypal_ec->do_ec(). obviously more needs to
	* be done here. this is just a simple logging example. The /ipnlog folder should the same level as
	* your CodeIgniter's index.php
	* --------------------------------------------------------------------------------------------------
	*/
	function ipn(){
		$logfile = 'ipnlog/' . uniqid() . '.html';
		$logdata = "<pre>\r\n" . print_r($_POST, true) . '</pre>';
		file_put_contents($logfile, $logdata);
	}
	
	/* -------------------------------------------------------------------------------------------------
	* a simple message to display errors. this should only be used during development
	* --------------------------------------------------------------------------------------------------
	*/
	function _error($ecd){
		echo "<br>error at Express Checkout<br>";
		echo "<pre>" . print_r($ecd, true) . "</pre>";
		echo "<br>CURL error message<br>";
		echo 'Message:' . $this->session->userdata('curl_error_msg') . '<br>';
		echo 'Number:' . $this->session->userdata('curl_error_no') . '<br>';
	}
}
/* Sample controller for Paypal_ec.php Library */
/* End of file porder.php */
/* Location: ./application/controllers/porder.php */
