<?php

namespace Classes;

use Classes\Session;

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

        if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
            redirect_to('/admin/login');
            $this->session->close_session();
        }

        return true;
    }

    public function is_authenticated()
    {
        $this->session->start_session();
        return isset($_SESSION['admin_id']);
    }
}
