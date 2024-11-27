<?php
require_once('./Classes/Database.php');
$db_config = require('./db_config.php');
$db = new Database($db_config);


$user_id = $_GET['id'];
$errors = [];
$user = null;



try {

    $user = $db->fetch("SELECT * FROM public.user WHERE id= :id ", [
        'id' => $user_id
    ]);

    if (empty($user)) {
        $errors['empty'] = 'Aucun résultat correspondant à votre demande';
        access_view('/not_found', [
            'errors' => $errors
        ]);
    }
} catch (PDOException $e) {
    $errors['db'] = "Impossible d\'acceder à la ressource demandée.";
    access_view('/not_found', [
        'errors' => $errors
    ]);
} finally {
    $db->close_connexion();
}



access_view('/admin/users/edit.view', [
    'user' => $user
]);
