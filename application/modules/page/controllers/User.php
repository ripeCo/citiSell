<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class User extends CI_Controller 
{
	public function __construct() 
	{  
            parent:: __construct(); 
            
            // Load models 
            $this->load->model('user_model');
            $this->load->model('page_model');
	}
	
	
	// User Registration function 
	public function userreg() 
	{  
		// field name, error message, validation rules
		
			$this->form_validation->set_rules('user_first_name', 'first name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('user_last_name', 'last name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('user_gender', 'gender', 'trim|required|xss_clean');
			$this->form_validation->set_rules('user_email', 'email', 'trim|required|valid_email|is_unique[users.user_email]|xss_clean');
			//$this->form_validation->set_rules('user_email', 'email', 'trim|required|valid_email|xss_clean');
             $this->form_validation->set_rules('user_password', 'password', 'trim|required|min_length[2]|max_length[40]|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if($this->form_validation->run() == FALSE) 
		{
			$data['breadcrumb'] = 'User registration';
			$data['error_msg'] = 'Your registration couldn\'t completed!';
			
			$this->load->view('page/user/regconfirm',$data);
		} 
		else 
		{
			if(!$this->user_model->mail_exists($this->input->post('user_email'))){ // Email exist check
			
				
				$this->user_model->userreg();
				
				$receipent      = $this->input->post('user_email');
				
				$data['breadcrumb'] 	= 'User Registration';
				$data['success_msg'] 	= 'Your registration completed successfully!';
				$data['slage'] 			= "Please check ($receipent) email inbox for verify your account.";
				
				// Email sendings
				
				
				$displayname    = $this->input->post('user_first_name') .' '. $this->input->post('user_last_name');
				$subject        = sitename().' Registration Successful!';
				
				$verify         = base_url().'page/user/verified/'.$this->db->insert_id();
				
				$msg            = 'Congratulation\'s! for register on "'.sitename().'".com. Your registration successful, so you should verify your account and enjoy more.<br/>';
				$msg            .= '<br/><br/>';
				$msg            .= 'Please Click here to verify account: <a class="btn btn-info btnsmall" href="'.$verify.'" target="_blank">Verify</a><br/><br/>';
				$msg            .= '<br/><br/>';
				$msg            .= '<b>Login User: </b>'. $this->input->post('user_email').'<br/>';
				$msg            .= '<b>Login Password: </b>'. $this->input->post('user_password');
				$from           = sitename(). emailfrom();
				$reply          = emailreplyto();
				
				$this->smtpmail($receipent,$subject,$msg,$displayname,'citisell@citisell.com','citisell@citisell.com'); // Email send for Account Verification link
				
				$this->load->view('page/user/regconfirm',$data);
			}else{
				$data['breadcrumb'] 	= 'User Registration';
				$data['error_msg'] 	= 'Your registration email already exist in "'.sitename().'" database! please try with another.';
				
				$this->load->view('page/user/regconfirm',$data);
			}
			
		}
	} 
    
	
	// Confirm user verification
	public function verified(){
		
		$action     = $this->uri->segment(3);
		$verifyid   = $this->uri->segment(4);
		
		extract($this->user_model->get_data($verifyid));
		
		$this->user_model->verified($verifyid);

		$data['breadcrumb'] 	= 'Account Verification!';
		$data['success_msg'] 	= 'Congratulation\'s! Your account has been verified. Thanks for staying with "'.sitename().'".';
		
		// Email sendings
				
			$receipent      = $user_email;
			$subject        = 'Your "'.sitename().'" Account has been verified!';
			
			$displayname 	= $display_name;

			$msg            = 'Congratulation\'s! Your account has been verified. Thanks for staying with "'.sitename().'".<br/>';
			$from           = sitename(). emailfrom();
			$reply          = emailreplyto();

			$this->smtpmail($receipent,$subject,$msg,$displayname,$from,$reply); // Email send for Account Verified email
		
		$this->load->view('page/user/verifyconfirm',$data);
		
	}
		
		
	// User Profile function
	public function userprofile() 
	{
		$userid = $this->uri->segment(4);
		
		$data['users'] = $this->user_model->get_data($userid);
		$data['favouriteitemsF4'] 	= $this->page_model->getfavcatproducts(0,3);
		$data['favouriteitemsL4'] 	= $this->page_model->getfavcatproducts(4,7);
		$data['favouriteitemsLL4'] 	= $this->page_model->getfavcatproducts(8,11);
		
		$data['breadcrumb'] = 'Profile';
		$this->load->view('page/user/profile', $data);
	}
	 
		
		
	// User Profile function
	public function edituserprofile() 
	{
		if($this->session->userdata('userid') == NULL){
			redirect('page');
		}
			
		$userid = $this->session->userdata('userid');
		// Check return true/false
		if($this->session->userdata('isLogin') == FALSE)
		{ 
			return redirect('page/login/logout');
		}
		
		$data['users'] = $this->user_model->get_data($userid);
		$data['breadcrumb'] = 'Profile Edit';
		$this->load->view('page/user/edit_profile', $data);
	}
	
		
	// User messages (Conversation) function
	public function messages() 
	{
		if($this->session->userdata('isLogin') == FALSE){
			return redirect('page/login/logout');
		}else{
		
			$userid = $this->uri->segment(4);
			//$data['users'] = $this->user_model->get_data($userid);
			
			$data['breadcrumb'] = 'Inbox Messages';
			$this->load->view('page/user/message', $data);
		}
	}
	
		
	// User messages Archive Or Delete function
	public function messagearchiveordelete() 
	{
		
		$this->user_model->messagearchiveordelete();
		
		$data['success_msg'] 	= 'Archived successfully';
		
		$data['breadcrumb'] = 'Archived Messages';
		$this->load->view('page/user/archivedmessages', $data);
	}
	
		
	// User messages Trash function
	public function trashmessages() 
	{
		if($this->session->userdata('isLogin') == FALSE){
			return redirect('page/login/logout');
		}else{
		
			$userid = $this->uri->segment(4);
			//$data['users'] = $this->user_model->get_data($userid);
			
			$data['breadcrumb'] = 'Trash Messages';
			$this->load->view('page/user/trashmessages', $data);
		}
	}
	
		
	// User sent messages (Conversation) function
	public function sentmessages() 
	{
		if($this->session->userdata('isLogin') == FALSE){
			return redirect('page/login/logout');
		}else{
			$userid = $this->uri->segment(4);
			
			//$data['users'] = $this->user_model->get_data($userid);
			$data['breadcrumb'] = 'Sent Messages';
			$this->load->view('page/user/sentmessage', $data);
		}
	}
	
		
	// User sent messages (Conversation) function
	public function unreadmessages() 
	{
		if($this->session->userdata('isLogin') == FALSE){
			return redirect('page/login/logout');
		}else{
			$userid = $this->uri->segment(4);
			
			//$data['users'] = $this->user_model->get_data($userid);
			$data['breadcrumb'] = 'Unread Messages';
			$this->load->view('page/user/unreadmessage', $data);
		}
	}
	
		
	// User sent messages (Conversation) function
	public function archivedmessages() 
	{
		if($this->session->userdata('isLogin') == FALSE){
			return redirect('page/login/logout');
		}else{
			$userid = $this->uri->segment(4);
			
			//$data['users'] = $this->user_model->get_data($userid);
			$data['breadcrumb'] = 'Archived Messages';
			$this->load->view('page/user/archivedmessages', $data);
		}
	}
	
	
	// User Messaging function 
	public function messagesend() 
	{  
		// field name, error message, validation rules
		
		$this->form_validation->set_rules('user_email', 'email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('msgtitle', 'message title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('message', 'message', 'trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if($this->form_validation->run() == FALSE) 
		{
			$data['breadcrumb'] = 'Sent Message';
			$data['error_msg'] = 'Your message send problem!';
			
			$this->load->view("page/user/sentmessage",$data);
		} 
		else 
		{
			if($this->user_model->mail_exists($this->input->post('user_email'))){ // Email exist check
			
				$this->load->library('upload');
				
				$filename = $_FILES["userfile"]["name"];
					
					$randomId = mt_rand();
					
					$dir_path ="./assets/frontend/images/messagefiles/";
					
					$file_basename = substr($filename, 0, strripos($filename, '.'));
					$file_ext = substr($filename, strripos($filename, '.'));
					$path = $dir_path.$randomId.$file_ext;
					$userfile = $randomId.$file_ext;
					
					
					move_uploaded_file($_FILES["userfile"]["tmp_name"], $path);
					
					$this->img_resize2(850,1070,$userfile); // resize image after upload
				
				
				if(!empty($userfile)){
					$msgfileName = $userfile;
				}else{
					$msgfileName = '';
				}
				
				$receiveremail = $this->input->post('user_email');
				
				$sqlGetReceiver = $this->db->query("select userid as usrid from mega_users where user_email='$receiveremail'");
				$sqlFetchReceiver = $sqlGetReceiver->row_array();
				extract($sqlFetchReceiver);
				
				if($this->input->post('senderid') !== $usrid){
					
					$this->user_model->sendusermessage($msgfileName); // Insert query
				
					$data['breadcrumb'] 	= 'Sent Message';
					$data['success_msg'] 	= 'Your message has been send successfully!';
					
					$this->load->view('page/user/sentmessage',$data);
				}else{
					
					$data['breadcrumb'] = 'Sent Message';
					$data['error_msg'] 	= 'May you try to send in your own email.';
					
					$this->load->view('page/user/sentmessage',$data);
					
				}
				
			}else{
				$data['breadcrumb'] = 'Sent Message';
				$data['error_msg'] 	= 'Your receipent email doesn\'t exists! please try again.';
				
				$this->load->view('page/user/sentmessage',$data);
			}
			
		}
	} 
	
	
	// User Messaging Continuing function 
	public function messagecontinue() 
	{  
		if($this->session->userdata('isLogin') == FALSE){
			return redirect('page/login/logout');
		}
		
		// field name, error message, validation rules
		
		$this->form_validation->set_rules('message', 'message', 'trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if($this->form_validation->run() == FALSE) 
		{
			$data['breadcrumb'] = $this->input->post('msgtitle');
			$data['error_msg'] = 'Your message send problem!';
			
			$this->load->view("page/user/writemessage",$data);
		} 
		else 
		{
			
			$this->load->library('upload');
			
			$filename = $_FILES["userfile"]["name"];
				
				$randomId = mt_rand();
				
				$dir_path ="./assets/frontend/images/messagefiles/";
				
				$file_basename = substr($filename, 0, strripos($filename, '.'));
				$file_ext = substr($filename, strripos($filename, '.'));
				$path = $dir_path.$randomId.$file_ext;
				$userfile = $randomId.$file_ext;
				
				
				move_uploaded_file($_FILES["userfile"]["tmp_name"], $path);
				
				$this->img_resize2(850,1070,$userfile); // resize image after upload
			
			
			if(!empty($filename)){
				$msgfileName = $userfile;
			}else{
				$msgfileName = '';
			}
				
				$this->user_model->continuemessage($msgfileName); // Insert query
				
				$cnvid = $this->uri->segment(5);
				$refid = $this->uri->segment(6);
				
				// Get All conversations
				$data['messageHistory'] = $this->user_model->getMessageData($refid);
				
				// Update Message for Read Or Unread
				if($cnvid == $refid){
					$this->user_model->updateMessageStatus1($cnvid);
				}else{
					$this->user_model->updateMessageStatus0($cnvid);
				}
				
				$data['breadcrumb'] 	= 'Write Message';
				
				$data['success_msg'] 	= 'Your message has been send successfully!';
				
				$this->load->view('page/user/writemessage',$data);
				
			
			
		}
	} 
	
	
	// User Number of Message (Conversation) function
	function numberOfMessages() 
	{
		
		$receiverid = $this->session->userdata('userid');
		
		$sqlGetReceiver = $this->db->query("select * from mega_message where receiverid=$receiverid and receivedto=$receiverid and msgstatus='unread'");
		$sqlFetchReceiver = $sqlGetReceiver->row_array();
		
		if($sqlGetReceiver->num_rows() > 0){
			echo $sqlGetReceiver->num_rows();
		}else{
			echo '0';
		}
	} 
	
		
	// User Write messages (Conversation) function
	public function writemessage() 
	{
		if($this->session->userdata('isLogin') == FALSE){
			return redirect('page/login/logout');
		}else{
			
			$cnvid = $this->uri->segment(5);
			$refid = $this->uri->segment(6);
			
			// Get All conversations
			$data['messageHistory'] = $this->user_model->getMessageData($refid);
			
			// Update Message for Read Or Unread
			if($cnvid == $refid){
				$this->user_model->updateMessageStatus1($cnvid);
			}else{
				$this->user_model->updateMessageStatus0($cnvid);
			}
			
			$data['breadcrumb'] = 'Write Messages';
			$this->load->view('page/user/writemessage', $data);
		}
	}
	
	
	
	// File loading function
	public function do_upload(){
		
		$config['upload_path'] 		= './assets/frontend/images/users/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png';
			
		$this->load->library('upload', $config);
		
	}
	
	// Image Resize function
	/*
	public function img_resize($w,$h,$imgName){
		$config['image_library'] 	= 'gd2';
		$config['source_image'] 	= './assets/frontend/images/users/'.$imgName;
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
	
	
	// Image Resize function
	public function img_resize2($w,$h,$imgName){
		$config['image_library'] 	= 'gd2';
		$config['source_image'] 	= './assets/frontend/images/messagefiles/'.$imgName;
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
	*/
		
	// Update User Profile function
	public function updateuserprofile() 
	{
		
		if($this->session->userdata('userid') == NULL){
			redirect('page');
		}
			
		if('assets/frontend/images/users/'.$this->input->post('oldpic')){
			delete_files('assets/frontend/images/users/'.$this->input->post('oldpic')); // Delete Old Picture
		}
		
		$this->do_upload();
		
		$userid = $this->session->userdata('userid');
		
		if( $this->upload->do_upload() ){
			
			$this->user_model->updateprofilewithimg();
			
			//$this->img_resize($this->upload->data('file_name'));
			
			$this->upload->data('file_name');
			
			
			// Get users all information & store in session
			extract($this->user_model->get_data($userid));
			$attrr = array(
				'userid'				=> $userid,
				'useremail'				=> $user_email,
				'first_name'			=> $user_first_name,
				'last_name'				=> $user_last_name,
				'displayname'			=> $display_name,
				'usergender'			=> $user_gender,
				'user_picture'			=> $user_picture,
				'user_email_verified'	=> $user_email_verified,
				'user_country'			=> $user_country,
				'userregistrationdate'	=> $user_registration_date,
				'logininfo'				=> $logininfo,
				'shopopen'				=> $shopopen,
				'userstatus'			=> $user_status
			);
			// Session set
			$this->session->set_userdata($attrr);
			
			
			$data['breadcrumb'] = 'Profile Updated';
			$data['success_msg'] = 'Profile Updated successfully';
			$data['users'] = $this->user_model->get_data($userid);
			$this->load->view('page/user/edit_profile',$data);
			
		}else if( !$this->upload->do_upload() ){
			
			$this->user_model->updateprofile();
			
			// Get users all information & store in session
			extract($this->user_model->get_data($userid));
			$attrr = array(
				'userid'				=> $userid,
				'useremail'				=> $user_email,
				'first_name'			=> $user_first_name,
				'last_name'				=> $user_last_name,
				'displayname'			=> $display_name,
				'usergender'			=> $user_gender,
				'user_email_verified'	=> $user_email_verified,
				'user_country'			=> $user_country,
				'userregistrationdate'	=> $user_registration_date,
				'logininfo'				=> $logininfo,
				'shopopen'				=> $shopopen,
				'userstatus'			=> $user_status
			);
			// Session set
			$this->session->set_userdata($attrr);
			
			$data['breadcrumb'] = 'Profile Updated';
			$data['success_msg'] = 'Profile Updated successfully';
			$data['users'] = $this->user_model->get_data($userid);
			$this->load->view('page/user/edit_profile',$data);
			
		}else{
			
			$data['breadcrumb'] = 'Profile Not Updated';
			$data['error_msg'] = 'Profile Not Updated Yet!';
			$data['users'] = $this->user_model->get_data($userid);
			$this->load->view('page/user/edit_profile',$data);
			
		}
		
	}
	 
	 
	 
		
	// User shop function
	public function shop() 
	{
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->session->userdata('userid');
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		$data['users'] = $this->user_model->get_data($userid);
		$data['breadcrumb'] = 'Shop';
		$this->load->view('page/user/shop', $data);
	}
	
	
	
	
	
	// load this function
	public function userarea()
	{
		if($this->session->userdata('isLogin') == FALSE){
			return redirect('page/login/logout');
		}else{
			$data['breadcrumb'] 	=	'Welcome';
			
			$data['shoplast6p'] 	= 	$this->user_model->getlast6ProductsbyShopid($this->session->userdata('shopid'),6);
			
			$data['last2items'] 		= $this->page_model->getlastnumberofproducts(2);
			$data['last4items'] 		= $this->page_model->getlastnumberofrandomproducts(4);
			$data['last8items'] 		= $this->page_model->getlastnumberofrandomproducts(8);
			$data['last60items'] 		= $this->page_model->getlastnumberofrandomproducts(60);
			
			$this->load->view('page/user/user',$data);
		}
	}
	 

	// load this function
	public function favotites()
	{
		$data['breadcrumb'] =	'Favorites';
		
		$this->load->view('page/favorite',$data);
	}
	
	

	// load this function
	public function setting()
	{
		if($this->session->userdata('userid') == NULL) {
			redirect('page');
		}
			
		$userid = $this->session->userdata('userid');
		$data['users'] = $this->user_model->get_data($userid);
		
		$data['breadcrumb'] =	'Setting\'s';
		
		$this->load->view('page/setting',$data);
	}
	

	// load this function
	public function yourshop()
	{
		if($this->session->userdata('userid') == NULL){
			redirect('page');
		}
			
		$userid = $this->session->userdata('userid');
		
		$data['users'] = $this->user_model->get_data($userid);
		
		$data['breadcrumb'] =	'Your Shop';
		
		$this->load->view('page/yourshop',$data);
	}

	/* Validates only US address.
		@param array address - holds the address to validate
	*/
	private function validateUSaddress(array $address) {
		if ($address['country'] != "USA")
			return [];

		require_once APPPATH . 'third_party/RocketShipIt/autoload.php';

		$av = new \RocketShipIt\AddressValidate('USPS');
		$av->setParameter('toAddr1', $address['addrLine1']);
		if (!empty($address['addrLine2Of1']))
			$av->setParameter('toAddr2', $address['addrLine2Of1']);
		$av->setParameter('toCity', $address['city']);
		$av->setParameter('toState', $address['state']);
		$av->setParameter('toCode', $address['zipcode']);
		$av->setParameter('toExtendedCode', $address['extendedZipcode']);
		return $av->validate();
	}
	

	// load this function
	public function shippingaddress1() {		
		if ($this->session->userdata('userid') == NULL)
			redirect('page');
			
		$userid = $this->session->userdata('userid');
		$country = trim($this->input->post('country1'));
		$state = trim($this->input->post('state1'));
		$city = trim($this->input->post('city1'));
		$addrLine1 = trim($this->input->post('addrLine1'));
		$addrLine2Of1 = trim($this->input->post('addrLine2Of1'));
		$zipcode = trim($this->input->post('zipcode1'));
		$extendedZipcode = trim($this->input->post('extendedZipcode1'));
		$notUSfullAddress = trim($this->input->post('notUSfullAddress1'));
		$preferredAddress = trim($this->input->post('preferredAddress1'));

		if (empty($country)) {
			$data['breadcrumb'] = 'Shipping country';
			$data['error_msg'] 	= 'Please select country.';
			
			$data['users'] 		= $this->user_model->get_data($userid);
			$this->load->view('page/setting',$data);
			return;
		}

		$preferredAddressFromDB = $this->user_model->getPreferredAddress($userid);

		if (empty($preferredAddress) && !$preferredAddressFromDB) {
			$data['error_msg'] 	= 'Please select preferred address.';
			
			$data['users'] 		= $this->user_model->get_data($userid);
			$this->load->view('page/setting',$data);
			return;
		}

		if (trim($country) == "USA") {
			$error = FALSE;

			if (empty($state)) {
				$data['error_msg'] 	= 'Shipping state is empty.';
				$error = TRUE;
			}
			if (empty($city)) {
				$data['error_msg'] 	= 'Shipping city is empty.';
				$error = TRUE;
			}
			if (empty($addrLine1)) {
				$data['error_msg'] 	= 'Shipping address line 1 is empty.';
				$error = TRUE;
			}
			if (empty($zipcode)) {
				$data['error_msg'] 	= 'Shipping zipcode is empty.';
				$error = TRUE;
			}

			if ($error) {
				$data['users'] 		= $this->user_model->get_data($userid);
				$this->load->view('page/setting',$data);
				return;
			}
		}

		$address['country'] = $country;
		$address['state'] = $state;
		$address['city'] = $city;
		$address['addrLine1'] = $addrLine1;
		$address['addrLine2Of1'] = $addrLine2Of1;
		$address['zipcode'] = $zipcode;
		$address['extendedZipcode'] = ($extendedZipcode ? $extendedZipcode : null);
		$address['notUSfullAddress'] = $notUSfullAddress;
		$address['preferredAddress'] = ($preferredAddress ? 1 : 2);

		// before the update check address if valid if country is US
		if ($address['country'] == "USA") {
			$validatedUSAddress = $this->validateUSaddress($address);
			file_put_contents('c:\tmp\address.txt', print_r($validatedUSAddress, TRUE));
			if (!empty($validatedUSAddress['Data']['Errors'])) {	// if there's an error
				file_put_contents('c:\tmp\error_address.txt', print_r($validatedUSAddress, TRUE));

				$data['error_msg'] 	= $validatedUSAddress['Data']['Errors'][0]['Description'];
				$data['users'] 		= $this->user_model->get_data($userid);
				$this->load->view('page/setting',$data);
				return;				
			} else {	// The API returns with corrected address so better use it.
				$address['addrLine1'] = $validatedUSAddress['Data']['Addr1'];
				$address['addrLine2Of1'] = $validatedUSAddress['Data']['Addr2'];
				$address['city'] = $validatedUSAddress['Data']['City'];
				$address['state'] = $validatedUSAddress['Data']['State'];
				$address['zipcode'] = $validatedUSAddress['Data']['ZipCode'];
				$address['extendedZipcode'] = $validatedUSAddress['Data']['ZipCodeAddon'];
			}
		}

		$this->user_model->shippingaddressupdate($userid, $address);

		$data['breadcrumb'] 	= 'Shipping Address';
		$data['success_msg'] 	= 'Shipping address updated successfully';
		
		$data['users'] 			= $this->user_model->get_data($userid);
		$this->load->view('page/setting',$data);		
	}
	

	// load this function
	public function shippingaddress2() {		
		if ($this->session->userdata('userid') == NULL)
			redirect('page');
			
		$userid = $this->session->userdata('userid');
		$country = $this->input->post('country2');
		$state = $this->input->post('state2');
		$city = $this->input->post('city2');
		$addrLine1 = $this->input->post('addrLine1Of2');
		$addrLine2Of2 = $this->input->post('addrLine2Of2');
		$zipcode = $this->input->post('zipcode2');
		$extendedZipcode = $this->input->post('extendedZipcode2');
		$notUSfullAddress = $this->input->post('notUSfullAddress2');
		$preferredAddress = $this->input->post('preferredAddress2');

		if (empty($country)) {
			$data['breadcrumb'] = 'Shipping country';
			$data['error_msg'] 	= 'Please select country.';
			
			$data['users'] 		= $this->user_model->get_data($userid);
			$this->load->view('page/setting',$data);
			return;
		}

		$preferredAddressFromDB = $this->user_model->getPreferredAddress($userid);

		if (empty($preferredAddress) && !$preferredAddressFromDB) {
			$data['error_msg'] 	= 'Please select preferred address.';
			
			$data['users'] 		= $this->user_model->get_data($userid);
			$this->load->view('page/setting',$data);
			return;
		}

		if (trim($country) == "USA") {
			$error = FALSE;

			if (empty($state)) {
				$data['error_msg'] 	= 'Shipping state is empty.';
				$error = TRUE;
			}
			if (empty($city)) {
				$data['error_msg'] 	= 'Shipping city is empty.';
				$error = TRUE;
			}
			if (empty($addrLine1)) {
				$data['error_msg'] 	= 'Shipping address line 1 is empty.';
				$error = TRUE;
			}
			if (empty($zipcode)) {
				$data['error_msg'] 	= 'Shipping zipcode is empty.';
				$error = TRUE;
			}

			if ($error) {
				$data['users'] 		= $this->user_model->get_data($userid);
				$this->load->view('page/setting',$data);
				return;
			}
		}

		$address['country'] = $country;
		$address['state'] = $state;
		$address['city'] = $city;
		$address['addrLine1'] = $addrLine1;
		$address['addrLine2Of2'] = $addrLine2Of2;
		$address['zipcode'] = $zipcode;
		$address['extendedZipcode'] = $extendedZipcode;
		$address['notUSfullAddress'] = $notUSfullAddress;
		$address['preferredAddress'] = ($preferredAddress ? 2 : 1);

		// before the update check address if valid if country is US
		if ($address['country'] == "USA") {
			$validatedUSAddress = $this->validateUSaddress($address);
			file_put_contents('c:\tmp\address.txt', print_r($validatedUSAddress, TRUE));
			if (!empty($validatedUSAddress['Data']['Errors'])) {	// if there's an error
				file_put_contents('c:\tmp\error_address.txt', print_r($validatedUSAddress, TRUE));

				$data['users'] 		= $this->user_model->get_data($userid);
				$this->load->view('page/setting',$data);
				return;				
			} else {	// The API returns with corrected address so better use it.
				$address['addrLine1'] = $validatedUSAddress['Data']['Addr1'];
				$address['addrLine2Of1'] = $validatedUSAddress['Data']['Addr2'];
				$address['city'] = $validatedUSAddress['Data']['City'];
				$address['state'] = $validatedUSAddress['Data']['State'];
				$address['zipcode'] = $validatedUSAddress['Data']['ZipCode'];
				$address['extendedZipcode'] = $validatedUSAddress['Data']['ZipCodeAddon'];
			}
		}

		$this->user_model->shippingaddressupdate2($userid, $address);

		$data['breadcrumb'] 	= 'Shipping Address';
		$data['success_msg'] 	= 'Shipping address updated successfully';
		
		$data['users'] 			= $this->user_model->get_data($userid);
		$this->load->view('page/setting',$data);		
	}
	

	// load this function
	public function signinnotification()
	{
		
		if($this->session->userdata('userid') == NULL){
			redirect('page');
		}
			
		$userid = $this->session->userdata('userid');
		
		
		$this->user_model->securitynotificationupdate($userid);

		$data['breadcrumb'] 	= 'Signin Notification';
		
		if($this->input->post('logininfo') == 1){
			$data['success_msg'] 	= 'Signin notification enabled successfully';
		}else{
			$data['success_msg'] 	= 'Signin notification disabled successfully';
		}
		
		$data['users'] 			= $this->user_model->get_data($userid);
		$this->load->view('page/setting',$data);
		
	}	

	// load this function
	public function signinhistory()
	{
		
		if($this->session->userdata('userid') == NULL){
				redirect('page');
			}
			
		$userid = $this->session->userdata('userid');
		
		
		$this->user_model->signinhistoryupdate($userid);

		$data['breadcrumb'] 	= 'Signin History';
		
		if($this->input->post('loginhistory') == 1){
			$data['success_msg'] 	= 'Signin history enabled successfully';
		}else{
			$data['success_msg'] 	= 'Signin history disabled successfully';
		}
		
		$data['users'] 			= $this->user_model->get_data($userid);
		$this->load->view('page/setting',$data);
		
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
		
		
	// View details user purchase function
	public function purchasedetails() 
	{
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->session->userdata('userid');
		}else{
			$userid 				= $this->uri->segment(4);
			redirect('page');
		}
		
		$data['orderdetails'] = $this->user_model->purchasedetails();
		extract($data['orderdetails']);
		
		$data['breadcrumb'] = $ordernumber.' - Purchase details on '.sitename();
		$this->load->view('page/purchasedetails', $data);
	}
	
	
	 
	// Buyer purchase list view
	public function viewpurchases($offset=0){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
		}else{
			$userid 				= $this->uri->segment(4);
			redirect('page');
		}
		
		/*$sqlshop0 = $this->db->query("select * from mega_shops where shopid=$shopid");
		$sqlshopfetch0 = $sqlshop0->row_array();
		extract($sqlshopfetch0);*/
		
		
		$perpagerecords = 4;
		
		if( $this->uri->segment(6) == NULL){
			
			$config['total_rows'] = $this->user_model->getuserpurchasetotalrecords();
			
			$config['base_url'] = base_url()."page/user/viewpurchases/".$userid;
			$config['uri_segment'] = '5';
			
		}else{
			
			$config['total_rows'] 		= $this->user_model->getuserpurchasetotalrecords();
			$data['categorynumrow'] 	= $this->user_model->getuserpurchasetotalrecords();
			
			
			$config['base_url'] = base_url()."page/user/viewpurchases/".$userid.'/'.$this->uri->segment(5).'/'.$this->uri->segment(6) ;
			
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
			
			$query = $this->user_model->getpurchaserecords($perpagerecords,$this->uri->segment(5));

			$data['allitem'] = null;

			if($query){ $data['allitem'] =  $query; }
			
		}else{
			
			$query = $this->user_model->getpurchaserecords($perpagerecords,$this->uri->segment(6));

			$data['allitem'] = null;

			if($query){ $data['allitem'] =  $query; }
			
		}
		
		
		//$data['allitems'] 		= $this->page_model->getallproducts(0,4);
		if($this->uri->segment(4) !== NULL){
			$data['all_results'] 	= $this->user_model->getuserpurchaseAllrecords();
		}
		
		if($this->uri->segment(4) !== NULL){
			$data['pending_results'] 	= $this->user_model->getuserpurchasetotalrecordsByStatus('Pending');
		}
		
		if($this->uri->segment(4) !== NULL){
			$data['delivered_results'] 	= $this->user_model->getuserpurchasetotalrecordsByStatus('Delivered');
		}
		
		if($this->uri->segment(4) !== NULL){
			$data['cancelled_results'] 	= $this->user_model->getuserpurchasetotalrecordsByStatus('Cancelled');
		}
		
		$data['breadcrumb'] =	'Purchase reviews';
		
		$this->load->view('page/purchasereview',$data);
	}
	
	
	
	
		
	// View details order details function
	public function yourorder() 
	{
		
		if( $this->session->userdata('isLogin') == TRUE){
			$orderid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}else{
			$orderid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
			redirect('page');
		}
		
		$data['orderdetails'] = $this->user_model->yourorderdetails();
		extract($data['orderdetails']);
		
		$data['breadcrumb'] = $ordernumber.' - Order details on '.sitename();
		$this->load->view('page/yourorder', $data);
	}
	
	
	 
	// Shopper orders list view
	public function vieworders($offset=0){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}else{
			$userid 				= $this->uri->segment(4);
			redirect('page');
		}
		
		/*$sqlshop0 = $this->db->query("select * from mega_shops where shopid=$shopid");
		$sqlshopfetch0 = $sqlshop0->row_array();
		extract($sqlshopfetch0);*/
		
		
		$perpagerecords = 3;
		
		if( $this->uri->segment(7) == NULL){
			
			$config['total_rows'] = $this->user_model->getshoptotalorderrecords();
			
			$config['base_url'] = base_url()."page/user/vieworders/".$userid.'/'.$shopid;
			$config['uri_segment'] = '6';
			
		}else{
			
			$config['total_rows'] 		= $this->user_model->getshoptotalorderrecords();
			$data['categorynumrow'] 	= $this->user_model->getshoptotalorderrecords();
			
			
			$config['base_url'] = base_url()."page/user/vieworders/".$userid.'/'.$shopid.'/'.$this->uri->segment(6).'/'.$this->uri->segment(7) ;
			
			$config['uri_segment'] = '8';
			
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

		if($this->uri->segment(7) == NULL){
			
			$query = $this->user_model->getAllUserOedersrecords($perpagerecords,$this->uri->segment(6));

			$data['allitem'] = null;

			if($query){ $data['allitem'] =  $query; }
			
		}else{
			
			$query = $this->user_model->getAllUserOedersrecords($perpagerecords,$this->uri->segment(8));

			$data['allitem'] = null;

			if($query){ $data['allitem'] =  $query; }
			
		}
		
		
		//$data['allitems'] 		= $this->page_model->getallproducts(0,4);
		if($this->uri->segment(4) !== NULL && $this->uri->segment(5) !== NULL){
			$data['all_results'] 	= $this->user_model->getAllShopUserOedersrecords();
		}
		
		if($this->uri->segment(4) !== NULL && $this->uri->segment(5) !== NULL){
			$data['pending_results'] 	= $this->user_model->getOederstotalrecordsByStatus('Pending');
		}
		
		if($this->uri->segment(4) !== NULL && $this->uri->segment(5) !== NULL){
			$data['delivered_results'] 	= $this->user_model->getOederstotalrecordsByStatus('Completed');
		}
		
		if($this->uri->segment(4) !== NULL && $this->uri->segment(5) !== NULL){
			$data['cancelled_results'] 	= $this->user_model->getOederstotalrecordsByStatus('Cancelled');
		}
		
		$data['breadcrumb'] =	'Orders List';
		
		$this->load->view('page/vieworders',$data);
	}      
        
        
    // User SMTP Mail function
	//public function smtpemail($receipent,$from,$reply,$attach,$subject,$message,$attachment)
	public function smtpmail($receipent,$subject,$msg,$displayname,$from,$reply)
	{
		$this->load->library('email');

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
                    <b>Web:</> <a href="http://www.citisell.com" target="_blank">'.sitename().'</a>
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

	public function USStates() {
		$this->load->helper('myhelp');

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(getUSstates()));
	}

	public function USCities($stateISOcode = null) {
		if (!$stateISOcode)
			return;

		$this->load->helper('myhelp');

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(getUScitiesByState($stateISOcode)));	
	}
}
