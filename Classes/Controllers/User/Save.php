<?php

namespace Classes\Controllers\User;

use Traits\UserTrait;

class Save
{

    use UserTrait;

    public function index($user_data)
    {
        $this->validate_credentials($user_data);

        $error_message = 'Cette adresse mail est déjà utilisée.';

        $this->check_existing_user($user_data['email'], $error_message);

        $user_data = $this->formating_data($user_data);

        $this->database_user->save($user_data);

        redirect_to('/admin/dashboard/users');
    }
}
