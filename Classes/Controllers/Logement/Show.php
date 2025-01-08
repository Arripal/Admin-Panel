<?php

namespace Classes\Controllers\Logement;

use Classes\Database\Logement as Database_logement;
use PDOException;

class Show
{
    public function index(Database_logement $database_logement)
    {
        $errors = [];
        try {
            $logements = $database_logement->get_all();

            if (empty($logements)) {
                $errors['empty'] = "La ressource demandée est indisponible.";
            }
        } catch (PDOException) {
            $errors['db'] = "La ressource demandée est indisponible.";
        }

        uasort($logements, function ($a, $b) {
            return $a['id'] - $b['id'];
        });

        access_view('/admin/logements/logements.view', [
            'errors' => $errors,
            'logements' => $logements
        ]);
    }
}
