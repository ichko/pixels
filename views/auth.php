<?php
namespace Views;

class AuthView
{
    public function __construct(
        $auth_service, $post_service,
        $navigation_service, $make_validation
    ) {
        $this->user_validator = $make_validation([
            'name' => [[
                'test' => function ($val, $_) {return trim($val) != "";},
                'hint' => function ($val, $_) {return "Name is required.";},
            ]],
            'password' => [[
                'test' => function ($val, $_) {return trim($val) != "";},
                'hint' => function ($val, $_) {return "Password is required.";},
            ]],
            'email' => [[
                'test' => function ($val, $_) {return trim($val) != "";},
                'hint' => function ($val, $_) {return "Email is required.";},
            ]],
            'registered' => [[
                'test' => function ($_, $model) {
                    $is_registered = $this->auth_service->is_user_registered([
                        'name' => $model['name'],
                        'email' => $model['email'],
                    ]);
                    return !$is_registered;
                },
                'hint' => function ($val, $_) {return "Name or email already registered.";},
            ]],
        ]);

        $this->auth_service = $auth_service;
        $this->post_service = $post_service;
        $this->navigation_service = $navigation_service;
    }

    public function login()
    {
        $this->auth_service->assert_not_logged();
        $validation_report = '';
        $model = $this->post_service->get_form_post(['name', 'password']);

        if ($this->post_service->is_post()) {
            $user_id = $this->auth_service->get_user_id($model);
            if ($user_id) {
                $this->auth_service->login($user_id);
                $this->navigation_service->navigate_to('/');
            } else {
                $validation_report = '<ul class="errors"><li>User is not registered.</li></ul>';
            }
        }

        return [
            'title' => 'Login',
            'validation_report' => $validation_report,
            'name' => $this->post_service->get('name'),
        ];
    }

    public function register()
    {
        $this->auth_service->assert_not_logged();
        $model = $this->post_service->get_form_post(['name', 'password', 'email', 'registered']);
        $error_report = '';

        if ($this->post_service->is_post()) {
            [$is_valid, $error_report] = $this->user_validator->report($model);
            if ($is_valid) {
                unset($model['registered']);
                $this->auth_service->register($model);
                $this->navigation_service->navigate_to('/');
            }
        }

        return [
            'title' => 'Register',
            'validation_report' => $error_report,
            'name' => $this->post_service->get('name'),
            'email' => $this->post_service->get('email'),
        ];
    }
}
