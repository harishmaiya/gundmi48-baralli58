<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to seller management
 * @author dev Beetrut
 *
 */

class Seller extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation','image_lib','resizeimage'));		
		$this->load->model('seller_model');$this->load->model('user_model');$this->load->model('cms_model');
		if ($this->checkPrivileges('Host',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the seller requests page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/seller/display_seller_dashboard');
		}
	}
	
	/**
	 * 
	 * This function loads the sellers dashboard
	 */
	public function display_seller_dashboard(){
		/*if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Renters Dashboard';
			$condition = array('group'=>'Seller');
			$this->data['sellerList'] = $this->seller_model->get_all_details(USERS,$condition);
			$condition = array('request_status'=>'Pending','group'=>'User');
			$this->data['pendingList'] = $this->seller_model->get_all_details(USERS,$condition);
			$this->load->view('admin/seller/display_seller_dashboard',$this->data);
		}*/
		
		
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Hosts Dashboard';
			$condition = 'where `group`="Seller" order by `created` desc';
			$this->data['usersList'] = $this->user_model->get_users_details($condition);
			$this->load->view('admin/seller/display_seller_dashboard',$this->data);
		}
	
	}
	
	/**
	 * 
	 * This function loads the seller requests page
	 */
	public function display_seller_requests(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Hosts Requests';
			$condition = array('request_status' => 'Pending','group' => 'User');
			$this->data['sellerRequests'] = $this->seller_model->get_all_details(USERS,$condition);
			$this->load->view('admin/seller/display_seller_requests',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the sellers list page
	 */
	public function display_seller_list(){
	//die;
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Hosts List';
			$condition = array('group' => 'Seller');
			//$this->data['sellersList'] = $this->seller_model->get_all_details(USERS,$condition);
			$this->data['sellersList'] = $this->seller_model->get_all_seller_details_admin();
			
			//echo $this->db->last_query();die;
			$this->load->view('admin/seller/display_sellerlist',$this->data);
		}
	}
	
	
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditRenter(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$user_id = $this->input->post('user_id');
			$firstname = $this->input->post('firstname');
			$password = md5($this->input->post('new_password'));
			$email = $this->input->post('email');
			/* if ($user_id == ''){
				//$unameArr = $this->config->item('unameArr');
				/*if (!preg_match('/^\w{1,}$/', trim($firstname))){
					$this->setErrorMessage('error','User name not valid. Only alphanumeric allowed');
					echo "<script>window.history.go(-1);</script>";exit;
				}*/
				
			
					$condition = array('email' => $email);
					$duplicate_mail = $this->seller_model->get_all_details(USERS,$condition);
						//echo '<pre>';print_r($duplicate_mail);
					if ($duplicate_mail->num_rows() > 0){
						$this->setErrorMessage('error','This email already exists');
						redirect('admin/seller/add_seller_form');
					}
				
			} 
			$excludeArr = array("user_id","image","new_password","confirm_password","group","status");
			
			$user_group = 'Seller';
			
			if ($this->input->post('status') != ''){
				$user_status = 'Active';
			}else {
				$user_status = 'Inactive';
			}
			$inputArr = array('group' => $user_group, 'status' => $user_status);
			
			$inputArr['request_status'] = 'Approved';
			
			$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time();
						if($filename = $_FILES['image']['tmp_name']!=""){
			$filename = $_FILES['image']['tmp_name'];
			$size = getimagesize($filename);
			
				 
						 if($size['0']>=275 && $size['1']>=275) {	 
			$uploaddir = "images/users/";
		$logoDirectory = './images/users';
		$config['overwrite'] = FALSE;
		$config['remove_spaces'] = FALSE;
		$config['upload_path'] = $logoDirectory;
		$config['allowed_types'] = 'jpg|jpeg|gif|tif|png|bmp|JPG|JPEG|PNG|GIF';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
			if($this->upload->do_upload('image')){
			$logoDetails = $this->upload->data('image'); 
			$inputArr['image'] = $logoDetails['file_name'];
		} else {
			$error=$this->upload->display_errors();
			
		}
		
			$image_name=$logoDetails['file_name'];
			//$sliderUploadedData = array($this->upload->data());
			$target_file=$uploaddir.$image_name;
			$imageName=$image_name; 	
			$option=$this->getImageShape(275,275,$target_file);
						$renameArr = explode('.', $imageName);
						$newName = $renameArr[0].'.jpg';
						$resizeObj = new Resizeimage($target_file);	
						$resizeObj -> resizeImage(200, 200, $option);
						$resizeObj -> saveImage($uploaddir.$newName, 100);
						$this->ImageCompress($uploaddir.$newName);
						
					}else {
			
			$this->setErrorMessage('error','Upload Image size should be greater than 275px X 275px');
				redirect('admin/seller/add_seller_form');
			
			}
		}
			
			$currDAte=date("Y-m-d");
			if ($user_id == ''){
				$user_data = array(
					'password'	=>	$password,
					'is_verified'	=>	'No',
					'member_purchase_date'=>$currDAte,
					'package_status' => 'Paid',
					'created'	=>	mdate($datestring,$time),
					'modified'	=>	mdate($datestring,$time),	
					'last_login_date' => mdate ( $datestring, $time ),
					'last_login_ip' => $this->input->ip_address ()
				);
			}else {
				$user_data = array('modified' =>	mdate($datestring,$time),'last_login_date' => mdate ( $datestring, $time ),'last_login_ip' => $this->input->ip_address ());
			}
			$dataArr = array_merge($inputArr,$user_data);
			$condition = array('id' => $user_id);
			if ($user_id == ''){
				$this->seller_model->commonInsertUpdate(USERS,'insert',$excludeArr,$dataArr,$condition);
				$getInsertId=$this->user_model->get_last_insert_id();
				$userDetails = $userDetails = $this->user_model->get_all_details (USERS,array('id'=>$getInsertId));
				$this->send_confirm_mail ( $userDetails );
				$this->setErrorMessage('success','Added successfully');
			}else {
				
				$this->seller_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Updated successfully');
			}
			redirect('admin/seller/display_seller_list');
		}
		
			public function send_confirm_mail($userDetails = '') {

		$uid = $userDetails->row ()->id;
		$email = $userDetails->row ()->email;
		$name = $userDetails->row ()->firstname."    ".$userDetails->row ()->lastname;

		$newsid = '47';
		$template_values = $this->user_model->get_newsletter_template_details( $newsid );

		$user=$userDetails->row ()->firstname."     ".$userDetails->row ()->lastname;
		//$cfmurl = base_url () . 'site/user/confirm_register/' . $uid . "/" . $randStr . "/confirmation";
		$subject = 'From: ' . $this->config->item ( 'email_title' ) . ' - ' . $template_values ['news_subject'];
		$adminnewstemplateArr = array (
				'created'=>$userDetails->row ()->created,
				'logo' => $this->data ['logo'],
				'username'=>$name,
				'email_id'=>$email,
				'password'=>md5($userDetails->row ()->password),
				'group_id'=>$userDetails->row ()->group
		);
		extract ( $adminnewstemplateArr );
		//echo $this->data ['siteContactMail'];die;
		$header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

		$message .= '<body>';
		include ('./newsletter/registeration' . $newsid . '.php');

		$message .= '</body>
			';

			$sender_email = $this->data ['siteContactMail'];
			$sender_name = $this->data ['siteTitle'];
		
		// add inbox from mail
		// $this->product_model->simple_insert(INBOX,array('sender_id'=>$sender_email,'user_id'=>$email,'mailsubject'=>$template_values['news_subject'],'description'=>stripslashes($message)));

		$email_values = array (
				'mail_type' => 'html',
				'from_mail_id' => $sender_email,
				'mail_name' => $sender_name,
				'to_mail_id' => $email,
				'subject_message' => $template_values ['news_subject'],
				'body_messages' => trim($message)
		);
			#echo "<pre>"; print_r($email_values);die;
		//echo stripslashes($message);die;

		$email_send_to_common = $this->user_model->common_email_send ( $email_values );
		//echo $this->db->last_query();die;
	}
	
	
	/**
	 * 
	 * This function insert and edit a seller
	 */
	public function insertEditSeller(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			//echo '<pre>';print_r($_POST);die;
			$seller_id = $this->input->post('seller_id');
			$email = $this->input->post('email');
			$excludeArr = array("seller_id","confirm-password","password","email");
			$dataArr = array();
			$condition = array('id' => $seller_id);

						if($filename = $_FILES['image']['tmp_name']!=""){
			$filename = $_FILES['image']['tmp_name'];
			$size = getimagesize($filename);
			
				 
						 if($size['0']>=275 && $size['1']>=275) {	 
			
			$uploaddir = "images/users/";
		$logoDirectory = './images/users';
		$config['overwrite'] = FALSE;
		$config['remove_spaces'] = FALSE;
		$config['upload_path'] = $logoDirectory;
		$config['allowed_types'] = 'jpg|jpeg|gif|tif|png|bmp|JPG|JPEG|PNG|GIF';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
			if($this->upload->do_upload('image')){
			$logoDetails = $this->upload->data('image'); 
			$dataArr['image'] = $logoDetails['file_name'];
		} else {
			$error=$this->upload->display_errors();
			
		}
			$image_name=$logoDetails['file_name'];
			//$sliderUploadedData = array($this->upload->data());
			$target_file=$uploaddir.$image_name;
			$imageName=$image_name; 	
			$option=$this->getImageShape(275,275,$target_file);
						$renameArr = explode('.', $imageName);
						$newName = $renameArr[0].'.jpg';
						$resizeObj = new Resizeimage($target_file);	
						$resizeObj -> resizeImage(200, 200, $option);
						$resizeObj -> saveImage($uploaddir.$newName, 100);
						$this->ImageCompress($uploaddir.$newName);
						
			}else {
			
			$this->setErrorMessage('error','Upload Image size should be greater than 275px X 275px');
				redirect('admin/seller/edit_seller_form/'.$seller_id);
			
			}

			}
			
			if($this->input->post('password') != '')
			{
				$pwd = $this->input->post('password');
				$newdata = array ('password' => md5 ( $pwd ));
				$this->seller_model->update_details ( USERS, $newdata, $condition );
				$this->send_user_password ( $pwd, $email );
			}		
			if ($seller_id == ''){
				$this->seller_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','User added successfully');
			}else {
				$this->seller_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','User updated successfully');
			}
			redirect('admin/seller/display_seller_list');
		}
	}
	
	public function insertEditSeller_old(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			//echo '<pre>';print_r($_POST);die;
			$seller_id = $this->input->post('seller_id');
			$email = $this->input->post('email');
			
			
				$config['overwrite'] = FALSE;
				$config['allowed_types'] = 'jpg|jpeg|gif|png';
				$config['max_size'] = 2000;
				$config['upload_path'] = './images/users';
		    $this->load->library('upload', $config);
			if ( $this->upload->do_upload('image')){
		    	$imgDetails = $this->upload->data();
		    	$inputArr['image'] = $imgDetails['file_name'];
			}

			
			
			$excludeArr = array("seller_id","confirm-password","password","email");
			$dataArr = array('image'=>$inputArr['image']);
			$condition = array('id' => $seller_id);
			if($this->input->post('password') != '')
			{
				$pwd = $this->input->post('password');
				$newdata = array ('password' => md5 ( $pwd ));
				$this->seller_model->update_details ( USERS, $newdata, $condition );
				$this->send_user_password ( $pwd, $email );
			}		
			if ($seller_id == ''){
				$this->seller_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','User added successfully');
			}else {
				$this->seller_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
				//echo $this->db->last_query();die;
				$this->setErrorMessage('success','User updated successfully');
			}
			redirect('admin/seller/display_seller_list');
		}
	}
	
	public function send_user_password($pwd = '', $email) {
		$newsid = '5';
		$template_values = $this->seller_model->get_newsletter_template_details ( $newsid );
		$adminnewstemplateArr = array (
				'email_title' => $this->config->item ( 'email_title' ),
				'logo' => $this->data ['logo'] 
		);
		extract ( $adminnewstemplateArr );
		$subject = 'From: ' . $this->config->item ( 'email_title' ) . ' - ' . $template_values ['news_subject'];
		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>' . $template_values ['news_subject'] . '</title>
			<body>';
		include ('./newsletter/registeration' . $newsid . '.php');
		
		$message .= '</body>
			</html>';
		
			$sender_email = $this->config->item ( 'site_contact_mail' );
			$sender_name = $this->config->item ( 'email_title' );
		
		$email_values = array (
				'mail_type' => 'html',
				'from_mail_id' => $sender_email,
				'mail_name' => $sender_name,
				'to_mail_id' => $email,
				'subject_message' => 'Password Reset',
				'body_messages' => $message 
		);
		
		//echo stripslashes($message);die;
		
		$email_send_to_common = $this->seller_model->common_email_send ( $email_values );
	}
	
	/**
	 * 
	 * This function change the seller request status
	 */
	public function change_seller_request(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Rejected':'Approved';
			$newdata = array('request_status' => $status);
			if ($status == 'Rejected'){
				$newdata['group'] = 'User';
			}else if ($status == 'Approved'){
				$newdata['group'] = 'Seller';
			}
			$condition = array('id' => $user_id);
			$this->seller_model->update_details(USERS,$newdata,$condition);
			$this->setErrorMessage('success','Renter Request '.$status.' Successfully');
			redirect('admin/seller/display_seller_requests');
		}
	}
	
	/**
	 * 
	 * This function change the seller status
	 */
	public function change_seller_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$this->data['seller_details'] = $this->seller_model->get_all_details(PRODUCT,array('user_id'=>$user_id));
			$get_productid=$this->data['seller_details']->num_rows();
			//echo '<pre>';print_r($get_productid);die;
			/* if($get_productid > 0){
			$this->setErrorMessage('success','Not Permission to changed');
			redirect('admin/dashboard/admin_dashboard');
			}
			else{ */
			$status = ($mode == '0')?'Rejected':'Approved';
			$newdata = array('request_status' => $status);
			if ($status == 'Rejected'){
				$newdata['group'] = 'User';
			}else if ($status == 'Approved'){
				$newdata['group'] = 'Seller';
			}
			$condition = array('id' => $user_id);
			$newdatas = array('host_status' => 'Active');
			$this->seller_model->update_details(USERS,$newdata,$condition);
			$this->seller_model->update_details(USERS,$newdatas,$condition);
			//echo $this->db->last_query();die;
			$this->setErrorMessage('success','Renter Status Changed Successfully');
			redirect('admin/seller/display_seller_list');
		//}
		}
	}
	
	/**
	 * 
	 * This function loads the add new seller form
	 */
	public function add_seller_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Host';
			$sortArr1 = array('field'=>'name','type'=>'asc');
			$sortArr = array($sortArr1);
			$this->load->view('admin/seller/add_seller',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the edit seller form
	 */
	public function edit_seller_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Host';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			
			$this->data['seller_details'] = $this->seller_model->get_all_details(USERS,$condition);
			
			$condition2 = array('id' => $this->data['seller_details']->row()->languages_known);
			$this->data['languages'] = $this->seller_model->get_all_details(LANGUAGES,$condition2);
			 
			$country_query = 'SELECT id,name FROM ' . LOCATIONS . ' WHERE status="Active" order by name';
			$this->data ['active_countries'] = $this->cms_model->ExecuteQuery ( $country_query );
			if ($this->data['seller_details']->num_rows() == 1 && $this->data['seller_details']->row()->group == 'Seller'){
				// var_dump($this->data['seller_details']->row()->timezone);die;
				$this->load->view('admin/seller/edit_seller',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function loads the seller view page
	 */
	public function view_seller(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Host';
			$seller_id = $this->uri->segment(4,0);
			$condition = array('id' => $seller_id);
			$this->data['seller_details'] = $this->seller_model->get_all_details(USERS,$condition);
			if ($this->data['seller_details']->num_rows() == 1){
				$this->load->view('admin/seller/view_seller',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the seller record from db
	 */
	public function delete_seller(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$seller_id = $this->uri->segment(4,0);
			//echo $seller_id; die;
			
			$condition = array('id' => $seller_id);
			$condition1=array('user_id'=>$seller_id);
			$this->seller_model->commonDelete(USERS,$condition);
			$this->seller_model->commonDelete(PRODUCT,$condition1);
			$this->setErrorMessage('success','Renter deleted successfully');
			redirect('admin/seller/display_seller_list');
		}
	}
	
	/**
	 * 
	 * This function delete the seller request records
	 */
	public function change_seller_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->seller_model->activeInactiveCommon(USERS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Renter records deleted successfully');
			}else {
				$this->setErrorMessage('success','Renter records status changed successfully');
			}
			redirect('admin/seller/display_seller_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 */
	public function change_user_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->seller_model->update_details(USERS,$newdata,$condition);
			/*--Hogan--*/
			$condition = array('user_id' => $user_id);
			$newdata = array('user_status' => $status);
			$this->seller_model->update_details(PRODUCT,$newdata,$condition);
			//echo $this->db->last_query();die;
			/*--*/
			$this->setErrorMessage('success','Renter Status Changed Successfully');
			redirect('admin/seller/display_seller_list');
		}
	}
	
	public function verify_user_status(){
	echo ("inside function");
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'No':'Yes';
			$newdata = array('is_verified' => $status);
			$condition = array('id' => $user_id);
			$this->seller_model->update_details(USERS,$newdata,$condition);
			$this->setErrorMessage('success','User Status Changed Successfully');
			redirect('admin/seller/display_seller_list');
		}
	}
	
	public function verify_user_liststatus(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'no':'Yes';
			$newdata = array('other' => $status);
			$condition = array('id' => $user_id);
			$this->seller_model->update_details(LISTSPACE_VALUES,$newdata,$condition);
			$this->setErrorMessage('success','User Status Changed Successfully');
			redirect('admin/listattribute/display_listspace_values');
		}
	}
	
	public function update_refund(){
		if ($this->checkLogin('A') != ''){
			$uid = $this->input->post('uid');
			$refund_amount = $this->input->post('amt');
			if ($uid != ''){
				$this->seller_model->update_details(USERS,array('refund_amount'=>$refund_amount),array('id'=>$uid));
			}
		}
	}
	
	
	 /* Export Excel function */
	public function customerExcelExport() 
	{	
		$sortArr = array('field'=>'id','type'=>'desc');
		$condition = array('group'=>'Seller');
		
		$UserDetails = $this->user_model->get_all_details(USERS,$condition);
		$data['getCustomerDetails'] = $UserDetails->result_array();
	//echo '<pre>';print_r($data['getCustomerDetails']);die;
		$this->load->view('admin/seller/customerExportExcel',$data);
	}	
	
	
	
	
}

/* End of file seller.php */
/* Location: ./application/controllers/admin/seller.php */