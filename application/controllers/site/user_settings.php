<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User Settings related functions
 * @author dev Beetrut
 *
 */

class User_settings extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation','pagination'));		
		$this->load->model('user_model');
		$this->load->model('review_model');
		$this->load->model('cms_model');
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->user_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];
		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->user_model->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];
		$this->data['loginCheck'] = $this->checkLogin('U');
    }
    
    public function index(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url());
    	}else {
	    	$this->data['heading'] = 'Dashboard';
			$user_id_verified_query='SELECT * FROM '.REQUIREMENTS.' WHERE user_id='.$this->checkLogin('U');
			$condition = array('receiver_id' => $this->checkLogin('U'), 'msg_read'=> 'no');
			$this->data['dashboardinbox'] = $this->user_model->get_all_details(DISCUSSION,$condition);
			$this->data['user_verified_status']=$this->user_model->ExecuteQuery($user_id_verified_query);
			$this->load->view('site/user/dashboard',$this->data);
    	}
    }
	
	public function inbox(){
		if ($this->checkLogin('U') != ''){
			$this->data['med_messages'] = $this->cms_model->get_med_messages($this->checkLogin ( 'U' ));
			//$this->data['med_messages1'] = $this->cms_model->get_med_messages1($this->checkLogin ( 'U' ));
			$this->load->view ( 'site/user/dashboard-med-message', $this->data );
		} else{
			redirect();
		}
	}
	
	public function conversation()
	{
		$bookingNo = $this->uri->segment ( 2, 0 );
		$this->data['bookingNo'] = $bookingNo;
		$this->data['userId'] = $this->checkLogin ( 'U' );
		if($this->checkLogin ( 'U' ) != '' && $bookingNo != '')
		{
			$this->data['specialOfferCheck'] = $this->user_model->get_all_details ( MED_MESSAGE, array ('bookingNo' => $bookingNo, 'point' => '2', 'offer_accept' => 'Pending'));
			$this->data['specialOfferCheck'] = $this->data['specialOfferCheck']->num_rows();
			$this->data['conversationDetails'] = $this->user_model->get_all_details ( MED_MESSAGE, array ('bookingNo' => $bookingNo ),array(array('field'=>'id', 'type'=>'desc')));
			$this->user_model->update_details(MED_MESSAGE,array('msg_read' => 'Yes'),array('receiverId'=>$this->checkLogin( 'U' ),'bookingNo'=> $bookingNo) );
			$this->data['unread_messages_count'] = $this->user_model->get_unread_messages_count($this->checkLogin('U'));
			$this->data['bookingDetails'] = $this->user_model->get_booking_details($bookingNo);
			$temp[] = $this->data['conversationDetails']->row()->senderId;
			$temp[] = $this->data['conversationDetails']->row()->receiverId;
			$productId = $this->data['productId'] = $this->data['conversationDetails']->row()->productId;
			if(!in_array($this->checkLogin ( 'U' ), $temp))redirect();
			if($this->checkLogin ( 'U' ) == $temp[0])
			{
				$this->data['sender_id'] = $temp[0];
				$this->data['receiver_id'] = $temp[1];
			}
			else
			{
				$this->data['sender_id'] = $temp[1];
				$this->data['receiver_id'] = $temp[0];
			}
			$this->data['senderDetails'] = $this->user_model->get_all_details ( USERS, array ('id' => $this->data['sender_id'] ));
			$this->data['receiverDetails'] = $this->user_model->get_all_details ( USERS, array ('id' => $this->data['receiver_id'] ));
			$this->data['verifiedDetails'] = $this->user_model->get_all_details ( REQUIREMENTS, array ('user_id' => $this->data['receiver_id'] ));
			$reviewCount = $this->user_model->get_all_details ( REVIEW, array ('user_id' => $this->data['receiver_id'] ));
			$this->data['reviewCount'] = $reviewCount->num_rows();
			$this->data['productDetails'] = $this->user_model->get_all_details ( PRODUCT, array ('id' => $productId));
			$this->data['bookingNo'] = $bookingNo;
			$this->data['bookingDetailsSpl'] = $this->product_model->get_pre_approve_booking($bookingNo);
			$specialCheckin = date('m/d/Y', strtotime($this->data['bookingDetailsSpl']->row()->checkin));
			$specialCheckout = date('m/d/Y', strtotime($this->data['bookingDetailsSpl']->row()->checkout));
			$specialNoofGuest = $this->data['bookingDetailsSpl']->row()->NoofGuest;
			$specialDates = array('specialCheckin' => $specialCheckin, 'specialCheckout' => $specialCheckout , 'specialNoofGuest' => $specialNoofGuest );
			$this->session->set_userdata($specialDates);
			$this->data['products'] = $this->product_model->get_all_details(PRODUCT, array('user_id'=>$this->checkLogin ( 'U' ), 'status'=>'Publish'));
			/*-Muthu-*/
			$this->data['CalendarBooking'] = $this->product_model->get_all_details(CALENDARBOOKING,array('PropId'=>$productId));
			if($this->data['CalendarBooking']->num_rows() > 0){
				foreach($this->data['CalendarBooking']->result()  as $CRow){
					$DisableCalDate .='"'.$CRow->the_date.'",';
				}
				$this->data['forbiddenCheckIn']='['.$DisableCalDate.']';
			}else{
				$this->data['forbiddenCheckIn']='[]';
				$this->data['forbiddenCheckOut']='[]';
			}
			$all_dates = array();
			$selected_dates = array();
			foreach($this->data['CalendarBooking']->result()  as $date){
				$all_dates[] = trim($date->the_date);
				$date1 = new DateTime(trim($date->the_date));
				$date2 = new DateTime($prev);
				$diff = $date2->diff($date1)->format("%a");
				if($diff == '1'){
					$selected_dates[] = trim($date->the_date);
				}
				$prev = trim($date->the_date);
				$DisableCalDate = '';
				foreach($all_dates as $CRow){
					$DisableCalDate .= '"'.$CRow.'",';
				}
				$this->data['forbiddenCheckIn']='['.$DisableCalDate.']';
				$DisableCalDate = '';
				foreach($selected_dates as $CRow){
					$DisableCalDate .= '"'.$CRow.'",';
				}
				$this->data['forbiddenCheckOut']='['.$DisableCalDate.']';
			}
			$this->data['forbiddenCheckIn']='[]';
			$this->data['forbiddenCheckOut']='[]';
			$this->load->view ( 'site/user/host_conversation', $this->data );
		} else {
			redirect();
		}
	}
	
	public function dashboard_listing() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			if($this->uri->segment(3)=='completed'){
				$this->data ['enable_complete_popup']='yes';
			}
			$status = $this->uri->segment ( 2, 0 );
			$this->data ['heading'] = 'Dashboard-Listing';
			if ($status == 'all') {
				$sortArr1 = array (
					'field' => 'id',
					'type' => 'desc'
				);
				$sortArr = array (
					$sortArr1
				);
				$this->data ['rentalDetail'] = $this->cms_model->get_dashboard_list ( $this->checkLogin ( 'U' ) );
			} else if ($status == 'UnPublish') {
				$sortArr1 = array (
						'field' => 'id',
						'type' => 'desc'
				);
				$sortArr = array (
						$sortArr1
				);
				$this->data ['rentalDetail'] = $this->cms_model->get_dashboard_list ( $this->checkLogin ( 'U' ), $status );
			} else if ($status == 'Publish') {
				$sortArr1 = array (
						'field' => 'id',
						'type' => 'desc'
				);
				$sortArr = array (
						$sortArr1
				);
				$this->data ['rentalDetail'] = $this->cms_model->get_dashboard_list ( $this->checkLogin ( 'U' ), $status );
			} else {
				$sortArr1 = array (
						'field' => 'id',
						'type' => 'desc'
				);
				$sortArr = array (
						$sortArr1
				);
				$this->data ['rentalDetail'] = $this->cms_model->get_dashboard_list ( $this->checkLogin ( 'U' ) );
			}
			foreach($this->data ['rentalDetail']->result() as $res){
				$rentalDetailArr[] = $res;
			}
			
			foreach($rentalDetailArr as $key => $list)
			{
				$result = $this->cms_model->get_all_details ( PRODUCT_PHOTOS, array ('product_id' => $list->id), array(array('field'=>'cover', 'type'=>'desc')));
				if($result->num_rows() > 0){
					$rentalDetailArr[$key]->product_image = $result->row()->product_image;
					$rentalDetailArr[$key]->cover = $result->row()->cover;
				}else {
					$rentalDetailArr[$key]->product_image = '';
					$rentalDetailArr[$key]->cover = '';
				}
			}
			$this->data['rentalDetail'] = $rentalDetailArr;
			
			
			$hosting_commission_status='SELECT * FROM '.COMMISSION.' WHERE seo_tag="host-listing" ';
			$temp=$this->cms_model->ExecuteQuery($hosting_commission_status);
			$this->data ['hosting_commission_status'] = $temp->row()->status;
			
			$this->load->view ( 'site/user/dashboard-listing', $this->data );
		}
	}
	
	public function dashboard_listing_reservation() {
		if ($this->checkLogin ( 'U' ) == '')
			redirect ( base_url () );
		else {
			$this->data ['heading'] = 'Dashboard-Listing Reservation';
			$this->data ['bookedRental'] = $this->cms_model->booked_rental ( $this->checkLogin ( 'U' ) );
			$this->load->view ( 'site/user/dashboard-listing-reservation', $this->data );
		}
	}
	
	public function dashboard_listing_requirement() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			$this->data ['heading'] = 'Dashboard-Listing Requirement';
			$this->data ['userDetail'] = $this->cms_model->get_all_details ( USERS, array (
					'id' => $this->checkLogin ( 'U' )
			) );
			$this->data ['RequestDetail'] = $this->cms_model->get_all_details ( REQUIREMENTS, array (
					'user_id' => $this->checkLogin ( 'U' )
			) );

			//echo $this->db->last_query();die;
			$this->load->view ( 'site/user/dashboard-listing-res-reqmt', $this->data );
		}
	}
	
	public function dashboard_trips() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			$keyword = "";
			if ($_POST) {
				$keyword = $this->input->post ('product_title');
			}
            $this->load->model('admin_model');
			$this->data['heading'] = 'Dashboard-Trips';
			$this->data['bookedRental'] = $this->cms_model->booked_rental_trip( $this->checkLogin ('U'), $keyword);
			$this->data['user_id'] = $this->checkLogin('U');
			$this->load->view ('site/user/dashboard-trips', $this->data);
		}
	}
	
	public function dashboard_trips_prve() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			if ($_POST) {
				$product_title = $this->input->post ( 'product_title' );
			}
			$this->data ['heading'] = 'Dashboard-Trips previous';
			$this->data ['bookedRental'] = $this->cms_model->booked_rental_trip_prev ( $this->checkLogin ( 'U' ), $product_title );
			$this->data['user_id'] = $this->checkLogin('U');
			$this->load->view ( 'site/user/dashboard-trips-prev', $this->data );
		}
	}
	
	public function display_user_settings(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url());
    	}else {
	    	$this->data['heading'] = 'Settings';
			$country_query='SELECT id,name FROM '.LOCATIONS.' WHERE status="Active" order by name';
			$this->data['active_countries']=$this->user_model->ExecuteQuery($country_query);
			$user_verified_query='SELECT * FROM '.REQUIREMENTS.' WHERE user_id='.$this->checkLogin('U');
			$this->data['user_verified_status']=$this->user_model->ExecuteQuery($user_verified_query);
			$languages_known_query='SELECT * FROM '.LANGUAGES_KNOWN;
			$langues_known_lang='SELECT * FROM '.USERS;
			$this->data['languages_known']=$this->user_model->ExecuteQuery($languages_known_query,$langues_known_lang);
    		$this->load->view('site/user/settings',$this->data);
    	}
    }
    
	public function display_review(){
		if($this->data['loginCheck'] !=''){
			$this->data['ReviewDetails']=$this->review_model->get_productreview_aboutyou($this->data['loginCheck']);
			$this->data['uId']=$this->data['loginCheck'];
			$this->load->view('site/user/review',$this->data);
		}
		else{
			redirect(base_url());
		}
	}
	
	public function display_review1(){
		if($this->data['loginCheck'] !=''){
		$this->data['ReviewDetails']=$this->review_model->get_productreview_byyou($this->data['loginCheck']);
		$this->data['uId']=$this->data['loginCheck'];
		$this->load->view('site/user/reviewbyyou',$this->data);
		}else{
		redirect(base_url());
		}
	}
	
	public function dashboard_account() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			$this->data ['heading'] = 'Dashboard-Account';
			$this->data ['Details'] = $this->cms_model->get_all_details ( USERS, array (
					'id' => $this->checkLogin ( 'U' )
			) );
			$this->load->view ( 'site/user/dashboard-account', $this->data );
		}
	}
	
	public function dashboard_account_payout() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			$this->data ['userpay'] = $this->cms_model->get_all_details ( USERS, array (
					'id' => $this->checkLogin ( 'U' )
			) );
			$this->data ['heading'] = 'Dashboard-Account payout';
			$country_query = 'SELECT id,name FROM ' . LOCATIONS . ' WHERE status="Active" order by name';
			$this->data ['active_countries'] = $this->cms_model->ExecuteQuery ( $country_query );

			$this->load->view ( 'site/user/dashboard-account-payout', $this->data );
		}
	}
	
	public function dashboard_account_trans() {
		if ($this->checkLogin ( 'U' ) == '')
			redirect ( base_url () );
		else {
			$emailQry = $this->cms_model->get_all_details(USERS, array('id' => $this->checkLogin ( 'U' )));
			$email = $emailQry->row()->email;
			$host_id = $this->checkLogin ( 'U' );
			$this->data['featured_transaction'] = $this->cms_model->get_featured_transaction($host_id);
			$this->data['completed_transaction'] = $this->cms_model->get_completed_transaction($host_id);
			$this->load->view ( 'site/user/dashboard-account-transaction', $this->data );
		}
	}
	
	public function dashboard_account_privacy() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			$this->data ['heading'] = 'Dashboard-Account privacy';
			$this->data ['userDetails'] = $this->cms_model->get_all_details ( USERS, array (
					'id' => $this->checkLogin ( 'U' )
			) );
			$this->load->view ( 'site/user/dashboard-account-privacy', $this->data );
		}
	}
	
	public function dashboard_account_setting() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {

			if ($_POST) {
				$dataArr = array (
						'country' => $this->input->post ( 'country' )
				);
				$this->cms_model->commonInsertUpdate ( USERS, 'update', array (), $dataArr, array (
						'id' => $this->checkLogin ( 'U' )
				) );
				$this->setErrorMessage ( 'success', 'Country Updated successfully.' );
				redirect ( 'account-setting' );
			}

			$this->data ['heading'] = 'Country of Residence';
			$this->data ['countries'] = $this->cms_model->get_countries();
			$this->load->view ( 'site/user/dashboard-account-settings', $this->data );
		}
	}
	
	public function dashboard_account_security() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			$this->data ['heading'] = 'Dashboard-Account Security';
			$this->load->view ( 'site/user/dashboard-account-security', $this->data );
		}
	}
	
	public function user_edit($id){
		if ($this->checkLogin('U')=='')
		{
			redirect(base_url());
		}
		else
		{
			$condition = array('id' => $id);
			$this->data['UserDetail'] = $this->user_model->get_all_details(USERS,$condition);
			$this->data['heading'] = 'Profile';
			$this->load->view('site/user/profile',$this->data);
		}
	}
	
	public function delete_inquiry_details(){
		$id = $this->uri->segment(4);
		$this->setErrorMessage('success','Message deleted successfully!');
		$this->db->where('id', $id)->delete(DISCUSSION);
		redirect('inbox');
	}
	
	public function delete_conversation_details(){
		$id = $this->uri->segment(4);
		$this->db->where('convId', $id)->delete(DISCUSSION);
		$this->setErrorMessage('success','Message deleted successfully!');
		redirect('inbox');
	}
	public function view_inquiry_details(){
	
		//view_product_details1
        $id = $this->uri->segment(4);
		
		$pageDetails = $this->product_model->get_all_details(DISCUSSION,array('id'=>$id));
		//echo $pageDetails->row()->rental_id;die;
		$productDetails=$this->product_model->view_product_details1("where p.id=".$pageDetails->row()->rental_id);
		
		//$productDetails=$this->product_model->get_all_details(PRODUCT,array('id'=>$pageDetails->row()->rental_id));
		$hostDetails=$this->product_model->get_all_details(USERS,array('id'=>$productDetails->row()->user_id));
		$senderDetails=$this->product_model->get_all_details(USERS,array('id'=>$pageDetails->row()->sender_id));
		$receiverDetails=$this->product_model->get_all_details(USERS,array('id'=>$pageDetails->row()->receiver_id)); 
    	if ($pageDetails->num_rows() == 0){
    		show_404();
    	}else {
    		
    		$this->data['heading'] = 'View Inquiry Details'; 
    		$this->data['pageDetails'] = $pageDetails;
			$this->data['productDetails'] = $productDetails;
			$this->data['hostDetails'] = $hostDetails;
		    $this->data['senderDetails'] = $senderDetails; 
			$this->data['receiverDetails'] = $receiverDetails;
			$this->data['UserId'] = $this->checkLogin('U');
			
            $this->load->view('site/cms/display_inquiry',$this->data);
    	}
	}
	
	public function view_conversation_details(){
	
		//view_product_details1
		//echo $this->checkLogin('U');die;
        $id = $this->uri->segment(4);
		
		$pageDetails = $this->product_model->get_all_details(DISCUSSION,array('convId'=>$id));
		//echo $pageDetails->row()->rental_id;die;
		$productDetails=$this->product_model->view_product_details1("where p.id=".$pageDetails->row()->rental_id);
		
		//$productDetails=$this->product_model->get_all_details(PRODUCT,array('id'=>$pageDetails->row()->rental_id));
		$hostDetails=$this->product_model->get_all_details(USERS,array('id'=>$productDetails->row()->user_id));
		$senderDetails=$this->product_model->get_all_details(USERS,array('id'=>$pageDetails->row()->sender_id));
		$receiverDetails=$this->product_model->get_all_details(USERS,array('id'=>$pageDetails->row()->receiver_id)); 
    	if ($pageDetails->num_rows() == 0){
    		show_404();
    	}else {
    		
    		$this->data['heading'] = 'View Conversation Details'; 
    		$this->data['pageDetails'] = $pageDetails;
			$this->data['productDetails'] = $productDetails;
			$this->data['hostDetails'] = $hostDetails;
		    $this->data['senderDetails'] = $senderDetails; 
			$this->data['receiverDetails'] = $receiverDetails;
			$this->data['UserId'] = $this->checkLogin('U');
			
            $this->load->view('site/cms/display_conversation',$this->data);
    	}
	}
	
    public function update_profile(){
    	$inputArr = array();
    	$response['success'] = '0';
    	if ($this->checkLogin('U') == ''){
    		$response['msg'] = 'You must login';
    	}else {
	    	$update = '0';
	    	$email = $this->input->post('email');
	    	if ($email!=''){
	    		if (valid_email($email)){
	    			$condition = array('email'=>$email,'id !='=>$this->checkLogin('U'));
	    			$duplicateMail = $this->user_model->get_all_details(USERS,$condition);
	    			if ($duplicateMail->num_rows()>0){
						$response['msg'] = 'Email already exists';
	    			}else {
	    				$inputArr['email'] = $email;
	    				$update = '1';
	    			}
	    		}else {
	    			$response['msg'] = 'Invalid email';
	    		}
	    	}else {
	    		$update = '1';
	    	}
	    	if ($update == '1'){
	    		$birthday = $this->input->post('b_year').'-'.$this->input->post('b_month').'-'.$this->input->post('b_day');
	    		$excludeArr = array('b_year','b_month','b_day','email');
	    		$inputArr['birthday'] = $birthday;
	    		$condition = array('id'=>$this->checkLogin('U'));
	    		$this->user_model->commonInsertUpdate(USERS,'update',$excludeArr,$inputArr,$condition);
	    		$this->setErrorMessage('success','Done ! Your profile looks even better now');
	    		$response['success'] = '1';
	    	}
    	}
	    echo json_encode($response);
    }
    
    public function changePhoto(){
		
		
		
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
            $config['overwrite'] = FALSE;
	    	$config['remove_spaces'] = TRUE;
	    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
	    	$config['max_size'] = 2000;
	    	$config['max_width']  = '1600';
			$config['max_height']  = '1600';
	    	$config['upload_path'] = './images/users';
	    	$this->load->library('upload', $config);
	    	if ( $this->upload->do_upload('upload-file')){
				$imgDetailsd = $this->upload->data();
				
	    		//$dataArr['image'] = $imgDetails['file_name'];
	    		$imgDetails = array('image'=>$imgDetailsd['file_name']);
	    	}else{
				$imgDetails = array();
			}	//$dataArr['image'] = $imgDetails['file_name'];
				$dob_date = $this->input->post('dob_date');
				$dob_month = $this->input->post('dob_month');
				$dob_year = $this->input->post('dob_year');
				
				$dob = $dob_year.'-'.$dob_month.'-'.$dob_date;
				$dataArr = array(
				'firstname'=>strip_tags($this->input->post('firstname')),
				'gender'=>strip_tags($this->input->post('gender')),
				'lastname'=>strip_tags($this->input->post('lastname')),
				'email'=>strip_tags($this->input->post('email')),
				'phone_no'=>strip_tags($this->input->post('phone_no')),
				'ph_country'=>strip_tags($this->input->post('phone_country')),
				'description'=>strip_tags($this->input->post('description')),
				'dob_month'=>strip_tags($this->input->post('dob_month')),
				'dob_date'=>strip_tags($this->input->post('dob_date')),
				'dob_year'=>strip_tags($this->input->post('dob_year')),
				'school'=>strip_tags($this->input->post('school')),
				'birthday'=>strip_tags($dob),
				'work'=>strip_tags($this->input->post('work')),
				'timezone'=>strip_tags($this->input->post('timezone')),
				'emergency_name'=>strip_tags($this->input->post('emergency_name')),
				'emergency_phone'=>strip_tags($this->input->post('emergency_phone')),
				'emergency_email'=>strip_tags($this->input->post('emergency_email')),	
				's_city'=>strip_tags($this->input->post('s_city')),
				'emergency_relationship'=>strip_tags($this->input->post('emergency_relationship'))
				
			 );	
			// echo'<pre>';print_r($dataArr);exit;
			 //print_r($dataArr);die;
				$condition = array('id'=>$this->checkLogin('U'));
				$dataArrMrg=array_merge($dataArr,$imgDetails);
	    		$this->user_model->update_details(USERS,$dataArrMrg,$condition);
				//echo $this->db->last_query();die;
			//die;
			$this->setErrorMessage('success','User Profile Information Updated successfully.');
	    	redirect(base_url().'settings');
    	}
    }
    
    public function delete_user_photo(){
    	$response['success'] = '0';
    	if ($this->checkLogin('U')==''){
    		$response['msg'] = 'You must login';
    	}else {
    		$condition = array('id'=>$this->checkLogin('U'));
    		$dataArr = array('image'=>'');
    		$this->user_model->update_details(USERS,$dataArr,$condition);
    		$this->setErrorMessage('success','Profile photo deleted successfully');
    		$response['success'] = '1';
    	}
    	echo json_encode($response);
    }
    
    public function delete_user_account(){
    	if ($this->checkLogin('U')!=''){
    		$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time();
			$newdata = array(
	               'last_logout_date' => mdate($datestring,$time),
				   'status'=>'Inactive'
			);
			$condition = array('id' => $this->checkLogin('U'));
			$this->user_model->update_details(USERS,$newdata,$condition);
			$userdata = array(
							'fc_session_user_id'=>'',
							'session_user_name'=>'',
							'session_user_email'=>'',
							'fc_session_temp_id'=>''
						);
			$this->session->set_userdata($userdata);
    		$this->setErrorMessage('success','Your account inactivated successfully');
    	}
    }
    
    public function password_settings(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
	    	$this->data['heading'] = 'Password Settings';
    		$this->load->view('site/user/changepassword',$this->data);
    	}
    }
    
    public function change_user_password(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$pwd = $this->input->post('pass');
    		$cfmpwd = $this->input->post('confirmpass');
    		if ($pwd != '' && $cfmpwd != '' && strlen($pwd) > 5){
    			if ($pwd == $cfmpwd){
    				$dataArr = array('password'=>md5($pwd));
    				$condition = array('id'=>$this->checkLogin('U'));
    				$this->user_model->update_details(USERS,$dataArr,$condition);
    				$this->setErrorMessage('success','Password changed successfully');
    			}else {
    				$this->setErrorMessage('error','Passwords does not match');
    			}
    		}else {
    			$this->setErrorMessage('error','Password and Confirm password fields required');
    		}
    		redirect(base_url().'settings/password');
    	}
    }
    
    public function preferences_settings(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
	    	$this->data['heading'] = 'Preference Settings';
	    	$this->data['languages'] = $this->user_model->get_all_details(LANGUAGES,array());
    		$this->load->view('site/user/change_preferences',$this->data);
    	}
    }
    
    public function update_preferences(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->user_model->commonInsertUpdate(USERS,'update',array(),array(),array('id'=>$this->checkLogin('U')));
    		$this->setErrorMessage('success','Preferences saved successfully');
    		redirect(base_url().'settings/preferences');
    	}
    }
    
	public function notifications_settings(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
	    	$this->data['heading'] = 'Notifications Settings';
	    	$this->data['languages'] = $this->user_model->get_all_details(LANGUAGES,array());
    		$this->load->view('site/user/change_notifications',$this->data);
    	}
    }
    
    public function update_notifications(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
	    	$emailArr = $this->data['emailArr'];
	    	$notyArr = $this->data['notyArr'];
	    	$emailStr = '';
	    	$notyStr = '';
	    	foreach ($this->input->post() as $key=>$val){
	    		if (in_array($key, $emailArr)){
	    			$emailStr .= $key.',';
	    		}else if (in_array($key, $notyArr)){
	    			$notyStr .= $key.',';
	    		}
	    	}
	    	$updates = $this->input->post('updates');
	    	$updates = ($updates == '')?'0':'1';
	    	$emailStr = substr($emailStr, 0,strlen($emailStr)-1);
	    	$notyStr = substr($notyStr, 0,strlen($notyStr)-1);
	    	$dataArr = array(
	    		'email_notifications'	=>	$emailStr,
	    		'notifications'			=>	$notyStr,
	    		'updates'				=>	$updates
	    	);
	    	$condition = array('id'=>$this->checkLogin('U'));
	    	$this->user_model->update_details(USERS,$dataArr,$condition);
	    	$this->setErrorMessage('success','Notifications settings saved successfully');
	    	redirect(base_url().'settings/notifications');
    	}
    }
    
    public function user_profile() {
		$userid =  $this->uri->segment(3);
		if(!is_numeric($userid)){
			show_404();
		}else{
			$condition = array('id'=>$userid);
			$this->data['user_Details'] = $this->user_model->get_all_details(USERS,$condition);
			$phone_number_verified_query='SELECT * FROM '.REQUIREMENTS.' WHERE user_id='.$userid;
			$this->data['phone_number_verified']=$this->review_model->get_phone_number_verified($userid);
			$this->data['ReviewDetails']=$this->review_model->get_yourproductreview_details($userid);
			$this->data ['rentalDetail'] = $this->cms_model->get_dashboard_list ( $userid,Publish);
			$this->data['languages']=$this->cms_model->get_all_details(LANGUAGES_KNOWN,array());
			$this->data['verifyid']=$this->cms_model->get_all_details(USERS,array('id'=>$userid));
			$this->data['user_id']=$userid;
			$this->data['login_user']=$this->checkLogin('U');
			$this->data['WishListCat'] = $this->product_model->get_list_details_wishlist($userid);
			//echo '<pre>'; print_r($this->data['WishListCat']->result()); die;
			$this->load->view('site/user/display_user_profile',$this->data);
		}
	}
	
    public function change_photo(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
	    	$config['overwrite'] = FALSE;
	    	$config['remove_spaces'] = TRUE;
	    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
	    	$config['max_size'] = 2000;
	    	$config['max_width']  = '600';
			$config['max_height']  = '600';
	    	$config['upload_path'] = './images/users';
	    	$this->load->library('upload', $config);
	    	if ( $this->upload->do_upload('upload-file')){
	    		$imgDetails = $this->upload->data();
	    		$dataArr['image'] = $imgDetails['file_name'];
	    		$condition = array('id'=>$this->checkLogin('U'));
	    		$this->user_model->update_details(USERS,$dataArr,$condition);
	    		redirect('image-crop/'.$this->checkLogin('U'));
	    	}else {
	    		$this->setErrorMessage('error',strip_tags($this->upload->display_errors()));
	    	}
	    	echo "<script>window.history.go(-1);</script>";
    	}
    }
	
	public function update_languages()
	{
		$excludeArr = array('languages','languages_known');
		$inputArr['languages_known'] = implode(',',$this->input->post('languages_known'));
		$condition = array('id'=>$this->checkLogin('U'));
		$this->user_model->commonInsertUpdate(USERS,'update',$excludeArr,$inputArr,$condition);
		$this->db->select('*');
		$this->db->from(LANGUAGES_KNOWN);
		$this->db->where_in('language_code', $this->input->post('languages_known'));
		$languages = $this->db->get();
		foreach($languages->result() as $lang)
		{
			$returnStr['value'].= "<li id='".$lang->language_code."'>".$lang->language_name."<small><a class='text-normal' href='javascript:void(0);' onclick=delete_languages(this,'".$lang->language_code."')>x</a></small></li>";
		}
		$languages_known_query='SELECT languages_known FROM '.USERS.' WHERE id='.$this->checkLogin('U');
		$languages_known=$this->user_model->ExecuteQuery($languages_known_query);
		$languages=explode(',',$languages_known->row()->languages_known);
		if($languages[0]!=''){
			$returnStr['counts']=count($languages);
		} else {
			$returnStr['counts']='None';
		}
		echo json_encode($returnStr);
	}
			
	public function delete_languages(){
		$languages_known_query='SELECT languages_known FROM '.USERS.' WHERE id='.$this->checkLogin('U');
		$languages_known=$this->user_model->ExecuteQuery($languages_known_query);
		$languages=explode(',',$languages_known->row()->languages_known);
		$position=array_search($this->input->post('language_code'),$languages);
		unset($languages[$position]);
		$excludeArr = array('languages','language_code');
		$inputArr['languages_known'] = implode(',',$languages);
		$condition = array('id'=>$this->checkLogin('U'));
		$this->user_model->commonInsertUpdate(USERS,'update',$excludeArr,$inputArr,$condition);
		$languages_known_query2='SELECT languages_known FROM '.USERS.' WHERE id='.$this->checkLogin('U');
		$languages_known2=$this->user_model->ExecuteQuery($languages_known_query2);
		$getuserlang=explode(',',$languages_known2->row()->languages_known);
		$languages_known_query1='SELECT * FROM '.LANGUAGES_KNOWN;
		$this->data['languages_known1']=$this->user_model->ExecuteQuery($languages_known_query1);
		$i=1;
		foreach ($this->data['languages_known1']->result() as $item  ) {
			if($i%2 == 1) {
				$returnArr['values'].=  '<li>';
				$returnArr['values'].='<input value="'.$item->language_code.'" type="checkbox" name="languages[]"';
				if(in_array($item->language_code,$getuserlang)){ 		
				$returnArr['values'].=' checked="checked" ';} else { 
				$returnArr['values'].=' '; }
				$returnArr['values'].=' /> <label>'.$item->language_name.'</label></li>'; 
			}
			if($i%2 == 0) {
				$returnArr['values1'].=  '<li>';
				$returnArr['values1'].='<input value="'.$item->language_code.'" type="checkbox" name="languages[]"';
				if(in_array($item->language_code,$getuserlang)){ 		
					$returnArr['values1'].=' checked="checked" ';
				} else { 
					$returnArr['values1'].=' '; 
				}
				$returnArr['values1'].=' /> <label>'.$item->language_name.'</label></li>'; 
			}
			$i++;
		}
		$returnArr['status_code']='1';
		$languages_known_query='SELECT languages_known FROM '.USERS.' WHERE id='.$this->checkLogin('U');
		$languages_known=$this->user_model->ExecuteQuery($languages_known_query);
		$languages=explode(',',$languages_known->row()->languages_known);
		if($languages[0]!=''){
			$returnArr['counts']=count($languages);
		} else {
			$returnArr['counts']='None';
		}
		echo json_encode($returnArr);
	}
}

/* End of file user_settings.php */
/* Location: ./application/controllers/site/user_settings.php */