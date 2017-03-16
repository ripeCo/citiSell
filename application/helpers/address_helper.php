<?php defined('BASEPATH') OR exit('No direct script access allowed.');

	if (!function_exists('addressIsValid')) {
		/*function addressIsValid($data) {
			if ($data['preferredAddress'] == 1) {
				if (!$data['user_country']) {
					return FALSE;
				} else {
					if ($data['user_country'] == "USA") {
						if (!$data['user_address'])
							return FALSE;
						if (!$data['user_city'])
							return FALSE;
						if (!$data['user_state'])
							return FALSE;
						if (!$data['user_zip'])
							return FALSE;
						if (!$data['user_country'])
							return FALSE;
					} else {
						if (!$data['notUSfullAddress1'])
							return FALSE;
					}
				}
			} elseif ($data['preferredAddress'] == 2) {
				if (!$data['user_country2']) {
					return FALSE;
				} else {
					if ($data['user_country2'] == "USA") {
						if (!$data['user_address2'])
							return FALSE;
						if (!$data['user_city2'])
							return FALSE;
						if (!$data['user_state2'])
							return FALSE;
						if (!$data['user_zip2'])
							return FALSE;
						if (!$data['user_country2'])
							return FALSE;
					} else {
						if (!$data['notUSfullAddress2'])
							return FALSE;
					}
				}
			} else {
				return FALSE;
			}

			return TRUE;
		}*/

		function addressIsValid(array $data) {			
			if ($data['preferredAddress'] == 1) {
				if (!$data['user_address'])
					return FALSE;
				if (!$data['user_city'])
					return FALSE;
				if (!$data['user_state'])
					return FALSE;
				if (!$data['user_zip'])
					return FALSE;
				if (!$data['user_country'])
					return FALSE;

				return TRUE;
			} elseif ($data['preferredAddress'] == 2) {
				if (!$data['user_address2'])
					return FALSE;
				if (!$data['user_city2'])
					return FALSE;
				if (!$data['user_state2'])
					return FALSE;
				if (!$data['user_zip2'])
					return FALSE;
				if (!$data['user_country2'])
					return FALSE;

				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

?>