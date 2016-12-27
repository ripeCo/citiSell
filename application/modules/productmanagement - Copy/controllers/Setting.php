<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Setting extends CI_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();
		// Load models
		//$this->load->model('settings_model');
	}
	
	// Default load this function
	public function index() 
	{
		// Check user session at first
		$session = $this->session->userdata('isLogin');
		if($session == FALSE) 
		{
			$data['breadcrumb'] = 'Administrator Login';
			$this->load->view('administrator/login/login-form', $data); 
		} 
		else 
		{
			$data['breadcrumb'] = 'Portal Settings';
			$this->load->view('setting/view', $data); 
		}
	}
	
	// Add load this function
	public function add() 
	{
		// Check user session at first
		$session = $this->session->userdata('isLogin');
		if($session == FALSE) 
		{
			$data['breadcrumb'] = 'Administrator Login';
			$this->load->view('administrator/login/login-form', $data);
		} 
		else 
		{
			$data['breadcrumb'] = 'Add New';
			$this->load->view('administrator/setting/add', $data); 
		}
	}
	
	
	
	
	
	
	
	
	
	// User login function
	public function form()
	{
		// field name, error message, validation rules
		$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'password', 'trim|required|md5|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if($this->form_validation->run() == FALSE) 
		{
			$this->index();
		}
		else 
		{
			$check = $this->login_model->check_user();
			if($check == TRUE) 
			{
				$this->session->set_userdata('isLogin', TRUE); // This is a public session that used every controller
				$this->login_model->login_time(); // Update login time
				$this->index();
				$this->mail();
				
			}
			else 
			{
			 	$this->session->set_flashdata('login_error', "Username or password didn't match!.");
				$this->index();
			}
		}  
	}
	
	// User Mail function
	public function mail()
	{
		$this->load->library('email');

		$this->email->from('email@example.com', 'Your Name');
		$this->email->to('cisrony@gmail.com');

		$this->email->subject('Email Test');
		$this->email->message( current_url() );
		
		$this->email->send();
	}
	
	// Database Backup
	public function dbBackup(){
		// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup();

		// Load the file helper and write the file to your server
		/*$this->load->helper('file');
		write_file('/path/to/mybackup.gz', $backup);*/

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		$dbname = 'wanerp_dbBackup_'.date('d-m-Y');
		force_download("$dbname.zip", $backup);
	}

	// Logout function 
	public function logout() 
	{
		$this->login_model->logout_time(); // Update logout time
		$this->session->sess_destroy();
		redirect('administrator');
	}

}
