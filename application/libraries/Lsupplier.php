<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lsupplier {

    //Supplier List
    public function supplier_list($r_id) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $suppliers_list = $CI->Suppliers->supplier_list($r_id);
        $i = 0;
        if (!empty($suppliers_list)) {
            foreach ($suppliers_list as $k => $v) {
                $i++;
                $suppliers_list[$k]['sl'] = $i;
            }
        }
        $data = array(
            'title' => 'Suppliers List',
            'suppliers_list' => $suppliers_list,
        );
        $supplierList = $CI->parser->parse('supplier/supplier', $data, true);
        return $supplierList;
    }
	
	//Retrieve  Customer List	

    public function import_vendor() {

        $CI = & get_instance();

        $CI->load->model('Suppliers');

        $CI->load->model('Web_settings');

       $data = array();

        $customerList = $CI->parser->parse('supplier/import_supplier', $data, true);

        return $customerList;

    }

    //Supplier Search Item
    public function supplier_search_item_new($supplier_id) { 
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $suppliers_list = $CI->Suppliers->supplier_search_item($supplier_id);
        $i = 0;
        if ($suppliers_list) {
            return $suppliers_list;
        } else {
            return $suppliers_list;
        }
    }

    //Supplier Search Item
    public function supplier_search_item($supplier_id) { 
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $suppliers_list = $CI->Suppliers->supplier_search_item($supplier_id);
        
        $i = 0;
        if ($suppliers_list) {
            foreach ($suppliers_list as $k => $v) {
                $i++;
                $suppliers_list[$k]['sl'] = $i;
            }
            $data = array(
                'title' => 'Suppliers Search Items',
                'suppliers_list' => $suppliers_list
            );
            $supplierList = $CI->parser->parse('supplier/supplier', $data, true);
            print_r($supplierList);die;
            return $supplierList;
        } else {
            redirect('Csupplier/manage_supplier');
        }
    }

    //Product search by supplier
    public function product_by_search() {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $suppliers_list = $CI->Suppliers->product_search_item($supplier_id);
        $i = 0;
        foreach ($suppliers_list as $k => $v) {
            $i++;
            $suppliers_list[$k]['sl'] = $i;
        }
        $data = array(
            'title' => 'Suppliers Search Items',
            'suppliers_list' => $suppliers_list
        );
        $supplierList = $CI->parser->parse('supplier/supplier', $data, true);
        return $supplierList;
    }

    //Sub Category Add
    public function supplier_add_form() {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $data = array(
            'title' => 'Add Supplier'
        );
        $supplierForm = $CI->parser->parse('supplier/add_supplier_form', $data, true);
        return $supplierForm;
    }

    public function insert_supplier($data) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $result = $CI->Suppliers->supplier_entry($data);
        if ($result == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //supplier Edit Data
    public function supplier_edit_data($supplier_id) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $supplier_detail = $CI->Suppliers->retrieve_supplier_editdata($supplier_id);
        $data = array(
            'supplier_id' => $supplier_detail[0]['supplier_id'],
            'supplier_name' => $supplier_detail[0]['supplier_name'],
            'address' => $supplier_detail[0]['address'],
            'mobile' => $supplier_detail[0]['mobile'],
            'email' => $supplier_detail[0]['email'],
            'details' => $supplier_detail[0]['details'],
            'status' => $supplier_detail[0]['status'],
            'country' => $supplier_detail[0]['country'],
            'state' => $supplier_detail[0]['state'],
            'city' => $supplier_detail[0]['city'],
            'zip' => $supplier_detail[0]['zip']
        );
        $chapterList = $CI->parser->parse('supplier/edit_supplier_form', $data, true);
        return $chapterList;
    }

    //Supplier Details Data
    public function supplier_detail_data($supplier_id) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $supplier_detail = $CI->Suppliers->supplier_personal_data($supplier_id);
        $purchase_info = $CI->Suppliers->supplier_purchase_data($supplier_id);
        $total_amount = 0;
        if (!empty($purchase_info)) {
            foreach ($purchase_info as $k => $v) {
                $purchase_info[$k]['final_date'] = $CI->occational->dateConvert($purchase_info[$k]['purchase_date']);
                $total_amount = $total_amount + $purchase_info[$k]['grand_total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'supplier_id' => $supplier_detail[0]['supplier_id'],
            'supplier_name' => $supplier_detail[0]['supplier_name'],
            'supplier_address' => $supplier_detail[0]['address'],
            'supplier_mobile' => $supplier_detail[0]['mobile'],
            'details' => $supplier_detail[0]['details'],
            'total_amount' => number_format($total_amount, 2, '.', ','),
            'purchase_info' => $purchase_info,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $chapterList = $CI->parser->parse('supplier/supplier_details', $data, true);
        return $chapterList;
    }

    public function supplier_sales_data($supplier_id) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->library('occational');
        $supplier_detail = $CI->Suppliers->supplier_personal_data($supplier_id);
        $sales_info = $CI->Suppliers->supplier_sales_data($supplier_id, null);

        if (!empty($sales_info)) {
            foreach ($sales_info as $k => $v) {
                $sales_info[$k]['date'] = $CI->occational->dateConvert($sales_info[$k]['date']);
            }
        }
        $data = array(
            'supplier_id' => $supplier_detail[0]['supplier_id'],
            'supplier_name' => $supplier_detail[0]['supplier_name'],
            'supplier_address' => $supplier_detail[0]['address'],
            'supplier_mobile' => $supplier_detail[0]['mobile'],
            'details' => $supplier_detail[0]['details'],
            'sales_info' => $sales_info,
        );
        $sales_report = $CI->parser->parse('supplier/supplier_sales_report', $data, true);
        return $sales_report;
    }

    //Ledger Book Maintaining information....
    public function supplier_ledger($supplier_id, $start, $end) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $supplier = $CI->Suppliers->supplier_list("110", "0");
        $supplier_details = $CI->Suppliers->supplier_personal_data($supplier_id);
        $ledger = $CI->Suppliers->supplier_product_purchase($supplier_id, $start, $end);
        $previouscredit = $CI->Suppliers->supplier_previous_purchase_credit($supplier_id, $start);
        $supplier_debit = $CI->Suppliers->suppliers_transection_debit($supplier_id, $start);
        $summary = $CI->Suppliers->suppliers_transection_summary($supplier_id, $start, $end);

        $total_ammount = 0;
        $total_credit = 0;
        $total_debit = 0;
//        if (!empty($ledger)) {
//            foreach ($ledger as $k => $v) {
//                $ledger[$k]['total_amount'] = $total_ammount + $ledger[$k]['total_taka'];
//                $total_ammount = $ledger[$k]['total_amount'];
//                $ledger[$k]['description'] = "Purchase";
//                $total_credit = $ledger[$k]['total_amount'];
//            }
//        }
//        if (!empty($summary)) {
//            foreach ($summary as $k => $v) {
//                $summary[$k]['total_taka'] = $total_ammount - $summary[$k]['total_debit'];
//                $total_ammount = $summary[$k]['total_taka'];
//
//                $total_debit = $total_debit + $summary[$k]['total_debit'];
//            }
//        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(
            'title' => "Supplier Ledger",
            'supplier_id' => $supplier_details[0]['supplier_id'],
            'supplier_name' => $supplier_details[0]['supplier_name'],
            'address' => $supplier_details[0]['address'],
            'ledger' => $ledger,
            'previous_credit' => $previouscredit[0]['total_credit'],
            'previous_debit' => $supplier_debit[0]['previous_debit'],
            'prveious_balance' => $previouscredit[0]['total_credit'] - $supplier_debit[0]['previous_debit'],
            'summary' => $summary,
            'total_amount' => number_format($total_ammount, 2, '.', ','),
            'SubTotal_debit' => number_format($total_debit, 2, '.', ','),
            'SubTotal_credit' => number_format($total_credit, 2, '.', ','),
            'supplier_ledger' => 'Csupplier/supplier_ledger/' . $supplier_id,
            'supplier' => $supplier,
            'supplier_sales_details' => 'Csupplier/supplier_sales_details/' . $supplier_id,
            'supplier_sales_summary' => 'Csupplier/supplier_sales_summary/' . $supplier_id,
            'sales_payment_actual' => 'Csupplier/sales_payment_actual/' . $supplier_id,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $singlecustomerdetails = $CI->parser->parse('supplier/supplier_purchase_report', $data, true);
        return $singlecustomerdetails;
    }

    public function supplier_sales_details($supplier_id, $links, $per_page, $page, $start, $end) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');

        $supplier_detail = $CI->Suppliers->supplier_personal_data($supplier_id);
        $sales_info = $CI->Suppliers->supplier_sales_details($supplier_id, $per_page, $page, $start, $end);
        $sub_total = 0;
        if (!empty($sales_info)) {
            foreach ($sales_info as $k => $v) {
                $sales_info[$k]['date'] = $CI->occational->dateConvert($sales_info[$k]['date']);
                $sub_total += $sales_info[$k]['total'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => "Supplier Sales Details",
            'supplier_id' => $supplier_detail[0]['supplier_id'],
            'supplier_name' => $supplier_detail[0]['supplier_name'],
            'supplier_address' => $supplier_detail[0]['address'],
            'supplier_mobile' => $supplier_detail[0]['mobile'],
            'details' => $supplier_detail[0]['details'],
            'sub_total' => number_format($sub_total, 2, '.', ','),
            'sales_info' => $sales_info,
            'links' => $links,
            'supplier_ledger' => 'Csupplier/supplier_ledger/' . $supplier_id,
            'supplier_sales_details' => 'Csupplier/supplier_sales_details',
            'supplier_sales_summary' => 'Csupplier/supplier_sales_summary/' . $supplier_id,
            'sales_payment_actual' => 'Csupplier/sales_payment_actual/' . $supplier_id,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $sales_report = $CI->parser->parse('supplier/supplier_sales_details', $data, true);
        return $sales_report;
    }

    ################################################################################################ Supplier sales details all from menu###########

    public function supplier_sales_details_allm($links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $supplier_detail = $CI->Suppliers->supplier_personal_data_all();
        $sales_info = $CI->Suppliers->supplier_sales_details_all($per_page, $page);
        $sub_total = 0;
        if (!empty($sales_info)) {
            foreach ($sales_info as $k => $v) {
                $sales_info[$k]['date'] = $CI->occational->dateConvert($sales_info[$k]['date']);
                $sub_total += $sales_info[$k]['total'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => "Supplier Sales Details",
            'supplier_id' => $supplier_detail[0]['supplier_id'],
            'supplier_name' => $supplier_detail[0]['supplier_name'],
            'supplier_address' => $supplier_detail[0]['address'],
            'supplier_mobile' => $supplier_detail[0]['mobile'],
            'details' => $supplier_detail[0]['details'],
            'sub_total' => number_format($sub_total, 2, '.', ','),
            'sales_info' => $sales_info,
            'links' => $links,
            'supplier_ledger' => 'Csupplier/supplier_ledger/',
            'supplier_sales_details' => 'Csupplier/supplier_sales_details',
            'supplier_sales_summary' => 'Csupplier/supplier_sales_summary/',
            'sales_payment_actual' => 'Csupplier/sales_payment_actual/',
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $sales_report = $CI->parser->parse('supplier/supplier_sales_details', $data, true);
        return $sales_report;
    }

    public function supplier_sales_summary($supplier_id, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $supplier_detail = $CI->Suppliers->supplier_personal_data($supplier_id);
        $sales_info = $CI->Suppliers->supplier_sales_summary($per_page, $page);

        $sub_total = 0;
        if (!empty($sales_info)) {
            foreach ($sales_info as $k => $v) {
                $sales_info[$k]['date'] = $CI->occational->dateConvert($sales_info[$k]['date']);
                $sub_total += $sales_info[$k]['total'];
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => "Supplier Sales Summary",
            'supplier_detail' => $supplier_detail,
            'sub_total' => number_format($sub_total, 2, '.', ','),
            'sales_info' => $sales_info,
            'links' => $links,
            'supplier_ledger' => 'Csupplier/supplier_ledger/' . $supplier_id,
            'supplier_sales_details' => 'Csupplier/supplier_sales_details/' . $supplier_id,
            'supplier_sales_summary' => 'Csupplier/supplier_sales_summary/' . $supplier_id,
            'sales_payment_actual' => 'Csupplier/sales_payment_actual/' . $supplier_id,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $sales_report = $CI->parser->parse('supplier/supplier_sales_summary', $data, true);
        return $sales_report;
    }

    ########################## Sales & Payment ledger #########################
    #	This function will be responsible for retreive all actual sales information 
    # 	as well as payment info.Whatever stock that will not be matter .
    ############################################################################

    function sales_payment_actual($supplier_id, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');

        $sales_payment_actual = $CI->Suppliers->sales_payment_actual($per_page, $page);


        $sup_per_info = $CI->Suppliers->supplier_personal_data($supplier_id);
        $total_amount = 0;
        if (!empty($sales_payment_actual)) {
            foreach ($sales_payment_actual as $k => $v) {
                $sales_payment_actual[$k]['total_amount'] = $total_amount + $sales_payment_actual[$k]['amount'];
                $total_amount = $sales_payment_actual[$k]['total_amount'];
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Supplier Actual Ledger',
            'info' => $CI->Suppliers->supplier_personal_data($supplier_id),
            'total_details' => $CI->Suppliers->sales_payment_actual_total($supplier_id),
            'ledger' => $sales_payment_actual,
            'links' => $links,
            'company_info' => $CI->Suppliers->retrieve_company(),
            'supplier_ledger' => 'Csupplier/supplier_ledger/' . $supplier_id,
            'supplier_sales_details' => 'Csupplier/supplier_sales_details/' . $supplier_id,
            'supplier_sales_summary' => 'Csupplier/supplier_sales_summary/' . $supplier_id,
            'sales_payment_actual' => 'Csupplier/sales_payment_actual/' . $supplier_id,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $sales_actual_report = $CI->parser->parse('supplier/sales_payment_ledger', $data, true);
        return $sales_actual_report;
    }

    //Search supplier
    public function supplier_search_list($cat_id, $company_id) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $category_list = $CI->Suppliers->retrieve_category_list();
        $suppliers_list = $CI->Suppliers->supplier_search_list($cat_id, $company_id);
        $data = array(
            'title' => 'Suppliers List',
            'suppliers_list' => $suppliers_list,
            'category_list' => $category_list
        );
        $supplierList = $CI->parser->parse('supplier/supplier', $data, true);
        return $supplierList;
    }

    ################################################################################################################################################### Supplier Report Part ################################

    public function supplier_ledger_report() {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $supplier = $CI->Suppliers->supplier_list("110", "0");
        $supplier_details = $CI->Suppliers->supplier_personal_data1();

//        $ledger = $CI->Suppliers->supplier_product_purchase_rpt();
        $ledgers = $CI->Suppliers->supplier_product_purchase_rpt();
        $summary = $CI->Suppliers->suppliers_transection_summary1();
//                echo '<pre>';                print_r($ledgers);die();


        $total_ammount = 0;
        $total_credit = 0;
        $total_debit = 0;
        $balance = 0;

//        if (!empty($ledger)) {
//            foreach ($ledger as $k => $v) {
//                $ledger[$k]['total_amount'] = $total_ammount + $ledger[$k]['total_taka'];
//                $total_ammount = $ledger[$k]['total_amount'];
//                $ledger[$k]['description'] = "Purchase";
//                $total_credit = $ledger[$k]['total_amount'];
//            }
//        }
//        if (!empty($summary)) {
//            foreach ($summary as $k => $v) {
//                $summary[$k]['total_taka'] = $total_ammount - $summary[$k]['total_debit'];
//                $total_ammount = $summary[$k]['total_taka'];
//
//                $total_debit = $total_debit + $summary[$k]['total_debit'];
//            }
//        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(
            'title' => "Supplier Ledger",
//            'purchase_id' => $ledger[0]['purchase_id'],
            'ledgers' => $ledgers,
            'summary' => $summary,
            'total_amount' => number_format($total_ammount, 2, '.', ','),
            'SubTotal_debit' => number_format($total_debit, 2, '.', ','),
            'SubTotal_credit' => number_format($total_credit, 2, '.', ','),
            'supplier_ledger' => 'Csupplier/supplier_ledger',
            'supplier' => $supplier,
            // 'supplier_sales_details' => 'Csupplier/supplier_sales_details/'.$supplier_id,
            // 'supplier_sales_summary' => 'Csupplier/supplier_sales_summary/'.$supplier_id,
            // 'sales_payment_actual' => 'Csupplier/sales_payment_actual/'.$supplier_id,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
//        echo '<pre>';        print_r($data);        die();
        $singlecustomerdetails = $CI->parser->parse('supplier/supplier_ledger', $data, true);
        return $singlecustomerdetails;
    }

    // supplier id wise info from view/mange page
    public function supplier_ledger_info($supplier_id) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $supplier_details = $CI->Suppliers->supplier_personal_data($supplier_id);
        $supplier = $CI->Suppliers->supplier_list("110", "0");
        $ledgers = $CI->Suppliers->supplier_product_sale_info($supplier_id);
        $summary = $CI->Suppliers->suppliers_transection_summary_info($supplier_id);

        $total_ammount = 0;
        $total_credit = 0;
        $total_debit = 0;
//        if (!empty($ledger)) {
//            foreach ($ledger as $k => $v) {
//                $ledger[$k]['total_amount'] = $total_ammount + $ledger[$k]['total_taka'];
//                $total_ammount = $ledger[$k]['total_amount'];
//                $ledger[$k]['description'] = "SALE";
//                $total_credit = $ledger[$k]['total_amount'];
//            }
//        }
//        if (!empty($summary)) {
//            foreach ($summary as $k => $v) {
//                $summary[$k]['total_taka'] = $total_ammount - $summary[$k]['total_debit'];
//                $total_ammount = $summary[$k]['total_taka'];
//
//                $total_debit = $total_debit + $summary[$k]['total_debit'];
//            }
//        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(
            'title' => "Supplier Ledger",
            'supplier_id' => $supplier_details[0]['supplier_id'],
            'supplier_name' => $supplier_details[0]['supplier_name'],
            'address' => $supplier_details[0]['address'],
            'ledgers' => $ledgers,
            'summary' => $summary,
            'total_amount' => number_format($total_ammount, 2, '.', ','),
            'SubTotal_debit' => number_format($total_debit, 2, '.', ','),
            'SubTotal_credit' => number_format($total_credit, 2, '.', ','),
            'supplier_ledger' => 'Csupplier/supplier_ledger/' . $supplier_id,
            'supplier_sales_details' => 'Csupplier/supplier_sales_details/' . $supplier_id,
            'supplier_sales_summary' => 'Csupplier/supplier_sales_summary/' . $supplier_id,
            'sales_payment_actual' => 'Csupplier/sales_payment_actual/' . $supplier_id,
            'supplier' => $supplier,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
//        echo '<pre>';        print_r($data);die();
        $singlecustomerdetails = $CI->parser->parse('supplier/supplier_ledger_info', $data, true);
        return $singlecustomerdetails;
    }

    ################################// actual supplier ledger

    public function supplier_actual_ledger() {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $supplier = $CI->Suppliers->supplier_list("110", "0");

        $ledger = $CI->Suppliers->supplier_product_sale_actual();
        $summary = $CI->Suppliers->suppliers_transection_sale_summary_actual();

        $total_ammount = 0;
        $total_credit = 0;
        $total_debit = 0;
        if (!empty($ledger)) {
            foreach ($ledger as $k => $v) {
                $ledger[$k]['total_amount'] = $total_ammount + $ledger[$k]['total_taka'];
                $total_ammount = $ledger[$k]['total_amount'];
                $ledger[$k]['description'] = "SALE";
                $total_credit = $ledger[$k]['total_amount'];
            }
        }
        if (!empty($summary)) {
            foreach ($summary as $k => $v) {
                $summary[$k]['total_taka'] = $total_ammount - $summary[$k]['total_debit'];
                $total_ammount = $summary[$k]['total_taka'];

                $total_debit = $total_debit + $summary[$k]['total_debit'];
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(
            'title' => "Supplier Ledger",
            'ledger' => $ledger,
            'summary' => $summary,
            'total_amount' => number_format($total_ammount, 2, '.', ','),
            'SubTotal_debit' => number_format($total_debit, 2, '.', ','),
            'SubTotal_credit' => number_format($total_credit, 2, '.', ','),
            'supplier_ledger' => 'Csupplier/supplier_actual_ledger_rpt',
            'supplier' => $supplier,
            // 'supplier_sales_details' => 'Csupplier/supplier_sales_details/'.$supplier_id,
            // 'supplier_sales_summary' => 'Csupplier/supplier_sales_summary/'.$supplier_id,
            // 'sales_payment_actual' => 'Csupplier/sales_payment_actual/'.$supplier_id,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
//        echo '<pre>';        print_r($data);die();
        $singlecustomerdetails = $CI->parser->parse('supplier/supplier_actual_ledger', $data, true);
        return $singlecustomerdetails;
    }

    ############# actual supplier ledger report############

    public function supplier_ledger_actual_rpt($supplier_id, $start, $end) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $supplier = $CI->Suppliers->supplier_list("110", "0");
        $supplier_details = $CI->Suppliers->supplier_personal_data($supplier_id, $start, $end);
        $ledger = $CI->Suppliers->supplier_product_sale($supplier_id, $start, $end);
        $crdit_actual_ledger = $CI->Suppliers->supplier_product_sale_previous_credit($supplier_id, $start);
        $supplier_debit = $CI->Suppliers->suppliers_transection_debit($supplier_id, $start);
        $summary = $CI->Suppliers->suppliers_transection_summary($supplier_id, $start, $end);

        $total_ammount = 0;
        $total_credit = 0;
        $total_debit = 0;
        if (!empty($ledger)) {
            foreach ($ledger as $k => $v) {
                $ledger[$k]['total_amount'] = $total_ammount + $ledger[$k]['total_taka'];
                $total_ammount = $ledger[$k]['total_amount'];
                $ledger[$k]['description'] = "SALE";
                $total_credit = $ledger[$k]['total_amount'];
            }
        }
        if (!empty($summary)) {
            foreach ($summary as $k => $v) {
                $summary[$k]['total_taka'] = $total_ammount - $summary[$k]['total_debit'];
                $total_ammount = $summary[$k]['total_taka'];

                $total_debit = $total_debit + $summary[$k]['total_debit'];
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(
            'title' => "Supplier Ledger",
            'supplier_id' => $supplier_details[0]['supplier_id'],
            'supplier_name' => $supplier_details[0]['supplier_name'],
            'address' => $supplier_details[0]['address'],
            'ledger' => $ledger,
            'previous_credit' => $crdit_actual_ledger[0]['total_taka'],
            'previous_debit' => $supplier_debit[0]['previous_debit'],
            'prveious_balance' => $crdit_actual_ledger[0]['total_taka'] - $supplier_debit[0]['previous_debit'],
            'summary' => $summary,
            'total_amount' => number_format($total_ammount, 2, '.', ','),
            'SubTotal_debit' => number_format($total_debit, 2, '.', ','),
            'SubTotal_credit' => number_format($total_credit, 2, '.', ','),
            'supplier_ledger' => 'Csupplier/supplier_actual_ledger_rpt/' . $supplier_id,
            'supplier' => $supplier,
            'supplier_sales_details' => 'Csupplier/supplier_sales_details/' . $supplier_id,
            'supplier_sales_summary' => 'Csupplier/supplier_sales_summary/' . $supplier_id,
            'sales_payment_actual' => 'Csupplier/sales_payment_actual/' . $supplier_id,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $singlecustomerdetails = $CI->parser->parse('supplier/supplier_actual_ledger_rpt', $data, true);
        return $singlecustomerdetails;
    }

    ################# sales ledger for supplier sales price###########

    public function supplier_actual_ledger_sales_price() {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $supplier = $CI->Suppliers->supplier_list("110", "0");

        $ledger = $CI->Suppliers->supplier_product_sale_price();
        $summary = $CI->Suppliers->suppliers_transection_sale_summary_actual();

        $total_ammount = 0;
        $total_credit = 0;
        $total_debit = 0;
        if (!empty($ledger)) {
            foreach ($ledger as $k => $v) {
                $ledger[$k]['total_amount'] = $total_ammount + $ledger[$k]['total_taka'];
                $total_ammount = $ledger[$k]['total_amount'];
                $ledger[$k]['description'] = "SALE";
                $total_credit = $ledger[$k]['total_amount'];
            }
        }
        if (!empty($summary)) {
            foreach ($summary as $k => $v) {
                $summary[$k]['total_taka'] = $total_ammount - $summary[$k]['total_debit'];
                $total_ammount = $summary[$k]['total_taka'];

                $total_debit = $total_debit + $summary[$k]['total_debit'];
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(
            'title' => "Supplier Ledger",
            'ledger' => $ledger,
            'summary' => $summary,
            'total_amount' => number_format($total_ammount, 2, '.', ','),
            'SubTotal_debit' => number_format($total_debit, 2, '.', ','),
            'SubTotal_credit' => number_format($total_credit, 2, '.', ','),
            'supplier_ledger' => 'Csupplier/supplier_actual_ledger_rpt',
            'supplier' => $supplier,
            // 'supplier_sales_details' => 'Csupplier/supplier_sales_details/'.$supplier_id,
            // 'supplier_sales_summary' => 'Csupplier/supplier_sales_summary/'.$supplier_id,
            // 'sales_payment_actual' => 'Csupplier/sales_payment_actual/'.$supplier_id,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $singlecustomerdetails = $CI->parser->parse('supplier/supplier_actual_saleprice', $data, true);
        return $singlecustomerdetails;
    }

    ################# supplier actual ledger sales price ############

    public function supplier_ledger_salesprice_rpt($supplier_id, $start, $end) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $supplier = $CI->Suppliers->supplier_list("110", "0");
        $supplier_details = $CI->Suppliers->supplier_personal_data($supplier_id, $start, $end);
        $ledger = $CI->Suppliers->supplier_product_saleprice($supplier_id, $start, $end);
        $summary = $CI->Suppliers->suppliers_transection_summary($supplier_id, $start, $end);
        $crdit_actual_ledger = $CI->Suppliers->supplier_product_sale_previous_debit($supplier_id, $start);
        $supplier_debit = $CI->Suppliers->suppliers_transection_debit($supplier_id, $start);

        $total_ammount = 0;
        $total_credit = 0;
        $total_debit = 0;
        if (!empty($ledger)) {
            foreach ($ledger as $k => $v) {
                $ledger[$k]['total_amount'] = $total_ammount + $ledger[$k]['total_taka'];
                $total_ammount = $ledger[$k]['total_amount'];
                $ledger[$k]['description'] = "SALE";
                $total_credit = $ledger[$k]['total_amount'];
            }
        }
        if (!empty($summary)) {
            foreach ($summary as $k => $v) {
                $summary[$k]['total_taka'] = $total_ammount - $summary[$k]['total_debit'];
                $total_ammount = $summary[$k]['total_taka'];

                $total_debit = $total_debit + $summary[$k]['total_debit'];
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(
            'title' => "Supplier Ledger",
            'supplier_id' => $supplier_details[0]['supplier_id'],
            'supplier_name' => $supplier_details[0]['supplier_name'],
            'address' => $supplier_details[0]['address'],
            'ledger' => $ledger,
            'summary' => $summary,
            'previous_credit' => $crdit_actual_ledger[0]['total_taka'],
            'previous_debit' => $supplier_debit[0]['previous_debit'],
            'prveious_balance' => $crdit_actual_ledger[0]['total_taka'] - $supplier_debit[0]['previous_debit'],
            'total_amount' => number_format($total_ammount, 2, '.', ','),
            'SubTotal_debit' => number_format($total_debit, 2, '.', ','),
            'SubTotal_credit' => number_format($total_credit, 2, '.', ','),
            'supplier_ledger' => 'Csupplier/supplier_actual_ledger_rpt/' . $supplier_id,
            'supplier' => $supplier,
            'supplier_sales_details' => 'Csupplier/supplier_sales_details/' . $supplier_id,
            'supplier_sales_summary' => 'Csupplier/supplier_sales_summary/' . $supplier_id,
            'sales_payment_actual' => 'Csupplier/sales_payment_actual/' . $supplier_id,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $singlecustomerdetails = $CI->parser->parse('supplier/supplier_actual_salesledger_rpt', $data, true);
        return $singlecustomerdetails;
    }

    ############# Supplier Payment report ############

    public function supplier_payment() {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $supplier = $CI->Suppliers->supplier_list("110", "0");

        $ledger = $CI->Suppliers->supplier_payment_ledger();
//        echo '<pre>';        print_r($ledger);die();

        $total_ammount = 0;
        $total_credit = 0;
        $total_debit = 0;
//        if (!empty($ledger)) {
//            foreach ($ledger as $k => $v) {
//                $ledger[$k]['total_amount'] = $total_ammount + $ledger[$k]['total_taka'];
//                $total_ammount = $ledger[$k]['total_amount'];
//                $ledger[$k]['description'] = $ledger[$k]['description'];
//                $total_credit = $ledger[$k]['total_amount'];
//            }
//        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(
            'title' => "Supplier Ledger",
            'ledger' => $ledger,
            'total_amount' => number_format($total_ammount, 2, '.', ','),
            'SubTotal_credit' => number_format($total_credit, 2, '.', ','),
            'supplier' => $supplier,
            // 'supplier_sales_details' => 'Csupplier/supplier_sales_details/'.$supplier_id,
            // 'supplier_sales_summary' => 'Csupplier/supplier_sales_summary/'.$supplier_id,
            // 'sales_payment_actual' => 'Csupplier/sales_payment_actual/'.$supplier_id,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $singlecustomerdetails = $CI->parser->parse('supplier/supplier_payment', $data, true);
        return $singlecustomerdetails;
    }

    ############### supplier payment report by id ##########

    public function supplier_payment_report($supplier_id, $start, $end, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $supplier = $CI->Suppliers->supplier_list("110", "0");
        $supplier_details = $CI->Suppliers->supplier_personal_data($supplier_id);

        $ledger = $CI->Suppliers->supplier_payment_report($supplier_id, $start, $end, $per_page, $page);
        $previousbalance = $CI->Suppliers->supplier_payment_last($supplier_id, $start);

        $total_ammount = 0;
        $total_credit = 0;
        $total_debit = 0;
        if (!empty($ledger)) {
            foreach ($ledger as $k => $v) {
                $ledger[$k]['total_amount'] = $total_ammount + $ledger[$k]['total_taka'];
                $total_ammount = $ledger[$k]['total_amount'];
                $ledger[$k]['description'] = $ledger[$k]['description'];
                $total_credit = $ledger[$k]['total_amount'];
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(
            'title' => "Supplier Ledger",
            'supplier_id' => $supplier_details[0]['supplier_id'],
            'supplier_name' => $supplier_details[0]['supplier_name'],
            'address' => $supplier_details[0]['address'],
            'prviousbalance' => $previousbalance[0]['pay_amount'],
            'ledger' => $ledger,
            'links' => $links,
            'total_amount' => number_format($total_ammount, 2, '.', ','),
            'SubTotal_credit' => number_format($total_credit, 2, '.', ','),
            'supplier' => $supplier,
            // 'supplier_sales_details' => 'Csupplier/supplier_sales_details/'.$supplier_id,
            // 'supplier_sales_summary' => 'Csupplier/supplier_sales_summary/'.$supplier_id,
            // 'sales_payment_actual' => 'Csupplier/sales_payment_actual/'.$supplier_id,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $singlecustomerdetails = $CI->parser->parse('supplier/supplier_payment_report', $data, true);
        return $singlecustomerdetails;
    }

}

?>