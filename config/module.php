<?php
error_reporting(E_ALL);

require_once 'db_config.php';

require_once 'framework/dependency_container.php';
require_once 'framework/view_renderer.php';
require_once 'framework/router.php';
require_once 'framework/db.php';

require_once 'views/common.php';
require_once 'views/auth.php';
require_once 'views/snippet.php';

require_once 'services/auth.php';
require_once 'services/navigation.php';
require_once 'services/post.php';
require_once 'services/session.php';
require_once 'services/snippet.php';
require_once 'services/validation.php';

$container = (new \Framework\DependencyContainer)
    ->register('renderer', new \Framework\Renderer('templates', '.php'))
    ->register('view_renderer', function ($container) {
        $auth_service = $container->resolve('auth_service');
        return new \Framework\ViewRenderer($auth_service, 'templates', '.php');
    })
    ->register('db', new \Framework\DB\MySqlConnection($db_config))

    ->register('post_service', \Services\PostService::class)
    ->register('auth_service', \Services\AuthService::class)
    ->register('navigation_service', \Services\NavigationService::class)
    ->register('session_service', \Services\SessionService::class)
    ->register('snippet_service', \Services\SnippetService::class)
    ->register('make_validation', function () {
        return function ($validations) {
            return new \Services\ValidationService($validations);
        };
    })

    ->register('common_view', \Views\CommonView::class)
    ->register('auth_view', \Views\AuthView::class)
    ->register('snippet_view', \Views\SnippetView::class)

    ->register('routing', function ($container) {
        return (new \Framework\Router)
            ->add('', $container->resolve('common_view'), 'home')
            ->add('login', $container->resolve('auth_view'), 'login')
            ->add('logout', function () use ($container) {
                $container->resolve('auth_service')->logout();
            })
            ->add('register', $container->resolve('auth_view'), 'register')
            ->add('snippet/create', $container->resolve('snippet_view'), 'create')
            ->add('snippet/save/?', $container->resolve('snippet_view'), 'save')
            ->add('snippet/edit/?', $container->resolve('snippet_view'), 'edit')
            ->add('snippet/view/?', $container->resolve('snippet_view'), 'view')
            ->add('.*', $container->resolve('common_view'), 'not_found');
    })

    ->register('bootstrap', function ($container) {
        [$method_name, $view_data] = $container->resolve('routing')->route(
            $_SERVER['REQUEST_URI'],
            $_SERVER['REQUEST_METHOD']
        );

        echo $container->resolve('view_renderer')
            ->render_view('layout', $method_name, $view_data);
    });
