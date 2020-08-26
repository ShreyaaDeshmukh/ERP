<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lpurchase {
	// Retrieve  Quize List From DB
	public function purchase_list($links,$per_page,$page, $post,$r_id)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
		$purchases_list = $CI->Purchases->purchase_list($per_page,$page,$post,$r_id);
		$all_supplier = $CI->Purchases->select_all_supplier($r_id);
		$all_product = $CI->Purchases->all_product_list($r_id);
		$all_customer = $CI->Purchases->all_customer_list($r_id);
		$all_customerPO = $CI->Purchases->all_customerPO_list($r_id);
		if(!empty($purchases_list)){	
			$j=0;
			foreach($purchases_list as $k=>$v){
				$purchases_list[$k]['final_date'] = $CI->occational->dateConvert($purchases_list[$j]['purchase_date']);
			  $j++;
			}
		
			$i=0;
			foreach($purchases_list as $k=>$v){$i++;
			   $purchases_list[$k]['sl']=$i;
			}
		}
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$data = array(
				'title' => 'Purchases List',
				'purchases_list' => $purchases_list,
				'links' => $links,
				'currency' => $currency_details[0]['currency'],
				'position' => $currency_details[0]['currency_position'],
				'all_supplier' => $all_supplier,
				'all_product' => $all_product,
				'all_customer' => $all_customer,
				'all_customerPO' => $all_customerPO,
				'post' 		=> $post
			);
		#echo "<pre>";print_r($data);die;
		$purchaseList = $CI->parser->parse('purchase/purchase',$data,true);
		return $purchaseList;
	}
	//Purchase Item By Search
	public function purchase_by_search($supplier_id)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$CI->load->library('occational');
		$purchases_list = $CI->Purchases->purchase_by_search($supplier_id);
		$j=0;
		if(!empty($purchases_list)){
			foreach($purchases_list as $k=>$v){
				$purchases_list[$k]['final_date'] = $CI->occational->dateConvert($purchases_list[$j]['purchase_date']);
			  $j++;
			}
			$i=0;
			foreach($purchases_list as $k=>$v){$i++;
			   $purchases_list[$k]['sl']=$i;
			}
		}
		$data = array(
				'purchases_list' => $purchases_list
			);
		$purchaseList = $CI->parser->parse('purchase/purchase',$data,true);
		return $purchaseList;
	}
	//Sub Category Add
	public function purchase_add_form($r_id)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$CI->load->model('Customers');
		$CI->load->model('Shipping');
		$all_supplier = $CI->Purchases->select_all_supplier($r_id);
		$all_customer = $CI->Customers->all_customer_list($r_id);
		$all_shipping = $CI->Shipping->all_shipping_list($r_id);
		$all_product = $CI->Purchases->all_product_list($r_id);
		$data = array(
				'title' => 'Add Purchase',
				'all_supplier' => $all_supplier,
				'all_customer' => $all_customer,
				'all_shipping'  => $all_shipping,
				'all_product'  => $all_product,
				
			);
		#echo "<pre>";print_r($data);die;	
		$purchaseForm = $CI->parser->parse('purchase/add_purchase_form',$data,true);
		return $purchaseForm;
	}
	public function insert_purchase($data)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
        $CI->Purchases->purchase_entry($data);
		return true;
	}
	//purchase Edit Data
	public function purchase_edit_data($r_id,$purchase_id)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$CI->load->model('Suppliers');
		$CI->load->model('Customers');
		$CI->load->model('Shipping');
		$CI->load->model('Products');
		$purchase_detail = $CI->Purchases->retrieve_purchase_editdata($r_id,$purchase_id);
		$supplier_id = $purchase_detail[0]['supplier_id'];
		$customer_id = $purchase_detail[0]['customer_id'];
		$supplier_list=$CI->Suppliers->supplier_list($r_id,"110","0");
		$supplier_selected=$CI->Suppliers->supplier_search_item($r_id,$supplier_id);
		$customer_selected=$CI->Customers->customer_search_item($r_id,$customer_id);
		$all_shipping = $CI->Shipping->all_shipping_list($r_id);
		$all_product = $CI->Purchases->all_product_list_supplier($r_id,$supplier_id);
		if(!empty($purchase_detail)){
			foreach($purchase_detail as $k=>$val){
				if($val['cartoon_quantity']>0)
					$purchase_detail[$k]['cartoon'] = ($val['quantity']/$val['cartoon_quantity']);
			}
			$i=0;
			foreach($purchase_detail as $k=>$v){$i++;
			   $purchase_detail[$k]['sl']=$i;
			}
		}
		$data=array(
			'title'				=>	"Purchase edit",
			'purchase_id'		=>	$purchase_detail[0]['purchase_id'],
			'chalan_no'			=>	$purchase_detail[0]['chalan_no'],
			'supplier_name'		=>	$purchase_detail[0]['supplier_name'],
			'customer_name'		=>	$purchase_detail[0]['customer_name'],
			'supplier_id'		=>	$purchase_detail[0]['supplier_id'],
			'customer_id'		=>	$purchase_detail[0]['customer_id'],
			'grand_total'		=>	$purchase_detail[0]['grand_total_amount'],
			'purchase_details'	=>	$purchase_detail[0]['purchase_details'],
			'purchase_date'		=>	$purchase_detail[0]['purchase_date'],
			'ship_date'			=>	$purchase_detail[0]['ship_date'],
			'customer_po'		=>	$purchase_detail[0]['customer_po'],
			'ship_method'		=>	$purchase_detail[0]['ship_method'],
			'description'		=>	$purchase_detail[0]['description'],
			'purchase_info'		=>	$purchase_detail,
			'supplier_list'		=>	$supplier_list,
			'supplier_selected'	=>	$supplier_selected,
			'all_shipping'  	=> $all_shipping,
			'all_product'  => $all_product,
			);

		$chapterList = $CI->parser->parse('purchase/edit_purchase_form',$data,true);
		return $chapterList;
	}
	//Search purchase
	public function purchase_search_list($cat_id,$company_id)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$category_list = $CI->Purchases->retrieve_category_list();
		$purchases_list = $CI->Purchases->purchase_search_list($cat_id,$company_id);
		$data = array(
				'title' => 'Purchases List',
				'purchases_list' => $purchases_list,
				'category_list' => $category_list
			);
		$purchaseList = $CI->parser->parse('purchase/purchase',$data,true);
		return $purchaseList;
	}
	//Purchase html Data
	
	public function purchase_details_data($purchase_id)
	{
	
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
	
		$purchase_detail = $CI->Purchases->purchase_details_data($purchase_id);
		#echo "<pre>";print_r($purchase_detail);die;
		if(!empty($purchase_detail)){
			$i = 0;
			foreach($purchase_detail as $k=>$v){$i++;
			   $purchase_detail[$k]['sl']=$i;
			   if($purchase_detail[$k]['cartoon_quantity']>0){
					$purchase_detail[$k]['cartoon']=$purchase_detail[$k]['quantity']/$purchase_detail[$k]['cartoon_quantity'];
			   }else{
				   $purchase_detail[$k]['cartoon']=$purchase_detail[$k]['quantity'];
			   }
			}
			
			foreach($purchase_detail as $k=>$v){
			   $purchase_detail[$k]['convert_date'] = $CI->occational->dateConvert($purchase_detail[$k]['purchase_date']);
			}
			
		}
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$company_info = $CI->Purchases->retrieve_company();

		$shippname = "";
		for($i=0; $i<count($purchase_detail);$i++){
			if($shippname == ""){
				$shippname = $purchase_detail[0]['shipping_name'];
			}else{
				$shippname = $shippname.", ".$purchase_detail[0]['shipping_name'];
			}
		}
		
		
		
		$sp = explode(",",$purchase_detail[0]['ship_method']);
		
		$sp_name_all = '';
		for($j=0; $j<count($sp);$j++){
			 $sp_name = $CI->Purchases->getshippingname($sp[$j]);
			 
			 if($sp_name_all == ""){
				$sp_name_all = $sp_name[0]['shipping_name'];
			}else{
				$sp_name_all = $sp_name_all.", ".$sp_name[0]['shipping_name'];
			}
		}
		

		$data=array(
			'purchase_id'		=>	$purchase_detail[0]['purchase_id'],
			'purchase_details'	=>	$purchase_detail[0]['purchase_details'],
			'supplier_name'		=>	$purchase_detail[0]['supplier_name'],
			'address'         =>  $purchase_detail[0]['address'],
			'product_details' => $purchase_detail[0]['product_details'],
			'customer_name'		=>	$purchase_detail[0]['customer_name'],
			'customer_address' => $purchase_detail[0]['customer_address'],
			'customer_zip' => $purchase_detail[0]['zip'],

			'customer_city'		=>	$purchase_detail[0]['customer_city_name'],
			'customer_state'		=>	$purchase_detail[0]['customer_state_name'],


			'customer_po'		=>	$purchase_detail[0]['customer_po'],
			'shipping_name'		=>	$sp_name_all ,
			'ship_date'		=>	$purchase_detail[0]['ship_date'],
			'created_at'		=>	$purchase_detail[0]['created_at'],


			'final_date'		=>	$purchase_detail[0]['convert_date'],
			'sub_total_amount'	=>	number_format($purchase_detail[0]['grand_total_amount'], 2, '.', ','),
			'chalan_no'			=>	$purchase_detail[0]['chalan_no'],
			'purchase_all_data'	=>	$purchase_detail,
			'company_info'		=>	$company_info,
			'currency' 			=> $currency_details[0]['currency'],
			'position' 			=> $currency_details[0]['currency_position'],
			);
	
		$chapterList = $CI->parser->parse('purchase/purchase_detail',$data,true);
		return $chapterList;
	}
}
?>