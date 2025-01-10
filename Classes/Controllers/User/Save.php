<?php

namespace Classes\Controllers\User;

use Classes\Controllers\Abstractions\SaveAbstractController;
use Classes\Crypt;
use Classes\Database\User as Database;
use Classes\Validation\User as Validation;


class Save extends SaveAbstractController
{

    private Crypt $crypt;

    public function __construct(Database $database, Validation $validation, Crypt $crypt)
    {
        parent::__construct($database, $validation, '/admin/dashboard/users');
        $this->crypt = $crypt;
    }

    protected function formating($user_data)
    {
        $hashed_password = $this->crypt->password_encryption($user_data['password']);
        $full_name = $user_data['first_name'] . ' ' . $user_data['last_name'];

        unset($user_data['first_name']);
        unset($user_data['last_name']);
        $user_data['password'] = $hashed_password;
        $user_data['name'] = $full_name;

        return $user_data;
    }
}
