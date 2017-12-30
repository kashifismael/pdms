<?php

class Feedback extends CI_Model {

    private $feedbackID;
    private $feedbackDate;
    private $evidenceID;
    private $evidenceName;
    private $deliverableName;
    private $thumbnail;

    function __construct() {
        parent::__construct();
    }

    public function feedbackConstructor($feedbackID, $feedbackDate) {
        $feedback = new Feedback();
        $feedback->setFeedbackID($feedbackID);
        $feedback->setFeedbackDate($feedbackDate);
        return $feedback;
    }

    public function feedbackConstructorTwo($feedbackID, $feedbackDate, $evidenceID, $evidenceName, $deliverableName, $thumbnail) {
        $feedback = new Feedback();
        $feedback->setFeedbackID($feedbackID);
        $feedback->setFeedbackDate($feedbackDate);
        $feedback->setEvidenceID($evidenceID);
        $feedback->setEvidenceName($evidenceName);
        $feedback->setDeliverableName($deliverableName);
        $feedback->setThumbnail($thumbnail);
        return $feedback;
    }

    public function getAllStudentsFeedbacks($seen, $studentID) {
        $feedbackList = array();
        $query = "SELECT fyp_Feedback.feedback_ID, fyp_Evidence.evidence_ID ,fyp_Deliverable.deliverableName,
            fyp_Evidence.evidenceName ,fyp_Feedback.feedbackDate, fyp_Evidence.thumbnail  
                    FROM `fyp_Feedback` 
                    INNER JOIN fyp_Evidence ON fyp_Evidence.evidence_ID = fyp_Feedback.evidence_ID 
                    INNER JOIN fyp_Deliverable ON fyp_Deliverable.deliverable_ID = fyp_Evidence.deliverable_ID
                    INNER JOIN fyp_Student ON fyp_Student.student_ID = fyp_Deliverable.student_ID
                    WHERE fyp_Student.student_ID = '$studentID'
                    AND fyp_Feedback.hasBeenSeen = '$seen'
                    ORDER BY `fyp_Feedback`.`feedbackDate` DESC";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $feedback = self:: feedbackConstructorTwo($row->feedback_ID, $row->feedbackDate, $row->evidence_ID, $row->evidenceName, $row->deliverableName, $row->thumbnail);
            $feedbackList[] = $feedback;
        }
        return $feedbackList;
    }

    public function countAllUnseenFeedbacks($studentID) {
        $query = "SELECT fyp_Feedback.feedback_ID
                    FROM `fyp_Feedback` 
                    INNER JOIN fyp_Evidence ON fyp_Evidence.evidence_ID = fyp_Feedback.evidence_ID 
                    INNER JOIN fyp_Deliverable ON fyp_Deliverable.deliverable_ID = fyp_Evidence.deliverable_ID
                    INNER JOIN fyp_Student ON fyp_Student.student_ID = fyp_Deliverable.student_ID
                    WHERE fyp_Student.student_ID = '$studentID'
                    AND fyp_Feedback.hasBeenSeen = 0
                    ORDER BY `fyp_Feedback`.`feedbackDate` DESC";
        $result = $this->db->query($query);
        return $result->num_rows();
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

    public function getAllFeedbacksOfEvidence($evidId) {
        $feedbackList = array();
        $query = "SELECT * 
                    FROM `fyp_Feedback` 
                    WHERE evidence_ID = '$evidId' 
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
        $query = $this->db->query("UPDATE fyp_Deliverable SET delStatus_ID = '$delStatus' , lastUpdated = NOW() WHERE deliverable_ID = '$delID'");
        return $query;
    }

    public function downloadFeedbackFile() {
        $feedbackID = $this->input->post('feedbackID');
//        if (self::setFeedbacktoSeen($feedbackID)) {
//            echo "updated successfully";
//        }
        $query = "SELECT * "
                . "FROM `fyp_Feedback` "
                . "WHERE feedback_ID = '$feedbackID'";
        $result = $this->db->query($query);
        $feedbackRow = $result->row();
        $filename = $feedbackRow->filePath;
        $file = base_url('feedbackUploads/' . $filename);
        $file = str_replace(' ', '%20', $file);
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename='" . basename($file) . "'");
        readfile($file);
        exit();
    }

    public function setFeedbacktoSeen($feedback){
        return $this->db->query("UPDATE `fyp_Feedback` SET `hasBeenSeen` = '1' WHERE `fyp_Feedback`.`feedback_ID` = '$feedback'");
        //return $query;
    }
    
    public function getDeliverableInfoForEmail($delID) {
        $query = "SELECT fyp_Deliverable.deliverableName, fyp_User.firstName, fyp_User.emailAddress  
                    FROM `fyp_Deliverable`
                    INNER JOIN fyp_Student ON fyp_Deliverable.student_ID = fyp_Student.student_ID
                    INNER JOIN fyp_User ON fyp_User.user_ID = fyp_Student.user_ID
                    WHERE fyp_Deliverable.deliverable_ID = '$delID'";
        $result = $this->db->query($query);
        return $result->row();
    }

    public function getEvidenceInfoForEmail($evidID) {
        $query = "SELECT fyp_Evidence.evidenceName ,fyp_Deliverable.deliverableName, fyp_User.firstName, fyp_User.emailAddress  
                    FROM `fyp_Evidence`
                    INNER JOIN fyp_Deliverable ON fyp_Evidence.deliverable_ID = fyp_Deliverable.deliverable_ID
                    INNER JOIN fyp_Student ON fyp_Deliverable.student_ID = fyp_Student.student_ID
                    INNER JOIN fyp_User ON fyp_User.user_ID = fyp_Student.user_ID
                    WHERE fyp_Evidence.evidence_ID = '$evidID'";
        $result = $this->db->query($query);
        return $result->row();
    }

    function getThumbnail() {
        return $this->thumbnail;
    }

    function setThumbnail($thumbnail) {
        $this->thumbnail = $thumbnail;
    }

    function getEvidenceID() {
        return $this->evidenceID;
    }

    function getEvidenceName() {
        return $this->evidenceName;
    }

    function getDeliverableName() {
        return $this->deliverableName;
    }

    function setEvidenceID($evidenceID) {
        $this->evidenceID = $evidenceID;
    }

    function setEvidenceName($evidenceName) {
        $this->evidenceName = $evidenceName;
    }

    function setDeliverableName($deliverableName) {
        $this->deliverableName = $deliverableName;
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
