<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Staff
 *
 * @author Kashif
 */
class Staff extends CI_Controller {

    public function index() {
        self::checkIfAuthorised();
        $data['title'] = "Dashboard";
        $this->load->view('header', $data);
        $navFilePath = self::staffTypeCheck($_SESSION['userTypeID']);
        $this->load->view($navFilePath);
        if ($_SESSION['userTypeID'] == 1){
            $this->load->view('moduleLeaderViews/mlDashboard');
        } else if($_SESSION['userTypeID'] == 2) {
            $this->load->view('staffViews/supDashboard');
        } else {
            echo "user type is ".$_SESSION['userTypeID'].", which is unexpected";
        }
    }

    public function viewStudent($studentID) {
        $data['title'] = "View Student";
        $this->load->view('header', $data);
        $this->load->view('staffViews/navbar');
        if (isset($_GET['flow']) && $_GET['flow'] == "list") {
            $this->load->view('staffViews/viewStudentList');
        } else {
            $this->load->view('staffViews/viewStudentGrid');
        }
    }

    public function viewEvidence($evidID) {
        $data['title'] = "View Evidence";
        $data['evidenceID'] = $evidID;
        $this->load->view('header', $data);
        $this->load->view('staffViews/navbar');
        $this->load->view('staffViews/viewEvidence');
    }

    public function viewDeliverable($delId) {
        $data['title'] = "View Deliverable";
        $this->load->view('header', $data);
        $this->load->view('staffViews/navbar');
        if (isset($_GET['flow']) && $_GET['flow'] == "list") {
            $this->load->view('staffViews/viewDeliverableList');
        } else {
            $this->load->view('staffViews/viewDeliverableGrid');
        }
        $this->load->view('staffViews/viewDeliverableFooter');
    }

    public function allocateStudents() {
        $data['title'] = "Student Allocation";
        $this->load->view('header', $data);
        $this->load->view('moduleLeaderViews/navbar');
        $this->load->view('moduleLeaderViews/allocateStudents');
    }

    public function manageRequests() {
        $data['title'] = "Manage Requests";
        $this->load->view('header', $data);
        $this->load->view('staffViews/navbar');
        $this->load->view('staffViews/manageRequests');
    }

    private static function checkIfAuthorised() {
        if (isset($_SESSION['userName']) && $_SESSION['userTypeID'] == 2 || $_SESSION['userTypeID'] == 1) {
            echo "<p>User is authorised</p>";
        } else {
            echo "user is not authorised, redirect user away";
            //force redirect
        }
    }
    
    private static function staffTypeCheck($userTypeID){
        $navFilePath = "";
        if($userTypeID == 2){
            $navFilePath = 'staffViews/navbar';
            return $navFilePath;
        } else if($userTypeID == 1){
            $navFilePath = 'moduleLeaderViews/navbar';
            return $navFilePath;
        } else {
            echo "user type is ".$userTypeID.", which is unexpected";
        }
    }

}
