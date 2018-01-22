<?php
namespace Views;

class Auth
{
    public function __construct($auth_service, $post_service, $navigation_service)
    {
        $this->auth_service = $auth_service;
        $this->post_service = $post_service;
        $this->navigation_service = $navigation_service;
    }

    public function login()
    {
        $validation_report = '';

        if ($this->post_service->is_set()) {
            if (
                $this->auth_service->is_registered(
                    $this->post_service->get('username'),
                    $this->post_service->get('password')
                )
            ) {
                $this->auth_service->login(
                    $this->post_service->get('username'),
                    $this->post_service->get('password')
                );
                $this->navigation_service->navigate_to('/');
            } else {
                $validation_report = 'User is not registered.';
            }
        }

        return [
            'title' => 'Login',
            'validation_report' => $validation_report,
            'username' => $this->post_service->get('username'),
        ];
    }
}
