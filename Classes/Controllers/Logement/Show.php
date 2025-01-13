<?php

namespace Classes\Controllers\Logement;

use Classes\Controllers\Abstractions\ShowAbstractController;
use Classes\Database\Logement as Database;


class Show extends ShowAbstractController
{

    public function __construct(Database $database)
    {
        parent::__construct(
            $database,
            '/admin/logements/logements.view'
        );
    }

    protected function error_handler()
    {
        $this->errors['empty'] = "Il n'y a aucun logement disponible pour le moment.";
        $this->render(['errors' => $this->errors]);
    }

    protected function render($entities)
    {
        access_view($this->view, $entities);
        die();
    }
}
