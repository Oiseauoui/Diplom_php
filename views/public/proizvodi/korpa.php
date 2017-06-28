<!-- Proizvodi u korpi -->
<section class="korpa-section">
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12'>
                <?php
                if (!empty($_GET['msg']) && $_GET['msg'] == 'uspesno') {
                    echo '<h3 style="color:red">Форма заказа отправлна. Благодарим Вас за доверие, оказанное нам!</h3><br>';
                }
                ?>  

                <?php
                if ($this->itemsCount > 0) :
                    ?>
                    <h1>KORPA</h1>
                    <div class="table-responsive korpa">
                        <table  class='table table-hover'>
                            <tr>
                                <th>Товар</th>
                                <th>Количество</th>
                                <th>Цена</th>
                                <th>Общая</th>
                                <th>Описание</th>
                            </tr>
                            <?php
                            $sumPrice = 0;
                            $broj = 0;
                            ?>
                            <?php foreach ($this->items as $rb => $item): ?>
                                <tr>
                                    <td><img src="<?php echo $item['image'] ?>" alt='<?php echo $item['title'] ?>'/><span><?php echo $item['title'] ?></span></td>
                                    <td><?php echo $item['kolicina'] ?></td>
                                    <td><?php echo number_format($item['price'], 2, ',', '.') ?> RSD</td>
                                    <td><?php echo number_format(($item['price'] * $item['kolicina']), 2, ',', '.'); ?> RSD</td>
                                    <td><a  style="color:#EF81B1;" href="<?php echo URL . 'proizvodi/obrisiIzKorpe/' . $rb; ?>"><img src='<?php echo URL . 'images/delete.png' ?>' alt='delete'></a></td>
                                    <?php $sumPrice += $item['price'] * $item['kolicina']; ?>
                                    <?php $broj+=$item['kolicina']; ?>
                                </tr>
                            <?php endforeach; ?>
                        </table>


                        <?php $cena = number_format($sumPrice, 2, ',', '.') ?>
                        <p class="brproiz">Количество товаров в корзине:<?php echo $broj; ?></p>
                        <p class='korpaCena'>Общая стоимость:<?php echo $cena; ?>  RSD</p>
                        <a class="button right naruci" href="<?php echo URL . 'proizvodi/naruci?id=' . $_SESSION['user_id'] . '&broj=' . $broj . '&cena=' . $sumPrice ?>">Naruči</a>

                        <?php
                    else :
                        ?>
                        <div class='prazna-korpa'>
                            <h1>Корзина пуста</h1>
                            <img src='<?php echo URL . 'images/cart.jpg' ?>' alt='korpa.jpg'/>
                        </div>
                    <?php
                    endif;
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Kraj korpe -->