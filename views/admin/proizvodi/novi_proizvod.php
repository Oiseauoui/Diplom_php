<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
    <p class="title1">DODAJ NOVI PROIZVODI</p>
     <form class="form" action="<?php echo ADMIN_URL . 'proizvodi/dodajProizvod' ?>" method="post" enctype="multipart/form-data">
        <label for="title">Naziv:</label> <input type="text" id="title" name="title" /> 
        <label for="description">Opis:</label> <textarea id="description" name="description" rows="5" cols="35"></textarea> 
        <label for="price">Cena:</label> <input type="text" id="price" name="price" /> 
        <label for="image">Slika:</label> <input type="file" id="image" name="image" /> 
        <label for="fk_category_id">Kategorija:</label>
            <select name="fk_category_id">
                <option value=""> - - - - - </option>
                <?php
                    foreach ($this->categories as $category) {
                        echo '<option value="' . $category['category_id'] .'">'. $category['name'] . '</option>';
                    }
                ?>
            </select>
        <label for="fk_sub_category_id">Podkategorija:</label>
            <select name="fk_sub_category_id">
                <option value=""> - - - - - </option>
                <?php
                    foreach ($this->podkategorije as $subCategory) {
                        echo '<option value="' . $subCategory['sub_category_id'] .'">'. $subCategory['name'] . '</option>';
                    }
                ?>
            </select> <br/>
            <button class="button" type="submit" value="Dodaj">DODAJ</button>
    </form>
    
</section>
</div>