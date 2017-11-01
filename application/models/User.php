<?php

class User extends CI_Model {

    private $user_ID;
    private $userTypeID;
    private $firstName;
    private $lastName;
    private $email;
    private $username;
    
    function __construct() {
        parent::__construct();
    }

    
//    function __construct($user_ID, $userTypeID, $firstName, $lastName, $email, $username) {
//        parent::__construct();
//        $this->user_ID = $user_ID;
//        $this->userTypeID = $userTypeID;
//        $this->firstName = $firstName;
//        $this->lastName = $lastName;
//        $this->email = $email;
//        $this->username = $username;
//    }
    
    public function authenticateUser($username, $password) {
        $encrPassword = self::encrypt("theSecretKeyInit", $password);
        $query = $this->db->query("SELECT * FROM fyp_User WHERE username='$username' AND password='$encrPassword'");
        if ($query->num_rows() === 1) {
            $oneAccount = $query->row();
            $newQuery = $this->db->query("UPDATE fyp_User SET last_login = NOW() WHERE username='$username';");
            if ($newQuery === true) {
                echo "Record updated, Successfully logged in<br>";
                $newUser = new User();
                $newUser->setUser_ID($oneAccount->user_ID);
                $newUser->setUserTypeID($oneAccount->userType_ID);
                $newUser->setFirstName($oneAccount->firstName);
                $newUser->setLastName($oneAccount->lastName);
                $newUser->setEmail($oneAccount->emailAddress);
                $newUser->setUsername($oneAccount->username);
//                $newUser = new User(
//                        $oneAccount->user_ID,
//                        $oneAccount->userType_ID,
//                        $oneAccount->firstName,
//                        $oneAccount->lastName,
//                        $oneAccount->emailAddress,
//                        $oneAccount->username);
                echo $newUser->getFirstName()." ".$newUser->getLastName()." ".$newUser->getUsername();
                //self::sendToDashboard($oneAccount->userType_ID);
            } else {
                echo "Error updating record";
            }
        } else {
            echo "Incorrect Username or Password, Try again";
        }
    }

    public static function sendToDashboard($userType) {
        if ($userType == 1) {
            redirect("staff-home?type=ml");
        } else if ($userType == 2) {
            redirect("staff-home");
        } else if ($userType == 3) {
            redirect("student-home");
        } else {
            echo "userType is ".$userType.", which is unexpected";
        }
    }

    public function isUserUnique($user) {
        $query = $this->db->query("SELECT * FROM fyp_User WHERE username='$user'");
        if ($query->num_rows() > 0) {
            echo "this username already exists, try again";
            return false;
        } else {
            return true;
        }
    }

    public function doesPasswordsMatch($password1, $password2) {
        if ($password1 === $password2) {
            return true;
        } else {
            echo "the passwords dont match";
            return false;
        }
    }

    public static function encrypt($key, $plain) {
        $plain = hash('md5', $plain, false);
        $plain = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $plain, MCRYPT_MODE_ECB);
        $plain = base64_encode($plain);
        return substr($plain, 0, 44);
    }
    
    function getUser_ID() {
        return $this->user_ID;
    }

    function getUserTypeID() {
        return $this->userTypeID;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmail() {
        return $this->email;
    }

    function getUsername() {
        return $this->username;
    }

    function setUser_ID($user_ID) {
        $this->user_ID = $user_ID;
    }

    function setUserTypeID($userTypeID) {
        $this->userTypeID = $userTypeID;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setUsername($username) {
        $this->username = $username;
    }
}
