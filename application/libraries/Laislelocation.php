<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laislelocation {
    #==============user list================#

    public function location_list() {
        $CI = & get_instance();
        $CI->load->model('Aislelocation');
        $location_list = $CI->Aislelocation->location_list();
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
        $locationList = $CI->parser->parse('aislelocations/locations', $data, true);
        return $locationList;
    }
	
	
	public function location_list_print() {
        $CI = & get_instance();
        $CI->load->model('Aislelocation');
        $location_list = $CI->Aislelocation->location_list();
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
        $locationList = $CI->parser->parse('aislelocations/locations_print', $data, true);
        return $locationList;
    }
	
    #=============User Search item===============#

    public function location_search_item($location_id) {
        $CI = & get_instance();
        $CI->load->model('Aislelocation');
        $location_list = $CI->Aislelocation->location_search_item($location_id);
        $i = 0;
        foreach ($location_list as $k => $v) {
            $i++;
            $location_list[$k]['sl'] = $i;
        }
        $data = array(
            'title' => 'Location Search Items',
            'location_list' => $location_list
        );
        $locationList = $CI->parser->parse('aislelocations/locations', $data, true);
        return $locationList;
    }

    #==============User add form===========#

    public function location_add_form() {
        $CI = & get_instance();
        $CI->load->model('Aislelocation');
        $CI->load->model('Locationm');
		$building_list = $CI->Locationm->building_list();
        $data = array(
            'title' => 'Add location',
			'building_list' => $building_list
        );
		$locationForm = $CI->parser->parse('aislelocations/add_location_form', $data, true);
        return $locationForm;
    }

    #================Insert user==========#

    public function insert_location($data) {
        $CI = & get_instance();
        $CI->load->model('Aislelocation');
        $CI->Aislelocation->location_entry($data);
        return true;
    }

    #===============User edit form==============#

    public function location_edit_data($location_id) {
        $CI = & get_instance();
        $CI->load->model('Aislelocation');
        $location_detail = $CI->Aislelocation->retrieve_location_editdata($location_id);
        $data1 = (array)$CI->Aislelocation->retrieve_location_editdata($location_id);
		$CI->load->model('Locationm');
		$building_list = $CI->Locationm->building_list();
		$data = array(
            'building_list' => $building_list,
            'data1' => $data1
        );
      //echo '<pre>';        print_r($data1);die();

        $locationList = $CI->parser->parse('aislelocations/edit_location_form', $data, true);
        return $locationList;
    }

}

?>