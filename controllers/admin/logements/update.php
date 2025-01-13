<?php

use Classes\Controllers\Logement\Update as UpdateController;
use Classes\Database\Logement as Database;
use Classes\Validation\Logement as Validation;

$db_config = require('./db_config.php');
$database = new Database($db_config);
$validation = new Validation();
$logement = new UpdateController($database, $validation);

$data = $_POST;

$logement->validate_data($data)->update($data)->success("Le logement a bien été mis à jour.");
