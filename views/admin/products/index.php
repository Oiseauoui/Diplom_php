<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
    <p class="title1">ПРОДУКЦИЯ</p>

<?php

    if(!empty($_GET['poruka']) && $_GET['poruka'] == '1'){
     echo   '<h3 style="color:red">Вы успешно добавили товар!</h3><br>';
    }
    if(!empty($_GET['poruka']) && $_GET['poruka'] == '2'){
     echo   '<h3 style="color:red">ТОвар не удалось добавить, попробуйте еще раз!</h3><br>';
    }
    if(!empty($_GET['poruka']) && $_GET['poruka'] == '3'){
     echo   '<h3 style="color:red">Вы успешно удалили товар!</h3><br>';
    }
    if(!empty($_GET['poruka']) && $_GET['poruka'] == '4'){
     echo   '<h3 style="color:red">Товар не удалось удалить, попробуйте еще раз!</h3><br>';
    }
    if(!empty($_GET['poruka']) && $_GET['poruka'] == '5'){
     echo   '<h3 style="color:red">Успешно внесены данные о товаре!</h3><br>';
    }
    if(!empty($_GET['poruka']) && $_GET['poruka'] == '6'){
     echo   '<h3 style="color:red">Информация о товаре не была изменена!</h3><br>';
    }

?>


    <div class='search'>
        <form action='<?php echo $this->paginationUrl?>' method='get'>
            <span>Поиск:</span> <input type='text' name='pretraga' value='<?php echo $this->search;?>' />
            <button class='button' type='submit' value='OK'>OK</button>
        </form>
            <a class="button" href="<?php echo ADMIN_URL . 'products/newProduct'; ?>" >Добавить новый товар</a>

    </div>
    <table class="table-responsive mt15" border="1">
        <tr>
            <td>ID</td>
            <td>Название</td>
            <td>Описание</td>
            <td>Изображение</td>
            <td>Цена</td>
            <td>Активный</td>
            <td>Дата</td>
            <td>Категория</td>
            <td>Подкатегория</td>
            <td>Удалить</td>

        </tr>

    <?php

        foreach ($this->items as $item) {
            if($item['item_id'] == ''){break;}
            echo '<tr>';
            echo '<td><a href="' . ADMIN_URL . 'products/updateProduct/' . $item['item_id'] . '" title="Изменить">' . $item['item_id'] . '</td>';
            echo '<td>' . $item['title'] . '</td>';
            echo '<td>' . $item['description'] . '</td>';
            if (!empty($item['image'])) {
                echo '<td><img width="100" src="' . $item['images']['160x160'] . '" /></td>';
            } else {
                echo '<td></td>';
            }

            echo '<td>' . $item['price'] . '</td>';
            $active = $item['active'] == 1 ? "В наличии" : "Нет в наличии";
            echo '<td>' . $active . '</td>';
            echo '<td>' .date('Y-m-d H:i:s', strtotime(str_replace('-','/',($item['create_date']))) ). '</td>';
        foreach ($this->kategorije as $category) {
            if ($item['fk_category_id'] == $category['category_id']) {
                echo '<td>' . $category['name'] . '</td>';
            }
        }
        foreach ($this->podkategorije as $subCategory){
            if($item['fk_sub_category_id'] == $subCategory['sub_category_id']){
                echo '<td>' . $subCategory['name'] . '</td>';
            }
        }
            echo '<td><a href="' . ADMIN_URL .'products/deleteProduct?item_id=' . $item['item_id'] . '" title="Удалить товар" class="obrisi" onclick="return confirm(\'Вы уверены, что хотите удалить?\');"  ><img src="' . URL . 'images/delete.png" /></a></td>';

            echo '</tr>';
        }
        ?>
    </table>

     <?php $page = $this->currentPage;
                  if ($this->pagesCount > 3) { ?>
                    <ul class="pagination">
                        <?php if($page>1){?>
                        <li><a href="<?php echo $this->paginationUrl.'&page=' . ($page-1) .  '&pretraga=' . $this->searchParam ?>"><</a></li>
                        <?php } ?>
                    <?php for ($i = 1; $i < 4; $i++) { ?>
                        <li>
                            <a <?php if ($i == $this->currentPage) {
                            echo 'class="current"';
                            }?>
                        href="<?php echo $this->paginationUrl.'&page=' . $i .  '&pretraga=' . $this->searchParam ?>"><?php echo $i; ?></a>
                        </li>

        <?php } ?>
         <?php if($page!=$this->pagesCount){?>
            <li><a href="<?php echo $this->paginationUrl.'&page=' . ($page+1) .  '&pretraga=' . $this->searchParam ?>">></a></li>
    <?php }?>
    </ul>

    <?php } else {?>
        <ul class="pagination">
        <?php for ($i = 1; $i <= $this->pagesCount; $i++) { ?>
            <li>
                <a <?php if ($i == $this->currentPage) {
                        echo 'class="current"';
                    }?>
                    href="<?php echo $this->paginationUrl.'&page=' . $i .  '&pretraga=' . $this->searchParam ?>"><?php echo $i; ?></a>
            </li>

        <?php } ?>
    </ul>
    <?php }?>
</section>
</div>