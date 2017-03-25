<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency_converter extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('user_model');
		

    }
	function index()
	{
	

		/* $url = file_get_contents("http://openexchangerates.org/api/latest.json?app_id=62eb7fcc63b8421da359ac65d877833f");
        $json_a=json_decode($url,true); */
		$curr = $this->user_model->get_all_details('fc_currency',array());
		//echo "<pre>"; print_r($curr->result()); die;
            
       $from = 'USD';
		foreach($curr->result() as $row)
		{
			$to = $row->currency_type;
			$url = 'http://www.webservicex.net/CurrencyConvertor.asmx/ConversionRate?FromCurrency='.$from.'&ToCurrency='.$to;
			$url = 'http://www.x-rates.com/calculator/?from='.$from.'&to='.$to.'&amount=1';
		    $data = @file_get_contents( 'http://www.x-rates.com/calculator/?from='.$from.'&to='.$to.'&amount=1');
            preg_match("/<span class=\"ccOutputRslt\">(.*)<\/span>/",$data, $conversion);   
			
			//echo "<pre>"; print_r( $conversion);
//echo $conversion[0];		
$rate_value =  (float) filter_var( $conversion[0], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) ; // float(55.35) 	
//echo $int = intval(preg_replace('/[^0-9]+/', '', $conversion[0]), 10);
			
		//	print_r($rate_value); die;
             if($rate_value >= 0){
				 $rate = $rate_value;
			 }
			 else 
				 $rate = 0;
		//	echo $rate.'<br>'; 
			$condition = array('currency_type'=>$row->currency_type);
			$data = array('currency_rate'=>$rate );
			$this->db->where($condition);
		$this->db->update('fc_currency',$data);
		//$this->user_model->update_details('fc_currency',array('currency_rate'=>$rate ),array('currency_type'=>$row->currency_type));
		//echo $this->db->last_query(); 
		}
//	die;
		redirect('');	
	}
	function check_currency()
	{
		$url = file_get_contents("http://openexchangerates.org/api/latest.json?app_id=62eb7fcc63b8421da359ac65d877833f");
        $json_a=json_decode($url,true);
		$CRC = $json_a['rates']['CRC'];
		$USD = $json_a['rates']['USD'];
		$final = $USD/$CRC;
		$amount = 60;
		echo $amount = $amount*$final;die;
		echo $amount*100;
	}
}
	?>