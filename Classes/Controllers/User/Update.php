<?php

namespace Classes\Controllers\User;

use Classes\Controllers\Abstractions\UpdateAbstractController;
use Classes\Crypt;
use Classes\Database\User as Database;
use Classes\Validation\User as Validation;


class Update extends UpdateAbstractController
{

    private $crypt;

    public function __construct(Database $database, Validation $validation, Crypt $crypt)
    {
        parent::__construct(
            $database,
            $validation,
            '/admin/dashboard/users'
        );

        $this->crypt = $crypt;
    }


    protected function formating($data)
    {
        $hashed_password = $this->crypt->password_encryption($data['password']);
        $full_name = $data['first_name'] . ' ' . $data['last_name'];

        unset($data['first_name']);
        unset($data['last_name']);
        $data['password'] = $hashed_password;
        $data['name'] = $full_name;

        $data = array_diff_key($data, ['_method' => '']);

        return $data;
    }
}
