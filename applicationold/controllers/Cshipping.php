<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cshipping extends CI_Controller {

    public $user_id;

    function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('llocation');
        $this->load->library('lshipping');
        $this->load->library('lusers');
        $this->load->library('session');
        $this->load->model('Userm');
        $this->load->model('Locationm');
        $this->load->model('Shipping');
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
		 if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
        $content = $this->lshipping->shipping_add_form();
        $this->template->full_admin_html_view($content);
    }}

    #===============User Search Item===========#

    public function location_search_item() {
        $location_id = $this->input->post('location_id');
        $content = $this->llocation->location_search_item($location_id);
        $this->template->full_admin_html_view($content);
    }

    #================Manage User===============#

    public function manage_shipping() {
		
        $r_id=$this->session->r_id;
		 if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
        $content = $this->lshipping->shipping_list($r_id);
        $this->template->full_admin_html_view($content);
    }}

    #==============Insert User==============#

    public function insert_shipping($r_id) {
        // print_r($_SESSION);die;
        $data = array(
            'shipping_name' => $this->input->post('shipping_name'),
            'created_by' => $_SESSION['username'],
            'r_id' => $r_id
        );

        $this->lshipping->insert_shipping($data);
        $this->session->set_userdata(array('message' => display('successfully_added')));
        if (isset($_POST['add-location'])) {
            redirect('Cshipping/manage_shipping/'.$r_id);
        } elseif (isset($_POST['add-location-another'])) {
            redirect(base_url('Cshipping'));
        }
    }

    #===============User update form================#

    public function shipping_update_form($location_id) {
        $location_id = $location_id;
		 if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
        $content = $this->lshipping->shipping_edit_data($location_id);
        $this->template->full_admin_html_view($content);
    }}

    #===============User update===================#

    public function shipping_update() {
        $shipping_id = $this->input->post('shipping_id');
        $this->Shipping->update_shipping($shipping_id);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Cshipping/manage_shipping'));
    }

    #============User delete===========#

    public function shipping_delete() {
        $shipping_id = $_POST['shipping_id'];
        $this->Shipping->delete_shipping($shipping_id);
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
	
	public function print_location(){
		$content = $this->llocation->location_list_print();
        $this->template->full_admin_html_view($content);
	}

}
