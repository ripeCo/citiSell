<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_model extends CI_Model{
	/*	Sample successful output
		[charges] => 9.19
	    [trk_main] => 9400111969000940000011
	    [transaction_id] => 73b0ee20-49ec-412f-931e-41c4e5c2e05e
	    [pkgs] => Array
	        (
	            [0] => Array
	                (
	                    [pkg_trk_num] => 9400111969000940000011
	                    [label_fmt] => Pdf
	                    [label_img] => // the very long string for the image.
	                )

	        )

	    [media] => Array
	        (
	            [0] => // the very long string for the image.
	*/
	public function saveTrackingDetails($orderID, array $paramData) {
		$data['charges'] = $paramData['charges'];
		$data['trk_main'] = $paramData['trk_main'];
		$data['transaction_id'] = $paramData['transaction_id'];
		$data['order_status'] = 'Processing';

		$this->db->where('orderid', $orderID);
		$this->db->update('orders', $data);

		$data = [];
		foreach ($paramData['pkgs'] as $key => $value) {
			$data['transaction_id'] = $paramData['transaction_id'];
			$data['indx'] = $key;
			$data['pkg_trk_num'] = $value['pkg_trk_num'];
			$data['label_fmt'] = $value['label_fmt'];
			$data['label_img'] = $value['label_img'];
			
			$this->db->insert("usps_shipping_pkgs", $data);
		}
	}
}

?>