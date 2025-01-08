<?php

namespace Classes\Controllers\Logement;

use Classes\Database\Logement;
use Classes\Validation\Logement as Validation;
use Classes\Database\User;

class Save
{

    private $validation;
    private $db_user;
    private $db_logement;
    public function __construct(Validation $validation, User $db_user, Logement $db_logement)
    {
        $this->validation = $validation;
        $this->db_user = $db_user;
        $this->db_logement = $db_logement;
    }

    public function index($logement_data)
    {
        $this->validate($logement_data);
        $this->find_existing_user($logement_data['host'], $this->db_user);

        $formated_data = $this->formated_data($logement_data);

        $this->db_logement->save($formated_data);

        redirect_to('/admin/dashboard/logements');
    }

    private function validate($logement_data)
    {
        if (!$this->validation->validate($logement_data)) {
            $errors = $this->validation->get_errors();
            $_SESSION['errors'] = $errors;
            redirect_to($_SERVER['HTTP_REFERER']);
            die();
        }
    }

    private function find_existing_user($identifier)
    {
        $user = $this->db_user->get('email', ['email' => $identifier]);

        if (!$user) {
            $_SESSION['user_error'] = 'Impossible d\'enregistrer ce logement,pas d\'utilisateur correspondant en base de données.';
            redirect_to($_SERVER['HTTP_REFERER']);
        }
    }

    private function formated_data($logement_data)
    {

        $logement_data['equipments'] = set_array_to_db_insertion($logement_data['equipments']);
        $logement_data['pictures'] = set_array_to_db_insertion($logement_data['pictures']);

        return $logement_data;
    }
}
