<?php

namespace Classes\Controllers\User;

use Classes\Controllers\Abstractions\DeleteAbstractController;
use Classes\Database\User as Database;

class Delete extends DeleteAbstractController
{
    static $path = '/admin/dashboard/users';

    public function __construct(Database $database)
    {
        parent::__construct(
            $database,
        );
    }

    protected function error_handler()
    {
        $_SESSION['error'] = "Impossible de supprimer l'utilisateur.";
        redirect_to(static::$path);
    }
}
