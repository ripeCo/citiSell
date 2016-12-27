<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Accounts_model extends CI_Model 
{
	
	

	// Get record by id for update
	public function get_sellerbillinginfo() 
	{
	   
	   $userid = $this->uri->segment(4);
	   $shopid = $this->uri->segment(5);
	   
	   $this->db->select('*');
	   $this->db->from('paymentmethods');
	   $this->db->where('userid', $userid);
	   $this->db->where('shopid', $shopid);
	   
	   $results = $this->db->get();
	   return $results->row_array();
	}

	// Get record
	public function get_sellerpaymentinfo() 
	{
	   
	   $userid = $this->uri->segment(4);
	   $shopid = $this->uri->segment(5);
	   
	   $this->db->select("*");
			
		$query2 = $this->db->where('userid', $userid)
			->where('shopid', $shopid)
			->order_by('paymentdetailsid', 'DESC')
			->get('paymentdetails');
	   
	   return $query2->row_array();
	}
	

	// Get record by id for update
	public function get_sellerpaymentmethodsinfo() 
	{
	   
	   $userid = $this->uri->segment(4);
	   $shopid = $this->uri->segment(5);
	   
	   $this->db->select('*');
	   $this->db->from('paymentmethods');
	   $this->db->where('userid', $userid);
	   $this->db->where('shopid', $shopid);
	   
	   $results = $this->db->get();
	   return $results->row_array();
	}

	// Get record
	public function get_sellerbillingRecords() 
	{
	   
	   $userid = $this->uri->segment(4);
	   $shopid = $this->uri->segment(5);
	   $billmonth = date('F Y');
	   
	   $this->db->select("*");
			
		$query2 = $this->db->where('userid', $userid)
			->where('shopid', $shopid)
			->where('billmonth', $billmonth)
			->order_by('billid', 'DESC')
			->get('bill');
	   
	   return $query2->row_array();
	}
	
        
        
	// Get record by id for update
	public function get_data_shops($id) 
	{
	   $query = $this->db->get_where('shops',array('userid' => $id));
	   return $query->row_array();		  
	}
	
	
	// Main Action Search
	public function getselleraccountsrecords(){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}
		
		$this->db->select("*");
			
		$query2 = $this->db->where('userid', $userid)
			->where('shopid', $shopid)
			->order_by('paymentdetailsid', 'DESC')
			->get('paymentdetails');
		
		return $query2->num_rows();
		
	}
	
	// Main Search
	public function getAllUserAccountsrecords($limit=NULL,$offset=NULL){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		$this->db->select("*");
			
		$query2 = $this->db->where('userid', $userid)
			->where('shopid', $shopid)
			->order_by('paymentdetailsid', 'DESC')
			->limit($limit, $offset)
			->get('paymentdetails');
		
		return $query2->result();
		
	}
	
	
	// Seller billing number of records
	public function getsellerBillingrecords(){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}
		
		if($this->input->post('year') == TRUE){
			$billyear = $this->input->post('year');
		}else{
			$billyear = date('Y');
		}
		
		$this->db->select("*");
			
		$query2 = $this->db->where('userid', $userid)
			->where('shopid', $shopid)
			->where('billyear', $billyear)
			->order_by('billid', 'DESC')
			->get('bill');
		
		return $query2->num_rows();
		
	}
	
	// Seller billing all records
	public function getSellerAllBillingrecords($limit=NULL,$offset=NULL){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		if($this->input->post('year') !== NULL){
			$billyear = $this->input->post('year');
		}else{
			$billyear = date('Y');
		}
		
		$this->db->select("*");
			
		$query2 = $this->db->where('userid', $userid)
			->where('shopid', $shopid)
			->where('billyear', $billyear)
			->order_by('billid', 'DESC')
			->limit($limit, $offset)
			->get('bill');
		
		return $query2->result();
		
	}
	
	
	// Seller billing details number of records
	public function getsellerBilldetailsrecords(){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}
		
		$billmonth		= str_replace("_"," ", $this->uri->segment(7));
		
		$this->db->select("*");
			
		$query2 = $this->db->where('userid', $userid)
			->where('shopid', $shopid)
			->where('billmonth', $billmonth)
			->order_by('billdetailsid', 'DESC')
			->get('billdetails');
		
		return $query2->num_rows();
		
	}
	
	// Seller billing all records
	public function getSellerAllBilldetailsrecords($limit=NULL,$offset=NULL){
		
		if( $this->session->userdata('isLogin') == TRUE){
			$userid 				= $this->uri->segment(4);
			$shopid 				= $this->uri->segment(5);
		}else{
			$userid 				= $this->uri->segment(4);
		}
		
		$billmonth		= str_replace("_"," ", $this->uri->segment(7));
		
		$this->db->select("*");
			
		$query2 = $this->db->where('userid', $userid)
			->where('shopid', $shopid)
			->where('billmonth', $billmonth)
			->order_by('billdetailsid', 'DESC')
			->limit($limit, $offset)
			->get('billdetails');
		
		return $query2->result();
		
	}
	
	
        
	
        
	
	

}
