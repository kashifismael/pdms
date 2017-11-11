<?php

class Deliverable extends CI_Model {

    private $deliverableNo;
    private $studentID;
    private $delStatusNo;
    private $deliverableName;
    private $deadlineDate;
    
        function __construct() {
        parent::__construct();
    }
    
    public function insertDeliverable($deadlineDate){
            $delData = array(
            'student_ID' => $this->session->secondaryID,
            'deliverableName' => $this->input->post('delName'),
            'deadlineDate' => $deadlineDate,
        );
        $this->session->set_userdata('deliverableCreation', 'success');
        return $this->db->insert('fyp_Deliverable', $delData);
    }
    
}
