<?php

class Order extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$userlogged = $this->session->userdata('userid');
		if($userlogged === null){
			redirect('page/login/dologin');
		}
		$this->load->model('order_model');
	} 
	
	function index(){
		$this->load->view('order/vieworder');
	}
	public function completedorder(){
		$this->load->view('order/completed');
	}
	public function allorder(){
		$this->load->view('order/all');
	}
	public function canceledorder(){
		$this->load->view('order/canceledorder');
	}
	
}