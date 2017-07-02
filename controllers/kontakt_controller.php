<?php
class Kontakt_Controller extends Controller
{
    public function index() {
        $kontaktPage=$this->model->getPage('Contact');
        $this->view->podaci=$kontaktPage;
        $this->view->render('kontakt/contact_page.php');
    }
    public function poruka() {
        
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['text'])) {
            header("Location: " . URL ."kontakt?poruka=unesitepodatke");
            die();
        }
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            header('Location: ' . URL . 'kontakt?poruka=emailneispravan');
            die();
        }
var_dump($_POST);
        $name=$_POST['name'];
        $email=$_POST['email'];
        $text=$_POST['text'];

        if ($this->model->Contact($name, $email, $text)) {
            header('Location: ' . URL . 'kontakt?poruka=poslataporuka');
            die();
        }else {
            header('Location: ' . URL . 'kontakt?poruka=nijeposlato');
            die();

        }
    }
}