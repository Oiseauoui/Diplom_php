
<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
<p class="title1">IZMENA KATEGORIJE</p>
   
<?php

    if(!empty($_GET['error']) && $_GET['error'] == '1'){
     echo   '<h3 style="color:red">Uspešno ste izmenili kategoriju!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '2'){
     echo   '<h3 style="color:red">Niste popunili naziv kategorije!</h3><br>';
    }
   
 
?>

<table class="table-responsive mt15" border="1">
        <tr>
            <td>ID</td>
            <td>Naziv</td>
            <td>Status</td>
              
           
        </tr>
        <?php
        
            echo '<tr>';
            echo '<td>' . $this->category['category_id'] . '</td>';
            echo '<td>' . $this->category['name'] . '</td>';
            if ($this->category['active'] > 0){
                echo '<td>Aktivna</td>'; 
            }else{
                echo '<td>Neaktivna</td>';
            }
        ?>
    </table>
        <hr>
        <span> Izmeni kategoriju:</span>
    <form class="form" action="<?php echo ADMIN_URL . 'proizvodi/izmeniKategoriju/' .   $this->category['category_id']; ?>" method="post">   
        <label for="name">Naziv:</label> <input type="text" id="name" name="name" value="<?php echo $this->category['name'] ?>" />
        <label for="active">Status:</label>
        <select name="active" >
        <option value=""> - - - - - </option>
        <option name="active" value="1">Aktivan</option>
        <option name="active" value="0">Neaktivan</option>
        </select> <br>
        <button class='button' type="submit" value="Izmeni" >IZMENI KATEGORIJU</button>
    </form>
    
    </section>
</div>


    
    
   

