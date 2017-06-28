<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
<p class="title1">IZMENA PODKATEGORIJE</p>
 
<?php

    if(!empty($_GET['error']) && $_GET['error'] == '1'){
     echo   '<h3 style="color:red">Uspešno ste izmenili podkategoriju!</h3><br>';
    }
    if(!empty($_GET['error']) && $_GET['error'] == '2'){
     echo   '<h3 style="color:red">Niste popunili naziv podkategorije!</h3><br>';
    }
   
 
?>

<table class="table-responsive mt15" border="1">
        <tr>
            <td>ID</td>
            <td>Kategorija</td>
            <td>Naziv</td>
            <td>Status</td>
        </tr>
        <?php
        
            echo '<tr>';
            echo '<td>' . $this->subCategory['sub_category_id'] . '</td>';
            foreach($this->category as $category){
                if ($category['category_id'] == $this->subCategory['fk_category_id'] ) {
                    echo '<td>' . $category['name'] . '</td>';
                }
            }
            echo '<td>' . $this->subCategory['name'] . '</td>';
            if ($this->subCategory['active'] > 0){
                echo '<td>Aktivna</td>'; 
            }else{
                echo '<td>Neaktivna</td>';
            }
        ?>
    </table>
<br>
   <span> Izmeni podkategoriju:</span>
    <form class="form" action="<?php echo ADMIN_URL . 'proizvodi/izmeniPodkategoriju/' .   $this->subCategory['sub_category_id']; ?>" method="post">      
        <label for="name">Naziv:</label> <input type="text" id="name" name="name" value="<?php echo $this->subCategory['name'] ?>" />
        <label for="active">Status:</label>
        <select name="active" >
        <option value=""> - - - - - </option>
        <option name="active" value="1">Aktivan</option>
        <option name="active" value="0">Neaktivan</option>
        </select> <br/>
        <label for="fk_category_id">Kategorija:</label> 
        <select name="fk_category_id" >
        <option value=""> - - - - - </option>
        <?php
        foreach ($this->category as $category) {
        echo '<option ' . ($this->subcategory['fk_category_id'] == $category['category_id'] ? 'selected="selected"' : '') . ' value="' . $category['category_id'] . '">' . $category['name'] . '</option>';
        }
        ?>
        </select><br>
        <button class='button' type="submit" value="Izmeni">IZMENI</button>
    </form>
</section>
</div>

