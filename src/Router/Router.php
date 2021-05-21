<?php

class Router extends Validate {
	//Params
	private $urlParams;

	/**
	* Constructor
	*
	* 
	* @author Jordã França
	**/
	public function __construct() {
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri = explode( '/', $uri );
		$this->urlParams = $uri;
	}

	/**
	* Start the routes
	*
	* 
	* @author Jordã França
	**/
	public function startRoute() {
		$urlParams = self::getUrlParams();
		if(isset($urlParams[1])) {
			switch ($urlParams[1]) {
				case 'exchange':
					self::doExchange($urlParams);
				break;
				
				default:
					self::return400();
				break;
			}
		}
	}

	//Setter
	public function getUrlParams() {
		return $this->urlParams;
	}
}