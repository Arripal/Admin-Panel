<?php

use Classes\Controllers\User\Edit as EditController;
use Classes\Database\User as Database;

$db_config = require('./db_config.php');

$database = new Database($db_config);
$user = new EditController($database);

$user_id = strip_tags($_GET['id']);

$user->edit($user_id);
