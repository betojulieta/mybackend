<?php

// CORS Headers (opcional poner aquí, aunque es mejor hacerlo vía middleware en Laravel)
header('Access-Control-Allow-Origin: https://frontend-rho-liard-56.vercel.app');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// Capturar la solicitud
$request = Request::capture();

// Procesar la solicitud
$response = $app->handle($request);

// Enviar la respuesta
$response->send();

// Terminar correctamente el ciclo de vida de la solicitud
$app->terminate($request, $response);



/*
header('Access-Control-Allow-Origin: https://frontend-rho-liard-56.vercel.app');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');


use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...

$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
*/