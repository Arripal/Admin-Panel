<?php


function error_handler($error_message = '', $code = 404)
{
    http_response_code($code);
    throw new Exception($error_message, $code);
}


function access_view($path, $data = [])
{
    extract($data);
    return require("views/{$path}.php");
}


function redirect_to($path)
{
    return header("Location: {$path}");
}

function set_array_to_db_insertion($data)
{
    return '{' . implode(',', array_map(function ($item) {
        return '"' . str_replace('"', '\\"', $item) . '"';
    }, $data)) . '}';
};
