<?php
require_once '../module.php';

$db = $container->resolve('db');
$seed_sql = file_get_contents('seed.sql');

$db->query($seed_sql)->execute();
