<?php

class Kupovina_Admin_Model extends Admin_Model {
        
    public function getPurchases(){
        $purchases = array();

        $sql = "SELECT p.purchase_id, p.fk_user_id, p.purchase_date, p.sent_date, p.amount,p.status, p.total_price, u.login, u.first_name, u.last_name, u.address, u.phone
                FROM purchases p
                INNER JOIN users u
                ON p.fk_user_id=u.user_id ";
        $result = $this->db->query($sql);
        if($result->rowCount() > 0){
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $purchases[] = $row;
            }
        }        
        return $purchases;
    }
    
    public function getDetailsOfPurchase(){
        
        $purchase_id = $_POST['purchase_id'];

        $sql = "SELECT i.title, i.price, ip.number, p.purchase_id
        FROM items_to_purchases ip
        INNER JOIN purchases p ON p.purchase_id=ip.fk_purchase_id
        INNER JOIN items i ON i.item_id=ip.fk_item_id
        WHERE ip.fk_purchase_id=$purchase_id ";

        $result = $this->db->query($sql);
        if($result->rowCount() > 0){
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $purchaseDetails[] = $row;
            }
        }
        return $purchaseDetails;
    }
    public function changeStatus($purchaseId){
        $sentDate = time();
        $sql = "UPDATE `purchases` SET `status` = 1, `sent_date` = $sentDate WHERE `purchase_id` = $purchaseId";
        $this->db->exec($sql);
        return true;
    }
    
}


