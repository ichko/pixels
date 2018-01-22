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
    ) ENGINE = InnoDB;
")->execute();

$db->query("
    CREATE TABLE `test`.`banners` (
        `id` INT NOT NULL AUTO_INCREMENT ,
        `name` VARCHAR(256) NOT NULL ,
        `description` VARCHAR(512) NOT NULL ,
        `url` VARCHAR(256) NOT NULL ,
        `top_x` INT NOT NULL ,
        `top_y` INT NOT NULL ,
        `width` INT NOT NULL ,
        `height` INT NOT NULL ,
        `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        `user_id` INT NOT NULL ,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;
")->execute();

echo 'Successfully created the DB.';
