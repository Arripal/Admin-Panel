<?php

require('./Classes/Session.php');
require('./Classes/Database.php');
require('./Classes/Authentification.php');

$db_config = require('./db_config.php');
$db = new Database($db_config);
$auth = new Authentification($db);



$logement_id = $_GET['id'];

$auth->verify_admin_access();

$logement = $db->fetch("SELECT * FROM public.logements WHERE id= :id ", [
    'id' => $logement_id
]);

if (empty($logement)) {
    redirect_to('/admin/dashboard/not_found');
}

$db->close_connexion();

access_view('/admin/logements/edit.view', [
    'logement' => $logement
]);
