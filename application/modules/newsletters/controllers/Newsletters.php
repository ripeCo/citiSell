<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Newsletters extends CI_Controller
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
		$this->load->model('newsletters_model');
	}

	// Default load this function
	public function newsmail()
	{
		$data['breadcrumb'] = 'Send Subscriber Newsletter';
		$this->load->view('newsletters/email/send',$data);
	}


	// Default load this function
	public function newslettersend()
	{
		if( $this->input->post('sendto') == 'Users' ){

			// Get All Registered Users Email
			$data['viewall'] = $this->newsletters_model->registeredusers('Active');

			$emails = array();
			foreach($data['viewall'] as $results){
				$emails[]     = $results->user_email;
			}
			$receipent     = implode(',',$emails);

		}else{

                    // Get All Subscribers User Email
                    $data['viewall'] = $this->newsletters_model->subscriber(1);

                    $emails = array();
                    foreach($data['viewall'] as $results){
                            $emails[]     = $results->subscribeemail;
                    }
                    $receipent     = implode(',',$emails);
		}

		$subject    = $this->input->post('subject');
		$from           = emailfrom();
                $reply          = emailreplyto();

		/*$config['upload_path'] = './assets/_upload/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|doc|docx|xl|xls|pdf|zip|rar';
                $this->load->library('upload', $config);
                $this->upload->do_upload('attachment');
                $upload_data = $this->upload->data();

                $attachm = $this->email->attach($upload_data['full_path']);*/

		$msg        = $this->input->post('contents');

		//$sendEmail = $this->smtpmail('cisrony@gmail.com',$subject,$msg,$from,$reply);
		$sendEmail = $this->smtpmail($receipent,$subject,$msg,$from,$reply);

		if( $sendEmail == NULL ){

			//  If go Success
			$data['breadcrumb']        = 'Send Subscriber Newsletter';
			$data['success_msg']       = 'Newsletter Send Successfully!';
			$this->load->view('newsletters/email/send',$data);

		}else{
			// If Go Fail
			$data['breadcrumb']     = 'Send Subscriber Newsletter';
			$data['error_msg']      = 'Newsletter didn\'t Send!';
			$this->load->view('newsletters/email/send',$data);
		}

	}



	// User SMTP Mail function
	//public function smtpemail($receipent,$from,$reply,$attach,$subject,$message,$attachment)
	public function smtpmail($receipent,$subject,$msg,$from,$reply)
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
		<h4>Dear Xxx,</h4>

		<p>'.$msg.'</p>

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
				->message($body)
				->send();

		//var_dump($result);
		//echo '<br />';
		//echo $this->email->print_debugger();
		//exit;
	}





}
