<?php

use Classes\Controllers\User\Login;
use Classes\Crypt;
use Classes\Database\User as DatabaseUser;
use Classes\Session;
use Classes\Validation\Login as Validator;

$db_config = require('./db_config.php');
$email = $_POST['email'];
$password = $_POST['password'];

$user_data = [
    'email' => $email,
    'password' => $password
];

$validator = new Validator();
$crypt = new Crypt();
$session = new Session();
$database_user = new DatabaseUser($db_config);
$login = new Login($validator, $database_user, $crypt, $session);

$login->login($user_data);
