<?php



class Home_Model extends Model {
    
    public function getSlider () {
        
        $slider=array();
        $sql="SELECT * FROM `home_slider` ";
        $result=$this->db->query($sql);
        
         $slider=$result->fetchAll(PDO::FETCH_ASSOC);
         return $slider;
    }
    public function homeItems () {
        
        $homeIt=array();
        $sql="SELECT * FROM `home_items` ";
        $result=$this->db->query($sql);
        
         $homeIt=$result->fetchAll(PDO::FETCH_ASSOC);
         return $homeIt;
    }
    
}