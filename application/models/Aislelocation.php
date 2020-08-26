<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aislelocation extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    #============Count Company=============#

    public function count_location() {
        return $this->db->count_all("aislelocations");
    }

    #=============User List=============#

    public function location_list() {
        $this->db->select('aislelocations.*, building.building_name');
        $this->db->from('aislelocations');
		$this->db->join('building', 'building.id = aislelocations.building_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    #==============User search list==============#

    public function location_search_item($location_id) {
        $this->db->select('aislelocations.*,user_login.user_type');
        $this->db->from('user_login');
        $this->db->join('aislelocations', 'aislelocations.created_by = user_login.user_id');
        $this->db->where('aislelocations.id', $location_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    #============Insert user to database========#

    public function location_entry($data) {
        $this->db->select('aislelocations.*');
        $this->db->from('aislelocations');
        $this->db->where('aislelocations.location_name', $data['location_name']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            $location_data = array(
            'location_name' => $data['location_name'],
            'building_id' => $data['building_id'],
            'created_by' => $data['created_by'],
            'updated_at' => date('yyyy-mm-dd h:i:s'),
            "location_unique_key" => time()
        ); 
        $this->db->insert('aislelocations', $location_data);
        return true;    
        }
        
        /*foreach ($query->result() as $row) {
            $json_product[] = array('label' => $row->first_name, 'value' => $row->user_id);
        }
        $cache_file = './my-assets/js/admin_js/json/user.json';
        $productList = json_encode($json_product);
        file_put_contents($cache_file, $productList);*/

       
    }

    #==============User edit data===============#

    public function retrieve_location_editdata($location_id) {

        $this->db->select('aislelocations.*');
        $this->db->from('aislelocations');
        $this->db->where('aislelocations.id', $location_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    #==============Update company==================#

    public function update_location($location_id) {
        /*$this->db->select('locations.*');
        $this->db->from('locations');
        $this->db->where('locations.location_name', $data['location_name']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{*/
            $data = array(
                'location_name' => $this->input->post('location_name'),
                'building_id' => $this->input->post('building_id')
            );
    //        echo '<pre>';        print_r($data);die();
            $this->db->where('id', $location_id);
            $this->db->update('aislelocations', $data);
		#	echo $this->db->last_query();die;
            return true;
       /// }
    }

    #===========Delete user item========#

    public function delete_location($location_id) {
        $flag = 0;
		$this->db->select('*');
		$this->db->from('locations');
		$this->db->where('locations.parent_location_id',$location_id);
		$this->db->join('inventory_locations', 'locations.location_unique_key = inventory_locations.location_unique_key');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$flag = 1;
		}
		if($flag==0){
			$this->db->where('id', $location_id);
			$this->db->delete('aislelocations');
			return 1;
		}else{
			return 0;
		}
    }
	
	public function retrieve_location_uniquedata($locataion_id) {

        $this->db->select('*');

        $this->db->from('aislelocations');

        $this->db->where('location_unique_key', $locataion_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }
	
	 public function building_list() {
        $this->db->select('building.*');
        $this->db->from('building');
       //	 $this->db->join('user_login', 'locations.created_by = user_login.user_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	public function getAisleLocation($building_id) {
        $this->db->select('aislelocations.*');
        $this->db->from('aislelocations');
        $this->db->where('building_id', $building_id);
       //	 $this->db->join('user_login', 'locations.created_by = user_login.user_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

}
