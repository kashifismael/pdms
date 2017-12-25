<?php

class DeadlineRequest extends Request {

    private $requestedDeadlineDate;

    function __construct() {
        parent::__construct();
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

}
