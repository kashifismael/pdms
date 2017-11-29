<?php

class Feedback extends CI_Model {

    public function uploadFeedbackFile($fileName, $file_tmp) {
        $newFileName = uniqid('', true) . $this->session->userName . $fileName;
        $fileDestination = "feedbackUploads/" . $newFileName;
        if (move_uploaded_file($file_tmp, $fileDestination)) {
            $insert = self::insertFileRecord($newFileName);
        } else {
            echo "file upload didnt work";
        }
        if ($insert === true) {
            return true;
        }
    }

    public function insertFileRecord($newFileName) {
        $data = array(
            'evidence_ID' => $this->input->post('evidID'),
            'filePath' => $newFileName,
        );
        return $this->db->insert('fyp_Feedback', $data);
    }

    public function updateEvidStatus($evidID, $evidStatus) {
        $query = $this->db->query("UPDATE fyp_Evidence SET evidStatus_ID = '$evidStatus' WHERE fyp_Evidence.evidence_ID = '$evidID'");
        return $query;
    }

    public function updateDelStatus($delID, $delStatus) {
        $query = $this->db->query("UPDATE fyp_Deliverable SET delStatus_ID = '$delStatus' WHERE deliverable_ID = '$delID'");
        return $query;
    }

    public function downloadFeedbackFile() {
        //downloading of feedback file on server
    }

}
