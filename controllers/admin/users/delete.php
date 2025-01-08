<?php

use Classes\Controllers\User\Delete;
use Classes\Database\Database;
use Classes\Database\User as DatabaseUser;

$db_config = require('./db_config.php');
$db = new Database($db_config);

$data = $_POST;

$db_config = require('./db_config.php');

$database_user = new DatabaseUser($db_config);
$delete = new Delete();

$delete->index($data['user_email'], $database_user);
