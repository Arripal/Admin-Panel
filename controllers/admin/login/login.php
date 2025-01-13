<?php

use Classes\Controllers\User\Login;
use Classes\Crypt;
use Classes\Database\User as Database;
use Classes\Session;
use Classes\Validation\Login as Validation;

$db_config = require('./db_config.php');
$email = $_POST['email'];
$password = $_POST['password'];

$user_data = [
    'email' => $email,
    'password' => $password
];

$validation = new Validation();
$crypt = new Crypt();
$session = new Session();
$database = new Database($db_config);
$login = new Login($validation, $database, $crypt, $session);

$login->login($user_data);
