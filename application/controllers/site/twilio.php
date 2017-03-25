<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Landing page functions
 * @author Teamtweaks
 *
 */

class Twilio extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('product_model');
		$this->load->library('session');
       }
	   
	 public function index()
	{
	redirect('site/twilio/send_sms');
	}
	public function send_sms()
	{
		require_once('twilio/Services/Twilio.php');
		$account_sid = $this->config->item('twilio_account_sid'); 
		$auth_token = $this->config->item('twilio_account_token');
		$from=$this->config->item('twilio_phone_number');
		$to="+919790605724";
		$client = new Services_Twilio($account_sid, $auth_token); 
		$client->account->messages->create(array( 
			'To' => $to,	
			'From' =>$from, 
			'Body' => "Hi",   
		));
	}
	
	public function product_verification()
	{
		if ($this->checkLogin ( 'U' ) != '') {
			$query_phverified = $this->product_model->get_all_details(USERS,array('id'=>$this->checkLogin('U'),'phone_no'=>$_POST['phone_no'],'ph_verified'=>'Yes'));
			$result_phverified = $query_phverified->num_rows();
			
			if($result_phverified==0){
				require_once('twilio/Services/Twilio.php');
				$account_sid = $this->config->item('twilio_account_sid'); 
				$auth_token = $this->config->item('twilio_account_token');

				$random_confirmation_number = mt_rand(100000, 999999);
				$excludeArr=array('product_id','mobile_code');
				$dataArr=array('mobile_verification_code'=>$random_confirmation_number,'ph_verified'=>'No','country_code'=>$_POST['mobile_code']);
				$condition=array('id'=>$this->checkLogin('U'));
				$this->product_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
				//echo $this->db->last_query();die;
				$from=$this->config->item('twilio_phone_number');
				if($this->input->post('mobile_code') && $this->input->post('phone_no'))
				{
					$mobile_code=$this->input->post('mobile_code');
					$phone_number=$this->input->post('phone_no');
				}
				else
				{
					$user_details_query=$this->product_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
					$mobile_code_query='SELECT country_mobile_code FROM '.LOCATIONS.' WHERE id='.$user_details_query->row()->country;
					$mobile_code=$this->product_model->ExecuteQuery($mobile_code_query);

					$phone_number=$this->data['userDetails']->row()->phone_no;
					$mobile_code=$mobile_code->row()->country_mobile_code;
				}



				$to=$mobile_code.$phone_number; //echo $to;die;
				$client = new Services_Twilio($account_sid, $auth_token); 
				$client->account->messages->create(array( 
					'To' => $to,	
					'From' =>$from, 
					'Body' => "Hi This is from ".$this->config->item('meta_title')." and Your Verification Code is ".$random_confirmation_number,   
				));

				$DataARR = array('phone_no'=>$this->input->post('phone_no'),
				'ph_country'=>$this->input->post('ph_country'));
				$this->product_model->update_details(USERS,$DataARR,$condition);
				echo 'success';
			}
			else{
				echo 'already_verified';
			}
		}
		else
		{
			echo 'your_session_expired';
		}

	}

public function get_mobile_code()
{

 	$country_id=$this->input->post('country_id');
 	$country_mobile_code_query='SELECT country_mobile_code FROM '.LOCATIONS.' WHERE id='.$country_id;
 
 	$country_mobile_code=$this->product_model->ExecuteQuery($country_mobile_code_query)->row_array();
 	//echo $this->db->last_query();die;
 	echo json_encode($country_mobile_code);
}
	
	
   
}