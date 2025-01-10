<?php

namespace Classes\Controllers\Abstractions;

use Interfaces\DatabaseMethodsInterface;
use PDOException;

abstract class DeleteAbstractController
{
    protected DatabaseMethodsInterface $database;
    protected $path;

    public function __construct(DatabaseMethodsInterface $database, string $redirect)
    {
        $this->database = $database;
        $this->path = $redirect;
    }

    public function delete($identifier)
    {
        try {
            $this->database->delete($identifier['name'], [$identifier['name'] => $identifier['value']]);
        } catch (PDOException) {
            $this->error_handler();
            die();
        }

        return $this;
    }

    public function success($message)
    {
        $_SESSION['success'] = $message;
        redirect_to($this->path);
    }

    abstract protected function error_handler();
}
