<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Shops extends CI_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();
		// Load models
		$this->load->model('shopmanagement_model');
	}
	
	
	// Add load this function
	public function index()
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
			$data['breadcrumb'] = 'Shop Management';
			$data['getshops'] = $this->shopmanagement_model->getallshops('Active');
			
			$this->load->view('administrator/shopmanagement/view', $data);
		}
	}
	
	
	// Add load this function
	public function suspended()
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
			$data['breadcrumb'] = 'Shop Management';
			$data['getshops'] = $this->shopmanagement_model->getallshops('suspended');
			
			$this->load->view('administrator/shopmanagement/view', $data);
		}
	}
	
	
	// Add load this function
	public function pending()
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
			$data['breadcrumb'] = 'Shop Management';
			$data['getshops'] = $this->shopmanagement_model->getallshops('Pending');
			
			$this->load->view('administrator/shopmanagement/view', $data);
		}
	}
	
	
	// Add load this function
	public function active()
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
			$shopid = $this->uri->segment(4);
			$data['breadcrumb'] = 'Shop Active';
			$data['getshops'] = $this->shopmanagement_model->getshopById($shopid);
			
			$this->load->view('administrator/shopmanagement/edit', $data);
		}
	}
	
	
	// Add load this function
	public function suspend()
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
			$shopid = $this->uri->segment(4);
			$data['breadcrumb'] = 'Shop Suspend';
			$data['getshops'] = $this->shopmanagement_model->getshopById($shopid);
			
			$this->load->view('administrator/shopmanagement/edit', $data);
		}
	}
	
	
	// Conf load this function
	public function shopupdate()
	{
		$shopid = $this->uri->segment(4);
		
			$this->shopmanagement_model->updateshop($shopid);

			$data['breadcrumb']     = 'Shop Management';
			$data['success_msg']    = 'Shop updated successfully!';
			
			$data['getshops'] = $this->shopmanagement_model->getshopById($shopid);
			$data['getshops'] = $this->shopmanagement_model->getallshops('Active');
			
			$this->load->view('administrator/shopmanagement/view', $data);
	}
	
		
    
    ///////////////////////////////////////////
    //  Order Management
    //////////////////////////////////////////
    
	
	
	// Conf load this function
	public function delivered()
	{
		
		$data['breadcrumb']     = 'Order Management';
		
		$data['vieworders'] = $this->shopmanagement_model->getAllOedersrecords('Delivered');
		
		$this->load->view('administrator/ordermanagement/view', $data);
	}
	
	
	// Conf load this function
	public function pendingorder()
	{
		
		$data['breadcrumb']     = 'Order Management';
		
		$data['vieworders'] = $this->shopmanagement_model->getAllOedersrecords('Pending');
		
		$this->load->view('administrator/ordermanagement/view', $data);
	}
	
    
    ///////////////////////////////////////////
    //  Social Settings
    //////////////////////////////////////////
    
    


}
