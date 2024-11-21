<?php

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
        session_unset();

        session_destroy();
    }

    private function empty()
    {
        $_SESSION = [];
    }

    public function set_message($key, $message)
    {
        $_SESSION[$key] = $message;
    }

    public function get_message($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function delete_message($key)
    {
        unset($_SESSION[$key]);
    }
}
