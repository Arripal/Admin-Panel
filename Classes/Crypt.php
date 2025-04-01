<?php

namespace Classes;

class Crypt
{
    static function password_encryption($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    static function password_decryption($plain_password, $hashed_password)
    {
        return password_verify($plain_password, $hashed_password);
    }
}
