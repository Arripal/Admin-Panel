<?php

use Classes\Controllers\Logement\Show;
use Classes\Database\Logement as Database_logement;

$db_config = require('./db_config.php');
$db_logement = new Database_logement($db_config);
$show = new Show();

$show->index($db_logement);
