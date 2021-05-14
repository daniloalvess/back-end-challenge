<?php
header('Content-Type: application/json; charset=UTF-8');
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require __DIR__ . '/vendor/autoload.php';

if (isset($_REQUEST) && !empty($_REQUEST)) {
	$converter = new App\Http\CurrencyConverter();
	echo $converter->run();
}


