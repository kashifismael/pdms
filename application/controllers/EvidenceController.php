<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EvidenceController extends CI_Controller {
    
    public function uploadFile(){
        if (isset($_FILES['evidence'])){
            $file = $_FILES['evidence'];
            print_r($_POST);
            echo "<br>";
            //print_r($file);
            $fileName = $file['name'];
            $file_tmp = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            echo "<p>file name is ".$fileName."</p>";
            echo "<p>file tmp name is ".$file_tmp."</p>";
            echo "<p>file size is ".$fileSize."</p>";
            echo "<p>file error is ".$fileError."</p>";
        }
    }
    
    
}
