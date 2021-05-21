<?php
	/**
	* Class Exchange
	*
	*
	* @author Jordã França
	**/
	class Exchange extends Validate{

		private $converted;
		private $symbol;
		private $from;
		private $to;
		private $amout;
		private $price;
		private $convertedValue;

		/**
		* Constructor
		*
		* 
		* @author Jordã França
		**/
		public function __construct($from, $to, $amout, $price) {
			$this->from  = $from;
			$this->to    = $to;
			$this->amout = $amout;
			$this->price = $price;
		}

		/**
		* Convert
		*
		* 
		* @author Jordã França
		**/
		public function getResults() {
			//Define Symbol and Convert
			switch ($this->to) {
				case 'BRL':
					self::setSymbol('R$');
					self::setConverted(round(self::getAmount()*self::getPrice(), 2));
				break;

				case 'USD':
					self::setSymbol('$');
					self::setConverted(round(self::getAmount()/self::getPrice(), 2));
				break;

				case 'EUR':
					self::setSymbol('€');
					self::setConverted(round(self::getAmount()/self::getPrice(), 2));
				break;
				
				default:
					self::return400();
				break;
			}

			//Result
			$arrJSON = array("convertedValue" => self::getConverted(), "symbol" => self::getSymbol());
			self::outputJSON($arrJSON);
		}


		/**
		* Output JSON 
		*
		* 
		* @author Jordã França
		**/
		private function outputJSON($json) {
			print_r(json_encode($json));
		}

		/* Getters and Setters*/
		private function setConverted($converted) {
			$this->converted = $converted;
		}

		public function getConverted() {
			return $this->converted;
		}

		private function setSymbol($symbol) {
			$this->symbol = $symbol;
		}

		public function getSymbol() {
			return $this->symbol;
		}

		private function setFrom($from) {
			$this->from = $from;
		}

		public function getFrom() {
			return $this->from;
		}

		private function setTo($to) {
			$this->to = $to;
		}

		public function getTo() {
			return $this->to;
		}

		private function setAmout($amout) {
			$this->amout = $amout;
		}

		public function getAmount() {
			return $this->amout;
		}

		private function setPrice($price) {
			$this->price = $price;
		}

		public function getPrice() {
			return $this->price;
		}


	}