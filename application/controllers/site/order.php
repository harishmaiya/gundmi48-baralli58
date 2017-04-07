<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author dev Beetrut
 *
 */

class Order extends MY_Controller { 
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('order_model');$this->load->model('user_model');
		$this->load->model('product_model');
		$this->load->model('contact_model');
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->order_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];
		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->order_model->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];
		$this->data['loginCheck'] = $this->checkLogin('U');
    }

	/**
	 * 
	 * Loading Order Page
	 */
	public function index(){
		$this->data['heading'] = 'Order Confirmation'; 
		if($this->uri->segment(2) == 'success'){
			if($this->uri->segment(5)==''){
				$transId = $_REQUEST['txn_id'];
				$Pray_Email = $_REQUEST['payer_email'];
			}else{
				$transId = $this->uri->segment(5);
				$Pray_Email = '';
			}	
			$UserNo = $this->uri->segment(3);
			$DealCodeNo = $this->uri->segment(4);
			$PaymentSuccessCheck = $this->order_model->get_all_details(PAYMENT,array('user_id' => $UserNo, 'dealCodeNumber' => $DealCodeNo,'status'=>'Paid'));
			$EnquiryUpdate = $this->order_model->get_all_details(PAYMENT,array('dealCodeNumber'=>$DealCodeNo));
			$eprd_id = $EnquiryUpdate->row()->product_id;
			$eInq_id = $EnquiryUpdate->row()->EnquiryId;
			$coupon = $this->session->userdata('coupon_strip');
			$coupon = explode('-', $coupon);
			$this->data['discountAmt'] = 0;
			if($coupon['0'] != ''){
				$dataArr = array('is_coupon_used' => 'Yes',
				   'discount_type' => $coupon['4'],
				   'coupon_code' => $coupon['0'],
				   'discount' => $coupon['2'],
				   'dval' => $coupon['1'],
				   'total_amt' => $coupon['3']
				);
				$this->session->unset_userdata('coupon_strip');
				$this->order_model->update_details(PAYMENT,$dataArr,array('dealCodeNumber'=>$DealCodeNo));
				$dataArr = array('discount_amount' => $coupon['2'],'pro_discount_amount' => AdminCurrencyValue($eprd_id,$coupon['2']) );
				$this->order_model->update_details(RENTALENQUIRY,$dataArr,array('id'=> $eInq_id)); 
				$dataArr = array('code' => trim($coupon['0']));
				$couponi = $this->order_model->get_all_details(COUPONCARDS,$dataArr);
				$dataArr = array('purchase_count' => $couponi->row()->purchase_count+1,
				'card_status' => 'redeemed');
				$this->order_model->update_details(COUPONCARDS,$dataArr,array('id'=>$couponi->row()->id));
				$this->data['discountAmt'] = $coupon['1'];
			}
			$this->data['invoicedata'] = $this->order_model->get_all_details(RENTALENQUIRY,array('id'=>$eInq_id));		
			$condition1 = array('user_id'=>$UserNo,'prd_id'=>$eprd_id,'id'=>$eInq_id);
			$dataArr1 = array('booking_status'=>'Booked');
			$this->order_model->update_details(RENTALENQUIRY,$dataArr1,$condition1);
			$this->data['Confirmation'] = $this->order_model->PaymentSuccess($this->uri->segment(3),$this->uri->segment(4),$transId,$Pray_Email,$this->uri->segment(6));
			$SelBookingQty =$this->order_model->get_all_details(RENTALENQUIRY,array( 'id' => $eInq_id));
			$productId = $SelBookingQty->row()->prd_id;
			$arrival = $SelBookingQty->row()->checkin;
			$depature = $SelBookingQty->row()->checkout;
			$dates = $this->getDatesFromRange($arrival, $depature);
			$i=1;
			$dateMinus1= count($dates)-2; 
			foreach($dates as $date){
				if($i <= $dateMinus1){
					$BookingArr=$this->contact_model->get_all_details(CALENDARBOOKING,array('PropId' => $productId,'id_state' => 1,'id_item' => 1,'the_date' => $date));
					if($BookingArr->num_rows() > 0){
					
					}else{
						$dataArr = array('PropId' => $productId,
							 'id_state' => 1,
							 'id_item' => 1,
							 'the_date' => $date
						);
						$this->contact_model->simple_insert(CALENDARBOOKING,$dataArr);
					}
			   }
			   $i++;
			}
			$DateArr=$this->product_model->get_all_details(CALENDARBOOKING,array('PropId'=>$productId));
			$dateDispalyRowCount=0;
			$availableDates = array();
			$price = '';
			if($DateArr->num_rows > 0){
				$dateArrVAl .='{';
				foreach($DateArr->result() as $dateDispalyRow){
					if($dateDispalyRowCount==0){
						$availableDates[] = $dateDispalyRow->the_date;
						$dateArrVAl .='"'.$dateDispalyRow->the_date.'":{"available":"1","bind":0,"info":"","notes":"","price":"'.$price.'","promo":"","status":"booked"}';
					}else{
						$availableDates[] = $dateDispalyRow->the_date;
						$dateArrVAl .=',"'.$dateDispalyRow->the_date.'":{"available":"1","bind":0,"info":"","notes":"","price":"'.$price.'","promo":"","status":"booked"}';
					}
					$dateDispalyRowCount=$dateDispalyRowCount+1;
				}
				$dateArrVAl .='}';
			}
			
			//echo $dateArrVAl;echo '</br></br>';
			$newDateArrQuery = $this->product_model->get_all_details(SCHEDULE,array('id'=>$productId));
			$dateString = $newDateArrQuery->row()->data;
			$dateJ = json_decode($dateString);
			$newdateArr = json_decode($dateArrVAl);
			$newArr = array();
			foreach($dateJ as $key=>$dates)
			{
				if(!in_array($key, $availableDates))
				$newArr[$key] = $dates;
			}
			foreach($newdateArr as $key=>$dates)
			$newdateArr1[$key] = $dates;
			$newdateArrJ = array_merge($newdateArr1, $newArr);
			$dateArrVAl = json_encode($newdateArrJ);
			
			$inputArr4=array();
			$inputArr4 = array('id' =>$productId,'data' => trim($dateArrVAl));
			$this->product_model->update_details(SCHEDULE,$inputArr4,array('id' =>$productId));
			$condition = array('status' => 'Active', 'seo_tag'=>'host-accept');
			$service_tax_host=$this->product_model->get_all_details(COMMISSION, $condition);
			$this->data['host_tax_type'] = $service_tax_host->row()->promotion_type;
			$this->data['host_tax_value'] = $service_tax_host->row()->commission_percentage;
			$condition = array('status' => 'Active', 'seo_tag'=>'guest-booking');
			$service_tax_guest=$this->product_model->get_all_details(COMMISSION, $condition);
			$this->data['guest_tax_type'] = $service_tax_guest->row()->promotion_type;
			$this->data['guest_tax_value'] = $service_tax_guest->row()->commission_percentage;
			$orderDetails = $this->order_model->get_all_details(RENTALENQUIRY,array( 'id' => $eInq_id));
			$userDetails = $this->order_model->get_all_details(USERS,array( 'id' => $orderDetails->row()->renter_id));
			$guest_fee = $orderDetails->row()->serviceFee;
			$netAmount = $orderDetails->row()->totalAmt-$orderDetails->row()->serviceFee;
			$enqId = $orderDetails->row()->id;
			if($this->data['host_tax_type'] == 'flat')
			{
				$host_fee = $this->data['host_tax_value'];
				$host_fee = USDtoOtherCurrency($productId,$host_fee);
			}
			else 
			{
				$host_fee = ($netAmount * $this->data['host_tax_value'])/100;
			}
			$payable_amount = $netAmount - $host_fee;
			$data1 = array('host_email'=>$userDetails->row()->email,
							'host_id' => $userDetails->row()->id,
							'booking_no'=>$orderDetails->row()->Bookingno,
							
							'pro_total_amount'=>AdminCurrencyValue($eprd_id,$orderDetails->row()->totalAmt),
							'pro_guest_fee'=>AdminCurrencyValue($eprd_id,$guest_fee),
							'pro_host_fee'=>AdminCurrencyValue($eprd_id,$host_fee), 
							'pro_payable_amount'=>AdminCurrencyValue($eprd_id,$payable_amount),
							
							'total_amount'=>$orderDetails->row()->totalAmt,
							'guest_fee'=>$guest_fee,
							'host_fee'=>$host_fee, 
							'payable_amount'=>$payable_amount
			);
			$chkQry = $this->order_model->get_all_details(COMMISSION_TRACKING,array( 'booking_no' => $orderDetails->row()->Bookingno));
			if($chkQry->num_rows() == 0)
			$this->product_model->simple_insert(COMMISSION_TRACKING, $data1);
			else
			$this->product_model->update_details(COMMISSION_TRACKING,$data1,array('booking_no'=>$orderDetails->row()->Bookingno));
			
			$checkin = $SelBookingQty->row()->checkin;
			$checkout = $SelBookingQty->row()->checkout;
			$query = "SELECT * FROM ".RENTALENQUIRY." WHERE (( checkin <= '".$checkin."' and checkout >= '".$checkin."') or (checkin <= '".$checkout."' and checkout >= '".$checkout."')) AND booking_status <> 'Booked' AND prd_id = ".$productId;
			$res = $this->order_model->ExecuteQuery($query);
			foreach($res->result() as $r){
				$dataArr = array('approval' => 'Decline', 'declined' => 'Yes');
				$this->order_model->update_details(RENTALENQUIRY, $dataArr, array('id'=>$r->id));
				
				
				$dataArr = array(
					'productId' => $productId ,
					'senderId' => $SelBookingQty->row()->renter_id ,
					'receiverId' => $SelBookingQty->row()->user_id ,
					'bookingNo' => $r->Bookingno ,
					'subject' => "Booking Request : ".$r->Bookingno ,
					'message' => "declined",
					'point' => '1',
					'status' => 'Decline'
				);

				$this->db->insert(MED_MESSAGE, $dataArr);
				
				
				$this->order_model->update_details (MED_MESSAGE,array('status'=>'Decline'),array('bookingNo'=>$r->Bookingno));
				$this->send_decline_msg($r->id);
			}
		
			$this->booking_conform_mail($DealCodeNo);
			$this->booking_conform_mail_admin($DealCodeNo);
			$this->booking_conform_mail_host($DealCodeNo);
			$this->send_booking_sms($enqId);
			$this->send_booking_sms_host($enqId);
			$this->data['Confirmation'] = 'Success';
			$this->data['productId'] = $productId;
			$this->load->view('site/order/order.php',$this->data);
		}elseif($this->uri->segment(2) == 'failure'){
			$this->data['Confirmation'] = 'Failure';
			if($this->uri->segment(3) != '')
			$this->data['errors'] = $this->uri->segment(3);
			else if($this->session->userdata('payment_error') != '')
			$this->data['errors'] = $this->session->userdata('payment_error');
			$this->session->unset_userdata('payment_error');
			$this->load->view('site/order/order.php',$this->data);
		}elseif($this->uri->segment(2) == 'notify'){
			$this->data['Confirmation'] = 'Failure';			
			$this->load->view('site/order/order.php',$this->data);
		}elseif($this->uri->segment(2) == 'confirmation'){
			$this->data['Confirmation'] = 'Success';
			$this->load->view('site/order/order.php',$this->data);
		}elseif($this->uri->segment(2) == 'pakagesuccess') {
			$this->memberPackageUpdate($this->uri->segment(3)); 
		}	
	}
	
	public function send_decline_msg($enqId){
		$enqDetailsRow = $this->order_model->get_enquiry_details($enqId);
		$enqDetails = $enqDetailsRow->row();
		$hostDetails = $this->order_model->get_all_details(USERS, array('id'=>$enqDetails->renter_id));
		$userDetails = $this->order_model->get_all_details(USERS, array('id'=>$enqDetails->user_id));
		$username = $userDetails->row()->user_name;
		$toEmail = $userDetails->row()->email;
		$product_title = $enqDetails->product_title;
		$Bookingno = $enqDetails->Bookingno;
		$logo = $this->data['logo'];
		$newsid='56';
		$template_values=$this->order_model->get_newsletter_template_details($newsid);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		$message .= '</body>
			</html>';
		$sender_email=$this->data['siteContactMail'];
		$sender_name=$this->data['siteTitle'];
		
		$email_values = array('mail_type'=>'html',
			'from_mail_id'=>$sender_email,
			'mail_name'=>$sender_name,
			'to_mail_id'=>$toEmail,
			'subject_message'=>$template_values['news_subject'],
			'body_messages'=>$message
		);
		//echo stripslashes($message);die;
		$email_send_to_common = $this->product_model->common_email_send($email_values);
		
	}
	public function send_booking_sms($enqId)
	{
		require_once('twilio/Services/Twilio.php');
		
		$enqDetailsRow = $this->order_model->get_enquiry_details($enqId);
		$enqDetails = $enqDetailsRow->row();
		$userDetails = $this->order_model->get_all_details(USERS, array('id'=>$enqDetails->user_id));
		if($userDetails->row()->phone_no != '' && $userDetails->row()->country_code != '' && $userDetails->row()->ph_verified == 'Yes' && $userDetails->row()->mobile_notification == 'Yes'){
			$to = $userDetails->row()->country_code.$userDetails->row()->phone_no;
			$home_name = $enqDetails->product_title;
			$hostname = $enqDetails->firstname.' '.$enqDetails->lastname;
			$host_phone = $enqDetails->phone_no;
			
			$message = "Hello! you was just confirmed booking with ".$hostname."(".$host_phone."), for the property ".$home_name.". Contact Host for more details. Thanks you.";
			
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
	}
	public function send_booking_sms_host($enqId)
	{
		require_once('twilio/Services/Twilio.php');
		
		$enqDetailsRow = $this->order_model->get_enquiry_details($enqId);
		$enqDetails = $enqDetailsRow->row();
		$hostDetails = $this->order_model->get_all_details(USERS, array('id'=>$enqDetails->renter_id));
		$userDetails = $this->order_model->get_all_details(USERS, array('id'=>$enqDetails->user_id));
		if($hostDetails->row()->phone_no != '' && $hostDetails->row()->country_code != '' && $hostDetails->row()->ph_verified == 'Yes' && $hostDetails->row()->mobile_notification == 'Yes'){
			$to = $hostDetails->row()->country_code.$hostDetails->row()->phone_no;
			$home_name = $enqDetails->product_title;
			$guestname = $userDetails->row()->firstname.' '.$userDetails->row()->lastname;
			$guset_phone = $userDetails->row()->phone_no;
			
			$message = "Hello! your property ".$home_name.". was got confirmed by ".$guestname."(".$guset_phone."). Contact Guest for more details. Thanks you.";
			
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
	}
	
	public function memberPackageUpdate($user_ID) {
		 $condition=array('user_id'=>$user_ID);
		 $dataArr = array( 'package_status' => "Paid");	
		 $this->product_model->commonInsertUpdate(USERS,'update',array('user_id'),array( 'package_status' => "Paid"),array('id'=>$user_ID));	 
		 $this->product_model->commonInsertUpdate(PRODUCT,'update',$excludeArr,$dataArr,$condition);
		 $this->memberPackagePurchaseEmail($user_ID);
		 redirect(base_url('plan'));
	}
	
	public function memberPackagePurchaseEmail($user_ID) {
		$this->data['order_details'] = $this->product_model->get_membership_order_details($user_ID);
		$username=ucfirst($this->data['order_details']->row()->firstname).' '.ucfirst($this->data['order_details']->row()->lastname);
		$newsid='11';
		$template_values=$this->product_model->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array('logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'),'username'=>$username,'packagename'=>ucfirst($this->data['order_details']->row()->name),'price'=>ucfirst($this->data['order_details']->row()->price),'valid_date'=>ucfirst($this->data['order_details']->row()->valid_date));
		extract($adminnewstemplateArr);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		$message .= '</body>
			</html>';
		$sender_email=$this->data['siteContactMail'];
		$sender_name=$this->data['siteTitle'];
		$this->product_model->simple_insert(INBOX,array('sender_id'=>$sender_email,'user_id'=>$this->data['order_details']->row()->email,'mailsubject'=>$subject,'description'=>stripslashes($message)));
		$email_values = array('mail_type'=>'html',
			'from_mail_id'=>$sender_email,
			'mail_name'=>$sender_name,
			'to_mail_id'=>$this->data['order_details']->row()->email,
			'cc_mail_id'=>$sender_email,
			'subject_message'=>$subject,
			'body_messages'=>$message
		);
		$email_send_to_common = $this->product_model->common_email_send($email_values);
	}
	
	public function booking_conform_mail($paymentid){
		$PaymentSuccess = $this->order_model->get_all_details(PAYMENT,array('dealCodeNumber' => $paymentid)); 
		$Renter_details = $this->order_model->get_all_details(USERS,array('id'=>$PaymentSuccess->row()->sell_id));
		$user_details = $this->order_model->get_all_details(USERS,array('id'=>$PaymentSuccess->row()->user_id));
		$Rental_details = $this->order_model->get_all_details(PRODUCT,array('id'=>$PaymentSuccess->row()->product_id));
		$Contact_details = $this->order_model->get_all_details(RENTALENQUIRY,array( 'id' => $PaymentSuccess->row()->EnquiryId));
		$get_servicefee=CurrencyValue($Rental_details->row()->id,$Contact_details->row()->serviceFee);
		$RentalPhoto = $this->order_model->get_all_details(PRODUCT_PHOTOS,array('product_id'=>$PaymentSuccess->row()->product_id));
		$total = $Contact_details->row()->totalAmt-$Contact_details->row()->serviceFee;
		
		$gcmRegID  = $user_details->row()->mobile_key;
		$ios_key  = $user_details->row()->ios_key;
		$pushMessage = "Hi ".$user_details->row()->firstname.", you was completed booking for the booking : ".$Contact_details->row()->Bookingno." - ".$Rental_details->row()->product_title;
		if (isset($gcmRegID) && isset($pushMessage)) {		
			$gcmRegIds = array($gcmRegID);
			$message = array("m" => $pushMessage, "k"=>'Your Trips');	
			$pushStatus = $this->sendPushNotificationToAndroid($gcmRegIds, $message);
		}
		if($ios_key != ''){
			$message2 = array('message'=>$pushMessage);
			$this->push_notification($ios_key,$message2);
		}
		
		
		$newsid='29';
		$template_values=$this->order_model->get_newsletter_template_details($newsid);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		if($Renter_details->row()->image != '')
		$hostImage=base_url()."images/users/".$Renter_details->row()->image;
		else 
		$hostImage=base_url()."images/users/user-thumb.png";
		$proImages=base_url().PRODUCTPATH.$RentalPhoto->row()->product_image;
		$chkIn = date('d-M-Y',strtotime($Contact_details->row()->checkin));
		$chkOut = date('d-M-Y',strtotime($Contact_details->row()->checkout));
		if($Contact_details->row()->discount_amount != 0.00){
			$discount_amount = CurrencyValue($Rental_details->row()->id,$Contact_details->row()->totalAmt-$Contact_details->row()->discount_amount);
			$netAmount = $Contact_details->row()->discount_amount;
		} else {
			$discount_amount = CurrencyValue($Rental_details->row()->id,$Contact_details->row()->discount_amount);
			$netAmount = CurrencyValue($Rental_details->row()->id,$Contact_details->row()->totalAmt);
		}
		$adminnewstemplateArr=array(
			'email_title'=>$this->config->item('email_title'),
			'logo'=>$this->data['logo'],
			'first_name'=>$user_details->row()->firstname,
			'last_name'=>$user_details->row()->lastname,
			'NoofGuest'=>$Contact_details->row()->NoofGuest,
			'numofdates'=>$Contact_details->row()->numofdates,
			'booking_status'=>$Contact_details->row()->booking_status,
			'user_email'=>$user_details->row()->email,
			'ph_no'=>$Renter_details->row()->phone_no,
			'Enquiry'=>$Contact_details->row()->Enquiry,
			'checkin'=>$chkIn,
			'checkout'=>$chkOut,
			'price'=>CurrencyValue($Rental_details->row()->id,$Renter_details->row()->price),
			'amount'=>CurrencyValue($Rental_details->row()->id,$total),
			'netamount'=>$netAmount,
			'noofnights'=>$Contact_details->row()->numofdates,
			'serviceFee'=>$get_servicefee,
			'renter_id'=>$PaymentSuccess->row()->sell_id,
			'prd_id'=>$PaymentSuccess->row()->product_id,
			'renter_fname'=>$Renter_details->row()->firstname,
			'renter_lname'=>$Renter_details->row()->lastname,
			'owner_email'=>$Renter_details->row()->email,
			'owner_phone'=>$Renter_details->row()->phone_no,
			'rental_name'=>$Rental_details->row()->product_title,
			'rental_image'=>$proImages,
			'image'=>$hostImage,
			'symbol'=>$this->session->userdata('currency_type'),
			'discount_amount'=>$discount_amount,
			'bookingNo'=>$Contact_details->row()->Bookingno
		);
		
		extract($adminnewstemplateArr);
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		$message .= '</body>';
		$sender_email=$this->data['siteContactMail'];
		$sender_name=$this->data['siteTitle'];
		$this->order_model->simple_insert(INBOX,array('sender_id'=>$sender_email,'user_id'=>$PaymentSuccess->row()->user_id,'mailsubject'=>$template_values['news_subject'],'description'=>stripslashes($message)));
		$this->session->set_userdata('ContacterEmail',$user_details->row()->email);
		$email_values = array('mail_type'=>'html',
			'from_mail_id'=>$sender_email,
			'mail_name'=>$sender_name,
			'to_mail_id'=>$this->data['userDetails']->row()->email,
			'subject_message'=>$template_values['news_subject'],
			'body_messages'=>$message
		);
		//echo stripslashes($message);die;
		$email_send_to_common = $this->order_model->common_email_send($email_values);
	}
	
	public function booking_conform_mail_admin($paymentid){
		$PaymentSuccess = $this->order_model->get_all_details(PAYMENT,array('dealCodeNumber' => $paymentid)); 
		$condition = array('id'=>$PaymentSuccess->row()->sell_id);
		$Renter_details = $this->order_model->get_all_details(USERS,$condition);
		$condition3 = array('id'=>$PaymentSuccess->row()->user_id);
		$user_details = $this->order_model->get_all_details(USERS,$condition3);
		$condition1 = array('id'=>$PaymentSuccess->row()->product_id);
		$Rental_details = $this->order_model->get_all_details(PRODUCT,$condition1);
		$Contact_details = $this->order_model->get_all_details(RENTALENQUIRY,array( 'id' => $PaymentSuccess->row()->EnquiryId));
		$RentalPhoto = $this->order_model->get_all_details(PRODUCT_PHOTOS,array('product_id'=>$PaymentSuccess->row()->product_id));
		$total = $Contact_details->row()->totalAmt-$Contact_details->row()->serviceFee;
		$get_servicefee=CurrencyValue($Rental_details->row()->id,$Contact_details->row()->serviceFee);
		$newsid='33';
		$template_values=$this->order_model->get_newsletter_template_details($newsid);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$proImages=base_url().PRODUCTPATH.$RentalPhoto->row()->product_image;
		$chkIn = date('d-m-y',strtotime($Contact_details->row()->checkin));
		$chkOut = date('d-m-y',strtotime($Contact_details->row()->checkout));
		if($Contact_details->row()->discount_amount != 0.00){
			$discount_amount = CurrencyValue($Rental_details->row()->id,$Contact_details->row()->totalAmt-$Contact_details->row()->discount_amount);
			$netAmount = $Contact_details->row()->discount_amount;
		} else {
			$discount_amount = CurrencyValue($Rental_details->row()->id,$Contact_details->row()->discount_amount);
			$netAmount = CurrencyValue($Rental_details->row()->id,$Contact_details->row()->totalAmt);
		}
		$adminnewstemplateArr=array(
			'email_title'=>$this->config->item('email_title'),
			'logo'=>$this->data['logo'],
			'first_name'=>$user_details->row()->firstname,
			'last_name'=>$user_details->row()->lastname,
			'NoofGuest'=>$Contact_details->row()->NoofGuest,
			'numofdates'=>$Contact_details->row()->numofdates,
			'booking_status'=>$Contact_details->row()->booking_status,
			'user_email'=>$user_details->row()->email,
			'ph_no'=>$user_details->row()->phone_no,
			'Enquiry'=>$Contact_details->row()->Enquiry,
			'checkin'=>$chkIn,
			'checkout'=>$chkOut,
			'price'=>CurrencyValue($Rental_details->row()->id,$Renter_details->row()->price),
			'amount'=>CurrencyValue($Rental_details->row()->id,$total),
			'netamount'=>$netAmount,
			'noofnights'=>$Contact_details->row()->numofdates,
			'serviceFee'=>$get_servicefee,
			'renter_id'=>$PaymentSuccess->row()->sell_id,
			'prd_id'=>$PaymentSuccess->row()->product_id,
			'renter_fname'=>$Renter_details->row()->firstname,
			'renter_lname'=>$Renter_details->row()->lastname,
			'owner_email'=>$Renter_details->row()->email,
			'owner_phone'=>$Renter_details->row()->phone_no,
			'rental_name'=>$Rental_details->row()->product_title,
			'rental_image'=>$proImages,
			'symbol'=>$this->session->userdata('currency_type'),
			'discount_amount'=>$discount_amount,
			'bookingNo'=>$Contact_details->row()->Bookingno
		);
		extract($adminnewstemplateArr);
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
		$message .= '<body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		$message .= '</body>
			</html>';
		
		$sender_email=$this->data['siteContactMail'];
		$sender_name=$this->data['siteTitle'];
		$this->order_model->simple_insert(INBOX,array('sender_id'=>$sender_email,'user_id'=>$PaymentSuccess->row()->user_id,'mailsubject'=>$template_values['news_subject'],'description'=>stripslashes($message)));
		$this->session->set_userdata('ContacterEmail',$user_details->row()->email);
		$email_values = array('mail_type'=>'html',
			'from_mail_id'=>$sender_email,
			'mail_name'=>$sender_name,
			'to_mail_id'=>$sender_email,
			'subject_message'=>$template_values['news_subject'],
			'body_messages'=>$message
		);
		//echo stripslashes($message);die;
		$email_send_to_common = $this->order_model->common_email_send($email_values);
	}

	public function booking_conform_mail_host($paymentid){
		$PaymentSuccess = $this->order_model->get_all_details(PAYMENT,array('dealCodeNumber' => $paymentid));
		$condition = array('id'=>$PaymentSuccess->row()->sell_id);
		$Renter_details = $this->order_model->get_all_details(USERS,$condition);
		$condition = array('id'=>$PaymentSuccess->row()->sell_id);
		$Renter_email = $this->order_model->get_all_details(USERS,$condition);
		$condition3 = array('id'=>$PaymentSuccess->row()->user_id);
		$user_details = $this->order_model->get_all_details(USERS,$condition3);
		$condition1 = array('id'=>$PaymentSuccess->row()->product_id);
		$Rental_details = $this->order_model->get_all_details(PRODUCT,$condition1);
		$Contact_details = $this->order_model->get_all_details(RENTALENQUIRY,array( 'id' => $PaymentSuccess->row()->EnquiryId));
		$RentalPhoto = $this->order_model->get_all_details(PRODUCT_PHOTOS,array('product_id'=>$PaymentSuccess->row()->product_id));
		$total = $Contact_details->row()->totalAmt-$Contact_details->row()->serviceFee;
		
		
		$gcmRegID  = $Renter_details->row()->mobile_key;
		$ios_key  = $Renter_details->row()->ios_key;
		$pushMessage = "Hi ".$Renter_details->row()->firstname.", your guest ".$user_details->row()->firstname." was completed booking for the booking : ".$Contact_details->row()->Bookingno." - ".$Rental_details->row()->product_title;
		if (isset($gcmRegID) && isset($pushMessage)) {		
			$gcmRegIds = array($gcmRegID);
			$message = array("m" => $pushMessage, "k"=>'Your Trips');	
			$pushStatus = $this->sendPushNotificationToAndroid($gcmRegIds, $message);
		}
		if($ios_key != ''){
			$message2 = array('message'=>$pushMessage);
			$this->push_notification($ios_key,$message2);
		}
		
		
		$newsid='34';
		$template_values=$this->order_model->get_newsletter_template_details($newsid);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$proImages=base_url().PRODUCTPATH.$RentalPhoto->row()->product_image;
		$hostImages=base_url().PRODUCTPATH.$Rental_details->row()->image;
		$chkIn = date('d-M-Y',strtotime($Contact_details->row()->checkin));
		$chkOut = date('d-M-Y',strtotime($Contact_details->row()->checkout));
		if($Contact_details->row()->discount_amount != 0.00){
			$discount_amount = CurrencyValue($Rental_details->row()->id,$Contact_details->row()->totalAmt-$Contact_details->row()->discount_amount);
			$netAmount = $Contact_details->row()->discount_amount;
		} else {
			$discount_amount = CurrencyValue($Rental_details->row()->id,$Contact_details->row()->discount_amount);
			$netAmount = CurrencyValue($Rental_details->row()->id,$Contact_details->row()->totalAmt);
		}
		$adminnewstemplateArr=array(
			'email_title'=>$this->config->item('email_title'),
			'logo'=>$this->data['logo'],
			'first_name'=>$user_details->row()->firstname,
			'last_name'=>$user_details->row()->lastname,
			'NoofGuest'=>$Contact_details->row()->NoofGuest,
			'numofdates'=>$Contact_details->row()->numofdates,
			'booking_status'=>$Contact_details->row()->booking_status,
			'user_email'=>$user_details->row()->email,
			'ph_no'=>$user_details->row()->phone_no,
			'Enquiry'=>$Contact_details->row()->Enquiry,
			'checkin'=>$chkIn,
			'checkout'=>$chkOut,
			'price'=>CurrencyValue($Rental_details->row()->id,$Renter_details->row()->price),
			'amount'=>CurrencyValue($Rental_details->row()->id,$total),
			'netamount'=>$netAmount,
			'noofnights'=>$Contact_details->row()->numofdates,
			'serviceFee'=>CurrencyValue($Rental_details->row()->id,$Contact_details->row()->serviceFee),
			'renter_id'=>$PaymentSuccess->row()->sell_id,
			'prd_id'=>$PaymentSuccess->row()->product_id,
			'renter_fname'=>$Renter_details->row()->firstname,
			'renter_lname'=>$Renter_details->row()->lastname,
			'owner_email'=>$Renter_details->row()->email,
			'owner_phone'=>$Renter_details->row()->phone_no,
			'rental_name'=>$Rental_details->row()->product_title,
			'rental_image'=>$proImages,
			'image'=>$hostImages,
			'symbol'=>$this->session->userdata('currency_type'),
			'discount_amount'=>$discount_amount,
			'pro_discount_amount' => AdminCurrencyValue($PaymentSuccess->row()->product_id,$Contact_details->row()->discount_amount),
			'bookingNo'=>$Contact_details->row()->Bookingno
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
		$sender_email=$this->data['siteContactMail'];
		$sender_name=$this->data['siteTitle'];
		$this->order_model->simple_insert(INBOX,array('sender_id'=>$sender_email,'user_id'=>$PaymentSuccess->row()->user_id,'mailsubject'=>$template_values['news_subject'],'description'=>stripslashes($message)));
		$this->session->set_userdata('ContacterEmail',$user_details->row()->email);
		$email_values = array('mail_type'=>'html',
			'from_mail_id'=>$sender_email,
			'mail_name'=>$sender_name,
			'to_mail_id'=>$Renter_email->row()->email,
			'subject_message'=>$template_values['news_subject'],
			'body_messages'=>$message
		);
		//echo stripslashes($message);die;
		$email_send_to_common = $this->order_model->common_email_send($email_values);
	}		
		
	public function mail_owner_admin_booking($got_values){
		$header='';
		$adminnewstemplateArr=array();
		$subject='';
		$cfmurl='';
		$sender_email='';
		$sender_name='';
		$newsid='9';
		$template_values=$this->order_model->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),
			'logo'=> $this->data['logo']
		);
		extract($adminnewstemplateArr);
		extract($got_values);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
		$message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		$message .= '</body>
		</html>';
		if($template_values['sender_name']=='' && $template_values['sender_email']=='')
		{
			$sender_email=$this->data['siteContactMail'];
			$sender_name=$this->data['siteTitle'];
		}
		else
		{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}

		$this->order_model->simple_insert(INBOX,array('sender_id'=>$this->session->userdata('ContacterEmail'),'user_id'=>$sender_email,'mailsubject'=>$template_values['news_subject'],'description'=>stripslashes($message)));
		$email_values2 = array('mail_type'=>'html',
			'from_mail_id'=>$sender_email,
			'mail_name'=>$sender_email,
			'to_mail_id'=>$sender_email,
			'subject_message'=>$template_values['news_subject'],
			'body_messages'=>$message
		);
		$email_send_to_common1 = $this->order_model->common_email_send($email_values2);
		if($got_values['renter_id'] > 0){
			$UserDetails = $this->user_model->get_all_details(USERS,array('id'=>$got_values['renter_id']));
			$emailid=$UserDetails->row()->email;
			$this->order_model->simple_insert(INBOX,array('sender_id'=>$this->session->userdata('ContacterEmail'),'user_id'=>$emailid,'mailsubject'=>$template_values['news_subject'],'description'=>stripslashes($message)));
			$email_values = array('mail_type'=>'html',
				'from_mail_id'=>$sender_email,
				'mail_name'=>$sender_name,
				'to_mail_id'=>$emailid,
				'subject_message'=>$template_values['news_subject'],
				'body_messages'=>$message
			);
			$this->session->unset_userdata('ContacterEmail');
			$email_send_to_common = $this->order_model->common_email_send($email_values);
		}
	}
	
	public function ipnpayment(){
		mysql_query('CREATE TABLE IF NOT EXISTS '.TRANSACTIONS.' ( `id` int(255) NOT NULL AUTO_INCREMENT,`payment_cycle` varchar(500) NOT NULL,`txn_type` varchar(500) NOT NULL, `last_name` varchar(500) NOT NULL,`next_payment_date` varchar(500) NOT NULL, `residence_country` varchar(500) NOT NULL, `initial_payment_amount` varchar(500) NOT NULL, `currency_code` varchar(500) NOT NULL, `time_created` varchar(500) NOT NULL, `verify_sign` varchar(750) NOT NULL, `period_type` varchar(500) NOT NULL, `payer_status` varchar(500) NOT NULL, `test_ipn` varchar(500) NOT NULL, `tax` varchar(500) NOT NULL, `payer_email` varchar(500) NOT NULL, `first_name` varchar(500) NOT NULL, `receiver_email` varchar(500) NOT NULL, `payer_id` varchar(500) NOT NULL, `product_type` varchar(500) NOT NULL, `shipping` varchar(500) NOT NULL, `amount_per_cycle` varchar(500) NOT NULL, `profile_status` varchar(500) NOT NULL, `charset` varchar(500) NOT NULL, `notify_version` varchar(500) NOT NULL, `amount` varchar(500) NOT NULL, `outstanding_balance` varchar(500) NOT NULL, `recurring_payment_id` varchar(500) NOT NULL, `product_name` varchar(500) NOT NULL,`custom_values` varchar(500) NOT NULL, `ipn_track_id` varchar(500) NOT NULL, `tran_date` datetime NOT NULL, PRIMARY KEY (`id`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;');

		mysql_query("insert into ".TRANSACTIONS." set  payment_cycle='".$_REQUEST['payment_cycle']."', txn_type='".$_REQUEST['txn_type']."', last_name='".$_REQUEST['last_name']."',next_payment_date='".$_REQUEST['next_payment_date']."', residence_country='".$_REQUEST['residence_country']."', initial_payment_amount='".$_REQUEST['initial_payment_amount']."',currency_code='".$_REQUEST['currency_code']."', time_created='".$_REQUEST['time_created']."', verify_sign='".$_REQUEST['verify_sign']."', period_type= '".$_REQUEST['period_type']."', payer_status='".$_REQUEST['payer_status']."', test_ipn='".$_REQUEST['test_ipn']."', tax='".$_REQUEST['tax']."', payer_email='".$_REQUEST['payer_email']."', first_name='".$_REQUEST['first_name']."', receiver_email='".$_REQUEST['receiver_email']."', payer_id='".$_REQUEST['payer_id']."', product_type='".$_REQUEST['product_type']."', shipping='".$_REQUEST['shipping']."', amount_per_cycle='".$_REQUEST['amount_per_cycle']."', profile_status='".$_REQUEST['profile_status']."', charset='".$_REQUEST['charset']."',notify_version='".$_REQUEST['notify_version']."', amount='".$_REQUEST['amount']."', outstanding_balance='".$_REQUEST['payment_status']."', recurring_payment_id='".$_REQUEST['txn_id']."', product_name='".$_REQUEST['product_name']."', custom_values ='".$_REQUEST['custom']."', ipn_track_id='".$_REQUEST['ipn_track_id']."', tran_date=NOW()");


		$this->data['heading'] = 'Order Confirmation'; 

		if($_REQUEST['payment_status'] == 'Completed'){
			$newcustom = explode('|',$_REQUEST['custom']);
	
			if($newcustom[0]=='Product'){
				$userdata = array('fc_session_user_id' => $newcustom[1],'randomNo' => $newcustom[2]);
				$this->session->set_userdata($userdata);	
				$transId = $_REQUEST['txn_id'];
				$Pray_Email = $_REQUEST['payer_email'];
				$this->data['Confirmation'] = $this->order_model->PaymentSuccess($newcustom[1],$newcustom[2],$transId,$Pray_Email);	
				//$userdata = array('fc_session_user_id' => $newcustom[1],'randomNo' => $newcustom[2]);
				$this->session->unset_userdata($userdata);
			}elseif($newcustom[0]=='Gift'){
				$userdata = array('fc_session_user_id' => $newcustom[1]);
				$this->session->set_userdata($userdata);
				$transId = $_REQUEST['txn_id'];
				$Pray_Email = $_REQUEST['payer_email'];
				$this->data['Confirmation'] = $this->order_model->PaymentGiftSuccess($newcustom[1],$transId,$Pray_Email);	
				//$userdata = array('fc_session_user_id' => $newcustom[1]);
				$this->session->unset_userdata($userdata);
			}

		}	
			
	}
	
	
	public function insert_product_comment(){
	 			$uid= $this->checkLogin('U');
				$returnStr['status_code'] = 0;
				$comments = $this->input->post('comments');
				$product_id = $this->input->post('cproduct_id');
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time();
				$conditionArr = array('comments'=>$comments,'user_id'=>$uid,'product_id'=>$product_id,'status'=>'InActive','dateAdded'=>mdate($datestring,$time));
				$this->order_model->simple_insert(PRODUCT_COMMENTS,$conditionArr);
				$cmtID = $this->order_model->get_last_insert_id();
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time();
				$createdTime = mdate($datestring,$time);
				$actArr = array(
					'activity'		=>	'own-product-comment',
					'activity_id'	=>	$product_id,
					'user_id'		=>	$this->checkLogin('U'),
					'activity_ip'	=>	$this->input->ip_address(),
					'created'		=>	$createdTime,
					'comment_id'	=> $cmtID
				);
				$this->order_model->simple_insert(NOTIFICATIONS,$actArr);
				$this->send_comment_noty_mail($cmtID,$product_id);
				$returnStr['status_code'] = 1;
				echo json_encode($returnStr);
	}
	
	public function send_comment_noty_mail($cmtID='0',$pid='0'){
		if ($this->checkLogin('U')!=''){
			if ($cmtID != '0' && $pid != '0'){
				$productUserDetails = $this->product_model->get_product_full_details($pid);
				if ($productUserDetails->num_rows()==1){
					$emailNoty = explode(',', $productUserDetails->row()->email_notifications);
					if (in_array('comments', $emailNoty)){
						$commentDetails = $this->product_model->view_product_comments_details('where c.id='.$cmtID);
						if ($commentDetails->num_rows() == 1){
							if ($productUserDetails->prodmode == 'seller'){
								$prodLink = base_url().'things/'.$productUserDetails->row()->id.'/'.url_title($productUserDetails->row()->product_name,'-');
							}else {
								$prodLink = base_url().'user/'.$productUserDetails->row()->user_name.'/things/'.$productUserDetails->row()->seller_product_id.'/'.url_title($productUserDetails->row()->product_name,'-');
							}
							
							$newsid='1';
							$template_values=$this->order_model->get_newsletter_template_details($newsid);
							$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'full_name'=>$commentDetails->row()->full_name,'product_name'=>$productUserDetails->row()->product_name,'user_name'=>$commentDetails->row()->user_name);
							extract($adminnewstemplateArr);
							$subject = $this->config->item('email_title').' - '.$template_values['news_subject'];
							
							$message .= '<!DOCTYPE HTML>
								<html>
								<head>
								<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
								<meta name="viewport" content="width=device-width"/>
								<title>'.$template_values['news_subject'].'</title>
								<body>';
							include('./newsletter/registeration'.$newsid.'.php');	
							
							$message .= '</body>
								</html>';
							
							$sender_email=$this->data['siteContactMail'];
							$sender_name=$this->data['siteTitle'];
							
							//add inbox from mail 
							$this->order_model->simple_insert(INBOX,array('user_id'=>$productUserDetails->row()->email,'sender_id'=>$sender_email,'mailsubject'=>$subject,'description'=>stripslashes($message)));
							
							$email_values = array('mail_type'=>'html',
												'from_mail_id'=>$sender_email,
												'mail_name'=>$sender_name,
												'to_mail_id'=>$productUserDetails->row()->email,
												'subject_message'=>$subject,
												'body_messages'=>$message
												);
							$email_send_to_common = $this->product_model->common_email_send($email_values);
						}
					}
				}
			}
		}
	}
	
	public function getDatesFromRange($start, $end){
    	$dates = array($start);
    	while(end($dates) < $end){
        	$dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
    	}
		return $dates;
	}	
	
}  /* Controller end */

