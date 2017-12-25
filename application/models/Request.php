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
