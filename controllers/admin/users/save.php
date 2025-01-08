<?php

use Classes\Controllers\User\Save;
use Classes\Crypt;
use Classes\Database\User as DatabaseUser;
use Classes\Validation\User as ValidationUser;

$db_config = require('./db_config.php');

$database_user = new DatabaseUser($db_config);
$validation_user = new ValidationUser();
$crypt = new Crypt();
$save = new Save($database_user, $validation_user, $crypt);

$user_data = $_POST;
$save->index($user_data);
