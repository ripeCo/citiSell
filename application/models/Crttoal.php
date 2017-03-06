<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Crttoal extends CI_Model{
	
	public function total_itm(){
		$query = $this->db->query("select * from mega_cart");
		return $query->num_rows();
	}
}