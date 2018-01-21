<?php
namespace Views;

require_once 'framework/view.php';

class User extends \Framework\View
{

    public function login()
    {
        return $this->render('login', [
            'title' => 'Login',
        ]);
    }

    public function register()
    {
        return $this->render('register');
    }
}
