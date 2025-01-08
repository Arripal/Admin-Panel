<?php

namespace Classes\Controllers\User;

use Classes\Database\User as DatabaseUser;

class Edit
{
    public function index($identifier, DatabaseUser $database_user)
    {
        $errors = [];

        $user = $database_user->get('id', ['id' => $identifier]);
        if (empty($user)) {
            $errors['empty'] = 'Aucun résultat correspondant à votre demande';
            access_view('/not_found', [
                'errors' => $errors
            ]);
        }

        access_view('/admin/users/edit.view', [
            'user' => $user
        ]);
    }
}
