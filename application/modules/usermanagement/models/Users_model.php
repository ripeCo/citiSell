<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Users_model extends CI_Model 
{
	
	// Get all record from users table
	public function index() 
	{
		$this->db->select('*');
		$this->db->from('portalusers');
		
		if($this->session->userdata('type') != 'SuperAdmin')
			$this->db->where('type <>','SuperAdmin');

		$this->db->order_by('PortalUId','ASC');
		$query = $this->db->get();
		return $query->result();
	}  

	// Create new record
	public function insert() 
	{
		if($this->input->post('status') == 'on'){ $status = '1'; }else{ $status = '0'; }
		$date = date('Y-m-d H:i:s', bd_time());
		$data = array(
			'name'			=> $this->input->post('name'),  
			'email'			=> $this->input->post('email'),  
			'type'			=> $this->input->post('type'),
			'status'		=> $status,
			'registered'	=> $date,  
			'login'			=> $date,  
			'logout'		=> $date,
			'username'		=> $this->input->post('username'),
			'password'		=> md5($this->input->post('password'))
		);  
		$this->db->insert('portalusers', $data);
	}  
	
	// Get record by id for update
	public function get_data($id) 
	{
	   $query = $this->db->get_where('portalusers',array('PortalUId' => $id));
	   return $query->row_array();		  
	}
	
	// Update record
	public function update($id) 
	{
		if( $this->input->post('status') === 'on' ){ $status ='1'; }else{ $status = '0'; }

		$data = array(
			'name'		=> $this->input->post('name'),  
			'email'		=> $this->input->post('email'),  
			'type'		=> $this->input->post('type'),
			'status'	=> $status,
			'username'	=> $this->input->post('username'),
			'password'	=> md5($this->input->post('password'))
		);  

		$this->db->where('PortalUId', $id);
		$this->db->update('portalusers', $data);

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

}
