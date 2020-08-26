<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lreport {

    // Retrieve All Stock Report
    public function stock_report($limit, $page, $links) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $stok_report = $CI->Reports->stock_report($limit, $page);

        if (!empty($stok_report)) {
            $i = $page;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['stok_quantity'] = $stok_report[$k]['totalBuyQnty'] - $stok_report[$k]['totalSalesQnty'];
                $stok_report[$k]['totalSalesCtn'] = $stok_report[$k]['totalSalesQnty'] / $stok_report[$k]['cartoon_quantity'];
                $stok_report[$k]['totalPrhcsCtn'] = $stok_report[$k]['totalBuyQnty'] / $stok_report[$k]['cartoon_quantity'];

                $stok_report[$k]['stok_quantity_cartoon'] = $stok_report[$k]['stok_quantity'] / $stok_report[$k]['cartoon_quantity'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Stock List',
            'stok_report' => $stok_report,
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/stock_report', $data, true);
        return $reportList;
    }

    // Retrieve Single Item Stock Stock Report
    public function stock_report_single_item($product_id, $date, $limit, $page, $link) {   //echo "$product_id,$date,$limit,$page";
       $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->library('occational');
        $stok_report = $CI->Reports->stock_report_bydate($product_id, $date, $limit, $page);

        $sub_total_in = 0;
        $sub_total_out = 0;
        $sub_total_stock = 0;
        if (!empty($stok_report)) {
            $i = $page;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }

            foreach ($stok_report as $k => $v) {
                $i++;

                $stok_report[$k]['totalSalesCtn'] = $stok_report[$k]['totalSalesQnty'] / $stok_report[$k]['cartoon_quantity'];

                $stok_report[$k]['totalPrhcsCtn'] = $stok_report[$k]['totalPurchaseQnty'] / $stok_report[$k]['cartoon_quantity'];

                $stok_report[$k]['stok_quantity_cartoon'] = ($stok_report[$k]['totalPrhcsCtn'] - $stok_report[$k]['totalSalesCtn']);

                $stok_report[$k]['SubTotalOut'] = ($sub_total_out + $stok_report[$k]['totalSalesCtn']);
                $sub_total_out = $stok_report[$k]['SubTotalOut'];


                $stok_report[$k]['SubTotalIn'] = ($sub_total_in + $stok_report[$k]['totalPrhcsCtn']);
                $sub_total_in = $stok_report[$k]['SubTotalIn'];

                $stok_report[$k]['SubTotalStock'] = ($sub_total_stock + $stok_report[$k]['stok_quantity_cartoon']);
                $sub_total_stock = $stok_report[$k]['SubTotalStock'];
            }
        } else {
            $CI->session->set_userdata(array('error_message' => display('product_not_found')));
            redirect('Creport');
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $company_info = $CI->Reports->retrieve_company();
        $data = array(
            'title' => 'Stock Report',
            'stok_report' => $stok_report,
            'product_model' => $stok_report[0]['product_model'],
            'link' => $link,
            'date' => $date,
            'sub_total_in' => $sub_total_in,
            'sub_total_out' => $sub_total_out,
            'sub_total_stock' => $sub_total_stock,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $reportList = $CI->parser->parse('report/stock_report', $data, true);
        return $reportList;
    }

    // Retrieve Single Item Stock Stock Report
    public function stock_report_supplier_wise($product_id, $supplier_id, $date, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Suppliers');
        $CI->load->library('occational');
        $stok_report = $CI->Reports->stock_report_supplier_bydate($product_id, $supplier_id, $date, $per_page, $page);

        $supplier_list = $CI->Suppliers->supplier_list_report();
        $supplier_info = $CI->Suppliers->retrieve_supplier_editdata($supplier_id);

        $sub_total_in = 0;
        $sub_total_out = 0;
        $sub_total_stock = 0;

        if (!empty($stok_report)) {
            $i = $page;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }

            foreach ($stok_report as $k => $v) {
                $i++;

                $stok_report[$k]['totalSalesCtn'] = $stok_report[$k]['totalSalesQnty'] / $stok_report[$k]['cartoon_quantity'];

                $stok_report[$k]['totalPrhcsCtn'] = $stok_report[$k]['totalPurchaseQnty'] / $stok_report[$k]['cartoon_quantity'];

                $stok_report[$k]['stok_quantity_cartoon'] = ($stok_report[$k]['totalPrhcsCtn'] - $stok_report[$k]['totalSalesCtn']);

                $stok_report[$k]['SubTotalOut'] = ($sub_total_out + $stok_report[$k]['totalSalesCtn']);
                $sub_total_out = $stok_report[$k]['SubTotalOut'];


                $stok_report[$k]['SubTotalIn'] = ($sub_total_in + $stok_report[$k]['totalPrhcsCtn']);
                $sub_total_in = $stok_report[$k]['SubTotalIn'];

                $stok_report[$k]['SubTotalStock'] = ($sub_total_stock + $stok_report[$k]['stok_quantity_cartoon']);
                $sub_total_stock = $stok_report[$k]['SubTotalStock'];
            }
        } else {
            $CI->session->set_userdata(array('error_message' => display('product_not_found')));
            redirect('Creport/stock_report_supplier_wise');
        }


        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $company_info = $CI->Reports->retrieve_company();
        $data = array(
            'title' => 'Stock Report',
            'stok_report' => $stok_report,
            'product_model' => $stok_report[0]['product_model'],
            'links' => $links,
            'date' => $date,
            'sub_total_in' => $sub_total_in,
            'sub_total_out' => $sub_total_out,
            'sub_total_stock' => $sub_total_stock,
            'supplier_list' => $supplier_list,
            'supplier_info' => $supplier_info,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $reportList = $CI->parser->parse('report/stock_report_supplier_wise', $data, true);
        return $reportList;
    }

    // Retrieve Single Item Stock Stock Report
    public function stock_report_product_wise($product_id, $supplier_id, $from_date, $to_date, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Suppliers');
        $CI->load->library('occational');
        $stok_report = $CI->Reports->stock_report_product_bydate($product_id, $supplier_id, $from_date, $to_date, $per_page, $page);

        $supplier_list = $CI->Suppliers->supplier_list_report();
        $supplier_info = $CI->Suppliers->retrieve_supplier_editdata($supplier_id);


        $sub_total_in = 0;
        $sub_total_out = 0;
        $sub_total_stock = 0;
        $sub_total_in_qnty = 0;
        $sub_total_out_qnty = 0;
        $sub_total_in_taka = 0;
        $sub_total_out_taka = 0;
        $stok_quantity_cartoon = 0;
        if (!empty($stok_report)) {
            $i = $page;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }

            foreach ($stok_report as $k => $v) {
                $i++;

                $stok_report[$k]['totalSalesCtn'] = $stok_report[$k]['totalSalesQnty'] / $stok_report[$k]['cartoon_quantity'];

                $stok_report[$k]['totalPrhcsCtn'] = $stok_report[$k]['totalPurchaseQnty'] / $stok_report[$k]['cartoon_quantity'];

                $stok_report[$k]['stok_quantity_cartoon'] = ($stok_report[$k]['totalPrhcsCtn'] - $stok_report[$k]['totalSalesCtn']);


                $stok_report[$k]['SubTotalOut'] = ($sub_total_out + $stok_report[$k]['totalSalesCtn']);
                $sub_total_out = $stok_report[$k]['SubTotalOut'];


                $stok_report[$k]['SubTotalIn'] = ($sub_total_in + $stok_report[$k]['totalPrhcsCtn']);
                $sub_total_in = $stok_report[$k]['SubTotalIn'];

                $stok_report[$k]['SubTotalStock'] = ($sub_total_stock + $stok_report[$k]['stok_quantity_cartoon']);
                $sub_total_stock = $stok_report[$k]['SubTotalStock'];

                $stok_report[$k]['in_taka'] = $stok_report[$k]['totalPurchaseQnty'] * $stok_report[$k]['supplier_price'];

                $stok_report[$k]['out_taka'] = $stok_report[$k]['totalSalesQnty'] * $stok_report[$k]['supplier_price'];


                $stok_report[$k]['SubTotalinQnty'] = ($sub_total_in_qnty + $stok_report[$k]['totalPurchaseQnty']);
                $sub_total_in_qnty = $stok_report[$k]['SubTotalinQnty'];

                $stok_report[$k]['SubTotaloutQnty'] = ($sub_total_out_qnty + $stok_report[$k]['totalSalesQnty']);
                $sub_total_out_qnty = $stok_report[$k]['SubTotaloutQnty'];


                $stok_report[$k]['SubTotalinTaka'] = ($sub_total_in_taka + $stok_report[$k]['in_taka']);
                $sub_total_in_taka = $stok_report[$k]['SubTotalinTaka'];

                $stok_report[$k]['SubTotalOutTaka'] = ($sub_total_out_taka + $stok_report[$k]['out_taka']);
                $sub_total_out_taka = $stok_report[$k]['SubTotalOutTaka'];
            }
        } else {
            $CI->session->set_userdata(array('error_message' => display('product_not_found')));
            redirect('Creport/stock_report_product_wise');
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $company_info = $CI->Reports->retrieve_company();
        $data = array(
            'title' => 'Stock Report',
            'stok_report' => $stok_report,
            'product_model' => $stok_report[0]['product_model'],
            'product_name' => $stok_report[0]['product_name'],
            'links' => $links,
            'date' => $to_date,
            'sub_total_in' => $sub_total_in,
            'sub_total_out' => $sub_total_out,
            'sub_total_stock' => $sub_total_stock,
            'SubTotalinQnty' => $sub_total_in_qnty,
            'SubTotaloutQnty' => $sub_total_out_qnty,
            'sub_total_in_taka' => number_format($sub_total_in_taka, 2, '.', ','),
            'sub_total_out_taka' => number_format($sub_total_out_taka, 2, '.', ','),
            'supplier_list' => $supplier_list,
            'supplier_info' => $supplier_info,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $reportList = $CI->parser->parse('report/stock_report_product_wise', $data, true);
        return $reportList;
    }

    // Retrieve daily Report
    public function retrieve_all_reports() {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $sales_report = $CI->Reports->todays_sales_report();
//        echo '<pre>';        print_r($sales_report);die();
        $sales_amount = 0;
        if (!empty($sales_report)) {
            $i = 0;
            foreach ($sales_report as $k => $v) {
                $i++;
                $sales_report[$k]['sl'] = $i;
                $sales_report[$k]['sales_date'] = $CI->occational->dateConvert($sales_report[$k]['date']);
                $sales_amount = $sales_amount + $sales_report[$k]['total_amount'];
            }
        }
        $purchase_report = $CI->Reports->todays_purchase_report();
        $purchase_amount = 0;
        if (!empty($purchase_report)) {
            $i = 0;
            foreach ($purchase_report as $k => $v) {
                $i++;
                $purchase_report[$k]['sl'] = $i;
                $purchase_report[$k]['prchse_date'] = $CI->occational->dateConvert($purchase_report[$k]['purchase_date']);
                $purchase_amount = $purchase_amount + $purchase_report[$k]['grand_total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Todays report',
            'sales_report' => $sales_report,
            'sales_amount' => number_format($sales_amount, 2, '.', ','),
            'purchase_amount' => number_format($purchase_amount, 2, '.', ','),
            'purchase_report' => $purchase_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        // report/all_report
        $reportList = $CI->parser->parse('report/all_report', $data, true);
        return $reportList;
    }

    // Retrieve todays_sales_report
    public function todays_sales_report() {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $sales_report = $CI->Reports->todays_sales_report();
        $sales_amount = 0;
        if (!empty($sales_report)) {
            $i = 0;
            foreach ($sales_report as $k => $v) {
                $i++;
                $sales_report[$k]['sl'] = $i;
                $sales_report[$k]['sales_date'] = $CI->occational->dateConvert($sales_report[$k]['date']);
                $sales_amount = $sales_amount + $sales_report[$k]['total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Daily Sales Report',
            'sales_amount' => number_format($sales_amount, 2, '.', ','),
            'sales_report' => $sales_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/sales_report', $data, true);
        return $reportList;
    }

    public function retrieve_dateWise_SalesReports($start_date, $end_date) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $sales_report = $CI->Reports->retrieve_dateWise_SalesReports($start_date, $end_date);
        $sales_amount = 0;
        if (!empty($sales_report)) {
            $i = 0;
            foreach ($sales_report as $k => $v) {
                $i++;
                $sales_report[$k]['sl'] = $i;
                $sales_report[$k]['sales_date'] = $CI->occational->dateConvert($sales_report[$k]['date']);
                $sales_amount = $sales_amount + $sales_report[$k]['total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Sales Report',
            'sales_amount' => $sales_amount,
            'sales_report' => $sales_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/sales_report', $data, true);
        return $reportList;
    }

    // Retrieve todays_purchase_report
    public function todays_purchase_report() {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $purchase_report = $CI->Reports->todays_purchase_report();
        $purchase_amount = 0;
        if (!empty($purchase_report)) {
            $i = 0;
            foreach ($purchase_report as $k => $v) {
                $i++;
                $purchase_report[$k]['sl'] = $i;
                $purchase_report[$k]['prchse_date'] = $CI->occational->dateConvert($purchase_report[$k]['purchase_date']);
                $purchase_amount = $purchase_amount + $purchase_report[$k]['grand_total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Purchase Report',
            'purchase_amount' => number_format($purchase_amount, 2, '.', ','),
            'purchase_report' => $purchase_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/purchase_report', $data, true);
        return $reportList;
    }

    //Total profit report
    public function total_profit_report($links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $total_profit_report = $CI->Reports->total_profit_report($per_page, $page);


        $profit_ammount = 0;
        $SubTotalSupAmnt = 0;
        $SubTotalSaleAmnt = 0;
        if (!empty($total_profit_report)) {
            $i = 0;
            foreach ($total_profit_report as $k => $v) {
                $total_profit_report[$k]['sl'] = $i;
                $total_profit_report[$k]['prchse_date'] = $CI->occational->dateConvert($total_profit_report[$k]['date']);

                $profit_ammount = $profit_ammount + $total_profit_report[$k]['total_profit'];

                $SubTotalSupAmnt = $SubTotalSupAmnt + $total_profit_report[$k]['total_supplier_rate'];

                $SubTotalSaleAmnt = $SubTotalSaleAmnt + $total_profit_report[$k]['total_sale'];
            }
        }


        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Profit Report',
            'profit_ammount' => number_format($profit_ammount, 2, '.', ','),
            'total_profit_report' => $total_profit_report,
            'SubTotalSupAmnt' => number_format($SubTotalSupAmnt, 2, '.', ','),
            'SubTotalSaleAmnt' => number_format($SubTotalSaleAmnt, 2, '.', ','),
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/profit_report', $data, true);
        return $reportList;
    }

    public function retrieve_dateWise_PurchaseReports($start_date, $end_date) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $purchase_report = $CI->Reports->retrieve_dateWise_PurchaseReports($start_date, $end_date);
        $purchase_amount = 0;
        if (!empty($purchase_report)) {
            $i = 0;
            foreach ($purchase_report as $k => $v) {
                $i++;
                $purchase_report[$k]['sl'] = $i;
                $purchase_report[$k]['prchse_date'] = $CI->occational->dateConvert($purchase_report[$k]['purchase_date']);
                $purchase_amount = $purchase_amount + $purchase_report[$k]['grand_total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Purchase Report',
            'purchase_amount' => $purchase_amount,
            'purchase_report' => $purchase_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/purchase_report', $data, true);
        return $reportList;
    }

    //Retrive date wise total profit report
    public function retrieve_dateWise_profit_report($start_date, $end_date, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $total_profit_report = $CI->Reports->retrieve_dateWise_profit_report($start_date, $end_date, $per_page, $page);

        $profit_ammount = 0;
        $SubTotalSupAmnt = 0;
        $SubTotalSaleAmnt = 0;
        if (!empty($total_profit_report)) {
            $i = 0;
            foreach ($total_profit_report as $k => $v) {
                $total_profit_report[$k]['sl'] = $i;
                $total_profit_report[$k]['prchse_date'] = $CI->occational->dateConvert($total_profit_report[$k]['date']);

                $profit_ammount = $profit_ammount + $total_profit_report[$k]['total_profit'];

                $SubTotalSupAmnt = $SubTotalSupAmnt + $total_profit_report[$k]['total_supplier_rate'];

                $SubTotalSaleAmnt = $SubTotalSaleAmnt + $total_profit_report[$k]['total_sale'];
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Profit Report',
            'profit_ammount' => number_format($profit_ammount, 2, '.', ','),
            'total_profit_report' => $total_profit_report,
            'SubTotalSupAmnt' => number_format($SubTotalSupAmnt, 2, '.', ','),
            'SubTotalSaleAmnt' => number_format($SubTotalSaleAmnt, 2, '.', ','),
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/profit_report', $data, true);
        return $reportList;
    }

    public function get_products_report_sales_view($links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $product_report = $CI->Reports->retrieve_product_sales_report($per_page, $page);

        if (!empty($product_report)) {
            $i = 0;
            foreach ($product_report as $k => $v) {
                $i++;
                $product_report[$k]['sl'] = $i;
            }
        }
        $sub_total = 0;
        if (!empty($product_report)) {
            foreach ($product_report as $k => $v) {
                $product_report[$k]['sales_date'] = $CI->occational->dateConvert($product_report[$k]['date']);
                $sub_total = $sub_total + $product_report[$k]['total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Product Wise Sales Report',
            'sub_total' => number_format($sub_total, 2, '.', ','),
            'product_report' => $product_report,
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
//        echo '<pre>';        print_r($data);die();
        $reportList = $CI->parser->parse('report/product_report', $data, true);
        return $reportList;
    }

    public function get_products_search_report($from_date, $to_date, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $product_report = $CI->Reports->retrieve_product_search_sales_report($from_date, $to_date, $per_page, $page);
        
        if (!empty($product_report)) {
            $i = 0;
            foreach ($product_report as $k => $v) {
                $i++;
                $product_report[$k]['sl'] = $i;
            }
        }
        $sub_total = 0;
        if (!empty($product_report)) {
            foreach ($product_report as $k => $v) {
                $product_report[$k]['sales_date'] = $CI->occational->dateConvert($product_report[$k]['date']);
                $sub_total = $sub_total + $product_report[$k]['total_price'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Product Wise Sales Report',
            'sub_total' => number_format($sub_total, 2, '.', ','),
            'product_report' => $product_report,
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/product_report', $data, true);
        return $reportList;
    }

}

?>