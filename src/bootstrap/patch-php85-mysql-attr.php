<?php

$path = __DIR__.'/../vendor/laravel/framework/config/database.php';

if (! is_file($path)) {
    exit(0);
}

$contents = file_get_contents($path);
$replacement = "(defined('Pdo\\\\Mysql::ATTR_SSL_CA') ? \\Pdo\\Mysql::ATTR_SSL_CA : PDO::MYSQL_ATTR_SSL_CA)";

if (! str_contains($contents, 'PDO::MYSQL_ATTR_SSL_CA') || str_contains($contents, 'Pdo\\\\Mysql::ATTR_SSL_CA')) {
    exit(0);
}

file_put_contents($path, str_replace('PDO::MYSQL_ATTR_SSL_CA', $replacement, $contents));
