<?php
require_once('./Classes/Database.php');
require_once('./Classes/Validation.php');
require_once('./Classes/LogementValidation.php');
$db_config = require('./db_config.php');
$db = new Database($db_config);
$validation = new LogementValidation();

$logement_data_to_add = $_POST;
$is_valid_logement = $validation->validate_logement($logement_data_to_add);

if (!$is_valid_logement) {
    $errors = $validation->get_validation_errors();
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
            rating,
            tags
        ) VALUES (
            :title, 
            :host,
            :location, 
            :cover, 
            :description, 
            :pictures, 
            :equipments, 
            :rating,
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
            'rating' => strip_tags($logement_data_to_add['rating']),
            'tags' => $tags_db
        ]
    );

    redirect_to('/admin/dashboard/logements');
} catch (PDOException $e) {
    throw $e;
} finally {
    $db->close_connexion();
}
