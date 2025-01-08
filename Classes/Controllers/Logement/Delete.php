<?php

namespace Classes\Controllers\Logement;

use Classes\Database\Logement as Database_logement;
use PDOException;

class Delete
{
    public function index($identifier, Database_logement $database_logement)
    {
        try {
            $database_logement->delete('id', ['id' => $identifier]);
        } catch (PDOException $e) {
            throw $e;
        }

        redirect_to('/admin/dashboard/logements');
    }
}
