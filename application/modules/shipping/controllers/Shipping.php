<?php 
	if(!defined('BASEPATH')) exit('Your are not allowed');
	
	class Shipping extends CI_Controller{
		
		function __construct(){
			parent::__construct();
			// Load models 
			$this->load->model('Navigation_model');
		}
		
		function index(){
			$this->load->view('shipping_label');
		}
		
	}
