<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchases extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //Count purchase
    public function count_purchase($r_id) {
        $this->db->select('a.*,b.supplier_name');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->where('a.r_id',$r_id);
        $this->db->where('b.r_id',$r_id);
        $this->db->order_by('a.purchase_date', 'desc');
        $this->db->order_by('purchase_id', 'desc');
        $query = $this->db->get();

        $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
	
	//Count purchase
    public function count_purchase_today($r_id) {
        $this->db->select('a.*');
        $this->db->from('product_purchase a');
        $this->db->where('a.r_id',$r_id);
        #$this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->order_by('a.purchase_date', 'desc');
        $this->db->order_by('purchase_id', 'desc');
        $this->db->like('created_at', date("Y-m-d"));
        $query = $this->db->get();

        $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
	
	//Count purchase
    public function count_purchase_line_item_today($r_id) {
        $this->db->select('a.*');
        $this->db->from('product_purchase_details a');
        $this->db->where('a.r_id',$r_id);
        #$this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->order_by('purchase_detail_id', 'desc');
        $this->db->like('created_at', date("Y-m-d"));
        $query = $this->db->get();
		$last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
	
	//Count purchase
    public function count_picking_line_item_today($r_id) {
        $this->db->select('a.*');
        $this->db->from('product_ticket_details a');
        $this->db->where('a.r_id',$r_id);
        #$this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->order_by('ticket_detail_id', 'desc');
        $this->db->like('created_at', date("Y-m-d"));
        $query = $this->db->get();
		$last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
	
	//Count purchase
    public function count_picking_line_item_month($r_id) {
        $query = "SELECT a.* FROM product_ticket_details as a WHERE a.r_id = ".$r_id." AND MONTH(a.created_at) = MONTH(CURRENT_DATE())";
		
        $query = $this->db->query($query);
       // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
	
	//Count purchase
    public function count_ticket_today($r_id) {
        $this->db->select('a.*');
        $this->db->from('product_ticket a');
        $this->db->where('a.r_id',$r_id);
        $this->db->order_by('ticket_id', 'desc');
        $this->db->like('created_at', date("Y-m-d"));
        $query = $this->db->get();

         $last_query = $this->db->last_query();
		 // print_r($last_query);die;
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
		
		
    }
	
	//Count purchase
    public function count_ticket_month($r_id) {
        $query = "SELECT a.* FROM product_ticket as a  WHERE a.r_id = ".$r_id." AND MONTH(a.created_at) = MONTH(CURRENT_DATE())";
		// print_r($query);die;
        $query = $this->db->query($query);
       // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
	
	//Count purchase
    public function count_purchase_month($r_id) {
         $query = "SELECT `a`.*, `b`.`supplier_name` FROM `product_purchase` `a` JOIN `supplier_information` `b` ON `b`.`supplier_id` = `a`.`supplier_id` WHERE a.r_id =$r_id AND b.r_id = $r_id AND MONTH(a.created_at) = MONTH(CURRENT_DATE()) ORDER BY `a`.`purchase_date` DESC, `purchase_id` DESC";
        $query = $this->db->query($query);
       // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
	
	//Count line item
    public function count_purchase_line_item_month() {
        $r_id=$this->session->r_id;
         $query = "SELECT `a`.* FROM `product_purchase_details` `a` WHERE MONTH(a.created_at) = MONTH(CURRENT_DATE()) and a.r_id =$r_id ORDER BY `a`.`created_at` DESC, `purchase_detail_id` DESC";
		 // print_r($query);die;
        $query = $this->db->query($query);
    //    echo $query->num_rows();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
	
	public function today_partially_ticket_line_item($r_id){
		$date = date('Y-m-d');
		$query = "SELECT product_ticket_details.*, COALESCE(SUM(product_picking_order.picked_quantity),0) as totalpicked FROM `product_ticket_details` JOIN product_picking_order ON product_picking_order.ticket_detail_id = product_ticket_details.ticket_detail_id WHERE product_ticket_details.r_id = ".$r_id." AND  product_ticket_details.created_at like '%".$date."%' GROUP BY product_picking_order.ticket_detail_id HAVING product_ticket_details.quantity > totalpicked";
        $query = $this->db->query($query);
       // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
	}
	
	public function today_fully_ticket_line_item($r_id){
		$date = date('Y-m-d');
		$query = "SELECT product_ticket_details.*, SUM(product_picking_order.picked_quantity) as totalpicked FROM `product_ticket_details` JOIN product_picking_order ON product_picking_order.ticket_detail_id = product_ticket_details.ticket_detail_id WHERE product_ticket_details.r_id = '".$r_id."' AND product_ticket_details.created_at like '%".$date."%' GROUP BY product_picking_order.ticket_detail_id HAVING product_ticket_details.quantity <= totalpicked";
        $query = $this->db->query($query);
       // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
	}
	
	public function month_partially_ticket_line_item(){
		$date = date('Y-m-d');
		$query = "SELECT product_ticket_details.*, COALESCE(SUM(product_picking_order.picked_quantity),0) as totalpicked FROM `product_ticket_details` JOIN product_picking_order ON product_picking_order.ticket_detail_id = product_ticket_details.ticket_detail_id WHERE product_ticket_details.r_id = ".$r_id." MONTH(product_ticket_details.created_at) = MONTH(CURRENT_DATE()) GROUP BY product_picking_order.ticket_detail_id HAVING product_ticket_details.quantity > totalpicked";
        $query = $this->db->query($query);
       // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
	}
	
	public function month_fully_ticket_line_item(){
	    $r_id=$this->session->r_id;
		$date = date('Y-m-d');
		$query = "SELECT product_ticket_details.*, SUM(product_picking_order.picked_quantity) as totalpicked FROM `product_ticket_details` JOIN product_picking_order ON product_picking_order.ticket_detail_id = product_ticket_details.ticket_detail_id WHERE MONTH(product_ticket_details.created_at) = MONTH(CURRENT_DATE()) and product_ticket_details.r_id=$r_id GROUP BY product_picking_order.ticket_detail_id HAVING product_ticket_details.quantity <= totalpicked";
        $query = $this->db->query($query);
        // echo $query->num_rows();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
	}
	
	
	//Count line item
    public function count_purchase_line_item_month_parital_received() {
        $r_id=$this->session->r_id;
         $query = "SELECT SUM(purchase_receipt_order.total_quantity) as totalrecievedyet, purchase_receipt_order.product_id, purchase_receipt_order.purchase_id, purchase_receipt_order.purchase_detail_id, product_purchase_details.quantity FROM `purchase_receipt_order` JOIN product_purchase_details ON product_purchase_details.purchase_detail_id = purchase_receipt_order.purchase_detail_id WHERE MONTH(product_purchase_details.created_at) = MONTH(CURRENT_DATE()) AND purchase_receipt_order.is_web = 0 and product_purchase_details.r_id=".$r_id." GROUP BY product_purchase_details.purchase_detail_id  HAVING product_purchase_details.quantity>totalrecievedyet";
		 // print_r($query);die;
        $query = $this->db->query($query);
    //    echo $query->num_rows();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
	
	//Count line item
    public function count_purchase_line_item_month_fully_received($r_id) {
         $query = "SELECT SUM(purchase_receipt_order.total_quantity) as totalrecievedyet, purchase_receipt_order.product_id, purchase_receipt_order.purchase_id, purchase_receipt_order.purchase_detail_id, product_purchase_details.quantity FROM `purchase_receipt_order` JOIN product_purchase_details ON product_purchase_details.purchase_detail_id = purchase_receipt_order.purchase_detail_id WHERE purchase_receipt_order.r_id = ".$r_id." AND MONTH(product_purchase_details.created_at) = MONTH(CURRENT_DATE()) AND purchase_receipt_order.is_web = 0 GROUP BY product_purchase_details.purchase_detail_id  HAVING product_purchase_details.quantity<=totalrecievedyet";
        $query = $this->db->query($query);
        // echo $query->num_rows();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
	//Count location
    public function count_location_items($r_id) {
        # $query = "select locations.*, SUM(purchase_receipt_order.total_quantity) as totalquantity FROM locations JOIN inventory_locations ON inventory_locations.location_unique_key = locations.location_unique_key JOIN purchase_receipt_order ON purchase_receipt_order.label = inventory_locations.label WHERE locations.is_deleted = 0 GROUP BY locations.location_unique_key";
        
		$data = [];
		$query = "SELECT a.*, (SELECT SUM(purchase_receipt_order.total_quantity) FROM purchase_receipt_order JOIN inventory_locations ON purchase_receipt_order.label = inventory_locations.label WHERE purchase_receipt_order.label = inventory_locations.label AND a.r_id = $r_id AND inventory_locations.r_id = $r_id AND inventory_locations.location_unique_key = a.location_unique_key) as totalquantity FROM `locations` as a WHERE a.is_deleted = 0 AND a.r_id =$r_id ";
		
		
        $query = $this->db->query($query);
    //    echo $query->num_rows();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
         #   return $query->result_array();
        }
     #   return false;
		
		
		$query_all_locations = "SELECT COUNT(locations.id) as total_location FROM locations where is_deleted = 0 AND r_id =$r_id";
		$query = $this->db->query($query_all_locations);
        $locationall = [];
      
        if ($query->num_rows() > 0) {
            $locationall = $query->result_array();
        }
		
		
		$query_filled_locations = "SELECT DISTINCT location_unique_key FROM inventory_locations where is_deleted = 0 AND r_id =$r_id";
        $query = $this->db->query($query_filled_locations);
       
		$locationall1 = [];
        if ($query->num_rows() > 0) {
            $locationall1 = $query->result_array();
			
        }
		
		
		$query_inven_locations = "SELECT DISTINCT location_unique_key, SUM(purchase_receipt_order.total_quantity) as totalquantity, SUM(product_purchase_details.total_amount) as totalamount FROM inventory_locations JOIN purchase_receipt_order ON purchase_receipt_order.label = inventory_locations.label JOIN product_purchase_details ON product_purchase_details.purchase_detail_id = purchase_receipt_order.purchase_detail_id AND inventory_locations.r_id =$r_id GROUP BY inventory_locations.location_unique_key ";
        $query = $this->db->query($query_inven_locations);
       
		$locationall2 = [];
        if ($query->num_rows() > 0) {
            $locationall2 = $query->result_array();
			
        }
		
		$totalamount = 0;
		$totalinventory = 0;
		foreach($locationall2 as $locc){
			$totalamount += $locc['totalamount'];	
			$totalinventory += $locc['totalquantity'];	
		}

		
		$percentagefilled = 0;
		if($locationall[0]['total_location']>0){
			$percentagefilled = round(count($locationall1) / $locationall[0]['total_location'] * 100);
		}else{
			$percentagefilled = 0;
		}
		$data['total_locations'] = $locationall[0]['total_location'];
		$data['total_filled_locations'] = count($locationall1);
		$data['total_empty_locations'] = $locationall[0]['total_location']-count($locationall1);
		$data['totalamount'] = $totalamount;
		$data['totalinventory'] = $totalinventory;
		$data['percentagefilled'] = $percentagefilled;
		$data['percentageunfilled'] = 100 - $percentagefilled;
		$data['piechatdata'] = array($percentagefilled, 100 - $percentagefilled);
		$data['piechartcoloum'] = array($percentagefilled."% of location filled with ".$totalinventory." items of amount $".$totalamount, 100 - $percentagefilled."% of locations are empty");
		// return ;
		// print_r($data);die;
		return $data;
    }
	
	//Count purchase
    public function purchase_receiving_graph_data() {
        $r_id=$this->session->r_id;
         $query = "SELECT count(id) as totalorders, CONCAT(YEAR(created_at),'-', MONTH(created_at), '-', DAY(created_at)) as ym FROM purchase_receipt_order WHERE is_web = 0 and r_id= $r_id GROUP BY ym";
        // print_r( $query);die;
        $query = $this->db->query($query);
        // print_r($query2);die;
         $last_query = $this->db->last_query();
        // print_r($query->num_rows());die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //purchase List
    public function purchase_list($per_page, $page, $post,$r_id) {
       $where = "";
		
		if(!empty($post['supplier_id'])){
			$where .= "AND a.supplier_id = '".$post['supplier_id']."'";
		}
		
		if(!empty($post['product_id'])){
			$where .= "AND ppd.product_id = '".$post['product_id']."'";
		}
		
		if(!empty($post['customer_po'])){
			$where .= "AND a.customer_po = '".$post['customer_po']."'";
		}
		
		if(!empty($post['customer_name'])){
			$where .= " AND a.customer_id =(SELECT customer_id FROM `customer_information` where customer_name = '".$post['customer_name']."' limit 1)";
			
		}
		
        $query = "SELECT `a`.*, `b`.`supplier_name`, `c`.`customer_name`, replace(GROUP_CONCAT(p.product_name), ',', '<br/>') as productName, count(ppd.product_id) as productcount FROM `product_purchase` `a` JOIN `supplier_information` `b` ON `b`.`supplier_id` = `a`.`supplier_id` JOIN `customer_information` `c` ON `c`.`customer_id` = `a`.`customer_id` JOIN `product_purchase_details` `ppd` ON `ppd`.`purchase_id` = `a`.`purchase_id` JOIN `product_information` `p` ON `p`.`product_id` = `ppd`.`product_id` WHERE a.r_id = $r_id AND a.status = 1 ".$where." GROUP BY `purchase_id` ORDER BY `a`.`purchase_date` DESC, `purchase_id` DESC";
		
		/* echo $query; die; */
        $query = $this->db->query($query);
        return $query->result_array();
       // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	public function today_fully_received($r_id){
		$date = date('Y-m-d');
		#$date = "2019-02-12";
		$query = "SELECT SUM(purchase_receipt_order.total_quantity) as totalrecievedyet, purchase_receipt_order.product_id, purchase_receipt_order.purchase_id, purchase_receipt_order.purchase_detail_id, product_purchase_details.quantity FROM `purchase_receipt_order` JOIN product_purchase_details ON product_purchase_details.purchase_detail_id = purchase_receipt_order.purchase_detail_id WHERE purchase_receipt_order.r_id = ".$r_id." AND purchase_receipt_order.created_at like '%".$date."%' AND purchase_receipt_order.is_web = 0 AND product_purchase_details.quantity<=total_quantity GROUP BY purchase_receipt_order.purchase_id";
        $query = $this->db->query($query);
        return $query->result_array();
        echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;	
	}
	
	public function month_fully_received(){
	
/*	$query = "SELECT SUM(purchase_receipt_order.total_quantity) as totalrecievedyet, purchase_receipt_order.product_id, purchase_receipt_order.purchase_id, purchase_receipt_order.purchase_detail_id, product_purchase_details.quantity FROM `purchase_receipt_order` JOIN product_purchase_details ON product_purchase_details.purchase_detail_id = purchase_receipt_order.purchase_detail_id WHERE MONTH(purchase_receipt_order.created_at) = MONTH(CURRENT_DATE()) AND purchase_receipt_order.is_web = 0 AND product_purchase_details.quantity<=total_quantity GROUP BY purchase_receipt_order.purchase_id";
*/
    $r_id=$this->session->r_id;
    
    $query="SELECT SUM(purchase_receipt_order.total_quantity) as totalrecievedyet, purchase_receipt_order.product_id, purchase_receipt_order.purchase_id, purchase_receipt_order.purchase_detail_id, product_purchase_details.quantity FROM `purchase_receipt_order` JOIN product_purchase_details ON product_purchase_details.purchase_detail_id = purchase_receipt_order.purchase_detail_id WHERE MONTH(product_purchase_details.created_at) = MONTH(CURRENT_DATE()) AND purchase_receipt_order.is_web = 0 and purchase_receipt_order.r_id=$r_id GROUP BY product_purchase_details.purchase_detail_id HAVING product_purchase_details.quantity<=totalrecievedyet";

        $query = $this->db->query($query);
        $query->result_array();
        // print_R($this->db->last_query());die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;	
	}
	
	public function today_partially_received(){
		$date = date('Y-m-d');
		#$date = "2019-02-12";
		$r_id=$this->session->r_id;
		$query = "SELECT SUM(purchase_receipt_order.total_quantity) as totalrecievedyet, purchase_receipt_order.product_id, purchase_receipt_order.purchase_id, purchase_receipt_order.purchase_detail_id, product_purchase_details.quantity FROM `purchase_receipt_order` JOIN product_purchase_details ON product_purchase_details.purchase_detail_id = purchase_receipt_order.purchase_detail_id WHERE purchase_receipt_order.created_at like '%".$date."%' AND purchase_receipt_order.is_web = 0 AND purchase_receipt_order.r_id =$r_id and product_purchase_details.quantity>total_quantity GROUP BY purchase_receipt_order.purchase_id";
        $query = $this->db->query($query);
        // return $query->result_array();
        // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;	
	}
	
	public function today_partially_received_line_item($r_id){
		$date = date('Y-m-d');
		#$date = "2019-02-12";
		// $r_id=$this->session->r_id;
		$query = "SELECT SUM(purchase_receipt_order.total_quantity) as totalrecievedyet, purchase_receipt_order.product_id, purchase_receipt_order.purchase_id, purchase_receipt_order.purchase_detail_id, product_purchase_details.quantity FROM `purchase_receipt_order` JOIN product_purchase_details ON product_purchase_details.purchase_detail_id = purchase_receipt_order.purchase_detail_id WHERE product_purchase_details.created_at like '%".$date."%' AND purchase_receipt_order.is_web = 0 and purchase_receipt_order.r_id='".$r_id."' AND product_purchase_details.quantity>total_quantity GROUP BY product_purchase_details.purchase_detail_id";
        $query = $this->db->query($query);
        // return $query->result_array();
        // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;	
	}
	
	public function today_fully_received_line_item(){
		$date = date('Y-m-d');
		#$date = "2019-02-12";
		$r_id=$this->session->r_id;
		$query = "SELECT SUM(purchase_receipt_order.total_quantity) as totalrecievedyet, purchase_receipt_order.product_id, purchase_receipt_order.purchase_id, purchase_receipt_order.purchase_detail_id, product_purchase_details.quantity FROM `purchase_receipt_order` JOIN product_purchase_details ON product_purchase_details.purchase_detail_id = purchase_receipt_order.purchase_detail_id WHERE product_purchase_details.created_at like '%".$date."%' AND purchase_receipt_order.is_web = 0 and purchase_receipt_order.r_id= $r_id  AND product_purchase_details.quantity<=total_quantity GROUP BY product_purchase_details.purchase_detail_id";
        $query = $this->db->query($query);
        // return $query->result_array();
        // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;	
	}
	
	public function today_partially_ticket($r_id){
		$date = date('Y-m-d');
		#$date = "2019-02-11";
		$query = "select product_ticket.*, product_ticket_details.*, product_ticket_details.quantity as required_quantity, SUM(product_picking_order.picked_quantity) as pickedqu FROM product_ticket JOIN product_ticket_details ON product_ticket_details.ticket_id = product_ticket.ticket_id JOIN product_picking_order ON product_picking_order.ticket_id = product_ticket_details.ticket_id WHERE product_ticket.r_id = ".$r_id." AND product_picking_order.created_at like '%".$date."%' GROUP BY product_ticket.ticket_id";
        $query = $this->db->query($query);
       // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
			$dss = $query->result_array();
			$array = [];
			foreach($dss as $rows){
				if($rows['quantity'] > $rows['pickedqu']){
					$array[] = $rows;
				}
			}
			return $array;
        }
        return false;	
	}
	
	public function today_fully_ticket($r_id){
		$date = date('Y-m-d');
		#$date = "2019-02-11";
		$query = "select product_ticket.*, product_ticket_details.*, product_ticket_details.quantity as required_quantity, SUM(product_picking_order.picked_quantity) as pickedqu FROM product_ticket JOIN product_ticket_details ON product_ticket_details.ticket_id = product_ticket.ticket_id JOIN product_picking_order ON product_picking_order.ticket_id = product_ticket_details.ticket_id WHERE product_ticket.r_id = '".$r_id."' AND product_picking_order.created_at like '%".$date."%' GROUP BY product_ticket.ticket_id";
    
	   $query = $this->db->query($query);
       // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
			$dss = $query->result_array();
			$array = [];
			foreach($dss as $rows){
				if($rows['quantity'] <= $rows['pickedqu']){
					$array[] = $rows;
				}
			}
			return $array;
        }
        return false;	
	}
	
	
	public function month_partial_received(){
		$date = date('Y-m-d');
		#$date = "2019-02-12";
		$r_id=$this->session->r_id;
		$query = "SELECT SUM(purchase_receipt_order.total_quantity) as totalrecievedyet, purchase_receipt_order.product_id, purchase_receipt_order.purchase_id, purchase_receipt_order.purchase_detail_id, product_purchase_details.quantity FROM `purchase_receipt_order` JOIN product_purchase_details ON product_purchase_details.purchase_detail_id = purchase_receipt_order.purchase_detail_id WHERE MONTH(purchase_receipt_order.created_at) = MONTH(CURRENT_DATE()) AND purchase_receipt_order.is_web = 0 AND product_purchase_details.quantity>total_quantity  and purchase_receipt_order.r_id=$r_id GROUP BY purchase_receipt_order.purchase_id";
        $query = $this->db->query($query);
        // return $query->result_array();
        // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;	
	}
	
	
	
	public function monthly_fully_ticket(){
		$date = date('Y-m-d');
		#$date = "2019-02-11";
		$r_id=$this->session->r_id;
		$query = "select product_ticket.*, product_ticket_details.*, product_ticket_details.quantity as required_quantity, SUM(product_picking_order.picked_quantity) as pickedqu FROM product_ticket JOIN product_ticket_details ON product_ticket_details.ticket_id = product_ticket.ticket_id JOIN product_picking_order ON product_picking_order.ticket_id = product_ticket_details.ticket_id WHERE  MONTH(product_picking_order.created_at) = MONTH(CURRENT_DATE()) and product_ticket.r_id =$r_id GROUP BY product_ticket.ticket_id";
        $query = $this->db->query($query);
        // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
			$dss = $query->result_array();
			$array = [];
			foreach($dss as $rows){
				if($rows['quantity'] <= $rows['pickedqu']){
					$array[] = $rows;
				}
			}
			return $array;
        }
        return false;	
	}
	
	public function month_partially_ticket($r_id){
		$query = "select product_ticket.*, product_ticket_details.*, product_ticket_details.quantity as required_quantity, SUM(product_picking_order.picked_quantity) as pickedqu FROM product_ticket JOIN product_ticket_details ON product_ticket_details.ticket_id = product_ticket.ticket_id JOIN product_picking_order ON product_picking_order.ticket_id = product_ticket_details.ticket_id WHERE product_ticket.r_id = ".$r_id." AND MONTH(product_picking_order.created_at) = MONTH(CURRENT_DATE())  GROUP BY product_ticket.ticket_id";
        $query = $this->db->query($query);
       // echo $this->db->last_query();die;
       //  $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
			$dss = $query->result_array();
			$array = [];
			foreach($dss as $rows){
				if($rows['quantity'] > $rows['pickedqu']){
					$array[] = $rows;
				}
			}
			return $array;
        }
        return false;	
	}
	

    //Select All Supplier List
    public function select_all_supplier($r_id) {
        $query = $this->db->select('*')
                ->from('supplier_information')
                ->where('status', '1')
                ->where('r_id',$r_id)
				->order_by('supplier_name')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	 //Select All Supplier List
    public function all_product_list($r_id) {
        $query = $this->db->select('*')
                ->from('product_information')
                ->where('status', '1')
                ->where('r_id',$r_id)
				->order_by('product_name')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	// select customer po
     public function all_customerPO_list($r_id){
		 $query = $this->db->select('*')
                ->from('product_purchase')
                ->where('r_id',$r_id)
				->order_by('customer_po')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
	 }
	 
	 
    // select All Customer List
    public function all_customer_list($r_id){
        $query = $this->db->select('*')
        ->from('customer_information')
        ->where('status', '1')
        ->where('r_id',$r_id)
        ->order_by('customer_name')
        ->get();
		
    if ($query->num_rows() > 0) {
    return $query->result_array();
}
return false;
}
    
	
	 //Select All Supplier List
    public function all_product_list_supplier($r_id,$supplier_id) {
        $query = $this->db->select('*')
                ->from('product_information')
                ->where('status', '1')
                ->where('supplier_id', $supplier_id)
                ->where('r_id',$r_id)
				->order_by('product_name')
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
	
	
	public function check_customer_po_purchase($cus_po,$r_id){
		$this->db->select("*");
		$this->db->from('product_purchase');
		$this->db->where("customer_po", $cus_po);
	    $this->db->where("r_id", $r_id);
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
	}

    //Count purchase
    public function purchase_entry($r_id) {
		
        $purchase_id = $this->input->post('purchase_id');

        $p_id = $this->input->post('product_id');
        $supplier_id = $this->input->post('supplier_id');
            // print_r($r_id);die;
        //supplier & product id relation ship checker.
        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_id = $p_id[$i];
            // print_r($r_id);die;
            $value = $this->product_supplier_check($product_id, $supplier_id);
            // print_r($r_id);die;
            if ($value == 0) {
                $this->session->set_userdata(array('error_message' => "Product and Vendor did not match !"));
                redirect(base_url('Cpurchase'));
                exit();
				#echo json_encode(array("status"=>false, "msg"=>"Product and Vendor did not match!"));
				#exit();
            }
        }
		
		//check for customer po
		$check  = $this->check_customer_po_purchase($this->input->post('customer_po'),$r_id);
		if($check){
			$this->session->set_userdata(array('error_message' => "This customer PO has already used, please use another!"));
            redirect(base_url('Cpurchase'));
            exit();
			
			#echo json_encode(array("status"=>false, "msg"=>"This customer PO has already used, plesae use another!"));
			#exit();
		}
        
          
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
            'ship_method' => join(",", $this->input->post('ship_method')),
            'r_id'  => $r_id
           
        );
        #echo "<pre>";print_r($data);die;
        // print_r($r_id);die;
        $this->db->insert('product_purchase', $data);
        // print_r($r_id);die;
		$insert_idP = $this->db->insert_id();
		
		$ledger = array(
            'transaction_id' => $purchase_id,
            'chalan_no' => $this->input->post('chalan_no'),
            'supplier_id' => $this->input->post('supplier_id'),
            'amount' => $this->input->post('grand_total_price'),
            'date' => $this->input->post('purchase_date'),
            'description' => $this->input->post('purchase_details'),
            'r_id' => $r_id,
            'status' => 1,
            'd_c' => 'c'
        );
        $this->db->insert('supplier_ledger', $ledger);
        // print_r($r_id);die;
        
		$rate = $this->input->post('product_rate');
        $quantity = $this->input->post('product_quantity');
        $t_price = $this->input->post('total_price');
        $unit = $this->input->post('unit');
        $per = $this->input->post('per2');
        $innerper = $this->input->post('inner-per');
        $innerper2 = $this->input->post('inner-per2');
        $description = $this->input->post('description');
		
        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_quantity1 = $quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
            $unit1 = $unit[$i];
			$per1 = $per[$i];
			$innerper1 = $innerper[$i];
			$innerper21 = $innerper2[$i];
			$description = $description[$i];
			$totalQuantityRecorded = $_POST['product_quantity'][$i];
			$arrrrrr = explode("###", $unit1);
			$unit1 = $arrrrrr[0];
			$totalQuantityRecorded = $arrrrrr[1] * $totalQuantityRecorded;
			
		
		$product_quantity = $totalQuantityRecorded;
		$purchase_detail_id = $this->generator(15);
            $data1 = array(
                'purchase_detail_id' => $purchase_detail_id,
                'purchase_id' => $purchase_id,
                'product_id' => $product_id,
                'quantity' => $totalQuantityRecorded,
                'rate' => $product_rate,
                'total_amount' => $total_price,
                'status' => 1,
                'unit' => $unit1,
				'description' => $description,
                'requested_quantity' => $product_quantity1,
                'r_id' => $r_id
            );
			if (!empty($quantity)) {
                $this->db->insert('product_purchase_details', $data1);
            }
			// print_r($r_id);die;
			// insert data into orders table
			$label = time() + $i;
			$data2 = array(
				"purchase_id" => $purchase_id,
				"purchase_detail_id" => $purchase_detail_id,
				"product_id" => $product_id,
				"type" => 1,
				'unit' => $unit1,
				"total_quantity" => $totalQuantityRecorded,
				"label" => "UI".$label,
				'quantity' => $product_quantity1,
                'requested_quantity' => $product_quantity1,
                'r_id' =>$r_id,
				'is_web' => 1
			);
			if (!empty($data2)) {

                $this->db->insert('purchase_receipt_order', $data2);
            }
        }
        // print_r($r_id);die;
        // print_r($this->db->query("call STR_updatePOnumber('".$purchase_id."',".$insert_idP.")")); die;
		$query = $this->db->query("call STR_updatePOnumber('".$purchase_id."',".$insert_idP.")");
		
		
		return true;
		#echo json_encode(array("status"=>true, "msg"=>"Successfully created purchase order."));
		#exit();
    }

    //Retrieve purchase Edit Data
    public function retrieve_purchase_editdata($r_id,$purchase_id) {
        $this->db->select('a.*,
						b.per2 as per, b.inner-per as per2, b.inner-per2 as per3, b.purchase_detail_id,b.unit,
						c.product_id,
						c.product_name,
						c.product_model,
						c.cartoon_quantity,
						d.supplier_id,
						d.supplier_name,
                        e.customer_name,
						c.unit_values,
						c.price,
						b.quantity,
						b.rate,
						b.total_amount,
						b.requested_quantity,
						b.description'
						
						
        );
        $this->db->from('product_purchase a');
        $this->db->join('product_purchase_details b', 'b.purchase_id =a.purchase_id');
        $this->db->join('product_information c', 'c.product_id =b.product_id');
        $this->db->join('supplier_information d', 'd.supplier_id = a.supplier_id');
        $this->db->join('customer_information e', 'e.customer_id = a.customer_id');
        $this->db->join('purchase_receipt_order pro', 'pro.purchase_id = a.purchase_id');
        $this->db->where('a.r_id',$r_id);
        $this->db->where('b.r_id',$r_id);
        $this->db->where('c.r_id',$r_id);
        $this->db->where('d.r_id',$r_id);
        $this->db->where('e.r_id',$r_id);
        $this->db->where('pro.r_id',$r_id);
        $this->db->where('a.purchase_id', $purchase_id);
		$this->db->group_by('b.purchase_detail_id');
        $this->db->order_by('b.id', 'asc');
        /* $this->db->order_by('a.purchase_details', 'asc'); */ // comment on 09-05-2019 tapan
        $query = $this->db->get();
        
			// echo $this->db->last_query();die;
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
    public function update_purchase($r_id) {
        #echo "<pre>";print_r($_POST);die;
        $purchase_id = $this->input->post('purchase_id');

        $data = array(
            'chalan_no' => $this->input->post('chalan_no'),
            'supplier_id' => $this->input->post('supplier_id'),
            'customer_id' => $this->input->post('customer_id'),
            'ship_date' => $this->input->post('ship_date'),
            'customer_po' => $this->input->post('customer_po'),
            'ship_method' => join(",", $this->input->post('ship_method')),
            'grand_total_amount' => $this->input->post('grand_total_price'),
            'purchase_date' => $this->input->post('purchase_date'),
            'purchase_details' => $this->input->post('purchase_details'),
            
            
        );
        // print_r($data);
        // die();
        if ($purchase_id != '') {
           # print_r($data);
           # echo $purchase_id;die;
            $this->db->where('purchase_id', $purchase_id);
            $this->db->where('r_id',$r_id);
            $this->db->update('product_purchase', $data);
			
			
			
        }

        /*$rate = $this->input->post('product_rate');
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
        }*/
		
        $this->db->where('purchase_id', $purchase_id);
        $this->db->where('r_id',$r_id);
		$this->db->delete('product_purchase_details'); 
		
		
		$p_id = $this->input->post('product_id');
		$rate = $this->input->post('product_rate');
        $quantity = $this->input->post('product_quantity');
        $t_price = $this->input->post('total_price');
        $unit = $this->input->post('unit');
        $per = $this->input->post('per2');
        $innerper = $this->input->post('inner-per');
        $innerper2 = $this->input->post('inner-per2');
        $description = $this->input->post('description');
		
		// print_r($description);
        //    die();
		
		
        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_quantity1 = $quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
            $unit1 = $unit[$i];
			$per1 = $per[$i];
			$innerper1 = $innerper[$i];
			$innerper21 = $innerper2[$i];
			$description = $description[$i];
			$totalQuantityRecorded = $_POST['product_quantity'][$i];
			$arrrrrr = explode("###", $unit1);
			$unit1 = $arrrrrr[0];
			$totalQuantityRecorded = $arrrrrr[1] * $totalQuantityRecorded;
			
		
		$product_quantity = $totalQuantityRecorded;
		$purchase_detail_id = $this->generator(15);
            $data1 = array(
                'purchase_detail_id' => $purchase_detail_id,
                'purchase_id' => $purchase_id,
                'product_id' => $product_id,
                'quantity' => $totalQuantityRecorded,
                'rate' => $product_rate,
                'total_amount' => $total_price,
                'status' => 1,
                'unit' => $unit1,
				'description' => $description,
                'requested_quantity' => $product_quantity1,
                'r_id' =>$r_id
            );
           
			if (!empty($quantity)) {
                $this->db->insert('product_purchase_details', $data1);
				
				$this->db->query("UPDATE product_purchase_details as a,product_information as b set a.description=b.product_details where a.r_id = $r_id and b.r_id = $r_id and a.product_id=b.product_id and a.purchase_id = '".$purchase_id."'");
            }
		}
		
		/*$removed_purchased_id = $this->input->post("removed_purchased_id");
		for ($i = 0, $n = count($removed_purchased_id); $i < $n; $i++) {
			$purchase_detail_id = $removed_purchased_id[$i];
			$this->db->where('purchase_detail_id', $purchase_detail_id);
			$this->db->delete('product_purchase_details'); 
		}*/
        return true;
    }

    // Delete purchase Item
    public function delete_purchase($purchase_id) {
		
		
		echo $purchase_id;
		
		$this->db->select("*");
		$this->db->from("purchase_receipt_order");
		$this->db->where("purchase_id", $purchase_id);
		$this->db->where("is_web", 0);
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        }else{
		 //Delete product_purchase table
        $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('product_purchase');
        //Delete product_purchase_details table
        $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('product_purchase_details');
        return true;
		}
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
        $this->db->select('a.*,b.*,c.*,ci.*, e.purchase_details, e.customer_po, t.shipping_name ,d.product_id,d.product_name,d.product_model,d.cartoon_quantity, d.product_details, ci.customer_address, ct.name as customer_city_name, st.name as customer_state_name');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->join('customer_information ci', 'ci.customer_id = a.customer_id');
        $this->db->join('product_purchase_details c', 'c.purchase_id = a.purchase_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->join('product_purchase e', 'e.purchase_id = c.purchase_id');

      
        $this->db->join('shipping_method t','find_in_set(t.id, a.ship_method)');

        $this->db->join('cities ct', 'ci.city = ct.id');
        $this->db->join('states st', 'ci.state = st.id');

        $this->db->group_by("c.id");
      
        
        $this->db->where('a.purchase_id', $purchase_id);
        $query = $this->db->get();

         //print_r($this->db->last_query());
         //die();

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

    public function retrieve_purchase_labnumdata($purchase_id ,$product_id,$datagrp) {

        $this->db->select('a.*');
        $this->db->select('b.product_name');

        $this->db->select('b.product_details');
       

        $this->db->from('purchase_receipt_order a');
        $this->db->join('product_information b', 'b.product_id =a.product_id');
        // $this->db->join('product_purchase_details c', 'c.purchase_id =a.purchase_id');

        $this->db->where('a.purchase_id', $purchase_id);
        $this->db->where('a.product_id', $product_id);
        $this->db->where('a.is_web', 0);
        $this->db->where('a.datagrp', $datagrp);

        // $query = $this->db-query("select * from purchase_receipt_order where purchase_id ='"..$purchase_id"' and
        // pro  ")

        $query = $this->db->get();
        // print_r( $query);
        // die();
        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;

    }
	
	public function checkCustomePO($customer_po){
		$this->db->select('*');

        $this->db->from('product_purchase');

        $this->db->where('customer_po', $customer_po);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;
	}
	
	
	public function getshippingname($id){
		$this->db->select('*');

        $this->db->from('shipping_method');

        $this->db->where('id', $id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;
	}

}
