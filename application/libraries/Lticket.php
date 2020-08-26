<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lticket {
	// Retrieve  Quize List From DB
	public function ticket_list($links,$per_page,$page,$r_id)
	{
		$CI =& get_instance();
		
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
		$CI->load->model('Purchases');
		$CI->load->model('Customers');
		$CI->load->model('Tickets');
		
		$customer_list = $CI->Customers->all_customer_list($r_id);
		// print_r($customer_list);
		// die;
		
		$all_product = $CI->Purchases->all_product_list($r_id);
		$all_customerPO = $CI->Purchases->all_customerPO_list($r_id);
		// print_r($all_product);
		// die;
		
		
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		
		$ticket_list = $CI->Tickets->ticket_list($per_page,$page,$r_id);

		// echo 1;
		 
				
		if(!empty($ticket_list)){	
			$j=0;
			foreach($ticket_list as $k=>$v){
				$ticket_list[$k]['final_date'] = $CI->occational->dateConvert($ticket_list[$j]['ticket_date']);
			  $j++;
			}
		
			$i=0;
			foreach($ticket_list as $k=>$v){$i++;
			   $ticket_list[$k]['sl']=$i;
			}
		}
		
		$data = array(
				'title' => 'Pick Ticket List',
				'receipt_list' => $ticket_list,
				'links' => $links,
				'currency' => $currency_details[0]['currency'],
				'position' => $currency_details[0]['currency_position'],
				'all_supplier'=> $customer_list,
				'all_product'=> $all_product,
				'all_customerPO' => $all_customerPO
				
			);
		// echo "<pre>";print_r($data);die;	
			
		$purchaseList = $CI->parser->parse('ticket/ticket',$data,true);
		return $purchaseList;
	}
	//Purchase Item By Search
	public function ticket_by_search($supplier_id)
	{
		$CI =& get_instance();
		$CI->load->model('Tickets');
		$CI->load->library('occational');
		$ticket_list = $CI->Tickets->ticket_by_search($supplier_id);
		$j=0;
		if(!empty($ticket_list)){
			foreach($ticket_list as $k=>$v){
				$ticket_list[$k]['final_date'] = $CI->occational->dateConvert($ticket_list[$j]['ticket_date']);
			  $j++;
			}
			$i=0;
			foreach($ticket_list as $k=>$v){$i++;
			   $ticket_list[$k]['sl']=$i;
			}
		}
		$data = array(
				'tickets_list' => $ticket_list
			);
		$purchaseList = $CI->parser->parse('ticket/ticket',$data,true);
		return $purchaseList;
	}
	//Sub Category Add
	public function ticket_add_form($r_id)
	{
		$CI =& get_instance();
		$CI->load->model('Tickets');
		$CI->load->model('Customers');
		$CI->load->model('Shipping');
		$CI->load->model('Products');
		$all_supplier = $CI->Tickets->select_all_supplier($r_id);
		$all_customer = $CI->Customers->all_customer_list($r_id);
		$all_shipping = $CI->Shipping->all_shipping_list($r_id);
		$all_product = $CI->Products->all_product_list($r_id);
		
		$data = array(
				'title' => 'Add Tickets',
				'all_supplier' => $all_supplier,
				'all_customer' => $all_customer,
				'all_shipping' => $all_shipping,
				'all_product' => $all_product
			);
		$purchaseForm = $CI->parser->parse('ticket/add_ticket_form',$data,true);
		return $purchaseForm;
	}
	public function insert_ticket($data)
	{
		$CI =& get_instance();
		$CI->load->model('Tickets');
        $CI->Tickets->ticket_entry($data);
		return true;
	}
	//purchase Edit Data
	public function ticket_edit_data($receipt_id)
	{
		$CI =& get_instance();
		$CI->load->model('Tickets');
		$CI->load->model('Suppliers');
		$CI->load->model('Customers');

		$ticket_detail = $CI->Tickets->retrieve_ticket_editdata($receipt_id);
		#$supplier_id = $ticket_detail[0]['supplier_id'];
		$customer_id = $ticket_detail[0]['customer_id'];
		$supplier_list=$CI->Suppliers->supplier_list("110","0");
		#$supplier_selected=$CI->Suppliers->supplier_search_item($supplier_id);
		$customer_selected=$CI->Customers->customer_search_item($customer_id);
		if(!empty($ticket_detail)){
			foreach($ticket_detail as $k=>$val){
				if(!empty($val['cartoon_quantity']))
				$ticket_detail[$k]['cartoon'] = ($val['quantity']/$val['cartoon_quantity']);
			}
			$i=0;
			foreach($ticket_detail as $k=>$v){$i++;
			   $ticket_detail[$k]['sl']=$i;
			}
		}
		$data=array(
			'title'				=>	"Ticket edit",
			'ticket_id'		=>	$ticket_detail[0]['ticket_id'],
			'chalan_no'			=>	$ticket_detail[0]['chalan_no'],
			#'supplier_name'		=>	$ticket_detail[0]['supplier_name'],
			'customer_name'		=>	$ticket_detail[0]['customer_name'],
			'ship_to'		=>	$ticket_detail[0]['ship_to'],
			'customer_id'		=>	$ticket_detail[0]['customer_id'],
			'grand_total'		=>	$ticket_detail[0]['grand_total_amount'],
			'ticket_details'	=>	$ticket_detail[0]['ticket_details'],
			'ticket_date'		=>	$ticket_detail[0]['ticket_date'],
			'ship_date'		=>	$ticket_detail[0]['ship_date'],
			'customer_po'		=>	$ticket_detail[0]['customer_po'],
			'ship_method'		=>	$ticket_detail[0]['ship_method'],
			'unit'		=>	$ticket_detail[0]['unit'],
			'purchase_info'		=>	$ticket_detail,
			#'supplier_list'		=>	$supplier_list,
			#'supplier_selected'	=>	$supplier_selected,

			);
		#echo "<pre>";print_r($data);die;
		$chapterList = $CI->parser->parse('ticket/edit_ticket_form',$data,true);
		return $chapterList;
	}
	//Search purchase
	public function ticket_search_list($cat_id,$company_id)
	{
		$CI =& get_instance();
		$CI->load->model('Tickets');
		$category_list = $CI->ticket_date->retrieve_category_list();
		$purchases_list = $CI->ticket_date->ticket_search_list($cat_id,$company_id);
		$data = array(
				'title' => 'Tickets List',
				'purchases_list' => $purchases_list,
				'category_list' => $category_list
			);
		$purchaseList = $CI->parser->parse('ticket/ticket',$data,true);
		return $purchaseList;
	}
	//Purchase html Data
	
	public function ticket_details_data($ticket_id)
	{
	
		$CI =& get_instance();
		$CI->load->model('Tickets');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
	
		$ticket_detail1 = $CI->Tickets->ticket_details_data($ticket_id);
		$ticket_detail = $ticket_detail1[0];
		if(!empty($ticket_detail)){
		 	$i = 0;
		 	foreach($ticket_detail as $k=>$v){
				 $i++;
		 	   $ticket_detail[$k]['sl']=$i;
	
		 	}
			
	
			
		 }
		// $currency_details = $CI->Web_settings->retrieve_setting_editdata();
		// $company_info = $CI->Tickets->retrieve_company();

		if($ticket_detail1[1]){
			$data=array(
				'ticket_id'		=>	$ticket_detail[0]['ticket_id'],
			   // 'ticket_details_id'	=>	$ticket_detail[0]['ticket_details_id'],
			   'product_name' => $ticket_detail[0]['product_name'],
			   'product_details' => $ticket_detail[0]['product_details'],
			   'customer_name' => $ticket_detail[0]['customer_name'],
			   'customer_address' => $ticket_detail[0]['customer_address'],
			   'ship_name' => $ticket_detail[0]['ship_name'],
			   'location'  =>$ticket_detail[0]['location'],
			   'unit'  => $ticket_detail[0]['unit'],
			   'quantity' => $ticket_detail[0]['quantity'],
			   // 'supplier_name'		=>	$ticket_detail[0]['supplier_name'],
		   //	 'final_date'		=>	$ticket_detail[0]['convert_date'],
			   // 'sub_total_amount'	=>	number_format($purchase_detail[0]['grand_total_amount'], 2, '.', ','),
			   // 'chalan_no'			=>	$ticket_detail[0]['chalan_no'],
				'ticket_all_data'	=>	$ticket_detail,
			   // 'company_info'		=>	$company_info,
			   // 'currency' 			=> $currency_details[0]['currency'],
			   // 'position' 			=> $currency_details[0]['currency_position'],
			   );
		}
		else{
			$data=array(
				'ticket_id'		=>	$ticket_detail[0]['ticket_id'],
			   // 'ticket_details_id'	=>	$ticket_detail[0]['ticket_details_id'],
			   'product_name' => $ticket_detail[0]['product_name'],
			   'product_details' => $ticket_detail[0]['product_details'],
			   'customer_name' => $ticket_detail[0]['customer_name'],
			   'customer_address' => $ticket_detail[0]['customer_address'],
			   'ship_name' => $ticket_detail[0]['customer_name'],
			   'location'  =>$ticket_detail[0]['location'],
			   'unit'  => $ticket_detail[0]['unit'],
			   'quantity' => $ticket_detail[0]['quantity'],
			   // 'supplier_name'		=>	$ticket_detail[0]['supplier_name'],
		   //	 'final_date'		=>	$ticket_detail[0]['convert_date'],
			   // 'sub_total_amount'	=>	number_format($purchase_detail[0]['grand_total_amount'], 2, '.', ','),
			   // 'chalan_no'			=>	$ticket_detail[0]['chalan_no'],
				'ticket_all_data'	=>	$ticket_detail,
			   // 'company_info'		=>	$company_info,
			   // 'currency' 			=> $currency_details[0]['currency'],
			   // 'position' 			=> $currency_details[0]['currency_position'],
			   );
		}
	

			// print_r($ticket_detail);
			// die();
	
		$chapterList = $CI->parser->parse('ticket/ticket_detail',$data,true);
		return $chapterList;
	}



public function picking_details_data($ticket_id){
	$CI =& get_instance();
	$CI->load->model('Tickets');
	$CI->load->model('Web_settings');
	$CI->load->library('occational');

	$ticket_detail = $CI->Tickets->picking_details_data($ticket_id);
	
	if(!empty($ticket_detail)){
		$i = 0;
		foreach($ticket_detail as $k=>$v){
			$i++;
			 $ticket_detail[$k]['sl']=$i;

		}
	 

	 
	}

	$data = array(
		'ticket_id'		=>	$ticket_detail[0]['ticket_id'],
		'product_name' => $ticket_detail[0]['product_name'],
		'customer_name' => $ticket_detail[0]['customer_name'],
	  'customer_address' => $ticket_detail[0]['customer_addressFull'],
		'product_details' => $ticket_detail[0]['product_details'],
		'label' =>  $ticket_detail[0]['label'],
		'ticket_all_data'	=>	$ticket_detail,

	);

	$chapterList = $CI->parser->parse('ticket/picking_detail',$data,true);
	return $chapterList;

}

}
?>