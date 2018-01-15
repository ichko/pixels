<?php

require_once 'app/framework/db.php';
require_once 'app/framework/router.php';
require_once 'app/controllers/users.php';

$db = new \Framework\DB\MySqlConnection([
    'host' => 'localhost',
    'dbname' => 'test',
    'username' => '',
    'password' => '',
]);

$router = (new \Framework\Router())
    ->add('home', function () {return 'This is home!';})
    ->add('users/?/test/?', new \Component\Users())
    ->add('.*', function () {return '404';});

$response = $router(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);

echo $response;
