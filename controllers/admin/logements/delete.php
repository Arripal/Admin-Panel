<?php

require_once('./Classes/Database.php');
require_once('./Classes/Session.php');
$db_config = require('./db_config.php');
$session = new Session();
$db = new Database($db_config);

$data = $_POST;

try {
    $corresponding_logement = $db->fetch('SELECT * FROM public.logements WHERE id = :id', [
        'id' => $data['logement_id']
    ]);

    if (empty($corresponding_logement)) {
        $_SESSION['error'] = 'Impossible de mettre à jour le logement, il n\'existe pas en base de données.';
        redirect_to('/admin/dashboard/logements');
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
