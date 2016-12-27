<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Account extends CI_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();
		// Load models
		$this->load->model('account_model');
	}
	
	
	
	// Add load this function
	public function citisellaccounts()
	{
		// Check user session at first
		$session = $this->session->userdata('isAdminLogin');
		if($session == FALSE)
		{
			$data['breadcrumb'] = 'Administrator Login';
			$this->load->view('administrator/login/login-form', $data);
		}
		else
		{
			$data['breadcrumb'] = 'Accounts Statements';
			$data['accountdetails'] = $this->account_model->getAllsellinghistory('delivered');
			
			$this->load->view('administrator/accountmanagement/view', $data);
		}
	}
	
	
	// Add load this function
	public function payable()
	{
		// Check user session at first
		$session = $this->session->userdata('isAdminLogin');
		if($session == FALSE)
		{
			$data['breadcrumb'] = 'Administrator Login';
			$this->load->view('administrator/login/login-form', $data);
		}
		else
		{
			$data['breadcrumb'] = 'Payable Account Lists';
			//$data['accountdetails'] = $this->account_model->getAllpayablesellersamounts('Pending');
			$data['shopdetails'] = $this->account_model->getAllActiveShops('Active');
			
			$this->load->view('administrator/accountmanagement/payable', $data);
		}
	}
	
	
	// Add load this function
	public function paymentmade()
	{
		// Check user session at first
		$session 			= $this->session->userdata('isAdminLogin');
		$shhpid 			= $this->uri->segment(4);
		$paymentdetailsid 	= $this->uri->segment(5);
		
		if($session == FALSE)
		{
			$data['breadcrumb'] = 'Administrator Login';
			$this->load->view('administrator/login/login-form', $data);
		}
		else
		{
			$data['breadcrumb'] = 'Payment Made';
			$data['shoppaymentdetails'] = $this->account_model->getShopPayableInfo($paymentdetailsid,$shhpid);
			
			$this->load->view('administrator/accountmanagement/paymentmade', $data);
		}
	}
	
	
	// Add load this function
	public function paymentmadeconfirm()
	{
		// Check user session at first
		$session 			= $this->session->userdata('isAdminLogin');
		$shhpid 			= $this->uri->segment(4);
		$paymentdetailsid 	= $this->uri->segment(5);
		$userid 			= $this->uri->segment(6);
		
		if($session == FALSE)
		{
			$data['breadcrumb'] = 'Administrator Login';
			$this->load->view('administrator/login/login-form', $data);
		}
		else
		{
			$payableBalance 	= $this->input->post('payableamounts');
			$paidamounts	 	= $this->input->post('paidamounts');
			
			// Payment status
			if($payableBalance > $paidamounts){
				$paymentstatus = 'Pending';
			}else{ $paymentstatus = 'Made'; }
			
			
			$cbalance = $payableBalance - $paidamounts;
			
			if($paidamounts > $payableBalance){
				
				$data['breadcrumb'] 		= 'Payment Made';
				$data['error_msg']      	= 'Sorry paid amounts is not greater to payable amounts!';
				$data['shoppaymentdetails'] = $this->account_model->getShopPayableInfo($paymentdetailsid,$shhpid);
				
				$this->load->view('administrator/accountmanagement/paymentmade', $data);
				
			}else{
				
				// Insert made payment
				$this->account_model->confirmpaymentmade($userid,$shhpid,$paidamounts,$cbalance,$paymentstatus);
				
				$data['breadcrumb'] 		= 'Payable Account Lists';
				$data['success_msg']    	= 'Payment has been paid!';
				
				$data['shopdetails'] = $this->account_model->getAllActiveShops('Active');
				
				$this->load->view('administrator/accountmanagement/payable', $data);
				
			}
			
			
		}
	}
	
	
	
	// Add load this function
	public function receiveable()
	{
		// Check user session at first
		$session = $this->session->userdata('isAdminLogin');
		if($session == FALSE)
		{
			$data['breadcrumb'] = 'Administrator Login';
			$this->load->view('administrator/login/login-form', $data);
		}
		else
		{
			$data['breadcrumb'] = 'Receivable Account Lists';
			$data['accountdetails'] = $this->account_model->getAllReceivablesellersamounts(NULL);
			
			$this->load->view('administrator/accountmanagement/receiveable', $data);
		}
	}
	
    
    ///////////////////////////////////////////
    //  Something
    //////////////////////////////////////////
    
    


}
