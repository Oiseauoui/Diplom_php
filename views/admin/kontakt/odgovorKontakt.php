<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
        <p class="title1">ОТВЕТ</p>
       
<?php

    if(!empty($_GET['error']) && $_GET['error'] == 'prazna_polja'){
     echo   '<h3 style="color:red">Niste popunili sva polja!</h3><br>';
    }
    if(!empty($_GET['poruka']) && $_GET['poruka'] == 'uspesan_odgovor'){
     echo   '<h3 style="color:red">Odgovor uspešno poslat!</h3><br>';
    }
?>
<form class='form' action="<?php echo ADMIN_URL . 'kontakt/odgovorKontakt/' . $this->contact['contact_id']; ?>" method="post">
	<table class='mt15 table-responsive'>
		<tr>
			<th>
				TO:
			</th>
			<td>
				<input type="text" name="email" value="<?php echo $this->contact['email']; ?>">
			</td>
		</tr>
		<tr>
			<th>
				SUBJECT :
			</th>
			<td>
				<input type="text" name="subject" >
			</td>
		</tr>
		<tr>
			<th>
				ODGOVOR :
			</th>
			<td>
				<textarea rows="10" cols="70" name="odgovor"></textarea>
			</td>
		</tr>
		<tr>
			<th>
				
			</th>
			<td align="left">
                            <button class='button' type="submit">ОТВЕТИТЬ</button>
			</td>
		</tr>
	</table> 
</form>
</section>
</div>