<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';


$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {

    $response->getBody()->write("Backend Challenge 1.0");
    return $response;

});

$app->get('/exchange/{currencyFrom}/{currencyTo}/', function (Request $request, Response $response) {
    
    require_once('inc/exchange.php');

    if($currencyValidate($request->getAttribute('currencyFrom')) && $currencyValidate($request->getAttribute('currencyTo'))){

        $params = $request->getQueryParams();
        if(!empty($params['amount']) && !empty($params['price'])){

            $data = array(            
                "convertedValue" => $convertedValue($params['amount'], $params['price']),
                "symbol" => $currencySimbol($valToUppercase($request->getAttribute('currencyTo'))),                         
            );
            $payload = json_encode($data, JSON_PRETTY_PRINT);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    $response->getBody()->write('Algo deu errado, contate o administrador.');
    return $response->withHeader('Content-Type', 'text/html');
    

});

$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);


$app->run();
