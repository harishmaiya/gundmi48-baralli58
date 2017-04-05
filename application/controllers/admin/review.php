<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author dev Beetrut
 *
 */

class Review extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('review_model');
		if ($this->checkPrivileges('Review',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the testimonials list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/review/display_review_list');
		}
	}
	
	/**
	 * 
	 * This function loads the testimonials list page
	 */
	public function display_review_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Review List';
			$condition = array();
			$this->data['reviewList'] = $this->review_model->get_all_review_details();
//print_r($this->data['testimonialsList']);
		
			$this->load->view('admin/review/display_review',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the testimonials dashboard
	 */
	public function display_testimonials_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Testimonials Dashboard';
			$condition = array();
			$grouptestimonials=array('c.renter_id');
			$grouporder=array('u.testimonials_count'=>'DESC');
			
			$this->data['testimonialsList'] = $this->review_model->get_testimonialsAll_details($grouptestimonials,$grouporder);
			$grouptestimonials=array('c.rental_id');
			$grouporder=array('p.testimonials_count'=>'DESC');
			$this->data['TopRentalList'] = $this->review_model->get_testimonialsAll_details($grouptestimonials,$grouporder);
			
	
			
			
			$this->load->view('admin/testimonials/display_testimonials_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new testimonials form
	 */
	public function add_testimonials_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Contact';
			$this->load->view('admin/testimonials/add_testimonials',$this->data);
		}
	}
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditTestimonials(){
	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$testimonials_id = $this->input->post('testimonials_id');
			$testimonials_name = $this->input->post('title');
			$seourl = url_title($testimonials_name, '-', TRUE);
			if ($testimonials_id == ''){
				$condition = array('title' => $testimonials_name);
				$duplicate_name = $this->review_model->get_all_details(TESTIMONIALS,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','Testimonial name already exists');
					redirect('admin/testimonials/add_testimonials_form');
				}
			}
			$excludeArr = array("testimonials_id");
			
			
			$testimonials_data=array();
			
			$inputArr = array();
			$datestring = "%Y-%m-%d %H:%M:%S";
			$time = time();
			if ($testimonials_id == ''){
				$testimonials_data = array(
					'dateAdded'	=>	mdate($datestring,$time),
				);
			}
			$dataArr = array_merge($inputArr,$testimonials_data);
			$condition = array('id' => $testimonials_id);
			if ($testimonials_id == ''){
				$this->review_model->commonInsertUpdate(TESTIMONIALS,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Testimonial added successfully');
			}else {
				
				$this->review_model->commonInsertUpdate(TESTIMONIALS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Testimonial updated successfully');
			}
			redirect('admin/testimonials/display_testimonials_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_testimonials_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Contact';
			$testimonials_id = $this->uri->segment(4,0);
			$condition = array('id' => $testimonials_id);
			$this->data['testimonials_details'] = $this->review_model->get_all_details(TESTIMONIALS,$condition);
			if ($this->data['testimonials_details']->num_rows() == 1){
				$this->load->view('admin/testimonials/edit_testimonials',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 *
	 *change_testimonials_status_global
	 */
	public function change_review_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			//echo $status;die;
			if($status=='Active'){
				$GetReviewDetails=$this->review_model->get_all_details(REVIEW,$condition);
				//echo '<pre>';print_r($GetReviewDetails->result()); die;
				if($GetReviewDetails->row()->user_id > 0 && $GetReviewDetails->row()->user_id != ''){
					$GetUserDetails=$this->review_model->get_all_details(USERS,array('id' => $GetReviewDetails->row()->user_id));
					$GetRentalDetails=$this->review_model->get_all_details(PRODUCT,array('id' => $GetReviewDetails->row()->product_id));
					//echo '<pre>'; print_r($GetReviewDetails->result()); die;
					$rev_det=$this->review_model->get_all_details(USERS,array('id'=>$GetReviewDetails->row()->reviewer_id));
					//echo '<pre>';print_r($rev_det->result()); die;
					if($GetUserDetails->row()->email != ''){
						$newsid='44';
						$template_values=$this->review_model->get_newsletter_template_details($newsid);
						// $burl="http://coreteam.casperon.com/tempo_clone/site/product/display_review";
						// $burl= $this->config->base_url()."site/product/display_review";
						$host_name=$GetUserDetails->row()->user_name;
						$user_name=$rev_det->row()->user_name;
						$product_name=$GetRentalDetails->row()->product_title;
						$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
						$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'title'=>$GetReviewDetails->row()->title,'review'=>$GetReviewDetails->row()->review,'rateVal'=>$GetReviewDetails->row()->rateVal,'email_id'=>$GetReviewDetails->row()->email,'nickname'=>$GetReviewDetails->row()->nickname,'full_name'=>$GetReviewDetails->row()->full_name,'date_arrival'=>$GetReviewDetails->row()->date_arrival,'location'=>$GetReviewDetails->row()->location,'user_type'=>$GetReviewDetails->row()->user_type,'rental_id'=>$GetReviewDetails->row()->product_id,'rental_name'=>$GetRentalDetails->row()->product_name,'user_id'=>$GetReviewDetails->row()->user_id,'reviewer_id'=>$GetReviewDetails->row()->reviewer_id,'owner_name'=>ucfirst($GetUserDetails->row()->first_name));
						extract($adminnewstemplateArr);
						// echo "<PRE>";print_r(extract($adminnewstemplateArr));exit;
						//$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
						$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
						
						$message .= '<!DOCTYPE HTML>
							<html>
							<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
							<meta name="viewport" content="width=device-width"/><body>';
						include('./newsletter/registeration'.$newsid.'.php');	
						
						$message .= '</body>
							</html>';
						
						if($template_values['sender_name']=='' && $template_values['sender_email']==''){
							$sender_email=$this->data['siteContactMail'];
							$sender_name=$this->data['siteTitle'];
						}else{
							$sender_name=$template_values['sender_name'];
							$sender_email=$template_values['sender_email'];
						}
						//add inbox from mail 
						$this->review_model->simple_insert(INBOX,array('sender_id'=>$sender_email,'user_id'=>$GetUserDetails->row()->email,'mailsubject'=>$subject,'description'=>stripslashes($message)));
				
						$email_values = array('mail_type'=>'html',
											'from_mail_id'=>$sender_email,
											'mail_name'=>$sender_name,
											'to_mail_id'=>$GetUserDetails->row()->email,
											//'to_mail_id'=>'samuelyesudasan@casperon.in',
											'subject_message'=>$template_values['news_subject'],
											'body_messages'=>$message
											);
						$email_send_to_common = $this->review_model->common_email_send($email_values); 
					}
					
					if($GetReviewDetails->row()->email != ''){
						$newsid='61';
						$template_values=$this->review_model->get_newsletter_template_details($newsid);
						// $burl="http://coreteam.casperon.com/tempo_clone/site/product/display_review";
						// $burl= $this->config->base_url()."site/product/display_review";
						$host_name=$GetUserDetails->row()->user_name;
						$user_name=$rev_det->row()->user_name;
						$product_name=$GetRentalDetails->row()->product_title;
						$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
						$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'title'=>$GetReviewDetails->row()->title,'review'=>$GetReviewDetails->row()->review,'rateVal'=>$GetReviewDetails->row()->rateVal,'email_id'=>$GetReviewDetails->row()->email,'nickname'=>$GetReviewDetails->row()->nickname,'full_name'=>$GetReviewDetails->row()->full_name,'date_arrival'=>$GetReviewDetails->row()->date_arrival,'location'=>$GetReviewDetails->row()->location,'user_type'=>$GetReviewDetails->row()->user_type,'rental_id'=>$GetReviewDetails->row()->product_id,'rental_name'=>$GetRentalDetails->row()->product_name,'user_id'=>$GetReviewDetails->row()->user_id,'reviewer_id'=>$GetReviewDetails->row()->reviewer_id,'owner_name'=>ucfirst($GetUserDetails->row()->first_name));
						extract($adminnewstemplateArr);
						// echo "<PRE>";print_r(extract($adminnewstemplateArr));exit;
						//$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
						$message = '';
						$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
						
						$message .= '<!DOCTYPE HTML>
							<html>
							<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
							<meta name="viewport" content="width=device-width"/><body>';
						include('./newsletter/registeration'.$newsid.'.php');	
						
						$message .= '</body>
							</html>';
						
						if($template_values['sender_name']=='' && $template_values['sender_email']==''){
							$sender_email=$this->data['siteContactMail'];
							$sender_name=$this->data['siteTitle'];
						}else{
							$sender_name=$template_values['sender_name'];
							$sender_email=$template_values['sender_email'];
						}
						//add inbox from mail 
						$this->review_model->simple_insert(INBOX,array('sender_id'=>$sender_email,'user_id'=>$GetUserDetails->row()->email,'mailsubject'=>$subject,'description'=>stripslashes($message)));
				
						$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$GetReviewDetails->row()->email,
							//'to_mail_id'=>'samuelyesudasan@casperon.in',
							'subject_message'=>$template_values['news_subject'],
							'body_messages'=>$message
							);
						//echo '<pre>';print_r($email_values);die;
						$email_send_to_common = $this->review_model->common_email_send($email_values); 
					}
				}
			}
			$this->review_model->update_details(REVIEW,$newdata,$condition);
			$this->setErrorMessage('success','Review Status Changed Successfully');
			redirect('admin/review/display_review_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_review(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Review';
			$review_id = $this->uri->segment(4,0);
			$this->data['review_details'] = $this->review_model->get_review_details($review_id);
			if ($this->data['review_details']->num_rows() == 1){
				$this->load->view('admin/review/view_review',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_review(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$id = $this->uri->segment(4,0);
			$condition = array('id' => $id);
			$this->review_model->commonDelete(REVIEW,$condition);
			$this->setErrorMessage('success','Review deleted successfully');
			redirect('admin/review/display_review_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_review_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->review_model->activeInactiveCommon(REVIEW,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Review records deleted successfully');
			}else {
				$this->setErrorMessage('success','Review records status changed successfully');
			}
			redirect('admin/review/display_review_list');
		}
	}
}

/* End of file testimonials.php */
/* Contact: ./application/controllers/admin/testimonials.php */