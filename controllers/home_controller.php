<?php



class Home_Controller extends Controller  {
	function __construct()
    {
        parent::__construct();
    }

    public function index () {

        $slider=$this->model->getSlider();
        $this->view->slider=$slider;
        $homeIt=$this->model->homeItems();
        $this->view->items=$homeIt;
        $this->view->render('home/home_page.php');
    }
    public function uputstva() {
        $this->view->render('home/instructions.php');
    }

}