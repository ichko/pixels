<?php
require_once 'framework/router.php';
require_once 'framework/db.php';
require_once 'controllers/users.php';

error_reporting(E_ALL);

$db = new \Framework\DB\MySqlConnection([
    'host' => 'db',
    'dbname' => 'test',
    'username' => 'root',
    'password' => 'example',
]);

$db->query("
    CREATE TABLE IF NOT EXISTS `test`.`users` (
        `id` INT NOT NULL AUTO_INCREMENT ,
        `name` VARCHAR(50) NOT NULL ,
        `email` VARCHAR(50) NOT NULL ,
        `pass_hash` VARCHAR(256) NOT NULL ,
        PRIMARY KEY (`id`))
    ENGINE = InnoDB;
");

$router = (new \Framework\Router())
    ->add('home', function () {return 'This is home!';})
    ->add('users/?/test/?', new \Controllers\Users())
    ->add('.*', function () {return '404';})
;

$response = $router(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);

echo $response;
