<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receipts extends CI_Model {

	 public function __construct() {

        parent::__construct();

    }



    //Count purchase

    public function count_receipt() {

        $this->db->select('a.*,b.supplier_name');

        $this->db->from('product_receipt a');

        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');

        $this->db->order_by('a.receipt_date', 'desc');

        $this->db->order_by('receipt_id', 'desc');

        $query = $this->db->get();



        $last_query = $this->db->last_query();

        if ($query->num_rows() > 0) {

            return $query->num_rows();

        }

        return false;

    }



    //purchase List

    public function receipt_list($per_page, $page) {

        $this->db->select('a.*,b.supplier_name,c.customer_name');

        $this->db->from('product_receipt a');

        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');

        $this->db->join('customer_information c', 'c.customer_id = a.customer_id');

        $this->db->order_by('a.receipt_date', 'desc');

        $this->db->order_by('receipt_id', 'desc');

        $this->db->limit($per_page, $page);

        $query = $this->db->get();



        $last_query = $this->db->last_query();

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

    public function receipt_by_search($supplier_id) {

        $this->db->select('a.*,b.supplier_name');

        $this->db->from('product_receipt a');

        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');

        $this->db->where('b.supplier_id', $supplier_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    //Count purchase

    public function receipt_entry() { #print_r($_POST);

        #$purchase_id = date('YmdHis');

        $receipt_id = $this->input->post('receipt_id');



        $p_id = $this->input->post('product_id');

        $supplier_id = $this->input->post('supplier_id');



        //supplier & product id relation ship checker.

        for ($i = 0, $n = count($p_id); $i < $n; $i++) {

            $product_id = $p_id[$i];

            $value = $this->product_supplier_check($product_id, $supplier_id);

            if ($value == 0) {

                $this->session->set_userdata(array('message' => "product_and_supplier_did_not_match"));

                redirect(base_url('Cpurchase'));

                exit();

            }

        }



        $data = array(

            'receipt_id' => $receipt_id,

           // 'chalan_no' => $this->input->post('chalan_no'),

            'supplier_id' => $this->input->post('supplier_id'),

            'customer_id' => $this->input->post('customer_id'),

            'grand_total_amount' => $this->input->post('grand_total_price'),

            'receipt_date' => $this->input->post('receipt_date'),

            'receipt_details' => $this->input->post('receipt_details'),

            'status' => 1,

            'ship_date' => $this->input->post('ship_date'),

            'customer_po' => $this->input->post('customer_po'),

            'ship_method' => join(",", $this->input->post('ship_method')),

        );

        $this->db->insert('product_receipt', $data);



        $ledger = array(

            'transaction_id' => $receipt_id,

            'chalan_no' => $this->input->post('chalan_no'),

            'supplier_id' => $this->input->post('supplier_id'),

            'amount' => $this->input->post('grand_total_price'),

            'date' => $this->input->post('receipt_date'),

            'description' => $this->input->post('receipt_details'),

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



        for ($i = 0, $n = count($p_id); $i < $n; $i++) {

            $product_quantity = $quantity[$i];

            $product_rate = $rate[$i];

            $product_id = $p_id[$i];

            $total_price = $t_price[$i];



            $data1 = array(

                'receipt_detail_id' => $this->generator(15),

                'receipt_id' => $receipt_id,

                'product_id' => $product_id,

                'quantity' => $product_quantity,

                'rate' => $product_rate,

                'total_amount' => $total_price,

                'status' => 1

            );



            if (!empty($quantity)) {

                $this->db->insert('product_receipt_details', $data1);

            }

        }

        return true;

    }



    //Retrieve purchase Edit Data

    public function retrieve_receipt_editdata($purchase_id) {

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

        $this->db->from('product_receipt a');

        $this->db->join('product_receipt_details b', 'b.receipt_id =a.receipt_id');

        $this->db->join('product_information c', 'c.product_id =b.product_id');

        $this->db->join('supplier_information d', 'd.supplier_id = a.supplier_id');

        $this->db->join('customer_information e', 'e.customer_id = a.customer_id');

        $this->db->where('a.receipt_id', $purchase_id);

        $this->db->order_by('a.receipt_details', 'asc');

        $query = $this->db->get();

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

    public function update_receipt() {
      # echo "<pre>"; print_r($_POST);   
        $receipt_id = $this->input->post('receipt_id');



        $data = array(

            'chalan_no' => $this->input->post('chalan_no'),

            'supplier_id' => $this->input->post('supplier_id'),

            'customer_id' => $this->input->post('customer_id'),

            'ship_date' => $this->input->post('ship_date'),

            'customer_po' => $this->input->post('customer_po'),

            'ship_method' => join(",", $this->input->post('ship_method')),

            'grand_total_amount' => $this->input->post('grand_total_price'),

            'receipt_date' => $this->input->post('receipt_date'),

            'receipt_details' => $this->input->post('receipt_details')

        );



        if ($receipt_id != '') {
           #print_r($data);echo $receipt_id;die;
            $this->db->where('receipt_id', $receipt_id);

            $this->db->update('product_receipt', $data);

        }



        $rate = $this->input->post('product_rate');

        $p_id = $this->input->post('product_id');

        $quantity = $this->input->post('product_quantity');

        $t_price = $this->input->post('total_price');

        $purchase_d_id = $this->input->post('receipt_detail_id');

#        print_r($purchase_d_id);

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



           # print_r($data1);
           # echo $receipt_detail_id;die;

            if (($quantity)) {
               # print_r($data1);
               # print_r($purchase_detail_id);die;
                $this->db->where('receipt_detail_id', $purchase_detail_id);

                $this->db->update('product_receipt_details', $data1);

            }

        }

        return true;

    }



    // Delete purchase Item

    public function delete_receipt($receipt_id) {

        //Delete product_purchase table

        $this->db->where('receipt_id', $receipt_id);

        $this->db->delete('product_receipt');

        //Delete product_purchase_details table

         $this->db->where('receipt_id', $receipt_id);

        $this->db->delete('product_purchase_details');

        return true;

    }



    public function receipt_search_list($cat_id, $company_id) {

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

    public function receipt_details_data($receipt_id) {

        $this->db->select('a.*,b.*,c.*,e.receipt_details,d.product_id,d.product_name,d.product_model,d.cartoon_quantity');

        $this->db->from('product_receipt a');

        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');

        $this->db->join('product_receipt_details c', 'c.receipt_id = a.receipt_id');

        $this->db->join('product_information d', 'd.product_id = c.product_id');

        $this->db->join('product_receipt e', 'e.receipt_id = c.receipt_id');

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



}