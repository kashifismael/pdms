<?php

class DeleteRequest extends Request {

    function __construct() {
        parent::__construct();
    }

    public function deleteRequestConstructor($reqID, $delID, $studentName, $delName, $reason) {
        $deleteRequest = new DeleteRequest();
        $deleteRequest->setRequestNo($reqID);
        $deleteRequest->setDeliverableNo($delID);
        $deleteRequest->setStudentName($studentName);
        $deleteRequest->setDeliverableName($delName);
        $deleteRequest->setReason($reason);
        return $deleteRequest;
    }

    public function insertDeleteRequest() {
        $data = array(
            'deliverable_ID' => $this->input->post('deliverableID'),
            'requestType_ID' => 1,
            'reason' => $this->input->post('deleteReason'),
        );
        return $this->db->insert('fyp_Request', $data);
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
                    fyp_Student.staff_ID = '$staffID'";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $delRequest = self::deleteRequestConstructor($row->request_ID, $row->deliverable_ID, $row->firstName . " " . $row->lastName, $row->deliverableName, $row->reason);
            $requestList[] = $delRequest;
        }
        return $requestList;
    }
    
}