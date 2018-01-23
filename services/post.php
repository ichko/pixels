<?php
namespace Services;

class PostService
{
    public function is_post()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function validate_fields($field_names, $model)
    {
        if (is_null($field_names)) {
            return $model;
        }

        if (is_null($model)) {
            $model = [];
        }

        $result = [];
        foreach ($field_names as $key) {
            if (!array_key_exists($key, $model)) {
                $model[$key] = '';
            }

            $result[$key] = htmlspecialchars($model[$key]);
        }

        return $result;
    }

    public function get_json_post($field_names = null)
    {
        $decoded = json_decode(file_get_contents('php://input'), true);
        return $this->validate_fields($field_names, $decoded);
    }

    public function get_form_post($field_names = null)
    {
        return $this->validate_fields($field_names, $_POST);
    }

    public function get($key)
    {
        if (array_key_exists($key, $_POST)) {
            return htmlspecialchars($_POST[$key]);
        }

        return '';
    }
}
