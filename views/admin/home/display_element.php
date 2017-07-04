<div class='col-xs-12 col-sm-9 col-md-9'>
    <section class='content'>
        <p class='title1'>ОБНОВЛЕНИЕ</p>
        <form class="form" action="<?php echo ADMIN_URL . 'home/promeniItems' ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" id='slider_id' name="homeItems_id" value="<?php echo $this->item['homeItems_id']; ?>" /><br>
           <label for='title'>Изменить текст ниже: </label> <input type="text" id='title' name='title' value ="<?php echo $this->item['title'];?>" /><br>
            <img width="200"   src="<?php echo URL . 'images/home/' . $this->item['image']?>" alt="item.jpg"/><br>
            <label for='image'>Выберите файл (минимум 250x250):</label><input type="file" id='image' name="image"/><br/>
             <button class="button" type="submit">Сохранить изменения</button>

        </form>
        
    </section>
</div>