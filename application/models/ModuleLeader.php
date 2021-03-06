<?php

class ModuleLeader extends Supervisor {

    public function getAllUnallocatedStudents() {
        $unallocatedStudents = array();
        $result = self::unallocatedStudentsQuery();
        foreach ($result->result() as $row) {
            $student = Student::studentConstructor($row->student_ID, $row->firstName, $row->lastName, $row->username);
            $unallocatedStudents[] = $student;
        }
        return $unallocatedStudents;
    }
    
    public function unallocatedStudentsQuery(){
        $query = "SELECT * 
                FROM `fyp_User` 
                INNER JOIN fyp_Student 
                ON fyp_Student.user_ID = fyp_User.user_ID 
                WHERE fyp_Student.staff_ID IS NULL";
        return $this->db->query($query);
        //$result = $this->db->query($query);
        //return $result->num_rows();
    }

    public function countAllUnallocatedStudents(){
        $result = self::unallocatedStudentsQuery();
        return $result->num_rows();
    }
    
    public function getAllSupervisors() {
        $supervisors = array();
        $query = "SELECT * 
                FROM `fyp_User` 
                INNER JOIN fyp_Staff 
                ON fyp_User.user_ID = fyp_Staff.user_ID";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {
            $supervisor = Supervisor::supervisorConstructor($row->firstName, $row->lastName, $row->username, $row->staff_ID, $row->emailAddress);
            $supervisors[] = $supervisor;
        }
        return $supervisors;
    }

    public function allocateStudentsToSupervisor() {
        $studentsArray = $this->input->post('students');
        $supervisor = $this->input->post('supervisor');
        foreach ($studentsArray as $student) {
            $this->db->set('staff_ID', $supervisor);
            $this->db->where('student_ID',$student);
            $result = $this->db->update('fyp_Student'); 
            if ($result === true){
                $this->session->set_userdata('allocation', 'success');
            }
        }
    }

    public function getAllStudents(){
        $query="SELECT 
                    a.username,
                    a.firstName AS StudentFirstName, 
                    a.lastName AS StudentLastName,
                    ROUND(AVG(coalesce(delStatusScore,0))*100, 2) AS avgScore, 
                    COUNT(fyp_Deliverable.deliverable_ID) AS NumOfDeliverables,
                    b.firstName AS SupervisorFirstName, 
                    b.lastName AS SupervisorLastName 
                    FROM fyp_Student 
                    INNER JOIN fyp_Staff ON fyp_Student.staff_ID = fyp_Staff.staff_ID 
                    INNER JOIN fyp_User a ON fyp_Student.user_ID = a.user_ID 
                    INNER JOIN fyp_User b ON fyp_Staff.user_ID = b.user_ID 
                    LEFT JOIN fyp_Deliverable on fyp_Deliverable.student_ID = fyp_Student.student_ID 
                    LEFT JOIN fyp_DeliverableStatus ON fyp_Deliverable.delStatus_ID = fyp_DeliverableStatus.delStatus_ID
                    WHERE fyp_Deliverable.isInactive = 0
                    GROUP by a.user_ID
                    ORDER BY `avgScore` DESC";
        return $this->db->query($query);
    }
    
}
