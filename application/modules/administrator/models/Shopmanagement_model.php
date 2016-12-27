<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Shopmanagement_model extends CI_Model
{

	

	// Get all record from mega_shops table
	public function getallshops($status)
	{
		$this->db->select('*');
		$this->db->from('shops');

		$this->db->where('shop_status', $status);

		$query = $this->db->get();
		return $query->result();
	}


	// Get all record from mega_products table
	public function getallListingNumbers($status,$shopid)
	{
		$this->db->select('*');
		$this->db->from('products');

		$this->db->where('shopid', $shopid);
		$this->db->where('product_live', $status);

		$query = $this->db->get();
		return $query->num_rows();
	}


	// Get all record from mega_shops table
	public function getshopById($shopid)
	{
		$this->db->select('*');
		$this->db->from('shops');

		$this->db->where('shopid', $shopid);

		$query = $this->db->get();
		return $query->row_array();
	}

	
	// Update Shop Status
	public function updateshop($shopid)
	{
		$attr = array(
				'shop_status'			=> $this->input->post('shop_status')
		);
		$this->db->where('shopid', $shopid);
		$result = $this->db->update('shops', $attr);

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
	
	
	
	
	// Main Search
	public function getAllOedersrecords($status){
		
		$this->db->select("*");
		$this->db->join('orderdetails','orderdetails.orderid=orders.orderid', 'LEFT');
		
		$query2 = $this->db->where('orders.order_status', $status)
				->order_by('orders.orderid', 'DESC')
				->get('orders');
		
		return $query2->result();
		
	}
	
    
	
}
