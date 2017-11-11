<?php

class Supervisor extends User {

    //put your code here

    public function insertStaff($username, $pass1, $pass2, $userType) {
        //print_r($_POST);
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
        $this->db->insert('fyp_User', $data1);

        $query = $this->db->query("SELECT user_ID FROM fyp_User WHERE username='$username'");
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

}
