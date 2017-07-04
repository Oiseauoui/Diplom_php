<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
        <p class="title1">КОНТАКТЫ</p>

<?php if(!empty($_GET['poruka']) && $_GET['poruka'] == 'uspean_odgovor'): ?>
<p style="color: red">Вы успешно ответили на этот вопрос !</p>
<?php endif;?>

  <form class='form' action="<?php echo ADMIN_URL . 'contact'; ?>" method="get">
         <select name="replied">
                        <option value=""> Ответить </option>
                        <option value="Да" <?php echo $this->replied == 'ДА' ? ' selected' : ''; ?> >   ДА </option>
                        <option value="НЕТ" <?php echo $this->replied == 'НЕТ' ? ' selected' : ''; ?> >   НЕТ </option>

         </select><br>
        Поиск <input type="text" name="search" value="<?php  echo $this->search; ?>"/>
        <button class="button" type="submit">OK</button>
  </form><br>

    <?php
        if($this->contacts['contactsNumber']>0){
    ?>
    <table class="table-responsive mt15" border="1">
        <tr>
            <td>ID</td>
            <td>Имя и Фамилия</td>
            <td>Email</td>
            <td>Текст</td>
            <td>Время получения контакта</td>
            <td>Ответ</td>
            <td>Время отправки ответа</td>
            <td>Ответить</td>
            <td>Удалить</td>
        </tr>
        <?php
        foreach ($this->contacts as $contact) {
            if($contact['contact_id'] == ''){break;}
            echo '<tr>';
            echo '<td>' . $contact['contact_id'] . '</td>';
            echo '<td>' . $contact['name'] . '</td>';
            echo '<td>' . $contact['email'] . '</td>';
            echo '<td>' . $contact['text'] . '</td>';
            echo '<td>' . date('Y-m-d H:i:s', strtotime(str_replace('-','/', $contact['create_date']))) . '</td>';
            if($contact['replied'] == '0'){
            echo '<td>НЕТ</td>';
            }
            if($contact['replied'] == '1'){
            echo '<td>ДА</td>';
            }
            if($contact['replied_date']!= 0){
				echo '<td>' .date('Y-m-d H:i:s', strtotime(str_replace('-','/',
							   $contact['replied_date']))) . '</td>';
            } else {
            echo '<td> ---- </td>';
            }
            echo '<td><a href="' . ADMIN_URL .'contact/replied/' . $contact['contact_id'] . '">Ответить</a></td>';
            echo '<td><a href="' . ADMIN_URL .'contact/deleteContact?contact_id=' . $contact['contact_id'] . '" title="Удалить контакт" onclick="return confirm(\'Вы уверены, что хотите удалить?\');" ><img src="' . URL . 'images/delete.png" /></a></td>';
            echo '</tr>';
        }
        ?>
    </table>

    <?php
        } else{
         echo   '<h3 style="color:red">Нет контакта!</h3><br>';
        }
    ?>

    <br>

     <?php if ($this->pagesCount > 1) { ?>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $this->pagesCount; $i++) { ?>
                <li>
                    <a <?php if ($i == $this->currentPage) {
                            echo 'class="current"';
                        }?>
                        href="<?php echo $this->paginationUrl . '?page=' . $i . '&search=' . $this->search . '&replied=' . $this->replied ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
    </section>
</div>