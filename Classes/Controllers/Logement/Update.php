<?php

namespace Classes\Controllers\Logement;

use Classes\Controllers\Abstractions\UpdateAbstractController;
use Classes\Database\Logement as Database;
use Classes\Validation\Logement as Validation;

class Update extends UpdateAbstractController
{


    public function __construct(Database $database, Validation $validation)
    {
        parent::__construct(
            $database,
            $validation
        );
    }

    protected function formating($data)
    {

        $equipments = set_array_to_db_insertion($data['equipments']);
        $data['equipments'] = $equipments;

        $pictures = set_array_to_db_insertion($data['pictures']);
        $data['pictures'] = $pictures;

        $data = array_diff_key($data, ['_method' => '']);

        return $data;
    }
}
