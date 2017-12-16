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
        $this->load->view(self::navbarLoader($_SESSION['userTypeID']));
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
        self::checkIfAuthorised();
        $this->load->model('user');
        $this->load->model('student');
        $this->load->model('supervisor');
        $this->load->model('deliverable');
        $data['studentID'] = $studentID;
        $data['student'] = $this->supervisor->getStudentInfo($studentID);
        $data['theirDeliverables'] = $this->deliverable->getAllStudentDeliverables($studentID);
        $data['title'] = "View Student";
        $this->load->view('header', $data);
        $this->load->view(self::navbarLoader($_SESSION['userTypeID']));
        $this->load->view('staffViews/viewStudentInfo');
    }

    public function viewDeliverable($delID) {
        self::checkIfAuthorised();
        $this->load->model('deliverable');
        $this->load->model('evidence');
        $this->load->model('feedback');
        $data['deliverableInfo'] = $this->deliverable->getOneDeliverable($delID);
        $data['myEvidences'] = $this->evidence->getAllEvidencesOfDeliverable($delID);
        $data['myFeedbacks'] = $this->feedback->getAllFeedbacksofDeliverable($delID);
        $data['title'] = "View Deliverable";
        $data['deliverableID'] = $delID;
        $data['statusOptions'] = $this->deliverable->listStatusOptions();
        $this->load->view('header', $data);
        $this->load->view(self::navbarLoader($_SESSION['userTypeID']));
        $this->load->view('staffViews/viewDeliverableInfo');
        $this->load->view('staffViews/viewDeliverableFooter');
        if (isset($_SESSION['statusUpdate'])) {
            unset($_SESSION['statusUpdate']);
        }
    }

    public function viewEvidence($evidID) {
        self::checkIfAuthorised();
        $this->load->model('deliverable');
        $this->load->model('evidence');
        $this->load->model('feedback');
        $data['evidence'] = $this->evidence->getOneEvidence($evidID);
        $data['statusOptions'] = $this->deliverable->listStatusOptions();
        $data['myFeedbacks'] = $this->feedback->getAllFeedbacksOfEvidence($evidID);
        $data['title'] = "View Evidence";
        $data['evidenceID'] = $evidID;
        $this->load->view('header', $data);
        $this->load->view(self::navbarLoader($_SESSION['userTypeID']));
        $this->load->view('staffViews/viewEvidence');
        if (isset($_SESSION['feedbackSubmission'])) {
            unset($_SESSION['feedbackSubmission']);
        }
        if (isset($_SESSION['feedbackUpload'])) {
            unset($_SESSION['feedbackUpload']);
        }
    }

    public function allocateStudents() {
        self::checkIfAuthorised();
        $this->load->model('user');
        $this->load->model('student');
        $this->load->model('supervisor');
        $this->load->model('moduleLeader');
        $data['title'] = "Student Allocation";
        $data['studentList'] = $this->moduleLeader->getAllUnallocatedStudents();
        $data['supervisorList'] = $this->moduleLeader->getAllSupervisors();
        $this->load->view('header', $data);
        $this->load->view(self::navbarLoader($_SESSION['userTypeID']));
        $this->load->view('moduleLeaderViews/allocateStudents');
        if (isset($_SESSION['allocation'])) {
            unset($_SESSION['allocation']);
        }
    }

    public function manageRequests() {
        self::checkIfAuthorised();
        $data['title'] = "Manage Requests";
        $this->load->view('header', $data);
        $this->load->view(self::navbarLoader($_SESSION['userTypeID']));
        $this->load->view('staffViews/manageRequests');
    }

    public function processAllocation() {
        self::checkIfAuthorised();
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

    public function viewSubmittedEvidences() {
        self::checkIfAuthorised();
        $this->load->model('user');
        $this->load->model('student');
        $this->load->model('supervisor');
        $this->load->model('evidence');
        $data['submittedEvidences'] = $this->evidence->getAllEvidencesForSupervisor($this->session->secondaryID);
        $data['title'] = "Latest Submissions";
        $this->load->view('header', $data);
        $this->load->view(self::navbarLoader($_SESSION['userTypeID']));
        $this->load->view('staffViews/latestSubmissions');
    }

    public function viewAllSupervisors() {
        self::checkIfAuthorised();
        $this->load->model('user');
        $this->load->model('supervisor');
        $this->load->model('moduleLeader');
        $data['supervisorList'] = $this->moduleLeader->getAllSupervisors();
        $data['title'] = "View All Supervisors";
        $this->load->view('header', $data);
        $this->load->view(self::navbarLoader($_SESSION['userTypeID']));
        $this->load->view('moduleLeaderViews/viewAllSupervisors');
    }

    private static function checkIfAuthorised() {
        if (isset($_SESSION['userName']) && $_SESSION['userTypeID'] == 2 || $_SESSION['userTypeID'] == 1) {
            //user is authorised
        } else {
            //echo "user is not authorised, redirect user away";
            redirect('/?isAuthorised=false');
        }
    }

    private static function navbarLoader($userTypeID) {
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
