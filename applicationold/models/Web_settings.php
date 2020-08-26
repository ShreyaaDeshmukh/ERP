<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Web_settings extends CI_Model {

	private $table  = "language";
    private $phrase = "phrase";

	public function __construct()
	{
		parent::__construct();
	}
	//Retrieve customer Edit Data
	public function retrieve_setting_editdata()
	{
		$this->db->select('*');
		$this->db->from('web_setting');
		$this->db->where('setting_id',1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	//Update Categories
	public function update_setting($data)
	{
		$this->db->where('setting_id',1);
		$this->db->update('web_setting',$data);
		return true;
	}

    public function languages()
    { 
        if ($this->db->table_exists($this->table)) { 

                $fields = $this->db->field_data($this->table);

                $i = 1;
                foreach ($fields as $field)
                {  
                    if ($i++ > 2)
                    $result[$field->name] = ucfirst($field->name);
                }

                if (!empty($result)) return $result;
 

        } else {
            return false; 
        }
	}
	
	public function checkLicensing(){
				$this->db->select('*');	
				
				$this->db->from('user_licensing');
						$this->db->where('id',1);	
							$query = $this->db->get();

									if ($query->num_rows() > 0) {
										$dataQuantity = $query->result_array();
										$date1 = date('Y-m-d');		
											$date2 = $dataQuantity[0]['license_last_date'];	
											$difference = $this->datedifference($date1, $date2);
											if($difference>0){
												return 1;
											}else{		
												
												$this->session->set_userdata(
													array('error_message' => "Your subscription plan has expired. Please renew subscription"));
																?>		
																
																<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>	
																<script>setTimeout(function(){		
																$('input').attr('disabled', 'disabled');
																$('input').css('pointer-events','none');
																$('.btn').attr('disabled', 'disabled');			
																$('.btn').css('pointer-events','none');
																$('li').attr('disabled', 'disabled');	
																$('li').css('pointer-events','none');		
																$('a').attr('disabled', 'disabled');
																$('a').css('pointer-events','none');	
																}, 1000);</script>	
																<?php
																}		}

																return false;	
															}	

public function datedifference($date1, $date2){	
		$date1 = new DateTime($date1);	
			$date2 = new DateTime($date2);
			$interval = $date1->diff($date2);
			if($interval->invert==0){
			return $interval->days;	
			}else{
				return 0;
			}
		}

}