<?php
namespace Views;

class SnippetView
{
    public function __construct($snippets_service, $auth_service, $navigation_service)
    {
        $this->snippets_service = $snippets_service;
        $this->auth_service = $auth_service;
        $this->navigation_service = $navigation_service;
    }

    public function create()
    {
        $this->auth_service->assert_logged();
        $id = $this->snippets_service->create();
        $this->navigation_service->navigate_to("snippet/edit/$id");
    }

    public function edit($id)
    {
        $this->auth_service->assert_logged();
        $snippet_model = $this->snippets_service->get($id);
        $snippet_model['title'] = 'Editing';
        var_dump($snippet_model);

        return $snippet_model;
    }
}
