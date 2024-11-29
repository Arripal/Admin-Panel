<?php
require_once('./Classes/Validation.php');
require_once('./Classes/Database.php');
$db_config = require('./db_config.php');
$db = new Database($db_config);
$validation = new Validation();

$updated_logement_data = $_POST;

$corresponding_logement = $db->fetch('SELECT * FROM public.logements WHERE id = :id', [
    'id' => $updated_logement_data['id']
]);

if (empty($corresponding_logement)) {
    $session->set_message('empty', 'Aucun logement correspondant à votre demande');
    redirect_to("location:javascript://history.go(-1)");
}

$validation->validate('title', $logement_data_to_add['title'], ['min', 'max', 'required']);
$validation->validate('location', $logement_data_to_add['location'], ['min', 'max', 'required']);
$validation->validate('description', $logement_data_to_add['description'], ['min', 'max', 'required']);
$validation->validate('cover', $logement_data_to_add['cover'], ['url', 'required']);
$validation->validate('host', $logement_data_to_add['host'], ['email', 'required']);
$validation->validate('tags', $logement_data_to_add['tags'], ['arraystrs']);
$validation->validate('pictures', $logement_data_to_add['pictures'], ['arraystrs']);
$valid_equipments = $validation->validate('equipments', $logement_data_to_add['equipments'], ['arraystrs']);
$is_valid = $validation->is_valid();

if (!$is_valid) {
    $errors = $validation->get_errors();
    redirect_to('/admin/dashboard/logements/edit');
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
