<?php

class Kupovina_Admin_Controller extends Admin_Controller {
    public function index(){
        $this->view->activeNavigation = 'kupovina';
        $purchases = $this->model->getPurchases();
        $this->view->purchases = $purchases;
        $this->view->render('kupovina/kupovina_page.php');
    }
    public function getDetail(){
        $purchaseDetails = $this->model->getDetailsOfPurchase();
        $this->view->purchaseDetails = $purchaseDetails;
        $this->view->load('kupovina/detalji_kupovine.php');        
    }
    public function sent($purchaseId){
        if($this->model->changeStatus($purchaseId)){
            header('Location: ' .ADMIN_URL. 'kupovina');
        }
        
    }
}
