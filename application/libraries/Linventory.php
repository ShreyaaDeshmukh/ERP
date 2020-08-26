<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Linventory {
    /*
     * * Retrieve  Quize List From DB 
     */

    public function product_list($links, $per_page, $page,$r_id) {
        $CI = & get_instance();
        $CI->load->model('Products');
        $CI->load->model('Web_settings');
        $products_list = $CI->Products->product_list_inventory($per_page, $page,$r_id);
        // echo 1;
// print_r($products_list);die;

        $all_product_list = $CI->Products->all_product_list_inventory($r_id);


        $i = 0;
        if (!empty($products_list)) {
            foreach ($products_list as $k => $v) {
                $i++;
                $products_list[$k]['sl'] = $i;
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Products List',
            'products_list' => $products_list,
            'all_product_list' => $all_product_list,
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        
        $productList = $CI->parser->parse('inventory/product', $data, true);
        return $productList;
    }
	
	 public function product_checkout_list($links, $per_page, $page, $r_id) {
	   // echo "hii";die;
        $CI = & get_instance();
        $CI->load->model('Products');
        $CI->load->model('Web_settings');
        $products_list = $CI->Products->product_list_checkout($per_page, $page, $r_id);
        // echo "hii rinkyyyy";
// print_R($products_list);die;
        $all_product_list = $CI->Products->all_product_list_checkout($r_id);



        $i = 0;
        if (!empty($products_list)) {
            foreach ($products_list as $k => $v) {
                $i++;
                $products_list[$k]['sl'] = $i;
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        // print_r("hiii");die;
        $data = array(
            'title' => 'Products List',
            'products_list' => $products_list,
            'all_product_list' => $all_product_list,
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        // echo 1;

        // print_r($data);die;
        $productList = $CI->parser->parse('inventory/product_checkout', $data, true);
        return $productList;
    }
	
	
	
	public function product_checkin_list($links, $per_page, $page, $r_id) {
	   // echo "hii";die;
        $CI = & get_instance();
        $CI->load->model('Products');
        $CI->load->model('Web_settings');
        $products_list = $CI->Products->product_list_checkin($per_page, $page, $r_id);
        // echo "hii rinkyyyy";
// print_R($products_list);die;
        $all_product_list = $CI->Products->all_product_list_checkin($r_id);



        $i = 0;
        if (!empty($products_list)) {
            foreach ($products_list as $k => $v) {
                $i++;
                $products_list[$k]['sl'] = $i;
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        // print_r("hiii");die;
        $data = array(
            'title' => 'Products List',
            'products_list' => $products_list,
            'all_product_list' => $all_product_list,
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        // echo 1;

        // print_r($data);die;
        $productList = $CI->parser->parse('inventory/product_checkin', $data, true);
        return $productList;
    }

    //Sub Category Add
    public function product_add_form() {
        $CI = & get_instance();
        $CI->load->model('Products');
        $CI->load->model('Suppliers');
        $CI->load->model('Categories');
        $supplier = $CI->Suppliers->supplier_list("110", "0");
        $category_list = $CI->Categories->category_list_product();
        $tax_list = $CI->db->select('*')
                ->from('tax_information')
                ->get()
                ->result();
        $data = array(
            'title' => 'Add Product',
            'supplier' => $supplier,
            'category_list' => $category_list,
            'tax_list' => $tax_list
        );
        $productForm = $CI->parser->parse('inventory/add_product_form', $data, true);
        return $productForm;
    }

    public function insert_product($data) {
        $CI = & get_instance();
        $CI->load->model('Products');
        $result = $CI->Products->product_entry($data);
        if ($result == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Product Edit Data
    public function product_edit_data($product_id) {
        $CI = & get_instance();
        $CI->load->model('Products');
        $CI->load->model('Suppliers');
        $CI->load->model('Categories');

        $product_detail = $CI->Products->retrieve_product_editdata($product_id);
		#echo "<pre>";print_r($product_detail);die;
        @$supplier_id = $product_detail[0]['supplier_id'];
        @$category_id = $product_detail[0]['category_id'];
        $supplier_list = $CI->Suppliers->supplier_list("110", "0");
        $supplier_selected = $CI->Suppliers->supplier_search_item($supplier_id);

        $category_list = $CI->Categories->category_list_product();
        $category_selected = $CI->Categories->category_search_item($category_id);
//        echo '<pre>';        print_r($category_selected);die();
        $tax_list = $CI->Products->retrieve_product_tax();

        $data = array(
            'title' => "Product Edit",
            'product_id' => $product_detail[0]['product_id'],
            'product_name' => $product_detail[0]['product_name'],
            'price' => $product_detail[0]['price'],
            'supplier_price' => $product_detail[0]['supplier_price'],
            'cartoon_quantity' => $product_detail[0]['cartoon_quantity'],
            'pallet_quantity' => $product_detail[0]['pallet_quantity'],
            'product_model' => $product_detail[0]['product_model'],
            'product_details' => $product_detail[0]['product_details'],
            'lot_flag' => $product_detail[0]['lot_flag'],
            'expiry_flag' => $product_detail[0]['expiry_flag'],
            'image' => $product_detail[0]['image'],
            'unit_values' => json_decode($product_detail[0]['unit_values'], true),
            'supplier_list' => $supplier_list,
            'supplier_selected' => $supplier_selected,
            'category_list' => $category_list,
            'category_selected' => $category_selected,
            'tax_list' => $tax_list,
        );

        $chapterList = $CI->parser->parse('inventory/edit_product_form', $data, true);

        return $chapterList;
    }



    public function product_details_inventory($product_id) {
        $CI = & get_instance();
        $CI->load->model('Products');
      

        $product_detail = $CI->Products->product_detail_inventory($product_id);
		// print_r($product_detail);die;
        $data = array(
            'title' => 'Products List',
            'products_list' => $product_detail
        );

       
        $chapterList = $CI->parser->parse('inventory/edit_product_form', $data, true);

        return $chapterList;
    }



    //Search Product
    public function product_search_list($product_id,$vendoreID,$customer_name,$customer_po) {
        $CI = & get_instance();
        $CI->load->model('Products');
        $CI->load->model('Web_settings');
        $products_list = $CI->Products->product_search_item_inventory($product_id,$vendoreID,$customer_name,$customer_po);
        $all_product_list = $CI->Products->all_product_list_inventory();

        $i = 0;
        if ($products_list) {
            foreach ($products_list as $k => $v) {
                $i++;
                $products_list[$k]['sl'] = $i;
            }

            $currency_details = $CI->Web_settings->retrieve_setting_editdata();
            $data = array(
                'title' => 'Products List',
                'products_list' => $products_list,
                'all_product_list' => $all_product_list,
                'links' => "",
                'currency' => $currency_details[0]['currency'],
                'position' => $currency_details[0]['currency_position'],
            );
            $productList = $CI->parser->parse('inventory/product', $data, true);
            return $productList;
        } else {
            redirect('Cinventory/manage_product');
        }
    }

    //Product Details
    public function product_details($product_id) {
        $CI = & get_instance();
        $CI->load->model('Products');
        $CI->load->library('occational');
        $CI->load->model('Web_settings');
        $details_info = $CI->Products->product_details_info($product_id);
        //

        $purchaseData = $CI->Products->product_purchase_info($product_id);
        $totalPurchase = 0;
        $totalPrcsAmnt = 0;
        if (!empty($purchaseData)) {
            foreach ($purchaseData as $k => $v) {
                $purchaseData[$k]['final_date'] = $CI->occational->dateConvert($purchaseData[$k]['purchase_date']);
                $totalPrcsAmnt = ($totalPrcsAmnt + $purchaseData[$k]['grand_total_amount']);
                $totalPurchase = ($totalPurchase + $purchaseData[$k]['quantity']);
                $purchaseData[$k]['purchase_cartoon'] = $purchaseData[$k]['quantity'] / $details_info[0]['cartoon_quantity'];
            }
        }
        $salesData = $CI->Products->invoice_data($product_id);
        $totalSales = 0;
        $totaSalesAmt = 0;
        if (!empty($salesData)) {
            foreach ($salesData as $k => $v) {
                $salesData[$k]['final_date'] = $CI->occational->dateConvert($salesData[$k]['date']);
                $totalSales = ($totalSales + $salesData[$k]['quantity']);
                $totaSalesAmt = ($totaSalesAmt + $salesData[$k]['total_amount']);
            }
        }
        //Cartoon conversion
        $totalPurchase = $totalPurchase / $details_info[0]['cartoon_quantity'];
        $totalSales = $totalSales / $details_info[0]['cartoon_quantity'];

        $stock = ($totalPurchase - $totalSales);
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Product Detail',
            'product_name' => $details_info[0]['product_name'],
            'product_model' => $details_info[0]['product_model'],
            'cartoon_quantity' => $details_info[0]['cartoon_quantity'],
            'pallet_quantity' => $details_info[0]['pallet_quantity'],
            'price' => $details_info[0]['price'],
            'purchaseTotalAmount' => number_format($totalPrcsAmnt, 2, '.', ','),
            'salesTotalAmount' => number_format($totaSalesAmt, 2, '.', ','),
            'total_purchase' => $totalPurchase,
            'total_sales' => $totalSales,
            'purchaseData' => $purchaseData,
            'salesData' => $salesData,
            'stock' => $stock,
            'product_statement' => 'Cinventory/product_sales_supplier_rate/' . $product_id,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $productList = $CI->parser->parse('inventory/product_details', $data, true);
        return $productList;
    }

    //Product Details
    public function product_sales_supplier_rate($product_id, $startdate, $enddate) {
        $CI = & get_instance();
        $CI->load->model('Products');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');

        //Product Summary
        $details_info = $CI->Products->product_details_info($product_id);

        $opening_balance = $CI->Products->previous_stock_data($product_id, $startdate);

        //Stock details.
        $salesData = $CI->Products->invoice_data_supplier_rate($product_id, $startdate, $enddate);


        $stock = $opening_balance[0]['quantity'];
        $totalIn = 0;
        $totalOut = 0;
        $totalstock = 0;
        $gtotal_sell = 0;
        $gtotal_purchase = 0;

        if (!empty($salesData)) {
            foreach ($salesData as $k => $v) {
                $salesData[$k]['fdate'] = $CI->occational->dateConvert($salesData[$k]['date']);


                if ($salesData[$k]['account'] == "a") {
                    $salesData[$k]['in'] = round($salesData[$k]['quantity'], 0);
                    $salesData[$k]['total_purchase'] = $salesData[$k]['total_price'];
                    $salesData[$k]['total_sell'] = 0;
                    $salesData[$k]['out'] = 0;
                    $stock = $stock + $salesData[$k]['out'] + $salesData[$k]['in'];
                    $totalIn += $salesData[$k]['in'];

                    $gtotal_purchase += $salesData[$k]['total_purchase'];
                } else {
                    $salesData[$k]['out'] = round($salesData[$k]['quantity'], 0);
                    $salesData[$k]['in'] = 0;
                    $stock = $stock + $salesData[$k]['out'] + $salesData[$k]['in'];
                    $totalOut += $salesData[$k]['out'];

                    //total group
                    $salesData[$k]['total_purchase'] = 0;
                    $salesData[$k]['total_sell'] = $salesData[$k]['total_price'];
                    $gtotal_sell += $salesData[$k]['total_sell'];
                }
                $salesData[$k]['stock'] = $stock;

                $totalstock = $salesData[$k]['stock'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $company_info = $CI->Products->retrieve_company();



        $data = array(
            'title' => 'Product Details',
            'product_id' => $details_info[0]['product_id'],
            'product_name' => $details_info[0]['product_name'],
            'product_model' => $details_info[0]['product_model'],
            'startdate' => $startdate,
            'enddate' => $enddate,
            'price' => $details_info[0]['price'],
            'totalIn' => $totalIn,
            'totalOut' => $totalOut,
            'totalstock' => $totalstock,
            'gtotal_sell' => number_format($gtotal_sell, 2, '.', ','),
            'gtotal_purchase' => number_format($gtotal_purchase, 2, '.', ','),
            'opening_balance' => round($opening_balance[0]['quantity'], 0),
            'salesData' => $salesData,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $productList = $CI->parser->parse('inventory/product_sales_supplier_rate', $data, true);
        return $productList;
    }

}

?>