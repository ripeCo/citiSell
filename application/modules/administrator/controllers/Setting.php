<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Setting extends CI_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();
		// Load models
		$this->load->model('setting_model');
	}
	
	// Add load this function
	public function config()
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
			$id = $this->uri->segment(4);

			$data['breadcrumb'] = 'ctSell Shop Portal Product Listing cost, Listing Renewal Period, Sells Commission etc Setting';
			$data['editdata'] = $this->setting_model->getById($id);
			$this->load->view('administrator/setting/config', $data);
		}
	}

	// Conf load this function
	public function conf()
	{
		$id = $this->uri->segment(4);

		// field name, error message, validation rules
		$this->form_validation->set_rules('listingcost', 'Product Listing Cost', 'trim|required|xss_clean');
		$this->form_validation->set_rules('productrenewal', 'Product renewal Period', 'trim|xss_clean');
		$this->form_validation->set_rules('sellcommission', 'Sell Commission', 'trim|xss_clean');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if( $this->form_validation->run() == FALSE ){

			$data['breadcrumb']     = 'ctSell Shop Portal Product Listing cost, Listing Renewal Period, Sells Commission etc Setting';
			$data['error_msg']      = 'Product Listing Settings didn\'t updated!';
			$data['editdata'] 		= $this->setting_model->getById($id);
			$this->load->view('administrator/setting/config', $data);
		}else{

			$this->setting_model->update($id);

			$data['breadcrumb']     = 'ctSell Shop Portal Product Listing cost, Listing Renewal Period, Sells Commission etc Setting';
			$data['success_msg']    = 'Product Listing Settings updated successfully!';
			$data['editdata'] 		= $this->setting_model->getById($id); // Get editable data
			$this->load->view('administrator/setting/config', $data);
		}
	}
	
    
    ///////////////////////////////////////////
    //  Social Settings
    //////////////////////////////////////////
    
    
	
	// Add load this function
	public function social()
	{
		$id = $this->uri->segment(4);

		$data['breadcrumb'] = 'Social Media Setting';
		$data['editdata'] = $this->setting_model->getbySocialId($id);
		$this->load->view('administrator/setting/social', $data);
	}
    
    

	// Conf load this function
	public function socialupdate()
	{
		$id = $this->uri->segment(4);

		// field name, error message, validation rules
		$this->form_validation->set_rules('facebook', 'facebook', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gplus', 'google plus', 'trim|xss_clean');
		$this->form_validation->set_rules('twitter', 'twitter', 'trim|xss_clean');
		$this->form_validation->set_rules('linkedin', 'linkedin', 'trim|xss_clean');
		$this->form_validation->set_rules('pinterest', 'pinterest', 'trim|xss_clean');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if( $this->form_validation->run() == FALSE ){

			$data['breadcrumb']     = 'Social Media Profile Setting';
			$data['error_msg']      = 'Social Media Profile didn\'t updated!';
			$data['editdata'] 		= $this->setting_model->getbySocialId($id);
			$this->load->view('administrator/setting/social', $data);
		}else{

			$this->setting_model->socialupdate($id);

			$data['breadcrumb']     = 'Social Media Profile Setting';
			$data['success_msg']    = 'PSocial Media Profile updated successfully!';
			$data['editdata'] 		= $this->setting_model->getbySocialId($id); // Get editable data
			$this->load->view('administrator/setting/social', $data);
		}
	}


}
