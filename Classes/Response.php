<?php

namespace Classes;

class Response
{

    public function send_json_response($data = null, $status = 'success', $error = null, $code = 200)
    {

        $response = [
            'status' => $status,
            'data' => $data,
            'error' => $error
        ];

        http_response_code($code);
        header("Content-Type: application/json");
        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}
