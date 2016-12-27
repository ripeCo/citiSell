<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Login_model extends CI_Model 
{ 

	// Check user login information
	public function check_user() 
	{ 
		// Create an array for check user condition
		$attr = array(
			'username'	=> $this->input->post('username'),
			'password'	=> $this->input->post('password'),
			'status'	=> 1
		);
		$result = $this->db->get_where('PortalUsers', $attr);
		// Check return and create an array for session 
		if ($result->num_rows() == 1) 
		{
			$attr = array(
				'PortalUId'		=> $result->row(0)->PortalUId,
				'name'		=> $result->row(1)->name,
				'type'		=> $result->row(3)->type,
				'username'	=> $result->row(8)->username,
				'useremail'	=> $result->row(2)->email
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
    
    // Email Exist Checking Model Function
    public function mail_exists($key)
    {
        $attr = array(
			'email'	=> $this->input->post('useremail')
		);
        $query = $this->db->get_where('portalusers',$attr);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

	// Update user Password
	public function updatepass($email,$pass)
	{
		$data 	= array(  
			'password'	=> md5($pass)
		);
		$this->db->where('email', $email);
		$this->db->update('PortalUsers', $data);
	}

	// Update user Password
	public function recoverpass($email,$pass) 
	{
		$data 	= array(  
			'password'	=> $pass
		);
		$this->db->where('email', $email);  
		$this->db->update('PortalUsers', $data);
	}

	// Update user login time
	public function login_time() 
	{
		$PortalUId 	= $this->session->userdata('PortalUId');
		$time 	= date('Y-m-d H:i:s');
		
		$data 	= array(  
			'login'	=> $time
		);
		$this->db->where('PortalUId', $PortalUId);  
		$this->db->update('PortalUsers', $data);
	}
	
	// Update user logout time
	public function logout_time() 
	{
		$PortalUId 	= $this->session->userdata('PortalUId');
		$time 	= date('Y-m-d H:i:s');
		
		$data 	= array(
			'logout'	=> $time
		);  
		$this->db->where('PortalUId', $PortalUId);  
		$this->db->update('PortalUsers', $data);
	}
	
}