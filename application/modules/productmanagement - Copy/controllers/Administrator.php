<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Administrator extends CI_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();
		// Load models
		$this->load->model('login_model');
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
			$data['breadcrumb'] = 'Dashboard';
			$this->load->view('dashboard/dashboard', $data);
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
				$this->smtpmail('rony@wanitbd.com','Test Subject','Test Message','rony@wanitbd.com','rony@wanitbd.com','http://ead123.com/multi2/upload/images/promo/0/banner_1.jpg');
				
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
    
    // Password Change by User function
    public function changepass(){
        $data['breadcrumb'] = 'Update User Password';
        $this->load->view('administrator/dashboard/changepass',$data);
        
    }
    
    // Update Password function
    public function updatepass(){
        $email      = $this->input->post('useremail'); // removed is_unique
        $newpass    = $this->input->post('password'); // removed is_unique

        if($email !== ''){
            
            // If Go Success
            $data['breadcrumb']     = 'Update User Password';
            $data['success_msg']    = 'Password has been updated!';
            $this->login_model->updatepass($email,$newpass);
            $this->load->view('administrator/dashboard/changepass',$data);
            
        }else{
           //  If go wrong
            $data['breadcrumb']     = 'Update User Password';
            $data['error_msg']      = 'Password didn\'t updated!';
            $this->load->view('administrator/dashboard/changepass',$data); 
            
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
    
    // Password Recovery Function
    public function resetpass() {
      
      $key = $this->form_validation->set_rules('useremail','Email','trim|required|valid_email'); // removed is_unique
      
      //$this->rolekey_exists($key);
      $this->rolekey_exists($key);
      
    }
    
    // Email Exist Check Function
    public function rolekey_exists($key) {
      
      global $key;
      if($this->login_model->mail_exists($key)){
        
        $data['breadcrumb'] = 'Administrator Login';
        $data['success_msg'] = 'Password has been recovered,check email!';
        
        $pass = $this->randomPassword(8);
        $newpass = md5($pass);
        $this->login_model->recoverpass($key,$newpass);
        
        
        $msg = 'Your password has been recovered.<br/>';
        $msg .= 'Your password has been recovered.<br/> <b>Your Email is :</b>'. $key;
        $msg .= 'Your password has been recovered.<br/> <b>Your New Password is :</b>'. $pass;
        
        $this->smtpmail('rony@wanitbd.com','Password recovered!',$msg,'rony@wanitbd.com','rony@wanitbd.com','http://ead123.com/multi2/upload/images/promo/0/banner_1.jpg');
				
        $this->load->view('administrator/login/login-form', $data);
        
      }else{
        
        $data['breadcrumb'] = 'Administrator Login';
        $data['error_msg'] = 'Sorry your email doesn\'t exist !!';
        $this->load->view('administrator/login/login-form', $data);
        
      }
      
    }
    
	
	// User SMTP Mail function
	//public function smtpmail($receipent,$from,$reply,$attach,$subject,$message)
	public function smtpmail($receipent,$subj,$msg,$from,$reply,$attach)
	{
		$this->load->library('email');

		$subject = $subj;
		$message = '<p>'.$msg.'</p>';
		$message .= '<img width="500" src="'.$attach.'" alt="'.$attach.'" />';
		$attachm = $this->email->attach($attach);

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
		<h4>Dear Xxx,</h4>
		
		<p>'.$message.'</p>
		
		<h4>----------------------------</h4>
		<h4>Regards,</h4>
		<p>Md Salahuddin Khan</p>
		<p>Sr.Web & Application Developer</p>
		<p>Mobile: +880-1821-720819, +880-1917-827230</p>
		<p>Skype: rony_khan2</p>
		<p>
			<a href="http://www.wanitltd.com" targer="_blank" title="Wan IT LTD.">Wan IT LTD.</a>
		</p>
		
		</body>
		</html>';
		// Also, for getting full html you may use the following internal method:
		//$body = $this->email->full_html($subject, $message);

		$result = $this->email
		->from($from)
		->reply_to($reply)    // Optional, an account where a human being reads.
		->to($receipent)
		->subject($subject)
		->message($body,$attachm)
		->send();

		//var_dump($result);
		//echo '<br />';
		//echo $this->email->print_debugger();
		//exit;
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
		$dbname = 'ctSell_shopPortal_dbBackup_'.date('d-m-Y');
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
