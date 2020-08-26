<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shipping extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    #============Count Company=============#

    public function count_location() {
        return $this->db->count_all("locations");
    }

    #=============User List=============#

    public function shipping_list($r_id) {
        $this->db->select('shipping_method.*');
        $this->db->from('shipping_method');
        $this->db->where('r_id',$r_id);
       //	 $this->db->join('user_login', 'locations.created_by = user_login.user_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    #==============User search list==============#

    public function location_search_item($location_id) {
        $this->db->select('locations.*,user_login.user_type');
        $this->db->from('user_login');
        $this->db->join('locations', 'locations.created_by = user_login.user_id');
        $this->db->where('locations.id', $location_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    #============Insert user to database========#

    public function shipping_entry($data) {
        $r_id = $data['r_id'];
        $this->db->select('shipping_method.*');
        $this->db->from('shipping_method');
        $this->db->where('shipping_method.shipping_name', $data['shipping_name']);
        $this->db->where('r_id',$r_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            $location_data = array(
            'shipping_name' => $data['shipping_name'],
            'created_by' => $data['created_by'],
            'r_id' => $r_id,
            'updated_at' => date('yyyy-mm-dd h:i:s')
        ); 
        $this->db->insert('shipping_method', $location_data);
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

    public function retrieve_shipping_editdata($location_id) {

        $this->db->select('shipping_method.*');
        $this->db->from('shipping_method');
        $this->db->where('shipping_method.id', $location_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    #==============Update company==================#

    public function update_shipping($shipping_id) {
        /*$this->db->select('locations.*');
        $this->db->from('locations');
        $this->db->where('locations.location_name', $data['location_name']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{*/
            $data = array(
                'shipping_name' => $this->input->post('shipping_name')
            );
           #echo '<pre>';        print_r($data);die();
            $this->db->where('id', $shipping_id);
            $this->db->update('shipping_method', $data);
            return true;
       /// }
    }

    #===========Delete user item========#

    public function delete_shipping($location_id) {
        $this->db->where('id', $location_id);
        $this->db->delete('shipping_method');
        return true;
    }
	
	public function retrieve_location_uniquedata($locataion_id) {

        $this->db->select('*');

        $this->db->from('locations');

        $this->db->where('location_unique_key', $locataion_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }
	
	//all customer List

    public function all_shipping_list($r_id) {

        $this->db->select('shipping_method.*');

        $this->db->from('shipping_method');
        $this->db->where('r_id',$r_id);

        #$this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

        #$this->db->group_by('customer_transection_summary.customer_id');

        $query = $this->db->get();
       # echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }

}
