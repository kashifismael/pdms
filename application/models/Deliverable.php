<?php

class Deliverable extends CI_Model {

    private $deliverableNo;
    private $studentID;
    private $delStatusNo;
    private $delstatusDesc;
    private $deliverableName;
    private $deadlineDate;
    private $studentName;
    private $lastUpdatedDate;
    private $thumbnail;

    function __construct() {
        parent::__construct();
    }

    public function deliverableConstructor($delNo, $statusDesc, $delName, $deadlineDate) {
        $deliverable = new Deliverable();
        $deliverable->setDeliverableNo($delNo);
        $deliverable->setDelstatusDesc($statusDesc);
        $deliverable->setDeliverableName($delName);
        $deliverable->setDeadlineDate($deadlineDate);
        //$deliverable->setLastUpdated($lastUpdated);
        return $deliverable;
    }

    public function getAllStudentDeliverables($username) {
        $deliverableList = array();
        $query = "SELECT deliverable_ID , deliverableName, deadlineDate, delStatusDesc, lastUpdated, thumbnail
                    FROM (((`fyp_Deliverable` 
                    INNER JOIN fyp_DeliverableStatus ON fyp_DeliverableStatus.delStatus_ID = fyp_Deliverable.delStatus_ID) 
                    INNER JOIN fyp_Student ON fyp_Student.student_ID = fyp_Deliverable.student_ID) 
                    INNER JOIN fyp_User ON fyp_Student.user_ID = fyp_User.user_ID) 
                    WHERE fyp_User.username = ? ";
        if (isset($_GET['sort']) && $_GET['sort'] == "deadline") {
            $query = $query . "ORDER BY `fyp_Deliverable`.`deadlineDate` ASC";
        } else {
            $query = $query . " ORDER BY `fyp_Deliverable`.`lastUpdated` DESC";
        }
        $result = $this->db->query($query, $username);
        foreach ($result->result() as $row) {
            $newDel = self::deliverableConstructor($row->deliverable_ID, $row->delStatusDesc, $row->deliverableName, new DateTime($row->deadlineDate));
            $newDel->setLastUpdated($row->lastUpdated);
            $newDel->setThumbnail($row->thumbnail);
            $deliverableList[] = $newDel;
        }
        return $deliverableList;
    }

    public function getOneDeliverable($deliverableID) {
        $query = "SELECT * "
                . "FROM (((`fyp_Deliverable` "
                . "INNER JOIN fyp_DeliverableStatus ON fyp_Deliverable.delStatus_ID = fyp_DeliverableStatus.delStatus_ID) "
                . "INNER JOIN fyp_Student ON fyp_Student.student_ID = fyp_Deliverable.student_ID)
                   INNER JOIN fyp_User ON fyp_Student.user_ID = fyp_User.user_ID)"
                . "WHERE deliverable_ID = '$deliverableID'";
        $result = $this->db->query($query);
        $deliverableRow = $result->row();
        $deliverableInfo = self::deliverableConstructor($deliverableRow->deliverable_ID, $deliverableRow->delStatusDesc, $deliverableRow->deliverableName, new DateTime($deliverableRow->deadlineDate));
        $deliverableInfo->setStudentName($deliverableRow->firstName . " " . $deliverableRow->lastName);
        $deliverableInfo->setStudentID($deliverableRow->username);
        $deliverableInfo->setLastUpdated($deliverableRow->lastUpdated);
        return $deliverableInfo;
    }

    public function getAverageScoreOfOneStudent($username){
        $query = "SELECT ROUND(AVG(delStatusScore)*100, 2) AS avgScore
                    FROM fyp_Deliverable 
                    INNER JOIN fyp_Student ON fyp_Student.student_ID = fyp_Deliverable.student_ID 
                    INNER JOIN fyp_User ON fyp_User.user_ID = fyp_Student.user_ID 
                    INNER JOIN fyp_DeliverableStatus ON fyp_DeliverableStatus.delStatus_ID = fyp_Deliverable.delStatus_ID 
                    WHERE fyp_User.username = ? ";
        $result = $this->db->query($query, $username);
        $row = $result->row();
        return $row->avgScore;
    }
    
    public function insertDeliverable($deadlineDate) {
        $delData = array(
            'student_ID' => htmlentities($this->session->secondaryID),
            'deliverableName' => htmlentities($this->input->post('delName')),
            'deadlineDate' => htmlentities($deadlineDate),
            'thumbnail' => "thumbnail".rand(1,13).".jpg",
        );
        $this->session->set_userdata('deliverableCreation', 'success');
        return $this->db->insert('fyp_Deliverable', $delData, TRUE);
    }

    public function checkStudentAgainstDeliverable($delID) {
        $studentID = $this->session->secondaryID;
        $query = $this->db->query("SELECT * FROM `fyp_Deliverable` WHERE deliverable_ID = '$delID' and student_ID = '$studentID'");
        return $query;
    }

    public function listStatusOptions() {
        $query = "SELECT delStatus_ID, delStatusDesc FROM `fyp_DeliverableStatus`";
        return $this->db->query($query);
    }

    function getThumbnail() {
        return $this->thumbnail;
    }

    function setThumbnail($thumbnail) {
        $this->thumbnail = $thumbnail;
    }
    
    function getLastUpdated() {
        return $this->lastUpdatedDate;
    }

    function setLastUpdated($lastUpdatedDate) {
        $this->lastUpdatedDate = $lastUpdatedDate;
    }

    function getStudentName() {
        return $this->studentName;
    }

    function setStudentName($studentName) {
        $this->studentName = $studentName;
    }

    function getDeliverableNo() {
        return $this->deliverableNo;
    }

    function getStudentID() {
        return $this->studentID;
    }

    function getDelStatusNo() {
        return $this->delStatusNo;
    }

    function getDelstatusDesc() {
        return $this->delstatusDesc;
    }

    function getDeliverableName() {
        return $this->deliverableName;
    }

    function getDeadlineDate() {
        return $this->deadlineDate;
    }

    function setDeliverableNo($deliverableNo) {
        $this->deliverableNo = $deliverableNo;
    }

    function setStudentID($studentID) {
        $this->studentID = $studentID;
    }

    function setDelStatusNo($delStatusNo) {
        $this->delStatusNo = $delStatusNo;
    }

    function setDelstatusDesc($delstatusDesc) {
        $this->delstatusDesc = $delstatusDesc;
    }

    function setDeliverableName($deliverableName) {
        $this->deliverableName = $deliverableName;
    }

    function setDeadlineDate($deadlineDate) {
        $this->deadlineDate = $deadlineDate;
    }

}
