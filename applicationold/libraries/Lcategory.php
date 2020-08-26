<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lcategory {
	//Retrieve  Customer List	
	public function category_list($r_id)
	{
		$CI =& get_instance();
		$CI->load->model('Categories');
		$category_list = $CI->Categories->category_list($r_id);  //It will get only Credit Customers		
		$category_list_product = $CI->Categories->category_list_product($r_id);  //It will get only Credit Customers	
		$i=0;
		$total=0;
		if(!empty($category_list)){	
			foreach($category_list as $k=>$v){$i++;
			   $category_list[$k]['sl']=$i;
			}
		}
		if(!empty($category_list_product)){	
			foreach($category_list_product as $k=>$v){$i++;
			   $category_list_product[$k]['sl']=$i;
			}
		}
		$data = array(
				'title' => 'Categories List',
				'category_list' => $category_list,
				'category_list_product' => $category_list_product,
			);
		$customerList = $CI->parser->parse('category/category',$data,true);
		return $customerList;
	}			
	//Sub Category Add
	public function category_add_form()
	{
		$CI =& get_instance();
		$CI->load->library('session'); 
		
		$CI->load->model('Categories');
		 
		$data = array(
				'title' => 'Add Category'
			);
		$customerForm = $CI->parser->parse('category/add_category_form',$data,true);
		return $customerForm;
	   
	}

	//customer Edit Data
	public function category_edit_data($r_id,$category_id)
	{
		$CI =& get_instance();
		$CI->load->model('Categories');
		$category_detail = $CI->Categories->retrieve_category_editdata($r_id,$category_id);
		$data=array(
			'category_id' 			=> $category_detail[0]['category_id'],
			'category_name' 		=> $category_detail[0]['category_name'],
			'status' 				=> $category_detail[0]['status']
			);
		$chapterList = $CI->parser->parse('category/edit_category_form',$data,true);
		return $chapterList;
	}
	//Search customer
	public function customer_search_list($cat_id,$company_id)
	{
		$CI =& get_instance();
		$CI->load->model('Customers');
		$category_list = $CI->Customers->retrieve_category_list();
		$customers_list = $CI->Customers->customer_search_list($cat_id,$company_id);
		$data = array(
				'title' => 'customers List',
				'customers_list' => $customers_list,
				'category_list' => $category_list
			);
		$customerList = $CI->parser->parse('customer/customer',$data,true);
		return $customerList;
	}
	
	//Retrieve  Customer List			
	public function category_search_list($category_id) 	{ 			
	$CI =& get_instance();			
	$CI->load->model('Categories');			
	$category_list = $CI->Categories->category_search_item($category_id);  	
	$category_list_product = $CI->Categories->category_list_product();  //It will get only Credit Customers	
	//It will get only Credit Customers					
	$i=0;			
	$total=0;			
	if(!empty($category_list)){					
	foreach($category_list as $k=>$v){		
	$i++;			   		
	$category_list[$k]['sl']=$i;					
	}				
	}

	if(!empty($category_list_product)){	
			foreach($category_list_product as $k=>$v){$i++;
			   $category_list_product[$k]['sl']=$i;
			}
	}	
	$data = array('title' => 'Categories List','category_list' => $category_list,'category_list_product' => $category_list_product);				
	$customerList = $CI->parser->parse('category/category',$data,true);				
	return $customerList;		
	}	
}
?>