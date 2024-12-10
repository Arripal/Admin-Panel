<?php

class LogementValidation
{
    private $validation;

    public function __construct()
    {
        $this->validation = new Validation();
    }

    public function validate_logement(array $logement_data)
    {
        $this->validation->validate('title', $logement_data['title'], ['min', 'max', 'required']);
        $this->validation->validate('location', $logement_data['location'], ['min', 'max', 'required']);
        $this->validation->validate('description', $logement_data['description'], ['min', 'max', 'required']);
        $this->validation->validate('cover', $logement_data['cover'], ['url', 'required']);
        $this->validation->validate('host', $logement_data['host'], ['email', 'required']);
        $this->validation->validate('rating', $logement_data['rating'], ['rating', 'required']);
        $this->validation->validate('tags', $logement_data['tags'], ['arraystrs'], 'required');
        $this->validation->validate('pictures', $logement_data['pictures'], ['arraystrs'], 'required');
        $this->validation->validate('equipments', $logement_data['equipments'], ['arraystrs'], 'required');

        return $this->validation->is_valid();
    }

    public function get_validation_errors()
    {
        return $this->validation->get_errors();
    }
}
