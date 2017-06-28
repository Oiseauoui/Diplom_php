<section class="kontakt">
    <div class='container-fluid'>
        <div class='row'> 
            <div class='col-xs-12 col-sm-5'>
                <div class='kontakt-forma'>        
                    <h1>Свяжитесь с нами!</h1>
                    <?php
                    if (!empty($_GET['poruka']) && $_GET['poruka'] == 'unesitepodatke') {
                        echo '<p style="color:#e6005c; font-weight:bold;">Пожалуйста, введите ваши данные!</p>';
                    }
                    if (!empty($_GET['poruka']) && $_GET['poruka'] == 'emailneispravan') {
                        echo '<p style="color:#e6005c; font-weight:bold;">Пожалуйста, введите действительный адрес электронной почты!</p>';
                    }
                    if (!empty($_GET['poruka']) && $_GET['poruka'] == 'poslataporuka') {
                        echo '<p style="color:#e6005c; font-weight:bold;">Благодарим Вас за обращение к нам!</p>';
                    }
                    if (!empty($_GET['poruka']) && $_GET['poruka'] == 'nijeposlato') {
                        echo '<p style="color:#e6005c; font-weight:bold;">Сообщение не было отправлено, пожалуйста, попробуйте еще раз!</p>';
                    }
                    ?>  
                    <form class="form contact_form" action="<?php echo URL . 'kontakt/poruka'; ?>" method="post" >
                        <input type="text" id="name" name="name" placeholder='НАПИШИТЕ ВАШЕ ИМЯ'/> <br/>
                        <input type="text" id="email" name="email" placeholder="ВВЕДИТЕ АДРЕС ЭЛЕКТРОННОЙ ПОЧТЫ"/> <br/>
                        <textarea id="text" name="text" placeholder="Оставьте сообщение и мы ответим вам как можно скорее"></textarea><br/>
                        <button class="button-form" type="submit">Отправить</button>
                    </form>
                </div>                  
            </div>  
            <!-- Kraj kontakt forme -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2535.2385522334052!2d30.20975561542606!3d50.54833358818861!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x472b31bbfb799bc9%3A0xf412595ab3dff529!2z0LLRg9C70LjRhtGPINCe0YHRgtGA0L7QstGB0YzQutC-0LPQviwgMzQsINCR0YPRh9CwLCDQmtC40ZfQstGB0YzQutCwINC-0LHQu9Cw0YHRgtGMLCAwODI5Mg!5e0!3m2!1sru!2sua!4v1498527472154" width="600" height="550" frameborder="0" style="border:0" allowfullscreen></iframe><!--Kontakt forma -->

            <!-- Google mapa
            <div class='col-xs-12 col-sm-7'>
                <div class='podaci'>улица Островского, 34, Буча, Киевская область, 08292</div>
                <div id='mapa'></div>
            </div>
             Kraj mape -->

        </div>  
        <div class="row">
            <hr>
            <h2>Мы здесь для того, чтобы решить все ваши вопросы!</h2>
            <div class="col-md-4">
                <div class="kontakt-stavke">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    <p class="kontakt-title">Адрес</p>
                    <p class="kontakt-text"> улица Островского, 34, Буча, Киевская область, 08292</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="kontakt-stavke">
                    <span class="glyphicon glyphicon-envelope"></span>
                    <p class="kontakt-title" >Email</p>
                    <p class="kontakt-text"> mywormyrest@gmail.com</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="kontakt-stavke">
                    <span class="glyphicon glyphicon-phone-alt"></span>
                    <p class="kontakt-title">Телефон</p>
                    <p class="kontakt-text"> +38 (050) 738 05 60</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        initialize();
    </script>
</section>

