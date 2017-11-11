<?php

class Student extends User {

    private $supervisor_ID;

    public function __construct() {
        parent::__construct();
    }

    function getSupervisor_ID() {
        return $this->supervisor_ID;
    }

    function setSupervisor_ID($supervisor_ID) {
        $this->supervisor_ID = $supervisor_ID;
    }

    public function insertStudent($username, $pass1, $pass2, $userType) {
        //print_r($_POST);
        echo"<br>";
        if (self::isUserUnique($username) == true && self::doesPasswordsMatch($pass1, $pass2) == true) {
            echo "Creating account...";
            self::createAccount($username, $userType);
            $this->session->set_userdata('userFirstName', $this->input->post('stFirstName'));
            $this->session->set_userdata('userLastName', $this->input->post('stLastName'));
            $this->session->set_userdata('userName', $username);
            $this->session->set_userdata('userTypeID', 3);
            $this->session->set_userdata('account', 'new');
            redirect('student-home');
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
        self::putStudentIdIntoSession($userID->user_ID);      
    }

    public function putStudentIdIntoSession($userID) {
        $firstquery = $this->db->query("SELECT * FROM fyp_Student WHERE user_ID='$userID'");
        $firstRow = $firstquery->row();
        $this->session->set_userdata('secondaryID', $firstRow->student_ID);
    }

}
