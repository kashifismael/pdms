<?php

class DeadlineRequest extends Request {

    private $currentDeadlineDate;
    private $requestedDeadlineDate;

    function __construct() {
        parent::__construct();
    }
    
    public function deleteRequestConstructor($reqID, $delID, $currDeadline, $reqDeadline, $studentName, $delName ,$reason){
        $delRequest = new DeadlineRequest();
        $delRequest->setRequestNo($reqID);
        $delRequest->setDeliverableNo($delID);
        $delRequest->setCurrentDeadlineDate($currDeadline);
        $delRequest->setRequestedDeadlineDate($reqDeadline);
        $delRequest->setStudentName($studentName);
        $delRequest->setDeliverableName($delName);
        $delRequest->setReason($reason);
        return $delRequest;
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

    public function insertDeadlineRequest($reqDeadlineDate) {
        $data = array(
            'deliverable_ID' => $this->input->post('deliverableID'),
            'requestType_ID' => 2,
            'reqDeadlineDate' => $reqDeadlineDate,
            'reason' => $this->input->post('reason'),
        );
        return $this->db->insert('fyp_Request', $data);
    }

    public function getAllPendingDeleteRequests($staffID){
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
        foreach ($result->result() as $row){
            $delRequest = self::deleteRequestConstructor($row->request_ID, 
                    $row->deliverable_ID, $row->deadlineDate, $row->reqDeadlineDate,
                    $row->firstName." ".$row->lastName, $row->deliverableName,
                    $row->reason);
            $requestList[] = $delRequest;
        }     
        return $requestList;
    }
    
}
