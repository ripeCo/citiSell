<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class Page extends CI_Controller
{

	public function __construct()
	{
		parent:: __construct();
		
		// Load models 
		$this->load->model('navigation_model');
		$this->load->model('page_model');
		
	}
	

	// Default load this function
	public function index()
	{
		$data['breadcrumb'] =	sitename().' :: '.sitetitle();
		
		$data['last2items'] 		= $this->page_model->getlastnumberofproducts(2);
		$data['last4items'] 		= $this->page_model->getlastnumberofrandomproducts(8);
		
		$data['alllitems'] 			= $this->page_model->getallcatproducts(80);
		
		//echo $this->page_model->totalrecommaddeduiprecords();
		
		if($this->page_model->totalrecommaddeduiprecords($_SERVER['REMOTE_ADDR']) >0){
			
			$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproductsbyUserip($_SERVER['REMOTE_ADDR'],20);
			
		}else{
			
			$data['last12items'] 	= $this->page_model->getlastnumberofrecommandedomproducts(20);
			
		}
		
		$this->load->view('page/index',$data);
	}
	
	
	// aboutus function
	public function about() 
	{
		$pagename = $this->uri->segment(2);
		$data['pagecontents'] = $this->page_model->pagecontents($pagename);
		
		$data['breadcrumb'] = 'About '.sitename();
		$this->load->view('page/pagecms',$data);
	}
	
	
	// FAQS function
	public function faq() 
	{
		$pagename = $this->uri->segment(2);
		$data['pagecontents'] = $this->page_model->pagecontents($pagename);
		
		$data['breadcrumb'] = 'FAQS';
		$this->load->view('page/pagecms',$data);
	}
	
	
	// Terms & Condition function
	public function terms() 
	{
		$pagename = $this->uri->segment(2);
		$data['pagecontents'] = $this->page_model->pagecontents($pagename);
		
		$data['breadcrumb'] = 'Terms & Conditions';
		$this->load->view('page/pagecms',$data);
	}
	
	
	// ctSell policy function
	public function ppolicy() 
	{
		$pagename = $this->uri->segment(2);
		$data['pagecontents'] = $this->page_model->pagecontents($pagename);
		
		$data['breadcrumb'] = 'Privecy policy';
		$this->load->view('page/pagecms',$data);
	}
	
	
	// ctSell product category page function
	public function category() 
	{
		$origin 	= $this->uri->segment(2);
		$catname 	= $this->uri->segment(3);
		$catid 		= $this->uri->segment(4);
		
		$data['ppcategory'] 	= $this->page_model->getcategoryproducts($catid,2);
		$data['latestitems'] 	= $this->page_model->getcategoryproducts($catid,1);
		
		$data['allitems'] 		= $this->page_model->getallcatproducts(100);
		
		
		$data['breadcrumb'] = sitename().' :: '.sitetitle();
		$this->load->view('page/product_category',$data);
	}
    
	
	// ctSell product details page function
	public function pdetails() 
	{
		$pid 			= $this->uri->segment(4);
		
		$data['pdetails'] 	= $this->page_model->getproductdetails($pid);
		
		$this->page_model->recommendedproductsave($pid); // Insert user recommended products
		
		$data['breadcrumb'] = sitename().' :: '.sitetitle();
		$this->load->view('page/product_details',$data);
	}
    
	
	// ctSell shipping page function
	public function shipping() 
	{
		/*$pid 			= $this->uri->segment(4);
		$data['pdetails'] 	= $this->page_model->getproductdetails($pid);
		$this->page_model->recommendedproductsave($pid); // Insert user recommended products
		*/
		
		$data['breadcrumb'] = sitename().' :: Shipping';
		$this->load->view('page/shipping',$data);
	}
	
    
	
	// ctSell product review function
	public function preview() 
	{
		if($this->input->post('product_review_details') !== '' && $this->input->post('product_rating') !== ''){
			
			$productid = $this->input->post('productid');
			
			$this->page_model->previewsave();
			
			return redirect("page/pdetails/pid/$productid#previews");
			
		}
	}
	
	
	
	
	/////////////////////////////////////////////////////////
	//					Searching Being
	////////////////////////////////////////////////////////
	 
	 
	// User main searching
	public function mainsearching(){
		
		$this->page_model->mainsearch();
		
	}
	 
	 
	// User main searching results
	/*public function mainsearchresults(){
		
		$origin 	= $this->uri->segment(2);
		$catname 	= $this->uri->segment(4);
		$catid 		= $this->uri->segment(5);
		$searchitem	= $this->uri->segment(6);
		
		$data['ppcategory'] 	= $this->page_model->getcategoryproducts($catid,2);
		$data['latestitems'] 	= $this->page_model->getcategoryproducts($catid,18);
		
		$data['allitems'] 		= $this->page_model->getallcatproducts(10);
		
		
		$data['breadcrumb'] = $searchitem;
		$this->load->view('page/searchresults',$data);
		
	}*/
	 
	 
	// User main searching results
	public function mainsearchresults($offset=0){
  
		$origin 	= $this->uri->segment(2);
		$page 		= $this->uri->segment(3);
		$pagenum 	= $this->uri->segment(4);
		$catname 	= $this->uri->segment(5);
		$catid 		= $this->uri->segment(6);
		$sectionid 	= $this->uri->segment(9);
		
		
		$searchitem	= ucfirst($this->uri->segment(5)) .'-'. ucfirst($this->uri->segment(8));
		
		$perpagerecords = perpagerecords();
		
		if( $this->uri->segment(5) == NULL){
			
			$config['total_rows'] = $this->page_model->totalrecords();
			
			$config['base_url'] = base_url()."page/mainsearchresults/category/0";
			$config['uri_segment'] = '5';
			
		}else{
			
			$config['total_rows'] 		= $this->page_model->getsearchtotalrecords();
			$data['categorynumrow'] 	= $this->page_model->getsearchtotalrecords();
			
			$pname = str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $this->uri->segment(7)))))))));
			
			if($this->uri->segment(8)== NULL){$sectionname = '&nbsp;';}else{$sectionname = $this->uri->segment(8);}
			
			if($this->uri->segment(9)== NULL){$sectionid = '&nbsp;';}else{$sectionid = $this->uri->segment(9);}
			
			$config['base_url'] = base_url()."page/mainsearchresults/category/0/".str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $this->uri->segment(5))))))))).'/'.$this->uri->segment(6).'/'.$pname.'/'.$sectionname.'/'.$sectionid;
			
			$config['uri_segment'] = '10';
			
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

		if( $this->uri->segment(6) == NULL){
			
			$query = $this->page_model->getsearchrecords($perpagerecords,$this->uri->segment(10));

			$data['allitem'] = null;

			if($query){ $data['allitem'] =  $query; }
			
		}else{
			
			$query = $this->page_model->getsearchrecords($perpagerecords,$this->uri->segment(10));

			$data['allitem'] = null;

			if($query){ $data['allitem'] =  $query; }
			
		}
		

		$data['allcategories'] 		= $this->page_model->getaalcategory(25);
		
		//$data['allitems'] 		= $this->page_model->getallproducts(0,4);

		$data['total_results'] 	= $this->page_model->getsearchtotalrecords();
		
		$data['breadcrumb'] = $searchitem;
		$this->load->view('page/searchresults',$data);
	}
	 
	 
	 
	 
	// User main action searching result
	public function mainactionsearchresult($offset=0){
  
		$origin 	= $this->uri->segment(2);
		$page 		= $this->uri->segment(3);
		$pagenum 	= $this->uri->segment(4);
		$catname 	= $this->uri->segment(5);
		$catid 		= $this->uri->segment(6);
		$sectionid 	= $this->uri->segment(9);
		
		//$searchkey = $this->session->set_userdata($this->input->get('search'));
		if($this->uri->segment(4) == NULL){
			$searchkey = $this->input->get('search');
		}else{
			$searchkey = $this->uri->segment(4);
		}
		
		$searchitem	= 'Citisell search for - '.$searchkey;
		
		
		$perpagerecords = perpagerecords();
		
		if( $this->uri->segment(2) == NULL){
			
			$config['total_rows'] = $this->page_model->totalrecords();
			
			$config['base_url'] = base_url()."page/mainactionsearchresult/0";
			$config['uri_segment'] = '5';
			
		}else{
			
			$config['total_rows'] 		= $this->page_model->getactionsearchtotalrecords();
			$data['categorynumrow'] 	= $this->page_model->getactionsearchtotalrecords();
			
			
			$config['base_url'] = base_url()."page/mainactionsearchresult/0/".$searchkey;
			
			$config['uri_segment'] = '5';
			
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

		if( $this->input->get('search') == NULL){
			
			$query = $this->page_model->getactionsearchrecords($perpagerecords,$this->uri->segment(5));

			$data['allitem'] = null;

			if($query){ $data['allitem'] =  $query; }
			
		}else{
			
			$query = $this->page_model->getactionsearchrecords($perpagerecords,$this->uri->segment(5));

			$data['allitem'] = null;

			if($query){ $data['allitem'] =  $query; }
			
		}
		

		$data['allcategories'] 		= $this->page_model->getaalcategory(25);
		
		//$data['allitems'] 		= $this->page_model->getallproducts(0,4);

		$data['total_results'] 	= $this->page_model->getactionsearchtotalrecords();
		
		$data['breadcrumb'] = $searchitem;
		$this->load->view('page/searchresult',$data);
	}
	 
	
	
	/////////////////////////////////////////////////////////
	//					Searching END
	////////////////////////////////////////////////////////
	
    
	
	
	
	// ctSell product review function
	public function previewload($shopid,$productid) 
	{
		//sanitize post value
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

		//throw HTTP error if page number is not valid
		if(!is_numeric($page_number)){
			header('HTTP/1.1 500 Invalid page number!');
			exit();
		}

		//get current starting point of records
		$position = ($page_number * $item_per_page);

		//Limit our results within a specified range. 
		$results = $this->db->query("select * from mega_productreviews where shopid=$shopid and productid=$productid ORDER BY id DESC LIMIT $position, $item_per_page");
		$showresult = $results->result(); //Execute prepared Query

		//output results from database
		echo '<ul class="page_result">';
		foreach($showresult as $viewResult){ //fetch values
			
			$previewUsersql = $this->db->query("select display_name,user_picture from mega_users where userid=$viewResult->userid");
													
			extract($previewUsersql->row_array());
			
			echo '
				<div class="rate_profile"><!-- Begin: rate_profile -->
                                                
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="rate_pic"><!-- Begin: rate_pic -->
						
						<img src="<?php echo base_url(); ?>assets/frontend/images/users/<?php echo $user_picture; ?>" class="img-responsive img-rounded" alt="<?php echo $display_name; ?> profile picture" />
						
						<h6 class="rate_pic_h6">Reviewed by</h6>
						
						<p class="rate_pic_p">
							
							<a href="#">
								<?php echo $display_name; ?>
							</a>
							
						</p>
						
					</div><!-- End: rate_pic -->
				</div>
				
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
				
					<div class="rate_details"><!-- Begin: rate_details -->
					
						<div class="rate_icon">
						
							<div class="star_rate">
								
								<i class="fa fa-star" style="color:#ffdc1e"></i>
								
								<i class="fa fa-star" style="color:#ffdc1e"></i>
								
								<i class="fa fa-star" style="color:#ffdc1e"></i>
								
								<i class="fa fa-star" style="color:#ffdc1e"></i>
								
								<i class="fa fa-star-half-full" style="color:#ffdc1e"></i>
								
							</div>
							
							<div class="star_ratedate">
								<p class="star_ratedate_p">
									<?php echo $prevviewShow->product_review_date; ?>
								</p>
							</div>
																							
						</div>
						
						<p class="rate_details_p">
							<?php echo $prevviewShow->product_review_details; ?>
						</p>
						
					</div><!-- End: rate_details -->
					
				</div>
				
			</div><!-- End: rate_profile -->
			';	
		}
		echo '</ul>';
		
	}
	
	
	// ctSell product category pagination function
	public function catpaginat($offset=0){
  
		$origin 	= $this->uri->segment(2);
		$page 		= $this->uri->segment(3);
		$pagenum 	= $this->uri->segment(4);
		$catname 	= $this->uri->segment(5);
		$catid 		= $this->uri->segment(6);
		
		$perpagerecords = perpagerecords();
		
		if( $this->uri->segment(6) == NULL){
			
			$config['total_rows'] = $this->page_model->totalrecords();
			
			$config['base_url'] = base_url()."page/catpaginat/category/0";
			$config['uri_segment'] = '5';
			
		}else{
			
			$config['total_rows'] 		= $this->page_model->totalcatrecords($this->uri->segment(6));
			$data['categorynumrow'] 	= $this->page_model->totalcatrecords($this->uri->segment(6));
			
			$config['base_url'] = base_url()."page/catpaginat/category/0/".str_replace("&","and",strtolower(str_replace(' ', '-', str_replace("'", '', str_replace(',', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', $this->uri->segment(5))))))))).'/'.$this->uri->segment(6);
			
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

		if( $this->uri->segment(6) == NULL){
			
			$query = $this->page_model->getrecords($perpagerecords,$this->uri->segment(5));

			$data['allitem'] = null;

			if($query){ $data['allitem'] =  $query; }
			
		}else{
			
			$query = $this->page_model->getcatrecords($this->uri->segment(6),$perpagerecords,$this->uri->segment(7));

			$data['allitem'] = null;

			if($query){ $data['allitem'] =  $query; }
			
		}
		

		$data['allcategories'] 		= $this->page_model->getaalcategory(25);
		
		//$data['allitems'] 		= $this->page_model->getallproducts(0,4);

		
		$data['breadcrumb'] = sitename().' :: '.sitetitle();
		$this->load->view('page/allcategories',$data);
	 }
	
    
	
	// ctSell product sub category page function
	public function subcategory() 
	{
		$origin 	= $this->uri->segment(2);
		$catname 	= $this->uri->segment(3);
		$subcatname = $this->uri->segment(5);
		$catid 		= $this->uri->segment(4);
		
		$data['ppcategory'] 	= $this->page_model->getcategoryproducts($catid,2);
		$data['latestitems'] 	= $this->page_model->getcategoryproducts($catid,9);
		$data['allitems'] 		= $this->page_model->getallcatproducts(50);
		
		//$data['breadcrumb'] = ucfirst($catname). ' &NestedGreaterGreater; ' .$subcatname. ' - ctSell';
		$data['breadcrumb'] = sitename().' :: '.sitetitle();
		$this->load->view('page/sub_category',$data);
	}
	
    
	
	// ctSell product sub category page function
	public function subcategorylev2() 
	{
		$origin 	= $this->uri->segment(2);
		$catname 	= $this->uri->segment(3);
		$subcatname = $this->uri->segment(5);
		$catid 		= $this->uri->segment(4);
		
		$data['ppcategory'] 	= $this->page_model->getcategoryproducts($catid,2);
		$data['latestitems'] 	= $this->page_model->getcategoryproducts($catid,9);
		$data['allitems'] 		= $this->page_model->getallcatproducts(50);
		
		//$data['breadcrumb'] = ucfirst($catname). ' &NestedGreaterGreater; ' .$subcatname. ' - ctSell';
		$data['breadcrumb'] = sitename().' :: '.sitetitle();
		$this->load->view('page/sub_category',$data);
	}
	
	
	
	
	
	
	
	
	
	// load this function
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
				$emails[]     = $results->UserEmail;
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
		$from   	= emailfrom();
		$reply    	= emailreplyto();

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
