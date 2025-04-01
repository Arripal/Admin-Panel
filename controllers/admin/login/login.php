<?php

use Classes\Controllers\User\Login;
use Classes\Database\User as Database;
use Classes\Session;
use Classes\Validation\Login as Validation;

$db_config = require('./db_config.php');

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = trim($_POST['password']);

$user_credentials = [
    'email' => $email,
    'password' => $password
];

$validation = new Validation();
$session = new Session();
$database = new Database($db_config);
$login = new Login($validation, $database, $session);

$login->login($user_credentials);
