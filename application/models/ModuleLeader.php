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
            //$student = studentConstructor($row->student_ID, $row->firstName, $row->lastName, $row->username);
            $unallocatedStudents[] = $student;
        }
        return $unallocatedStudents;  
    }  
    
}
