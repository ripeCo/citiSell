<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Msmodel extends CI_Model{
	
	public function savecrt_info($data){
		$this->db->insert('mega_cart', $data);
	}
	public function getcrt_info(){
		$query = $this->db->query("SELECT * from mega_cart
									LEFT JOIN mega_shops ON
									mega_shops.shopid=mega_cart.craw_shopid
									LEFT JOIN mega_products ON
									mega_products.productid=mega_cart.craw_prodctid
									LEFT JOIN mega_users ON
									mega_users.userid=mega_cart.craw_pseller_id
									LEFT JOIN mega_shippingdetails ON
									mega_shippingdetails.productid=mega_cart.craw_prodctid
									GROUP BY mega_cart.craw_shopid
									ORDER BY mega_cart.craw_id DESC
									");
		$result = $query->result_array();
		return $result;
	}
	public function getproductby_shopid($shopid){
		$query = $this->db->query("SELECT * from mega_cart
									LEFT JOIN mega_shops ON
									mega_shops.shopid=mega_cart.craw_shopid
									LEFT JOIN mega_products ON
									mega_products.productid=mega_cart.craw_prodctid
									LEFT JOIN mega_users ON
									mega_users.userid=mega_cart.craw_pseller_id
									LEFT JOIN mega_shippingdetails ON
									mega_shippingdetails.productid=mega_cart.craw_prodctid
									where mega_cart.craw_shopid='$shopid'
									ORDER BY mega_cart.craw_id DESC
									");
		$result = $query->result_array();
		return $result;
	}
	public function placeordr_shopid($shopid){
		$query = $this->db->query("SELECT * from mega_cart
									LEFT JOIN mega_shops ON
									mega_shops.shopid=mega_cart.craw_shopid
									LEFT JOIN mega_products ON
									mega_products.productid=mega_cart.craw_prodctid
									LEFT JOIN mega_users ON
									mega_users.userid=mega_cart.craw_pseller_id
									LEFT JOIN mega_shippingdetails ON
									mega_shippingdetails.productid=mega_cart.craw_prodctid
									where mega_cart.craw_shopid='$shopid'
									ORDER BY mega_cart.craw_id DESC
									");
		$result = $query->row_array();
		return $result;
	}
	public function totalcrt_amount($shopid){
		$result = $this->db->query("SELECT SUM(mega_cart.craw_price) AS total FROM mega_cart where mega_cart.craw_shopid=?", [$shopid]);
		return $result->row_array();
	}
	public function removecrt_item($rowid){
		$this->db->query("DELETE from mega_cart where mega_cart.craw_id='$rowid'");
	}
	public function total_itm(){
		$query = $this->db->query("select * from mega_cart");
		return $query->num_rows();
	}
	public function itemqnty($rawid, $data){
		$this->db->where('craw_id', $rawid);
		$this->db->update('mega_cart', $data);
	}
	public function pricerange($rawid){
		$query = $this->db->query("select * from mega_cart 
								   LEFT JOIN mega_products ON
								   mega_products.productid=mega_cart.craw_prodctid 
								   where mega_cart.craw_id='$rawid'
								   ");
		return $query->row_array();
	}
	
	public function check_existing_product($product_id){
		$query = $this->db->query("select * from mega_cart where mega_cart.craw_prodctid='$product_id'");
		return $query->row_array();
	}
	public function update_crtinfo($crt_id, $data){
		$this->db->where('craw_id', $crt_id);
		$this->db->update('mega_cart', $data);
	}
	public function getshopid_byproid($productid){
		$query = $this->db->query("select * from mega_products where mega_products.productid='$productid'");
		return $query->row_array();
	}
	public function insertorder($data){
		$this->db->insert('mega_orders', $data);
	}
	public function gettotalorder(){
		$query = $this->db->query("select * from mega_orders");
		return $query->num_rows();
	} 
}