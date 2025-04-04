<?php


namespace Classes\Controllers\User;

use Classes\Controllers\Abstractions\ShowAbstractController;
use Classes\Database\User as Database;

class Show extends ShowAbstractController
{
    private $view = '/admin/users/users.view';
    public function __construct(Database $database)
    {
        parent::__construct(
            $database
        );
    }

    protected function error_handler()
    {
        $this->errors['empty'] = "Aucun utilisateur a afficher, la base de données est vide.";
        $this->render(['errors' => $this->errors]);
    }

    protected function render($entities)
    {
        access_view($this->view, $entities);
        die();
    }
}
