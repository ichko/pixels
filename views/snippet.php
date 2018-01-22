<?php
namespace Views;

class SnippetView
{
    public function __construct($post_service, $navigation_service, $snippets_service)
    {
        $this->navigation_service = $navigation_service;
        $this->post_service = $post_service;
        $this->snippets_service = $snippets_service;
    }

    public function create()
    {
        $this->navigation_service->navigate_to('/');
    }

    public function save()
    {
        $data = $this->post_service->get_post();
        return 'aaa';
    }
}
