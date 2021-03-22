<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require __DIR__ . '/vendor/autoload.php';

use App\Post;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$currency = ['BRL', 'USD', 'EUR'];


if ($uri[1] !== 'exchange') {

    header("HTTP/1.1 404 Not Found");
    exit();
}

if ( !in_array($uri[2],$currency) ) {

    header("HTTP/1.1 404 Not Found");
    exit();
}

if ( !in_array($uri[3],$currency) ) {

    header("HTTP/1.1 404 Not Found");
    exit();
}

if (isset($uri[2])) {
    $currencyFrom = (string) $uri[2];
}

if (isset($uri[3])) {
    $currencyTo = (string) $uri[3];
}

$amount = filter_input(INPUT_GET, 'amount',FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

$price = filter_input(INPUT_GET, 'price',FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

$requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the request method and post ID to the Post and process the HTTP request:
$controller = new Post($requestMethod, $currencyFrom, $currencyTo, $amount, $price);
$controller->processRequest();
