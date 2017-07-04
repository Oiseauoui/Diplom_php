<?php
class Contact_Controller extends Controller
{
    public function index() {
        $contactPage=$this->model->getPage('Contact');
        $this->view->podaci=$contactPage;
        $this->view->render('contact/contact_page.php');
    }
    public function poruka() {
        
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['text'])) {
            header("Location: " . URL ."contact?poruka=unesitepodatke");
            die();
        }
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            header('Location: ' . URL . 'contact?poruka=emailneispravan');
            die();
        }

        $name=$_POST['name'];
        $email=$_POST['email'];
        $text=$_POST['text'];

        if ($this->model->Contact($name,$email,$text)) {
            header('Location: ' . URL . 'contact?poruka=poslataporuka');
            die();
        }else {
            header('Location: ' . URL . 'contact?poruka=didnotsent');
            die();

        }
    }
}