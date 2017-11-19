<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EvidenceController extends CI_Controller {

    public function uploadFile() {
        $this->load->model('evidence');
        if (isset($_FILES['evidence']) && isset($_POST['evidenceName']) 
                && $_FILES['evidence']['error'] === 0 && $_FILES['evidence']['size'] <= 2097152) {
            $upload = $this->evidence->uploadEvidenceFile($_FILES['evidence']['name'],$_FILES['evidence']['tmp_name']);
            if ($upload === true){
                //echo "<p>everything was successful</p>";
                $this->session->set_userdata('evidenceCreation', 'success');
                
                redirect('deliverable/'.$this->input->post('deliverableID'));
            }
        } else {
            echo "something went wrong, redirect away";
            redirect('student-home');
        }
    }

}
