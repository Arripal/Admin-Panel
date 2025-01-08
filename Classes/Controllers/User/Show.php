<?php


namespace Classes\Controllers\User;

use Classes\Database\User as Database_user;
use PDOException;

class Show
{
    public function index(Database_user $database_user)
    {
        $errors = [];
        try {

            $users = $database_user->get_all();

            if (empty($users)) {
                $errors['empty'] = "La ressource demandée est indisponible.";
                die();
            }

            uasort($users, function ($a, $b) {
                return $a['id'] - $b['id'];
            });

            access_view('/admin/users/users.view', [
                'errors' => $errors,
                'users' => $users
            ]);
        } catch (PDOException) {
            $errors['db'] = "La ressource demandée est indisponible.";
        }
    }
}
