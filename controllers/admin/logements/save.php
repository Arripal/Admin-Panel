<?php

use Classes\Controllers\Logement\Save as SaveController;
use Classes\Database\Logement as Database;
use Classes\Database\User as DB_User;
use Classes\Validation\Logement as Validation;

$db_config = require('./db_config.php');
$db_logement = new Database($db_config);
$db_user = new DB_User($db_config);
$validation = new Validation();
$save = new SaveController($db_logement, $validation, $db_user);

$data = $_POST;

$save->validate_data($data)->existing_user('email', ['email' => $data['host']])->save($data)->success("Le logement a bien été enregistré.");
