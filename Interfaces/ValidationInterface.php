<?php

namespace Interfaces;


interface ValidationInterface
{
    public function get_errors();
    public function set_error($error, $message);
    public function validate(array $data);
}
