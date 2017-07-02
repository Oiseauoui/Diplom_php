<!-- Meni sa leve strane -->
<div class='container-fluid'>   
    <div class='row'>
        <button class='kateg visible-xs'><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>ТОВАРЫ</button>

        <div class='col-xs-12 col-sm-3 col-md-2 col-lg-2'>
            <div class='ktg'>
                <ul class='list'>
                    <li class='kategorije'>Категории</li>
                    <?php foreach ($this->kategorije as $category) { ?>
                        <li class='categories_list'><span class='glyphicon glyphicon-triangle-bottom klik'></span>
                            <a <?php
                            if ($category['category_id'] == $this->item['fk_category_id']) {
                                $categoryName = $category['name'];
                                echo 'class="active"';
                            }
                            ?>
                            href="<?php echo URL . 'proizvodi/kategorija?cid=' . $category['category_id'] ?>"> <?php echo $category['name'] ?> </a>
                            <ul class='sub_categories_list'>
                                <?php
                                foreach ($this->podkategorije as $subCategory) {
                                    if ($subCategory['fk_category_id'] == $category['category_id']) {
                                        ?>
                                        <li <?php
                                        if ($subCategory['sub_category_id'] == $this->item['fk_sub_category_id']) {
                                            $subCategoryId = $subCategory['sub_category_id'];
                                            $subName = $subCategory['name'];
                                            echo 'class="active"';
                                        }
                                        ?>>
                                            <a href="<?php echo URL . 'proizvodi/kategorija?cid=' . $category['category_id'] . '&scid=' . $subCategory['sub_category_id'] ?>">
                                                <?php
                                                echo $subCategory['name'];
                                            }
                                            ?> </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>

            </div>

    <!-- Kraj meni -->
        </div>

        <div class='col-xs-12 col-sm-9 col-md-10 col-lg-10'>
            <div class='search'>
                <div class='item-nav'>
                    <form action='<?php echo $this->paginationUrl ?>' method='get'>
                        <input type='text' class='trazi' name='pretraga' value='<?php echo $this->search; ?>'
                               placeholder="Поиск по типу цвету"/>
                        <button class='btnsearch' type='submit'><span class="glyphicon glyphicon-search"></span></button>

                        <h3><?php echo $categoryName . '/' . $this->item['title'] ?> </h3>
                <hr>
                    </form>
                </div>
        </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-5">
            <div class="item_image_big">
                <?php if (!empty($this->item['image'])) { ?>
                    <img alt="<?php echo $this->item['image']; ?>"  src="<?php echo $this->item['images']['300x300'] ?>" />
                <?php } else { ?>
                    <img alt="no_image"  src="<?php echo URL . 'images/no_image.png' ?>" />
                <?php } ?>
            </div>
        </div>


        <!-- Opis proizvoda -->
        <div class='col-xs-12 col-sm-3 col-md-5'>
            <div class="item-desc">
                <div class="item-desc-text">
                    <h1><?php echo $this->item['title']; ?></h1>    
                    <p class='opis'>
                        <?php echo $this->item['description']; ?>
                    </p>
                    <span>Цена: <?php echo number_format($this->item['price'], 2, ',', '.'); ?> грн.</span>

                    <?php if (!empty($_SESSION['user_id']) && $this->item['active'] != 0) { ?>

                        <form action="<?php echo URL . 'proizvodi/dodajUkorpu?itemId=' . $this->item['item_id'] ?>" class='shop-form'>
                            <input type="hidden" name="itemId" value="<?php echo $this->item['item_id'] ?>"/>
                            <label for='kolicina'>выберите количество:</label><br>
                            <p class='poruka'></p>
                            <input type='button' value='-' class='minus'/>
                            <input type="text" name="kolicina" value='1' id='kolicina'/>
                            <input type='button' value='+' class='plus'/><br>
                            <button class="klikKupi" type="submit"><span class='glyphicon glyphicon-shopping-cart'></span>В КОРЗИНУ</button>
                        </form>

                    <?php } else { ?>
                        <?php
                        if ($this->item['active'] == 0) {
                            echo '<p class= "dostupan" style="color:#"FA3C8E> *** Товар в настоящее время отсутсвует.</p>';
                        } else {
                            ?>
                            <hr>
                            <p> <a href='<?php echo URL . 'korisnici/login' ?>'>Зарегистрироваться</a> для совершения покупок.</p>
                            <p>Если у вас нет аккаунта, <a href='<?php echo URL . 'korisnici/registracija' ?>'>зарегистрируйтесь</a>.</p>
                        <?php } ?>   
                    <?php } ?>

                </div>
            </div>
        </div>


        <!-- Kraj opisa proizvoda -->
        <!-- Ostale boje proizvoda -->
        <div class='col-sm-9 col-md-10 hidden-xs'>   
            <div class='item-colors'>
                <h3><span>Другие виды продукции - <?php echo $subName ?></span></h3>
                <?php
                foreach ($this->itemImages as $itemImage) {
                    $itemUrl = URL . 'proizvodi/proizvod/' . $itemImage['item_id'] . '/' . $subCategoryId;
                    if (!empty($itemImage['image'])) {
                        ?>
                        <a href="<?php echo $itemUrl; ?>"><img src="<?php echo $itemImage['images']['160x160'] ?>" alt="thumb"></a>
                        <?php
                    }
                }
                ?>
                <br>
                <p class='button showImages'>Показать все цвета</p>
            </div>
        </div>
        <!-- Kraj ostalih boja -->
    </div>
</div>
<script>
    var slides = $('.item-colors a');
    var slidesLength = slides.length;
    if (slidesLength > 4) {
        $('.showImages').show();
    } else {
        $('.showImages').hide();
    }
    if (slidesLength > 0) {
        for (i = 0; i <= 4; i++) {
            $(slides[i]).show();
        }
    }
    $('.showImages').on('click', function () {
        for (i = 5; i < slidesLength - 1; i++) {
            $(slides[i]).fadeIn('slow');
        }
        $('.showImages').detach();
    });
</script>