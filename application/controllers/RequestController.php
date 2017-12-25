<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RequestController extends CI_Controller {

    public function requestDeadlineExtension() {
        if (isset($_POST['reason'])) { 
            $postDate = new DateTime($this->input->post('reqDeadlineDate'));
            $postTime = new DateTime($this->input->post('reqDeadlineTime'));
            $postDateTime = new DateTime($postDate->format('Y-m-d') . ' ' . $postTime->format('H:i'));
            $this->load->model('request');
            $this->load->model('deadlineRequest');
            $insert = $this->deadlineRequest->insertDeadlineRequest($postDateTime->format('Y-m-d H:i'));
            if ($insert === true){
                echo "successful insert, redirect user back";
                $this->session->set_userdata('requestSubmission', 'success');
                redirect('deliverable/'.$this->input->post('deliverableID'));
            }
        } else {
            echo "nothing was posted, redirect away";
            redirect('student-home');
        }
    }

}
