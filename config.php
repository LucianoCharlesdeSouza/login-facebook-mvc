<?php

require 'environment.php';

global $config;
$config = array();

if (ENVIRONMENT == 'development') {
    define("BASE", "https://realtrueweb.com.br/login-facebook-mvc/");
    define("BASEADMIN", "http://localhost/NOME_DA_PASTA_DO_PROJETO/App/admin/");
    $config['dbname'] = 'realtrueweb_projeto_youtube';
    $config['host'] = 'server1.rapidcloud.com.br';
    $config['dbuser'] = 'realtrueweb_youtube';
    $config['dbpass'] = 'S*?{.8E+6MsS';
} else {
    define("BASE", "https://seudominio_real/");
    define("BASEADMIN", "https://seudominio_real/admin/");
    $config['dbname'] = 'realtrueweb_projeto_youtube';
    $config['host'] = 'server1.rapidcloud.com.br';
    $config['dbuser'] = '"realtrueweb_youtube";';
    $config['dbpass'] = 'S*?{.8E+6MsS';
}

