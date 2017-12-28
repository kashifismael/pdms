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

}
