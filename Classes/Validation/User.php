<?php

namespace Classes\Validation;

use Interfaces\ValidationInterface;
use Respect\Validation\Validator as v;

class User extends Validation implements ValidationInterface
{

    private const ROLES = ['admin', 'user'];

    public function validate(array $user_data)
    {
        $this
            ->name($user_data['first_name'])
            ->name($user_data['last_name'])
            ->is_email($user_data['email'])
            ->is_password($user_data['password'])
            ->picture($user_data['picture'])
            ->role($user_data['role'])
        ;

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

    public function role($value)
    {
        $value = trim($value);
        $value = strtolower($value);

        if (!v::in(self::ROLES)->validate($value)) {
            $this->set_error('error-role', "Role invalide.");
        }
        return $this;
    }

    public function name($value)
    {
        if ($value == null or $value == '') {
            $this->set_error("error-name", "Un nom valide est requis.");
            return $this;
        }
        if (!$this->alpha($value)) {
            $this->set_error("error-name", "Le nom saisie est invalide, il ne doit contenir que des lettres.");
        }
        return $this;
    }

    public function picture($value)
    {
        $valid = $this->url($value);
        if (!$valid) {
            $this->set_error("error-picture", "Une url valide de la photo de profil est requise.");
        }
        return $this;
    }
}
