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

}
