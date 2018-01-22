<?php
namespace Views;

class BannerView
{
    public function __construct($post_service)
    {
        $this->post_service = $post_service;
    }

    public function buy()
    {
        return [
            'title' => 'Buy banner',
        ];
    }

    public function register()
    {
        $data = $this->post_service->get_post();
    }
}
