<?php

namespace Classes\Controllers\User;

use Classes\Crypt;
use Classes\Database\User as Database;
use Classes\Session;
use Classes\Validation\Login as Validation;

class Login
{
    private Validation $login;
    private Database $database;
    private Session $session;

    public function __construct(Validation $login, Database $database, Session $session)
    {
        $this->login = $login;
        $this->database = $database;
        $this->session = $session;
    }

    public function login($data)
    {

        if (!$this->login->validate($data)) {
            access_view('admin/login.view', [
                'errors' => $this->login->get_errors()
            ]);
        }

        $user = $this->database->get('email', [
            'email' => $data['email']
        ]);

        if (!$user) {
            access_view('admin/login.view', [
                'user_error' => 'Les données fournies sont incorrectes.'
            ]);
        }

        $matching_passwords = Crypt::password_decryption($data['password'], $user['password']);

        if (!$matching_passwords) {
            access_view('admin/login.view', [
                'user_error' => 'Les données fournies sont incorrectes.'
            ]);
        }

        $this->session->create_session([
            'role' => $user['role'],
            'admin_id' => $user['id']
        ]);

        redirect_to('/admin/dashboard');
    }
}
