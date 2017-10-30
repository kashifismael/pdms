<?php

class Student extends User {
    //put your code here
    
        public function insertStudent($username, $pass1, $pass2, $userType) {
        print_r($_POST);
        echo"<br>";
        if (self::isUserUnique($username) == true && self::doesPasswordsMatch($pass1, $pass2) == true) {
            echo "Creating account...";
            self::createAccount($username, $userType);
        }
    }
    
        public function createAccount($username, $userType){
                $data1 = array(
                'userType_ID' => $userType,
                'firstName' => $this->input->post('stFirstName'),
                'lastName' => $this->input->post('stLastName'),
                'emailAddress' => $this->input->post('stEmail'),
                'username' => $username,
                'password' => self::encrypt("theSecretKeyInit", $this->input->post('stpwd1')),
            );
            $this->db->insert('fyp_User', $data1);

            $query = $this->db->query("SELECT user_ID FROM fyp_User WHERE username='$username'");
            $userID = $query->row();
            $data2 = array(
                'User_ID' => $userID->user_ID
            );
            $this->db->insert('fyp_Student', $data2);
    }
    
}
