<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clocation extends CI_Controller {

    public $user_id;

    function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('llocation');
        $this->load->library('lusers');
        $this->load->library('session');
        $this->load->model('Userm');
        $this->load->model('Locationm');
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
        $content = $this->llocation->location_add_form();
        $this->template->full_admin_html_view($content);
    }

    #===============User Search Item===========#

    public function location_search_item() {
        $location_id = $this->input->post('location_id');
        $content = $this->llocation->location_search_item($location_id);
        $this->template->full_admin_html_view($content);
    }

    #================Manage Location===============#

    public function manage_location($r_id) {
        // print_r($r_id);die;
		 if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
        $content = $this->llocation->location_list($r_id);
        $this->template->full_admin_html_view($content);
    }}
	
	public function import_locations($r_id) {
		 $CI = & get_instance();
		 $CI->load->library('lproduct');
		  if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
		$content = $this->llocation->import_locations($r_id);
        $this->template->full_admin_html_view($content);

    }
	}
	public function location_import_action($r_id){
		$this->load->model('Locationm');
		$this->Locationm->import_location($r_id,$_FILES);
		die;
	}

    #==============Insert User==============#

    public function insert_location() {
        $data = array(
            'location_name' => $this->input->post('location_name'),
            'parent_location_id' => $this->input->post('parent_location_id'),
            'created_by' => $_SESSION['user_id']
        );

        $result = $this->llocation->insert_location($data);
		if($result==1){
			$this->session->set_userdata(array('message' => display('successfully_added')));
		}else{
			$this->session->set_userdata(array('error_message' => "This location is already exist."));
		}
        if (isset($_POST['add-location'])) {
            redirect('Clocation/manage_location');
        } elseif (isset($_POST['add-location-another'])) {
            redirect(base_url('Clocation'));
        }
    }

    #===============User update form================#

    public function location_update_form($location_id) {
        $location_id = $location_id;
        $content = $this->llocation->location_edit_data($location_id);
        $this->template->full_admin_html_view($content);
    }

    #===============User update===================#

    public function location_update() {
        $location_id = $this->input->post('location_id');
        $this->Locationm->update_location($location_id);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Clocation/manage_location'));
    }

    #============User delete===========#

    public function location_delete() {
        $location_id = $_POST['location_id'];
        $loc = $this->Locationm->delete_location($location_id);
		if($loc){
			$this->session->set_userdata(array('message' => display('successfully_delete')));
        }else{
			$this->session->set_userdata(array('error_message' => "You can not delete this location because its using in some transactions."));
		}
		return true;
    }
	
	#==============add Building============#

    public function add_building() {
        $content = $this->llocation->building_add_form();
        $this->template->full_admin_html_view($content);
    }
	
#-------------------------------------------------------------------------------------------------#######-------------------------- Building Functions
	
	#================Manage Location===============#

    public function manage_building() {
        $content = $this->llocation->building_list();
        $this->template->full_admin_html_view($content);
    }
	
	#===============Building update form================#

    public function building_update_form($building_id) {
        $building_id = $building_id;
        $content = $this->llocation->building_edit_data($building_id);
        $this->template->full_admin_html_view($content);
    }
	
	
	#============User delete===========#

    public function building_delete() {
        $building_id = $_POST['building_id'];
        $loc = $this->Locationm->delete_building($building_id);
		if($loc){
			$this->session->set_userdata(array('message' => display('successfully_delete')));
        }else{
			$this->session->set_userdata(array('error_message' => "You can not delete this location because its using in some transactions."));
		}
		return true;
    }
	
	#==============Insert User==============#

    public function insert_building() { 
        $data = array(
            'building_name' => $this->input->post('building_name'),
            'created_by' => $_SESSION['user_id']
        );

        $this->llocation->insert_building($data);
        $this->session->set_userdata(array('message' => display('successfully_added')));
        if (isset($_POST['add-building'])) {
            redirect('Clocation/manage_building');
        } elseif (isset($_POST['add-building-another'])) {
            redirect(base_url('Clocation/add_building'));
        }
    }
	
	
	#===============User update===================#

    public function building_update() {
        $building_id = $this->input->post('building_id');
        $this->Locationm->update_building($building_id);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Clocation/manage_building'));
    }

#---------------------------------------------------------------------------------#######----------------------------- Building Function Ends




#-------------------------------------------------------------------------------------------------#######-------------------------- Slots Functions
	
	#================Manage Location===============#

    public function manage_slots() {
        $content = $this->llocation->slot_list();
        $this->template->full_admin_html_view($content);
    }
	
	#===============Building update form================#

    public function slot_update_form($slot_id) {
        $slot_id = $slot_id;
        $content = $this->llocation->slot_edit_data($slot_id);
        $this->template->full_admin_html_view($content);
    }
	
	
	#============User delete===========#

    public function slot_delete() {
        $slot_id = $_POST['slot_id'];
        $loc = $this->Locationm->delete_slot($slot_id);
		if($loc){
			$this->session->set_userdata(array('message' => display('successfully_delete')));
        }else{
			$this->session->set_userdata(array('error_message' => "You can not delete this location because its using in some transactions."));
		}
		return true;
    }
	
	#==============add Building============#

    public function add_slot() {
        $content = $this->llocation->slot_add_form();
        $this->template->full_admin_html_view($content);
    }
	
	
	#==============Insert User==============#

    public function insert_slot() { 
        $data = array(
            'slot_name' => $this->input->post('slot_name'),
			'aisle_id'  => $this->input->post('aisle_id'),
            'created_by' => $_SESSION['user_id']
        );

        $this->llocation->insert_slot($data);
        $this->session->set_userdata(array('message' => display('successfully_added')));
        if (isset($_POST['add-slot'])) {
            redirect('Clocation/manage_slots');
        } elseif (isset($_POST['add-slot-another'])) {
            redirect(base_url('Clocation/add_slot'));
        }
    }
	
	
	#===============User update===================#

    public function slot_update() {
        $slot_id = $this->input->post('slot_id');
        $this->Locationm->update_slot($_POST);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Clocation/manage_slots'));
    }

#---------------------------------------------------------------------------------#######----------------------------- Slots Function Ends


#-------------------------------------------------------------------------------------------------#######-------------------------- Level Functions
	
	#================Manage Location===============#

    public function manage_levels() {
        $content = $this->llocation->level_list();
        $this->template->full_admin_html_view($content);
    }
	
	#===============Building update form================#

    public function level_update_form($level_id) {
        $level_id = $level_id;
        $content = $this->llocation->level_edit_data($level_id);
        $this->template->full_admin_html_view($content);
    }
	
	
	#============User delete===========#

    public function level_delete() {
        $level_id = $_POST['level_id'];
        $loc = $this->Locationm->delete_level($level_id);
		if($loc){
			$this->session->set_userdata(array('message' => display('successfully_delete')));
        }else{
			$this->session->set_userdata(array('error_message' => "You can not delete this location because its using in some transactions."));
		}
		return true;
    }
	
	#==============add Building============#

    public function add_level() {
        $content = $this->llocation->level_add_form();
        $this->template->full_admin_html_view($content);
    }
	
	
	#==============Insert User==============#

    public function insert_level() { 
        $data = array(
            'level_name' => $this->input->post('level_name'),
			'slot_id'  => $this->input->post('slot_id'),
            'created_by' => $_SESSION['user_id']
        );

        $this->llocation->insert_level($data);
        $this->session->set_userdata(array('message' => display('successfully_added')));
        if (isset($_POST['add-level'])) {
            redirect('Clocation/manage_levels');
        } elseif (isset($_POST['add-level-another'])) {
            redirect(base_url('Clocation/add_level'));
        }
    }
	
	
	#===============User update===================#

    public function level_update() {
        $level_id = $this->input->post('level_id');
        $this->Locationm->update_level($_POST);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Clocation/manage_levels'));
    }

#---------------------------------------------------------------------------------#######----------------------------- Slots Function Ends



#-------------------------------------------------------------------------------------------------#######-------------------------- Bin Functions
	
	#================Manage Location===============#

    public function manage_bins() {
        $content = $this->llocation->bins_list();
        $this->template->full_admin_html_view($content);
    }
	
	#===============Building update form================#

    public function bin_update_form($bin_id) {
        $bin_id = $bin_id;
        $content = $this->llocation->bin_edit_data($bin_id);
        $this->template->full_admin_html_view($content);
    }
	
	
	#============User delete===========#

    public function bin_delete() {
        $bin_id = $_POST['bin_id'];
        $loc = $this->Locationm->delete_bin($bin_id);
		if($loc){
			$this->session->set_userdata(array('message' => display('successfully_delete')));
        }else{
			$this->session->set_userdata(array('error_message' => "You can not delete this location because its using in some transactions."));
		}
		return true;
    }
	
	#==============add Building============#

    public function add_bin() {
        $content = $this->llocation->bin_add_form();
        $this->template->full_admin_html_view($content);
    }
	
	
	#==============Insert User==============#

    public function insert_bin() { 
        $data = array(
            'bin_name' => $this->input->post('bin_name'),
			'level_id'  => $this->input->post('level_id'),
            'created_by' => $_SESSION['user_id']
        );

        $this->llocation->insert_bin($data);
        $this->session->set_userdata(array('message' => display('successfully_added')));
        if (isset($_POST['add-bin'])) {
            redirect('Clocation/manage_bins');
        } elseif (isset($_POST['add-bin-another'])) {
            redirect(base_url('Clocation/add_bin'));
        }
    }
	
	
	#===============User update===================#

    public function bin_update() {
		#print_r($_POST);die;
        #$bin_id = $this->input->post('bin_id');
        $this->Locationm->update_bin($_POST);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Clocation/manage_bins'));
    }

#---------------------------------------------------------------------------------#######----------------------------- Slots Function Ends


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
	
	public function print_location($r_id){
		$content = $this->llocation->location_list_print($r_id);
        $this->template->full_admin_html_view($content);
	}
	
	public function getAisleLocation(){
		$aisle = $this->Locationm->getAisleLocation($_POST['building_id']);
		echo json_encode(array("status"=>true, "aisle_location"=>$aisle));die;
	}
	
	public function getSlotLocation(){
		$aisle = $this->Locationm->getSlotLocation($_POST['aisle_id']);
		echo json_encode(array("status"=>true, "slot_location"=>$aisle));die;
	}
	
	public function getLevelLocation(){
		$aisle = $this->Locationm->getLevelLocation($_POST['slot_id']);
		echo json_encode(array("status"=>true, "level_location"=>$aisle));die;
	}
	
	public function getBinLocation(){
		$aisle = $this->Locationm->getBinLocation($_POST['level_id']);
		echo json_encode(array("status"=>true, "bin_location"=>$aisle));die;
	}

}
