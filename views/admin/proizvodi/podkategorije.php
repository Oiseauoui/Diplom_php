<section class='content'>
    <p class="title1">ПОДКАТЕГОРИЯ</p>

<div class='col-xs-12 col-sm-3 col-md-3'>

<?php

    if(!empty($_GET['error']) && $_GET['error'] == '1'){
     echo   '<h3 style="color:red">Категория усспешно добавлена!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '2'){
     echo   '<h3 style="color:red">Категория не добавлена!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '3'){
     echo   '<h3 style="color:red">Подкатегория была удалена!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '4'){
     echo   '<h3 style="color:red">Подкатегория не удаляется, попробуйте еще раз!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '5'){
     echo   '<h3 style="color:red">Nije obrisana, prvo morate obrisati proizvode te podkategorije!</h3><br>';
    }
    if (!empty($_GET['msg']) && $_GET['msg'] == '5'){
    echo '<h3 style="color:red">Подкатегория с введенным названием уже существует!</h3>';
}
?>
    <span> Добавить подкатегорию:</span>
    <form class="form" action="<?php echo ADMIN_URL . 'proizvodi/dodajPodkategoriju'; ?>" method="post">
        <label for="name">Название:</label> <input type="text" id="name" name="name" />
        <label for="active">Статус:</label>
        <select name="active" >
        <option value=""> - - - - - </option>
        <option name="active" value="1">Активна</option>
        <option name="active" value="0">Неактивна</option>
        </select> <br/>
        <label for="fk_category_id">Категория:</label>
        <select name="fk_category_id" >
        <option value=""> - - - - - </option>
        <?php
        foreach ($this->categories as $category) {
        echo '<option ' . ($this->podkategorije['fk_category_id'] == $category['category_id'] ? 'selected="selected"' : '') . ' value="' . $category['category_id'] . '">' . $category['name'] . '</option>';
        }
        ?>
        </select> <br/>
        <button class='button' type="submit" value="Dodaj" >ДОБАВИТЬ</button>
    </form>

</div>
<div class='col-xs-12 col-sm-6 col-md-7'>
    <table class="table-responsive mt15" border="1">
        <tr>
            <td>ID</td>
            <td>Название</td>
            <td>Статус</td>
            <td>Изменить</td>
            <td>Удалить</td>
        </tr>
        <?php
        foreach ($this->podkategorije as $subCategory) {
            echo '<tr>';
            echo '<td>' . $subCategory['sub_category_id'] . '</td>';
            echo '<td>' . $subCategory['name'] . '</td>';
            if ($subCategory['active'] > 0){
                echo '<td>Активна</td>';
            }else{
                echo '<td>Неактивна</td>';
            }
            echo '<td><a href="' . ADMIN_URL .'proizvodi/izabranaPodkategorija/' . $subCategory['sub_category_id'] . '" title="Изменить категорию">Изменить</a></td>';
            echo '<td><a href="' . ADMIN_URL .'proizvodi/obrisiPodkategoriju/' . $subCategory['sub_category_id'] . '" title="Удалить категорию" onclick="return confirm(\'Вы уверены, что хотите удалить?\');"  ><img src="' . URL . 'images/delete.png" /></a></td>';
            echo '</tr>';
        }
        ?>
    </table>

</div>
</section>