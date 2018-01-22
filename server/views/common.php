<?php
namespace Views;

class CommonView
{
    public function home()
    {
        return ['title' => 'Homepage'];
    }

    public function not_found()
    {
        return ['title' => '404'];
    }
}
