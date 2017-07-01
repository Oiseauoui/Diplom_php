<div class="col-xs-12 col-sm-9 col-md-10">
    <section class='content'>
    <p class="title1">ГЛАВНАЯ СТРАНИЦА</p>
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
    <span>Бегунок</span>

    <table class="mt15 table-responsive">
        <tr>
            <th>Редактировать</th>
            <th>Изображение</th>
            <th>Первый заголовок</th>
            <th>Второй заголовок</th>
        </tr>
        <?php foreach($this->slider as $slider) {?>
        <tr>
            <td>
                <a href="<?php echo ADMIN_URL . 'home/izmeniSlider/' . $slider['slider_id'] ?>">  <?php echo $slider['slider_id']; ?></a>
            </td>
            <td>
                <img width="200"  src="<?php echo URL . 'images/home/' . $slider['image']?>" alt="slider.jpg"/>
            </td>
            <td>
                <?php echo $slider['welcome'];?>
            </td>
            <td>
                <?php echo $slider['shop'];?>
            </td>
        </tr>
        <?php }?>
    </table>


    <span>Просмотр элементов ниже бегунка</span>
   <p>При выборе текста и изображений, иметь в виду, что первый пункт приводит к товару, а второй и третий с инструкциями</p>

    <table class="mt15 table-responsive">
        <tr>
            <th>Редактировать</th>
            <th>Изображение</th>
            <th>Текст</th>
        </tr>
        <?php foreach ($this->items as$items) {?>
        <tr>
            <td>
                <a href="<?php echo ADMIN_URL . 'home/izmeniItems/' . $items['homeItems_id'] ?>">  <?php echo $items['homeItems_id']; ?></a>
            </td>
            <td><img width="200" src = "<?php echo URL . 'images/home/' . $items['image']?>" alt="items.jpg"/></td>
            <td><?php echo $items['title']; ?></td>
        </tr>
        <?php } ?>
    </table>

    </section>
</div>