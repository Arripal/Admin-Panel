<?php

namespace Classes;

class Session
{
    public function create_session($params = [])
    {
        $this->start_session();
        foreach ($params as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public function start_session()
    {
        session_start();
    }
    public function close_session()
    {
        $this->empty();

        if (ini_get("session.use_cookies")) {
            $session_params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $session_params['path'], $session_params['domain'], $session_params['secure'], $session_params['httponly']);
        }
        session_unset();
        session_destroy();
        session_write_close();
    }

    private function empty()
    {
        $_SESSION = [];
    }
}
