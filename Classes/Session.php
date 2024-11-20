<?php

class Session
{
    public function create_session($params = [])
    {
        session_start();
        foreach ($params as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }


    public function close_session()
    {
        session_unset();
        session_destroy();
    }
}
