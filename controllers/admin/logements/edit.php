<?php

require('./Classes/Session.php');
require('./Classes/Database.php');
require('./Classes/Authentification.php');

$db_config = require('./db_config.php');
$db = new Database($db_config);
$auth = new Authentification($db);

$logement_id = $_GET['id'];
$errors = [];
$logement = null;

$auth->verify_admin_access();

try {

    $logement = $db->fetch("SELECT * FROM public.logements WHERE id= :id ", [
        'id' => $logement_id
    ]);

    if (empty($logement)) {
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



access_view('/admin/logements/edit.view', [
    'logement' => $logement
]);
