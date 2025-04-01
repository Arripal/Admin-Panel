<?php

use Classes\Controllers\Logement\Delete as DeleteController;
use Classes\Database\Logement as Database;

$db_config = require('./db_config.php');
$database = new Database($db_config);
$logement = new DeleteController($database);

$logement_id = strip_tags(trim($_POST['logement_id']));

$logement->delete(['name' => 'id', 'value' => $logement_id])->success("Le logement a été supprimé avec succès.")->redirection(DeleteController::$path);
