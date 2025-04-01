<?php

namespace Classes\Controllers\Abstractions;

use Interfaces\DatabaseMethodsInterface;
use Interfaces\ValidationInterface;
use PDOException;

abstract class SaveAbstractController
{
    protected DatabaseMethodsInterface $database;
    protected ValidationInterface $validation;

    public function __construct(DatabaseMethodsInterface $database, ValidationInterface
    $validation)
    {
        $this->database = $database;
        $this->validation = $validation;
    }

    public function save($data)
    {
        $formated_data = $this->formating($data);
        try {
            $this->database->save($formated_data);
        } catch (PDOException) {
            $_SESSION['save'] = 'Impossible de sauvegarder la ressource en base de données.';
            redirect_to($_SERVER['HTTP_REFERER']);
            die();
        }

        return $this;
    }

    public function validate_data($data)
    {
        $is_valid = $this->validation->validate($data);

        if (!$is_valid) {
            $_SESSION['errors'] = $this->validation->get_errors();
            redirect_to($_SERVER['HTTP_REFERER']);
            die();
        }

        return $this;
    }

    public function success($message)
    {
        $_SESSION['success'] = $message;
        return $this;
    }

    public function redirection(string $path)
    {
        return redirect_to($path);
    }

    abstract protected function formating($data);
}
