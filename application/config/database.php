<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.50.68'|| $_SERVER['HTTP_HOST'] == '192.168.50.56' || $_SERVER['HTTP_HOST'] == '192.168.50.33' || $_SERVER['HTTP_HOST'] == '192.168.50.34' || $_SERVER['HTTP_HOST'] == '192.168.50.53') {

    $host = 'localhost';
    $userName = 'root';
    $password = '';
    $database = 'doreen_power';
} else {
    $host = 'localhost';
    $userName = 'tbdinfo_poweruse';
    $password = 'T}4Y#wA}8^1F';
    $database = 'tbdinfo_doreen_powerdb';
}

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn' => '',
    'hostname' => $host,
    'username' => $userName,
    'password' => $password,
    'database' => $database,
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
