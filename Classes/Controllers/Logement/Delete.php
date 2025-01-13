<?php

namespace Classes\Controllers\Logement;

use Classes\Controllers\Abstractions\DeleteAbstractController;
use Classes\Database\Logement as Database;

class Delete extends DeleteAbstractController
{
    public function __construct(Database $database)
    {
        parent::__construct(
            $database,
            '/admin/dashboard/logements'
        );
    }

    protected function error_handler()
    {
        $_SESSION['error'] = "Impossible de supprimer le logement.";
        redirect_to($this->path);
    }
}
