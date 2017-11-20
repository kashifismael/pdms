<?php

class Evidence extends CI_Model {

    private $evidenceNo;
    private $deliverableNo;
    private $evidenceStatus;
    private $submissionDate;
    private $evidenceName;
    
    function __construct() {
        parent::__construct();
    }

    public function evidenceConstructor($evidNo, $evidStatus, $subDate, $evidName){
        $evidence = new Evidence();
        $evidence->setEvidenceNo($evidNo);
        $evidence->setEvidenceStatus($evidStatus);
        $evidence->setSubmissionDate($subDate);
        $evidence->setEvidenceName($evidName);
        return $evidence;
    }
    
    public function getAllEvidencesOfDeliverable($delNo){
        $evidenceList = array();
        $query = "SELECT * 
                    FROM `fyp_Evidence` 
                    INNER JOIN fyp_EvidenceStatus 
                    ON fyp_Evidence.evidStatus_ID = fyp_EvidenceStatus.evidStatus_ID 
                    WHERE deliverable_ID = '$delNo'";
        $result = $this->db->query($query);
        foreach($result->result() as $row){
            $newEvid = self::evidenceConstructor($row->evidence_ID, $row->evidStatusDesc, 
                    new DateTime($row->submissionDate), $row->evidenceName);
            $evidenceList[] = $newEvid;
        }
        return $evidenceList;
    }
    
    public function uploadEvidenceFile($fileName, $file_tmp) {
        $newFileName = uniqid('', true) . $this->session->userName . $fileName;
        $fileDestination = "evidenceUploads/" . $newFileName;
        if (move_uploaded_file($file_tmp, $fileDestination)) {
            //echo "<p>file upload successful </p>";
            $insert = self::insertFileRecord($newFileName);
        } else {
            echo "file upload didnt work";
        }
        if($insert === true){
            //echo "<p>record insert successful </p>";
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
