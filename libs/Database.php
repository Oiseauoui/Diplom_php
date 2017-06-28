<?php
class Database {
    public $db;
    public function __construct() {
        $this->db = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8;' ,DB_USER, DB_PASS);
    }    
}

