<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lsettings {
	#===============Bank list============#
	public function bank_list()
	{
		$CI =& get_instance();
		$CI->load->model('Settings');
		$bank_list = $CI->Settings->get_bank_list( );
		$i=0;
		if(!empty($bank_list)){		
			foreach($bank_list as $k=>$v){$i++;
			   $bank_list[$k]['sl']=$i;
			}
		}
		$data = array(
				'title' => 'Bank List',
				'bank_list' => $bank_list
			);
		$bankList = $CI->parser->parse('settings/bank',$data,true);
		return $bankList;
	}
	//Add person
	public function add_person()
	{
		$CI =& get_instance();
		$CI->load->model('Settings');
		
		$data = array(
				'title' => 'Add Person'
			);
		$bankList = $CI->parser->parse('settings/add_person',$data,true);
		return $bankList;
	}	

	//personal loan
	public function add_person1()
	{
		$CI =& get_instance();
		$CI->load->model('Settings');
		
		$data = array(
				'title' => 'Add Person'
			);
		$bankList = $CI->parser->parse('settings/add_person1',$data,true);
		return $bankList;
	}	

	//Add loan
	public function add_loan()
	{
		$CI =& get_instance();
		$CI->load->model('Settings');
		$person_list = $CI->Settings->person_list_personal_loan();
		
		$data = array(
				'title' => 'Add Loan',
				'person_list' => $person_list,
			);
		$add_loan = $CI->parser->parse('settings/add_loan',$data,true);
		return $add_loan;
	}	
	//Add payment
	public function add_payment()
	{
		$CI =& get_instance();
		$CI->load->model('Settings');
		$person_list = $CI->Settings->person_list_personal_loan();
		
		$data = array(
				'title' => 'Add Payment',
				'person_list' => $person_list,
			);
		$add_payment = $CI->parser->parse('settings/add_payment',$data,true);
		return $add_payment;
	}	
	//Manage person
	public function manage_person($links,$per_page,$limit)
	{
		$CI =& get_instance();
		$CI->load->model('Settings');
		$person_list = $CI->Settings->person_list_limt($per_page,$limit);
		
		$data = array(
				'title' => 'Manage Person',
				'person_list' => $person_list,
				'links'		=>$links
			);
		$manage_person = $CI->parser->parse('settings/manage_person',$data,true);
		return $manage_person;
	}	
	//Edit person
	//Manage personal loan person information 
	public function manage_person_loan_person($links,$per_page,$limit)
	{
		$CI =& get_instance();
		$CI->load->model('Settings');
		$person_list = $CI->Settings->person_list_limt_loan($per_page,$limit);
		
		$data = array(
				'title'       => 'Manage Person',
				'person_list' => $person_list,
				'links'		  =>$links
			);
		$manage_person = $CI->parser->parse('settings/peson_loan_manage',$data,true);
		return $manage_person;
	}	
	public function edit_person($person_id)
	{
		$CI =& get_instance();
		$CI->load->model('Settings');
		$person_list = $CI->Settings->select_person_by_id($person_id);

		$data = array(
				'title' => 'Manage Person',
				'person_id' => $person_list[0]['person_id'],
				'person_name' => $person_list[0]['person_name'],
				'person_phone' => $person_list[0]['person_phone'],
				'person_address' => $person_list[0]['person_address'],
			);

		$manage_person = $CI->parser->parse('settings/person_edit',$data,true);
		return $manage_person;
	}
	//personal loan update date
	public function edit_person_loan($person_id)
	{
		$CI =& get_instance();
		$CI->load->model('Settings');
		$person_list = $CI->Settings->select_loan_person_by_id($person_id);

		$data = array(
				'title' => 'Manage Person',
				'person_id' => $person_list[0]['person_id'],
				'person_name' => $person_list[0]['person_name'],
				'person_phone' => $person_list[0]['person_phone'],
				'person_address' => $person_list[0]['person_address'],
			);

		$manage_person = $CI->parser->parse('settings/person_loan_edit',$data,true);
		return $manage_person;
	}
	//Person Ledger data
	public function person_ledger_data($person_id){
		$CI =& get_instance();
		$CI->load->model('Settings');

		$person_details_all = $CI->Settings->person_list();
		$person_details = $CI->Settings->select_person_by_id($person_id);
		$ledger 	= $CI->Settings->personledger_tradational($person_id);

		$balance = 0;
		$total_credit = 0;
		$total_debit = 0;
		$total_balance = 0;

		if(!empty($ledger)){
			foreach ($ledger as $k => $v) {
				$ledger[$k]['balance'] = ($ledger[$k]['debit']-$ledger[$k]['credit'])+$balance;
				$balance=$ledger[$k]['balance'];

				$ledger[$k]['subtotalDebit'] = $total_debit + $ledger[$k]['debit'];
				$total_debit = $ledger[$k]['subtotalDebit'];	

				$ledger[$k]['subtotalCredit'] = $total_credit + $ledger[$k]['credit'];
				$total_credit = $ledger[$k]['subtotalCredit'];

				$ledger[$k]['subtotalBalance'] = $total_balance + $ledger[$k]['balance'];
				$total_balance = $ledger[$k]['subtotalBalance'];
			}
		}
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$data=array(
			'person_details_all' => $person_details_all,
			'person_details' => $person_details,
			'person_id' 	=> $person_details[0]['person_id'],
			'person_name' 	=> $person_details[0]['person_name'],
			'person_phone' 	=> $person_details[0]['person_phone'],
			'person_address' => $person_details[0]['person_address'],
			'currency' 		=> $currency_details[0]['currency'],
			'position' 		=> $currency_details[0]['currency_position'],
			'ledger' 		=> $ledger,
			'subtotalDebit' => number_format($total_debit, 2, '.', ','),
			'subtotalCredit' => number_format($total_credit, 2, '.', ','),
			'subtotalBalance' => number_format($total_balance, 2, '.', ','),	
			'links' => '',
			);
		$chapterList = $CI->parser->parse('settings/person_ledger',$data,true);
		return $chapterList;
	}
	// personal loan details 
	public function person_loan_data($person_id){
		$CI =& get_instance();
		$CI->load->model('Settings');

		$person_details_all = $CI->Settings->person_list_personal_loan();
		$person_details = $CI->Settings->select_loan_person_by_id($person_id);
		$ledger 	= $CI->Settings->personal_loan_tradational($person_id);

		$balance = 0;
		$total_credit = 0;
		$total_debit = 0;
		$total_balance = 0;

		if(!empty($ledger)){
			foreach ($ledger as $k => $v) {
				$ledger[$k]['balance'] = ($ledger[$k]['debit']-$ledger[$k]['credit'])+$balance;
				$balance=$ledger[$k]['balance'];

				$ledger[$k]['subtotalDebit'] = $total_debit + $ledger[$k]['debit'];
				$total_debit = $ledger[$k]['subtotalDebit'];	

				$ledger[$k]['subtotalCredit'] = $total_credit + $ledger[$k]['credit'];
				$total_credit = $ledger[$k]['subtotalCredit'];

				$ledger[$k]['subtotalBalance'] = $total_balance + $ledger[$k]['balance'];
				$total_balance = $ledger[$k]['subtotalBalance'];
			}
		}
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$data=array(
			'person_details_all' => $person_details_all,
			'person_details' => $person_details,
			'person_id' 	=> $person_details[0]['person_id'],
			'person_name' 	=> $person_details[0]['person_name'],
			'person_phone' 	=> $person_details[0]['person_phone'],
			'person_address' => $person_details[0]['person_address'],
			'currency' 		=> $currency_details[0]['currency'],
			'position' 		=> $currency_details[0]['currency_position'],
			'ledger' 		=> $ledger,
			'subtotalDebit' => number_format($total_debit, 2, '.', ','),
			'subtotalCredit' => number_format($total_credit, 2, '.', ','),
			'subtotalBalance' => number_format($total_balance, 2, '.', ','),	
			'links' => '',
			);
		$chapterList = $CI->parser->parse('settings/person_loan_summary',$data,true);
		return $chapterList;
	}
	//Ledger search by date
	public function ledger_search_by_date($person_id,$from_date,$to_date,$links,$per_page,$page){

		$CI =& get_instance();
		$CI->load->model('Settings');

		$person_details_all = $CI->Settings->person_list();
		$person_details = $CI->Settings->select_person_by_id($person_id);
		$ledger 	= $CI->Settings->ledger_search_by_date($person_id,$from_date,$to_date);

		$balance = 0;
		$total_credit = 0;
		$total_debit = 0;
		$total_balance = 0;

		if(!empty($ledger)){
			foreach ($ledger as $k => $v) {
				$ledger[$k]['balance'] = ($ledger[$k]['debit']-$ledger[$k]['credit'])+$balance;
				$balance=$ledger[$k]['balance'];

				$ledger[$k]['subtotalDebit'] = $total_debit + $ledger[$k]['debit'];
				$total_debit = $ledger[$k]['subtotalDebit'];	

				$ledger[$k]['subtotalCredit'] = $total_credit + $ledger[$k]['credit'];
				$total_credit = $ledger[$k]['subtotalCredit'];

				$ledger[$k]['subtotalBalance'] = $total_balance + $ledger[$k]['balance'];
				$total_balance = $ledger[$k]['subtotalBalance'];
			}
		}
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$data=array(
			'person_details_all' => $person_details_all,
			'person_details' => $person_details,
			'person_id' 	=> $person_details[0]['person_id'],
			'person_name' 	=> $person_details[0]['person_name'],
			'person_phone' 	=> $person_details[0]['person_phone'],
			'person_address' => $person_details[0]['person_address'],
			'currency' 		=> $currency_details[0]['currency'],
			'position' 		=> $currency_details[0]['currency_position'],
			'ledger' 		=> $ledger,
			'subtotalDebit' => $total_debit,
			'subtotalCredit' => $total_credit,
			'subtotalBalance' => $total_balance,
			'links' => $links,
			);
		$chapterList = $CI->parser->parse('settings/person_ledger',$data,true);
		return $chapterList;
	}
	#=============Bank show by id=======#
	public function bank_show_by_id($bank_id){
		$CI =& get_instance();
		$CI->load->model('Settings');
		$bank_list = $CI->Settings->get_bank_by_id($bank_id);
		$data = array(
				'title' => 'Update List',
				'bank_list' => $bank_list
			);
		$bankList = $CI->parser->parse('settings/edit_bank',$data,true);
		return $bankList;
	}
	#=============Bank Update by id=======#
	public function bank_update_by_id($bank_id){
		$CI =& get_instance();
		$CI->load->model('Settings');
		$bank_list = $CI->Settings->bank_update_by_id($bank_id);
		return true;
	}
	#============Table List=============#
	public function table_list($links,$per_page,$page)
	{
		$CI =& get_instance();
		$CI->load->model('Settings');
		$bank_list = $CI->Settings->table_list($per_page,$page);
		$i=0;
		if(!empty($bank_list)){		
			foreach($bank_list as $k=>$v){$i++;
			   $bank_list[$k]['sl']=$i;
			}
		}
		$data = array(
				'title' => 'Table List',
				'table_list' => $bank_list,
				'links' => $links
			);
		$bankList = $CI->parser->parse('settings/table_list',$data,true);
		return $bankList;
	}	
	#============bank ledger=============#
	public function bank_ledger($bank_id)
	{
		$CI =& get_instance();
		$CI->load->model('Settings');
		$CI->load->model('Web_settings');
		$ledger = $CI->Settings->bank_ledger($bank_id);
		$bank_info = $CI->Settings->bank_info($bank_id);

		$total_ammount = 0;
		$total_credit = 0;
		$total_debit = 0;

		$balance = 0;
		$total_debit = 0;
		$total_credit = 0;

		if(!empty($ledger)){
			foreach ($ledger as $index => $value) {
				if(($ledger[$index]['ac_type']) == "Debit(+)")
				{
					$ledger[$index]['debit']=$total_debit+$ledger[$index]['dr'];
					$total_debit = $ledger[$index]['debit'];

					$ledger[$index]['balance']=$balance+$ledger[$index]['ammount'];
					$ledger[$index]['credit']="";
					$balance=$ledger[$index]['balance'];

				}
				else
				{
					$ledger[$index]['credit']=$total_credit+$ledger[$index]['cr'];
					$total_credit = $ledger[$index]['credit'];

					$ledger[$index]['balance']=$balance-$ledger[$index]['ammount'];
					$ledger[$index]['debit']="";
					$balance=$ledger[$index]['balance'];
				}
			}
		}

		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$data = array(
				'title' => 'Bank Ledger',
				'ledger' => $ledger,
				'bank_info' => $bank_info,
				'total_credit' => number_format($total_credit, 2, '.', ','),
				'total_debit' => number_format($total_debit, 2, '.', ','),
				'balance' => number_format($balance, 2, '.', ','),
				'currency' => $currency_details[0]['currency'],
				'position' => $currency_details[0]['currency_position'],
			);
		$bank_ledger = $CI->parser->parse('settings/bank_ledger',$data,true);
		return $bank_ledger;
	}

}
?>