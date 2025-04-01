<?php

namespace Classes\Controllers\Logement;

use Classes\Controllers\Abstractions\SaveAbstractController;
use Classes\Database\Logement as DB_Logement;
use Classes\Validation\Logement as Validation;
use Classes\Database\User as DB_User;
use PDOException;

class Save extends SaveAbstractController
{

    private DB_User $db_user;

    public function __construct(DB_Logement $database, Validation $validation, DB_User $db_user)
    {
        parent::__construct($database, $validation);

        $this->db_user = $db_user;
    }


    public function existing_user($identifier, $params)
    {
        try {

            $user = $this->db_user->get($identifier, $params);

            if (!$user) {
                $this->error_handler();
            }
        } catch (PDOException) {
            $this->error_handler();
        }
        return $this;
    }

    private function error_handler()
    {
        $_SESSION['exists'] = 'Impossible d\'enregistrer ce logement,pas d\'utilisateur correspondant en base de données.';
        redirect_to($_SERVER['HTTP_REFERER']);
        die();
    }

    protected function formating($data)
    {
        $data['equipments'] = set_array_to_db_insertion($data['equipments']);
        $data['pictures'] = set_array_to_db_insertion($data['pictures']);

        return $data;
    }
}
