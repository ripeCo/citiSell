<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Category extends CI_Controller
{
	
	public function __construct() 
	{
		parent::__construct();
		// Load models
		$this->load->model('category_model');
	}

    ////////////////////////////////////////////////
    //  Category Section
    ///////////////////////////////////////////////

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
			$data['breadcrumb'] = 'Category Management';
            $data['viewdata'] = $this->category_model->index(); // Get all data
            $this->load->view('categorymanagement/category/view', $data);
		}
	}

    // Add new category for load this function
    public function addcat()
    {
        // Check user session at first
        $session = $this->session->userdata('isLogin');
        if($session == FALSE)
        {
            $data['breadcrumb'] = 'Add New Category';
            $this->load->view('categorymanagement/category/add', $data);
        }
        else
        {
            $data['breadcrumb'] = 'Add New Category';
            $this->load->view('categorymanagement/category/add', $data);
        }
    }
	
	// Category add function
	public function savecat()
	{
		// field name, error message, validation rules
		$this->form_validation->set_rules('CategoryName', 'Category Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('catstatus', 'catstatus', 'trim|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if( $this->form_validation->run() ){
			$check = $this->category_model->insertcat();
			if($check)
			{
				$data['breadcrumb']     = 'Add New Category';
                $data['success_msg']    = 'New Category added successfully!';
                $this->load->view('categorymanagement/category/add', $data);
			}
			else 
			{
                $data['breadcrumb']     = 'Add New Category';
                $data['success_msg']    = 'New Category didn\'t added!';
                $this->load->view('categorymanagement/category/add', $data);
			}
		}  
	}

    // Update category for load this function
    public function catupdate()
    {
        $id = $this->uri->segment(4);

        $data['breadcrumb'] = 'Update Category';
        $data['editdata'] = $this->category_model->getCatbyId($id);
        $this->load->view('categorymanagement/category/update', $data);

    }


    // Category Update function
    public function updatecat()
    {
        $id = $this->uri->segment(4);
        
        // Unique check when update record
		
		$this->form_validation->set_rules('CategoryName', 'Category name', 'trim|xss_clean');
        
        // field name, error message, validation rules
        $this->form_validation->set_rules('catstatus', 'catstatus', 'trim|xss_clean');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if( $this->form_validation->run() == FALSE ){
            
            $data['breadcrumb']     = 'Add New Category';
            $data['error_msg']      = 'Sub Category didn\'t updated Or Already Exist!';
            $data['viewdata']       = $this->category_model->index(); // Get all data
            $this->load->view('categorymanagement/category/view', $data);
        }else{
            
            $this->category_model->updatecat($id);
            
            $data['breadcrumb']     = 'Add New Category';
            $data['success_msg']    = 'Category updated successfully!';
            $data['viewdata']       = $this->category_model->index(); // Get all data
            $this->load->view('categorymanagement/category/view', $data);
        }
        
    }
	
	// Delete function
	public function delete() 
	{
		$id = $this->uri->segment(4);
		$utype = $this->session->userdata('type');
		
		if($utype=='SuperAdmin' OR $utype=='Admin') 
		{
			// Check return true/false
			if ($this->category_model->delete($id) == FALSE) 
			{ 
				goodbye(); // It's active when hacking attempt.
			}
			$data['breadcrumb'] = 'Manage Category';
			$data['success_msg'] = 'Record Deleted successfully';
			$data['viewdata'] = $this->category_model->index();  
			$this->load->view('categorymanagement/category/view',$data);
		}
		else 
		{
			$data['breadcrumb'] = 'Manage Category';
			$data['error_msg'] = "Sorry ! you can't deleted this record";
			$data['viewdata'] = $this->category_model->index();  
			$this->load->view('categorymanagement/category/view',$data);
		}
	}

}
