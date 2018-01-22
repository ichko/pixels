<?php
namespace Services;

class PostService
{
    public function is_post()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function get_post()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function get($key)
    {
        if (array_key_exists($key, $_POST)) {
            return $_POST[$key];
        }

        return '';
    }
}
