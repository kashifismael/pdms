<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DeliverableController extends CI_Controller {

    public function create() {
        $this->load->model('deliverable');
        if (isset($_POST['delName'])) {
            $postDate = new DateTime($this->input->post('deadlineDate'));
            $postTime = new DateTime($this->input->post('deadlineTime'));
            $postDateTime = new DateTime($postDate->format('Y-m-d') . ' ' . $postTime->format('H:i'));
            $insert = $this->deliverable->insertDeliverable($postDateTime->format('Y-m-d H:i'));
            if ($insert === true) {
                //redirect('student-home?deliverableCreation=success');
                redirect('student-home');
            } else {
                echo "<p>Insert went wrong</p>";         
                echo "<a href=\"" . base_url('student-home') . "\"> Go Back </a>";
            }
        } else {
            echo "post wasnt sent";
            redirect('student-home');
        }
    }

}
