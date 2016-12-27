<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Subcategory extends CI_Controller
{
	
	public function __construct() 
	{
		parent::__construct();
		// Load models
		$this->load->model('category_model');
		$this->load->model('subcategory_model');
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
			$data['breadcrumb'] = 'Subcategory Management';
            $data['viewdata']   = $this->subcategory_model->index(); // Get all data
            $this->load->view('categorymanagement/subcategory/view', $data);
		}
	}
	

    // Add new sub category for load this function
    public function addsubcat()
    {
        // Check user session at first
        $session = $this->session->userdata('isLogin');
        if($session == FALSE)
        {
            $data['breadcrumb'] = 'Add New Sub Category';
			$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
			
			foreach( $data['mainmenusArray'] as $key1 => $values1){
				$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
			}
            $this->load->view('categorymanagement/subcategory/add', $data);
        }
        else
        {
            $data['breadcrumb'] = 'Add New Sub Category';
			$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
			
			foreach( $data['mainmenusArray'] as $key1 => $values1){
				$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
			}
			
            $this->load->view('categorymanagement/subcategory/add', $data);
        }
    }
	
	// Sub Category add function
	public function save()
	{
		// field name, error message, validation rules
		$this->form_validation->set_rules('SubCategoryName', 'Sub Category Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('CategoryID', 'Category Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('SubCatStatus', 'Status', 'trim|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if( $this->form_validation->run() ){
			$check = $this->subcategory_model->insertsubcat();
			if($check)
			{
				$data['breadcrumb']     = 'Add New Sub Category';
                $data['viewdata']       = $this->category_model->getByStatus(1); // Get all data
                $data['success_msg']    = 'New Sub Category added successfully!';
				
				$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
				
				foreach( $data['mainmenusArray'] as $key1 => $values1){
					$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
				}
				
                $this->load->view('categorymanagement/subcategory/add', $data);
			}
			else 
			{
                $data['breadcrumb']     = 'Add New Sub Category';
                $data['viewdata']       = $this->category_model->getByStatus(1); // Get all data
                $data['success_msg']    = 'New Sub Category didn\'t added!';
				
				$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
				
				foreach( $data['mainmenusArray'] as $key1 => $values1){
					$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
				}
				
                $this->load->view('categorymanagement/subcategory/add', $data);
			}
		}
	}

    // Update category for load this function
    public function subcatupdate()
    {
        $id = $this->uri->segment(4);

        $data['breadcrumb'] = 'Update Category';
        $data['viewdata'] = $this->category_model->getByStatus(1);
        $data['editdata'] = $this->subcategory_model->getbyId($id);
				
		$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
		
		foreach( $data['mainmenusArray'] as $key1 => $values1){
			$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
		}
		
        $this->load->view('categorymanagement/subcategory/update', $data);

    }


    // Category Update function
    public function updatesubcat()
    {
        $id = $this->uri->segment(4);
        
        // Unique check when update record
		
		$this->form_validation->set_rules('SubCategoryName', 'Sub Category name', 'trim|required|xss_clean');
        
        // field name, error message, validation rules
        $this->form_validation->set_rules('CategoryID', 'Category Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('SubCatStatus', 'Status', 'trim|xss_clean');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if( $this->form_validation->run() == FALSE ){
            
            $data['breadcrumb']     = 'Update Sub Category';
            $data['error_msg']      = 'Sub Category didn\'t updated Or Already Exist!';
            $data['viewdata']       = $this->subcategory_model->index(); // Get all data
				
			$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
			
			foreach( $data['mainmenusArray'] as $key1 => $values1){
				$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
			}
			
            $this->load->view('categorymanagement/subcategory/view', $data);
        }else{
            
            $this->subcategory_model->updatesubcat($id);
            
            $data['breadcrumb']     = 'Update Sub Category';
            $data['success_msg']    = 'Sub Category updated successfully!';
            $data['viewdata']       = $this->subcategory_model->index(); // Get all data
				
			$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
			
			foreach( $data['mainmenusArray'] as $key1 => $values1){
				$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
			}
			
            $this->load->view('categorymanagement/subcategory/view', $data);
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
			if ($this->subcategory_model->delete($id) == FALSE)
			{ 
				goodbye(); // It's active when hacking attempt.
			}
			$data['breadcrumb'] = 'Manage Sub Category';
			$data['success_msg'] = 'Record Deleted successfully';
			$data['viewdata'] = $this->subcategory_model->index();
			$this->load->view('categorymanagement/subcategory/view',$data);
		}
		else 
		{
			$data['breadcrumb'] = 'Manage Sub Category';
			$data['error_msg'] = "Sorry ! you can't deleted this record";
			$data['viewdata'] = $this->subcategory_model->index();
			$this->load->view('categorymanagement/subcategory/view',$data);
		}
	}

}
