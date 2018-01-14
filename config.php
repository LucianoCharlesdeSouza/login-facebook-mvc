<?php

require 'environment.php';

global $config;
$config = array();

if (ENVIRONMENT == 'development') {
    define("BASE", "http://localhost/NOME_DA_PASTA_DO_PROJETO/");
    define("BASEADMIN", "http://localhost/NOME_DA_PASTA_DO_PROJETO/App/admin/");
    $config['dbname'] = 'dbname';
    $config['host'] = 'dbhost';
    $config['dbuser'] = 'dbuser';
    $config['dbpass'] = 'dbpass';
} else {
    define("BASE", "http://localhost/NOME_DA_PASTA_DO_PROJETO/");
    define("BASEADMIN", "http://localhost/NOME_DA_PASTA_DO_PROJETO/App/admin/");
    $config['dbname'] = 'dbname';
    $config['host'] = 'dbhost';
    $config['dbuser'] = 'dbuser';
    $config['dbpass'] = 'dbpass';
}

