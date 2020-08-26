<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userm extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    #============Count Company=============#

    public function count_user() {
        return $this->db->count_all("users");
    }

    #=============User List=============#

    public function user_list() {
		$CI = & get_instance();
        $CI->load->library('session'); 
        $email = $this->session->userdata('username');	
        
        $result = $this->users->check_email($email);     
      
        
        $this->db->select('*');

        $this->db->from('mobile_user_details');       
        $this->db->where('register_id',$this->session->r_id);
        $query = $this->db->get();
            
        // print_r($query->num_rows());exit;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    #==============User search list==============#

    public function user_search_item($user_id) {
        $this->db->select('users.*,user_login.user_type');
        $this->db->from('user_login');
        $this->db->join('users', 'users.user_id = user_login.user_id');
        $this->db->where('users.user_id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

	#============ Check user by email ==========#
	public function checkUserByEmail($email){
		$this->db->select('user_login.*');
		$this->db->from('user_login');
		$this->db->where('username', $email);
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }else{
			return false;
		}
	}
	
    #============Insert user to database========#
	
    public function user_entry($data) {
        // print_R($data);die;
                $this->db->select('*');
                $this->db->from('mobile_user_details');
                $this->db->where('register_id', $data['register_id']);
                $query = $this->db->get();
            //    print_r($query->num_rows());die;
                //if ($query->num_rows() < 2) {
                    // echo 1;die;
                        $this->db->select('*');
                        $this->db->from('mobile_user_details');
                        $this->db->where('email', $data['email']);
                        $query = $this->db->get(); 
                        // print_r($query->num_rows());die;                   
                                if ($query->num_rows() > 0) {                        
                                    return 'already email exist';
                                }
                                else{      
                                     
                                    $this->db->insert('mobile_user_details', $data);
                                    echo $insert_id = $this->db->insert_id();        
                                    $this->db->trans_complete();        
                                    return $insert_id;
                                }
                
                //}
                // else{
                  
                //     return "two user already exists";
                // }
               
			
			
		
    }


    #============Insert user to database========#
	
    public function web_user_entry($data) {
        // print_R($data);die;
                // $this->db->select('*');
                // $this->db->from('mobile_user_details');
                // $this->db->where('register_id', $data['register_id']);
                // $query = $this->db->get();
            //    print_r($query->num_rows());die;
                //if ($query->num_rows() < 2) {
                    // echo 1;die;
                        $this->db->select('*');
                        $this->db->from('user_login');
                        $this->db->where('username', $data['username']);
                        $query = $this->db->get(); 
                        // print_r($query->num_rows());die;                   
                                if ($query->num_rows() > 0) {                        
                                    return 'already email exist';
                                }
                                else{      
                                     
                                    $this->db->insert('user_login', $data);
                                    echo $insert_id = $this->db->insert_id();        
                                    $this->db->trans_complete();        
                                    return $insert_id;
                                }
                
                //}
                // else{
                  
                //     return "two user already exists";
                // }
               
			
			
		
    }

    #==============User edit data===============#

    public function retrieve_user_editdata($user_id) {
        // echo 2;
        $this->db->select('*');
        $this->db->from('mobile_user_details');
        // $this->db->join('users', 'users.user_id = user_login.user_id');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
      
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    #==============Update company==================#

    public function update_user($user_id) {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            'password' => md5("gef" . $this->input->post('password')),
        );
        // print_r($data);die();
        $this->db->where('id', $user_id);
        $this->db->update('mobile_user_details', $data);
        

        return true;
    }
    public function delete_user($user_id){
				
				
				$this->db->where('id', $user_id);
				$this->db->delete('mobile_user_details');


    }

    
}
