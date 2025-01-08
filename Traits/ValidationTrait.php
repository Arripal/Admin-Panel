<?php

namespace Traits;

use Classes\Validation\Validation;

trait ValidationTrait
{
    protected $validation;

    public function __construct()
    {
        $this->validation = new Validation();
    }

    public function get_errors()
    {
        return $this->validation->get_errors();
    }
}
