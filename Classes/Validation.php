<?php
class Validation
{
    private $errors = [];
    private $validators = [
        'min' => 'minlength',
        'max' => 'maxlength',
        'email' => 'is_email',
        'url' => 'is_url',
        'password' => 'is_password',
        'required' => 'is_required',
        'arraystrs' => 'is_array_of_string',
        'rating' => 'is_rating',
        'role' => 'is_valid_role'
    ];
    private $lengths = [
        'minlength' => 5,
        'maxlength' => 255
    ];
    private $rating_values = [
        'min' => 0,
        'max' => 5
    ];

    private $roles = ['admin', 'user'];
    private $name;

    private function set_name($name)
    {
        $this->name = $name;
    }

    private function get_validator($rule)
    {
        $validator_exists = $this->validators[$rule];

        if (!$validator_exists) {
            return $this->errors['missing'] = "Impossible de valider le champ {$rule}";
        }
        return $validator_exists;
    }

    public function validate($name, $value, $validators = [])
    {
        $this->set_name($name);
        foreach ($validators as $validator) {
            $method = $this->get_validator($validator);
            $this->$method($value);
        }
    }

    private function minlength($value)
    {
        if (!is_string($value)) {
            return $this->errors["{$this->name}-type"] = "Le champ {$this->name} n'est pas du type requis.";
        }
        if (strlen($value) < $this->lengths['minlength']) {
            return  $this->errors["{$this->name}-minlength"] = "Le champ {$this->name} n'a pas la longueur minimum requise.";
        }

        return true;
    }

    private function is_rating($value)
    {

        if ($value == '' || $value === null) {
            return  $this->errors["{$this->name}-value"] = "La note n'est pas valide, elle doit être comprise entre {$this->rating_values['min']} et {$this->rating_values['max']}.";
        }

        if ($value < $this->rating_values['min'] || $value > $this->rating_values['max']) {
            return  $this->errors["{$this->name}-value"] = "La note n'est pas valide, elle doit être comprise entre {$this->rating_values['min']} et {$this->rating_values['max']}.";
        }
        return true;
    }
    private function maxlength($value)
    {
        if (!is_string($value)) {
            return  $this->errors["{$this->name}-type"] = "Le champ {$this->name} n'est pas valide.";
        }

        if (strlen($value) > $this->lengths['maxlength']) {
            return $this->errors["{$this->name}-maxlength"] = "Le champ {$this->name} n'a pas la longueur maximum requise.";
        }

        return true;
    }

    private function is_email($value)
    {
        $email_valid = filter_var($value, FILTER_VALIDATE_EMAIL);
        if (!$email_valid) {
            return $this->errors["{$this->name}-email"] = "L'{$this->name} est invalide. ";
        }
        return true;
    }

    private function is_url($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            return $this->errors["{$this->name}-URL"] = "L'url est invalide. ";
        }
        return true;
    }

    private function is_required($value)
    {
        if ($value == '' || $value == null) {
            return $this->errors["{$this->name}-required"] = "Ce champ est requis. ";
        }
        return true;
    }

    public function is_password($value)
    {
        $pattern = '/^.{5,}$/';
        $password_valid = preg_match($pattern, $value);

        if (!$password_valid) {
            return $this->errors['password'] = "Mot de passe invalide, il doit contenir au minimum {$this->lengths['minlength']} caractères.";
        }
        return true;
    }

    private function is_array_of_string($value)
    {
        foreach ($value as $item) {
            if (!is_string($item)) {
                return $this->errors["{$this->name}-array-item-type"] = 'Les éléments passés sont invalides.';
            }
        }
    }

    private function is_valid_role($value)
    {
        $value = trim($value);
        $value = strtolower($value);
        $is_valid = array_search($value, $this->roles);

        if ($is_valid === false) {
            return $this->errors["{$this->name}-role"] = 'Role invalide.';
        }
        return true;
    }

    public function is_valid()
    {
        if (!empty($this->errors)) {
            return false;
        }
        return true;
    }

    public function get_errors()
    {
        if (!empty($this->errors)) {
            return $this->errors;
        }
        return false;
    }
}
