<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Account_model extends CI_Model
{

	
	
	// Main Search
	public function getAllsellinghistory($status){
		
		$this->db->select("*");
		
		$query2 = $this->db->where('orders.order_status', $status)
				->order_by('orders.orderid', 'DESC')
				->get('orders');
		
		return $query2->result();
		
	}

	
	
	// Main Search
	public function getAllActiveShops($status){
		
		$this->db->select("*");
		
		$query2 = $this->db->where('shops.shop_status', $status)
				->order_by('shops.shopid', 'DESC')
				->get('shops');
		
		return $query2->result();
		
	}

	
	
	// Main Search
	public function getShopPayableInfo($paymentdetailsid,$shopid){
		
		$this->db->select("*");
		$this->db->join('shops', 'shops.shopid=paymentdetails.shopid', 'LEFT');
		
		$query2 = $this->db->where('paymentdetails.shopid', $shopid)
				->where('paymentdetails.paymentdetailsid', $paymentdetailsid)
				->order_by('paymentdetails.paymentdetailsid', 'DESC')
				->order_by('paymentdetails.shopid', 'DESC')
				->get('paymentdetails');
		
		return $query2->row_array();
		
	}

	
	
	// Main Search
	public function confirmpaymentmade($userid,$shopid,$paidamounts,$cbalance,$paymentstatus){
		
		$paymentmonth = date('F d, Y');
		
		$data = array(
			'userid'						=> $userid,
			'shopid'						=> $shopid,
			'paymentmonth'					=> $paymentmonth,
			'descriptions'					=> 'Payment made',
			'amount'						=> $paidamounts,
			'fees'							=> 0,
			'netamount'						=> 0,
			'currentbalance'				=> $cbalance,
			'paymentmade'					=> $paymentstatus
		);

		$this->db->insert('paymentdetails', $data);
		
	}
	
	
	
	// Main Search
	public function getAllReceivablesellersamounts($status){
		
		$cmonth = date('F Y');
		
		//$this->db->select("*, SUM(currentbalance) as cbalance");
		$this->db->select("*");
		
		$this->db->join('shops', 'shops.shopid=bill.shopid', 'LEFT');
		
		$query2 = $this->db->where('bill.billstatus', $status)
				->where('bill.billmonth', $cmonth	)
				->group_by('bill.shopid')
				->order_by('bill.billid', 'DESC')
				->get('bill');
		
		return $query2->result();
		
	}
	
    
	
}
