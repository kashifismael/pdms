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

    function __construct() {
        parent::__construct();
    }

    public function requestConstructor($delID, $delName, $reqType, $dateOfRequest, $reason) {
        $request = new Request();
        $request->setDeliverableNo($delID);
        $request->setDeliverableName($delName);
        $request->setRequestType($reqType);
        $request->setDateOfRequest($dateOfRequest);
        $request->setReason($reason);
        return $request;
    }

    public function requestConstructorTwo($delID, $delName, $reqType, $reqStatus) {
        $request = new Request();
        $request->setDeliverableNo($delID);
        $request->setDeliverableName($delName);
        $request->setRequestType($reqType);
        $request->setRequestStatus($reqStatus);
        return $request;
    }

    public function rejectRequest($reqID) {
        $query = $this->db->query("UPDATE `fyp_Request` SET `requestStatus_ID` = '3' WHERE `fyp_Request`.`request_ID` = '$reqID'");
        return $query;
    }

    public function getRequestInfoForEmail($reqID) {
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

    public function countAllRequests($staffID) {
        $query = "SELECT fyp_Request.request_ID
                    FROM `fyp_Request` 
                    INNER JOIN fyp_Deliverable ON fyp_Request.deliverable_ID = fyp_Deliverable.deliverable_ID
                    INNER JOIN fyp_Student ON fyp_Deliverable.student_ID = fyp_Student.student_ID
                    INNER JOIN fyp_User ON fyp_Student.user_ID = fyp_User.user_ID
                    WHERE fyp_Request.requestStatus_ID = 1 AND
                    fyp_Student.staff_ID = '$staffID'";
        $result = $this->db->query($query);
        return $result->num_rows();
    }

    public function countAllRequestResponsesForOneStudent($studentID) {
        $query =  self::getAllUnseenRequestsQuery($studentID);
        $result = $this->db->query($query);
        return $result->num_rows();
    }

    public function getAllUnseenRequestIDs($studentID){
        $query =  self::getAllUnseenRequestsQuery($studentID);
        $result = $this->db->query($query);
        return $result->result();
    }
    
    public function setUnseenRequestsToSeen($unseenrequests){
        foreach ($unseenrequests as $request){
            $this->db->query("UPDATE `fyp_Request` SET `hasBeenSeen` = '1' WHERE `fyp_Request`.`request_ID` = '$request->request_ID'");
        }
    }
    
    private function getAllUnseenRequestsQuery($studentID) {
        $query = "SELECT fyp_Request.request_ID
                    FROM `fyp_Request` 
                    INNER JOIN fyp_RequestStatus ON fyp_Request.requestStatus_ID = fyp_RequestStatus.requestStatus_ID
                    INNER JOIN fyp_RequestType ON fyp_RequestType.requestType_ID = fyp_Request.requestType_ID
                    INNER JOIN fyp_Deliverable ON fyp_Request.deliverable_ID = fyp_Deliverable.deliverable_ID
                    INNER JOIN fyp_Student ON fyp_Deliverable.student_ID = fyp_Student.student_ID
                    WHERE fyp_Request.hasBeenSeen = 0 AND 
                    fyp_Student.student_ID = '$studentID' AND 
                    (fyp_Request.requestStatus_ID = 2 OR fyp_Request.requestStatus_ID = 3)";
        return $query;
    }

    public function getAllPendingRequestsOfStudent($studentID) {
        $requestList = array();
        $query = "SELECT fyp_Request.deliverable_ID, fyp_Deliverable.deliverableName ,fyp_Request.requestStatus_ID, fyp_RequestType.requestTypeDesc, fyp_Request.dateOfRequest, fyp_Request.reason
                    FROM `fyp_Request` 
                    INNER JOIN fyp_RequestStatus ON fyp_Request.requestStatus_ID = fyp_RequestStatus.requestStatus_ID
                    INNER JOIN fyp_RequestType ON fyp_RequestType.requestType_ID = fyp_Request.requestType_ID
                    INNER JOIN fyp_Deliverable ON fyp_Request.deliverable_ID = fyp_Deliverable.deliverable_ID
                    INNER JOIN fyp_Student ON fyp_Deliverable.student_ID = fyp_Student.student_ID
                    WHERE fyp_Request.requestStatus_ID = 1 AND
                    fyp_Student.student_ID = '$studentID'
                    ORDER BY `fyp_Request`.`dateOfRequest` ASC";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $request = self::requestConstructor($row->deliverable_ID, $row->deliverableName, $row->requestTypeDesc, $row->dateOfRequest, $row->reason);
            $requestList[] = $request;
        }
        return $requestList;
    }

    public function getAllRequestResponses($studentID) {
        $requestList = array();
        $query = "SELECT fyp_Request.deliverable_ID, fyp_Deliverable.deliverableName ,fyp_Request.requestStatus_ID, fyp_RequestType.requestTypeDesc, fyp_Request.dateOfRequest,fyp_RequestStatus.requestStatusDesc
                    FROM `fyp_Request` 
                    INNER JOIN fyp_RequestStatus ON fyp_Request.requestStatus_ID = fyp_RequestStatus.requestStatus_ID
                    INNER JOIN fyp_RequestType ON fyp_RequestType.requestType_ID = fyp_Request.requestType_ID
                    INNER JOIN fyp_Deliverable ON fyp_Request.deliverable_ID = fyp_Deliverable.deliverable_ID
                    INNER JOIN fyp_Student ON fyp_Deliverable.student_ID = fyp_Student.student_ID
                    WHERE (fyp_Request.requestStatus_ID = 2 OR fyp_Request.requestStatus_ID = 3)
                    AND fyp_Student.student_ID = '$studentID'
                    ORDER BY `fyp_Request`.`dateOfRequest` ASC";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $request = self::requestConstructorTwo($row->deliverable_ID, $row->deliverableName, $row->requestTypeDesc, $row->requestStatusDesc);
            $requestList[] = $request;
        }
        return $requestList;
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
