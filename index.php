<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

//Class
require __DIR__.'/src/class/Validate.class.php';
require __DIR__.'/src/class/Exchange.class.php';

//Imports
require __DIR__ . '/vendor/autoload.php';
include __DIR__.'/src/Router/Router.php';

//Router
$router = new Router();
$router->startRoute();