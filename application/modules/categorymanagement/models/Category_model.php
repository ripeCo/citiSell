<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Category_model extends CI_Model
{

    // Get all record from table
    public function index()
    {
        $this->db->select('*');
        $this->db->from('productcategories');

        $this->db->order_by('category_id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
	

    // Get all record from table by status
    public function getByStatus($status)
    {
        $this->db->select('*');
        $this->db->from('productcategories');

        $this->db->where('category_status', $status);
        $this->db->order_by('category_id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

	
	
	// Check user login information
	public function insertcat()
	{ 
		// Create an array for check user condition
        if( $this->input->post('catstatus') == 'on'){ $status = '1'; }else{ $status = '0'; }
		$attr = array(
			'main_menus'		=> $this->input->post('mainmenus'),
			'category_name'	=> $this->input->post('CategoryName'),
			'category_status'	    => $status
		);
		$result = $this->db->insert('productcategories', $attr);
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
    public function getCatbyId($catID)
    {
        $this->db->select('*');
        $this->db->from('productcategories');

        $this->db->where('category_id', $catID);
        $this->db->order_by('category_id', 'ASC');

        $query = $this->db->get();
        return $query->row_array();
    }

	
	
	// Update user Password
	public function updatecat($category_id)
	{
        if( $this->input->post('catstatus') == 'on'){ $status = '1'; }else{ $status = '0'; }
        $attr = array(
            'main_menus'		=> $this->input->post('mainmenus'),
			'category_name'		=> $this->input->post('CategoryName'),
            'category_status'  	=> $status
        );
		$this->db->where('category_id', $category_id);
		$result = $this->db->update('productcategories', $attr);

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
        $this->db->delete('productcategories', array('category_id' => $id));

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }


}
