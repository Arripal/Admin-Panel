<?php

namespace Classes\Controllers\Logement;

use Classes\Database\Logement;
use PDOException;

class Edit
{

    private $db_logement;
    public function __construct(Logement $db_logement)
    {
        $this->db_logement = $db_logement;
    }

    public function index($logement_id)
    {
        try {

            $logement = $this->db_logement->get('id', ['id' => $logement_id]);

            if (empty($logement)) {
                $_SESSION['error'] = 'Impossible de mettre à jour le logement, il n\'existe pas en base de données.';
                redirect_to('/admin/dashboard/logements');
                die();
            }
        } catch (PDOException) {
            access_view('/not_found');
        }

        access_view('/admin/logements/edit.view', [
            'logement' => $logement
        ]);
    }
}
