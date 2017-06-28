<table class='mt15 table-responsive'>
    <tr>
        <th>Naslov</th>
        <th>Cena</th>
        <th>Količina</th>
    </tr>
<?php
    foreach ($this->purchaseDetails as $detail){
        echo '<tr>';
        echo '<td>'.$detail['title'].'</td>';
        echo '<td>'.$detail['price'].'</td>';
        echo '<td>'.$detail['number'].'</td>';
        echo '</tr>';
    }
?>
</table>
<button class='button'><a href="<?php echo ADMIN_URL .'kupovina/sent/' . $detail['purchase_id']?>">Poslato</a></button>
            

