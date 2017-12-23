<?php

class Evidence extends CI_Model {

    private $evidenceNo;
    private $deliverableNo;
    private $studentID;
    private $evidenceStatus;
    private $submissionDate;
    private $evidenceName;
    private $deliverableName;
    private $studentName;

    function __construct() {
        parent::__construct();
    }

    public function evidenceConstructor($evidNo, $evidStatus, $subDate, $evidName) {
        $evidence = new Evidence();
        $evidence->setEvidenceNo($evidNo);
        $evidence->setEvidenceStatus($evidStatus);
        $evidence->setSubmissionDate($subDate);
        $evidence->setEvidenceName($evidName);
        return $evidence;
    }

    public function evidenceContructorTwo($evidNo, $subDate, $evidName, $delName, $studentName) {
        $evidence = new Evidence();
        $evidence->setEvidenceNo($evidNo);
        $evidence->setSubmissionDate($subDate);
        $evidence->setEvidenceName($evidName);
        $evidence->setDeliverableName($delName);
        $evidence->setStudentName($studentName);
        return $evidence;
    }

    public function getAllEvidencesOfDeliverable($delNo) {
        $evidenceList = array();
        $query = "SELECT * 
                    FROM `fyp_Evidence` 
                    INNER JOIN fyp_EvidenceStatus 
                    ON fyp_Evidence.evidStatus_ID = fyp_EvidenceStatus.evidStatus_ID 
                    WHERE deliverable_ID = '$delNo'"
                . "ORDER BY `fyp_Evidence`.`submissionDate` DESC";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $newEvid = self::evidenceConstructor($row->evidence_ID, 
                    $row->evidStatusDesc, new DateTime($row->submissionDate), $row->evidenceName);
            $evidenceList[] = $newEvid;
        }
        return $evidenceList;
    }

    public function getAllEvidencesForSupervisor($staffID) {
        $evidenceList = array();
        $query = "SELECT *
                    FROM (((((`fyp_Evidence`
                    INNER JOIN fyp_Deliverable ON fyp_Deliverable.deliverable_ID = fyp_Evidence.deliverable_ID)
                    INNER JOIN fyp_Student ON fyp_Deliverable.student_ID = fyp_Student.student_ID)
                    INNER JOIN fyp_User ON fyp_User.user_ID = fyp_Student.user_ID)
                    INNER JOIN fyp_Staff ON fyp_Student.staff_ID = fyp_Staff.staff_ID)
                    INNER JOIN fyp_EvidenceStatus ON fyp_Evidence.evidStatus_ID = fyp_EvidenceStatus.evidStatus_ID)
                    WHERE fyp_Staff.staff_ID = '$staffID' AND fyp_Evidence.evidStatus_ID = 1
                    ORDER BY `fyp_Evidence`.`submissionDate` DESC";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $newEvid = self::evidenceContructorTwo($row->evidence_ID, new DateTime($row->submissionDate), 
                    $row->evidenceName, $row->deliverableName, $row->firstName . " " . $row->lastName);
            $evidenceList[] = $newEvid;
        }
        return $evidenceList;
    }

    public function getOneEvidence($evidID){
        $query = "SELECT * 
                    FROM `fyp_Evidence` 
                    INNER JOIN fyp_Deliverable ON fyp_Deliverable.deliverable_ID = fyp_Evidence.deliverable_ID 
                    INNER JOIN fyp_EvidenceStatus ON fyp_EvidenceStatus.evidStatus_ID = fyp_Evidence.evidStatus_ID
                    INNER JOIN fyp_Student ON fyp_Deliverable.student_ID = fyp_Student.student_ID
                    INNER JOIN fyp_User ON fyp_User.user_ID = fyp_Student.user_ID
                    WHERE evidence_ID = '$evidID'";
        $result = $this->db->query($query);
        $row = $result->row();
        $evidence = self::evidenceConstructor($row->evidence_ID, $row->evidStatusDesc, 
                new DateTime($row->submissionDate), $row->evidenceName);
        $evidence->setDeliverableNo($row->deliverable_ID);
        $evidence->setDeliverableName($row->deliverableName);
        $evidence->setStudentID($row->username);
        return $evidence;
    }
    
    public function uploadEvidenceFile($fileName, $file_tmp) {
        $newFileName = uniqid('', true) . $this->session->userName . $fileName;
        $fileDestination = "evidenceUploads/" . $newFileName;
        if (move_uploaded_file($file_tmp, $fileDestination)) {
            $insert = self::insertFileRecord($newFileName);
            $delID = $this->input->post('deliverableID');
            $update = $this->db->query("UPDATE fyp_Deliverable SET lastUpdated = NOW() WHERE deliverable_ID = '$delID' ");
        } else {
            echo "file upload didnt work";
        }
        if ($insert === true && $update === true) {
            return true;
        }
    }

    public function insertFileRecord($newFileName) {
        $data = array(
            'deliverable_ID' => $this->input->post('deliverableID'),
            'evidStatus_ID' => 1,
            'evidenceName' => $this->input->post('evidenceName'),
            'filePath' => $newFileName,
        );
        return $this->db->insert('fyp_Evidence', $data);
    }

    public function downloadEvidenceFile() {
        $evidID = $this->input->post('evidID');
        $query = "SELECT filePath 
                    FROM `fyp_Evidence` 
                    WHERE evidence_ID = '$evidID'";
        $result = $this->db->query($query);
        $evidenceRow = $result->row();
        $filename = $evidenceRow->filePath;
        $file = base_url('evidenceUploads/' . $filename);
        $file = str_replace(' ', '%20', $file);
        header("Content-Description: File Transfer"); 
        header("Content-Type: application/octet-stream"); 
        header("Content-Disposition: attachment; filename='" . basename($file) . "'"); 
        readfile ($file);
        exit();
    }

    function getStudentID() {
        return $this->studentID;
    }

    function setStudentID($studentID) {
        $this->studentID = $studentID;
    }
       
    function getDeliverableName() {
        return $this->deliverableName;
    }

    function getStudentName() {
        return $this->studentName;
    }

    function setDeliverableName($deliverableName) {
        $this->deliverableName = $deliverableName;
    }

    function setStudentName($studentName) {
        $this->studentName = $studentName;
    }

    function getEvidenceNo() {
        return $this->evidenceNo;
    }

    function getDeliverableNo() {
        return $this->deliverableNo;
    }

    function getEvidenceStatus() {
        return $this->evidenceStatus;
    }

    function getSubmissionDate() {
        return $this->submissionDate;
    }

    function getEvidenceName() {
        return $this->evidenceName;
    }

    function setEvidenceNo($evidenceNo) {
        $this->evidenceNo = $evidenceNo;
    }

    function setDeliverableNo($deliverableNo) {
        $this->deliverableNo = $deliverableNo;
    }

    function setEvidenceStatus($evidenceStatus) {
        $this->evidenceStatus = $evidenceStatus;
    }

    function setSubmissionDate($submissionDate) {
        $this->submissionDate = $submissionDate;
    }

    function setEvidenceName($evidenceName) {
        $this->evidenceName = $evidenceName;
    }

}
