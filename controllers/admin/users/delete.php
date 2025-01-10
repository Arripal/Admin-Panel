<?php

use Classes\Controllers\User\Delete as DeleteController;

use Classes\Database\User as Database;

$db_config = require('./db_config.php');
$db = new Database($db_config);

$data = $_POST;

$db_config = require('./db_config.php');

$database = new Database($db_config);
$user = new DeleteController($database);

$user->delete(['name' => 'email', 'value' => $data['user_email']])->success("L'utilisateur a été supprimé avec succès.");
