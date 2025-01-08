<?php

use Classes\Controllers\User;
use Classes\Controllers\User\Edit;
use Classes\Database\User as DatabaseUser;

$db_config = require('./db_config.php');

$database_user = new DatabaseUser($db_config);
$edit = new Edit();

$user_id = $_GET['id'];

$edit->index($user_id, $database_user);
