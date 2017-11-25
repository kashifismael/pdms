<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FeedbackController extends CI_Controller{
    
    public function uploadFile(){
        if (isset($_POST['delStatus'])){
            echo $this->session->userName." gave a status of ".$this->input->post('delStatus')." for evidence ".$this->input->post('evidID');
        } else {
            echo "nothing was posted";
        }
    }
    
}
