<?php

class Authentification
{

    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function verify_admin_access()
    {
        $this->session->start_session();
        if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'ADMIN') {
            $this->session->close_session();

            redirect_to('/admin/login');
        }
    }
}
