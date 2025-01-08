<?php

namespace Classes\Controllers\User;

use Classes\Crypt;
use Classes\Database\User as Database_user;
use Classes\Session;
use Classes\Validation\Login as validator;

class Login
{
    private validator $login;
    private Database_user $database_user;
    private Crypt $crypt;
    private Session $session;

    public function __construct(validator $login, Database_user $database_user, Crypt $crypt, Session $session)
    {
        $this->login = $login;
        $this->database_user = $database_user;
        $this->crypt = $crypt;
        $this->session = $session;
    }

    public function login($user_data)
    {
        if (!$this->login->validate($user_data)) {
            access_view([
                'errors' => $this->login->get_errors()
            ]);
        }

        $existing_user = $this->database_user->get('email', [
            'email' => $user_data['email']
        ]);
        if (!$existing_user) {
            access_view([
                'user_error' => 'Les données fournies sont incorrectes.'
            ]);
        }

        $matching_passwords = $this->crypt->password_decryption($user_data['password'], $existing_user['password']);

        if (!$matching_passwords) {
            access_view([
                'user_error' => 'Les données fournies sont incorrectes.'
            ]);
        }

        $this->session->create_session([
            'role' => $existing_user['role'],
            'admin_id' => $existing_user['id']
        ]);

        redirect_to('/admin/dashboard');
    }
}
