<?php

require('./Classes/Response.php');
require('./Classes/Database.php');
$db_config = require('./db_config.php');
$db = new Database($db_config);
$response = new Response();

try {

    $result = $db->fetch_all("SELECT * FROM public.logements");

    if (empty($result)) {
        return $response->send_json_response(null, 'error', "Aucun résultat correspondant à votre demande.", 404);
    }

    $response->send_json_response($result);
} catch (PDOException $exception) {
    $response->send_json_response(null, 'error', "Une erreur est survenue : {$exception->getMessage()} ", 500);
} finally {
    $db->close_connexion();
}
