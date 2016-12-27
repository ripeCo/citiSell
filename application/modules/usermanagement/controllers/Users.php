<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Users extends CI_Controller 
{
	
	public function __construct() 
	{  
		parent:: __construct(); 
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			goodbye(); // It's active when hacking attempt.
		}
		// Load models 
		$this->load->model('users_model'); 
	}
	
	// Default load this function
	public function index() 
	{
		$data['breadcrumb'] = 'Manage Users';
		$data['users'] = $this->users_model->index();  
		$this->load->view('users/view',$data);  
	}
    
	
	// Add function
	public function add() 
	{
		$data['breadcrumb'] = 'Create New User';
		$this->load->view('usermanagement/users/add',$data);
	}
    
	
	// Insert function 
	public function insert() 
	{  
		// field name, error message, validation rules
		$this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[portalusers.email]|xss_clean');
		$this->form_validation->set_rules('type', 'type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('status', 'status', 'trim|xss_clean');
		$this->form_validation->set_rules('username', 'username', 'trim|required|min_length[3]|max_length[12]|is_unique[portalusers.username]|xss_clean');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[3]|max_length[12]|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if($this->form_validation->run() == FALSE) 
		{
			$data['breadcrumb'] = 'Create New User';
			$data['error_msg'] = 'User didn\'t created successfully';
			$this->load->view('usermanagement/users/add',$data);
		} 
		else 
		{
			$this->users_model->insert();

			$data['breadcrumb'] = 'Create New User';
			$data['success_msg'] = 'New User Created successfully';
			$this->load->view('usermanagement/users/add',$data);
		}
	} 
    
    
	
	// Edit function
	public function edit() 
	{
		$id = $this->uri->segment(4);
		// Check return true/false
		if($this->users_model->get_data($id) == FALSE)
		{ 
			goodbye(); // It's active when hacking attempt.
		}
		$data['users'] = $this->users_model->get_data($id);
		$data['breadcrumb'] = 'Edit User';
		$this->load->view('users/edit', $data);
	 }
     
     
	 
	// Update function
	public function update()
	{
		// field name, error message, validation rules
		$this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');

		if ($this->input->post('email_old') !== $this->input->post('email')) {
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[portalusers.email]|xss_clean');
		}

		$this->form_validation->set_rules('type', 'type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('status', 'status', 'trim|xss_clean');

		// Unique check when update record
		if ($this->input->post('username_old') !== $this->input->post('username')){
			$this->form_validation->set_rules('username', 'username', 'trim|required|min_length[3]|max_length[12]|is_unique[portalusers.username]|xss_clean');
		}

		$this->form_validation->set_rules('password', 'password', 'trim|min_length[3]|max_length[12]|xss_clean');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if($this->form_validation->run() == FALSE) 
		{
			$id = $this->uri->segment(4);

			$data['users'] 		= $this->users_model->get_data($id);
			$data['breadcrumb'] = 'Edit User';
			$data['error_msg'] 	= 'User Info Not updated successfully';
			$this->load->view('usermanagement/users/edit', $data);
		} 
		else 
		{
			$id = $this->uri->segment(4);

			$this->users_model->update($id);

			$data['breadcrumb'] 	= 'Manage Users';
			$data['success_msg'] 	= 'User Info Updated successfully';
			$data['users'] 			= $this->users_model->index();
			$this->load->view('usermanagement/users/view',$data);
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
			if ($this->users_model->delete($id) == FALSE) 
			{ 
				goodbye(); // It's active when hacking attempt.
			}
			$data['breadcrumb'] 	= 'User Manager';
			$data['success_msg'] 	= 'Deleted successfully';
			$data['users'] 			= $this->users_model->index();
			$this->load->view('usermanagement/users/view',$data);
		}
		else 
		{
			$data['breadcrumb'] 	= 'User Manager';
			$data['error_msg'] 		= "Sorry ! you can't deleted this record";
			$data['users'] 			= $this->users_model->index();
			$this->load->view('usermanagement/users/view',$data);
		}
	}
    


}
