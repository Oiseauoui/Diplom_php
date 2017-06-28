<?php

class Korisnici_Admin_Controller extends Admin_Controller {
    
    public function index () {
        $this->view->activeNavigation = 'korisnici';
        $korisnici=$this->model->getUsers ();
        $this->view->korisnici=$korisnici;
        $groups = $this->model->getGroups();
        $this->view->groups = $groups;
        $this->view->render('korisnici/korisnici.php');
        
    }

    public function login() {
        $this->view->activeNavigation = 'login';
        $this->view->render('korisnici/login.php');
    }

    public function ulogujSe() {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            header('Location: ' . ADMIN_URL . 'korisnici/login?error=prazna_polja');
            die();
        }

        if ($this->model->loginCheck($_POST['login'], $_POST['password']) ) {
            header('Location: ' . ADMIN_URL . 'home');
            die();
        } else {
            header('Location: ' . ADMIN_URL . 'korisnici/login?error=korisnik_ne_postoji');
            die();
        }
    }

    public function logout() {
        unset($_SESSION);
        session_destroy();
        header('Location: ' . ADMIN_URL . 'korisnici/login');
        die();
    }
    
    public function obrisiKorisnika ($userID) {
        $this->model->deleteUser($userID);
        header('Location: ' . ADMIN_URL . 'korisnici?poruka=obrisano');
    }
    
    public function dodajKorisnika () {
       
        $user['login'] = $_POST['login'];
        $user['password'] = $_POST['password'];
        $user['email'] = $_POST['email'];
        $user['first_name'] = $_POST['first_name'];
        $user['last_name'] = $_POST['last_name'];
        $user['address'] = $_POST['address'];
        $user['phone'] = $_POST['phone'];
        $user['active'] = $_POST['active'];
        $user['fk_group_id'] = $_POST['fk_group_id'];
        
        if ($this->model->addUser($user))
        {
        header('Location: ' . ADMIN_URL . 'korisnici?poruka=dodato');}
        else {
        header('Location: ' . ADMIN_URL . 'korisnici?poruka=postoji');
   
        }
        
    }
    public function izmeni ($userID) {
        $this->view->activeNavigation = 'korisnici';
        $user=$this->model->getUser($userID);
        $this->view->korisnik=$user;
        $groups = $this->model->getGroups();
        $this->view->groups = $groups;
        $this->view->render('korisnici/izmeni_korisnika.php');
        
    }
    
    public function izmeniKorisnika () {
        
        $user['user_id'] = $_POST['user_id'];
        $user['login'] = $_POST['login'];
        $user['password'] = $_POST['password'];
        $user['email'] = $_POST['email'];
        $user['first_name'] = $_POST['first_name'];
        $user['last_name'] = $_POST['last_name'];
        $user['address'] = $_POST['address'];
        $user['phone'] = $_POST['phone'];
        $user['active'] = $_POST['active'];
        $user['fk_group_id'] = $_POST['fk_group_id'];
        
        $this->model->updateUser($user);
        header('Location: ' . ADMIN_URL . 'korisnici?poruka=izmenjeno');
        
    }

}