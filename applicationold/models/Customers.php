<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Customers extends CI_Model {



    public function __construct() {

        parent::__construct();
		$this->load->library('auth');
    }



    //Count customer

    public function count_customer($r_id) {
        // print_r($r_id);die;
        // $data= $this->db->count_all("customer_information");
        // // print_r($data); exit();
        // return $this->db->count_all("customer_information");
        $this->db->select('r_id');
        $this->db->from('customer_information');
        $this->db->where('r_id',$r_id);
        $query = $this->db->get();
        // print_r($query->num_rows());die;
        return $query->num_rows();
    }



    //customer List

    public function customer_list_count($r_id) {

        $this->db->select('customer_information.*,sum(customer_transection_summary.amount) as customer_balance');

        $this->db->from('customer_information');

        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

        $this->db->where('customer_information.r_id ',$r_id);
        $this->db->where('customer_transection_summary.r_id ',$r_id);

        $this->db->group_by('customer_transection_summary.customer_id');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->num_rows();

        }

        return false;

    }



    //customer List

    public function customer_list($per_page, $page,$r_id) {

        $this->db->select('*, c.name as state, ct.name as city');

        $this->db->from('customer_information ci');

        //$this->db->join('customer_ledger cl', 'cl.customer_id = ci.customer_id');

        $this->db->join('states c', 'ci.state = c.id', 'left');

        $this->db->join('cities ct', 'ci.city = ct.id', 'left');
        $this->db->where( 'ci.r_id ='.$r_id.'');

        #$this->db->join('customer_ledger cl', 'cl.customer_id = ci.customer_id');

        #$this->db->join('customer_ledger cl', 'cl.customer_id = ci.customer_id');

        $this->db->order_by('ci.customer_name', 'asc');

        $this->db->group_by('ci.customer_id');

        #$this->db->limit($per_page, $page);

        $query = $this->db->get();
		#echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

//        $this->db->select('customer_information.*,

//			CAST(sum(customer_transection_summary.amount) AS DECIMAL(16,2)) as customer_balance

//			');

//        $this->db->from('customer_information');

//        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

//        $this->db->group_by('customer_transection_summary.customer_id');

//        $this->db->limit($per_page, $page);

//        $query = $this->db->get();

//

//        if ($query->num_rows() > 0) {

//            return $query->result_array();

//        }

//        return false;

    }



    //all customer List

    public function all_customer_list($r_id) {

        $this->db->select('customer_information.*');
        $this->db->from('customer_information');
        $this->db->where('r_id',$r_id);

        #$this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

        #$this->db->group_by('customer_transection_summary.customer_id');

        $query = $this->db->get();
        // echo $query->num_rows();die;
        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    //Credit customer List

    public function credit_customer_list($per_page, $page) {

         $this->db->select('customer_information.*,

			sum(customer_transection_summary.amount) as customer_balance

			');

        $this->db->from('customer_information');

        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

        //$this->db->where('customer_information.status',2);

        $this->db->group_by('customer_transection_summary.customer_id');

        $this->db->having('customer_balance < 0', NULL, FALSE);

        $this->db->limit($per_page, $page);

        $query = $this->db->get();



        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

//        $this->db->select('customer_information.*,

//			CAST(sum(customer_transection_summary.amount) AS DECIMAL(16,2)) as customer_balance

//			');

//        $this->db->from('customer_information');

//        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

//        $this->db->where('customer_information.status', 2);

//        $this->db->group_by('customer_transection_summary.customer_id');

//        $this->db->having('customer_balance != 0', NULL, FALSE);

//        $this->db->limit($per_page, $page);

//        $query = $this->db->get();

//

//        if ($query->num_rows() > 0) {

//            return $query->result_array();

//        }

//        return false;

    }



    //All Credit customer List

    public function all_credit_customer_list() {

        $this->db->select('customer_information.*,

			CAST(sum(customer_transection_summary.amount) AS DECIMAL(16,2)) as customer_balance

			');

        $this->db->from('customer_information');

        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

//        $this->db->where('customer_information.status', 2);

        $this->db->group_by('customer_transection_summary.customer_id');

        $this->db->having('customer_balance != 0', NULL, FALSE);

        $query = $this->db->get();



        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    //Credit customer List

    public function credit_customer_list_count() {

        $this->db->select('customer_information.*,sum(customer_transection_summary.amount) as customer_balance');

        $this->db->from('customer_information');

        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

        $this->db->where('customer_information.status', 2);

        $this->db->group_by('customer_transection_summary.customer_id');

        $this->db->having('customer_balance != 0', NULL, FALSE);

        $query = $this->db->get();



        if ($query->num_rows() > 0) {

            return $query->num_rows();

        }

        return false;

    }



    //Paid Customer list

    public function paid_customer_list($per_page = null, $page = null) {

        $this->db->select('customer_information.*,

			sum(customer_transection_summary.amount) as customer_balance

			');

        $this->db->from('customer_information');

        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

        //$this->db->where('customer_information.status',1);

        $this->db->having('customer_balance >= 0', NULL, FALSE);

        $this->db->group_by('customer_transection_summary.customer_id');

        $this->db->limit($per_page, $page);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

//        $this->db->select('customer_information.*,

//			CAST(sum(customer_transection_summary.amount) AS DECIMAL(16,2)) as customer_balance

//			');

//        $this->db->from('customer_information');

//        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

//        $this->db->where('customer_information.status', 1);

//        // $this->db->where('customer_transection_summary.amount >',0);

//        $this->db->group_by('customer_transection_summary.customer_id');

//        $this->db->limit($per_page, $page);

//        $query = $this->db->get();

//        if ($query->num_rows() > 0) {

//            return $query->result_array();

//        }

//        return false;

    }



    //All Paid Customer list

    public function all_paid_customer_list() {

        $this->db->select('customer_information.*,sum(customer_transection_summary.amount) as customer_balance');

        $this->db->from('customer_information');

        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

        $this->db->where('customer_information.status', 1);

        $this->db->group_by('customer_transection_summary.customer_id');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    //Paid Customer list

    public function paid_customer_list_count() {

        $this->db->select('customer_information.*,sum(customer_transection_summary.amount) as customer_balance');

        $this->db->from('customer_information');

        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

        $this->db->where('customer_information.status', 1);

        $this->db->where('customer_transection_summary.amount >', 0);

        $this->db->group_by('customer_transection_summary.customer_id');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->num_rows();

        }

        return false;

    }



    //Customer Search List

    public function customer_search_item($customer_id) {


$r_id=$this->session->r_id;
        $this->db->select('customer_information.*,

			CAST(sum(customer_transection_summary.amount) AS DECIMAL(16,2)) as customer_balance');

        $this->db->from('customer_information');

        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

        $this->db->where('customer_information.customer_id', $customer_id);
        $this->db->where('customer_information.r_id',$r_id);
        $this->db->where('customer_transection_summary.r_id',$r_id);
        $this->db->group_by('customer_transection_summary.customer_id');

        $query = $this->db->get();

        #echo $this->db->last_query();die;


        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    //Credit Customer Search List

    public function credit_customer_search_item($customer_id) {



        $this->db->select('customer_information.*,

			CAST(sum(customer_transection_summary.amount) AS DECIMAL(16,2)) as customer_balance

			');

        $this->db->from('customer_information');

        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

        $this->db->where('customer_information.status', 2);

        $this->db->group_by('customer_transection_summary.customer_id');

        $this->db->where('customer_information.customer_id', $customer_id);

        $this->db->having('customer_balance != 0', NULL, FALSE);

        $query = $this->db->get();



        if ($query->num_rows() > 0) {

            return $query->result_array();

        } else {

            $this->session->set_userdata(array('error_message' => display('this_is_not_credit_customer')));

            redirect('Ccustomer/credit_customer');

        }

    }



    //Paid Customer Search List

    public function paid_customer_search_item($customer_id) {



        $this->db->select('customer_information.*,CAST(sum(customer_transection_summary.amount) AS DECIMAL(16,2)) as customer_balance');

        $this->db->from('customer_information');

        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

        $this->db->where('customer_information.status', 1);

        $this->db->where('customer_information.customer_id', $customer_id);

        $this->db->group_by('customer_transection_summary.customer_id');



        $query = $this->db->get();



        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }


    //Paid Customer Search List

    public function paid_customer_search_item_new($customer_id) {



        $this->db->select('customer_information.*, countries.name as countryname, cities.name as cityname, states.name as statename');

        $this->db->from('customer_information');

        #$this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');

        #$this->db->where('customer_information.status', 1);
		
		$this->db->join('countries', 'countries.id = customer_information.country');
		$this->db->join('cities', 'cities.id = customer_information.city');
		$this->db->join('states', 'states.id = customer_information.state');

        $this->db->where('customer_information.customer_id', $customer_id);

        #$this->db->group_by('customer_transection_summary.customer_id');



        $query = $this->db->get();

       # echo $this->db->last_query();die;

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    //Count customer

    public function customer_entry($data,$customer_id,$addre,$multipleaddress) {


        $email=$data['customer_email'];
        $data_check=array('r_id'=> $this->session->r_id,
        'customer_email'=>$email,
    
         );
        $this->db->select('*');

        $this->db->from('customer_information');

        $this->db->where($data_check);

        $query = $this->db->get();
        // echo $this->session->r_id;
        // echo $data['customer_email'] ;
        // print_r($query->num_rows());die;

        if ($query->num_rows() > 0) {

            return FALSE;

        } else {
            // print_r($data);die;
            $this->db->insert('customer_information', $data);
            $str = "('".$customer_id."', '".$addre."',now())";
            // echo 1;
            // print_r($multipleaddress);die;
			// foreach($multipleaddress as $key=>$value){
			// 	$str .=  ",('".$customer_id."', '".$value."',now())";
			// }
			
            $query = "insert into tbl_customer_address(customer_id,address,timestamp)values".$str;
            // print_r($query);die;
			$query = $this->db->query($query);
			

            $this->db->select('*');

            $this->db->from('customer_information');

            $query = $this->db->get();

            foreach ($query->result() as $row) {

                $json_customer[] = array('label' => $row->customer_name, 'value' => $row->customer_id);

            }

            $cache_file = './my-assets/js/admin_js/json/customer.json';

            $customerList = json_encode($json_customer);

            file_put_contents($cache_file, $customerList);

            return TRUE;

        }

    }



    //Customer Previous balance adjustment

    public function previous_balance_add($balance, $customer_id) {

        $this->load->library('auth');

        $transaction_id = $this->auth->generator(10);

        $data = array(

            'transaction_id' => $transaction_id,

            'customer_id' => $customer_id,

            'invoice_no' => "NA",

            'receipt_no' => NULL,

            'amount' => $balance,

            'description' => "Previous adjustment with software",

            'payment_type' => "NA",

            'cheque_no' => "NA",

            'date' => date("d-m-Y"),

            'status' => 1,

            'd_c' => "d"

        );



        $this->db->insert('customer_ledger', $data);

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



    //Retrieve customer Edit Data

    public function retrieve_customer_editdata($r_id,$customer_id) {

        $this->db->select('*');

        $this->db->from('customer_information');

        $this->db->where('customer_id', $customer_id);
        $this->db->where('r_id', $r_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    //Retrieve customer Personal Data 

    public function customer_personal_data($customer_id) {

        $this->db->select('*');

        $this->db->from('customer_information');

        $this->db->where('customer_id', $customer_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    //Retrieve customer Invoice Data 

    public function customer_invoice_data($customer_id) {

        $this->db->select('*');

        $this->db->from('customer_ledger');

        $this->db->where(array('customer_id' => $customer_id, 'receipt_no' => NULL, 'status' => 1));

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



    //Retrieve customer Receipt Data 

    public function customer_receipt_data($customer_id) {

        $this->db->select('*');

        $this->db->from('customer_ledger');

        $this->db->where(array('customer_id' => $customer_id, 'invoice_no' => NULL, 'status' => 1));

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }



//Retrieve customer All data 

    public function customerledger_tradational($customer_id) {

        $query = $this->db->select('*')

                ->from('customer_ledger cl')

                ->join('customer_information ci', 'ci.customer_id = cl.customer_id')

//                ->join('product_purchase pp', 'pp.chalan_no = sl.chalan_no')

                ->where('cl.customer_id', $customer_id)

                ->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        } else {

            return false;

        }

//        $this->db->select('

//			customer_ledger.*,

//			invoice.invoice as invoce_n

//			');

//        $this->db->from('customer_ledger');

//        $this->db->join('invoice', 'customer_ledger.invoice_no = invoice.invoice_id', 'LEFT');

//        $this->db->where(array('customer_ledger.customer_id' => $customer_id, 'customer_ledger.status' => 1));

//        $query = $this->db->get();

//        if ($query->num_rows() > 0) {

//            return $query->result_array();

//        }

//        return false;

    }



//Retrieve customer total information

    public function customer_transection_summary($customer_id) {

        $result = array();



        $this->db->select('sum(amount) as total_credit');

        $this->db->from('customer_ledger');

        $this->db->where('customer_id', $customer_id);

        $this->db->where('receipt_no', NULL);

        $this->db->where('status', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            $result[] = $query->result_array();

        }





        $this->db->select('sum(amount) as total_debit');

        $this->db->from('customer_ledger');

        $this->db->where('customer_id', $customer_id);

        $this->db->where('invoice_no', NULL);

        $this->db->where('status', 1);

        $query = $this->db->get();



        if ($query->num_rows() > 0) {

            $result[] = $query->result_array();

        }

        return $result;

    }



    //Update Categories

    public function update_customer($data, $customer_id,$addre,$multipleaddress) {

        $this->db->where('customer_id', $customer_id);

        $this->db->update('customer_information', $data);

		$str = "('".$customer_id."', '".$addre."',now())";
			foreach($multipleaddress as $key=>$value){
				$str .=  ",('".$customer_id."', '".$value."',now())";
			}
			$deletequery = "delete from tbl_customer_address where customer_id = '".$customer_id."'";
			$query1 = $this->db->query($deletequery);
			$query = "insert into tbl_customer_address(customer_id,address,timestamp)values".$str;
			$query = $this->db->query($query);



        $this->db->select('*');

        $this->db->from('customer_information');

        $query = $this->db->get();

        foreach ($query->result() as $row) {

            $json_customer[] = array('label' => $row->customer_name, 'value' => $row->customer_id);

        }

        $cache_file = './my-assets/js/admin_js/json/customer.json';

        $customerList = json_encode($json_customer);

        file_put_contents($cache_file, $customerList);

        return true;

    }



// custromer transection delete

    public function delete_transection($customer_id) {

        $this->db->where('relation_id', $customer_id);

        $this->db->delete('transection');

    }



    // custromer invoicedetails delete

    public function delete_invoicedetails($customer_id) {

        $this->db->where('customer_id', $customer_id);

        $this->db->delete('invoice_details');

    }



    // custromer invoice delete

    public function delete_invoic($customer_id) {

        $this->db->where('customer_id', $customer_id);

        $this->db->delete('invoice');

    }



    // delete customer ledger 

    public function delete_customer_ledger($customer_id) {
		$flag = 0;
		
		$this->db->select('*');
		$this->db->from('product_purchase');
		$this->db->where('customer_id',$customer_id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$flag = 1;
		}else{
			$flag = 0;
		}
		
		$this->db->select('*');
		$this->db->from('product_ticket');
		$this->db->where('customer_id',$customer_id);
		$query1 = $this->db->get();
		
		if ($query1->num_rows() > 0) {
			$flag = 1;
		}else{
			$flag = 0;
		}
		
		
		$this->db->select('*');
		$this->db->from('customer_ledger');
		$this->db->where('customer_id',$customer_id);
		$query2 = $this->db->get();
		
		if ($query2->num_rows() > 0) {
			$flag = 1;
		}else{
			$flag = 0;
		}
		echo $flag;die;	
		if($flag == 0){
		//	$this->db->where('customer_id', $customer_id);
		//	$this->db->delete('customer_ledger');
			return true;
		}else{
			return false;
		}
    }



    // Delete customer Item

    public function delete_customer($customer_id) {
		$flag = 0;
		$this->db->select('*');
		$this->db->from('product_purchase');
		$this->db->where('customer_id',$customer_id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$flag = 1;
		}
		
		$this->db->select('*');
		$this->db->from('product_ticket');
		$this->db->where('customer_id',$customer_id);
		$query1 = $this->db->get();
		
		if ($query1->num_rows() > 0) {
			$flag = 1;
		}
		
		
		$this->db->select('*');
		$this->db->from('customer_ledger');
		$this->db->where('customer_id',$customer_id);
		$query2 = $this->db->get();
		
		if ($query2->num_rows() > 0) {
			$flag = 1;
		}
		
		if($flag == 0){
		
		$this->db->where('customer_id', $customer_id);

        $this->db->delete('customer_information');



        $this->db->select('*');

        $this->db->from('customer_information');

        $query = $this->db->get();

        foreach ($query->result() as $row) {

            $json_customer[] = array('label' => $row->customer_name, 'value' => $row->customer_id);

        }

        $cache_file = './my-assets/js/admin_js/json/customer.json';

        $customerList = json_encode($json_customer);

        file_put_contents($cache_file, $customerList);

			return 1;
		
		}else{
			return 0;
		}

    }



    public function customer_search_list($cat_id, $company_id) {

        $this->db->select('a.*,b.sub_category_name,c.category_name');

        $this->db->from('customers a');

        $this->db->join('customer_sub_category b', 'b.sub_category_id = a.sub_category_id');

        $this->db->join('customer_category c', 'c.category_id = b.category_id');

        $this->db->where('a.sister_company_id', $company_id);

        $this->db->where('c.category_id', $cat_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }

	//Product search item
    public function product_search_item($customer_id, $flag) {
        if($flag=="c"){
			$query = "SELECT a.*, c.product_name, d.label as labnum, SUM(d.total_quantity) as total FROM `product_purchase_details` as a,product_purchase as b, product_information as c, purchase_receipt_order as d, inventory_locations as il WHERE il.label = d.label AND a.purchase_id = b.purchase_id AND b.customer_id = '".$customer_id."' and c.product_id = a.product_id AND d.purchase_id = a.purchase_id AND c.status = 1 GROUP BY c.product_name ORDER BY c.product_name ASC";
		}else{
			 $query = "SELECT product_information.*, (SELECT SUM(a.total_quantity) FROM purchase_receipt_order as a, inventory_locations as b WHERE a.label = b.label AND a.product_id = product_information.product_id AND a.is_web = 0) as total FROM product_information WHERE product_information.status = 1 GROUP BY product_id ORDER BY product_name ASC";
		}
		$query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	public function import_customer($files,$r_id){
		/* echo "here in this model";
		echo "<pre>";
		print_r($files); */
		
		$count=0;
        $fp = fopen($_FILES['customer']['tmp_name'],'r') or die(redirect('Ccustomer/import_customers/'.$r_id));
		$insert = [];
        while($csv_line = fgetcsv($fp,1024))
        {
            $count++;
            if($count == 1)
            {
                continue;
            }//keep this if condition if you want to remove the first row
            
				
				$data = array();
				if($csv_line[0]!='' && !empty($csv_line[0])){
					/* echo $csv_line[0];die; */
					$data['customer_name'] = $csv_line[0];
				}else{
					/* echo $csv_line[0];die; */
					$this->session->set_userdata(array('error_message' => "Customer Name is required field"));
					redirect('Ccustomer/import_customers/'.$r_id);
				}
				
				if($csv_line[1]!='' && !empty($csv_line[1])){
					$data['customer_mobile'] = $csv_line[1];
				}else{
					$this->session->set_userdata(array('error_message' => "Customer Mobile is required field"));
					redirect('Ccustomer/import_customers/'.$r_id);
				}
				
				if($csv_line[2]!='' && !empty($csv_line[2])){
					$data['customer_email'] = $csv_line[2];
				}else{
					$this->session->set_userdata(array('error_message' => "Customer Email is required field"));
					redirect('Ccustomer/import_customers/'.$r_id);
				}
				
				if($csv_line[3]!='' && !empty($csv_line[3])){
					$country = $this->getCountryCityStateId($csv_line[3], 1);
					#print_r($country);
					if($country[0]['id'] == NULL || $country[0]['id'] == 'NULL'){
						$this->session->set_userdata(array('error_message' => "Please check country name"));
					redirect('Ccustomer/import_customers/'.$r_id);
					
					}else{
						$data['country'] = $country[0]['id'];
					}
					
				}else{
					$this->session->set_userdata(array('error_message' => "Customer Country is required field"));
					redirect('Ccustomer/import_customers/'.$r_id);
				}
				
				if($csv_line[4]!='' && !empty($csv_line[4])){
					$state = $this->getCountryCityStateId($csv_line[4], 2);
					if($state[0]['id'] == NULL || $state[0]['id'] == 'NULL'){
						$this->session->set_userdata(array('error_message' => "Please check state name"));
					redirect('Ccustomer/import_customers/'.$r_id);
					}else{
						$data['state'] = $state[0]['id'];
					}
					
				}else{
					$this->session->set_userdata(array('error_message' => "Please check state name"));
					redirect('Ccustomer/import_customers/'.$r_id);
				}
				
				if($csv_line[5]!='' && !empty($csv_line[5])){
					$city = $this->getCountryCityStateId($csv_line[5], 3);
					if($city[0]['id'] == NULL || $city[0]['id'] == 'NULL'){
						$this->session->set_userdata(array('error_message' => "Please check city name"));
					redirect('Ccustomer/import_customers/'.$r_id);
					}else{
						$data['city'] = $city[0]['id'];
					}
					
				}else{
					$this->session->set_userdata(array('error_message' => "Please check city name"));
					redirect('Ccustomer/import_customers/'.$r_id);
				}
				
				if($csv_line[6]!='' && !empty($csv_line[6])){
					$data['customer_address'] = $csv_line[6];
				}else{
					$this->session->set_userdata(array('error_message' => "Customer Address is required field"));
					redirect('Ccustomer/import_customers/'.$r_id);
				}
				$data['customer_detail'] = $csv_line[7];
				
				if($csv_line[8]!='' && !empty($csv_line[8])){
					$data['zip'] = $csv_line[8];
				}else{
					$this->session->set_userdata(array('error_message' => "Zip code is required field"));
					redirect('Ccustomer/import_customers/'.$r_id);
				}
				
				$data['customer_id'] = $this->auth->generator(15);
				$status = 1 ;
				$data['status'] = $status;
				$data['r_id'] = $r_id;
				$insert[] = $data;
		}
		// print_r($insert);die;
		foreach($insert as $inserts){
			$this->db->select('*');

			$this->db->from('customer_information');

			$this->db->where('customer_mobile', $inserts['customer_mobile']);
			$this->db->where('r_id', $r_id);

			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				$this->session->set_userdata(array('error_message' => "This mobile number is already exists .".$inserts['customer_mobile']));
				redirect('Ccustomer/import_customers/'.$r_id);
			} else {
				$this->db->insert('customer_information', $inserts);
			}
		}
        fclose($fp) or die("can't close file");
        $this->session->set_userdata(array('message' => "Customers import Successfully"));
		redirect('Ccustomer/manage_customer/'.$r_id);
		
	}
	
	public function getCountryCityStateId($value, $flag){
		if($flag==1){
			$value = trim($value, '');
			$query = "SELECT * FROM countries WHERE (name =  '".$value."' or sortname =  '".$value."')";
			$query = $this->db->query($query);
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		}else if($flag==2){
			$value = trim($value, '');
			$query = "SELECT * FROM states WHERE name = '".$value."'";
			$query = $this->db->query($query);
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		}else if($flag==3){
			$value = trim($value, '');
			$query = "SELECT * FROM cities WHERE name = '".$value."'";
			$query = $this->db->query($query);
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		}else{
			return true;
		}
		return; 
	}
	
	public function check_customer_name($customer_email,$r_id){
		$query = "SELECT * FROM customer_information WHERE customer_email='".$customer_email."' AND r_id = ".$r_id."";
	
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return false;
		}
	}


}

