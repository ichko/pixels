<?php
error_reporting(E_ALL);

require_once 'framework/dependency_container.php';
require_once 'framework/view_renderer.php';
require_once 'framework/router.php';
require_once 'framework/db.php';

require_once 'views/common.php';
require_once 'views/auth.php';
require_once 'services/auth.php';
require_once 'services/navigation.php';
require_once 'services/post.php';
require_once 'services/session.php';

$container = (new \Framework\DependencyContainer)
    ->register('renderer', function ($container) {
        $auth_service = $container->resolve('auth_service');
        return new \Framework\ViewRenderer($auth_service, 'templates', '.php');
    })
    ->register('db', new \Framework\DB\MySqlConnection([
        'host' => 'localhost',
        'db_name' => 'test',
        'username' => '',
        'password' => '',
    ]))

    ->register('post_service', \Services\PostService::class)
    ->register('auth_service', \Services\AuthService::class)
    ->register('navigation_service', \Services\NavigationService::class)
    ->register('session_service', \Services\SessionService::class)

    ->register('common', \Views\Common::class)
    ->register('auth', \Views\Auth::class)

    ->register('routing', function ($container) {
        return (new \Framework\Router)
            ->add('', $container->resolve('common'), 'home')
            ->add('login', $container->resolve('auth'), 'login')
            ->add('logout', function () use ($container) {
                $container->resolve('auth_service')->logout();
            })
            ->add('register', $container->resolve('auth'), 'register')
            ->add('.*', $container->resolve('common'), 'not_found');
    })

    ->register('bootstrap', function ($container) {
        [$method_name, $view_data] = $container->resolve('routing')->route(
            $_SERVER['REQUEST_URI'],
            $_SERVER['REQUEST_METHOD']
        );

        echo $container->resolve('renderer')
            ->render_view('layout', $method_name, $view_data);
    });
