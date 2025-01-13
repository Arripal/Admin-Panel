<?php

use Classes\Controllers\User\Update as UpdateController;
use Classes\Crypt;
use Classes\Database\User as Database;
use Classes\Validation\User as Validation;

$db_config = require('./db_config.php');
$database = new Database($db_config);
$validation = new Validation();
$crypt = new Crypt();
$user = new UpdateController($database, $validation, $crypt);

$data = $_POST;

$user->validate_data($data)->update($data)->success("L'utilisateur a bien été mis à jour.");
