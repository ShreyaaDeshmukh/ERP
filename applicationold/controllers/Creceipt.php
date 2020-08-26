<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Creceipt extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'receipt';
	  $this->load->model('Web_settings');
		$this->Web_settings->checkLicensing();
		
    }
	public function index()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lreceipt');
		$content = $CI->lreceipt->receipt_add_form();
		$this->template->full_admin_html_view($content);
	}
	//Product Add Form
	public function manage_receipt()
	{
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lreceipt');
		$CI->load->model('Receipts');

		#
        #pagination starts
        #
        $config["base_url"] = base_url('Creceipt/manage_receipt/');
        $config["total_rows"] = $this->Receipts->count_receipt();
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
        $content =$this->lreceipt->receipt_list($links,$config["per_page"],$page);
      
		$this->template->full_admin_html_view($content);
	}
	//Insert Product and uload
	public function insert_receipt()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('Receipts');
		$CI->Receipts->receipt_entry();
		$this->session->set_userdata(array('message'=>display('successfully_added')));
		if(isset($_POST['add-receipt'])){
			redirect(base_url('Creceipt/manage_receipt'));
			exit;
		}elseif(isset($_POST['add-receipt-another'])){
			redirect(base_url('Creceipt'));
			exit;
		}
	}
	//purchase Update Form
	public function receipt_update_form($receipt_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lreceipt');
		$content = $CI->lreceipt->receipt_edit_data($receipt_id);
		$this->template->full_admin_html_view($content);
	}
	// purchase Update
	public function receipt_update()
	{
	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('Receipts');
		$CI->Receipts->update_receipt();
		$this->session->set_userdata(array('message'=>display('successfully_updated')));
		redirect(base_url('Creceipt/manage_receipt'));
		exit;
	}
	// product_delete
	public function receipt_delete()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Receipts');
		$receipt_id =  $_POST['receipt_id'];
		$CI->Receipts->delete_receipt($receipt_id);
		$this->session->set_userdata(array('message'=>display('successfully_delete')));
		return true;
			
	}
	//Purchase item by search
	public function purchase_item_by_search()
	{
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		$supplier_id = $this->input->post('supplier_id');			
        $content = $CI->lpurchase->purchase_by_search($supplier_id);
		$this->template->full_admin_html_view($content);
	}
	//Product search by supplier id
	public function product_search_by_supplier(){

		$CI =& get_instance();
		$this->auth->check_admin_auth();
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

	//Retrive right now inserted data to cretae html
	public function receipt_details_data($purchase_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lreceipt');
		$content = $CI->lreceipt->receipt_details_data($purchase_id);	
		$this->template->full_admin_html_view($content);
	}
}