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
            if ($insert === true) {
                $this->session->set_userdata('requestSubmission', 'success');
                redirect('deliverable/' . $this->input->post('deliverableID'));
            }
        } else {
            echo "nothing was posted, redirect away";
            redirect('student-home');
        }
    }

    public function requestDeliverableDelete() {
        if (isset($_POST['deleteReason'])) {
            $this->load->model('request');
            $this->load->model('deleteRequest');
            $insert = $this->deleteRequest->insertDeleteRequest();
            if ($insert === true) {
                $this->session->set_userdata('requestSubmission', 'success');
                redirect('deliverable/' . $this->input->post('deliverableID'));
            }
        } else {
            echo "nothing was posted";
        }
    }
    
    public function approveDeliverableDelete(){
        if (isset($_POST['delID'])) {
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            echo "delete this deliverable (yet to be implemented)";
        }
    }

    public function approveDeadlineRequest() {
        if (isset($_POST['delID'])) {
            $this->load->model('request');
            $this->load->model('deadlineRequest');
            $approve = $this->deadlineRequest->approveDeadlineRequest(
                    $this->input->post('reqID'), $this->input->post('delID'), $this->input->post('reqDeadline'));
            if ($approve === true) {
                $this->session->set_userdata('deadlineRequestApproval', 'success');
                redirect('manage-requests');
            } else {
                echo "something went wrong";
            }
        } else {
            echo "nothing was posted, redirect away";
        }
    }

    public function rejectRequest() {
        if (isset($_POST['reqID'])) {
            $this->load->model('request');
            $reject = $this->request->rejectRequest($this->input->post('reqID'));
            if ($reject === true) {
                $this->session->set_userdata('requestRejection', 'success');
                redirect('manage-requests');
            }
        } else {
            echo "nothing was posted, redirect away";
        }
    }

}
