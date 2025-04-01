<?php

namespace Classes\Controllers\Abstractions;

use Interfaces\DatabaseMethodsInterface;
use PDOException;

abstract class DeleteAbstractController
{
    protected DatabaseMethodsInterface $database;

    public function __construct(DatabaseMethodsInterface $database)
    {
        $this->database = $database;
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
        return $this;
    }

    abstract protected function error_handler();

    public function redirection(string $path)
    {
        return redirect_to($path);
    }
}
