<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lpayment {

    public function payement_form() {

        $CI = & get_instance();
        $CI->load->model('Payment');
        $CI->load->model('Suppliers');
        $CI->load->model('Customers');
        $CI->load->model('Settings');
        $CI->load->model('Accounts'); //
        $bank = $CI->Settings->get_bank_list();
        $supplier = $CI->Suppliers->supplier_list("110", "0");
        $customer = $CI->Customers->customer_list("110", "0");
        $account_list = $CI->Payment->account_list("110", "0");
        $account_list_category = $CI->Payment->account_list_category("110", "0");
        $payment = $CI->Accounts->accounts_name_finder(2);
        $expense = $CI->Accounts->accounts_name_finder(1);
        $loan_list = $CI->Settings->loan_list();
        $data = array(
            'title' => 'Add Payement',
            'supplier' => $supplier,
            'customer' => $customer,
            'bank' => $bank,
            'account_list' => $account_list,
            'accounts' => $payment,
            'expense' => $expense,
            'trans_category' => $account_list_category,
            'loan_list' => $loan_list,
        );

        $paymentform = $CI->parser->parse('payment/form', $data, true);
        return $paymentform;
    }

    public function receipt_form() {

        $CI = & get_instance();
        $CI->load->model('Payment');
        $CI->load->model('Suppliers');
        $CI->load->model('Customers');
        $CI->load->model('Settings');
        $CI->load->model('Accounts'); //
        $bank = $CI->Settings->get_bank_list();
        $supplier = $CI->Suppliers->supplier_list("110", "0");
        $customer = $CI->Customers->customer_list("110", "0");
        $account_list_category = $CI->Payment->account_list_category("110", "0");
        $account_list = $CI->Payment->account_list("110", "0");
        $payment = $CI->Accounts->accounts_name_finder(2);
        $expense = $CI->Accounts->accounts_name_finder(1);
        $loan_list = $CI->Settings->loan_list();
        $data = array(
            'title' => 'Add Payement',
            'supplier' => $supplier,
            'customer' => $customer,
            'bank' => $bank,
            'account_list' => $account_list,
            'accounts' => $payment,
            'trans_category' => $account_list_category,
            'expense' => $expense,
            'loan_list' => $loan_list,
        );

        $paymentform = $CI->parser->parse('payment/receipt_form', $data, true);
        return $paymentform;
    }

    public function payment_list() {
        $CI = & get_instance();
        $CI->load->model('Payment');

        $transactions = $CI->Payment->get_transaction_info();
//        echo '<pre>';        print_r($transactions);die();

        $ledger = $CI->Payment->date_summary_query();
        $category = $CI->Payment->tran_cat_list();

        $balance = 0;
        $total_credit = 0;
        $total_debit = 0;
        $total_balance = 0;

//        if (!empty($ledger)) {
//            foreach ($ledger as $k => $v) {
//                $ledger[$k]['balance'] = ($ledger[$k]['debit'] - $ledger[$k]['credit']) + $balance;
//                $balance = $ledger[$k]['balance'];
//
//                $ledger[$k]['subtotalDebit'] = $total_debit + $ledger[$k]['debit'];
//                $total_debit = $ledger[$k]['subtotalDebit'];
//
//                $ledger[$k]['subtotalCredit'] = $total_credit + $ledger[$k]['credit'];
//                $total_credit = $ledger[$k]['subtotalCredit'];
//
//                $ledger[$k]['subtotalBalance'] = $total_balance + $ledger[$k]['balance'];
//                $total_balance = $ledger[$k]['subtotalBalance'];
//            }
//        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            //'person_details_all' => $person_details_all,
            //'person_details' => $ledger[$k]['transection_category'],

            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            'ledger' => $ledger,
            'transactions' => $transactions,
            'transaction_id' => @$ledger[0]['transaction_id'],
            //'invoice_no'    => $invoice,
            'category' => $category,
            //'invoice'       => $invoice,
            'subtotalDebit' => number_format($total_debit, 2, '.', ','),
            'subtotalCredit' => number_format($total_credit, 2, '.', ','),
            'subtotalBalance' => number_format($total_balance, 2, '.', ','),
            'links' => '',
        );
        $chapterList = $CI->parser->parse('payment/payment', $data, true);
        return $chapterList;
    }

    public function payment_up_data($trans) {
        $CI = & get_instance();
        $CI->load->model('Payment');
        $CI->load->model('Suppliers');
        $CI->load->model('Customers');
        $CI->load->model('Settings');
        $CI->load->model('Accounts'); //


        $bank = $CI->Settings->get_bank_list();
        $supplier = $CI->Suppliers->supplier_list("110", "0");
        $customer = $CI->Customers->customer_list("110", "0");
        $account_list = $CI->Payment->account_list("110", "0");
        $payment = $CI->Accounts->accounts_name_finder(2);
        $expense = $CI->Accounts->accounts_name_finder(1);
        $loan_list = $CI->Settings->loan_list(); 
        
        $payment = $CI->Payment->payment_updata($trans);
        @$category_id = $payment[0]['transection_category'];
//        echo '<pre>';        print_r(@$category_id);die();
        $category_selected = $CI->Payment->selected_transection($category_id); //
        $supplier_selected = $CI->Payment->selected_supplier($trans);
        $customer_selected = $CI->Payment->selected_customer($trans);
        $tran_type_selected = $CI->Payment->selected_transection_type($trans);
        $loan_selected = $CI->Payment->selected_loan($trans);
        $office_selected = $CI->Payment->selected_office_trns($trans);
        $category = $CI->Payment->tran_cat_list();

        $data = array(
            'transaction_id' => $payment[0]['transaction_id'],
            'date_of_transection' => $payment[0]['date_of_transection'],
            'relation_id' => $payment[0]['relation_id'],
            'transection_category' => $payment[0]['transection_category'],
            'transection_type' => $payment[0]['transection_type'],
            'description' => $payment[0]['description'],
            'amount' => $payment[0]['amount'],
            'pay_amount' => $payment[0]['pay_amount'],
            'category_list' => $category,
            'category_selected' => $category_selected,
            'supplier_seleced' => $supplier_selected,
            'office' => $office_selected,
            'customer_id' => $customer_selected[0]['customer_name'],
            'sel_loan' => $loan_selected[0]['person_name'],
            'supplier' => $supplier,
            'customer' => $customer,
            'bank' => $bank,
            'trn_mood' => $payment[0]['transection_mood'],
            'tran_type' => $tran_type_selected[0]['transection_type'],
            'account_list' => $account_list,
            'accounts' => $payment,
            'expense' => $expense,
            'loan_list' => $loan_list,
        );
        $updatepayment = $CI->parser->parse('payment/update_payment', $data, true);
        return $updatepayment;
    }

// transection report start
    public function transection_report_details() {
        $CI = & get_instance();
        $CI->load->model('Payment');
        $CI->load->model('Web_settings');
        $trans_report = $CI->Payment->transection_report();

        $i = 0;
        if (!empty($trans_report)) {
            foreach ($trans_report as $k => $v) {
                $i++;
                $trans_report[$k]['sl'] = $i;
            }
        }
        $data = array(
            'title' => 'report List',
            'trans_report' => $trans_report,
        );

        $report = $CI->parser->parse('payment/trans_details', $data, true);
        return $report;
    }

    // transection details by id
    public function transection_data($id) {
        $CI = & get_instance();
        $CI->load->model('Payment');

        $ledger = $CI->Payment->transection_rp_id($id);


        $data = array(
            'trans' => $ledger,
        );

        $chapterList = $CI->parser->parse('payment/detail_byid', $data, true);
        return $chapterList;
    }

    // transaction report
    public function trans_data() {
        $CI = & get_instance();
        $CI->load->model('Payment');

        // $person_details_all = $CI->Settings->person_list();
        // $person_details = $CI->Settings->select_person_by_id($person_id);
        $ledger = $CI->Payment->tran_rep_query();

        $balance = 0;
        $total_credit = 0;
        $total_debit = 0;
        $total_balance = 0;

        if (!empty($ledger)) {
            foreach ($ledger as $k => $v) {
                $ledger[$k]['balance'] = ($ledger[$k]['debit'] - $ledger[$k]['credit']) + $balance;
                $balance = $ledger[$k]['balance'];

                $ledger[$k]['subtotalDebit'] = $total_debit + $ledger[$k]['debit'];
                $total_debit = $ledger[$k]['subtotalDebit'];

                $ledger[$k]['subtotalCredit'] = $total_credit + $ledger[$k]['credit'];
                $total_credit = $ledger[$k]['subtotalCredit'];

                $ledger[$k]['subtotalBalance'] = $total_balance + $ledger[$k]['balance'];
                $total_balance = $ledger[$k]['subtotalBalance'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            'ledger' => $ledger,
            'subtotalDebit' => number_format($total_debit, 2, '.', ','),
            'subtotalCredit' => number_format($total_credit, 2, '.', ','),
            'subtotalBalance' => number_format($total_balance, 2, '.', ','),
            'links' => '',
        );
        $chapterList = $CI->parser->parse('payment/trans_report', $data, true);
        return $chapterList;
    }

    // date wise report
    public function trans_datewise_data() {
        $CI = & get_instance();
        $CI->load->model('Payment');

        // $person_details_all = $CI->Settings->person_list();
        // $person_details = $CI->Settings->select_person_by_id($person_id);
        $ledger = $CI->Payment->date_summary_query();
//        echo '<pre>';        print_r($ledger);die();
        $balance = 0;
        $total_credit = 0;
        $total_debit = 0;
        $total_balance = 0;

//        if (!empty($ledger)) {
//            foreach ($ledger as $k => $v) {
//                $ledger[$k]['balance'] = ($ledger[$k]['debit'] - $ledger[$k]['credit']) + $balance;
//                $balance = $ledger[$k]['balance'];
//
//                $ledger[$k]['subtotalDebit'] = $total_debit + $ledger[$k]['debit'];
//                $total_debit = $ledger[$k]['subtotalDebit'];
//
//                $ledger[$k]['subtotalCredit'] = $total_credit + $ledger[$k]['credit'];
//                $total_credit = $ledger[$k]['subtotalCredit'];
//
//                $ledger[$k]['subtotalBalance'] = $total_balance + $ledger[$k]['balance'];
//                $total_balance = $ledger[$k]['subtotalBalance'];
//            }
//        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            'ledger' => $ledger,
            'subtotalDebit' => number_format($total_debit, 2, '.', ','),
            'subtotalCredit' => number_format($total_credit, 2, '.', ','),
            'subtotalBalance' => number_format($total_balance, 2, '.', ','),
            'links' => '',
        );
        $chapterList = $CI->parser->parse('payment/date_wise', $data, true);
        return $chapterList;
    }

    //date between search result
    public function result_datewise_data($start, $end) {
        $CI = & get_instance();
        $CI->load->model('Payment');

        // $person_details_all = $CI->Settings->person_list();
        // $person_details = $CI->Settings->select_person_by_id($person_id);
        $ledger = $CI->Payment->search_query($start, $end);

        $balance = 0;
        $total_credit = 0;
        $total_debit = 0;
        $total_balance = 0;

        if (!empty($ledger)) {
            foreach ($ledger as $k => $v) {
                $ledger[$k]['balance'] = ($ledger[$k]['debit'] - $ledger[$k]['credit']) + $balance;
                $balance = $ledger[$k]['balance'];

                $ledger[$k]['subtotalDebit'] = $total_debit + $ledger[$k]['debit'];
                $total_debit = $ledger[$k]['subtotalDebit'];

                $ledger[$k]['subtotalCredit'] = $total_credit + $ledger[$k]['credit'];
                $total_credit = $ledger[$k]['subtotalCredit'];

                $ledger[$k]['subtotalBalance'] = $total_balance + $ledger[$k]['balance'];
                $total_balance = $ledger[$k]['subtotalBalance'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            //'person_details_all' => $person_details_all,
            //'person_details' => $ledger[$k]['transection_category'],

            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            'ledger' => $ledger,
            'subtotalDebit' => number_format($total_debit, 2, '.', ','),
            'subtotalCredit' => number_format($total_credit, 2, '.', ','),
            'subtotalBalance' => number_format($total_balance, 2, '.', ','),
            'links' => '',
        );
        $chapterList = $CI->parser->parse('payment/date_wise', $data, true);
        return $chapterList;
    }

    // customr report data
    public function trans_custom_report_data() {
        $CI = & get_instance();
        $CI->load->model('Payment');

        // $person_details_all = $CI->Settings->person_list();
        // $person_details = $CI->Settings->select_person_by_id($person_id);
        $ledger = $CI->Payment->date_summary_query();
        $category = $CI->Payment->tran_cat_list();
        //@$transaction_id = $ledger[0]['transaction_id'];
        //$invoice  = $CI->Payment->invoice($customer);
        // @$customer= $ledger[0]['transaction_id'];
        //$invoice=$CI->Payment->invoice($transaction_id);
        $balance = 0;
        $total_credit = 0;
        $total_debit = 0;
        $total_balance = 0;

//        if (!empty($ledger)) {
//            foreach ($ledger as $k => $v) {
//                $ledger[$k]['balance'] = ($ledger[$k]['debit'] - $ledger[$k]['credit']) + $balance;
//                $balance = $ledger[$k]['balance'];
//
//                $ledger[$k]['subtotalDebit'] = $total_debit + $ledger[$k]['debit'];
//                $total_debit = $ledger[$k]['subtotalDebit'];
//
//                $ledger[$k]['subtotalCredit'] = $total_credit + $ledger[$k]['credit'];
//                $total_credit = $ledger[$k]['subtotalCredit'];
//
//                $ledger[$k]['subtotalBalance'] = $total_balance + $ledger[$k]['balance'];
//                $total_balance = $ledger[$k]['subtotalBalance'];
//            }
//        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            //'person_details_all' => $person_details_all,
            //'person_details' => $ledger[$k]['transection_category'],

            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            'ledger' => $ledger,
            //'invoice_no'    => $invoice,
            'category' => $category,
            //'invoice'       => $invoice,
            'subtotalDebit' => number_format($total_debit, 2, '.', ','),
            'subtotalCredit' => number_format($total_credit, 2, '.', ','),
            'subtotalBalance' => number_format($total_balance, 2, '.', ','),
            'links' => '',
        );
        $chapterList = $CI->parser->parse('payment/custom_report', $data, true);
        return $chapterList;
    }

    // custom report search result info
    public function custom_result_datewise_data($start, $end, $account) {
        $CI = & get_instance();
        $CI->load->model('Payment');

        // $person_details_all = $CI->Settings->person_list();
        // $person_details = $CI->Settings->select_person_by_id($person_id);
        $category = $CI->Payment->tran_cat_list();
        $ledger = $CI->Payment->custom_search_query($start, $end, $account);


        $balance = 0;
        $total_credit = 0;
        $total_debit = 0;
        $total_balance = 0;

        if (!empty($ledger)) {
            foreach ($ledger as $k => $v) {
                $ledger[$k]['balance'] = (is_numeric($ledger[$k]['debit']) - is_numeric($ledger[$k]['credit'])) + $balance;
                $balance = $ledger[$k]['balance'];

                $ledger[$k]['subtotalDebit'] = is_numeric($total_debit) + is_numeric($ledger[$k]['debit']);
                $total_debit = $ledger[$k]['subtotalDebit'];

                $ledger[$k]['subtotalCredit'] = $total_credit + $ledger[$k]['credit'];
                $total_credit = $ledger[$k]['subtotalCredit'];

                $ledger[$k]['subtotalBalance'] = $total_balance + $ledger[$k]['balance'];
                $total_balance = $ledger[$k]['subtotalBalance'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            //'person_details_all' => $person_details_all,
            //'person_details' => $ledger[$k]['transection_category'],

            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            'ledger' => $ledger,
            'category' => $category,
            'subtotalDebit' => number_format($total_debit, 2, '.', ','),
            'subtotalCredit' => number_format($total_credit, 2, '.', ','),
            'subtotalBalance' => number_format($total_balance, 2, '.', ','),
            'links' => '',
        );
        $chapterList = $CI->parser->parse('payment/custom_report_datewise', $data, true);
        return $chapterList;
    }

}
