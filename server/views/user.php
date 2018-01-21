<?php
namespace Views;

class User extends \Framework\View
{

    public function login()
    {
        return $this->render('login');
    }

    public function register()
    {

        return $this->render('register');
    }
}
