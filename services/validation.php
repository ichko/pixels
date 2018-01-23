<?php
namespace Services;

class ValidationService
{
    public function __construct($validations)
    {
        $this->validations = $validations;
    }

    public function validate($fields)
    {
        $errors = [];
        foreach ($fields as $key => $value) {
            if (array_key_exists($key, $this->validations)) {
                foreach ($this->validations[$key] as $validation) {
                    $is_valid = $validation['test']($value, $fields);
                    if (!$is_valid) {
                        $error_msg = $validation['hint']($value, $fields);
                        $errors[] = $error_msg;
                    }
                }
            }
        }

        return $errors;
    }

    public function render_errors($errors)
    {
        $result = "<ul class='errors'>";
        foreach ($errors as $error) {
            $result .= "<li>$error</li>";
        }

        return $result . "</ul>";
    }

    public function report($fields)
    {
        $errors = $this->validate($fields);
        return [count($errors) == 0, $this->render_errors($errors)];
    }
}
