<?php
class Controller {
    public $view;
    public $model;
    function __construct(){
        $this->view = new View();
    }
    public function loadModel ($name){
        $path = BASE_PATH . '/models/'.$name.'_model.php';
        if(file_exists($path)){
            include $path;
            
            $modelName = ucfirst($name).'_Model';
            $this->model = new $modelName();
        } 
    }
}
