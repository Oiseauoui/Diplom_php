<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ю_Шишик</title>
        <link href="<?php echo URL . 'libs/css/bootstrap.min.css'?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo URL . 'views/public/style.css'; ?>"/>
        <link rel="stylesheet" href="<?php echo URL . 'views/public/animate.css'; ?>"/>
        <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
       <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans" rel="stylesheet">   
        <script type="text/javascript" src="<?php echo URL . 'libs/javascript/jquery-1.10.2.min.js' ?>"></script>
        <script src="<?php echo URL . 'libs/js/bootstrap.min.js'?>"></script>
        <script src="<?php echo URL . 'libs/js/main.js'?>"></script>
    </head>
    <body>
        <nav class='navbar wrap' role='navigation'>           
            <div class="container-fluid"> 
               
                    <button type="button" class="navbar-toggle burger" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                      
                    </button>  
                    <a class="navbar-logo hidden-xs" href="#">ШИШИК</a>
                    <a class="navbar-logo visible-xs" href="#">ШИШИК</a>
                <?php if (!empty($_SESSION['user_id'])) { ?>
                    <div class="header_login navbar-right">
                        <span class='nameLog'><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></span>
                        <br>
                        <a href="<?php echo URL . 'proizvodi/korpa' ?>" ><span class='glyphicon glyphicon-shopping-cart'></span> : <span class="priceLog">
                    <?php
                        $priceSum = 0;
                        if (!empty($_SESSION['korpa'])) {
                            foreach ($_SESSION['korpa'] as $proizvodUkorpi) {
                            $priceSum += $proizvodUkorpi['price']*$proizvodUkorpi['kolicina'];
                            }
                        }
                        echo number_format($priceSum, 2, ',', '.') . ' RSD';
                    ?>
                        </span>
                      </a> 
                      </div>    
            <?php } ?>  
                   
                    <div class="clear_both visible-xs"></div>
        <div class="collapse navbar-collapse navbar-right" id="myNavbar">
            <ul class="nav navbar-nav navigation" >
                <li><a <?php if (!empty($this->controllerName) && $this->controllerName == 'home') {
                echo 'class="active"';
                } ?> href="<?php echo URL . 'home' ?>">ГЛАВНАЯ</a></li>
                <li><a  <?php if (!empty($this->controllerName) && $this->controllerName == 'proizvodi') {
                echo 'class="active"';
                } ?> href="<?php echo URL . 'proizvodi' ?>">ТОВАРЫ</a></li>
                <li><a <?php if (!empty($this->controllerName) && $this->controllerName == 'kontakt') {
                echo 'class="active"';
                } ?> href="<?php echo URL . 'kontakt' ?>">КОНТАКТЫ</a></li>
                <?php if (!empty($_SESSION['user_id'])) { ?>
                <li><a <?php if (!empty($this->controllerName) && $this->controllerName == 'korisnici') {
                echo 'class="active"';
                } ?> href="<?php echo URL . 'korisnici/logout' ?>">ВЫЙТИ</a></li>
                <?php } else { ?>
                <li><a <?php if (!empty($this->controllerName) && $this->controllerName == 'korisnici') {
                echo 'class="active"';
                } ?> href="<?php echo URL . 'korisnici/login' ?>">ВОЙТИ</a></li>
                <?php } ?>                
            </ul>
        </div> 
    </div>         
</nav>  
          

 