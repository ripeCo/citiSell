<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Login extends CI_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();
		
		//MY_Output class's nocache() method
        $this->output->nocache();
		
		// Load models
		$this->load->model('login_model');
		$this->load->model('user_model');
		$this->load->model('page_model');
	}
	
	// Default load this function
	public function index()
	{
		// Check user session at first
		$session = $this->session->userdata('isLogin');
		if($session == FALSE)
		{
			$data['breadcrumb'] = 'User Login Area !';
			$this->load->view('page/user/login-form', $data); 
		} 
		else 
		{
			$data['breadcrumb'] = 'Welcome to '.sitename();
			$data['Welcome']	= 'Welcome';
			$this->load->view('page/user/user', $data); 
		}
	}
	
	// User login function
	public function dologin()
	{
		// field name, error message, validation rules
		$this->form_validation->set_rules('user_email', 'user email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('user_password', 'password', 'trim|required|md5|xss_clean');
		
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
				
				if($this->login_model->shopuser_exists($this->session->userdata('userid'))){
					extract($this->login_model->getByidshopinfo($this->session->userdata('userid')));
					$attrr = array(
						'shopdone'				=> 'Done',
						'shopid'				=> $shopid,
						'shopname'				=> $shop_name,
						'shoplogo'				=> $shoplogo
					);
					// Session set
					$this->session->set_userdata($attrr);
				}
				
				$this->login_model->login_time(); // Update login time
				
				$data['breadcrumb'] = 'Welcome to '.sitename();
				
				$data['shoplast6p'] 	= 	$this->user_model->getlast6ProductsbyShopid($this->session->userdata('shopid'),6);
			
				$data['last2items'] 		= $this->page_model->getlastnumberofproducts(2);
				$data['last8items'] 		= $this->page_model->getlastnumberofrandomproducts(8);
				$data['last60items'] 		= $this->page_model->getlastnumberofrandomproducts(60);
				
				$this->login_model->login_time(); // Update login time
				
				$this->load->view('page/user/user', $data);
				
				//$this->smtpmail('rony@wanitbd.com','Test Subject','Test Message','rony@wanitbd.com','rony@wanitbd.com','http://ead123.com/multi2/upload/images/promo/0/banner_1.jpg');
				
			}
			else 
			{
			 	$this->session->set_flashdata('login_error', "Username or password didn't match!.");
				$this->index();
			}
		}  
	}
	
	// User Checkout login function
	public function dochklogin()
	{
		// field name, error message, validation rules
		$this->form_validation->set_rules('user_email', 'user email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('user_password', 'password', 'trim|required|md5|xss_clean');
		
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
				
				if($this->login_model->shopuser_exists($this->session->userdata('userid'))){
					extract($this->login_model->getByidshopinfo($this->session->userdata('userid')));
					$attrr = array(
						'shopdone'				=> 'Done',
						'shopid'				=> $shopid,
						'shopname'				=> $shop_name,
						'shoplogo'				=> $shoplogo
					);
					// Session set
					$this->session->set_userdata($attrr);
				}
				
				$this->login_model->login_time(); // Update login time
				
				$data['breadcrumb'] = 'Welcome to '.sitename();
				
				$data['shoplast6p'] 	= 	$this->user_model->getlast6ProductsbyShopid($this->session->userdata('shopid'),6);
			
				$data['last2items'] 		= $this->page_model->getlastnumberofproducts(2);
				$data['last4items'] 		= $this->page_model->getlastnumberofrandomproducts(4);
				$data['last8items'] 		= $this->page_model->getlastnumberofrandomproducts(8);
				
				
				// Load page model
				$data['last2items'] 		= $this->page_model->getlastnumberofproducts(2);
				$data['last4items'] 		= $this->page_model->getlastnumberofrandomproducts(8);
				$data['last5items'] 		= $this->page_model->getlastnumberofrandomproducts(5);
				
				//echo $this->page_model->totalrecommaddeduiprecords();
				
				if($this->page_model->totalrecommaddeduiprecords($_SERVER['REMOTE_ADDR']) >0){
					
					$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproductsbyUserip($_SERVER['REMOTE_ADDR'],20);
					
				}else{
					$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproducts(20);
				}
				
				$this->login_model->login_time(); // Update login time
				
				$data['message'] = '<p class="bg-success" id="msg"><i class="fa fa-times-circle"></i> Login successfully</p>';
				
			
				$this->load->view('page/cart', $data);
				
				//$this->smtpmail('rony@wanitbd.com','Test Subject','Test Message','rony@wanitbd.com','rony@wanitbd.com','http://ead123.com/multi2/upload/images/promo/0/banner_1.jpg');
				
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

	
	
    
    // Update Password function
    public function changeuserpass(){
        
		$currentpass      	= $this->input->post('currentpassword'); // get current password
        $newpass    		= $this->input->post('newpassword'); // Get New Passworrd
        $newcnfpass    		= $this->input->post('confirmnewpassword'); // Get New Confirm Passworrd
        $userid	    		= $this->input->post('userid'); // Get userid for update
		
		extract($this->login_model->getByid($userid));

        if($user_password !== md5($currentpass)){
            
            //  If go wrong
            $data['breadcrumb']     = 'Change Password';
            $data['error_msg']      = 'Current password didn\'t Match with database!';
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->user_model->get_data($userid);
			
            $this->load->view('page/setting',$data); 
			
            
        }else{
           
		   // If Go Success
            $data['breadcrumb']     = 'Change Password';
            $data['success_msg']    = 'Password has been changed!';
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->user_model->get_data($userid);
			
            $this->login_model->updatepass($userid,$newpass);
            $this->load->view('page/setting',$data);
            
        }
        
    }

	
	
    
    // Update User Email function
    public function changeuseremail(){
        
		$this->form_validation->set_rules('newemail','Email','trim|required|valid_email'); // removed is_unique
		$this->form_validation->set_rules('confirmemail','Email','trim|required|valid_email'); // removed is_unique
		
		$currentpass      	= $this->input->post('currentpassword'); // get current password
        $newemail    		= $this->input->post('newemail'); // Get New email
        $newcnfemail    	= $this->input->post('confirmemail'); // Get New Confirm email
        $userid	    		= $this->input->post('userid'); // Get userid for update
		
		extract($this->login_model->getByid($userid));

        if($user_password !== md5($currentpass)){
            
            //  If go wrong
            $data['breadcrumb']     = 'Change Email';
            $data['error_msg']      = 'Current password didn\'t Match with database!';
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->user_model->get_data($userid);
			
            $this->load->view('page/setting',$data);
			
            
        }else if($newemail !== $newcnfemail){
           
		   // If Go Wrong
            $data['breadcrumb']     = 'Change Email';
            $data['success_msg']    = 'Confirm email didn\'t Match!';
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->user_model->get_data($userid);
			
            $this->load->view('page/setting',$data);
            
        }else{
           
		   // If Go Success
            $data['breadcrumb']     = 'Change Email';
            $data['success_msg']    = 'Your email address has been changed!';
			
			$userid = $this->session->userdata('userid');
			$data['users'] = $this->user_model->get_data($userid);
			
            $this->login_model->updateemail($userid,$newemail);
			
			// Email sendings
                    
			$receipent      = $newemail;
			$subject        = 'Your email has been changed!';
			
			$displayname 	= $display_name;
			
			$msg            = 'Congratulation\'s! Your email has been changed. <br/>';
			$msg 			.= '<br/>';
			$msg 			.= '<b>Your New Email Address is :</b>'. $newemail;
			
			$from           = sitename(). emailfrom();
			$reply          = emailreplyto();

			$this->smtpmail($receipent,$subject,$msg,$displayname,$from,$reply); // Email send for Account Verified email
			
			
            $this->load->view('page/setting',$data);
            
        }
        
    }
	
	
    
    // Random Password Generator
    public function randomPassword($max) {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $max; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
	
	
    
    // Email Exist Check Function
    public function resetpass() {
      
      $this->form_validation->set_rules('user_email','Email','trim|required|valid_email'); // removed is_unique
	  
	  $key 			= $this->input->post('user_email');
	  
	  
      if($this->login_model->mail_exists($key)){
		  
			if(!empty($key)){
			  extract($this->login_model->getByKey($key,'Active')); // Get user Display Name by user_email
			}
        
        $data['breadcrumb'] 	= 'Recovery Forgot Password!';
        $data['success_msg'] 	= 'Password has been recovered,check your email!';
			
		$userid = $this->session->userdata('userid');
		$data['users'] = $this->user_model->get_data($userid);
        
        $pass 		= $this->randomPassword(8);
        $newpass 	= md5($pass);
		
        $this->login_model->recoverpass($key,$newpass);
		//die();
		// Email sendings
                    
			$receipent      = $key;
			$subject        = 'Your password has been recovered!';
			
			$displayname 	= $display_name;
			
			$msg            = 'Congratulation\'s! Your password has been recovered. Thanks for staying with '.sitename();
			$msg            = '<br/>';
			$msg 			.= 'Recovery password has been recovered.<br/>';
			$msg 			.= '<b>Your Email is :</b>'. $key;
			$msg 			.= '<b>Your New Password is :</b>'. $pass;
			
			$from           = sitename(). emailfrom();
			$reply          = emailreplyto();

			$this->smtpmail($receipent,$subject,$msg,$displayname,$from,$reply); // Email send for Account Verified email
				
        $this->load->view('page/user/login-form', $data);
        
      }else{
        
        $data['breadcrumb'] 	= 'Recovery Forgot Password!';
        $data['error_msg'] 		= 'Sorry your email doesn\'t exist for password recovery!';
			
		$userid = $this->session->userdata('userid');
		$data['users'] = $this->user_model->get_data($userid);
			
        $this->load->view('page/user/login-form', $data);
        
      }
      
    }
    
	
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
		$dbname = sitename().'_shopPortal_dbBackup_'.date('d-m-Y');
		force_download("$dbname.zip", $backup);
	}
	
	function checkuser(){
		$email = $this->input->post('user_email');
		$password = $this->input->post('user_password');
		
		$result = array("status"=>'ok', 'usernm' => $email);
		echo json_encode($result);
	}

	// Logout function 
	public function logout() 
	{
		$data['breadcrumb'] = 'Welcome to '.sitename();
		$data['Welcome']	= 'Welcome';
		
		$this->login_model->logout_time(); // Update logout time
		
		//$this->session->sess_destroy();
		$sessionArray = array('userid','useremail','first_name','last_name','displayname','usergender','user_picture','user_email_verified','user_country','userregistrationdate','logininfo','shopopen','userstatus');
		$this->session->sess_destroy($sessionArray);
		
		redirect('page');
		
		//$this->load->view('page/index');
	}

}
