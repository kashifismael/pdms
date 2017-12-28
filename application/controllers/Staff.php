<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

    public function index() {
        $data = self::checkIfAuthorised();
        //$this->load->model(array('user','student','supervisor','evidence'));
        $this->load->model(array('user','student','supervisor'));
        $data['supervisorGroup'] = $this->supervisor->getAllSupervisorStudents($this->session->secondaryID);
        $data['submittedEvidences'] = $this->evidence->getAllEvidencesForSupervisor($this->session->secondaryID);
        $data['title'] = "Dashboard";
        $this->load->view('header', $data);
        self::navbarLoader($_SESSION['userTypeID']);
        if ($_SESSION['userTypeID'] == 1) {
            //$data['unAllocatedStudentsNumber'] = $this->moduleLeader->unallocatedStudentsQuery();
            $this->load->view('moduleLeaderViews/mlDashboard', $data);
        } else if ($_SESSION['userTypeID'] == 2) {
            $this->load->view('staffViews/supDashboard');
        } 
//        else {
//            echo "user type is " . $_SESSION['userTypeID'] . ", which is unexpected";
//        }
    }

    public function viewStudent($studentID) {
        $data = self::checkIfAuthorised();
        $this->load->model(array('user','student','supervisor','deliverable'));
        $data['studentID'] = $studentID;
        $data['student'] = $this->supervisor->getStudentInfo($studentID);
        $data['theirDeliverables'] = $this->deliverable->getAllStudentDeliverables($studentID);
        $data['title'] = "View Student";
        $this->load->view('header', $data);
        self::navbarLoader($_SESSION['userTypeID']);
        $this->load->view('staffViews/viewStudentInfo');
    }

    public function viewDeliverable($delID) {
        $data = self::checkIfAuthorised();
        $this->load->model(array('user','supervisor','deliverable','feedback'));
        $data['deliverableInfo'] = $this->deliverable->getOneDeliverable($delID);
        $data['myEvidences'] = $this->evidence->getAllEvidencesOfDeliverable($delID);
        $data['myFeedbacks'] = $this->feedback->getAllFeedbacksofDeliverable($delID);
        $data['title'] = "View Deliverable";
        $data['deliverableID'] = $delID;
        $data['statusOptions'] = $this->deliverable->listStatusOptions();
        $this->load->view('header', $data);
        self::navbarLoader($_SESSION['userTypeID']);
        $this->load->view('staffViews/viewDeliverableInfo');
        $this->load->view('staffViews/viewDeliverableFooter');
        if (isset($_SESSION['statusUpdate'])) {
            unset($_SESSION['statusUpdate']);
        }
    }

    public function viewEvidence($evidID) {
        $data = self::checkIfAuthorised();
        $this->load->model(array('user','supervisor','deliverable','feedback'));
        $data['evidence'] = $this->evidence->getOneEvidence($evidID);
        $data['statusOptions'] = $this->deliverable->listStatusOptions();
        $data['myFeedbacks'] = $this->feedback->getAllFeedbacksOfEvidence($evidID);
        $data['title'] = "View Evidence";
        $data['evidenceID'] = $evidID;
        $this->load->view('header', $data);
        self::navbarLoader($_SESSION['userTypeID']);
        $this->load->view('staffViews/viewEvidence');
        if (isset($_SESSION['feedbackSubmission'])) {
            unset($_SESSION['feedbackSubmission']);
        }
        if (isset($_SESSION['feedbackUpload'])) {
            unset($_SESSION['feedbackUpload']);
        }
    }

    public function allocateStudents() {
        $data = self::checkIfAuthorised();
        $this->load->model(array('user','student','supervisor','moduleLeader'));
        $data['title'] = "Student Allocation";
        $data['studentList'] = $this->moduleLeader->getAllUnallocatedStudents();
        $data['supervisorList'] = $this->moduleLeader->getAllSupervisors();
        $this->load->view('header', $data);
        self::navbarLoader($_SESSION['userTypeID']);
        $this->load->view('moduleLeaderViews/allocateStudents');
        if (isset($_SESSION['allocation'])) {
            unset($_SESSION['allocation']);
        }
    }

    public function manageRequests() {
        $data = self::checkIfAuthorised();
        $this->load->model(array('user','supervisor','request','deadlineRequest','deleteRequest'));
        $data['title'] = "Manage Requests";
        $data['deadlineRequests'] = $this->deadlineRequest->getAllPendingDeadlineRequests($this->session->secondaryID);
        $data['deleteRequests'] = $this->deleteRequest->getAllPendingDeleteRequests($this->session->secondaryID);
        $this->load->view('header', $data);
        self::navbarLoader($_SESSION['userTypeID']);
        $this->load->view('staffViews/manageRequests');
        if (isset($_SESSION['requestRejection'])) {
            unset($_SESSION['requestRejection']);
        }
        if (isset($_SESSION['deadlineRequestApproval'])) {
            unset($_SESSION['deadlineRequestApproval']);
        }
    }

    public function processAllocation() {
        self::checkIfAuthorised();
        if (isset($_POST['students'])) {
            $this->load->model(array('user','student','supervisor','moduleLeader'));
            $this->moduleLeader->allocateStudentsToSupervisor();
            redirect('student-allocation');
        } else {
            echo "nothing posted, so redirect away";
        }
    }

    public function viewSubmittedEvidences() {
        $data = self::checkIfAuthorised();
        $this->load->model(array('user','student','supervisor'));
        $data['submittedEvidences'] = $this->evidence->getAllEvidencesForSupervisor($this->session->secondaryID);
        $data['title'] = "Latest Submissions";
        $this->load->view('header', $data);
        self::navbarLoader($_SESSION['userTypeID']);
        $this->load->view('staffViews/latestSubmissions');
    }

    public function viewAllSupervisors() {
        $data = self::checkIfAuthorised();
        $this->load->model(array('user','supervisor','moduleLeader'));
        $data['supervisorList'] = $this->moduleLeader->getAllSupervisors();
        $data['title'] = "View All Supervisors";
        $this->load->view('header', $data);
        self::navbarLoader($_SESSION['userTypeID']);
        $this->load->view('moduleLeaderViews/viewAllSupervisors');
    }

    private function checkIfAuthorised() {
        if (isset($_SESSION['userName']) && $_SESSION['userTypeID'] == 2 || $_SESSION['userTypeID'] == 1) {
            //user is authorised
            //load all supervisor models for nav
            $this->load->model(array('request','evidence'));
            //do count queries on the navbar options
                //data[] = countAllRequests
                $data['numberOfReqs'] = $this->request->countAllRequests($this->session->secondaryID);
                //data[] = countAllEvidences
                $data['numberOfEvids'] = $this->evidence->countAllSubmittedEvidences($this->session->secondaryID);
                return $data;
                
        } else {
            //echo "user is not authorised, redirect user away";
            redirect('/?isAuthorised=false');
        }
    }

    private function navbarLoader($userTypeID) {
        if ($userTypeID == 2) {
            return $this->load->view('staffViews/navbar');
        } else if ($userTypeID == 1) {
            $this->load->model('moduleLeader');
                //count all unallocated students
            $data['unAllocatedStudentsNumber'] = $this->moduleLeader->countAllUnallocatedStudents();
            return $this->load->view('moduleLeaderViews/navbar',$data);
        } 
    }

}
