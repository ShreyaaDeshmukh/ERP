<?php
error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    require_once('./application/libraries/stripe-php/init.php');


class Admin_dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->template->current_menu = 'home';
        $this->load->model('Web_settings');
        $this->load->model('users');
		$this->Web_settings->checkLicensing();
        $this->load->library('session');
        $this->load->helper('url');

    }

   public function index() {
        $user=$this->session->userdata('username'); 
        $CI = & get_instance();
        $CI->load->library('session');
        $this->load->library('lreport');
        $this->load->library('occational');
        // print_r($this->session);exit;
        if (!$user){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
       else{           
        $email = $this->session->userdata('username');
        $result = $this->users->check_email($email); 
           foreach($result as $row){ 
            $r_id= $row->id;
           }
        $this->session->set_userdata('r_id',$r_id);
        $this->load->model('Customers');
        $this->load->model('Products');
        $this->load->model('Suppliers');
        $this->load->model('Invoices');
        $this->load->model('Purchases');
        $this->load->model('Reports');
        $this->load->model('Accounts');
        $this->load->model('Web_settings');
        $this->load->model('Payment');
       

        $total_customer = $this->Customers->count_customer($r_id);
        $total_product = $this->Products->count_product($r_id);
        $total_suppliers = $this->Suppliers->count_supplier($r_id);
        $total_sales = $this->Invoices->count_invoice($r_id);
        $total_purchase = $this->Purchases->count_purchase($r_id);
		$today_total_purchase = $this->Purchases->count_purchase_today($r_id);
	    $today_total_purchase_line_item = $this->Purchases->count_purchase_line_item_today($r_id);
        $count_picking_line_item_today = $this->Purchases->count_picking_line_item_today($r_id);
		$count_picking_line_item_month = $this->Purchases->count_picking_line_item_month($r_id);
        $today_total_ticket = $this->Purchases->count_ticket_today($r_id);
       	$count_ticket_month = $this->Purchases->count_ticket_month($r_id);
        $count_location_items = $this->Purchases->count_location_items($r_id);
       	$monthly_total_purchase = $this->Purchases->count_purchase_month($r_id);
		$count_purchase_line_item_month = $this->Purchases->count_purchase_line_item_month($r_id);
		$count_purchase_line_item_month_parital_received = $this->Purchases->count_purchase_line_item_month_parital_received($r_id);
		$count_purchase_line_item_month_fully_received = $this->Purchases->count_purchase_line_item_month_fully_received($r_id);
        $today_fully_received = $this->Purchases->today_fully_received($r_id);
      	if(!empty($today_fully_received)){
			$today_fully_received = count($today_fully_received);
		
		}else{
		    
			$today_fully_received = "";
		}                
		
        $month_fully_received = $this->Purchases->month_fully_received($r_id);
       
		if(!empty($month_fully_received)){
			$month_fully_received = count($month_fully_received);
		}else{
			$month_fully_received = "";
		}
		
        $today_partial_received = $this->Purchases->today_partially_received($r_id);
       
		if(!empty($today_partial_received)){
			$today_partial_received = count($today_partial_received);
		}else{
			$today_partial_received = "";
		}
		
        $today_partially_received_line_item = $this->Purchases->today_partially_received_line_item($r_id);
      
		if(!empty($today_partially_received_line_item)){
			$today_partially_received_line_item = count($today_partially_received_line_item);
		}else{
			$today_partially_received_line_item = "";
		}
		  
        $today_fully_received_line_item = $this->Purchases->today_fully_received_line_item($r_id);
       
		if(!empty($today_fully_received_line_item)){
			$today_fully_received_line_item = count($today_fully_received_line_item);
		}else{
			$today_fully_received_line_item = "";
		}
		
		
        $today_partially_ticket = $this->Purchases->today_partially_ticket($r_id);
        
		 
        
		if(!empty($today_partially_ticket)){
			$today_partially_ticket = count($today_partially_ticket);
		}else{
			$today_partially_ticket = "";
		}
		
        $today_fully_ticket = $this->Purchases->today_fully_ticket($r_id);
        
   
        
		if(!empty($today_fully_ticket)){
			$today_fully_ticket = count($today_fully_ticket); 
		}else{
			$today_fully_ticket = "";
		}
		
		$today_partially_ticket_line_item = $this->Purchases->today_partially_ticket_line_item($r_id);
		    
		if(!empty($today_partially_ticket_line_item)){
			/* $today_partially_ticket_line_item = count($today_partially_ticket_line_item); */ // comment by tapan 20-05-2019
			$today_partially_ticket_line_item = $today_partially_ticket_line_item;
		}else{
			$today_partially_ticket_line_item = 0;
		}
		/* echo $today_partially_ticket_line_item; echo "<br>";
echo 1243;die;	 */	
		$today_fully_ticket_line_item = $this->Purchases->today_fully_ticket_line_item($r_id);
	
		
		if(!empty($today_fully_ticket_line_item)){
			$today_fully_ticket_line_item = $today_fully_ticket_line_item;
		}else{
			$today_fully_ticket_line_item = 0;
		}
		
		$month_partially_ticket_line_item = $this->Purchases->month_partially_ticket_line_item($r_id);
			if(!empty($month_partially_ticket_line_item)){
			$month_partially_ticket_line_item = count($month_partially_ticket_line_item);
		}else{
			$month_partially_ticket_line_item = 0;
		}
		  
		$month_fully_ticket_line_item = $this->Purchases->month_fully_ticket_line_item($r_id);
		
		if(!empty($month_fully_ticket_line_item)){
			$month_fully_ticket_line_item = $month_fully_ticket_line_item;
		}else{
			$month_fully_ticket_line_item = 0;
		}
		
		$today_fully_ticket = $this->Purchases->today_fully_ticket($r_id);
		
		if(!empty($today_fully_ticket)){
			$today_fully_ticket = count($today_fully_ticket); 
		}else{
			$today_fully_ticket = 0;
		}
		
		
		$monthly_fully_ticket = $this->Purchases->monthly_fully_ticket($r_id);
	
		if(!empty($monthly_fully_ticket)){
			$monthly_fully_ticket = count($monthly_fully_ticket);
		}else{
			$monthly_fully_ticket = 0;
		}
		
		$month_partially_ticket = $this->Purchases->month_partially_ticket($r_id);
		
		if(!empty($month_partially_ticket)){
			$month_partially_ticket = count($month_partially_ticket);
		}else{
			$month_partially_ticket = 0;
		}
		
		
		
		$month_partial_received = $this->Purchases->month_partial_received($r_id);
		
		if(!empty($month_partial_received)){
			$month_partial_received = count($month_partial_received);
		}else{
			$month_partial_received = 0;
		}
		
		
		
		if($today_total_purchase_line_item!='' && $today_fully_received_line_item!='' && $today_partially_received_line_item!=''){
			$total_blank_line_item_daily = $today_total_purchase_line_item - ($today_fully_received_line_item + $today_partially_received_line_item);
		}else{
			$total_blank_line_item_daily = 0;
		}
		if($count_purchase_line_item_month!='' && $count_purchase_line_item_month_parital_received!='' && $count_purchase_line_item_month_fully_received!=''){
			$total_blank_line_item_montly = $count_purchase_line_item_month - ($count_purchase_line_item_month_parital_received + $count_purchase_line_item_month_fully_received);
		}else{
			$total_blank_line_item_montly = 0;
		}
		
		if($count_picking_line_item_today!='' && $today_partially_ticket_line_item!='' && $today_fully_ticket_line_item!=''){
			$total_blank_line_item_daily_ticket = $count_picking_line_item_today - ($today_partially_ticket_line_item + $today_fully_ticket_line_item);
		}else{
			$total_blank_line_item_daily_ticket = 0;
		}
		
		
		if($count_picking_line_item_month!='' && $month_partially_ticket_line_item!='' && $month_fully_ticket_line_item!=''){
			#echo $count_picking_line_item_month.'--->'.$month_partially_ticket_line_item.'--->'.$month_fully_ticket_line_item;die;
			$total_blank_line_item_month_ticket = $count_picking_line_item_month - ($month_partially_ticket_line_item + $month_fully_ticket_line_item);
		}else{
			$total_blank_line_item_month_ticket = 0;
		}
		$purchase_receiving_graph_data = $this->Purchases->purchase_receiving_graph_data($r_id);
		#print_r($today_partial_received);die;
		
        $this->Accounts->accounts_summary(1);
        $total_expese = $this->Accounts->sub_total;
	
        $monthly_sales_report = $this->Reports->monthly_sales_report($r_id);
        
        $sales_report = $this->Reports->todays_total_sales_report($r_id);
      
        $total_profit = ($sales_report[0]['total_sale'] - $sales_report[0]['total_supplier_rate']);
		 	 $currency_details = $this->Web_settings->retrieve_setting_editdata();
        // $data['username']=$this->session->userdata('username');
        $data = array(
            'username'=> $this->session->userdata('username'),
            'title' => 'Dashboard',
            'total_customer' => $total_customer,
            'total_product' => $total_product,
            'total_suppliers' => $total_suppliers,
            'total_sales' => $total_sales,
            'total_purchase' => $total_purchase,
            'today_partial_received' => $today_partial_received,
            'today_partially_received_line_item' => $today_partially_received_line_item,
            'count_purchase_line_item_month_fully_received' => $count_purchase_line_item_month_fully_received,
            'count_purchase_line_item_month_parital_received' => $count_purchase_line_item_month_parital_received,
            'today_fully_received_line_item' => $today_fully_received_line_item,
            'total_blank_line_item_daily' => $total_blank_line_item_daily,
            'today_total_purchase_line_item' => $today_total_purchase_line_item,
            'count_purchase_line_item_month' => $count_purchase_line_item_month,
            'today_fully_received' => $today_fully_received,
            'month_fully_received' => $month_fully_received,
            'monthly_partial_received' => $month_partial_received,
            'monthly_total_purchase' => $monthly_total_purchase,
            'count_location_items' => $count_location_items,
            'today_total_ticket' => $today_total_ticket,
            'today_partially_ticket' => $today_partially_ticket,
            'today_fully_ticket' => $today_fully_ticket,
            'monthly_fully_ticket' => $monthly_fully_ticket,
            'month_partially_ticket' => $month_partially_ticket,
            'count_ticket_month' => $count_ticket_month,
            'purchase_receiving_graph_data' => $purchase_receiving_graph_data,
            'count_picking_line_item_today' => $count_picking_line_item_today,
            'total_blank_line_item_montly' => $total_blank_line_item_montly,
            'today_partially_ticket_line_item' => $today_partially_ticket_line_item,
            'today_fully_ticket_line_item' => $today_fully_ticket_line_item,
            'total_blank_line_item_daily_ticket' => $total_blank_line_item_daily_ticket,
            'month_partially_ticket_line_item' => $month_partially_ticket_line_item,
            'month_fully_ticket_line_item' => $month_fully_ticket_line_item,
            'count_picking_line_item_month' => $count_picking_line_item_month,
            'total_blank_line_item_month_ticket' => $total_blank_line_item_month_ticket,
            'purchase_amount' => number_format($sales_report[0]['total_supplier_rate'], 2, '.', ','),
            'sales_amount' => number_format($sales_report[0]['total_sale'], 2, '.', ','),
            'total_expese' => $total_expese,
            'total_profit' => number_format($total_profit, 2, '.', ','),
            'monthly_sales_report' => $monthly_sales_report,			            
            // 'monthly_sales_report' => '0',			            
			'today_total_purchase' => $today_total_purchase,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
// print_r($data);die;
        $content = $this->parser->parse('include/admin_home', $data, true);
        $this->template->full_admin_html_view($content);
       }
    }

    //Today All Report
    public function all_report() {
        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }

        $CI = & get_instance();
        $CI->load->library('lreport');
        if (!$this->auth->is_logged()) {
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
        }
        $this->auth->check_admin_auth();

        $user_type = $this->session->userdata('user_type');

        if ($user_type == 1) {
            $content = $CI->lreport->retrieve_all_reports();
            $this->template->full_admin_html_view($content);
        } elseif ($user_type == 2) {
            $CI->load->library('linvoice');
            $content = $CI->linvoice->invoice_add_form();
            $this->template->full_admin_html_view($content);
        }
    }
  
    #==============Todays_sales_report============#

    public function todays_sales_report() {
        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
        $CI = & get_instance();
        $CI->load->library('lreport');
        $this->auth->check_admin_auth();
        $content = $CI->lreport->todays_sales_report();
        $this->template->full_admin_html_view($content);
    }

    #================todays_purchase_report========#

    public function todays_purchase_report() {

        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
        $CI = & get_instance();
        $CI->load->library('lreport');
        $this->auth->check_admin_auth();
        $content = $CI->lreport->todays_purchase_report();
        $this->template->full_admin_html_view($content);
    }

    #=============Total profit report===================#

    public function total_profit_report() {
        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
        $CI = & get_instance();
        $CI->load->library('lreport');
        $CI->load->model('Reports');
        // $this->auth->check_admin_auth();

        #
        #pagination starts
        #
        $config["base_url"] = base_url('Admin_dashboard/total_profit_report/');
        $config["total_rows"] = $this->Reports->total_profit_report_count();
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
        $content = $this->lreport->total_profit_report($links, $config["per_page"], $page);

        $this->template->full_admin_html_view($content);
    }

    #============Date wise sales report==============#

    public function retrieve_dateWise_SalesReports() {
        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lreport');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $content = $CI->lreport->retrieve_dateWise_SalesReports($from_date, $to_date);
        $this->template->full_admin_html_view($content);
    }

    #==============Date wise purchase report=============#

    public function retrieve_dateWise_PurchaseReports() {
        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lreport');
        $start_date = $this->input->post('from_date');
        $end_date = $this->input->post('to_date');
        $content = $CI->lreport->retrieve_dateWise_PurchaseReports($start_date, $end_date);
        $this->template->full_admin_html_view($content);
    }

    #==============Product sales report date wise===========#

    public function product_sales_reports_date_wise() {
        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lreport');
        $CI->load->model('Reports');

        #
        #pagination starts
        #
        $config["base_url"] = base_url('Admin_dashboard/product_sales_reports_date_wise/');
        $config["total_rows"] = $this->Reports->retrieve_product_sales_report_count();
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
        $content = $this->lreport->get_products_report_sales_view($links, $config["per_page"], $page);

        $this->template->full_admin_html_view($content);
    }

    #==============Date wise purchase report=============#

    public function retrieve_dateWise_profit_report() {
        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lreport');
        $CI->load->model('Reports');
        $start_date = $this->input->post('from_date');
        $end_date = $this->input->post('to_date');
        #
        #pagination starts
        #
        $config["base_url"] = base_url('Admin_dashboard/retrieve_dateWise_profit_report/');
        $config["total_rows"] = $this->Reports->retrieve_dateWise_profit_report_count($start_date, $end_date);
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
        $content = $this->lreport->retrieve_dateWise_profit_report($start_date, $end_date, $links, $config["per_page"], $page);

        $this->template->full_admin_html_view($content);
    }

    #==============Product sales search reports============#

    public function product_sales_search_reports() {
        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lreport');
        $CI->load->model('Reports');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        #
        #pagination starts
        #
        $config["base_url"] = base_url('Admin_dashboard/product_sales_search_reports/');
        $config["total_rows"] = $this->Reports->retrieve_product_search_sales_report_count($from_date, $to_date);
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
        $content = $this->lreport->get_products_search_report($from_date, $to_date, $links, $config["per_page"], $page);

        $this->template->full_admin_html_view($content);
    }
  #============User signup=========#

  function signup()
  {   
    //   $this->sendEmail();
      $this->load->view('user/signup');
  }

 function PricingPlan(){

    // echo "(((((((";

    $this->load->view('pricing_plan');

 }
 

  public function signupMe()
  {
    // $user_id =mt_rand();
    
      $this->load->library('form_validation');      
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');    
      $this->form_validation->set_rules('subscription', 'Subscription', 'required');
      $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[32]');
      $this->form_validation->set_rules('rpassword', 'Repeat Password', 'trim|required|matches[password]');
      
      if($this->form_validation->run() == false)
      {
          
          $this->load->view('user/signup');
      }
      else
      {
        
          $email = $this->security->xss_clean($this->input->post('email'));
          $password = $this->input->post('password');
          $mobile = $this->input->post('mobile');
          $subscription = $this->input->post('subscription');
		 $licence_session = rand(1000,9999) . '' . rand(1000,9999) . '' . rand(1000,9999);
            // $this->sendEmail($license1);          
          $userdata = array('r_password'=>$password,'r_email'=>$email,
                          'r_mobile'=>$mobile,
                          'r_date_time'=>date('Y-m-d H:i:s'),
                          'r_subscription'=>$subscription,
                          'licence_session'=>$licence_session
                          );
            $this->session->set_userdata('lic_key',uniqid());
            $this->session->set_userdata($userdata);
            $userdata_check = array('password'=>$password,'username'=>$email);
            $result = $this->users->check_signupMe($userdata_check);           
            if($result > 0)
           {
            
            $this->session->set_flashdata('warning','Email id already exists');
             $this->load->view('user/signup'); 
            // </script>";
             ?>
             <script>
                // alert("Email id already exists");
             </script>
            <?php
           
            //   $this->load->view('user/signup');
           }
          else
          {    
				
                  $this->sendEmail($email,$password);
              // $this->load->view('user/lic',$userdata);                  
          }
      }
  }
  public function sendEmail($email,$password)
  {
	 
	    $userdata = $this->session->userdata($userdata);
		// print_r($userdata);die;
	        $config['protocol'] = 'smtp'; // mail, sendmail, or smtp    The mail sending protocol.
            $config['smtp_host'] = 'ssl://smtp.googlemail.com'; // SMTP Server Address.
			$config['smtp_user'] = 'testmindcrew1001@gmail.com'; // SMTP Username.
             $config['smtp_pass'] = 'Saloni19@'; // SMTP Password.
			
			 // $config['smtp_user'] = 'support@plumkit.com';
			 // $config['smtp_pass'] = 'Mindcrew01'; // SMTP Password.
            $config['smtp_port'] = '465'; // SMTP Port. 25 is for local host
            $config['smtp_timeout'] = '7	'; // SMTP Timeout (in seconds).
            $config['wordwrap'] = TRUE; // TRUE or FALSE (boolean)    Enable word-wrap.
            $config['wrapchars'] = 76; // Character count to wrap at.
            $config['mailtype'] = 'html'; // text or html Type of mail. If you send HTML email you must send it as a complete web page. Make sure you don't have any relative links or relative image paths otherwise they will not work.
            $config['charset'] = 'utf-8'; // Character set (utf-8, iso-8859-1, etc.).
            $config['validate'] = TRUE; // TRUE or FALSE (boolean)    Whether to validate the email address.
            $config['priority'] = 1; // 1, 2, 3, 4, 5    Email Priority. 1 = highest. 5 = lowest. 3 = normal.
            $config['crlf'] = "\r\n"; // "\r\n" or "\n" or "\r" Newline character. (Use "\r\n" to comply with RFC 822).
            $config['newline'] = "\r\n"; // "\r\n" or "\n" or "\r"    Newline character. (Use "\r\n" to comply with RFC 822).
            $config['bcc_batch_mode'] = FALSE; // TRUE or FALSE (boolean)    Enable BCC Batch Mode.
            $config['bcc_batch_size'] = 200; //
	  
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->initialize($config);
		   $email_body ="<div>Your license key is ".$userdata['licence_session']." </div>";
       
          $this->email->from('testmindcrew1001@gmail.com','Mindcrew Technologies');
		  $this->email->to($email);
          // $this->email->to('tayyabjohar@gmail.com');
          $this->email->subject('Subject : Welcome');
		  $this->email->message($email_body);
          // $this->email->message('This Message is to notify you that your license key is'.$userdata['licence_session']);
           // $this->email->send();
		  $send = $this->email->send();
		//print_r($this->email->send());die;
         //Send mail 
		  // print_r($this->email->send());die;
		 
         if($send) {
			 
          $this->session->set_flashdata("email_sent"," A license key has been sent to your email address");
        //   print_r($this->session->flashdata('email_sent'));exit;
		 $this->load->view('user/lic',$userdata);
		 }
         else {
			echo $this->email->print_debugger();
			 
          $this->session->set_flashdata("email_sent","Error in sending Email.");
		  $this->load->view('user/signup',$userdata);
        //  $this->load->view('email_form'); 
		 }
    }
  
  
    #============User login=========#

    public function login() {
        if ($this->auth->is_logged()) {
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard', TRUE, 302);
        }
        $data['title'] = "Admin Login Area";
        // $content = $this->parser->parse('user/admin_login_form', $data, true);
        // $this->template->full_admin_html_view($content);
        // $content = $this->parser->parse('user/admin_login_form', $data, true);
        $this->load->view('user/admin_login_form', $data);
    }

     #============User forget password=========#

  function forgotPassword()
  {   
         $this->load->view('user/forgotPassword');
  }


#==================reset password======================#

    public function resetPasswordUser()
	{	  $this->load->model('Users');
		 $email = $this->input->post("login_email");
		 $key = $this->input->post("lic_key");
		 $password = $this->input->post("password");
	     
		$update = $this->Users->updatePassword($email,$password,$key);
			
				
		    $data['title'] = "Admin Login Area";
        // $content = $this->parser->parse('user/admin_login_form', $data, true);
        // $this->template->full_admin_html_view($content);
        // $content = $this->parser->parse('user/admin_login_form', $data, true);
        $this->load->view('user/admin_login_form', $data);
	}

   

    #==============Valid user check=======#

   
    #==============Valid user check=======#

    public function do_login() 
    {
        $error = '';
        
        $setting_detail = $this->Web_settings->retrieve_setting_editdata();
       
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        
         if ($this->form_validation->run() == FALSE) {
		 	print_r('if');
			die();
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
        } 

        else {

            $username = $this->input->post('email');

            $password = $this->input->post('password');  
            
            $user_login=array('username'=>$username,'password'=>$password);
          
            $user_login1=array('l_email'=>$username,'l_password'=>$password);

            $result = $this->users->loginMe($user_login);//users models
            
            if($result > 0)
           {   
         
            $license_key = $this->input->post('license_key'); 
         
            $device_type = "Web";

         $nm=preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);

            if($nm==0||$nm=="0"){
                $device_type = "Web";   
            }       
            
              else{
                $device_type = "Mobile";
              }

            //   echo  $device_type;

           $device_id = '';

            $localIP = $_SERVER['REMOTE_ADDR'];
             
              $device_id = $localIP;

    //          ob_start();
    //         system('ipconfig/all');
    //         $mycom=ob_get_contents(); 
    //         ob_clean(); 
    //         $findme = "Physical";
    //         $pmac = strpos($mycom, $findme); 
    //         $mac=substr($mycom,($pmac+36),17);

	// $device_id= $mac;
        
            if($username!='' && $password!='' && $license_key!==''){
         
                $con=mysqli_connect("localhost", "root","","wholesale");
         
                // $getData = mysqli_query($con,"SELECT * FROM license_key where email = '".$username."' AND password = '".md5("gef".$password)."' AND license_key='".$license_key."', AND device_type='".$device_type."'");
                
                $sql = "SELECT * FROM user_login where username ='".$username."' AND password ='".$password."' and device_type='".$device_type."' ";


                 

                $getData = $con->query($sql);

                if($getData->num_rows > 0)
         
                {
                    $userdata = [];
         
                    while ($row = $getData->fetch_assoc()) {
         
                        $userdata[] = $row;
                
                        // echo "  uyser enter";
                        // echo $license_key;

                        // echo "from db ";
                        // echo $userdata[0]['license_key'];
    
                        if($userdata[0]['license_key']==""||$userdata[0]['license_key']==null){
                           
                            echo "blank*****";

                        }
                        else{

                        if($userdata[0]['license_key']!= $license_key)
                        {
                            // echo "invalid license key";

                         $this->session->set_flashdata('warning', 'Please enter valid license number.');
                         return $this->load->view('user/admin_login_form');	
                        }

                        if($userdata[0]['device_id']==''||$userdata[0]['device_id']==null)
                        {
                            $sql = "UPDATE user_login SET login_status=1, device_id='".$device_id."' WHERE id='".$userdata[0]['id']."'";
         
                            if ($con->query($sql) === TRUE) {
                           //    $response['data'] = array("status"=>"true","msg"=>'Login Successfully', "data"=>$userdata);
                           //    echo "successMMM";

                              $this->session->set_userdata($user_login);
                             return    $this->output->set_header("Location: " . base_url(), TRUE, 302);
  
                                 }
                                  else{
                                    $response['data'] = array("status"=>"true","msg"=>'Something went wronng');
                                   //  echo "fail";

                                  }

                            // $this->session->set_flashdata('warning', 'You are already loggedin on another device.');
                            // return $this->load->view('user/admin_login_form');
                         }
                        else{

                           if($userdata[0]['device_id']==$device_id)
                        {
                        //  echo "inside else";
                        //  echo "db user";
                        //  echo $userdata[0]['device_id'];

                        //  echo "current device";
                        // echo $device_id;

                        

                        //    $response['data'] = array("status"=>"true","msg"=>'Login Successfully', "data"=>$userdata);
                        $this->session->set_userdata($user_login);
                        return    $this->output->set_header("Location: " . base_url(), TRUE, 302);

                        }
                        else{
                            $this->session->set_flashdata('warning', 'This license key is already in use on another device.');
                            return $this->load->view('user/admin_login_form');
                        }
                     }
                
                    }
                   
                }
         
                }else{



                    $this->session->set_flashdata('warning', 'Please enter valid login details !');
                    return $this->load->view('user/admin_login_form');
                 
                }	
         
            }else{
         
                $this->session->set_flashdata('warning', 'Please enter all required details !');
                return $this->load->view('user/admin_login_form');         
            }
         
                 return $response;            
        }
        else{
            $this->session->set_flashdata('warning', 'Email and password not match !');
            return $this->load->view('user/admin_login_form');

        }   
        }
     }

        public function license(){  
			 if(isset($_SESSION['email_sent'])){
              unset($_SESSION['email_sent']);
              }
			// $this->session->unset_flashdata("email_sent"," A license key has been sent to your email address");
            $this->form_validation->set_rules('license', 'License', 'required|exact_length[12]');     
            if ($this->form_validation->run() == FALSE){
                $this->load->view('user/lic');
            }
            else{       
                if($this->session->userdata['licence_session'] == $this->input->post('license')){               
                    $userdata= $this->session;                      
                    $result = $this->users->login_insert($userdata);//users models  
                    // print_r($result);die;
                    if($result>0){
                        // $this->session->sess_destroy(); 
                        $this->output->set_header("Location: " . base_url(), TRUE, 302);
                    } 
                    else{
                         $this->session->set_flashdata('warning', 'license key already exists !');
                        return $this->load->view('user/lic.php');
                        // echo "license key already exists";
                    }
                }
                else{
                    
                    // echo "invalid lic_key";
                     $this->session->set_flashdata('invalid_key', 'invalid lic_key !');
                        return $this->load->view('user/lic.php');
                }
                    
            }
    
    
        }

    //Valid captcha check
    function validate_captcha() {
        $setting_detail = $this->Web_settings->retrieve_setting_editdata();
        $captcha = $this->input->post('g-recaptcha-response');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $setting_detail[0]['secret_key'] . ".&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    #===============Logout=======#

    public function logout() {
        if ($this->auth->logout())

        session_destroy();
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);

    }

    #=============Edit Profile======#

    public function edit_profile() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('luser');
        $content = $CI->luser->edit_profile_form();
        $this->template->full_admin_html_view($content);
    }

    #=============Update Profile========#

    public function update_profile() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->model('Users');
        $this->Users->profile_update();
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Admin_dashboard/edit_profile'));
    }

    #=============Change Password=========# 

    public function change_password_form() {
        $CI = & get_instance();
        // $this->auth->check_admin_auth();
        $content = $CI->parser->parse('user/change_password', array('title' => "Change Password"), true);
        $this->template->full_admin_html_view($content);
    }

    #============Change Password===========#

    public function change_password() {
        $CI = & get_instance();
        // $this->auth->check_admin_auth();
        $CI->load->model('Users');

        $error = '';
        $email = $this->input->post('email');
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('password');
        $repassword = $this->input->post('repassword');
        
        if ($email == '' || $old_password == '' || $new_password == '') {
            $error = display('blank_field_does_not_accept');
        } else if ($email != $this->session->userdata('username')) {
            $error = display('you_put_wrong_email_address');
        } else if (strlen($new_password) < 6) {
            $error = display('new_password_at_least_six_character');
        } else if ($new_password != $repassword) {
            $error = display('password_and_repassword_does_not_match');
        } else if ($CI->Users->change_password($email, $old_password, $new_password) === FALSE) {
            $error = display('you_are_not_authorised_person');
        }
        
        if ($error != '') {
            $this->session->set_userdata(array('error_message' => $error));
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/change_password_form', TRUE, 302);
        } else {
            $this->session->set_userdata(array('message' => display('successfully_changed_password')));
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/change_password_form', TRUE, 302);
        }
    }

	// public function getPlanId(){

	// 	$pid=$_POST['plan_id'];

	// 	echo "<script>alert('".$pid."');</script>";

	// 	return $pid;

	// 	redirect('/signup');
	// }

	 public function stripePost()
	 {
		\Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

		$stripe = new \Stripe\StripeClient('sk_test_51GyDZVELvDFHHRjV8uydQHeKfpp5nM2JI7H1pBIGDxRFYCH7aUSTmF9QiXXhOHMVzUbT0xTBnDDFVwSrqaQVR7GH00WXGdUw1n');

         $inputdata=$this->input;
       
         $token=$this->input->post('stripeToken');
		 $full_name=$this->input->post('full_name');
         $email_address=$this->input->post('email_address');
        
		//  echo $token;
	  
		//  \Stripe\Charge::create ([
		// 		 "amount" => 100 * 100,
		// 		 "currency" => "usd",
		// 		 "source" => $this->input->post('stripeToken'),
		// 		 "description" => "Test payment from itsolutionstuff.com." 
        //  ]);
        
        //echo "999999999";

     	$cust=$stripe->customers->create([
			'name'=>$full_name,
            'email'=> $email_address,
            "address" => ["city" => 'indore', "country" => 'india', "line1" => 'indore', "line2" => '', "postal_code" => '452010', "state" => 'MP'],

            ]);

           if($cust!=''||$cust!=null){

			$card=$this->addCard($cust,$inputdata);

			if($card!=''||$card!=null){
         
                
                $subscription=$this->subscribeUser($cust,$inputdata);

               
	          
				if($subscription!=''||$subscription!=null){
					$userdata=$this->addUser($inputdata);

					if($userdata!=''||$userdata!=null){
						$this->session->set_flashdata('success', 'Signup successfully.');   
						
					//	echo "success : '".$userdata."'" ;

						echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
						<script>
						
						swal("Registered Successfully....!! Please check your registered email for Access Keys.");
						
                        </script>';
                        
                        $this->load->view('user/admin_login_form');
					}
		
				   }
				   else{
					$this->session->set_flashdata('failed', 'Something went wrong.');   
				   }	
			   }
			   else{
				$this->session->set_flashdata('failed', 'Something went wrong.');   
			   }
        
		   }
		   else{
			$this->session->set_flashdata('failed', 'Something went wrong.');   
		   }

		// 	$card=$stripe->customers->createSource(
		// 		$cust->id,
		// 		['source' => $token]
		// 	);

		//   $subscription=$stripe->subscriptions->create([
		// 	'customer' => $cust->id,
		// 	'items' => [
		// 	  ['price' => 'price_1H4o9WD1A36x6Y7CCm0f9Xem'],
		// 	],
		//   ]);

		//   echo $subscription;

		//  print_r($cust);
		
		//  redirect('/Welcome');
	 }

	 function addCard($cust,$inputdata){

		\Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
		$stripe = new \Stripe\StripeClient('sk_test_51GyDZVELvDFHHRjV8uydQHeKfpp5nM2JI7H1pBIGDxRFYCH7aUSTmF9QiXXhOHMVzUbT0xTBnDDFVwSrqaQVR7GH00WXGdUw1n');

		$token=$inputdata->post('stripeToken');

		 		$card=$stripe->customers->createSource(
				$cust->id,
				['source' => $token]
			);

			return $card;
	 }

	 public function subscribeUser($cust,$inputdata)
	 {
    
		\Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
		$stripe = new \Stripe\StripeClient('sk_test_51GyDZVELvDFHHRjV8uydQHeKfpp5nM2JI7H1pBIGDxRFYCH7aUSTmF9QiXXhOHMVzUbT0xTBnDDFVwSrqaQVR7GH00WXGdUw1n');

        // $planid=getPlanId();
    

		$plan_id=$inputdata->post('plan_id');

	//	 echo "**********************'".$inputdata."'";

		   $subscription=$stripe->subscriptions->create([
			'customer' => $cust->id,
			'items' => [
			  ['price' => $plan_id],
			],
		  ]);

		  return  $subscription;
	 }

	 public function addUser($inputdata){

		$full_name=$inputdata->post('full_name');
		$contact_no=$inputdata->post('contact_no');
		$email_address=$inputdata->post('email_address');
		$password=$inputdata->post('password');
		$dob=$inputdata->post('dob');
		$gender=$inputdata->post('gender');
		$no_of_web_access=$inputdata->post('no_of_web_access');
		$no_of_mobile_access=$inputdata->post('no_of_mobile_access');
	$newval='';

		$generatedKeys = array();		
		
		if($no_of_web_access==''||$no_of_web_access==null){
			$no_of_web_access=0;
		}

		if($no_of_mobile_access==''||$no_of_mobile_access==null){
			$no_of_mobile_access=0;
		}

		$totalkeys=$no_of_web_access+$no_of_mobile_access;

		$con=mysqli_connect("localhost", "root","","wholesale");

		// $sql = "INSERT INTO user(`full_name`, `contact_no`, `email_address`, `password`, `dob`, `gender`, `no_of_web_access`,no_of_mobile_access) VALUES('".$full_name."','".$contact_no."','".$email_address."','".$password."','".$dob."','".$gender."','".$no_of_web_access."','".$no_of_mobile_access."')";
    
		$sql = "INSERT INTO user_login(`full_name`, `contact_no`, `username`, `password`, `no_of_web_access`,no_of_mobile_access) VALUES('".$full_name."','".$contact_no."','".$email_address."','".$password."','".$no_of_web_access."','".$no_of_mobile_access."')";
        
		if ($con->query($sql) === TRUE) {
			$last_id = $con->insert_id;
		//   echo "New record created successfully";
        $a=array();
          
        $sql='';
  
        for ($i = 0; $i < $totalkeys; $i++)
	     {
			$val="";
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 

            $Gkey=time().''.substr(str_shuffle($str_result),  
        	0, 5);
              
            if($i==0){
                $msql = "UPDATE user_login SET license_key='".$Gkey."' WHERE id='".$last_id."'";
         
                if ($con->query($msql) === TRUE) {
                    
                   $resultval= $this->sendLicenseKey($email_address,$Gkey);
                }
            }
			$sql = "INSERT INTO license_key(`user_id`, `license_key`) VALUES('".$last_id."','".$Gkey."')";

                      

              //  echo $Gkey;

			if ($con->query($sql) === TRUE) {
				//echo "key inserted";

				// $keyname="Key'".$i+1."'";
				
                $k=" Key";
                $n=$i+1;
    
                $keyname=$k." ".$n;

                //echo $keyname;

              $a[]=array($keyname=>$Gkey) ;

      // $generatedKeys[$i+1][$keyname]=$unq ;
				 
	}

        	foreach ($a as $key => $value) {
                
                // echo $key . ':' . $value . '<br>';

				$v=$value;

				foreach ($v as $key => $value) {
			   $val= $val.''. $key .':'. $value.',' ;

               $newval=$val;
				}
			}

		
         }
			$strng = str_replace('[{', '**', $a);

			// $msg= echo 'your license key is';



		 		// echo $val;
				 
         $mailresult=   $this->sendSignupMail($email_address,$newval);
         
        if($mailresult==true){
            return $last_id;  		  

         }
         else{

         }

		} 
		else {
		  echo "Error: " . $sql . "<br>" . $con->error;
		}
				// $msg = "Location Updated!";
    }
    

   function sendSignupMail($email_address,$a)
    {
       
          $userdata = $this->session->userdata($userdata);
          // print_r($userdata);die;
              $config['protocol'] = 'smtp'; // mail, sendmail, or smtp    The mail sending protocol.
              $config['smtp_host'] = 'ssl://smtp.googlemail.com'; // SMTP Server Address.
              $config['smtp_user'] = 'testmindcrew1001@gmail.com'; // SMTP Username.
               $config['smtp_pass'] = 'Saloni19@'; // SMTP Password.
              
               // $config['smtp_user'] = 'support@plumkit.com';
               // $config['smtp_pass'] = 'Mindcrew01'; // SMTP Password.
              $config['smtp_port'] = '465'; // SMTP Port. 25 is for local host
              $config['smtp_timeout'] = '7	'; // SMTP Timeout (in seconds).
              $config['wordwrap'] = TRUE; // TRUE or FALSE (boolean)    Enable word-wrap.
              $config['wrapchars'] = 76; // Character count to wrap at.
              $config['mailtype'] = 'html'; // text or html Type of mail. If you send HTML email you must send it as a complete web page. Make sure you don't have any relative links or relative image paths otherwise they will not work.
              $config['charset'] = 'utf-8'; // Character set (utf-8, iso-8859-1, etc.).
              $config['validate'] = TRUE; // TRUE or FALSE (boolean)    Whether to validate the email address.
              $config['priority'] = 1; // 1, 2, 3, 4, 5    Email Priority. 1 = highest. 5 = lowest. 3 = normal.
              $config['crlf'] = "\r\n"; // "\r\n" or "\n" or "\r" Newline character. (Use "\r\n" to comply with RFC 822).
              $config['newline'] = "\r\n"; // "\r\n" or "\n" or "\r"    Newline character. (Use "\r\n" to comply with RFC 822).
              $config['bcc_batch_mode'] = FALSE; // TRUE or FALSE (boolean)    Enable BCC Batch Mode.
              $config['bcc_batch_size'] = 200; //
        
        
          $this->load->library('email');
          $this->email->set_newline("\r\n");
          $this->email->initialize($config);
             $email_body ="<div>Your license key is </div>";
         
     
            $this->email->from('testmindcrew1001@gmail.com','Mindcrew Technologies');
            $this->email->to($email_address);
            // $this->email->to('tayyabjohar@gmail.com');
            $this->email->subject('Subject : Welcome');
           // $this->email->message($a);
		 
		 $this->email->message('<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>  <title></title><meta http-equiv="X-UA-Compatible" content="IE=edge">  <!--<![endif]--><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><style type="text/css">  #outlook a { padding: 0; }  .ReadMsgBody { width: 100%; }  .ExternalClass { width: 100%; }  .ExternalClass * { line-height:100%; }  body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }  table, td { border-collapse:collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }  img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }  p { display: block; margin: 13px 0; }</style><style type="text/css">  @media only screen and (max-width:480px) {    @-ms-viewport { width:320px; }    @viewport { width:320px; }  }</style><link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css">    <style type="text/css">        @import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);    </style><style type="text/css">  @media only screen and (min-width:480px) {    .mj-column-per-100 { width:100%!important; }  }</style></head><b  ody style="background: #F5F5F5;">    <div class="mj-container" style="background-color:#F5F5F5;"><div style="margin:0px auto;max-width:600px;background:#FFFFFF;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#FFFFFF;" align="left" border="0"><tbody></tbody></table></div><div style="margin:0px auto;max-width:600px;background:#FFFFFF;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#FFFFFF;" align="center" border="0"><tbody ><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:0px 0px 0px 0px;"><div style="margin:0px auto;max-width:600px;background:##FFFFFF;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:##FFFFFF;" align="center" border="0"><tbody><tr><td style="text-align:left;vertical-align:top;direction:ltr;font-size:0px;padding:7px 0px 7px 0px;"><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="left"><div style="cursor:auto;color:#367fa9;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:left;"><h1 style="font-family: &apos;Open Sans&apos;, sans-serif; line-height: 100%;">WMSIMPLIFIED</h1></div></td></tr></tbody></table></div></td></tr></tbody></table></div><div style="margin:0px auto;max-width:600px;background:#FFFFFF;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#FFFFFF;" align="center" border="0"><tbody style="background:#ededed;"><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="left"><div style="cursor:auto;color:#000000;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:left;"><p>Welcome to WMSIMPLIFIED</p><p>Please find your access keys below -<br> '.$a.'</p> </p><br/><p>Thanks! </p></div></td></tr></tbody></table></div></td></tr></tbody></table></div><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" border="0"><tbody><tr><td><div style="background-color:#367fa9; margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="center"><div style="cursor:auto;color:#000000;color:#fff; font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:center;">&copy; Copyright 2020 WMSIMPLIFIED</p></div></td></tr></tbody></table></div></td></tr></tbody></table></div></td></tr></tbody></div></div></body></html>');
		
		   
            // $this->email->message('This Message is to notify you that your license key is'.$userdata['licence_session']);
             // $this->email->send();
            $send = $this->email->send();
          //print_r($this->email->send());die;
           //Send mail 
            // print_r($this->email->send());die;
           
           if($send) {
               
            $this->session->set_flashdata("email_sent"," A license key has been sent to your email address");
          //   print_r($this->session->flashdata('email_sent'));exit;
        //    $this->load->view('user/lic',$userdata);

        return true;
           }
           else {
              echo $this->email->print_debugger();
               
            $this->session->set_flashdata("email_sent","Error in sending Email.");
            // $this->load->view('user/signup',$userdata);
          //  $this->load->view('email_form'); 

             return false;
           }
      }

      public function sendLicenseKey($email_address,$l_key)
      {
         
            $userdata = $this->session->userdata($userdata);
            // print_r($userdata);die;
                $config['protocol'] = 'smtp'; // mail, sendmail, or smtp    The mail sending protocol.
                $config['smtp_host'] = 'ssl://smtp.googlemail.com'; // SMTP Server Address.
                $config['smtp_user'] = 'testmindcrew1001@gmail.com'; // SMTP Username.
                 $config['smtp_pass'] = 'Saloni19@'; // SMTP Password.
                
                 // $config['smtp_user'] = 'support@plumkit.com';
                 // $config['smtp_pass'] = 'Mindcrew01'; // SMTP Password.
                $config['smtp_port'] = '465'; // SMTP Port. 25 is for local host
                $config['smtp_timeout'] = '7	'; // SMTP Timeout (in seconds).
                $config['wordwrap'] = TRUE; // TRUE or FALSE (boolean)    Enable word-wrap.
                $config['wrapchars'] = 76; // Character count to wrap at.
                $config['mailtype'] = 'html'; // text or html Type of mail. If you send HTML email you must send it as a complete web page. Make sure you don't have any relative links or relative image paths otherwise they will not work.
                $config['charset'] = 'utf-8'; // Character set (utf-8, iso-8859-1, etc.).
                $config['validate'] = TRUE; // TRUE or FALSE (boolean)    Whether to validate the email address.
                $config['priority'] = 1; // 1, 2, 3, 4, 5    Email Priority. 1 = highest. 5 = lowest. 3 = normal.
                $config['crlf'] = "\r\n"; // "\r\n" or "\n" or "\r" Newline character. (Use "\r\n" to comply with RFC 822).
                $config['newline'] = "\r\n"; // "\r\n" or "\n" or "\r"    Newline character. (Use "\r\n" to comply with RFC 822).
                $config['bcc_batch_mode'] = FALSE; // TRUE or FALSE (boolean)    Enable BCC Batch Mode.
                $config['bcc_batch_size'] = 200; //
          
          
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->initialize($config);
               $email_body ="<div>Your license key is </div>";
           
       
              $this->email->from('testmindcrew1001@gmail.com','Mindcrew Technologies');
              $this->email->to($email_address);
              // $this->email->to('tayyabjohar@gmail.com');
              $this->email->subject('Subject : Welcome');
             // $this->email->message($a);
           
           $this->email->message('<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>  <title></title><meta http-equiv="X-UA-Compatible" content="IE=edge">  <!--<![endif]--><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><style type="text/css">  #outlook a { padding: 0; }  .ReadMsgBody { width: 100%; }  .ExternalClass { width: 100%; }  .ExternalClass * { line-height:100%; }  body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }  table, td { border-collapse:collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }  img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }  p { display: block; margin: 13px 0; }</style><style type="text/css">  @media only screen and (max-width:480px) {    @-ms-viewport { width:320px; }    @viewport { width:320px; }  }</style><link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css">    <style type="text/css">        @import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);    </style><style type="text/css">  @media only screen and (min-width:480px) {    .mj-column-per-100 { width:100%!important; }  }</style></head><b  ody style="background: #F5F5F5;">    <div class="mj-container" style="background-color:#F5F5F5;"><div style="margin:0px auto;max-width:600px;background:#FFFFFF;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#FFFFFF;" align="left" border="0"><tbody></tbody></table></div><div style="margin:0px auto;max-width:600px;background:#FFFFFF;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#FFFFFF;" align="center" border="0"><tbody ><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:0px 0px 0px 0px;"><div style="margin:0px auto;max-width:600px;background:##FFFFFF;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:##FFFFFF;" align="center" border="0"><tbody><tr><td style="text-align:left;vertical-align:top;direction:ltr;font-size:0px;padding:7px 0px 7px 0px;"><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="left"><div style="cursor:auto;color:#367fa9;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:left;"><h1 style="font-family: &apos;Open Sans&apos;, sans-serif; line-height: 100%;">WMSIMPLIFIED</h1></div></td></tr></tbody></table></div></td></tr></tbody></table></div><div style="margin:0px auto;max-width:600px;background:#FFFFFF;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#FFFFFF;" align="center" border="0"><tbody style="background:#ededed;"><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="left"><div style="cursor:auto;color:#000000;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:left;"><p>Welcome to WMSIMPLIFIED</p><p>Your license key is - ' .$l_key.'</p> </p><br/><p>Thanks! </p></div></td></tr></tbody></table></div></td></tr></tbody></table></div><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" border="0"><tbody><tr><td><div style="background-color:#367fa9; margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="center"><div style="cursor:auto;color:#000000;color:#fff; font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:center;">&copy; Copyright 2020 WMSIMPLIFIED</p></div></td></tr></tbody></table></div></td></tr></tbody></table></div></td></tr></tbody></div></div></body></html>');
          
             
              // $this->email->message('This Message is to notify you that your license key is'.$userdata['licence_session']);
               // $this->email->send();
              $send = $this->email->send();
            //print_r($this->email->send());die;
             //Send mail 
              // print_r($this->email->send());die;
             
             if($send) {
                 
              $this->session->set_flashdata("email_sent"," A license key has been sent to your email address");
            //   print_r($this->session->flashdata('email_sent'));exit;
          //    $this->load->view('user/lic',$userdata);
  
          return true;
             }
             else {
                echo $this->email->print_debugger();
                 
              $this->session->set_flashdata("email_sent","Error in sending Email.");
              // $this->load->view('user/signup',$userdata);
            //  $this->load->view('email_form'); 
  
               return false;
             }
        }
  
      

}
