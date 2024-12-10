<?php
require_once('./Classes/Validation.php');
require_once('./Classes/Database.php');
require_once('./Classes/LogementValidation.php');
$db_config = require('./db_config.php');
$db = new Database($db_config);
$validation = new LogementValidation();

$updated_logement_data = $_POST;

$corresponding_logement = $db->fetch('SELECT * FROM public.logements WHERE id = :id', [
    'id' => $updated_logement_data['id']
]);

if (empty($corresponding_logement)) {
    $_SESSION['empty'] = 'Aucun logement correspondant à votre demande';
    redirect_to($_SERVER['HTTP_REFERER']);
}

$is_valid = $validation->validate_logement($updated_logement_data);

if (!$is_valid) {
    $errors = $validation->get_validation_errors();
    $_SESSION['errors'] = $errors;
    redirect_to($_SERVER['HTTP_REFERER']);
    die();
}

try {

    $equipments_db = set_array_to_db_insertion($updated_logement_data['equipments']);

    $db->db_query(
        'UPDATE public.logements SET 
                title = :title,
                location = :location,
                cover = :cover,
                description = :description,
                equipments = :equipments
            WHERE id = :id',
        [
            'id' => strip_tags($updated_logement_data['id']),
            'title' => strip_tags($updated_logement_data['title']),
            'location' => strip_tags($updated_logement_data['location']),
            'cover' => $updated_logement_data['cover'],
            'description' => strip_tags($updated_logement_data['description']),
            'equipments' => $equipments_db
        ]
    );

    redirect_to('/admin/dashboard/logements');
} catch (PDOException $e) {
    throw $e;
} finally {
    $db->close_connexion();
}
