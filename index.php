<?php

use Classes\Authentification;
use Routing\Router;

header('Access-Control-Allow-Origin: *');
require_once('vendor/autoload.php');
require('./utils.php');

$auth = new Authentification();
$router = new Router();

require('./Routing/routes.php');

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router->use_route($url, $method, $auth);
