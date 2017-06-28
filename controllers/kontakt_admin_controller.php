<?php

class Kontakt_Admin_Controller extends Admin_Controller {

   
    //prikaz kontakt stranice
    public function index(){
        $this->view->activeNavigation = 'kontakt'; //postavlja navigaciju Kontakt kao aktivnu
        $search = !empty($_GET['search']) ? $_GET['search'] : ''; //ispituje da li postoji pretraga i ako postoji dodeljuje promenljivoj $search
	$replied = !empty($_GET['replied']) ? $_GET['replied'] : '';  //ispituje da li postoji odgovor ili ne i ako postoji dodeljuje promenljivoj $replied
        
        $contactPerPage = 10; //broj kontakta  na jednoj stranici pri stranicenju
        $page = 1; //po difoltu prva stranica koja se prikazuje je stranica broj 1
        
        if (!empty($_GET['page']) && $_GET['page'] > 1) {
            $page = $_GET['page']; //ako treba prikazati neku drugu stranicu  njen broj se dodeljuje pronenljivoj $page
        }
        
        $offset = ($page - 1) * $contactPerPage; //broj prvog kontakta koji se prikazuje na izabranoj stranici
        $limit = $contactPerPage;  //broj kontakta na stranici
        
        $contactsCount = $this->model->countContacts($replied, $search); //prikuplja i  vraca broj kontakta u zavisnosti od pretrage i uslova
       
        $pagesCount = ceil($contactsCount / $contactPerPage); // broj potrebnih stranica
        $this->view->pagesCount = $pagesCount;
        $this->view->currentPage = $page;
        
        $contacts = $this->model->getContacts($replied, $offset, $limit, $search); //poziva metodu koja prikuplja i vraca kontakte
       
        $this->view->contacts = $contacts; //podatke o kontaktima dodeljuje svojstvu contacts View objekta da bi se preko njega prikazali na stranici kontakti
        $this->view->paginationUrl = ADMIN_URL . 'kontakt';
        $this->view->searchParam = !empty($search) ? '&pretraga=' . $search : '';
        $this->view->search = $search;
        $this->view->replied = $replied;
        $this->view->render('kontakt/kontakti.php'); //prikaz kontakt stranice sa kontaktima
      
    } 
    
    public function obrisiKontakt() {
        $contactId = $_GET['contact_id'];
        $this->model->deleteContact($contactId); //brise kontakte
        header('Location: ' . ADMIN_URL . 'kontakt');
    }
    
    
    //prikaz stranice za azuriranje kontakt stranice
    public function kontaktStranica(){
        $this->view->activeNavigation = 'kontaktStranica';
        $kontaktPage = $this->model->getKontaktPage();
        $this->view->kontaktPage = $kontaktPage;
        $this->view->render('kontakt/kontakt_stranica.php');
    }
    
    //azuriranje kontakt stranice
    public function azurirajKontaktStranicu() {
        $title = $_POST['title'];
        $description = $_POST['description'];
        
        $result = $this->model->updateContactPage($title, $description);
        
        if($result){
            header('Location: ' . ADMIN_URL . 'kontakt/kontaktStranica?message=azurirana'); //vraca poruku - uspesno
        } else {
            header('Location: ' . ADMIN_URL . 'kontakt/kontaktStranica?message=nije_azurirana');//vraca poruku - neuspesno
        }
    }

    
    //metoda za prikaz stranice za odgovor na kontakt
    public function odgovori($contactId) {
        $this->view->activeNavigation = 'kontakt'; //postavlja navigaciju Kontakt kao aktivnu
        $contact = $this->model->getContact($contactId);
        $this->view->contact = $contact;
        $this->view->render('kontakt/odgovorKontakt.php');
    }

    //slanje odgovora na email
    public function odgovorKontakt($contactID) {
        if (empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['odgovor'])) {
            header('Location: ' . ADMIN_URL . 'kontakt/odgovori/' . $contactID . '?error=prazna_polja'); //vraca poruku o gresci
            die();
        }
        require_once LIBS . 'email/swift_required.php'; //za slanje email-a

        $subject = $_POST['subject'];
        $from = SMTP_USER;
        $to = $_POST['email'];
        $body = $_POST['odgovor'];

        // Create the Transport
        $transport = Swift_SmtpTransport::newInstance()->setHost(SMTP_SERVER);
        $transport->setPort(SMTP_PORT);
        $transport->setUsername(SMTP_USER);
        $transport->setPassword(SMTP_PASSWORD);
        if (SMTP_SSL) {
            $transport->setEncryption('ssl');
        }

        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        // Create a message
        $message = Swift_Message::newInstance($subject);
        $message->setFrom($from);
        $message->setTo($to);
        $message->setBody($body);
        $message->setContentType("text/html");
        $message->setPriority(3);
        $message->getHeaders()->addTextHeader('User-Agent', 'Mozilla Thunderbird 1.5.0.8 (Windows/20061025)');

        // Send the message
        if($result = $mailer->send($message)) {
            $this->model->replied($contactID);
            header('Location: ' . ADMIN_URL . 'kontakt?poruka=uspesan_odgovor'); //vraca poruku
            die();
        }
    }


}