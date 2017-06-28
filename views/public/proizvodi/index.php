<section class="main">
    <div class='container-fluid'>
        <div class='row'>
            <button class='kateg visible-xs'><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>КАТЕГОРИИ</button>
            <div class='col-xs-12 col-sm-3 col-md-2 col-lg-2'>
                <!-- Meni sa leve strane -->
                <div class='ktg'>
                    <ul class='list'>
                        <li class='kategorije'>Категории</li>
                        <?php foreach ($this->kategorije as $category) { ?>
                            <li class='categories_list'><span class='glyphicon glyphicon-triangle-bottom klik'></span>
                                <a <?php
                                if (!empty($this->CategoryId) && $this->CategoryId == $category['category_id']) {
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
                                                if (!empty($this->subCatId) && $this->subCatId == $subCategory['sub_category_id']) {
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
                <!-- Kraj meni sa leve strane -->
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h2><?php
                    if (!empty($categoryName)) {
                        echo $categoryName;
                    }
                    if (!empty($subName)) {
                        echo '/' . $subName;
                    }
                    if (empty($categoryName) && empty($subName) && empty($this->pagesCount)) {
                        echo 'Найдено единиц товаров';
                    }
                    if (empty($categoryName) && empty($subName) && !empty($this->pagesCount)) {
                        echo 'Товары';
                    }
                    ?></h2>

            </div>
            <div class="col-xs-12 col-sm-5 col-md-6">
                <div class='search'>
                    <form action='<?php echo $this->paginationUrl ?>' method='get'>
                        <input type='text' class='trazi' name='pretraga' value='<?php echo $this->search; ?>'
                         placeholder="Поиск по типу или цвету"/>
                        <button class='btnsearch' type='submit'><span class="glyphicon glyphicon-search"></span></button>
                    </form>    
                </div>
            </div>
            <div class='col-xs-12  col-sm-9  col-md-10 col-lg-10'>
                <!-- Prikaz proizvoda -->
                <div class="items">
                    <ul class="items_list cf">
                        <?php
                        foreach ($this->items as $item):
                            $itemUrl = URL . 'proizvodi/proizvod/' . $item['item_id'] . '/' . $item['fk_sub_category_id'];
                            ?>
                            <li>
                                <div class="hvrdiv">
                                    <a class="button" href="<?php echo $itemUrl; ?>">ПОДРОБНЕЕ</a>
                                </div> 
                                <div class="item_thumb">
                                    <?php if (!empty($item['image'])) { ?>
                                        <a href="<?php echo $itemUrl; ?>"><img src="<?php echo $item['images']['160x160'] ?>" alt="no image"></a>
                                    <?php } else { ?>
                                        <a href="<?php echo $itemUrl; ?>"><img width="160" alt="no_image"  src="<?php echo URL . 'images/product' ?>" /></a>
                                    <?php } ?>
                                </div>
                                <h3><a href="<?php echo $itemUrl; ?>"><?php echo $item['title'] ?></a></h3>
                                <div class="price"><?php echo number_format($item['price'], 2, ',', '.'); ?> грн.</div>


                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>  
                <!-- Kraj prikaza proizvoda -->
            </div>  
        </div> 
        <div class='row'>
            <div class='col-lg-12'>
                <!-- Paginacija -->
                <div class='main-pagination'>
                    <?php
                    $page = $this->currentPage;
                    if ($this->pagesCount > 3) {
                        ?>
                        <ul class="pagin">
                            <?php if ($page > 1) { ?>
                                <li><a href="<?php echo $this->paginationUrl . '&page=' . ($page - 1) . '&pretraga=' . $this->searchParam ?>"><</a></li>
                            <?php } ?>
                            <?php for ($i = $page; $i < ($page + 3); $i++) { ?>
                                <li>
                                    <a <?php
                                    if ($i == $this->currentPage) {
                                        echo 'class="current"';
                                    }
                                    ?>   
                                        href="<?php echo $this->paginationUrl . '&page=' . $i . '&pretraga=' . $this->searchParam ?>"><?php echo $i; ?></a>
                                </li>          
                            <?php } ?>

                            <?php if ($page != $this->pagesCount) { ?>
                                <li><a href="<?php echo $this->paginationUrl . '&page=' . ($page + 1) . '&pretraga=' . $this->searchParam ?>">></a></li>
                            <?php } ?>   
                        </ul>

                    <?php } else { ?>
                        <ul class="pagin">
                            <?php for ($i = 1; $i <= $this->pagesCount; $i++) { ?>
                                <li>
                                    <a <?php
                                    if ($i == $this->currentPage) {
                                        echo 'class="current"';
                                    }
                                    ?>   
                                        href="<?php echo $this->paginationUrl . '&page=' . $i . '&pretraga=' . $this->searchParam ?>"><?php echo $i; ?></a>
                                </li>

                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div> 
                <!-- Kraj paginacije -->
            </div>
        </div>
    </div>
</section>
