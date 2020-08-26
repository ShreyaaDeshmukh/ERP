<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lreceipt {
	// Retrieve  Quize List From DB
	public function receipt_list($links,$per_page,$page)
	{
		$CI =& get_instance();
		$CI->load->model('Receipts');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
		$receipt_list = $CI->Receipts->receipt_list($per_page,$page);
		if(!empty($receipt_list)){	
			$j=0;
			foreach($receipt_list as $k=>$v){
				$receipt_list[$k]['final_date'] = $CI->occational->dateConvert($receipt_list[$j]['receipt_date']);
			  $j++;
			}
		
			$i=0;
			foreach($receipt_list as $k=>$v){$i++;
			   $receipt_list[$k]['sl']=$i;
			}
		}
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$data = array(
				'title' => 'Purchases List',
				'receipt_list' => $receipt_list,
				'links' => $links,
				'currency' => $currency_details[0]['currency'],
				'position' => $currency_details[0]['currency_position'],
			);
		$purchaseList = $CI->parser->parse('receipt/receipt',$data,true);
		return $purchaseList;
	}
	//Purchase Item By Search
	public function receipt_by_search($supplier_id)
	{
		$CI =& get_instance();
		$CI->load->model('Receipts');
		$CI->load->library('occational');
		$receipts_list = $CI->Receipts->receipts_by_search($supplier_id);
		$j=0;
		if(!empty($receipts_list)){
			foreach($receipts_list as $k=>$v){
				$receipts_list[$k]['final_date'] = $CI->occational->dateConvert($receipts_list[$j]['receipt_date']);
			  $j++;
			}
			$i=0;
			foreach($receipts_list as $k=>$v){$i++;
			   $receipts_list[$k]['sl']=$i;
			}
		}
		$data = array(
				'receipts_list' => $receipts_list
			);
		$purchaseList = $CI->parser->parse('receipt/receipt',$data,true);
		return $purchaseList;
	}
	//Sub Category Add
	public function receipt_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('Receipts');
		$CI->load->model('Customers');
		$CI->load->model('Shipping');
		$all_supplier = $CI->Receipts->select_all_supplier();
		$all_customer = $CI->Customers->all_customer_list();
		$all_shipping = $CI->Shipping->all_shipping_list();
		$data = array(
				'title' => 'Add Purchase',
				'all_supplier' => $all_supplier,
				'all_customer' => $all_customer,
				'all_shipping'  => $all_shipping
			);
		$purchaseForm = $CI->parser->parse('receipt/add_receipt_form',$data,true);
		return $purchaseForm;
	}
	public function insert_receipt($data)
	{
		$CI =& get_instance();
		$CI->load->model('Receipts');
        $CI->Receipts->receipt_entry($data);
		return true;
	}
	//purchase Edit Data
	public function receipt_edit_data($receipt_id)
	{
		$CI =& get_instance();
		$CI->load->model('Receipts');
		$CI->load->model('Suppliers');
		$CI->load->model('Customers');
		$CI->load->model('Shipping');
		$purchase_detail = $CI->Receipts->retrieve_receipt_editdata($receipt_id);
		$supplier_id = $purchase_detail[0]['supplier_id'];
		$customer_id = $purchase_detail[0]['customer_id'];
		$supplier_list=$CI->Suppliers->supplier_list("110","0");
		$supplier_selected=$CI->Suppliers->supplier_search_item($supplier_id);
		$customer_selected=$CI->Customers->customer_search_item($customer_id);
		$all_shipping = $CI->Shipping->all_shipping_list();
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
			'receipt_id'		=>	$purchase_detail[0]['receipt_id'],
			'chalan_no'			=>	$purchase_detail[0]['chalan_no'],
			'supplier_name'		=>	$purchase_detail[0]['supplier_name'],
			'customer_name'		=>	$purchase_detail[0]['customer_name'],
			'supplier_id'		=>	$purchase_detail[0]['supplier_id'],
			'customer_id'		=>	$purchase_detail[0]['customer_id'],
			'grand_total'		=>	$purchase_detail[0]['grand_total_amount'],
			'receipt_details'	=>	$purchase_detail[0]['receipt_details'],
			'receipt_date'	=>	$purchase_detail[0]['receipt_date'],
			'ship_date'			=>	$purchase_detail[0]['ship_date'],
			'customer_po'		=>	$purchase_detail[0]['customer_po'],
			'ship_method'		=>	$purchase_detail[0]['ship_method'],
			'receipt_info'		=>	$purchase_detail,
			'supplier_list'		=>	$supplier_list,
			'supplier_selected'	=>	$supplier_selected,
			'all_shipping'  => $all_shipping
			
		);
		#echo "<pre>";print_r($data);die;
		$chapterList = $CI->parser->parse('receipt/edit_receipt_form',$data,true);
		return $chapterList;
	}
	//Search purchase
	public function receipt_search_list($cat_id,$company_id)
	{
		$CI =& get_instance();
		$CI->load->model('Receipts');
		$category_list = $CI->Receipts->retrieve_category_list();
		$purchases_list = $CI->Receipts->receipt_search_list($cat_id,$company_id);
		$data = array(
				'title' => 'Purchases List',
				'purchases_list' => $purchases_list,
				'category_list' => $category_list
			);
		$purchaseList = $CI->parser->parse('receipt/receipt',$data,true);
		return $purchaseList;
	}
	//Purchase html Data
	
	public function receipt_details_data($purchase_id)
	{
	
		$CI =& get_instance();
		$CI->load->model('Receipts');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
	
		$purchase_detail = $CI->Receipts->receipt_details_data($purchase_id);
		
		if(!empty($purchase_detail)){
			$i = 0;
			foreach($purchase_detail as $k=>$v){$i++;
			   $purchase_detail[$k]['sl']=$i;
			   $purchase_detail[$k]['cartoon']=$purchase_detail[$k]['quantity']/$purchase_detail[$k]['cartoon_quantity'];
			}
			
			foreach($purchase_detail as $k=>$v){
			   $purchase_detail[$k]['convert_date'] = $CI->occational->dateConvert($purchase_detail[$k]['receipt_date']);
			}
			
		}
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$company_info = $CI->Purchases->retrieve_company();
		$data=array(
			'receipt_id'		=>	$purchase_detail[0]['receipt_id'],
			'receipt_details'	=>	$purchase_detail[0]['receipt_details'],
			'supplier_name'		=>	$purchase_detail[0]['supplier_name'],
			'final_date'		=>	$purchase_detail[0]['convert_date'],
			'sub_total_amount'	=>	number_format($purchase_detail[0]['grand_total_amount'], 2, '.', ','),
			'chalan_no'			=>	$purchase_detail[0]['chalan_no'],
			'purchase_all_data'	=>	$purchase_detail,
			'company_info'		=>	$company_info,
			'currency' 			=> $currency_details[0]['currency'],
			'position' 			=> $currency_details[0]['currency_position'],
			);
	
		$chapterList = $CI->parser->parse('receipt/receipt_detail',$data,true);
		return $chapterList;
	}
}
?>