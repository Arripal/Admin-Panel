<?php
require('./Classes/Session.php');
require('./Classes/Database.php');
require('./Classes/Authentification.php');

$db_config = require('./db_config.php');
$db = new Database($db_config);
$auth = new Authentification($db);

$errors = [];

try {
    $auth->verify_admin_access();

    $logements = $db->fetch_all("SELECT * FROM public.logements");
    if (count($logements) < 1) {
        $errors['empty'] = "Aucun logement n'est enregistré en base de données pour le moment.";
    }
    $db->close_connexion();

    uasort($logements, function ($a, $b) {
        return $a['id'] - $b['id'];
    });

    access_view('/admin/logements/logements.view', [
        'errors' => $errors,
        'logements' => $logements,
    ]);
} catch (\Throwable $e) {
    error_handler('La requête a échouée : ' . $e->getMessage(), 500);
}
