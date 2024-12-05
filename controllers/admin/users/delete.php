<?php
require_once('./Classes/Database.php');
$db_config = require('./db_config.php');
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

    $db->delete_one('DELETE FROM public.user WHERE email = :email', [
        'email' => $corresponding_user['email']
    ]);

    $db->delete_one('DELETE FROM public.logements WHERE host = :host', [
        'host' => $corresponding_user['email']
    ]);
    redirect_to('/admin/dashboard/users');
} catch (PDOException $e) {
    throw $e;
} finally {
    $db->close_connexion();
}
