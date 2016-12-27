<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Newsletters_model extends CI_Model 
{
	
	
    // Get all record from subscriber table
	public function subscriber($status) 
	{
		$this->db->select('*');
		$this->db->from('subscribers');
		
		$this->db->where('status',$status);
		$query = $this->db->get();
		return $query->result();
	} 
    
    
    // Get all record from users table
	public function registeredusers($status) 
	{
		$this->db->select('*');
		$this->db->from('users');
		
		$this->db->where('user_status',$status);
		$query = $this->db->get();
		return $query->result();
	}  
    
    
    

}
