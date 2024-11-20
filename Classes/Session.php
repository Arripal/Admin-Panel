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
        session_unset();
        session_destroy();
    }
}
