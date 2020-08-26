<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cpurchase extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'purchase';
		$this->load->model('Web_settings');
		$this->Web_settings->checkLicensing();
    }
	public function index()
	{	
		if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
              // $this->auth->check_admin_auth();
        }
       else{
	    $r_id = $this->session->r_id;
		$CI =& get_instance();
		// $CI->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		$content = $CI->lpurchase->purchase_add_form($r_id);
		$this->template->full_admin_html_view($content);
		
	}
}
	//Product Add Form
	public function manage_purchase($r_id)
	{
		$CI =& get_instance();
		// print_r($r_id);die;
		// $this->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		$CI->load->model('Purchases');
        // print_r($this->session->userdata('username'));die;	

		if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
       else{ 
        $config["base_url"] = base_url('Cpurchase/manage_purchase/'.$r_id);
        $config["total_rows"] = $this->Purchases->count_purchase($r_id);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config["num_links"] = 5; 
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #  
		
        $content =$this->lpurchase->purchase_list($links,$config["per_page"],$page, $_POST,$r_id);
      
		$this->template->full_admin_html_view($content);
	   }
	}
	//Insert Product and uload
	public function insert_purchase()
	{	#echo "test";die;
		$r_id=$this->session->r_id;
		$CI =& get_instance();
		// $CI->auth->check_admin_auth();
		$CI->load->model('Purchases');
		$CI->Purchases->purchase_entry($r_id);
		$this->session->set_userdata(array('message'=>display('successfully_added')));
		if(isset($_POST['add-purchase'])){
			redirect(base_url('Cpurchase/manage_purchase/'.$r_id));
			exit;
		}elseif(isset($_POST['add-purchase-another'])){
			redirect(base_url('Cpurchase'));
			exit;
		}
	}
	//purchase Update Form
	public function purchase_update_form($r_id,$purchase_id)
	{	
		$CI =& get_instance();
		// $CI->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		
			if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
		$content = $CI->lpurchase->purchase_edit_data($r_id,$purchase_id);
		$this->template->full_admin_html_view($content);
	}}
	// purchase Update
	public function purchase_update($r_id)
	{
	
		$CI =& get_instance();
		// $CI->auth->check_admin_auth();
		$CI->load->model('Purchases');
		$CI->Purchases->update_purchase($r_id);
		$this->session->set_userdata(array('message'=>display('successfully_updated')));
		redirect(base_url('Cpurchase/manage_purchase/'.$r_id));
		exit;
	}
	// product_delete
	public function purchase_delete()
	{	
		$CI =& get_instance();
		// $this->auth->check_admin_auth();
		$CI->load->model('Purchases');
		$purchase_id =  $_POST['purchase_id'];
		$result = $CI->Purchases->delete_purchase($purchase_id);
		if($result){
			$this->session->set_userdata(array('message'=>display('successfully_delete')));
			return true;
		}else{
			$this->session->set_userdata(array('error_message'=>"You can not delete this purchase order as its using in calculation system."));
			return false;
		}
		
			
	}
	//Purchase item by search
	public function purchase_item_by_search()
	{
		$CI =& get_instance();
		// $this->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		$supplier_id = $this->input->post('supplier_id');			
        $content = $CI->lpurchase->purchase_by_search($supplier_id);
		$this->template->full_admin_html_view($content);
	}
	//Product search by supplier id
	public function product_search_by_supplier(){

		$CI =& get_instance();
		// $this->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		$CI->load->model('Suppliers');
		$supplier_id = $this->input->post('supplier_id');			
        $content = $CI->Suppliers->product_search_item($supplier_id);

        if (empty($content)) {
        	echo display('product_not_found');
	    }else{
	    	// Select option created for product
	        echo "<select name=\"product_id[]\" class=\"productSelection form-control\">";
	        	echo "<option value=\"0\">".display('select_one')."</option>";
	        	foreach ($content as $product) {
	    			echo "<option value=".$product['product_id'].">";
	    			echo $product['product_name'];
	    			#echo $product['product_name']."-(".$product['product_model'].")";
	    			echo "</option>"; 
	        	}	
	        echo "</select>";
	    }
	}

	//Retrive right now inserted data to cretae html
	public function purchase_details_data($purchase_id)
	{	
		$CI =& get_instance();
		// $CI->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
		$content = $CI->lpurchase->purchase_details_data($purchase_id);	
		
		$this->template->full_admin_html_view($content);
	}
}
	
	public function checkCustomePO(){
		
		$CI =& get_instance();
		$customerpo = $_POST['customer_po'];
		$customer_id = $_POST['customer_id'];
		$CI->load->model('Purchases');
		$datas = $this->Purchases->checkCustomePO($customerpo,$customer_id);
		if($datas){
			echo json_encode(array("status"=>"false", "msg"=>"Customer PO already exist. Please try another"));exit();
		}else{
			echo json_encode(array("status"=>"true", "msg"=>"You can use this customer PO"));exit();
		}
	}
}