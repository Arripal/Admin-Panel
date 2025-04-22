<?php

namespace Classes\Controllers\Logement;

use Classes\Controllers\Abstractions\EditAbstractController;
use Classes\Database\Logement as Database;

class Edit extends EditAbstractController
{
    static $path = '/admin/dashboard/logements';
    private $view = '/admin/logements/edit.view';

    public function __construct(Database $database)
    {
        parent::__construct(
            $database
        );
    }

    protected function error_handler()
    {
        $_SESSION['error'] = 'Aucun résultat correspondant à votre demande';
        redirect_to(static::$path);
        die();
    }

    protected function render($data)
    {
        access_view($this->view, [
            'logement' => $data
        ]);
    }
}
