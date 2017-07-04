<section class='content'>
    <p class="title1">КАТЕГОРИИ</p>

<div class='col-xs-12 col-sm-4 col-md-4'>

    <div class="dodaj_kat">

<?php

    if(!empty($_GET['error']) && $_GET['error'] == '1'){
     echo   '<h3 style="color:red">Вы успешно добавили новую категорию!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '2'){
     echo   '<h3 style="color:red">Вы не заполнили название категории!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '3'){
     echo   '<h3 style="color:red">Категория удалена!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '4'){
     echo   '<h3 style="color:red">Категория не удаляется, попробуйте еще раз!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '5'){
     echo   '<h3 style="color:red">Не удаляется, вытереть первые товары, относящиеся к этой категории!</h3><br>';
    }
    if (!empty($_GET['msg']) && $_GET['msg'] == 5){
    echo '<h3 style="color:red">Категория с тем же именем уже существует в базе данных!</h3>';
}
?>


    <span>Добавить категорию:</span>
    <form class="form" action="<?php echo ADMIN_URL . 'products/addCategory'; ?>" method="post">
        <label for="name">Название:</label><input type="text" id="name" name="name" />
        <label for="active">Статус:</label>
        <select name="active" >
        <option value=""> - - - - - </option>
        <option name="active" value="1">Активная</option>
        <option name="active" value="0">Неактивная</option>
        </select><br>
        <button type="submit" class='button' value="Добавить">ДОБАВИТЬ КАТЕГОРИЮ</button>
    </form>
</div>
</div>
<div class='col-xs-12 col-sm-5 col-md-6'>
    <table class="table-responsive mt15" border="1">
        <tr>
            <td>ID</td>
            <td>Название</td>
            <td>Статус</td>
            <td>Изменить</td>
            <td>Удалить</td>
        </tr>
        <?php
        foreach ($this->categories as $category) {
            echo '<tr>';
            echo '<td>' . $category['category_id'] . '</td>';
            echo '<td>' . $category['name'] . '</td>';
             if ($category['active'] > 0){
                echo '<td>Активна</td>';
            }else{
                echo '<td>Неактивна</td>';
            }
            echo '<td><a href="' . ADMIN_URL .'products/selectedCategory//' . $category['category_id'] . '" title="Изменить категорию">Изменить</a></td>';
            echo '<td><a href="' . ADMIN_URL .'products/deleteCategory/' . $category['category_id'] . '" title="Удалить"
			onclick="return confirm(\'Вы уверены, что хотите удалить?\');" >
			<img src="' . URL . 'images/delete.png" /></a></td>';
            echo '</tr>';
        }
        ?>
    </table>
  </div>
</section>