<?php
require_once '../framework/db.php';
require_once 'db_config.php';

$db = new \Framework\DB\MySqlConnection($db_config);

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
    CREATE TABLE `{$db->get_db_name()}`.`snippets` (
        `id` INT NOT NULL AUTO_INCREMENT ,
        `name` VARCHAR(256) NOT NULL ,
        `description` VARCHAR(512) NOT NULL ,
        `code` TEXT NOT NULL ,
        `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        `user_id` INT NOT NULL ,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;
")->execute();

echo 'Successfully created the DB.';
