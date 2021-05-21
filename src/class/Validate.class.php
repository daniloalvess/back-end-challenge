<?php 

	/**
	* Validate class
	*
	*
	* @author Jordã França
	**/
	class Validate {

		public function doExchange($params) {

			//Verify if isset query params
			if(!isset($_GET['amount']) || !isset($_GET['price'])) {
				self::return400();
			} else {
				//Verify if is in lowercase
				if(ctype_lower($params[2]) || ctype_lower($params[3])) {
					self::return400();
				} else {
					//Convert to float
					$_GET['amount'] = (float) $_GET['amount'];
					$_GET['price'] = (float) $_GET['price'];

					//Verify if is float and highter than 0
					if(is_float($_GET['amount']) && is_float($_GET['price']) && $_GET['price'] > 0 && $_GET['amount'] > 0) {
						$exchange = new Exchange($params[2], $params[3], $_GET['amount'], $_GET['price']);
						$exchange->getResults();
					} else {
						self::return400();
					}
				}
			}
		}

		/** Return 404 method
		*
		*
		*
		* @author Jordã França
		**/
		public function return400() {
			http_response_code(400); 
			print_r(json_encode(array("status" => "false"))); 
			exit();
		}
	}