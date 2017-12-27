<?php

class Request extends CI_Model {

    private $requestNo;
    private $deliverableNo;
    private $deliverableName;
    private $studentName;
    private $requestStatus;
    private $requestType;
    private $reason;
    private $dateOfRequest;
    private $dateOfApproval;
    
    public function rejectRequest($reqID){
        $query = $this->db->query("UPDATE `fyp_Request` SET `requestStatus_ID` = '3' WHERE `fyp_Request`.`request_ID` = '$reqID'");
        return $query;
    }
    
    public function getRequestInfoForEmail($reqID){
        $query = "SELECT fyp_Deliverable.deliverableName, fyp_User.firstName, fyp_User.emailAddress, 
                    fyp_RequestType.requestTypeDesc ,fyp_RequestStatus.requestStatusDesc
                    FROM fyp_Request
                    INNER JOIN fyp_RequestType ON fyp_Request.requestType_ID = fyp_RequestType.requestType_ID
                    INNER JOIN fyp_RequestStatus ON fyp_Request.requestStatus_ID = fyp_RequestStatus.requestStatus_ID
                    INNER JOIN fyp_Deliverable ON fyp_Request.deliverable_ID = fyp_Deliverable.deliverable_ID
                    INNER JOIN fyp_Student ON fyp_Deliverable.student_ID = fyp_Student.student_ID
                    INNER JOIN fyp_User ON fyp_User.user_ID = fyp_Student.user_ID
                    WHERE fyp_Request.request_ID = '$reqID'";
        $result = $this->db->query($query);
        return $result->row();
    }
    
    function __construct() {
        parent::__construct();
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

        
    function getRequestNo() {
        return $this->requestNo;
    }

    function getDeliverableNo() {
        return $this->deliverableNo;
    }

    function getRequestStatus() {
        return $this->requestStatus;
    }

    function getRequestType() {
        return $this->requestType;
    }

    function getReason() {
        return $this->reason;
    }

    function getDateOfRequest() {
        return $this->dateOfRequest;
    }

    function getDateOfApproval() {
        return $this->dateOfApproval;
    }

    function setRequestNo($requestNo) {
        $this->requestNo = $requestNo;
    }

    function setDeliverableNo($deliverableNo) {
        $this->deliverableNo = $deliverableNo;
    }

    function setRequestStatus($requestStatus) {
        $this->requestStatus = $requestStatus;
    }

    function setRequestType($requestType) {
        $this->requestType = $requestType;
    }

    function setReason($reason) {
        $this->reason = $reason;
    }

    function setDateOfRequest($dateOfRequest) {
        $this->dateOfRequest = $dateOfRequest;
    }

    function setDateOfApproval($dateOfApproval) {
        $this->dateOfApproval = $dateOfApproval;
    }


    
    
}
