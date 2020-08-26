<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Locationm extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    #============Count Company=============#

    public function count_location() {
        return $this->db->count_all("locations");
    }

    #=============User List=============#

    public function location_list($r_id) {
        // print_r($r_id);die;
        $this->db->select('locations.*, aislelocations.location_name as aislelocationname, aislelocations.location_unique_key as aislelocationuniquekey');
        $this->db->from('locations');
        $this->db->join('aislelocations', 'locations.parent_location_id = aislelocations.id','left');
        $this->db->where('locations.r_id',$r_id);
        $this->db->where('aislelocations.r_id',$r_id);
        // print_r($this->db);die;
        $query = $this->db->get();
        // print_r( $query);die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	#=============User List=============#

    public function building_list() {
        $this->db->select('building.*');
        $this->db->from('building');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	#=============User List=============#

    public function slot_list() {
        $this->db->select('slots.*, aislelocations.location_name');
        $this->db->from('slots');
		$this->db->join('aislelocations', 'aislelocations.id = slots.aisle_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	#=============User List=============#

    public function level_list() {
        $this->db->select('Levels.*, slots.slot_name');
        $this->db->from('Levels');
		$this->db->join('slots', 'slots.id = Levels.slot_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	#=============User List=============#

    public function bin_list() {
        $this->db->select('bins.*, Levels.level_name');
        $this->db->from('bins');
		$this->db->join('Levels', 'Levels.id = bins.level_id');
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

    public function location_entry($data) {
		$location_name = str_replace(" ", "-", $data['location_name']);
		$location_name = chop($location_name, "-");
		$location_unique_key = str_replace(" ", "", $data['location_name']);
        $this->db->select('locations.*');
        $this->db->from('locations');
        $this->db->where('locations.location_name', $location_name);
        $query = $this->db->get();
		if ($query->num_rows() > 0) {
            return false;
        }else{
			$location_data = array(
            'location_name' => $location_name,
            'created_by' => $data['created_by'],
            'updated_at' => date('Y-m-d h:i:s'),
            "location_unique_key" => $location_unique_key
        ); 
        $this->db->insert('locations', $location_data);
        return true;    
        }
        
        /*foreach ($query->result() as $row) {
            $json_product[] = array('label' => $row->first_name, 'value' => $row->user_id);
        }
        $cache_file = './my-assets/js/admin_js/json/user.json';
        $productList = json_encode($json_product);
        file_put_contents($cache_file, $productList);*/

       
    }
	
	 #============Insert user to database========#

    public function building_entry($data) {
        $this->db->select('building.*');
        $this->db->from('building');
        $this->db->where('building.building_name', $data['building_name']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            $location_data = array(
            'building_name' => $data['building_name'],
            'created_by' => $data['created_by'],
            'updated_at' => date('yyyy-mm-dd h:i:s')
        ); 
        $this->db->insert('building', $location_data);
        return true;    
        }
        
        /*foreach ($query->result() as $row) {
            $json_product[] = array('label' => $row->first_name, 'value' => $row->user_id);
        }
        $cache_file = './my-assets/js/admin_js/json/user.json';
        $productList = json_encode($json_product);
        file_put_contents($cache_file, $productList);*/

       
    }
	
	 #============Insert user to database========#

    public function slot_entry($data) {
        $this->db->select('slots.*');
        $this->db->from('slots');
        $this->db->where('slots.slot_name', $data['slot_name']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
			$aisledata = explode("###", $data['aisle_id']);
            $location_data = array(
            'slot_name' => $data['slot_name'],
            'aisle_id' => $aisledata[0],
            'building_id' => $aisledata[1],
            'created_by' => $data['created_by'],
            'updated_at' => date('yyyy-mm-dd h:i:s')
        ); 
        $this->db->insert('slots', $location_data);
        return true;    
        }
    }
	
	#============Insert user to database========#

    public function level_entry($data) {
        $this->db->select('Levels.*');
        $this->db->from('Levels');
        $this->db->where('Levels.level_name', $data['level_name']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
			$aisledata = explode("###", $data['slot_id']);
            $location_data = array(
            'level_name' => $data['level_name'],
            'slot_id' => $aisledata[0],
            'aisle_id' => $aisledata[1],
            'building_id' => $aisledata[2],
            'created_by' => $data['created_by'],
            'updated_at' => date('yyyy-mm-dd h:i:s')
        ); 
        $this->db->insert('Levels', $location_data);
        return true;    
        }
    }
	
	
	#============Insert user to database========#

    public function bin_entry($data) {#print_r($_POST);die;
        $this->db->select('bins.*');
        $this->db->from('bins');
        $this->db->where('bins.bin_name', $data['bin_name']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
			$aisledata = explode("###", $data['level_id']);
            $location_data = array(
            'bin_name' => $data['bin_name'],
            'level_id' => $aisledata[0],
            'slot_id' => $aisledata[1],
            'aisle_id' => $aisledata[2],
            'building_id' => $aisledata[3],
            'created_by' => $data['created_by'],
            'updated_at' => date('yyyy-mm-dd h:i:s')
        ); 
        $this->db->insert('bins', $location_data);
        return true;    
        }
    }


    #==============User edit data===============#

    public function retrieve_location_editdata($location_id) {

        $this->db->select('locations.*, aislelocations.location_name as aislelocationname, aislelocations.location_unique_key as aislelocationuniquekey');
        $this->db->from('locations');
        $this->db->join('aislelocations', 'locations.parent_location_id = aislelocations.id', 'left');

        $this->db->where('locations.id', $location_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
	
	#==============User edit data===============#

    public function retrieve_building_editdata($building_id) {

        $this->db->select('building.*');
        $this->db->from('building');
        
        $this->db->where('building.id', $building_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
	
	
	
	#==============User edit data===============#

    public function retrieve_slot_editdata($slot_id) {

        $this->db->select('slots.*');
        $this->db->from('slots');
        
        $this->db->where('slots.id', $slot_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
	
	#==============User edit data===============#

    public function retrieve_level_editdata($level_id) {

        $this->db->select('Levels.*');
        $this->db->from('Levels');
        
        $this->db->where('Levels.id', $level_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
	
	#==============User edit data===============#

    public function retrieve_bin_editdata($bin_id) {

        $this->db->select('bins.*');
        $this->db->from('bins');
        
        $this->db->where('bins.id', $bin_id);
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
                'parent_location_id' => $this->input->post('parent_location_id')
            );
    //        echo '<pre>';        print_r($data);die();
            $this->db->where('id', $location_id);
            $this->db->update('locations', $data);
            return true;
       /// }
    }
	
	
	#==============Update company==================#

    public function update_building($building_id) {
        
	        $data = array(
                'building_name' => $this->input->post('building_name')
            );
            $this->db->where('id', $building_id);
            $this->db->update('building', $data);
            return true;
    }
	
	#==============Update company==================#

    public function update_slot($post) {
			$aisledata = explode("###", $post['aisle_id']);
	        $data = array(
                'slot_name' => $this->input->post('slot_name'),
                'aisle_id' => $aisledata[0],
                'building_id' => $aisledata[1]
            );
            $this->db->where('id', $post['slot_id']);
            $this->db->update('slots', $data);
            return true;
    }
	
	#==============Update company==================#

    public function update_level($post) {
			$aisledata = explode("###", $post['slot_id']);
	        $data = array(
                'level_name' => $this->input->post('level_name'),
                'slot_id' => $aisledata[0],
                'aisle_id' => $aisledata[1],
                'building_id' => $aisledata[2],
            );
			$level_id = $post['level_id'];
            $this->db->where('id', $level_id);
            $this->db->update('Levels', $data);
            return true;
    }
	
	#==============Update company==================#

    public function update_bin($post) {
			$aisledata = explode("###", $post['level_id']);
	        $data = array(
                'bin_name' => $this->input->post('bin_name'),
                'level_id' => $aisledata[0],
				'slot_id' => $aisledata[1],
				'aisle_id' => $aisledata[2],
				'building_id' => $aisledata[3],
            );
			#echo "dafd";print_r($data);print_r($post);die;
            $this->db->where('id', $post['bin_id']);
            $this->db->update('bins', $data);
            return true;
    }
	
	
    #===========Delete user item========#

    public function delete_location($location_id) {
		$flag = 0;
		$this->db->select('*');
		$this->db->from('locations');
		$this->db->where('locations.id',$location_id);
		$this->db->join('inventory_locations', 'locations.location_unique_key = inventory_locations.location_unique_key');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$flag = 1;
		}
		if($flag==0){
        $this->db->where('id', $location_id);
        $this->db->delete('locations');
			return 1;
		}else{
			return 0;
		}
    }
	
	#===========Delete user item========#

    public function delete_building($building_id) {
		
        $this->db->where('id', $building_id);
        $this->db->delete('building');
		return 1;
		
    }
	
	#===========Delete user item========#

    public function delete_slot($slot_id) {
		
        $this->db->where('id', $slot_id);
        $this->db->delete('slots');
		return 1;
		
    }
	
	#===========Delete user item========#

    public function delete_level($level_id) {
		
        $this->db->where('id', $level_id);
        $this->db->delete('Levels');
		return 1;
		
    }
	
	#===========Delete user item========#

    public function delete_bin($bin_id) {
		
        $this->db->where('id', $bin_id);
        $this->db->delete('bins');
		return 1;
		
    }
	
	public function retrieve_location_uniquedata($r_id,$locataion_id) {

        $this->db->select('*');

        $this->db->from('locations');

        $this->db->where('location_unique_key', $locataion_id);

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
	
	public function getSlotLocation($aisle_id) {
        $this->db->select('slots.*');
        $this->db->from('slots');
        $this->db->where('aisle_id', $aisle_id);
       //	 $this->db->join('user_login', 'locations.created_by = user_login.user_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	public function getLevelLocation($slot_id) {
        $this->db->select('Levels.*');
        $this->db->from('Levels');
        $this->db->where('slot_id', $slot_id);
       //	 $this->db->join('user_login', 'locations.created_by = user_login.user_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	public function getBinLocation($level_id) {
        $this->db->select('bins.*');
        $this->db->from('bins');
        $this->db->where('level_id', $level_id);
       //	 $this->db->join('user_login', 'locations.created_by = user_login.user_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	public function import_location($r_id,$files){

        // print_r($r_id);die;
		#echo "here in this model";
		echo "<pre>";
		#print_r($files);
		
		$count=0;
        $fp = fopen($_FILES['customer']['tmp_name'],'r') or die("can't open file");
		$insert = [];
        while($csv_line = fgetcsv($fp,1024))
        {
            $count++;
            if($count == 1)
            {
                continue;
            }//keep this if condition if you want to remove the first row
            
				#print_r($csv_line);die;
				$data = array();
				if($csv_line[0]!='' && !empty($csv_line[0])){
					$data['building_name'] = $csv_line[0];
				}else{
					$this->session->set_userdata(array('error_message' => "Building Name is required field"));
					redirect('Clocation/import_locations/'.$r_id);
				}
				
				if($csv_line[1]!='' && !empty($csv_line[1])){
					$data['aisle_name'] = $csv_line[1];
				}else{
					$this->session->set_userdata(array('error_message' => "Aisle Name is required field"));
					redirect('Clocation/import_locations/'.$r_id);
				}
				
				if($csv_line[2]!='' && !empty($csv_line[2])){
					$data['slot_name'] = $csv_line[2];
				}else{
					$this->session->set_userdata(array('error_message' => "Slot name is required field"));
					redirect('Clocation/import_locations/'.$r_id);
				}
				
				if($csv_line[3]!='' && !empty($csv_line[3])){
					$data['level_name'] = $csv_line[3];
				}else{
					$this->session->set_userdata(array('error_message' => "Level name is required field"));
					redirect('Clocation/import_locations/'.$r_id);
				}
				
				if($csv_line[4]!='' && !empty($csv_line[4])){
					$data['bin_name'] = $csv_line[4];
				}else{
					$this->session->set_userdata(array('error_message' => "Bin name is required field"));
					redirect('Clocation/import_locations/'.$r_id);
				}
				
				if($csv_line[5]!='' && !empty($csv_line[5])){
					$data['location_name'] = $csv_line[5];
				}else{
					$this->session->set_userdata(array('error_message' => "Location name is required field"));
					redirect('Clocation/import_locations/'.$r_id);
				}
				
				if($csv_line[6]!='' && !empty($csv_line[6])){
					$data['location_unique_key'] = $csv_line[6];
				}else{
					$this->session->set_userdata(array('error_message' => "Location Barcode is required field"));
					redirect('Clocation/import_locations/'.$r_id);
				}
				
				
				
				
				
				
				
				
				$insert[] = $data;
        }
        
        // print_r($insert);die;
		/* print_r($insert);die; */
		foreach($insert as $inserts){
            // print_r($insert);die;
            // print_r("haha");die;
			//building insert
			$this->db->select('*');
			$this->db->from('building');
            $this->db->where('building_name', $inserts['building_name']);
            $this->db->where('r_id',$r_id);
            // print_r("haha");die;
            $query = $this->db->get();
            //  print_r($query->num_rows());die;
				if ($query->num_rows() > 0) {
                    // print_r("haha");die;
					#$this->session->set_userdata(array('error_message' => "Building Name ".$inserts['building_name']." already exists."));
					#redirect('Clocation/import_locations');
				} 
				 else {
                    //  print_r("haha");die;
					$data = array("building_name"=>$inserts['building_name'],"r_id"=>$r_id);
					$this->db->insert('building', $data);
					$building_id = $this->db->insert_id();
				}
			
			
			
			//Aisle insert
			/*$this->db->select('id');
			$this->db->from('building');
			$this->db->where("building_name", $inserts['building_name']);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				$getdata =  $query->result_array();
			}*/
			
			$getbuildingid = $this->getNameByFlag(1, $inserts['building_name']);
			
			$this->db->select('*');
			$this->db->from('aislelocations');
			$this->db->where('location_name', $inserts['aisle_name']);
            $this->db->where('building_id', $getbuildingid);
            $this->db->where('r_id',$r_id);
            $query = $this->db->get();
            // print_r($query);die;
				if ($query->num_rows() > 0) {
					echo 123;
					#$this->session->set_userdata(array('error_message' => "Aisle Location Name ".$inserts['aisle_name']." already exists."));
					#redirect('Clocation/import_locations');
				} 
				 else {
					$data = array("location_name"=>$inserts['aisle_name'], "building_id"=>$getbuildingid,"r_id"=>$r_id);
					$this->db->insert('aislelocations', $data);
                    $aisle_id = $this->db->insert_id();

				}
                // echo  $aisle_id;die;
			
			//Slot insert
           
			$getaisleid = $this->getNameByFlag(2, $inserts['aisle_name']);
			
			
			$this->db->select('*');
			$this->db->from('slots');
			$this->db->where('slot_name', $inserts['slot_name']);
			$this->db->where('building_id', $getbuildingid);
            $this->db->where('aisle_id', $getaisleid);
            $this->db->where('r_id',$r_id);
			$query = $this->db->get();
				if ($query->num_rows() > 0) {
					#$this->session->set_userdata(array('error_message' => "Slot Name ".$inserts['slot_name']." already exists."));
					#redirect('Clocation/import_locations');
				} 
				 else {
					$data = array("slot_name"=>$inserts['slot_name'], "building_id"=>$getbuildingid, "aisle_id"=>$getaisleid,"r_id"=>$r_id);
					$this->db->insert('slots', $data);
					$slot_id = $this->db->insert_id();
				}
			
			
			//Level insert
			
			$getslotid = $this->getNameByFlag(3, $inserts['slot_name']);
			
			
			$this->db->select('*');
			$this->db->from('Levels');
			$this->db->where('level_name', $inserts['level_name']);
			$this->db->where('building_id', $getbuildingid);
			$this->db->where('aisle_id', $getaisleid);
            $this->db->where('slot_id', $getslotid);
            $this->db->where('r_id',$r_id);
			$query = $this->db->get();
				if ($query->num_rows() > 0) {
					#$this->session->set_userdata(array('error_message' => "Level Name ".$inserts['level_name']." already exists."));
					#redirect('Clocation/import_locations');
				} 
				 else {
					$data = array("level_name"=>$inserts['level_name'], "building_id"=>$getbuildingid, "aisle_id"=>$getaisleid, "slot_id"=>$getslotid,"r_id"=>$r_id);
					$this->db->insert('Levels', $data);
					$level_id = $this->db->insert_id();
				}
			
			
			//Bin insert
			
			$getlevelid = $this->getNameByFlag(4, $inserts['level_name']);
			
			
			$this->db->select('*');
			$this->db->from('bins');
			$this->db->where('bin_name', $inserts['bin_name']);
			$this->db->where('building_id', $getbuildingid);
			$this->db->where('aisle_id', $getaisleid);
			$this->db->where('slot_id', $getslotid);
            $this->db->where('level_id', $getlevelid);
            $this->db->where('r_id',$r_id);
			$query = $this->db->get();
				if ($query->num_rows() > 0) {
					#$this->session->set_userdata(array('error_message' => "Bin Name ".$inserts['bin_name']." already exists."));
					#redirect('Clocation/import_locations');
				} 
				 else {
					$data = array("bin_name"=>$inserts['bin_name'], "building_id"=>$getbuildingid, "aisle_id"=>$getaisleid, "slot_id"=>$getslotid, "level_id"=>$getlevelid,"r_id"=>$r_id);
					$this->db->insert('bins', $data);
					$bin_id = $this->db->insert_id();
				}
			
			
			// location insert
			
			$getbinid = $this->getNameByFlag(5, $inserts['bin_name']);
			
            // echo $aisle_id;die;
			$this->db->select('*');
			$this->db->from('locations');
            $this->db->where('location_name', $inserts['location_name']);
            $this->db->where('r_id',$r_id);
            $query = $this->db->get();
            // print_r($query);die;
				if ($query->num_rows() > 0) {
					#$this->session->set_userdata(array('error_message' => "Location Name ".$inserts['location_name']." already exists."));
					#redirect('Clocation/import_locations');
                } 
               
				 else {
                    
					$data = array("location_name"=>$inserts['location_name'], "location_unique_key"=>$inserts['location_unique_key'], "building_id"=>$getbuildingid,"parent_location_id"=>$aisle_id,"aisle_id"=>$getaisleid, "slot_id"=>$getslotid, "level_id"=>$getlevelid, "bin_id"=>$getbinid,"r_id"=>$r_id);
					$this->db->insert('locations', $data);
				}
			}
        fclose($fp) or die("can't close file");
        $this->session->set_userdata(array('message' => "Locations import Successfully"));
		redirect('Clocation/import_locations/'.$r_id);
		
	}
	
	public function getNameByFlag($flag, $name){
		if($flag==1){
			//building
			$this->db->select('id');
			$this->db->from('building');
			$this->db->where("building_name", $name);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				$getdata =  $query->result_array();
				return $getdata[0]['id'];
			}
		}elseif($flag==2){
			//aisle
			$this->db->select('id');
			$this->db->from('aislelocations');
			$this->db->where("location_name", $name);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				$getdata =  $query->result_array();
				return $getdata[0]['id'];
			}
		}elseif($flag==3){
			//slots
			$this->db->select('id');
			$this->db->from('slots');
			$this->db->where("slot_name", $name);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				$getdata =  $query->result_array();
				return $getdata[0]['id'];
			}
		}elseif($flag==4){
			//level
			$this->db->select('id');
			$this->db->from('Levels');
			$this->db->where("level_name", $name);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				$getdata =  $query->result_array();
				return $getdata[0]['id'];
			}
		}elseif($flag==5){
			//bins
			$this->db->select('id');
			$this->db->from('bins');
			$this->db->where("bin_name", $name);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				$getdata =  $query->result_array();
				return $getdata[0]['id'];
			}
		}elseif($flag==6){
			//locations
		}
		
	}
}
