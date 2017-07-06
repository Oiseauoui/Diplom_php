<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
        <p class="title1">ПОКУПКИ</p>
        <?php

        if(!empty($_GET['msg']) && $_GET['msg'] == '1'){
            echo   '<h3 style="color:red">Вы успешно отредактировали слайд!</h3><br>';
        }
        if(!empty($_GET['msg']) && $_GET['msg'] == '2'){
            echo   '<h3 style="color:red">Вы не изменили слайд!</h3><br>';
        }
        if(!empty($_GET['msg']) && $_GET['msg'] == '3'){
            echo   '<h3 style="color:red">Вы успешно отредактирован элемент!</h3><br>';
        }
        if(!empty($_GET['msg']) && $_GET['msg'] == '4'){
            echo   '<h3 style="color:red">Вы не отредактировали элемент!</h3><br>';
        }
        ?>
        <div class='col-xs-12 col-sm-5 col-md-6'>
            <table class="table-responsive mt15" border="1">
                <tr>
                    <td>Номер заказа</td>
                    <td>Пользователь</td>
                    <td>Имя</td>
                    <td>Фамилия</td>
                    <td>Адрес</td>
                    <td>Телефон</td>
                    <td>Дата покупки</td>
                    <td>Общая сумма заказа</td>

                </tr>
                <?php
                foreach ($this->purchases as $purchases) {
                    if($purchases['purchase_id'] == ''){break;}
                    echo '<tr>';
                    echo '<td>
<a href="' . ADMIN_URL . 'kupovina/getDetail/' . $purchases['purchase_id'] . '" title="Просмотреть">' . $purchases['purchase_id'] . '</a></td>';



                    echo '<td>' . $purchases['login'] . '</td>';
                    echo '<td>' . $purchases['first_name'] . '</td>';
                    echo '<td>' . $purchases['last_name'] . '</td>';
                    echo '<td>' . $purchases['address'] . '</td>';
                    echo '<td>' . $purchases['phone'] . '</td>';
                    echo '<td>' .date('Y-m-d H:i:s', strtotime(str_replace('-','/', $purchases['purchase_date']))) . '</td>';
                    echo '<td>' . $purchases['total_price'] . '</td>';





                }
                ?>
            </table>
        </div>
    </section>