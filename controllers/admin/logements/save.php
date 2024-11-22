<?php

require('./Classes/Session.php');
require('./Classes/Database.php');
require('./Classes/Authentification.php');

$db_config = require('./db_config.php');
$db = new Database($db_config);
$auth = new Authentification($db);

$auth->verify_admin_access();

$logement_data_to_add = $_POST;



$is_valid_title = $validation->is_valid_length($logement_data_to_add['title']);
$is_valid_location = $validation->is_valid_length($logement_data_to_add['location']);
$is_valid_description = $validation->is_valid_length($logement_data_to_add['description']);
$is_valid_url = $validation->is_valid_URL($logement_data_to_add['cover']);

if (!$is_valid_location || !$is_valid_title || !$is_valid_url || !$is_valid_description) {
    redirect_to("location:javascript://history.go(-1)");
    die();
}

var_dump($logement_data_to_add);
