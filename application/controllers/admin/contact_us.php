<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to cms management 
 * @author dev Beetrut
 *
 */

class Contact_us extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('contact_model');
		if ($this->checkPrivileges('ContactUs',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    public function display_contactus() {
		
		if ($this->checkLogin ( 'A' ) == '') {
			redirect ( 'admin' );
		} else {
			$this->data ['admin_contactus'] = $this->contact_model->get_all_details ( CONTACTUS, array () );
			$this->load->view ( 'admin/contact/display_contactus', $this->data );
		}
	}
	public function change_contact_status()
	{
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$list_value_id = $this->uri->segment(4);
			$condition = array('id' => $list_value_id);
			$this->contact_model->commonDelete(CONTACTUS,$condition);
			$this->setErrorMessage('success','Contact details deleted successfully');
			redirect('admin/contact_us/display_contactus');
		}
		
	}
	public function replaymail()
	{if ($this->checkLogin ( 'A' ) == '') {
			redirect ( 'admin' );
		} else {
			$id = $this->uri->segment ( 4 );
			$this->data ['admin_replay'] = $this->contact_model->get_all_details(CONTACTUS, array('id' => $id) );
			//echo("<pre>");print_r($this->data['admin_replay']->row());die;
			$this->load->view ( 'admin/contact/display_replaymail', $this->data );
		}
		}
		public function replaymail1()
		{
		
			$replayemail = $this->input->post('replayemail');
			$body_message = $this->input->post('your-message');
			
			
		$newsid = '28';
		$template_values = $this->contact_model->get_newsletter_template_details ( $newsid );
		$adminnewstemplateArr = array (
				'email_title' => $this->config->item ('email_title'),
				'logo' => $this->data ['logo']
		);
		extract ( $adminnewstemplateArr );
		$subject = 'From: ' . $this->config->item ('email_title') . ' - ' . $template_values ['news_subject'];
		$header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
		
		
		
		
		include ('./newsletter/registeration' . $newsid . '.php');
		
		
		
		
		
			$sender_email = $this->config->item ( 'site_contact_mail' );
			$sender_name = $this->config->item ( 'email_title' );
		
		
		
		$email_values = array (
				'mail_type' => 'html',
				'from_mail_id' => $sender_email,
				'mail_name' => $sender_name,
				'to_mail_id' => $replayemail, 
				'subject_message' => $template_values['news_subject'],
				'body_messages' => $message
		);
			 //echo stripslashes($email_values['body_messages']);die;
	     $this->contact_model->common_email_send($email_values);
			
			
			
			
			
			
			/* $newsid='20';
			$template_values=$this->product_model->get_newsletter_template_details($newsid);
			$subject = $template_values['news_subject'];
			if($template_values['sender_name']=='' && $template_values['sender_email']==''){
				$sender_email=$this->data['siteContactMail'];
				$sender_name=$this->data['siteTitle'];
			}else{
				$sender_name=$template_values['sender_name'];
				$sender_email=$template_values['sender_email'];
			}
			$email_values = array('mail_type'=>'html',
					'from_mail_id'=> $sender_email,
					'to_mail_id'=>$this->input->post('replayemail'),
					'subject_message'=>$subject,
					'body_messages'=>$this->input->post('replaymsg'),
			);
			//echo("<pre>");print_r($email_values);die;
			
			$email_send_to_common = $this->contact_model->common_email_send($email_values); */
			$this->setErrorMessage ( 'success', 'Your message sent successfully.' );
			redirect('admin/contact_us/display_contactus');
		}
		
		public function change_contact_status_global() {
		
			// print_r($_POST);
			if (count ( $_POST ['checkbox_id'] ) > 0 && $_POST ['statusMode'] != '') {
				$this->contact_model->activeInactiveCommon ( CONTACTUS, 'id' );
				if (strtolower ( $_POST ['statusMode'] ) == 'delete') {
					$this->setErrorMessage ( 'success', 'Contact records deleted successfully' );
				} else {
					$this->setErrorMessage ( 'success', 'Contact records status changed successfully' );
				}
				redirect('admin/contact_us/display_contactus');
			}
		}
}

/* End of file cms.php */
/* Location: ./application/controllers/admin/cms.php */