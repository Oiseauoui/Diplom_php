<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
    <p class="title1">ДОБАВИТЬ НОВУЮ ПРОДУКЦИЮ</p>
     <form class="form" action="<?php echo ADMIN_URL . 'products/addProduct' ?>" method="post" enctype="multipart/form-data">
        <label for="title">Название:</label> <input type="text" id="title" name="title" />
        <label for="description">Описание:</label> <textarea id="description" name="description" rows="5" cols="35"></textarea>
        <label for="price">Цена:</label> <input type="text" id="price" name="price" />
        <label for="image">Изображение:</label> <input type="file" id="image" name="image" />
        <label for="fk_category_id">Категория:</label>
            <select name="fk_category_id">
                <option value=""> - - - - - </option>
                <?php
                    foreach ($this->categories as $category) {
                        echo '<option value="' . $category['category_id'] .'">'. $category['name'] . '</option>';
                    }
                ?>
            </select>
        <label for="fk_sub_category_id">Подкатегория:</label>
            <select name="fk_sub_category_id">
                <option value=""> - - - - - </option>
                <?php
                    foreach ($this->podkategorije as $subCategory) {
                        echo '<option value="' . $subCategory['sub_category_id'] .'">'. $subCategory['name'] . '</option>';
                    }
                ?>
            </select> <br/>
            <button class="button" type="submit" value="Dodaj">ДОБАВИТЬ</button>
    </form>

</section>
</div>