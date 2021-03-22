<?php
namespace App;

class Post {
  private $requestMethod;
  private $currencyFrom;
  private $currencyTo;
  private $amount;
  private $price;

  public function __construct($requestMethod, $currencyFrom, $currencyTo, $amount, $price)
  {
    $this->requestMethod = $requestMethod;
    $this->currencyFrom = $currencyFrom;
    $this->currencyTo = $currencyTo;
    $this->amount = $amount;
    $this->price = $price;
  }

  public function processRequest()
  {
    switch ($this->requestMethod) {
      case 'GET':
        $response = $this->CurrencyConvert($this->currencyFrom, $this->currencyTo, $this->amount, $this->price);
        break;
      default:
        $response = $this->notFoundResponse();
        break;
    }

    //header($response['status_code_header']);
    if ($response['body']) {
        echo $response['body'];
    }
  }

  public function CurrencyConvert($currencyFrom, $currencyTo, $amount, $price)
  {
    $currency = [
        'BRL' => 'R$', 
        'USD' => '$', 
        'EUR' => '€'
    ];
    
    if($currencyFrom == 'BRL'){
      $result = [
          "convertedValue" => number_format($amount/$price,2),
          "symbol" => $currency[$currencyTo]
      ];
    } else {
        $result = [
          "convertedValue" => $amount*$price,
          "symbol" => $currency[$currencyTo]
      ];
    }

    $response['body'] = json_encode($result);
    return $response;
  }

  private function notFoundResponse()
  {
    $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
    $response['body'] = null;
    return $response;
  }
}