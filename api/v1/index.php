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
    $logDAO = new LogDAO();


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

// Route: /cpu-readings
$router->mount('/cpu-readings', function () use ($router) {
    $router->post('/', 'CpuReadingController@createCpuReading');
    $router->get('/', 'CpuReadingController@getCpuReadings');
    $router->get('/(\d+)', 'CpuReadingController@getCpuReadingsByServerId');
    $router->get('/archive/(\d+)', 'CpuReadingController@getArchivedCpuReadingsByServerId');
    $router->delete('/', 'CpuReadingController@deleteCpuReadingsByServerId');
    $router->delete('/archive', 'CpuReadingController@deleteArchivedCpuReadingsByServerId');
});

// Route: /system-stats
$router->mount('/system-stats', function () use ($router) {
    $router->post('/', 'SystemStatsController@createSystemStats');
    $router->get('/', 'SystemStatsController@getSystemStats');
    $router->get('/(\d+)', 'SystemStatsController@getSystemStatsByServerId');
    $router->get('/archive/(\d+)', 'SystemStatsController@getArchivedSystemStatsByServerId');
    $router->delete('/', 'SystemStatsController@deleteSystemStatsByServerId');
    $router->delete('/archive', 'SystemStatsController@deleteArchivedSystemStatsByServerId');
});

// Route: /systeminformation
$router->mount('/systeminformation', function () use ($router) {
    $router->post('/', 'SystemInformationController@createSystemInformationEntry');
    $router->get('/', 'SystemInformationController@getSystemInformationEntries');
    $router->delete('/', 'SystemInformationController@deleteSystemInformationEntriesByServerId');
});

// Route: /capabilites
$router->mount('/capabilities', function () use ($router) {
    $router->post('/', 'CapabilityController@createCapability');
    $router->get('/', 'CapabilityController@getCapabilities');
    $router->put('/', 'CapabilityController@updateCapability');
    $router->delete('/', 'CapabilityController@deleteCapability');
});

// Route: /roles
$router->mount('/roles', function () use ($router) {
    $router->post('/', 'RoleController@createRole');
    $router->get('/', 'RoleController@getRoles');
    $router->put('/', 'RoleController@updateRole');
    $router->delete('/', 'RoleController@deleteRole');
});

// Route: /roles-capabilities
$router->mount('/roles-capabilities', function () use ($router) {
    $router->get('/', 'RoleCapabilityController@getRolesWithCapabilities');
    $router->post('/', 'RoleCapabilityController@assignCapabilityToRole');
    $router->delete('/', 'RoleCapabilityController@removeCapabilityFromRole');
});

// Route: /users-roles
$router->mount('/users-roles', function () use ($router) {
    $router->get('/(\d+)', 'UserRoleController@getRolesWithCapabilitiesByUserId');
    $router->post('/', 'UserRoleController@assignUserToRole');
    $router->delete('/', 'UserRoleController@removeUserFromRole');
});

$router->run();

