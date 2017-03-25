<?php if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );

/** 
 *
 * User related functions
 *
 * @author Teamtweaks
 *
 */
class User extends MY_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( array (
				'cookie',
				'date',
				'form',
				'email',
				'url'
		) );
		$this->load->library ( array (
				'encrypt',
				'form_validation',
				'linkedin',
				'session'
		) );
		$this->load->model ( array (
				'user_model',
				'product_model',
				'contact_model',
				'checkout_model',
				'order_model'
		) );
		if ($_SESSION ['sMainCategories'] == '') {
			$sortArr1 = array (
					'field' => 'cat_position',
					'type' => 'asc'
			);
			$sortArr = array (
					$sortArr1
			);
			$_SESSION ['sMainCategories'] = $this->product_model->get_all_details ( CATEGORY, array (
					'rootID' => '0',
					'status' => 'Active'
			), $sortArr );
		}
		$this->data ['mainCategories'] = $_SESSION ['sMainCategories'];
		if ($_SESSION ['sColorLists'] == '') {
			$_SESSION ['sColorLists'] = $this->user_model->get_all_details ( LIST_VALUES, array (
					'list_id' => '1'
			) );
		}
		$this->data ['mainColorLists'] = $_SESSION ['sColorLists'];

		$this->data ['loginCheck'] = $this->checkLogin ( 'U' );
		$this->data ['likedProducts'] = array ();
		if ($this->data ['loginCheck'] != '') {
			$this->data ['WishlistUserDetails'] = $this->user_model->get_all_details ( USERS, array (
					'id' => $this->checkLogin ( 'U' )
			) );
		}
	}

	/**
	 * Function for quick signup
	 */
	public function quickSignup() {
		$email = $this->input->post ( 'email' );
		$returnStr ['success'] = '0';
		if (valid_email ( $email )) {
			$condition = array (
					'email' => $email
			);
			$duplicateMail = $this->user_model->get_all_details ( USERS, $condition );
			if ($duplicateMail->num_rows () > 0) {
				$returnStr ['msg'] = 'Email id already exists';
			} else {
				$fullname = substr ( $email, 0, strpos ( $email, '@' ) );
				$checkAvail = $this->user_model->get_all_details ( USERS, array (
						'user_name' => $fullname
				) );
				if ($checkAvail->num_rows () > 0) {
					$avail = FALSE;
				} else {
					$avail = TRUE;
					$username = $fullname;
				}
				while ( ! $avail ) {
					$username = $fullname . rand ( 1111, 999999 );
					$checkAvail = $this->user_model->get_all_details ( USERS, array (
							'user_name' => $username
					) );
					if ($checkAvail->num_rows () > 0) {
						$avail = FALSE;
					} else {
						$avail = TRUE;
					}
				}
				if ($avail) {
					$pwd = $this->get_rand_str ( '6' );
					$this->user_model->insertUserQuick ( $fullname, $username, $email, $pwd );
					$this->session->set_userdata ( 'quick_user_email', $email );
					$returnStr ['msg'] = 'Successfully registered';
					$returnStr ['full_name'] = $fullname;
					$returnStr ['user_name'] = $username;
					$returnStr ['password'] = $pwd;
					$returnStr ['email'] = $email;
					$returnStr ['success'] = '1';
				}
			}
		} else {
			$returnStr ['msg'] = "Invalid email id";
		}
		echo json_encode ( $returnStr );
	}

	/**
	 * Function for quick signup update
	 */
	public function quickSignupUpdate() {
		$returnStr ['success'] = '0';
		$unameArr = $this->config->item ( 'unameArr' );
		$username = $this->input->post ( 'username' );
		if (! preg_match ( '/^\w{1,}$/', trim ( $username ) )) {
			$returnStr ['msg'] = 'User name not valid. Only alphanumeric allowed';
		} elseif (in_array ( $username, $unameArr )) {
			$returnStr ['msg'] = 'User name already exists';
		} else {
			$email = $this->input->post ( 'email' );
			$condition = array (
					'user_name' => $username,
					'email !=' => $email
			);
			$duplicateName = $this->user_model->get_all_details ( USERS, $condition );
			if ($duplicateName->num_rows () > 0) {
				$returnStr ['msg'] = 'Username already exists';
			} else {
				$pwd = $this->input->post ( 'password' );
				$fullname = $this->input->post ( 'fullname' );
				$this->user_model->updateUserQuick ( $fullname, $username, $email, $pwd );
				$this->session->set_userdata ( 'quick_user_name', $username );
				$returnStr ['msg'] = 'Successfully registered';
				$returnStr ['success'] = '1';
			}
		}
		echo json_encode ( $returnStr );
	}
	public function send_quick_register_mail() {
		if ($this->checkLogin ( 'U' ) != '') {
		//die;
			redirect ( base_url () );
		} else {

			$quick_user_name = $this->session->userdata ( 'quick_user_email' );
			if ($quick_user_name == '') {
				redirect ( base_url () );
			} else {
				$condition = array (
						'email' => $quick_user_name
				);
				$userDetails = $this->user_model->get_all_details ( USERS, $condition );



				if ($userDetails->num_rows () == 1) {
					$this->send_confirm_mail ( $userDetails );
					if(stripslashes($this->lang->line('reg_success')) != '') {
					 $this->setErrorMessage('success',stripslashes($this->lang->line('reg_success')));
					 }else{
					$this->setErrorMessage('success','Registration  Successfully Completed. Please Check Your Mail to Verify Registration.');
					 }
					redirect ( base_url () );
				} else {
					if(stripslashes($this->lang->line('reg_verify')) != '') {
					 $this->setErrorMessage('success',stripslashes($this->lang->line('reg_verify')));
					 }else{
					$this->setErrorMessage('success','Please Check Your Mail to Verify Registration.');
					 }
					redirect ( base_url () );
				}
			}
		}
	}
	
	public function registerUser1() {
		$returnStr ['success'] = '0';
		$unameArr = $this->config->item ( 'unameArr' );
		$fullname = $this->input->post ( 'fullname' );
		$username = $this->input->post ( 'username' );
		$thumbnail = $this->input->post ( 'thumbnail' );
		$email = $this->input->post ( 'email' );
		$pwd = $this->input->post ( 'pwd' );
		$this->user_model->insertUserQuick_social ( $fullname, $username, $email, $pwd, $thumbnail );
		$this->session->set_userdata ( 'quick_user_email', $email );
		$returnStr ['msg'] = 'Successfully registered';
		$returnStr ['success'] = '1';
		echo json_encode ( $returnStr );
	}
	
	public function registerUser() {
		$returnStr ['success'] =0;
		$firstname = $this->input->post ( 'firstname' );
		$firstname=stripslashes($firstname);
		$firstname=trim($firstname);
		$lastname = $this->input->post ( 'lastname' );
		$lastname=stripslashes($lastname);
		$lastname=trim($lastname);
		$email = $this->input->post ( 'email' );
		$email=stripslashes($email);
		$email=trim($email);
		$pwd = $this->input->post ( 'pwd' );
		$news_signup = $this->input->post ( 'news_signup' );
		if (valid_email ( $email )) {
			$condition = array (
					'email' => $email
			);
			$duplicateMail = $this->user_model->get_all_details( USERS, $condition );
			if ($duplicateMail->num_rows () > 0) {
				$returnStr ['msg'] = 'Email id already exists';
				echo json_encode ( $returnStr );
				exit;
			} else {
	            $expireddate = date ( 'Y-m-d', strtotime ( '+15 days' ) );
				$this->user_model->insertUserQuick ( $firstname, $lastname, $email, $pwd, $news_signup, $expireddate );
				$this->session->set_userdata ( 'quick_user_name', $firstname );
				$this->session->set_userdata ( 'quick_user_email', $email );
				$usrDetails = $this->user_model->get_all_details ( USERS, $condition );
				$this->send_confirm_mail ( $usrDetails );
				$returnStr ['msg'] = 'Successfully registered';
				$returnStr ['success'] =1;
			}
			$email = $this->input->post ( 'email' );
			$pwd = $this->input->post ( 'pwd' );
			if (valid_email ( $email )) {
			$condition = array (
					'email' => $email
			);

			$checkUser = $this->user_model->get_all_details(USERS, $condition);
			if ($checkUser->num_rows () == '1') {
				$userdata = array (
					'fc_session_user_id' => $checkUser->row ()->id,
					'session_user_group' => $checkUser->row ()->group,
					'session_user_email' => $checkUser->row ()->email,
					'fc_session_user_pwd' => md5($pwd)
				);
				$this->session->set_userdata ( $userdata );
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time ();
				$newdata = array (
					'last_login_date' => mdate ( $datestring, $time ),
					'last_login_ip' => $this->input->ip_address ()
				);
				$condition = array (
					'id' => $checkUser->row ()->id
				);
				$this->user_model->update_details ( USERS, $newdata, $condition );
				if ($remember != '') {
					$userid = $this->encrypt->encode ( $checkUser->row ()->id );
					$cookie = array (
						'name' => 'admin_session',
						'value' => $userid,
						'expire' => 86400,
						'secure' => FALSE
					);
					$this->input->set_cookie ( $cookie );
				}
				$this->setErrorMessage('success','Registered & Login Successfully!');
			}else{
			$returnStr ['msg'] = 'Successfully failed 1';
			}
			}else{
			$returnStr ['msg'] = 'Successfully failed 2';
			}
		} else {
			$returnStr ['msg'] = "Invalid email id";
		}
		
		echo json_encode ($returnStr );
	}

	public function registerUser_bck(){
		$returnStr['success'] = '0';
		$firstname = $this->input->post ( 'firstname' );
		$lastname = $this->input->post ( 'lastname' );
		$email = $this->input->post ( 'email' );
		$pwd = $this->input->post ( 'pwd' );
		if (valid_email($email)){
			$condition = array('email'=>$email);
			$duplicateMail = $this->user_model->get_all_details(USERS,$condition);
			if ($duplicateMail->num_rows()>0){
				$this->setErrorMessage('error','Email id already exists');
				redirect('sign_up');
			}else {
				$returnMail = $this->user_model->get_all_details(USERS,$condition);
				if($returnMail->num_rows()>0){
					$this->setErrorMessage('success','Welcome back, Thanks for registering again');
				}
				$this->user_model->insertUserQuick($firstname,$lastname,$email,$pwd);
				$this->session->set_userdata('quick_user_name',$firstname);
				$usrDetails = $this->user_model->get_all_details(USERS,$condition);
				$this->send_confirm_mail($usrDetails);
				$this->setErrorMessage('success','Successfully registered');
				/* auto login */
				$returnStr['status_code'] = 0;
				$returnStr['message'] = 'welcome';
				$email = $this->input->post('email');
				$pwd = md5($this->input->post('pwd'));
				if (valid_email($email)){
					$condition = array('email'=>$email,'password'=>$pwd,'status'=>'Active');
					$checkUser = $this->user_model->get_all_details(USERS,$condition);
					$str = $this->db->last_query();
					if ($checkUser->num_rows() == '1'){
						$userdata = array(
							'fc_session_user_id' => $checkUser->row()->id,
							'dhdy_session_user_id' => $checkUser->row()->id,
							'session_user_email' => $checkUser->row()->email,
							'session_user_group' => $checkUser->row ()->group,
							'fc_session_user_pwd' => $pwd
						);
						$this->session->set_userdata($userdata);
						$datestring = "%Y-%m-%d %h:%i:%s";
						$time = time();
						$newdata = array(
							'last_login_date' => mdate($datestring,$time),
							'last_login_ip' => $this->input->ip_address(),
							'commision'=>$this->config->item('guide_commission')
						);
						$condition = array('id' => $checkUser->row()->id);
						$this->user_model->update_details(USERS,$newdata,$condition);
						if ($remember != ''){
							$userid = $this->encrypt->encode($checkUser->row()->id);
							$cookie = array(
								'name'   => 'admin_session',
								'value'  => $userid,
								'expire' => 86400,
								'secure' => FALSE
							);
							$this->input->set_cookie($cookie);
						}
						$this->setErrorMessage('success','Welcome back!');
						$returnStr['status_code'] = 1;
						redirect(base_url());
					}else {
						$this->setErrorMessage('error','Invalid login details');
					}
				} else {
					$this->setErrorMessage('error','Invalid email id');
				}
			}
		} else {
			$this->setErrorMessage('error','Invalid email id');
		}
		redirect(base_url());
	}

	public function resend_confirm_mail() {
		$mail = $this->input->post ( 'mail' );
		if ($mail == '') {
			echo '0';
		} else {
			$condition = array (
					'email' => $mail
			);
			$userDetails = $this->user_model->get_all_details ( USERS, $condition );
			$this->send_confirm_mail ( $userDetails );
			echo '1';
		}
	}
	public function dashboard_resend_confirm_mail() {
		$mail = $this->data ['userDetails']->row ()->email;
		if ($mail != '') {

			$condition = array (
					'email' => $mail
			);
			$userDetails = $this->user_model->get_all_details (USERS,$condition );
			$this->send_confirm_mail ( $userDetails );
			if(stripslashes($this->lang->line('reg_verify')) != '') {
			 $this->setErrorMessage('success',stripslashes($this->lang->line('reg_verify')));
			 }else{
			$this->setErrorMessage('success','Please Check Your Mail to Verify Registration.');
			 }
			redirect ( 'dashboard' );
		}
	}
	public function send_email_confirmation() {
		$returnStr ['status_code'] = 0;
		if ($this->checkLogin ( 'U' ) == '') {
			$returnStr ['message'] = 'Login required';
		} else {
			$this->send_confirm_mail ( $this->data ['userDetails'] );
			$returnStr ['status_code'] = 1;
		}
		echo json_encode ( $returnStr );
	}
	public function send_confirm_mail($userDetails = '') {

		$uid = $userDetails->row ()->id;
		$email = $userDetails->row ()->email;
		$name = $userDetails->row ()->firstname."    ".$userDetails->row ()->lastname;

		$randStr = $this->get_rand_str ('10');
		$condition = array (
				'id' => $uid
		);
		$dataArr = array (
				'verify_code' => $randStr
		);
		$this->user_model->update_details ( USERS, $dataArr, $condition );

		$newsid = '35';
		$template_values = $this->user_model->get_newsletter_template_details( $newsid );

		$user=$userDetails->row ()->firstname."     ".$userDetails->row ()->lastname;
		$cfmurl = base_url () . 'site/user/confirm_register/' . $uid . "/" . $randStr . "/confirmation";
		$subject = 'From: ' . $this->config->item ( 'email_title' ) . ' - ' . $template_values ['news_subject'];
		$adminnewstemplateArr = array (
				'email_title' => $this->config->item ('email_title'),
				'logo' => $this->data ['logo'],
				'username'=>$name
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

	public function send_verify_mail($userDetails = '') {

	   // echo "<script>alert('hi')</script>";die;
		$uid = $userDetails->row ()->id;
		$username = $userDetails->row ()->user_name;
		$email = $userDetails->row ()->email;

		$randStr = $this->get_rand_str ( '10' );
		$condition = array (
				'user_id' => $uid
		);
		$dataArr = array (
				'verify_code' => $randStr
		);
		$user_id_exist=$this->user_model->get_all_details(REQUIREMENTS,array('user_id'=>$uid));

		$user_id_exist1=$this->user_model->get_all_details(USERS,array('id'=>$uid));
		//echo " hgdfh".$uid.$user_id_exist->num_rows(); die;
		if($user_id_exist->num_rows() == 0)
		{
		//echo "<script>alert('inside')</script>"; die;
		$dataArr1 = array (
					'user_id' => $uid,
					'id_verified'=>'no',
					'verify_code' => $randStr
					);

		$condition1 = array();
		$this->user_model->commonInsertUpdate(REQUIREMENTS,'insert', $excludeArr,$dataArr1,$condition1);
		$dataArr2 = array (

					'is_verified'=>'No',
					'verify_code' => $randStr
					);
        $conditionuser = array (
				'id' => $uid
		);
		$this->user_model->commonInsertUpdate(USERS,'update', $excludeArr,$dataArr2,$conditionuser);
		}else
		{
		$this->user_model->update_details( REQUIREMENTS, $dataArr, $condition );
		$condition2 = array (
				'id' => $uid
		);

		$this->user_model->update_details( USERS, $dataArr, $condition2 );
		}
		$newsid = '18';
		$template_values = $this->user_model->get_newsletter_template_details( $newsid );

		$user=$userDetails->row ()->firstname.' '.$userDetails->row ()->lastname;
		$cfmurl = base_url () . 'site/user/confirm_verify/' . $uid . "/" . $randStr . "/confirmation";
		$subject = 'From: ' . $this->config->item ( 'email_title' ) . ' - ' . $template_values ['news_subject'];
		$adminnewstemplateArr = array (
				'email_title' => $this->config->item ( 'email_title' ),
				'logo' => $this->data ['logo'],
				'username'=>$username,
				'confirm_url'=>$cfmurl
		);
		extract ( $adminnewstemplateArr );
		//echo $this->data ['siteContactMail'];die;
		$header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
		include ('./newsletter/registeration' . $newsid . '.php');

		$message .= '</body>
			</html>';

		$sender_email = $this->data ['siteContactMail'];
		$sender_name = $this->data ['siteTitle'];
		
		// add inbox from mail
		// $this->product_model->simple_insert(INBOX,array('sender_id'=>$sender_email,'user_id'=>$email,'mailsubject'=>$template_values['news_subject'],'description'=>stripslashes($message)));
		$adminDetails=$this->user_model->get_all_details(ADMIN_SETTINGS,array('id'=>1));
		$ccMail = $adminDetails->row()->site_contact_mail;
		$email_values = array (
				'mail_type' => 'html',
				'from_mail_id' => $sender_email,
				'mail_name' => $sender_name,
				'to_mail_id' => $email,
				'cc_mail_id' => $ccMail,
				'subject_message' => $template_values ['news_subject'],
				'body_messages' => $message

		);
		//echo "<pre>";print_r($email_values);die;
		 /* foreach($email_values as $emailV)
		{
		echo stripslashes($emailV);
		echo '<br>';
		}die;   */
		//print_r(stripslashes($message));die;

		$email_send_to_common = $this->user_model->common_email_send ( $email_values );
	}

	public function signup_form() {
		if ($this->checkLogin ( 'U' ) != '') {
			redirect ( base_url () );
		} else {
			$this->data ['heading'] = 'Sign up';
			$this->load->view ( 'site/user/signup.php', $this->data );
		}
	}

	/**
	 * Loading login page
	 */
	public function login_form() {
		redirect();
	}
	public function login_user() {
		$returnStr ['status_code'] = 0;
		$returnStr ['message'] = 'welcome';
		//print_r($_POST);die;
		$email = $this->input->post ( 'email' );

		$pwd = md5 ( $this->input->post ( 'password' ) );

		$bpath = $this->input->post ('bpath');

		$remember = $this->input->post ( 'remember' );

		if (valid_email($email)) {
			$condition = array (
					'email' => $email,
					'password' => $pwd,
					'status' => 'Active'
			);
			
			$conditionInactive = array (
					'email' => $email,
					'password' => $pwd,
					'status' => 'Inactive'
			);
			$checkUser = $this->user_model->get_all_details ( USERS, $condition );
			$checkUserInactive = $this->user_model->get_all_details ( USERS, $conditionInactive );
			//echo $this->db->last_query();die;
			if ($checkUser->num_rows () == '1') {
				$userdata = array (
						'fc_session_user_id' => $checkUser->row ()->id,
						'session_user_group' => $checkUser->row ()->group,
						'session_user_email' => $checkUser->row ()->email,
						'fc_session_user_pwd' => $pwd
				);
				$this->session->set_userdata ( $userdata );
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time ();
				$newdata = array (
						'last_login_date' => mdate ( $datestring, $time ),
						'last_login_ip' => $this->input->ip_address () ,
						'login_hit' => 0,
						'loginUserType' => 'normal'
				);
				$condition = array (
						'id' => $checkUser->row ()->id
				);
				$this->user_model->update_details ( USERS, $newdata, $condition );
				if ($remember != '' && $remember=='yes')  {
					$userid =  ( $checkUser->row ()->id );
					$cookie = array (
							'name' => 'renters_newuser',
							'value' => $userid,
							'expire' => 86400,
							'secure' => FALSE
					);
					$this->input->set_cookie ( $cookie );
				}
				if($this->lang->line('login_success') != '') { $logged_in = stripslashes($this->lang->line('login_success')); } else $logged_in = "You are Logged In ... !";
				$this->setErrorMessage ( 'success', $logged_in );
				//$this->setErrorMessage ( 'success', 'You are Logged In ... !' );
				$returnStr ['status_code'] = 1;
			} if ($checkUserInactive->num_rows () == '1') {
				$returnStr ['message'] = 'Account is Inactive.';
			} else {
				$condition = array (
					'email' => $email
				);
				$checkUser = $this->user_model->get_all_details ( USERS, $condition );
				//echo $this->db->last_query();die;
				$login_hit = 0;
				if ($checkUser->num_rows () == '1')
				{
					$login_hit = $checkUser->row()->login_hit;
					$login_hit = $login_hit+1;
					$newdata = array (
							'login_hit' => $login_hit
					);
					$condition = array (
							'id' => $checkUser->row ()->id
					);
					$this->user_model->update_details ( USERS, $newdata, $condition );
					if($login_hit < 5)
					{
						$returnStr ['message'] = 'Invalid password, try again';
					}
					else
					{
						$pwd = $this->get_rand_str ( '6' );
						$newdata = array (
							'password' => md5 ( $pwd )
						);
						$condition = array (
							'email' => $email
						);
						$this->user_model->update_details ( USERS, $newdata, $condition );
						$this->send_user_password ( $pwd, $checkUser );
						$this->setErrorMessage ( 'success', 'New password sent to your mail' );
						$returnStr ['message'] = 'New password sent to your email';
						$returnStr ['status_code'] = 1;
					}
				} else {
					$returnStr ['message'] = "Invalid login credentials";
				}
			}
		} else {
			$returnStr ['message'] = "Invalid email id";
		}
		echo json_encode ( $returnStr );
	}

	/**
	 * ************************* added 14/05/2014 --------------------------------
	 */
	public function paypaldetail() {
		$returnStr ['status_code'] = '1';
		$bank_code = $this->input->post ( 'bank_code' );
		$paypalemail = $this->input->post ( 'paypalemail' );
		$bank_name = $this->input->post ( 'bank_name' );
		$bank_no = $this->input->post ( 'bank_no' );

		$condition = array (
				'id' => $this->checkLogin ( 'U' )
		);
		$dataArr = array (
				'bank_name' => $bank_name,
				'bank_no' => $bank_no,
				'bank_code' => $bank_code,
				'paypal_email' => $paypalemail
		);
		$this->user_model->update_details ( USERS, $dataArr, $condition );
		$returnStr ['message'] = "success" . $bank_code . $paypalemail;

		echo json_encode ( $returnStr );
	}

	/* -------------------- Rental enquiry added 15/04/2014 ----- */
	public function rentalEnquiry() {
		$returnStr ['status_code'] = 1;

		$NoOfDays = $this->getDatesFromRange ( date ( 'Y-m-d', strtotime ( $_REQUEST ['checkin'] ) ), date ( 'Y-m-d', strtotime ( $_REQUEST ['checkout'] ) ) );
		$dateCheck = $this->user_model->get_all_details ( CALENDARBOOKING, array (
				'PropId' => $_REQUEST ['prd_id']
		) );
		// echo $this->db->last_query();
		// print_r($NoOfDays);die;
		if ($dateCheck->num_rows () > 0) {
			foreach ( $dateCheck->result () as $dateCheckStr ) {
				if (in_array ( $dateCheckStr->the_date, $NoOfDays )) {
					$returnStr ['status_code'] = '';
					$returnStr ['message'] = "Rental date already booked";
					$returnStr ['status_code'] = 10;
					exit ();
				}
			}
		}
		// print_r($NoOfDays); echo '<pre>';print_r($dateCheck->result()); die;
		if ($returnStr ['status_code'] != 10) {
			// echo '<pre>';print_r($NoOfDays);die;
			$dataArr = array (
					'checkin' => date ( 'Y-m-d H:i:s', strtotime ( str_replace ( '-', '/', $this->input->post ( 'checkin' ) ) ) ),
					'checkout' => date ( 'Y-m-d H:i:s', strtotime ( str_replace ( '-', '/', $this->input->post ( 'checkout' ) ) ) ),
					'Enquiry' => $this->input->post ( 'Enquiry' ),
					'numofdates' => $this->input->post ( 'numofdates' ),
					'caltophone' => $this->input->post ( 'caltophone' ),
					'enquiry_timezone' => $this->input->post ( 'enquiry_timezone' ),
					'user_id' => $this->checkLogin ( 'U' ),
					'renter_id' => $this->input->post ( 'renter_id' ),
					'NoofGuest' => $this->input->post ( 'NoofGuest' ),
					'prd_id' => $this->input->post ( 'prd_id' )
			);
			$booking_status = array (
					'booking_status' => 'Enquiry'
			);
			$dataArr = array_merge ( $dataArr, $booking_status );
			$this->user_model->commonInsertUpdate ( RENTALENQUIRY, 'insert', array (), $dataArr, array (
					'user_id' => $this->checkLogin ( 'U' )
			) );
			$insertid = $this->db->insert_id ();
			$this->session->set_userdata ( 'EnquiryId', $insertid );
			$returnStr ['message'] = "Contact not send.";

			$rentalArr = $this->user_model->view_product_details_email ( $_REQUEST ['prd_id'] );
			// echo $this->db->last_query();die;
			$proImages = base_url () . PRODUCTPATH . $rentalArr->row ()->product_image;
			$rental_Details = array (
					'first_name' => $this->data ['userDetails']->row ()->firstname,
					'userphoneno' => $this->data ['userDetails']->row ()->phone_no,
					'last_name' => $this->data ['userDetails']->row ()->lastname,
					'firest_name' => $this->data ['userDetails']->row ()->firstname,
					'rental_name' => $rentalArr->row ()->product_title,
					'rental_image' => $proImages,
					'owner_email' => $rentalArr->row ()->email,
					'owner_phone' => $rentalArr->row ()->phone_no
			);
			$dataArr = array_merge ( $dataArr, $rental_Details );
			// echo json_encode($returnStr);
			$this->contact_owner ( $dataArr );
			$this->setErrorMessage ( 'success', 'Contact details sent to owner' );
		}
		echo json_encode ( $returnStr );
	}
	public function rentalEnquiry_booking() {
		
		$returnStr ['status_code'] = 1;

		$NoOfDays = $this->getDatesFromRange(date('Y-m-d', strtotime($_REQUEST['checkin'])),date('Y-m-d',strtotime($_REQUEST['checkout'])));

		$this->db->select('count(id) as count,the_date,id_state');
		$this->db->from(CALENDARBOOKING);
		$this->db->where_in('the_date',$NoOfDays);
		$this->db->group_by('the_date');
		$this->db->where('PropId',$_REQUEST['prd_id']);
		$booked_count=$this->db->get()->result();
		$dateCheck = $this->user_model->get_all_details ( CALENDARBOOKING, array ('PropId'=>$_REQUEST['prd_id']));
		//$dateCheck = $this->user_model->booking_details ($_REQUEST['prd_id']);
		if(count($booked_count) > 1){
			if ($dateCheck->num_rows () > 0) {

				foreach ( $dateCheck->result () as $dateCheckStr ) {
					if (in_array ( $dateCheckStr->the_date, $NoOfDays )) {

						$returnStr ['status_code'] = '';
						$returnStr ['message'] = "Rental date already booked";
						$returnStr ['status_code'] = 10;
						break;
					}
				}
			}
		}

		if ($returnStr ['status_code'] != 10)
		{

			$dataArr = array (
					'checkin' => date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $this->input->post('checkin')))),
					'b_checkin' => date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $this->input->post('checkin')))),
					'checkout' => date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $this->input->post('checkout')))),
					'b_checkout' => date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $this->input->post('checkout')))),
					'Enquiry' => $this->input->post ( 'Enquiry' ),
					'numofdates' => $this->input->post ( 'numofdates' ),
					'b_numofdates' => $this->input->post ( 'numofdates' ),
					'caltophone' => $this->input->post ( 'caltophone' ),
					'enquiry_timezone' => $this->input->post ( 'enquiry_timezone' ),
					'user_id' => $this->checkLogin ( 'U' ),
					'renter_id' => $this->input->post ( 'renter_id' ),
					'NoofGuest' => $this->input->post ( 'NoofGuest' ),
					'b_NoofGuest' => $this->input->post ( 'NoofGuest' ),
					
					'subTotal' => $this->input->post ( 'subTotal' ),
					'serviceFee' => $this->input->post ( 'serviceFee' ),
					'totalAmt' => $this->input->post ( 'totalAmt' ),
					
					'pro_subTotal' =>  AdminCurrencyValue($_REQUEST['prd_id'],$this->input->post ( 'subTotal' )),
					'pro_serviceFee' =>  AdminCurrencyValue($_REQUEST['prd_id'],$this->input->post ( 'serviceFee' )),
					'pro_totalAmt' =>  AdminCurrencyValue($_REQUEST['prd_id'],$this->input->post ( 'totalAmt' )),
					
					'b_serviceFee' => $this->input->post ( 'serviceFee' ),
					'b_totalAmt' => $this->input->post ( 'totalAmt' ),
					
					'prd_id' => $this->input->post ( 'prd_id' ),
					'b_prd_id' => $this->input->post ( 'prd_id' ),
					'cancellation_policy' => $this->input->post ( 'cancellation_policy' )
			);
//echo "<pre>"; print_r($dataArr);
			$booking_status = array (
					'booking_status' => 'Enquiry'

			);
			$dataArr1 = array_merge ( $dataArr, $booking_status );

			$this->user_model->commonInsertUpdate (RENTALENQUIRY, 'insert', array (), $dataArr1, array (
					'user_id' => $this->checkLogin ( 'U' )
			) );

			$insertid = $this->db->insert_id ();
			$this->data['bookingno']=$this->user_model->get_all_details(RENTALENQUIRY,array('id'=>$insertid));
			if($this->data['bookingno']->row()->Bookingno=='' || $this->data['bookingno']->row()->Bookingno==NULL) 
			{
				$val = 10*$insertid+8;
				$val = 1500000+$val;
				$bookingno ="EN".$val;
				$newdata = array (
						'Bookingno' => $bookingno
				);
				$condition = array (
						'id' => $insertid
				);
				$this->user_model->update_details (RENTALENQUIRY,$newdata,$condition);
			}
			$this->session->set_userdata('EnquiryId',$insertid);
			$returnStr ['message'] = "Contact not send.";
		}
		//print_r($returnStr);die;
		echo json_encode ( $returnStr );
	}

	/* Booking confirmation mail */


	public function emailhostreservationreq($id) {

		$this->data['bookingmail'] = $this->user_model->getbookeduser_detail($id);
		//$price = $this->data['bookingmail']->row()->price * $this->data['bookingmail']->row()->noofdates;

		$checkindate = date('d-M-Y',strtotime($this->data['bookingmail']->row()->checkin));
		$checkoutdate = date('d-M-Y',strtotime($this->data['bookingmail']->row()->checkout));

		$this->data['hostdetail'] = $this->user_model->get_all_details(USERS,array('id'=>$this->data['bookingmail']->row()->renter_id));

		$hostemail = $this->data['hostdetail']->row()->email;
		$hostname = $this->data['hostdetail']->row()->user_name;
		$to  = $this->data['bookingmail']->row()->email;

		$price_converts=CurrencyValue($this->data['bookingmail']->row()->prd_id,$this->data['bookingmail']->row()->price);
		/* $price = $price_converts * $this->data['bookingmail']->row()->noofdates; */
		$price = CurrencyValue($this->data['bookingmail']->row()->prd_id,$this->data['bookingmail']->row()->tot);

		$newsid = '16';
		$template_values = $this->user_model->get_newsletter_template_details ( $newsid );
		$product_name=$this->data['bookingmail']->row()->productname;
		
		$travellername = $this->data['bookingmail']->row()->firstname." ".$this->data['bookingmail']->row()->lastname; 
		$adminnewstemplateArr = array (
				'email_title' => $this->config->item ( 'email_title' ),
				'logo' => $this->data ['logo'],
				'checkindate'=>	$checkindate,
				'checkoutdate'=>$checkoutdate,
				'hostname'=>$hostname,
				'travellername'=>$travellername,
				'product_name'=>$this->data['bookingmail']->row()->productname,
				'prd_id'=>$this->data['bookingmail']->row()->prd_id,
				'price'=>$price_converts,
				'totalprice'=>$price,
				'symbol'=>$this->session->userdata('currency_type')
		);
		extract ( $adminnewstemplateArr );
		$product_name=$this->data['bookingmail']->row()->productname;

		$subject = 'From: ' . $this->config->item ( 'email_title' ) . ' - ' . $template_values ['news_subject'];
		$header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

		$message .= '<body>';
		include ('./newsletter/registeration' . $newsid . '.php');

		$message .= '</body>
			';

		$sender_email = $this->config->item ( 'site_contact_mail' );
		$sender_name = $this->config->item ( 'email_title' );
		


		$email_values = array (
				'mail_type' => 'html',
				'from_mail_id' => $sender_email,
				'mail_name' => $sender_name,
				'to_mail_id' => $hostemail,
				'subject_message' => $template_values['news_subject'],
				'body_messages' => $message
		);

		//echo '<pre>'; print_r($email_values); die;


	$this->contact_model->common_email_send($email_values);


	}



	public function traveller_reservation($id) {

	        $this->data['bookingmail'] = $this->user_model->getbookeduser_detail($id);
			$price = $this->data['bookingmail']->row()->price * $this->data['bookingmail']->row()->noofdates;

			$checkindate =date('d-M-Y',strtotime($this->data['bookingmail']->row()->checkin));
			$checkoutdate =date('d-M-Y',strtotime($this->data['bookingmail']->row()->checkout));

			$this->data['hostdetail'] = $this->user_model->get_all_details(USERS,array('id'=>$this->data['bookingmail']->row()->renter_id));
			$hostname = $this->data['hostdetail']->row->email;
			$hostemail = $this->data['hostdetail']->row->user_name;
			$to  = $this->data['bookingmail']->row()->email;

			// echo $this->data['bookingmail']->row()->noofdates;
			// echo $this->data['bookingmail']->row()->checkin;
			// echo $this->data['bookingmail']->row()->checkout;
			// echo $this->data['bookingmail']->row()->price;
			// echo $this->data['bookingmail']->row()->email;
			// echo $this->data['bookingmail']->row()->name;
			$price_converts=CurrencyValue($this->data['bookingmail']->row()->prd_id,$this->data['bookingmail']->row()->price);
			/* $price = $price_converts * $this->data['bookingmail']->row()->noofdates; */
			$totaloverall=$this->data['bookingmail']->row()->tot+$this->data['bookingmail']->row()->serviceFee;
			   $price = CurrencyValue($this->data['bookingmail']->row()->prd_id,$totaloverall);
			$prd_id =$this->data['bookingmail']->row()->prd_id;

		//	$this->data['productimage'] = $this->user_model->get_detail_all(PRODUCT_PHOTOS,array('product_id'=>$prd_id));
			$this->data['productimage'] = $this->user_model->getproductimage($prd_id);
			//echo $prd_id;
			//echo '<pre>'; print_r($this->data['productimage']->row()->product_image);die;


		$newsid = '20';
		$template_values = $this->user_model->get_newsletter_template_details ($newsid);
		$adminnewstemplateArr = array (
				'email_title' => $this->config->item ( 'email_title' ),
				'logo' => $this->data ['logo'],
				'checkindate'=>	$checkindate,
				'checkoutdate'=>$checkoutdate,
				'hostname'=>$hostname,
				'travellername'=>$this->data['bookingmail']->row()->name,
				'price'=>$price_converts,
				'totalprice'=>$price,
				'productname'=>$this->data['bookingmail']->row()->productname,
				'prd_id'=>$this->data['bookingmail']->row()->prd_id,
				'prd_image'=>$this->data['productimage']->row()->product_image,
				'symbol'=>$this->session->userdata('currency_type')
		);
		extract ( $adminnewstemplateArr );
		$subject = 'From: ' . $this->config->item ( 'email_title' ) . ' - ' . $template_values ['news_subject'];

		$header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

		$message .= '<body>';
		include ('./newsletter/registeration' . $newsid . '.php');

		$message .= '</body>';

		$sender_email = $this->config->item ( 'site_contact_mail' );
		$sender_name = $this->config->item ( 'email_title' );
		
		$email_values = array (
				'mail_type' => 'html',
				'from_mail_id' => $sender_email,
				'mail_name' => $sender_name,
				'to_mail_id' => $this->data['bookingmail']->row()->email,
				'subject_message' => $template_values ['news_subject'],
				'body_messages' => $message
		);
		//echo "<pre>";print_r($message);die;
	   $this->contact_model->common_email_send($email_values);


	}











	/* email send after enquiry */
	public function contact_owner($dataArr) {

		// ---------------email to user---------------------------
		if ($dataArr ['renter_id'] > 0) {
			$UserDetails = $this->user_model->get_all_details ( USERS, array (
					'id' => $this->checkLogin ( 'U' )
			) );
			$emailid = $UserDetails->row ()->email;
			$this->session->set_userdata ( 'ContacterEmail', $emailid );

			$newsid = '1';
			$template_values = $this->contact_model->get_newsletter_template_details ( $newsid );

			$cfmurl = base_url () . 'site/user/confirm_register/' . $uid . "/" . $randStr . "/confirmation";
			$subject = 'From: ' . $this->config->item ( 'email_title' ) . ' - ' . $template_values ['news_subject'];
			$adminnewstemplateArr = array (
					'email_title' => $this->config->item ( 'email_title' ),
					'logo' => $this->data ['logo']
			);

			extract ( $adminnewstemplateArr );
			extract ( $dataArr );

			// $ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
			$header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

			$message .= '<!DOCTYPE HTML>
							<html>
							<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
							<meta name="viewport" content="width=device-width"/><body>';
			include ('./newsletter/registeration' . $newsid . '.php');

			$message .= '</body>
							</html>';

			$sender_email = $this->data ['siteContactMail'];
			$sender_name = $this->data ['siteTitle'];
			

			// add inbox from mail
			$this->contact_model->simple_insert ( INBOX, array (
					'sender_id' => $owner_email,
					'user_id' => $emailid,
					'mailsubject' => $template_values ['news_subject'],
					'description' => stripslashes ( $message )
			) );

			$email_values = array (
					'mail_type' => 'html',
					'from_mail_id' => $sender_email,
					'mail_name' => $sender_name,
					'to_mail_id' => $emailid,
					'subject_message' => $template_values ['news_subject'],
					'body_messages' => $message
			);

			$email_send_to_common = $this->contact_model->common_email_send ( $email_values );

			// $user_input_values = $this->input->post();

			$this->mail_owner_admin ( $dataArr );
		}
		// redirect(base_url('rental/'.$this->input->post('rental_id')));
		/* echo '<!--<script>window.history.go(-1);</script>-->'; */

		// }
	}
	public function mail_owner_admin($got_values) { // print_r($got_values);die;

		// email to admin
		$header = '';
		$adminnewstemplateArr = array ();
		$subject = '';
		$cfmurl = '';
		$sender_email = '';
		$sender_name = '';
		$newsid = '9';
		$template_values = $this->contact_model->get_newsletter_template_details ( $newsid );

		$adminnewstemplateArr = array (
				'email_title' => $this->config->item ( 'email_title' ),
				'logo' => $this->data ['logo']
		);

		extract ( $adminnewstemplateArr );
		extract ( $got_values );

		$subject = 'From: ' . $this->config->item ( 'email_title' ) . ' - ' . $template_values ['news_subject'];
		$header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

		$message .= '<!DOCTYPE HTML>
						<html>
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						<meta name="viewport" content="width=device-width"/><body>';
		include ('./newsletter/registeration' . $newsid . '.php');

		$message .= '</body>
						</html>';

		$sender_email = $this->data ['siteContactMail'];
		$sender_name = $this->data ['siteTitle'];
		
		// add inbox from mail
		$this->contact_model->simple_insert ( INBOX, array (
				'sender_id' => $this->session->userdata ( 'ContacterEmail' ),
				'user_id' => $sender_email,
				'mailsubject' => $template_values ['news_subject'],
				'description' => stripslashes ( $message )
		) );
		$email_values2 = array (
				'mail_type' => 'html',
				'from_mail_id' => $sender_email,
				'mail_name' => $sender_email,
				'to_mail_id' => $sender_email,
				'subject_message' => $template_values ['news_subject'],
				'body_messages' => $message
		);
		$email_send_to_common1 = $this->contact_model->common_email_send ( $email_values2 );

		// Email to owner

		if ($got_values ['renter_id'] > 0) {
			$UserDetails = $this->user_model->get_all_details ( USERS, array (
					'id' => $got_values ['renter_id']
			) );
			$emailid = $UserDetails->row ()->email;
			$this->contact_model->simple_insert ( INBOX, array (
					'sender_id' => $this->session->userdata ( 'ContacterEmail' ),
					'user_id' => $emailid,
					'mailsubject' => $template_values ['news_subject'],
					'description' => stripslashes ( $message )
			) );
			$email_values = array (
					'mail_type' => 'html',
					'from_mail_id' => $sender_email,
					'mail_name' => $sender_name,
					'to_mail_id' => $emailid,
					'subject_message' => $template_values ['news_subject'],
					'body_messages' => $message
			);
			// echo"admin<pre>"; print_r($email_values2);echo "<br>";
			// echo"owner"; print_r($email_values); die;
			$this->session->unset_userdata ( 'ContacterEmail' );
			$email_send_to_common = $this->contact_model->common_email_send ( $email_values );
		}

		// print_r($message);die;
	}
	/* email send End */
	public function login_after_signup($userDetails = '') {
		if ($userDetails->num_rows () == '1') {
			$userdata = array (
					'fc_session_user_id' => $userDetails->row ()->id,
					'session_user_name' => $userDetails->row ()->user_name,
					'session_user_email' => $userDetails->row ()->email,
					'session_user_group' => $userDetails->row ()-> group
			);
			$this->session->set_userdata($userdata);
			$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time ();
			$newdata = array (
					'last_login_date' => mdate ( $datestring, $time ),
					'last_login_ip' => $this->input->ip_address ()
			);
			$condition = array (
					'id' => $userDetails->row ()->id
			);
			$this->user_model->update_details ( USERS, $newdata, $condition );
		} else {
			redirect ( base_url () );
		}
	}
	public function confirm_register() {
		$uid = $this->uri->segment ( 4, 0 );
		$code = $this->uri->segment ( 5, 0 );
		$mode = $this->uri->segment ( 6, 0 );
		//echo'<pre>';print_r($uid);
		//echo'<pre>';print_r($code);
		//echo'<pre>';print_r($mode);exit;
		if ($mode == 'confirmation') {
			$condition = array (
					'verify_code' => $code,
					'id' => $uid
			);
			$checkUser = $this->user_model->get_all_details ( USERS, $condition );
			if ($checkUser->num_rows () == 1) {
				$conditionArr = array (
						'id' => $uid,
						'verify_code' => $code
				);
				$dataArr = array (
						'id_verified' => 'Yes'
						//'status' => 'Active'
				);
				$this->user_model->update_details ( USERS, $dataArr, $condition );
				$this->setErrorMessage ( 'success', 'Great going ! Your mail ID has been verified' );
				$this->login_after_signup ( $checkUser );
				redirect ( base_url () );
			} else {
				$this->setErrorMessage ( 'error', 'Invalid confirmation link' );
				redirect ( base_url () );
			}
		} else {
			$this->setErrorMessage ( 'error', 'Invalid confirmation link' );
			redirect ( base_url () );
		}
	}

	public function confirm_verify() {
		$uid = $this->uri->segment ( 4, 0 );
		$code = $this->uri->segment ( 5, 0 );
		$mode = $this->uri->segment ( 6, 0 );
		if ($mode == 'confirmation') {
			/* $condition = array (
					'verify_code' => $code,
					'user_id' => $uid
			);
			$checkUser = $this->user_model->get_all_details ( REQUIREMENTS, $condition );*/
			$condition1 = array (
					'verify_code' => $code,
					'id' => $uid
			);
			$checkUser = $this->user_model->get_all_details ( USERS, $condition1 );
			if ($checkUser->num_rows () == 1) {
				/* $conditionArr = array (
						'user_id' => $uid,
						'verify_code' => $code
				);
				$dataArr = array (
						'id_verified' => 'yes'
				);
				$this->user_model->update_details ( REQUIREMENTS, $dataArr, $conditionArr ); */
				$conditionArr1 = array (
						'id' => $uid,
						'verify_code' => $code
				);
				$dataArr1 = array (
						'is_verified' => 'yes'
				);
				$this->user_model->update_details ( USERS, $dataArr1, $conditionArr1 );
				$this->setErrorMessage ( 'success', 'Great going ! Your mail ID has been verified' );
				redirect ( base_url () );
			} else {
				$this->setErrorMessage ( 'error', 'Invalid confirmation link' );
				redirect ( base_url () );
			}
		} else {
			$this->setErrorMessage ( 'error', 'Invalid confirmation link' );
			redirect ( base_url () );
		}
	}

	public function logout_user() {
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = time ();
		$newdata = array (
				'last_logout_date' => mdate ( $datestring, $time )
		);
		$condition = array (
				'id' => $this->checkLogin ( 'U' )
		);
		$this->user_model->update_details ( USERS, $newdata, $condition );
		$userdata = array (
				'fc_session_user_id' => '',
				'session_user_name' => '',
				'session_user_email' => '',
				'fc_session_temp_id' => '',
				'fc_session_user_pwd' => ''
		);
		$this->session->unset_userdata ( $userdata );

		@session_start ();
		unset ( $_SESSION ['token'] );
		$twitter_return_values = array (
				'tw_status' => '',
				'tw_access_token' => ''
		);

		$this->session->unset_userdata ( $twitter_return_values );
		delete_cookie("renters_newuser");
		$this->setErrorMessage ( 'success', 'Successfully logged out of your account' );
		redirect ( base_url () );
	}


	public function forgot_password_form() {
		$this->data ['heading'] = 'Forgot Password';
		$this->load->view ( 'site/user/forgot_password.php', $this->data );
	}
	public function forgot_password_user() {
		$returnStr ['status_code'] = 0;
		$returnStr ['message'] = '';
		$this->form_validation->set_rules ( 'email', 'Email Address', 'required' );
		if ($this->form_validation->run () === FALSE) {
			$this->setErrorMessage ( 'error', 'Email address required' );
			redirect ( 'forgot-password' );
		} else {
			$email = $this->input->post ( 'email' );
			if (valid_email ( $email )) {
				$condition = array (
						'email' => $email
				);
				$checkUser = $this->user_model->get_all_details ( USERS, $condition );

				//echo '<pre>'; print_r($checkUser->result_array()); die;
				if ($checkUser->num_rows () == '1') {
					$pwd = $this->get_rand_str ( '6' );
					$newdata = array (
							'password' => md5 ( $pwd )
					);
					$condition = array (
							'email' => $email
					);
					$this->user_model->update_details ( USERS, $newdata, $condition );
					$this->send_user_password ( $pwd, $checkUser );
					$this->setErrorMessage ( 'success', 'New password sent to your mail' );
					$returnStr ['message'] = 'New password sent to your email';
					$returnStr ['status_code'] = 1;
					// redirect('site/landing');
				} else {
					// $this->setErrorMessage('error','Your email id not matched in our records');
					$returnStr ['message'] = 'Your email id not matched in our records';
					// redirect('forgot-password');
				}
			} else {
				// $this->setErrorMessage('error','Email id not valid');
				$returnStr ['message'] = 'Please enter a valid email address';
				// redirect('forgot-password');
			}
		}
		echo json_encode ( $returnStr );
	}
	public function send_user_password($pwd = '', $query) {
		$newsid = '5';
		$template_values = $this->user_model->get_newsletter_template_details ( $newsid );
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
		
		// add inbox from mail
		// $this->product_model->simple_insert(INBOX,array('sender_id'=>$sender_email,'user_id'=>$query->row()->email,'mailsubject'=>'Password Reset','description'=>stripslashes($message)));

		$email_values = array (
				'mail_type' => 'html',
				'from_mail_id' => $sender_email,
				'mail_name' => $sender_name,
				'to_mail_id' => $query->row ()->email,
				'subject_message' => 'Password Reset',
				'body_messages' => $message
		);

		// print_r($message);die;

		$email_send_to_common = $this->product_model->common_email_send ( $email_values );

		/* echo $this->email->print_debugger();die; */
	}

	/*
	 * public function emailSettings_notification()
	 * {
	 * if ($this->checkLogin('U') == '')
	 * {
	 * $returnStr['message'] = 'You must login';
	 * }
	 * else
	 * {
	 * $user_id = $this->input->post('user_id');
	 * if($this->input->post('upcoming_reservation'))
	 * $up_res = 'yes';
	 * $current_pass = md5($this->input->post('old_password'));
	 * $condition = array('email'=>$email,'password'=>$current_pass);
	 * $checkuser = $this->user_model->get_all_details(USERS,$condition);
	 * if($checkuser->num_rows() == 1)
	 * {
	 * $newPass = md5($this->input->post('new_password'));
	 * $newdata = array('password' => $newPass);
	 * $condition1 = array('email'=>$email);
	 * $this->user_model->update_details(USERS,$newdata,$condition1);
	 * $this->setErrorMessage('success','Password changed successfully');
	 * redirect(dashboard);
	 * }
	 * else
	 * {
	 * $this->setErrorMessage('error','Current password is wrong');
	 * redirect('account-settings');
	 * }
	 * }
	 * }
	 */
	public function update_notifications() {
		if ($this->checkLogin ( 'U' ) == '')
			redirect ( base_url () );
		else {
			$emailArr = $this->data ['emailArr'];
			$emailStr = '';
			foreach ( $this->input->post () as $key => $val ) {
				if (in_array ( $key, $emailArr )) {
					$emailStr .= $key . ',';
				}
			}
			$emailStr = substr ( $emailStr, 0, strlen ( $emailStr ) - 1 );
			$dataArr = array (
					'email_notifications' => $emailStr
			);
			$condition = array (
					'id' => $this->checkLogin ( 'U' )
			);
			$this->user_model->update_details ( USERS, $dataArr, $condition );
			$this->setErrorMessage ( 'success', 'Email notifications settings saved successfully' );
			redirect ( account );
		}
	}
	public function update_notifications_mobile() {
		if ($this->checkLogin ( 'U' ) == '')
			redirect ( base_url () );
		else {
			$notyArr = $this->data ['notyArr'];
			$notyStr = '';
			foreach ( $this->input->post () as $key => $val ) {
				if (in_array ( $key, $notyArr )) {
					$notyStr .= $key . ',';
				}
			}
			$notyStr = substr ( $notyStr, 0, strlen ( $notyStr ) - 1 );
			$dataArr = array (
					'notifications' => $notyStr
			);
			$condition = array (
					'id' => $this->checkLogin ( 'U' )
			);
			$this->user_model->update_details ( USERS, $dataArr, $condition );
			$this->setErrorMessage ( 'success', 'Mobile notifications settings saved successfully' );
			redirect ( account );
		}
	}
	public function update_mobile_notifications() {
		if ($this->checkLogin ( 'U' ) == '')
			redirect ( base_url () );
		else {
			
		 $status = $this->input->post('checked');
		 if( $status=="")
		 {
		 $final_status ='No';
			
			$dataArr = array (
					'mobile_notification' => $final_status
			);
			$condition = array (
					'id' => $this->checkLogin ( 'U' )
			);
			$this->user_model->update_details ( USERS, $dataArr, $condition );
			$this->setErrorMessage ( 'error', 'Click the checkbox to Enable Mobile Notifications settings' );
			redirect ( account );
		 
		 
		 }
		 
		 
		 if($status=='on'){
		 $final_status ='Yes';
			}
			else
			{
			 $final_status ='No';
			}
			$dataArr = array (
					'mobile_notification' => $final_status
			);
			$condition = array (
					'id' => $this->checkLogin ( 'U' )
			);
			$this->user_model->update_details ( USERS, $dataArr, $condition );
			$this->setErrorMessage ( 'success', 'Mobile notifications settings saved successfully' );
			redirect ( account );
		}
	}

	/**
	 * * Membership Package Payment *
	 */
	public function memberPackagePayment() {
		$this->load->library ( 'paypal_class' );
		$totalAmount = explode ( '-', $_POST ['plan'] );
		$paypalProcess = unserialize ( $paypal_ipn_settings ['settings'] );
		$loginUserId = $this->checkLogin ( 'U' );
		$excludeArr = array (
				'plan',
				'planpay'
		);
		$MembershipIdArr = explode ( '-', $_POST ['member_pakage'] );
		if ($MembershipIdArr [0] > 0) {
			$meb_id = $MembershipIdArr [0];
		} else {
			$this->setErrorMessage ( 'error', 'Payment Details Invalid' );
			redirect ( base_url ( 'plan' ) );
		}
		
		$condition = array (
				'user_id' => $loginUserId
		);
		$dataArr = array (
				'member_pakage' => $_POST ['member_pakage']
		);

		$this->product_model->commonInsertUpdate ( PRODUCT, 'update', $excludeArr, $dataArr, $condition );
		$currDAte = date ( "Y-m-d" );
		$this->product_model->commonInsertUpdate ( USERS, 'update', array (
				'user_id',
				'plan',
				'planpay'
		), array (
				'member_pakage' => $meb_id,
				'member_purchase_date' => $currDAte
		), array (
				'id' => $loginUserId
		) );
		// echo $this->db->last_query();die;
		$quantity = 1;

		$paypal = $this->checkout_model->getPaypalDetails ();
		// print_r($paypal);
		$dataArr = array (
				'settings' => serialize ( $paypal )
		);
		// $result=serialize($dataArr['settings']);
		$ans = unserialize ( $paypal [0] ['settings'] );

		$email = $ans ['merchant_email'];

		$mode = $ans ['mode'];

		if ($mode == 'sandbox') {
			$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; // testing paypal url
		} else {
			$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr'; // paypal url
		}

		$this->paypal_class->add_field ( 'currency_code', 'USD' ); // USD

		$this->paypal_class->add_field ( 'business', $email ); // Business Email
		                                                   // $this->paypal_class->add_field('business',$email); // Business Email

		$this->paypal_class->add_field ( 'return', base_url () . 'order/pakagesuccess/' . $loginUserId . '/' . $lastFeatureInsertId ); // Return URL

		$this->paypal_class->add_field ( 'cancel_return', base_url () . 'order/failure' ); // Cancel URL

		$this->paypal_class->add_field ( 'notify_url', base_url () . 'order/ipnpayment' ); // Notify url

		// $this->paypal_class->add_field('custom', 'Product|'.$loginUserId.'|'.$lastFeatureInsertId); // Custom Values

		$this->paypal_class->add_field ( 'item_name', $totalAmount [0] ); // Product Name

		$this->paypal_class->add_field ( 'user_id', $loginUserId );

		$this->paypal_class->add_field ( 'quantity', $quantity ); // Quantity
		                                                       // echo $totalAmount;die;
		$this->paypal_class->add_field ( 'amount', $totalAmount [1] ); // Price
		                                                           // $this->paypal_class->add_field('amount', 1); // Price

		// echo base_url().'order/success/'.$loginUserId.'/'.$lastFeatureInsertId; die;

		$this->paypal_class->submit_paypal_post ();
	}
	public function update_privacy() {
		if ($this->checkLogin ( 'U' ) == '')
			redirect ( base_url () );
		else {
			$privacyArr = $this->data ['privacyArr'];
			$privacyStr = '';
			foreach ( $this->input->post () as $key => $val ) {
				if (in_array ( $key, $privacyArr )) {
					$privacyStr .= $key . ',';
				}
			}
			$privacyStr = substr ( $privacyStr, 0, strlen ( $privacyStr ) - 1 );
			$dataArr = array (
					'notifications' => $privacyStr
			);
			$condition = array (
					'id' => $this->checkLogin ( 'U' )
			);
			$this->user_model->update_details ( USERS, $dataArr, $condition );
			$this->setErrorMessage ( 'success', 'Privacy settings saved successfully' );
			redirect ( account - privacy );
		}
	}
	public function change_password1() {
		if ($this->checkLogin ( 'U' ) == '') {
			$returnStr ['message'] = 'You must login';
		} else {

		$email = $this->input->post ( 'id' );
		 $current_pass = md5 ( $this->input->post ( 'old_password' ) );
			$condition = array (
					'email' => $email,
					'password' => $current_pass
			);
			$checkuser = $this->user_model->get_all_details ( USERS, $condition );
			if ($checkuser->num_rows () == 1) {
				$newPass = md5 ( $this->input->post ( 'new_password' ) );
				$newdata = array (
						'password' => $newPass
				);
				$condition1 = array (
						'email' => $email
				);
				$this->user_model->update_details ( USERS, $newdata, $condition1 );
				$userdata = array (
						'fc_session_user_pwd' => $newPass
				);
				$this->session->set_userdata ( $userdata );
				$this->setErrorMessage ( 'success', 'Password changed successfully' );
				redirect ( dashboard );
			} else {
				$this->setErrorMessage ( 'error', 'Current password is wrong' );
				redirect ( 'account-security' );
			}
		}
	}
	public function cancel_account() {
		if ($this->checkLogin ( 'U' ) == '') {
			$returnStr ['message'] = 'You must login';
		} else {
			$email = $this->input->post ( 'email' );
			$condition = array (
					'email' => $email
			);
			$checkUser = $this->user_model->get_all_details ( USERS, $condition );
			if ($checkUser->num_rows () == 1) {
				$data = array (
						'user_id' => $this->input->post ( 'id' ),
						'email' => $email,
						'reason' => $this->input->post ( 'reason' ),
						'contact_again' => $this->input->post ( 'contact_ok' ),
						'detail' => $this->input->post ( 'details' )
				);
				$this->user_model->simple_insert ( USERS_DELETE, $data );
				$this->user_model->commonDelete ( USERS, $condition );
				$userdata = array (
						'fc_session_user_id' => '',
						'session_user_name' => '',
						'session_user_email' => '',
						'fc_session_temp_id' => ''
				);
				$this->session->unset_userdata ( $userdata );

				@session_start ();
				unset ( $_SESSION ['token'] );
				$twitter_return_values = array (
						'tw_status' => '',
						'tw_access_token' => ''
				);
				$this->session->unset_userdata ( $twitter_return_values );
				$this->setErrorMessage ( 'error', 'Your account has been canceled' );
				redirect ( base_url () );
			} else {
				$this->setErrorMessage ( 'error', 'User details not available' );
				redirect ( 'account-settings' );
			}
		}
	}
	public function add_fancy_item() {
		$returnStr ['status_code'] = 0;
		if ($this->checkLogin ( 'U' ) == '') {
			$returnStr ['message'] = 'You must login';
		} else {
			$tid = $this->input->post ( 'tid' );
			$checkProductLike = $this->user_model->get_all_details ( PRODUCT_LIKES, array (
					'product_id' => $tid,
					'user_id' => $this->checkLogin ( 'U' )
			) );
			if ($checkProductLike->num_rows () == 0) {
				$productDetails = $this->user_model->get_all_details ( PRODUCT, array (
						'seller_product_id' => $tid
				) );
				if ($productDetails->num_rows () == 0) {
					$productDetails = $this->user_model->get_all_details ( USER_PRODUCTS, array (
							'seller_product_id' => $tid
					) );
					$productTable = USER_PRODUCTS;
				} else {
					$productTable = PRODUCT;
				}
				if ($productDetails->num_rows () == 1) {
					$likes = $productDetails->row ()->likes;
					$dataArr = array (
							'product_id' => $tid,
							'user_id' => $this->checkLogin ( 'U' ),
							'ip' => $this->input->ip_address ()
					);
					$this->user_model->simple_insert ( PRODUCT_LIKES, $dataArr );
					$actArr = array (
							'activity_name' => 'fancy',
							'activity_id' => $tid,
							'user_id' => $this->checkLogin ( 'U' ),
							'activity_ip' => $this->input->ip_address ()
					);
					$this->user_model->simple_insert ( USER_ACTIVITY, $actArr );
					$datestring = "%Y-%m-%d %h:%i:%s";
					$time = time ();
					$createdTime = mdate ( $datestring, $time );
					$actArr = array (
							'activity' => 'like',
							'activity_id' => $tid,
							'user_id' => $this->checkLogin ( 'U' ),
							'activity_ip' => $this->input->ip_address (),
							'created' => $createdTime
					);
					$this->user_model->simple_insert ( NOTIFICATIONS, $actArr );
					$likes ++;
					$dataArr = array (
							'likes' => $likes
					);
					$condition = array (
							'seller_product_id' => $tid
					);
					$this->user_model->update_details ( $productTable, $dataArr, $condition );
					$totalUserLikes = $this->data ['userDetails']->row ()->likes;
					$totalUserLikes ++;
					$this->user_model->update_details ( USERS, array (
							'likes' => $totalUserLikes
					), array (
							'id' => $this->checkLogin ( 'U' )
					) );
					/*
					 * -------------------------------------------------------
					 * Creating list automatically when user likes a product
					 * -------------------------------------------------------
					 *
					 * $listCheck = $this->user_model->get_list_details($tid,$this->checkLogin('U'));
					 * if ($listCheck->num_rows() == 0){
					 * $productCategoriesArr = explode(',', $productDetails->row()->category_id);
					 * if (count($productCategoriesArr)>0){
					 * foreach ($productCategoriesArr as $productCategoriesRow){
					 * if ($productCategoriesRow != ''){
					 * $productCategory = $this->user_model->get_all_details(CATEGORY,array('id'=>$productCategoriesRow));
					 * if ($productCategory->num_rows()==1){
					 *
					 * }
					 * }
					 * }
					 * }
					 * }
					 */
					$returnStr ['status_code'] = 1;
				} else {
					$returnStr ['message'] = 'Product not available';
				}
			}
		}
		echo json_encode ( $returnStr );
	}
	public function remove_fancy_item() {
		$returnStr ['status_code'] = 0;
		if ($this->checkLogin ( 'U' ) == '') {
			$returnStr ['message'] = 'You must login';
		} else {
			$tid = $this->input->post ( 'tid' );
			$checkProductLike = $this->user_model->get_all_details ( PRODUCT_LIKES, array (
					'product_id' => $tid,
					'user_id' => $this->checkLogin ( 'U' )
			) );
			if ($checkProductLike->num_rows () == 1) {
				$productDetails = $this->user_model->get_all_details ( PRODUCT, array (
						'seller_product_id' => $tid
				) );
				if ($productDetails->num_rows () == 0) {
					$productDetails = $this->user_model->get_all_details ( USER_PRODUCTS, array (
							'seller_product_id' => $tid
					) );
					$productTable = USER_PRODUCTS;
				} else {
					$productTable = PRODUCT;
				}
				if ($productDetails->num_rows () == 1) {
					$likes = $productDetails->row ()->likes;
					$conditionArr = array (
							'product_id' => $tid,
							'user_id' => $this->checkLogin ( 'U' )
					);
					$this->user_model->commonDelete ( PRODUCT_LIKES, $conditionArr );
					$actArr = array (
							'activity_name' => 'unfancy',
							'activity_id' => $tid,
							'user_id' => $this->checkLogin ( 'U' ),
							'activity_ip' => $this->input->ip_address ()
					);
					$this->user_model->simple_insert ( USER_ACTIVITY, $actArr );
					$likes --;
					$dataArr = array (
							'likes' => $likes
					);
					$condition = array (
							'seller_product_id' => $tid
					);
					$this->user_model->update_details ( $productTable, $dataArr, $condition );
					$totalUserLikes = $this->data ['userDetails']->row ()->likes;
					$totalUserLikes --;
					$this->user_model->update_details ( USERS, array (
							'likes' => $totalUserLikes
					), array (
							'id' => $this->checkLogin ( 'U' )
					) );
					$returnStr ['status_code'] = 1;
				} else {
					$returnStr ['message'] = 'Product not available';
				}
			}
		}
		echo json_encode ( $returnStr );
	}
	public function display_user_profile() {
		$username = urldecode ( $this->uri->segment ( 2, 0 ) );
		if ($username == 'administrator') {
			$this->data ['heading'] = $username;
			$this->load->view ( 'site/user/display_admin_profile' );
		} else {
			$userProfileDetails = $this->user_model->get_all_details ( USERS, array (
					'user_name' => $username,
					'status' => 'Active'
			) );
			if ($userProfileDetails->num_rows () == 1) {
				$this->data ['heading'] = $username;
				if ($userProfileDetails->row ()->visibility == 'Only you' && $userProfileDetails->row ()->id != $this->checkLogin ( 'U' )) {
					$this->load->view ( 'site/user/display_user_profile_private', $this->data );
				} else {
					$this->data ['productLikeDetails'] = $this->user_model->get_like_details_fully ( $userProfileDetails->row ()->id );
					$this->data ['userProductLikeDetails'] = $this->user_model->get_like_details_fully_user_products ( $userProfileDetails->row ()->id );
					$this->data ['userProfileDetails'] = $userProfileDetails;
					$this->data ['recentActivityDetails'] = $this->user_model->get_activity_details ( $userProfileDetails->row ()->id );
					$this->data ['featureProductDetails'] = $this->product_model->get_featured_details ( $userProfileDetails->row ()->feature_product );

					$this->load->view ( 'site/user/display_user_profile', $this->data );
				}
			} else {
				$this->setErrorMessage ( 'error', 'User details not available' );
				redirect ( base_url () );
			}
		}
	}
	public function add_follow() {
		$returnStr ['status_code'] = 0;
		if ($this->checkLogin ( 'U' ) != '') {
			$follow_id = $this->input->post ( 'user_id' );
			$followingListArr = explode ( ',', $this->data ['userDetails']->row ()->following );
			if (! in_array ( $follow_id, $followingListArr )) {
				$followingListArr [] = $follow_id;
				$newFollowingList = implode ( ',', $followingListArr );
				$followingCount = $this->data ['userDetails']->row ()->following_count;
				$followingCount ++;
				$dataArr = array (
						'following' => $newFollowingList,
						'following_count' => $followingCount
				);
				$condition = array (
						'id' => $this->checkLogin ( 'U' )
				);
				$this->user_model->update_details ( USERS, $dataArr, $condition );
				$followUserDetails = $this->user_model->get_all_details ( USERS, array (
						'id' => $follow_id
				) );
				if ($followUserDetails->num_rows () == 1) {
					$followersListArr = explode ( ',', $followUserDetails->row ()->followers );
					if (! in_array ( $this->checkLogin ( 'U' ), $followersListArr )) {
						$followersListArr [] = $this->checkLogin ( 'U' );
						$newFollowersList = implode ( ',', $followersListArr );
						$followersCount = $followUserDetails->row ()->followers_count;
						$followersCount ++;
						$dataArr = array (
								'followers' => $newFollowersList,
								'followers_count' => $followersCount
						);
						$condition = array (
								'id' => $follow_id
						);
						$this->user_model->update_details ( USERS, $dataArr, $condition );
					}
				}
				$actArr = array (
						'activity_name' => 'follow',
						'activity_id' => $follow_id,
						'user_id' => $this->checkLogin ( 'U' ),
						'activity_ip' => $this->input->ip_address ()
				);
				$this->user_model->simple_insert ( USER_ACTIVITY, $actArr );
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time ();
				$createdTime = mdate ( $datestring, $time );
				$actArr = array (
						'activity' => 'follow',
						'activity_id' => $follow_id,
						'user_id' => $this->checkLogin ( 'U' ),
						'activity_ip' => $this->input->ip_address (),
						'created' => $createdTime
				);
				$this->user_model->simple_insert ( NOTIFICATIONS, $actArr );
				$this->send_noty_mail ( $followUserDetails->result_array () );
				$returnStr ['status_code'] = 1;
			} else {
				$returnStr ['status_code'] = 1;
			}
		}
		echo json_encode ( $returnStr );
	}
	public function add_follows() {
		$returnStr ['status_code'] = 0;
		if ($this->checkLogin ( 'U' ) != '') {
			$follow_ids = $this->input->post ( 'user_ids' );
			$follow_ids_arr = explode ( ',', $follow_ids );
			$followingListArr = explode ( ',', $this->data ['userDetails']->row ()->following );
			foreach ( $follow_ids_arr as $flwRow ) {
				if (in_array ( $flwRow, $followingListArr )) {
					if (($key = array_search ( $flwRow, $follow_ids_arr )) !== false) {
						unset ( $follow_ids_arr [$key] );
					}
				}
			}
			if (count ( $follow_ids_arr ) > 0) {
				$newfollowingListArr = array_merge ( $followingListArr, $follow_ids_arr );
				$newFollowingList = implode ( ',', $newfollowingListArr );
				$followingCount = $this->data ['userDetails']->row ()->following_count;
				$newCount = count ( $follow_ids_arr );
				$followingCount = $followingCount + $newCount;
				$dataArr = array (
						'following' => $newFollowingList,
						'following_count' => $followingCount
				);
				$condition = array (
						'id' => $this->checkLogin ( 'U' )
				);
				$this->user_model->update_details ( USERS, $dataArr, $condition );
				$conditionStr = 'where id IN (' . implode ( ',', $follow_ids_arr ) . ')';
				$followUserDetailsArr = $this->user_model->get_users_details ( $conditionStr );
				if ($followUserDetailsArr->num_rows () > 0) {
					foreach ( $followUserDetailsArr->result () as $followUserDetails ) {
						$followersListArr = explode ( ',', $followUserDetails->followers );
						if (! in_array ( $this->checkLogin ( 'U' ), $followersListArr )) {
							$followersListArr [] = $this->checkLogin ( 'U' );
							$newFollowersList = implode ( ',', $followersListArr );
							$followersCount = $followUserDetails->followers_count;
							$followersCount ++;
							$dataArr = array (
									'followers' => $newFollowersList,
									'followers_count' => $followersCount
							);
							$condition = array (
									'id' => $followUserDetails->id
							);
							$this->user_model->update_details ( USERS, $dataArr, $condition );
							$datestring = "%Y-%m-%d %h:%i:%s";
							$time = time ();
							$createdTime = mdate ( $datestring, $time );
							$actArr = array (
									'activity' => 'follow',
									'activity_id' => $followUserDetails->id,
									'user_id' => $this->checkLogin ( 'U' ),
									'activity_ip' => $this->input->ip_address (),
									'created' => $createdTime
							);
							$this->user_model->simple_insert ( NOTIFICATIONS, $actArr );
							$this->send_noty_mails ( $followUserDetails );
						}
					}
				}
				$returnStr ['status_code'] = 1;
			} else {
				$returnStr ['status_code'] = 1;
			}
		}
		echo json_encode ( $returnStr );
	}
	public function delete_follow() {
		$returnStr ['status_code'] = 0;
		if ($this->checkLogin ( 'U' ) != '') {
			$follow_id = $this->input->post ( 'user_id' );
			$followingListArr = explode ( ',', $this->data ['userDetails']->row ()->following );
			if (in_array ( $follow_id, $followingListArr )) {
				if (($key = array_search ( $follow_id, $followingListArr )) !== false) {
					unset ( $followingListArr [$key] );
				}
				$newFollowingList = implode ( ',', $followingListArr );
				$followingCount = $this->data ['userDetails']->row ()->following_count;
				$followingCount --;
				$dataArr = array (
						'following' => $newFollowingList,
						'following_count' => $followingCount
				);
				$condition = array (
						'id' => $this->checkLogin ( 'U' )
				);
				$this->user_model->update_details ( USERS, $dataArr, $condition );
				$followUserDetails = $this->user_model->get_all_details ( USERS, array (
						'id' => $follow_id
				) );
				if ($followUserDetails->num_rows () == 1) {
					$followersListArr = explode ( ',', $followUserDetails->row ()->followers );
					if (in_array ( $this->checkLogin ( 'U' ), $followersListArr )) {
						if (($key = array_search ( $this->checkLogin ( 'U' ), $followersListArr )) !== false) {
							unset ( $followersListArr [$key] );
						}
						$newFollowersList = implode ( ',', $followersListArr );
						$followersCount = $followUserDetails->row ()->followers_count;
						$followersCount --;
						$dataArr = array (
								'followers' => $newFollowersList,
								'followers_count' => $followersCount
						);
						$condition = array (
								'id' => $follow_id
						);
						$this->user_model->update_details ( USERS, $dataArr, $condition );
					}
				}
				$actArr = array (
						'activity_name' => 'unfollow',
						'activity_id' => $follow_id,
						'user_id' => $this->checkLogin ( 'U' ),
						'activity_ip' => $this->input->ip_address ()
				);
				$this->user_model->simple_insert ( USER_ACTIVITY, $actArr );
				$returnStr ['status_code'] = 1;
			} else {
				$returnStr ['status_code'] = 1;
			}
		}
		echo json_encode ( $returnStr );
	}
	public function display_user_added() {
		$username = urldecode ( $this->uri->segment ( 2, 0 ) );
		$userProfileDetails = $this->user_model->get_all_details ( USERS, array (
				'user_name' => $username
		) );
		if ($userProfileDetails->num_rows () == 1) {
			if ($userProfileDetails->row ()->visibility == 'Only you' && $userProfileDetails->row ()->id != $this->checkLogin ( 'U' )) {
				$this->load->view ( 'site/user/display_user_profile_private', $this->data );
			} else {
				$this->data ['heading'] = $username;
				$this->data ['userProfileDetails'] = $userProfileDetails;
				$this->data ['recentActivityDetails'] = $this->user_model->get_activity_details ( $userProfileDetails->row ()->id );
				$this->data ['addedProductDetails'] = $this->product_model->view_product_details ( ' where p.user_id=' . $userProfileDetails->row ()->id . ' and p.status="Publish"' );
				$this->data ['notSellProducts'] = $this->product_model->view_notsell_product_details ( ' where p.user_id=' . $userProfileDetails->row ()->id . ' and p.status="Publish"' );
				$this->load->view ( 'site/user/display_user_added', $this->data );
			}
		} else {
			redirect ( base_url () );
		}
	}
	public function display_user_lists() {
		$username = urldecode ( $this->uri->segment ( 2, 0 ) );
		$userProfileDetails = $this->user_model->get_all_details ( USERS, array (
				'user_name' => $username
		) );
		if ($userProfileDetails->num_rows () == 1) {
			if ($userProfileDetails->row ()->visibility == 'Only you' && $userProfileDetails->row ()->id != $this->checkLogin ( 'U' )) {
				$this->load->view ( 'site/user/display_user_profile_private', $this->data );
			} else {
				$this->data ['heading'] = $username;
				$this->data ['userProfileDetails'] = $userProfileDetails;
				$this->data ['recentActivityDetails'] = $this->user_model->get_activity_details ( $userProfileDetails->row ()->id );
				$this->data ['listDetails'] = $this->product_model->get_all_details ( LISTS_DETAILS, array (
						'user_id' => $userProfileDetails->row ()->id
				) );
				if ($this->data ['listDetails']->num_rows () > 0) {
					foreach ( $this->data ['listDetails']->result () as $listDetailsRow ) {
						$this->data ['listImg'] [$listDetailsRow->id] = '';
						if ($listDetailsRow->product_id != '') {
							$pidArr = array_filter ( explode ( ',', $listDetailsRow->product_id ) );

							$productDetails = '';
							if (count ( $pidArr ) > 0) {
								foreach ( $pidArr as $pidRow ) {
									if ($pidRow != '') {
										$productDetails = $this->product_model->get_all_details ( PRODUCT, array (
												'seller_product_id' => $pidRow,
												'status' => 'Publish'
										) );
										if ($productDetails->num_rows () == 0) {
											$productDetails = $this->product_model->get_all_details ( USER_PRODUCTS, array (
													'seller_product_id' => $pidRow,
													'status' => 'Publish'
											) );
										}
										if ($productDetails->num_rows () == 1)
											break;
									}
								}
							}
							if ($productDetails != '' && $productDetails->num_rows () == 1) {
								$this->data ['listImg'] [$listDetailsRow->id] = $productDetails->row ()->image;
							}
						}
					}
				}
				$this->load->view ( 'site/user/display_user_lists', $this->data );
			}
		} else {
			redirect ( base_url () );
		}
	}
	public function display_user_wants() {
		$username = urldecode ( $this->uri->segment ( 2, 0 ) );
		$userProfileDetails = $this->user_model->get_all_details ( USERS, array (
				'user_name' => $username
		) );
		if ($userProfileDetails->num_rows () == 1) {
			if ($userProfileDetails->row ()->visibility == 'Only you' && $userProfileDetails->row ()->id != $this->checkLogin ( 'U' )) {
				$this->load->view ( 'site/user/display_user_profile_private', $this->data );
			} else {
				$this->data ['heading'] = $username;
				$this->data ['userProfileDetails'] = $userProfileDetails;
				$this->data ['recentActivityDetails'] = $this->user_model->get_activity_details ( $userProfileDetails->row ()->id );
				$wantList = $this->user_model->get_all_details ( WANTS_DETAILS, array (
						'user_id' => $userProfileDetails->row ()->id
				) );
				$this->data ['wantProductDetails'] = $this->product_model->get_wants_product ( $wantList );
				$this->data ['notSellProducts'] = $this->product_model->get_notsell_wants_product ( $wantList );
				$this->load->view ( 'site/user/display_user_wants', $this->data );
			}
		} else {
			redirect ( base_url () );
		}
	}
	public function display_user_owns() {
		$username = urldecode ( $this->uri->segment ( 2, 0 ) );
		$userProfileDetails = $this->user_model->get_all_details ( USERS, array (
				'user_name' => $username
		) );
		if ($userProfileDetails->num_rows () == 1) {
			if ($userProfileDetails->row ()->visibility == 'Only you' && $userProfileDetails->row ()->id != $this->checkLogin ( 'U' )) {
				$this->load->view ( 'site/user/display_user_profile_private', $this->data );
			} else {
				$this->data ['heading'] = $username;
				$this->data ['userProfileDetails'] = $userProfileDetails;
				$this->data ['recentActivityDetails'] = $this->user_model->get_activity_details ( $userProfileDetails->row ()->id );
				$productIdsArr = array_filter ( explode ( ',', $userProfileDetails->row ()->own_products ) );
				$productIds = '';
				if (count ( $productIdsArr ) > 0) {
					foreach ( $productIdsArr as $pidRow ) {
						if ($pidRow != '') {
							$productIds .= $pidRow . ',';
						}
					}
					$productIds = substr ( $productIds, 0, - 1 );
				}
				if ($productIds != '') {
					$this->data ['ownsProductDetails'] = $this->product_model->view_product_details ( ' where p.seller_product_id in (' . $productIds . ') and p.status="Publish"' );
					$this->data ['notSellProducts'] = $this->product_model->view_notsell_product_details ( ' where p.seller_product_id in (' . $productIds . ') and p.status="Publish"' );
				} else {
					$this->data ['addedProductDetails'] = '';
					$this->data ['notSellProducts'] = '';
				}
				$this->load->view ( 'site/user/display_user_owns', $this->data );
			}
		} else {
			redirect ( base_url () );
		}
	}
	public function display_user_following() {
		$username = urldecode ( $this->uri->segment ( 2, 0 ) );
		$userProfileDetails = $this->user_model->get_all_details ( USERS, array (
				'user_name' => $username
		) );
		if ($userProfileDetails->num_rows () == 1) {
			if ($userProfileDetails->row ()->visibility == 'Only you' && $userProfileDetails->row ()->id != $this->checkLogin ( 'U' )) {
				$this->load->view ( 'site/user/display_user_profile_private', $this->data );
			} else {
				$this->data ['heading'] = $username;
				$this->data ['userProfileDetails'] = $userProfileDetails;
				$this->data ['recentActivityDetails'] = $this->user_model->get_activity_details ( $userProfileDetails->row ()->id );
				$fieldsArr = array (
						'*'
				);
				$searchName = 'id';
				$searchArr = explode ( ',', $userProfileDetails->row ()->following );
				$joinArr = array ();
				$sortArr = array ();
				$limit = '';
				$this->data ['followingUserDetails'] = $followingUserDetails = $this->product_model->get_fields_from_many ( USERS, $fieldsArr, $searchName, $searchArr, $joinArr, $sortArr, $limit );
				if ($followingUserDetails->num_rows () > 0) {
					foreach ( $followingUserDetails->result () as $followingUserRow ) {
						$this->data ['followingUserLikeDetails'] [$followingUserRow->id] = $this->user_model->get_userlike_products ( $followingUserRow->id );
					}
				}
				$this->load->view ( 'site/user/display_user_following', $this->data );
			}
		} else {
			redirect ( base_url () );
		}
	}
	public function display_user_followers() {
		$username = urldecode ( $this->uri->segment ( 2, 0 ) );
		$userProfileDetails = $this->user_model->get_all_details ( USERS, array (
				'user_name' => $username
		) );
		if ($userProfileDetails->num_rows () == 1) {
			if ($userProfileDetails->row ()->visibility == 'Only you' && $userProfileDetails->row ()->id != $this->checkLogin ( 'U' )) {
				$this->load->view ( 'site/user/display_user_profile_private', $this->data );
			} else {
				$this->data ['heading'] = $username;
				$this->data ['userProfileDetails'] = $userProfileDetails;
				$this->data ['recentActivityDetails'] = $this->user_model->get_activity_details ( $userProfileDetails->row ()->id );
				$fieldsArr = array (
						'*'
				);
				$searchName = 'id';
				$searchArr = explode ( ',', $userProfileDetails->row ()->followers );
				$joinArr = array ();
				$sortArr = array ();
				$limit = '';
				$this->data ['followingUserDetails'] = $followingUserDetails = $this->product_model->get_fields_from_many ( USERS, $fieldsArr, $searchName, $searchArr, $joinArr, $sortArr, $limit );
				if ($followingUserDetails->num_rows () > 0) {
					foreach ( $followingUserDetails->result () as $followingUserRow ) {
						$this->data ['followingUserLikeDetails'] [$followingUserRow->id] = $this->user_model->get_userlike_products ( $followingUserRow->id );
					}
				}
				$this->load->view ( 'site/user/display_user_followers', $this->data );
			}
		} else {
			redirect ( base_url () );
		}
	}
	public function add_list_when_fancyy() {
		$returnStr ['status_code'] = 0;
		$returnStr ['listCnt'] = '';
		$returnStr ['wanted'] = 0;
		$uniqueListNames = array ();
		if ($this->checkLogin ( 'U' ) == '') {
			$returnStr ['message'] = 'Login required';
		} else {
			$tid = $this->input->post ( 'tid' );
			$firstCatName = '';
			$firstCatDetails = '';
			$count = 1;

			// Adding lists which was not already created from product categories
			$productDetails = $this->user_model->get_all_details ( PRODUCT, array (
					'seller_product_id' => $tid
			) );
			if ($productDetails->num_rows () == 0) {
				$productDetails = $this->user_model->get_all_details ( USER_PRODUCTS, array (
						'seller_product_id' => $tid
				) );
			}
			if ($productDetails->num_rows () == 1) {
				$productCatArr = explode ( ',', $productDetails->row ()->category_id );
				if (count ( $productCatArr ) > 0) {
					$productCatNameArr = array ();
					foreach ( $productCatArr as $productCatID ) {
						if ($productCatID != '') {
							$productCatDetails = $this->user_model->get_all_details ( CATEGORY, array (
									'id' => $productCatID
							) );
							if ($productCatDetails->num_rows () == 1) {
								if ($count == 1) {
									$firstCatName = $productCatDetails->row ()->cat_name;
								}
								$listConditionArr = array (
										'name' => $productCatDetails->row ()->cat_name,
										'user_id' => $this->checkLogin ( 'U' )
								);
								$listCheck = $this->user_model->get_all_details ( LISTS_DETAILS, $listConditionArr );
								if ($count == 1) {
									$firstCatDetails = $listCheck;
								}
								if ($listCheck->num_rows () == 0) {
									$this->user_model->simple_insert ( LISTS_DETAILS, $listConditionArr );
									$userDetails = $this->user_model->get_all_details ( USERS, array (
											'id' => $this->checkLogin ( 'U' )
									) );
									$listCount = $userDetails->row ()->lists;
									if ($listCount < 0 || $listCount == '') {
										$listCount = 0;
									}
									$listCount ++;
									$this->user_model->update_details ( USERS, array (
											'lists' => $listCount
									), array (
											'id' => $this->checkLogin ( 'U' )
									) );
								}
								$count ++;
							}
						}
					}
				}
			}

			// Check the product id in list table
			$checkListsArr = $this->user_model->get_list_details ( $tid, $this->checkLogin ( 'U' ) );

			if ($checkListsArr->num_rows () == 0) {

				// Add the product id under the first category name
				if ($firstCatName != '') {
					$listConditionArr = array (
							'name' => $firstCatName,
							'user_id' => $this->checkLogin ( 'U' )
					);
					if ($firstCatDetails == '' || $firstCatDetails->num_rows () == 0) {
						$dataArr = array (
								'product_id' => $tid
						);
					} else {
						$productRowArr = explode ( ',', $firstCatDetails->row ()->product_id );
						$productRowArr [] = $tid;
						$newProductRowArr = implode ( ',', $productRowArr );
						$dataArr = array (
								'product_id' => $newProductRowArr
						);
					}
					$this->user_model->update_details ( LISTS_DETAILS, $dataArr, $listConditionArr );
					$listCntDetails = $this->user_model->get_all_details ( LISTS_DETAILS, $listConditionArr );
					if ($listCntDetails->num_rows () == 1) {
						array_push ( $uniqueListNames, $listCntDetails->row ()->id );
						$returnStr ['listCnt'] .= '<li class="selected"><label for="' . $listCntDetails->row ()->id . '"><input type="checkbox" checked="checked" id="' . $listCntDetails->row ()->id . '" name="' . $listCntDetails->row ()->id . '">' . $listCntDetails->row ()->name . '</label></li>';
					}
				}
			} else {

				// Get all the lists which contain this product
				foreach ( $checkListsArr->result () as $checkListsRow ) {
					array_push ( $uniqueListNames, $checkListsRow->id );
					$returnStr ['listCnt'] .= '<li class="selected"><label for="' . $checkListsRow->id . '"><input type="checkbox" checked="checked" id="' . $checkListsRow->id . '" name="' . $checkListsRow->id . '">' . $checkListsRow->name . '</label></li>';
				}
			}
			$all_lists = $this->user_model->get_all_details ( LISTS_DETAILS, array (
					'user_id' => $this->checkLogin ( 'U' )
			) );
			if ($all_lists->num_rows () > 0) {
				foreach ( $all_lists->result () as $all_lists_row ) {
					if (! in_array ( $all_lists_row->id, $uniqueListNames )) {
						$returnStr ['listCnt'] .= '<li><label for="' . $all_lists_row->id . '"><input type="checkbox" id="' . $all_lists_row->id . '" name="' . $all_lists_row->id . '">' . $all_lists_row->name . '</label></li>';
					}
				}
			}

			// Check the product wanted status
			$wantedProducts = $this->user_model->get_all_details ( WANTS_DETAILS, array (
					'user_id' => $this->checkLogin ( 'U' )
			) );
			if ($wantedProducts->num_rows () == 1) {
				$wantedProductsArr = explode ( ',', $wantedProducts->row ()->product_id );
				if (in_array ( $tid, $wantedProductsArr )) {
					$returnStr ['wanted'] = 1;
				}
			}
			$returnStr ['status_code'] = 1;
		}
		echo json_encode ( $returnStr );
	}
	public function add_item_to_lists() {
		$returnStr ['status_code'] = 0;
		if ($this->checkLogin ( 'U' ) == '') {
			$returnStr ['message'] = 'You must login';
		} else {
			$tid = $this->input->post ( 'tid' );
			$lid = $this->input->post ( 'list_ids' );
			$listDetails = $this->user_model->get_all_details ( LISTS_DETAILS, array (
					'id' => $lid
			) );
			if ($listDetails->num_rows () == 1) {
				$product_ids = explode ( ',', $listDetails->row ()->product_id );
				if (! in_array ( $tid, $product_ids )) {
					array_push ( $product_ids, $tid );
				}
				$new_product_ids = implode ( ',', $product_ids );
				$this->user_model->update_details ( LISTS_DETAILS, array (
						'product_id' => $new_product_ids
				), array (
						'id' => $lid
				) );
				$returnStr ['status_code'] = 1;
			}
		}
		echo json_encode ( $returnStr );
	}
	public function remove_item_from_lists() {
		$returnStr ['status_code'] = 0;
		if ($this->checkLogin ( 'U' ) == '') {
			$returnStr ['message'] = 'You must login';
		} else {
			$tid = $this->input->post ( 'tid' );
			$lid = $this->input->post ( 'list_ids' );
			$listDetails = $this->user_model->get_all_details ( LISTS_DETAILS, array (
					'id' => $lid
			) );
			if ($listDetails->num_rows () == 1) {
				$product_ids = explode ( ',', $listDetails->row ()->product_id );
				if (in_array ( $tid, $product_ids )) {
					if (($key = array_search ( $tid, $product_ids )) !== false) {
						unset ( $product_ids [$key] );
					}
				}
				$new_product_ids = implode ( ',', $product_ids );
				$this->user_model->update_details ( LISTS_DETAILS, array (
						'product_id' => $new_product_ids
				), array (
						'id' => $lid
				) );
				$returnStr ['status_code'] = 1;
			}
		}
		echo json_encode ( $returnStr );
	}
	public function add_want_tag() {
		$returnStr ['status_code'] = 0;
		if ($this->checkLogin ( 'U' ) == '') {
			$returnStr ['message'] = 'You must login';
		} else {
			$tid = $this->input->post ( 'thing_id' );
			$wantDetails = $this->user_model->get_all_details ( WANTS_DETAILS, array (
					'user_id' => $this->checkLogin ( 'U' )
			) );
			if ($wantDetails->num_rows () == 1) {
				$product_ids = explode ( ',', $wantDetails->row ()->product_id );
				if (! in_array ( $tid, $product_ids )) {
					array_push ( $product_ids, $tid );
				}
				$new_product_ids = implode ( ',', $product_ids );
				$this->user_model->update_details ( WANTS_DETAILS, array (
						'product_id' => $new_product_ids
				), array (
						'user_id' => $this->checkLogin ( 'U' )
				) );
			} else {
				$dataArr = array (
						'user_id' => $this->checkLogin ( 'U' ),
						'product_id' => $tid
				);
				$this->user_model->simple_insert ( WANTS_DETAILS, $dataArr );
			}
			$wantCount = $this->data ['userDetails']->row ()->want_count;
			if ($wantCount <= 0 || $wantCount == '') {
				$wantCount = 0;
			}
			$wantCount ++;
			$dataArr = array (
					'want_count' => $wantCount
			);
			$ownProducts = explode ( ',', $this->data ['userDetails']->row ()->own_products );
			if (in_array ( $tid, $ownProducts )) {
				if (($key = array_search ( $tid, $ownProducts )) !== false) {
					unset ( $ownProducts [$key] );
				}
				$ownCount = $this->data ['userDetails']->row ()->own_count;
				$ownCount --;
				$dataArr ['own_count'] = $ownCount;
				$dataArr ['own_products'] = implode ( ',', $ownProducts );
			}
			$this->user_model->update_details ( USERS, $dataArr, array (
					'id' => $this->checkLogin ( 'U' )
			) );
			$returnStr ['status_code'] = 1;
		}
		echo json_encode ( $returnStr );
	}
	public function delete_want_tag() {
		$returnStr ['status_code'] = 0;
		if ($this->checkLogin ( 'U' ) == '') {
			$returnStr ['message'] = 'You must login';
		} else {
			$tid = $this->input->post ( 'thing_id' );
			$wantDetails = $this->user_model->get_all_details ( WANTS_DETAILS, array (
					'user_id' => $this->checkLogin ( 'U' )
			) );
			if ($wantDetails->num_rows () == 1) {
				$product_ids = explode ( ',', $wantDetails->row ()->product_id );
				if (in_array ( $tid, $product_ids )) {
					if (($key = array_search ( $tid, $product_ids )) !== false) {
						unset ( $product_ids [$key] );
					}
				}
				$new_product_ids = implode ( ',', $product_ids );
				$this->user_model->update_details ( WANTS_DETAILS, array (
						'product_id' => $new_product_ids
				), array (
						'user_id' => $this->checkLogin ( 'U' )
				) );
				$wantCount = $this->data ['userDetails']->row ()->want_count;
				if ($wantCount <= 0 || $wantCount == '') {
					$wantCount = 1;
				}
				$wantCount --;
				$this->user_model->update_details ( USERS, array (
						'want_count' => $wantCount
				), array (
						'id' => $this->checkLogin ( 'U' )
				) );
				$returnStr ['status_code'] = 1;
			}
		}
		echo json_encode ( $returnStr );
	}
	public function create_list() {
		$returnStr ['status_code'] = 0;
		if ($this->checkLogin ( 'U' ) == '') {
			$returnStr ['message'] = 'You must login';
		} else {
			$tid = $this->input->post ( 'tid' );
			$list_name = $this->input->post ( 'list_name' );
			$category_id = $this->input->post ( 'category_id' );
			$checkList = $this->user_model->get_all_details ( LISTS_DETAILS, array (
					'name' => $list_name,
					'user_id' => $this->checkLogin ( 'U' )
			) );
			if ($checkList->num_rows () == 0) {
				$dataArr = array (
						'user_id' => $this->checkLogin ( 'U' ),
						'name' => $list_name,
						'product_id' => $tid
				);
				if ($category_id != '') {
					$dataArr ['category_id'] = $category_id;
				}
				$this->user_model->simple_insert ( LISTS_DETAILS, $dataArr );
				$userDetails = $this->user_model->get_all_details ( USERS, array (
						'id' => $this->checkLogin ( 'U' )
				) );
				$listCount = $userDetails->row ()->lists;
				if ($listCount < 0 || $listCount == '') {
					$listCount = 0;
				}
				$listCount ++;
				$this->user_model->update_details ( USERS, array (
						'lists' => $listCount
				), array (
						'id' => $this->checkLogin ( 'U' )
				) );
				$returnStr ['list_id'] = $this->user_model->get_last_insert_id ();
				$returnStr ['new_list'] = 1;
			} else {
				$productArr = explode ( ',', $checkList->row ()->product_id );
				if (! in_array ( $tid, $productArr )) {
					array_push ( $productArr, $tid );
				}
				$product_id = implode ( ',', $productArr );
				$dataArr = array (
						'product_id' => $product_id
				);
				if ($category_id != '') {
					$dataArr ['category_id'] = $category_id;
				}
				$this->user_model->update_details ( LISTS_DETAILS, $dataArr, array (
						'user_id' => $this->checkLogin ( 'U' ),
						'name' => $list_name
				) );
				$returnStr ['list_id'] = $checkList->row ()->id;
				$returnStr ['new_list'] = 0;
			}
			$returnStr ['status_code'] = 1;
		}
		echo json_encode ( $returnStr );
	}
	public function search_users() {
		$search_key = $this->input->post ( 'term' );
		$returnStr = array ();
		if ($search_key != '') {
			$userList = $this->user_model->get_search_user_list ( $search_key, $this->checkLogin ( 'U' ) );
			if ($userList->num_rows () > 0) {
				$i = 0;
				foreach ( $userList->result () as $userRow ) {
					$userArr ['id'] = $userRow->id;
					$userArr ['fullname'] = $userRow->full_name;
					$userArr ['username'] = $userRow->user_name;
					if ($userRow->image != '') {
						$userArr ['image_url'] = 'images/users/' . $userRow->image;
					} else {
						$userArr ['image_url'] = 'images/users/user-thumb1.png';
					}
					array_push ( $returnStr, $userArr );
					$i ++;
				}
			}
		}
		echo json_encode ( $returnStr );
	}
	public function seller_signup_form() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			if ($this->data ['userDetails']->row ()->is_verified == 'No') {
				$this->setErrorMessage ( 'error', 'Please confirm your email first' );
				redirect ( base_url () );
			} else {
				$this->data ['heading'] = 'Seller Signup';
				$this->load->view ( 'site/user/seller_register', $this->data );
			}
		}
	}
	public function create_brand_form() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			$this->data ['heading'] = 'Seller Signup';
			$this->load->view ( 'site/user/seller_register', $this->data );
		}
	}
	public function seller_signup() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			if ($this->data ['userDetails']->row ()->is_verified == 'No') {
				$this->setErrorMessage ( 'error', 'Please confirm your email first' );
				redirect ( 'create-brand' );
				// echo "<script>window.history.go(-1)/script>";
			} else {
				$dataArr = array (
						'request_status' => 'Pending'
				);
				$this->user_model->commonInsertUpdate ( USERS, 'update', array (), $dataArr, array (
						'id' => $this->checkLogin ( 'U' )
				) );
				$this->setErrorMessage ( 'success', 'Welcome onboard ! Our team is evaluating your request. We will contact you shortly' );
				redirect ( base_url () );
			}
		}
	}
	public function view_purchase() {
		if ($this->checkLogin ( 'U' ) == '') {
			show_404 ();
		} else {
			$uid = $this->uri->segment ( 2, 0 );
			$dealCode = $this->uri->segment ( 3, 0 );
			if ($uid != $this->checkLogin ( 'U' )) {
				show_404 ();
			} else {
				$purchaseList = $this->user_model->get_purchase_list ( $uid, $dealCode );
				$invoice = $this->get_invoice ( $purchaseList );
				echo $invoice;
			}
		}
	}
	public function view_order() {
		if ($this->checkLogin ( 'U' ) == '') {
			show_404 ();
		} else {
			$uid = $this->uri->segment ( 2, 0 );
			$dealCode = $this->uri->segment ( 3, 0 );
			if ($uid != $this->checkLogin ( 'U' )) {
				show_404 ();
			} else {
				$orderList = $this->user_model->get_order_list ( $uid, $dealCode );
				$invoice = $this->get_invoice ( $orderList );
				echo $invoice;
			}
		}
	}
	public function get_invoice($PrdList) {
		$shipAddRess = $this->user_model->get_all_details ( SHIPPING_ADDRESS, array (
				'id' => $PrdList->row ()->shippingid
		) );
		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>Product Order Confirmation</title>
<body>
<div style="width:1012px;background:#FFFFFF; margin:0 auto;">
<div style="width:100%;background:#454B56; float:left; margin:0 auto;">
    <div style="padding:20px 0 10px 15px;float:left; width:50%;"><a href="' . base_url () . '" target="_blank" id="logo"><img src="' . base_url () . 'images/logo/' . $this->data ['logo'] . '" alt="' . $this->data ['WebsiteTitle'] . '" title="' . $this->data ['WebsiteTitle'] . '"></a></div>

</div>
<!--END OF LOGO-->

 <!--start of deal-->
    <div style="width:970px;background:#FFFFFF;float:left; padding:20px; border:1px solid #454B56; ">

	<div style=" float:right; width:35%; margin-bottom:20px; margin-right:7px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
			  <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Id</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">#' . $PrdList->row ()->dealCodeNumber . '</span></td>
              </tr>
              <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Date</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">' . date ( "F j, Y g:i a", strtotime ( $PrdList->row ()->created ) ) . '</span></td>
              </tr>

              </table>
        	</div>

    <div style="float:left; width:100%;">

    <div style="width:49%; float:left; border:1px solid #cccccc; margin-right:10px;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.8%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Shipping Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>' . stripslashes ( $shipAddRess->row ()->full_name ) . '</td></tr>
                    <tr><td>Address</td><td>:</td><td>' . stripslashes ( $shipAddRess->row ()->address1 ) . '</td></tr>
					<tr><td>Address 2</td><td>:</td><td>' . stripslashes ( $shipAddRess->row ()->address2 ) . '</td></tr>
					<tr><td>City</td><td>:</td><td>' . stripslashes ( $shipAddRess->row ()->city ) . '</td></tr>
					<tr><td>Country</td><td>:</td><td>' . stripslashes ( $shipAddRess->row ()->country ) . '</td></tr>
					<tr><td>State</td><td>:</td><td>' . stripslashes ( $shipAddRess->row ()->state ) . '</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>' . stripslashes ( $shipAddRess->row ()->postal_code ) . '</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>' . stripslashes ( $shipAddRess->row ()->phone ) . '</td></tr>
            	</table>
            </div>
     </div>

    <div style="width:49%; float:left; border:1px solid #cccccc;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.7%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Billing Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>' . stripslashes ( $PrdList->row ()->full_name ) . '</td></tr>
                    <tr><td>Address</td><td>:</td><td>' . stripslashes ( $PrdList->row ()->address ) . '</td></tr>
					<tr><td>Address 2</td><td>:</td><td>' . stripslashes ( $PrdList->row ()->address2 ) . '</td></tr>
					<tr><td>City</td><td>:</td><td>' . stripslashes ( $PrdList->row ()->city ) . '</td></tr>
					<tr><td>Country</td><td>:</td><td>' . stripslashes ( $PrdList->row ()->country ) . '</td></tr>
					<tr><td>State</td><td>:</td><td>' . stripslashes ( $PrdList->row ()->state ) . '</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>' . stripslashes ( $PrdList->row ()->postal_code ) . '</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>' . stripslashes ( $PrdList->row ()->phone_no ) . '</td></tr>
            	</table>
            </div>
    </div>
</div>

<div style="float:left; width:100%; margin-right:3%; margin-top:10px; font-size:14px; font-weight:normal; line-height:28px;  font-family:Arial, Helvetica, sans-serif; color:#000; overflow:hidden;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece; width:99.5%;">
        <tr bgcolor="#f3f3f3">
        	<td width="17%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Bag Items</span></td>
            <td width="43%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>
            <td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Qty</span></td>
            <td width="14%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Unit Price</span></td>
            <td width="15%" style="text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Sub Total</span></td>
         </tr>';

		$disTotal = 0;
		$grantTotal = 0;
		foreach ( $PrdList->result () as $cartRow ) {
			$InvImg = @explode ( ',', $cartRow->image );
			$unitPrice = ($cartRow->price * (0.01 * $cartRow->product_tax_cost)) + $cartRow->product_shipping_cost + $cartRow->price;
			$uTot = $unitPrice * $cartRow->quantity;
			if ($cartRow->attr_name != '') {
				$atr = '<br>' . $cartRow->attr_name;
			} else {
				$atr = '';
			}
			$message .= '<tr>
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="' . base_url () . PRODUCTPATH . $InvImg [0] . '" alt="' . stripslashes ( $cartRow->product_name ) . '" width="70" /></span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">' . stripslashes ( $cartRow->product_name ) . $atr . '</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">' . strtoupper ( $cartRow->quantity ) . '</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">' . $this->data ['currencySymbol'] . number_format ( $unitPrice, 2, '.', '' ) . '</span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">' . $this->data ['currencySymbol'] . number_format ( $uTot, 2, '.', '' ) . '</span></td>
        </tr>';
			$grantTotal = $grantTotal + $uTot;
		}
		$private_total = $grantTotal - $PrdList->row ()->discountAmount;
		$private_total = $private_total + $PrdList->row ()->tax + $PrdList->row ()->shippingcost;

		$message .= '</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';
		if ($PrdList->row ()->note != '') {
			$message .= '<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>

            </tr>
			<tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">' . stripslashes ( $PrdList->row ()->note ) . '</span></td>
            </tr></table>';
		}

		if ($PrdList->row ()->order_gift == 1) {
			$message .= '<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
		}

		$message .= '</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
            <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Sub Total</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">' . $this->data ['currencySymbol'] . number_format ( $grantTotal, '2', '.', '' ) . '</span></td>
            </tr>
			<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Discount Amount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">' . $this->data ['currencySymbol'] . number_format ( $PrdList->row ()->discountAmount, '2', '.', '' ) . '</span></td>
            </tr>
		<tr bgcolor="#f3f3f3">
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Cost</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">' . $this->data ['currencySymbol'] . number_format ( $PrdList->row ()->shippingcost, 2, '.', '' ) . '</span></td>
              </tr>
			  <tr>
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Tax</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">' . $this->data ['currencySymbol'] . number_format ( $PrdList->row ()->tax, 2, '.', '' ) . '</span></td>
              </tr>
			  <tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">' . $this->data ['currencySymbol'] . number_format ( $private_total, '2', '.', '' ) . '</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        </div>

        <!--end of left-->


            <div style="width:27.4%; margin-right:5px; float:right;">


            </div>

        <div style="clear:both"></div>

    </div>
    </div></body></html>';
		return $message;
	}
	public function change_order_status() {
		if ($this->checkLogin ( 'U' ) == '') {
			show_404 ();
		} else {
			$uid = $this->input->post ( 'seller' );
			if ($uid != $this->checkLogin ( 'U' )) {
				show_404 ();
			} else {
				$returnStr ['status_code'] = 0;
				$dealCode = $this->input->post ( 'dealCode' );
				$status = $this->input->post ( 'value' );
				$dataArr = array (
						'shipping_status' => $status
				);
				$conditionArr = array (
						'dealCodeNumber' => $dealCode,
						'sell_id' => $uid
				);
				$this->user_model->update_details ( PAYMENT, $dataArr, $conditionArr );
				$returnStr ['status_code'] = 1;
				echo json_encode ( $returnStr );
			}
		}
	}
	public function display_user_lists_home() {
	//var_dump($_POST); die;
	//echo $this->checkLogin ('U'); die;
	$uname = $this->uri->segment ( '2', '0' );
		if ($this->checkLogin ( 'U' ) != '' && $uname==$this->checkLogin ( 'U' )) {
			$lid = $this->uri->segment ( '4', '0' );	
		//echo $uname; die;
		$this->data ['user_profile_details'] = $userProfileDetails = $this->user_model->get_all_details ( USERS, array (
				'id' => $uname
		) );
		//echo '<pre>';print_r($userProfileDetails->result()); die;
		if ($userProfileDetails->row ()->visibility == 'Only you' && $userProfileDetails->row ()->id != $this->checkLogin ( 'U' )) {
			$this->load->view ( 'site/user/display_user_profile_private', $this->data );
		} else {
			$this->data ['list_details'] = $list_details = $this->product_model->get_all_details (LISTS_DETAILS, array (
					'id' => $lid,
					'user_id'=>$uname
			) );
			
			if($list_details->num_rows()!=0){
			//print_r($list_details->result()); die;

			$searchArr = array_filter ( explode ( ',', $list_details->row ()->product_id ) );
			if (count ( $searchArr ) > 0) {
				foreach ( $searchArr as $searchphotoid ) {
					$wishlist_image[$searchphotoid]  = $this->product_model->get_wishlistphoto ( $searchphotoid );
				}
				$this->data ['product_details'] = $product_details = $this->product_model->get_product_details_wishlist_one_category ( $searchArr ,$this->checkLogin('U'));
					//echo $this->db->last_query(); die;
				$this->data ['totalProducts'] = $this->data ['product_details']->num_rows ();
			}
			$this->data['wishlist_image']=$wishlist_image;

			$this->data['login_user']=$this->checkLogin('U');
			$this->data['user_id']=$uname;
			
			$this->load->view ( 'site/user/user_list_home', $this->data );
			} else {
			show_404();
			}
		}
		} else {
			redirect('');
		}
	}
	public function DeleteallWishList() {
		$lid = $this->uri->segment ( '4', '0' );
			//$this->data['deletewishlist'] = $this->product_model->alldeletewishlist_details($lid );
			
			$wishlistdetails = $this->user_model->get_all_details(LISTS_DETAILS, array ('id' => $lid));
	$prd_id = ltrim($wishlistdetails->row()->product_id,",");
	$product_id = explode(',',$prd_id);
	foreach($product_id as $row){
	$this->user_model->commonDelete(NOTES, array ('user_id' => $wishlistdetails->row()->user_id,'product_id'=>$row));
	
	}
	$this->user_model->commonDelete(LISTS_DETAILS, array('id' => $lid));

			
			redirect('users/'.$this->data ['userDetails']->row ()->id.'/wishlists');
	}
	public function display_user_lists_edit() {
		$this->load->view ( 'site/user/user_list_edit' );
	}
	public function display_user_lists_followers() {
		$lid = $this->uri->segment ( '4', '0' );
		$uname = $this->uri->segment ( '2', '0' );
		$this->data ['user_profile_details'] = $userProfileDetails = $this->user_model->get_all_details ( USERS, array (
				'user_name' => $uname
		) );
		if ($userProfileDetails->row ()->visibility == 'Only you' && $userProfileDetails->row ()->id != $this->checkLogin ( 'U' )) {
			$this->load->view ( 'site/user/display_user_profile_private', $this->data );
		} else {
			$this->data ['list_details'] = $list_details = $this->product_model->get_all_details ( LISTS_DETAILS, array (
					'id' => $lid,
					'user_id' => $this->data ['user_profile_details']->row ()->id
			) );
			if ($this->data ['list_details']->num_rows () == 0) {
				show_404 ();
			} else {
				$fieldsArr = '*';
				$searchArr = explode ( ',', $list_details->row ()->followers );
				$this->data ['user_details'] = $user_details = $this->product_model->get_fields_from_many ( USERS, $fieldsArr, 'id', $searchArr );
				if ($user_details->num_rows () > 0) {
					foreach ( $user_details->result () as $userRow ) {
						$fieldsArr = array (
								PRODUCT_LIKES . '.*',
								PRODUCT . '.product_name',
								PRODUCT . '.image',
								PRODUCT . '.id as PID'
						);
						$searchArr = array (
								$userRow->id
						);
						$joinArr1 = array (
								'table' => PRODUCT,
								'on' => PRODUCT_LIKES . '.product_id=' . PRODUCT . '.seller_product_id',
								'type' => ''
						);
						$joinArr = array (
								$joinArr1
						);
						$sortArr1 = array (
								'field' => PRODUCT . '.created',
								'type' => 'desc'
						);
						$sortArr = array (
								$sortArr1
						);
						$this->data ['product_details'] [$userRow->id] = $this->product_model->get_fields_from_many ( PRODUCT_LIKES, $fieldsArr, PRODUCT_LIKES . '.user_id', $searchArr, $joinArr, $sortArr, '5' );
					}
				}
				$fieldsArr = array (
						PRODUCT . '.*',
						USERS . '.user_name',
						USERS . '.full_name'
				);
				$searchArr = array_filter ( explode ( ',', $list_details->row ()->product_id ) );
				if (count ( $searchArr ) > 0) {
					$this->data ['totalProducts'] = count ( $searchArr );
				} else {
					$this->data ['totalProducts'] = 0;
				}

				$this->load->view ( 'site/user/user_list_followers', $this->data );
			}
		}
	}
	public function follow_list() {
		$returnStr ['status_code'] = 0;
		$lid = $this->input->post ( 'lid' );
		if ($this->checkLogin ( 'U' ) != '') {
			$listDetails = $this->product_model->get_all_details ( LISTS_DETAILS, array (
					'id' => $lid
			) );
			$followersArr = explode ( ',', $listDetails->row ()->followers );
			$followersCount = $listDetails->row ()->followers_count;
			$oldDetails = explode ( ',', $this->data ['userDetails']->row ()->following_user_lists );
			if (! in_array ( $lid, $oldDetails )) {
				array_push ( $oldDetails, $lid );
			}
			if (! in_array ( $this->checkLogin ( 'U' ), $followersArr )) {
				array_push ( $followersArr, $this->checkLogin ( 'U' ) );
				$followersCount ++;
			}
			$this->product_model->update_details ( USERS, array (
					'following_user_lists' => implode ( ',', $oldDetails )
			), array (
					'id' => $this->checkLogin ( 'U' )
			) );
			$this->product_model->update_details ( LISTS_DETAILS, array (
					'followers' => implode ( ',', $followersArr ),
					'followers_count' => $followersCount
			), array (
					'id' => $lid
			) );
			$returnStr ['status_code'] = 1;
		}
		echo json_encode ( $returnStr );
	}
	public function unfollow_list() {
		$returnStr ['status_code'] = 0;
		$lid = $this->input->post ( 'lid' );
		if ($this->checkLogin ( 'U' ) != '') {
			$listDetails = $this->product_model->get_all_details ( LISTS_DETAILS, array (
					'id' => $lid
			) );
			$followersArr = explode ( ',', $listDetails->row ()->followers );
			$followersCount = $listDetails->row ()->followers_count;
			$oldDetails = explode ( ',', $this->data ['userDetails']->row ()->following_user_lists );
			if (in_array ( $lid, $oldDetails )) {
				if ($key = array_search ( $lid, $oldDetails ) !== false) {
					unset ( $oldDetails [$key] );
				}
			}
			if (in_array ( $this->checkLogin ( 'U' ), $followersArr )) {
				if ($key = array_search ( $this->checkLogin ( 'U' ), $followersArr ) !== false) {
					unset ( $followersArr [$key] );
				}
				$followersCount --;
			}
			$this->product_model->update_details ( USERS, array (
					'following_user_lists' => implode ( ',', $oldDetails )
			), array (
					'id' => $this->checkLogin ( 'U' )
			) );
			$this->product_model->update_details ( LISTS_DETAILS, array (
					'followers' => implode ( ',', $followersArr ),
					'followers_count' => $followersCount
			), array (
					'id' => $lid
			) );
			$returnStr ['status_code'] = 1;
		}
		echo json_encode ( $returnStr );
	}
	public function edit_user_lists() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( 'login' );
		} else {
			$lid = $this->uri->segment ( '4', '0' );
			$uname = $this->uri->segment ( '2', '0' );
			if ($uname != $this->data ['userDetails']->row ()->user_name) {
				show_404 ();
			} else {
				$this->data ['user_profile_details'] = $this->user_model->get_all_details ( USERS, array (
						'user_name' => $uname
				) );
				$this->data ['list_details'] = $list_details = $this->product_model->get_all_details ( LISTS_DETAILS, array (
						'id' => $lid,
						'user_id' => $this->data ['user_profile_details']->row ()->id
				) );
				if ($this->data ['list_details']->num_rows () == 0) {
					show_404 ();
				} else {
					$this->data ['list_category_details'] = $this->user_model->get_all_details ( CATEGORY, array (
							'id' => $this->data ['list_details']->row ()->category_id
					) );
					$this->data ['heading'] = 'Edit List';
					$this->load->view ( 'site/user/edit_user_list', $this->data );
				}
			}
		}
	}
	public function edit_user_list_details() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( 'login' );
		} else {
			$lid = $this->input->post ( 'lid' );
			$uid = $this->input->post ( 'uid' );
			if ($uid != $this->checkLogin ( 'U' )) {
				show_404 ();
			} else {
				$list_title = $this->input->post ( 'setting-title' );
				$catID = $this->input->post ( 'category' );
				$duplicateCheck = $this->user_model->get_all_details ( LISTS_DETAILS, array (
						'user_id' => $uid,
						'id !=' => $lid,
						'name' => $list_title
				) );
				if ($duplicateCheck->num_rows () > 0) {
					$this->setErrorMessage ( 'error', 'List title already exists' );
					echo '<script>window.history.go(-1);</script>';
				} else {
					if ($catID == '') {
						$catID = 0;
					}
					$this->user_model->update_details ( LISTS_DETAILS, array (
							'name' => $list_title,
							'category_id' => $catID
					), array (
							'id' => $lid,
							'user_id' => $uid
					) );
					$this->setErrorMessage ( 'success', 'List updated successfully' );
					echo '<script>window.history.go(-1);</script>';
				}
			}
		}
	}
	public function delete_user_list() {
		$returnStr ['status_code'] = 0;
		if ($this->checkLogin ( 'U' ) == '') {
			$returnStr ['message'] = 'Login required';
		} else {
			$lid = $this->input->post ( 'lid' );
			$uid = $this->input->post ( 'uid' );
			if ($uid != $this->checkLogin ( 'U' )) {
				$returnStr ['message'] = 'You can\'t delete other\'s list';
			} else {
				$list_details = $this->user_model->get_all_details ( LISTS_DETAILS, array (
						'id' => $lid,
						'user_id' => $uid
				) );
				if ($list_details->num_rows () == 1) {
					$followers_id = $list_details->row ()->followers;
					if ($followers_id != '') {
						$searchArr = array_filter ( explode ( ',', $followers_id ) );
						$fieldsArr = array (
								'following_user_lists',
								'id'
						);
						$followersArr = $this->user_model->get_fields_from_many ( USERS, $fieldsArr, 'id', $searchArr );
						if ($followersArr->num_rows () > 0) {
							foreach ( $followersArr->result () as $followersRow ) {
								$listArr = array_filter ( explode ( ',', $followersRow->following_user_lists ) );
								if (in_array ( $lid, $listArr )) {
									if (($key = array_search ( $lid, $listArr )) != false) {
										unset ( $listArr [$key] );
										$this->user_model->update_details ( USERS, array (
												'following_user_lists' => implode ( ',', $listArr )
										), array (
												'id' => $followersRow->id
										) );
									}
								}
							}
						}
					}
					$this->user_model->commonDelete ( LISTS_DETAILS, array (
							'id' => $lid,
							'user_id' => $this->checkLogin ( 'U' )
					) );
					$listCount = $this->data ['userDetails']->row ()->lists;
					$listCount --;
					if ($listCount == '' || $listCount < 0) {
						$listCount = 0;
					}
					$this->user_model->update_details ( USERS, array (
							'lists' => $listCount
					), array (
							'id' => $this->checkLogin ( 'U' )
					) );
					$returnStr ['url'] = base_url () . 'user/' . $this->data ['userDetails']->row ()->user_name . '/lists';
					$this->setErrorMessage ( 'success', 'List deleted successfully' );
					$returnStr ['status_code'] = 1;
				} else {
					$returnStr ['message'] = 'List not available';
				}
			}
		}
		echo json_encode ( $returnStr );
	}
	public function update_reservation_requirements() {
		if ($this->checkLogin ( 'U' ) == '')
			redirect ( 'login' );
		else {
			if ($this->input->post ( 'verify_id' ))
				$verify_id = 'yes';
			else
				$verify_id = 'no';

			if ($this->input->post ( 'verify_phone' ))
				$verify_phone = 'yes';
			else
				$verify_phone = 'no';

			if ($this->input->post ( 'profilePicture' ))
				$profilePicture = 'yes';
			else
				$profilePicture = 'no';

			if ($this->input->post ( 'tripDesc' ))
				$tripDesc = 'yes';
			else
				$tripDesc = 'no';
				// echo $verify_id;die;

			$this->user_model->commonDelete ( REQUIREMENTS, array (
					'user_id' => $this->input->post ( 'user_id' )
			) );

			$data = array (
				'user_id' => $this->input->post ( 'user_id' ),
				'id_verified' => $verify_id,
				'ph_verified' => $verify_phone,
				'profile_picture' => $profilePicture,
				'trip_description' => $tripDesc
			);
			$this->user_model->simple_insert ( REQUIREMENTS, $data );
			$this->setErrorMessage ( 'success', 'Reservation requirements updated successfully' );
			echo "<script>window.history.go(-1);</script>";
			exit ();
		}
	}
	public function image_crop() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( 'login' );
		} else {
			$uid = $this->uri->segment ( 2, 0 );
			if ($uid != $this->checkLogin ( 'U' )) {
				show_404 ();
			} else {
				$this->data ['heading'] = 'Cropping Image';
				$this->load->view ( 'site/user/crop_image', $this->data );
			}
		}
	}
	public function image_crop_process() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( 'login' );
		} else {
			$targ_w = $targ_h = 240;
			$jpeg_quality = 90;

			$src = 'images/users/' . $this->data ['userDetails']->row ()->image;
			$ext = substr ( $src, strpos ( $src, '.' ) + 1 );
			if ($ext == 'png') {
				$jpgImg = imagecreatefrompng ( $src );
				imagejpeg ( $jpgImg, $src, 90 );
			}
			$img_r = imagecreatefromjpeg ( $src );
			$dst_r = ImageCreateTrueColor ( $targ_w, $targ_h );

			// list($width, $height) = getimagesize($src);

			imagecopyresampled ( $dst_r, $img_r, 0, 0, $_POST ['x1'], $_POST ['y1'], $targ_w, $targ_h, $_POST ['w'], $_POST ['h'] );
			imagejpeg ( $dst_r, 'images/users/' . $this->data ['userDetails']->row ()->image );
			$this->setErrorMessage ( 'success', 'Profile photo changed successfully' );
			redirect ( 'user/' . $this->data ['userDetails']->row ()->user_name );
			exit ();
		}
	}
	public function send_noty_mail($followUserDetails = array()) {
		if (count ( $followUserDetails ) > 0) {
			$emailNoty = explode ( ',', $followUserDetails [0] ['email_notifications'] );
			if (in_array ( 'following', $emailNoty )) {
				$newsid = '7';
				$template_values = $this->product_model->get_newsletter_template_details ( $newsid );
				$adminnewstemplateArr = array (
						'logo' => $this->data ['logo'],
						'meta_title' => $this->config->item ( 'meta_title' ),
						'full_name' => $followUserDetails [0] ['full_name'],
						'cfull_name' => $this->data ['userDetails']->row ()->full_name,
						'user_name' => $this->data ['userDetails']->row ()->user_name
				);
				extract ( $adminnewstemplateArr );
				$subject = 'From: ' . $this->config->item ( 'email_title' ) . ' - ' . $template_values ['news_subject'];
				$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>' . $template_values ['news_subject'] . '</title><body>';
				include ('./newsletter/registeration' . $newsid . '.php');

				$message .= '</body>
			</html>';

			
				$sender_email = $this->data ['siteContactMail'];
				$sender_name = $this->data ['siteTitle'];

				// add inbox from mail
				$this->product_model->simple_insert ( INBOX, array (
						'sender_id' => $sender_email,
						'user_id' => $followUserDetails [0] ['email'],
						'mailsubject' => $subject,
						'description' => stripslashes ( $message )
				) );

				$email_values = array (
						'mail_type' => 'html',
						'from_mail_id' => $sender_email,
						'mail_name' => $sender_name,
						'to_mail_id' => $followUserDetails [0] ['email'],
						'subject_message' => $subject,
						'body_messages' => $message
				);
				$email_send_to_common = $this->product_model->common_email_send ( $email_values );
			}
		}
	}
	public function send_noty_mails($followUserDetails = array()) {
		if (count ( $followUserDetails ) > 0) {
			$emailNoty = explode ( ',', $followUserDetails->email_notifications );
			if (in_array ( 'following', $emailNoty )) {

				$newsid = '9';
				$template_values = $this->product_model->get_newsletter_template_details ( $newsid );
				$adminnewstemplateArr = array (
						'logo' => $this->data ['logo'],
						'meta_title' => $this->config->item ( 'meta_title' ),
						'full_name' => $followUserDetails [0] ['full_name'],
						'cfull_name' => $this->data ['userDetails']->row ()->full_name,
						'user_name' => $this->data ['userDetails']->row ()->user_name
				);
				extract ( $adminnewstemplateArr );
				$subject = 'From: ' . $this->config->item ( 'email_title' ) . ' - ' . $template_values ['news_subject'];
				$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>' . $template_values ['news_subject'] . '</title><body>';
				include ('./newsletter/registeration' . $newsid . '.php');

				$message .= '</body>
			</html>';

				$sender_email = $this->data ['siteContactMail'];
				$sender_name = $this->data ['siteTitle'];
				
				// add inbox from mail
				$this->product_model->simple_insert ( INBOX, array (
						'sender_id' => $sender_email,
						'user_id' => $followUserDetails->email,
						'mailsubject' => $subject,
						'description' => stripslashes ( $message )
				) );

				$email_values = array (
						'mail_type' => 'html',
						'from_mail_id' => $sender_email,
						'mail_name' => $sender_name,
						'to_mail_id' => $followUserDetails->email,
						'subject_message' => $subject,
						'body_messages' => $message
				);
				$email_send_to_common = $this->product_model->common_email_send ( $email_values );
			}
		}
	}

	public function post_order_comment() {
		if ($this->checkLogin ( 'U' ) != '') {
			$this->user_model->commonInsertUpdate ( REVIEW_COMMENTS, 'insert', array (), array (), '' );
		}
	}
	public function change_received_status() {
		if ($this->checkLogin ( 'U' ) != '') {
			$status = $this->input->post ( 'status' );
			$rid = $this->input->post ( 'rid' );
			$this->user_model->update_details ( PAYMENT, array (
					'received_status' => $status
			), array (
					'id' => $rid
			) );
		}
	}
	public function EditSiteUserLoginDetails() {
		$excludeArr = array (
				'signin',
				'first_name',
				'last_name'
		);
		$condition = array (
				'id' => $this->checkLogin ( 'U' )
		);
		$dataArr = array (
				'firstname' => $this->input->post ( 'first_name' ),
				'lastname' => $this->input->post ( 'last_name' )
		);

		$filePRoductUploadData = array ();
		$setPriority = 0;
		$this->user_model->commonInsertUpdate ( USERS, 'update', $excludeArr, $dataArr, $condition );
		$this->setErrorMessage ( 'success', 'User details updated successfully' );
		redirect ( base_url () . 'users/edit/' . $this->checkLogin ( 'U' ) );
	}
	
	function getDatesFromRange($start, $end) {
		$dates = array (
				$start
		);
		while ( end ( $dates ) < $end ) {
			$dates [] = date ( 'Y-m-d', strtotime ( end ( $dates ) . ' +1 day' ) );
		}
		return $dates;
	}

	/**
	 * ****************Invite Friends*******************
	 */
	public function invite_friends() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( 'login' );
		} else {
			$this->data ['heading'] = 'Invite Friends';
			$this->load->view ( 'site/user/invite_friends', $this->data );
		}
	}
	
	public function app_twitter() {
		$returnStr ['status_code'] = 1;
		$returnStr ['url'] = base_url () . 'twtest/get_twitter_user';
		$returnStr ['message'] = '';
		echo json_encode ( $returnStr );
	}
	
	public function find_friends_twitter() {
		$returnStr ['status_code'] = 1;
		$returnStr ['url'] = base_url () . 'twtest/invite_friends';
		$returnStr ['message'] = '';
		echo json_encode ( $returnStr );
	}
	
	public function find_friends_gmail_19() {
		$returnStr ['status_code'] = 1;
		error_reporting ( 0 );
		include_once './invite_friends/GmailOath.php';
		include_once './invite_friends/Config.php';
		$oauth = new GmailOath ( $consumer_key, $consumer_secret, $argarray, $debug, $callback );
		$getcontact = new GmailGetContacts ();
		$access_token = $getcontact->get_request_token ( $oauth, false, true, true );
		$this->session->set_userdata ( 'oauth_token', $access_token ['oauth_token'] );
		$this->session->set_userdata ( 'oauth_token_secret', $access_token ['oauth_token_secret'] );
		$returnStr ['url'] = "https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=" . $oauth->rfc3986_decode ( $access_token ['oauth_token'] );
		$returnStr ['message'] = '';
		echo json_encode ( $returnStr );
	}
	
	public function find_friends_gmail_callback() {
		include_once './invite_friends/GmailOath.php';
		include_once './invite_friends/Config.php';
		error_reporting ( 0 );
		$oauth = new GmailOath ( $consumer_key, $consumer_secret, $argarray, $debug, $callback );
		$getcontact_access = new GmailGetContacts ();

		$request_token = $oauth->rfc3986_decode ( $this->input->get ( 'oauth_token' ) );
		$request_token_secret = $oauth->rfc3986_decode ( $this->session->userdata ( 'oauth_token_secret' ) );
		$oauth_verifier = $oauth->rfc3986_decode ( $this->input->get ( 'oauth_verifier' ) );

		$contact_access = $getcontact_access->get_access_token ( $oauth, $request_token, $request_token_secret, $oauth_verifier, false, true, true );
		$access_token = $oauth->rfc3986_decode ( $contact_access ['oauth_token'] );
		$access_token_secret = $oauth->rfc3986_decode ( $contact_access ['oauth_token_secret'] );
		$contacts = $getcontact_access->GetContacts ( $oauth, $access_token, $access_token_secret, false, true, $emails_count );

		$count = 0;
		foreach ( $contacts as $k => $a ) {
			$final = end ( $contacts [$k] );
			foreach ( $final as $email ) {
				$this->send_invite_mail ( $email ["address"] );
				$count ++;
			}
		}
		if ($count > 0) {
			echo "
			<script>
				alert('Invitations sent successfully');
				window.close();
			</script>
			";
		} else {
			echo "
			<script>
				window.close();
			</script>
			";
		}
	}
	public function send_invite_mail($to = '') {
		if ($to != '') {
			$newsid = '16';
			$template_values = $this->product_model->get_newsletter_template_details ( $newsid );
			$adminnewstemplateArr = array (
					'logo' => $this->data ['logo'],
					'siteTitle' => $this->data ['siteTitle'],
					'meta_title' => $this->config->item ( 'meta_title' ),
					'full_name' => $this->data ['userDetails']->row ()->full_name,
					'user_name' => $this->data ['userDetails']->row ()->user_name
			);
			extract ( $adminnewstemplateArr );
			$subject = $template_values ['news_subject'];
			$message .= '<!DOCTYPE HTML>
					<html>
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<meta name="viewport" content="width=device-width"/>
					<title>' . $template_values ['news_subject'] . '</title><body>';
			include ('./newsletter/registeration' . $newsid . '.php');

			$message .= '</body>
					</html>';
			$sender_email = $this->data ['siteContactMail'];
			$sender_name = $this->data ['siteTitle'];
			
			$email_values = array (
				'mail_type' => 'html',
				'from_mail_id' => $sender_email,
				'mail_name' => $sender_name,
				'to_mail_id' => $to,
				'subject_message' => $subject,
				'body_messages' => $message
			);
			$email_send_to_common = $this->product_model->common_email_send ( $email_values );
		}
	}
	
	public function verification() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () . 'login' );
		}
		if ($this->uri->segment ( 2 ) == 'send-mail') {
			$this->send_confirm_mail ( $this->data ['userDetails'] );
			$this->setErrorMessage ( 'success', 'Verification request has been sent. We will get contact with you shortly.' );
			redirect ( 'verification' );
		}
		if ($this->uri->segment ( 2 ) == 'verify-mail') {
			$this->send_verify_mail ( $this->data ['userDetails'] );
			$this->setErrorMessage ( 'success', 'Verification request has been sent. We will get contact with you shortly.' );
			redirect ( 'verification' );
		}
		$userid =  $this->session->userdata('fc_session_user_id');
		$condition = array('id'=>$userid);
		$this->data['user_Details'] = $this->user_model->get_all_details(USERS,$condition);
		$country_query = 'SELECT id,name FROM ' . LOCATIONS . ' WHERE status="Active" order by name';
		$this->data ['active_countries'] = $this->user_model->ExecuteQuery ( $country_query );
		$this->data ['heading'] = 'Trust and Verification';
		$this->data ['UserDetail'] = $this->data ['userDetails'];
		$this->load->view ( 'site/user/email_verification', $this->data );
	}
	
	public function change_profile_photo_redirect() {
		redirect('profile-photo');
	}
	public function change_profile_photo() {
		if($this->checkLogin('U') !='') {
			if($_FILES['upload-file']['name']!=""){
				$filename = getimagesize($_FILES['upload-file']['tmp_name']);
				if($filename[0] >= 500 && $filename[1]>=350)
				{
					$config ['overwrite'] = FALSE;
					$config ['remove_spaces'] = TRUE;
					$config ['allowed_types'] = 'jpg|jpeg|gif|png';
					$config['min_width'] = '500';
					$config['min_height'] = '350';
					$config ['upload_path'] = './images/users';
					$this->load->library ( 'upload', $config );
						if ($this->upload->do_upload ( 'upload-file' )) {
							$config2['image_library'] = 'gd2';
							$config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config2['new_image'] = './images/users';
							$config2['maintain_ratio'] = TRUE;
							$config2['width'] = 200;
							$config2['height'] = 200;
							$this->load->library('image_lib',$config2); 
							$this->image_lib->resize();
							$imgDetailsd = $this->upload->data ();
							$imgDetails = array (
								'image' => $imgDetailsd ['file_name'],
								'loginUserType' => ''
							);
						} else {
							$imgDetails = array ();
							$upload_errors = $this->upload->display_errors('', '');
						}
						$condition = array (
							'id' => $this->checkLogin ( 'U' )
						);
						$dataArrMrg = $imgDetails;

							$this->user_model->update_details (USERS, $dataArrMrg, $condition );
							$targetPath = "images/users/".$imgDetailsd ['file_name'];

							echo '<img src="'.$targetPath.'">'; die;
					
				} else {
				        echo 'failed'; die;
					//echo "<script>swal('Image height or width size limit is below');</script>";
				}
			}
			$this->data ['heading'] = 'Photo';
			$this->data ['userDetails'] = $this->data ['userDetails'];
			$this->load->view ( 'site/user/photo_video', $this->data );
		} else {
			redirect();
		}
	}

	public function account_update() {
		$excludeArr = array (
			'submit',
			'hid',
			'expid',
			'uid',
			'payout_email'
		);
		$condition = array (
			'id' => $this->input->post ( 'hid' )
		);
		$dataArr = array (
			'accname' => $this->input->post ( 'accname' ),
			'accno' => $this->input->post ( 'accno' ),
			'bankname' => $this->input->post ( 'bankname' ),
			'paypal_email' => $this->input->post ( 'paypal_email' )
		);
		$this->user_model->commonInsertUpdate ( USERS, 'update', $excludeArr, $dataArr, $condition );
		$this->user_model->commonInsertUpdate (USERS, 'update', $excludeArr, $dataArr, $condition );
		$this->account_changes($this->input->post ( 'hid' ));
		redirect ( base_url () . 'account-payout' );
	}

	public function deactive_user() {
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = time ();
		$newdata = array (
			'last_logout_date' => mdate ( $datestring, $time )
		);
		$condition = array (
			'id' => $this->checkLogin ( 'U' )
		);
		$this->user_model->update_details ( USERS, $newdata, $condition );
		$userdata = array (
			'fc_session_user_id' => '',
			'session_user_name' => '',
			'session_user_email' => '',
			'fc_session_temp_id' => ''
		);
		$this->session->unset_userdata ( $userdata );
		@session_start ();
		unset ( $_SESSION ['token'] );
		$twitter_return_values = array (
			'tw_status' => '',
			'tw_access_token' => ''
		);
		$this->session->unset_userdata ( $twitter_return_values );
		$this->setErrorMessage ( 'success', 'Your account has been Deactived successfully.' );
		redirect ( base_url () );
	}

	public function get_mobile_code(){
		$country_id=$this->input->post('country_id');
		$country_mobile_code_query='SELECT country_mobile_code FROM '.LOCATIONS.' WHERE id='.$country_id;
		$country_mobile_code=$this->product_model->ExecuteQuery($country_mobile_code_query)->row_array();
		echo json_encode($country_mobile_code);
	}

	public function booking_confirm() {
		$bookingDetails = $this->user_model->get_all_details(RENTALENQUIRY,array('Bookingno'=>$this->input->post('Bookingno')));
		$message = strip_tags($this->input->post('message'));
		$dataArr = array(
			'productId' => $bookingDetails->row()->prd_id, 
			'bookingNo' => $bookingDetails->row()->Bookingno, 
			'senderId' => $bookingDetails->row()->user_id, 
			'receiverId' => $bookingDetails->row()->renter_id, 
			'subject' => 'Booking Request : '.$bookingDetails->row()->Bookingno,
			'message' => $message
		);
		$this->user_model->simple_insert(MED_MESSAGE, $dataArr);
		$this->user_model->update_details( RENTALENQUIRY, array ('booking_status' => 'Pending', 'caltophone' =>$this->input->post('phone_no')), array ('user_id' => $this->checkLogin ( 'U' ),'id' => $this->session->userdata ( 'EnquiryId' ) ) );
		$this->emailhostreservationreq($this->session->userdata ( 'EnquiryId' ));
		$this->traveller_reservation($this->session->userdata ( 'EnquiryId' ));
		$user_id =$this->uri->segment(4);
		$guestDetails = $this->product_model->get_all_details(USERS,array('id'=>$bookingDetails->row()->user_id));			
		$hostDetails = $this->product_model->get_all_details(USERS,array('id'=>$bookingDetails->row()->renter_id));
		$product_details = $this->product_model->get_all_details(PRODUCT,array('id'=>$bookingDetails->row()->prd_id));
		$gcmRegID  = $hostDetails->row()->mobile_key;
		$ios_key  = $hostDetails->row()->ios_key;
		$pushMessage = 'Your property '.$product_details->row()->product_title.' was booked by '.$guestDetails->row()->user_name;	
		$message1 = $pushMessage;
		if (isset($gcmRegID) && isset($pushMessage)) {		
			$gcmRegIds = array($gcmRegID);
			$message = array("m" => $pushMessage, "k"=>'Your Reservation');	
			$pushStatus = $this->sendPushNotificationToAndroid($gcmRegIds, $message);
		}
		require_once('twilio/Services/Twilio.php');
		if($hostDetails->row()->phone_no != '' && $hostDetails->row()->country_code != '' && $hostDetails->row()->ph_verified == 'Yes' && $hostDetails->row()->mobile_notification == 'Yes'){
			$to = $hostDetails->row()->country_code.$hostDetails->row()->phone_no;
			$senderName = $guestDetails->row()->user_name;
			$receiverName = $hostDetails->row()->user_name;
			$message = "Hi ".$receiverName.", You've received booking request(".$bookingDetails->row()->Bookingno.") from ".$senderName." for the property ".$product_details->row()->product_title." - from ".$this->config->item ( 'meta_title' );
			
			$account_sid = $this->config->item('twilio_account_sid'); 
			$auth_token = $this->config->item('twilio_account_token');
			$from=$this->config->item('twilio_phone_number');
			$client = new Services_Twilio($account_sid, $auth_token); 
			$client->account->messages->create(array( 
				'To' => $to,	
				'From' =>$from, 
				'Body' => $message,
			)); 
		}
		$this->setErrorMessage ( 'success', 'Congratulation on your booking!! The host will reply you soon.' );
		redirect('trips/upcoming');
	}

	public function confirmbooking() {
		$id = $this->uri->segment(4);
		$this->data['datavalues'] = $this->user_model->get_all_details(RENTALENQUIRY,array('id'=>$id));
		$this->data['datavalues'] = $this->user_model->get_all_details(RENTALENQUIRY,array('id'=>$id));
		$productDet = $this->user_model->get_all_details(PRODUCT,array('id'=>$this->data['datavalues']->row()->prd_id));
		$userDet = $this->user_model->get_all_details(USERS,array('id'=>$this->data['datavalues']->row()->renter_id));
		if($productDet->row()->status=='UnPublish' || $userDet->row()->status=='Inactive' || $userDet->num_rows()==0 ) {
			$this->setErrorMessage ( 'error', 'Your booked property was Unavailable.Please Contact Admin' );
			redirect ('trips/upcoming');
		}
		$arrival = $this->data['datavalues']->row()->checkin;
		$depature = $this->data['datavalues']->row()->checkout;
		$Bookingno = $this->data['datavalues']->row()->Bookingno;
		$productId = $this->data['datavalues']->row()->prd_id;
		$dates = $this->getDatesFromRange($arrival, $depature);
		foreach($dates as $date){
			$all_date .= $date.',';
		}
		$all_dates = rtrim($all_date,',');
		$full_date = explode(',',$all_dates,2);
		$this->db->select('*');
		$this->db->from(CALENDARBOOKING);
		$this->db->where_in('the_date',$full_date);
		$this->db->group_by('the_date');
		$this->db->where('PropId',$productId);
		$booked_count=$this->db->get();
		if($booked_count->num_rows() > 1){
			$this->setErrorMessage ( 'error', 'This date is already booked.' );
			redirect ('trips/upcoming');
		} 
		if($this->data['datavalues']->row()->booking_status == 'Booked'){
			redirect(base_url().'trips/upcoming');
		}
		$user = $this->data['datavalues']->row_array();
		$refno = $this->data['datavalues']->row()->Bookingno;
		$Rental_id = $this->data['datavalues']->row()->prd_id;
		$this->data['pay'] = $this->user_model->get_all_details(PAYMENT,array('user_id'=>$user['user_id']));
		$this->data['userDetails'] = $this->user_model->get_all_details (USERS, array ('id' => $user['user_id']) );
		$this->data ['productList'] = $this->product_model->view_product_details_booking ( ' where p.id="' . $Rental_id . '"  group by p.id order by p.created desc limit 0,1' );
		$this->data ['countryList'] = $this->product_model->get_country_list ();
		$this->data ['BookingUserDetails'] = $this->product_model->view_user_details_booking ( ' where p.id="' . $Rental_id . '" and rq.id="' . $this->session->userdata ( 'EnquiryId' ) . '" group by p.id order by p.created desc limit 0,1' );
		$service_tax_query='SELECT * FROM '.COMMISSION.' WHERE commission_type="Guest Booking" AND status="Active"';
        $this->data['service_tax']=$this->product_model->ExecuteQuery($service_tax_query);
		if ($this->data ['productList']->row ()->meta_title != '') {
			$this->data ['meta_title'] = $this->data ['productList']->row ()->meta_title;
		}
		if ($this->data ['productList']->row ()->meta_keyword != '') {
			$this->data ['meta_keyword'] = $this->data ['productList']->row ()->meta_keyword;
		}
		if ($this->data ['productList']->row ()->meta_description != '') {
			$this->data ['meta_description'] = $this->data ['productList']->row ()->meta_description;
		}
		$this->data['paypal_status'] = $this->product_model->get_all_details(PAYMENT_GATEWAY,array('gateway_name'=>'Paypal IPN'));
		$this->data['creditCard_status'] = $this->product_model->get_all_details(PAYMENT_GATEWAY,array('gateway_name'=>'Credit Card'));

		$tax_query = 'SELECT * FROM ' . COMMISSION . ' WHERE id=4';

		$this->data ['tax'] = $this->product_model->ExecuteQuery ( $tax_query );
		$uniid = time()."-".$refno;
		$this->data['RefNo'] = $uniid;
		$source ="DbQhpCuQpPM07244".$uniid."100MYR";
		$val = sha1($source);
		$rval = $this->hex2bin($val);
		$this->data['signature']=  base64_encode($rval);
		$this->load->view ( 'site/rentals/confirmpayment', $this->data );
	}

	function hex2bin( $str ) {
        $sbin = "";
        $len = strlen( $str );
        for ( $i = 0; $i < $len; $i += 2 ) {
            $sbin .= pack( "H*", substr( $str, $i, 2 ) );
        }
        return $sbin;
    }

	
	public function invoice() {
		$id = $this->uri->segment(4);
		$Invoicetmp = $this->product_model->get_all_details(RENTALENQUIRY,array('Bookingno'=>$id));
		$eId = $Invoicetmp->row()->id;
		$transactionid = $this->product_model->get_all_details(PAYMENT,array('EnquiryId'=>$eId));
		//echo "<pre>";print_r($Invoicetmp->result());
		//echo "<pre>";print_r($transactionid->result());die;
		
		 $coupon_code = $transactionid->row()->coupon_code;
		$coupon_details = $this->product_model->get_all_details(COUPONCARDS,array('code'=>$coupon_code));
		//echo "<pre>";print_r($coupon_details->result());die;
		$admin_email = $this->product_model->get_all_details(ADMIN,array())->row()->email;
		$transid = $Invoicetmp->row()->Bookingno;
		$productvalue = $this->product_model->get_all_details(PRODUCT,array('id'=>$Invoicetmp->row()->prd_id));
		$productaddress = $this->product_model->get_all_details(PRODUCT_ADDRESS_NEW,array('productId'=>$Invoicetmp->row()->prd_id));
		$product_id = $Invoicetmp->row()->prd_id;
		$checkindate =date('d-M-Y',strtotime($Invoicetmp->row()->checkin));
		$checkoutdate =date('d-M-Y',strtotime($Invoicetmp->row()->checkout));
		
		$servicefee = $Invoicetmp->row()->pro_serviceFee;

		$pro_totalAmt = str_replace(',', '', $Invoicetmp->row()->pro_totalAmt);
		$pro_serviceFee = str_replace(',', '', $Invoicetmp->row()->pro_serviceFee);
		$pro_discount_amount = str_replace(',', '', $Invoicetmp->row()->pro_discount_amount);
		
		$totalAmtWithoutService = $pro_totalAmt-$pro_serviceFee;
		
		$totalAmt = $Invoicetmp->row()->pro_totalAmt;
		//vasu
		/* echo "<pre>"; print_r( $transactionid->result());
		echo $transactionid->row()->is_coupon_used;  */
		if($transactionid->row()->is_coupon_used=='Yes')
		{
			$totalAmtWithoutService = $pro_totalAmt - $pro_serviceFee;
			$totalAmtWithoutService = number_format($totalAmtWithoutService, 2);
			$coupon_discount = $pro_totalAmt - $pro_discount_amount;
			$totalAmt = $Invoicetmp->row()->pro_discount_amount;
			//$totalAmt =  $total - $coupon_discount ;
		}

		$to  = '';//$this->data['bookingmail']->row()->email; // note the comma

		$service = $this->user_model->get_all_details(COMMISSION,array('id'=>2, 'status'=>'Active'));
      	$Night = ($Invoicetmp->row()->numofdates == 1)?"Night":"Nights";
		$Guest = ($Invoicetmp->row()->NoofGuest==1)?"Guest":"Guests";
		$houserule = ($productvalue->row()->house_rules!='')?$productvalue->row()->house_rules:'None';
		$this->data['message'] = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Invoice</title>
		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:site" content="@ZoplayCom" />
		<meta name="twitter:creator" content="@ZoplayCom"/>
		<meta name="twitter:widgets:csp" content="on">
		<meta property="og:title" content='.$productvalue->row()->product_title.' />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="'.base_url().$id.'" />
		<meta property="og:address" content='.$productaddress->row()->address.' />
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#4BBEFF" data-bgcolor="body-bg-dark" data-module="1" class="ui-sortable-handle currentTable">
		<tbody><tr>
		<td>
		<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth" style="background-color:#ffffff;" data-bgcolor="light-gray-bg">
		<tbody><tr>
		<td height="30" bgcolor="#4BBEFF" >&nbsp;</td>
		</tr>
		<tr>
		<td align="center">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tbody><tr style="padding: 10px 10px 0px 10px; float: left">
		<td align="center" valign="top">
		<table width="650" border="0" cellpadding="5" cellspacing="1" >
		<tbody style="font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px;">
		<tr>
		<th width="70" bgcolor="#4BBEFF"style="color:#fff; font-size:15px;">Receipt</th>
		<th width="75" ></th>
		<th width="75"></th>
		<th width="75"></th>
		<th align="right" width="75" style="color:#f3402e; text-align:right"><a onClick="window.print()" TARGET="_blank" style="cursor: pointer; cursor: hand;text-decoration:underline;">Print Page</a></th>
		</tr>
		</tbody></table>
		</td>
		</tr>
		</tr>
		<tr><td align="left" style="color:#4c4c4c;font-size:13px;font-family:Open Sans, Arial, Helvetica, sans-serif;margin:10px; padding: 10px">Booking No : '.$transid.'</td></tr>
		<tr><td align="left" style="color:#4c4c4c;font-size:13px;font-family:Open Sans, Arial, Helvetica, sans-serif;margin:10px; padding: 10px">Property Name : '.$productvalue->row()->product_title.'</td></tr>
		<tr><td align="left" style="color:#4c4c4c;font-size:13px;font-family:Open Sans, Arial, Helvetica, sans-serif;margin:10px; padding: 10px">Address : '.$productaddress->row()->address.'</td></tr>
		<tr>
		<td style="border-top:1px solid #808080" bgcolor="#fff">&nbsp;</td>
		</tr>
		<tr>
		<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tbody><tr style="padding: 10px; float: left">
		<td align="center" valign="top">
		<table width="650" border="0" cellpadding="5" cellspacing="1" >
		<tbody style="font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px;" ><tr>
		<th width="75" bgcolor="#EFEFEF">Check In</th>
		<th width="5"></th>
		<th width="75" bgcolor="#EFEFEF">Check Out</th>
		<th width="75" ></th>
		<th width="75" bgcolor="#EFEFEF">'.$Night.'</th>
		<th width="75" bgcolor="#EFEFEF">'.$Guest.'</th>
		</tr>
		<tr align="center">
		<td >'.$checkindate.'</td>
		<td ></td>
		<td >'.$checkoutdate.'</td>
		<td ></td>
		<td >'.$Invoicetmp->row()->numofdates.'</td>
		<td >'.$Invoicetmp->row()->NoofGuest.'</td>
		</tr>
		</tbody></table>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		<tr style="pointer-events:none;">
		<td align="center" valign="top" style="color:#000; font-weight: 700; font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px;" data-size="body-text" data-min="10" data-max="25" data-color="footer-text">
		<img id="map-image" border="0" alt="'.$productaddress->row()->address.'" src="https://maps.googleapis.com/maps/api/staticmap?center='.$productaddress->row()->address.'&zoom=13&size=600x300&maptype=roadmap&sensor=false&format=png&visual_refresh=true&markers=size:mid%7Ccolor:red%7C'. $productaddress->row()->address.'">
		</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		</tr>
		<tr>
		<tr>
		<td align="center" >
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" style="padding:0px 10px;">
		<tbody><tr>
		<td align="left" width="300px" valign="top" style="color:#4f595b; font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px; line-height:20px;" data-size="body-text" data-min="10" data-max="25" data-color="footer-text">
		<h4 style="float: left; width:100%;">Cancellation Policy  -    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.ucfirst($productvalue->row()->cancellation_policy).'</h4>For More details of the cancellation policy, please refer <a href="'.base_url().'pages/cancellation-policy" target="_blank">cancellation policy</a>.
		<td>
		<td align="left" width="300px"valign="top" style="color:#4f595b; text-align:justify; font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px;line-height:20px;" data-size="body-text" data-min="10" data-max="25" data-color="footer-text">
		<h4 style="float: left; width:100%;">House Rules</h4>
		'.$houserule.'</td>
		</tr>
		<tr>
		<td align="left" width="300px" valign="top" style="color:#4f595b; font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px; line-height:20px;" data-size="body-text" data-min="10" data-max="25" data-color="footer-text">
		<h4 style="float: left; width:100%; margin: 10px 0px;">Billing</h4>
		<table style="width:100%; font-size:13px;">
		<tr>
		<td style="border-bottom: 1px solid #bbb;">Booked for '.$Invoicetmp->row()->numofdates.'  &nbsp;'.$Night.'</td>
		<td style="border-bottom: 1px solid #bbb;"></td>
		<td style="border-bottom: 1px solid #bbb; padding: 5px 0px;">'.$this->data['admin_currency_symbol'] .' '.$totalAmtWithoutService.'</td>
		</tr>';
		if($servicefee >0.00){
			$this->data['message'].= '<tr>
			<td style="border-bottom: 1px solid #bbb;">Service Fee</td>
			<td style="border-bottom: 1px solid #bbb;"></td>
			<td style="border-bottom: 1px solid #bbb; padding: 5px 0px;">'.$this->data['admin_currency_symbol'] .' '.$servicefee.'</td>
			</tr>
			<tr>';
		}
		if($transactionid->row()->is_coupon_used=='Yes') {
			$this->data['message'].= '<tr>
			<td style="border-bottom: 1px solid #bbb;">Discount ('.$coupon_code.')</td>
			<td style="border-bottom: 1px solid #bbb;"></td>
			<td style="border-bottom: 1px solid #bbb; padding: 5px 0px;">'.$this->data['admin_currency_symbol'] .' '.number_format($coupon_discount, 2).' (-)</td>
			</tr>
			<tr>'; 
		}
		$this->data['message'].='<td style="border-bottom: 1px solid #bbb;  padding: 10px 0px;">Total</td>
		<td style="border-bottom: 1px solid #bbb;padding: 10px 0px;"></td>
		<td style="border-bottom: 1px solid #bbb;padding: 10px 0px;">'.$this->data['admin_currency_symbol'] .' '.$totalAmt.'</td>
		</tr>
		</table>
		<td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		</tr>
		<tr>
		<td>&nbsp;</td>
		</tr>
		<tr>
		<td align="center" valign="middle" style="color:#444444; font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px;"><a href="javascript:void(0);" style="color:#0094aa; text-decoration:none;" data-size="body-text" data-min="10" data-max="25" data-link-color="plain-url-color" data-link-size="plain-url-text">(Remember: Not responding to this booking will result in your listing being ranked lower.)</a></td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		</tr>
		<tr>
		<td align="center" valign="middle" style="color:#444444; font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px; padding:0 20px;" data-size="body-text" data-min="10" data-max="25" data-color="body-text">If you need help or have any questions, please visit <a href="mailto:'.$admin_email.'" style="color:#0094aa;" data-link-color="plain-url-color">'.$admin_email.'</a></td>
		</tr>
		<tr>
		<td height="50">&nbsp;</td>
		</tr>
		<tr>
		<td height="30" bgcolor="#fff">&nbsp;</td>
		</tr>
		<tr>
		<td align="center" bgcolor="#fff">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="padding:0px 10px;">
		<tbody>
		</tbody>
		</table>
		</td>
		</tr>
		<tr>
		<td height="30" bgcolor="#4BBEFF" >&nbsp;</td>
		</tr>
		</tbody></table>
		</td>      </tr>
		</tbody></table>';
		$this->load->view ( 'site/user/invoice', $this->data );
	}
	
	
	public function invoice_old_29_06_2016() {
		$id = $this->uri->segment(4);
		$Invoicetmp = $this->product_model->get_all_details(RENTALENQUIRY,array('Bookingno'=>$id));
		$eId = $Invoicetmp->row()->id;
		$transactionid = $this->product_model->get_all_details(PAYMENT,array('EnquiryId'=>$eId));
		$coupon_code = $transactionid ->row()->coupon_code;
		$coupon_details = $this->product_model->get_all_details(COUPONCARDS,array('code'=>$coupon_code));
		$admin_email = $this->product_model->get_all_details(ADMIN,array())->row()->email;
		$transid = $Invoicetmp->row()->Bookingno;
		$productvalue = $this->product_model->get_all_details(PRODUCT,array('id'=>$Invoicetmp->row()->prd_id));
		$productaddress = $this->product_model->get_all_details(PRODUCT_ADDRESS_NEW,array('productId'=>$Invoicetmp->row()->prd_id));
		$product_id = $Invoicetmp->row()->prd_id;
		$checkindate =date('d-M-Y',strtotime($Invoicetmp->row()->checkin));
		$checkoutdate =date('d-M-Y',strtotime($Invoicetmp->row()->checkout));
		$TotalAmt_temp = ($Invoicetmp->row()->totalAmt) - ($Invoicetmp->row()->serviceFee);
		$TotalwithoutService = CurrencyValue($product_id,$TotalAmt_temp);
		//vasu
		$coupon_discount = 0;
		if($transactionid->row()->is_coupon_used=='Yes')
		{
			$TotalAmt_temp = ($Invoicetmp->row()->totalAmt) - ($Invoicetmp->row()->serviceFee);
			$TotalwithoutService = CurrencyValue($product_id,$TotalAmt_temp);
			$coupon_discount = CurrencyValue($product_id,$transactionid->row()->dval);
			$total_value=$transactionid->row()->discount;
		}

		$subTotal=($Invoicetmp->row()->subTotal-$TotalAmt_temp);
		$to  = '';//$this->data['bookingmail']->row()->email; // note the comma

		$service = $this->user_model->get_all_details(COMMISSION,array('id'=>2, 'status'=>'Active'));
      	$servicefee = CurrencyValue($product_id,$Invoicetmp->row()->serviceFee);
      	$TotalAmt = CurrencyValue($product_id,$Invoicetmp->row()->totalAmt);
		$gtotalAmt = CurrencyValue($product_id,$productvalue->row()->price);
		$tt_price = $TotalAmt-$coupon_discount;
		$Night = ($Invoicetmp->row()->numofdates == 1)?"Night":"Nights";
		$Guest = ($Invoicetmp->row()->NoofGuest==1)?"Guest":"Guests";
		$houserule = ($productvalue->row()->house_rules!='')?$productvalue->row()->house_rules:'None';
		$this->data['message'] = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Invoice</title>
		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:site" content="@ZoplayCom" />
		<meta name="twitter:creator" content="@ZoplayCom"/>
		<meta name="twitter:widgets:csp" content="on">
		<meta property="og:title" content='.$productvalue->row()->product_title.' />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="http://rc.nextio.co.kr/rental/'.$id.'" />
		<meta property="og:address" content='.$productaddress->row()->address.' />
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#4BBEFF" data-bgcolor="body-bg-dark" data-module="1" class="ui-sortable-handle currentTable">
		<tbody><tr>
		<td>
		<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth" style="background-color:#ffffff;" data-bgcolor="light-gray-bg">
		<tbody><tr>
		<td height="30" bgcolor="#4BBEFF" >&nbsp;</td>
		</tr>
		<tr>
		<td align="center">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tbody><tr style="padding: 10px 10px 0px 10px; float: left">
		<td align="center" valign="top">
		<table width="650" border="0" cellpadding="5" cellspacing="1" >
		<tbody style="font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px;">
		<tr>
		<th width="70" bgcolor="#4BBEFF"style="color:#fff; font-size:15px;">Receipt</th>
		<th width="75" ></th>
		<th width="75"></th>
		<th width="75"></th>
		<th align="right" width="75" style="color:#f3402e; text-align:right"><a onClick="window.print()" TARGET="_blank" style="cursor: pointer; cursor: hand;text-decoration:underline;">Print Page</a></th>
		</tr>
		</tbody></table>
		</td>
		</tr>
		</tr>
		<tr><td align="left" style="color:#4c4c4c;font-size:13px;font-family:Open Sans, Arial, Helvetica, sans-serif;margin:10px; padding: 10px">Booking No : '.$transid.'</td></tr>
		<tr><td align="left" style="color:#4c4c4c;font-size:13px;font-family:Open Sans, Arial, Helvetica, sans-serif;margin:10px; padding: 10px">Property Name : '.$productvalue->row()->product_title.'</td></tr>
		<tr><td align="left" style="color:#4c4c4c;font-size:13px;font-family:Open Sans, Arial, Helvetica, sans-serif;margin:10px; padding: 10px">Address : '.$productaddress->row()->address.'</td></tr>
		<tr>
		<td style="border-top:1px solid #808080" bgcolor="#fff">&nbsp;</td>
		</tr>
		<tr>
		<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tbody><tr style="padding: 10px; float: left">
		<td align="center" valign="top">
		<table width="650" border="0" cellpadding="5" cellspacing="1" >
		<tbody style="font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px;" ><tr>
		<th width="75" bgcolor="#EFEFEF">Check In</th>
		<th width="5"></th>
		<th width="75" bgcolor="#EFEFEF">Check Out</th>
		<th width="75" ></th>
		<th width="75" bgcolor="#EFEFEF">'.$Night.'</th>
		<th width="75" bgcolor="#EFEFEF">'.$Guest.'</th>
		</tr>
		<tr align="center">
		<td >'.$checkindate.'</td>
		<td ></td>
		<td >'.$checkoutdate.'</td>
		<td ></td>
		<td >'.$Invoicetmp->row()->numofdates.'</td>
		<td >'.$Invoicetmp->row()->NoofGuest.'</td>
		</tr>
		</tbody></table>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		<tr style="pointer-events:none;">
		<td align="center" valign="top" style="color:#000; font-weight: 700; font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px;" data-size="body-text" data-min="10" data-max="25" data-color="footer-text">
		<img id="map-image" border="0" alt="'.$productaddress->row()->address.'" src="https://maps.googleapis.com/maps/api/staticmap?center='.$productaddress->row()->address.'&zoom=13&size=600x300&maptype=roadmap&sensor=false&format=png&visual_refresh=true&markers=size:mid%7Ccolor:red%7C'. $productaddress->row()->address.'">
		</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		</tr>
		<tr>
		<tr>
		<td align="center" >
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" style="padding:0px 10px;">
		<tbody><tr>
		<td align="left" width="300px" valign="top" style="color:#4f595b; font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px; line-height:20px;" data-size="body-text" data-min="10" data-max="25" data-color="footer-text">
		<h4 style="float: left; width:100%;">Cancellation Policy  -    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.ucfirst($productvalue->row()->cancellation_policy).'</h4>For More details of the cancellation policy, please refer <a href="'.base_url().'pages/cancellation-policy" target="_blank">cancellation policy</a>.
		<td>
		<td align="left" width="300px"valign="top" style="color:#4f595b; text-align:justify; font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px;line-height:20px;" data-size="body-text" data-min="10" data-max="25" data-color="footer-text">
		<h4 style="float: left; width:100%;">House Rules</h4>
		'.$houserule.'</td>
		</tr>
		<tr>
		<td align="left" width="300px" valign="top" style="color:#4f595b; font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px; line-height:20px;" data-size="body-text" data-min="10" data-max="25" data-color="footer-text">
		<h4 style="float: left; width:100%; margin: 10px 0px;">Billing</h4>
		<table style="width:100%; font-size:13px;">
		<tr>
		<td style="border-bottom: 1px solid #bbb;">Booked for '.$Invoicetmp->row()->numofdates.'  &nbsp;'.$Night.'</td>
		<td style="border-bottom: 1px solid #bbb;"></td>
		<td style="border-bottom: 1px solid #bbb; padding: 5px 0px;">'.$this->session->userdata('currency_s') .' '.$TotalwithoutService.'</td>
		</tr>';
		if($servicefee >0.00){
			$this->data['message'].= '<tr>
			<td style="border-bottom: 1px solid #bbb;">Service Fee</td>
			<td style="border-bottom: 1px solid #bbb;"></td>
			<td style="border-bottom: 1px solid #bbb; padding: 5px 0px;">'.$this->session->userdata('currency_s') .' '.$servicefee.'</td>
			</tr>
			<tr>';
		}
		if($transactionid->row()->is_coupon_used=='Yes') {
			$this->data['message'].= '<tr>
			<td style="border-bottom: 1px solid #bbb;">Discount Amount (-)</td>
			<td style="border-bottom: 1px solid #bbb;"></td>
			<td style="border-bottom: 1px solid #bbb; padding: 5px 0px;">'.$this->session->userdata('currency_s') .' '.$coupon_discount.'</td>
			</tr>
			<tr>'; 
		}
		$this->data['message'].='<td style="border-bottom: 1px solid #bbb;  padding: 10px 0px;">Total</td>
		<td style="border-bottom: 1px solid #bbb;padding: 10px 0px;"></td>
		<td style="border-bottom: 1px solid #bbb;padding: 10px 0px;">'.$this->session->userdata('currency_s') .' '.$tt_price.'</td>
		</tr>
		</table>
		<td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		</tr>
		<tr>
		<td>&nbsp;</td>
		</tr>
		<tr>
		<td align="center" valign="middle" style="color:#444444; font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px;"><a href="javascript:void(0);" style="color:#0094aa; text-decoration:none;" data-size="body-text" data-min="10" data-max="25" data-link-color="plain-url-color" data-link-size="plain-url-text">(Remember: Not responding to this booking will result in your listing being ranked lower.)</a></td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		</tr>
		<tr>
		<td align="center" valign="middle" style="color:#444444; font-family:Open Sans, Arial, Helvetica, sans-serif; font-size:13px; padding:0 20px;" data-size="body-text" data-min="10" data-max="25" data-color="body-text">If you need help or have any questions, please visit <a href="mailto:'.$admin_email.'" style="color:#0094aa;" data-link-color="plain-url-color">'.$admin_email.'</a></td>
		</tr>
		<tr>
		<td height="50">&nbsp;</td>
		</tr>
		<tr>
		<td height="30" bgcolor="#fff">&nbsp;</td>
		</tr>
		<tr>
		<td align="center" bgcolor="#fff">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="padding:0px 10px;">
		<tbody>
		</tbody>
		</table>
		</td>
		</tr>
		<tr>
		<td height="30" bgcolor="#4BBEFF" >&nbsp;</td>
		</tr>
		</tbody></table>
		</td>      </tr>
		</tbody></table>';
		$this->load->view ( 'site/user/invoice', $this->data );
	}

	public function account_changes($userid){
		$userDetail = $this->user_model->get_all_details(USERS,array('id'=>$userid));
		$username = $userDetail->row()->firstname." ".$userDetail->row()->lastname;
		$useremail = $userDetail->row()->email;

		$newsid='36';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);


		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];

		$adminnewstemplateArr=array(
				'email_title'=>$this->config->item('email_title'),
				'logo'=>$this->data['logo'],
				'username'=>$username
				);


		extract($adminnewstemplateArr);

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
		$email_values = array('mail_type'=>'html',
			'from_mail_id'=>$sender_email,
			'mail_name'=>$sender_name,
			'to_mail_id'=>$useremail,
			'cc_mail_id'=>$sender_email,
			'subject_message'=>$template_values['news_subject'],
			'body_messages'=>$message
		);
		$email_send_to_common = $this->order_model->common_email_send($email_values);
	}




	public function reloadCaptcha()
	{
		$Capta1 = substr(str_shuffle("0123456789"), 0, 4);
		$Capta2 = substr(str_shuffle("0123456789"), 0, 4);
		echo $Capta1.'-'.$Capta2;

	}

	public function send_message()
	{
		$sender_id = $this->input->post ( 'sender_id' );
		$receiver_id = $this->input->post ( 'receiver_id' );
		$booking_id = $this->input->post ( 'booking_id' );
		$product_id = $this->input->post ( 'product_id' );
		$subject = $this->input->post ( 'subject' );
		$message = strip_tags($this->input->post ( 'message' ));
		$statusQry = $this->user_model->get_all_details ( MED_MESSAGE, array ('bookingNo' => $booking_id));
		$status = $statusQry->row()->status;
		$dataArr = array(
			'productId' => $product_id ,
			'senderId' => $sender_id ,
			'receiverId' => $receiver_id ,
			'bookingNo' => $booking_id ,
			'subject' => $subject ,
			'message' => $message,
			'status' => $status
		);
		$this->db->insert(MED_MESSAGE, $dataArr);
				
		$user_key = $this->user_model->get_all_details(USERS, array('id'=>$receiver_id));
		$conid = time();
		$userName = $user_key->row()->user_name;
		if($user_key->row()->image !=''){
			$userImage = $user_key->row()->image;
		}else{
			$userImage  = 'profile.jpg';
		}
	
		$gcmRegID = $user_key->row()->mobile_key; 
		if (isset($gcmRegID) && isset($message)) 
		{		
			$gcmRegIds = array($gcmRegID);
			$message1 = array("m" => $message,"k"=>'msg',"convId"=>$booking_id,"convName"=>$userName,"convImage"=>$userImage,"convRentalId"=>$product_id,"convIHostId"=>$sender_id);	
			$pushStatus = $this->sendPushNotificationToAndroid($gcmRegIds, $message1);
		}
	}
	
	public function DeleteallWishList_New($userid,$listid)
	{
	$wishlistdetails = $this->user_model->get_all_details(LISTS_DETAILS, array ('id' => $listid,'user_id'=>$userid));
	$prd_id = ltrim($wishlistdetails->row()->product_id,",");
	$product_id = explode(',',$prd_id);
	foreach($product_id as $row){
	$this->user_model->commonDelete(NOTES, array ('user_id' => $userid,'product_id'=>$row));
	
	}
	$this->user_model->commonDelete(LISTS_DETAILS, array('id' => $listid));
	//print_r($product_id); die;
	redirect('users/'.$this->data ['userDetails']->row ()->id.'/wishlists');
	}


/**
 * ************************************************
 */
}
