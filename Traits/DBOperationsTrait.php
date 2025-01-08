<?php

namespace Traits;


trait DBOperationsTrait
{
    protected function get_table_name() {}

    public function get($identifier, $params = [])
    {
        $query = "SELECT * FROM " . $this->get_table_name() . " WHERE {$identifier} = :{$identifier} ";
        return $this->database->fetch($query, $params);
    }

    public function get_all()
    {
        $query = "SELECT * FROM " . $this->get_table_name();

        return $this->database->fetch_all($query);
    }

    public function save($data)
    {

        $fields = [];
        $fields_placeholders = [];
        $params = [];

        foreach ($data as $field => $value) {
            if ($value != null) {
                $fields[] = $field;
                $fields_placeholders[] = ":{$field}";
                $params[$field] = strip_tags($value);
            }
        }

        $formated_fields = implode(', ', $fields);
        $formated_fields_placeholders = implode(', ', $fields_placeholders);


        $query = "INSERT INTO " . $this->get_table_name() . " ( {$formated_fields} ) VALUES ( {$formated_fields_placeholders} )";

        return $this->database->db_query($query, $params);
    }

    public function delete($identifier, $params = [])
    {
        $query = "DELETE FROM " . $this->get_table_name() . " WHERE {$identifier} = :{$identifier}";
        return $this->database->fetch($query, $params);
    }

    public function update($user_data)
    {
        $id = strip_tags($user_data['id']);
        unset($user_data['id']);

        $user_fields = [];
        $params = ['id' => $id];

        foreach ($user_data as $field => $value) {
            $user_fields[] = "{$field} = :{$field}";
            $params[$field] = strip_tags($value);
        }
        $formated_fields = implode(', ', $user_fields);

        $query = "UPDATE " . $this->get_table_name() . " SET {$formated_fields} WHERE id = :id";

        return $this->database->db_query($query, $params);
    }

    public function close_connexion()
    {
        return $this->database->close_connexion();
    }
}
