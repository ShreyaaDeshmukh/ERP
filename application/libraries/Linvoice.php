<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Linvoice {

    //Retrieve  Invoice List
    public function invoice_list($links, $perpage, $page) {

        $CI = & get_instance();
        $CI->load->model('Invoices');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');

        $invoices_list = $CI->Invoices->invoice_list($perpage, $page);
        if (!empty($invoices_list)) {
            foreach ($invoices_list as $k => $v) {
                $invoices_list[$k]['final_date'] = $CI->occational->dateConvert($invoices_list[$k]['date']);
            }
            $i = 0;
            foreach ($invoices_list as $k => $v) {
                $i++;
                $invoices_list[$k]['sl'] = $i;
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Invoices List',
            'invoices_list' => $invoices_list,
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $invoiceList = $CI->parser->parse('invoice/invoice', $data, true);
        return $invoiceList;
    }

    //Pos invoice add form
    public function pos_invoice_add_form() {
        $CI = & get_instance();
        $CI->load->model('Invoices');
        $customer_details = $CI->Invoices->pos_customer_setup();

        $data = array(
            'title' => 'Add invoice',
            'customer_name' => $customer_details[0]['customer_name'],
            'customer_id' => $customer_details[0]['customer_id']
        );
        $invoiceForm = $CI->parser->parse('invoice/add_pos_invoice_form', $data, true);
        return $invoiceForm;
    }

    //Retrieve  Invoice List
    public function search_inovoice_item($customer_id) {
        $CI = & get_instance();
        $CI->load->model('Invoices');
        $CI->load->library('occational');
        $invoices_list = $CI->Invoices->search_inovoice_item($customer_id);
        if (!empty($invoices_list)) {
            foreach ($invoices_list as $k => $v) {
                $invoices_list[$k]['final_date'] = $CI->occational->dateConvert($invoices_list[$k]['date']);
            }
            $i = 0;
            foreach ($invoices_list as $k => $v) {
                $i++;
                $invoices_list[$k]['sl'] = $i;
            }
        }
        $data = array(
            'title' => 'Invoices Search Item',
            'invoices_list' => $invoices_list
        );
        $invoiceList = $CI->parser->parse('invoice/invoice', $data, true);
        return $invoiceList;
    }

    //Sub Category Add
    public function invoice_add_form() {
        $CI = & get_instance();
        $CI->load->model('Invoices');
        $data = array(
            'title' => 'Add invoice'
        );
        $invoiceForm = $CI->parser->parse('invoice/add_invoice_form', $data, true);
        return $invoiceForm;
    }

    public function insert_invoice($data) {
        $CI = & get_instance();
        $CI->load->model('Invoices');
        $CI->Invoices->invoice_entry($data);
        return true;
    }

    //invoice Edit Data
    public function invoice_edit_data($invoice_id) {
        $CI = & get_instance();
        $CI->load->model('Invoices');
        $invoice_detail = $CI->Invoices->retrieve_invoice_editdata($invoice_id);

        foreach ($invoice_detail as $k => $v) {
            $invoice_detail[$k]['per_cartoon'] = ($invoice_detail[$k]['quantity'] / $invoice_detail[$k]['cartoon']);
        }
        $i = 0;
        foreach ($invoice_detail as $k => $v) {
            $i++;
            $invoice_detail[$k]['sl'] = $i;
        }


        $data = array(
            'invoice_id' => $invoice_detail[0]['invoice_id'],
            'customer_id' => $invoice_detail[0]['customer_id'],
            'customer_name' => $invoice_detail[0]['customer_name'],
            'date' => $invoice_detail[0]['date'],
            'total_amount' => $invoice_detail[0]['total_amount'],
            'paid_amount' => $invoice_detail[0]['paid_amount'],
            'due_amount' => $invoice_detail[0]['due_amount'],
            'tax' => $invoice_detail[0]['tax'],
            'total_tax' => $invoice_detail[0]['total_tax'],
            'total_discount' => $invoice_detail[0]['total_discount'],
            'invoice_all_data' => $invoice_detail
        );
        $chapterList = $CI->parser->parse('invoice/edit_invoice_form', $data, true);
        return $chapterList;
    }

    //invoice html Data
    public function invoice_html_data($invoice_id) {
        $CI = & get_instance();
        $CI->load->model('Invoices');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $invoice_detail = $CI->Invoices->retrieve_invoice_html_data($invoice_id);


        $subTotal_quantity = 0;
        $subTotal_cartoon = 0;
        $subTotal_discount = 0;
        $subTotal_ammount = 0;
        if (!empty($invoice_detail)) {
            foreach ($invoice_detail as $k => $v) {
                $invoice_detail[$k]['final_date'] = $CI->occational->dateConvert($invoice_detail[$k]['date']);

                $invoice_detail[$k]['per_cartoon'] = $invoice_detail[$k]['quantity'] / $invoice_detail[$k]['cartoon'];

                $subTotal_quantity = $subTotal_quantity + $invoice_detail[$k]['quantity'];

                $subTotal_ammount = $subTotal_ammount + $invoice_detail[$k]['total_price'];

                $subTotal_cartoon = $subTotal_cartoon + $invoice_detail[$k]['cartoon'];
            }

            $i = 0;
            foreach ($invoice_detail as $k => $v) {
                $i++;
                $invoice_detail[$k]['sl'] = $i;
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $company_info = $CI->Invoices->retrieve_company();
        $data = array(
            'ttile' => "Invoice View",
            'invoice_id' => $invoice_detail[0]['invoice_id'],
            'invoice_no' => $invoice_detail[0]['invoice'],
            'customer_name' => $invoice_detail[0]['customer_name'],
            'customer_address' => $invoice_detail[0]['customer_address'],
            'customer_mobile' => $invoice_detail[0]['customer_mobile'],
            'customer_email' => $invoice_detail[0]['customer_email'],
            'final_date' => $invoice_detail[0]['final_date'],
            'total_amount' => number_format($invoice_detail[0]['total_amount'], 2, '.', ','),
            'subTotal_cartoon' => $subTotal_cartoon,
            'subTotal_quantity' => $subTotal_quantity,
            'total_discount' => number_format($invoice_detail[0]['total_discount'], 2, '.', ','),
            'subTotal_ammount' => number_format($subTotal_ammount, 2, '.', ','),
            'tax' => number_format($invoice_detail[0]['tax'], 2, '.', ','),
            'paid_amount' => number_format($invoice_detail[0]['paid_amount'], 2, '.', ','),
            'due_amount' => number_format($invoice_detail[0]['due_amount'], 2, '.', ','),
            'invoice_all_data' => $invoice_detail,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $chapterList = $CI->parser->parse('invoice/invoice_html', $data, true);
        return $chapterList;
    }

    //POS invoice html Data
    public function pos_invoice_html_data($invoice_id) {
        $CI = & get_instance();
        $CI->load->model('Invoices');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $invoice_detail = $CI->Invoices->retrieve_invoice_html_data($invoice_id);

        $subTotal_quantity = 0;
        $subTotal_cartoon = 0;
        $subTotal_discount = 0;
        $subTotal_ammount = 0;
        if (!empty($invoice_detail)) {
            foreach ($invoice_detail as $k => $v) {
                $invoice_detail[$k]['final_date'] = $CI->occational->dateConvert($invoice_detail[$k]['date']);

                $invoice_detail[$k]['per_cartoon'] = $invoice_detail[$k]['quantity'] / $invoice_detail[$k]['cartoon'];

                $subTotal_quantity = $subTotal_quantity + $invoice_detail[$k]['quantity'];

                $subTotal_ammount = $subTotal_ammount + $invoice_detail[$k]['total_price'];

                $subTotal_cartoon = $subTotal_cartoon + $invoice_detail[$k]['cartoon'];
            }

            $i = 0;
            foreach ($invoice_detail as $k => $v) {
                $i++;
                $invoice_detail[$k]['sl'] = $i;
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $company_info = $CI->Invoices->retrieve_company();
        $data = array(
            'ttile' => "Invoice View",
            'invoice_id' => $invoice_detail[0]['invoice_id'],
            'invoice_no' => $invoice_detail[0]['invoice'],
            'customer_name' => $invoice_detail[0]['customer_name'],
            'customer_address' => $invoice_detail[0]['customer_address'],
            'customer_mobile' => $invoice_detail[0]['customer_mobile'],
            'customer_email' => $invoice_detail[0]['customer_email'],
            'final_date' => $invoice_detail[0]['final_date'],
            'total_amount' => number_format($invoice_detail[0]['total_amount'], 2, '.', ','),
            'subTotal_cartoon' => $subTotal_cartoon,
            'subTotal_quantity' => $subTotal_quantity,
            'total_discount' => number_format($invoice_detail[0]['total_discount'], 2, '.', ','),
            'subTotal_ammount' => number_format($subTotal_ammount, 2, '.', ','),
            'tax' => number_format($invoice_detail[0]['tax'], 2, '.', ','),
            'paid_amount' => number_format($invoice_detail[0]['paid_amount'], 2, '.', ','),
            'due_amount' => number_format($invoice_detail[0]['due_amount'], 2, '.', ','),
            'invoice_all_data' => $invoice_detail,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $chapterList = $CI->parser->parse('invoice/pos_invoice_html', $data, true);
        return $chapterList;
    }

    //Retrieve invoice data by receipt id
    public function receipt_html_data($receipt_id) {
        $CI = & get_instance();
        $CI->load->model('Invoices');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $invoice_detail = $CI->Invoices->retrieve_receipt_html_data($receipt_id);

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $weblogo = $CI->Invoices->retript_web_logo();
        $company_info = $CI->Invoices->retrieve_company();
        $data = array(
            'ttile' => "Invoice View",
            'receipt_no' => $invoice_detail[0]['receipt_no'],
            'customer_name' => $invoice_detail[0]['customer_name'],
            'date' => $invoice_detail[0]['date'],
            'amount' => $invoice_detail[0]['amount'],
            'total_amount' => $invoice_detail[0]['total_amount'],
            'check_no' => $invoice_detail[0]['cheque_no'],
            'description' => $invoice_detail[0]['description'],
            'company_info' => $company_info,
            'logo' => $weblogo[0]['logo'],
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $chapterList = $CI->parser->parse('invoice/receipt_html', $data, true);
        return $chapterList;
    }

}

?>