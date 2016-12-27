<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');
	
	// This function is set software expire date
	// Call this function
	/*
		if(!(expireDate() >= date('Y-m-d'))) {
			echo '<h1 style="color:red;" align="center"> Date Expire ... </h1>';
			die();
		}
	*/
	
	
	// This function check hacking V.V.I.
	function goodbye() 
	{
		redirect('login/?Hacking Attempt: Get out of the system');
	}
	
	// Software expire 
	function expireDate()
	{
		return date('2015-12-31');
	}
	
	// Powered by 
	function poweredBy()
	{
		return 'Powered by: Wan IT Ltd.';
	}
	
	// copyright 
	function copyright()
	{
		echo date('Y') . ' &copy; Wan IT Ltd.';
	}
	
	// This is report header
	function companyInfo()
	{
		//return '<p align="center"><img src="assets/images/logo.jpg" height="75px" style="margin-top:-25px;"></p>';
	}

