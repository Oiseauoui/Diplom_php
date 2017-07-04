<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
<p class="title1">ИЗМЕНЕНИЕ КАТЕГОРИИ</p>

<?php

    if(!empty($_GET['error']) && $_GET['error'] == '1'){
     echo   '<h3 style="color:red">Вы успешно изменили категорию!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '2'){
     echo   '<h3 style="color:red">Вы не заполнили название категории!</h3><br>';
    }


?>

<table class="table-responsive mt15" border="1">
        <tr>
            <td>ID</td>
            <td>Названиеv</td>
            <td>Статус</td>


        </tr>
        <?php

            echo '<tr>';
        
            echo '<td>' . $this->category['category_id'] . '</td>';
            echo '<td>' . $this->category['name'] . '</td>';
            if ($this->category['active'] > 0){
                echo '<td>Активна</td>';
            }else{
                echo '<td>Неактивна</td>';
            }
        ?>
    </table>
        <hr>
        <span> Изменить категорию:</span>
    <form class="form" action="<?php echo ADMIN_URL . 'products/changeCategory//' .   $this->category['category_id']; ?>" method="post">
        <label for="name">Название:</label> <input type="text" id="name" name="name" value="<?php echo $this->category['name'] ?>" />
        <label for="active">Статус:</label>
        <select name="active" >
        <option value=""> - - - - - </option>
        <option name="active" value="1">Активна</option>
        <option name="active" value="0">Неактивна</option>
        </select> <br>
        <button class='button' type="submit" value="Izmeni" >ИЗМЕНИТЬ КАТЕГОРИЮ</button>
    </form>

    </section>
</div>