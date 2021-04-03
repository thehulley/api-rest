<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);


define('HOST', 'localhost');
define('DB', 'api');
define('USER', 'root');
define('PASS', '');
define('DS', DIRECTORY_SEPARATOR);
define('DIR_APP', __DIR__);
define('DIR_PROJECT', 'api');


if (file_exists('autoload.php')){
    include 'autoload.php';
}else {
    echo 'Erro ao incluir bootstrap'; exit;
}