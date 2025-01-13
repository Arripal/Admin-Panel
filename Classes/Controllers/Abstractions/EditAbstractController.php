<?php

namespace Classes\Controllers\Abstractions;

use Interfaces\DatabaseMethodsInterface;
use PDOException;

abstract class EditAbstractController
{
    protected DatabaseMethodsInterface $database;
    protected $path;
    protected $view;

    public function __construct(DatabaseMethodsInterface $database, string $redirect, string $view)
    {
        $this->database = $database;
        $this->path = $redirect;
        $this->view = $view;
    }

    public function edit($identifier)
    {
        try {
            $entity = $this->database->get('id', ['id' => $identifier]);

            if (empty($entity)) {
                $this->error_handler();
                die();
            }

            $this->render($entity);
        } catch (PDOException) {
            $this->error_handler();
        }
    }

    abstract protected function error_handler();
    abstract protected function render($entity);
}
