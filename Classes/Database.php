<?php

class Database
{
    private $dbconfig;
    private $connexion;
    public $statement;

    public function __construct($db_config)
    {
        $this->dbconfig = $db_config;
        $this->connexion_db();
    }

    private function connexion_db()
    {
        try {
            $db_url = sprintf(
                "pgsql:host=%s;port=%s;dbname=%s",
                $this->dbconfig['database']['host'],
                $this->dbconfig['database']['port'],
                $this->dbconfig['database']['db_name']
            );

            $this->connexion = new PDO($db_url, $this->dbconfig['user']['username'], $this->dbconfig['user']['password'], [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $exception) {
            error_handler("Impossible de se connecter à la base de données, erreur : {$exception->getMessage()}", 500);
        }
    }

    public function db_query($query, $params = [])
    {
        //prepare afin d'éviter les injections sql
        $this->statement = $this->connexion->prepare($query);
        $this->statement->execute($params);
        return $this->statement;
    }


    public function fetch_all($query, $params = [])
    {
        try {
            return $this->db_query($query, $params)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function fetch($query, $params = [])
    {
        try {
            return $this->db_query($query, $params)->fetch();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function delete_one($query, $params = [])
    {
        try {
            return $this->db_query($query, $params);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function close_connexion()
    {
        $this->statement = null;
        $this->connexion = null;
    }
}
