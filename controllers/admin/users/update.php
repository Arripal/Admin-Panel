<?php

use Classes\Controllers\User\Update;
use Classes\Crypt;
use Classes\Database\User as DatabaseUser;
use Classes\Validation\User as ValidationUser;

$db_config = require('./db_config.php');
$database_user = new DatabaseUser($db_config);
$validation_user = new ValidationUser();
$crypt = new Crypt();
$update = new Update($database_user, $validation_user, $crypt);

$user_data = $_POST;
$user_data = array_diff_key($_POST, ['_method' => '']);
$update->index($user_data);
