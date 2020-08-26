<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categories extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	//customer List
	public function category_list($r_id)
	{
		$this->db->select('*');
		$this->db->from('product_category');
		#$this->db->where('status',1);
		$this->db->where('r_id',$r_id);
		$this->db->order_by('product_category.id', 'desc');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}	
	
	
	//customer List
	public function category_list_product()
	{
		$r_id=$this->session->r_id;	
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->where('status',1);
		$this->db->where('r_id',$r_id);
		$this->db->order_by('product_category.category_name', 'asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//customer List
	public function category_list_count()
	{
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->where('status',1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();	
		}
		return false;
	}
	//Category Search Item
	public function category_search_item($category_id)
	{
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->where('category_id',$category_id);
		#$this->db->limit('500');
		$query = $this->db->get();
		#echo $this->db->last_query();die;
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Count customer
	public function category_entry($data)
	{
		// print_r($data['r_id']);die;
		$data_check=array(
			'r_id'=>$data['r_id'],
			'category_name'=>$data['category_name'],
		);
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->where('status',1);
		$this->db->where($data_check);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return FALSE;
		}else{
			// $CI = & get_instance();
            // $CI->load->library('session'); 
            // $CI->load->model('users'); 
			// $email = $this->session->userdata('username');
			// $result = $this->users->check_email($email);    
			// // print_r($result);       
            //    foreach($result as $row){ 
            //     $r_id= $row->r_id;
    
            //    }
			//    print_r($r_id);
			//    die;
			$this->db->insert('product_category',$data);
			return TRUE;
		}
	}
	//Retrieve customer Edit Data
	public function retrieve_category_editdata($r_id,$category_id)
	{
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->where('category_id',$category_id);
		$this->db->where('r_id',$r_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	//Update Categories
	public function update_category($r_id,$data,$category_id)
	{
		$this->db->where('category_id',$category_id);		
		$this->db->where('r_id',$r_id);
		$this->db->update('product_category',$data);
		return true;
	}
	// Delete customer Item
	public function delete_category($category_id)
	{	
		$this->db->select('*');
		$this->db->from('product_information');
		$this->db->where('category_id',$category_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return false;//$query->result_array();	
		}else{
			$this->db->where('category_id',$category_id);
			$this->db->delete('product_category');
			return true;
		}
	}
	
	public function check_category_name($category_name){
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->where('category_name',$category_name);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}
}