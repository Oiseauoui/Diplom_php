<!-- Pocetna slider-->
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php foreach ($this->slider as $slider) { ?>
                    <div class="intro none">
                        <div class="slika">
                            <img src="<?php echo URL . 'images/home/' . $slider['image'] ?>" alt="slider" />
                        </div>
                        <div class='header-text'>
                            <p class='header-welcome'><?php echo $slider['welcome'] ?></p>
                            <p class='header-shop'><?php echo $slider['shop'] ?></p>
                            <p class='header-enter'>
                                <a href='<?php echo URL . 'products' ?>'>ПОКУПКИ</a> <!--переход на страницу товаров-->
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
</header>
<!--Kraj slider-a -->
<section class='home-items'>
    <div class='container-fluid'>
        <div class='row'>
            <hr>
            <h1> Отличное предложение хлопка и ниток</h1>
            <?php foreach ($this->items as $items) { ?>
                <div class='col-sm-6 col-md-4'>
                    <div class='home-vunica'>
                        <?php if (!empty($items['image'])) { ?>
                            <a href ='<?php echo URL . $items['taketo'] ?>'>
                                <img src='<?php echo URL . 'images/home/' . $items['image'] ?>' alt='vunica.jpg' class='img-responsive'>
                                <p class='home-caption'>
                                    <?php echo $items['title']; ?>
                                </p>
                            </a>
                        <?php } else { ?>
                            <a href='<?php echo URL . $items['taketo'] ?>'><img width="250" alt="no_image"  src="<?php echo URL . 'images/no_image.png' ?>" />
                                <p class='home-caption'>
                                    <?php echo $items['title']; ?>
                                </p>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<script>

    $(document).ready(function () {
        $(".header-welcome").addClass('animated fadeInUp');
        $(".header-shop").addClass('animated fadeInUp');
        $(".header-enter").addClass('animated flipInY');

        var slideHeader = $('.intro');
        var sliderLength = slideHeader.length;
        function showHide() {
            $(slideHeader[0]).addClass('block');
            for (i = 1; i < sliderLength; i++) {
                $(slideHeader[i]).addClass('none');
            }
        }
        showHide();
        var position = 0;
        function slideHome() {

            $(slideHeader[position]).removeClass('block').addClass('none');
            position = (position == sliderLength - 1) ? -1 : position;
            ++position;
            $(slideHeader[position]).removeClass('none').addClass('block');
        }
        function slideTimer() {
            setInterval(slideHome, 4000);
        }
        slideTimer();

    });
</script>