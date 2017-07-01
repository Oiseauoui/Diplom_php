<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
    <p class="title1">АВТОРИЗАЦИЯ</p>
    <div class="login">
    <form class="form" action="<?php echo ADMIN_URL . 'korisnici/ulogujSe'; ?>" method="post" >
    <label for="login">Login:</label><input type="text" id="login" name="login" />
    <label for="password">Пароль:</label><input type="password" id="password" name="password" /><br>
    <button class="button" type="submit" value="Login">ВОЙТИ</button>
</form>
    </div>
    </section>
</div>