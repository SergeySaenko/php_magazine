<?php

//define('ROOT', '/my_shop/');
define('DB_HOST', 'localhost');
define('DB_NAME', 'test2');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_CONNECT', 'mysql:host='. DB_HOST . ';dbname=' . DB_NAME);

$config['db_charset'] = 'UTF-8';
$config['path_root'] = __DIR__;
$config['path_public'] = $config['path_root'] . '/../public';
$config['path_model'] = $config['path_root'] . '/../model';
$config['path_controller'] = $config['path_root'] . '/../controller';
$config['path_cache'] = $config['path_root'] . '/../cache';
$config['path_data'] = $config['path_root'] . '/data';
$config['path_fixtures'] = $config['path_data'] . '/fixtures';
$config['path_migrations'] = $config['path_data'] . '/../migrate';
$config['path_commands'] = $config['path_root'] . '/../lib/commands';
$config['path_libs'] = $config['path_root'] . '/../lib';
$config['path_templates'] = $config['path_root'] . '/../templates';

$config['path_logs'] = $config['path_root'] . '/../logs';

$config['sitename'] = 'Интернет-магазин';