<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends CI_Controller {

    public function index() {
        $data['title'] = "Welcome";
        $this->load->view('header', $data);
        $this->load->view('emailTest', $data);
    }

    public function sendEmail() {
        if (isset($_POST['subject'])) {
            echo $this->input->post('subject')."<br>";
            $data['title'] = "Announcement Test";
            $data['content'] = $this->input->post('content');
            //$config = self::getEmailConfig();
            //$this->load->library('email', $config);
            $this->load->library('email');
            //$this->email->set_newline("\r\n");
            $this->email->from('unidissKU@gmail.com', 'UniDiss');
            $this->email->to('k.ismael@hotmail.co.uk');
            $this->email->subject($this->input->post('subject'));            
            $body = $this->load->view('emailViews/emailTemplate', $data, TRUE);
            $this->email->message($body);
            $result = $this->email->send();
            if($result === true){
                echo "email sent";
            } else {
                echo "email not sent";
            }
        }
    }

//    private function getEmailConfig() {
//        $config = Array(
//            'protocol' => 'smtp',
//            'smtp_host' => 'ssl://smtp.googlemail.com',
//            'smtp_port' => 465,
//            'smtp_user' => 'unidissKU@gmail.com',
//            'smtp_pass' => 'kashiffyp',
//            'mailtype' => 'html',
//            'charset' => 'iso-8859-1'
//        );
//        return $config;
//    }

}
