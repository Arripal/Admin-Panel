<?php

namespace Classes\Controllers\Logement;

use Classes\Controllers\Abstractions\EditAbstractController;
use Classes\Database\Logement as Database;

class Edit extends EditAbstractController
{

    public function __construct(Database $database)
    {
        parent::__construct(
            $database,
            '/admin/dashboard/logements',
            '/admin/logements/edit.view'
        );
    }

    protected function error_handler()
    {
        $_SESSION['error'] = 'Aucun résultat correspondant à votre demande';
        redirect_to($this->path);
        die();
    }

    protected function render($data)
    {
        access_view($this->view, [
            'logement' => $data
        ]);
    }
}
