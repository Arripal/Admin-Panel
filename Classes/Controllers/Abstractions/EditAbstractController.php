<?php

namespace Classes\Controllers\Abstractions;

use Interfaces\DatabaseMethodsInterface;
use PDOException;

abstract class EditAbstractController
{
    protected DatabaseMethodsInterface $database;

    public function __construct(DatabaseMethodsInterface $database,)
    {
        $this->database = $database;
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
