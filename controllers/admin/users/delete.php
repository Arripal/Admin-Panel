<?php

use Classes\Controllers\User\Delete as DeleteController;

use Classes\Database\User as Database;

$db_config = require('./db_config.php');
$db = new Database($db_config);

$email = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL);

if (!$email) {
    redirect_to($_SERVER['HTTP_REFERER']);
}

$db_config = require('./db_config.php');

$database = new Database($db_config);
$user = new DeleteController($database);

$user->delete(['name' => 'email', 'value' => $email])->success("L'utilisateur a été supprimé avec succès.")->redirection(DeleteController::$path);
