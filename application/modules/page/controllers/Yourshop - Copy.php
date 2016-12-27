<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Yourshop extends CI_Controller 
{
	
	public function __construct() 
	{  
            parent:: __construct(); 
			
			//$this->load->library('upload');
			
            // Load models 
            $this->load->model('yourshop_model');
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
		
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$data['breadcrumb'] =	'Your Shop';
			
			$this->load->view('page/shop/yourshop',$data);
		}
		
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
					
					// New Seprate upload directory for each shops
					$dir_exist = true; // flag for checking the directory exist or not
					if (!is_dir('assets/frontend/images/shops/' . $shop_name))
					{
						mkdir('./assets/frontend/images/shops/' . $shop_name, 0777, true);
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
		
		$config['upload_path'] 		= './assets/frontend/images/shops/'.$shopname.'/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png';
			
		$this->load->library('upload', $config);
		
	}
	
	
	
	
	// Image Resize function
	public function img_resize($shopname,$imgName){
		//$config['image_library'] 		= 'gd2';
		echo $config['source_image'] 	= "./assets/frontend/images/shops/$shopname/$imgName";
		$config['create_thumb'] 		= FALSE;
		$config['maintain_ratio'] 		= TRUE;
		$config['quality'] 				= '100%';
		$config['width']         		= 450;
		$config['height']       		= 450;
		
		$this->load->library('image_lib', $config);
		
		if ( ! $this->image_lib->resize())
		{
			echo $this->image_lib->display_errors();
		}else{
			return $this->image_lib->resize();	
		}
	}
	
	
	
	
	// Add listing when shop open
	public function productstock(){
		
		if( $this->input->post('product_name') !== NULL && $this->input->post('product_category_id') !== NULL && $this->input->post('product_price') !== NULL && $this->input->post('product_stock') !== NULL ){
			
			$this->load->library('upload');
			
			$userid = $this->session->userdata('userid');
			extract($this->yourshop_model->get_data_shops($userid));
			
			$productId = $this->yourshop_model->max()+1; // Get Maximum Product ID
			
			$filename = $_FILES["userfile"]["name"];
			
			
			for($sn=0;$sn<count($filename);$sn++){
				
				$dir_path ="./assets/frontend/images/shops/$shop_name/";
				
				$file_basename = substr($filename[$sn], 0, strripos($filename[$sn], '.'));
				$file_ext = substr($filename[$sn], strripos($filename[$sn], '.'));
				$path = $dir_path.$productId.'_'.$sn.$file_ext;
				$userfile = $productId.'_'.$sn.$file_ext;
				
				if($userfile == $productId.'_'.$sn){
					// Nothing	
				}else{ $pimages[] = $userfile; }
				
				move_uploaded_file($_FILES["userfile"]["tmp_name"][$sn], $path);
				
			}
			
			$fileName = implode(',',$pimages);	
			
			if( $shopid !== NULL ){
				
				$this->yourshop_model->insertlistedproduct($shopid,$fileName); // Insert Query for products table
				
				$this->yourshop_model->insertproductoptions($productId); // Insert Query for productoptions table
				
				$this->yourshop_model->insertshoppinginfo($shopid,$productId); // Insert Query for shippingdetails table
				
				
				$data['breadcrumb'] = 'Listing your products';
				$data['success_msg'] = '1 product listed successfully';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				
				$this->load->view('page/shop/yourshop',$data);
				
				}else{
				
				$data['breadcrumb'] = 'Listing your products';
				$data['error_msg'] = 'Product Not Yet listed!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				
				$this->load->view('page/shop/yourshop',$data);
				
			}
		}else{
			
				$data['breadcrumb'] = 'Listing your products';
				$data['error_msg'] 	= 'Product Not Yet listed!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				
				$this->load->view('page/shop/addlisting',$data);
			
			}
	}
	
	
	// Add listing After shop opened
	public function shopproductstock(){
		
		if( $this->input->post('product_name') !== NULL && $this->input->post('product_category_id') !== NULL && $this->input->post('product_price') !== NULL && $this->input->post('product_stock') !== NULL ){
		
			$this->load->library('upload');
			
			$userid = $this->session->userdata('userid');
			extract($this->yourshop_model->get_data_shops($userid));
			
			$productId = $this->yourshop_model->max()+1; // Get Maximum Product ID
			
			$filename = $_FILES["userfile"]["name"];
			
			
			for($sn=0;$sn<count($filename);$sn++){
				
				$dir_path ="./assets/frontend/images/shops/$shop_name/";
				
				$file_basename = substr($filename[$sn], 0, strripos($filename[$sn], '.'));
				$file_ext = substr($filename[$sn], strripos($filename[$sn], '.'));
				$path = $dir_path.$productId.'_'.$sn.$file_ext;
				$userfile = $productId.'_'.$sn.$file_ext;
				
				if($userfile == $productId.'_'.$sn){
					// Nothing	
				}else{ $pimages[] = $userfile; }
				
				move_uploaded_file($_FILES["userfile"]["tmp_name"][$sn], $path);
				
			}
			
			$fileName = implode(',',$pimages);	
			
			if( $shopid !== NULL ){
				
				$this->yourshop_model->insertlistedproduct($shopid,$fileName); // Insert Query for products table
				
				$this->yourshop_model->insertproductoptions($productId); // Insert Query for productoptions table
				
				$this->yourshop_model->insertshoppinginfo($shopid,$productId); // Insert Query for shippingdetails table
				
				
				$data['breadcrumb'] = 'Listing your products';
				$data['success_msg'] = '1 product listed successfully';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				
				$this->load->view('page/shop/addlisting',$data);
				
			}else{
			
				$data['breadcrumb'] = 'Listing your products';
				$data['error_msg'] = 'Product Not Yet listed!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				
				$this->load->view('page/shop/addlisting',$data);
			
			}
		}else{
			
				$data['breadcrumb'] = 'Listing your products';
				$data['error_msg'] 	= 'Product Not Yet listed!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				
				$this->load->view('page/shop/addlisting',$data);
			
			}
	}
	
	
	
	// load this function
	public function paymentinfosave()
	{
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
				
				$data['breadcrumb'] = 'Welcome to ctSell';
				$data['success_msg'] = 'You opend a shop successfully!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				
				$attr = array(
					'shopdone'				=> 'Done',
					'shopid'				=> $shopid,
					'shopname'				=> $shop_name,
					'shoplogo'				=> $shoplogo
				);
				// Session set
				$this->session->set_userdata($attr);
				
				$this->load->view('page/user/user', $data); 
				
			}else if($this->input->post('paymentmethod')==='Creditcard'){
				
				$this->yourshop_model->creditcardinfosave($userid,$shopid); // Insert payment info
				
				$this->yourshop_model->updateopendshop($userid,$shopid); // Update users table shopopen field info
				$this->yourshop_model->updateshopdone($shopid); // Update Shops table shopdone field info
				
				$data['breadcrumb'] = 'Welcome to ctSell';
				$data['success_msg'] = 'You opend a shop successfully!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				
				$this->load->view('page/user/user', $data); 
				
			}else{
				
				$data['breadcrumb'] 	= 'Setting billing informations';
				$data['error_msg'] 		= 'Billing informations not yet completed!';
				$data['users'] 			= $this->yourshop_model->get_data($userid);
				
				$this->load->view('page/shop/yourshop',$data);
			}
		}
		
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
		
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$data['breadcrumb'] =	'Your Shop - Items';
			
			$this->load->view('page/shop/listingmanager',$data);
		}
		
	}
	
	

	// load this function
	public function listingviews()
	{
		$shopid = $this->session->userdata('shopid');
		return $this->yourshop_model->shoplistingview($shopid);
		
	}
	
	

	// load this function
	public function addlisting()
	{
		// Check user session
		if($this->session->userdata('isLogin') == FALSE) 
		{ 
			
			$data['breadcrumb'] =	'Your Shop';
			$this->load->view('page/user/login-form', $data); // It's active when hacking attempt.
			
		}else{
		
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->yourshop_model->get_data($userid);
			
			$data['breadcrumb'] =	'Your Shop - Items Listing';
			
			$this->load->view('page/shop/addlisting',$data);
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
                    ctSell.com <br/>
                    <b>Contact:</b> +1917-703-9134 <br/>
                    <b>Web:</> <a href="http://www.ctsell.com" target="_blank">ctSell</a>
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
