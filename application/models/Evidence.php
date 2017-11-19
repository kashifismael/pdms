<?php

class Evidence extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function uploadEvidenceFile($fileName, $file_tmp) {
        $newFileName = uniqid('', true) . $this->session->userName . $fileName;
        $fileDestination = "evidenceUploads/" . $newFileName;
        if (move_uploaded_file($file_tmp, $fileDestination)) {
            //echo "<p>file upload successful </p>";
            $insert = self::insertFileRecord($newFileName);
        } else {
            echo "file upload didnt work";
        }
        if($insert === true){
            //echo "<p>record insert successful </p>";
            return true;
        }
    }

    public function insertFileRecord($newFileName) {
        $data = array(
            'deliverable_ID' => $this->input->post('deliverableID'),
            'evidStatus_ID' => 1,
            'evidenceName' => $this->input->post('evidenceName'),
            'filePath' => $newFileName,
        );
        return $this->db->insert('fyp_Evidence', $data);
    }

}
