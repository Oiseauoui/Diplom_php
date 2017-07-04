<!-- Nalog za prijavu -->
<section id='logIn'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-sm-6 col-sm-offset-3'>
                <div class='logInForm'>
                    <?php
                    if (!empty($_GET['error']) && $_GET['error'] == 'prazna_polja') {
                        echo '<h3 style="color:#EF81B1">Вы не заполнили все поля!</h3><br>';
                    }
                    ?>
                    <?php
                    if (!empty($_GET['error']) && $_GET['error'] == 'korisnik_ne_postoji') {
                        echo '<h3 style="color:#EF81B1">Пользователь не существует!</h3><br>';
                    }
                    ?>
                    <?php
                    if (!empty($_GET['msg']) && $_GET['msg'] == 'hvala_sto_ste_se_registrovali') {
                        echo "<h3 style='color:#EF81B1'> Добро пожаловать! Вы можете войти.</h3>";
                    }
                    ?>
                    <p class='reg-title'>Добро пожаловать!</p>
                    <form action="<?php echo URL . 'users/role'; ?>" method="post" id="login_form" >
                        <input type="text" id="login" name="login" placeholder="Имя пользователя" class='login-input' /> <br/>
                        <input type="password" id="password" name="password" placeholder="Пароль" class='login-input' /> <br/>
                        <input class="login-button" type="submit" value="Войти">
                    </form>
                    <p class='loginP'>Если у Вас нет аккаунта, пожалуйста <a class='link-reg' href="<?php echo URL . 'users/registration ' ?>">  ЗАРЕГИСТРИРУЙТЕСЬ.</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Kraj prijave -->