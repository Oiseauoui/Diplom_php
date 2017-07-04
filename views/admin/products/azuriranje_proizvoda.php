<div class='col-xs-12 col-sm-9 col-md-9'>
    <section class='content'>
        <p class='title1'>ОБНОВЛЕНИЕ ПРОДУКЦИИ</p>

    <form class="form" action="<?php echo ADMIN_URL . 'products/changeProduct' ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="item_id" value="<?php echo $this->item['item_id']; ?>" />
        <label for="title">Название:</label> <input type="text" id="title" name="title" value="<?php echo $this->item['title']; ?>" />
        <label for="description">Описание:</label> <textarea id="description" name="description" rows="10" cols="70">
		<?php echo $this->item['description']; ?></textarea>
        <label for="price">Цена:</label> <input type="text" id="price" name="price" value="<?php echo $this->item['price']; ?>" />
         <?php if ( !empty($this->item['images']['300x300']) ) { ?>
        <label for="slika" >Изображение:</label>
		<img id="slika" alt="<?php echo $this->item['image']; ?>"  src="<?php echo $this->item['images']['300x300'] ?>" />
        <?php } ?>
        <label for="image">Изменить:</label> <input type="file" id="image" name="image" />
        <label for="fk_category_id">Категория:</label>
            <select name="fk_category_id">
                <option value=""> - - - - - </option>
                <?php
                    foreach ($this->categories as $category) {
                        echo '<option ' .  ($this->item['fk_category_id'] == $category['category_id'] ? 'selected="selected"' : '') .  ' value="' . $category['category_id'] .'">'. $category['name'] . '</option>';
                    }
                ?>
            </select>
        <label for="fk_sub_category_id">Подкатегория:</label>
            <select name="fk_sub_category_id">
                <option value=""> - - - - - </option>
                <?php
                    foreach ($this->podkategorije as $subCategory) {
                        echo '<option ' . ($this->item['fk_sub_category_id'] == $subCategory['sub_category_id'] ? 'selected="selected"' : '') . 'value="' . $subCategory['sub_category_id'] .'">'. $subCategory['name'] . '</option>';
                    }
                ?>
            </select>
            <label for="active">Статус:</label>
        <select name="active" >
        <option value=""> - - - - - </option>
        <option name="active" value="1" selected="selected">В наличии</option>
        <option name="active" value="0">Нет в  наличии</option>
        </select> <br/>
        <button class="button" type="submit" value="Izmeni">ВНЕСТИ ИЗМЕНЕНИЯ</button>
    </form>
    </section>
</div>