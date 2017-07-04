<?php

class Users_Admin_Controller extends Admin_Controller {
    
    public function index () {
        $this->view->activeNavigation = 'users';
        $korisnici=$this->model->getUsers ();
        $this->view->korisnici=$korisnici;
        $groups = $this->model->getGroups();
        $this->view->groups = $groups;
        $this->view->render('users/korisnici.php');
        
    }

    public function login() {
        $this->view->activeNavigation = 'login';
        $this->view->render('users/login.php');
    }

    public function role() {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            header('Location: ' . ADMIN_URL . 'users/login?error=prazna_polja');
            die();
        }

        if ($this->model->loginCheck($_POST['login'], $_POST['password']) ) {
            header('Location: ' . ADMIN_URL . 'home');
            die();
        } else {
            header('Location: ' . ADMIN_URL . 'users/login?error=korisnik_ne_postoji');
            die();
        }
    }

    public function logout() {
        unset($_SESSION);
        session_destroy();
        header('Location: ' . ADMIN_URL . 'users/login');
        die();
    }
    
    public function deleteUser ($userID) {
        $this->model->deleteUser($userID);
        header('Location: ' . ADMIN_URL . 'users?poruka=obrisano');
    }
    
    public function addUser () {
       
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
        header('Location: ' . ADMIN_URL . 'users?poruka=dodato');}
        else {
        header('Location: ' . ADMIN_URL . 'users?poruka=postoji');
   
        }
        
    }
    public function change ($userID) {
        $this->view->activeNavigation = 'korisnici';
        $user=$this->model->getUser($userID);
        $this->view->korisnik=$user;
        $groups = $this->model->getGroups();
        $this->view->groups = $groups;
        $this->view->render('users/izmeni_korisnika.php');
        
    }
    
    public function changeUser () {
        
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
        header('Location: ' . ADMIN_URL . 'users?poruka=izmenjeno');
        
    }

}