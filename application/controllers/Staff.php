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
           
    public function index()
        {
        $data['title'] = "Dashboard";    
        $this->load->view('header',$data);       
            if (isset($_GET['type']) && $_GET['type'] == "ml"){
                //echo "this is the module leader page";
                $this->load->view('moduleLeaderViews/navbar');
                $this->load->view('moduleLeaderViews/mlDashboard');
            } else {
                $this->load->view('staffViews/navbar');
                $this->load->view('staffViews/supDashboard');
            }
        }
        
        public function viewStudent($studentID) {
            $data['title'] = "View Student";
            $this->load->view('header', $data);
            $this->load->view('staffViews/navbar');
            if (isset($_GET['flow']) && $_GET['flow'] == "list"){
            $this->load->view('staffViews/viewStudentList');
            } else {
                $this->load->view('staffViews/viewStudentGrid');
            }
        }
        
        public function viewEvidence($evidID) {
            $data['title'] = "View Evidence";
            $this->load->view('header', $data);
            $this->load->view('staffViews/navbar');
            $this->load->view('staffViews/viewEvidence');
        }
        
        public function viewDeliverable($delId){
            $data['title'] = "View Deliverable";
            $this->load->view('header', $data);
            $this->load->view('staffViews/navbar');
                if (isset($_GET['flow']) && $_GET['flow'] == "list"){
                    $this->load->view('staffViews/viewDeliverableList');
                } else {
                    $this->load->view('staffViews/viewDeliverableGrid');                   
                }
        }


        public function allocateStudents(){
            $data['title'] = "Student Allocation";
            $this->load->view('header', $data);
            $this->load->view('moduleLeaderViews/navbar');
            $this->load->view('moduleLeaderViews/allocateStudents');
        }
        
        public function manageRequests(){
            $data['title'] = "Manage Requests";           
            $this->load->view('header', $data);
            $this->load->view('staffViews/navbar');
            $this->load->view('staffViews/manageRequests');
        }
}
