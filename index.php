<?php

session_start();
session_name('juli');
//echo $_GET['url'];
//die();
require 'config.php';
require LIBS.'Router.php';
require LIBS.'Controller.php';
require LIBS.'View.php';
require LIBS.'Database.php';
require LIBS.'Model.php';

$stgeorge = new Router();

?>