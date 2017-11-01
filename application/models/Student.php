<?php

class Student extends User {

    private $supervisor_ID;
    
    public function __construct(){
        parent::__construct();
    }

//        public function __construct($user_ID, $userTypeID, $firstName, $lastName, $email, $username, $supervisorID) {
//        parent::__construct($user_ID, $userTypeID, $firstName, $lastName, $email, $username);
//        $this->supervisor_ID = $supervisorID;
//    }
    
    function getSupervisor_ID() {
        return $this->supervisor_ID;
    }

    function setSupervisor_ID($supervisor_ID) {
        $this->supervisor_ID = $supervisor_ID;
    }

        
    public function insertStudent($username, $pass1, $pass2, $userType) {
        print_r($_POST);
        echo"<br>";
        if (self::isUserUnique($username) == true && self::doesPasswordsMatch($pass1, $pass2) == true) {
            echo "Creating account...";
            self::createAccount($username, $userType);
        }
    }

    public function createAccount($username, $userType) {
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
