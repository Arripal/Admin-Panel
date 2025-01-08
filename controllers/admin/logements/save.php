<?php

use Classes\Controllers\Logement\Save;
use Classes\Database\Logement;
use Classes\Database\User;
use Classes\Validation\Logement as ValidationLogement;

$db_config = require('./db_config.php');
$db_logement = new Logement($db_config);
$db_user = new User($db_config);
$validation = new ValidationLogement();
$save = new Save($validation, $db_user, $db_logement);

$logement_data = $_POST;

$save->index($logement_data);
