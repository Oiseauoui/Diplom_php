<?php

class Contact_Model extends Model {
    
    public function getPage($pageName) {
        
        $sql="SELECT * FROM pages WHERE page LIKE '$pageName'";
        $result=$this->db->query($sql);
        $page=$result->fetch(PDO::FETCH_ASSOC);
        return $page;
    }
    public function Contact($name,$email,$text) {

        $sql="INSERT INTO contacts (name, email, text) 
           VALUES (:name,:email,:text)";
        $result=$this->db->prepare($sql);
        return $result->execute(array(
            ':name'=>$name,
            ':email'=>$email,
            ':text'=>$text,

        ));
        //var_dump($sql);
    }
}