<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $this->load->model('user');
        $data['title'] = "Welcome";
        $this->load->view('header', $data);
        $this->load->view('landing_page', $data);
        if (isset($_SESSION['passNotMatching'])):
            unset($_SESSION['passNotMatching']);
        endif;
        if (isset($_SESSION['notUnique'])):
            unset($_SESSION['notUnique']);
        endif;
    }

    public function registerStudent() {
        $this->load->model('user');
        $this->load->model('student');
//        echo "This is the student register page";
//        echo "<br>";
        $userType = 3;
        if (isset($_POST['stUsername'])) {
            $username = $this->input->post('stUsername');
            $pass1 = $this->input->post('stpwd1');
            $pass2 = $this->input->post('stpwd2');
            $this->student->insertStudent($username, $pass1, $pass2, $userType);
        } else {
            echo "You're not meant to be here";
        }
    }

    public function registerStaff() {
        $this->load->model('user');
        $this->load->model('supervisor');
//        echo "<p>This is the supervisor register page</p>";
//        echo "<br>";
        $userType = 2;
        if (isset($_POST['kuUsername'])) {
            $username = $this->input->post('kuUsername');
            $pass1 = $this->input->post('kupwd1');
            $pass2 = $this->input->post('kupwd2');
            $this->supervisor->insertStaff($username, $pass1, $pass2, $userType);
        } else {
            echo "You're not meant to be here";
        }
    }

    public function processLogin() {
        $this->load->model('user');
        if (isset($_POST['username'])) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->user->authenticateUser($username, $password);
        } else {
            echo "You're not meant to be here";
        }
    }

    public function logOut() {
        echo "Logging out";
        session_destroy();
        redirect("/");
    }

}
