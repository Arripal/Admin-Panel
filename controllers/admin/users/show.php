<?php
require_once('./Classes/Database.php');
$db_config = require('./db_config.php');
$db = new Database($db_config);

$errors = [];
$users = null;

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
