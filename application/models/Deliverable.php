<?php

class Deliverable extends CI_Model {

    private $deliverableNo;
    private $studentID;
    private $delStatusNo;
    private $delstatusDesc;
    private $deliverableName;
    private $deadlineDate;
    private $studentName;

    function __construct() {
        parent::__construct();
    }

    public function deliverableConstructor($delNo, $statusDesc, $delName, $deadlineDate) {
        $deliverable = new Deliverable();
        $deliverable->setDeliverableNo($delNo);
        $deliverable->setDelstatusDesc($statusDesc);
        $deliverable->setDeliverableName($delName);
        $deliverable->setDeadlineDate($deadlineDate);
        return $deliverable;
    }

    public function getAllStudentDeliverables($username) {
        $deliverableList = array();
        $query = "SELECT deliverable_ID , deliverableName, deadlineDate, delStatusDesc
                    FROM (((`fyp_Deliverable` 
                    INNER JOIN fyp_DeliverableStatus ON fyp_DeliverableStatus.delStatus_ID = fyp_Deliverable.delStatus_ID) 
                    INNER JOIN fyp_Student ON fyp_Student.student_ID = fyp_Deliverable.student_ID) 
                    INNER JOIN fyp_User ON fyp_Student.user_ID = fyp_User.user_ID) 
                    WHERE fyp_User.username = '$username'"
                . "ORDER BY `fyp_Deliverable`.`deadlineDate` ASC";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $newDel = self::deliverableConstructor($row->deliverable_ID, $row->delStatusDesc, $row->deliverableName,
                    new DateTime($row->deadlineDate));
            $deliverableList[] = $newDel;
        }
        return $deliverableList;
    }

    public function getOneDeliverable($deliverableID){
        $query = "SELECT * "
                . "FROM (((`fyp_Deliverable` "
                . "INNER JOIN fyp_DeliverableStatus ON fyp_Deliverable.delStatus_ID = fyp_DeliverableStatus.delStatus_ID) "
                . "INNER JOIN fyp_Student ON fyp_Student.student_ID = fyp_Deliverable.student_ID)
                   INNER JOIN fyp_User ON fyp_Student.user_ID = fyp_User.user_ID)"
                . "WHERE deliverable_ID = '$deliverableID'";
        $result = $this->db->query($query);
        $deliverableRow = $result->row();
        $deliverableInfo = self::deliverableConstructor($deliverableRow->deliverable_ID, $deliverableRow->delStatusDesc, $deliverableRow->deliverableName,
                    new DateTime($deliverableRow->deadlineDate));
        $deliverableInfo->setStudentName($deliverableRow->firstName." ".$deliverableRow->lastName);
        $deliverableInfo->setStudentID($deliverableRow->username);
        return $deliverableInfo;
    }
    
    public function insertDeliverable($deadlineDate) {
        $delData = array(
            'student_ID' => $this->session->secondaryID,
            'deliverableName' => $this->input->post('delName'),
            'deadlineDate' => $deadlineDate,
        );
        $this->session->set_userdata('deliverableCreation', 'success');
        return $this->db->insert('fyp_Deliverable', $delData);
    }
    
    public function listStatusOptions(){
        $query = "SELECT delStatus_ID, delStatusDesc FROM `fyp_DeliverableStatus`";
        return $this->db->query($query);
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
