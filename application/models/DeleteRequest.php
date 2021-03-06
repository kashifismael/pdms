<?php

class DeleteRequest extends Request {

    function __construct() {
        parent::__construct();
    }

    public function deleteRequestConstructor($reqID, $delID, $studentName, $delName, $reason, $stuUsername) {
        $deleteRequest = new DeleteRequest();
        $deleteRequest->setRequestNo($reqID);
        $deleteRequest->setDeliverableNo($delID);
        $deleteRequest->setStudentName($studentName);
        $deleteRequest->setDeliverableName($delName);
        $deleteRequest->setReason($reason);
        $deleteRequest->setStudentUsername($stuUsername);
        return $deleteRequest;
    }

    public function deleteRequestContructorTwo($reason, $dateOfRequest, $status) {
        $deleteRequest = new DeleteRequest();
        $deleteRequest->setReason($reason);
        $deleteRequest->setDateOfRequest($dateOfRequest);
        $deleteRequest->setRequestStatus($status);
        return $deleteRequest;
    }

    public function countAllRequests($staffID) {
        $query = "SELECT fyp_Request.request_ID
                    FROM `fyp_Request` 
                    INNER JOIN fyp_Deliverable ON fyp_Request.deliverable_ID = fyp_Deliverable.deliverable_ID
                    INNER JOIN fyp_Student ON fyp_Deliverable.student_ID = fyp_Student.student_ID
                    INNER JOIN fyp_User ON fyp_Student.user_ID = fyp_User.user_ID
                    WHERE fyp_Request.requestStatus_ID = 1 AND
                    fyp_Request.requestType_ID = 1 AND
                    fyp_Student.staff_ID = ? ";
        $result = $this->db->query($query, $staffID);
        return $result->num_rows();
    }

    public function insertDeleteRequest() {
        $data = array(
            'deliverable_ID' => htmlentities($this->input->post('deliverableID')),
            'requestType_ID' => 1,
            'reason' => htmlentities($this->input->post('deleteReason')),
        );
        return $this->db->insert('fyp_Request', $data, TRUE);
    }

    public function getAllPendingDeleteRequests($staffID) {
        $requestList = array();
        $query = "SELECT *
                    FROM `fyp_Request` 
                    INNER JOIN fyp_Deliverable ON fyp_Request.deliverable_ID = fyp_Deliverable.deliverable_ID
                    INNER JOIN fyp_Student ON fyp_Deliverable.student_ID = fyp_Student.student_ID
                    INNER JOIN fyp_User ON fyp_Student.user_ID = fyp_User.user_ID
                    WHERE fyp_Request.requestType_ID = 1 AND
                    fyp_Request.requestStatus_ID = 1 AND
                    fyp_Student.staff_ID = ? ";
        $result = $this->db->query($query, $staffID);
        foreach ($result->result() as $row) {
            $delRequest = self::deleteRequestConstructor($row->request_ID, $row->deliverable_ID, $row->firstName . " " . $row->lastName,
                    $row->deliverableName, $row->reason, $row->username);
            $requestList[] = $delRequest;
        }
        return $requestList;
    }

    public function approveDeleteRequest($reqID) {
        $query = "SELECT `deliverable_ID` FROM `fyp_Request` WHERE request_ID = ? ";
        $result = $this->db->query($query, $reqID);
        $requestRow = $result->row();
        //$newQuery = "UPDATE fyp_Deliverable SET `isInactive` = '1' WHERE deliverable_ID = ? ";
        $delete = $this->db->query("UPDATE fyp_Deliverable SET `isInactive` = '1' WHERE deliverable_ID = ? ", $requestRow->deliverable_ID);
        $updateStatus = $this->db->query("UPDATE `fyp_Request` SET `requestStatus_ID` = '2' WHERE `fyp_Request`.`request_ID` = ? ", $reqID);
        $logDateOfApproval = $this->db->query("UPDATE `fyp_Request` SET `dateOfApproval` = Now() WHERE `fyp_Request`.`request_ID` = ? ", $reqID);
        if ($updateStatus === true && $delete === true && $logDateOfApproval === true) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllDeleteRequestsOfDeliverable($delID) {
        $requestList = array();
        $query = "SELECT * FROM fyp_Request 
                    INNER JOIN fyp_RequestStatus ON fyp_Request.requestStatus_ID = fyp_RequestStatus.requestStatus_ID 
                    WHERE fyp_Request.deliverable_ID = ? 
                    and fyp_Request.requestType_ID = 1";
        $result = $this->db->query($query, $delID);
        foreach ($result->result() as $row) {
            $deleteRequest = self::deleteRequestContructorTwo($row->reason, $row->dateOfRequest, $row->requestStatusDesc);
            $requestList[] = $deleteRequest;
        }
        return $requestList;
    }

}
