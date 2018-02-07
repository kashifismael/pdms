<?php

class Supervisor extends User {

    private $staffID;

    function __construct() {
        parent::__construct();
    }

    public static function supervisorConstructor($firstName, $lastName, $username, $staffID, $email){
        $supervisor = new Supervisor();
        $supervisor->setFirstName($firstName);
        $supervisor->setLastName($lastName);
        $supervisor->setUsername($username);
        $supervisor->setStaffID($staffID);
        $supervisor->setEmail($email);
        return $supervisor;
    }
    
    public function insertStaff($username, $pass1, $pass2, $userType) {
        echo"<br>";
        if (self::isUserUnique($username) == true && self::doesPasswordsMatch($pass1, $pass2) == true) {
            echo "Creating account...";
            self::createAccount($username, $userType);
            $this->session->set_userdata('userFirstName', $this->input->post('kuFirstName'));
            $this->session->set_userdata('userLastName', $this->input->post('kuLastName'));
            $this->session->set_userdata('userName', $username);
            $this->session->set_userdata('userTypeID', 2);
            $this->session->set_userdata('account', 'new');
            redirect('staff-home');
        } else {
            redirect('/');
        }
    }

    public function createAccount($username, $userType) {
        $data1 = array(
            'userType_ID' => $userType,
            'firstName' => $this->input->post('kuFirstName'),
            'lastName' => $this->input->post('kuLastName'),
            'emailAddress' => $this->input->post('kuEmail'),
            'username' => $username,
            'password' => self::encrypt("theSecretKeyInit", $this->input->post('kupwd1')),
        );
        $this->db->insert('fyp_User', $data1, TRUE);

        //$query = $this->db->query("SELECT user_ID FROM fyp_User WHERE username='$username'");
        $query = $this->db->query("SELECT user_ID FROM fyp_User WHERE username = ? ", $username);
        $userID = $query->row();
        $data2 = array(
            'user_ID' => $userID->user_ID
        );
        $this->db->insert('fyp_Staff', $data2);
        self::putStaffIdIntoSession($userID->user_ID);
    }

    public function putStaffIdIntoSession($userID) {
        $firstquery = $this->db->query("SELECT * FROM fyp_Staff WHERE user_ID='$userID'");
        $firstRow = $firstquery->row();
        $this->session->set_userdata('secondaryID', $firstRow->staff_ID);
    }
    
    public function getAllSupervisorStudents($staffID){
        $supervisorGroup = array();
        $query = "SELECT * 
                    FROM `fyp_User` 
                    INNER JOIN fyp_Student 
                    ON fyp_Student.user_ID = fyp_User.user_ID 
                    where fyp_Student.staff_ID = '$staffID'";
                $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $student = Student::studentConstructor($row->student_ID, $row->firstName, $row->lastName, $row->username);
            $supervisorGroup[] = $student;
        }
        return $supervisorGroup;
    }
    
    public function getStudentInfo($username){
        $query ="SELECT * FROM `fyp_Student` "
                . "INNER JOIN fyp_User "
                . "ON fyp_Student.user_ID = fyp_User.user_ID "
               // . "WHERE fyp_User.username = '$username'";
                . "WHERE fyp_User.username = ? ";
        //$result = $this->db->query($query);
        $result = $this->db->query($query, $username);
        $studentRow = $result->row();
        $student = Student::studentConstructorTwo($studentRow->firstName, $studentRow->lastName, $studentRow->username, $studentRow->emailAddress);
        return $student;
    }

    function getStaffID() {
        return $this->staffID;
    }

    function setStaffID($staffID) {
        $this->staffID = $staffID;
    }


}
