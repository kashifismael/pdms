<?php

class DeadlineRequest extends Request {

    private $currentDeadlineDate;
    private $requestedDeadlineDate;

    function __construct() {
        parent::__construct();
    }

    public function deadlineRequestConstructor($reqID, $delID, $currDeadline, $reqDeadline, $studentName, $delName, $reason) {
        $deadlineRequest = new DeadlineRequest();
        $deadlineRequest->setRequestNo($reqID);
        $deadlineRequest->setDeliverableNo($delID);
        $deadlineRequest->setCurrentDeadlineDate($currDeadline);
        $deadlineRequest->setRequestedDeadlineDate($reqDeadline);
        $deadlineRequest->setStudentName($studentName);
        $deadlineRequest->setDeliverableName($delName);
        $deadlineRequest->setReason($reason);
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

    public function insertDeadlineRequest($reqDeadlineDate) {
        $data = array(
            'deliverable_ID' => $this->input->post('deliverableID'),
            'requestType_ID' => 2,
            'reqDeadlineDate' => $reqDeadlineDate,
            'reason' => $this->input->post('reason'),
        );
        return $this->db->insert('fyp_Request', $data);
    }

    public function approveDeadlineRequest($reqID, $delID, $newDeadline) {
        $updateStatus = $this->db->query("UPDATE `fyp_Request` SET `requestStatus_ID` = '2' WHERE `fyp_Request`.`request_ID` = '$reqID'");
        $changeDeadline = $this->db->query("UPDATE `fyp_Deliverable` SET `deadlineDate` = '$newDeadline' WHERE `fyp_Deliverable`.`deliverable_ID` = '$delID'");
        $logDateOfApproval = $this->db->query("UPDATE `fyp_Request` SET `dateOfApproval` = Now() WHERE `fyp_Request`.`request_ID` = '$reqID'");
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
            $deadlineRequest = self::deadlineRequestConstructor($row->request_ID, $row->deliverable_ID, $row->deadlineDate, $row->reqDeadlineDate, $row->firstName . " " . $row->lastName, $row->deliverableName, $row->reason);
            $requestList[] = $deadlineRequest;
        }
        return $requestList;
    }

}
