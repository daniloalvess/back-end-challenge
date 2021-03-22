<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require __DIR__ . '/vendor/autoload.php';

use App\Post;
use App\HTTPStatus;

header("Access-Control-Allow-Origin: *");
header("accept: application/json");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$currency = ['BRL', 'USD', 'EUR'];

if ($uri[1] !== 'exchange') {
    HTTPStatus::HTTPStatus(400);
    exit();
}

if ( !in_array($uri[2],$currency) ) {
    HTTPStatus::HTTPStatus(400);
    exit();
}

if ( count($uri) <= 3 || !in_array($uri[3],$currency) ) {
    HTTPStatus::HTTPStatus(400);
    exit();
}

if(filter_input(INPUT_GET, 'amount') && filter_input(INPUT_GET, 'amount') >= 0 && floatval(filter_input(INPUT_GET, 'amount')) ){
    $amount = filter_input(INPUT_GET, 'amount');
} else{
    HTTPStatus::HTTPStatus(400);
    exit();
}

if( filter_input(INPUT_GET, 'price') && floatval(filter_input(INPUT_GET, 'price'))) {
    $price = filter_input(INPUT_GET, 'price');
} else{
    HTTPStatus::HTTPStatus(400);
    exit();
}

if (isset($uri[2])) {
    $currencyFrom = (string) $uri[2];
}

if (isset($uri[3])) {
    $currencyTo = (string) $uri[3];
}

 $requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the request method and post ID to the Post and process the HTTP request:
$controller = new Post($requestMethod, $currencyFrom, $currencyTo, $amount, $price);
$controller->processRequest();
