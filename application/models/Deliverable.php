<?php

class Deliverable extends CI_Model {

    private $deliverableNo;
    private $studentID;
    private $delStatusNo;
    private $delstatusDesc;
    private $deliverableName;
    private $deadlineDate;

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

    public function getAllStudentDeilverables($studentID) {
        $deliverableList = array();
        $query = "SELECT deliverable_ID , deliverableName, deadlineDate, delStatusDesc
                    FROM (((`fyp_Deliverable` 
                    INNER JOIN fyp_DeliverableStatus ON fyp_DeliverableStatus.delStatus_ID = fyp_Deliverable.delStatus_ID) 
                    INNER JOIN fyp_Student ON fyp_Student.student_ID = fyp_Deliverable.student_ID) 
                    INNER JOIN fyp_User ON fyp_Student.user_ID = fyp_User.user_ID) 
                    WHERE fyp_Deliverable.student_ID = '$studentID'"
                . "ORDER BY `fyp_Deliverable`.`deadlineDate` ASC";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $newDel = self::deliverableConstructor($row->deliverable_ID, $row->delStatusDesc, $row->deliverableName,
                    new DateTime($row->deadlineDate));
            $deliverableList[] = $newDel;
        }
        return $deliverableList;
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
