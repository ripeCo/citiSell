<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Page extends CI_Controller 
{
	
	public function __construct() 
	{  
		parent:: __construct(); 
		
		// Load models 
		$this->load->model('page_model'); 
	}
	
	// Default load this function
	public function index()
	{
		$data['breadcrumb'] = 'Manage Pages';
		$data['view'] = $this->page_model->index();  
		$this->load->view('pages/page/view',$data);  
	}
    
	
	// Add function
	public function add() 
	{
		$data['breadcrumb'] = 'Create New Page With Contents';
		$this->load->view('pages/page/add',$data);
	}
    
	
	// view shop function (Shop Management)
	public function viewshop() 
	{
		$data['breadcrumb'] = 'View Shop';
		$this->load->view('pages/page/view',$data);
	}
    
	
	// Insert function 
	public function insert() 
	{  
		// field name, error message, validation rules
		$this->form_validation->set_rules('pagename', 'pagename', 'trim|required|xss_clean');
		$this->form_validation->set_rules('title', 'title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('contents', 'contents', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pagestatus', 'pagestatus', 'trim|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if($this->form_validation->run() == FALSE) 
		{
			$data['breadcrumb'] = 'Create New Page With Contents';
			$data['error_msg'] = 'New Page didn\'t created successfully';
			$this->load->view('pages/page/add',$data);
		} 
		else 
		{
			$this->page_model->insert();

			$data['breadcrumb'] = 'Create New Page With Contents';
			$data['success_msg'] = 'New Page Created successfully';
			$this->load->view('pages/page/add',$data);
		}
	} 
    
    
	
	// Edit function
	public function edit() 
	{
		$id = $this->uri->segment(4);
		// Check return true/false
		if($this->page_model->get_data($id) == FALSE)
		{ 
			goodbye(); // It's active when hacking attempt.
		}
		$data['editpage'] = $this->page_model->get_data($id);
		$data['breadcrumb'] = 'Edit Page Contents';
		$this->load->view('pages/page/edit', $data);
	 }
     
     
	 
	// Update function
	public function update()
	{
		// field name, error message, validation rules
		$this->form_validation->set_rules('pagename', 'pagename', 'trim|required|xss_clean');
		$this->form_validation->set_rules('title', 'title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('contents', 'contents', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pagestatus', 'pagestatus', 'trim|xss_clean');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if($this->form_validation->run() == FALSE) 
		{
			$id = $this->uri->segment(4);

			$data['editpage'] 		= $this->page_model->get_data($id);
			$data['breadcrumb'] = 'Edit Page Contents';
			$data['error_msg'] 	= 'Page Contents didn\'t updated!';
			$this->load->view('pages/page/edit', $data);
		} 
		else 
		{
			$id = $this->uri->segment(4);

			$this->page_model->update($id);

			$data['breadcrumb'] 	= 'Manage Page Contents';
			$data['success_msg'] 	= 'Page Contents Updated successfully';
			$data['view'] 			= $this->page_model->index();
			$this->load->view('pages/page/view',$data);
		}
	}
    
    

	// Delete function
	public function delete()
	{
		$id = $this->uri->segment(4);
		$utype = $this->session->userdata('type');
		$uid = $this->session->userdata('id');
		
		if($utype=='SuperAdmin' OR $utype=='Admin') 
		{
			// Check return true/false
			if ($this->page_model->delete($id) == FALSE) 
			{ 
				goodbye(); // It's active when hacking attempt.
			}
			$data['breadcrumb'] 	= 'Page Management';
			$data['success_msg'] 	= 'Deleted successfully';
			$data['view'] 			= $this->page_model->index();
			$this->load->view('pages/page/view',$data);
		}
		else 
		{
			$data['breadcrumb'] 	= 'Page Management';
			$data['error_msg'] 		= "Sorry ! you can't deleted this record";
			$data['view'] 			= $this->page_model->index();
			$this->load->view('pages/page/view',$data);
		}
		
	}
    


}
