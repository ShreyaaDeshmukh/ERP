<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tickets extends CI_Model {
	 public function __construct() {
        parent::__construct();
    }

    //Count purchase
    public function count_ticket($r_id) {
        $this->db->select('a.*');
        $this->db->from('product_ticket a');
        $this->db->join('product_ticket_details b', 'b.ticket_id = a.ticket_id');
		if(!empty($_POST['customer_id']) && $_POST['customer_id']!=''){
			$this->db->where('a.customer_id', $_POST['customer_id']);
		}
		if(!empty($_POST['product_id']) && $_POST['product_id']!=''){
			$this->db->where('b.product_id', $_POST['product_id']);
        }
        $this->db->where('a.r_id',$r_id);
        $this->db->where('b.r_id',$r_id);
        $this->db->order_by('a.ticket_date', 'desc');
        $this->db->order_by('a.ticket_id', 'desc');
        $query = $this->db->get();

        $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //purchase List
	public function ticket_list($per_page, $page,$r_id) {
        // echo $per_page; 
        // echo "<br>page ".$page;
        // echo "<br>r_id ".$r_id;
//    print_r($page);die;
		/* 
       $this->db->select('a.*,c.customer_name, pi.product_name, SUM(ppo.picked_quantity) as totalpicked_quantity, sum(`ptd`.`quantity`) as quantity');
        $this->db->from('product_ticket a');
        $this->db->join('product_picking_order ppo', 'ppo.ticket_id = a.ticket_id', 'left');
        $this->db->join('customer_information c', 'c.customer_id = a.customer_id');        		
		$this->db->join('product_ticket_details ptd', 'ptd.ticket_id = a.ticket_id');		        
		if(!empty($_POST['customer_id']) && $_POST['customer_id']!=''){
			$this->db->where('a.customer_id', $_POST['customer_id']);
		}
		if(!empty($_POST['product_id']) && $_POST['product_id']!=''){
			$this->db->where('ptd.product_id', $_POST['product_id']);
		}
		$this->db->join('product_information pi', 'ptd.product_id = pi.product_id');
        $this->db->order_by('a.ticket_date', 'desc');
        $this->db->order_by('ticket_id', 'desc');
		$this->db->group_by('ptd.ticket_id');
		
        $this->db->limit($per_page, $page);
        $query = $this->db->get(); 
		 */
		/* echo $this->db->last_query();die;  */
		 
		 
		$this->db->query("truncate table tbl_ptqty");
		/* $this->db->query("insert into tbl_ptqty(id, ticket_id, chalan_no, ship_to, customer_id, grand_total_amount, ticket_date,ticket_detatils,status,ship_date,customer_po,ship_method,created_at,customer_name, product_name,totalpicked_quantity,quantity)(SELECT `a`.*, `c`.`customer_name`, `pi`.`product_name`, SUM(ppo.picked_quantity) as totalpicked_quantity, sum(`ptd`.`quantity`) as quantity FROM `product_ticket` `a` LEFT JOIN `product_picking_order` `ppo` ON `ppo`.`ticket_id` = `a`.`ticket_id`  JOIN `customer_information` `c` ON `c`.`customer_id` = `a`.`customer_id` JOIN `product_ticket_details` `ptd` ON `ptd`.`ticket_id` = `a`.`ticket_id` and ppo.product_id = ptd.product_id JOIN `product_information` `pi` ON `ptd`.`product_id` = `pi`.`product_id` GROUP BY `ptd`.`ticket_id` ORDER BY `a`.`ticket_date` DESC, `ticket_id` DESC)");
		 */
        
//   echo "insert into tbl_ptqty(id,r_id, ticket_id, chalan_no, ship_to, customer_id, grand_total_amount, ticket_date,ticket_detatils,status,ship_date,customer_po,ship_method,created_at,customer_name, product_name,totalpicked_quantity,quantity)(SELECT a.id, ".$r_id.", a.ticket_id, a.chalan_no, a.ship_to, a.customer_id, a.grand_total_amount, a.ticket_date, a.ticket_details, a.status, a.ship_date, a.customer_po, a.ship_method,a.created_at, `c`.`customer_name`, `pi`.`product_name`, SUM(ppo.picked_quantity) as totalpicked_quantity, sum(`ptd`.`quantity`) as quantity FROM `product_ticket` `a` LEFT JOIN `product_picking_order` `ppo` ON `ppo`.`ticket_id` = `a`.`ticket_id` JOIN `customer_information` `c` ON `c`.`customer_id` = `a`.`customer_id` JOIN `product_ticket_details` `ptd` ON `ptd`.`ticket_id` = `a`.`ticket_id` JOIN `product_information` `pi` ON `ptd`.`product_id` = `pi`.`product_id` GROUP BY `ptd`.`ticket_id` ORDER BY `a`.`ticket_date` DESC, `ticket_id` DESC)";die;

        $this->db->query("insert into tbl_ptqty(id,r_id, ticket_id, chalan_no, ship_to, customer_id, grand_total_amount, ticket_date,ticket_detatils,status,ship_date,customer_po,ship_method,created_at,customer_name, product_name,totalpicked_quantity,quantity)(SELECT a.id, a.r_id, a.ticket_id, a.chalan_no, a.ship_to, a.customer_id, a.grand_total_amount, a.ticket_date, a.ticket_details, a.status, a.ship_date, a.customer_po, a.ship_method,a.created_at, `c`.`customer_name`, `pi`.`product_name`, SUM(ppo.picked_quantity) as totalpicked_quantity, sum(`ptd`.`quantity`) as quantity FROM `product_ticket` `a` LEFT JOIN `product_picking_order` `ppo` ON `ppo`.`ticket_id` = `a`.`ticket_id` JOIN `customer_information` `c` ON `c`.`customer_id` = `a`.`customer_id` JOIN `product_ticket_details` `ptd` ON `ptd`.`ticket_id` = `a`.`ticket_id` JOIN `product_information` `pi` ON `ptd`.`product_id` = `pi`.`product_id` GROUP BY `ptd`.`ticket_id` ORDER BY `a`.`ticket_date` DESC, `ticket_id` DESC)");





       // echo "hello";

        // $this->db->query("SELECT `a`.*, `c`.`customer_name`, `pi`.`product_name`, SUM(ppo.picked_quantity) as totalpicked_quantity, sum(`ptd`.`quantity`) as quantity FROM `product_ticket` `a` LEFT JOIN `product_picking_order` `ppo` ON `ppo`.`ticket_id` = `a`.`ticket_id` JOIN `customer_information` `c` ON `c`.`customer_id` = `a`.`customer_id` JOIN `product_ticket_details` `ptd` ON `ptd`.`ticket_id` = `a`.`ticket_id` JOIN `product_information` `pi` ON `ptd`.`product_id` = `pi`.`product_id` GROUP BY `ptd`.`ticket_id` ORDER BY `a`.`ticket_date` DESC, `ticket_id` DESC");
    
		
         $this->db->query("UPDATE tbl_ptqty p,( SELECT ticket_id, sum(picked_quantity)  as mysum FROM product_picking_order GROUP by ticket_id) as s   SET p.totalpicked_quantity= s.mysum  WHERE p.ticket_id = s.ticket_id");

         $query1= $this->db->query("UPDATE tbl_ptqty p,(select ticket_id,sum(total_quantity) as mysum from product_ticket_details GROUP by ticket_id) as s   SET p.quantity  = s.mysum  WHERE p.ticket_id = s.ticket_id");
        

		/* if(!empty($_POST['customer_id']) && $_POST['customer_id']!=''){
			
			$this->db->query("insert into tbl_ptqty(id, ticket_id, chalan_no, ship_to, customer_id, grand_total_amount, ticket_date,ticket_detatils,status,ship_date,customer_po,ship_method,created_at,customer_name, product_name,totalpicked_quantity,quantity)(SELECT `a`.*, `c`.`customer_name`, `pi`.`product_name`, SUM(ppo.picked_quantity) as totalpicked_quantity, sum(`ptd`.`quantity`) as quantity FROM `product_ticket` `a` LEFT JOIN `product_picking_order` `ppo` ON `ppo`.`ticket_id` = `a`.`ticket_id` JOIN `customer_information` `c` ON `c`.`customer_id` = `a`.`customer_id` JOIN `product_ticket_details` `ptd` ON `ptd`.`ticket_id` = `a`.`ticket_id` JOIN `product_information` `pi` ON `ptd`.`product_id` = `pi`.`product_id` GROUP BY `ptd`.`ticket_id` ORDER BY `a`.`ticket_date` DESC, `ticket_id` DESC)");
			
			
			$this->db->where('a.customer_id', $_POST['customer_id']);
		}
		 */
		// print_r("insert into tbl_ptqty(id,r_id, ticket_id, chalan_no, ship_to, customer_id, grand_total_amount, ticket_date,ticket_detatils,status,ship_date,customer_po,ship_method,created_at,customer_name, product_name,totalpicked_quantity,quantity)SELECT `a`.*, `c`.`customer_name`, `pi`.`product_name`, SUM(ppo.picked_quantity) as totalpicked_quantity, sum(`ptd`.`quantity`) as quantity FROM `product_ticket` `a` LEFT JOIN `product_picking_order` `ppo` ON `ppo`.`ticket_id` = `a`.`ticket_id` JOIN `customer_information` `c` ON `c`.`customer_id` = `a`.`customer_id` JOIN `product_ticket_details` `ptd` ON `ptd`.`ticket_id` = `a`.`ticket_id` JOIN `product_information` `pi` ON `ptd`.`product_id` = `pi`.`product_id` GROUP BY `ptd`.`ticket_id` ORDER BY `a`.`ticket_date` DESC, `ticket_id` DESC");die;
		
		// if(!empty($_POST['product_id']) && $_POST['product_id']!=''){
		// 	$this->db->where('ptd.product_id', $_POST['product_id']);
        // }
        // echo "hello";
        // print_r($r_id);die;
		$this->db->select('*');
        $this->db->from('tbl_ptqty'); 
		$this->db->where('r_id',$r_id);
        $this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $page);
        $query = $this->db->get();
        // print_r($this->db->last_query());die;
        // echo $this->db->last_query(); die;
		/* $this->db->group_by('ptd.ticket_detail_id'); */
		
		
		/* $query = $this->db->query("call STR_PT_qtysum()");  */
		
		/* $query->next_result();  */
		/* $query->free_result();  */

		/* print_r($query->result_array());die; */
		
       /* echo $last_query = $this->db->last_query();die; */
    //    print_r($query->num_rows());die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Select All Supplier List
    public function select_all_supplier($r_id) {
        $query = $this->db->select('*')
                ->from('supplier_information')
                ->where('status', '1')
                ->where('r_id',$r_id)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //purchase Search  List
    public function ticket_by_search($supplier_id) {
        $this->db->select('a.*,b.supplier_name');
        $this->db->from('product_ticket a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->where('b.supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Count purchase
    public function ticket_entry($r_id) {
             #echo "<pre>";	print_r($_POST);
             
             $ship_to = $this->input->post('sub');
             $totalAddress = $this->input->post('totalAddress');
             $ship_name = $this->input->post('shipName');
             $customer_id = $this->input->post('customer_id');
	$i = 0;
	foreach($_POST['locations'] as $loctn){
		$value = explode("###", $loctn);
		$query = "SELECT SUM(purchase_receipt_order.total_quantity) as total_quantity, product_information.product_name FROM purchase_receipt_order JOIN inventory_locations ON inventory_locations.label = purchase_receipt_order.label LEFT JOIN product_information ON purchase_receipt_order.product_id = product_information.product_id WHERE purchase_receipt_order.r_id ='".$r_id."' AND inventory_locations.product_id = '".$value[1]."' AND inventory_locations.location_unique_key = '".$value[0]."'";
		// print_r($query);die;
		$query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            $total = $query->result_array();
			if($_POST['each_quantity'][$i] > $total[0]['total_quantity']){
				$this->session->set_userdata(array('error_message' => $total[0]['product_name']." on this location has only ".$total[0]['total_quantity']." quantity remaining."));
                redirect('Cticket');
			}
        }
		$i++;
	}
	
			
		$ticket_id = $this->input->post('ticket_id');
        $data = array(
            'r_id'=>$r_id,
            'ticket_id' => $this->input->post('ticket_id'),
           // 'chalan_no' => $this->input->post('chalan_no'),
            'ship_to' => json_encode($this->input->post('ship_to')),
            'customer_id' => $this->input->post('customer_id'),
            //'grand_total_amount' => $this->input->post('grand_total_price'),
            'ticket_date' => $this->input->post('ticket_date'),
            'ticket_details' => $this->input->post('receipt_details'),
            'status' => 1,
            'ship_date' => $this->input->post('ship_date'),
            'customer_po' => $this->input->post('customer_po'),
            'ship_method' => ($this->input->post('ship_method')? join(",", $this->input->post('ship_method')) : ""),
        );

		$this->db->insert('product_ticket', $data);
        $insert_idP = $this->db->insert_id();
        
     

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

        $quantity = $this->input->post('each_quantity');
        $entered_quantity = 'EACH';
        $total = $this->input->post('each_quantity');
        $p_id = $this->input->post('product_id');		        
		$location = $this->input->post('locations');	
		$locationsQty = $this->input->post('locationsQty');	
        $unit = $this->input->post('unit');	
        
       
        $new =substr($locationsQty[0], 1, -1);
        


        for ($j = 0; $j < count($p_id); $j++) {
            $each_quantity = $quantity[$j];
            $unit_quantity = $quantity[$j];
            $total_quanitity = $total[$j];
            $product_id = $p_id[$j];
            $units = $unit[$j];							
			$loc = explode("###", $location[$j]);			
			$loc = $loc[0];
			#if($loc!="" && $unit!="" && $product_quantity!=""){
            $data1 = array(
                'r_id'=>$r_id,				
				'location' => $loc,
                'ticket_detail_id' => $this->generator(15),
                'ticket_id' => $ticket_id,
                'product_id' => $product_id,
                'each_quantity' => $each_quantity,
                'quantity' => $unit_quantity,
                'total_quantity' => $total_quanitity, 
                'status' => 1,
				'unit'	=> $entered_quantity
            );
            if (!empty($quantity)) {
                $this->db->insert('product_ticket_details', $data1);
            }
			#}
        }




            // print_r($new);
            // die();

		// for ($j = 0; $j < count($p_id); $j++) {
		// 	$someArray = json_decode($locationsQty[0], true);
		// $totalEach = 1;
		// if($unit[$j] =='PALLET'){
		// 	if($someArray['PALLET'])
		// 	$totalEach = $totalEach*$someArray['PALLET'];
		
		// 	if($someArray['CARTON'])
		// 	$totalEach = $totalEach*$someArray['CARTON'];
		
		// 	if($someArray['INNER_CART'])
		// 	$totalEach = $totalEach*$someArray['INNER_CART'];
		
		// 	if($someArray['EACH'])
		// 	$totalEach = $totalEach*$someArray['EACH'];
		// }
		
		// if($unit[$j] =='CARTON'){
		// 	if($someArray['CARTON'])
		// 	$totalEach = $totalEach*$someArray['CARTON'];
		
		// 	if($someArray['INNER_CART'])
		// 	$totalEach = $totalEach*$someArray['INNER_CART'];
		
		// 	if($someArray['EACH'])
		// 	$totalEach = $totalEach*$someArray['EACH'];
		// }
		
		// if($unit[$j] =='INNER_CART'){
			
		// 	if($someArray['INNER_CART'])
		// 	$totalEach = $totalEach*$someArray['INNER_CART'];
		
		// 	if($someArray['EACH'])
		// 	$totalEach = $totalEach*$someArray['EACH'];
		// }
		
		// if($unit[$j] =='EACH'){
					
		// 	if($someArray['EACH'])
		// 	$totalEach = $totalEach*$someArray['EACH'];
		// }
		
			
        //     // print_r($someArray);
        //     //  die();

        //     // print_r($new);
        //     // die();
             
          
		// 	$each_quantity = $quantity[$j];
        //     $product_id = $p_id[$j];
        //     $units = $unit[$j];							
		// 	$loc = explode("###", $location[$j]);			
		// 	$loc = $loc[0];
		// 	$unitType = explode('{',$locationsQty[0]);
		// 	$unitTypeRes = explode(':',$unitType[1]);
		// 	/* print_r($unitTypeRes[0]); */
		
		
		// 	#if($loc!="" && $unit!="" && $product_quantity!=""){
        //     $data1 = array(				
		// 		'location' => $loc,
        //         'ticket_detail_id' => $this->generator(15),
        //         'ticket_id' => $ticket_id,
        //         'product_id' => $product_id,
        //         'quantity' => $entered_quantity,
        //         'each_quantity' => $each_quantity,
        //         'status' => 1,
		// 		'unit'	=> $units,
        //         'total_quantity' => $total,
        //         // 'picking_details' => $new
        //     );
        //     if (!empty($quantity)) {
        //         $this->db->insert('product_ticket_details', $data1);
        //     }
		// 	#}
        // }
		#die;
         $query = $this->db->query("call STR_updateTicketnumber('".$ticket_id."',".$insert_idP.")");
         
           // add code to insert data in Pt_ship_address

       
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('customer_address', $ship_to);
        $this->db->where('customer_id', $this->input->post('customer_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
           //do nothing
            
        }
        else{
            
           
          // print_r($value[0]['purchase_id']);die;
          $ptPurchase = $this->db->select('ticket_id')
          ->get_where('product_ticket', array('id' => $insert_idP))
          ->row()
          ->ticket_id;

            $data1 = array(
                'r_id'=>$r_id,
                'customer_id'=>$customer_id,
                'ticket_id'=>$ptPurchase,
                'ship_name'=>$ship_name,
                'ship_address'=>$totalAddress
            );
            $this->db->insert('pt_ship_address', $data1);
        }
        // end code 
        return true;
    }

    //Retrieve purchase Edit Data
    public function retrieve_ticket_editdata($purchase_id) {
       /*  $this->db->select('a.*,
						b.*,
						c.product_id,
						c.product_name,
						c.product_model,
						c.cartoon_quantity,
						c.product_details,
						
						
                        e.customer_name'
        );
        $this->db->from('product_ticket a');
        $this->db->join('product_ticket_details b', 'b.ticket_id =a.ticket_id');
        $this->db->join('product_information c', 'c.product_id =b.product_id');
        #$this->db->join('supplier_information d', 'd.supplier_id = a.supplier_id');
        $this->db->join('customer_information e', 'e.customer_id = a.customer_id');
        $this->db->where('a.ticket_id', $purchase_id);
        $this->db->order_by('a.ticket_details', 'asc');
        $query = $this->db->get(); */
		
		$query = $this->db->query("SELECT a.id,a.ticket_id,a.chalan_no,a.ship_to,a.customer_id,a.grand_total_amount,a.ticket_date,a.ticket_details,a.status,a.ship_date,a.customer_po,GROUP_CONCAT(shm.shipping_name) as ship_method,a.created_at,b.id,b.ticket_detail_id,b.ticket_id,b.product_id,b.quantity,b.each_quantity,b.total_quantity,b.unit,b.location,b.rate,b.total_amount,b.status,b.picking_status,b.picking_details,b.created_at,b.is_deleted,c.product_id, c.product_name, c.product_model, c.cartoon_quantity, c.product_details,e.customer_name FROM product_ticket_details b,product_information c,shipping_method as shm,product_ticket a left join customer_information e on e.customer_id = a.customer_id where b.ticket_id =a.ticket_id and a.ticket_id =  '".$purchase_id."' and c.product_id =b.product_id and FIND_IN_SET(shm.id, a.ship_method) GROUP by b.id ORDER BY a.ticket_details ASC");
		
		
		
		/* SELECT a.*, b.*,c.product_id, c.product_name, c.product_model, c.cartoon_quantity, c.product_details,e.customer_name FROM product_ticket_details b,product_information c,product_ticket a left join customer_information e on e.customer_id = a.customer_id where b.ticket_id =a.ticket_id and a.ticket_id = '".$purchase_id."' and c.product_id =b.product_id ORDER BY a.ticket_details ASC
		 */
		
		/* 
		 echo $last_query = $this->db->last_query();
		 die; */
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


// print detail data

// public function ticket_details_data($ticket_id) {
//     $this->db->select('a.*,b.*,c.*,ci.*, e.purchase_details,d.product_id,d.product_name,d.product_model,d.cartoon_quantity, d.product_details, ci.customer_address');
//     $this->db->from('product_ticket a');
//     $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
//     $this->db->join('customer_information ci', 'ci.customer_id = a.customer_id');
//     $this->db->join('product_purchase_details c', 'c.purchase_id = a.purchase_id');
//     $this->db->join('product_information d', 'd.product_id = c.product_id');
//     $this->db->join('product_purchase e', 'e.purchase_id = c.purchase_id');
    
//     $this->db->where('a.ticket_id', $ticket_id);
//     $query = $this->db->get();
//     if ($query->num_rows() > 0) {
//         return $query->result_array();
//     }
//     return false;
// }


/* public function ticket_details_data($ticket_id) {
$query = $this->db->query("select * from product_information where product_id in (select product_id from product_ticket_details where ticket_id = '".$ticket_id."')");
// print_r("select * from product_information where product_id in (select product_id from product_ticket_details where ticket_id = '".$ticket_id."')");
// die();

    // $this->db->where('ticket_id', $ticket_id);

    // $query = $this->db->get();
//    print_r($query);
//     die(); 
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
} */



public function ticket_details_data($ticket_id) {
// $query = $this->db->query("select * from product_information where product_id in (select product_id from product_ticket_details where ticket_id = '".$ticket_id."')");
/*
$this->db->select('a.*,b.product_details, b.product_name, c.customer_address , c.customer_name');
$this->db->from('product_ticket_details a');
$this->db->join('product_information b','b.product_id = a.product_id');
 $this->db->join('customer_information c','c.status= a.status');

$this->db->where('a.ticket_id', $ticket_id);
$this->db->group_by('a.id');

$query = $this->db->get();
*/ 

$query = $this->db->query("select DISTINCT a.*,b.product_details, b.product_name, c.customer_name,e.ship_address as customer_address,e.ship_name as ship_name from product_ticket_details as a,product_ticket as d,product_information as b,customer_information as c,pt_ship_address as e where a.product_id= b.product_id  and a.ticket_id = d.ticket_id and d.customer_id = c.customer_id and e.ticket_id = d.ticket_id and  d.ticket_id = '".$ticket_id."'");


if($query->num_rows() > 0){
    return array($query->result_array(),1);
}
else{



$query = $this->db->query("select DISTINCT a.*,b.product_details, b.product_name, c.customer_address , c.customer_name from product_ticket_details as a,product_ticket as d,product_information as b,customer_information as c where a.product_id= b.product_id  and a.ticket_id = d.ticket_id and d.customer_id = c.customer_id and  d.ticket_id = '".$ticket_id."'");



// print_r($query);
// die(); 
if ($query->num_rows() > 0) {
return array($query->result_array(),0);
}
return false;
}
}
// getting picking data
    public function picking_details_data($ticket_id){

        $query = $this->db->query("select DISTINCT *,concat(e.customer_address,', ',cities.name,' ,', st.name,', ',e.zip) as customer_addressFull from product_picking_order as a,product_information as b,product_ticket_details as c,product_ticket as d,customer_information as e,states as st,cities where c.product_id = a.product_id and a.ticket_id = c.ticket_id and b.product_id = a.product_id and c.ticket_id=d.ticket_id and d.customer_id = e.customer_id and c.ticket_id = '".$ticket_id."'  and st.id = e.state and cities.id = e.city and label != ''");
	// print_r($this->db->last_query());die;
		
		
		/* select DISTINCT a.*,b.product_details, b.product_name,  , c.customer_name from product_ticket_details as a,product_ticket as d,product_information as b,customer_information as c,states as st,cities where a.product_id= b.product_id  and a.ticket_id = d.ticket_id and d.customer_id = c.customer_id and  d.ticket_id = 'pt1009' and st.id = e.state and cities.id = e.city */
		
		/* 
 'PT1016' */
        //  $this->db->select("a.*, b.product_name,b.product_details");
        //  $this->db->from("product_picking_order a");
        //  $this->db->join("product_information", "b.product_id = a.product_id ");
        //  $this->db->where('a.ticket_id', $ticket_id);

        //  $query = $this->db->get();

    //    $query = $this->db->query("select DISTINCT a.*,b.product_details, b.product_name, c.customer_address , c.customer_name, e.label from product_ticket_details as a,product_ticket as d,product_information as b,customer_information as c, inventory_locations as e where a.product_id= b.product_id and a.product_id = e.product_id and a.ticket_id = d.ticket_id and d.customer_id = c.customer_id and  d.ticket_id = '".$ticket_id."' ORDER BY location_unique_key");

        // $query = $this->db->query("select DISTINCT a.*,b.product_details, b.product_name, c.customer_address , c.customer_name from product_ticket_details as a,product_ticket as d,product_information as b,customer_information as c where a.product_id= b.product_id  and a.ticket_id = d.ticket_id and d.customer_id = c.customer_id and  d.ticket_id = '".$ticket_id."'");
        
        // print_r("select a.*,b.product_details, b.product_name, c.customer_address , c.customer_name from product_ticket_details as a,product_ticket as d,product_information as b,customer_information as c where a.product_id= b.product_id  and a.ticket_id = d.ticket_id and d.customer_id = c.customer_id and  d.ticket_id = '".$ticket_id."'");
        // die();
        // print_r($query);
        // die(); 
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
    public function update_ticket() {
		#echo "<pre>";print_r($_POST);die;
        $ticket_id = $this->input->post('ticket_id');

        $data = array(
            //'supplier_id' => $this->input->post('supplier_id'),
            'customer_id' => $this->input->post('customer_id'),
            'ship_date' => $this->input->post('ship_date'),
            'ship_to' => json_encode($this->input->post('ship_to')),
            'customer_po' => $this->input->post('customer_po'),
            'ship_method' => $this->input->post('ship_method'),
            'grand_total_amount' => $this->input->post('grand_total_price'),
            'ticket_date' => $this->input->post('ticket_date')
        );

        if ($ticket_id != '') {
            $this->db->where('ticket_id', $ticket_id);
            $this->db->update('product_ticket', $data);
        }

        $rate = $this->input->post('product_rate');
        $p_id = $this->input->post('product_id');
        $quantity = $this->input->post('product_quantity');
        $t_price = $this->input->post('total_price');
        $purchase_d_id = $this->input->post('ticket_detail_id');
        $locations = $this->input->post('locations');

        for ($i = 0, $n = count($purchase_d_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
            $purchase_detail_id = $purchase_d_id[$i];
            $location = $locations[$i];
			$locarr = explode("###", $location);
            $data1 = array(
                'product_id' => $product_id,
                'quantity' => $product_quantity,
                'rate' => $product_rate,
                'total_amount' => $total_price,
				'location'	=> $locarr[0]
            );


            if (($quantity)) {
                $this->db->where('ticket_detail_id', $purchase_detail_id);
                $this->db->update('product_ticket_details', $data1);
            }
        }
        return true;
    }

    // Delete purchase Item
    public function delete_ticket($ticket_id) {
        //Delete product_purchase table
        $this->db->where('ticket_id', $ticket_id);
        $this->db->delete('product_ticket');
        //Delete product_purchase_details table
         $this->db->where('ticket_id', $ticket_id);
        $this->db->delete('product_ticket_details');
        return true;
    }

    public function ticket_search_list($cat_id, $company_id) {
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
    public function receipt_details_data($ticket_id) {
        $this->db->select('a.*,b.*,c.*,e.receipt_details,d.product_id,d.product_name,d.product_model,d.cartoon_quantity');
        $this->db->from('product_ticket a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->join('product_ticket_details c', 'c.ticket_id = a.ticket_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->join('product_ticket e', 'e.ticket_id = c.ticket_id');
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
	
	public function checkCustomePO($customer_po){
		$this->db->select('*');

        $this->db->from('product_ticket');

        $this->db->where('customer_po', $customer_po);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

        }

        return false;
	}
	
	
	public function checkCustomeID($venderrid){
		$this->db->select('*');

        $this->db->from('product_purchase');

        $this->db->where('supplier_id', $venderrid);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

			// SELECT customer_id FROM `` where supplier_id='GZD4S3NBBEC8HTAHLRM9' 
        }

        return false;
	}
	
	
	public function product_search_by_customer_details($product_id){
		$this->db->select('*');

        $this->db->from('product_information');

        $this->db->where('product_id', $product_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->result_array();

			// SELECT customer_id FROM `` where supplier_id='GZD4S3NBBEC8HTAHLRM9' 
        }

        return false;
	}

}