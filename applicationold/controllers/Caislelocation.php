<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Caislelocation extends CI_Controller {

    public $user_id;

    function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('laislelocation');
        $this->load->library('lusers');
        $this->load->library('session');
        $this->load->model('Userm');
        $this->load->model('Aislelocation');
        $this->auth->check_admin_auth();
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
        $content = $this->laislelocation->location_add_form();
        $this->template->full_admin_html_view($content);
    }

    #===============User Search Item===========#

    public function location_search_item() {
        $location_id = $this->input->post('location_id');
        $content = $this->laislelocation->location_search_item($location_id);
        $this->template->full_admin_html_view($content);
    }

    #================Manage User===============#

    public function manage_location() {
        $content = $this->laislelocation->location_list();
        $this->template->full_admin_html_view($content);
    }

    #==============Insert User==============#

    public function insert_location() { #print_r($_POST);die;
        $data = array(
            'location_name' => $this->input->post('location_name'),
            'building_id' => $this->input->post('building_id'),
            'created_by' => $_SESSION['user_id']
        );

        $this->laislelocation->insert_location($data);
        $this->session->set_userdata(array('message' => display('successfully_added')));
        if (isset($_POST['add-location'])) {
            redirect('Caislelocation/manage_location');
        } elseif (isset($_POST['add-location-another'])) {
            redirect(base_url('Caislelocation'));
        }
    }

    #===============User update form================#

    public function location_update_form($location_id) {
        $location_id = $location_id;
        $content = $this->laislelocation->location_edit_data($location_id);
        $this->template->full_admin_html_view($content);
    }

    #===============User update===================#

    public function location_update() {
		$location_id = $this->input->post('location_id');
        $this->Aislelocation->update_location($location_id);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Caislelocation/manage_location'));
    }

    #============User delete===========#

    public function location_delete() {
        $location_id = $_POST['location_id'];
        $loc = $this->Aislelocation->delete_location($location_id);
        if($loc=="1"){
			$this->session->set_userdata(array('message' => display('successfully_delete')));
        }else{
			$this->session->set_userdata(array('error_message' => "You can not delete this location because its using in some transactions."));
		}
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
	
	public function print_location(){
		$content = $this->laislelocation->location_list_print();
        $this->template->full_admin_html_view($content);
	}

}
