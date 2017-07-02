<?php

class Proizvodi_Model extends Model {

    public function getCategories() {

        $sql="SELECT * FROM categories WHERE active='1'";
        $result=$this->db->query($sql);
        $category=$result->fetchALL(PDO::FETCH_ASSOC);
        return $category;

    }
    public function getSubCategories () {

        $sql="SELECT * FROM sub_categories WHERE active='1'";
        $result=$this->db->query($sql);
        $subCategory=$result->fetchALL(PDO::FETCH_ASSOC);
        return $subCategory;
    }
    public function getItems($categoryId=0,$subCatId=0,$offset=0,$limit=0,$search='') {

        $items = array();

        $limitSql = '';

        if ($offset == 0 && $limit > 0) {
            $limitSql = " LIMIT $limit ";
        } else if ($offset > 0 && $limit > 0) {
            $limitSql = " LIMIT $offset, $limit ";
        }

        $where = "";
        if (!empty($categoryId) && $categoryId > 0) {
            $where = " WHERE `fk_category_id` = '$categoryId' ";
        }
        if (!empty($subCatId) && $subCatId > 0) {
            $where = " AND `fk_sub_category_id` = '$subCatId' ";
        }
        if (!empty($search)) {
            $where = !empty($where) ? $where . " AND (`title` LIKE '%$search%' OR `description` LIKE '%$search%' ) " : " WHERE `title` LIKE '%$search%' OR `description` LIKE '%$search%'  ";
        }

        $sql = "SELECT  i.`item_id`, i.`title`, i.`description`, i.`image`, i.`price`, i.`active`, i.`create_date`, i.`fk_category_id`, i.`fk_sub_category_id`,
                c.`name` AS `category`
                FROM `items` i
                INNER JOIN `categories` c ON c.category_id = i.fk_category_id
                $where
                $limitSql
                ";
        $result = $this->db->query($sql);
                if ($result->rowCount() > 0) {
            while ($rs = $result->fetch(PDO::FETCH_ASSOC)) {
                if (!empty($rs['image'])) {
                    // u bazi cuvamo samo kranje ime slike sa ekstenzijom zato moramo da dodamo celu putanju do slike
                    $rs['images']['160x160'] = URL . 'images/' . $rs['item_id'] . '/160x160_' . $rs['image'];
                    $rs['images']['300x300'] = URL . 'images/' . $rs['item_id'] . '/300x300_' . $rs['image'];
                }
                $items[] = $rs;
            }
        }

        return $items;

    }
    public function countItems($categoryId=0,$subCatId=0, $search='') {
        $num = 0;
        $where = '';
        if (!empty($categoryId) && $categoryId > 0) {
            $where = " WHERE `fk_category_id` = '$categoryId' ";
        }
        if (!empty($subCatId) && $subCatId > 0) {
            $where = " WHERE `fk_sub_category_id` = '$subCatId' ";
        }
        if (!empty($search)) {
            $where = !empty($where) ? $where . " AND (`title` LIKE '%$search%' OR `description` LIKE '%$search%' ) " : " WHERE `title` LIKE '%$search%' OR `description` LIKE '%$search%'  ";
        }
        $sql = "SELECT COUNT(*) AS num
                FROM `items`
                $where";
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);

        return (int)$row['num'];
    }
    public function getItem($itemId) {
        // metoda koja vadi iz baze podatke o proizvodu sa datim id-em

        $item = array();

        $sql = "SELECT  i.`item_id`, i.`title`, i.`description`, i.`image`, i.`price`, i.`fk_sub_category_id`, i.`active`, i.`create_date`, i.`fk_category_id`,
                        c.`name` AS category
                FROM `items` i
                INNER JOIN `categories` c ON c.category_id = i.fk_category_id
                WHERE `item_id` = '$itemId' ";
        $result = $this->db->query($sql);

        if ($result->rowCount() > 0) {
            $item = $result->fetch(PDO::FETCH_ASSOC);

            if (!empty($item['image'])) {
                $item['images']['160x160'] = URL . 'images/' . $item['item_id'] . '/160x160_' . $item['image'];
                $item['images']['300x300'] = URL . 'images/' . $item['item_id'] . '/300x300_' . $item['image'];
            }
        }

        return $item;
    }
    public function getItemImages($itemSubId) {
        //metoda koja vadi iz baze sve slike jedne podkategorije
       // Здесь  отображаются картинки на страницы товары
        $itemImages = array();
        $sql = "SELECT `image`, `item_id`  FROM `items` WHERE `fk_sub_category_id` = '$itemSubId'";
        $result = $this->db->query($sql);
                if ($result->rowCount() > 0) {
            while ($rs = $result->fetch(PDO::FETCH_ASSOC)) {
                if (!empty($rs['image'])) {
                    // u bazi cuvamo samo kranje ime slike sa ekstenzijom zato moramo da dodamo celu putanju do slike
                    $rs['images']['160x160'] = URL . 'images/' . $rs['item_id'] . '/160x160_' . $rs['image'];
//echo $rs; die();
                }
                $itemImages[] = $rs;
            }
        }
       return $itemImages;

    }
     public function purchase($id, $broj, $cena) {
        // metoda koja za svaku kupovinu upisuje u bazu id korisnika koji je izvrsio kupovinu, id proizvoda koji je kupljen i datum kupovine
        $createDate = time();

		 
		 $sql = "INSERT INTO `purchases` (`fk_user_id`, `amount`, `purchase_date`, `total_price`)
                VALUES ('$id', '$broj', '$createDate', '$cena')";
        if ($this->db->exec($sql) == true) {


           $purchaseId = $this->db->lastInsertId();
            foreach ($_SESSION ['korpa'] as $items) {
            $sql= "INSERT INTO `items_to_purchases` (`fk_purchase_id`, `fk_item_id`, `number`, `price`) VALUES ( $purchaseId, '{$items['item_id']}', '{$items['kolicina']}', '{$items['price']}')";
            $this->db->exec($sql); }
			//die();
        }
    }
}