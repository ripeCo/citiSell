<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Order extends CI_Controller 
{
	
	public function __construct() 
	{  
        parent:: __construct(); 
		$this->load->library('paypal_ec'); 
	}
	
	function success(){
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
				// at this point, you have collected payment from your customer
				// you may want to process the order now.
				echo "<h1>Thank you. We will process your order now.</h1>";
				echo "<pre>";
				echo "\nGetExpressCheckoutDetails Data\n" . print_r($get_ec_return, true);
				echo "\n\nDoExpressCheckoutPayment Data\n" . print_r($do_ec_return, true);
				echo "</pre>";
			} else {
				$this->_error($do_ec_return);
			}
		} else {
			$this->_error($get_ec_return);
		}
	}
	/* -------------------------------------------------------------------------------------------------
	* The location for your IPN_URL that you set for $this->paypal_ec->do_ec(). obviously more needs to
	* be done here. this is just a simple logging example. The /ipnlog folder should the same level as
	* your CodeIgniter's index.php
	* --------------------------------------------------------------------------------------------------
	*/
	function ipn() {
		$logfile = 'ipnlog/' . uniqid() . '.html';
		$logdata = "<pre>\r\n" . print_r($_POST, true) . '</pre>';
		file_put_contents($logfile, $logdata);
	}
	
	/* -------------------------------------------------------------------------------------------------
	* a simple message to display errors. this should only be used during development
	* --------------------------------------------------------------------------------------------------
	*/
	function _error($ecd) {
		echo "<br>error at Express Checkout<br>";
		echo "<pre>" . print_r($ecd, true) . "</pre>";
		echo "<br>CURL error message<br>";
		echo 'Message:' . $this->session->userdata('curl_error_msg') . '<br>';
		echo 'Number:' . $this->session->userdata('curl_error_no') . '<br>';
	}
}
