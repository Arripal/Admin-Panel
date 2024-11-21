<?php
require('./Classes/Session.php');
require('./Classes/Database.php');
require('./Classes/Authentification.php');

$db_config = require('./db_config.php');
$db = new Database($db_config);
$auth = new Authentification($db);

$errors = [];
$logements = null;

$auth->verify_admin_access();

try {

    $logements = $db->fetch_all("SELECT * FROM public.logements");

    if (empty($logements)) {
        $errors['empty'] = "La ressource demandée est indisponible.";
    }
} catch (PDOException $e) {
    $errors['db'] = "La ressource demandée est indisponible.";
} finally {
    $db->close_connexion();
}


if (!empty($logements)) {
    uasort($logements, function ($a, $b) {
        return $a['id'] - $b['id'];
    });
}

access_view('/admin/logements/logements.view', [
    'errors' => $errors,
    'logements' => $logements
]);
