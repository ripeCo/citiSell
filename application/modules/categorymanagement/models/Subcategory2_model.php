<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Subcategory2_model extends CI_Model
{

    // Get all record from table
    public function index()
    {
        $this->db->select('*');
        $this->db->from('subcategorylevel2');

        $this->db->join('productcategories', 'productcategories.category_id=subcategorylevel2.category_id', 'left');
        $this->db->join('subcategory', 'subcategory.sub_category_id=subcategorylevel2.sub_category_id', 'left');
        $this->db->order_by('sub_category_lev2_id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    // Get all record from table by status
    public function getByStatus($status,$catid)
    {
        $this->db->select('*');
        $this->db->from('subcategorylevel2');

        $this->db->where('sub_cat_lev2_status', $status);
        $this->db->where('category_id', $catid);
        $this->db->group_by('category_id');
        $this->db->order_by('sub_category_id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    // Insert Subcategory information
    public function insertsubcat()
    {
        // Create an array for check user condition
        if( $this->input->post('SubCatLev2Status') == 'on'){ $status = '1'; }else{ $status = '0'; }
        $attr = array(
            'sub_category_lev2_name'	=> $this->input->post('SubCategoryLev2Name'),
            'category_id'	        	=> $this->input->post('CategoryID'),
            'sub_category_id'	        => $this->input->post('SubCategoryID'),
            'sub_cat_lev2_status'	    => $status
        );
        $result = $this->db->insert('subcategorylevel2', $attr);
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
    public function getbyId($SubCategoryLev2ID)
    {
        $this->db->select('*');
        $this->db->from('subcategorylevel2');

        $this->db->join('productcategories', 'productcategories.category_id=subcategorylevel2.category_id', 'left');
        $this->db->join('subcategory', 'subcategory.sub_category_id=subcategorylevel2.sub_category_id', 'left');
        $this->db->where('sub_category_lev2_id', $SubCategoryLev2ID);
        $this->db->order_by('sub_category_lev2_id', 'ASC');

        $query = $this->db->get();
        return $query->row_array();
    }

    // Update user Password
    public function updatesubcat($SubCategoryLev2ID)
    {
        if( $this->input->post('sub_cat_lev2_status') == 'on'){ $status = '1'; }else{ $status = '0'; }
        $attr = array(
            'sub_category_lev2_name'	=> $this->input->post('SubCategoryLev2Name'),
            'category_id'	        => $this->input->post('CategoryID'),
            'sub_category_id'	        => $this->input->post('SubCategoryID'),
            'sub_cat_lev2_status'	=> $status
        );
        $this->db->where('sub_category_lev2_id', $SubCategoryLev2ID);
        $result = $this->db->update('subcategorylevel2', $attr);

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
        $this->db->delete('subcategorylevel2', array('sub_category_lev2_id' => $id));

        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }


}
