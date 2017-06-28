<section class='content'>
    <p class="title1">PODKATEGORIJE</p>
   
<div class='col-xs-12 col-sm-3 col-md-3'>
    
<?php

    if(!empty($_GET['error']) && $_GET['error'] == '1'){
     echo   '<h3 style="color:red">Uspešno ste dodali novu podkategoriju!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '2'){
     echo   '<h3 style="color:red">Niste dodali podkategoriju!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '3'){
     echo   '<h3 style="color:red">Podkategorija je obrisana!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '4'){
     echo   '<h3 style="color:red">Podkategorija nije obrisana, pokušajte ponovo!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '5'){
     echo   '<h3 style="color:red">Nije obrisana, prvo morate obrisati proizvode te podkategorije!</h3><br>';
    }
    if (!empty($_GET['msg']) && $_GET['msg'] == '5'){
    echo '<h3 style="color:red">Podkategorija sa unetim nazivom vec postoji u bazi!</h3>';
}
?>
    <span> Dodaj podkategoriju:</span>
    <form class="form" action="<?php echo ADMIN_URL . 'proizvodi/dodajPodkategoriju'; ?>" method="post">
        <label for="name">Naziv:</label> <input type="text" id="name" name="name" />
        <label for="active">Status:</label>
        <select name="active" >
        <option value=""> - - - - - </option>
        <option name="active" value="1">Aktivan</option>
        <option name="active" value="0">Neaktivan</option>
        </select> <br/>
        <label for="fk_category_id">Kategorija:</label> 
        <select name="fk_category_id" >
        <option value=""> - - - - - </option>
        <?php
        foreach ($this->categories as $category) {
        echo '<option ' . ($this->podkategorije['fk_category_id'] == $category['category_id'] ? 'selected="selected"' : '') . ' value="' . $category['category_id'] . '">' . $category['name'] . '</option>';
        }
        ?>
        </select> <br/>
        <button class='button' type="submit" value="Dodaj" >DODAJ</button>
    </form>

</div>
<div class='col-xs-12 col-sm-6 col-md-7'>
    <table class="table-responsive mt15" border="1">
        <tr>
            <td>ID</td>
            <td>Naziv</td>
            <td>Status</td>
            <td>Izmeni</td>
            <td>Obriši</td>
        </tr>
        <?php
        foreach ($this->podkategorije as $subCategory) {
            echo '<tr>';
            echo '<td>' . $subCategory['sub_category_id'] . '</td>';
            echo '<td>' . $subCategory['name'] . '</td>';
            if ($subCategory['active'] > 0){
                echo '<td>Aktivna</td>'; 
            }else{
                echo '<td>Neaktivna</td>';
            }
            echo '<td><a href="' . ADMIN_URL .'proizvodi/izabranaPodkategorija/' . $subCategory['sub_category_id'] . '" title="Izmeni kategoriju">Izmeni</a></td>';
            echo '<td><a href="' . ADMIN_URL .'proizvodi/obrisiPodkategoriju/' . $subCategory['sub_category_id'] . '" title="Obrisi kategoriju" onclick="return confirm(\'Da li ste sigurni da zelite da izbrisete?\');"  ><img src="' . URL . 'images/delete.png" /></a></td>';
            echo '</tr>';
        }
        ?>
    </table>

</div>
</section>