<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Subcategory2 extends CI_Controller
{
	
	public function __construct() 
	{
		parent::__construct();
		// Load models
		$this->load->model('category_model');
		$this->load->model('subcategory_model');
		$this->load->model('subcategory2_model');
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
			$data['breadcrumb'] = 'Subcategory Lavel2 Management';
            $data['viewdata']   = $this->subcategory2_model->index(); // Get all data
            $this->load->view('categorymanagement/subcategory2/view', $data);
		}
	}

   // Add new sub category for load this function
    public function addlev2subcat()
    {
        // Check user session at first
        $session = $this->session->userdata('isLogin');
        if($session == FALSE)
        {
            $data['breadcrumb'] = 'Add Level2 Sub Category';
				
			$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
			
			foreach( $data['mainmenusArray'] as $key1 => $values1){
				$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
			}
			
            $this->load->view('categorymanagement/subcategory2/add', $data);
        }
        else
        {
            $data['breadcrumb']     = 'Add Level2 Sub Category';
            $data['viewCatdata']    = $this->category_model->getByStatus(1); // Get all data

           foreach($data['viewCatdata'] as $view){
                $data['viewSubCatdata'][$view->category_id]= $this->subcategory_model->getSubCatByStatus(1,$view->category_id); // Get all data
            }
				
			$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
			
			foreach( $data['mainmenusArray'] as $key1 => $values1){
				$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
			}
			
            $this->load->view('categorymanagement/subcategory2/add', $data);
        }
    }

    public function dependent_dropdown()
    {
        if(isset($_POST['category_id']))
        {
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode($this->subcategory2_model->getType($_POST['category_id'])));
        }
    }
	
	// Sub Category add function
	public function save()
	{
		// field name, error message, validation rules
		$this->form_validation->set_rules('SubCategoryLev2Name', 'Sub Category Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('CategoryID', 'Category Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('SubCategoryID', 'Sub Category Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('SubCatLev2Status', 'Status', 'trim|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if( $this->form_validation->run() ){
			$check = $this->subcategory2_model->insertsubcat();
			if($check)
			{
				$data['breadcrumb']     = 'Add New Sub Category Level2';
                $data['viewCatdata']    = $this->category_model->getByStatus(1); // Get all data

                foreach($data['viewCatdata'] as $view){
                    $data['viewSubCatdata'][$view->category_id]= $this->subcategory_model->getSubCatByStatus(1,$view->category_id); // Get all data
                }
				
				$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
				
				foreach( $data['mainmenusArray'] as $key1 => $values1){
					$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
				}
				
                $data['success_msg']    = 'New Sub Category added successfully!';
                $this->load->view('categorymanagement/subcategory2/add', $data);
			}
			else 
			{
                $data['breadcrumb']     = 'Add New Sub Category Level2';
                $data['viewCatdata']    = $this->category_model->getByStatus(1); // Get all data

                foreach($data['viewCatdata'] as $view){
                    $data['viewSubCatdata'][$view->category_id]= $this->subcategory_model->getSubCatByStatus(1,$view->category_id); // Get all data
                }
				
				$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
				
				foreach( $data['mainmenusArray'] as $key1 => $values1){
					$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
				}
				
                $data['success_msg']    = 'New Sub Category didn\'t added!';
                $this->load->view('categorymanagement/subcategory2/add', $data);
			}
		}
	}

    // Update category for load this function
    public function subcatupdate()
    {
        $id = $this->uri->segment(4);

        $data['breadcrumb']     = 'Update Sub Category Level2';
        $data['viewCatdata']    = $this->category_model->getByStatus(1); // Get all data

		foreach($data['viewCatdata'] as $view){
			$data['viewSubCatdata'][$view->category_id]= $this->subcategory_model->getSubCatByStatus(1,$view->category_id); // Get all data
		}
				
		$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
		
		foreach( $data['mainmenusArray'] as $key1 => $values1){
			$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
		}
        
        $data['editdata'] = $this->subcategory2_model->getbyId($id);
        $this->load->view('categorymanagement/subcategory2/update', $data);

    }


    // Category Update function
    public function updatesubcat()
    {
        $id = $this->uri->segment(4);

        // Unique check when update record
		
			$this->form_validation->set_rules('SubCategoryLev2Name', 'Sub Category Level2 name', 'trim|required|xss_clean');
        
        // field name, error message, validation rules
        $this->form_validation->set_rules('CategoryID', 'Category Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('SubCategoryID', 'Sub Category Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('SubCatLev2Status', 'Status', 'trim|xss_clean');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if( $this->form_validation->run() == FALSE ){
            
            $data['breadcrumb']     = 'Update Sub Category Level2';
            $data['error_msg']      = 'Sub Category didn\'t updated or already exist!';
            $data['viewdata']       = $this->subcategory2_model->index(); // Get all data
				
			$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
			
			foreach( $data['mainmenusArray'] as $key1 => $values1){
				$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
			}
			
            $this->load->view('categorymanagement/subcategory2/view', $data);
        
        }else{
            $this->subcategory2_model->updatesubcat($id);
                
            $data['breadcrumb']     = 'Update Sub Category Level2';
            $data['success_msg']    = 'Sub Category Level2 updated successfully!';
            $data['viewdata']       = $this->subcategory2_model->index(); // Get all data
				
			$data['mainmenusArray'] = array( 7001 => 'Clothing & Accessories', 7002 => 'Hand made Jewelry', 7003 => 'Handicraft Supplies', 7004 => 'Weddings', 7005 => 'Cosmetics', 7006 => 'Living & Home', 7007 => 'Kids Need', 7008 => 'Vintage');
			
			foreach( $data['mainmenusArray'] as $key1 => $values1){
				$data['catview'][$values1] =	$this->subcategory_model->category($values1,1); // Get Category
			}
			
            $this->load->view('categorymanagement/subcategory2/view', $data);  
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
			if ($this->subcategory2_model->delete($id) == FALSE)
			{ 
				goodbye(); // It's active when hacking attempt.
			}
			$data['breadcrumb'] = 'Manage Sub Category Level2';
			$data['success_msg'] = 'Record Deleted successfully';
			$data['viewdata'] = $this->subcategory2_model->index();
			$this->load->view('categorymanagement/subcategory2/view',$data);
		}
		else 
		{
			$data['breadcrumb'] = 'Manage Sub Category Level2';
			$data['error_msg'] = "Sorry ! you can't deleted this record";
			$data['viewdata'] = $this->subcategory2_model->index();
			$this->load->view('categorymanagement/subcategory2/view',$data);
		}
	}

}
