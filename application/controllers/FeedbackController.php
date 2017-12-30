<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FeedbackController extends CI_Controller {

    public function provideFeedback() {
        if (!isset($_POST['delStatus'])) {
            redirect('staff-home');
        }
        $this->load->model('feedback');
        $info = $this->feedback->getEvidenceInfoForEmail($this->input->post('evidID'));
        $delUpdate = $this->feedback->updateDelStatus($this->input->post('delID'), $this->input->post('delStatus'));
        $evidUpdate = $this->feedback->updateEvidStatus($this->input->post('evidID'), $this->input->post('evidStatus'));
        if ($delUpdate === true && $evidUpdate === true) {
            $this->session->set_userdata('feedbackSubmission', 'success');
            $messageOne = "The statuses of the following deliverable/evidence has been updated:";
            $messageTwo = null;
            if (self::uploadFeedback()) {
                $this->session->set_userdata('feedbackUpload', 'success');
                $messageTwo = "Your supervisor has uploaded feedback regarding your piece of evidence.";
            }
            self::sendNotificationEmail($info->emailAddress, $info->firstName, $info->evidenceName . " (" . $info->deliverableName . ")", $messageOne, $messageTwo);
            redirect('view-evidence/' . $this->input->post('evidID'));
        }
    }

    private function uploadFeedback() {
        if (isset($_FILES['feedback']) && $_FILES['feedback']['error'] === 0 && $_FILES['feedback']['size'] <= 2097152) {
            return $this->feedback->uploadFeedbackFile($_FILES['feedback']['name'], $_FILES['feedback']['tmp_name']);
        } else {
            echo "there was a problem with the file upload/file size";
            return false;
        }
    }

    public function markDelStatus() {
        if (isset($_POST['delStatus'])) {
            $this->load->model('feedback');
            $info = $this->feedback->getDeliverableInfoForEmail($this->input->post('delID'));
            $message = "The status of the following deliverable has been updated:";
            $delUpdate = $this->feedback->updateDelStatus($this->input->post('delID'), $this->input->post('delStatus'));
            if ($delUpdate === true) {
                self::sendNotificationEmail($info->emailAddress, $info->firstName, $info->deliverableName, $message, null);
                $this->session->set_userdata('statusUpdate', 'success');
                redirect('view-deliverable/' . $this->input->post('delID'));
            }
        }
    }

    private function sendNotificationEmail($email, $firstName, $deliverable, $messageOne, $messageTwo) {
        $data['title'] = "Deliverable Status Updated";
        $data['firstName'] = $firstName;
        $data['messageOne'] = $messageOne;
        $data['messageTwo'] = $messageTwo;
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
            $this->feedback->setFeedbacktoSeen($this->input->post('feedbackID'));
            $this->feedback->downloadFeedbackFile();
        } else {
            echo "nothing was posted, redirect user away";
        }
    }

}
