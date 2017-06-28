<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
    <p class="title1">PROIZVODI</p>
    
<?php

    if(!empty($_GET['poruka']) && $_GET['poruka'] == '1'){
     echo   '<h3 style="color:red">Uspešno ste dodali proizvod!</h3><br>';
    }
    if(!empty($_GET['poruka']) && $_GET['poruka'] == '2'){
     echo   '<h3 style="color:red">Proizvod nije uspešno dodat, pokušajte ponovo!</h3><br>';
    }
    if(!empty($_GET['poruka']) && $_GET['poruka'] == '3'){
     echo   '<h3 style="color:red">Uspešno ste obrisali proizvod!</h3><br>';
    }
    if(!empty($_GET['poruka']) && $_GET['poruka'] == '4'){
     echo   '<h3 style="color:red">Proizvod nije uspešno obrisan, pokušajte ponovo!</h3><br>';
    }
    if(!empty($_GET['poruka']) && $_GET['poruka'] == '5'){
     echo   '<h3 style="color:red">Uspešno su ažurirani podaci o proizvodu!</h3><br>';
    }
    if(!empty($_GET['poruka']) && $_GET['poruka'] == '6'){
     echo   '<h3 style="color:red">Podaci o proizvodu nisu promenjeni!</h3><br>';
    }
    
?>


    <div class='search'>
        <form action='<?php echo $this->paginationUrl?>' method='get'>
            <span>Pretraga:</span> <input type='text' name='pretraga' value='<?php echo $this->search;?>' />
            <button class='button' type='submit' value='OK'>OK</button>
        </form>
            <a class="button" href="<?php echo ADMIN_URL . 'proizvodi/noviProizvod'; ?>" >Dodaj novi proizvod</a>

    </div>
    <table class="table-responsive mt15" border="1">
        <tr>
            <td>ID</td>
            <td>Naziv</td>
            <td>Opis</td>
            <td>Slika</td>
            <td>Cena</td>
            <td>Aktivan</td>
            <td>Datum</td>
            <td>Kategorija</td>
            <td>Podkategorija</td>
            <td>Obrisi</td>
          
        </tr>
        
    <?php
        
        foreach ($this->items as $item) {
            if($item['item_id'] == ''){break;}
            echo '<tr>';
            echo '<td><a href="' . ADMIN_URL . 'proizvodi/azuriranjeProizvoda/' . $item['item_id'] . '" title="Izmeni proizvod">' . $item['item_id'] . '</td>';
            echo '<td>' . $item['title'] . '</td>';
            echo '<td>' . $item['description'] . '</td>';
            if (!empty($item['image'])) {
                echo '<td><img width="100" src="' . $item['images']['160x160'] . '" /></td>';
            } else {
                echo '<td></td>';
            }
            
            echo '<td>' . $item['price'] . '</td>';
            $active = $item['active'] == 1 ? "Na stanju" : "Nema na stanju";
            echo '<td>' . $active . '</td>';
            echo '<td>' . date("d.m.Y H:i", strtotime($item['create_date'])) . '</td>';
        foreach ($this->kategorije as $category) {    
            if ($item['fk_category_id'] == $category['category_id']) {
                echo '<td>' . $category['name'] . '</td>';
            } 
        }
        foreach ($this->podkategorije as $subCategory){
            if($item['fk_sub_category_id'] == $subCategory['sub_category_id']){
                echo '<td>' . $subCategory['name'] . '</td>';
            }
        }    
            echo '<td><a href="' . ADMIN_URL .'proizvodi/obrisiProizvod?item_id=' . $item['item_id'] . '" title="Obrisi proizvod" class="obrisi" onclick="return confirm(\'Da li ste sigurni da zelite da izbrisete?\');"  ><img src="' . URL . 'images/delete.png" /></a></td>';
           
            echo '</tr>';
        }
        ?>
    </table>
        
     <?php $page = $this->currentPage;
                  if ($this->pagesCount > 3) { ?>
                    <ul class="pagination">
                        <?php if($page>1){?>
                        <li><a href="<?php echo $this->paginationUrl.'&page=' . ($page-1) .  '&pretraga=' . $this->searchParam ?>"><</a></li>
                        <?php } ?>
                    <?php for ($i = 1; $i < 4; $i++) { ?>
                        <li>
                            <a <?php if ($i == $this->currentPage) { 
                            echo 'class="current"';
                            }?>   
                        href="<?php echo $this->paginationUrl.'&page=' . $i .  '&pretraga=' . $this->searchParam ?>"><?php echo $i; ?></a>
                        </li>
            
        <?php } ?>
         <?php if($page!=$this->pagesCount){?>
            <li><a href="<?php echo $this->paginationUrl.'&page=' . ($page+1) .  '&pretraga=' . $this->searchParam ?>">></a></li>
    <?php }?>   
    </ul>
     
    <?php } else {?>
        <ul class="pagination">
        <?php for ($i = 1; $i <= $this->pagesCount; $i++) { ?>
            <li>
                <a <?php if ($i == $this->currentPage) { 
                        echo 'class="current"';
                    }?>   
                    href="<?php echo $this->paginationUrl.'&page=' . $i .  '&pretraga=' . $this->searchParam ?>"><?php echo $i; ?></a>
            </li>
            
        <?php } ?>
    </ul>
    <?php }?>
</section>
</div>
