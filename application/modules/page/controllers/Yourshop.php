<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Yourshop extends CI_Controller 
{
	
	public function __construct() 
	{  
		parent:: __construct(); 
		
		//$this->load->library('upload');
		
		// Load models 
		$this->load->model('yourshop_model');
		$this->load->model('user_model');
		$this->load->model('accounts_model');
		$this->load->model('page_model');
	}
	

	// load this function
	public function newshop()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			$data['sections'] 	= $this->yourshop_model->get_sectiondata();
			
			$data['breadcrumb'] =	'Your Shop';
			
			$this->load->view('page/shop/yourshop',$data);
		}
		
	}
	

	// load this function
	public function closeshop()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
			$userid = $this->uri->segment(4);
			$shopid = $this->uri->segment(5);
			
			
			$data['paymentinfo'] 			= $this->accounts_model->get_sellerbillingRecords();
			$data['paymentmethodsinfo'] 	= $this->accounts_model->get_sellerpaymentmethodsinfo();
		
			
			$data['shopbillinfo'] 		= $this->yourshop_model->getshopbilldata($shopid);
			$data['shopinfo'] 			= $this->yourshop_model->getshopdata($shopid);
			
			$data['breadcrumb'] =	'Close your Shop';
			
			$this->load->view('page/shop/closeshop',$data);
		}
		
	}
	
	 
	 
	// User main action searching result
	public function viewshop($offset=0){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$shopid 				= $this->uri->segment(4);
			$userid 				= $this->session->userdata('userid');
			$data['users'] 			= $this->yourshop_model->get_data($userid);
		}else{
			$shopid 				= $this->uri->segment(4);
		}
		
		$data['getsections'] 	= $this->yourshop_model->get_sectiondata();
		
		$sqlshop0 = $this->db->query("select * from mega_shops where shopid=$shopid");
		$sqlshopfetch0 = $sqlshop0->row_array();
		extract($sqlshopfetch0);
		
		
		$perpagerecords = perpagerecords();
		
		if( $this->uri->segment(6) == NULL){
			
			$config['total_rows'] = $this->yourshop_model->getsectiontotalrecords();
			
			$config['base_url'] = base_url()."page/yourshop/viewshop/".$shopid;
			$config['uri_segment'] = '5';
			
		}else{
			
			$config['total_rows'] 		= $this->yourshop_model->getsectiontotalrecords();
			$data['categorynumrow'] 	= $this->yourshop_model->getsectiontotalrecords();
			
			
			$config['base_url'] = base_url()."page/yourshop/viewshop/".$shopid.'/'.$this->uri->segment(5).'/'.$this->uri->segment(6) ;
			
			$config['uri_segment'] = '7';
			
		}
		
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

		if($this->uri->segment(6) == NULL){
			
			$query = $this->yourshop_model->getsectionrecords($perpagerecords,$this->uri->segment(5));

			$data['allitem'] = null;

			if($query){ $data['allitem'] =  $query; }
			
		}else{
			
			$query = $this->yourshop_model->getsectionrecords($perpagerecords,$this->uri->segment(7));

			$data['allitem'] = null;

			if($query){ $data['allitem'] =  $query; }
			
		}
		
		
		//$data['allitems'] 		= $this->page_model->getallproducts(0,4);

		$data['total_results'] 	= $this->yourshop_model->getsectiontotalrecords();
		
		$data['breadcrumb'] =	ucfirst($shoptitle). ' - by '.$shop_name. ' on CitiSell';
		
		$this->load->view('page/shop/myshop',$data);
	}

		  

	// load this function
	public function renewproduct()
	{
		
		$data['getproductinfo'] = $this->yourshop_model->getRenualroducts();
		
	}

		  

	// load this function
	public function shopavailablecheck()
	{
		// Check user session
		$check = $this->yourshop_model->checkshopname($this->input->post('shop_name'));
		
		if($check) 
		{ 
			echo "<span class='error' style='color:brown;font-size:15px;'> <i class='fa fa-times-circle'></i> Sorry shopname already taken !!!</span>";
			
		}else{
		
			echo "<span class='success' style='color:green;font-size:15px;'> <i class='fa fa-check-square-o'></i> Shopname is available!</span>";
		}
		
	}
	
	

	// load this function
	public function shoppreferences()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
			$userid 		= $this->session->userdata('userid');
			
			if($this->yourshop_model->shopuser_exists($userid)){
				
				/*$data['breadcrumb'] 	=	'Your Shop';
				$data['error_msg'] 		= 	'You already opened a shop!';
				$this->load->view('page/shop/yourshop',$data);*/
			}else{
			
				$this->yourshop_model->newshopopen();
			}
		}
		
	}
	
	
	

	// load this function
	public function shopnamesave()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			$userid 		= $this->session->userdata('userid');
			$shop_name 		= $this->input->post('shop_name');
			$old_shopname 	= $this->input->post('old_shopname');
			
			if($this->yourshop_model->shopname_exists($shop_name)){
				
				/*$data['breadcrumb'] 	=	'Your Shop';
				$data['error_msg'] 		= 	'You already opened a shop!';
				$this->load->view('page/shop/yourshop',$data);*/
			}else{
				
				if(!empty($shop_name)){
					
					$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
					
					// New Seprate upload directory for each shops
					$dir_exist = true; // flag for checking the directory exist or not
					if (!is_dir('assets/frontend/images/shops/'.$sname))
					{
						mkdir('./assets/frontend/images/shops/'.$sname, 0777, true);
						$dir_exist = false; // dir not exist
					}else{
						// Nothing
					}
					
					$this->yourshop_model->updateshopname($userid);
				}
				
			}
		}
		
	}
	
	
	

	// load this function
	public function getproductsubcategory()
	{
		if($this->input->post('category_id'))
		{
			$id = $this->input->post('category_id');
			
			$stmt = $this->db->query("SELECT * FROM mega_subcategory WHERE category_id=$id");
			$results = $stmt->result();
			
			echo '<option value="">---Sub Category---</option>';
			echo '<optgroup label="Select Subcategory">';
			
			foreach($results as $row)
			{
			
				echo '<option value="'.$row->sub_category_id.'">'.$row->sub_category_name.'</option>';
			
			}
			
			echo '</optgroup>';
		}
		
	}
	
	
	

	// load this function
	public function getproductsubcategorylev2()
	{
		if($this->input->post('subcategory_id'))
		{
			$id = $this->input->post('subcategory_id');
			
			$stmt = $this->db->query("SELECT * FROM mega_subcategorylevel2 WHERE sub_category_id=$id");
			$results = $stmt->result();
			
			echo '<option value="">---Sub Subcategorylev2---</option>';
			echo '<optgroup label="Select Subcategorylev2">';
			
			foreach($results as $row)
			{
			
				echo '<option value="'.$row->sub_category_lev2_id.'">'.$row->sub_category_lev2_name.'</option>';
			
			}
			
			echo '</optgroup>';
		}
		
	}
	
	
	
	// File loading function
	public function do_upload($shopname){
		
		$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shopname))));
		
		$config['upload_path'] 		= './assets/frontend/images/shops/'.$sname.'/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
		$config['encrypt_name']		= FALSE;
		$config['max_size']			= 10240;

		$this->load->library('upload', $config); // File upload library 
		
	}
	
	
	// Image Resize function
	public function img_resize($w,$h,$shopname,$imgName){
		//$config['image_library'] 		= 'gd2';
		$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shopname))));
		
		$config['image_library'] 	= 'gd2';
		$config['source_image'] 	= './assets/frontend/images/shops/'.$sname.'/'.$imgName;
		$config['create_thumb'] 	= FALSE;
		$config['maintain_ratio'] 	= TRUE;
		$config['quality']     		= "100%";
		$config['width']         	= $w;
		$config['height']       	= $h;
		
		$this->load->library('image_lib');
		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
	
	
	
	
	// Add listing when shop open
	public function productstock(){
		
		$this->db->trans_start();
		
		if($this->session->userdata('userid') == NULL){
			redirect('page');
		}
			
		$userid = $this->session->userdata('userid');
		
		if( $this->input->post('product_name') !== '' && $this->input->post('product_category_id') !== '' && $this->input->post('product_price') !== '' && $this->input->post('product_stock') !== '' ){
		
			$this->load->library('upload');
			
			extract($this->yourshop_model->get_data_shops($userid));
			
			$productId = $this->yourshop_model->max()+1; // Get Maximum Product ID
			
			$filename = $_FILES["userfile"]["name"];
			
				for($sn=0;$sn<count($filename);$sn++){
					
					$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
					
					$dir_path ="./assets/frontend/images/shops/$sname/";
					
					$file_basename = substr($filename[$sn], 0, strripos($filename[$sn], '.'));
					$file_ext = substr($filename[$sn], strripos($filename[$sn], '.'));
					$path = $dir_path.$productId.'_'.$sn.$file_ext;
					$userfile = $productId.'_'.$sn.$file_ext;
					
					
					if($userfile == $productId.'_'.$sn){
						// Nothing	
					}else{ $pimages[] = $userfile; }
					
					move_uploaded_file($_FILES["userfile"]["tmp_name"][$sn], $path);
					
					$this->img_resize(1087,1087,$sname,$userfile); // resize image after upload
				}
				
			if(!empty($pimages)){
				$fileName = implode(',',$pimages);
			}else{
				$fileName = 'default-img.jpg';
			}
				
			
			if( $shopid !== NULL ){
				
				$this->yourshop_model->insertlistedproduct($shopid,$fileName); // Insert Query for products table
				
				$this->yourshop_model->generateNewListingBill($shopid); // Insert Query for Listing bill, billdetails table
				
				
				//$this->yourshop_model->insertproductoptions($productId); // Insert Query for productoptions table
				
				$this->yourshop_model->insertshoppinginfo($shopid,$productId); // Insert Query for shippingdetails table
				
				$grpNameC = $this->input->post('option_group_nameC');
				$grpNameS = $this->input->post('option_group_nameS');
				
				if(!empty($grpNameC)){
					
					if($grpNameC == 1){
						$this->yourshop_model->insertproductvariationsColor($productId); // Insert Query for productvariations table
					}
				}
				
				
				if(!empty($grpNameS)){
					
					if($grpNameS == 2){
						$this->yourshop_model->insertproductvariationsSize($productId); // Insert Query for productvariations table
					}
				}
				
				
				$data['breadcrumb'] = 'Listing your products';
				$data['success_msg'] = '1 product listed successfully';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				$data['sections'] 	= $this->yourshop_model->get_sectiondata();
				
				$this->load->view('page/shop/yourshop',$data);
				
			}else{
			
				$data['breadcrumb'] = 'Listing your products';
				$data['error_msg'] = 'Product Not Yet listed!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				$data['sections'] 	= $this->yourshop_model->get_sectiondata();
				
				$this->load->view('page/shop/yourshop',$data);
			
			}
		}else{
				
				$data['breadcrumb'] = 'Listing your products';
				$data['error_msg'] 	= 'Product Not Yet listed!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				$data['sections'] 	= $this->yourshop_model->get_sectiondata();
				
				$this->load->view('page/shop/yourshop',$data);
			
			}
			
		$this->db->trans_complete();
	}
	
	
	
	
	// Add listing After shop opened
	public function shopproductstock(){
		
		$this->db->trans_start();
		
		if($this->session->userdata('userid') == NULL){
			redirect('page');
		}
			
		$userid = $this->session->userdata('userid');
		
		if( $this->input->post('product_name') !== '' && $this->input->post('product_category_id') !== '' && $this->input->post('product_price') !== '' && $this->input->post('product_stock') !== '' ){
		
			$this->load->library('upload');
			
			extract($this->yourshop_model->get_data_shops($userid));
			
			$productId = $this->yourshop_model->max()+1; // Get Maximum Product ID
			
			$filename = $_FILES["userfile"]["name"];
			
				for($sn=0;$sn<count($filename);$sn++){
					
					$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
					
					$dir_path ="./assets/frontend/images/shops/$sname/";
					
					$file_basename = substr($filename[$sn], 0, strripos($filename[$sn], '.'));
					$file_ext = substr($filename[$sn], strripos($filename[$sn], '.'));
					$path = $dir_path.$productId.'_'.$sn.$file_ext;
					$userfile = $productId.'_'.$sn.$file_ext;
					
					
					if($userfile == $productId.'_'.$sn){
						// Nothing	
					}else{ $pimages[] = $userfile; }
					
					move_uploaded_file($_FILES["userfile"]["tmp_name"][$sn], $path);
					
					$this->img_resize(1087,1087,$sname,$userfile); // resize image after upload
				}
				
			if(!empty($pimages)){
				$fileName = implode(',',$pimages);
			}else{
				$fileName = 'default-img.jpg';
			}
				
			
			if( $shopid !== NULL ){
				
				$this->yourshop_model->insertlistedproduct($shopid,$fileName); // Insert Query for products table
				
				$this->yourshop_model->generateNewListingBill(); // Insert Query for Listing bill, billdetails table
				
				//$this->yourshop_model->insertproductoptions($productId); // Insert Query for productoptions table
				
				$this->yourshop_model->insertshoppinginfo($shopid,$productId); // Insert Query for shippingdetails table
				
				$grpNameC = $this->input->post('option_group_nameC');
				$grpNameS = $this->input->post('option_group_nameS');
				
				if(!empty($grpNameC)){
					
					if($grpNameC == 1){
						$this->yourshop_model->insertproductvariationsColor($productId); // Insert Query for productvariations table
					}
				}
				
				
				if(!empty($grpNameS)){
					
					if($grpNameS == 2){
						$this->yourshop_model->insertproductvariationsSize($productId); // Insert Query for productvariations table
					}
				}
				
				
				$data['breadcrumb'] = 'Listing your products';
				$data['success_msg'] = '1 product listed successfully';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				$data['sections'] 	= $this->yourshop_model->get_sectiondata();
				
				$this->load->view('page/shop/addlisting',$data);
				
			}else{
			
				$data['breadcrumb'] = 'Listing your products';
				$data['error_msg'] = 'Product Not Yet listed!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				$data['sections'] 	= $this->yourshop_model->get_sectiondata();
				
				$this->load->view('page/shop/addlisting',$data);
			
			}
		}else{
				
				$data['breadcrumb'] = 'Listing your products';
				$data['error_msg'] 	= 'Product Not Yet listed!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				$data['sections'] 	= $this->yourshop_model->get_sectiondata();
				
				$this->load->view('page/shop/addlisting',$data);
			
			}
			
		$this->db->trans_complete();
	}
	
	
	
	// load this function
	public function paymentinfosave()
	{
		$this->db->trans_start();
		
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
			
			$userid 		= $this->session->userdata('userid');
			extract($this->yourshop_model->get_data_shops($userid));
			
			if($this->input->post('paymentmethod')==='Paypal'){
				
				$this->yourshop_model->paypalinfosave($userid,$shopid); // Insert payment info
				
				$this->yourshop_model->updateopendshop($userid,$shopid); // Update users table shopopen field info
				$this->yourshop_model->updateshopdone($shopid); // Update Shops table shopdone field info
				
				$data['breadcrumb'] = 'Welcome to '.sitename();
				$data['success_msg'] = 'You opend a shop successfully!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				
				$attr = array(
					'shopdone'				=> 'Done',
					'shopopen'				=> $shopid,
					'shopname'				=> $shop_name,
					'shoplogo'				=> $shoplogo
				);
				// Session set
				$this->session->set_userdata($attr);
				
				
				$data['shoplast6p'] 	= 	$this->user_model->getlast6ProductsbyShopid($this->session->userdata('shopid'),6);
				
				$data['last2items'] 		= $this->page_model->getlastnumberofproducts(2);
				$data['last4items'] 		= $this->page_model->getlastnumberofrandomproducts(4);
				$data['last8items'] 		= $this->page_model->getlastnumberofrandomproducts(8);
				
				$this->load->view('page/user/user', $data); 
				
			}else if($this->input->post('paymentmethod')==='Creditcard'){
				
				$this->yourshop_model->creditcardinfosave($userid,$shopid); // Insert payment info
				
				$this->yourshop_model->updateopendshop($userid,$shopid); // Update users table shopopen field info
				$this->yourshop_model->updateshopdone($shopid); // Update Shops table shopdone field info
				
				$data['breadcrumb'] = 'Welcome to '.sitename();
				$data['success_msg'] = 'You opend a shop successfully!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				
				
				$data['shoplast6p'] 	= 	$this->user_model->getlast6ProductsbyShopid($this->session->userdata('shopid'),6);
				
				$data['last2items'] 		= $this->page_model->getlastnumberofproducts(2);
				$data['last4items'] 		= $this->page_model->getlastnumberofrandomproducts(4);
				$data['last8items'] 		= $this->page_model->getlastnumberofrandomproducts(8);
				
				$this->load->view('page/user/user', $data); 
				
			}else{
				
				$data['breadcrumb'] 	= 'Setting billing informations';
				$data['error_msg'] 		= 'Billing informations not yet completed!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				
				$this->load->view('page/shop/yourshop',$data);
			}
		}
		
		$this->db->trans_complete();
		
	}
	
	

	// load this function
	public function listingmanager()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$data['breadcrumb'] =	'Your Shop - Items';
			
			$this->load->view('page/shop/listingmanager',$data);
		}
		
	}
	
	

	// load this function
	public function shopconfirmclose()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
			$userid = $this->uri->segment(4);
			$shopid = $this->uri->segment(5);
			
			// Shop Block
			$this->yourshop_model->shopcloseblock($userid,$shopid);
			
			// Shop product inactive
			$this->yourshop_model->shopproductinactive($userid,$shopid);
			
			// Shop product inactive
			$this->yourshop_model->shopopennone($userid,$shopid);
			
			return redirect('page/login/logout');
		}
		
	}
	
	

	// load this function
	public function deactivatedlisting()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$data['breadcrumb'] =	'Your Shop - Deactivated Items';
			
			$this->load->view('page/shop/deactivatedlisting',$data);
		}
		
	}
	
	

	// load this function
	public function activatedlisting()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$data['breadcrumb'] =	'Your Shop - Activated Items';
			
			$this->load->view('page/shop/activatedlisting',$data);
		}
		
	}
	
	

	// load this function
	public function listingviews()
	{
		$shopid = $this->session->userdata('shopid');
		return $this->yourshop_model->shoplistingview($shopid);
		
	}
	

	// load this function
	public function shoplistinginactivatedview()
	{
		$shopid = $this->session->userdata('shopid');
		return $this->yourshop_model->shoplistinginactivatedview($shopid,'Inactive');
		
	}
	

	// load this function
	public function shoplistingdeactivatedview()
	{
		$shopid = $this->session->userdata('shopid');
		return $this->yourshop_model->shoplistinginactivatedview($shopid,'Active');
		
	}
	

	// load this function
	public function shoplistingrenewview()
	{
		$shopid = $this->session->userdata('shopid');
		return $this->yourshop_model->shoplistingrenewview($shopid);
		
	}
	
	

	// load this function
	public function listingrenewnow()
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
			
			$this->yourshop_model->getrenewal();
			
			$data['message'] = '<p class="bg-success" id="msg"><i class="fa fa-check-square-o"></i> Thanks, your product has been renewed!</p>';
			$data['breadcrumb'] =	'Renewable product Listings';
			
			$this->load->view('page/shop/listingrenew',$data);
		}
		
	}
	
	

	// Add listing products load this function
	public function addlisting()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
			
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			$userid = $this->session->userdata('userid');
			$data['users'] 		= $this->yourshop_model->get_data($userid);
			$data['sections'] 	= $this->yourshop_model->get_sectiondata();
			
			$data['breadcrumb'] =	'Your Shop - Items Listing';
			
			$this->load->view('page/shop/addlisting',$data);
		}
		
	}
	
	

	// Update Listed products load this function
	public function peditpage()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE){
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}
		$userid = $this->session->userdata('userid');
		$data['users'] = $this->yourshop_model->get_data($userid);
		
		$data['sections'] 	= $this->yourshop_model->get_sectiondata();
	
		$data['success_msg'] 	= 'Product updated successfully';
		$data['breadcrumb'] =	'Your Shop - Edit Listing Items';
		
		$this->load->view('page/shop/editlisting',$data);
	}
	
	
	

	// Update Listed products load this function
	public function pedit()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
			
			$this->form_validation->set_rules('product_name', 'product name', 'trim|required|xss_clean');
			
			$pid 	= $this->uri->segment(4);
			$shopid = $this->uri->segment(5);
			
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			if($this->form_validation->run() == FALSE){
				
				
				$data['sections'] 	= $this->yourshop_model->get_sectiondata();
				
				$data['error_msg'] 	= 'Product didn\'t updated!';
				$data['breadcrumb'] =	'Your Shop - Edit Listing Items';
				
				$this->load->view('page/shop/editlisting',$data);
				
			}else{
				
				$this->db->trans_start();
				
					// Change Listing Imagess
					$productId = $this->uri->segment(4); // Get product id
					
					// Get Shop name
					$userid = $this->session->userdata('userid');
					extract($this->yourshop_model->get_data_shops($userid));
					
					if(!empty($_FILES["userfile"]["name"])){	
						$filename = $_FILES["userfile"]["name"];
						//var_dump($filename);
						//echo 'Input';
					}else{
						$filename = $this->input->post('usrfile');
						/*for($sn=0;$sn<count($filename);$sn++){
							echo $filename[$sn];
						}*/
						//echo 'Input File';
						//var_dump($filename);
					}
					//die();
						for($sn=0;$sn<count($filename);$sn++){
							//echo $sn.' - '.$filename[$sn];
							$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
							
							$dir_path ="./assets/frontend/images/shops/$sname/";
							
							$file_basename = substr($filename[$sn], 0, strripos($filename[$sn], '.'));
							$file_ext = substr($filename[$sn], strripos($filename[$sn], '.'));
							$path = $dir_path.$productId.'_'.$sn.$file_ext;
							$userfile1 = $productId.'_'.$sn.$file_ext;
					
							if($userfile1 == $productId.'_'.$sn){
								// Nothing	
							}else{ $pimages[] = $userfile1; }
							
							// Upload to shop directory
							move_uploaded_file($_FILES["userfile"]["tmp_name"][$sn], $path);
							
							
						$this->img_resize(1087,1087,$sname,$userfile1); // resize image after upload
					
						}
						
						$sqlpop = $this->db->query("select product_image from mega_products where productid=$productId");
						$sqlpopresult = $sqlpop->row_array();
						extract($sqlpopresult);
						
						$pimages2 = explode(',',$product_image);
						
						if(!empty($pimages)){
							
							$fileName = implode(',',$pimages2);
							// Check Image Exist Or Not
							if($product_image == ''){
								$fileName .= implode(',',$pimages);
							}else{
								$fileName .= ','.implode(',',$pimages);
							}
							
							$fileName00[] = $fileName;
							
							$original = implode(',',$fileName00);
							$fieldnames_original = explode(',',$original);
							
							$vv = array();
							
							foreach($fieldnames_original as $v)
							{
								$vv[] = $v;
							}
							$filterimages0 = array_unique($vv);
							//print_r($filterimages);
						}else{
							$fl = $this->input->post('usrfile');
							for($i=0;$i<count($fl);$i++){
								if($fl[$i] == ''){
									break;
								}
								$ffl[] = $fl[$i];
							}
								
							$filterimages0 = array_unique($ffl);
							
						}
						
						$filterimages = implode(",",$filterimages0);
						
						//die();
						
						// Update Listing information's
						$this->yourshop_model->updateshopproduct($pid,$shopid,$filterimages) ; // Product info update
				
					$grpNameC = $this->input->post('option_group_nameC');
					
					// Get Product Variations from mega_productvariations table
					$varitionGet1 = $this->db->query("select * from mega_productvariations where productid=$pid and optiongroupid=$grpNameC");
					
					if($varitionGet1->num_rows() < 0){
						if(!empty($grpNameC)){
							
							if($grpNameC == 1){
								$this->yourshop_model->insertproductvariationsColor($pid); // Insert Query for productvariations table
							}
						}
					}else{
						$this->yourshop_model->updateproductvariationsC($pid) ; // Product Options update
					}
				
					$grpNameS = $this->input->post('option_group_nameS');
					
					$varitionGet2 = $this->db->query("select * from mega_productvariations where productid=$pid and optiongroupid=$grpNameS");
					
					if($varitionGet2->num_rows() < 0){
						if(!empty($grpNameS)){
							
							if($grpNameS == 2){
								$this->yourshop_model->insertproductvariationsSize($pid); // Insert Query for productvariations table
							}
						}
					}else{
						$this->yourshop_model->updateproductvariationsS($pid) ; // Product Options update
					}
				
				
				
				$this->yourshop_model->updateproductshipping($pid,$shopid) ; // Product Shipping Info update
				
				$this->db->trans_complete();
				
				
				$data['sections'] 	= $this->yourshop_model->get_sectiondata();
			
				$data['success_msg'] 	= 'Product updated successfully';
				$data['breadcrumb'] =	'Your Shop - Edit Listing Items';
				
				$this->load->view('page/shop/editlisting',$data);
				
			}
		}
		
	}
	
	

	// shoppolicysettings load this function
	public function shoppolicysettings()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
			
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$data['breadcrumb'] =	'Your Shop - Policy settings';
			
			$this->load->view('page/shop/shoppolicysettings',$data);
		}
		
	}
	
	

	// shopprivacypolicysave load this function
	public function shopprivacypolicysave()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$this->yourshop_model->shopprivacypolicysave(); // Save query
			
			$data['success_msg'] 	= 'Shop privacy policy has been saved successfully!';
			$data['breadcrumb'] =	'Your Shop - Privacy policies';
			
			$this->load->view('page/shop/shoppolicysettings',$data);
		}
		
	}
	
	

	// shop vacation mode enable or disable using load this function
	public function vacationupdate()
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
			
			$this->yourshop_model->vacationupdate(); // Update query
			
			$data['success_msg'] 	= 'Shop vacation has been updated successfully!';
			$data['breadcrumb'] =	'Your Shop - Vacation mode updated';
			
			$shpid = $this->session->userdata('shopid');
			
			return redirect('page/yourshop/viewshop/'.$shpid.'/vacationmode',$data);
		}
		
	}
	
	

	// shopprivacypolicyupdate load this function
	public function shopprivacypolicyupdate()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$this->yourshop_model->shopprivacypolicyupdate(); // Save query
			
			$data['success_msg'] 	= 'Shop privacy policy has been updated successfully!';
			$data['breadcrumb'] =	'Your Shop - Privacy policies';
			
			$this->load->view('page/shop/shoppolicysettings',$data);
		}
		
	}
	

	// active shop product load this function
	public function activeproduct()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$this->yourshop_model->activeproduct(); // Save query
			
			$data['success_msg'] 	= 'Product has been activated successfully!';
			$data['breadcrumb'] =	'Your Shop - Product Activated';
			
			$this->load->view('page/shop/deactivatedlisting',$data);
		}
		
	}
	

	// deactive shop product load this function
	public function deactiveproduct()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$this->yourshop_model->deactiveproduct(); // Save query
			
			$data['success_msg'] 	= 'Product has been deactivated successfully!';
			$data['breadcrumb'] =	'Your Shop - Product Deactivated';
			
			$this->load->view('page/shop/activatedlisting',$data);
		}
		
	}
	

	// deactive shop product load this function
	public function listingrenew()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$data['breadcrumb'] =	'Renewable product Listings';
			
			$this->load->view('page/shop/listingrenew',$data);
		}
		
	}
	
	

	// shopsettings load this function
	public function shopsettings()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
			
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$data['breadcrumb'] =	'Your Shop - Apparences settings';
			
			$this->load->view('page/shop/shopsettings',$data);
		}
		
	}
	
	

	// shopsettings load this function
	public function shopsettingsinfosave()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE)
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$this->load->library('upload');
			
			extract($this->yourshop_model->get_data_shops($userid));
			
			$filename1 = $_FILES["logofile"]["name"];
			$filename2 = $_FILES["bannerfile"]["name"];
				
				$sname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', $shop_name))));
				
				$dir_path ="assets/frontend/images/shops/$sname/";
				
				if(empty($filename1)){ $shoplogo = $shoplogo; }else{
					$file_basename1 = substr($filename1, 0, strripos($filename1, '.'));
					$file_ext1= substr($filename1, strripos($filename1, '.'));
					$path1 = $dir_path.'logo_'.$shopid.$file_ext1;
					$shoplogo = 'logo_'.$shopid.$file_ext1;
					
					move_uploaded_file($_FILES["logofile"]["tmp_name"], $path1);
					//$this->img_resize(250,250,$sname,$shoplogo);
					$this->img_resize(250,250,$sname,$shoplogo); // resize image after upload
				}
				
				if(empty($filename2)){ $shopbanner = $shopbanner; }else{
					$file_basename2 = substr($filename2, 0, strripos($filename2, '.'));
					$file_ext2= substr($filename2, strripos($filename2, '.'));
					$path2 = $dir_path.'banner_'.$shopid.$file_ext2;
					$shopbanner = 'banner_'.$shopid.$file_ext2;
					
					move_uploaded_file($_FILES["bannerfile"]["tmp_name"], $path2);
					//$this->img_resize(800,450,$sname,$shopbanner);
					$this->img_resize(1100,170,$sname,$shopbanner); // resize image after upload
				}
			
			// Upload image End
			
			$this->yourshop_model->shopinfoupdate($shoplogo,$shopbanner); // Update query
			
			$data['success_msg'] 	= 'Shop settings has been saved successfully!';
			$data['breadcrumb'] =	'Your Shop - Apparences settings';
			
			$this->load->view('page/shop/shopsettings',$data);
		}
		
	}
	
	
		
	// Update User Profile function
	/*public function productlistingsave() 
	{
		$userid = $this->session->userdata('userid');
		extract($this->yourshop_model->get_data_shops($userid));
		
		
		$this->do_upload($shop_name);
		
		if( $this->upload->do_upload() ){
			
			//$this->yourshop_model->insertlistedproduct($shopid); // Insert into db
			
			$product_image = array();
			$files = $_FILES['images'];
			
			foreach ($files['name'] as $key => $image) {
				$_FILES['product_image[]']['name']= $files['name'][$key];
				$_FILES['product_image[]']['type']= $files['type'][$key];
				$_FILES['product_image[]']['tmp_name']= $files['tmp_name'][$key];
				$_FILES['product_image[]']['error']= $files['error'][$key];
				$_FILES['product_image[]']['size']= $files['size'][$key];
				
				$fileName = 'test' .'_'. $image;
				
				$product_image[] = $fileName;
				
				//$config['file_name'] = $fileName;
				//$this->upload->initialize($config);
				$this->img_resize($shop_name,$this->upload->data($product_image[])); // Image resize	
				
				if ($this->upload->do_upload('product_image[]')) {
					$this->upload->data();
					$this->yourshop_model->insertlistedproduct($shopid);
				} else {
					return false;
				}
			}
			
			return $product_image;
			
			/*$data['breadcrumb'] 	= 'Add to product listing';
			$data['success_msg'] 	= 'Product Listed successfully';
			
			$data['users'] 			= $this->yourshop_model->get_data($userid);
			$this->load->view('page/user/edit_profile',$data);*/
			
		//}else{
			
			/*$data['breadcrumb'] 	= 'Add to product listing';
			$data['error_msg'] 		= 'Product Not Yet Listed!';
			
			$data['users'] 			= $this->yourshop_model->get_data($userid);
			$this->load->view('page/user/edit_profile',$data);*/
			
		//}
		
	//}
        
        
        
    // User SMTP Mail function
	//public function smtpemail($receipent,$from,$reply,$attach,$subject,$message,$attachment)
	public function smtpmail($receipent,$subject,$msg,$displayname,$from,$reply)
	{
		//$this->load->library('email');

		//$message .= '<img width="500" src="'.$attachment.'" alt="'.$attachment.'" />';
		//$attachment = $this->email->attach($attachm);

		// Get full html:
		$body =
				'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
    			<title>'.html_escape($subject).'</title>

			<style type="text/css">

				/* See http://htmlemailboilerplate.com/ */

				/* Based on The MailChimp Reset INLINE: Yes. */
				/* Client-specific Styles */
				#outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
				body {
					width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:40px;
					font-family: Arial, Verdana, Helvetica, sans-serif; font-size: 16px;
				}
				/* End reset */

				/* Some sensible defaults for images
				Bring inline: Yes. */
				img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
				a img {border:none;}

				/* Yahoo paragraph fix
				Bring inline: Yes. */
				p {margin: 1em 0;}

				/* Hotmail header color reset
				Bring inline: Yes. */
				h1, h2, h3, h4, h5, h6 {color: black !important;}

				h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}

				h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
				color: red !important; /* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
				}

				h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
				color: purple !important; /* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */
				}

				/* Outlook 07, 10 Padding issue fix
				Bring inline: No.*/
				table td {border-collapse: collapse;}

				/* Remove spacing around Outlook 07, 10 tables
				Bring inline: Yes */
				table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }

				/* Styling your links has become much simpler with the new Yahoo.  In fact, it falls in line with the main credo of styling in email and make sure to bring your styles inline.  Your link colors will be uniform across clients when brought inline.
				Bring inline: Yes. */
				a {color: blue;}

			</style>

		</head>

		<body>
            <h2>'.$subject.',</h2>
                    
		<h4>Dear '.$displayname.',</h4>

		<p>'.$msg.'</p>

		<h4>----------------------------</h4>
                <h4>Thanks & Regards,</h4>
                <p style="margin:0px !important; padding:0px !important;">
                    '.sitename().'.com <br/>
                    <b>Contact:</b> +1917-703-9134 <br/>
                    <b>Web:</> <a href="http://www.cstisell.com" target="_blank">'.sitename().'</a>
                </p>
		
                <p>Powered by: <a href="http://www.wanitltd.com" target="_blank">Wan IT Ltd.</a></p>

		</body>
		</html>';
		// Also, for getting full html you may use the following internal method:
		//$body = $this->email->full_html($subject, $message);

		$result = $this->email
				->from($from)
				->reply_to('noreply@ctsell.com')    // Optional, an account where a human being reads.
				->to($receipent)
				->subject($subject)
				->message($body)
				->send();

	}

    


}
