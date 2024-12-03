<?php
require_once('./Classes/Database.php');
require_once('./Classes/Validation.php');
$db_config = require('./db_config.php');
$db = new Database($db_config);
$validation = new Validation();

$logement_data_to_add = $_POST;

$validation->validate('title', $logement_data_to_add['title'], ['min', 'max', 'required']);
$validation->validate('location', $logement_data_to_add['location'], ['min', 'max', 'required']);
$validation->validate('description', $logement_data_to_add['description'], ['min', 'max', 'required']);
$validation->validate('cover', $logement_data_to_add['cover'], ['url', 'required']);
$validation->validate('host', $logement_data_to_add['host'], ['email', 'required']);
$validation->validate('tags', $logement_data_to_add['tags'], ['arraystrs'], 'required');
$validation->validate('pictures', $logement_data_to_add['pictures'], ['arraystrs'], 'required');
$validation->validate('equipments', $logement_data_to_add['equipments'], ['arraystrs'], 'required');
$is_valid = $validation->is_valid();

if (!$is_valid) {
    $errors = $validation->get_errors();
    $_SESSION['errors'] = $errors;
    redirect_to($_SERVER['HTTP_REFERER']);
    die();
}

$user = $db->fetch("SELECT * FROM public.user WHERE email= :email ", [
    'email' => $logement_data_to_add['host']
]);

if (!$user) {
    $_SESSION['user_error'] = 'Impossible d\'enregistrer ce logement,pas d\'utilisateur correspondant en base de données.';
    redirect_to($_SERVER['HTTP_REFERER']);
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
