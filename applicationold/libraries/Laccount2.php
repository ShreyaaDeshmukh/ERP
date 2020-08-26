<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laccount2 {

    public function account_form() {

        $CI = & get_instance();
        $CI->load->model('Account_2');
        $account = $CI->Account_2->account_list("110", "0");
        $data = array(
            'title' => 'Add Account',
            'account' => $account,
        );

        $account = $CI->parser->parse('account2/form', $data, true);
        return $account;
    }

    public function account_list() {
        $CI = & get_instance();
        $CI->load->model('Account_2');
        $CI->load->model('Web_settings');
        $account_list = $CI->Account_2->account_list();

        $i = 0;
        if (!empty($account_list)) {
            foreach ($account_list as $k => $v) {
                $i++;
                $account_list[$k]['sl'] = $i;
            }
        }
        $data = array(
            'title' => 'Account List',
            'account_list' => $account_list,
        );

        $payment = $CI->parser->parse('account2/account', $data, true);
        return $payment;
    }

    public function account_up_data($id) {
        $CI = & get_instance();
        $CI->load->model('Account_2');
        $account = $CI->Account_2->account_updata($id);
        $data = array(
            'account_id' => $account[0]['account_id'],
            'account_name' => $account[0]['account_name'],
            'parent_id' => $account[0]['parent_id'],
        );
        $updateaccount = $CI->parser->parse('account2/update_account', $data, true);
        return $updateaccount;
    }

    public function trans_custom_report_data($category_id) {
        $CI = & get_instance();
        $CI->load->model('Account_2');
        $CI->load->model('Web_settings');
        $CI->load->model('Payment');

        // $person_details_all = $CI->Settings->person_list();
        // $person_details = $CI->Settings->select_person_by_id($person_id);
        $ledger = $CI->Account_2->date_summary_query($category_id);
        $category = $CI->Payment->tran_cat_list();
        //@$transaction_id = $ledger[0]['transaction_id'];
        //$invoice  = $CI->Payment->invoice($customer);
        // @$customer= $ledger[0]['transaction_id'];
        //$invoice=$CI->Payment->invoice($transaction_id);
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

}
