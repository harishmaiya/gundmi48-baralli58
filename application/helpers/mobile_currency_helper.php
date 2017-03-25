<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	function mobileCurrencyValue($id,$amount,$local_currency)
	{
		
		$rate=0;

		$ci =& get_instance();
			
		$currencyCode     = $local_currency;

		$productCurrencyCode     = $ci->db->where('id',$id)->get(PRODUCT)->row()->currency;
	
		if($currencyCode == '')
		{
			$newCurrencyCode = $ci->db->where(array('status'=>'Active','default_currency'=>'Yes'))->get(CURRENCY)->row()->currency_type;
	
			$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $newCurrencyCode);
			
			$rate= mobilecurrency_convert($params);

			if($rate!=0)
				return $rate;
			else
				return $amount;
				
		}
			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);

		$rate= mobilecurrency_convert($params);

		if($rate!=0)
			return $rate;
		else
			return $amount;

	}
	
	function mobileAdminCurrencyValue($id,$amount)
	{
		
		$rate=0;

		$ci =& get_instance();
			
		$currencyCode      = $ci->db->where(array('status'=>'Active','default_currency'=>'Yes'))->get(CURRENCY)->row()->currency_type;

		$productCurrencyCode     = $ci->db->where('id',$id)->get(PRODUCT)->row()->currency;
	
		if($currencyCode == '')
		{
			$newCurrencyCode = $ci->db->where(array('status'=>'Active','default_currency'=>'Yes'))->get(CURRENCY)->row()->currency_type;
	
			$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $newCurrencyCode);
			
			$rate= round(mobilecurrency_convert($params));

			if($rate!=0)
				return $rate;
			else
				return $amount;
				
		}
			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);

		$rate= number_format(mobilecurrency_convert($params),2);

		if($rate!=0)
			return $rate;
		else
			return $amount;

	}

	
	function mobileUSDtoOtherCurrency($id,$amount)
	{
			$rate=0;

		$ci =& get_instance();

		$currencyCode     = $ci->db->where('id',$id)->get(PRODUCT)->row()->currency;

		$productCurrencyCode     = 'USD';
	

			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);

		$rate= number_format(mobilecurrency_convert($params),2);

		if($rate!= 0)
			return $rate;
		else
			return $amount;
	}
	
	function mobileUSDtoCurrentCurrency($amount,$local_currency){
		
		$rate=0;

		$ci =& get_instance();
			
		$currencyCode     = $local_currency;

		$productCurrencyCode     = 'USD';
			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);

		$rate= number_format(mobilecurrency_convert($params),2);

		if($rate!=0)
			return $rate;
		else
			return $amount;
		
	}
	function mobilecurrencyConvertToUSD($id,$amount){
		
			$rate=0;

		$ci =& get_instance();

		$productCurrencyCode     = $ci->db->where('id',$id)->get(PRODUCT)->row()->currency;

		$currencyCode     = 'USD';
	

			
		$params  = array('amount' => $amount, 'currFrom' => $productCurrencyCode, 'currInto' => $currencyCode);

		$rate= number_format(mobilecurrency_convert($params),2);

		if($rate!= 0)
			return $rate;
		else
			return $amount;
	}
	
	function mobilecurrencyCode()
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
	
	function mobilecurrency_convert($params)
	{
		//print_r($params); 
		$amount    = $params["amount"];
	
		$currFrom  = $params["currFrom"];

		$currInto  = $params["currInto"];

		if (trim($amount) == "" ||!is_numeric($amount)) 
		{
//			trigger_error("Please enter a valid amount",E_USER_ERROR);
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
	



?>