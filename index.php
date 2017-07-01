<?php

error_reporting(E_ALL);
session_start();
session_name('oiseauoui');
//echo $_GET['url'];
//die();
require 'config.php';
require LIBS.'Router.php';
require LIBS.'Controller.php';
require LIBS.'View.php';
require LIBS.'Database.php';
require LIBS.'Model.php';

$oiseauoui = new Router();