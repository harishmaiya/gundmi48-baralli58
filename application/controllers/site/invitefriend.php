<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invitefriend extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('product_model','product');
		$this->load->model('user_model');
		
		
	}
	public function twitter_login(){
		require("twitter/twitteroauth.php");
		require "twitter/config.php";
		session_start();
		$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
		$request_token = $twitteroauth->getRequestToken(base_url().'site/invitefriend/TwitterloginRedirect');
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		if($twitteroauth->http_code == 200){
			$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
			header('Location: ' . $url);
		}else{
			die('Something wrong happened.');
		}
	}
	public function TwitterloginRedirect(){
		require("twitter/twitteroauth.php");
		require "twitter/config.php";
		session_start();
		if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
			$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
			$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
			$_SESSION['access_token'] = $access_token;
			$user_info = $twitteroauth->get('account/verify_credentials');
			$twitterId = $user_info->id;
			$twitterCountById = $this->user_model->social_network_login_check($twitterId);
			if($twitterCountById != 0){
				//echo "redirect to login success page";
				$getLoginDetails = $this->user_model->get_social_login_details($twitterId);
				$userdata = array(
					'fc_session_user_id' => $getLoginDetails['id'],
					'session_user_name' => $getLoginDetails['user_name'], 
					'session_user_email' => $getLoginDetails['email'] 
				);
				$this->session->set_userdata($userdata);
				if($this->data['login_succ_msg'] != '')
				$lg_err_msg = $this->data['login_succ_msg'];
				else
				$lg_err_msg = 'You are Logged In ...';
				$this->setErrorMessage('success',$lg_err_msg);
				redirect(base_url());
			}else{
				$getFileNameArray = explode('/',$user_info->profile_image_url);
				$fileNameDetails = $getFileNameArray[5];
				if($fileNameDetails != ''){
					$fileNameDetails = $getFileNameArray[5];
				}else{
					$fileNameDetails = '';
				}
				$twitter_login_details = array('social_login_name'=>$user_info->name,'social_login_unique_id'=>$user_info->id,'screen_name'=>$user_info->screen_name,'social_image_name'=>$fileNameDetails);
				$url = $user_info->profile_image_url;
				$img = 'images/users/'.$fileNameDetails ;
				file_put_contents($img, file_get_contents($url));
				//echo "redirect to registration page";
				$social_login_name = $user_info->name;
				$this->session->set_userdata($twitter_login_details);
				//echo $a =$this->session->userdata($twise);
				redirect('signup');
			}
		}else{
			redirect('signup');
		}
	}
	public function twitter_friends(){
		$returnStr['status_code'] = 1;
		$returnStr['url'] = base_url().'site/invitefriend/get_twitter';
		$returnStr['message'] = '';
		echo json_encode($returnStr);
	}
	public function twitter_request(){
		$userDetails = $this->product->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
		$link = base_url();
		$full_name = $userDetails->row()->full_name;
		if ($full_name=='') $full_name = $userDetails->row()->user_name;
//		$invite_text = 'Invites you to join on '.$this->data['siteTitle'].' ('.base_url().'?ref='.$userDetails->row()->user_name.')';
		$invite_text = $full_name.' invites you to join on '.$this->data['siteTitle'];
		require_once('twitter/codebird.php');
		require "twitter/config.php";
		\Codebird\Codebird::setConsumerKey(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
		$cb = \Codebird\Codebird::getInstance();
		$cb->setToken($this->config->item('twitter_access_token'), $this->config->item('twitter_access_token_secret'));
		$reply = $cb->directMessages_new(array(
			'text' => $invite_text,
			'user_id'=>$this->input->post('twid'),
		));
		if($reply->httpstatus == 200){
			echo "send";
		}else{
			echo $reply->errors[0]->message;
		}
	}
	public function get_twitter(){
		require("twitter/twitteroauth.php");
		require "twitter/config.php";
		session_start();
		$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
		$request_token = $twitteroauth->getRequestToken(base_url().'site/invitefriend/getTwitterData');
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		if ($twitteroauth->http_code == 200) {
			$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
			header('Location: ' . $url);
		} else {
			die('Something wrong happened.');
		}
	}
	public function getTwitterData(){
		require("twitter/twitteroauth.php");
		require "twitter/config.php";
		session_start();
		if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
			$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
			$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
			$_SESSION['access_token'] = $access_token;
			$user_info = $twitteroauth->get('account/verify_credentials');
			$uid = $user_info->id;
			$username = $user_info->name;
			$friends = $user_info->followers_count;
			$screenName = $user_info->screen_name;
			//echo '<pre>';print_r($user_info);
			if($friends>0){
			
				$param_arr = array(
				'screen_name'=>$user_info->screen_name
				);
				
				$tw_friends_list = $twitteroauth->get('https://api.twitter.com/1.1/followers/list.json',$param_arr);
				
			print_r($tw_friends_list);
				
				$html = "<html><body><div style='height:auto; text-align:center;'>";
				foreach($tw_friends_list->users as $tw_friends_detail){
					$html .= '<div style="float:left; width:100%; height:75px; border-bottom:1px solid #ddd; padding-top:5px; padding-bottom:5px;">';
					$html .= '<div style="float:left; width:11%"><img style="float:left; height:75px; width:75px;" src="'.$tw_friends_detail->profile_image_url.'" /></div>';
					$html .= '<div style="text-align:left;float:left; width:30%; margin:20px 0 0 20px">'.$tw_friends_detail->name.'</div>';
					$html .= '<div style="float:right; margin:20px 0 0 20px"><input style="cursor:pointer; width:100px; color:white; font-size:17px; border-radius:5px; background:rgb(58, 126, 199); border:none; height:40px; margin-right:20px;" type="button" id="'.$tw_friends_detail->id.'" onclick="TwitterInvite(this);" value="Invite"></div>';
					$html .= '</div>';
				}
				$html .= '<input class="twitter_done" type="button" value="Done" style="cursor:pointer;width:100px; color:white; font-size:13px; background:rgb(58, 126, 199); border:none; height:40px; margin-top:10px; border-radius:5px;">';
				$html .= '</div></body></html>';
			}
			echo $html;
			
			echo "<script type='text/javascript' src='".base_url()."js/site/jquery-1.7.1.min.js'></script>
			<script type='text/javascript'>
				function TwitterInvite(evt){
					if($(evt).hasClass('processing')) return;
					$(evt).addClass('processing');
					$(evt).parent().append('<img src=\'".base_url()."images/twit_loader.gif\'>');
					var id =evt.id;
					var url = '".base_url()."site/invitefriend/twitter_request';
					$.post(url,{'twid':id},function(data){
						if(data == 'send'){
							$(evt).parent().find('img:last').remove();
							$(evt).val('Invited');
						}else{
							alert(data);
							$(evt).parent().find('img:last').remove();
						}
					});
				}
				$('.twitter_done').click(function(){
					window.close();
				});
			</script>";
		}else{
			echo "<script type='text/javascript'>
					window.close();
				</script>";
		}
	}
	
	
	
	public function google_connect()
	{
		$site_settings= $this->user_model->get_all_details(ADMIN_SETTINGS,array())->row();
		
		$clientid = $site_settings->google_client_id;
		$clientsecret = $site_settings->google_client_secret;
		$redirecturi = $site_settings->google_redirect_url_connect; 
		$maxresults = 100;
		if($_GET["code"] == '')
		{
		
		header("Location: https://accounts.google.com/o/oauth2/auth?scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile&state=%2Fprofile&client_id=$clientid&redirect_uri=$redirecturi&response_type=code");
		}
		else
		{
	
			$authcode = $_GET["code"];
			$fields=array(
			'code'=> urlencode($authcode),
			'client_id'=> urlencode($clientid),
			'client_secret'=> urlencode($clientsecret),
			'redirect_uri'=> urlencode($redirecturi),
			'grant_type'=> urlencode('authorization_code') );

			$fields_string = '';
			foreach($fields as $key=>$value){ $fields_string .= $key.'='.$value.'&'; }
			$fields_string = rtrim($fields_string,'&');

			$ch = curl_init();//open connection
			curl_setopt($ch,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
			curl_setopt($ch,CURLOPT_POST,5);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$result = curl_exec($ch);
			curl_close($ch);

			$response = json_decode($result);
			
			$accesstoken = $response->access_token;
			if( $accesstoken!='')
			$_SESSION['token']= $accesstoken;


			$xmlresponse = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token='. $_SESSION['token']);
			$userProfile = json_decode($xmlresponse);
			
			$condition = array('id' => $this->checkLogin ( 'U' ));
			$this->user_model->update_details(USERS,array('google'=>$userProfile->email),$condition);
			$this->setErrorMessage ( 'success', 'Your Google account is connected, Successfully');
			redirect('verification');
		}
		
	
	}
	
	public function google_disconnect() {
			$condition = array('id' => $this->checkLogin ( 'U' ));
			$this->user_model->update_details(USERS,array('google'=>''),$condition);
			$this->setErrorMessage ( 'success', 'Your Google account is disconnected, Successfully' );
			redirect('verification');
	}
	
	public function facebook_connect(){
		require 'facebook/src/facebook.php';
		$facebook = new Facebook(array(
		'appId'  => $this->config->item ( 'facebook_app_id' ),
		'secret' => $this->config->item ( 'facebook_app_secret' )
		));
		//echo $this->config->item ( 'facebook_app_id' ).'</br>'.$this->config->item ( 'facebook_app_secret' );die;
		// Get User ID
		$user = $facebook->getUser();

		if ($user) {
		try {
		// Get the user profile data you have permission to view
		$user_profile = $facebook->api('/me');
		
		$condition = array('id' => $this->checkLogin ( 'U' ));
		$this->user_model->update_details(USERS,array('facebook'=>$user_profile['id']),$condition);

		$this->setErrorMessage ( 'success', 'Your Facebook account is connected, Successfully' );
		redirect('verification');
		} catch (FacebookApiException $e) {
		$user = null;
		}
		} else {
		
		die('<script>top.location.href="'.$facebook->getLoginUrl().'";</script>');
		}
	}
	
	public function facebook_disconnect() {
			$condition = array('id' => $this->checkLogin ( 'U' ));
			$this->user_model->update_details(USERS,array('facebook'=>''),$condition);
			$this->setErrorMessage ( 'success', 'Your Facebook account is disconnected, Successfully' );
			redirect('verification');
	}
	
	public function linkedin_connect(){
		$site_settings= $this->user_model->get_all_details(ADMIN_SETTINGS,array())->row();
		$client_id = $site_settings->linkedin_app_id;
		$redirect_uri = base_url().'site/invitefriend/linkedin_connect';

		if (isset($_GET['error'])) {
			echo $_GET['error'] . ': ' . $_GET['error_description'];
		} elseif (isset($_GET['code'])) {
			$this->getAccessToken();
			$user = $this->fetch('GET', '/v1/people/~:(id,firstName,lastName,email-address,picture-url)');
			
			$condition = array('id' => $this->checkLogin ( 'U' ));
			$this->user_model->update_details(USERS,array('twitter'=>'linkedin'),$condition);
			$this->setErrorMessage ( 'success', 'Your LinkedIn account is connected, Successfully' );
			redirect('verification');
		}else {
			header("Location:https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&state=987654321&scope=r_basicprofile%20r_emailaddress%20w_share");
		}
	}
	
	public function getAccessToken() {
		$site_settings= $this->user_model->get_all_details(ADMIN_SETTINGS,array())->row();
    $params = array(
        'grant_type' => 'authorization_code',
        'client_id' => $site_settings->linkedin_app_id,
        'client_secret' =>  $site_settings->linkedin_app_key,
        'code' => $_GET['code'],
        'redirect_uri' => base_url().'site/invitefriend/linkedin_connect',
    );
    // Access Token request
    $url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
    // Tell streams to make a POST request
    $context = stream_context_create(
            array('http' =>
                array('method' => 'POST',
                )
            )
    );
    // Retrieve access token information
    $response = file_get_contents($url, false, $context);
    // Native PHP object, please
    $token = json_decode($response);
    // Store access token and expiration time
    $_SESSION['access_token'] = $token->access_token; // guard this! 
    $_SESSION['expires_in'] = $token->expires_in; // relative time (in seconds)
    $_SESSION['expires_at'] = time() + $_SESSION['expires_in']; // absolute time
    return true;
	}

	public function fetch($method, $resource, $body = '') {
    $opts = array(
        'http' => array(
            'method' => $method,
            'header' => "Authorization: Bearer " . 
            $_SESSION['access_token'] . "\r\n" . 
            "x-li-format: json\r\n"
        )
    );
    $url = 'https://api.linkedin.com' . $resource;
   // if (count($params)) {
     //   $url .= '?' . http_build_query($params);
   // }
    $context = stream_context_create($opts);
    $response = file_get_contents($url, false, $context);
    return json_decode($response);
	}
	
	public function linkedin_disconnect() {
			$condition = array('id' => $this->checkLogin ( 'U' ));
			$this->user_model->update_details(USERS,array('twitter'=>''),$condition);
			$this->setErrorMessage ( 'success', 'Your LinkedIn account is disconnected, Successfully' );
			redirect('verification');
	}
	
	
	public function login(){
		$client_id = $this->config->item('linkedin_app_id');
		$redirect_uri = base_url().'linkedinLogin';

		if (isset($_GET['error'])) {
			echo $_GET['error'] . ': ' . $_GET['error_description'];
		} elseif (isset($_GET['code'])) {
			$this->loginAccessToken();
			$user = $this->login_fetch('GET', '/v1/people/~:(id,firstName,lastName,email-address,picture-url)');//get name
		
			$email = $user->emailAddress;
			$user_name = $user->firstName;
			$last_name = $user->lastName;
			$social_id = $user->id;
			$profile_image_url = 'user-thumb.png';
			//echo "<pre>";print_r($user); die;
			if($email != '')
		{
			$googleLoginCheck = $this->user_model->googleLoginCheck($email);

				
			if($googleLoginCheck > 0)
			{
				//echo "login";
				$getGoogleLoginDetails = $this->user_model->google_user_login_details($email);
				//echo "<pre>";print_r($getGoogleLoginDetails);die;

				$userdata = array(
							'fc_session_user_id' => $getGoogleLoginDetails['id'],
							
							'session_user_email' => $getGoogleLoginDetails['email'] 
				);
				//echo "<pre>";print_r($userdata);die;
				$this->session->set_userdata($userdata);

				if($this->data['login_succ_msg'] != '')
				$lg_err_msg = $this->data['login_succ_msg'];
				else
				$lg_err_msg = 'You are Logged In ...';
				$this->setErrorMessage('success',$lg_err_msg);
				redirect(base_url());
			}
			else
			{

				$google_login_details = array('social_login_name'=>$user_name,'social_login_unique_id'=>$social_id,'screen_name'=>$user_name,'social_image_name'=>'','social_email_name'=>$email,'loginUserType'=>'google');
				//echo "<pre>";print_r($google_login_details);die;
				//echo "redirect to registration page";
				$social_login_name = $user_name;
				$this->session->set_userdata($google_login_details);
				
				
				$firstname = $user_name;
				$lastname = $last_name;
				$orgPass = time();
				$pwd = md5($orgPass);
				$Confirmpwd = $orgPass;
				$username = $user_name;
		
				$condition = array ('email' => $email);
				$duplicateMail = $this->user_model->get_all_details ( USERS, $condition );
				
				$expireddate = date ( 'Y-m-d', strtotime ( '+15 days' ) );
				
				$dataArr = array('firstname'=>$firstname,'lastname'=>$lastname,'user_name'=>$firstname,'group'=>'User','image'=>$profile_image_url,'email'=>$email,'password'=>$pwd,'status'=>'Active','expired_date'=>$expireddate,'is_verified'=>'No','loginUserType'=>'linkedin','google'=>'Yes','created'=>date('Y-m-d H:i:s'));
				$this->user_model->simple_insert(USERS,$dataArr);
				$lstID = $this->db->insert_id();
				//echo $this->db->last_query(); die;
				$userdata = array (
						'quick_user_name' => $firstname,
						'quick_user_email' => $email,
						'fc_session_user_id' => $lstID,
						'session_user_email' => $email 
				);
				$this->session->set_userdata ( $userdata );
				$condition = array ('email' => $email);
				$usrDetails = $this->user_model->get_all_details ( USERS, $condition );
				$this->send_confirm_mail ( $usrDetails );
				$this->setErrorMessage('success','Registered & Login Successfully');
				redirect(base_url());
				
				
			}
		}
		else
			{
			redirect('');
			}
		}else {
			header("Location:https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&state=987654321&scope=r_basicprofile%20r_emailaddress%20w_share");
		}
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
		
		$email_send_to_common = $this->user_model->common_email_send ( $email_values );
	}
	
	
	public function loginAccessToken() {
    $params = array(
        'grant_type' => 'authorization_code',
        'client_id' => $this->config->item('linkedin_app_id'),
        'client_secret' => $this->config->item('linkedin_app_key'),
        'code' => $_GET['code'],
        'redirect_uri' => base_url().'linkedinLogin'
    );
    // Access Token request
    $url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
    // Tell streams to make a POST request
    $context = stream_context_create(
            array('http' =>
                array('method' => 'POST',
                )
            )
    );
    // Retrieve access token information
    $response = file_get_contents($url, false, $context);
    // Native PHP object, please
    $token = json_decode($response);
    // Store access token and expiration time
    $_SESSION['access_token'] = $token->access_token; // guard this! 
    $_SESSION['expires_in'] = $token->expires_in; // relative time (in seconds)
    $_SESSION['expires_at'] = time() + $_SESSION['expires_in']; // absolute time
    return true;
	}

	public function login_fetch($method, $resource, $body = '') {
    $opts = array(
        'http' => array(
            'method' => $method,
            'header' => "Authorization: Bearer " . 
            $_SESSION['access_token'] . "\r\n" . 
            "x-li-format: json\r\n"
        )
    );
    $url = 'https://api.linkedin.com' . $resource;
   // if (count($params)) {
     //   $url .= '?' . http_build_query($params);
   // }
    $context = stream_context_create($opts);
    $response = file_get_contents($url, false, $context);
    return json_decode($response);
	}

	
	
}

