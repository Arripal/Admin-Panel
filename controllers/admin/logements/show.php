<?php

use Classes\Controllers\Logement\Show as ShowController;
use Classes\Database\Logement as Database;

$db_config = require('./db_config.php');
$database = new Database($db_config);
$logement = new ShowController($database);

$logement->show();
