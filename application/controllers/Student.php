<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    public function index() {
        $data = self::checkIfAuthorised();
        $this->load->model('user');
        $this->load->model('deliverable');
        $data['title'] = "Dashboard";
        $data['myDeliverables'] = $this->deliverable->getAllStudentDeliverables($this->session->userName);
        $this->load->view('header', $data);
        $this->load->view('studentViews/navbar');
        if (isset($_GET['flow']) && $_GET['flow'] == "list") {
            $this->load->view('studentViews/dashboardList');
        } else {
            $this->load->view('studentViews/dashboardGrid');
        }
        $this->load->view('studentViews/footer');
        self::clearNotifications();
    }

    private function clearNotifications() {
        if (isset($_SESSION['deliverableCreation'])) {
            unset($_SESSION['deliverableCreation']);
        }
        if (isset($_SESSION['account'])) {
            unset($_SESSION['account']);
        }
        if (isset($_SESSION['evidenceCreation'])) {
            unset($_SESSION['evidenceCreation']);
        }
        if (isset($_SESSION['requestSubmission'])) {
            unset($_SESSION['requestSubmission']);
        }
    }

    public function viewDeliverable($delID) {
        $data = self::checkIfAuthorised();
        $this->load->model('deliverable');
        if (self::isStudentAuthorOfDeliverable($delID) == false) {
            return $this->load->view('unauthorisedAccess');
        }
        $this->load->model('evidence');
        //$this->load->model('feedback');
        $data['deliverableInfo'] = $this->deliverable->getOneDeliverable($delID);
        $data['myEvidences'] = $this->evidence->getAllEvidencesOfDeliverable($delID);
        $data['myFeedbacks'] = $this->feedback->getAllFeedbacksofDeliverable($delID);
        $data['title'] = "View Deliverable";
        $data['delID'] = $delID;
        $this->load->view('header', $data);
        $this->load->view('studentViews/navbar');
        $this->load->view('studentViews/viewDeliverableInfo');
        $this->load->view('studentViews/viewDeliverableModals');
        $this->load->view('studentViews/footer');
        self::clearNotifications();
    }

    private function isStudentAuthorOfDeliverable($delID) {
        $result = $this->deliverable->checkStudentAgainstDeliverable($delID);
        if ($result->num_rows() === 0) {
            return false;
        } else {
            return true;
        }
    }

    public function viewEvidence($evidID) {
        $data = self::checkIfAuthorised();
        $this->load->model('evidence');
        if (self::isStudentAuthorOfEvidence($evidID) == false) {
            return $this->load->view('unauthorisedAccess');
        }
        $this->load->model('feedback');
        $data['evidence'] = $this->evidence->getOneEvidence($evidID);
        $data['myFeedbacks'] = $this->feedback->getAllFeedbacksOfEvidence($evidID);
        $data['title'] = "View Evidence";
        $data['evidID'] = $evidID;
        $this->load->view('header', $data);
        $this->load->view('studentViews/navbar');
        $this->load->view('studentViews/viewEvidence');
        $this->load->view('studentViews/footer');
    }

    private function isStudentAuthorOfEvidence($evidID) {
        $result = $this->evidence->checkStudentAgainstEvidence($evidID);
        if ($result->num_rows() === 0) {
            return false;
        } else {
            return true;
        }
    }

    public function viewRequests() {
        $data = self::checkIfAuthorised();
        $data['title'] = "View Requests";
        $this->load->view('header', $data);
        $this->load->view('studentViews/navbar');
        $this->load->view('studentViews/viewRequests');
        $this->load->view('studentViews/footer');
    }

//    public function viewAllEvidences() {
//        self::checkIfAuthorised();
//        $data['title'] = "View All Evidences";
//        $this->load->view('header', $data);
//        $this->load->view('studentViews/navbar');
//        $this->load->view('studentViews/viewAllEvidences');
//        $this->load->view('studentViews/footer');
//    }

    public function viewAllFeedbacks() {
        $data = self::checkIfAuthorised();
        //$this->load->model('feedback');
        $data['unseenFeedbacks'] = $this->feedback->getAllStudentsFeedbacks(0, $this->session->secondaryID);
        $data['seenFeedbacks'] = $this->feedback->getAllStudentsFeedbacks(1, $this->session->secondaryID);
        $data['title'] = "View All Feedbacks";
        $this->load->view('header', $data);
        $this->load->view('studentViews/navbar');
        $this->load->view('studentViews/viewAllFeedbacks');
        $this->load->view('studentViews/footer');
    }

    public function viewSupervisor() {
        $data = self::checkIfAuthorised();
        $data['title'] = "View Supervisor";
        $this->load->view('header', $data);
        $this->load->view('studentViews/navbar');
        $this->load->view('studentViews/viewSupervisor');
        $this->load->view('studentViews/footer');
    }

    private function checkIfAuthorised() {
        if (isset($_SESSION['userName']) && $_SESSION['userTypeID'] == 3) {
            //User is authorised
            $this->load->model('feedback');
            $data['unSeenFeedbackNumber'] = $this->feedback->countAllUnseenFeedbacks($this->session->secondaryID);
            return $data;
        } else {
            //echo "user is not authorised, redirect user away";
            redirect('/?isAuthorised=false');
        }
    }

}
