<?php

namespace Classes\Controllers\Abstractions;

use Interfaces\DatabaseMethodsInterface;
use PDOException;

abstract class ShowAbstractController
{
    protected DatabaseMethodsInterface $database;
    protected $errors = [];

    public function __construct(DatabaseMethodsInterface $database)
    {
        $this->database = $database;
    }

    public function show()
    {
        try {
            $entities = $this->database->get_all();
            if (empty($entities)) {
                $this->error_handler();
                die();
            }

            uasort($entities, function ($a, $b) {
                return $a['id'] - $b['id'];
            });

            $this->render(['data' => $entities]);
        } catch (PDOException) {

            $this->error_handler();
        }
    }

    abstract protected function error_handler();
    abstract protected function render($entities);
}
