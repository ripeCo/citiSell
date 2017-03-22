<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_model extends CI_Model {
	public function saveTrackingDetails($orderNumber, array $paramData) {
		$data['charges'] = $paramData['charges'];
		$data['trk_main'] = $paramData['trk_main'];
		$data['transaction_id'] = $paramData['transaction_id'];
		$data['order_status'] = 'Processing';
		$data['shipDate'] = $paramData['shipDate'];

		$this->db->where('ordernumber', $orderNumber);
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