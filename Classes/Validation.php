<?php

class Validation
{

    private $MIN_LENGTH = 5;
    private $MAX_LENGTH = 255;


    public function is_valid_password(string $password)
    {
        $password = trim($password);
        $is_valid_length = $this->is_valid_length($password);
        $is_valid_type = $this->is_valid_type($password, 'string');

        if (!$is_valid_length || !$is_valid_type) {
            return false;
        }

        return true;
    }

    public function is_valid_type($data, $type)
    {
        return gettype($data) === $type;
    }


    public function is_valid_email($email)
    {
        $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);

        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function is_valid_URL($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }


    public function is_valid_length($string)
    {
        return strlen($string) >= $this->MIN_LENGTH && strlen($string) <= $this->MAX_LENGTH;
    }

    public function validate_max_length($string)
    {
        return strlen($string) <= $this->MAX_LENGTH;
    }
}
