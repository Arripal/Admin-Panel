<?php


function access_view($path, $data = [])
{
    extract($data);
    return require("views/{$path}.php");
}


function redirect_to($path)
{
    header("Location: {$path}");
    die();
}

function set_array_to_db_insertion($data)
{
    return '{' . implode(',', array_map(function ($item) {
        return '"' . str_replace('"', '\\"', $item) . '"';
    }, $data)) . '}';
};

function clean_inputs(array $data): array
{
    $array = [];

    foreach ($data as $key => $value) {

        if (is_array($value)) {
            foreach ($value as  $string) {
                strip_tags(trim($string));
            }
            $array[$key] = $value;
        } else {
            $array[$key] = strip_tags(trim($value));
        }
    }
    return $array;
}
