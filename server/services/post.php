<?php
namespace Services;

class PostService
{
    public function is_set()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function get($key)
    {
        if (array_key_exists($key, $_POST)) {
            return $_POST[$key];
        }

        return '';
    }
}
