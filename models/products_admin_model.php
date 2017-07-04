<?php

include_once LIBS . 'Model.php'; //inkluduje klasu Model
include_once BASE_PATH . 'models/products_model.php'; //inkluduje fajl proizvodi_model da klasa Proizvodi_Model mogla da se nasledi u klasi Proizvodi_Admin_Model

class Products_Admin_Model extends Products_Model {
    
    
    /***************************************************************************
    1. KATEGORIJE 
    ***************************************************************************/
    public function getAdminCategories() {
        
        $sql="SELECT * FROM `categories`";
        $result=$this->db->query($sql);
        $category=$result->fetchALL(PDO::FETCH_ASSOC);
        return $category;
        
    }
    public function getAdminSubCategories () {
        
        $sql="SELECT * FROM `sub_categories`";
        $result=$this->db->query($sql);
        $subCategory=$result->fetchALL(PDO::FETCH_ASSOC);
        return $subCategory;
    }
    
    public function checkCatName($name) {
        $upperName = strtoupper($name);
        $sql = "SELECT `name` FROM `categories` WHERE upper(`name`)=:upperName";
        $qw = $this->db->prepare($sql);
        $qw->bindParam(':upperName', $upperName, PDO::PARAM_STR);
        $qw->execute();
        if ($qw->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    //dodavanje kategorije
    public function addCategory($name,$status) {
        if (empty($name) || empty($status)) {
            return false;
        }

        $sql = "INSERT INTO `categories` (`name`,`active`)
                VALUES ('$name', '$status')";
        $result = $this->db->exec($sql);
        
        if($result){ 
            return true;
        }
    }
    
    //brisanje kategorije
    public function deleteCategory($categoryId) {
        if (empty($categoryId)) {
            return false;
        }

        $sql = "DELETE FROM `categories`
                WHERE `category_id` = '$categoryId'";
        $result = $this->db->exec($sql);

        if($result){ 
            return true;
        }
    }
    public function getItemCategory($categoryId) {
        $itemCategory = array();
        
        $sql = "SELECT *
                FROM `items`
                WHERE `fk_category_id` = '$categoryId'";
        $result = $this->db->query($sql);

        if ($result->rowCount() > 0) {
            $itemCategory = $result->fetch(PDO::FETCH_ASSOC);
               
            
        }

        return $itemCategory;
    }
    //prikupljanje podataka o izabranoj kategoriji
    public function getCategory($categoryId) {
        $category = array();
        
        $sql = "SELECT `category_id`, `name`, `active`
                FROM `categories`
                WHERE `category_id` = '$categoryId'";
        $result = $this->db->query($sql);

        if ($result->rowCount() > 0) {
            $category = $result->fetch(PDO::FETCH_ASSOC);
               
            
        }

        return $category;
    }
    //izmena imena kategorije
    public function updateCategory($update) {
        $categoryId = $update[0];
        $name = $update[1];
        $stat=$update[2];
        if (empty($categoryId)) {
            return false;
        }

        $sql = "UPDATE  `categories` SET `name`= '$name', `active` = '$stat'  WHERE `category_id` = '$categoryId'";
        $result = $this->db->exec($sql);

        if($result){ 
            return true;
        }
    }
    /***************************************************************************
     2. PODKATEGORIJE
    ****************************************************************************/
    public function checkSubCatName($addName) {
        $upperAddName = strtoupper($addName);
        $sql = "SELECT `name` FROM `sub_categories` WHERE upper(`name`)=:upperAddName";
        $qw = $this->db->prepare($sql);
        $qw->bindParam(':upperAddName', $upperName, PDO::PARAM_STR);
        $qw->execute();
        if ($qw->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }
    public function addSubCategory($addName,$active,$categoryId) {
        if (empty($addName) || empty($active) || empty($categoryId)) {
            return false;
        }

        $sql = "INSERT INTO `sub_categories` (`name`, `active`, `fk_category_id`)
                VALUES ('$addName', '$active', '$categoryId')";
        $result = $this->db->exec($sql);
        
        if($result){ 
            return true;
        }
    }
    public function getSubCategory($subCategoryId) {
        $subCategory = array();
        
        $sql = "SELECT `sub_category_id`, `name`, `active`, `fk_category_id`
                FROM `sub_categories`
                WHERE `sub_category_id` = '$subCategoryId'";
        $result = $this->db->query($sql);

        if ($result->rowCount() > 0) {
            $subCategory = $result->fetch(PDO::FETCH_ASSOC);
               
            
        }

        return $subCategory;
    }
    //brisanje kategorije
    public function deleteSubCategory($subCategoryId) {
        if (empty($subCategoryId)) {
            return false;
        }

        $sql = "DELETE FROM `sub_categories`
                WHERE `sub_category_id` = '$subCategoryId'";
        $result = $this->db->exec($sql);

        if($result){ 
            return true;
        }
    }
    public function getSubCategoryItem($subCategoryId) {
        $subCategoryItem = array();
        
        $sql = "SELECT *
                FROM `items`
                WHERE `fk_sub_category_id` = '$subCategoryId'";
        $result = $this->db->query($sql);

        if ($result->rowCount() > 0) {
            $subCategoryItem = $result->fetch(PDO::FETCH_ASSOC);
               
            
        }

        return $subCategoryItem;
    }
    //izmena imena kategorije
    public function updateSubCategory($updateSub) {
        
        $subCategoryId = $updateSub[0];
        $subname = $updateSub[1];
        $subStatus=$updateSub[2];
        $subCat = $updateSub[3];
        if (empty($subCategoryId) || empty($subname)) {
            return false;
        }

        $sql = "UPDATE  `sub_categories` SET `name`= '$subname', `active`='$subStatus', `fk_category_id` = '$subCat'
                WHERE `sub_category_id` = '$subCategoryId'";
        $result = $this->db->exec($sql);

        if($result){ 
            return true;
        }
    }
    /***************************************************************************
    3. PROIZVODI  
    ***************************************************************************/
    
    //dodavanje proizvoda
    public function addItem($item) {
        //$create_date = time();
        $sql = "INSERT INTO `items` (`title`, `description`, `image`, `price`, `fk_sub_category_id`,`fk_category_id`, `active`)
                VALUES ('{$item['title']}', '{$item['description']}', '{$item['image']}', '{$item['price']}', '{$item['fk_sub_category_id']}' ,'{$item['fk_category_id']}', 1)";
        if ( $this->db->exec($sql) == true) {
            $itemId = $this->db->lastInsertId();
        }
        
        return $itemId;  //vraca Id dodatog proizvoda u bazu, pri cemu u bazu cuva naziv slike proizvoda. Idse vraca jer je  potreban pri kreirenju foldera i cuvanju slike proizvoda
    }
    
    public function deleteItem($itemId) {
        if (empty($itemId)) { //ako nije prosledje Id vraca false
            return false;
        }
      
       
        $sql = "DELETE FROM `items`
                WHERE `item_id` = '$itemId'";
        $result =  $this->db->exec($sql);
                 
        return $result;
    }
    
    
    //izmena proizvoda
    public function updateItem($item) {
        $imageSql = !empty($item['image']) ? " , `image` = '{$item['image']}' " : '';

        $sql = "UPDATE `items` SET `title` = '{$item['title']}', `active` = '{$item['active']}' , `description` = '{$item['description']}', `price` = '{$item['price']}',
                       `fk_category_id` = '{$item['fk_category_id']}', `fk_sub_category_id` = '{$item['fk_sub_category_id']}'
                       $imageSql
                WHERE `item_id` = '{$item['item_id']}'";
        $result = $this->db->exec($sql);
        
         
            return $result;
        
    }

    
}