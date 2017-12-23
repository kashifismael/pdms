<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Student
 *
 * @author Kashif
 */
class Student extends CI_Controller {

    public function index() {
        self::checkIfAuthorised();
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
    }

    public function viewDeliverable($delID) {
        self::checkIfAuthorised();
        $this->load->model('deliverable');
        if (self::isStudentAuthorOfDeliverable($delID) == false) {
            //echo "user is not authorised to view this content";
            return $this->load->view('unauthorisedAccess');
        }
        $this->load->model('evidence');
        $this->load->model('feedback');
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
        if (isset($_SESSION['evidenceCreation'])) {
            unset($_SESSION['evidenceCreation']);
        }
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
        self::checkIfAuthorised();
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

    private static function checkIfAuthorised() {
        if (isset($_SESSION['userName']) && $_SESSION['userTypeID'] == 3) {
            //User is authorised
        } else {
            //echo "user is not authorised, redirect user away";
            redirect('/?isAuthorised=false');
        }
    }

}
