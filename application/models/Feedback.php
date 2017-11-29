<?php

class Feedback extends CI_Model {

    private $feedbackID;
    private $feedbackDate;

    function __construct() {
        parent::__construct();
    }

    public function feedbackConstructor($feedbackID, $feedbackDate) {
        $feedback = new Feedback();
        $feedback->setFeedbackID($feedbackID);
        $feedback->setFeedbackDate($feedbackDate);
        return $feedback;
    }

    public function getAllFeedbacksofDeliverable($delID) {
        $feedbackList = array();
        $query = "SELECT fyp_Feedback.feedback_ID, fyp_Evidence.deliverable_ID, fyp_Feedback.evidence_ID, fyp_Feedback.feedbackDate
                    FROM `fyp_Feedback` 
                    INNER JOIN fyp_Evidence ON fyp_Evidence.evidence_ID = fyp_Feedback.evidence_ID 
                    INNER JOIN fyp_Deliverable ON fyp_Deliverable.deliverable_ID = fyp_Evidence.deliverable_ID 
                    WHERE fyp_Evidence.deliverable_ID = '$delID' 
                    ORDER BY `fyp_Feedback`.`feedbackDate` DESC";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $newFeedback = self::feedbackConstructor($row->feedback_ID, new DateTime($row->feedbackDate));
            $feedbackList[] = $newFeedback;
        }
        return $feedbackList;
    }

    public function uploadFeedbackFile($fileName, $file_tmp) {
        $newFileName = uniqid('', true) . $this->session->userName . $fileName;
        $fileDestination = "feedbackUploads/" . $newFileName;
        if (move_uploaded_file($file_tmp, $fileDestination)) {
            $insert = self::insertFileRecord($newFileName);
        } else {
            echo "file upload didnt work";
        }
        if ($insert === true) {
            return true;
        }
    }

    public function insertFileRecord($newFileName) {
        $data = array(
            'evidence_ID' => $this->input->post('evidID'),
            'filePath' => $newFileName,
        );
        return $this->db->insert('fyp_Feedback', $data);
    }

    public function updateEvidStatus($evidID, $evidStatus) {
        $query = $this->db->query("UPDATE fyp_Evidence SET evidStatus_ID = '$evidStatus' WHERE fyp_Evidence.evidence_ID = '$evidID'");
        return $query;
    }

    public function updateDelStatus($delID, $delStatus) {
        $query = $this->db->query("UPDATE fyp_Deliverable SET delStatus_ID = '$delStatus' WHERE deliverable_ID = '$delID'");
        return $query;
    }

    public function downloadFeedbackFile() {
        //downloading of feedback file on server
    }

    function getFeedbackID() {
        return $this->feedbackID;
    }

    function getFeedbackDate() {
        return $this->feedbackDate;
    }

    function setFeedbackID($feedbackID) {
        $this->feedbackID = $feedbackID;
    }

    function setFeedbackDate($feedbackDate) {
        $this->feedbackDate = $feedbackDate;
    }

}
