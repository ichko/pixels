<?php
namespace Views;

class CommonView
{
    public function __construct($snippet_service)
    {
        $this->snippet_service = $snippet_service;
    }

    public function home()
    {
        $model = [];
        $model['snippets'] = $this->snippet_service->get_all();
        $model['title'] = 'All snippets';
        return $model;
    }

    public function not_found()
    {
        return ['title' => '404'];
    }
}
