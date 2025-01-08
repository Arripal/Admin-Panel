<?php

use Classes\Controllers\Logement\Delete;
use Classes\Database\Logement as Database_logement;

$db_config = require('./db_config.php');
$db_logement = new Database_logement($db_config);
$delete = new Delete($db_logement);

$data = $_POST;

$delete->index($data['logement_id'], $db_logement);
