<?php
Class Korisnici_Model extends Model{

    public function userAdd($user) {
        $registrationDate = time();

        //Proveravamo da li postoji login ili email
        $sql = "SELECT *
                FROM `users`
                WHERE `login` = '{$user['login']}' OR `email` = '{$user['email']}' ";
        $result = $this->db->query($sql);
        if ($result->rowCount() > 0) {
            return false;
        }
		// var_dump($_POST);

		$sql = "INSERT INTO `users` (`login`, `password`, `email`, `first_name`, `last_name`, `address`, `phone`, `registration_date`, `active`, `email_code`, `fk_group_id`)
                VALUES (:login, :password, :email, :first_name, :last_name, :address, :phone, :reg_date, :active, :email_code, :fk_group_id)";
        $result = $this->db->prepare($sql);
        if($result->execute(array(':login' => $user['login'],
                               ':password' => md5($user['password']),
                               ':email' => $user['email'],
                               ':first_name' => $user['first_name'],
                               ':last_name' => $user['last_name'],
                               ':address' => $user['address'],
                               ':phone' => $user['phone'],
                               ':reg_date' => $registrationDate,
                               ':active' => 1,
                               ':email_code' => $user['email_code'],
                               ':fk_group_id' => 2
                               )
                        ) == true) {

        $sql='UPDATE `groups` SET `number_of_users`= number_of_users+1 WHERE `group_id`=2';
        $this->db->query($sql);}
        return true;

		//var_dump($_POST);
    }

    public function loginCheck($login, $password) {
        $password = md5($password);

        $sql = "SELECT `user_id`, `login`, `password`, `email`, `first_name`, `last_name`, `address`, `phone`, `registration_date`, `active`, `email_code`, `fk_group_id`
                FROM `users`
                WHERE `login` = '$login' AND `password` = '$password' AND `active` = 1
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

    public function userActivate($code) {
        $sql = "UPDATE `users` SET `active` = 1, `email_code` = ''
                WHERE `email_code` = '$code'
                LIMIT 1";
        $this->db->exec($sql);
    }

}