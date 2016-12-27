<?php
	
	ob_start(); // start the output buffer
	
	// number check for less than 10 or Greater
	function checkNumber($parameter){
		if($parameter < 10){
			return '0'.$parameter;
		}else{ return $parameter; }
	}
	
?>
