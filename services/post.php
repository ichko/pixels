<?php
namespace Services;

class PostService
{
    public function is_post()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function get_post($field_names = null)
    {
        $decoded = json_decode(file_get_contents('php://input'), true);
        if (is_null($field_names)) {
            return $decoded;
        }

        if (is_null($decoded)) {
            $decoded = [];
        }

        $result = [];
        foreach ($field_names as $key) {
            if (!array_key_exists($key, $decoded)) {
                $decoded[$key] = '';
            }

            $result[$key] = $decoded[$key];
        }

        return $result;
    }

    public function get($key)
    {
        if (array_key_exists($key, $_POST)) {
            return $_POST[$key];
        }

        return '';
    }
}
