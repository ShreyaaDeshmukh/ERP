<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cticket extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'ticket';
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
		$CI->load->library('lticket');
		$content = $CI->lticket->ticket_add_form($r_id);
		$this->template->full_admin_html_view($content);
	}
}
	//Product Add Form
	public function manage_ticket($r_id)
	{
		$CI =& get_instance();
		// $this->auth->check_admin_auth();
		$CI->load->library('lticket');
		$CI->load->model('Tickets');
		$r_id=$this->session->r_id;
		#
        #pagination starts
		#
		if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
       else{ 
        $config["base_url"] = base_url('Cticket/manage_ticket/'.$r_id);
        $config["total_rows"] = $this->Tickets->count_ticket($r_id);
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
		// $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$page=0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #  
        $content =$this->lticket->ticket_list($links,$config["per_page"],$page,$r_id);
		$this->template->full_admin_html_view($content);
	   }
	}
	//Insert Product and uload
	public function insert_ticket()
	{
		$CI =& get_instance();
		// $CI->auth->check_admin_auth();
		$r_id=$this->session->r_id;
		$CI->load->model('Tickets');
		$CI->Tickets->ticket_entry($r_id);
		$this->session->set_userdata(array('message'=>display('successfully_added')));
		if(isset($_POST['add-ticket'])){
			redirect(base_url('Cticket/manage_ticket/'.$r_id));
			exit;
		}elseif(isset($_POST['add-ticket-another'])){
			redirect(base_url('Cticket'));
			exit;
		}
	}
	//purchase Update Form
	public function ticket_update_form($ticket_id)
	{	
		$CI =& get_instance();
		// $CI->auth->check_admin_auth();
		$CI->load->library('lticket');
			if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
		$content = $CI->lticket->ticket_edit_data($ticket_id);
		$this->template->full_admin_html_view($content);
	}}
	// purchase Update
	public function ticket_update()
	{
	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('Tickets');
		$CI->Tickets->update_ticket();
		$this->session->set_userdata(array('message'=>display('successfully_updated')));
		redirect(base_url('Cticket/manage_ticket'));
		exit;
	}
	// product_delete
	public function ticket_delete()
	{	$CI =& get_instance();
		// $this->auth->check_admin_auth();
		$CI->load->model('Tickets');
		$ticket_id =  $_POST['ticket_id'];
		$CI->Tickets->delete_ticket($ticket_id);
		$this->session->set_userdata(array('message'=>display('successfully_delete')));
		return true;
			
	}
	//Purchase item by search
	public function ticket_item_by_search()
	{
		$CI =& get_instance();
		// $this->auth->check_admin_auth();
		$CI->load->library('lticket');
		$supplier_id = $this->input->post('supplier_id');			
        $content = $CI->lticket->purchase_by_search($supplier_id);
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
	        echo "<select name=\"product_id[]\" class=\"productSelection form-control\" id=\"product_id\">";
	        	echo "<option value=\"0\">".display('select_one')."</option>";
	        	foreach ($content as $product) {
	    			echo "<option value=".$product['product_id'].">";
	    			echo $product['product_name']."-(".$product['product_model'].")";
	    			echo "</option>"; 
	        	}	
	        echo "</select>";
	    }
	}
	
	//Product search by supplier id
	public function product_search_by_customer(){

		$CI =& get_instance();
		// $this->auth->check_admin_auth();
		$CI->load->library('lticket');
		$CI->load->model('Customers');
		$customer_id = $this->input->post('customer_id');			
		$fetchvalueflag = $this->input->post('fetchvalueflag');			
        $content = $CI->Customers->product_search_item($customer_id, $fetchvalueflag);
		#echo "<pre>";print_r($content);die;
        if (empty($content)) {
        	echo display('product_not_found');
	    }else{
	    	// Select option created for product
	        echo "<select name=\"product_id[]\" class=\"productSelection form-control\" id=\"product_id\">";
	        	echo "<option value=\"0\">".display('select_one')."</option>";
	        	foreach ($content as $product) {
					if($fetchvalueflag=='c'){
						echo "<option value=".$product['product_id'].">";
						echo $product['product_name'];
						echo "</option>"; 
					}else{
						echo "<option value=".$product['product_id'].">";
						echo $product['product_name'];
						echo "</option>";
					}
	        	}	
	        echo "</select>";
	    }
	}
	
	
	

	//Retrive right now inserted data to cretae html
	public function ticket_details_data($ticket_id)
	{	
		$CI =& get_instance();
		// $CI->auth->check_admin_auth();
		$CI->load->library('lticket');
		if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
		$content = $CI->lticket->ticket_details_data($ticket_id);	
		$this->template->full_admin_html_view($content);
	}}
	
	// retrieve_product_data
	public function retrieve_product_data()
	{	
		$r_id = $this->session->r_id;
		$CI =& get_instance();
		// $this->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$product_id = $this->input->post('product_id');
		//$product_info = $CI->Invoices->retrieve_product_data($product_id);
		//$product_stock_check = $this->product_stock_check($product_id);

		$product_info = $CI->Invoices->get_total_product_ticket($product_id,$r_id);

		echo json_encode($product_info);
	}
	
	public function retrieve_product_informations(){
		$CI =& get_instance();
		// $this->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$product_id = $this->input->post('product_id');
		//$product_info = $CI->Invoices->retrieve_product_data($product_id);
		//$product_stock_check = $this->product_stock_check($product_id);

		$product_info = $CI->Invoices->get_total_product_ticket_new($product_id);

		echo json_encode($product_info);
	}

// print detail data

public function ticket_print_data($ticket_id)
{	
	$CI =& get_instance();
	$CI->auth->check_admin_auth();
	$CI->load->library('lticket');
	$content = $CI->lticket->ticket_print_data($ticket_id);	
	$this->template->full_admin_html_view($content);
}


	
	public function checkExpiry(){
		$CI =& get_instance();
		// $this->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$product_id = $this->input->post('product_id');
		$location = $this->input->post('location');
		//$product_info = $CI->Invoices->retrieve_product_data($product_id);
		//$product_stock_check = $this->product_stock_check($product_id);

		return $product_info = $CI->Invoices->checkExpiry($product_id, $location);
		
		
	}
	
	public function checkCustomePO(){
		$CI =& get_instance();
		$customerpo = $_POST['customer_po'];
		$CI->load->model('Purchases');
		$datas = $this->Purchases->checkCustomePO($customerpo);
		if($datas){
			echo json_encode(array("status"=>"false", "msg"=>"Customer PO already exist. Please try another"));exit();
		}else{
			echo json_encode(array("status"=>"true", "msg"=>"YOu can use this customer PO"));exit();
		}
	}
	
	
	public function checkcustomeid(){
		
		$CI =& get_instance();
		// $this->auth->check_admin_auth();
		$venderid = $_POST['venderid'];
		
		$CI->load->model('Tickets');
		
		$datas = $this->Tickets->checkCustomeID($venderid);
		if($datas){
			echo json_encode(array("status"=>"true", "msg"=>$datas));exit();
		}else{
			echo json_encode(array("status"=>"true", "msg"=>"YOu can use this customer PO"));exit();
		}
	}
	
	
	public function product_search_by_customer_details(){
		
		$CI =& get_instance();
		// $this->auth->check_admin_auth();
		$product_id = $_POST['product_id'];
		
		$CI->load->model('Tickets');
		
		$datas = $this->Tickets->product_search_by_customer_details($product_id);
		if($datas){
			echo json_encode(array("status"=>"true", "msg"=>$datas));exit();
		}else{
			echo json_encode(array("status"=>"true", "msg"=>"YOu can use this customer PO"));exit();
		}
	}
	
	public function picking_details($ticket_id){
		
		$CI =& get_instance();
		// $CI->auth->check_admin_auth();
		$CI->load->library('lticket');
		
		if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
		$content = $CI->lticket->picking_details_data($ticket_id);	
		$this->template->full_admin_html_view($content);
	}
	}
	
}