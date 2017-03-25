<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Newsletter_model extends My_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function send_mail_subcribers($valuesStr){
		$this->db->select('email');
		$this->db->from(USERS);
		
		$this->db->where_in('id',$valuesStr);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		return $result = $query->result_array();
	}
	public function get_newsletter_details($table='',$data=''){
		$query =  $this->db->get_where($table,$data);
		return $result = $query->result_array();
	}
	public function send_mail_subcribers_list($valuesArr,$NewsId){
		$newsid=$NewsId->row()->id;
		$template_values=$this->product_model->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array(
				'news_subject'=> $NewsId->row()->news_subject,
				'logo_image'=>$this->config->item('logo_image'),
				'logo'=> $this->data['logo'],
				'news_descrip'=>$NewsId->row()->news_descrip,
				'email'=>$this->config->item('email'),
				'title'=>$this->data['title']
		);
		
		extract($adminnewstemplateArr);

		$subject = 'From: '.$this->config->item('email_title').' - ';
  		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$NewsId->row()->news_subject.'</title><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		
		$message .= '</body>
			</html>';

		foreach($valuesArr as $SubscriberEmail){		
			$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$NewsId->row()->sender_email,
							'mail_name'=>$NewsId->row()->sender_name,
							'to_mail_id'=>$SubscriberEmail['email'],
							'subject_message'=>$NewsId->row()->news_subject,
							'body_messages'=>$message
							);
						
			$email_send_to_common = $this->newsletter_model->common_email_send($email_values);
		//print_r($email_send_to_common);die;
		}
		
	}
	public function get_users_email_for_mass_email()
	{
	$this->db->select('email,firstname,lastname');
	$this->db->from(USERS);
	$this->db->where('status','Active');
	return $this->db->get()->result();
	  //echo $this->db->last_query();die;
	
	}
	
	public function send_mass_email($email_list){
	if(count($email_list)==0)
	{
	$this->db->select('email');
	$this->db->from(USERS);
	$this->db->where('status','Active');
	$user_emails=$this->db->get()->result();
	$email_from='db';
    }
	else
	{
	
	$user_emails=$email_list;
	$email_from='form';
	}
	
	$subject=$this->input->post('subject');
	$message_content=$this->input->post('message');
		
		$newsid=17;
		//echo $this->config->item('email_title');die;
		$template_values=$this->product_model->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array('logo_image'=>$this->config->item('logo_image'),'email'=>$this->config->item('email'),'title'=>$this->data['title'],'email_title'=>$this->config->item('email_title'),'message_content'=>$message_content,'email_title'=>$email_title);
		extract($adminnewstemplateArr);
		//$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
  		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$subject.'</title><body>';
		//$message  .=$message_content;
		include('./newsletter/registeration'.$newsid.'.php');	
		
		$message .= '</body>
			</html>';
			
		
		foreach($user_emails as $user_email){
		
					if($email_from=='db')
					{
					$to_email=$user_email->email;
					}
					else{
					$to_email=$user_email;
					}
					//echo $to_email;die;
					
			$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$email,
							'mail_name'=>$mail_name,
							'to_mail_id'=>$to_email,
							'subject_message'=>strip_tags($subject),
							'body_messages'=>$message
							);
							//print_r($email_values);die;
							//print_r(stripslashes($message));die;
			$email_send_to_common = $this->newsletter_model->common_email_send($email_values);
			
		}
		return;
		
	}
	
	public function newsletter(){
	
	$data =  $_POST['checkbox_id'];
	$id='';
		for ($i=0;$i<count($data);$i++){  
		$id.= "'".$data[$i]."',";
		}
		$id.="}";
	$selected_id =  str_replace(",}","",$id);
		
				$mode  = $this->input->post('statusMode');
				if($mode == 'Active'){
				$update_status = "Yes";
				}
				else if($mode == 'Inactive'){
				$update_status = "No";
				}
				else if($mode == 'Delete'){
				$update_status = "delete";
				}
				$statusArr = array('subscriber' => $update_status);
				
				$this->db->query("UPDATE `fc_users` SET `subscriber` = '".$update_status."' WHERE `id` IN ($selected_id) ");
				
	}
	public function get_users_subscriber_email()
	{
	$this->db->select('*');
	$this->db->from(USERS);
	$this->db->where_not_in('subscriber','delete');
	
	 return $query = $this->db->get();			
	/* $resultContent = $query->result_array();
	return $resultContent; */	
	  //echo $this->db->last_query();die;
	
	}
	
	
	
	
	
	
}