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
<form class="form" action="<?php echo ADMIN_URL . 'korisnici/dodajKorisnika'; ?>" method="post" >
    <label for="login">Login:</label> <input type="text" id="login" name="login" required /> <br/>
    <label for="password">Password:</label> <input type="password" id="password" name="password" required/> <br/>
    <label for="email">Email:</label> <input type="text" id="email" name="email" required/> <br/>
    <label for="first_name">Ime:</label> <input type="text" id="first_name" name="first_name" required /> <br/>
    <label for="last_name">Prezime:</label> <input type="text" id="last_name" name="last_name" required/> <br/>
    <label for="address">Adresa:</label> <input type="text" id="address" name="address" required /> <br/>
    <label for="phone">Telefon:</label> <input type="text" id="phone" name="phone" required/> <br/>
    <label for="active">Status:</label>
    <select name="active" required>
        <option value=""> - - - - - </option>
        <option name="active" value="1">Aktivan</option>
        <option name="active" value="0">Neaktivan</option>
    </select> <br/>
    <label for="fk_group_id">Grupa:</label> 
    <select name="fk_group_id" required>
    <option value=""> - - - - - </option>
    <?php
    foreach ($this->groups as $groups) {
        echo '<option ' . ($this->korisnik['fk_group_id'] == $groups['group_id'] ? 'selected="selected"' : '') . ' value="' . $groups['group_id'] . '">' . $groups['group'] . '</option>';
    }
    ?>
</select> <br/>
<button class="button" type="submit" value="Dodaj">DODAJ</button>
</form>
<br/>
<span> Prikaz postojećih korisnika: </span>
<table class="mt15 table-responsive" border="1">
    <tr>
        <th>ID</th>
        <th>Login</th>
        <th>E-mail</th>
        <th>Ime</th>
        <th>Prezime</th>
        <th>Adresa</th>
        <th>Telefon</th>
        <th>Datum registracije</th>
        <th>Status</th>
        <th>Grupa</th>
        <th>Izmeni</th>
        <th>Obrisi</th>
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
            <td><?php echo date("d.m.Y H:i", $korisnik ['registration_date']) ?></td>
            <td><?php if ($korisnik ['active'] > 0) {
        echo 'Aktivan';
    } else {
        echo "Neaktivan";
    } ?></td>
            <td> 
                <?php foreach ($this->groups as $group) {
                echo ($korisnik['fk_group_id']===$group['group_id'] ? $group['group'] : ''); }?>

            </td>
            <td>
                <a href="<?php echo ADMIN_URL . 'korisnici/izmeni/' . $korisnik['user_id'] ?>"
                   > Izmeni</a> 

            </td>
            <td>
                <a href="<?php echo ADMIN_URL . 'korisnici/obrisiKorisnika/' . $korisnik['user_id'] ?>"
                   title="Obrisi korisnika" onclick="return confirm('Da li ste sigurni da želite da izbrišete?');" > <img src="<?php echo URL . 'images/delete.png' ?>" /></a> 
            </td>
        </tr>
    <?php } ?>
</table>
</section>
</div>