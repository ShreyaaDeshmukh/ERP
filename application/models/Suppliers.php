<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suppliers extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //Count supplier
    public function count_supplier($r_id) {
        #return $this->db->where('status', 1)->count_all("supplier_information");
        // return $this->db->where('status',1)->from("supplier_information")->count_all_results();
        $this->db->select('r_id');
        $this->db->from('supplier_information');
        $this->db->where('r_id',$r_id);
        $query = $this->db->get();
        // print_r($query->num_rows());die;
        return $query->num_rows();
    }

    //supplier List
    public function supplier_list($r_id) {
        // print_r($r_id);exit;
        $r_id=$this->session->r_id;
        
        // SELECT * FROM `states`,`supplier_information`,`cities`,`supplier_ledger`,`countries` WHERE supplier_information.r_id=52 and supplier_ledger.r_id=supplier_information.r_id and states.id =supplier_information.state and cities.id=supplier_information.city and states.id =supplier_information.state and countries.id=supplier_information.country
		$this->db->select('*, c.name as state, ct.name as city');
        $this->db->from('supplier_information si');
        $this->db->join('supplier_ledger sl', 'sl.supplier_id = si.supplier_id');
         $this->db->join('states c', 'si.state = c.id', 'left');
        $this->db->join('cities ct', 'si.city = ct.id', 'left');
        $this->db->where('si.r_id',$r_id);
        // $this->db->where('sl.r_id',$r_id);
        $this->db->order_by('si.supplier_name', 'asc');
        $this->db->group_by('si.supplier_id');
        $query = $this->db->get();
           // print_r($this->db->last_query());die;
        // $query = $this->db->query('SELECT * FROM `states`,`supplier_information`,`cities`,`supplier_ledger`,`countries` WHERE supplier_information.r_id= $r_id and supplier_ledger.r_id=supplier_information.r_id and states.id =supplier_information.state and cities.id=supplier_information.city and states.id =supplier_information.state and countries.id=supplier_information.country');
		// print_r($query->num_rows()); exit;
		if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //supplier List For Report
    public function supplier_list_report() {
        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->order_by('supplier_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //supplier List
    public function supplier_list_count($r_id) {
        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->where('r_id',$r_id);
        $this->db->order_by('supplier_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
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

    //supplier Search List
    public function supplier_search_item($supplier_id) {
        $r_id=$this->session->r_id;
        $this->db->select('supplier_information.*, countries.name as countryname, cities.name as cityname, states.name as statename');
        $this->db->from('supplier_information');
        
		$this->db->join('countries', 'countries.id = supplier_information.country');
		$this->db->join('cities', 'cities.id = supplier_information.city');
		$this->db->join('states', 'states.id = supplier_information.state');
		
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('r_id',$r_id);
		
		$query = $this->db->get();
         //print_r($this->db->last_query());die;
		if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function supplier_search_item1($supplier_id) {
        $r_id=$this->session->r_id;
        $this->db->select('supplier_information.*, countries.name as countryname, cities.name as cityname, states.name as statename');
        $this->db->from('supplier_information');
        
        $this->db->join('countries', 'countries.id = supplier_information.country');
        $this->db->join('cities', 'cities.id = supplier_information.city');
        $this->db->join('states', 'states.id = supplier_information.state');
        
        $this->db->where('supplier_id', $supplier_id);
      
        
        $query = $this->db->get();
         //print_r($this->db->last_query());die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Selected Supplier List
    public function selected_product($product_id) {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('product_id', $product_id);
        return $query = $this->db->get()->row();
    }

    //Product search item
    public function product_search_item($supplier_id) {
        $r_id = $this->session->r_id;
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('status', 1);
        $this->db->where('r_id', $r_id);
		$this->db->order_by('product_name', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //supplier product
    public function supplier_product($supplier_id) {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('supplier_id', $supplier_id);
        return $query = $this->db->get()->result();
    }

    //Count supplier
    public function supplier_entry($data) {

        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->where('supplier_name', $data['supplier_name']);
		$this->db->where('r_id', $data['r_id']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {

            $this->db->insert('supplier_information', $data);
            //Data is sending for syncronizing

            $this->db->select('*');
            $this->db->from('supplier_information');
            $this->db->where('status', 1);
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $json_product[] = array('label' => $row->supplier_name, 'value' => $row->supplier_id);
            }
            $cache_file = './my-assets/js/admin_js/json/supplier.json';
            $productList = json_encode($json_product);
            file_put_contents($cache_file, $productList);
            return TRUE;
        }
    }

    //Retrieve supplier Edit Data
    public function retrieve_supplier_editdata($supplier_id) {
		$r_id = $this->session->r_id;
        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->where('supplier_id', $supplier_id);
		$this->db->where('r_id', $r_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Update Categories
    public function update_supplier($data, $supplier_id) {
		$r_id = $data['r_id'];
        $this->db->where('supplier_id', $supplier_id);
		 $this->db->where('r_id', $r_id);
        $this->db->update('supplier_information', $data);
        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->where('status', 1);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $json_product[] = array('label' => $row->supplier_name, 'value' => $row->supplier_id);
        }
        $cache_file = './my-assets/js/admin_js/json/supplier.json';
        $productList = json_encode($json_product);
        file_put_contents($cache_file, $productList);
        return true;
    }

    // Delete supplier ledger
    public function delete_supplier_ledger($supplier_id) {
        $this->db->where('supplier_id', $supplier_id);
        $this->db->delete('supplier_ledger');
    }

// Delete supplier from transection 
    public function delete_supplier_transection($supplier_id) {
        $this->db->where('relation_id', $supplier_id);
        $this->db->delete('transection');
    }

    // Delete supplier from transection 
    // Delete supplier Item
    public function delete_supplier($supplier_id) {
		
		$flag = 0;
		$this->db->select('*');
		$this->db->from('product_purchase');
		$this->db->where('supplier_id',$supplier_id);
		$query = $this->db->get();
		
		
		if ($query->num_rows() > 0) {
			$flag = 1;
		}
		
		/*$this->db->select('*');
		$this->db->from('supplier_ledger');
		$this->db->where('supplier_id',$supplier_id);
		$query2 = $this->db->get();
		
		if ($query2->num_rows() > 0) {
			$flag = 1;
		}*/
		
		if($flag==0){
			$this->db->where('supplier_id', $supplier_id);
			$this->db->delete('supplier_information');

			$this->db->select('*');
			$this->db->from('supplier_information');
			$this->db->where('status', 1);
			$query = $this->db->get();
			foreach ($query->result() as $row) {
				$json_product[] = array('label' => $row->supplier_name, 'value' => $row->supplier_id);
			}
			$cache_file = './my-assets/js/admin_js/json/supplier.json';
			$productList = json_encode($json_product);
			file_put_contents($cache_file, $productList);
			return 1;
		}else{
			return 0;
		}
    }

    //Retrieve supplier Personal Data 
    public function supplier_personal_data($supplier_id) {
        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->where('supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    /// supplier person data all
    public function supplier_personal_data_all() {
        $this->db->select('*');
        $this->db->from('supplier_information');
        //$this->db->where('supplier_id',$supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // second
    public function supplier_personal_data1() {
        $this->db->select('*');
        $this->db->from('supplier_information');
        //$this->db->where('supplier_id',$supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve Supplier Purchase Data 
    public function supplier_purchase_data($supplier_id) {
        $this->db->select('*');
        $this->db->from('product_purchase');
        $this->db->where(array('supplier_id' => $supplier_id, 'status' => 1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Supplier Search Data
    public function supplier_search_list($cat_id, $company_id) {
        $this->db->select('a.*,b.sub_category_name,c.category_name');
        $this->db->from('suppliers a');
        $this->db->join('supplier_sub_category b', 'b.sub_category_id = a.sub_category_id');
        $this->db->join('supplier_category c', 'c.category_id = b.category_id');
        $this->db->where('a.sister_company_id', $company_id);
        $this->db->where('c.category_id', $cat_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Supplioer product information
    public function supplier_product_purchase($supplier_id, $start, $end) {
        $date_between = "DATE(date) BETWEEN '$start' AND '$end'";
//        echo $date_between;die();
        $this->db->select('*');
        $this->db->from('supplier_ledger sl');
        $this->db->join('supplier_information si', 'si.supplier_id = sl.supplier_id');
//                ->join('product_purchase pp', 'pp.chalan_no = sl.chalan_no')
        $this->db->where('sl.supplier_id', $supplier_id);
        if ($start) {
            $this->db->where($date_between);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
//        $query = $this->db->select('a.product_name,
//							
//								b.quantity,
//
//								CAST(sum(b.total_amount) AS DECIMAL(16,2)) as  total_taka,
//
//							
//								c.purchase_date,a.cartoon_quantity,c.chalan_no
//								')
//                ->from('product_information a')
//                ->join('product_purchase_details b', 'a.product_id = b.product_id', 'left')
//                ->join('product_purchase c', 'c.purchase_id = b.purchase_id', 'left')
//                ->where('c.supplier_id', $supplier_id)
//                ->group_by('b.purchase_id')
//                ->where(array('c.purchase_date >=' => $start, 'c.purchase_date <=' => $end))
//                ->order_by('c.purchase_date')
//                ->get();
//
//        if ($query->num_rows() > 0) {
//            return $query->result_array();
//        } else {
//            return false;
//        }
    }

    //########### previous credit for supplier ledger purchase 
    public function supplier_previous_purchase_credit($supplier_id, $start) {
        $query = $this->db->select('
								

								CAST(sum(b.total_amount) AS DECIMAL(16,2)) as  total_credit,
								c.purchase_date,a.cartoon_quantity')
                ->from('product_information a')
                ->join('product_purchase_details b', 'a.product_id = b.product_id', 'left')
                ->join('product_purchase c', 'c.purchase_id = b.purchase_id', 'left')
                ->where('c.supplier_id', $supplier_id)
                ->where("c.purchase_date  <", $start)
                //->order_by('c.purchase_date')
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    // Second 
    public function supplier_product_purchase_rpt() {
        $query = $this->db->select('*')
                ->from('supplier_information si')
//                ->join('supplier_information si', 'si.supplier_id = sl.supplier_id')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

//        $query = $this->db->select('
//								a.product_name,
//							
//								b.quantity,
//
//								CAST(sum(b.total_amount) AS DECIMAL(16,2)) as  total_taka,
//
//							
//								c.purchase_date,a.cartoon_quantity,c.chalan_no,c.*
//								')
//                ->from('product_information a')
//                ->join('product_purchase_details b', 'a.product_id = b.product_id', 'left')
//                ->join('product_purchase c', 'c.purchase_id = b.purchase_id', 'left')
//
//                //->where('a.supplier_id' , $supplier_id)
//                ->group_by('b.purchase_id')
//                ->order_by('c.purchase_date')
//                ->get();
//
//        if ($query->num_rows() > 0) {
//            return $query->result_array();
//        } else {
//            return false;
//        }
    }

    //To get certain supplier's chalan info by which this company got products day by day
    public function suppliers_ledger($supplier_id, $start, $end) {
        $this->db->select('*');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where(array('date >=' => $start, 'date <=' => $end));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

//Retrieve supplier Transaction Summary
    public function suppliers_transection_summary($supplier_id, $start, $end) {
        $result = array();
        // $this->db->select_sum('amount','total_credit');
        // $this->db->from('supplier_ledger');
        // $this->db->where(array('supplier_id'=>$supplier_id,'deposit_no'=>NULL,'status'=>1));
        // $query = $this->db->get();
        // if ($query->num_rows() > 0) {
        // 	$result[]=$query->result_array();	
        // }

        $this->db->select('
		CAST(amount AS DECIMAL(16,2)) as total_debit,
			date as ledger_date,
			description,
			deposit_no

			');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where(array('date >=' => $start, 'date <=' => $end));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    //#################supplier debit lessthan start date ###############
    public function suppliers_transection_debit($supplier_id, $start) {
        $result = array();

        $this->db->select('sum(amount) as previous_debit');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where("date <", $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function suppliers_transection_summary1() {
        $result = array();
        // $this->db->select_sum('amount','total_credit');
        // $this->db->from('supplier_ledger');
        // $this->db->where(array('supplier_id'=>$supplier_id,'deposit_no'=>NULL,'status'=>1));
        // $query = $this->db->get();
        // if ($query->num_rows() > 0) {
        // 	$result[]=$query->result_array();	
        // }

        $this->db->select('
			CAST(amount AS DECIMAL(16,2)) as total_debit,
			date as ledger_date,
			description,
			deposit_no

			');
        $this->db->from('supplier_ledger');
        //$this->db->where(array('payment_type'=>1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

//Findings a certain supplier products sales information
    public function supplier_sales_details($per_page, $page, $start, $end) {
        $supplier_id = $this->uri->segment(3);
        $start = $this->uri->segment(4);
        $end = $this->uri->segment(5);


        $this->db->select('date,product_name,product_model,product_id,cartoon,quantity,supplier_rate,CAST(quantity*supplier_rate AS DECIMAL(16,2) ) as total');
        $this->db->from('sales_report');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where(array('date >=' => $start, 'date <=' => $end));
        $this->db->order_by('date', 'desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    ################################################################################################ Supplier sales details all menu################

    public function supplier_sales_details_all($per_page, $page) {


        $this->db->select('date,product_name,product_model,product_id,cartoon,quantity,supplier_rate,CAST(quantity*supplier_rate AS DECIMAL(16,2) ) as total');
        $this->db->from('sales_report');
        $this->db->order_by('date', 'desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Findings a certain supplier products sales information
    public function supplier_sales_details_count($supplier_id) {
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        $this->db->select('date,product_name,product_model,product_id,cartoon,quantity,supplier_rate,(quantity*supplier_rate) as total');
        $this->db->from('sales_report');
        $this->db->where('supplier_id', $supplier_id);
        if ($from_date != null AND $to_date != null) {
            $this->db->where('date >', $from_date);
            $this->db->where('date <', $to_date);
        }
        $this->db->order_by('date', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    // supplier sales details count menu all
    public function supplier_sales_details_count_all() {

        $this->db->select('date,product_name,product_model,product_id,cartoon,quantity,supplier_rate,(quantity*supplier_rate) as total');
        $this->db->from('sales_report');
        //$this->db->where('supplier_id',$supplier_id);

        $this->db->order_by('date', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    public function supplier_sales_summary($per_page, $page) {
        $date = $this->input->post('date');
        $supplier_id = $this->uri->segment(3);
        $start = $this->uri->segment(4);
        $end = $this->uri->segment(5);

        $this->db->select('
							date,
							quantity,
							product_name,product_model,
							product_id,
							sum(cartoon) as cartoon, 
							sum(quantity) as quantity ,
							supplier_rate,
							CAST(sum(quantity*supplier_rate) AS DECIMAL(16,2)) as total,
							FORMAT(sum(quantity/cartoon),2) as per_cartoon
						');

        $this->db->from('sales_report');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where(array('date >=' => $start, 'date <=' => $end));
        $this->db->group_by('invoice_id');
        //$this->db->order_by('date','desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function supplier_sales_summary_count($supplier_id) {
        $date = $this->input->post('date');


        $this->db->select('
							date,
							quantity,
							product_name,product_model,
							product_id,
							sum(cartoon) as cartoon, 
							sum(quantity) as quantity ,
							supplier_rate,
							sum(quantity*supplier_rate) as total,
							FORMAT(sum(quantity/cartoon),2) as per_cartoon
						');

        $this->db->from('sales_report');
        $this->db->where('supplier_id', $supplier_id);
        if ($date != null) {
            $this->db->where('date =', $date);
        }
        $this->db->group_by('product_id,date,supplier_rate');
        $this->db->order_by('date', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    ################## Ssales & Payment Details ####################

    public function sales_payment_actual($per_page, $page) {
        $supplier_id = $this->uri->segment(3);
        $start = $this->uri->segment(4);
        $end = $this->uri->segment(5);
        $this->db->select('*');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where(array('date >=' => $start, 'date <=' => $end));
        $this->db->limit($per_page, $page);
        $this->db->order_by('date');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return false;
    }

    ################## Ssales & Payment Details ####################

    public function sales_payment_actual_count() {
        $supplier_id = $this->uri->segment(3);


        $start = $this->uri->segment(4);
        $end = $this->uri->segment(5);

        $this->db->select('*');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where(array('date >=' => $start, 'date <=' => $end));
        $this->db->order_by('date');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }

        return false;
    }

################## total sales & payment information ####################

    public function sales_payment_actual_total() {
        $supplier_id = $this->uri->segment(3);
        $start = $this->uri->segment(4);
        $end = $this->uri->segment(5);


        $this->db->select_sum('sub_total');
        $this->db->from('sales_actual');
        $this->db->where('supplier_id', $supplier_id);
        //$this->db->where(array('date >='=>$start , 'date <='=>$end));
        $this->db->where('sub_total >', 0);
        $query = $this->db->get();
        $result = $query->result_array();
        $data[0]["debit"] = $result[0]["sub_total"];

        $this->db->select_sum('sub_total');
        $this->db->from('sales_actual');
        $this->db->where('supplier_id', $supplier_id);
        //$this->db->where(array('date >='=>$start , 'date <='=>$end));
        $this->db->where('sub_total <', 0);
        $query = $this->db->get();
        $result = $query->result_array();
        $data[0]["credit"] = $result[0]["sub_total"];

        $data[0]["balance"] = $data[0]["debit"] + $data[0]["credit"];

        return $data;
    }

//To get certain supplier's payment info which was paid day by day
    public function supplier_paid_details($supplier_id) {
        $this->db->select('*');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('chalan_no', NULL);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

//To get certain supplier's chalan info by which this company got products day by day
    public function supplier_chalan_details($supplier_id) {
        $this->db->select('*');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where('deposit_no', NULL);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    #############################################################################################Search supplier report by id and datebetween####################################################

    public function suppliers_transection_report($supplier_id, $start, $end) {
        $result = array();

        $this->db->select('
			CAST(amount AS DECIMAL(16,2)) as total_debit,
			date as ledger_date,
			description,
			deposit_no

			');
        $this->db->from('supplier_ledger');
        $this->db->where(array('date >=' => $start, 'date <=' => $end));
        $this->db->where('supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    //Retrieve supplier Transaction Summary by supplier id
    public function suppliers_transection_summary_info($supplier_id) {
        $result = array();
        // $this->db->select_sum('amount','total_credit');
        // $this->db->from('supplier_ledger');
        // $this->db->where(array('supplier_id'=>$supplier_id,'deposit_no'=>NULL,'status'=>1));
        // $query = $this->db->get();
        // if ($query->num_rows() > 0) {
        // 	$result[]=$query->result_array();	
        // }

        $this->db->select('
			CAST(amount AS DECIMAL(16,2)) as total_debit,
			date as ledger_date,
			description,
			deposit_no

			');
        $this->db->from('supplier_ledger');
        $this->db->where(array('supplier_id' => $supplier_id, 'chalan_no' => NULL, 'status' => 1, 'payment_type' => 1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function supplier_product_sale_info($supplier_id) {
        $query = $this->db->select('*')
                ->from('supplier_ledger sl')
                ->join('supplier_information si', 'si.supplier_id = sl.supplier_id')
//                ->join('product_purchase pp', 'pp.chalan_no = sl.chalan_no')
                ->where('sl.supplier_id', $supplier_id)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

//        $query = $this->db->select('
//								a.product_name,
//								a.supplier_price,
//								b.quantity,
//
//								CAST(sum(b.quantity * b.supplier_rate) AS DECIMAL(16,2)) as total_taka,
//
//								sum(cartoon) as total_cartoon,
//								c.date
//								')
//                ->from('product_information a')
//                ->join('invoice_details b', 'a.product_id = b.product_id', 'left')
//                ->join('invoice c', 'c.invoice_id = b.invoice_id', 'left')
//                ->where('a.supplier_id', $supplier_id)
//                ->group_by('c.date')
//                ->order_by('c.date')
//                ->get();
//
//        if ($query->num_rows() > 0) {
//            return $query->result_array();
//        } else {
//            return false;
//        }
    }

    // ####################supplier actual ledger report############
    public function supplier_product_sale($supplier_id, $start, $end) {
        $query = $this->db->select('
								a.product_name,
								a.supplier_price,
								b.quantity,

								CAST(sum(b.quantity * b.supplier_rate) AS DECIMAL(16,2)) as total_taka,

								sum(cartoon) as total_cartoon,
								c.date
								')
                ->from('product_information a')
                ->join('invoice_details b', 'a.product_id = b.product_id', 'left')
                ->join('invoice c', 'c.invoice_id = b.invoice_id', 'left')
                ->where('a.supplier_id', $supplier_id)
                ->where(array('c.date >=' => $start, 'c.date <=' => $end))
                ->group_by('b.invoice_id')
                ->order_by('c.date')
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    ##################### actual ledger #####################

    public function suppliers_transection_sale_summary_actual() {
        $result = array();
        // $this->db->select_sum('amount','total_credit');
        // $this->db->from('supplier_ledger');
        // $this->db->where(array('supplier_id'=>$supplier_id,'deposit_no'=>NULL,'status'=>1));
        // $query = $this->db->get();
        // if ($query->num_rows() > 0) {
        // 	$result[]=$query->result_array();	
        // }

        $this->db->select('
			CAST(amount AS DECIMAL(16,2)) as total_debit,
			date as ledger_date,
			description,
			deposit_no

			');
        $this->db->from('supplier_ledger');
        //$this->db->where(array('supplier_id'=>$supplier_id,'chalan_no'=>NULL,'status'=>1,'payment_type'=>1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function supplier_product_sale_actual() {
        $query = $this->db->select('
								a.product_name,
								a.supplier_price,
								b.quantity,

								CAST(sum(b.quantity * b.supplier_rate) AS DECIMAL(16,2)) as total_taka,

								sum(cartoon) as total_cartoon,
								c.date
								')
                ->from('product_information a')
                ->join('invoice_details b', 'a.product_id = b.product_id', 'left')
                ->join('invoice c', 'c.invoice_id = b.invoice_id', 'left')
                //->where('a.supplier_id' , $supplier_id)
                ->group_by(' b.invoice_id')
                ->order_by('c.date')
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    ######### supplier Actual ledger by sales price ##########

    public function supplier_product_sale_price() {
        $query = $this->db->select('
								a.product_name,
								a.supplier_price,
								b.quantity,

								CAST(sum(b.quantity * b.rate) AS DECIMAL(16,2)) as total_taka,

								sum(cartoon) as total_cartoon,
								c.date
								')
                ->from('product_information a')
                ->join('invoice_details b', 'a.product_id = b.product_id', 'left')
                ->join('invoice c', 'c.invoice_id = b.invoice_id', 'left')
                //->where('a.supplier_id' , $supplier_id)
                ->group_by(' b.invoice_id')
                ->order_by('c.date')
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    ############## supplier product salpirce ledger###########

    public function supplier_product_saleprice($supplier_id, $start, $end) {
        $query = $this->db->select('
								a.product_name,
								a.supplier_price,
								b.quantity,

								CAST(sum(b.quantity * b.rate) AS DECIMAL(16,2)) as total_taka,

								sum(cartoon) as total_cartoon,
								c.date
								')
                ->from('product_information a')
                ->join('invoice_details b', 'a.product_id = b.product_id', 'left')
                ->join('invoice c', 'c.invoice_id = b.invoice_id', 'left')
                ->where('a.supplier_id', $supplier_id)
                ->where(array('c.date >=' => $start, 'c.date <=' => $end))
                ->group_by('b.invoice_id')
                ->order_by('c.date')
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    ############### Supplier payment  maodel ###########

    public function supplier_payment_ledger() {
        $this->db->select('*');
        $this->db->from('supplier_information a');
//        $this->db->join('transection b', 'b.relation_id = a.supplier_id');
//        $this->db->where('b.transection_type', 1);
        $query = $this->db->get();

//        SELECT a.supplier_name, b.date_of_transection, SUM(b.pay_amount) as payment 
//	FROM supplier_information a 
//    JOIN transection b ON b.relation_id = a.supplier_id 
//    WHERE b.transection_type = 1
//        $query = $this->db->select('a.*,b.deposit_no,a.pay_amount as total_taka,')
//                ->from('transection a')
//                ->join('supplier_ledger b', 'a.transaction_id = b.transaction_id', 'left')
//                ->where('a.transection_category', 1)
//                ->group_by('a.transaction_id')
//                //->order_by('c.date')
//                ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    ############# supplier payment report ##########

    public function supplier_payment_report($supplier_id, $start, $end, $per_page, $page) {
        $date_between = "DATE(date_of_transection) BETWEEN '$start' AND '$end'";
        $this->db->select('a.*, b.deposit_no,a.pay_amount as total_taka,');
        $this->db->from('transection a');
        $this->db->join('supplier_ledger b', 'a.transaction_id = b.transaction_id', 'left');
        $this->db->where('a.transection_category', 1);
        $this->db->where('a.relation_id', $supplier_id);
        if ($start) {
            $this->db->where($date_between);
        }
//                ->where(array('a.date_of_transection >=' => $start, 'a.date_of_transection <=' => $end))
        $this->db->group_by('a.transaction_id');
        $this->db->limit($per_page, $page);
        //->order_by('c.date')
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    //Last date transaction summary
    public function supplier_payment_last($supplier_id, $start) {
        $query = $this->db->select('SUM(pay_amount) as pay_amount')
                ->from('transection ')
                ->where('relation_id', $supplier_id)
                //->where(array('date_of_transection<='$start))
                ->where("date_of_transection <", $start)
                //->group_by('transaction_id')
                //->order_by('c.date')
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function supplier_payment_count($supplier_id, $start, $end) {


        $this->db->select('*');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_id', $supplier_id);
        $this->db->where(array('date >=' => $start, 'date <=' => $end));
        //$this->db->order_by('date');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }

        return false;
    }

    // SUpplier  sales Actual ledger supplier price previous balance 
    public function supplier_product_sale_previous_credit($supplier_id, $start) {
        $query = $this->db->select('
								a.product_name,
								a.supplier_price,
								b.quantity,

								CAST(sum(b.quantity * b.supplier_rate) AS DECIMAL(16,2)) as total_taka,

								sum(cartoon) as total_cartoon,
								c.date
								')
                ->from('product_information a')
                ->join('invoice_details b', 'a.product_id = b.product_id', 'left')
                ->join('invoice c', 'c.invoice_id = b.invoice_id', 'left')
                ->where('a.supplier_id', $supplier_id)
                ->where("c.date <", $start)
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    // supplier sales price supplier actual ledger previous credit
    public function supplier_product_sale_previous_debit($supplier_id, $start) {
        $query = $this->db->select('
								a.product_name,
								a.supplier_price,
								b.quantity,

								CAST(sum(b.quantity * b.rate) AS DECIMAL(16,2)) as total_taka,

								sum(cartoon) as total_cartoon,
								c.date
								')
                ->from('product_information a')
                ->join('invoice_details b', 'a.product_id = b.product_id', 'left')
                ->join('invoice c', 'c.invoice_id = b.invoice_id', 'left')
                ->where('a.supplier_id', $supplier_id)
                ->where("c.date <", $start)
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	
	public function import_vendor($files,$r_id){
		/* echo "here in this model";
		echo "<pre>";
		print_r($files); */
		
		$count=0;
        $fp = fopen($_FILES['supplier']['tmp_name'],'r') or die(redirect('Csupplier/import_vendors/'.$r_id));
		$insert = [];
		$insert1 = [];
        while($csv_line = fgetcsv($fp,1024))
        {
            $count++;
            if($count == 1)
            {
                continue;
            }//keep this if condition if you want to remove the first row
            
				/* print_r($csv_line); */
				$data = array();
				$data1 = array();
				if($csv_line[0]!='' && !empty($csv_line[0])){
					$data['supplier_name'] = $csv_line[0];
				}else{
					$this->session->set_userdata(array('error_message' => "Vendor Name is required field"));
					redirect('Csupplier/import_vendors');
				}
				
				if($csv_line[1]!='' && !empty($csv_line[1])){
					$data['mobile'] = $csv_line[1];
				}else{
					$this->session->set_userdata(array('error_message' => "Vendor Mobile is required field"));
					redirect('Csupplier/import_vendors');
				}
				
				if($csv_line[2]!='' && !empty($csv_line[2])){
					$data['email'] = $csv_line[2];
				}else{
					$this->session->set_userdata(array('error_message' => "Vendor Email is required field"));
					redirect('Csupplier/import_vendors');
				}
				
				if($csv_line[3]!='' && !empty($csv_line[3])){
					$country = $this->getCountryCityStateId($csv_line[3], 1,'');
					#print_r($country);
					# $data['country'] = $country[0]['id'];
					
					if($country[0]['id'] == NULL || $country[0]['id'] == 'NULL'){
						$this->session->set_userdata(array('error_message' => "Please check country name"));
						redirect('Csupplier/import_vendors');
					
					}else{
						$data['country'] = $country[0]['id'];
					}
					
					
				}else{
					$this->session->set_userdata(array('error_message' => "Vendor Country is required field"));
					redirect('Csupplier/import_vendors');
				}
				
				if($csv_line[4]!='' && !empty($csv_line[4])){
					$state = $this->getCountryCityStateId($csv_line[4], 2,'');
					if($state[0]['id'] == 'null' || $state[0]['id'] == null){
						$this->session->set_userdata(array('error_message' => "State can not find"));
						redirect('Csupplier/import_vendors');
					}else{
						$data['state'] = $state[0]['id'];
					}
					
				}else{
					$this->session->set_userdata(array('error_message' => "Vendor State is required field"));
					redirect('Csupplier/import_vendors/'.$r_id);
				}
				
				if($csv_line[5]!='' && !empty($csv_line[5])){
					$city = $this->getCountryCityStateId($csv_line[5], 3,$csv_line[4]);
					
					if($city[0]['id'] == 'null' || $city[0]['id'] == null){
						$this->session->set_userdata(array('error_message' => "City can not find"));
						redirect('Csupplier/import_vendors/'.$r_id);
					}else{
						$data['city'] = $city[0]['id'];
					}
					
					
				}else{
					$this->session->set_userdata(array('error_message' => "Vendor City is required field"));
					redirect('Csupplier/import_vendors/'.$r_id);
				}
				
				if($csv_line[6]!='' && !empty($csv_line[6])){
					$data['address'] = $csv_line[6];
				}else{
					$this->session->set_userdata(array('error_message' => "Vendor Address is required field"));
					redirect('Csupplier/import_vendors/'.$r_id);
				}
				$data['details'] = $csv_line[7];
				
				if($csv_line[8]!='' && !empty($csv_line[8])){
					$data['zip'] = $csv_line[8];
				}else{
					$this->session->set_userdata(array('error_message' => "Zip code is required field"));
					redirect('Csupplier/import_vendors/'.$r_id);
				}
				$supplier_id = $this->auth->generator(15);
				$data['supplier_id'] = $supplier_id;
				$data1['supplier_id'] = $supplier_id;
				$data['r_id'] = $r_id;
				$data1['r_id'] = $r_id;
				
				$insert[] = $data;
				$insert1[] = $data1;
				
				$datacre = array(
            'supplier_id' => $supplier_id
            
        );
		
		}
		
		$i = 0;
		foreach($insert as $inserts){
			
			$this->db->select('*');
			$this->db->from('supplier_information');
			$this->db->where('mobile', $inserts['mobile']);
			$this->db->where('r_id', $r_id);
			$query = $this->db->get();
				if ($query->num_rows() > 0) {
					$this->session->set_userdata(array('error_message' => "This mobile number is already exists. ".$inserts['mobile']));
					redirect('Csupplier/import_vendors/'.$r_id);
					return FALSE;
				} 
				 else {
					$this->db->insert('supplier_ledger',$insert1[$i]);
					$this->db->insert('supplier_information', $inserts);
				}
				$i++;
			}
        fclose($fp) or die("can't close file");
        $this->session->set_userdata(array('message' => "Vendor import Successfully"));
		redirect('Csupplier/manage_supplier/'.$r_id);
		
	}
	
	public function getCountryCityStateId($value, $flag,$stateName){
		if($flag==1){
			$query = "SELECT * FROM countries WHERE (name =  '".$value."' or sortname =  '".$value."')";
			$query = $this->db->query($query);
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		}else if($flag==2){
			$query = "SELECT * FROM states WHERE name = '".$value."'";
			$query = $this->db->query($query);
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		}else if($flag==3){
			/* $query = "SELECT * FROM cities WHERE name = '".$value."'"; */
			$query = "SELECT * FROM cities WHERE name='".$value."' and state_id = (SELECT id FROM states WHERE name = '".$stateName."' limit 1)";
			$query = $this->db->query($query);
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		}else{
			return true;
		}
		return; 
	}

}
