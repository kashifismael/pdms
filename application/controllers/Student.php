<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student
 *
 * @author Kashif
 */
class Student extends CI_Controller {

    public function index() {
        $this->load->model('user');
        $this->load->model('deliverable');
        self::checkIfAuthorised();
        $data['title'] = "Dashboard";
        //$data['myDeliverables'] = $this->deliverable->getAllStudentDeilverables($this->session->secondaryID);
        $data['myDeliverables'] = $this->deliverable->getAllStudentDeliverables($this->session->userName);
        $this->load->view('header', $data);
        $this->load->view('studentViews/navbar');
        $this->load->view('studentViews/dashboard');
        $this->load->view('studentViews/footer');
        if (isset($_SESSION['deliverableCreation'])) {
            unset($_SESSION['deliverableCreation']);
        }
        if (isset($_SESSION['account'])) {
            unset($_SESSION['account']);
        }
    }

    public function viewDeliverable($delID) {
        $this->load->model('deliverable');
        $this->load->model('evidence');
        $data['deliverableInfo'] = $this->deliverable->getOneDeliverable($delID);
        $data['myEvidences'] = $this->evidence->getAllEvidencesOfDeliverable($delID);
        $data['title'] = "View Deliverable";
        $data['delID'] = $delID;
        $this->load->view('header', $data);
        $this->load->view('studentViews/navbar');
        if (isset($_GET['flow']) && $_GET['flow'] == "list") {
            $this->load->view('studentViews/viewDeliverableList');
        } else {
            $this->load->view('studentViews/viewDeliverableGrid');
        }
        $this->load->view('studentViews/viewDeliverableModals');
        $this->load->view('studentViews/footer');
        if (isset($_SESSION['evidenceCreation'])) {
            unset($_SESSION['evidenceCreation']);
        }
    }

    public function viewEvidence($evidID) {
        $data['title'] = "View Evidence";
        $data['evidID'] = $evidID;
        $this->load->view('header', $data);
        $this->load->view('studentViews/navbar');
        $this->load->view('studentViews/viewEvidence');
        $this->load->view('studentViews/footer');
    }

    private static function checkIfAuthorised() {
        if (isset($_SESSION['userName']) && $_SESSION['userTypeID'] == 3) {
            //echo "<p>User is authorised</p>";
        } else {
            echo "user is not authorised, redirect user away";
            //force redirect
        }
    }

}
