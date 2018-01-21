<?php
namespace Views;

class Auth
{
    public function login()
    {
        return [
            'template' => 'login',
            'model' => [
                'title' => 'Login',
                'validation_report' => '',
                'username' => 'Pesho',
            ],
        ];
    }
}
