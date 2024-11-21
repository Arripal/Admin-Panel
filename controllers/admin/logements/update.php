<?php
require('./Classes/Validation.php');
require('./Classes/Authentification.php');
require('./Classes/Database.php');
require('./Classes/Session.php');
$db_config = require('./db_config.php');

$session = new Session();
$db = new Database($db_config);
$validation = new Validation();

$data = $_POST;


$corresponding_logement = $db->fetch('SELECT * FROM public.logements WHERE id = :id', [
    'id' => $data['id']
]);


if (count($corresponding_logement) < 1) {
    $session->set_message('empty', 'Aucun logement correspondant à votre demande');
    redirect_to("location:javascript://history.go(-1)");
}

// Seuls ces deux éléments doivent avoir une valeur en DB, le reste peut être null

$is_valid_title = $validation->is_valid_length($data['title']);
$is_valid_location = $validation->is_valid_length($data['location']);


if (!$is_valid_location || !$is_valid_title) {
    redirect_to("location:javascript://history.go(-1)");
    die();
}

try {

    $equipments_db = '{' . implode(',', array_map(function ($item) {
        return '"' . str_replace('"', '\\"', $item) . '"';
    }, $data['equipments'])) . '}';

    $db->db_query(
        'UPDATE public.logements SET 
                title = :title,
                location = :location,
                cover = :cover,
                description = :description,
                equipments = :equipments
            WHERE id = :id',
        [
            'id' => $data['id'],
            'title' => $data['title'], //string
            'location' => $data['location'], //string
            'cover' => $data['cover'], //url
            'description' => $data['description'], //string
            'equipments' => $equipments_db

        ]
    );

    redirect_to('/admin/dashboard/logements');
} catch (\Throwable $e) {
    throw $e;
}

//TODO : Afficher via les sessions les messages d'erreurs