<?php
session_start();
require('./Classes/Session.php');
require('./Classes/Database.php');
require('./Classes/Authentification.php');
$db_config = require('./db_config.php');

$db = new Database($db_config);
$auth = new Authentification($db);

$auth->verify_admin_access();





access_view('/admin/dashboard.view');
