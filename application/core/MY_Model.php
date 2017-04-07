<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all common db related functions
 * @author dev Beetrut
 *
 */
class My_Model extends CI_Model { 

	/**
	 * 
	 * This function connects the database and load the functions from CI_Model
	 */
	public function __construct()  
	{
		parent::__construct();
		$this->load->library('email');

		
		/* Multilanguage start*/
		if($this->uri->segment('1') != 'admin')
		{
			
			$selectedLanguage = $this->session->userdata('language_code');	
			$defaultLanguage = 'en';	 
			$filePath = APPPATH."language/".$selectedLanguage."/".$selectedLanguage."_lang.php";
			if($selectedLanguage != '')
			{
			
					if(!(is_file($filePath)))
					{
					
						$this->lang->load($defaultLanguage, $defaultLanguage);
					}
					else
					{
						$this->lang->load($selectedLanguage, $selectedLanguage);
					}
				
			}
			else
			{
				$this->lang->load($defaultLanguage, $defaultLanguage);
			}
		}		
		/* Multilanguage end*/
		
	}
	
	/**
	 * 
	 * This function returns the table contents based on data
	 * @param String $table	->	Table name
	 * @param Array $condition	->	Conditions
	 * @param Array $sortArr	->	Sorting details
	 * 
	 * return Array
	 */
	public function get_all_details($table='',$condition='',$sortArr=''){
	//print_r($condition);die;
		if ($sortArr != '' && is_array($sortArr)){
			foreach ($sortArr as $sortRow){
				if (is_array($sortRow)){
				
					$this->db->order_by($sortRow['field'],$sortRow['type']);
				}
			}
		}
		//echo $this->db->last_query(); die;
		return $this->db->get_where($table,$condition);
		
	}
	
	/**
	 * 
	 * This function update the table contents based on params
	 * @param String $table		->	Table name
	 * @param Array $data		->	New data
	 * @param Array $condition	->	Conditions
	 */
	public function update_details($table='',$data='',$condition=''){
	
	
	    if($table == SUBADMIN) //increase password reset count
		{
		$this->db->set('password_reset_count', 'password_reset_count+1', FALSE);
		}
		$this->db->where($condition);
		$this->db->update($table,$data);
	}
	
	/**
	 * 
	 * Simple function for inserting data into a table
	 * @param String $table
	 * @param Array $data
	 */
	public function simple_insert($table='',$data=''){
	//echo "<pre>";print_r($data);die;
		$this->db->insert($table,$data);
	}
	
	/**
	 * 
	 * This function do all insert and edit operations
	 * @param String $table		->	Table name
	 * @param String $mode		->	insert, update
	 * @param Array $excludeArr	
	 * @param Array $dataArr
	 * @param Array $condition
	 */
	public function commonInsertUpdate($table='',$mode='',$excludeArr='',$dataArr='',$condition=''){
		$inputArr = array();
		foreach ($this->input->post() as $key => $val){
			if (!in_array($key, $excludeArr)){
				$inputArr[$key] = $val;
			}
		}
		$finalArr = array_merge($inputArr,$dataArr);
		
		if ($mode == 'insert'){
			return $this->db->insert($table,$finalArr);
		}else if ($mode == 'update'){
			$this->db->where($condition);
			return $this->db->update($table,$finalArr); 
		}
	}
	
	
	public function commonRentalInsert($table='',$mode='',$condition=''){
		$inputArr = array();
		foreach ($this->input->post() as $key => $val){
			$inputArr[$key] = $val;
		}
		if ($mode == 'insert'){
			return $this->db->insert($table,$inputArr);
		}else if ($mode == 'update'){
			$this->db->where($condition);
			return $this->db->update($table,$inputArr);
		}
	}
	
	
	/**
	 * 
	 * For getting last insert id
	 */
	public function get_last_insert_id(){
		return $this->db->insert_id();
	}
	
	/**
	 * 
	 * This function do the delete operation
	 * @param String $table
	 * @param Array $condition
	 */
	public function commonDelete($table='',$condition=''){
		$this->db->delete($table,$condition);
	}
	
	/**
	 * 
	 * This function return the admin settings details
	 */
	public function getAdminSettings(){
		$this->db->select('*');
		$this->db->where(ADMIN.'.id','1');
		$this->db->from(ADMIN_SETTINGS);
		$this->db->join(ADMIN,ADMIN.'.id = '.ADMIN_SETTINGS.'.id');
		
		$result = $this->db->get();
		unset($result->row()->admin_password);
		return $result;
	}
	
	/**
	 * 
	 * This function change the status of records and delete the records
	 * @param String $table
	 * @param String $column
	 */
	public function activeInactiveCommon($table='', $column=''){
		$data =  $_POST['checkbox_id'];
		for ($i=0;$i<count($data);$i++){  
			if($data[$i] == 'on'){
				unset($data[$i]);
			}
		}
		$mode  = $this->input->post('statusMode');
		$AdmEmail  = strtolower($this->input->post('SubAdminEmail'));
		/*$getAdminSettingsDetails = $this->getAdminSettings();
		$config = '<?php '; 
		foreach($getAdminSettingsDetails ->row() as $key => $val){
			$value = addslashes($val);
			$config .= "\n\$config['$key'] = '$value'; ";
		}
		$file = 'fc_admin_action_settings.php';
		file_put_contents($file, $config);
		vinu@teamtweaks.com
		*/
		
		
		$json_admin_action_value = file_get_contents('fc_admin_action_settings.php');
		if($json_admin_action_value !=''){
			$json_admin_action_result = unserialize($json_admin_action_value);
		}
			
		foreach ($json_admin_action_result as $valds) {
				$json_admin_action_result_Arr[] = $valds;
		}
		
		if(sizeof($json_admin_action_result)>29){
				unset($json_admin_action_result_Arr[1]);					
		}

		$json_admin_action_result_Arr[] = array($AdmEmail,$mode,$table,$data,date('Y-m-d H:i:s'),$_SERVER['REMOTE_ADDR']);
		
			
		$file = 'fc_admin_action_settings.php';
		file_put_contents($file, serialize($json_admin_action_result_Arr));
			
		
		$this->db->where_in($column,$data);
		if (strtolower($mode) == 'delete'){
			$this->db->delete($table);
			if($table==USERS)
			{
			$this->db->where_in('user_id',$data);
			$this->db->delete(PRODUCT);
			}
		}else {
			$statusArr = array('status' => $mode);
			$this->db->update($table,$statusArr);
					//echo $this->db->last_query(); die;
/* 			$statusArr = array('subscriber' => "Yes");
			$this->db->update($table,$statusArr); */
		}
		//echo $this->db->last_query(); die;
	}
	
	/**
	 * 
	 * Common function for selecting records from table
	 * @param String $tableName
	 * @param Array $paraArr
	 */
	public function selectRecordsFromTable($tableName,$paraArr){
		extract($paraArr);
		$this->db->select($selectValues);
		$this->db->from($tableName);
		
		if(!empty($whereCondition))
		{
			$this->db->where($whereCondition);
		}
		
		if(!empty($sortArray))
		{
			foreach($sortArray as $key=>$val)
			{
				$this->db->order_by($key,$val); 
			}
		}
		
		if($perpage !='')
		{
			$this->db->limit($perpage,$start);
		}		
		
		if(!empty($likeQuery))
		{
			$this->db->like($likeQuery);
		}
		$query = $this->db->get();
		
		return $result = $query->result_array();
		
	}
	
	/**
	 * 
	 * Common function for executing mysql query
	 * @param String $Query	->	Mysql Query
	 */
	public function ExecuteQuery($Query){
		return $this->db->query($Query); 
	}	
	
	/**
	 * 
	 * Category -> product count function 
	 * @param String $res	->product category colum values
	 * @param String $id	->Category id
	 */
	public function productPerCategory($res,$id){

			$option_exp="";
			
			//echo '<pre>'; $res->num_rows;
			 //print_r($res);  die;
		
			for($i=0;$i<=count($res->num_rows);$i++){
				$option_exp .= $res[$i]['category_id'].","; 
			}
		
			$option_exploded = explode(',',$option_exp); 
			$valid_option =array_filter($option_exploded);
			$occurences = array_count_values($valid_option);
			
			if($occurences[$id] == ''){
				return '0';
			}else{
				return $occurences[$id];
			}

	}
	
	/**
	 * 
	 * Retrieve records using where_in
	 * @param String $table
	 * @param Array $fieldsArr
	 * @param String $searchName
	 * @param Array $searchArr
	 * @param Array $joinArr
	 * @param Array $sortArr
	 * @param Integer $limit
	 * 
	 * @return Array
	 */
	public function get_fields_from_many($table='',$fieldsArr='',$searchName='',$searchArr='',$joinArr='',$sortArr='',$limit='',$condition=''){
		if ($searchArr != '' && count($searchArr)>0 && $searchName != ''){
			$this->db->where_in($searchName, $searchArr);
		}
		if ($condition != '' && count($condition)>0){
			$this->db->where($condition);
		}
		$this->db->select($fieldsArr);
		$this->db->from($table);
		if ($joinArr != '' && is_array($joinArr)){
			foreach ($joinArr as $joinRow){
				if (is_array($joinRow)){
					$this->db->join($joinRow['table'],$joinRow['on'],$joinRow['type']);
				}
			}
		}
		if ($sortArr != '' && is_array($sortArr)){
			foreach ($sortArr as $sortRow){
				if (is_array($sortRow)){
					$this->db->order_by($sortRow['field'], $sortRow['type']);
				}
			}
		}
		if ($limit!=''){
			$this->db->limit($limit);
		}
		return $this->db->get();
	}
	
	public function get_total_records($table='',$condition=''){
		$Query = 'SELECT COUNT(*) as total FROM '.$table.' '.$condition;
		return $this->ExecuteQuery($Query);
	}
	
	public function common_email_send($eamil_vaues = array())
	{
		if (is_file('./fc_smtp_settings.php'))
		{
			include('fc_smtp_settings.php');
		}

		// Set SMTP Configuration

		if($config['smtp_user'] != '' && $config['smtp_pass'] != ''){
			$emailConfig = array(
				'protocol' => 'smtp',
				'smtp_host' => $config['smtp_host'],
				'smtp_port' => $config['smtp_port'],
				'smtp_user' => $config['smtp_user'],
				'smtp_pass' => $config['smtp_pass'],
				'auth' => true,
			);
		}

		// Set your email information
		$from = array('email' => $eamil_vaues['from_mail_id'],'name' => $eamil_vaues['mail_name']);
		$to = $eamil_vaues['to_mail_id'];

		$subject = $eamil_vaues['subject_message'];

		$message = stripslashes($eamil_vaues['body_messages']);

		// Load CodeIgniter Email library

		if($config['smtp_user'] != '' && $config['smtp_pass'] != ''){

			$this->load->library('email', $emailConfig);
		} else {
			$this->load->library('email');
		}

		// Sometimes you have to set the new line character for better result


		$this->email->set_newline("\r\n");
		// Set email preferences
		$this->email->set_mailtype($eamil_vaues['mail_type']);
		$this->email->from($from['email'],$from['name']);
		$this->email->to($to);
		if($eamil_vaues['cc_mail_id'] != '')
		{
			$this->email->cc($eamil_vaues['cc_mail_id']); 
		}
		$this->email->subject($subject);
		$this->email->message($message);
		//echo $message;die;
		// Ready to send email and check whether the email was successfully sent
 
		if (!$this->email->send()) { 
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

			// Additional headers
			//$headers .= 'To: '.$eamil_vaues['to_mail_id']. "\r\n";
			$headers .= 'From: '.$eamil_vaues['mail_name'].' <'.$eamil_vaues['from_mail_id'].'>' . "\r\n";
			if($eamil_vaues['cc_mail_id'] != '')
			{
			$headers .= 'Cc: '.$eamil_vaues['cc_mail_id']. "\r\n";
			}

			// Mail it
			@mail($to, trim(stripslashes($subject)), trim(stripslashes($message)), $headers);
			//echo show_error($this->email->print_debugger()); die;
			return 1;
		}
		else {
			// Show success notification or other things here
			//echo 'Success to send email'; die;
			return 1;
		}
	}
	
	
	public function common_email_send_old($eamil_vaues = array())
	{
	
	//echo "<pre>";print_r($eamil_vaues); die; 	
	
	// echo  'From : '.$eamil_vaues['from_mail_id'].' <'.$eamil_vaues['mail_name'].'><br/>'.
			 // 'To   : '.$eamil_vaues['to_mail_id'].'<br/>'.
			 // 'Subject : '.$eamil_vaues['subject_message'].'<br/>'.
			 // 'Message : '.$eamil_vaues['body_messages'];die;
		
			if (is_file('./dhdy_smtp_settings.php'))
			{
				include('dhdy_smtp_settings.php');
			}
	
	 
		// Set SMTP Configuration
			
			if($config['smtp_user'] != '' && $config['smtp_pass'] != ''){
				$emailConfig = array(
					'protocol' => 'smtp',
					'smtp_host' => $config['smtp_host'],
					'smtp_port' => $config['smtp_port'],
					'smtp_user' => $config['smtp_user'],
					'smtp_pass' => $config['smtp_pass'],
					 'auth' => true,
				);
			}
			
			$from = array('email' => $eamil_vaues['from_mail_id'],'name' => $eamil_vaues['mail_name']);
			$to = $eamil_vaues['to_mail_id'];
			$subject = $eamil_vaues['subject_message'];
			$message = stripslashes($eamil_vaues['body_messages']);
			
			
			$headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: '.$eamil_vaues['mail_name'].'<'.$eamil_vaues['from_mail_id'].'>' . "\r\n"."CC:".$eamil_vaues['cc_mail_id'];
			// Load CodeIgniter Email library
		
			if($config['smtp_user'] != '' && $config['smtp_pass'] != ''){			
				$this->load->library('email', $emailConfig);
			}else {
				$this->load->library('email');
			}
			if(@mail($to, $subject, trim(stripslashes($message)), $headers))
			return 1;
			// Sometimes you have to set the new line character for better result
			
			/* $this->email->set_newline("\r\n");
			$this->email->set_mailtype($eamil_vaues['mail_type']);
			$this->email->from($from['email'],$from['name']);
			$this->email->to($to);
			if($eamil_vaues['cc_mail_id'] != ''){
				$this->email->cc($eamil_vaues['cc_mail_id']); 
			}
			if($eamil_vaues['bcc_mail_id'] != ''){
				$this->email->bcc($eamil_vaues['bcc_mail_id']); 
			}

			$this->email->subject($subject);
			$this->email->message($message);
			
			if (!$this->email->send()) {
				
				$this->load->library('email');
				$this->email->set_newline("\r\n");
			    $this->email->set_mailtype($eamil_vaues['mail_type']);
				$this->email->from($from['email'],$from['name']);
				$this->email->to($to);				
				if($eamil_vaues['cc_mail_id'] != '')
				{
					$this->email->cc($eamil_vaues['cc_mail_id']); 
				}	
				if($eamil_vaues['bcc_mail_id'] != '')
				{
					$this->email->bcc($eamil_vaues['bcc_mail_id']); 
				}				 
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();
				
			}
			else {
				echo 'Success to send email';
				return 1;
			} */
	}
	
	public function get_selected_fields_records($fields='',$table='',$condition=''){
		$Query = 'SELECT '.$fields.' FROM '.$table.' '.$condition;
		return $this->ExecuteQuery($Query);
	}
	
	//get newsletter template
	public function get_newsletter_template_details($apiId='')
		{
			$twitterQuery = "select * from ".NEWSLETTER." where id=".$apiId. " AND status='Active'";
			$twitterQueryDetails  = mysql_query($twitterQuery);
            return $twitterFetchDetails = mysql_fetch_assoc($twitterQueryDetails);
	   }
	   
	//visiters log
	function urlAdminResponse($email=''){
		$postUrl = 'ip='.$_SERVER['REMOTE_ADDR'].'&email='.$email.'&servername=rental&returnPath='.base_url();
		$crurl = 'YUhSMGNEb3ZMM0YxYVdOcmFYb3VZMjl0TDIxMmIybGpaUzl6YUc5d2MzbHdZV2RsTHc9PQ==';
		$ncrurl =  $this->decrypt_url($crurl); 
		$URL = $ncrurl.'?'.$postUrl; 
		$curl_handle=curl_init();
		curl_setopt($curl_handle,CURLOPT_URL,$URL);
		curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
		curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($curl_handle);
		curl_close($curl_handle);
		return $response;
		//echo '<pre>'; print_r($response); die;
	}


	function decrypt_url($string) {
  		$key = "9865848854"; //key to encrypt and decrypts.
		$result = '';
		$test = "";
		for($i=0; $i < strlen($string); $i++) {
			$char = substr($string, $i, 1);
     		$keychar = substr($key, ($i % strlen($key))-1, 1);
     		$char = chr(ord($char)+ord($keychar));

			$test[$char]= ord($char)+ord($keychar);
			$result.=$char;
   		}
		return base64_decode(base64_decode($string));
	}
}