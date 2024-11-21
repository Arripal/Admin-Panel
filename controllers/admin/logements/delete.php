<?php

require('./Classes/Database.php');
require('./Classes/Session.php');
$db_config = require('./db_config.php');

$session = new Session();
$db = new Database($db_config);

$data = $_POST;
$errors = [];

try {
    $corresponding_logement = $db->fetch('SELECT * FROM public.logements WHERE id = :id', [
        'id' => $data['logement_id']
    ]);

    if (empty($corresponding_logement)) {
        $errors['empty'] = 'Impossible de supprimer le logement car il n\'existe pas en base données ! ';
        access_view('/not_found', [
            'errors' => $errors
        ]);
        die();
    }

    $db->db_query('DELETE FROM public.logements WHERE id = :id', [
        'id' => $data['logement_id']
    ]);

    redirect_to('/admin/dashboard/logements');
} catch (PDOException $e) {
    throw $e;
} finally {
    $db->close_connexion();
}
