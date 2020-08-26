<?php
class SendEmail extends CI_Controller
{
    
    function SendEmail()
    {
        parent::Controller();
        $this->load->library('email'); // load the library
    }
    
    function index()
    {
        $this->sendEmail();
    }
    
    public function sendEmail()
    {
        // Email configuration
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'localhost',
            // 'smtp_port' => 465,
            'smtp_user' => 'root', // change it to yours
            'smtp_pass' => '', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        
        $this->load->library('email', $config);
        $this->email->from('rinky.rathoremindcrewtech.com', "Team");
        $this->email->to("rinkirathore199@gmail.com");
        // $this->email->cc("testcc@domainname.com");
        $this->email->subject("This is test subject line");
        $this->email->message("Mail sent test message...");
        
        $data['message'] = "Sorry Unable to send email...";
        if ($this->email->send()) {
            $data['message'] = "Mail sent...";
        }
        
        // forward to index page
        $this->load->view('index', $data);
    }
    
}
?>