<?php

namespace Classes\Controllers\User;

use Traits\UserTrait;

class Update
{

    use UserTrait;

    public function index($user_data)
    {
        $this->validate_credentials($user_data);

        $error_message = 'Impossible d\éditer l\'utilisateur, aucune correspondance en base de données.';

        $user = $this->database_user->get('email', ['email' => $user_data['email']]);

        if (!$user) {
            $_SESSION['empty_user'] = $error_message;
            redirect_to($_SERVER['HTTP_REFERER']);
            die();
        }

        $user_data = $this->formating_data($user_data);

        $this->database_user->update($user_data);
        redirect_to('/admin/dashboard/users');
    }
}
