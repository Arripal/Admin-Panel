<?php
header('Access-Control-Allow-Origin: *');
require('./utils.php');
require('./Classes/RouterException.php');
require('./Classes/ApiException.php');
require('./Routing/Router.php');
require('./Classes/Session.php');
require('./Classes/Authentification.php');
require('./Classes/Database.php');
$db_config = require('./db_config.php');

$db = new Database($db_config);
$auth = new Authentification($db);


$router = new Router();

require('./Routing/routes.php');

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$protected = $router->is_protected_path($url);

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

if (!$protected) {
    return $router->use_route($url, $method);
}


$auth->verify_admin_access();

$router->use_route($url, $method);





//TODO : chercher pourquoi il  est impossible d'appeler auth dans /admin/login quand la class Auth est deja appelé dans index.php et pourquoi il est impossible de la redeclare