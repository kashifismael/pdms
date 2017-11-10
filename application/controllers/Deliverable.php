<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Deliverable extends CI_Controller {

    public function create() {
        if (isset($_POST['delName'])) {
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            echo "<br>";
            echo "student ID is " . $this->session->secondaryID;
            echo "<br>";
            echo "deliverable name is " . $this->input->post('delName');
            echo "<br>";
            $postDate = new DateTime($_POST['deadlineDate']);
            if (isset($_POST['deadlineTime'])) {
                $postTime = new DateTime($_POST['deadlineTime']);
            } else {
                $postTime = new DateTime('23:59:00');
            }
            echo "<br>";
            $postDateTime = new DateTime($postDate->format('Y-m-d') . ' ' . $postTime->format('H:i'));
            echo "Chosen date time is " . $postDateTime->format('Y-m-d H:i'); // Outputs '2017-03-14 13:37:42'
            echo "<br>";
            echo "<a href=\"" . base_url('student-home') . "\"> Go Back </a>";
        } else {
            echo "post wasnt sent";
        }
    }

}
