<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Page_model extends CI_Model 
{
	
	
    // Get all record from users table
	public function index() 
	{
		$this->db->select('*');
		$this->db->from('cms');

		$this->db->order_by('pageid','ASC');
		$query = $this->db->get();
		return $query->result();
	}  
    
    

	// Create new record
	public function insert() 
	{
		if($this->input->post('pagestatus') == 'on'){ $status = '1'; }else{ $status = '0'; }
		$data = array(
			'pagename'			=> $this->input->post('pagename'),  
			'title'			=> $this->input->post('title'),  
			'contents'			=> $this->input->post('contents'),
			'pagestatus'		=> $status
		);  
		$this->db->insert('cms', $data);
	}  
    
    
	
	// Get record by id for update
	public function get_data($id) 
	{
	   $query = $this->db->get_where('cms',array('pageid' => $id));
	   return $query->row_array();		  
	}
    
    
	
	// Update record
	public function update($id) 
	{
		if( $this->input->post('pagestatus') === 'on' ){ $status ='1'; }else{ $status = '0'; }

		$data = array(
			'pagename'			=> $this->input->post('pagename'),  
			'title'			=> $this->input->post('title'),  
			'contents'			=> $this->input->post('contents'),
			'pagestatus'		=> $status
		);  

		$this->db->where('pageid', $id);
		$this->db->update('cms', $data);

	} 
    
    
    
	
	// Delete record
	public function delete($id) 
	{
		$this->db->delete('cms', array('pageid' => $id));
		
		if ($this->db->affected_rows() == 1)
			return TRUE;
		else 
			return FALSE;
	}
    
    

}
