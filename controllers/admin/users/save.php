<?php

use Classes\Controllers\User\Save as SaveController;
use Classes\Crypt;
use Classes\Database\User as Database;
use Classes\Validation\User as Validation;

$db_config = require('./db_config.php');

$database = new Database($db_config);
$validation = new Validation();
$crypt = new Crypt();
$user = new SaveController($database, $validation, $crypt);

$data = $_POST;

$user->validate_data($data)->save($data)->success("L'utilisateur a bien été enregistré.");
