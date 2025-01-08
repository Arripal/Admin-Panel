<?php


namespace Classes\Validation;

use Respect\Validation\Validator as v;

class Validation
{
    protected $errors = [];

    private const MIN_LENGTH = 5;
    private const MAX_LENGTH = 255;

    public function minlength($value, $min_length = self::MIN_LENGTH)
    {
        return v::stringType()->length($min_length, null)->validate($value) ? true : false;
    }

    public function length($value, $min_length = self::MIN_LENGTH, $max_length = self::MAX_LENGTH)
    {
        return v::stringType()->length($min_length, $max_length)->validate($value) ? true : false;
    }

    public function email($value)
    {
        return v::email()->validate($value) ? true : false;
    }

    public function url($value)
    {
        return v::url()->validate($value) ? true : false;
    }

    public function digit($value)
    {
        return v::digit()->validate($value) ? true : false;
    }

    public function alpha($value)
    {
        return v::alpha()->validate($value) ? true : false;
    }

    public function password($value)
    {
        $pattern = '/^.{5,}$/';
        $password_valid = preg_match($pattern, $value);

        return $password_valid ? true : false;
    }

    public function urls_array($value)
    {

        if ($value == null) {
            return false;
        }

        foreach ($value as $item) {

            if (!v::url()->validate($item)) {
                return  false;
            }
        }

        return true;
    }

    public function valid()
    {
        return empty($this->errors);
    }

    public function get_errors()
    {
        return $this->errors;
    }

    public function set_error($error, $message)
    {
        $this->errors[$error] = $message;
    }
}
