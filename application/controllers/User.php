<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class User extends CI_Controller {

    public $user_id;

    function __construct() {
        parent::__construct();
        $this->load->model('users');
        $this->load->library('auth');
        $this->load->library('lusers');
        $this->load->library('session');
        $this->load->model('Userm');
        // $this->auth->check_admin_auth();
        $this->template->current_menu = 'settings';

        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
		
		$this->load->model('Web_settings');
		$this->Web_settings->checkLicensing();
    }

    #==============User page load============#

    public function index() {
        // print_r($this->session-);die;
        if (!$this->session->username){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
       else{
         // echo ($content);exit;
        $content = $this->lusers->user_add_form();
       
        $this->template->full_admin_html_view($content);
       }
    }

    #===============User Search Item===========#

    public function user_search_item() {
        $user_id = $this->input->post('user_id');
        $content = $this->lusers->user_search_item($user_id);
        $this->template->full_admin_html_view($content);
    }

    #================Manage User===============#

    public function manage_user() {
        if (!$this->session->username){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
       else{
        $content = $this->lusers->user_list();
        $this->template->full_admin_html_view($content);
       }
    }

    #==============Insert User==============#

    public function insert_user() {
      
        $this->load->model('userm');
        $email = $this->session->userdata('username'); 
        // print_r($this->session->r_id);die;    
        // $result = $this->users->check_email($email);

        $l_key='';
       
        // $this->session->get_userdata($user_login);

        // $email = $this->session->userdata('username'); 

        // foreach($result as $row){ 
        //  $r_id= $row->r_id;
        // }

        // $this->session->set_userdata('register_id',$r_id);

        echo $this->session->r_id;

        $owner_id=$this->session->r_id;

        $newuseremail=$this->input->post('email');

               $result ='';

        $con=mysqli_connect("localhost", "root","","wholesale");

        $sql = "SELECT * from license_key where user_id=$owner_id and is_assigned=0";
        $result = $con->query($sql);

        // echo $owner_id;

        // echo $result;
        
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
          $l_key= $row['license_key']; 
          
          
          if($this->input->post('platform')=="iOS"){
            $data = array(
                'register_id'  =>$this->session->r_id,
                'user_id' => $this->generator(15),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'mobile' => $this->input->post('mobile'),
                'license_key'=>$l_key,
                'email' => $this->input->post('email'),
                'device_type'=>$this->input->post('platform'),
                'password' => md5("gef" . $this->input->post('password')),
                'create_date_time'=>date('Y-m-d H:i:s')
            
            );
   
            $result=$this->userm->user_entry($data);
          }
          else{
            $data = array(
                // 'register_id'  =>$this->session->r_id,
                'user_id' => $this->generator(15),
                'full_name' => $this->input->post('first_name').' '.$this->input->post('last_name'),
                'contact_no' => $this->input->post('mobile'),
                'username' => $this->input->post('email'),
                'password' =>$this->input->post('password'),
                'license_key'=>$l_key,
                'device_type'=>$this->input->post('platform'),
                // 'password' => md5("gef" . $this->input->post('password')),
                'reg_time'=>date('Y-m-d H:i:s')
            
            );
   
            $result=$this->userm->web_user_entry($data);

            $data1 = array(
                'register_id'  =>$this->session->r_id,
                'admin_id'=>$result,
                'user_id' => $this->generator(15),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'mobile' => $this->input->post('mobile'),
                'license_key'=>$l_key,
                'email' => $this->input->post('email'),
                'device_type'=>$this->input->post('platform'),
                'password' => md5("gef" . $this->input->post('password')),
                'create_date_time'=>date('Y-m-d H:i:s')
            
            );
   
            $result1=$this->userm->user_entry($data1);
          }
           
            
             //echo 1;  
                  
            if($result=='already email exist'){ 
                $this->session->set_flashdata('data_msg',"already email exists");
               //   $data_msg="alreadyemail_exists";
                 redirect(base_url('User'));
                
            }
           //  else if($result=='two user already exists'){
           //       $this->session->set_flashdata('data_msg',"You can not create more then two users.Subscribe to add more users");
           //         //   $data_msg= "two user already exists";
           //           redirect('User/manage_user/',$data_msg);
                     
           //  }
            else{
                $sql = "UPDATE license_key SET is_assigned=1,assigned_user_id=$result where license_key='".$l_key."'";


                if ($con->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  $result=$this->sendLicenseKey($newuseremail,$l_key);
                  if($result==true){
                    $this->session->set_flashdata('data_msg',"User created successfully, A license key has been send to the users email address.");
                  
                  }
                  else{
                    $this->session->set_flashdata('data_msg',"Email Not Send");

                  }

                  } else {
                    echo "Error updating record: " . $conn->error;
                  }

               
                  redirect('User/manage_user');
                
            }          }
        } else {
            $this->session->set_flashdata('data_msg',"You can not create more users");
            redirect('User/manage_user/',$data_msg);
        }
        
       
        //  print_r($result);die;  
     
 }
    #===============User update form================#

    public function user_update_form($user_id) {
        $user_id = $user_id;
			 if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
        $content = $this->lusers->user_edit_data($user_id);
        $this->template->full_admin_html_view($content);
    }
	}

    #===============User update===================#

    public function user_update() {
        $user_id = $this->input->post('user_id');
        // print_r($user_id);die;
        $this->Userm->update_user($user_id);




        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('User/manage_user'));
    }

    #============User delete===========#

    public function user_delete() {
        // print_R($_GET['user_id']);die;
        // if(isset($_POST['user_id']))
        // {
        //     echo 'Deleted successfully.';
        // }
        // else{
        //     echo 'failed';
        // }
        $user_id = $_POST['user_id'];
        // print_r($user_id);exit;
        $this->Userm->delete_user($user_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
        return true;
    }

    // Random Id generator
    public function generator($lenth) {
        $number = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "N", "M", "O", "P", "Q", "R", "S", "U", "V", "T", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 61);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }

 public function sendLicenseKey($email_address,$l_key)
    {
       
          $userdata = $this->session->userdata($userdata);
          // print_r($userdata);die;
              $config['protocol'] = 'smtp'; // mail, sendmail, or smtp    The mail sending protocol.
              $config['smtp_host'] = 'ssl://smtp.googlemail.com'; // SMTP Server Address.
              $config['smtp_user'] = 'testmindcrew1001@gmail.com'; // SMTP Username.
               $config['smtp_pass'] = 'Saloni19@'; // SMTP Password.
              
               // $config['smtp_user'] = 'support@plumkit.com';
               // $config['smtp_pass'] = 'Mindcrew01'; // SMTP Password.
              $config['smtp_port'] = '465'; // SMTP Port. 25 is for local host
              $config['smtp_timeout'] = '7	'; // SMTP Timeout (in seconds).
              $config['wordwrap'] = TRUE; // TRUE or FALSE (boolean)    Enable word-wrap.
              $config['wrapchars'] = 76; // Character count to wrap at.
              $config['mailtype'] = 'html'; // text or html Type of mail. If you send HTML email you must send it as a complete web page. Make sure you don't have any relative links or relative image paths otherwise they will not work.
              $config['charset'] = 'utf-8'; // Character set (utf-8, iso-8859-1, etc.).
              $config['validate'] = TRUE; // TRUE or FALSE (boolean)    Whether to validate the email address.
              $config['priority'] = 1; // 1, 2, 3, 4, 5    Email Priority. 1 = highest. 5 = lowest. 3 = normal.
              $config['crlf'] = "\r\n"; // "\r\n" or "\n" or "\r" Newline character. (Use "\r\n" to comply with RFC 822).
              $config['newline'] = "\r\n"; // "\r\n" or "\n" or "\r"    Newline character. (Use "\r\n" to comply with RFC 822).
              $config['bcc_batch_mode'] = FALSE; // TRUE or FALSE (boolean)    Enable BCC Batch Mode.
              $config['bcc_batch_size'] = 200; //
        
        
          $this->load->library('email');
          $this->email->set_newline("\r\n");
          $this->email->initialize($config);
             $email_body ="<div>Your license key is </div>";
         
     
            $this->email->from('testmindcrew1001@gmail.com','Mindcrew Technologies');
            $this->email->to($email_address);
            // $this->email->to('tayyabjohar@gmail.com');
            $this->email->subject('Subject : Welcome');
           // $this->email->message($a);
		 
		 $this->email->message('<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>  <title></title><meta http-equiv="X-UA-Compatible" content="IE=edge">  <!--<![endif]--><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><style type="text/css">  #outlook a { padding: 0; }  .ReadMsgBody { width: 100%; }  .ExternalClass { width: 100%; }  .ExternalClass * { line-height:100%; }  body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }  table, td { border-collapse:collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }  img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }  p { display: block; margin: 13px 0; }</style><style type="text/css">  @media only screen and (max-width:480px) {    @-ms-viewport { width:320px; }    @viewport { width:320px; }  }</style><link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css">    <style type="text/css">        @import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);    </style><style type="text/css">  @media only screen and (min-width:480px) {    .mj-column-per-100 { width:100%!important; }  }</style></head><b  ody style="background: #F5F5F5;">    <div class="mj-container" style="background-color:#F5F5F5;"><div style="margin:0px auto;max-width:600px;background:#FFFFFF;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#FFFFFF;" align="left" border="0"><tbody></tbody></table></div><div style="margin:0px auto;max-width:600px;background:#FFFFFF;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#FFFFFF;" align="center" border="0"><tbody ><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:0px 0px 0px 0px;"><div style="margin:0px auto;max-width:600px;background:##FFFFFF;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:##FFFFFF;" align="center" border="0"><tbody><tr><td style="text-align:left;vertical-align:top;direction:ltr;font-size:0px;padding:7px 0px 7px 0px;"><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="left"><div style="cursor:auto;color:#367fa9;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:left;"><h1 style="font-family: &apos;Open Sans&apos;, sans-serif; line-height: 100%;">WMSIMPLIFIED</h1></div></td></tr></tbody></table></div></td></tr></tbody></table></div><div style="margin:0px auto;max-width:600px;background:#FFFFFF;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#FFFFFF;" align="center" border="0"><tbody style="background:#ededed;"><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="left"><div style="cursor:auto;color:#000000;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:left;"><p>Welcome to WMSIMPLIFIED</p><p>Your license key is - ' .$l_key.'</p> </p><br/><p>Thanks! </p></div></td></tr></tbody></table></div></td></tr></tbody></table></div><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" border="0"><tbody><tr><td><div style="background-color:#367fa9; margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="center"><div style="cursor:auto;color:#000000;color:#fff; font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:center;">&copy; Copyright 2020 WMSIMPLIFIED</p></div></td></tr></tbody></table></div></td></tr></tbody></table></div></td></tr></tbody></div></div></body></html>');
		
		   
            // $this->email->message('This Message is to notify you that your license key is'.$userdata['licence_session']);
             // $this->email->send();
            $send = $this->email->send();
          //print_r($this->email->send());die;
           //Send mail 
            // print_r($this->email->send());die;
           
           if($send) {
               
            $this->session->set_flashdata("email_sent"," A license key has been sent to your email address");
          //   print_r($this->session->flashdata('email_sent'));exit;
        //    $this->load->view('user/lic',$userdata);

        return true;
           }
           else {
              echo $this->email->print_debugger();
               
            $this->session->set_flashdata("email_sent","Error in sending Email.");
            // $this->load->view('user/signup',$userdata);
          //  $this->load->view('email_form'); 

             return false;
           }
      }




}
