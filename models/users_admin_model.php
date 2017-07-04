<?php

Class Users_Admin_Model extends Admin_Model {

    public function loginCheck($login, $password) {
        $password = md5($password);

        $sql = "SELECT `user_id`, `login`, `password`, `email`, `first_name`, `last_name`, `address`, `phone`, `registration_date`, `active`, `email_code`, `fk_group_id`
                FROM `users`
                WHERE `login` = '$login' AND `password` = '$password' AND `active` = 1 AND `fk_group_id` = 1
                LIMIT 1";
        $result = $this->db->query($sql);

        if ($result->rowCount() > 0) {
            $user = $result->fetch(PDO::FETCH_ASSOC);

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['group_id'] = $user['fk_group_id'];
            return true;
        } else {
            return false;
        }
    }

    public function getUsers() {

        $sql = "SELECT * FROM users ORDER BY user_id DESC";
        $result = $this->db->query($sql);
        $korisnik = $result->fetchALL(PDO::FETCH_ASSOC);
        return $korisnik;
    }

    public function getUser($userID) {
        $sql = "SELECT * FROM users WHERE user_id=$userID";
        $result = $this->db->query($sql);
        $user = $result->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function deleteUser($userID) {
        $sql = "DELETE FROM users WHERE user_id=$userID";
        $this->db->exec($sql);
        return true;
    }

    public function addUser($user) {
        $registrationDate=time();
        $sql = "SELECT *
                FROM `users`
                WHERE `login` = '{$user['login']}' OR `email` = '{$user['email']}' ";
        $check = $this->db->query($sql);
        if ($check->rowCount() > 0) {
            return false;
             }
        $sql = "INSERT INTO users (login,password,email,first_name,last_name,address,phone,
            registration_date,active,fk_group_id) VALUES (:login,:password,:email,:first_name,:last_name,
            :address,:phone,:registration_date,:active,:fk_group_id)";
        $result=$this->db->prepare($sql);
        $result->execute(
                array(
                    ':login' => $user['login'],
                    ':password' => md5($user['password']),
                    ':email' => $user['email'],
                    ':first_name' => $user['first_name'],
                    ':last_name' => $user['last_name'],
                    ':address' => $user['address'],
                    ':phone' => $user['phone'],
                    ':registration_date' => $registrationDate,
                    ':active' => $user['active'],
                    ':fk_group_id'=> $user ['fk_group_id']
                )
        );
               
        if ($result) {
            
            $userId = $this->db->lastInsertId();
            $sql = "UPDATE `groups` SET `number_of_users_in_group` = number_of_users_in_group+1
                    WHERE `group_id` = '{$user['fk_group_id']}'";
            $this->db->exec($sql);
        }
        
    return $userId; 
        }
    

    public function updateUser($user) {
        
        $sql= "UPDATE `users` SET `login`='{$user['login']}',`password`= '{$user['password']}', `email`= '{$user['email']}', `first_name` = '{$user['first_name']}', `last_name` = '{$user['last_name']}', `address`='{$user['address']}', `phone`='{$user['phone']}',  `active`='{$user['active']}', `fk_group_id`='{$user['fk_group_id']}' WHERE `user_id`='{$user['user_id']}' ";
       $this->db->exec($sql);
       return true;
        
    }
    public function getGroups () {
        
        $sql="SELECT * FROM groups";
        $result=$this->db->query($sql);
        $groups=$result->fetchALL (PDO::FETCH_ASSOC);
        return $groups;
    }

}