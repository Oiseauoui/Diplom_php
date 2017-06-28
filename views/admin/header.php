<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>St.George - administracija</title>
        <link href="<?php echo URL . 'libs/css/bootstrap.min.css'?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo URL . 'views/admin/style_admin.css'; ?>"/>
        <script type="text/javascript" src="<?php echo URL . 'libs/javascript/jquery-1.10.2.min.js' ?>"></script>
        <script src="<?php echo URL . 'libs/js/bootstrap.min.js'?>"></script>
        <script src="<?php echo URL . 'libs/js/admin_main.js'?>"></script>
        <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    </head>
    <body>
        
        <header class="admin_header">
            <div class ="container-fluid">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4">                           
                            <div class="header_logo"><span>St.George</span></div>
                        </div>
                        <div class="col-xs-8 col-sm-8">
                            <div class="header_user">
                            <?php if (!empty($_SESSION['user_id'])) {  ?>  
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <?php echo '<span><b>' . $_SESSION['login'] . '</b>' . ' (' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . ')</span>' ; ?>
                               
                            <?php } ?>
                             <?php if (!empty($_SESSION['user_id'])): ?>
                            <a <?php if (!empty($this->activeNavigation) && $this->activeNavigation == 'logout') { echo 'class="active"' ; } ?> href="<?php echo ADMIN_URL . 'korisnici/logout' ?>">Log Out</a>
                            <?php else: ?>
                            <a <?php if (!empty($this->activeNavigation) && $this->activeNavigation == 'login') { echo 'class="active"' ; } ?> href="<?php echo ADMIN_URL . 'korisnici/login' ?>">Log In</a>
                            <?php endif ?>   
                            </div>
                        </div>
                </div>
            </div>
        </header>
        <div class="container-fluid" style="padding-left:0px;">
            <div class="row">
                <div class='col-xs-12 col-sm-3 col-md-2'>
                <button class='btn kateg visible-xs'>MENI<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></button>
                <div class="ktg">
                <ul class="admin_meni">
                    <li><a <?php if (!empty($this->activeNavigation) && $this->activeNavigation == 'home') { echo 'class="active"' ; } ?> href="<?php echo ADMIN_URL . 'home' ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span><br>Home</a></li>
                    <li><a <?php if (!empty($this->activeNavigation) && $this->activeNavigation == 'kategorije') { echo 'class="active"' ; } ?> href="<?php echo ADMIN_URL . 'proizvodi/kategorije' ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><br>Kategorije</a></li>
                    <li><a <?php if (!empty($this->activeNavigation) && $this->activeNavigation == 'podkategorije') { echo 'class="active"' ; } ?> href="<?php echo ADMIN_URL . 'proizvodi/podkategorije' ?>"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span><br>Podkategorije</a></li>
                    <li><a <?php if (!empty($this->activeNavigation) && $this->activeNavigation == 'proizvodi') { echo 'class="active"' ; } ?> href="<?php echo ADMIN_URL . 'proizvodi' ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span><br>Proizvodi</a></li>
                    <li><a <?php if (!empty($this->activeNavigation) && $this->activeNavigation == 'kontakt') { echo 'class="active"' ; } ?> href="<?php echo ADMIN_URL . 'kontakt' ?>"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><br>Kontakti</a></li>
                    <li><a <?php if (!empty($this->activeNavigation) && $this->activeNavigation == 'korisnici') { echo 'class="active"' ; } ?> href="<?php echo ADMIN_URL . 'korisnici' ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><br>Korisnici</a></li>
                    <li><a <?php if (!empty($this->activeNavigation) && $this->activeNavigation == 'kupovina') { echo 'class="active"' ; } ?> href="<?php echo ADMIN_URL . 'kupovina' ?>"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><br>Kupovina</a></li>
                                    
                </ul>  
                </div>
            </div>
   
              
            
            

