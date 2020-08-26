<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ccategory extends CI_Controller {
	public $menu;
	function __construct() {
      parent::__construct();
		$this->load->library('auth');
		$this->load->library('lcategory');
		$this->load->library('session');
		$this->load->model('Categories');
		// $this->auth->check_admin_auth();
		$this->template->current_menu = 'category';
		
		$this->load->model('Web_settings');
		$this->Web_settings->checkLicensing();
		
    }
	//Default loading for Category system.
	public function index()
	{
		if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
       else{ 
		$content = $this->lcategory->category_add_form();
	//Here ,0 means array position 0 will be active class
		$this->template->full_admin_html_view($content);
	}
}
	//Product Add Form
	public function manage_category()
	{
	    $r_id=$this->session->r_id;
		if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
       else{ 
        $content =$this->lcategory->category_list($r_id);
		$this->template->full_admin_html_view($content);
	   }
	}
	//Insert Product and upload
	public function insert_category()
	{
		
		$CI = & get_instance();
		$CI->load->library('session'); 
		$CI->load->model('users'); 
		$r_id=$this->session->r_id;
		$email = $this->session->userdata('username');
		$result = $this->users->check_email($email);
		// print_r($this->session->r_id) ;exit;   
		
		$category_id=$this->auth->generator(15);

	  	//Customer  basic information adding.
		$data=array(
			'category_id' 			=> $category_id,
			'category_name' 		=> $this->input->post('category_name'),
			'status' 				=> 1,
			'r_id'					=> $r_id
			);

		$result=$this->Categories->category_entry($data);
		// $this->manage_category($r_id);
		if ($result == TRUE) {
			//Previous balance adding -> Sending to customer model to adjust the data.			
			$this->session->set_userdata(array('message'=>display('successfully_added')));
			if(isset($_POST['add-customer'])){
				redirect(base_url('Ccategory/manage_category/'.$r_id));
				// $this->manage_category($r_id);
				exit;
			}elseif(isset($_POST['add-customer-another'])){
				redirect(base_url('Ccategory'));
				exit;
			}
		}else{
			$this->session->set_userdata(array('error_message'=>display('already_inserted')));
			redirect(base_url('Ccategory'));
		}
	}
	//customer Update Form
	public function category_update_form($r_id,$category_id)
	{	
	
		if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
		$content = $this->lcategory->category_edit_data($r_id,$category_id);
		$this->menu=array('label'=> 'Edit Category', 'url' => 'Ccustomer');
		$this->template->full_admin_html_view($content);
	}}
	// customer Update
	public function category_update($r_id)
	{
		$this->load->model('Categories');
		$category_id  = $this->input->post('category_id');
		$data=array(
			'category_name' => $this->input->post('category_name'),
			'status' 		=> $this->input->post('status'),
			);

		$this->Categories->update_category($r_id,$data,$category_id);
		$this->session->set_userdata(array('message'=>display('successfully_updated')));
		redirect(base_url('Ccategory/manage_category/'.$r_id));
		exit;
	}
	// product_delete
	public function category_delete()
	{	
		$this->load->model('Categories');
		$category_id =  $_POST['category_id'];
		$cat = $this->Categories->delete_category($category_id);

		print_r($cat);die;

		if($cat){	
			$this->session->set_userdata(array('message'=>display('successfully_delete')));		
		}else{			
			$this->session->set_userdata(array('error_message'=>"This Category is already assigned to products, you can not delete it."));		
		}
		redirect(base_url('Ccategory'));		
		return $cat;
			
	}
	
	public function checkCategoryname(){ 
		$this->load->model('Categories');
		$category_name =  $_POST['category_name'];
		$cat = $this->Categories->check_category_name($category_name);		
		if($cat){	
			echo "1";
		}else{			
			echo "0";
		}
		exit();
	}
	
	//Retrieve Single Item  By Search
    public function category_by_search() { #print_r($_POST);die; 
        $CI = & get_instance();
        // $this->auth->check_admin_auth();
        $CI->load->library('lcategory');
        $category_id = $this->input->post('product_id');

        $content = $CI->lcategory->category_search_list($category_id);
        $sub_menu = array(
            array('label' => 'Manage Category', 'url' => 'Ccategory', 'class' => 'active'),
            array('label' => 'Add Category', 'url' => 'Ccategory/manage_category')
        );
        $this->template->full_admin_html_view($content, $sub_menu);
    }
}