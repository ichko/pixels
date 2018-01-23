<?php
require_once '../framework/db.php';
require_once 'db_config.php';

$db = new \Framework\DB\MySqlConnection($db_config);
$seed_sql = file_get_contents('seed.sql');
$db->query($seed_sql)->execute();

echo 'DB seeded!';
