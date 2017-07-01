<?php

require_once LIBS . 'Model.php';
require_once BASE_PATH . 'models/home_model.php';

class Home_Admin_Model extends Home_Model {

    public function updateHomePage($title, $description) {
        $sql = "UPDATE `pages` SET `title` = :title, `description` = :description
                WHERE `page` = 'home_page' ";
        $result = $this->db->prepare($sql);

        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->execute();
    }
    public function getSlide($slideId){

        $sql="SELECT * FROM `home_slider` WHERE `slider_id` = '$slideId' ";
        $result=$this->db->query($sql);

         $slide=$result->fetch(PDO::FETCH_ASSOC);
         return $slide;

    }
    public function promenaSlide($slide){
        $imageSql = !empty($slide['image']) ? " , `image` = '{$slide['image']}' " : '';

        $sql = "UPDATE `home_slider` SET  `welcome` = '{$slide['welcome']}' , `shop` = '{$slide['shop']}'
                       $imageSql
                WHERE `slider_id` = '{$slide['slider_id']}'";
        $result = $this->db->exec($sql);


            return $result;

    }

    public function getItem($itemId){

        $sql="SELECT * FROM `home_items` WHERE `homeItems_id` = '$itemId' ";
        $result=$this->db->query($sql);

         $item=$result->fetch(PDO::FETCH_ASSOC);
         return $item;

    }
    public function promenaItem($item){
        $imageSql = !empty($item['image']) ? " , `image` = '{$item['image']}' " : '';

        $sql = "UPDATE `home_items` SET  `title` = '{$item['title']}'
                       $imageSql
                WHERE `homeItems_id` = '{$item['homeItems_id']}'";
        $result = $this->db->exec($sql);


            return $result;

    }
}