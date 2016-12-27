<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Login_model extends CI_Model 
{ 

	// Check user login information
	public function check_user() 
	{ 
		// Create an array for check user condition
		$attr = array(
			'user_email'	=> $this->input->post('user_email'),
			'user_password'	=> $this->input->post('user_password'),
			'user_status'	=> 'Active'
		);
		$result = $this->db->get_where('users', $attr);
		
		// Check return and create an array for session 
		if ($result->num_rows() == 1) 
		{
			$attr = array(
				'userid'				=> $result->row(0)->userid,
				'useremail'				=> $result->row(3)->user_email,
				'first_name'			=> $result->row(6)->user_first_name,
				'last_name'				=> $result->row(7)->user_last_name,
				'displayname'			=> $result->row(8)->display_name,
				'usergender'			=> $result->row(5)->user_gender,
				'user_picture'			=> $result->row(10)->user_picture,
				'user_email_verified'	=> $result->row(14)->user_email_verified,
				'user_country'			=> $result->row(21)->user_country,
				'userregistrationdate'	=> $result->row(15)->user_registration_date,
				'logininfo'				=> $result->row(25)->logininfo,
				'shopopen'				=> $result->row(26)->shopopen,
				'userstatus'			=> $result->row(27)->user_status
			);
			// Session set
			$this->session->set_userdata($attr);
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}
	
	
	
    
    // userid Exist Checking By Model Function
    public function shopuser_exists($key)
    {
        $attr = array(
			'userid'	=> $key
		);
        $query = $this->db->get_where('shops',$attr);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
	
	
	// Get all record from users table using user_email
	public function getByKey($key,$status)
	{
		$this->db->select('*');
		$this->db->from('users');
		
		$this->db->where('user_email',$key);
		$this->db->where('user_status',$status);
		
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	// Get all record from users table using user_email
	public function getByid($key)
	{
		$this->db->select('*');
		$this->db->from('users');
		
		$this->db->where('userid',$key);
		
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	// Get all record from shops table using userid
	public function getByidshopinfo($key)
	{
		$this->db->select('*');
		$this->db->from('shops');
		
		$this->db->where('userid',$key);
		
		$query = $this->db->get();
		return $query->row_array();
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
	
	

	// Update user Password
	public function updatepass($userid,$pass)
	{
		$data 	= array(  
			'user_password'	=> md5($pass)
		);
		$this->db->where('userid', $userid);
		$this->db->update('users', $data);
	}
	
	

	// Update user Email
	public function updateemail($userid,$email)
	{
		$data 	= array(  
			'user_email'	=> $email
		);
		$this->db->where('userid', $userid);
		$this->db->update('users', $data);
	}
	
	

	// Update user Password
	public function recoverpass($email,$pass) 
	{
		$data 	= array(  
			'user_password'	=> $pass
		);
		$this->db->where('user_email', $email);  
		$this->db->update('users', $data);
	}
	
	
	

	// Update user login time
	public function login_time() 
	{
		$userid 	= $this->session->userdata('userid');
		$time 	= date('Y-m-d H:i:s');
		
		$data 	= array(  
			'logintime'	=> $time
		);
		$this->db->where('userid', $userid);  
		$this->db->update('users', $data);
	}
	
	
	
	// Update user logout time
	public function logout_time() 
	{
		$userid 	= $this->session->userdata('userid');
		$time 	= date('Y-m-d H:i:s');
		
		$data 	= array(
			'logouttime'	=> $time
		);  
		$this->db->where('userid', $userid);  
		$this->db->update('users', $data);
	}
	
}