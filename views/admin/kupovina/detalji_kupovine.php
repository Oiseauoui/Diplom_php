<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
        <div class='col-xs-12 col-sm-5 col-md-6'>

            <table class="table-responsive mt15" border="1">
                <tr>

                    <th>Номер заказа</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Количество</th>
                </tr>

                <?php
                foreach ($this->purchaseDetails as $detail){


                    echo '<td>'.$detail['purchase_id'].'</td>';
                    echo '<td>'.$detail['title'].'</td>';
                    echo '<td>'.$detail['price'].'</td>';
                    echo '<td>'.$detail['number'].'</td>';
                    echo '</tr>';
                }
                ?>
            </table>

            <button class='button'><a href="<?php echo ADMIN_URL .'kupovina/sent/' . $details['purchase_id']?>">ОТПРАВИТЬ</a></button>


        </div>
    </section>