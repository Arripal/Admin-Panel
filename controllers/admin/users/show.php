<?php

use Classes\Controllers\User\Show as ShowController;
use Classes\Database\User as Database;

$db_config = require('./db_config.php');
$database = new Database($db_config);
$user = new ShowController($database);

$user->show();
