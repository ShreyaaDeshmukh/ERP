<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Ccustomer extends CI_Controller {

    public $menu;



    function __construct() {

        parent::__construct();

        $this->load->library('auth');

        $this->load->library('lcustomer');

        $this->load->library('session');

        $this->load->model('Customers');

        // $this->auth->check_admin_auth();

        $this->template->current_menu = 'customer';
		
		$this->load->model('Web_settings');
		$this->Web_settings->checkLicensing();
		
    }



    //Default loading for Customer System.

    public function index() {
        $r_id = $this->session->r_id;
        //Calling Customer add form which will be loaded by help of "lcustomer,located in library folder"
        if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
       else{ 
        $content = $this->lcustomer->customer_add_form($r_id);

        //Here ,0 means array position 0 will be active class

        $this->template->full_admin_html_view($content);
       }

    }



    //customer_search_item

    public function customer_search_item() {

        $customer_id = $this->input->post('customer_id');

        $content = $this->lcustomer->customer_search_item($customer_id);

        $this->template->full_admin_html_view($content);

    }



    //credit customer_search_item

    public function credit_customer_search_item() {

        $customer_id = $this->input->post('customer_id');

        $content = $this->lcustomer->credit_customer_search_item($customer_id);

        $this->template->full_admin_html_view($content);

    }



    //paid customer_search_item

    public function paid_customer_search_item() {

        $customer_id = $this->input->post('customer_id');

        $content = $this->lcustomer->paid_customer_search_item($customer_id);

        $this->template->full_admin_html_view($content);

    }



    // Supplier details findings !!!!!!!!!!!!!! Inactive Now !!!!!!!!!!!!

    public function ship_to_address($id){
        $content = $this->Customers->ship_to_address($id);
        echo json_encode(array("status"=>"true","data"=>$content));
    }

    public function customer_details_by_id($customer_id) {

        $content = $this->lcustomer->customer_search_item_new($customer_id);

        #$this->supplier_id = $supplier_id;

        

        echo json_encode(array("status"=>"true","data"=>$content));

    }

    public function customer_details_by_id1($customer_id) {

        $content = $this->lcustomer->customer_search_item_new1($customer_id);

        #$this->supplier_id = $supplier_id;

        

        echo json_encode(array("status"=>"true","data"=>$content));

    }

    //Manage customer

    public function manage_customer($r_id) {

        $this->load->model('Customers');



        #

        #pagination starts

        #

	 if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
        $config["base_url"] = base_url('Ccustomer/manage_customer/'.$r_id);

        $config["total_rows"] = $this->Customers->customer_list_count($r_id);

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

        $content = $this->lcustomer->customer_list($links, $config["per_page"], $page,$r_id);



        $this->template->full_admin_html_view($content);

        ;

    }}

	
	//Manage customer
//manage ship to
public function manage_ship_to_customer($r_id) {

    $this->load->model('Customers');



    #

    #pagination starts

    #

 if (!$this->session->userdata('username')){
        $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
        // $this->auth->check_admin_auth();
    }
    else{
    $config["base_url"] = base_url('Ccustomer/manage_ship_to_customer/'.$r_id);

    $config["total_rows"] = $this->Customers->customer_ship_list_count($r_id);

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

    $content = $this->lcustomer->customer_ship_to_list($links, $config["per_page"], $page,$r_id);



    $this->template->full_admin_html_view($content);

    ;

}}


//end of ship to
    public function import_customers($r_id) {

        $this->load->model('Customers');
		 if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
        $content = $this->lcustomer->import_customers($r_id);
        $this->template->full_admin_html_view($content);

    }}

    //import ship to 
    public function import_shipTo($r_id) {

        $this->load->model('Customers');
		 if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
        $content = $this->lcustomer->import_shipTo($r_id);
        $this->template->full_admin_html_view($content);

    }}
	
	public function customer_import_action(){
		  $r_id =$this->session->r_id;
		print_r($_POST);
		print_r($_FILES);
		 $this->load->model('Customers');
		 $this->Customers->import_customer($_FILES,$r_id);
		die;
	}

    // ship to import
    public function shipto_import_action(){
        $r_id =$this->session->r_id;
      print_r($_POST);
      print_r($_FILES);
       $this->load->model('Customers');
       $this->Customers->import_shipto($_FILES,$r_id);
      die;
  }
    //Product Add Form

    public function credit_customer() {

        $this->load->model('Customers');



        #

        #pagination starts

        #

        $config["base_url"] = base_url('Ccustomer/credit_customer/');

        $config["total_rows"] = $this->Customers->credit_customer_list_count();

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

        $content = $this->lcustomer->credit_customer_list($links, $config["per_page"], $page);



        $this->template->full_admin_html_view($content);

        ;

    }



    //Paid Customer list. The customer who will pay 100%.

    public function paid_customer() {

        $this->load->model('Customers');



        #

        #pagination starts

        #

        $config["base_url"] = base_url('Ccustomer/paid_customer/');

        $config["total_rows"] = $this->Customers->paid_customer_list_count();

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

        $content = $this->lcustomer->paid_customer_list($links, $config["per_page"], $page);

        $this->template->full_admin_html_view($content);

        ;

    }



    //Insert Product and upload

    public function insert_customer()
     {
         #print_r($_POST);die;
        $r_id=$this->session->r_id;
        $customer_id = $this->auth->generator(15);

        //Customer  basic information adding.
		
        $data = array(

            'customer_id' => $customer_id,

            'customer_name' => $this->input->post('customer_name'),

            'customer_address' => $this->input->post('address'),

            'customer_mobile' => $this->input->post('mobile'),

            'customer_email' => $this->input->post('email'),

            'status' => 1,

            'country' => $this->input->post('country'),

            'state' => $this->input->post('state'),

            'zip' => $this->input->post('zip'),

            'city' => $this->input->post('city'),
			
            'customer_detail' => $this->input->post('customer_detail'),
            'r_id' => $r_id

        );
// print_r($data);die;
		$multipleaddress = $this->input->post('address1');
		$onceaddress = $this->input->post('address');
		$city =$this->input->post('city');
		$state = $this->input->post('state');
		$country = $this->input->post('country');
		$zip = $this->input->post('zip');
        $addre = $onceaddress.' '.$city.' '.$state.' '.$country.' '.$zip;	
        // print_r($addre,$multipleaddress);
        // print_r($data);die;	

        if(!empty($this->input->post('ship_to_name'))){

            if(!empty($this->input->post('ship_to_name1'))){
                
                $shipData = array(
                    'customer_id'=> $customer_id,
                    'r_id' => $r_id,
                    'ship_to_name' => $this->input->post('ship_to_name'),
                    'ship_to_email' => $this->input->post('ship_to_email'),
                    'ship_to_phone' => $this->input->post('ship_to_phone'),
                    'ship_to_address' => $this->input->post('ship_to_address'),
                    'country'=> $this->input->post('country1'),
                    'state'=> $this->input->post('state1'),
                    'city'=> $this->input->post('city1'),
                    'zip'=> $this->input->post('zip1')
                );

                $shipExtraData = array('ship_to_name1'=>$this->input->post('ship_to_name1'),'ship_to_email1'=>$this->input->post('ship_to_email1'),'ship_to_phone1'=>$this->input->post('ship_to_phone1'),'ship_to_address1'=>$this->input->post('ship_to_address1'),'country2'=>$this->input->post('country2'),'state2'=>$this->input->post('state2'),'city2'=>$this->input->post('city2'),'zip2'=>$this->input->post('zip2'));
                
            }
            else{
                $shipData = array(
                    'customer_id'=> $customer_id,
                    'r_id' => $r_id,
                    'ship_to_name' => $this->input->post('ship_to_name'),
                    'ship_to_email' => $this->input->post('ship_to_email'),
                    'ship_to_phone' => $this->input->post('ship_to_phone'),
                    'ship_to_address' => $this->input->post('ship_to_address'),
                    'country'=> $this->input->post('country1'),
                    'state'=> $this->input->post('state1'),
                    'city'=> $this->input->post('city1'),
                    'zip'=> $this->input->post('zip1')
                );
                $shipExtraData = array();
            }
            
         
           
           // $multipleShipToAddress = 
            $result = $this->Customers->customer_entry($data,$customer_id,$addre,$multipleaddress,$shipData,$shipExtraData,$r_id);
        }
       else{
        $shipData = array();
        $shipExtraData = array();
           $result = $this->Customers->customer_entry($data,$customer_id,$addre,$multipleaddress,$shipData,$shipExtraData,$r_id);
        }
        

        if ($result == TRUE) {

            //Previous balance adding -> Sending to customer model to adjust the data.

            //$this->Customers->previous_balance_add($this->input->post('previous_balance'), $customer_id);



            $this->session->set_userdata(array('message' => display('successfully_added')));

            if (isset($_POST['add-customer'])) {

                redirect(base_url('Ccustomer/manage_customer/'.$r_id));

                exit;

            } elseif (isset($_POST['add-customer-another'])) {

                redirect(base_url('Ccustomer'));

                exit;

            }

        } else {

            $this->session->set_userdata(array('error_message' => display('already_exists')));

            redirect(base_url('Ccustomer'));

        }

    }



    //customer Update Form

    public function customer_update_form($r_id,$customer_id) {
		 if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{

        $content = $this->lcustomer->customer_edit_data($r_id,$customer_id);

        $this->menu = array('label' => 'Edit Customer', 'url' => 'Ccustomer');

        $this->template->full_admin_html_view($content);

    }}


// ship to update code starts here
   public function customer_ship_to_update_form($r_id,$customer_id,$id) {
       
       if (!$this->session->userdata('username')){
       $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
       // $this->auth->check_admin_auth();
   }
   else{

   $content = $this->lcustomer->customer_ship_to_edit_data($r_id,$customer_id,$id);

   $this->menu = array('label' => 'Edit Ship Tp', 'url' => 'Ccustomer');

   $this->template->full_admin_html_view($content);

}}
// end of ship to  update
    //Customer Ledger

    public function customer_ledger($customer_id) {



        $content = $this->lcustomer->customer_ledger_data($customer_id);

        $this->menu = array('label' => 'Customer Ledger', 'url' => 'Ccustomer');

        $this->template->full_admin_html_view($content);

    }



    //Customer Final Ledger

    public function customerledger($customer_id) {

        $content = $this->lcustomer->customerledger_data($customer_id);

        $this->menu = array('label' => 'Customer Ledger', 'url' => 'Ccustomer');

        $this->template->full_admin_html_view($content);

    }



    //Customer Previous Balance

    public function previous_balance_form() {

        $content = $this->lcustomer->previous_balance_form();

        $this->template->full_admin_html_view($content);

    }



    // customer Update

    public function customer_update() {
		$r_id = $this->session->r_id;

        $this->load->model('Customers');

        $customer_id = $this->input->post('customer_id');
		
		$multipleaddress = $this->input->post('address1');
		$onceaddress = $this->input->post('address');
		$city =$this->input->post('city');
		$state = $this->input->post('state');
		$country = $this->input->post('country');
		$zip = $this->input->post('zip');
		$addre = $onceaddress.' '.$city.' '.$state.' '.$country.' '.$zip;
		
		
        $data = array(

            'customer_name' => $this->input->post('customer_name'),

            'customer_address' => $this->input->post('address'),

            'customer_mobile' => $this->input->post('mobile'),

            'customer_email' => $this->input->post('email'),

            'country' => $this->input->post('country'),

            'state' => $this->input->post('state'),

            'city' => $this->input->post('city'),

            'zip' => $this->input->post('zip'),
			
            'customer_detail' => $this->input->post('customer_detail'),

        );
		
		$result = $this->Customers->update_customer($data,$customer_id,$addre,$multipleaddress);

      

        $this->session->set_userdata(array('message' => display('successfully_updated')));

        redirect(base_url('Ccustomer/manage_customer/'.$r_id));

        exit;

    }

// ship to update
public function customer_ship_to_update() {
    $r_id = $this->session->r_id;

    $this->load->model('Customers');

    $customer_id = $this->input->post('customer_id');
    $id = $this->input->post('id');
    
   
    $city =$this->input->post('city');
    $state = $this->input->post('state');
    $country = $this->input->post('country');
    $zip = $this->input->post('zip');
  
    
    
    $data = array(

        'ship_to_name' => $this->input->post('ship_to_name'),
        'ship_to_address' => $this->input->post('ship_to_address'),

        'ship_to_phone' => $this->input->post('ship_to_phone'),

        'ship_to_email' => $this->input->post('ship_to_email')

      
      

    );
    
    $result = $this->Customers->update_customer_ship_to($data,$customer_id,$r_id,$id);

  

    $this->session->set_userdata(array('message' => display('successfully_updated')));

    redirect(base_url('Ccustomer/manage_ship_to_customer/'.$r_id));

    exit;

}

    // product_delete

    public function customer_delete() {

        $this->load->model('Customers');

        $customer_id = $_POST['customer_id'];

        $custo = $this->Customers->delete_customer($customer_id);
		if($custo==1){
			$this->session->set_userdata(array('message' => display('successfully_delete')));
		}else{
			$this->session->set_userdata(array('error_message' => "You can not delete this customer because its using in some transactions."));	
		}
        #$this->Customers->delete_transection($customer_id);

        #$this->Customers->delete_customer_ledger($customer_id);

        #$this->Customers->delete_customer_ledger($customer_id);

        #$this->Customers->delete_invoic($customer_id);
		
		#redirect(base_url('Ccustomer'));
        

        return true;

    }

    // delete customer ship to from manage ship to

    public function customer_ship_to_delete() {

        $this->load->model('Customers');

        $customer_id = $_POST['customer_id'];

        $custo = $this->Customers->delete_ship_to_customer($customer_id);
		if($custo==1){
			$this->session->set_userdata(array('message' => display('successfully_delete')));
		}else{
			$this->session->set_userdata(array('error_message' => "You can not delete this customer because its using in some transactions."));	
		}
        #$this->Customers->delete_transection($customer_id);

        #$this->Customers->delete_customer_ledger($customer_id);

        #$this->Customers->delete_customer_ledger($customer_id);

        #$this->Customers->delete_invoic($customer_id);
		
		#redirect(base_url('Ccustomer'));
        

        return true;

    }

	
	public function checkCustommernames(){
		$r_id = $this->session->r_id;
		$CI =& get_instance();
		$customer_name = $_POST['customer_name'];
		$CI->load->model('Customers');
		$datas = $this->Customers->check_customer_name($customer_name,$r_id);
		if($datas){
			echo json_encode(array("status"=>"false", "msg"=>"This customer email already exist. Please try another"));exit();
		}else{
			echo json_encode(array("status"=>"true", "msg"=>"YOu can use this email"));exit();
		}
	}



}

