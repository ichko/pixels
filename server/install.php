<?php

$db->query("
    CREATE TABLE IF NOT EXISTS `test`.`users` (
        `id` INT NOT NULL AUTO_INCREMENT ,
        `name` VARCHAR(50) NOT NULL ,
        `email` VARCHAR(50) NOT NULL ,
        `pass_hash` VARCHAR(256) NOT NULL ,
        PRIMARY KEY (`id`))
    ENGINE = InnoDB;
")->execute();
