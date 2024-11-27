<?php
header('Access-Control-Allow-Origin: *');
require('./utils.php');
require('./Routing/Router.php');
require('./Classes/Authentification.php');
require('./Classes/Session.php');

$session = new Session();
$auth = new Authentification();
$router = new Router();

require('./Routing/routes.php');

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];


$route = $router->current_route($url, $method);

if (!$route) {
    redirect_to('/not_found');
}

$is_secured_route = $router->is_secured_route($route);

if (!$is_secured_route) {
    $router->use_route($url, $method);
    die();
}

$auth->verify_admin_access();
$router->use_route($url, $method);
