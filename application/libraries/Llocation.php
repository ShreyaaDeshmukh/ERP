<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Llocation {
    #==============user list================#

    public function location_list($r_id) {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $location_list = $CI->Locationm->location_list($r_id);
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
        $locationList = $CI->parser->parse('locations/locations', $data, true);
        return $locationList;
    }
	
	//Retrieve  Customer List	

    public function import_locations($r_id) {

        $CI = & get_instance();

        $CI->load->model('Locationm');

        $CI->load->model('Web_settings');

		$data = array();

        $customerList = $CI->parser->parse('locations/import_locations', $data, true);

        return $customerList;

    }
	
	public function building_list() {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $building_list = $CI->Locationm->building_list();
        $i = 0;
        if (!empty($building_list)) {
            foreach ($building_list as $k => $v) {
                $i++;
                $building_list[$k]['sl'] = $i;
            }
        }
        $data = array(
            'title' => 'Building List',
            'building_list' => $building_list,
        );
		#echo "<pre>";print_r($data);die;
        $locationList = $CI->parser->parse('locations/buildings', $data, true);
        return $locationList;
    }
	
	public function slot_list() {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $slot_list = $CI->Locationm->slot_list();
        $i = 0;
        if (!empty($slot_list)) {
            foreach ($slot_list as $k => $v) {
                $i++;
                $slot_list[$k]['sl'] = $i;
            }
        }
        $data = array(
            'title' => 'Slot List',
            'slot_list' => $slot_list,
        );
		#echo "<pre>";print_r($data);die;
        $locationList = $CI->parser->parse('locations/slots', $data, true);
        return $locationList;
    }
	
	public function level_list() {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $level_list = $CI->Locationm->level_list();
        $i = 0;
        if (!empty($level_list)) {
            foreach ($level_list as $k => $v) {
                $i++;
                $level_list[$k]['sl'] = $i;
            }
        }
        $data = array(
            'title' => 'Level List',
            'level_list' => $level_list,
        );
		#echo "<pre>";print_r($data);die;
        $locationList = $CI->parser->parse('locations/levels', $data, true);
        return $locationList;
    }
	
	public function bins_list() {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $bin_list = $CI->Locationm->bin_list();
        $i = 0;
        if (!empty($bin_list)) {
            foreach ($bin_list as $k => $v) {
                $i++;
                $bin_list[$k]['sl'] = $i;
            }
        }
        $data = array(
            'title' => 'Bin List',
            'bin_list' => $bin_list,
        );
		#echo "<pre>";print_r($data);die;
        $locationList = $CI->parser->parse('locations/bins', $data, true);
        return $locationList;
    }
	
	public function location_list_print($r_id) {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $location_list = $CI->Locationm->location_list($r_id);
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

    public function location_add_form() {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $CI->load->model('Aislelocation');
        $location_list = $CI->Aislelocation->location_list();
        $building_list = $CI->Aislelocation->building_list();
        #$aisle_list = $CI->Aislelocation->aisle_list();
        #$slot_list = $CI->Aislelocation->slot_list();
        ##$level_list = $CI->Aislelocation->level_list();
        #$bin_list = $CI->Aislelocation->bin_list();
        $data = array(
            'title' => 'Add location',
            'location_list' => $location_list,
            'building_list' => $building_list,
        #    'aisle_list' => $aisle_list,
        #    'slot_list' => $slot_list,
        #    'level_list' => $level_list,
        #    'bin_list' => $bin_list
        );
        $locationForm = $CI->parser->parse('locations/add_location_form', $data, true);
        return $locationForm;
    }
	
	#==============User add form===========#

    public function building_add_form() {
        $CI = & get_instance();
		$data = array(
            'title' => 'Add location',
        #    'location_list' => $location_list,
        #    'building_list' => $building_list,
        );
        $locationForm = $CI->parser->parse('locations/add_building_form', $data, true);
        return $locationForm;
    }
	
	#==============User add form===========#

    public function slot_add_form() {
        $CI = & get_instance();
		$CI->load->model('Aislelocation');
		$aisle_list = $CI->Aislelocation->location_list();
		$data = array(
            'title' => 'Add Slot',
            'aisle_list' => $aisle_list,
        #    'building_list' => $building_list,
        );
        $locationForm = $CI->parser->parse('locations/add_slot_form', $data, true);
        return $locationForm;
    }
	
	#==============User add form===========#

    public function level_add_form() {
        $CI = & get_instance();
		$CI->load->model('Aislelocation');
		$CI->load->model('Locationm');
		$slot_list = $CI->Locationm->slot_list();
		$data = array(
            'title' => 'Add Level',
            'slot_list' => $slot_list,
        #    'building_list' => $building_list,
        );
        $locationForm = $CI->parser->parse('locations/add_level_form', $data, true);
        return $locationForm;
    }
	
	#==============User add form===========#

    public function bin_add_form() {
        $CI = & get_instance();
		$CI->load->model('Aislelocation');
		$CI->load->model('Locationm');
		$level_list = $CI->Locationm->level_list();
		$data = array(
            'title' => 'Add Bin',
            'level_list' => $level_list,
        #    'building_list' => $building_list,
        );
        $locationForm = $CI->parser->parse('locations/add_bin_form', $data, true);
        return $locationForm;
    }


    #================Insert user==========#

    public function insert_location($data) {
        $CI = & get_instance();
        $CI->load->model('Locationm');
       $result = $CI->Locationm->location_entry($data);
        return $result;
    }
	
	#================Insert user==========#

    public function insert_building($data) {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $CI->Locationm->building_entry($data);
        return true;
    }
	
	#================Insert user==========#

    public function insert_slot($data) {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $CI->Locationm->slot_entry($data);
        return true;
    }
	
	#================Insert user==========#

    public function insert_level($data) {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $CI->Locationm->level_entry($data);
        return true;
    }
	
	#================Insert user==========#

    public function insert_bin($data) {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $CI->Locationm->bin_entry($data);
        return true;
    }


    #===============User edit form==============#

    public function location_edit_data($location_id) {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $location_detail = $CI->Locationm->retrieve_location_editdata($location_id);
        $data1 = (array)$CI->Locationm->retrieve_location_editdata($location_id);
	
        $CI->load->model('Aislelocation');
        $location_list = $CI->Aislelocation->location_list();
        $data = array(
            'title' => 'Edit location',
            'location_list' => $location_list,
            'locdata' => $data1
        );


        $locationList = $CI->parser->parse('locations/edit_location_form', $data, true);
        return $locationList;
    }
	
	#===============User edit form==============#

    public function building_edit_data($location_id) {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $location_detail = $CI->Locationm->retrieve_building_editdata($location_id);
        $data1 = (array)$CI->Locationm->retrieve_building_editdata($location_id);

        $data = array(
            'title' => 'Edit location',
            'locdata' => $data1
        );
        $locationList = $CI->parser->parse('locations/edit_building_form', $data, true);
        return $locationList;
    }
	
	#===============User edit form==============#

    public function slot_edit_data($slot_id) {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $location_detail = $CI->Locationm->retrieve_slot_editdata($slot_id);
        $data1 = (array)$CI->Locationm->retrieve_slot_editdata($slot_id);
		
		$CI->load->model('Aislelocation');
        $location_list = $CI->Aislelocation->location_list();
        $data = array(
            'title' => 'Edit Slot',
            'locdata' => $data1,
			'aisle_list' => $location_list,
        );
        $locationList = $CI->parser->parse('locations/edit_slot_form', $data, true);
        return $locationList;
    }
	
	#===============User edit form==============#

    public function level_edit_data($level_id) {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $location_detail = $CI->Locationm->retrieve_level_editdata($level_id);
        $data1 = (array)$CI->Locationm->retrieve_level_editdata($level_id);
		$slot_list = $CI->Locationm->slot_list();
		$CI->load->model('Aislelocation');
        $location_list = $CI->Aislelocation->location_list();
        $data = array(
            'title' => 'Edit Slot',
            'locdata' => $data1,
			'slot_list' => $slot_list,
        );
        $locationList = $CI->parser->parse('locations/edit_level_form', $data, true);
        return $locationList;
    }
	
	
	#===============User edit form==============#

    public function bin_edit_data($bin_id) {
        $CI = & get_instance();
        $CI->load->model('Locationm');
        $location_detail = $CI->Locationm->retrieve_bin_editdata($bin_id);
        $data1 = (array)$CI->Locationm->retrieve_bin_editdata($bin_id);
		$level_list = $CI->Locationm->level_list();
		$CI->load->model('Aislelocation');
        
        $data = array(
            'title' => 'Edit Slot',
            'locdata' => $data1,
			'level_list' => $level_list,
        );
        $locationList = $CI->parser->parse('locations/edit_bin_form', $data, true);
        return $locationList;
    }
	
	

}

?>