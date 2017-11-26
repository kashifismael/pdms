<?php

class Feedback extends CI_Model {

    public function uploadFeedbackFile() {
        //the actual uploading (and permanent saving) of the file to the server
    }

    public function insertFeedbackRecord() {
        //inserting into DB that a feedback has been uploaded
    }

    public function updateEvidStatus() {
        //sql update statement that changes the status of an evidence
        //$query = $this->db->query("UPDATE fyp_Deliverable SET delStatus_ID = 4 WHERE deliverable_ID = 3");
       // return $query;
    }

    public function updateDelStatus() {
        //sql update statement that changes the status of a deliverable
        //$query = $this->db->query("UPDATE fyp_Deliverable SET delStatus_ID = 4 WHERE deliverable_ID = 3");
        //return $query;
    }

    public function downloadFeedbackFile() {
        //downloadig of feedback file on server
    }

}
