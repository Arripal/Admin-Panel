<?php

class Authentification
{

    private $db;
    private $session;

    public function __construct($db)
    {
        $this->db = $db;
        $this->session = new Session();
    }

    public function verify_existing_admin($email, $password)
    {

        $existing_admin = $this->db->fetch('SELECT * FROM "user" where email = :email AND password = :password AND role = \'admin\'', [
            'email' => $email,
            'password' => $password,
        ]);

        $this->db->close_connexion();

        if (!$existing_admin) {
            http_response_code(403);
            return false;
        }

        return $existing_admin;
    }


    public function verify_admin_access()
    {
        $this->session->start_session();
        if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
            $this->session->close_session();

            redirect_to('/admin/login');
        }
    }
}
