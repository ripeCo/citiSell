<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

// Create User Log
	function hasAccess($currentpage,$actions,$username,$fullname,$attampts){
		
		//if($currentpage == 'index.php'){ $actions = 'Login Page'; }
		
		//if($actions == 'edit' || $actions == 'remove'){ $actions = $actions; }else{ $actions = 'Only View No Action Taken !!!'; }
		
		//Write action to txt log
		$log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
				/*"Attempt: ".($result[0]['success']=='1'?'Success':'Failed').PHP_EOL.*/
				"Attempt: ".$attampts.PHP_EOL.
				"Page Name: ".$currentpage.PHP_EOL.
				"Actions : ".$actions.PHP_EOL.
				"User: ".$username.PHP_EOL.
				"Name: ".$fullname.PHP_EOL.
				"-------------------------------------------------------------------".PHP_EOL;
		//-
		// Create Folder
		$flder = 'application/views/activitylogs';
		if (!file_exists($flder)) {
			mkdir($flder, 0777, true);
		}
		file_put_contents($flder.'/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
	}
	
