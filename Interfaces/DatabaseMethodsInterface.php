<?php

namespace Interfaces;

interface DatabaseMethodsInterface
{

    public function __construct($db_config);

    public function get($identifier, $params = []);


    public function get_all();


    public function delete($identifier, $params = []);


    public function save($user_data);

    public function update($user_data);


    public function close_connexion();
}
