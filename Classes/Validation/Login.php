<?php

namespace Classes\Validation;

class Login extends Validation
{

    public function validate(array $user_data)
    {
        $this->is_email($user_data['email'])->is_password($user_data['password']);
        return $this->valid();
    }

    private function is_email($value)
    {

        $valid = $this->email($value);
        if (!$valid) {
            $this->set_error("error-email", "L'email est invalide.");
        }
        return $this;
    }

    private function is_password($value)
    {
        $valid = $this->password($value);
        if (!$valid) {
            $this->set_error("error-password", "Le mot de passe saisie est invalide.");
        }
        return $this;
    }
}
