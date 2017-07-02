<?php
define('URL','/');
define('ADMIN_URL',  '/admin/'); //  отвечает за путь admin в адресной строке!!!!

$basePath = realpath(dirname(__FILE__)).'/';
//var_dump($basePath);die();
define('BASE_PATH', $basePath);
define('LIBS',BASE_PATH.'libs/');

define('DB_TYPE','mysql');
define('DB_HOST','localhost');
define('DB_NAME','oiseauou');
define('DB_USER','root');
define('DB_PASS','');

define('SMTP_SERVER', '');
define('SMTP_USER', '');
define('SMTP_PASSWORD', '');
define('SMTP_PORT', '');
define('SMTP_SSL', 1);