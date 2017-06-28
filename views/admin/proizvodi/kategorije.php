<section class='content'>
    <p class="title1">KATEGORIJE</p>
    
<div class='col-xs-12 col-sm-4 col-md-4'>
    
    <div class="dodaj_kat">  

<?php

    if(!empty($_GET['error']) && $_GET['error'] == '1'){
     echo   '<h3 style="color:red">Uspešno ste dodali novu kategoriju!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '2'){
     echo   '<h3 style="color:red">Niste popunili naziv kategorije!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '3'){
     echo   '<h3 style="color:red">Kategorija je obrisana!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '4'){
     echo   '<h3 style="color:red">Kategorija nije obrisana, pokušajte ponovo!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '5'){
     echo   '<h3 style="color:red">Nije obrisana,obrišite prvo proizvode koji pripadaju toj kategoriji!</h3><br>';
    }
    if (!empty($_GET['msg']) && $_GET['msg'] == 5){
    echo '<h3 style="color:red">Kategorija sa unetim nazivom već postoji u bazi!</h3>';
}
?>


    <span> Dodaj kategoriju:</span>
    <form class="form" action="<?php echo ADMIN_URL . 'proizvodi/dodajKategoriju'; ?>" method="post">
        <label for="name">Naziv:</label><input type="text" id="name" name="name" />
        <label for="active">Status:</label>
        <select name="active" >
        <option value=""> - - - - - </option>
        <option name="active" value="1">Aktivan</option>
        <option name="active" value="0">Neaktivan</option>
        </select><br>
        <button type="submit" class='button' value="Dodaj">DODAJ KATEGORIJU</button>
    </form>
</div>
</div>
<div class='col-xs-12 col-sm-5 col-md-6'>
    <table class="table-responsive mt15" border="1">
        <tr>
            <td>ID</td>
            <td>Naziv</td>
            <td>Status</td>
            <td>Izmeni</td>
            <td>Obriši</td>
        </tr>
        <?php
        foreach ($this->categories as $category) {
            echo '<tr>';
            echo '<td>' . $category['category_id'] . '</td>';
            echo '<td>' . $category['name'] . '</td>';
             if ($category['active'] > 0){
                echo '<td>Aktivna</td>'; 
            }else{
                echo '<td>Neaktivna</td>';
            }
            echo '<td><a href="' . ADMIN_URL .'proizvodi/izabranaKategorija/' . $category['category_id'] . '" title="Izmeni kategoriju">Izmeni</a></td>';
            echo '<td><a href="' . ADMIN_URL .'proizvodi/obrisiKategoriju/' . $category['category_id'] . '" title="Obrisi kategoriju" onclick="return confirm(\'Da li ste sigurni da zelite da izbrisete?\');" ><img src="' . URL . 'images/delete.png" /></a></td>';
            echo '</tr>';
        }
        ?>
    </table>
  </div>
</section>
