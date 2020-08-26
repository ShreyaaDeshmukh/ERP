<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Recieving extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //Count purchase
    public function count_purchase() {
        $this->db->select('a.*,b.supplier_name');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->order_by('a.purchase_date', 'desc');
        $this->db->order_by('purchase_id', 'desc');
        $query = $this->db->get();

        $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //purchase List
    public function recieving_list($per_page, $page,$r_id) {
		$where = "";
		$join = " JOIN product_information ON product_information.product_id = purchase_receipt_order.product_id JOIN product_purchase_details ON product_purchase_details.purchase_detail_id = purchase_receipt_order.purchase_detail_id JOIN product_purchase ON product_purchase.purchase_id = purchase_receipt_order.purchase_id";
		$post = $_POST;
		if(!empty($post['supplier_id'])){
			$where .= " AND product_purchase.supplier_id = '".$post['supplier_id']."'";
			#$join .= "JOIN product_purchase ON product_purchase.purchase_id = purchase_receipt_order.purchase_id";
		}
		
		if(!empty($post['product_id'])){
			$where .= " AND purchase_receipt_order.product_id = '".$post['product_id']."'";
			#$join .= "JOIN product_purchase ON product_purchase.purchase_id = purchase_receipt_order.purchase_id";
		}
		
		if(!empty($post['customer_po'])){
			$where .= " AND product_purchase.customer_po = '".$post['customer_po']."'";
			#$join .= "JOIN product_purchase ON product_purchase.purchase_id = purchase_receipt_order.purchase_id";
		}
		if(!empty($post['customer_name'])){
			$where .= " AND product_purchase.customer_id =(SELECT customer_id FROM `customer_information` where customer_name = '".$post['customer_name']."' limit 1)";
			
		}
		
       $query = "SELECT purchase_receipt_order.*, product_information.product_name, product_information.product_details, count(purchase_receipt_order.label) as cty_unit_id, product_purchase.ship_date,product_purchase.customer_po FROM purchase_receipt_order ".$join." WHERE  purchase_receipt_order.r_id = $r_id AND product_information.r_id = $r_id AND product_purchase.r_id = $r_id AND product_purchase_details.r_id = $r_id AND purchase_receipt_order.type = 1 AND is_web = 0 ".$where."   GROUP BY purchase_receipt_order.datagrp  ORDER BY purchase_receipt_order.id DESC";
    //    echo($query);
    //    die();
		
		// mY query on 12-04-2019
		
		//select purchase_receipt_order.*, product_information.product_name, product_information.product_details, purchase_receipt_order.label as cty_unit_id, product_purchase.ship_date FROM  product_information,product_purchase_details,purchase_receipt_order left join product_purchase on product_purchase.purchase_id = purchase_receipt_order.purchase_id  where product_information.product_id = purchase_receipt_order.product_id and product_purchase_details.purchase_detail_id = purchase_receipt_order.purchase_detail_id and purchase_receipt_order.type = 1 AND is_web = 0 GROUP BY purchase_receipt_order.id  ORDER BY purchase_receipt_order.id DESC;
		
		// ------------ Riz query comment by tags
		
		// $query = "SELECT purchase_receipt_order.*, product_information.product_name, product_information.product_details, count(purchase_receipt_order.label) as cty_unit_id, product_purchase.ship_date FROM purchase_receipt_order ".$join." WHERE purchase_receipt_order.type = 1 AND is_web = 0 ".$where." GROUP BY product_purchase_details.purchase_detail_id ORDER BY purchase_receipt_order.id DESC";
       
        $query = $this->db->query($query);
       # return $query->result_array();
      #  echo $this->db->last_query();
       #echo  $last_query = $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            
            return $query->result_array();
        }
        return false;
    }

    //Select All Supplier List
    public function select_all_supplier() {
        $query = $this->db->select('*')
                ->from('supplier_information')
                ->where('status', '1')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //purchase Search  List
    public function purchase_by_search($supplier_id) {
        $this->db->select('a.*,b.supplier_name');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->where('b.supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Count purchase
    public function purchase_entry() {
		#echo "<pre>";print_r($_POST);
		#$purchase_id = date('YmdHis');
        $purchase_id = $this->input->post('purchase_id');

        $p_id = $this->input->post('product_id');
        $supplier_id = $this->input->post('supplier_id');

        //supplier & product id relation ship checker.
        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_id = $p_id[$i];
            $value = $this->product_supplier_check($product_id, $supplier_id);
            if ($value == 0) {
                $this->session->set_userdata(array('error_message' => "Product and Vendor did not match !"));
                redirect(base_url('Cpurchase'));
                exit();
            }
        }
		#$per2 = json_encode(explode('#', $this->input->post('per2')[0]));
		#$innerper = json_encode(explode('#', $this->input->post('inner-per')[0]));
		#$innerper2 = json_encode(explode('#', $this->input->post('inner-per2')[0]));
        $data = array(
            'purchase_id' => $purchase_id,
           // 'chalan_no' => $this->input->post('chalan_no'),
            'supplier_id' => $this->input->post('supplier_id'),
            'customer_id' => $this->input->post('customer_id'),
            'grand_total_amount' => $this->input->post('grand_total_price'),
            'purchase_date' => $this->input->post('purchase_date'),
            'purchase_details' => $this->input->post('purchase_details'),
            'status' => 1,
            'ship_date' => $this->input->post('ship_date'),
            'customer_po' => $this->input->post('customer_po'),
            'ship_method' => $this->input->post('ship_method'),
           # 'per2' => $per2,
           # 'inner-per' => $innerper,
           # 'inner-per2' => $innerper2
            
        );
		#echo "<pre>";print_r($data);die;
        $this->db->insert('product_purchase', $data);

        $ledger = array(
            'transaction_id' => $purchase_id,
            'chalan_no' => $this->input->post('chalan_no'),
            'supplier_id' => $this->input->post('supplier_id'),
            'amount' => $this->input->post('grand_total_price'),
            'date' => $this->input->post('purchase_date'),
            'description' => $this->input->post('purchase_details'),
            'status' => 1,
            'd_c' => 'c'
        );
        $this->db->insert('supplier_ledger', $ledger);

        // Account Information for purchase
        // $account=array(
        // 	'transaction_id'		=>	$purchase_id,
        // 	'transection_category'	=>	1,
        // 	'relation_id'			=>	$this->input->post('supplier_id'),
        // 	'pay_amount'			=>	$this->input->post('grand_total_price'),
        // 	'date_of_transection'	=> date('d-m-Y'),
        // 	'description'			=>	$this->input->post('purchase_details'),
        // 	'transection_type'		=>	1,
        // 	'transection_mood'      =>1
        // );
        // $this->db->insert('transection',$account);
		$rate = $this->input->post('product_rate');
        $quantity = $this->input->post('product_quantity');
        $t_price = $this->input->post('total_price');
        $unit = $this->input->post('unit');
        $per = $this->input->post('per2');
        $innerper = $this->input->post('inner-per');
        $innerper2 = $this->input->post('inner-per2');
		
        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
            $unit1 = $unit[$i];
			#print_r($per);
			$per1 = $per[$i];
			$innerper1 = $innerper[$i];
			$innerper21 = $innerper2[$i];
			$totalQuantityRecorded = $_POST['product_quantity'][$i];
			#print_r($per);
		if($per1!="None"){
				#print_r($per);
				$perexplode = explode("#",$per1);
				#print_r($perexplode);
				if($perexplode[0]!='Select'){
					$totalQuantityRecorded = $totalQuantityRecorded * $perexplode[1];
				}	
		}
		
		if(!empty($innerper1) && $innerper1!="None"){
			
				$innerperexplode = explode("#", $innerper1);
				if($innerperexplode[0]!='Select'){
					$totalQuantityRecorded = $totalQuantityRecorded * $innerperexplode[1];
				}
			
		}
		
		if(!empty($innerper21) && $innerper21!="None"){
			
				$innerper2explode = explode("#", $innerper21);
				if($innerper2explode[0]!='Select'){
					$totalQuantityRecorded = $totalQuantityRecorded * $innerper2explode[1];
				}
			
		}
		
		$product_quantity = $totalQuantityRecorded;
		
            $data1 = array(
                'purchase_detail_id' => $this->generator(15),
                'purchase_id' => $purchase_id,
                'product_id' => $product_id,
                'quantity' => $product_quantity,
                'rate' => $product_rate,
                'total_amount' => $total_price,
                'status' => 1,
                'unit' => $unit1,
				'per2' => $per1,
				'inner-per' => $innerper1,
				'inner-per2' => $innerper21
            );
			#print_r($data1);
			if (!empty($quantity)) {
                $this->db->insert('product_purchase_details', $data1);
            }
        }
		return true;
    }

    //Retrieve purchase Edit Data
    public function retrieve_purchase_editdata($purchase_id) {
        $this->db->select('a.*,
						b.*,
						c.product_id,
						c.product_name,
						c.product_model,
						c.cartoon_quantity,
						d.supplier_id,
						d.supplier_name,
                        e.customer_name'
        );
        $this->db->from('product_purchase a');
        $this->db->join('product_purchase_details b', 'b.purchase_id =a.purchase_id');
        $this->db->join('product_information c', 'c.product_id =b.product_id');
        $this->db->join('supplier_information d', 'd.supplier_id = a.supplier_id');
        $this->db->join('customer_information e', 'e.customer_id = a.customer_id');
        $this->db->where('a.purchase_id', $purchase_id);
        $this->db->order_by('a.purchase_details', 'asc');
        $query = $this->db->get();
		#echo $this->db->last_query();die;
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
    public function update_purchase() {
        #echo "<pre>";print_r($_POST);die;
        $purchase_id = $this->input->post('purchase_id');

        $data = array(
            'chalan_no' => $this->input->post('chalan_no'),
            'supplier_id' => $this->input->post('supplier_id'),
            'customer_id' => $this->input->post('customer_id'),
            'ship_date' => $this->input->post('ship_date'),
            'customer_po' => $this->input->post('customer_po'),
            'ship_method' => $this->input->post('ship_method'),
            'grand_total_amount' => $this->input->post('grand_total_price'),
            'purchase_date' => $this->input->post('purchase_date'),
            'purchase_details' => $this->input->post('purchase_details')
        );

        if ($purchase_id != '') {
            #print_r($data);
            #echo $purchase_id;die;
            $this->db->where('purchase_id', $purchase_id);
            $this->db->update('product_purchase', $data);
        }

        $rate = $this->input->post('product_rate');
        $p_id = $this->input->post('product_id');
        $quantity = $this->input->post('product_quantity');
        $t_price = $this->input->post('total_price');
        $purchase_d_id = $this->input->post('purchase_detail_id');

        for ($i = 0, $n = count($purchase_d_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
            $purchase_detail_id = $purchase_d_id[$i];

            $data1 = array(
                'product_id' => $product_id,
                'quantity' => $product_quantity,
                'rate' => $product_rate,
                'total_amount' => $total_price
            );
            #print_r($data1); echo $purchase_detail_id;die;

            if (($quantity)) {
                $this->db->where('purchase_detail_id', $purchase_detail_id);
                $this->db->update('product_purchase_details', $data1);
            }
        }
        return true;
    }

    // Delete purchase Item
    public function delete_purchase($purchase_id) {
        //Delete product_purchase table
        $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('product_purchase');
        //Delete product_purchase_details table
        $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('product_purchase_details');
        return true;
    }

    public function purchase_search_list($cat_id, $company_id) {
        $this->db->select('a.*,b.sub_category_name,c.category_name');
        $this->db->from('purchases a');
        $this->db->join('purchase_sub_category b', 'b.sub_category_id = a.sub_category_id');
        $this->db->join('purchase_category c', 'c.category_id = b.category_id');
        $this->db->where('a.sister_company_id', $company_id);
        $this->db->where('c.category_id', $cat_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve purchase_details_data
    public function purchase_details_data($purchase_id) {
        $this->db->select('a.*,b.*,c.*,e.purchase_details,d.product_id,d.product_name,d.product_model,d.cartoon_quantity');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->join('product_purchase_details c', 'c.purchase_id = a.purchase_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->join('product_purchase e', 'e.purchase_id = c.purchase_id');
        $this->db->where('a.purchase_id', $purchase_id);
        $query = $this->db->get();
       
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //This function will check the product & supplier relationship.
    public function product_supplier_check($product_id, $supplier_id) {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('product_id', $product_id);
        $this->db->where('supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }
        return 0;
    }

    //This function is used to Generate Key
    public function generator($lenth) {
        $number = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "N", "M", "O", "P", "Q", "R", "S", "U", "V", "T", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 61);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }
	
	//Retrieve Product Edit Data

    public function retrieve_purchase_labnumdata($purchase_id) {

        $this->db->select('*');

        $this->db->from('purchase_receipt_order');

        $this->db->where('purchase_id', $purchase_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }


}
