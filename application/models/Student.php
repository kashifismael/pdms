<?php

class Student extends User {

    private $studentID;
    private $supervisor_ID;

    public function __construct() {
        parent::__construct();
    }

    public static function studentConstructor($studentID, $firstName, $lastName, $username) {
        $student = new Student();
        $student->setStudentID($studentID);
        $student->setFirstName($firstName);
        $student->setLastName($lastName);
        $student->setUsername($username);
        return $student;
    }

    public static function studentConstructorTwo($firstName, $lastName, $username, $email) {
        $student = new Student();
        $student->setEmail($email);
        $student->setFirstName($firstName);
        $student->setLastName($lastName);
        $student->setUsername($username);
        return $student;
    }

    public function insertStudent($username, $pass1, $pass2, $userType) {
        if (self::isUserUnique($username) == true && self::doesPasswordsMatch($pass1, $pass2) == true) {
            self::createAccount($username, $userType);
            $this->session->set_userdata('userFirstName', $this->input->post('stFirstName'));
            $this->session->set_userdata('userLastName', $this->input->post('stLastName'));
            $this->session->set_userdata('userName', $username);
            $this->session->set_userdata('userTypeID', 3);
            $this->session->set_userdata('account', 'new');
            redirect('student-home');
        } else {
            redirect('/');
        }
    }

    public function createAccount($username, $userType) {
        $data1 = array(
            'userType_ID' => $userType,
            'firstName' => htmlentities($this->input->post('stFirstName')),
            'lastName' => htmlentities($this->input->post('stLastName')),
            'emailAddress' => htmlentities($this->input->post('stEmail')),
            'username' => htmlentities($username),
            'password' => self::encrypt("theSecretKeyInit", $this->input->post('stpwd1')),
        );
        $this->db->insert('fyp_User', $data1, TRUE);
        $query = $this->db->query("SELECT user_ID FROM fyp_User WHERE username = ? ", $username);
        $userID = $query->row();
        $data2 = array(
            'User_ID' => $userID->user_ID
        );
        $this->db->insert('fyp_Student', $data2);
        self::putStudentIdIntoSession($userID->user_ID);
    }

    public function putStudentIdIntoSession($userID) {
        $firstquery = $this->db->query("SELECT * FROM fyp_Student WHERE user_ID= ? ", $userID);
        $firstRow = $firstquery->row();
        $this->session->set_userdata('secondaryID', $firstRow->student_ID);
    }

    function getSupervisor_ID() {
        return $this->supervisor_ID;
    }

    function setSupervisor_ID($supervisor_ID) {
        $this->supervisor_ID = $supervisor_ID;
    }

    function getStudentID() {
        return $this->studentID;
    }

    function setStudentID($studentID) {
        $this->studentID = $studentID;
    }

}
