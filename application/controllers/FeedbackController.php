<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FeedbackController extends CI_Controller {

    public function uploadFile() {
        if (isset($_POST['delStatus'])) {
            $upload = false;
            $this->load->model('feedback');
            $delUpdate = $this->feedback->updateDelStatus($this->input->post('delID'), $this->input->post('delStatus'));
            $evidUpdate = $this->feedback->updateEvidStatus($this->input->post('evidID'), $this->input->post('evidStatus'));
            if ($delUpdate === true && $evidUpdate === true) {
                $this->session->set_userdata('feedbackSubmission', 'success');
            }
            if (isset($_FILES['feedback']) && $_FILES['feedback']['error'] === 0 && $_FILES['feedback']['size'] <= 2097152) {
                $upload = $this->feedback->uploadFeedbackFile($_FILES['feedback']['name'], $_FILES['feedback']['tmp_name']);
                if ($upload === true) {
                    $this->session->set_userdata('feedbackUpload', 'success');
                }
            }
            redirect('view-evidence/' . $this->input->post('evidID'));
        } else {
            echo "nothing was posted";
        }
    }

    public function markDelStatus() {
        if (isset($_POST['delStatus'])) {
            $this->load->model('feedback');
            $info = $this->feedback->getDeliverableInfoForEmail($this->input->post('delID'));
            $message = "The status of the following deliverable has been updated:";
            $delUpdate = $this->feedback->updateDelStatus($this->input->post('delID'), $this->input->post('delStatus'));
            if ($delUpdate === true) {
                self::sendNotificationEmail($info->emailAddress,$info->firstName,$info->deliverableName, $message);
                $this->session->set_userdata('statusUpdate', 'success');
                redirect('view-deliverable/' . $this->input->post('delID'));
            }
        }
    }

    private function sendNotificationEmail($email, $firstName, $deliverable, $message) {
        $data['title'] = "Deliverable Status Updated";
        $data['firstName'] = $firstName;
        $data['message'] = $message;
        $data['delName'] = $deliverable;
        $this->load->library('email');
        $this->email->from('unidissKU@gmail.com', 'UniDiss');
        $this->email->to($email);
        $this->email->subject("Deliverable Status Updated");
        $body = $this->load->view('emailViews/updatedStatusEmail', $data, TRUE);
        $this->email->message($body);
        $this->email->send();
    }

    public function downloadFile() {
        $this->load->model('feedback');
        if (isset($_POST['feedbackID'])) {
            $this->feedback->downloadFeedbackFile();
        } else {
            echo "nothing was posted, redirect user away";
        }
    }

}
