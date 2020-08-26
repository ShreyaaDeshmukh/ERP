<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Products extends CI_Model {



    public function __construct() {

        parent::__construct();

    }



    //Count Product

    public function count_product($r_id) {

        // return $this->db->count_all("product_information");
        $this->db->select('r_id');
        $this->db->from('product_information');
        $this->db->where('r_id',$r_id);
        $query = $this->db->get();
        // print_r($query->num_rows());die;
        return $query->num_rows();
    }



    //Product List

    public function product_list($per_page, $page,$r_id) {

        $query = $this->db->select('supplier_information.*,product_information.*')

                ->from('product_information')

                ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')
                ->where('product_information.r_id',$r_id)
                // ->where('supplier_information.r_id',$r_id)
                ->order_by('product_information.id', 'desc')
                
                ->order_by('product_information.supplier_id', 'desc')

                ->order_by('product_information.product_id', 'desc')

                #->limit($per_page, $page)
				
                ->get();
				
				// print_r($this->db->last_query()); die;

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }


    public function product_list_inventory($per_page, $page,$r_id) {
			// print_r($r_id);die;
        // $query = $this->db->select('supplier_information.*,product_information.*, sum(purchase_receipt_order.total_quantity) as total_quantity, sum(CASE WHEN purchase_receipt_order.total_quantity<0 THEN purchase_receipt_order.total_quantity ELSE 0 END) as NegativeTotal,SUM(CASE WHEN purchase_receipt_order.total_quantity>=0 THEN purchase_receipt_order.total_quantity ELSE 0 END) as PostiveTotal')

        //         ->from('product_information')

        //         ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')

        //          ->join('purchase_receipt_order', 'product_information.product_id = purchase_receipt_order.product_id')

        //          ->join('inventory_locations', 'purchase_receipt_order.product_id = inventory_locations.product_id', 'left')

        //          ->where('purchase_receipt_order.total_quantity != ""')

        //          ->group_by('purchase_receipt_order.product_id')

        //         ->order_by('product_information.id', 'desc')
                
        //         ->order_by('product_information.supplier_id', 'desc')

        //         ->order_by('product_information.product_id', 'desc')

        //         ->limit($per_page, $page)

        //         ->get();


         $query = $this->db->select('sum(purchase_receipt_order.total_quantity) as total_quantity, sum(CASE WHEN purchase_receipt_order.total_quantity<0 THEN purchase_receipt_order.total_quantity ELSE 0 END) as NegativeTotal,SUM(CASE WHEN purchase_receipt_order.total_quantity>=0 THEN purchase_receipt_order.total_quantity ELSE 0 END) as PostiveTotal, purchase_receipt_order.label, inventory_locations.location_unique_key, product_information.product_name, supplier_information.*,product_information.*')

                ->from('purchase_receipt_order')

                ->join('inventory_locations', '`purchase_receipt_order`.`product_id` = `inventory_locations`.`product_id` && `purchase_receipt_order`.`label` = `inventory_locations`.`label`')

                ->join('product_information', '`purchase_receipt_order`.`product_id` = `product_information`.`product_id`', 'left')

                ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')



                ->group_by('purchase_receipt_order.product_id')

                ->where('purchase_receipt_order.total_quantity != ""')
                ->where('purchase_receipt_order.r_id',$r_id)
                ->where('inventory_locations.r_id',$r_id)
                ->where('product_information.r_id',$r_id)
                ->where('supplier_information.r_id',$r_id)
                //comment by tapan 23-05-2019
                /* ->where('purchase_receipt_order.total_quantity != ""  and quantity <> ""')  */

                ->order_by('purchase_receipt_order.id', 'desc')
                //->limit($per_page, $page)
                
                ->get();
				
				// print_r($this->db->last_query());die;

                 /* print_r($this->db->last_query());die;  */
        // print_r($this->db->last_query());die;

        if ($query->num_rows() > 0) {

               
        return $query->result_array();

        }

        return false;

    } 
	
	public function product_list_checkout($per_page, $page) {
	        $r_id=$this->session->r_id;
			$query = $this->db->select('checkout_inventory.*, supplier_information.*,product_information.*, users.*, mobile_user_details.*')

                ->from('checkout_inventory')

                ->join('product_information', '`checkout_inventory`.`product_id` = `product_information`.`product_id`', 'left')

                ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')
                
				->join('users', 'users.user_id = checkout_inventory.user_id', 'left')

                ->join('mobile_user_details', 'mobile_user_details.user_id = checkout_inventory.user_id', 'left')
					
                #->group_by('checkout_inventory.product_id')

                ->where('checkout_inventory.is_deleted = 0')
                 ->where('checkout_inventory.r_id',$r_id)

                ->order_by('checkout_inventory.id', 'desc')
                //->limit($per_page, $page)
                
                ->get();

            //   print_r($query->num_rows());die;

        if ($query->num_rows() > 0) {


            return $query->result_array();

        }

        return false;

    }
	
	
	
	
	
	
	public function product_list_checkin($per_page, $page) {
	        $r_id=$this->session->r_id;
			$query = $this->db->select('checkin_inventory.*, supplier_information.*,product_information.*, users.*, mobile_user_details.*')

                ->from('checkin_inventory')

                ->join('product_information', '`checkin_inventory`.`product_id` = `product_information`.`product_id`', 'left')

                ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')
                
				->join('users', 'users.user_id = checkin_inventory.user_id', 'left')

                ->join('mobile_user_details', 'mobile_user_details.user_id = checkin_inventory.user_id', 'left')
					
                #->group_by('checkout_inventory.product_id')

                ->where('checkin_inventory.is_deleted = 0')
                 ->where('checkin_inventory.r_id',$r_id)

                ->order_by('checkin_inventory.id', 'desc')
                //->limit($per_page, $page)
                
                ->get();

            //   print_r($query->num_rows());die;

        if ($query->num_rows() > 0) {


            return $query->result_array();

        }

        return false;

    }



    public function product_detail_inventory($product_id) {
			$r_id = $this->session->r_id;
			// print_r($r_id);die;
        $query = $this->db->select('sum(purchase_receipt_order.total_quantity) as total_quantity, purchase_receipt_order.label,purchase_receipt_order.expiry_date, purchase_receipt_order.sell_date, purchase_receipt_order.created_at,purchase_receipt_order.lot, purchase_receipt_order.serial_number, inventory_locations.location_unique_key, product_information.product_name,product_information.product_details,product_purchase.customer_po')

                ->from('purchase_receipt_order')

                ->join('inventory_locations', '`purchase_receipt_order`.`product_id` = `inventory_locations`.`product_id` && `purchase_receipt_order`.`label` = `inventory_locations`.`label`')

                ->join('product_information', '`purchase_receipt_order`.`product_id` = `product_information`.`product_id`')

               ->join('product_purchase','`product_purchase`.`purchase_id` = `purchase_receipt_order`.`purchase_id`')
                ->group_by('purchase_receipt_order.label')

                ->where('purchase_receipt_order.total_quantity != ""')  //comment by tapan 23-05-2019
                /* ->where('purchase_receipt_order.total_quantity != ""  and purchase_receipt_order.quantity <> ""') */

                ->where('purchase_receipt_order.product_id', $product_id)
				->where('purchase_receipt_order.r_id', $r_id)
                
                ->get();
	
					// print_r($query);die;
				  // echo $this->db->last_query();die; 


        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    public function product_list_count_inventory($r_id) {

         $query = $this->db->select('supplier_information.*,product_information.*, sum(purchase_receipt_order.total_quantity) as total_quantity, sum(CASE WHEN purchase_receipt_order.total_quantity<0 THEN purchase_receipt_order.total_quantity ELSE 0 END) as NegativeTotal,SUM(CASE WHEN purchase_receipt_order.total_quantity>=0 THEN purchase_receipt_order.total_quantity ELSE 0 END) as PostiveTotal')

                ->from('product_information')

                ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')

                 ->join('purchase_receipt_order', 'product_information.product_id = purchase_receipt_order.product_id')

                 ->join('inventory_locations', 'inventory_locations.product_id = purchase_receipt_order.product_id')

                 ->where('purchase_receipt_order.total_quantity != ""')

                 
                 ->where('purchase_receipt_order.r_id',$r_id)
                 ->where('product_information.r_id',$r_id)
                 ->where('supplier_information.r_id',$r_id)
                 ->where('inventory_locations.r_id',$r_id)
                //  ->where('purchase_receipt_order.r_id',$r_id)

                 ->group_by('purchase_receipt_order.product_id')


                ->order_by('product_information.id', 'desc')
                
                ->order_by('product_information.supplier_id', 'desc')

                ->order_by('product_information.product_id', 'desc')

                ->get();


        if ($query->num_rows() > 0) {
            
           return $query->num_rows();

        }

        return false;

    }
	
	public function product_list_count_checkout() {

         $query = "SELECT a.*, b.* FROM checkout_inventory as a, mobile_user_details AS b WHERE a.user_id=b.user_id";
        $query = $this->db->query($query);
       // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;

    }
	
	
	public function product_list_count_checkin() {

         $query = "SELECT a.*, b.* FROM checkin_inventory as a, mobile_user_details AS b WHERE a.user_id=b.user_id";
        $query = $this->db->query($query);
       // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;

    }



    //All Product List

    public function all_product_list($r_id) {

        $query = $this->db->select('supplier_information.*,product_information.*')

                ->from('product_information')

                ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')
                ->where('product_information.r_id',$r_id)
                ->where('supplier_information.r_id',$r_id)
                ->order_by('product_information.supplier_id', 'desc')

                ->order_by('product_information.product_id', 'desc')

                ->get();
				
			

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }


    public function all_product_list_inventory($r_id) {

        $query = $this->db->select('supplier_information.*,product_information.*')

                ->from('product_information')

                ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')

                ->join('inventory_locations', 'inventory_locations.product_id = product_information.product_id')
                ->where('product_information.r_id = '.$r_id.'')
                ->where('supplier_information.r_id = '.$r_id.'')
                ->where('inventory_locations.r_id = '.$r_id.'')
                ->group_by('product_information.product_id')

                ->order_by('product_information.supplier_id', 'desc')

                ->order_by('product_information.product_id', 'desc')

                

                ->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }
	
	public function all_product_list_checkout() {

        $query = $this->db->select('supplier_information.*,product_information.*')

                ->from('product_information')

                ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')

                ->join('checkout_inventory', 'checkout_inventory.product_id = product_information.product_id')

                ->group_by('product_information.product_id')

                ->order_by('product_information.supplier_id', 'desc')

                ->order_by('product_information.product_id', 'desc')

                ->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



	public function all_product_list_checkin() {

        $query = $this->db->select('supplier_information.*,product_information.*')

                ->from('product_information')

                ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')

                ->join('checkin_inventory', 'checkin_inventory.product_id = product_information.product_id')

                ->group_by('product_information.product_id')

                ->order_by('product_information.supplier_id', 'desc')

                ->order_by('product_information.product_id', 'desc')

                ->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }

    //Product List

    public function product_list_count($r_id) {

        $query = $this->db->select('supplier_information.*,product_information.*')

                ->from('product_information')

                ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')
                ->where('product_information.r_id',$r_id)
                ->where('supplier_information.r_id',$r_id)
                ->order_by('product_information.supplier_id', 'desc')

                ->order_by('product_information.product_id', 'desc')

                ->get();

        if ($query->num_rows() > 0) {

            return $query->num_rows();

        }

        return false;

    }



    //Product tax list

    public function retrieve_product_tax() {

        $result = $this->db->select('*')

                ->from('tax_information')

                ->get()

                ->result();



        return $result;

    }



    //Tax selected item

    public function tax_selected_item($tax_id) {

        $result = $this->db->select('*')

                ->from('tax_information')

                ->where('tax_id', $tax_id)

                ->get()

                ->result();



        return $result;

    }



    //Product generator id check 

    public function product_id_check($product_id) {

        $query = $this->db->select('*')

                ->from('product_information')

                ->where('product_id', $product_id)

                ->get();

        if ($query->num_rows() > 0) {

            return true;

        } else {

            return false;

        }

    }



    //Count Product

    public function product_entry($data) {


        // print_r($data);
        // die;
        $this->db->select('*');

        $this->db->from('product_information');

        $this->db->where('status', 1);

        $this->db->where('product_name', $data['product_name']);
		$this->db->where('r_id', $data['r_id']);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return FALSE;

        } else {

            $this->db->insert('product_information', $data);

            $this->db->select('*');

            $this->db->from('product_information');

            $this->db->where('status', 1);
            // $thijs->db->where('r_id',)

            $query = $this->db->get();

            foreach ($query->result() as $row) {

                $json_product[] = array('label' => $row->product_name . "-(" . $row->product_model . ")", 'value' => $row->product_id);

            }

            $cache_file = './my-assets/js/admin_js/json/product.json';

            $productList = json_encode($json_product);

            file_put_contents($cache_file, $productList);

            return TRUE;

        }

    }



    //Retrieve Product Edit Data

    public function retrieve_product_editdata($product_id) {

        $r_id=$this->session->r_id;
        
        $this->db->select('*');

        $this->db->from('product_information');

        $this->db->where('product_id', $product_id);
        $this->db->where('r_id', $r_id);

        $query = $this->db->get();
        // echo 3333;
        // print_r($query->num_rows());die;

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }

	
	

    //Retrieve company Edit Data

    public function retrieve_company() {

        $this->db->select('*');

        $this->db->from('company_information');

        $this->db->limit('1');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    //Update Categories

    public function update_product($data, $product_id) {
		

		$r_id = $data['r_id'];
		
        $this->db->where('product_id', $product_id);
		$this->db->where('r_id', $r_id);

        $this->db->update('product_information', $data);


	    // print_r($this->db->last_query());
		// die;





        $this->db->select('*');

        $this->db->from('product_information');

        $this->db->where('status', 1);

        $query = $this->db->get();

        foreach ($query->result() as $row) {

            $json_product[] = array('label' => $row->product_name . "-(" . $row->product_model . ")", 'value' => $row->product_id);

        }

        $cache_file = './my-assets/js/admin_js/json/product.json';

        $productList = json_encode($json_product);

        file_put_contents($cache_file, $productList);

        return true;

    }



    // Delete Product Item

    public function delete_product($product_id) {



        #### Check product is using on system or not##########

        # If this product is used any calculation you can't delete this product.

        # but if not used you can delete it from the system.

        $this->db->select('product_id');

        $this->db->from('product_purchase_details');

        $this->db->where('product_id', $product_id);

        $query = $this->db->get();

        $affected_row = $this->db->affected_rows();



        if ($affected_row == 0) {

            $this->db->where('product_id', $product_id);

            $this->db->delete('product_information');

            $this->session->set_userdata(array('message' => display('successfully_delete')));



            $this->db->select('*');

            $this->db->from('product_information');

            $this->db->where('status', 1);

            $query = $this->db->get();

            foreach ($query->result() as $row) {

                $json_product[] = array('label' => $row->product_name . "-(" . $row->product_model . ")", 'value' => $row->product_id);

            }

            $cache_file = './my-assets/js/admin_js/json/product.json';

            $productList = json_encode($json_product);

            file_put_contents($cache_file, $productList);

            return "1";

        } else {

            #$this->session->set_userdata(array('message' => display('you_cant_delete_this_product')));

            return "0";

        }

    }



    //Product By Search 

    public function product_search_item($product_id,$r_id) {



        $query = $this->db->select('supplier_information.*,product_information.*')

                ->from('product_information')

                ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')

                ->order_by('product_information.supplier_id', 'desc')

                ->order_by('product_information.product_id', 'desc')

                ->where('product_id', $product_id)
				->where('product_information.r_id', $r_id)

                ->get();



        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }


public function product_search_item_inventory($product_id) {

        $query = $this->db->select('supplier_information.*,product_information.*, sum(purchase_receipt_order.total_quantity) as total_quantity, sum(CASE WHEN purchase_receipt_order.total_quantity<0 THEN purchase_receipt_order.total_quantity ELSE 0 END) as NegativeTotal,SUM(CASE WHEN purchase_receipt_order.total_quantity>=0 THEN purchase_receipt_order.total_quantity ELSE 0 END) as PostiveTotal')

                ->from('product_information')

                ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')

                 ->join('purchase_receipt_order', 'product_information.product_id = purchase_receipt_order.product_id')

                 ->join('inventory_locations', 'inventory_locations.product_id = purchase_receipt_order.product_id')

                 ->where('purchase_receipt_order.total_quantity != ""')

                 ->where('purchase_receipt_order.product_id', $product_id)
				 
                 ->group_by('purchase_receipt_order.product_id')


                ->order_by('product_information.id', 'desc')
                
                ->order_by('product_information.supplier_id', 'desc')

                ->order_by('product_information.product_id', 'desc')

                ->get();
        



        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    //Duplicate Entry Checking 

    public function product_model_search($product_model) {

        $this->db->select('*');

        $this->db->from('product_information');

        $this->db->where('product_model', $product_model);

        $query = $this->db->get();

        return $this->db->affected_rows();

    }



    //Product Details

    public function product_details_info($product_id) {

        $this->db->select('*');

        $this->db->from('product_information');

        $this->db->where('product_id', $product_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    // Product Purchase Report

    public function product_purchase_info($product_id) {

        $this->db->select('a.*,b.*,c.supplier_name');

        $this->db->from('product_purchase a');

        $this->db->join('product_purchase_details b', 'b.purchase_id = a.purchase_id');

        $this->db->join('supplier_information c', 'c.supplier_id = a.supplier_id');

        $this->db->where('b.product_id', $product_id);

        $this->db->order_by('a.purchase_id', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    // Invoice Data for specific data

    public function invoice_data($product_id) {

        $this->db->select('a.*,b.*,c.customer_name');

        $this->db->from('invoice a');

        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id');

        $this->db->join('customer_information c', 'c.customer_id = a.customer_id');

        $this->db->where('b.product_id', $product_id);

        $this->db->order_by('a.invoice_id', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    public function previous_stock_data($product_id, $startdate) {



        $this->db->select('date,sum(quantity) as quantity');

        $this->db->from('product_report');

        $this->db->where('product_id', $product_id);

        $this->db->where('date <=', $startdate);

        $query = $this->db->get();

        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



// Invoice Data for specific data

    public function invoice_data_supplier_rate($product_id, $startdate, $enddate) {



        $this->db->select('

					date,

					sum(quantity) as quantity,

					rate,

					-rate*sum(quantity) as total_price,

					account

				');



        $this->db->from('product_report');

        $this->db->where('product_id', $product_id);



        $this->db->where('date >=', $startdate);

        $this->db->where('date <=', $enddate);



        $this->db->group_by('account');

        $this->db->order_by('date', 'asc');

        $query = $this->db->get();

        //echo $this->db->last_query();



        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }
	
	//Retrieve Product Edit Data

    public function retrieve_purchase_editdata($purchase_id) {

        $this->db->select('*');

        $this->db->from('purchase_receipt_order');

        $this->db->where('purchase_id', $purchase_id);
		
		$this->db->group_by('label');
		 
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }
	
	public function check_product_data($product_id){
        // print_r($product_id);die;
		$this->db->select('*');
		$this->db->from('product_purchase_details');
		$this->db->where('product_purchase_details.product_id', $product_id);
        $query = $this->db->get();
        // print_r($query->num_rows());die;
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	
	
	public function check_product_name($product_name,$r_id){
		$this->db->select('*');
		$this->db->from('product_information');
		$this->db->where('product_name',$product_name);
			$this->db->where('r_id',$r_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}
	
	public function import_product($files,$r_id){
		
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
            
				#print_r($csv_line);
				$data = array();
				if($csv_line[0]!='' && !empty($csv_line[0])){
					$data['product_name'] = $csv_line[0];
				}else{
					$this->session->set_userdata(array('error_message' => "Product Name is required field"));
					redirect('Cproduct/import_product/'.$r_id);
				}
				
				if($csv_line[1]!='' && !empty($csv_line[1])){
					$data['product_details'] = $csv_line[1];
				}else{
					$this->session->set_userdata(array('error_message' => "Product Details is required field"));
					redirect('Cproduct/import_product/'.$r_id);
				}
				
				if($csv_line[2]!='' && !empty($csv_line[2])){
					$category = $this->getCategoryId($csv_line[2], 1);
					if($category[0]['category_id'] == NULL || $category[0]['category_id'] == 'NULL'){
						$this->session->set_userdata(array('error_message' => "Category does not exists"));
						redirect('Cproduct/import_product/'.$r_id);
					}else{
						$data['category_id'] = $category[0]['category_id'];
					}
					
				}else{
					$this->session->set_userdata(array('error_message' => "Category is required field"));
					redirect('Cproduct/import_product/'.$r_id);
				}
				
				$data['lot_flag'] = $csv_line[3];
				$data['expiry_flag'] = $csv_line[4];
				$data['serial_flag'] = $csv_line[5];
				
				
				if($csv_line[6]!='' && !empty($csv_line[6])){
					$supplier_id = $this->getCategoryId($csv_line[6], 2);
					print_r($supplier_id[0]['supplier_id']);
					
					if($supplier_id[0]['supplier_id'] == NULL || $supplier_id[0]['supplier_id'] == 'NULL'){
						// print_r($supplier_id[0]['supplier_id']);die;
						$this->session->set_userdata(array('error_message' => "Vendor does not exists"));
						redirect('Cproduct/import_product/'.$r_id);
					}else{
						
						$data['supplier_id'] = $supplier_id[0]['supplier_id'];
					}
					
				}else{
					$this->session->set_userdata(array('error_message' => "Vendor is required"));
					redirect('Cproduct/import_product/'.$r_id);
				}
				
				$data['product_id'] = $this->generator(8);
				$data['r_id'] = $r_id;
				$data['image'] = "http://wholesale.plumkit.com/my-assets/image/product.png";
				$insert[] = $data;
		}
		#print_r($insert);die;
		foreach($insert as $inserts){
			$this->db->select('*');
			$this->db->from('product_information');
			$this->db->where('product_name', $inserts['product_name']);
			$this->db->where('r_id', $r_id);
			$query = $this->db->get();
				if ($query->num_rows() > 0) {
					$this->session->set_userdata(array('error_message' => "Product Name ".$inserts['product_name']." already exists."));
					redirect('Cproduct/manage_product/'.$r_id);
				} 
				 else {
					$this->db->insert('product_information', $inserts);
				}
			}
        fclose($fp) or die("can't close file");
        $this->session->set_userdata(array('message' => "Product import Successfully"));
		redirect('Cproduct/manage_product/'.$r_id);
		
	}
	
	public function getCategoryId($value, $flag){
		if($flag==1){
			// $query = "SELECT * FROM product_category WHERE category_name like '%".$value."%'";
			$query = "SELECT * FROM product_category WHERE category_name = '".$value."'";
			$query = $this->db->query($query);
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		}else if($flag==2){
			/* $query = "SELECT * FROM supplier_information WHERE supplier_name like '%".$value."%'"; */
			$query = "SELECT * FROM supplier_information WHERE supplier_name = '".$value."'";
			// echo $query ;die;
			$query = $this->db->query($query);
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		}
		return; 
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

}

