<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth {

    //Login....
    public function login($username, $password) {
		
        $CI = & get_instance();
        $CI->load->model('Users');
		$CI->load->library('session');
        $result = $CI->Users->check_valid_user($username, $password);
       
        if ($result) {
            $key = md5(time());
            $key = str_replace("1", "z", $key);
            $key = str_replace("2", "J", $key);
            $key = str_replace("3", "y", $key);
            $key = str_replace("4", "R", $key);
            $key = str_replace("5", "Kd", $key);
            $key = str_replace("6", "jX", $key);
            $key = str_replace("7", "dH", $key);
            $key = str_replace("8", "p", $key);
            $key = str_replace("9", "Uf", $key);
            $key = str_replace("0", "eXnyiKFj", $key);
            $sid_web = substr($key, rand(0, 3), rand(28, 32));

			
			// $databaseName = $result[0]['databaseName'];
			// $CI->session->set_userdata('databaseName',$databaseName);
			// $CI->session->userdata('databaseName'); 
			
            // codeigniter session stored data			
            $user_data = array(
                'sid_web' => $sid_web,
                'user_id' => $result[0]['l_id'],
                'lic_key' => $result[0]['l_lic_key'],
                'datetime' => $result[0]['l_datetime'],
                'user_email' => $result[0]['l_email'],
                // 'databaseName' => $result[0]['databaseName'],
            );
            // echo "auth";
            // print_r($user_data);exit;
            $test=$CI->session->set_userdata($user_data);        
            return TRUE;
        } else {
            return FALSE;
        }
    
    }

    //Check if is logged....
    public function is_logged() {
        $CI = & get_instance();
        if ($CI->session->userdata('sid_web')) {
            print_r($CI->session->userdata('sid_web'));
            return true;
        }
        return false;
    }

    //Logout....
    public function logout() {
        $CI = & get_instance();
        $user_data = array(
            'sid_web' => '',
            'user_id' => '',
            'user_type' => '',
            'user_name' => ''
        );
        $CI->session->sess_destroy($user_data);
        return true;
    }

    //Check for logged in user is Admin or not.

    public function is_admin() {
        $CI = & get_instance();
        if ($CI->session->userdata('user_type') == 1 || $CI->session->userdata('user_type') == 2) {
            return true;
        }
        return false;
    }

    // function check_admin_auth() {
    //     if (!$this->session->userdata('username')){
    //         $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
    //         // $this->auth->check_admin_auth();
    //     }
        
       
    // }

    //This function is used to Generate Key
    public function generator($lenth) {
        $number = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "N", "M", "O", "P", "Q", "R", "S", "U", "V", "T", "W", "X", "Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 34);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }

}

?>