<!-- Forma za registraciju korisnika -->
<section class='registracija'>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12'>
                <form class="form-reg" action="<?php echo URL . 'users/addUser'; ?>" method="post" >
                    <div class='row'>
                        <?php
                        if (!empty($_GET['error']) && $_GET['error'] == 'prazna_polja') {
                            echo '<h3 style="color:red">Вы не заполнили все поля!</h3><br>';
                        }
                        ?>
                        <?php
                        if (!empty($_GET['error']) && $_GET['error'] == 'neispravan_email') {
                            echo '<h3 style="color:red">Пожалуйста, введите действительный адрес электронной почты!</h3><br>';
                        }
                        ?>
                        <?php
                        if (!empty($_GET['error']) && $_GET['error'] == 'neuspesna_registracija') {
                            var_dump($_POST);
                            echo '<h3 style="color:red">Регистрация не удалась, попробуйте еще раз позже!</h3><br>';
                        }
                        ?>
                        <p class='reg-title'>Регистрация</p>
                        <div class='col-sm-6'>
                            <label for="login">Логин:</label><input type="text" id="login" name="login" class='reg' placeholder="Выберите имя пользователя"/> <br/>
                            <label for="password">Пароль:</label><input type="password" id="password" name="password" class='reg' placeholder="Выберите пароль"/> <br/>
                            <label for="email">Email:</label><input type="text" id="email" name="email" class='reg' placeholder="Введите действительный email"/> <br/>
                            <label for="first_name">Имя:</label><input type="text" id="first_name" name="first_name" class='reg' placeholder="Ваше имя"/> <br/>
                            <label for="last_name">Фамилия:</label><input type="text" id="last_name" name="last_name" class='reg' placeholder="Ваше фамилия"/> <br/>
                        </div>
                        <div class='col-sm-6'>
                            <label for="address">Адрес:</label><textarea id="address" name="address" placeholder="Введите ваш адрес (для отправки посылки почтой)"></textarea> <br/>
                            <label for="phone">Телефон:</label><input type="text" id="phone" name="phone" class='reg' placeholder="Введите свой номер телефона"/> <br/>
                            <input class="reg-button" type="submit" value="Зарегистрироваться">
                        </div>   


                    </div>
                </form>  
            </div>
        </div>
    </div>
</section>
<!-- Kraj registracije -->