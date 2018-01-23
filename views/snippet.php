<?php
namespace Views;

class SnippetView
{
    public function __construct($snippet_service, $auth_service, $navigation_service, $renderer)
    {
        $this->snippet_service = $snippet_service;
        $this->auth_service = $auth_service;
        $this->navigation_service = $navigation_service;
        $this->renderer = $renderer;
    }

    public function create()
    {
        $this->auth_service->assert_logged();
        $id = $this->snippet_service->create();
        $this->navigation_service->navigate_to("snippet/edit/$id");
    }

    public function edit($id)
    {
        $snippet_model = $this->snippet_service->get($id);
        if (!$snippet_model) {
            $this->navigation_service->navigate_to('404');
        }
        $snippet_model['title'] = 'Editing';

        return $snippet_model;
    }

    public function view($id)
    {
        return $this->renderer->render('view', $this->snippet_service->get($id));
    }

    public function save($id)
    {
        [$success, $reason] = $this->snippet_service->save($id);
        return json_encode([
            'success' => $success,
            'reason' => $reason,
        ]);
    }
}
