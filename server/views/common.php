<?php
namespace Views;

class Common
{
    public function home()
    {
        return [
            'template' => 'home',
            'model' => ['app_name' => 'App'],
            'title' => ['Homepage'],
        ];
    }

    public function not_found()
    {
        return ['template' => 'not_found'];
    }
}
