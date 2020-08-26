<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cinventory extends CI_Controller {

    public $product_id;

    function __construct() {
        parent::__construct();

        $this->template->current_menu = 'inventory';
    }

    //Index page load
    public function index() {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $content = $CI->lproduct->product_add_form();
        $this->template->full_admin_html_view($content);
    }

    //Product Add Form
    public function manage_product() {

        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $CI->load->model('Products');

        #
        #pagination starts
        #
        $config["base_url"] = base_url('CInventory/manage_product/');
        $config["total_rows"] = $this->Products->product_list_count();
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

        $content = $this->lproduct->product_list($links, $config["per_page"], $page);



        $this->template->full_admin_html_view($content);
    }

    //Insert Product and uload
    public function insert_product() { #echo "<pre>";print_r($_POST);
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->library('lproduct');

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
		#echo "<pre>";print_r($_POST);die; 
		//calculating units
		$arrunit = [];
		for($i=0;$i<count($_POST['perFrom']);$i++){
			#$arrunit[] = array($_POST['perFrom'][$i]=>$_POST['perFromQty'][$i], $_POST['perTo'][$i]=>$_POST['perToQty'][$i]);
			$arrunit[] = array("perFrom" => $_POST['perFrom'][$i], "perFromQty" => $_POST['perFromQty'][$i], "perTo" => $_POST['perTo'][$i], "perToQty" => $_POST['perToQty'][$i]);
		}
		#echo "<pre>";print_r($arrunit);echo json_encode($arrunit);die;
		/*#print_r($arrunit);
		 $productPerCarton = $arrunit["CREA"]["EA"];
		 $innerCartonPerCarton = $arrunit["CRIC"]["IC"];
		 $productPerInnerCarton = $arrunit["ICEA"]["EA"];
		if($productPerCarton>0 && $innerCartonPerCarton>0 && $productPerInnerCarton>0){
			if($productPerCarton/$innerCartonPerCarton!=$productPerInnerCarton){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_userdata(array('error_message' => 'InnerCarton Unit mismatch with regards to carton, Please check again!'));
				redirect(base_url('Cproduct'));
			}
		if(($productPerInnerCarton*$innerCartonPerCarton)!=$productPerCarton){
			$error = array('error' => $this->upload->display_errors());
            $this->session->set_userdata(array('error_message' => 'Carton Unit mismatch with regards to Inner carton, Please check again!'));
            redirect(base_url('Cproduct'));
		}
		}else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_userdata(array('error_message' => 'Please provide all unit informations!'));
			redirect(base_url('Cproduct'));
		}
		*/
		
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
        $data = array(
            'product_id' => $this->generator(8),
            'product_name' => $this->input->post('product_name'),
            'supplier_id' => $this->input->post('supplier_id'),
            'category_id' => $this->input->post('category_id'),
            'price' => $price,
            'supplier_price' => $this->input->post('supplier_price'),
            #'innercart_quantity' => $this->input->post('innercart_quantity'),
            #'cartoon_quantity' => $this->input->post('cartoon_quantity'),
            #'pallet_quantity' => $this->input->post('pallet_quantity'),
            'tax' => $tax,
			'lot_flag' => $lot_flag,
            'expiry_flag' => $expiry_flag,
            'product_model' => $this->input->post('model'),
            'product_details' => $this->input->post('description'),
            'image' => (!empty($image_url) ? $image_url : base_url('my-assets/image/product.png')),
            'status' => 1,
			'unit_values' => json_encode($arrunit)
        );

        $result = $CI->lproduct->insert_product($data);
        if ($result == 1) {
            $this->session->set_userdata(array('message' => display('successfully_added')));
            if (isset($_POST['add-product'])) {
                redirect(base_url('Cproduct/manage_product'));
                exit;
            } elseif (isset($_POST['add-product-another'])) {
                redirect(base_url('Cproduct'));
                exit;
            }
        } else {
            $this->session->set_userdata(array('error_message' => display('product_model_already_exist')));
            redirect(base_url('Cproduct'));
        }
    }

    //Product Update Form
    public function product_update_form($product_id) {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $content = $CI->lproduct->product_edit_data($product_id);
        $this->template->full_admin_html_view($content);
    }

    // Product Update
    public function product_update() {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
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

//        if ($_FILES['image']['name']) {
//            //Chapter chapter add start
//            $config['upload_path'] = './my-assets/image/product/';
//            $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp|tiff';
//            $config['max_size'] = "*";
//            $config['max_width'] = "*";
//            $config['max_height'] = "*";
//            $config['encrypt_name'] = TRUE;
//
//            $this->load->library('upload', $config);
//            if (!$this->upload->do_upload('image')) {
//                $error = array('error' => $this->upload->display_errors());
//                $this->session->set_userdata(array('error_message' => display('image_not_uploaded!')));
//                redirect(base_url('Cproduct'));
//            } else {
//                $image = $this->upload->data();
//                $old_image = $this->input->post('old_image');
//                $image_url = base_url() . "my-assets/image/product/" . $image['file_name'];
//            }
//        }
//        echo "SX".$old_image; die();
		
		//calculating units
		
		$arrunit = [];
		for($i=0;$i<count($_POST['perFrom']);$i++){
			#$arrunit[$_POST['unit1'][$i].$_POST['unit2'][$i]] = array($_POST['unit1'][$i]=>$_POST['value1'][$i], $_POST['unit2'][$i]=>$_POST['value2'][$i]);
			$arrunit[] = array("perFrom" => $_POST['perFrom'][$i], "perFromQty" => $_POST['perFromQty'][$i], "perTo" => $_POST['perTo'][$i], "perToQty" => $_POST['perToQty'][$i]);
		}
		#print_r($arrunit);
		/* $productPerCarton = $arrunit["CREA"]["EA"];
		 $innerCartonPerCarton = $arrunit["CRIC"]["IC"];
		 $productPerInnerCarton = $arrunit["ICEA"]["EA"];
		if($productPerCarton/$innerCartonPerCarton!=$productPerInnerCarton){
			$error = array('error' => $this->upload->display_errors());
            $this->session->set_userdata(array('error_message' => 'InnerCarton Unit mismatch with regards to carton, Please check again!'));
            redirect(base_url('Cproduct/product_update_form/'.$product_id));
		}
		
		if(($productPerInnerCarton*$innerCartonPerCarton)!=$productPerCarton){
			$error = array('error' => $this->upload->display_errors());
            $this->session->set_userdata(array('error_message' => 'Carton Unit mismatch with regards to Inner carton, Please check again!'));
            redirect(base_url('Cproduct/product_update_form/'.$product_id));
		}*/
		
		
        $data = array(
            //'product_id' => $this->generator(8),
            'product_name' => $this->input->post('product_name'),
            'supplier_id' => $this->input->post('supplier_id'),
            'category_id' => $this->input->post('category_id'),
            'price' => $this->input->post('price'),
            'supplier_price' => $this->input->post('supplier_price'),
            'innercart_quantity' => $this->input->post('innercart_quantity'),
            'cartoon_quantity' => $this->input->post('cartoon_quantity'),
            'product_model' => $this->input->post('model'),
            'product_details' => $this->input->post('description'),
            'tax' => $this->input->post('tax'),
            'lot_flag' => $this->input->post('lot_flag'),
            'expiry_flag' => $this->input->post('expiry_flag'),
            'image' => $image_name,
//            'image' => (!empty($image_url) ? $image_url : $old_image),
            'status' => 1,
			'unit_values' => json_encode($arrunit)
        );
//        echo '<pre>';        print_r($data);        die();
        $result = $CI->Products->update_product($data, $product_id);
        if ($result == true) {
            $this->session->set_userdata(array('message' => display('successfully_updated')));
            redirect(base_url('Cproduct/manage_product'));
        } else {
            $this->session->set_userdata(array('error_message' => display('product_model_already_exist')));
            redirect(base_url('Cproduct/manage_product'));
        }
    }

    // product_delete
    public function product_delete() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->model('Products');
        $product_id = $_POST['product_id'];
        $result = $CI->Products->delete_product($product_id);
        return true;
    }

    //Retrieve Single Item  By Search
    public function product_by_search() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $product_id = $this->input->post('product_id');

        $content = $CI->lproduct->product_search_list($product_id);
        $sub_menu = array(
            array('label' => 'Manage Product', 'url' => 'Cinventory', 'class' => 'active'),
            array('label' => 'Add Product', 'url' => 'Cinventory/manage_product')
        );
        $this->template->full_admin_html_view($content, $sub_menu);
    }

    //Retrieve Single Item  By Search
    public function product_details($product_id) {
        $this->product_id = $product_id;
        $CI = & get_instance();
        $this->auth->check_admin_auth();
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
        $this->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $content = $CI->lproduct->product_sales_supplier_rate($product_id, $startdate, $enddate);
        $this->template->full_admin_html_view($content);
    }

    //This function is used to Generate Key
    public function generator($lenth) {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
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

}
