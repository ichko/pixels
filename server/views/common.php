<?php
namespace Views;

require_once 'framework/view.php';

class Common extends \Framework\View
{
    public function home()
    {
        return $this->render('home');
    }

    public function not_found()
    {
        return '404';
    }
}
