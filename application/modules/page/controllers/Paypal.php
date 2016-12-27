<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller 
{
	 function  __construct(){
		parent::__construct();
		$this->load->library('paypal_lib');
		$this->load->model('cart_model');
	 }
	 
	 function success(){
	    //get the transaction data
		$paypalInfo = $this->input->get();
		  
		/*$data['item_number'] = $paypalInfo['item_number']; 
		$data['txn_id'] = $paypalInfo["tx"];
		$data['payment_amt'] = $paypalInfo["amt"];
		$data['currency_code'] = $paypalInfo["cc"];
		$data['status'] = $paypalInfo["st"];*/
		
		//pass the transaction data to view
        //$this->load->view('page/paypal/success', $data);
		
		$this->cart_model->update_paymentstatus();
		
		$this->cart->destroy(); // Cart Destroy
		
		$data['breadcrumb'] = 'Thank you for purchase from '. sitename();
		
        $this->load->view('page/paypal/success', $data);
	 }
	 
	 
	 
	 function cancel(){
        
		$this->cart_model->delete_cancelledorder();
		
		//$this->cart_model->update_cancel_order_delete();
		
		$data['breadcrumb'] = sitename().' - We are sorry! Your last transaction was cancelled.!';
		
		$this->load->view('page/paypal/cancel', $data);
	 }
	 
	 
	
	
	/////////////////////////////////////////////////
	//	END Cart Paypal Payment Confirmation
	//	Start Bill Paypal Payment Confirmation
	/////////////////////////////////////////////////
	
	 
	 function billsuccess(){
	    //get the transaction data
		$paypalInfo = $this->input->get();
		  
		/*$data['item_number'] = $paypalInfo['item_number']; 
		$data['txn_id'] = $paypalInfo["tx"];
		$data['payment_amt'] = $paypalInfo["amt"];
		$data['currency_code'] = $paypalInfo["cc"];
		$data['status'] = $paypalInfo["st"];*/
		
		//pass the transaction data to view
        //$this->load->view('page/paypal/success', $data);
		
		
		$this->cart_model->update_outstandingbillingstatus();
		
		
		$data['breadcrumb'] = 'Thank you for payment your outstanding billing to '. sitename();
		
        $this->load->view('page/paypal/billsuccess', $data);
	 }
	 
	 
	 
	 function billcancel(){
        
		$this->cart_model->delete_outstandingbillingstatus();
		
		$this->cart_model->update_cancel_outstandingbillingstatusandtime();
		
		$data['breadcrumb'] = sitename().' - We are sorry! Your last billing payment transaction was cancelled.!';
		
		$this->load->view('page/paypal/billcancel', $data);
	 }
	 
	 
	 
	 //////////////////////////////////////////////
	 //	Paypal IPN for all
	 /////////////////////////////////////////////
	 
	 
	 function ipn(){
		//paypal return transaction details array
		$paypalInfo	= $this->input->post();

		$data['user_id'] = $paypalInfo['custom'];
		$data['product_id']	= $paypalInfo["item_number"];
		$data['txn_id']	= $paypalInfo["txn_id"];
		$data['payment_gross'] = $paypalInfo["payment_gross"];
		$data['currency_code'] = $paypalInfo["mc_currency"];
		$data['payer_email'] = $paypalInfo["payer_email"];
		$data['payment_status']	= $paypalInfo["payment_status"];

		$paypalURL = $this->paypal_lib->paypal_url;		
		$result	= $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
		
		//check whether the payment is verified
		if(eregi("VERIFIED",$result)){
		    //insert the transaction data into the database
			$this->product->insertTransaction($data);
		}
    }
	
	
}