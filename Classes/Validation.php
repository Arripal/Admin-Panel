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
        'role' => 'is_valid_role'
    ];
    private $lengths = [
        'minlength' => 5,
        'maxlength' => 255
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


    private function maxlength($value)
    {
        if (!is_string($value)) {
            return  $this->errors["{$this->name}-type"] = "Le champ {$this->name} n'est pas du type requis.";
        }

        if (strlen($value) < $this->lengths['maxlength']) {
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
            return $this->errors["{$this->name}-required"] = "Le champ {$this->name} est requis. ";
        }
        return true;
    }

    private function is_password($value)
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
        if (!is_array($value)) {
            return $this->errors['array-type'] = "La valeur passée n'est pas un tableau";
        }

        foreach ($value as $item) {
            if (!is_string($item)) {
                return $this->errors['array-item-type'] = 'Les éléments du tableau doivent être de type string.';
            }
        }
    }

    private function is_valid_role($value)
    {
        $value = trim($value);
        $value = strtolower($value);

        $is_valid = array_search($value, $this->roles, true);
        if (!$is_valid) {
            return $this->errors['role'] = 'Role invalide.';
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
