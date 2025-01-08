<?php

use Classes\Controllers\Logement\Edit;
use Classes\Database\Logement;

$db_config = require('./db_config.php');
$db_logement = new Logement($db_config);
$edit = new Edit($db_logement);

$logement_id = $_GET['id'];

$edit->index($logement_id);
