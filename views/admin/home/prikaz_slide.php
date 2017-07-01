<div class='col-xs-12 col-sm-9 col-md-9'>
    <section class='content'>
        <p class='title1'>ОБНОВИТЬ СЛАЙДЕР</p>
        <form class="form" action="<?php echo ADMIN_URL . 'home/promeniSlider' ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" id='slider_id' name="slider_id" value="<?php echo $this->slide['slider_id']; ?>" /><br>
           <label for='welcome'>Измените первый заголовок:</label> <input type="text" id='welcome' name='welcome' value ="<?php echo $this->slide['welcome'];?>" /><br>
            <label for='shop'>Измените другой заголовок:</label><input type="text" id='shop' name ="shop" value="<?php echo $this->slide['shop'];?>"/><br>
            <img width="200"   src="<?php echo URL . 'images/home/' . $this->slide['image']?>" alt="slider.jpg"/><br>
            <label for='image'>Выберите файл (минимум 1600x900):</label><input type="file" id='image' name="image"/><br/>
             <button class="button" type="submit">СОХРАНИТЬ ИЗМЕНЕНИЯ</button>

        </form>

    </section>
</div>