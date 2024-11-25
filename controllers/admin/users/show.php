<?php
require('./Classes/Session.php');
require('./Classes/Database.php');
require('./Classes/Authentification.php');

$db_config = require('./db_config.php');
$db = new Database($db_config);
$auth = new Authentification($db);

$errors = [];
$users = null;

$auth->verify_admin_access();

try {

    $users = $db->fetch_all("SELECT * FROM public.user");

    if (empty($users)) {
        $errors['empty'] = "La ressource demandée est indisponible.";
    }
} catch (PDOException $e) {
    $errors['db'] = "La ressource demandée est indisponible.";
} finally {
    $db->close_connexion();
}


if (!empty($users)) {
    uasort($users, function ($a, $b) {
        return $a['id'] - $b['id'];
    });
}

access_view('/admin/users/users.view', [
    'errors' => $errors,
    'users' => $users
]);
