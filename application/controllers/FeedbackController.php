<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FeedbackController extends CI_Controller{
    
    public function uploadFile(){
        if (isset($_POST['delStatus'])){
            echo $this->session->userName." gave a status of ".$this->input->post('delStatus')." for evidence ".$this->input->post('evidID');
            echo "<br>";
            if (isset($_FILES['feedback']) && $_FILES['feedback']['error'] === 0 && $_FILES['feedback']['size'] <= 2097152){
                echo $this->session->userName." also uploaded some feedback";
                echo "<br>";
                echo "feedback file has a name of ".$_FILES['feedback']['name'];
                echo "<br>";
                echo "feedback file has a TMP name of ".$_FILES['feedback']['tmp_name'];
            }          
        } else {
            echo "nothing was posted";
        }
    }
    
}
