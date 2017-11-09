<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Deliverable extends CI_Controller{
    
    public function create(){
        if (isset($_POST['delName'])){
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            echo "<br>";
            echo "student ID is ".$this->session->secondaryID;
            echo "<br>";
            echo "<a href=\"".base_url('student-home')."\"> Go Back </a>";
        } else {
            echo "post wasnt sent";
        }
    }
    
}
