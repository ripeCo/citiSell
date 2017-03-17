<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!'); 

class Order_model extends CI_Model 
{
	function save_order($data){
		$this->db->insert('order', $data);
	}
	
	public function getshopinfobyuser($userid) {
		$query = $this->db->query("select * from mega_shops where mega_shops.userid=?", [$userid]);
		return $query->row_array();
	}
	
	public function getorderinfo($shopid) {
		$query = $this->db->query("select mega_ordershop.*, mega_orders.*,
								users.user_first_name, users.user_last_name
								,users.preferredAddress, users.user_address, users.user_city, users.user_state, users.user_zip, users.user_country
								,users.user_address2, users.user_city2, users.user_state2, users.user_zip2, users.user_country2
								,notUSfullAddress1
								,notUSfullAddress2
								FROM mega_ordershop
								LEFT JOIN mega_orders ON mega_orders.orderid = mega_ordershop.orderid
								JOIN mega_users users ON users.userid = mega_orders.order_buyerid
								WHERE mega_ordershop.shopid = ?
								ORDER BY mega_ordershop.shoporderid DESC", [$shopid]);
		return $query->result_array();
	}

	public function getOrderDetailsByOrderNumber($orderNumber) {
		$shopOwnerUserId = $this->session->userdata('userid');

		$query = $this->db->query("select users.display_name, users.user_email, users.user_first_name, users.user_last_name
							,users.preferredAddress, users.user_address, addrLine2Of1, users.user_city, users.user_state, users.user_zip, users.user_country
							,users.user_address2, addrLine2Of2, users.user_city2, users.user_state2, users.user_zip2, users.user_country2
							,notUSfullAddress1, notUSfullAddress2, users.user_phone
							,orderDetails.shopid
							,orderDetails.orderid
							,(SELECT pic_name FROM mega_productpic productpic WHERE productpic.pic_productid = orderDetails.productid LIMIT 1) AS productImage
							,orders.order_date
							,orders.order_status
							FROM mega_orders orders JOIN mega_users users ON users.userid = orders.order_buyerid
							JOIN mega_orderdetails orderDetails ON orderDetails.orderid = orders.orderid
							WHERE orders.ordernumber = ? AND orders.order_userid = ?
							ORDER BY orders.orderid DESC", [$orderNumber, $shopOwnerUserId]);
		return $query->result_array();
	}

	public function getorderproductinfo($shopid, $orderid) {
		$query = $this->db->query("select * from mega_orderdetails
									LEFT JOIN mega_products ON
									mega_products.productid=mega_orderdetails.productid
									WHERE mega_orderdetails.shopid = ?
									AND mega_orderdetails.orderid = ?
									ORDER BY mega_orderdetails.shopid DESC", array($shopid, $orderid));
		return $query->result_array();
	}

	public function getprothumb($productid) {
		$query = $this->db->query("select * from mega_productpic where mega_productpic.pic_productid='$productid'");
		return $query->row_array();
	}

	public function getbuyerinfo($buyerid) {
		$query = $this->db->query("select * from mega_users where mega_users.userid='$buyerid'");
		return $query->row_array();
	}
	
}
