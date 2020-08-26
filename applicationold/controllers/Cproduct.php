<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cproduct extends CI_Controller {

    public $product_id;

    function __construct() {
        parent::__construct();

        $this->template->current_menu = 'product';
		$this->load->model('Web_settings');
		$this->Web_settings->checkLicensing();
		
    }

    //Index page load
    public function index() {
         $CI = & get_instance();
        //  print_r($this->session);
        //  print_r($this->session->r_id);
         $r_id = $this->session->r_id;
         if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
       else{ 
        // $CI->auth->check_admin_auth();
    //    print_r($this->session->flashdata('r_id'));die;
        $CI->load->library('lproduct');
        $content = $CI->lproduct->product_add_form($r_id);
        $this->template->full_admin_html_view($content);
       }
    }

    //Product Add Form
    public function manage_product($r_id) {
        // $r_id=$this->session->r_id;
        $CI = & get_instance();
        // $this->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $CI->load->model('Products');

        #
        #pagination starts
        #
        if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
       else{
        $config["base_url"] = base_url('Cproduct/manage_product/'.$r_id);
        $config["total_rows"] = $this->Products->product_list_count($r_id);
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
        $content = $this->lproduct->product_list($links, $config["per_page"], $page,$r_id);

        $this->template->full_admin_html_view($content);
    }
}
	
	public function import_product() {
		 $CI = & get_instance();
		 $CI->load->library('lproduct');
		   if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
		$content = $this->lproduct->import_product();
        $this->template->full_admin_html_view($content);

    }}
	
	public function product_import_action(){
		$r_id = $this->session->r_id;
		$this->load->model('Products');
		$this->Products->import_product($_FILES,$r_id);
		// die;
	}

    //Insert Product and uload
    public function insert_product($r_id) { #echo "<pre>";print_r($_POST);
        $CI = & get_instance();
        // print_r($r_id);die;
        // print_r($r_id);die;
        // $CI->auth->check_admin_auth();
        $CI->load->library('lproduct');
        if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
       else{

        //Supplier check
        if ($this->input->post('supplier_id') == null) {
            $this->session->set_userdata(array('error_message' => display('please_select_supplier')));
            redirect(base_url('Cproduct'));
        }
		if ($_FILES['image']['name']) {
			
            //Chapter chapter add start
            $config['upload_path'] = './my-assets/image/product/';
            $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp|tiff';
            $config['max_size'] = "*";
            $config['max_width'] = "*";
            $config['max_height'] = "*";
            $config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);
           
            if (!$this->upload->do_upload('image')) { 
                $error = array('error' => $this->upload->display_errors());
				
                $this->session->set_userdata(array('error_message' => display('Image Not Uploaded!')));
                redirect(base_url('Cproduct'));
            } else { 
                $image = $this->upload->data();
                $image_url = base_url() . "my-assets/image/product/" . $image['file_name'];
            }
        }	
		

//calculating units
		$arrunitfirst = [];
		$arrunitsecond = [];
		$arrunitthird = [];
		$arrunitfourth = [];
		$tt = 1;
		$str = "";
		$finalArray = [];
		for($z=0;$z<count($_POST['first']);$z++){
			if(!empty($_POST['first'][$z]) && !empty($_POST['firstval'][$z])){
				$finalArray["first"][] = array($_POST['first'][$z]=>$_POST['firstval'][$z]);
			}
			if(!empty($_POST['second'][$z]) && !empty($_POST['secondval'][$z])){
				$finalArray["second"][] = array($_POST['second'][$z]=>$_POST['secondval'][$z]);
			}
			if(!empty($_POST['third'][$z]) && !empty($_POST['thirdval'][$z])){
				$finalArray["third"][] = array($_POST['third'][$z]=>$_POST['thirdval'][$z]);
			}
			if(!empty($_POST['fourth'][$z]) && !empty($_POST['fourthval'][$z])){
				$finalArray["fourth"][] = array($_POST['fourth'][$z]=>$_POST['fourthval'][$z]);
			}
			if(!empty($_POST['sell_price'][$z]) && !empty($_POST['sell_price'][$z])){
				$finalArray["sell_price"][] = array('sell_price'=>$_POST['sell_price'][$z]);
			}
			if(!empty($_POST['vendor_price'][$z]) && !empty($_POST['vendor_price'][$z])){
				$finalArray["vendor_price"][] = array('vendor_price'=>$_POST['vendor_price'][$z]);
			}
			
				
		
		}
		$firstarr = [];
		$secondarr = [];
		$thirdarr = [];
		$fourtharr = [];
		$fifthharr = [];
		$sixarr = [];
		
		foreach($finalArray as $key=>$value){
			$m = 0;
			
		foreach($value as $key=>$vals){ 
			if(!empty($vals)){
				$keyesss1 = array_keys($vals);
				$valuess1 = array_values($vals);
				
					
					$firstarr[$m][] = array($keyesss1[0] => $valuess1[0]);
					
				
			}
			$m++;
		}
		
		}
		#print_r($firstarr);
		#print_r($secondarr);
		#print_r($thirdarr);
		#print_r($fourtharr);
		
		$firstFinalizeArrr = [];
		$secondFinalizeArrr = [];
		$thirdFinalizeArrr = [];
		$fourthFinalizeArrr = [];
		
		$mainsArrs = [];
		
		
		$zkks = 0;
		foreach($firstarr as $keyys=>$vallss){
			#print_r($keyys);
			#print_r($vallss);
			$his = [];
			foreach($vallss as $kyyyes=>$valllls){
				#print_r($kyyyes);
				#print_r($valllls);
				$kys = array_keys($valllls);
				$vls = array_values($valllls);
				if($kys[0]!="Select"){
					$his[$kys[0]] = $vls[0];
					#$his = array($kys=>$vals);
				}
			}
			#print_r($his);
			$mainsArrs[] = $his;
			$zkks++;
		}
		
		
		if(!empty($firstFinalizeArrr)){
			$mainsArrs[] = $firstFinalizeArrr;
		}		

/* 	echo "<pre>";print_r($mainsArrs);
echo json_encode($mainsArrs);		
		die;  */
        $price = $this->input->post('price');
        $tax_percentage = $this->input->post('tax');
        $tax = ($price * $tax_percentage) / 100;
		if($this->input->post('lot_flag')=="1"){
			$lot_flag = 1;
		}else{
			$lot_flag = 0;
		}
		
		if($this->input->post('expiry_flag')=="1"){
			$expiry_flag = 1;
		}else{
			$expiry_flag = 0;
		}
		
		if($this->input->post('serial_flag')=="1"){
			$serial_flag = 1;
		}else{
			$serial_flag = 0;
		}
		
		
        $data = array(
            'product_id' => $this->generator(8),
            'product_name' => $this->input->post('product_name'),
            'supplier_id' => $this->input->post('supplier_id'),
            'category_id' => $this->input->post('category_id'),
            'r_id' => $r_id,
            #'price' => $price,
            #'supplier_price' => $this->input->post('supplier_price'),
            'tax' => $tax,
			'lot_flag' => $lot_flag,
			'lot_flag' => $lot_flag,
            'expiry_flag' => $expiry_flag,
            'serial_flag' => $serial_flag,
            'product_details' => $this->input->post('description'),
            'image' => (!empty($image_url) ? $image_url : base_url('my-assets/image/product.png')),
            'status' => 1,
			'unit_values' => json_encode($mainsArrs)
        );

        $result = $CI->lproduct->insert_product($data);
		// print_r($result);die;
        if ($result == 1) {
            $this->session->set_userdata(array('message' => display('successfully_added')));
            if (isset($_POST['add-product'])) {
                redirect(base_url('Cproduct/manage_product/'.$r_id));
                exit;
            } elseif (isset($_POST['add-product-another'])) {
                redirect(base_url('Cproduct'));
                exit;
            }
        } else {
            $this->session->set_userdata(array('error_message' => 'Product Name already exist.'));
            redirect(base_url('Cproduct'));
        }
    }
}

    //Product Update Form
    public function product_update_form($product_id) {
        $CI = & get_instance();
        // $CI->auth->check_admin_auth();
        $CI->load->library('lproduct');
        // echo "hii";die;
		  if (!$this->session->userdata('username')){
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            // $this->auth->check_admin_auth();
        }
		else{
        $content = $CI->lproduct->product_edit_data($product_id);
        $this->template->full_admin_html_view($content);
    }}

    // Product Update
    public function product_update($r_id) {#echo "<pre>";print_r($_POST);
		
        $CI = & get_instance();
        // $CI->auth->check_admin_auth();
        $CI->load->model('Products');

        $product_id = $this->input->post('product_id');

        // configure for upload 
        $config = array(
            'upload_path' => "./my-assets/image/product/",
            'allowed_types' => "png|jpg|jpeg|gif|bmp|tiff",
            'overwrite' => TRUE,
//                'file_name' => "IST" . time(),
            'max_size' => '0',
        );
        $image_data = array();
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('image')) {
            $image_data = $this->upload->data();
//                print_r($image_data); die();
            $image_name = base_url() . "my-assets/image/product/".$image_data['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $image_data['full_path']; //get original image
            $config['maintain_ratio'] = TRUE;
            $config['height'] = '*';
            $config['width'] = '*';
//                $config['quality'] = 50;
            $this->load->library('image_lib', $config);
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
        } else {
            $image_name = $this->input->post('old_image');
        }


		//calculating units
		$arrunitfirst = [];
		$arrunitsecond = [];
		$arrunitthird = [];
		$arrunitfourth = [];
		$tt = 1;
		$str = "";
		$finalArray = [];
		/* print_r($_POST);
		die;
		 */
		 
		for($z=0;$z<count($_POST['first']);$z++){
			if(!empty($_POST['first'][$z]) && !empty($_POST['firstval'][$z])){
				$finalArray["first"][] = array($_POST['first'][$z]=>$_POST['firstval'][$z]);
			}
				
			if(!empty($_POST['second'][$z]) && !empty($_POST['secondval'][$z])){
				$finalArray["second"][] = array($_POST['second'][$z]=>$_POST['secondval'][$z]);
			}
			if(!empty($_POST['third'][$z]) && !empty($_POST['thirdval'][$z])){
				$finalArray["third"][] = array($_POST['third'][$z]=>$_POST['thirdval'][$z]);
			}
			if(!empty($_POST['fourth'][$z]) && !empty($_POST['fourthval'][$z])){
				$finalArray["fourth"][] = array($_POST['fourth'][$z]=>$_POST['fourthval'][$z]);
			}
			if(!empty($_POST['sell_price'][$z]) && !empty($_POST['sell_price'][$z])){
				$finalArray["sell_price"][] = array('sell_price'=>$_POST['sell_price'][$z]);
			}
			if(!empty($_POST['vendor_price'][$z]) && !empty($_POST['vendor_price'][$z])){
				$finalArray["vendor_price"][] = array('vendor_price'=>$_POST['vendor_price'][$z]);
			}
			
				
		
		}
		
		$firstarr = [];
		$secondarr = [];
		$thirdarr = [];
		$fourtharr = [];
		$fifthharr = [];
		$sixarr = [];
		
		
		
		foreach($finalArray as $key=>$value){
			$m = 0;
			
		foreach($value as $key=>$vals){ 
			if(!empty($vals)){
				$keyesss1 = array_keys($vals);
				$valuess1 = array_values($vals);
				
					
					$firstarr[$m][] = array($keyesss1[0] => $valuess1[0]);
					
				
			}
			$m++;
		}
		
		}
		
		#print_r($firstarr);
		#print_r($secondarr);
		#print_r($thirdarr);
		#print_r($fourtharr);
		
		$firstFinalizeArrr = [];
		$secondFinalizeArrr = [];
		$thirdFinalizeArrr = [];
		$fourthFinalizeArrr = [];
		
		$mainsArrs = [];
		
		
		$zkks = 0;
		foreach($firstarr as $keyys=>$vallss){
			#print_r($keyys);
			#print_r($vallss);
			$his = [];
			foreach($vallss as $kyyyes=>$valllls){
				#print_r($kyyyes);
				#print_r($valllls);
				$kys = array_keys($valllls);
				$vls = array_values($valllls);
				if($kys[0]!="Select"){
					$his[$kys[0]] = $vls[0];
					#$his = array($kys=>$vals);
				}
			}
			#print_r($his);
			$mainsArrs[] = $his;
			$zkks++;
		}
		
		
		if(!empty($firstFinalizeArrr)){
			$mainsArrs[] = $firstFinalizeArrr;
		}
		
/* 		print_r($mainsArrs);
echo json_encode($mainsArrs);		
		die; 
 */
		
        $data = array(
            //'product_id' => $this->generator(8),
            'product_name' => $this->input->post('product_name'),
            'supplier_id' => $this->input->post('supplier_id'),
            'category_id' => $this->input->post('category_id'),
            #'price' => $this->input->post('price'),
            #'supplier_price' => $this->input->post('supplier_price'),
            'innercart_quantity' => $this->input->post('innercart_quantity'),
            'cartoon_quantity' => $this->input->post('cartoon_quantity'),
            'product_model' => $this->input->post('model'),
            'product_details' => $this->input->post('description'),
            'tax' => $this->input->post('tax'),
            'lot_flag' => ($this->input->post('lot_flag')=="1"?"1":"0"),
            'expiry_flag' => ($this->input->post('expiry_flag')=="1"?"1":"0"),
            'serial_flag' => ($this->input->post('serial_flag')=="1"?"1":"0"),
            'image' => $image_name,
//            'image' => (!empty($image_url) ? $image_url : $old_image),
            'status' => 1,
			'unit_values' => json_encode($mainsArrs),
			'r_id' => $r_id
        );
        #echo '<pre>';        print_r($data);        die();
		
        $result = $CI->Products->update_product($data, $product_id);
		// print_r($result);
		// die;
        if ($result == true) {
            $this->session->set_userdata(array('message' => display('successfully_updated')));
            redirect(base_url('Cproduct/manage_product/'.$r_id));
        } else {
            $this->session->set_userdata(array('error_message' => display('product_model_already_exist')));
            redirect(base_url('Cproduct/manage_product'));
        }
    }

    // product_delete
    public function product_delete() {
        $CI = & get_instance();
        // $this->auth->check_admin_auth();
        $CI->load->model('Products');
        $product_id = $_POST['product_id'];
        $result = $CI->Products->delete_product($product_id);
		if ($result == 1) {
            $this->session->set_userdata(array('message' => 'Successfully Deleted'));
           // redirect(base_url('Cproduct/manage_product'));
        } else {
            $this->session->set_userdata(array('error_message' => 'You cant delete this product'));
            ///redirect(base_url('Cproduct/manage_product'));
        }
        return true;
    }

    //Retrieve Single Item  By Search
    public function product_by_search($r_id) {
        $CI = & get_instance();
        // $this->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $product_id = $this->input->post('product_id');

        $content = $CI->lproduct->product_search_list($product_id,$r_id);
        $sub_menu = array(
            array('label' => 'Manage Product', 'url' => 'Cproduct', 'class' => 'active'),
            array('label' => 'Add Product', 'url' => 'Cproduct/manage_product')
        );
        $this->template->full_admin_html_view($content, $sub_menu);
    }

    //Retrieve Single Item  By Search
    public function product_details($product_id) {
        $this->product_id = $product_id;
        $CI = & get_instance();
        // $this->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $content = $CI->lproduct->product_details($product_id);
        $this->template->full_admin_html_view($content);
    }

    //Retrieve Single Item  By Search
    public function product_sales_supplier_rate($product_id = null, $startdate = null, $enddate = null) {
        if ($startdate == null) {
            $startdate = date('d-m-Y', strtotime('-30 days'));
        }
        if ($enddate == null) {
            $enddate = date('d-m-Y');
        }
        $product_id_input = $this->input->post('product_id');
        if (!empty($product_id_input)) {
            $product_id = $this->input->post('product_id');
            $startdate = $this->input->post('from_date');
            $enddate = $this->input->post('to_date');
        }

        $this->product_id = $product_id;

        $CI = & get_instance();
        // $this->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $content = $CI->lproduct->product_sales_supplier_rate($product_id, $startdate, $enddate);
        $this->template->full_admin_html_view($content);
    }

    //This function is used to Generate Key
    public function generator($lenth) {
        $CI = & get_instance();
        // $this->auth->check_admin_auth();
        $CI->load->model('Products');

        $number = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 8);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }

        $result = $this->Products->product_id_check($con);

        if ($result === true) {
            $this->generator(8);
        } else {
            return $con;
        }
    }
	
	
	public function checkProductname(){ 
		$r_id = $this->session->r_id;
		$this->load->model('Products');
		$product_name =  $_POST['product_name'];
		$cat = $this->Products->check_product_name($product_name,$r_id);		
		if($cat){	
			echo "1";
		}else{			
			echo "0";
		}
		exit();
	}
	
	public function checkProductnames(){
		
		$CI =& get_instance();
		$r_id = $this->session->r_id;
		$product_name = $_POST['product_name'];
		$CI->load->model('Products');
		$datas = $this->Products->check_product_name($product_name,$r_id);
		if($datas){
			echo json_encode(array("status"=>"false", "msg"=>"This product name already exist."));exit();
		}else{
			echo json_encode(array("status"=>"true", "msg"=>"You can use this product name"));exit();
		}
	}

}
