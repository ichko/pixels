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
            $user_id = $this->auth_service->get_user_id(
                $this->post_service->get('username'),
                $this->post_service->get('password')
            );

            if ($user_id) {
                $this->auth_service->login($user_id);
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

    public function register()
    {
        $validation_report = '';

        if ($this->post_service->is_set()) {
            $is_registered = $this->auth_service->is_user_registered(
                $this->post_service->get('username'),
                $this->post_service->get('email')
            );

            if ($is_registered) {
                $validation_report = 'Name or email already registered.';
            } else {
                $this->auth_service->register(
                    $this->post_service->get('username'),
                    $this->post_service->get('password'),
                    $this->post_service->get('email')
                );
                $this->navigation_service->navigate_to('/');
            }
        }

        return [
            'title' => 'Register',
            'validation_report' => $validation_report,
            'username' => $this->post_service->get('username'),
            'email' => $this->post_service->get('email'),
        ];
    }
}
