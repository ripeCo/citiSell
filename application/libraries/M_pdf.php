<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

class M_pdf 
{

	function m_pdf() 
	{
		$CI = & get_instance();
		log_message('Debug', 'mPDF class is loaded.');
	}
	
	function load($param = NULL) 
	{
		include_once APPPATH.'/third_party/mpdf/mpdf.php';
		if ($params == NULL) 
		{
			return new mPDF('c', 'A4', '', '', 15, 15, 40, 10, 10, 5); // setup page margine
		}
	}
	
}