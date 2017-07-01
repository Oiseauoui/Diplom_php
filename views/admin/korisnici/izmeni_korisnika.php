<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
        <p class="title1">КЛИЕНТЫ</p>

<form class="form" action="<?php echo ADMIN_URL . 'korisnici/izmeniKorisnika'; ?>" method="post" >
    <input type="hidden" name="user_id" value="<?php echo $this->korisnik['user_id']; ?>" />
    <label for="login">Login:</label> <input type="text" id="login" name="login" value="<?php echo ($this->korisnik['login']); ?>"/> <br/>
    <label for="password">Пароль:</label> <input type="password" id="password" name="password" value="<?php echo ($this->korisnik['password']); ?>" /> <br/>
    <label for="email">Email:</label> <input type="text" id="email" name="email" value="<?php echo ($this->korisnik['email']); ?>"/> <br/>
    <label for="first_name">Имя:</label> <input type="text" id="first_name" name="first_name" value="<?php echo ($this->korisnik['first_name']); ?>"/> <br/>
    <label for="last_name">Фамилия:</label> <input type="text" id="last_name" name="last_name" value="<?php echo ($this->korisnik['last_name']); ?>"/> <br/>
    <label for="address">Адрес:</label> <input type="text" id="address" name="address" value="<?php echo ($this->korisnik['address']); ?>"/> <br/>
    <label for="phone">Телефон:</label> <input type="text" id="phone" name="phone" value="<?php echo ($this->korisnik['phone']); ?>"/> <br/>
    <label for="active">Статус:</label>
    <select name="active">
        <option value=""> - - - - - </option>
        <option name="active" value="1" <?php echo ($this->korisnik['active']==1 ? 'selected="selected"' : '') ?> >Активный</option>
        <option name="active" value="0" <?php echo ($this->korisnik['active']==0 ? 'selected="selected"' : '') ?>>Неактивен</option>

    </select> <br/>
    <label for="fk_group_id">Группа</label>
    <select name="fk_group_id">
                <option value=""> - - - - - </option>
                <?php
                    foreach ($this->groups as $groups) {
                        echo '<option ' .  ($this->korisnik['fk_group_id'] == $groups['group_id'] ? 'selected="selected"' : '') .  ' value="' . $groups['group_id'] .'">'. $groups['group'] . '</option>';
                    }
                ?>
            </select> <br/>
            <button class="button" type="submit" value="Azuriraj">ОБНОВИТЬ</button>
</form>
    </section>
</div>