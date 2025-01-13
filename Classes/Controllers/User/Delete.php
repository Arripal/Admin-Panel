<?php

namespace Classes\Controllers\User;

use Classes\Controllers\Abstractions\DeleteAbstractController;
use Classes\Database\User as Database;

class Delete extends DeleteAbstractController
{

    public function __construct(Database $database)
    {
        parent::__construct(
            $database,
            '/admin/dashboard/users'
        );
    }

    protected function error_handler()
    {
        $_SESSION['error'] = "Impossible de supprimer l'utilisateur.";
        redirect_to($this->path);
    }
}
