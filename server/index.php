<?php
require_once 'framework/router.php';
require_once 'framework/db.php';
require_once 'framework/renderer.php';

require_once 'views/pages.php';

error_reporting(E_ALL);

$db = new \Framework\DB\MySqlConnection([
    'host' => 'localhost',
    'dbname' => 'test',
    'username' => '',
    'password' => '',
]);

$db->query("
    CREATE TABLE IF NOT EXISTS `test`.`users` (
        `id` INT NOT NULL AUTO_INCREMENT ,
        `name` VARCHAR(50) NOT NULL ,
        `email` VARCHAR(50) NOT NULL ,
        `pass_hash` VARCHAR(256) NOT NULL ,
        PRIMARY KEY (`id`))
    ENGINE = InnoDB;
")->execute();
$router = (new \Framework\Router())
    ->add('', new \Views\Pages\Home())
    ->add('login', new \Views\Pages\Login())
    ->add('.*', function () {return '404';})
;

$response = $router(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);

echo $response;

(new \Framework\Renderer('templates'))
    ->render('layout', '');
