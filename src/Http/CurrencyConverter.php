<?php

namespace App\Http;

use App\Http\Converters\BRL;
use App\Http\Converters\EUR;
use App\Http\Converters\USD;

class CurrencyConverter
{
	public static function run()
	{
		if (isset($_GET['amount']) && isset($_GET['price']) && is_numeric($_GET['amount']) && is_numeric($_GET['price']) && $_GET['amount'] > 0 && isset($_GET['url'])) 
		{
			$url = explode('/', $_GET['url']);
			$parameters[0] = $_GET['amount'];
			$parameters[1] = $_GET['price'];
			if (count($url) >= 4)
			{
				
				$exchange = $url[0];
				array_shift($url);

				$class = "App\\Http\\Converters\\" . strtoupper($url[0]);
				array_shift($url);

				$method = strtoupper($url[0]);
				array_shift($url);
			}
			else
			{
				return json_encode(array('status' => 'error', 'data' => 'URL not valid'));
			}

			try 
			{
				if ($parameters[0] = $_GET['amount']) 
				{
					if (class_exists($class)) 
					{
						if (method_exists($class, $method)) 
						{
							if($method == 'BRL')
							{
								$symbol = 'R$';
							}
							else if($method == 'USD') 
							{
								$symbol = '$';
							}
							else if($method == 'EUR') 
							{
								$symbol = '€';
							}
							else
							{
								return json_encode(array('status' => 'error', 'data' => 'Method not exisists'));
							}
							$return = call_user_func_array(array(new $class, $method), $parameters);
							return json_encode(array('convertedValue' => $return, 'symbol' => $symbol));
						}
						else
						{
							return json_encode(array('status' => 'error', 'data' => 'Method not exisists'));
						}
					}
					else 
					{
						return json_encode(array('status' => 'error', 'data' => 'Class not exisists'));
					}
				}
				else 
				{
					return json_encode(array('status' => 'error', 'data' => 'Route not exists'));
				}
			} 
			catch (Exception $e) 
			{
				return json_encode(array('status' => 'error', 'data' => $e->getMessage()));
			}
		}
		else
		{
			return json_encode(array('status' => 'error', 'data' => 'URL not valid'));
		}
	}
}