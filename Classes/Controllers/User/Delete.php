<?php

namespace Classes\Controllers\User;

use Classes\Database\User as DatabaseUser;
use PDOException;

class Delete
{
    public function index($identifier, DatabaseUser $database_user)
    {
        try {
            $database_user->delete('email', [
                'email' => $identifier
            ]);
        } catch (PDOException $e) {
            throw $e;
        }

        redirect_to('/admin/dashboard/users');
    }
}
