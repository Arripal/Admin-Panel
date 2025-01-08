<?php

namespace Classes\Validation;

use Traits\ValidationTrait;
use Respect\Validation\Validator as v;

class User
{
    use ValidationTrait;
    private const ROLES = ['admin', 'user'];

    public function validate(array $user_data)
    {
        $this
            ->name($user_data['first_name'])
            ->name($user_data['last_name'])
            ->email($user_data['email'])
            ->password($user_data['password'])
            ->picture($user_data['picture'])
            ->role($user_data['role'])
        ;

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

    public function role($value)
    {
        $value = trim($value);
        $value = strtolower($value);

        if (!v::in(self::ROLES)->validate($value)) {
            $this->validation->set_error('error-role', "Role invalide.");
        }
        return $this;
    }

    public function name($value)
    {
        if ($value == null or $value == '') {
            $this->validation->set_error("error-name", "Un nom valide est requis.");
            return $this;
        }
        if (!$this->validation->alpha($value)) {
            $this->validation->set_error("error-name", "Le nom saisie est invalide, il ne doit contenir que des lettres.");
        }
        return $this;
    }

    public function picture($value)
    {
        $valid = $this->validation->url($value);
        if (!$valid) {
            $this->validation->set_error("error-picture", "Une url valide de la photo de profil est requise.");
        }
        return $this;
    }
}
