<?php

class User extends CI_Model {

    //put your code here, attributes
//    public function __construct() {
//        parent::__construct();
//    }

    public function authenticateUser($username, $password) {
        $encrPassword = self::encrypt("theSecretKeyInit", $password);
        $query = $this->db->query("SELECT * FROM fyp_User WHERE username='$username' AND password='$encrPassword'");
        if ($query->num_rows() === 1) {
            $newQuery = $this->db->query("UPDATE fyp_User SET last_login = NOW() WHERE username='$username';");
            if ($newQuery === true){
            echo "Record updated, Successfully logged in";
            } else {
                echo "Error updating record";
            }
        } else {
            echo "Incorrect Username or Password, Try again";
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

}
