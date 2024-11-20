<?php

session_start();
require('./Classes/Session.php');
require('./Classes/Database.php');
require('./Classes/Authentification.php');
$db_config = require('./db_config.php');

$db = new Database($db_config);
$auth = new Authentification($db);

$errors = [];
$users;

$auth->verify_admin_access();


$result = $db->fetch_all("SELECT * FROM public.user");

$db->close_connexion();
$users = $result;



access_view('/admin/users/users.view', [
    'errors' => $errors,
    'users' => $users
]);
