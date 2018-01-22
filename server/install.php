<?php
require_once 'module.php';

$db = $container->resolve('db');

$db->query("
    CREATE TABLE IF NOT EXISTS `{$db->get_db_name()}`.`users` (
        `id` INT NOT NULL AUTO_INCREMENT ,
        `name` VARCHAR(50) NOT NULL ,
        `email` VARCHAR(50) NOT NULL ,
        `pass_hash` VARCHAR(256) NOT NULL ,
        PRIMARY KEY (`id`)
    )
    ENGINE = InnoDB;
")->execute();

$db->query("
    CREATE TABLE IF NOT EXISTS `{$db->get_db_name()}`.`banners` (
        `id` INT NOT NULL AUTO_INCREMENT ,
        `banner_info` TEXT NOT NULL ,
        PRIMARY KEY (`id`)
    )
    ENGINE = InnoDB;
")->execute();

echo 'Successfully created the DB.';
