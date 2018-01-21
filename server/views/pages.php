<?php
namespace Views\Pages;

require_once 'framework/view.php';

class Home extends \Framework\View
{
    public function get()
    {
        return $this->render('home');
    }
}

class Login extends \Framework\View
{
    public function get()
    {
        return $this->render('user');
    }
}
