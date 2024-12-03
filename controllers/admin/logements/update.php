<?php
require_once('./Classes/Validation.php');
require_once('./Classes/Database.php');
$db_config = require('./db_config.php');
$db = new Database($db_config);
$validation = new Validation();

$updated_logement_data = $_POST;
var_dump($updated_logement_data);
die();
$corresponding_logement = $db->fetch('SELECT * FROM public.logements WHERE id = :id', [
    'id' => $updated_logement_data['id']
]);

if (empty($corresponding_logement)) {
    $_SESSION['empty'] = 'Aucun logement correspondant à votre demande';
    redirect_to("/admin/dashboard/edit");
}

$validation->validate('title', $updated_logement_data['title'], ['min', 'max', 'required']);
$validation->validate('location', $updated_logement_data['location'], ['min', 'max', 'required']);
$validation->validate('description', $updated_logement_data['description'], ['min', 'max', 'required']);
$validation->validate('cover', $updated_logement_data['cover'], ['url', 'required']);
$validation->validate('host', $updated_logement_data['host'], ['email', 'required']);
$validation->validate('tags', $updated_logement_data['tags'], ['arraystrs']);
$validation->validate('pictures', $updated_logement_data['pictures'], ['arraystrs']);
$validation->validate('equipments', $updated_logement_data['equipments'], ['arraystrs']);
$is_valid = $validation->is_valid();



if (!$is_valid) {
    $errors = $validation->get_errors();
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
