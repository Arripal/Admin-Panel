<?php

use Classes\Controllers\Logement\Delete as DeleteController;
use Classes\Database\Logement as Database;

$db_config = require('./db_config.php');
$database = new Database($db_config);
$logement = new DeleteController($database);

$data = $_POST;

$logement->delete(['name' => 'id', 'value' => $data['logement_id']])->success("Le logement a été supprimé avec succès.");
