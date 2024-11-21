<?php
header('Access-Control-Allow-Origin: *');
require('./utils.php');
require('./Routing/Router.php');







$router = new Router();

require('./Routing/routes.php');

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->use_route($url, $method);
