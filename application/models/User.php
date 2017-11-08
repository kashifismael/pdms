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

    public function userConstructor($user_ID, $userTypeID, $firstName, $lastName, $email, $username) {
        $newUser = new User();
        $newUser->setUser_ID($user_ID);
        $newUser->setUserTypeID($userTypeID);
        $newUser->setFirstName($firstName);
        $newUser->setLastName($lastName);
        $newUser->setEmail($email);
        $newUser->setUsername($username);
        return $newUser;
    }

    public function displayAllUsers() {
        $query = 'SELECT * FROM `fyp_User` '
                . 'INNER JOIN fyp_UserType '
                . 'ON fyp_User.userType_ID = fyp_UserType.userType_ID';
        return $this->db->query($query);
    }

    public function authenticateUser($username, $password) {
        $encrPassword = self::encrypt("theSecretKeyInit", $password);
        $query = $this->db->query("SELECT * FROM fyp_User WHERE username='$username' AND password='$encrPassword'");
        if ($query->num_rows() === 1) {
            $oneAccount = $query->row();
            $newQuery = $this->db->query("UPDATE fyp_User SET last_login = NOW() WHERE username='$username';");
            if ($newQuery === true) {
                echo "Record updated, Successfully logged in<br>";
                $this->session->set_userdata('userFirstName', $oneAccount->firstName);
                $this->session->set_userdata('userLastName', $oneAccount->lastName);
                $this->session->set_userdata('userName', $oneAccount->username);
                $this->session->set_userdata('userTypeID', $oneAccount->userType_ID);
                //                $firstquery = $this->db->query("SELECT * FROM fyp_Student WHERE user_ID='$oneAccount->user_ID'");
                //                if ($firstquery == true) {
                //                    $firstRow = $firstquery->row();
                //                    echo "the student id of first row is " . $firstRow->student_ID;
                //                    $this->session->set_userdata('secondaryID', $firstRow->student_ID);
                //                } else {
                //                    echo "query doesnt work";
                //                }
                self::getSecondID($oneAccount->user_ID, $oneAccount->userType_ID);
                self::sendToDashboard($oneAccount->userType_ID);
            } else {
                echo "Error updating record";
            }
        } else {
            //echo "Incorrect Username or Password, Try again";
            redirect("/?details=incorrect");
        }
    }

    public function getSecondID($userID, $userType) {
        if ($userType == 1 || $userType == 2) {
            $firstquery = $this->db->query("SELECT * FROM fyp_Staff WHERE user_ID='$userID'");
            if ($firstquery == true) {
                $firstRow = $firstquery->row();
                $this->session->set_userdata('secondaryID', $firstRow->staff_ID);
            } else {
                echo "query doesnt work";
            }
        } else if ($userType == 3) {
            $firstquery = $this->db->query("SELECT * FROM fyp_Student WHERE user_ID='$userID'");
            if ($firstquery == true) {
                $firstRow = $firstquery->row();
                $this->session->set_userdata('secondaryID', $firstRow->student_ID);
            } else {
                echo "query doesnt work";
            }
        } else {
            echo "userType is " . $userType . ", which is unexpected";
        }
    }

    public static function sendToDashboard($userType) {
        if ($userType == 1 || $userType == 2) {
            redirect("staff-home");
        } else if ($userType == 3) {
            redirect("student-home");
        } else {
            echo "userType is " . $userType . ", which is unexpected";
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
