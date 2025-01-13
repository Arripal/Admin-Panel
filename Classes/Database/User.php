<?php

namespace Classes\Database;

use Interfaces\DatabaseMethodsInterface;
use Traits\DBOperationsTrait;

class User implements DatabaseMethodsInterface
{

    use DBOperationsTrait;

    private $database;

    public function __construct($db_config)
    {
        $this->database = new Database($db_config);
    }


    protected function get_table_name()
    {
        return 'public.user';
    }
}
