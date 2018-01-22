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

$container = (new \Framework\DependencyContainer)
    ->register('db', new \Framework\DB\MySqlConnection([
        'host' => 'localhost',
        'dbname' => 'test',
        'username' => '',
        'password' => '',
    ]))

    ->register('post_service', \Services\PostService::class)
    ->register('auth_service', \Services\AuthService::class)
    ->register('navigation_service', new \Services\NavigationService())

    ->register('common', \Views\Common::class)
    ->register('auth', \Views\Auth::class);

[$method_name, $view_data] = (new \Framework\Router)
    ->add('', $container->resolve('common'), 'home')
    ->add('login', $container->resolve('auth'), 'login')
    ->add('register', $container->resolve('auth'), 'register')
    ->add('.*', $container->resolve('common'), 'not_found')
    ->route(
        $_SERVER['REQUEST_URI'],
        $_SERVER['REQUEST_METHOD']
    );

echo (new \Framework\ViewRenderer('templates', '.php'))
    ->render_view('layout', $method_name, $view_data);
