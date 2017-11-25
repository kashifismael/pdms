<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

    public function index() {
        self::checkIfAuthorised();
        $this->load->model('user');
        $this->load->model('student');
        $this->load->model('supervisor');
        $this->load->model('moduleLeader');
        $this->load->model('evidence');
        $data['supervisorGroup'] = $this->supervisor->getAllSupervisorStudents($this->session->secondaryID);
        $data['submittedEvidences'] = $this->evidence->getAllEvidencesForSupervisor($this->session->secondaryID);
        $data['title'] = "Dashboard";
        $this->load->view('header', $data);
        $navFilePath = self::staffTypeCheck($_SESSION['userTypeID']);
        $this->load->view($navFilePath);
        if ($_SESSION['userTypeID'] == 1) {
            $data['unAllocatedStudentsNumber'] = $this->moduleLeader->unallocatedStudentsQuery();
            $this->load->view('moduleLeaderViews/mlDashboard', $data);
        } else if ($_SESSION['userTypeID'] == 2) {
            $this->load->view('staffViews/supDashboard');
        } else {
            echo "user type is " . $_SESSION['userTypeID'] . ", which is unexpected";
        }
    }

    public function viewStudent($studentID) {
        $this->load->model('user');
        $this->load->model('student');
        $this->load->model('supervisor');
        $this->load->model('deliverable');
        $data['studentID'] = $studentID;
        $data['student'] = $this->supervisor->getStudentInfo($studentID);
        $data['theirDeliverables'] = $this->deliverable->getAllStudentDeliverables($studentID);
        $data['title'] = "View Student";
        $this->load->view('header', $data);
        $this->load->view('staffViews/navbar');
        $this->load->view('staffViews/viewStudentInfo');
    }

    public function viewDeliverable($delID) {
        $this->load->model('deliverable');
        $this->load->model('evidence');
        $data['deliverableInfo'] = $this->deliverable->getOneDeliverable($delID);
        $data['myEvidences'] = $this->evidence->getAllEvidencesOfDeliverable($delID);
        $data['title'] = "View Deliverable";
        $data['deliverableID'] = $delID;
        $data['statusOptions'] = $this->deliverable->listStatusOptions();
        $this->load->view('header', $data);
        $this->load->view('staffViews/navbar');
        $this->load->view('staffViews/viewDeliverableInfo');
        $this->load->view('staffViews/viewDeliverableFooter');
    }

    public function viewEvidence($evidID) {
        $this->load->model('deliverable');
        $data['statusOptions'] = $this->deliverable->listStatusOptions();
        $data['title'] = "View Evidence";
        $data['evidenceID'] = $evidID;
        $this->load->view('header', $data);
        $this->load->view('staffViews/navbar');
        $this->load->view('staffViews/viewEvidence');
    }

    public function allocateStudents() {
        $this->load->model('user');
        $this->load->model('student');
        $this->load->model('supervisor');
        $this->load->model('moduleLeader');
        $data['title'] = "Student Allocation";
        $data['studentList'] = $this->moduleLeader->getAllUnallocatedStudents();
        $data['supervisorList'] = $this->moduleLeader->getAllSupervisors();
        $this->load->view('header', $data);
        $this->load->view('moduleLeaderViews/navbar');
        $this->load->view('moduleLeaderViews/allocateStudents');
        if (isset($_SESSION['allocation'])) {
            unset($_SESSION['allocation']);
        }
    }

    public function manageRequests() {
        $data['title'] = "Manage Requests";
        $this->load->view('header', $data);
        $this->load->view('staffViews/navbar');
        $this->load->view('staffViews/manageRequests');
    }

    public function processAllocation() {
        if (isset($_POST['students'])) {
            $this->load->model('user');
            $this->load->model('student');
            $this->load->model('supervisor');
            $this->load->model('moduleLeader');
            $this->moduleLeader->allocateStudentsToSupervisor();
            redirect('student-allocation');
        } else {
            echo "nothing posted, so redirect away";
        }
    }

    private static function checkIfAuthorised() {
        if (isset($_SESSION['userName']) && $_SESSION['userTypeID'] == 2 || $_SESSION['userTypeID'] == 1) {
            //echo "<p>User is authorised</p>";
        } else {
            echo "user is not authorised, redirect user away";
            //force redirect
        }
    }

    private static function staffTypeCheck($userTypeID) {
        $navFilePath = "";
        if ($userTypeID == 2) {
            $navFilePath = 'staffViews/navbar';
            return $navFilePath;
        } else if ($userTypeID == 1) {
            $navFilePath = 'moduleLeaderViews/navbar';
            return $navFilePath;
        } else {
            echo "user type is " . $userTypeID . ", which is unexpected";
        }
    }

}
