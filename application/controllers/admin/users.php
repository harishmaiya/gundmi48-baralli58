<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Users extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation','image_lib','resizeimage'));		
		$this->load->model('user_model');
		if ($this->checkPrivileges('Members',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the users list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/users/display_user_list');
		}
	}
	
	/**
	 * 
	 * This function loads the users list page
	 */
	public function display_user_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Members List';
			$condition = array('group'=>'User');
			$condition1 = array(array('field'=>'id','type'=>'desc'));
			$this->data['usersList'] = $this->user_model->get_all_details(USERS,$condition,$condition1);
			$this->load->view('admin/users/display_userlist',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the users dashboard
	 */
	public function display_user_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Members Dashboard';
			$condition = 'where `group`="User" order by `created` desc';
			$this->data['usersList'] = $this->user_model->get_users_details($condition);
			$this->load->view('admin/users/display_user_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new user form
	 */
	public function add_user_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Member';
			$this->load->view('admin/users/add_user',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditUser(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$user_id = $this->input->post('user_id');
			$firstname = $this->input->post('firstname');
			$user_name = $this->input->post('firstname');
			$password = md5($this->input->post('new_password'));
			$email = $this->input->post('email');
			if ($user_id == ''){
				//$unameArr = $this->config->item('unameArr');
				/*if (!preg_match('/^\w{1,}$/', trim($firstname))){
					$this->setErrorMessage('error','User name not valid. Only alphanumeric allowed');
					echo "<script>window.history.go(-1);</script>";exit;
				}*/
				
				
					$condition = array('email' => $email);
					$duplicate_mail = $this->user_model->get_all_details(USERS,$condition);
					if ($duplicate_mail->num_rows() > 0){
						$this->setErrorMessage('error','Member email already exists');
						redirect('admin/users/add_user_form');
					}
				
			}
			$excludeArr = array("user_id","image","new_password","confirm_password","group","status");
			
			$user_group = 'User';
			
			if ($this->input->post('status') != ''){
				$user_status = 'Active';
			}else {
				$user_status = 'Inactive';
			}
			$inputArr = array('group' => $user_group, 'status' => $user_status, 'user_name' => $user_name);
			
			$inputArr['request_status'] = 'Approved';
			
			$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time();
			if($filename = $_FILES['image']['tmp_name']!=""){
			$filename = $_FILES['image']['tmp_name'];
			$size = getimagesize($filename);
			
			 if($size['0']>=275 && $size['1']>=275) {
				 
				// echo '<pre>';	 print_r($size['3'] ); die;
				 
				 
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
			if($user_id!=""){
			
			$this->setErrorMessage('error','Upload Image size should be greater than 275px X 275px');
				redirect('admin/users/edit_user_form/'.$user_id);
			}
			
			$this->setErrorMessage('error','Upload Image size should be greater than 275px X 275px');
				redirect('admin/users/add_user_form');
			
			}
	}
			
			if ($user_id == ''){
				$user_data = array(
					'password'	=>	$password,
					'is_verified'	=>	'No',
					'created'	=>	mdate($datestring,$time),
					'modified'	=>	mdate($datestring,$time),
					'last_login_ip' => $this->input->ip_address (),
					'last_login_date' => mdate($datestring, $time)
				);
			}else {
				$user_data = array('modified' =>	mdate($datestring,$time),'last_login_date' => mdate($datestring,$time),'last_login_ip' => $this->input->ip_address ());
			}
			$dataArr = array_merge($inputArr,$user_data);
			$excludeArr = array("user_id","confirm-password","password","new_password","confirm_password");
			$condition = array('id' => $user_id);
			if ($user_id == ''){
				$this->user_model->commonInsertUpdate(USERS,'insert',$excludeArr,$dataArr,$condition);
				$getInsertId=$this->user_model->get_last_insert_id();
				$userDetails = $userDetails = $this->user_model->get_all_details (USERS,array('id'=>$getInsertId));
				$this->send_confirm_mail ( $userDetails );
				$this->setErrorMessage('success','Member added successfully');
			}else {
				//print_r($dataArr);die;
				$this->user_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
				
				//$this->send_confirm_mail ( $userDetails );
				if($this->input->post('password') != '')
				{
					$pwd = $this->input->post('password');
					$newdata = array ('password' => md5 ( $pwd ));
					$this->user_model->update_details ( USERS, $newdata, $condition );
				}
				$this->setErrorMessage('success','Member updated successfully');
			}
			
			redirect('admin/users/display_user_list');
		}
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
	 * This function loads the edit user form
	 */
	public function edit_user_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Member';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['user_details'] = $this->user_model->get_all_details(USERS,$condition);
			if ($this->data['user_details']->num_rows() == 1){
				$this->load->view('admin/users/edit_user',$this->data);
			}else {
				redirect('admin');
			}
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
			$this->user_model->update_details(USERS,$newdata,$condition);
			$this->setErrorMessage('success','User Status Changed Successfully');
			redirect('admin/users/display_user_list');
		}
	}
	public function change_user_status1(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('host_status' => $status,'group'=>'Seller');
			$condition = array('id' => $user_id);
			$this->user_model->update_details(USERS,$newdata,$condition);
			$this->setErrorMessage('success','User Status Changed Successfully');
			redirect('admin/users/display_user_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_user(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View User';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['user_details'] = $this->user_model->get_all_details(USERS,$condition);
			if ($this->data['user_details']->num_rows() == 1){
				$this->load->view('admin/users/view_user',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_user(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->user_model->commonDelete(USERS,$condition);
			$this->setErrorMessage('success','Member deleted successfully');
            redirect('admin/users/display_user_list');
		}
	}
	/**
	 * 
	 * This function change the user verified status
	 */
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
			$this->user_model->update_details(USERS,$newdata,$condition);
			$this->setErrorMessage('success','User Status Changed Successfully');
			redirect('admin/users/display_user_list');
		}
	}
	
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_user_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->user_model->activeInactiveCommon(USERS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','User records deleted successfully');
			}else {
				$this->setErrorMessage('success','User records status changed successfully');
			}
			redirect('admin/users/display_user_list');
		}
	}
	public function export_user_details()
	{
		$sortArr = array('field'=>'id','type'=>'desc');
		$condition = array('group'=>'User');
		
		$UserDetails = $this->user_model->get_all_details(USERS,$condition);
		//echo "<pre>";print_r($UserDetails->result());die;
		$data['users_detail'] = $UserDetails->result_array();
		$this->load->view('admin/users/export_user',$data);
	}
	public function export_user_details1()
	{
	$fields_wanted=array('firstname','lastname','email','created','last_login_date','last_login_ip,status');
    $table=USERS;
	$users=$this->user_model->export_user_details($table,$fields_wanted);
	$this->data['users_detail']=$users['users_detail']->result();
	$this->load->view('admin/users/export_user',$this->data);
	}
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */