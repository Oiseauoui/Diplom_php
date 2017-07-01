<?php
define('URL','/');
define('ADMIN_URL',  '/admin/'); //  отвечает за путь admin в адресной строке!!!!

$basePath = realpath(dirname(__FILE__)).'/';
//var_dump($basePath);die();
define('BASE_PATH', $basePath);
define('LIBS',BASE_PATH.'libs/');

define('DB_TYPE','mysql');
define('DB_HOST','oiseauou.ftp.ukraine.com.ua');
define('DB_NAME','oiseauou_db');
define('DB_USER','oiseauou_db');
define('DB_PASS','a3bzv8ws');

define('SMTP_SERVER', '');
define('SMTP_USER', '');
define('SMTP_PASSWORD', '');
define('SMTP_PORT', '');
define('SMTP_SSL', 1);