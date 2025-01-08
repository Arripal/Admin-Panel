<?php

namespace Classes\Validation;

use Traits\ValidationTrait;

class Login
{

    use ValidationTrait;

    public function validate(array $user_data)
    {
        $this->email($user_data['email'])->password($user_data['password']);
        return $this->validation->valid();
    }

    private function email($value)
    {

        $valid = $this->validation->email($value);
        if (!$valid) {
            $this->validation->set_error("error-email", "L'email est invalide.");
        }
        return $this;
    }

    private function password($value)
    {
        $valid = $this->validation->password($value);
        if (!$valid) {
            $this->validation->set_error("error-password", "Le mot de passe saisie est invalide.");
        }
        return $this;
    }
}
