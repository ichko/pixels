<?php
require_once 'framework/router.php';
require_once 'framework/db.php';
require_once 'framework/renderer.php';

require_once 'views/common.php';
require_once 'views/user.php';

error_reporting(E_ALL);

$router = (new \Framework\Router())
    ->add('', new \Views\Common, 'home')
    ->add('login', new \Views\User, 'login')
    ->add('register', new \Views\User, 'register')
    ->add('.*', new \Views\Common, 'not_found')
;

$content = $router->route(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);

$html = (new \Framework\Renderer())->render('layout', [
    'title' => 'title',
    'html' => $content,
]);

echo $html;
