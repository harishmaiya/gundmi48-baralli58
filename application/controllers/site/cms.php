<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
 *
 * CMS related functions
 *
 * @author dev Beetrut
 *
 */
class Cms extends MY_Controller {
	function __construct() {

		parent::__construct ();
		$this->load->helper ( array (
			'cookie',
			'date',
			'form',
			'email'
		) );
		$this->load->library ( array (
			'encrypt',
			'form_validation'

		) );
		$this->load->model ( array (
			'admin_model',
			'cms_model'
		) );
		if ($_SESSION ['sMainCategories'] == '') {
			$sortArr1 = array (
				'field' => 'cat_position',
				'type' => 'asc'
			);
			$sortArr = array (
				$sortArr1
			);
			$_SESSION ['sMainCategories'] = $this->cms_model->get_all_details ( CATEGORY, array (
				'rootID' => '0',
				'status' => 'Active'
			), $sortArr );
		}
		$this->data ['mainCategories'] = $_SESSION ['sMainCategories'];

		if ($_SESSION ['sColorLists'] == '') {
			$_SESSION ['sColorLists'] = $this->cms_model->get_all_details ( LIST_VALUES, array (
					'list_id' => '1'
			) );
		}
		$this->data ['mainColorLists'] = $_SESSION ['sColorLists'];

		$this->data ['loginCheck'] = $this->checkLogin ( 'U' );
		$this->data ['likedProducts'] = array ();
		$this->load->library("pagination");
	}
	public function index() {
		$seourl = $this->uri->segment ( 2 );
		if($this->session->userdata('language_code') ==''){
		$lang_code = 'en';
		}else{
		$lang_code = $this->session->userdata('language_code');	
		}
		$pageDetails = $this->cms_model->get_all_details ( CMS, array (
				'seourl' => $seourl,
				'lang_code' => $lang_code,
				'status' => 'Publish'
		) );
		if ($pageDetails->num_rows () == 0) {
			show_404 ();
		} else {
			if ($pageDetails->row ()->meta_title != '') {
				$this->data ['heading'] = $pageDetails->row ()->meta_title;
				$this->data ['meta_title'] = $pageDetails->row ()->meta_title;
			}
			if ($pageDetails->row ()->meta_tag != '') {
				$this->data ['meta_keyword'] = $pageDetails->row ()->meta_tag;
			}
			if ($pageDetails->row ()->meta_description != '') {
				$this->data ['meta_description'] = $pageDetails->row ()->meta_description;
			}
			$this->data ['heading'] = $pageDetails->row ()->meta_title;
			$this->data ['pageDetails'] = $pageDetails;
			$this->data ['admin_settings'] = $this->admin_model->getAdminSettings ();
			$this->load->view ( 'site/cms/display_cms', $this->data );
		}
	}
	public function page_by_id() {
		$cid = $this->uri->segment ( 2 );
		$pageDetails = $this->cms_model->get_all_details ( CMS, array (
				'id' => $cid,
				'status' => 'Publish'
		) );
		if ($pageDetails->num_rows () == 0) {
			show_404 ();
		} else {
			if ($pageDetails->row ()->meta_title != '') {
				$this->data ['heading'] = $pageDetails->row ()->meta_title;
				$this->data ['meta_title'] = $pageDetails->row ()->meta_title;
			}
			if ($pageDetails->row ()->meta_tag != '') {
				$this->data ['meta_keyword'] = $pageDetails->row ()->meta_tag;
			}
			if ($pageDetails->row ()->meta_description != '') {
				$this->data ['meta_description'] = $pageDetails->row ()->meta_description;
			}
			$this->data ['heading'] = $pageDetails->row ()->meta_title;
			$this->data ['pageDetails'] = $pageDetails;
			$this->load->view ( 'site/cms/display_cms', $this->data );
		}
	}

	public function rental_detail_count() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			$this->data ['rentalDetail'] = $this->cms_model->get_all_details ( PRODUCT, array (
					'user_id' => $this->checkLogin ( 'U' )
			) );
			$this->data ['rentalAddress'] = $this->cms_model->get_all_details ( PRODUCT_ADDRESS, array (
					'product_id' => $this->data ['rentalDetail']->row ()->id
			) );
			$this->data ['rentalBooking'] = $this->cms_model->get_all_details ( PRODUCT_BOOKING, array (
					'product_id' => $this->data ['rentalDetail']->row ()->id
			) );

			foreach ( $rentalDetail->result () as $row ) {
				$listingCount = 0;
				if ($row->bedrooms != '')
					$listingCount ++;
				if ($row->beds != '')
					$listingCount ++;
				if ($row->bed_type != '')
					$listingCount ++;
				if ($row->bathrooms != '')
					$listingCount ++;
				if ($row->home_type != '')
					$listingCount ++;
				if ($row->room_type != '')
					$listingCount ++;
				if ($row->accommodates != '')
					$listingCount ++;

				if ($listingCount == 7)
					$listingComplete = 'yes';
				else
					$listingComplete = 'no';
			}
			foreach ( $rentalAddress->result () as $row ) {
				$addressCount = 0;
				if ($row->country != '')
					$addressCount ++;
				if ($row->state != '')
					$addressCount ++;
				if ($row->city != '')
					$addressCount ++;
				if ($row->address != '')
					$addressCount ++;

				if ($addressCount == 4)
					$addressComplete = 'yes';
				else
					$addressComplete = 'no';
			}
			foreach ( $rentalDetail->result () as $row ) {
				$photoCount = 0;
				if ($row->image != '')
					$photoCount ++;
			}
			foreach ( $rentalDetail->result () as $row ) {
				$overviewCount = 0;
				if ($row->product_name != '')
					$overviewCount ++;
				if ($row->description != '')
					$overviewCount ++;
			}
			foreach ( $rentalDetail->result () as $row ) {
				$pricingCount = 0;
				if ($row->price != '')
					$pricingCount ++;
			}
			foreach ( $rentalBooking->result () as $row ) {
				$calendarCount = 0;
				if ($row->datefrom != '')
					$calendarCount ++;
				if ($row->dateto != '')
					$calendarCount ++;
			}
		}
	}


	public function contactus() {
		$name = strip_tags($this->input->post ( 'name' ));
		$email = strip_tags($this->input->post ( 'email' ));
		$subject = strip_tags($this->input->post ( 'subject' ));
		$message = strip_tags($this->input->post ( 'msg' ));
		require_once './captcha/securimage.php';
		$securimage = new Securimage ();
		$captcha = $this->input->post ( 'ct_captcha' );
		if ($securimage->check ( $captcha ) == false) {
			$this->setErrorMessage ( 'error', 'Incorrect security code entered.' );
			redirect ('contact-us');
		} else {
			$dataArr = array (
					'name' => $name,
					'email' => $email,
					'subject' => $subject,
					'message' => $message
			)
			;
			$this->cms_model->simple_insert ( CONTACTUS, $dataArr );
			$newsid='20';
			$template_values=$this->cms_model->get_newsletter_template_details($newsid);
			if($template_values['sender_name']=='' && $template_values['sender_email']==''){
				$sender_email=$this->data['siteContactMail'];
				$sender_name=$this->data['siteTitle'];
			}else{
				$sender_name=$template_values['sender_name'];
				
				$sender_email=$template_values['sender_email'];
			}
			$email_values = array('mail_type'=>'html',
					'from_mail_id'=>$this->input->post('email'),
					'to_mail_id'=> $sender_email,
					'subject_message'=>$this->input->post('subject'),
					'body_messages'=>$this->input->post('msg'),
			);
			$email_send_to_common = $this->cms_model->common_email_send($email_values);
			$this->setErrorMessage ( 'success', 'Your message sent successfully.' );
		}
		redirect ( 'contact-us' );
	}

	public function learnmore() {
		$this->data['cmslearnmore'] = $this->cms_model->get_cms_learnmore();
		$this->load->view ( 'site/cms/learnhost', $this->data );
	}

	public function howitwork() {
		$this->data['cmshowitwork'] = $this->cms_model->get_cms_details();
		$this->load->view ( 'site/cms/howitwork', $this->data );
		$city=$this->input->post('city');
	}

	public function cancelmyaccount() {
		$user_id = $this->uri->segment(4);
		$condition = array('id'=>$user_id);
		$excludeArr = array();
		$dataArr = array('status'=>'Inactive');
		$this->cms_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
		$newdata = array('status' => 'UnPublish');
		$condition = array('user_id' => $user_id);
		$this->cms_model->update_details(PRODUCT,$newdata,$condition);
		$this->setErrorMessage ( 'success', 'Your account has been Deactived successfully.' );
		redirect ('site/user/deactive_user');
	}

	/* Guide Approval fucntionality */
	public function confirm_booking() {
		$sender_id = $this->input->post ( 'sender_id' );
		$receiver_id = $this->input->post ( 'receiver_id' );
		$booking_id = $this->input->post ( 'booking_id' );
		$product_id = $this->input->post ( 'product_id' );
		$subject = $this->input->post ( 'subject' );
		$message = strip_tags($this->input->post ( 'message' ));
		$status = $this->input->post ( 'status' );
		$dataArr = array(
			'productId' => $product_id ,
			'senderId' => $sender_id ,
			'receiverId' => $receiver_id ,
			'bookingNo' => $booking_id ,
			'subject' => $subject ,
			'message' => $message,
			'point' => '1',
			'status' => $status
		);

		$this->db->insert(MED_MESSAGE, $dataArr);
		$this->db->where('bookingNo', $booking_id);
		$this->db->update(MED_MESSAGE, array('status' => $status));
		$newdata = array('approval' => $status,'message'=>$message);
		$condition = array('Bookingno' => $booking_id);
		$this->cms_model->update_details(RENTALENQUIRY,$newdata,$condition);
		$bookingDetails = $this->cms_model->get_all_details(RENTALENQUIRY, $condition);
		$enqId = $bookingDetails->row()->id;
		if($status == 'Accept') 
		{
			$this->guideapproval($enqId);
			$this->guideapprovalbyhost($enqId);
			$msgStatus = 'approved';
		}
		else if($status == 'Decline')
		{
			$this->guidedecline($enqId);
			$this->guidedeclinebyuser($enqId);
			$msgStatus = 'declined';
		}
		$this->data['hostDetails'] = $this->cms_model->get_all_details(USERS,array('id'=>$receiver_id));
		$this->data['product'] = $this->cms_model->get_all_details(PRODUCT,array('id'=>$product_id));
		$gcmRegID  = $this->data['hostDetails']->row()->mobile_key;
		$ios_key  = $this->data['hostDetails']->row()->ios_key;
		$pushMessage = 'Your booking request for '.$this->data['product']->row()->product_title.' is '.$msgStatus;
		$message1 = $pushMessage;
		if (isset($gcmRegID) && isset($pushMessage)) {		
			$gcmRegIds = array($gcmRegID);
			$message = array("m" => $pushMessage, "k"=>'Your Trips');	 
			$pushStatus = $this->sendPushNotificationToAndroid($gcmRegIds, $message);
		}
		
		$senderDetails = $this->user_model->get_all_details ( USERS, array ('id' => $bookingDetails->row()->renter_id));
		$receiverDetails = $this->user_model->get_all_details ( USERS, array ('id' => $bookingDetails->row()->user_id));
		
		require_once('twilio/Services/Twilio.php');
		
		if($receiverDetails->row()->phone_no != '' && $receiverDetails->row()->country_code != '' && $receiverDetails->row()->ph_verified == 'Yes' && $receiverDetails->row()->mobile_notification == 'Yes'){
			$to = $receiverDetails->row()->country_code.$receiverDetails->row()->phone_no;
			$senderName = $senderDetails->row()->user_name;
			$receiverName = $receiverDetails->row()->user_name;
			$message = 'Hi '.$receiverName.', your booking request('.$booking_id.") was ".$msgStatus." by ".$senderName." for the property ".$this->data['product']->row()->product_title." - from ".$this->config->item ( 'meta_title' );
			
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
		
		echo 'Success';
	}

	public function guide_approval() {
		$user_id = $this->uri->segment(4);
		$status = 'Accept';
		$newdata = array('approval' => $status);
		$condition = array('id' => $user_id);
		$this->cms_model->update_details(RENTALENQUIRY,$newdata,$condition);
		$this->guideapproval($user_id);
		$this->guideapprovalbyhost($user_id);
		$this->setErrorMessage('success','You have just confirmed a booking');
		redirect('listing-reservation');
	}


	public function guideapproval($id) {
		$this->data['detail'] = $this->cms_model->get_all_details(RENTALENQUIRY,array('id'=>$id));
		$this->data['userdetail'] = $this->cms_model->get_all_details(USERS,array('id'=>$this->data['detail']->row()->user_id));
		$this->data['hostdetail'] = $this->cms_model->get_all_details(USERS,array('id'=>$this->data['detail']->row()->renter_id));
		$this->data['productdetail'] = $this->cms_model->get_all_details(PRODUCT,array('id'=>$this->data['detail']->row()->prd_id));
		$newsid = '23';
		$template_values = $this->cms_model->get_newsletter_template_details ($newsid);
		$adminnewstemplateArr = array (
			'email_title' => $this->config->item ('email_title' ),
			'logo' => $this->data ['logo'],
			'travelername'=>$this->data['userdetail']->row()->firstname."  ".$this->data['userdetail']->row()->lastname,
			'propertyname'=>$this->data['productdetail']->row()->product_title,
			'hostname'=>$this->data['hostdetail']->row()->firstname." ".$this->data['hostdetail']->row()->lastname
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
			'to_mail_id' => $this->data['userdetail']->row()->email,
			'subject_message' => $template_values ['news_subject'],
			'body_messages' => $message
		);
		$this->cms_model->common_email_send($email_values);
	}

	public function guideapprovalbyhost($id) {
		$this->data['detail'] = $this->cms_model->get_all_details(RENTALENQUIRY,array('id'=>$id));
		$this->data['userdetail'] = $this->cms_model->get_all_details(USERS,array('id'=>$this->data['detail']->row()->user_id));
		$this->data['hostdetail'] = $this->cms_model->get_all_details(USERS,array('id'=>$this->data['detail']->row()->renter_id));
		$this->data['productdetail'] = $this->cms_model->get_all_details(PRODUCT,array('id'=>$this->data['detail']->row()->prd_id));
		$newsid = '30';
		$template_values = $this->cms_model->get_newsletter_template_details ($newsid);
		$adminnewstemplateArr = array (
			'email_title' => $this->config->item ('email_title' ),
			'logo' => $this->data ['logo'],
			'travelername'=>$this->data['userdetail']->row()->firstname."  ".$this->data['userdetail']->row()->lastname,
			'propertyname'=>$this->data['productdetail']->row()->product_title,
			'hostname'=>$this->data['hostdetail']->row()->firstname." ".$this->data['hostdetail']->row()->lastname
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
			'to_mail_id' => $this->data['hostdetail']->row()->email,
			'subject_message' => $template_values ['news_subject'],
			'body_messages' => $message
		);
		$this->cms_model->common_email_send($email_values);
	}

	public function guide_decline() {
		$user_id = $this->uri->segment(4);
		$status = 'Decline';
		$newdata = array('approval' => $status);
		$this->guidedecline($user_id);
		$this->guidedeclinebyuser($user_id);
		$condition = array('id' => $user_id);
		$this->cms_model->update_details(RENTALENQUIRY,$newdata,$condition);
		$this->setErrorMessage('success','You have just declined a booking');
		redirect('listing-reservation');
	}

	public function guidedecline($id) {
		$this->data['detail'] = $this->cms_model->get_all_details(RENTALENQUIRY,array('id'=>$id));
		$this->data['userdetail'] = $this->cms_model->get_all_details(USERS,array('id'=>$this->data['detail']->row()->user_id));
		$this->data['hostdetail'] = $this->cms_model->get_all_details(USERS,array('id'=>$this->data['detail']->row()->renter_id));
		$this->data['productdetail'] = $this->cms_model->get_all_details(PRODUCT,array('id'=>$this->data['detail']->row()->prd_id));
		$newsid = '24';
		$template_values = $this->cms_model->get_newsletter_template_details ($newsid);
		$adminnewstemplateArr = array (
			'email_title' => $this->config->item ('email_title' ),
			'logo' => $this->data ['logo'],
			'travelername'=>$this->data['userdetail']->row()->firstname."  ".$this->data['userdetail']->row()->lastname,
			'propertyname'=>$this->data['productdetail']->row()->product_title,
			'hostname'=>$this->data['hostdetail']->row()->firstname." ".$this->data['hostdetail']->row()->lastname
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
			'to_mail_id' => $this->data['userdetail']->row()->email,
			'subject_message' => $template_values ['news_subject'],
			'body_messages' => $message
		);
		//echo stripslashes($message);die;
		$this->cms_model->common_email_send($email_values);
	}
	
	public function guidedeclinebyuser($id) {
		$this->data['detail'] = $this->cms_model->get_all_details(RENTALENQUIRY,array('id'=>$id));
		$this->data['userdetail'] = $this->cms_model->get_all_details(USERS,array('id'=>$this->data['detail']->row()->user_id));
		$this->data['hostdetail'] = $this->cms_model->get_all_details(USERS,array('id'=>$this->data['detail']->row()->renter_id));
		$this->data['productdetail'] = $this->cms_model->get_all_details(PRODUCT,array('id'=>$this->data['detail']->row()->prd_id));
		$newsid = '25';
		$template_values = $this->cms_model->get_newsletter_template_details ($newsid);
		$adminnewstemplateArr = array (
			'email_title' => $this->config->item ('email_title' ),
			'logo' => $this->data ['logo'],
			'travelername'=>$this->data['userdetail']->row()->firstname."  ".$this->data['userdetail']->row()->lastname,
			'propertyname'=>$this->data['productdetail']->row()->product_title,
			'hostname'=>$this->data['hostdetail']->row()->firstname." ".$this->data['hostdetail']->row()->lastname
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
			'to_mail_id' => $this->data['hostdetail']->row()->email,
			'subject_message' => $template_values ['news_subject'],
			'body_messages' => $message
		);
		//echo stripslashes($message);die;
		$this->cms_model->common_email_send($email_values);
	}


	public function set_commission()
	{
		$payament = $this->cms_model->get_all_details(PAYMENT, array('status'=>'Paid'));
		foreach($payament->result() as $pay){
		$user = $this->cms_model->get_all_details(USERS, array('id'=>$pay->sell_id));
		$enq = $this->cms_model->get_all_details(RENTALENQUIRY, array('id'=>$pay->EnquiryId));
		$host_email = $user->row()->email;
		$host_id = $user->row()->id;
		$booking_no = $enq->row()->Bookingno;
		$payable_amount = $pay->sumtotal-(20+10);
		if($host_email != ''){
		$dataArr = array(
			'host_email'		=>	$host_email,
			'host_id'			=> $host_id,
			'booking_no'		=>	$booking_no,
			'total_amount'		=>	$pay->sumtotal,
			'guest_fee'			=>	20,
			'host_fee'			=>	10,
			'payable_amount'	=>	$payable_amount
		);
		$this->cms_model->simple_insert(COMMISSION_TRACKING,$dataArr);
		}}
	}


	public function calendar() {
		if($this->input->post ( 'productId' )){
			$productId = $this->input->post ( 'productId' ); 
		}
		$this->data['productId'] = $productId;
		$this->data['id'] = $productId;
		$productDetails = $this->cms_model->get_all_details(PRODUCT, array('id'=>$productId));
		$productCurrency = $productDetails->row()->currency;
		$currencyCheck = $this->cms_model->get_all_details(CURRENCY,array('currency_type'=>$productCurrency));
		if($currencyCheck->num_rows() > 0){
			$currencySymbol = $currencyCheck->row()->currency_symbols;
			$currencyCode = $currencyCheck->row()->currency_type;
		}else{
			$currencyCheck = $this->cms_model->get_all_details(CURRENCY,array('default_currency'=>'Yes'));
			$currencySymbol = $currencyCheck->row()->currency_symbols;
			$currencyCode = $currencyCheck->row()->currency_type;
		}
		$price = $productDetails->row()->price;
		$dateJsonQry = $this->cms_model->get_all_details(SCHEDULE, array('id'=>$productId));
		$dateJson = $dateJsonQry->row()->data;
		$dateArr = (array)json_decode($dateJson);

		$list=array();
		$ajax = 0;
		
		$month = date('m', time());
		$year = date('Y', time());
		
		if($this->input->post ( 'month' ) != '' && $this->input->post ( 'year' )){
			$month = $this->input->post ( 'month' ); 
			$year = $this->input->post ( 'year' );
			$ajax = 1;
		}
		
		$thisMonth = strtotime(date('Y-m', time()));
		$checkMonth = strtotime($year.'-'.$month);
		if($thisMonth == $checkMonth)$this->data['blockPrev'] = 'Yes';
		else $this->data['blockPrev'] = 'No';
		
		$this->data['month'] = $month;
		$this->data['year'] = $year;
		
		if($month == '01'){
			$lastMonth = 12;
			$lastYear = $year-1;
		}else {
			$lastMonth = $month-1;
			$lastYear = $year;
		}
		$this->data['lastYear'] = $lastYear;
		$this->data['lastMonth'] = $lastMonth;
		
		if($month == '12'){
			$nextMonth = 01;
			$nextYear = $year+1;
		} else{
			$nextMonth = $month+1;
			$nextYear = $year;
		}
		$this->data['nextYear'] = $nextYear;
		$this->data['nextMonth'] = $nextMonth;
		
		$time=mktime(12, 0, 0, $month, 1, $year);          
		$startingDay =  date('w', $time);
		
		$result = strtotime("{$lastYear}-{$lastMonth}-01");
		$result = strtotime('-1 second', strtotime('+1 month', $result));
		$lastMonthEnd = date('d', $result);
		$lastMonthStart = $lastMonthEnd-$startingDay+1;
		
		for($d=$lastMonthStart; $d<=31; $d++)
		{
			$time=mktime(12, 0, 0, $lastMonth, $d, $lastYear);          
			if (date('m', $time)==$lastMonth)       
				$list[]=date('Y-m-d', $time);
		}
		
		for($d=1; $d<=31; $d++)
		{
			$time=mktime(12, 0, 0, $month, $d, $year);          
			if (date('m', $time)==$month){       
				$list[]=date('Y-m-d', $time);
				$endingDay =  date('w', $time);
			}
		}
		$nextMonthEnd = 6-$endingDay;
		
		if(count($list)+$nextMonthEnd < 42)
		$nextMonthEnd = 42-count($list);
		
		for($d=1; $d<=$nextMonthEnd; $d++)
		{
			$time=mktime(12, 0, 0, $nextMonth, $d, $nextYear);          
			if (date('m', $time)==$nextMonth)       
				$list[]=date('Y-m-d', $time);
		}
		
		if(count($list) < 42)
		{
			$newList = array();
			$lastMonthStart = $lastMonthEnd-6;
			for($d=$lastMonthStart; $d<=31; $d++)
			{
				$time=mktime(12, 0, 0, $lastMonth, $d, $lastYear);          
				if (date('m', $time)==$lastMonth)       
					$newList[]=date('Y-m-d', $time);
			}
			$list = array_merge($newList,$list);
		}
		$dateTime = strtotime(date('Y-m-d', time()));
		$this->data['monthTime'] = strtotime(date('Y-m', time()));
		$html = '';
		$todayCheck = 0;
		foreach($list as $date){
			$curDate = date('d', strtotime($date));
			$curMonth = date('m', strtotime($date));
			$curYear = date('Y', strtotime($date));
			$timeStamp = strtotime($curYear.'-'.$curMonth.'-'.$curDate);
			$html .= '<li id="'.$timeStamp.'" class="';
			if($dateTime > strtotime($date))
			$html .= ' past-date ';
			else{
				$html .= ' current-date ';
				$todayCheck = 1;
			}
			if(!empty($dateArr[$date]) && $todayCheck == 1){
				if($dateArr[$date]->status == 'available')$html .= ' date-available ';
				if($dateArr[$date]->status == 'booked')$html .= ' date-booked ';
				if($dateArr[$date]->status == 'unavailable')$html .= ' date-unavailable ';
			}
			if($curDate == date('d', time()) && $curMonth == date('m', time()) && $curYear == date('Y', time())){
				$html .= ' date-today ';
			}
			if($curMonth == $month)
			$html .= ' current-month ';
			else
			$html .= ' other-month ';
			$html .= '">';
			$html .= '<div class="dayholder">';
			if($curDate == date('d', time()) && $curMonth == date('m', time()) && $curYear == date('Y', time())){
				$html .= '<span class="ds-nme ds-label">';
				if($this->lang->line('today') != '')
				$html .= $this->lang->line('today');
				else 
				$html .= 'Today';
				$html .= '</span>';
			}
			else if(date('d', strtotime($date)) == 1){
				$html .= '<span class="ds-nme ds-label">';
				if($this->lang->line(date('F', strtotime($date))) != '')
				$html .= $this->lang->line(date('F', strtotime($date)));
				else 
				$html .= date('F', strtotime($date));
				$html .= '</span>';
			}
			$html .= '<span class="ds-nme">'.date('d', strtotime($date)).'</span><span class="botmtxt">';
			if(!empty($dateArr[$date])){
				if($dateArr[$date]->status == 'available')$html .= $dateArr[$date]->price.$currencySymbol.' '.$currencyCode.'</span></div></li>';
				//if($dateArr[$date]->status == 'booked')$html .= $dateArr[$date]->price.' DKK</span></div></li>';
			}
			else if($todayCheck == 1){
				$html .= round($price).$currencySymbol;
				$html .= ' '.$currencyCode.'</span></div></li>';
			}
		}
		
		$this->data['html'] = $html;
		if($ajax == 1)
		$this->load->view ( 'site/product/calendar_ajax', $this->data );
		else 
		$this->load->view ( 'site/product/calendar', $this->data );
	}
	
	public function getDatesFromRange($start, $end) {
		$dates = array ($start);
		while ( end ( $dates ) < $end ) {
			$dates [] = date ( 'Y-m-d', strtotime ( end ( $dates ) . ' +1 day' ) );
		}
		
		return $dates;
	}
	
	public function save_calendar(){
		$home_date_from = $this->input->post('home_date_from');
		$from = date ( 'Y-m-d', strtotime ( $home_date_from ) );
		$home_date_to = $this->input->post('home_date_to');
		$to = date ( 'Y-m-d', strtotime ( $home_date_to ) );
		$dates = $this->getDatesFromRange ( $from, $to );
		$productId = $this->input->post('productId');
		$status = $this->input->post('status');
		$amount = $this->input->post('amount');
		$notes = $this->input->post('notes');
		$schedule = $this->cms_model->get_all_details(SCHEDULE, array('id'=>$productId));
		$scheduleArr = (array)json_decode($schedule->row()->data);
		foreach($scheduleArr as $key => $res){
			if(in_array($key, $dates)){
				unset($scheduleArr[$key]);
			}
		}
		
		foreach($dates as $date){
			if($status == 'available')
			{
				$tempArr['available'] = 1;
				$tempArr['bind'] = 0;
				$tempArr['info'] = '';
				$tempArr['notes'] = $notes; 
				$tempArr['price'] = round($amount);
				$tempArr['promo'] = '';
				$tempArr['status'] = 'available';
				$newScheduleArr[$date] = (object)$tempArr;
			}
			else if($status == 'unavailable')
			{
				$tempArr['available'] = '';
				$tempArr['bind'] = 0;
				$tempArr['info'] = '';
				$tempArr['notes'] = $notes; 
				$tempArr['price'] = round($amount);
				$tempArr['promo'] = '';
				$tempArr['status'] = 'unavailable';
				$newScheduleArr[$date] = (object)$tempArr;
			}
		}
		
		$scheduleArr = array_merge($newScheduleArr, $scheduleArr);
		
		$dataString = json_encode((object)$scheduleArr);
	
		$values = json_decode($dataString);
		$dat_arr = get_object_vars($values);
		
		$condition = array('id'=>$productId);
		$dataArr = array('data'=>$dataString);
		$this->cms_model->update_details (SCHEDULE, $dataArr, $condition );
		
		foreach($dat_arr as $key=>$val){
			if($val->status == 'available'){
				$condition = array('PropId'=>$productId, 'the_date'=>$key);
				$this->cms_model->commonDelete ( CALENDARBOOKING, $condition );
			}
			else if($val->status == 'unavailable'){
				$condition = array('PropId'=>$productId, 'the_date'=>$key);
				$checkQry = $this->cms_model->get_all_details(CALENDARBOOKING, $condition);
				$dataArr = array( 'PropId' => $productId,
					'the_date' => $key,
					'id_state' => 4,
					'id_item' => 1
				);
				if( $checkQry->num_rows == 0){
					$this->cms_model->simple_insert ( CALENDARBOOKING, $dataArr );
				}
				else{
					$this->cms_model->commonDelete ( CALENDARBOOKING, $condition );
					$this->cms_model->simple_insert ( CALENDARBOOKING, $dataArr );
				}
			}
		}
	}
	
	public function get_pop_up(){
		$selectedDates = $this->input->post ('selectedDates');
		$this->data['productId'] = $this->input->post ('productId');
		$this->data['productDetails'] = $this->cms_model->get_all_details(PRODUCT, array('id'=>$this->data['productId']));
		$productCurrency = $this->data['productDetails']->row()->currency;
		$currencyCheck = $this->cms_model->get_all_details(CURRENCY,array('currency_type'=>$productCurrency));
		if($currencyCheck->num_rows() > 0){
			$this->data['currencySymbol'] = $currencyCheck->row()->currency_symbols;
			$this->data['currencyCode'] = $currencyCheck->row()->currency_type;
		}else{
			$currencyCheck = $this->cms_model->get_all_details(CURRENCY,array('default_currency'=>'Yes'));
			$this->data['currencySymbol'] = $currencyCheck->row()->currency_symbols;
			$this->data['currencyCode'] = $currencyCheck->row()->currency_type;
		}
		$this->data['price'] = $this->data['productDetails']->row()->price;
		$dates = array();
		foreach($selectedDates as $res){
			$dates[] = date('m/d/Y', $res);
			$datesCheck[] = date('Y-m-d', $res);
		}
		$this->data['error_message'] = '';
		foreach($datesCheck as $res){
			$condition = array('PropId'=>$this->data['productId'], 'the_date'=>$res, 'id_state'=>1);
			$checkQry = $this->cms_model->get_all_details(CALENDARBOOKING, $condition);
			if($checkQry->num_rows() > 0){
				$this->data['error_message'] = 'Booked dates can\'t be changed';
			}
		}
		$this->data['startingDate'] = $dates[0];
		$this->data['endingDate'] = $dates[count($dates)-1];
		$this->load->view ( 'site/product/calendar_popup', $this->data );
	}
	
	public function get_time_stamp(){
		$home_date_from = $this->input->post ('home_date_from');
		$home_date_to = $this->input->post ('home_date_to');
		$returnStr['from'] = strtotime($home_date_from);
		$returnStr['to'] = strtotime($home_date_to);
		echo json_encode($returnStr);
	}
	
	public function contactus_businesstravel() {
		if ($this->uri->segment ( 1 ) == 'contact-us') {
			$this->data['cmscontactus'] = $this->cms_model->get_cmscontact_details();
			$this->load->view ( 'site/cms/contactus', $this->data );
		} else if ($this->uri->segment ( 1 ) == 'business-travel') {
			$this->data['SliderList'] = $this->slider_model->get_slider_details('WHERE status="Active"');
			$this->data['cmsbusinesstravel'] = $this->cms_model->get_cmsbusiness_details();
			$this->load->view ( 'site/cms/business-travel', $this->data );
		}
	}
	
		
	public function getDirContents($dir, &$results = array()){
		$files = scandir($dir);

		foreach($files as $key => $value){
			$path = realpath($dir.DIRECTORY_SEPARATOR.$value);
			if(!is_dir($path)) {
				$results[] = $path;
			} else if($value != "." && $value != "..") {
				$this->getDirContents($path, $results);
				$results[] = $path;
			}
		}

		return $results;
	}
	
	public function check_image_files() {
		/* $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/'), RecursiveIteratorIterator::SELF_FIRST);
		echo '<pre>';print_r($objects); */
	
		$files = $this->getDirContents('images/');
		foreach($files as $file){
			if(strpos($file, '.php') > 1){
				echo $file;echo '<br>';
				unlink($file);
			}
		}
		
		$files = $this->getDirContents('server/php/rental/');
		foreach($files as $file){
			if(strpos($file, '.php') > 1){
				echo $file;echo '<br>';
				unlink($file);
			}
		}
	}
/* Controller End */
}
