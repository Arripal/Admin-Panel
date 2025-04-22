<?php

namespace Classes\Controllers\User;

use Classes\Controllers\Abstractions\EditAbstractController;
use Classes\Database\User as Database;

class Edit extends EditAbstractController
{

    private $path = '/admin/dashboard/users';
    private $view = '/admin/users/edit.view';

    public function __construct(Database $database)
    {
        parent::__construct(
            $database,
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
            'user' => $data
        ]);
    }
}
