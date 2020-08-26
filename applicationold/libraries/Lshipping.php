<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lshipping {
    #==============user list================#

    public function shipping_list($r_id) {
        $CI = & get_instance();
        $CI->load->model('Shipping');
        $shipping_list = $CI->Shipping->shipping_list($r_id);
        $i = 0;
        if (!empty($shipping_list)) {
            foreach ($shipping_list as $k => $v) {
                $i++;
                $shipping_list[$k]['sl'] = $i;
            }
        }
        $data = array(
            'title' => 'Shipping List',
            'shipping_list' => $shipping_list,
        );
		#echo "<pre>";print_r($data);die;
        $locationList = $CI->parser->parse('shipping/shippings', $data, true);
        return $locationList;
    }
	
	
	public function location_list_print() {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $location_list = $CI->Locationm->location_list();
        $i = 0;
        if (!empty($location_list)) {
            foreach ($location_list as $k => $v) {
                $i++;
                $location_list[$k]['sl'] = $i;
            }
        }
        $data = array(
            'title' => 'Location List',
            'location_list' => $location_list,
        );
		#echo "<pre>";print_r($data);die;
        $locationList = $CI->parser->parse('locations/locations_print', $data, true);
        return $locationList;
    }
	
    #=============User Search item===============#

    public function location_search_item($location_id) {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $location_list = $CI->Locationm->location_search_item($location_id);
        $i = 0;
        foreach ($location_list as $k => $v) {
            $i++;
            $location_list[$k]['sl'] = $i;
        }
        $data = array(
            'title' => 'Location Search Items',
            'location_list' => $location_list
        );
        $locationList = $CI->parser->parse('locations/locations', $data, true);
        return $locationList;
    }

    #==============User add form===========#

    public function shipping_add_form() {
        $CI = & get_instance();
        $CI->load->model('Shipping');
        $data = array(
            'title' => 'Add Shipping Method'
        );
        $locationForm = $CI->parser->parse('shipping/add_shipping_form', $data, true);
        return $locationForm;
    }

    #================Insert user==========#

    public function insert_shipping($data) {
        $CI = & get_instance();
        $CI->load->model('Shipping');
        $CI->Shipping->shipping_entry($data);
        return true;
    }

    #===============User edit form==============#

    public function shipping_edit_data($location_id) {
        $CI = & get_instance();
        $CI->load->model('Shipping');
        $location_detail = $CI->Shipping->retrieve_shipping_editdata($location_id);
        $data1 = (array)$CI->Locationm->retrieve_location_editdata($location_id);
       
//        $data = array(
//            'user_id' => $user_detail[0]['user_id'],
//            'first_name' => $user_detail[0]['first_name'],
//            'last_name' => $user_detail[0]['last_name'],
//            'username' => $user_detail[0]['username'],
//            'password' => $user_detail[0]['password'],
//            'status' => $user_detail[0]['status']
//        );
      #echo '<pre>';        print_r($data1);die();

        $locationList = $CI->parser->parse('shipping/edit_shipping_form', $location_detail, true);
        return $locationList;
    }

}

?>