<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class User_model extends CI_Model 
{
	
	// Get all record from users table
	/*public function index() 
	{
		$this->db->select('*');
		$this->db->from('portalusers');
		
		if($this->session->userdata('type') != 'SuperAdmin')
			$this->db->where('type <>','SuperAdmin');

		$this->db->order_by('PortalUId','ASC');
		$query = $this->db->get();
		return $query->result();
	} */ 

	// Create new record
	public function userreg() 
	{
		$status = 'Pending';
		$date = date('Y-m-d H:i:s');
		$displayname = $this->input->post('user_first_name') .' '. $this->input->post('user_last_name');
		
		if($this->input->post('newsletter') == 1){ $newsletter = 1; }else{ $newsletter = 0; }
                
		$data = array(
			'user_first_name'           => $this->input->post('user_first_name'),  
			'user_last_name'            => $this->input->post('user_last_name'),  
			'display_name'              => $displayname,  
			'user_gender'               => $this->input->post('user_gender'),
			'user_email'                => $this->input->post('user_email'),
            'user_password' 			=> md5($this->input->post('user_password')),
			'user_status'               => $status,
			'user_registration_date'    => $date,  
			'user_modified'             => $date,  
			'userip'                    => $this->input->post('userip'),
			'user_country'              => $this->input->post('user_country'),
			'newsletter'              	=> $newsletter
		);  
		$this->db->insert('users', $data);
	}

	
	// Send user message record
	public function sendusermessage($filename) 
	{
		$attamps 	= 'Send';
		$msgstatus 	= 'unread';
		
		// Get Receiver id query by user email
		$receiveremail = $this->input->post('user_email');
		
		$sqlGetReceiver = $this->db->query("select userid from mega_users where user_email='$receiveremail'");
		$sqlFetchReceiver = $sqlGetReceiver->row_array();
		extract($sqlFetchReceiver);
		
		$receiverid = $userid;
		$receivedto = $userid;
		
		/* server timezone */
		define('CONST_SERVER_TIMEZONE', 'UTC');
		$datetime_variable = new DateTime();
		
		$msgdatetime = date_format($datetime_variable, 'Y-m-d H:i:s');
		$msgdate	 = date('M d, Y');
		
		if($this->input->post('senderid') !== $receiverid){
		 
			$data = array(
				'senderid'			=> $this->input->post('senderid'),  
				'receiverid'		=> $receiverid,  
				'receivedto'		=> $receivedto,  
				'msgtitle'			=> $this->input->post('msgtitle'),
				'message'         	=> $this->input->post('message'),
				'msgfile' 			=> $filename,
				'attamps'        	=> $attamps,
				'msgdatetime'    	=> $msgdatetime,  
				'msgdate'        	=> $msgdate,  
				'msgstatus'      	=> $msgstatus
			);  
			$this->db->insert('message', $data);
		
		}
	}
	
	// User messages Archive Or Delete model
	public function messagearchiveordelete() 
	{
		
		if($this->input->post('msgdelete')){
			// echo 'Delete';
			
			$deleteId = $this->input->post('chkS');
			
			for($d=0;$d<count($deleteId);$d++){
				
				//echo $archiveId[$a].'<br/>';
				
				$status = 'Delete';
				$updateid = $deleteId[$d];

				$data = array(
					'msgstatus'         => $status
				);  

				$this->db->where('conversationid', $updateid);
				$this->db->update('message', $data);
			}
			
		}
		
		
		if($this->input->post('msgarchive')){
			//echo 'Archive';
			
			$archiveId = $this->input->post('chkS');
			
			for($a=0;$a<count($archiveId);$a++){
				
				//echo $archiveId[$a].'<br/>';
				
				$status = 'Archive';
				$updateid = $archiveId[$a];

				$data = array(
					'msgstatus'         => $status
				);  

				$this->db->where('conversationid', $updateid);
				$this->db->update('message', $data);
			}
			
		}
		
	}

	
	// Send user message continue record
	public function continuemessage($filename) 
	{
		$attamps 	= 'Send';
		$msgstatus 	= 'unread';
		
		
		/* server timezone */
		define('CONST_SERVER_TIMEZONE', 'UTC');
		$datetime_variable = new DateTime();
		
		$msgdatetime = date_format($datetime_variable, 'Y-m-d H:i:s');
		$msgdate	 = date('M d, Y');
		
		
			$data = array(
				'senderid'			=> $this->input->post('senderid'),  
				'receiverid'		=> $this->input->post('receiverid'),  
				'receivedto'		=> $this->input->post('receiverid'),  
				'refid'				=> $this->input->post('refid'),  
				'msgtitle'			=> '',
				'message'         	=> $this->input->post('message'),
				'msgfile' 			=> $filename,
				'attamps'        	=> $attamps,
				'msgdatetime'    	=> $msgdatetime,  
				'msgdate'        	=> $msgdate,  
				'msgstatus'      	=> $msgstatus
			);  
			$this->db->insert('message', $data);
		
	}
	
	
    
    // Email Exist Checking Model Function
    public function mail_exists($key)
    {
        $attr = array(
			'user_email'	=> $this->input->post('user_email')
		);
        $query = $this->db->get_where('users',$attr);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
        
        
	// Verify Account
	public function verified($id) 
	{
		$status = 'Active';
        $date = date('Y-m-d H:i:s', bd_time());

		$data = array(
			'user_email_verified'                   => 1,  
			'user_modified'                         => $date,  
			'user_verification_code'				=> date('Y'),
			'user_status'                           => $status
		);  

		$this->db->where('userid', $id);
		$this->db->update('users', $data);
	}
	
        
        
	// Get record by id for update
	public function get_data($id) 
	{
	   $query = $this->db->get_where('users',array('userid' => $id));
	   return $query->row_array();		  
	}  
	
        
	// Update Message Status
	public function updateMessageStatus1($id) 
	{
		if($this->uri->segment(7) == ''){
			$msgstatus = 'read';
		}else{
			$msgstatus = $this->uri->segment(7);
		}
		
		$data = array(
			'msgstatus'             => $msgstatus
		);  

		$this->db->where('conversationid', $id);
		$this->db->where('msgstatus', 'unread');
		$this->db->update('message', $data);
	}
	
        
	// Update Message Status
	public function updateMessageStatus0($id) 
	{
		if($this->uri->segment(7) == ''){
			$msgstatus = 'read';
		}else{
			$msgstatus = $this->uri->segment(7);
		}

		$data = array(
			'msgstatus'             => $msgstatus
		);  

		$this->db->where('refid', $id);
		$this->db->where('msgstatus', 'unread');
		$this->db->update('message', $data);
	}
	    
        
	// Get record by refid
	public function getMessageData($id) 
	{
	   $query = $this->db->get_where('message',array('conversationid' => $id, 'refid' => 0));
	   return $query->row_array();		  
	}
        
        
	
	// Update record with img
	public function updateprofilewithimg() 
	{
		$display_name 	= $this->input->post('user_first_name'). ' '. $this->input->post('user_last_name');
		$userid 		= $this->input->post('userid');
		
		$data = array(
			'user_picture'			=> $this->upload->data('file_name'),  
			'display_name'			=> $display_name,
			'user_first_name'		=> $this->input->post('user_first_name'),  
			'user_last_name'		=> $this->input->post('user_last_name'),
			'user_gender'			=> $this->input->post('user_gender'),
			'user_city'				=> $this->input->post('user_city'),
			'user_dob'				=> $this->input->post('user_dob'),
			'about_user'			=> $this->input->post('about_user'),
			'favorite_materials'	=> $this->input->post('favorite_materials')
		);  

		$this->db->where('userid', $userid);
		$this->db->update('users', $data);

	} 
	
	// Update record
	public function updateprofile() 
	{
		$display_name 	= $this->input->post('user_first_name'). ' '. $this->input->post('user_last_name');
		$userid 		= $this->input->post('userid');
		
		$data = array(
			'display_name'			=> $display_name,
			'user_first_name'		=> $this->input->post('user_first_name'),  
			'user_last_name'		=> $this->input->post('user_last_name'),
			'user_gender'			=> $this->input->post('user_gender'),
			'user_city'				=> $this->input->post('user_city'),
			'user_dob'				=> $this->input->post('user_dob'),
			'about_user'			=> $this->input->post('about_user'),
			'favorite_materials'	=> $this->input->post('favorite_materials')
		);  

		$this->db->where('userid', $userid);
		$this->db->update('users', $data);

	}  
        
	
	// Update record
	public function shippingaddressupdate($userid) {
		
		$data = array(
			'user_address'			=> $this->input->post('user_address1')
		);  

		$this->db->where('userid', $userid);
		$this->db->update('users', $data);

	}  
        
	
	// Update record
	public function billingcardinfoedit($userid,$shopid) {
		
		$data = array(
			'nameoncard'		=> $this->input->post('nameoncard'),
			'cardname'			=> $this->input->post('cardname'),
			'cardnumber'		=> $this->input->post('cardnumber'),
			'cvc'				=> $this->input->post('cvc'),
			'securitycode'		=> $this->input->post('securitycode'),
			'expiremonth'		=> $this->input->post('expiremonth'),
			'expireyear'		=> $this->input->post('expireyear')
		);

		$this->db->where('userid', $userid);
		$this->db->where('shopid', $shopid);
		$this->db->update('paymentmethods', $data);
	}  
        
	
	// Update record
	public function billingbankinfoedit($userid,$shopid) {
		
		$data = array(
			'bankaccount'		=> 1,
			'bankname'			=> $this->input->post('bankname'),
			'bankcountry'		=> $this->input->post('bankcountry'),
			'accounttype'		=> $this->input->post('accounttype'),
			'accownername'		=> $this->input->post('accownername'),
			'routingnumber'		=> $this->input->post('routingnumber'),
			'accountnumber'		=> $this->input->post('accountnumber')
		);

		$this->db->where('userid', $userid);
		$this->db->where('shopid', $shopid);
		$this->db->update('paymentmethods', $data);
	}   
        
	
	// Update record
	public function shippingaddressupdate2($userid) {
		
		$data = array(
			'user_address2'			=> $this->input->post('user_address2')
		);  

		$this->db->where('userid', $userid);
		$this->db->update('users', $data);

	} 
        
	
	// Update record
	public function securitynotificationupdate($userid) {
		
		if($this->input->post('logininfo') == 1){ $notif = 1; }else{ $notif = 0; }
		
		$data = array(
			'logininfo'			=> $notif
		);  

		$this->db->where('userid', $userid);
		$this->db->update('users', $data);

	} 
        
	
	// Update record
	public function signinhistoryupdate($userid) {
		
		if($this->input->post('loginhistory') == 1){ $notif = 1; }else{ $notif = 0; }
		
		$data = array(
			'loginhistory'			=> $notif
		);  

		$this->db->where('userid', $userid);
		$this->db->update('users', $data);

	}
	
	
	
	// Get last 3 record from products table
    public function getlast6ProductsbyShopid($shopid,$limit)
    {
        $this->db->select('*');
        $this->db->from('products');
		
        $this->db->where('shopid', $shopid);
		$this->db->where('product_live', 'Active');
        $this->db->order_by('productid', 'RANDOM');
        $this->db->limit($limit);
		
        $query = $this->db->get();
        return $query->result();
    }
	
	
	
	
	// Delete record
	public function delete($id) 
	{
		$this->db->delete('portalusers', array('PortalUId' => $id));
		
		if ($this->db->affected_rows() == 1)
			return TRUE;
		else 
			return FALSE;
	}
	
	
	
	// Main Search
	public function purchasedetails(){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$orderid 				= $this->uri->segment(5);
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		
		$this->db->select("*");
		
		$query2 = $this->db->where('orders.order_userid', $userid)
             ->where('orders.orderid', $orderid)
             ->get('orders');
		 
		return $query2->row_array();
		
	}
	
	
	// Main Search
	public function getpurchaserecords($limit=NULL,$offset=NULL){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		if($this->uri->segment(6) !== NULL){ $purchaseStatus = $this->uri->segment(6); }
		
		$this->db->select("*");
		
		if($this->uri->segment(6) == NULL){
			
			$query2 = $this->db->where('orders.order_userid', $userid)
             ->order_by('orders.orderid', 'DESC')
             ->limit($limit, $offset)
             ->get('orders');
			 
		}else{
			
			$query2 = $this->db->where('orders.order_status', $purchaseStatus)
             ->where('orders.order_userid', $userid)
             ->order_by('orders.orderid', 'DESC')
             ->limit($limit, $offset)
             ->get('orders');
		}
		 
		return $query2->result();
		
	}
	
	
	// Main Action Search
	public function getuserpurchasetotalrecords(){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		if($this->uri->segment(6) !== NULL){ $purchaseStatus = $this->uri->segment(6); }
		
		$this->db->select("*");
		
		if($this->uri->segment(6) == NULL){
			
			$query2 = $this->db->where('order_userid', $userid)
             ->get('orders');
			 
		}else{
			
			$query2 = $this->db->where('order_status', $purchaseStatus)
             ->where('order_userid', $userid)
             ->get('orders');
		}
		
		 
		return $query2->num_rows();
		
	}
	
	
	// Main Action Search
	public function getuserpurchaseAllrecords(){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		if($this->uri->segment(6) !== NULL){ $purchaseStatus = $this->uri->segment(6); }
		
		$this->db->select("*");
		
		if($this->uri->segment(4) !== NULL){
			
			$query2 = $this->db->where('order_userid', $userid)
             ->get('orders');
			 
		}
		 
		return $query2->num_rows();
		
	}
	
	
	// Main Action Search
	public function getuserpurchasetotalrecordsByStatus($status){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		$this->db->select("*");
		
		$query2 = $this->db->where('order_status', $status)
             ->where('order_userid', $userid)
             ->get('orders');
		 
		return $query2->num_rows();
		
	}
	
	
	
	
	
	
	
	// Main Search
	public function yourorderdetails(){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$orderid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}else{
			redirect('page/login/logout');
		}
		
		
		$this->db->select("*");
		$this->db->join('ordershop','ordershop.orderid=orders.orderid', 'LEFT');
		$this->db->join('orderdetails','orderdetails.orderid=orders.orderid', 'LEFT');
		
		$query2 = $this->db->where('orders.orderid', $orderid)
				->get('orders');
		 
		return $query2->row_array();
		
	}
	
	
	// Main Search
	public function getAllUserOedersrecords($limit=NULL,$offset=NULL){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		if($this->uri->segment(7) !== NULL){ $orderStatus = $this->uri->segment(7); }
		
		$this->db->select("*");
		$this->db->join('orders','orders.orderid=ordershop.orderid', 'LEFT');
		$this->db->join('orderdetails','orderdetails.orderid=orders.orderid', 'LEFT');
		
		if($this->uri->segment(7) == NULL){
			
			$query2 = $this->db->where('ordershop.shopid', $shopid)
				->group_by('ordershop.orderid')
				->order_by('ordershop.orderid', 'DESC')
				->limit($limit, $offset)
				->get('ordershop');
			 
		}else{
			
			$query2 = $this->db->where('orders.order_status', $orderStatus)
				->where('ordershop.shopid', $shopid)
				->group_by('ordershop.orderid')
				->order_by('ordershop.orderid', 'DESC')
				->limit($limit, $offset)
				->get('ordershop');
		}
		 
		return $query2->result();
		
	}
	
	
	// Main Action Search
	public function getshoptotalorderrecords(){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		if($this->uri->segment(7) !== NULL){ $orderStatus = $this->uri->segment(7); }
		
		$this->db->select("*");
		$this->db->join('orders','orders.orderid=ordershop.orderid', 'LEFT');
		$this->db->join('orderdetails','orderdetails.orderid=orders.orderid', 'LEFT');
		
		if($this->uri->segment(7) == NULL){
			
			$query2 = $this->db->where('ordershop.shopid', $shopid)
			->group_by('ordershop.orderid')
			->get('ordershop');
			 
		}else{
			
			$query2 = $this->db->where('ordershop.shopid', $shopid)
			->where('orders.order_status', $orderStatus)
			->group_by('ordershop.orderid')
			->get('ordershop');
		}
		
		 
		return $query2->num_rows();
		
	}
	
	
	// Main Action Search
	public function getAllShopUserOedersrecords(){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		$this->db->select("*");
		$this->db->join('orders','orders.orderid=ordershop.orderid', 'LEFT');
		$this->db->join('orderdetails','orderdetails.orderid=orders.orderid', 'LEFT');
		
		if($this->uri->segment(4) !== NULL && $this->uri->segment(5) !== NULL){
			
			$query2 = $this->db->where('ordershop.shopid', $shopid)
			->group_by('ordershop.orderid')
			->get('ordershop');
			 
		}
		 
		return $query2->num_rows();
		
	}
		
	
	// Main Action Search
	public function getOederstotalrecordsByStatus($status){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		$this->db->select("*");
		$this->db->join('orders','orders.orderid=ordershop.orderid', 'LEFT');
		$this->db->join('orderdetails','orderdetails.orderid=orders.orderid', 'LEFT');
		
		$query2 = $this->db->where('ordershop.shopid', $shopid)
			->where('orders.order_status', $status)
			->group_by('ordershop.orderid')
			->get('ordershop');
		 
		return $query2->num_rows();
		
	}
	
	
	

}
