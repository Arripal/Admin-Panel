<?php

namespace Traits;


use Classes\Crypt;
use Classes\Database\User as DatabaseUser;
use Classes\Validation\User as ValidationUser;

trait UserTrait
{

    private DatabaseUser $database_user;
    private ValidationUser $validation_user;
    private Crypt $crypt;

    public function __construct(DatabaseUser $database_user, ValidationUser $validation_user, Crypt $crypt)
    {
        $this->database_user = $database_user;
        $this->validation_user = $validation_user;
        $this->crypt = $crypt;
    }

    protected function check_existing_user($email, $error_message)
    {
        $user = $this->database_user->get('email', ['email' => $email]);

        if ($user) {
            $_SESSION['empty_user'] = $error_message;
            redirect_to($_SERVER['HTTP_REFERER']);
            die();
        }
    }

    protected function validate_credentials($user_data)
    {
        $valid_data = $this->validation_user->validate($user_data);

        if (!$valid_data) {
            $_SESSION['errors'] = $this->validation_user->get_errors();
            redirect_to($_SERVER['HTTP_REFERER']);
            die();
        }
    }

    protected function formating_data($user_data)
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
