
<div class='col-xs-12 col-sm-9 col-md-9'>
    <section class='content'>
        <p class='title1'>AŽURIRANJE PROIZVODA</p>
       
    <form class="form" action="<?php echo ADMIN_URL . 'proizvodi/izmeniProizvod' ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="item_id" value="<?php echo $this->item['item_id']; ?>" />
        <label for="title">Naziv:</label> <input type="text" id="title" name="title" value="<?php echo $this->item['title']; ?>" />
        <label for="description">Opis:</label> <textarea id="description" name="description" rows="10" cols="70"><?php echo $this->item['description']; ?></textarea> 
        <label for="price">Cena:</label> <input type="text" id="price" name="price" value="<?php echo $this->item['price']; ?>" />
         <?php if ( !empty($this->item['images']['300x300']) ) { ?>
        <label for="slika" >Slika:</label> <img id="slika" alt="<?php echo $this->item['image']; ?>"  src="<?php echo $this->item['images']['300x300'] ?>" />
        <?php } ?>
        <label for="image">Izmeni:</label> <input type="file" id="image" name="image" /> 
        <label for="fk_category_id">Kategorija:</label>
            <select name="fk_category_id">
                <option value=""> - - - - - </option>
                <?php
                    foreach ($this->categories as $category) {
                        echo '<option ' .  ($this->item['fk_category_id'] == $category['category_id'] ? 'selected="selected"' : '') .  ' value="' . $category['category_id'] .'">'. $category['name'] . '</option>';
                    }
                ?>
            </select>
        <label for="fk_sub_category_id">Podkategorija:</label>
            <select name="fk_sub_category_id">
                <option value=""> - - - - - </option>
                <?php
                    foreach ($this->podkategorije as $subCategory) {
                        echo '<option ' . ($this->item['fk_sub_category_id'] == $subCategory['sub_category_id'] ? 'selected="selected"' : '') . 'value="' . $subCategory['sub_category_id'] .'">'. $subCategory['name'] . '</option>';
                    }
                ?>
            </select>
            <label for="active">Status:</label>
        <select name="active" >
        <option value=""> - - - - - </option>
        <option name="active" value="1" selected="selected">Na stanju</option>
        <option name="active" value="0">Nema na stanju</option>
        </select> <br/>
        <button class="button" type="submit" value="Izmeni">SAČUVAJ IZMENU</button>
    </form>
    </section>
</div>    
