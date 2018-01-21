<?php
require_once 'framework/router.php';
require_once 'framework/db.php';
require_once 'framework/renderer.php';

require_once 'views/pages.php';

error_reporting(E_ALL);

$router = (new \Framework\Router())
    ->add('', new \Views\Pages\Home())
    ->add('login', new \Views\Pages\Login())
    ->add('.*', function () {return '404';})
;

$content = $router(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);

$html = (new \Framework\Renderer())
    ->render('layout', [
        'title' => 'title',
        'html' => $content,
    ]);

echo $html;
