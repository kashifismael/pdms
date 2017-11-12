<?php

class ModuleLeader extends Supervisor {
 
    public function getAllUnallocatedStudents(){
        $unallocatedStudents = array();
        $query = "SELECT * 
                FROM `fyp_User` 
                INNER JOIN fyp_Student 
                ON fyp_Student.user_ID = fyp_User.user_ID 
                WHERE fyp_Student.staff_ID IS NULL";
        $result = $this->db->query($query);
        foreach ($result->result() as $row){
            $student = Student::studentConstructor($row->student_ID, $row->firstName, $row->lastName, $row->username);
            $unallocatedStudents[] = $student;
        }
        return $unallocatedStudents;  
    }  
    
    public function getAllSupervisors(){
        $supervisors = array();
        $query = "SELECT * 
                FROM `fyp_User` 
                INNER JOIN fyp_Staff 
                ON fyp_User.user_ID = fyp_Staff.user_ID";
        $result = $this->db->query($query);
        foreach ($result->result() as $row){
            $supervisor = Supervisor::supervisorConstructor($row->firstName, $row->lastName, $row->username, $row->staff_ID);
            $supervisors[] = $supervisor;
        }
        return $supervisors;
    }
    
}
