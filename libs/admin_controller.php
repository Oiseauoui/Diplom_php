<?php

class Admin_Controller {

    var $view;
    var $model;

    public function __construct($name = 0) {
        $this->view = new Admin_View();
    }

    public function loadModel ($name){
        $path = BASE_PATH . 'models/'.$name.'_admin_model.php';
        if (file_exists($path)) {
            include $path;

            $modelName = ucfirst($name).'_admin_model';
            $this->model = new $modelName();
        }
    }

}