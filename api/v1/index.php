<?php

// Needed method calls to prevent cors errors.
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: *");
    exit(0);
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Content-Type:application/json; charset=utf-8");

// Development only
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files.
require_once "vendor/autoload.php";
require_once "file-inclusions.php";

// Set namespace for easier later use.
use \Bramus\Router\Router;

// Create instance of the router.
$router = new Router();

//Define Routes
$router->get('/', function () {
    Response::json(200, array(
        "message" => "Welcome to the ombi-board-api"
    ));
});

// Route: /user
$router->mount('/user', function () use ($router) {
    $router->get('/init', 'UserController@initialSetup');
    $router->post('/signin', 'UserController@handleSignin');
    $router->post('/', 'UserController@createUser');
});

// Route: /servers
$router->mount('/servers', function () use ($router) {
    $router->post('/', 'ServerController@createServer');
    $router->get('/', 'ServerController@getServers');
    $router->get('/(\d+)', 'ServerController@getServerById');
    $router->put('/', 'ServerController@updateServer');
    $router->delete('/', 'ServerController@deleteServer');
});

// Route: /servers
$router->mount('/vitals', function () use ($router) {
    $router->post('/', 'VitalsController@createVitalsReading');
});

$router->run();

