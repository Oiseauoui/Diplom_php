<?php

require_once LIBS . 'Model.php';
require_once BASE_PATH . 'models/contact_model.php';

class Contact_Admin_Model extends Contact_Model {

     public function countContacts($replied = '', $search = '') {
        // metoda koja broji contacte


        $num = 0;

        $where = '';
        if (!empty($replied) && $replied == 'ДА') {
            $where = " WHERE `replied` = '1' ";
        }
        if (!empty($replied) && $replied == 'НЕТ') {
            $where = " WHERE `replied` = '0' ";
        }

        if (!empty($search)) {
            $where = !empty($where) ? $where . " AND (`name` LIKE '%$search%' OR `text` LIKE '%$search%' OR `email` LIKE '%$search%' ) " : " WHERE `name` LIKE '%$search%' OR `text` LIKE '%$search%' OR `email` LIKE '%$search%' ";
        }

        $sql = "SELECT COUNT(*) AS num
                FROM `contacts`
                $where";
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);

        return (int)$row['num'];
    }



    public function getContacts($replied = '', $offset = 0, $limit = 0, $search = '') {


        $limitSql = '';

        if ($offset == 0 && $limit > 0) {
            $limitSql = " LIMIT $limit ";
        } else if ($offset > 0 && $limit > 0) {
            $limitSql = " LIMIT $offset, $limit ";
        }

        $where = '';
        if (!empty($replied) && $replied == 'DA') {
            $where = " WHERE `replied` = '1' ";
        }
        if (!empty($replied) && $replied == 'NE') {
            $where = " WHERE `replied` = '0' ";
        }

        if (!empty($search)) {
            $where = !empty($where) ? $where . " AND (`name` LIKE '%$search%' OR `text` LIKE '%$search%' OR `email` LIKE '%$search%') " : " WHERE `name` LIKE '%$search%' OR `text` LIKE '%$search%' OR `email` LIKE '%$search%' ";
        }

        $contacts = array();

        $sql = "SELECT `contact_id`, `name`, `email`, `text`, `create_date`, `replied`, `replied_date`
                FROM `contacts`
                $where
                ORDER BY `create_date` DESC $limitSql";

        $result = $this->db->query($sql);
        if ($result->rowCount()>0){
            while ($rs = $result->fetch(PDO::FETCH_ASSOC)) {
                $contacts[] = $rs;
            }
        }
        $contacts['contactsNumber'] = $result->rowCount();
        return $contacts;
    }

    public function deleteContact($contactId) {
        $sql = "DELETE FROM `contacts` WHERE `contact_id` = $contactId";
        $this->db->exec($sql);
    }

    public function getContact($contactID){
        $contact = array();

        $sql ="SELECT * FROM `contacts` WHERE `contact_id` = '$contactID'";

        $result= $this->db->query($sql);
        if($result->rowCount() > 0) {
            $contact = $result->fetch(PDO::FETCH_ASSOC);
        }
        return $contact;
    }

     public function updateContactPage($title, $description) {
        $sql = "UPDATE `pages` SET `title` = :title, `description` = :description
                WHERE `page` = 'contact_page' ";
        $result = $this->db->prepare($sql);

        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->execute();

        return $result;
    }

    public function replied($contactID) {
        $repliedDate = time();
        $sql = "UPDATE `contacts` SET `replied` = 1, `replied_date` = '$repliedDate'
                WHERE `contact_id`= $contactID;";
        $this->db->exec($sql);

    }

}