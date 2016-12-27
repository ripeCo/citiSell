<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Accounts extends CI_Controller 
{
	
	public function __construct() 
	{  
            parent:: __construct(); 
			
			//$this->load->library('upload');
			
            // Load models 
            $this->load->model('accounts_model');
            $this->load->model('accounts_model');
            $this->load->model('page_model');
            $this->load->model('user_model');
	}
	

	// load this function
	public function billinginfo()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			if($this->session->userdata('userid') == NULL){
				redirect('page/login/logout');
			}
			
			$data['billinginfo'] 	= $this->accounts_model->get_sellerbillinginfo();
			
			$data['breadcrumb'] =	'Billing Info';
			
			$this->load->view('page/shop/billinginfo',$data);
		}
		
	}
	

	// load this function
	public function billpayment()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			if($this->session->userdata('userid') == NULL){
				redirect('page/login/logout');
			}
			
			$data['billpaymentinfo'] 	= $this->accounts_model->get_sellerbillinginfo();
			
			$data['paymentinfo'] 			= $this->accounts_model->get_sellerbillingRecords();
			$data['paymentmethodsinfo'] 	= $this->accounts_model->get_sellerpaymentmethodsinfo();
			
			$data['breadcrumb'] =	'Make Your Billing Payment';
			
			$this->load->view('page/shop/billpayment',$data);
		}
		
	}
	
	
	

	// load this function
	public function billinginfoedit()
	{
		$this->db->trans_start();
		
		if($this->session->userdata('userid') == NULL){
			redirect('page');
		}
			
		$userid = $this->uri->segment(4);
		$shopid = $this->uri->segment(5);
		
		$address = $this->input->post('user_address1');
		
		if(empty($address)) 
		{
			
			$data['breadcrumb'] = 'Billing Info edit';
			$data['error_msg'] 	= 'Billing info didn\'t updated successfully';
			
			$data['billinginfo'] 	= $this->accounts_model->get_sellerbillinginfo();
			
			$data['users'] 		= $this->user_model->get_data($userid);
			$this->load->view('page/shop/billinginfo',$data);
		} 
		else 
		{
			$this->user_model->shippingaddressupdate($userid); // Shipping Address Change
			
			$this->user_model->billingcardinfoedit($userid,$shopid); // Billing Card info Change
			
			$data['billinginfo'] 	= $this->accounts_model->get_sellerbillinginfo();

			$data['breadcrumb'] = 'Billing Info edit';
			$data['success_msg'] 	= 'Billing info  updated successfully';
			
			$data['users'] 			= $this->user_model->get_data($userid);
			$this->load->view('page/shop/billinginfo',$data);
		}
		
		$this->db->trans_complete();
		
	}
	
	
	

	// load this function
	public function billingbankinfoedit()
	{
		$this->db->trans_start();
		
		if($this->session->userdata('userid') == NULL){
			redirect('page');
		}
			
		$userid = $this->uri->segment(4);
		$shopid = $this->uri->segment(5);
		
		$bankname = $this->input->post('bankname');
		
		if(empty($bankname)) 
		{
			
			$data['breadcrumb'] = 'Billing Info edit';
			$data['error_msg'] 	= 'Billing Bank info didn\'t updated successfully';
			
			$data['billinginfo'] 	= $this->accounts_model->get_sellerbillinginfo();
			
			$data['users'] 		= $this->user_model->get_data($userid);
			$this->load->view('page/shop/billinginfo',$data);
		} 
		else 
		{
			$this->user_model->billingbankinfoedit($userid,$shopid); // Billing Card info Change
			
			$data['billinginfo'] 	= $this->accounts_model->get_sellerbillinginfo();

			$data['breadcrumb'] 	= 'Billing Bank Info edit';
			$data['success_msg'] 	= 'Billing Bank info  updated successfully';
			
			$data['users'] 			= $this->user_model->get_data($userid);
			$this->load->view('page/shop/billinginfo',$data);
		}
		
		$this->db->trans_complete();
		
	}
	
	
	// Seller Account Statements list view
	public function payment($offset=0){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}else{
			$userid 				= $this->uri->segment(4);
			
		}
		
		if($this->session->userdata('userid') == NULL){
			redirect('page/login/logout');
		}
		
		$perpagerecords = perpagerecords(); // Per page number of record view
		
		$config['total_rows'] 		= $this->accounts_model->getselleraccountsrecords();
		$data['categorynumrow'] 	= $this->accounts_model->getselleraccountsrecords();
		
		
		$config['base_url'] = base_url()."page/accounts/payment/".$userid.'/'.$shopid.'/'.$this->uri->segment(6) ;
		
		$config['uri_segment'] = '7';
		
		$config['per_page'] = $perpagerecords;

		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';

		$config['first_link'] = '« First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last »';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next →';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '← Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';


		$this->pagination->initialize($config);

			
		$query = $this->accounts_model->getAllUserAccountsrecords($perpagerecords,$this->uri->segment(7));

		$data['allitem'] = null;

		if($query){ $data['allitem'] =  $query; }
			
		
		$data['paymentinfo'] 			= $this->accounts_model->get_sellerpaymentinfo();
		$data['paymentmethodsinfo'] 	= $this->accounts_model->get_sellerpaymentmethodsinfo();
			
		$data['breadcrumb'] =	'Shop Payment Account';
		
		$this->load->view('page/shop/sellerpaymentaccount',$data);
		
	}
	
	
	
	
	
	// Seller Billing Statements list view
	public function bill($offset=0){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}else{
			$userid 				= $this->uri->segment(4);
			
		}
		
		if($this->session->userdata('userid') == NULL){
			redirect('page/login/logout');
		}
		
		$perpagerecords = perpagerecords(); // Per page number of record view
		
		$config['total_rows'] 		= $this->accounts_model->getsellerBillingrecords();
		$data['categorynumrow'] 	= $this->accounts_model->getsellerBillingrecords();
		
		
		$config['base_url'] = base_url()."page/accounts/bill/".$userid.'/'.$shopid.'/'.$this->uri->segment(6) ;
		
		$config['uri_segment'] = '7';
		
		$config['per_page'] = $perpagerecords;

		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';

		$config['first_link'] = '« First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last »';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next →';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '← Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';


		$this->pagination->initialize($config);

			
		$query = $this->accounts_model->getSellerAllBillingrecords($perpagerecords,$this->uri->segment(7));

		$data['allitem'] = null;

		if($query){ $data['allitem'] =  $query; }
			
		
		$data['paymentinfo'] 			= $this->accounts_model->get_sellerbillingRecords();
		$data['paymentmethodsinfo'] 	= $this->accounts_model->get_sellerpaymentmethodsinfo();
			
		$data['breadcrumb'] =	'Your Outstanding Bill';
		
		$this->load->view('page/shop/sellerbill',$data);
		
	}
	
	
	// Seller Billing Statements list view
	public function billdetails($offset=0){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		$billmonth		= str_replace("_"," ", $this->uri->segment(7));
		$blmonth		= str_replace(" ","_", $this->uri->segment(7));
		
		if($this->session->userdata('userid') == NULL){
			redirect('page/login/logout');
		}
		
		$perpagerecords = perpagerecords(); // Per page number of record view
		
		$config['total_rows'] 		= $this->accounts_model->getsellerBilldetailsrecords();
		$data['categorynumrow'] 	= $this->accounts_model->getsellerBilldetailsrecords();
		
		
		$config['base_url'] = base_url()."page/accounts/billdetails/".$userid.'/'.$shopid.'/'.$this->uri->segment(6).'/'.$blmonth;
		
		$config['uri_segment'] = '8';
		
		$config['per_page'] = $perpagerecords;

		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';

		$config['first_link'] = '« First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last »';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next →';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '← Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';


		$this->pagination->initialize($config);

			
		$query = $this->accounts_model->getSellerAllBilldetailsrecords($perpagerecords,$this->uri->segment(8));

		$data['allitem'] = null;

		if($query){ $data['allitem'] =  $query; }
			
			
		$data['breadcrumb'] =	'Your '.sitename(). 'Bill - Generated on '.$billmonth ;
		
		$this->load->view('page/shop/sellerbilldetails',$data);
		
	}
	
	 
	 
	

    


}
