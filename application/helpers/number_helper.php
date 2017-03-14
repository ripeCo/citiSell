<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('isNumericAndPositive')) {
	function isNumericAndPositive($numeric) {
		if (!is_numeric($numeric))
			return FALSE;
		if ($numeric < 0)
			return FALSE;

		return TRUE;
	}
}

?>