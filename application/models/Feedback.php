<?php

class Feedback extends CI_Model {
    
    
    public function uploadFeedbackFile(){
        //the actual uploading (and permanent saving) of the file to the server
    }
    
    public function insertFeedbackRecord(){
        //inserting into DB that a feedback has been uploaded
    }
    
    public function downloadFeedbackFile(){
        //downloadig of feedback file on server
    }
    
    public function updateDelStatus(){
        //sql update statement that changes the status of a deliverable
    }
}
