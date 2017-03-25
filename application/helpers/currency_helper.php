<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	function CurrencyValue($id,$amount)
	{
		
		$rate=0;

		$ci =& get_instance();
			
		$currencyCode     = $ci->session->userdata('currency_type');

		$productCurrencyCode     = $ci->db->where('id',$id)->get(PRODUCT)->row()->currency;
	
		if($currencyCode == '')
		{
			$newCurrencyCode = $ci->db->where('id',1)->get(ADMIN_SETTINGS)->row()->currency_type;
	
			$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $newCurrencyCode);
			
			$rate= round(currency_convert($params));

			if($rate!=0)
				return $rate;
			else
				return $amount;
				
		}
			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);

		$rate= number_format(currency_convert($params),2);

		if($rate!=0)
			return $rate;
		else
			return $amount;

	}
	
	function productSymbol($id){
		$ci =& get_instance();
		$currency_type = $ci->db->where('id',$id)->get(PRODUCT)->row()->currency;
		
		$currency_symbol = $ci->db->where(array('currency_type'=>$currency_type))->get(CURRENCY)->row()->currency_symbols;
		
		return $currency_symbol;
	}
	
	function currentToProduct($id,$amount)
	{
		
		$rate=0;

		$ci =& get_instance();
			
		$currencyCode     = $ci->db->where('id',$id)->get(PRODUCT)->row()->currency;

		$productCurrencyCode     = $ci->session->userdata('currency_type');
	
		if($currencyCode == '')
		{
			$newCurrencyCode = $ci->db->where('id',1)->get(ADMIN_SETTINGS)->row()->currency_type;
	
			$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $newCurrencyCode);
			
			$rate= round(currency_convert($params));

			if($rate!=0)
				return $rate;
			else
				return $amount;
				
		}
			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);

		$rate= number_format(currency_convert($params),2);

		if($rate!=0)
			return $rate;
		else
			return $amount;

	}
	
	function CurrencyValuenof($id,$amount)
	{
		
		$rate=0;

		$ci =& get_instance();
			
		$currencyCode     = $ci->session->userdata('currency_type');

		$productCurrencyCode     = $ci->db->where('id',$id)->get(PRODUCT)->row()->currency;
	
		if($currencyCode == '')
		{
			$newCurrencyCode = $ci->db->where('id',1)->get(ADMIN_SETTINGS)->row()->currency_type;
	
			$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $newCurrencyCode);
			
			$rate= round(currency_convert($params));

			if($rate!=0)
				return $rate;
			else
				return $amount;
				
		}
			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);

		$rate= currency_convert($params);

		if($rate!=0)
			return $rate;
		else
			return $amount;

	}
	
	function AdminCurrencyValue($id,$amount)
	{
		
		$rate=0;

		$ci =& get_instance();
			
		$currencyCode      = $ci->db->where('id',1)->get(ADMIN_SETTINGS)->row()->currency_type;
		
		$productCurrencyCode     = $ci->db->where('id',$id)->get(PRODUCT)->row()->currency;
	
		if($currencyCode == '')
		{
			$newCurrencyCode = $ci->db->where('id',1)->get(ADMIN_SETTINGS)->row()->currency_type;
	
			$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $newCurrencyCode);
			
			$rate= round(currency_convert($params));

			if($rate!=0)
				return $rate;
			else
				return $amount;
				
		}
			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);

		$rate= number_format(currency_convert($params),2);

		if($rate!=0)
			return $rate;
		else
			return $amount;

	}

	
	function USDtoOtherCurrency($id,$amount)
	{
			$rate=0;

		$ci =& get_instance();

		$currencyCode     = $ci->db->where('id',$id)->get(PRODUCT)->row()->currency;
		
		$currencyType = $ci->db->where('id',1)->get(ADMIN_SETTINGS)->row()->currency_type;
		
		$productCurrencyCode     = $currencyType;
	
		
			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);

		$rate= number_format(currency_convert($params),2);

		if($rate!= 0)
			return $rate;
		else
			return $amount;
	}
	
	function USDtoCurrentCurrency($amount){
		
		$rate=0;

		$ci =& get_instance();
			
		$currencyCode     = $ci->session->userdata('currency_type');
		
		$currencyType = $ci->db->where('id',1)->get(ADMIN_SETTINGS)->row()->currency_type;
		
		$productCurrencyCode     = $currencyType;
		
		/* $productCurrencyCode     = 'USD'; */
			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);
 
		$rate= number_format(currency_convert($params),2);

		if($rate!=0)
			return $rate;
		else
			return $amount;
		
	}
	
	//For cancellation
	function USDtoCurrentCurrency_nof($amount){
		
		$rate=0;

		$ci =& get_instance();
			
		$currencyCode     = $ci->session->userdata('currency_type');
		
		$currencyType = $ci->db->where('id',1)->get(ADMIN_SETTINGS)->row()->currency_type;
		
		$productCurrencyCode     = $currencyType;

		/* $productCurrencyCode     = 'USD'; */
			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);
 
		$rate= currency_convert($params);

		if($rate!=0)
			return $rate;
		else
			return $amount;
		
	}
	
	function currencyConvertToUSD($id,$amount)
	{
	//echo $id.'=='.$amount; die;
		$rate=0;

		$ci =& get_instance();

		$productCurrencyCode     = $ci->db->where('id',$id)->get(PRODUCT)->row()->currency;
//echo  $productCurrencyCode; //die;
		/* $currencyCode     = 'USD'; */
		$currencyType = $ci->db->where('id',1)->get(ADMIN_SETTINGS)->row()->currency_type;
		
		$currencyCode     = $currencyType;
//echo  $currencyCode;  die;
			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);

		$rate= number_format(currency_convert($params),2);
		//echo $rate;

		if($rate!= 0)
			return $rate;
		else
			return $amount;
	}
	
	function currencyCode()
	{
	 
	$ci =& get_instance();
	
	 $ip = $_SERVER['REMOTE_ADDR'];

	//$ip = '115.118.170.1'; //IND

	//$ip = '146.185.28.59'; //UK
	 
	$host = "http://www.geoplugin.net/php.gp?ip=$ip";
	 
	 if ( ini_get('allow_url_fopen') ) 
	 {
			$response = file_get_contents($host, 'r');	
		}
		 
	 $data = unserialize($response);

	return $data['geoplugin_currencyCode'];
	
}
	
	function currency_convert($params)
	{
		//print_r($params); 
		$amount    = $params["amount"];
	
		$currFrom  = $params["currFrom"];

		$currInto  = $params["currInto"];

		if (trim($amount) == "" ||!is_numeric($amount)) 
		{
		return $amount;
		}
		$return=array();

		$ci =& get_instance();
	
		if(trim($currFrom) == 'USD')
		{
			$currInto_result = $ci->db->where('currency_type',$currInto)->get(CURRENCY)->row();
		
			$rate = $amount * $currInto_result->currency_rate;
		}
		else
		{		
			$currFrom_result = $ci->db->where('currency_type',$currFrom)->get(CURRENCY)->row();

			$from_usd=0;
			
			if($currFrom_result->currency_rate > 0)
				$from_usd = 1/$currFrom_result->currency_rate;
	
			$from_usd_amt = $amount * $from_usd;
	
			$currInto_result = $ci->db->where('currency_type',$currInto)->get(CURRENCY)->row();
	
				$rate = $currInto_result->currency_rate * $from_usd_amt;
			
		}
	
		return $rate;
	}
	
	

function pastDateCurrency($id,$date,$Productamount)
{
	$ci =& get_instance();
	//echo $date;
	$currency_date = date('Y-m-d', strtotime($date));
	

$today = date("Y-m-d");


	if ($today < $currency_date)
		{
			$currency_date = $today;
		}
	
	$productCurrencyCode     = $ci->db->where('id',$id)->get(PRODUCT)->row()->currency;
	
	$currentCurrencyCode     = $ci->session->userdata('currency_type');
	
	$amount =  "http://currencies.apps.grandtrunk.net/getrate/$currency_date/$productCurrencyCode/$currentCurrencyCode" ;
//echo $amount; die;
	 if ( ini_get('allow_url_fopen') ) 
		{
			$response = file_get_contents($amount, 'r');	
		}
	
	$current_amount = $Productamount*$response;
	return $current_amount;
}

function USDtoCurrencyPayment($code,$amount){
		
		$rate=0;

		$ci =& get_instance();
			
		$currencyCode     = $code;
		
		$currencyType = $ci->db->where('id',1)->get(ADMIN_SETTINGS)->row()->currency_type;
		
		$productCurrencyCode     = $currencyType;
		
		/* $productCurrencyCode     = 'USD'; */
			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);
 
		$rate= number_format(currency_convert($params),2);

		if($rate!=0)
			return $rate;
		else
			return $amount;
		
	}


?>