<?php

class Crypt
{
    public function password_encryption($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function password_decryption($plain_password, $hashed_password)
    {
        return password_verify($plain_password, $hashed_password);
    }
}
