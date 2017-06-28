<?php
    class View {
        function __construct() {
        }
        public function render($template){
            include_once BASE_PATH . 'views/public/header.php';
            include_once BASE_PATH . 'views/public/'.$template;
            include_once BASE_PATH . 'views/public/footer.php';
        }
        public function load($template) {
        include_once BASE_PATH . 'views/public/'.$template;
    }
}

