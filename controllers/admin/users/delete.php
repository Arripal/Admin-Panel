<?php

require('./Classes/Database.php');
require('./Classes/Session.php');
$db_config = require('./db_config.php');

$session = new Session();
$db = new Database($db_config);

$data = $_POST;
$errors = [];

try {
    $corresponding_user = $db->fetch('SELECT * FROM public.user WHERE id = :id', [
        'id' => $data['user_id']
    ]);

    if (empty($corresponding_user)) {
        $errors['empty'] = 'Impossible de supprimer l\'utilisateur car il n\'existe pas en base données ! ';
        access_view('/not_found', [
            'errors' => $errors
        ]);
        die();
    }

    $db->db_query('DELETE FROM public.user WHERE id = :id', [
        'id' => $data['user_id']
    ]);

    redirect_to('/admin/dashboard/users');
} catch (PDOException $e) {
    throw $e;
} finally {
    $db->close_connexion();
}
