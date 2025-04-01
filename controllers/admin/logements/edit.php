<?php

use Classes\Controllers\Logement\Edit as EditController;
use Classes\Database\Logement as Database;

$db_config = require('./db_config.php');
$database = new Database($db_config);
$logement = new EditController($database);

$logement_id = strip_tags(trim($_GET['id']));

$logement->edit($logement_id);
