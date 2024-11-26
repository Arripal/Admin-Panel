<?php

require('./Classes/Session.php');
require('./Classes/Database.php');
require('./Classes/Authentification.php');
require('./Classes/Validation.php');

$db_config = require('./db_config.php');
$db = new Database($db_config);
$auth = new Authentification($db);
$validation = new Validation();

$auth->verify_admin_access();

$logement_data_to_add = $_POST;

$is_valid_title = $validation->is_valid_length($logement_data_to_add['title']);
$is_valid_location = $validation->is_valid_length($logement_data_to_add['location']);
$is_valid_description = $validation->is_valid_length($logement_data_to_add['description']);
$is_valid_url = $validation->is_valid_URL($logement_data_to_add['cover']);

if (!$is_valid_location || !$is_valid_title || !$is_valid_url || !$is_valid_description) {
    redirect_to('/admin/dashboard/not_found');
}

$user = $db->fetch("SELECT * FROM public.user WHERE email= :email ", [
    'email' => $logement_data_to_add['host']
]);

if (!$user) {
    redirect_to('/admin/dashboard/not_found');
}

try {

    $equipments_db =  set_array_to_db_insertion($logement_data_to_add['equipments']);
    $tags_db =  set_array_to_db_insertion($logement_data_to_add['tags']);
    $pictures_db =  set_array_to_db_insertion($logement_data_to_add['pictures']);

    $db->db_query(
        'INSERT INTO public.logements (
            title, 
            host,
            location, 
            cover, 
            description, 
            pictures, 
            equipments, 
            tags
        ) VALUES (
            :title, 
            :host,
            :location, 
            :cover, 
            :description, 
            :pictures, 
            :equipments, 
            :tags
        )',
        [
            'title' => strip_tags($logement_data_to_add['title']),
            'host' => strip_tags($logement_data_to_add['host']),
            'location' => strip_tags($logement_data_to_add['location']),
            'cover' => $logement_data_to_add['cover'],
            'description' => strip_tags($logement_data_to_add['description']),
            'pictures' => $pictures_db,
            'equipments' => $equipments_db,
            'tags' => $tags_db
        ]
    );

    redirect_to('/admin/dashboard/logements');
} catch (PDOException $e) {
    throw $e;
} finally {
    $db->close_connexion();
}
