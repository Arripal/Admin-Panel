<?php

use Classes\Controllers\User\Show;
use Classes\Database\User as DatabaseUser;

$db_config = require('./db_config.php');
$database_user = new DatabaseUser($db_config);
$show = new Show();

$show->index($database_user);
