<?php

class Home_Admin_Controller extends Admin_Controller {
    
    function index(){
        $this->view->activeNavigation = 'home';

        $slider = $this->model->getSlider();
        $this->view->slider = $slider;
        $items = $this->model->homeItems();
        $this->view->items = $items;
        $this->view->render('home/home_page.php');
    }

    public function azuriraj() {
        $title = $_POST['title'];
        $description = $_POST['description'];

        $this->model->updateHomePage($title, $description);

        header('Location: ' . ADMIN_URL . 'home');
        return true;
    }
    
    public function izmeniSlider($slideId){
        $this->view->activeNavigation = 'home';
        $slide = $this->model->getSlide($slideId);
        $this->view->slide = $slide;
        $this->view->render('home/prikaz_slide.php');
        
    }
    
    public function promeniSlider(){
        $this->view->activeNavigation = 'home';
        $slide['slider_id'] = $_POST['slider_id'];
        $slide['welcome'] = $_POST['welcome'];
        $slide['shop'] = $_POST['shop'];
        $slide['image'] = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
        $result = $this->model->promenaSlide($slide);
        
        //Ako menjamo sliku
        if (!empty($_FILES['image']['tmp_name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['size'] > 0) {
            require_once LIBS . 'PHPThumb/ThumbLib.inc.php';
            $imageFolder = BASE_PATH.'images/home/';
            $imageFile = $_FILES['image']['name'];

            if (!is_dir($imageFolder)) {
                mkdir($imageFolder);
            }
              $phpThumb = PhpThumbFactory::create($_FILES['image']['tmp_name']);
              $phpThumb->resize(1600,885)->save($imageFolder . $imageFile);
            

        }
        if($result){
            header('Location: ' . ADMIN_URL . 'home?msg=1');
        } else {
            header('Location: ' . ADMIN_URL . 'home?msg=2');
        }
    }
    
     public function izmeniItems($itemId){
        $this->view->activeNavigation = 'home';
        $item = $this->model->getItem($itemId);
        $this->view->item = $item;
        $this->view->render('home/prikaz_item.php');
        
    }
    
    public function promeniItems(){
        $this->view->activeNavigation = 'home';
        $item['homeItems_id'] = $_POST['homeItems_id'];
        $item['title'] = $_POST['title'];
        $item['image'] = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
        $result = $this->model->promenaItem($item);
        
        //Ako menjamo sliku
        if (!empty($_FILES['image']['tmp_name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['size'] > 0) {
            require_once LIBS . 'PHPThumb/ThumbLib.inc.php';
            $imageFolder = BASE_PATH.'images/home/';
            $imageFile = $_FILES['image']['name'];

            if (!is_dir($imageFolder)) {
                mkdir($imageFolder);
            }
              $phpThumb = PhpThumbFactory::create($_FILES['image']['tmp_name']);
              $phpThumb->resize(250,250)->save($imageFolder . $imageFile);
            

        }
        if($result){
            header('Location: ' . ADMIN_URL . 'home?msg=3');
        } else {
            header('Location: ' . ADMIN_URL . 'home?msg=4');
        }
    }
    
}
