<?php

class UserValidation
{
    private $validation;

    public function __construct()
    {
        $this->validation = new Validation();
    }

    public function validate_user(array $user_data)
    {
        $this->validation->validate('first_name', $user_data['first_name'], ['required']);
        $this->validation->validate('last_name', $user_data['last_name'], ['required']);
        $this->validation->validate('email', $user_data['email'], ['required', 'email']);
        $this->validation->validate('password', $user_data['password'], ['password']);
        $this->validation->validate('role', $user_data['role'], ['required', 'role']);
        $is_valid = $this->validation->is_valid();

        return $is_valid;
    }

    public function get_validation_errors()
    {
        return $this->validation->get_errors();
    }
}
