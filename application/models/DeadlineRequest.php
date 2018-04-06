<?php

class DeadlineRequest extends Request {

    private $currentDeadlineDate;
    private $requestedDeadlineDate;

    function __construct() {
        parent::__construct();
    }

    public function deadlineRequestConstructor($reqID, $delID, $currDeadline, $reqDeadline, $studentName, $delName, $reason, $stuUsername) {
        $deadlineRequest = new DeadlineRequest();
        $deadlineRequest->setRequestNo($reqID);
        $deadlineRequest->setDeliverableNo($delID);
        $deadlineRequest->setCurrentDeadlineDate($currDeadline);
        $deadlineRequest->setRequestedDeadlineDate($reqDeadline);
        $deadlineRequest->setStudentName($studentName);
        $deadlineRequest->setDeliverableName($delName);
        $deadlineRequest->setReason($reason);
        $deadlineRequest->setStudentUsername($stuUsername);
        return $deadlineRequest;
    }

    public function deadlineRequestConstructorTwo($reqDeadline, $reason, $submitted, $status) {
        $deadlineRequest = new DeadlineRequest();
        $deadlineRequest->setRequestedDeadlineDate($reqDeadline);
        $deadlineRequest->setReason($reason);
        $deadlineRequest->setDateOfRequest($submitted);
        $deadlineRequest->setRequestStatus($status);
        return $deadlineRequest;
    }

    function getCurrentDeadlineDate() {
        return $this->currentDeadlineDate;
    }

    function setCurrentDeadlineDate($currentDeadlineDate) {
        $this->currentDeadlineDate = $currentDeadlineDate;
    }

    function getRequestedDeadlineDate() {
        return $this->requestedDeadlineDate;
    }

    function setRequestedDeadlineDate($requestedDeadlineDate) {
        $this->requestedDeadlineDate = $requestedDeadlineDate;
    }

    function formattedCurrentDeadline() {
        $datetime = new DateTime($this->currentDeadlineDate);
        return date_format($datetime, 'G:ia - D j M');
    }

    function formattedRequestedDeadline() {
        $datetime = new DateTime($this->requestedDeadlineDate);
        return date_format($datetime, 'G:ia - D j M');
    }

    public function countAllRequests($staffID) {
        $query = "SELECT fyp_Request.request_ID
                    FROM `fyp_Request` 
                    INNER JOIN fyp_Deliverable ON fyp_Request.deliverable_ID = fyp_Deliverable.deliverable_ID
                    INNER JOIN fyp_Student ON fyp_Deliverable.student_ID = fyp_Student.student_ID
                    INNER JOIN fyp_User ON fyp_Student.user_ID = fyp_User.user_ID
                    WHERE fyp_Request.requestStatus_ID = 1 AND
                    fyp_Request.requestType_ID = 2 AND
                    fyp_Student.staff_ID = '$staffID'";
        $result = $this->db->query($query);
        return $result->num_rows();
    }

    public function insertDeadlineRequest($reqDeadlineDate, $reason) {
        $data = array(
            'deliverable_ID' => htmlentities($this->input->post('deliverableID')),
            'requestType_ID' => 2,
            'reqDeadlineDate' => htmlentities($reqDeadlineDate),
            'reason' => htmlentities($reason),
        );
        return $this->db->insert('fyp_Request', $data, TRUE);
    }

    public function performDeadlineApproval($reqID){
        $query = "SELECT `deliverable_ID`, `reqDeadlineDate` FROM `fyp_Request` WHERE `request_ID` = ? ";
        $result = $this->db->query($query, $reqID);
        $requestRow = $result->row();
        return $this->approveDeadlineRequest($reqID, $requestRow->deliverable_ID, $requestRow->reqDeadlineDate);
    }
    
    public function approveDeadlineRequest($reqID, $delID, $newDeadline) {
        //$updateStatus = $this->db->query("UPDATE `fyp_Request` SET `requestStatus_ID` = '2' WHERE `fyp_Request`.`request_ID` = '$reqID'");
        $updateStatus = $this->db->query("UPDATE `fyp_Request` SET `requestStatus_ID` = '2' WHERE `fyp_Request`.`request_ID` = ?", $reqID);
        //$changeDeadline = $this->db->query("UPDATE `fyp_Deliverable` SET `deadlineDate` = '$newDeadline' WHERE `fyp_Deliverable`.`deliverable_ID` = '$delID'");
        $changeDeadline = $this->db->query("UPDATE `fyp_Deliverable` SET `deadlineDate` = ? WHERE `fyp_Deliverable`.`deliverable_ID` = ? ", [$newDeadline, $delID]);
        //$logDateOfApproval = $this->db->query("UPDATE `fyp_Request` SET `dateOfApproval` = Now() WHERE `fyp_Request`.`request_ID` = '$reqID'");
        $logDateOfApproval = $this->db->query("UPDATE `fyp_Request` SET `dateOfApproval` = Now() WHERE `fyp_Request`.`request_ID` = ?", $reqID);
        if ($updateStatus === true && $changeDeadline === true && $logDateOfApproval === true) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllPendingDeadlineRequests($staffID) {
        $requestList = array();
        $query = "SELECT *
                    FROM `fyp_Request` 
                    INNER JOIN fyp_Deliverable ON fyp_Request.deliverable_ID = fyp_Deliverable.deliverable_ID
                    INNER JOIN fyp_Student ON fyp_Deliverable.student_ID = fyp_Student.student_ID
                    INNER JOIN fyp_User ON fyp_Student.user_ID = fyp_User.user_ID
                    WHERE fyp_Request.requestType_ID = 2 AND
                    fyp_Request.requestStatus_ID = 1 AND
                    fyp_Student.staff_ID = '$staffID'";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $deadlineRequest = self::deadlineRequestConstructor($row->request_ID, $row->deliverable_ID, $row->deadlineDate, 
                    $row->reqDeadlineDate, $row->firstName . " " . $row->lastName, 
                    $row->deliverableName, $row->reason, $row->username);
            $requestList[] = $deadlineRequest;
        }
        return $requestList;
    }

    public function getAllDeadlineRequestsOfDeliverable($delID) {
        $requestList = array();
        $query = "SELECT * FROM fyp_Request 
                    INNER JOIN fyp_RequestStatus ON fyp_Request.requestStatus_ID = fyp_RequestStatus.requestStatus_ID 
                    WHERE fyp_Request.deliverable_ID = $delID 
                    and fyp_Request.requestType_ID = 2";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $deadlineRequest = self::deadlineRequestConstructorTwo($row->reqDeadlineDate, $row->reason, $row->dateOfRequest, $row->requestStatusDesc);
            $requestList[] = $deadlineRequest;
        }
        return $requestList;
    }

}
