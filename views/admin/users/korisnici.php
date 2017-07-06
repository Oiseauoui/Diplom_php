<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
        <p class="title1">КЛИЕНТЫ</p>

<?php
if (!empty($_GET['poruka']) && $_GET['poruka'] == 'obrisano') {
    echo '<p style="color:red; font-weight:bold;">Пользователь удален!</p>';
}
?>
<?php
if (!empty($_GET['poruka']) && $_GET['poruka'] == 'dodato') {
    echo '<p style="color:red; font-weight:bold;">Пользователь будет добавлен!</p>';
}
?>
<?php
if (!empty($_GET['poruka']) && $_GET['poruka'] == 'izmenjeno') {
    echo '<p style="color:red; font-weight:bold;">Пользователь был обновлен!</p>';
}
?>
<?php
if (!empty($_GET['poruka']) && $_GET['poruka'] == 'postoji') {
    echo '<p style="color:red; font-weight:bold;">Пользователь уже существует!</p>';
}
?>
            <span> Добавление нового пользователя</span>
<form class="form" action="<?php echo ADMIN_URL . 'users/addUser'; ?>" method="post" >
    <label for="login">Login:</label> <input type="text" id="login" name="login" required /> <br/>
    <label for="password">Пароль:</label> <input type="password" id="password" name="password" required/> <br/>
    <label for="email">Email:</label> <input type="text" id="email" name="email" required/> <br/>
    <label for="first_name">Имя:</label> <input type="text" id="first_name" name="first_name" required /> <br/>
    <label for="last_name">Фамилия:</label> <input type="text" id="last_name" name="last_name" required/> <br/>
    <label for="address">Адрес:</label> <input type="text" id="address" name="address" required /> <br/>
    <label for="phone">Телефон:</label> <input type="text" id="phone" name="phone" required/> <br/>
    <label for="active">Статус:</label>
    <select name="active" required>
        <option value=""> - - - - - </option>
        <option name="active" value="1">Активен</option>
        <option name="active" value="0">Неактивен</option>
    </select> <br/>
    <label for="fk_group_id">Группа:</label>
    <select name="fk_group_id" required>
    <option value=""> - - - - - </option>
    <?php
    foreach ($this->groups as $groups) {
        echo '<option ' . ($this->korisnik['fk_group_id'] == $groups['group_id'] ? 'selected="selected"' : '') . ' value="' . $groups['group_id'] . '">' . $groups['group_id'] . '</option>';
    }
    ?>
</select> <br/>
<button class="button" type="submit" value="Добавить">ДОБАВИТЬ</button>
</form>
<br/>
<span> Уже существующие пользователи</span>
<table class="mt15 table-responsive" border="1">
    <tr>
        <th>ID</th>
        <th>Login</th>
        <th>E-mail</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Фдрес</th>
        <th>Телефон</th>
        <th>Дата регистрации</th>
        <th>Статус</th>
        <th>Группа</th>
        <th>Изменить</th>
        <th>Удалить</th>
    </tr>
<?php foreach ($this->korisnici as $korisnik) { ?>
        <tr>
            <td><?php echo $korisnik ['user_id'] ?></td>
            <td><?php echo $korisnik ['login'] ?></td>
            <td><?php echo $korisnik ['email'] ?></td>
            <td><?php echo $korisnik ['first_name'] ?></td>
            <td><?php echo $korisnik ['last_name'] ?></td>
            <td><?php echo $korisnik ['address'] ?></td>
            <td><?php echo $korisnik ['phone'] ?></td>
            <td><?php echo date('Y-m-d H:i:s', strtotime(str_replace('-','/', $korisnik ['registration_date']))) ?></td>
            <td><?php if ($korisnik ['active'] > 0) {
        echo 'Активен';
    } else {
        echo "Неактивен";
    } ?></td>
            <td>
                <?php foreach ($this->groups as $group) {
                echo ($korisnik['fk_group_id']===$group['group_id'] ? $group['group_id'] : ''); }?>

            </td>
            <td>
                <a href="<?php echo ADMIN_URL . 'users/change/' . $korisnik['user_id'] ?>"> Изменить</a>

            </td>
            <td>
                <a href="<?php echo ADMIN_URL . 'users/deleteUser/' . $korisnik['user_id'] ?>"
                   title="Удалить пользователя" onclick="return confirm('Вы уверены, что хотите удалить?');" > <img src="<?php echo URL . 'images/delete.png' ?>" /></a>
            </td>
        </tr>
    <?php } ?>
</table>
</section>
</div>