<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Setting_model extends CI_Model
{

	// Get all record from table by id
	public function getById($id)
	{
		$this->db->select('*');
		$this->db->from('settings');

		$this->db->where('setting_id', $id);

		$query = $this->db->get();
		return $query->row_array();
	}

	// Update Shop Portal Product Listing cost, Listing Renewal Period, Sells Commission etc Setting
	public function update($id)
	{
		$attr = array(
				'listing_cost'			=> $this->input->post('listingcost'),
				'product_renewal'	    => $this->input->post('productrenewal'),
				'sell_commission'	    => $this->input->post('sellcommission')
		);
		$this->db->where('setting_id', $id);
		$result = $this->db->update('settings', $attr);

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
    
    //////////////////////////////////////////////
    //  Social Settings Model
    //////////////////////////////////////////////
    
    
	// Get all record from table by id
	public function getbySocialId($id)
	{
		$this->db->select('*');
		$this->db->from('social');

		$this->db->where('socialid', $id);

		$query = $this->db->get();
		return $query->row_array();
	}

	// Update Social Profiles
	public function socialupdate($id)
	{
		$attr = array(
				'facebook'			=> $this->input->post('facebook'),
				'gplus'	            => $this->input->post('gplus'),
				'twitter'	        => $this->input->post('twitter'),
				'linkedin'	        => $this->input->post('linkedin'),
				'pinterest'	        => $this->input->post('pinterest')
		);
		$this->db->where('socialid', $id);
		$result = $this->db->update('social', $attr);

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
	
}
