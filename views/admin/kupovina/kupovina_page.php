<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
        <p class="title1">PRIKAZ KUPOVINA</p>
         
<table class='mt15 table-responsive'>
    <tr>
        <th>Ime i Prezime</th>
        <th>Adresa</th>
        <th>Telefon</th>
        <th>Datum kupovine</th>
        <th>Ukupna cena</th>
        <th>Status pošiljke</th>
        <th>Datum slanja</th>
        <th>Detalji</th>
    </tr>
<?php

foreach ($this->purchases as $purchase){

echo "<tr>";
echo "<td>" . $purchase['first_name'] . " " . $purchase['last_name'] . "</td>";
echo "<td>" . $purchase['address'] . "</td>";
echo "<td>" . $purchase['phone'] . "</td>";
echo "<td>" . date('d.m.Y.', $purchase['purchase_date']) . "</td>";
echo "<td>" . $purchase['total_price'] . "</td>";
if ($purchase['status']!=0){
    echo "<td>Posiljka poslata</td>";
} else{
    echo "<td>Nije poslata</td>";
}
if($purchase['sent_date']!= 0){
            echo '<td>' . date('H:i:s d/m/Y', $purchase['sent_date']) . '</td>';
            } else {
            echo '<td> ---- </td>';
            }
echo "<td><button class='button' id='".$purchase['purchase_id']."'>DETALJI</button></td>";
echo "</tr>";

}
?>
    
</table>


<div class='background'>

    <div class='detailOfPurchases'> 
        <div id='btnClose'><img src="<?php echo URL . 'images/icon_close.png'; ?>" /></div>
            <div class="details"></div>
    </div>
</div>
    </section>
</div>
<script>
    jQuery(document).ready(function($){
        $('.button').click(function(){
            var id = $(this).attr('id');
            console.log(id);
            $('.details').load('<?php echo ADMIN_URL; ?>kupovina/getDetail',{
                purchase_id : id
            });
            $('.background').fadeIn('slow');
            $('#btnClose').click(function(){
                $('.background').fadeOut('slow');
            });
        });
    });
</script>