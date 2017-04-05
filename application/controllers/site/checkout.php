<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * User related functions
 * @author dev Beetrut
 *
 */

class Checkout extends MY_Controller { 
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('checkout_model');
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->checkout_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];
		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->checkout_model->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['countryList'] = $this->checkout_model->get_all_details(COUNTRY_LIST,array());
		define("API_LOGINID",$this->config->item('payment_2'));
		define("StripeDetails",$this->config->item('payment_1'));
    }

	/**
	 * 
	 * Loading Cart Page
	 */

	/****************** Insert the checkout to user********************/
	public function PaymentProcess(){
		$product_id = $this->input->post('product_id');
		$tax = $this->input->post('tax');
		$enquiryid = $this->input->post('enquiryid'); 
		$product = $this->checkout_model->get_all_details(PRODUCT,array('id' => $product_id));
		$seller = $this->checkout_model->get_all_details(USERS,array('id' => $product->row()->user_id));
		$dealcode =$this->db->insert_id();
        /*Paypal integration start */
		$this->load->library('paypal_class');
		$item_name = $this->config->item('email_title').' Products';
		$totalAmount = $this->input->post('price');
		//User ID
		$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
		$lastFeatureInsertId = $this->session->userdata('randomNo');
		//echo $lastFeatureInsertId;die;
		$quantity = 1;
		//insert payment
		if($this->session->userdata('randomNo') != '') {
			$delete = 'delete from '.PAYMENT.' where dealCodeNumber = "'.$this->session->userdata('randomNo').'" and user_id = "'.$loginUserId.'" and status != "Paid"  ';
			$this->checkout_model->ExecuteQuery($delete, 'delete');
			$dealCodeNumber = $this->session->userdata('randomNo');
		} else {
			$dealCodeNumber = mt_rand();
		}
		$insertIds = array();
		$now = date("Y-m-d H:i:s");
		$paymentArr=array(
			'product_id'=>$product_id,
			'pro_price'=>$totalAmount,
			'price'=>AdminCurrencyValue($product->row()->id,$totalAmount),
			'indtotal'=>$product->row()->price,
			'pro_indtotal'=> AdminCurrencyValue($product->row()->id,$product->row()->price) ,
			'tax'=>$tax,
			'pro_sumtotal'=>$totalAmount,
			'sumtotal'=>AdminCurrencyValue($product->row()->id,$totalAmount),
			'user_id'=>$loginUserId,
			'sell_id'=>$product->row()->user_id,
			'created' => $now,
			'dealCodeNumber' => $dealCodeNumber,
			'status' => 'Pending',
			'shipping_status' => 'Pending',
			'pro_total'  =>$totalAmount,
			'pro_currency' => $product->row()->currency,
			'total'  => AdminCurrencyValue($product->row()->id,$totalAmount),
			'EnquiryId'=>$enquiryid,
			'inserttime' => NOW());
		$this->checkout_model->simple_insert(PAYMENT,$paymentArr);
		$insertIds[]=$this->db->insert_id();
		$paymtdata = array(
			'randomNo' => $dealCodeNumber,
			'randomIds' => $insertIds
		);
		$lastFeatureInsertId = $dealCodeNumber;		
		//echo '<pre>'; print_r($paymentArr); die;
		$this->session->set_userdata($paymtdata);
		$paypal_settings=unserialize($this->config->item('payment_0'));
		$paypal_settings=unserialize($paypal_settings['settings']);
		//sandbox
		if($paypal_settings['mode'] == 'sandbox'){
			$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		}else{
			$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
		}

		if($paypal_settings['mode'] == 'sandbox') {
			$ctype ='USD';
		}
		else {
			$ctype='USD';
		}
		// To change the currency type for below line >> Sandbox: USD, Live: MYR
		$CurrencyType = $this->checkout_model->get_all_details(CURRENCY,array('currency_type' => $ctype)); 
		$this->paypal_class->add_field('currency_code', $CurrencyType->row()->currency_type); 
		
		$this->paypal_class->add_field('business',$paypal_settings['merchant_email']); // Business Email
		$this->paypal_class->add_field('return',base_url().'order/success/'.$loginUserId.'/'.$lastFeatureInsertId); // Return URL
		$this->paypal_class->add_field('cancel_return', base_url().'order/failure'); // Cancel URL
		$this->paypal_class->add_field('notify_url', base_url().'order/ipnpayment'); // Notify url
		$this->paypal_class->add_field('custom', 'Product|'.$loginUserId.'|'.$lastFeatureInsertId); // Custom Values
		$this->paypal_class->add_field('item_name', $item_name); // Product Name
		$this->paypal_class->add_field('user_id', $loginUserId);
		$this->paypal_class->add_field('quantity', $quantity); // Quantity
		$this->paypal_class->add_field('amount', currencyConvertToUSD($product_id,$totalAmount)); // Price
		//echo base_url().'order/success/'.$loginUserId.'/'.$lastFeatureInsertId; die;
		$this->paypal_class->submit_paypal_post(); 
	}

	public function UserPaymentCreditStripe()
	{

		#echo '<pre>'; print_r($_POST);die;
		$userDetails = $this->checkout_model->get_all_details(USERS,$condition);
		$loginUserId = $this->checkLogin('U');
		$product_id = $this->input->post('product_id');
		$payment_type = $this->input->post('payment_type');
		$tax = $this->input->post('tax');
		$enquiryid = $this->input->post('enquiryid'); 
		$product = $this->checkout_model->get_all_details(PRODUCT,array('id' => $product_id));
		$seller = $this->checkout_model->get_all_details(USERS,array('id' => $product->row()->user_id));
		$dealcode =$this->db->insert_id();
		$lastFeatureInsertId = $this->session->userdata('randomNo');
		$userDetails = $this->checkout_model->get_all_details(USERS,$condition);
		$values = array('amount' =>  $this->input->post('total_price'), 
						'card_num' =>  $this->input->post('cardNumber'), 
						'exp_date' => $this->input->post('CCExpDay').'/'.$this->input->post('CCExpMnth'),
						'first_name' =>$userDetails->row()->firstname,
						'last_name' =>$userDetails->row()->lastname,
						'address' => $this->input->post('address'),
						'city' => $this->input->post('city'),
						'state' => $this->input->post('state'),
						'country' => $userDetails->row()->country,
						'phone' => $userDetails->row()->phone_no,
						'email' =>  $userDetails->row()->email,
						'card_code' => $this->input->post('creditCardIdentifier'));
		
		$excludeArr = array('authorize_mode','authorize_id','authorize_key','creditvalue','shipping_id','cardType','email','cardNumber','CCExpDay','CCExpMnth','creditCardIdentifier','total_price','CreditSubmit');
		
		$condition =array('id' => $loginUserId);
		$dataArr = array('user_id'=>$loginUserId,'full_name'=>$userDetails->row()->firstname.' '.$userDetails->row()->lastname,'address1'=>$this->input->post('address'),'address2'=>$this->input->post('address2'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postal_code'),'phone'=>$this->input->post('phone_no'));
		
		$StripDetVal=unserialize(StripeDetails); 			
		$StripeVals=unserialize($StripDetVal['settings']);	
		require_once('./stripe/lib/Stripe.php');
		$secret_key = $StripeVals['secret_key'];
		$publishable_key = $StripeVals['publishable_key'];
		$stripe = array(
			"secret_key"      => $secret_key,
			"publishable_key" => $publishable_key
			);
		
		Stripe::setApiKey($stripe['secret_key']);
		$token = $this->input->post('stripeToken');
		$amounts = currencyConvertToUSD($product_id,$values['amount'])*100;
		try {
			
			$payment_result = 	Stripe_Charge::create(array(
					"amount" => $amounts, # amount in cents, again
					"currency" => "USD",
					"source" => $token,
					"description" =>$enquiryid)
				);
				
			$product_id =$this->input->post('booking_rental_id');
			$product = $this->checkout_model->get_all_details(PRODUCT,array('id' => $product_id));
			$seller = $this->checkout_model->get_all_details(USERS,array('id' => $product->row()->user_id));
			$totalAmount = $this->input->post('total_price');
			if($this->session->userdata('randomNo') != '') {
				$delete = 'delete from '.PAYMENT.' where dealCodeNumber = "'.$this->session->userdata('randomNo').'" and user_id = "'.$loginUserId.'" ';
				$this->checkout_model->ExecuteQuery($delete, 'delete');
				$dealCodeNumber = $this->session->userdata('randomNo');
				} else {
					$dealCodeNumber = mt_rand();
				}
				$insertIds = array();
				$now = date("Y-m-d H:i:s");
				$paymentArr=array(
						'product_id'=>$product_id,
						'sell_id'=>$product->row()->user_id,
						'pro_price'=>$totalAmount,
			'price'=>AdminCurrencyValue($product->row()->id,$totalAmount),
			'indtotal'=>$product->row()->price,
			'pro_indtotal'=>AdminCurrencyValue($product->row()->id,$product->row()->price),
						
						'pro_sumtotal'=>$totalAmount,
			'sumtotal'=>AdminCurrencyValue($product->row()->id,$totalAmount),
						'user_id'=>$loginUserId,
						'created' => $now,
						'dealCodeNumber' => $dealCodeNumber,
						'status' => 'Pending',
						'shipping_status' => 'Pending',
						'pro_total'  => $totalAmount,
			'pro_currency' => $product->row()->currency,
			'total'  => AdminCurrencyValue($product->row()->id,$totalAmount),
						'EnquiryId'=>$enquiryid,
						'payment_type'=>$payment_type,
						'inserttime' => NOW());
								
			
				$this->checkout_model->simple_insert(PAYMENT,$paymentArr);
				#echo $this->db->last_query();die;
				$insertIds[]=$this->db->insert_id();
				$paymtdata = array(
					'randomNo' => $dealCodeNumber,
					'randomIds' => $insertIds,
					'EnquiryId'=>$enquiryid
				);
				$this->session->set_userdata($paymtdata);
				$this->product_model->edit_rentalbooking(array('booking_status' => 'Booked'),array('id'=>$this->session->userdata('EnquiryId')));
				$lastFeatureInsertId = $this->session->userdata('randomNo');
				redirect('order/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$token.'/stripe');
			} catch (Exception $e) {
				$error = $e->getMessage();
				$error = str_replace("'", "", $error);
				redirect('order/failure/'.$error); 
			}	
	}

	public function PaymentCredit(){
		#echo '<pre>';print_r($_POST);die;
		$cvv = md5($this->input->post('creditCardIdentifier'));
		$dataArr = array('cvv' => $cvv);
		$condition =array('id' => $this->checkLogin('U'));
		$userDetails = $this->checkout_model->get_all_details(USERS,$condition);
		$loginUserId = $this->checkLogin('U');
		$lastFeatureInsertId = $this->session->userdata('randomNo');
		if($this->input->post('creditvalue')=='authorize') 
		{	
			$Auth_Details=unserialize(API_LOGINID); 
			$Auth_Setting_Details=unserialize($Auth_Details['settings']);	
			//echo '<pre>';print_r($Auth_Setting_Details);die;
			define("AUTHORIZENET_API_LOGIN_ID",$Auth_Setting_Details['merchantcode']);    // Add your API LOGIN ID
			define("AUTHORIZENET_TRANSACTION_KEY",$Auth_Setting_Details['merchantkey']); // Add your API transaction key
			define("API_MODE",$Auth_Setting_Details['mode']);
			if(API_MODE	=='sandbox')
			{ 
				define("AUTHORIZENET_SANDBOX",true);// Set to false to test against production
			}
			else
			{
				define("AUTHORIZENET_SANDBOX",false);
			}       
			define("TEST_REQUEST", "FALSE"); 
			require_once './authorize/autoload.php';
			$transaction = new AuthorizeNetAIM;
			$transaction->setSandbox(AUTHORIZENET_SANDBOX);
			$transaction->setFields(
			array(
				'amount' =>  currencyConvertToUSD($this->input->post('booking_rental_id'),$this->input->post('total_price')), 
				'card_num' =>  $this->input->post('cardNumber'), 
				'exp_date' => $this->input->post('CCExpDay').'/'.$this->input->post('CCExpMnth'),
				'first_name' =>$userDetails->row()->firstname,
				'last_name' =>$userDetails->row()->lastname,
				'address' => $this->input->post('address'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'country' => $userDetails->row()->country,
				'phone' => $userDetails->row()->phone_no,
				'email' =>  $userDetails->row()->email,
				'card_code' => $this->input->post('creditCardIdentifier'),
				));
			$response = $transaction->authorizeAndCapture();
			//echo '<pre>';print_r($response);die;
			if($response->approved != '')
			{
				$product_id =$this->input->post('booking_rental_id');
				$product = $this->checkout_model->get_all_details(PRODUCT,array('id' => $product_id));
				$seller = $this->checkout_model->get_all_details(USERS,array('id' => $product->row()->user_id));
				$totalAmount = $this->input->post('total_price');
				$enquiryid = $this->input->post('enquiryid');
				$loginUserId = $this->checkLogin('U');
				if($this->session->userdata('randomNo') != '') {
				$delete = 'delete from '.PAYMENT.' where dealCodeNumber = "'.$this->session->userdata('randomNo').'" and user_id = "'.$loginUserId.'" ';
				$this->checkout_model->ExecuteQuery($delete, 'delete');
				$dealCodeNumber = $this->session->userdata('randomNo');
				} else {
				$dealCodeNumber = mt_rand();
				}
				$insertIds = array();
				$now = date("Y-m-d H:i:s");
				$paymentArr=array(
			'product_id'=>$product_id,
			'pro_price'=>$totalAmount,
			'price'=>AdminCurrencyValue($product->row()->id,$totalAmount),
			'indtotal'=>$product->row()->price,
			'pro_indtotal'=>AdminCurrencyValue($product->row()->id,$product->row()->price),
			'pro_sumtotal'=>$totalAmount,
			'sumtotal'=>AdminCurrencyValue($product->row()->id,$totalAmount),
			'user_id'=>$loginUserId,
			'sell_id'=>$product->row()->user_id,
			'created' => $now,
			'dealCodeNumber' => $dealCodeNumber,
			'status' => 'Paid',
			'shipping_status' => 'Pending',
			'pro_total'  => $totalAmount,
			'pro_currency' => $product->row()->currency,
			'total'  => AdminCurrencyValue($product->row()->id,$totalAmount),
			'EnquiryId'=>$enquiryid,
			'inserttime' => NOW());
								
				$this->checkout_model->simple_insert(PAYMENT,$paymentArr);
				$insertIds[]=$this->db->insert_id();
				$paymtdata = array(
					'randomNo' => $dealCodeNumber,
					'randomIds' => $insertIds
					);
				$this->session->set_userdata($paymtdata);
				$this->product_model->edit_rentalbooking(array('booking_status' => 'Booked'),array('id'=>$enquiryid));
				$lastFeatureInsertId = $this->session->userdata('randomNo');
				redirect('order/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$response->transaction_id.'/credit');
			}else{
				$this->session->set_userdata(array('payment_error' => $response->response_reason_text));
				redirect('order/failure'); 
			}
		}
	}

	public function postdata() {
		print_r($_POST);
	}
}



/* End of file checkout.php */

/* Location: ./application/controllers/site/checkout.php */