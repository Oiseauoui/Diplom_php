<?php
error_reporting(E_ALL);


session_start();
session_name('oiseauoui_admin');

require 'config.php';
require LIBS.'Database.php';
require LIBS.'Router.php';
require LIBS.'Admin_Controller.php';
require LIBS.'Admin_View.php';
require LIBS.'Admin_Model.php';

//echo "admin";
//var_dump($_GET['url']);
//die();

$oiseauoui = new Router('admin');