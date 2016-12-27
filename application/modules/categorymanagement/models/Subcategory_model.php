<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Subcategory_model extends CI_Model
{

    // Get all record from table
    public function index()
    {
        $this->db->select('*');
        $this->db->from('subcategory');

        $this->db->join('productcategories', 'productcategories.category_id=subcategory.category_id', 'left');
        $this->db->order_by('sub_category_id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
	
	
	
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
	
	

    // Get all record from table by status
    public function getByStatus($status)
    {
        $this->db->select('*');
        $this->db->from('subcategory');

        $this->db->where('sub_cat_status', $status);
        $this->db->order_by('sub_category_id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
	
	
	

    // Get all record from table by status
    public function getSubCatByStatus($status,$catid)
    {
        $this->db->select('*');
        $this->db->from('subcategory');

        $this->db->where('sub_cat_status', $status);
        $this->db->where('category_id', $catid);
        $this->db->order_by('sub_category_id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
	
	
	

	// Insert Subcategory information
	public function insertsubcat()
	{ 
		// Create an array for check user condition
        if( $this->input->post('SubCatStatus') == 'on'){ $status = '1'; }else{ $status = '0'; }
        $attr = array(
            'sub_category_name'	=> $this->input->post('SubCategoryName'),
            'category_id'	    => $this->input->post('CategoryID'),
            'sub_cat_status'	    => $status
        );
		$result = $this->db->insert('subcategory', $attr);
		// Check return and create an array for session 
		if ($result == TRUE)
		{
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}
	
	


    // Get all record from table by id
    public function getbyId($SubcatID)
    {
        $this->db->select('*');
        $this->db->from('subcategory');

        $this->db->join('productcategories', 'productcategories.category_id=subcategory.category_id', 'left');
        $this->db->where('sub_category_id', $SubcatID);
        $this->db->order_by('sub_category_id', 'ASC');

        $query = $this->db->get();
        return $query->row_array();
    }
	
	

	// Update user Password
	public function updatesubcat($SubCategoryID)
	{
        if( $this->input->post('SubCatStatus') == 'on'){ $status = '1'; }else{ $status = '0'; }
        $attr = array(
            'sub_category_name'	=> $this->input->post('SubCategoryName'),
            'category_id'	    => $this->input->post('CategoryID'),
            'sub_cat_status'	    => $status
        );
		$this->db->where('sub_category_id', $SubCategoryID);
		$result = $this->db->update('subcategory', $attr);

		// Check return and create an array for session
        if ($result == TRUE)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
	}



    // Delete record Payment table
    public function delete($id)
    {
        $this->db->delete('subcategory', array('sub_category_id' => $id));

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }


}
