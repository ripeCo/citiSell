<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Navigation_model extends CI_Model 
{
	
	
    // Get all record from subscriber table
	public function category($mainmenus,$status) 
	{
		$this->db->select('*');
		$this->db->from('productcategories');
		
		$this->db->where('main_menus',$mainmenus);
		$this->db->where('category_status',$status);
		$query = $this->db->get();
		return $query->result();
	} 
    
    
    // Get all record from users table
	public function subcategory($catid,$status)
	{
		$this->db->select('*');
		$this->db->from('subcategory');
		
		$this->db->where('category_id',$catid);
		$this->db->where('sub_cat_status',$status);
		$query = $this->db->get();
		return $query->result();
	}
    
    
    

}
