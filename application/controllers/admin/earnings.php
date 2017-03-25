<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Earnings extends MY_Controller {


	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('commission_model');
		if ($this->checkPrivileges('Commission',$this->privStatus) == FALSE){
			redirect('admin');
		}
		
		
    }
    
    /**
     * 
     * This function loads the commisions list page
     */
   	public function index(){

	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/earnings/display_earning_list');
		}
	}
	
	
	/**
	 * 
	 * This function loads the commission list page
	 */
	public function display_earning_list(){
	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Earning List';
			$condition = array();
			$this->data['commissionList'] = $this->commission_model->get_all_details(COMMISSION,$condition);
			
			
			$this->load->view('admin/earnings/display_earninglist',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the commission dashboard
	 */
	public function display_commission_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Members Dashboard';
			$condition = 'where `group`="commission" order by `created` desc';
			$this->data['commissionList'] = $this->commission_model->get_commission_details($condition);
			$this->load->view('admin/commission/display_commission_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new commission form
	 */
	public function add_commission_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Commission';
			$this->load->view('admin/commission/add_commission',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit a commission
	 */
	public function insertEditcommission(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$commission_id = $this->input->post('commission_id');
			$commission_type = $this->input->post('commission_type');
			
			$password = md5($this->input->post('new_password'));
			$email = $this->input->post('email');
			if ($commission_id == ''){
				//$unameArr = $this->config->item('unameArr');
				/*if (!preg_match('/^\w{1,}$/', trim($firstname))){
					$this->setErrorMessage('error','commission name not valid. Only alphanumeric allowed');
					echo "<script>window.history.go(-1);</script>";exit;
				}*/
				
				$condition = array('commission_type' => $commission_type);
				$duplicate_name = $this->commission_model->get_all_details(COMMISSION,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','First name already exists');
					redirect('admin/commission/add_commission_form');
				}
			}
			$excludeArr = array("commission_id","image","new_password","confirm_password","group","status");
			
			
			if ($this->input->post('status') != ''){
				$commission_status = 'Active';
			}else {
				$commission_status = 'Inactive';
			}
			
            $dataArr = array('status' => $commission_status);
			$condition = array('id' => $commission_id);
			if ($commission_id == ''){
				$this->commission_model->commonInsertUpdate(COMMISSION,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','commission added successfully');
			}else {
				//print_r($dataArr);die;
				$this->commission_model->commonInsertUpdate(COMMISSION,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Earnings updated successfully');
			}
			redirect('admin/earnings/display_earning_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit commission form
	 */
	public function edit_earning_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Earning';
			$commission_id = $this->uri->segment(4,0);
			$condition = array('id' => $commission_id);
			$this->data['commission_details'] = $this->commission_model->get_all_details(COMMISSION,$condition);
			if ($this->data['commission_details']->num_rows() == 1){
				$this->load->view('admin/earnings/edit_earnings',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function change the commission status
	 */
	public function change_commission_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$commission_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $commission_id);
			$this->commission_model->update_details(COMMISSION,$newdata,$condition);
			$this->setErrorMessage('success','Earnings Status Changed Successfully');
			redirect('admin/earnings/display_earning_list');
		}
	}
	
	/**
	 * 
	 * This function loads the commission view page
	 */
	public function view_commission(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View commission';
			$commission_id = $this->uri->segment(4,0);
			$condition = array('id' => $commission_id);
			$this->data['commission_details'] = $this->commission_model->get_all_details(commission,$condition);
			if ($this->data['commission_details']->num_rows() == 1){
				$this->load->view('admin/commission/view_commission',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the commission record from db
	 */
	public function delete_commission(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$commission_id = $this->uri->segment(4,0);
			$condition = array('id' => $commission_id);
			$this->commission_model->commonDelete(commission,$condition);
			$this->setErrorMessage('success','Earnings deleted successfully');
            redirect('admin/earnings/display_earning_list');
		}
	}
	
	/**
	 * 
	 * This function change the commission status, delete the commission record
	 */
	public function change_commission_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->commission_model->activeInactiveCommon(COMMISSION,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','commission records deleted successfully');
			}else {
				$this->setErrorMessage('success','commission records status changed successfully');
			}
			redirect('admin/earnings/display_earning_list');
		}
	}
	
	public function export_commission_details()
	{
	$fields_wanted=array('firstname','lastname','email','created','last_login_date','last_login_ip');
    $table=commission;
	$commission=$this->commission_model->export_commission_details($table,$fields_wanted);
	$this->data['commission_detail']=$commission['commission_detail']->result();
	$this->load->view('admin/commission/export_commission',$this->data);
	}
	
	public function display_commission_tracking_lists(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Commission Tracking Lists';
			$sellerDetails = $this->commission_model->get_all_details(USERS,array('group'=>'Seller','status'=>'Active'));
		//echo "<pre>";	print_r($sellerDetails->result()); die; $this->data['trackingDetails']
			foreach($sellerDetails->result() as $seller)
			{
				$sellerEmail = $seller->email;
				
				$rental_booking_details[$sellerEmail] = $this->commission_model->get_all_commission_tracking($sellerEmail);
				$this->data['trackingDetails'][$sellerEmail]['rowsCount'] = count($rental_booking_details[$sellerEmail]);
				$this->data['trackingDetails'][$sellerEmail]['guest_fee'] = 0;
				$this->data['trackingDetails'][$sellerEmail]['total_amount'] = 0;
				$this->data['trackingDetails'][$sellerEmail]['host_fee'] = 0;
				$this->data['trackingDetails'][$sellerEmail]['payable_amount'] = 0;
				//echo "<pre>";print_r($rental_booking_details[$sellerEmail]); die;
				if(count($rental_booking_details[$sellerEmail]) != 0){ 
				foreach($rental_booking_details[$sellerEmail] as $rentals)
				{
					$this->data['trackingDetails'][$sellerEmail]['id'] = $rentals['id'];
					
					$this->data['trackingDetails'][$sellerEmail]['total_amount'] = $this->data['trackingDetails'][$sellerEmail]['total_amount'] + AdminCurrencyValue($rentals['prd_id'],$rentals['total_amount']);
					
					$this->data['trackingDetails'][$sellerEmail]['guest_fee'] = $this->data['trackingDetails'][$sellerEmail]['guest_fee'] + AdminCurrencyValue($rentals['prd_id'],$rentals['guest_fee']);
					
					$this->data['trackingDetails'][$sellerEmail]['host_fee'] = $this->data['trackingDetails'][$sellerEmail]['host_fee'] + AdminCurrencyValue($rentals['prd_id'],$rentals['host_fee']);
					
					$this->data['trackingDetails'][$sellerEmail]['payable_amount'] = $this->data['trackingDetails'][$sellerEmail]['payable_amount'] + AdminCurrencyValue($rentals['prd_id'],$rentals['payable_amount']);
					
					
					}
				}
				$paidAmountQry = $this->commission_model->get_paid_details($sellerEmail);
			$this->data['trackingDetails'][$sellerEmail]['paid'] = 0;
			if(count($paidAmountQry) != 0){ 

				foreach($paidAmountQry as $rental_paid)
				{
				$this->data['trackingDetails'][$sellerEmail]['paid'] = $this->data['trackingDetails'][$sellerEmail]['paid'] + AdminCurrencyValue($rental_paid['prd_id'],$rental_paid['payable_amount']);	
				}
			}

				
			}
			$this->load->view('admin/commission/display_tracking_lists',$this->data);
		}
	}
	public function display_commission_tracking_lists_old(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Commission Lists';
			$sellerDetails = $this->commission_model->get_all_details(USERS,array('group'=>'Seller','status'=>'Active'));
			$CommDetails = $this->commission_model->get_all_details(COMMISSION,array('id'=>'3'));
			
			//echo '<pre>'; print_r($CommDetails->result()); die;
			
			if ($sellerDetails->num_rows()>0){
				foreach ($sellerDetails->result() as $sellerDetailsRow){
					$orderDetails[$sellerDetailsRow->id] = $this->commission_model->get_total_order_amount($sellerDetailsRow->id);
					
					$refund_amt = $sellerDetailsRow->refund_amount;
					$commission_to_admin[$sellerDetailsRow->id] = 0;
					$amount_to_vendor[$sellerDetailsRow->id] = 0;
					$total_amount = $tax_amount = $RemainAmt = $adminTotAmt = 0;
					$this->data['total_amount'][$sellerDetailsRow->id] = $total_amount;
					$this->data['tax_amount'][$sellerDetailsRow->id] = $tax_amount;
					$this->data['remain_amount'][$sellerDetailsRow->id] = $RemainAmt;
					$this->data['TotalAdminAmt'][$sellerDetailsRow->id] = $adminTotAmt;
					//echo '<pre>'; print_r($orderDetails[$sellerDetailsRow->id]->result_array());
					
					$total_orders = 0;
					if ($orderDetails[$sellerDetailsRow->id]->num_rows()==1){
					
						$commission_percentage = $CommDetails->row()->commission_percentage;
						$total_amount = $orderDetails[$sellerDetailsRow->id]->row()->TotalAmt;
						$tax_amount = $orderDetails[$sellerDetailsRow->id]->row()->TaxAmt;
						$RemainAmt = $total_amount - $tax_amount;
						$this->data['total_amount'][$sellerDetailsRow->id] = $total_amount;
						$total_amount = $RemainAmt-$refund_amt;
						$total_orders = $orderDetails[$sellerDetailsRow->id]->row()->orders;
						
						if($CommDetails->row()->promotion_type=='percentage'){
							$commission_to_admin[$sellerDetailsRow->id] = $total_amount*($commission_percentage*0.01);
						}else{
							$commission_to_admin[$sellerDetailsRow->id] = $total_orders * $commission_percentage;
						}
						
						
						if ($commission_to_admin[$sellerDetailsRow->id]<0)$commission_to_admin[$sellerDetailsRow->id]=0;
						$amount_to_vendor[$sellerDetailsRow->id] = $total_amount-$commission_to_admin[$sellerDetailsRow->id];
						if ($amount_to_vendor[$sellerDetailsRow->id]<0)$amount_to_vendor[$sellerDetailsRow->id]=0;
						
						
					}
					$paidDetails = $this->commission_model->get_total_paid_details($sellerDetailsRow->id);
					$paid_to[$sellerDetailsRow->id] = 0;
					if ($paidDetails->num_rows()==1){
						$paid_to[$sellerDetailsRow->id] = $paidDetails->row()->totalPaid;
						if ($paid_to[$sellerDetailsRow->id]<0)$paid_to[$sellerDetailsRow->id]=0;
					}
					$paid_to_balance[$sellerDetailsRow->id] = $amount_to_vendor[$sellerDetailsRow->id]-$paid_to[$sellerDetailsRow->id];
					if ($paid_to_balance[$sellerDetailsRow->id]<0)$paid_to_balance[$sellerDetailsRow->id]=0;
					$this->data['total_orders'][$sellerDetailsRow->id] = $total_orders;
					$this->data['tax_amount'][$sellerDetailsRow->id] = $tax_amount;
					$this->data['remain_amount'][$sellerDetailsRow->id] = $RemainAmt;
					$this->data['commission_to_admin'][$sellerDetailsRow->id] = $commission_to_admin[$sellerDetailsRow->id];
					$this->data['amount_to_vendor'][$sellerDetailsRow->id] = $amount_to_vendor[$sellerDetailsRow->id];
					$this->data['TotalAdminAmt'][$sellerDetailsRow->id] = $tax_amount + $commission_to_admin[$sellerDetailsRow->id];
					
					$this->data['paid_to'][$sellerDetailsRow->id] = $paid_to[$sellerDetailsRow->id];
					$this->data['paid_to_balance'][$sellerDetailsRow->id] = $paid_to_balance[$sellerDetailsRow->id];
				}
			}
			//echo "<pre>"; print_r($this->data['tax_amount']); die;
			$this->data['sellerDetails'] = $sellerDetails;
			$this->load->view('admin/commission/display_tracking_lists',$this->data);
		}
	}
	
	public function view_paid_details(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Vendor payment details';
			$sid = $this->uri->segment(4,0);
			$this->data['paidDetails'] = $this->commission_model->get_all_details(VENDOR_PAYMENT,array('vendor_id'=>$sid));
			$this->load->view('admin/commission/view_paid_details',$this->data);
		}
	}
	
	public function add_pay_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add vendor payment';
			$sid = $this->uri->segment(4,0);
			$hostEmailQry = $this->commission_model->get_commission_track_id($sid);
			$product_id = $hostEmailQry->row()->prd_id;
			$hostEmail = $hostEmailQry->row()->host_email;
			$this->data['hostEmail'] = $hostEmail;
			
			$rental_booking_details= $this->commission_model->get_unpaid_commission_tracking($hostEmail);
			$payableAmount = 0;
			if(count($rental_booking_details) != 0){ 
				foreach($rental_booking_details as $rentals)
				{
				
					$payableAmount = $payableAmount + AdminCurrencyValue($rentals['prd_id'],$rentals['payable_amount']);
					
					
					}
				}
				
			$paidAmountQry = $this->commission_model->get_paid_details($hostEmail);
			$paidAmount = 0;
			if(count($paidAmountQry) != 0){ 
				foreach($paidAmountQry as $rental_paid)
				{
				$paidAmount =$paidAmount + AdminCurrencyValue($rental_paid['prd_id'],$rental_paid['payable_amount']);	
				}
			}
			

			$this->data['hostEmail'] = $hostEmail;
			
			$this->data['payableAmount'] = number_format($payableAmount-$paidAmount, 2, '.', '');
			$this->load->view('admin/commission/add_vendor_payment',$this->data);
		}
	}
	
	public function add_pay_form_old(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add vendor payment';
			$sid = $this->uri->segment(4,0);
			$this->data['sellerDetails'] = $this->commission_model->get_all_details(USERS,array('group'=>'Seller','id'=>$sid));
			$CommDetails = $this->commission_model->get_all_details(COMMISSION,array('id'=>'3'));
			
			if ($this->data['sellerDetails']->num_rows()==1){
				$this->data['orderDetails'] = $this->commission_model->get_total_order_amount($sid);
				$commission_percentage = $CommDetails->row()->commission_percentage;
				$total_amount = $tax_amount = $RemainAmt = $adminTotAmt = 0;
				if ($this->data['orderDetails']->num_rows()==1){
					$total_amount = $this->data['orderDetails']->row()->TotalAmt;
					
					$tax_amount = $this->data['orderDetails']->row()->TaxAmt;
					$RemainAmt = $total_amount - $tax_amount;
					$this->data['total_amount'] = $total_amount;
					$total_amount = $RemainAmt-$refund_amt;
					$total_orders = $this->data['orderDetails']->row()->orders;
					
					if($CommDetails->row()->promotion_type=='percentage'){
						$commission_to_admin = $total_amount*($commission_percentage*0.01);
					}else{
						$commission_to_admin = $total_orders * $commission_percentage;
					}
				}
				
				$total_amount = $total_amount-$this->data['sellerDetails']->row()->refund_amount;
				 
				if ($commission_to_admin<0)$commission_to_admin=0;
				$amount_to_vendor = $total_amount-$commission_to_admin;
				if ($amount_to_vendor<0)$amount_to_vendor=0;
				
				$this->data['paidDetails'] = $this->commission_model->get_total_paid_details($sid);
				$paid_to = 0;
				if ($this->data['paidDetails']->num_rows()==1){
					$paid_to = $this->data['paidDetails']->row()->totalPaid;
					if ($paid_to<0)$paid_to=0;
				}
				$paid_to_balance = $amount_to_vendor-$paid_to;
				if ($paid_to_balance<0)$paid_to_balance=0;
				$this->data['commission_to_admin'] = $commission_to_admin;
				$this->data['amount_to_vendor'] = $amount_to_vendor;
				$this->data['paid_to'] = $paid_to;
				$this->data['paid_to_balance'] = $paid_to_balance;
				$this->load->view('admin/commission/add_vendor_payment',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
		public function add_vendor_payment(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
/*			$balance = $this->input->post('balance_due');
			$amount = $this->input->post('amount');
			if ($amount>$balance){
				$this->setErrorMessage('error','Amount exceeds the balance due');
				echo "<script>window.history.go(-1);</script>";exit();
			}else {
				$trans_id = $this->input->post('transaction_id');
				$duplicateCheck = $this->commission->get_all_details(VENDOR_PAYMENT,array('transaction_id'=>$trans_id));
				if ($duplicateCheck->num_rows()>0){
					$this->setErrorMessage('error','Transaction id already exists');
					echo "<script>window.history.go(-1);</script>";exit();
				}else {
					$excludeArr = array('balance_due');
					$this->commission->commonInsertUpdate(VENDOR_PAYMENT,'insert',$excludeArr,array());
					$this->setErrorMessage('success','Payment added successfully');
					redirect('admin/commission/view_paid_details/'.$this->input->post('vendor_id'));
				}
			}
*/		
			
			$balance = $this->input->post('balance_due');
			$amount = $this->input->post('amount');
			$seller_id = $this->input->post('vendor_id');
			if ($amount>$balance){
				$this->setErrorMessage('error','Amount exceeds the balance due');
				echo "<script>window.history.go(-1);</script>";exit();
			}else {
				$randNumber = mt_rand();
				$key = 'team-fancyy-clone-tweaks';
				$encrypted_string = $this->encrypt->encode($randNumber, $key);
				
				$dataArr = array(
					'transaction_id'	=>	$randNumber,
					'payment_type'		=>	'paypal',
					'amount'			=>	$amount,
					'status'			=>	'pending',
					'vendor_id'			=>	$seller_id
				);
				$this->commission_model->simple_insert(VENDOR_PAYMENT,$dataArr);
				$this->data['randNumber'] = $randNumber;
				$this->data['code'] = $encrypted_string;
				$this->data['amount'] = $amount;
				$this->data['admin_id'] = $this->encrypt->encode($this->checkLogin('A'), $key);
				$this->data['seller_id'] = $this->encrypt->encode($seller_id, $key);
				$this->data['paypal_email'] = $this->input->post('paypal_email');
				$this->load->view('admin/commission/paypal_form',$this->data);
			}
		}
	}
	
	
	public function add_vendor_payment_manual(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
		//echo "<pre>";	print_r($this->input->post());
		$rental_booking_details= $this->commission_model->get_unpaid_commission_tracking($this->input->post('hostEmail'));
			$payableAmount = 0;
			if(count($rental_booking_details) != 0){ 
				foreach($rental_booking_details as $rentals)
				{
				
					$payableAmount = $payableAmount + $rentals['payable_amount'];
					
					
					}
				}
				
		
			$dataArr = array(
				'host_email'	=>	$this->input->post('balance_due'),
				'transaction_id'		=>	$this->input->post('transaction_id'),
				'amount'		=>$payableAmount
			);
		//	print_r($dataArr); die;
			$this->commission_model->simple_insert(COMMISSION_PAID,$dataArr);
			$this->commission_model->update_details(COMMISSION_TRACKING, array('paid_status'=>'yes'), array('host_email'=>$this->input->post('hostEmail')));
			redirect('admin/commission/display_commission_tracking_lists');
		}
	}
	
	public function add_vendor_payment_manual_old(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$balance = $this->input->post('balance_due');
			$amount = $this->input->post('amount');
			if ($amount>$balance){
				$this->setErrorMessage('error','Amount exceeds the balance due');
				echo "<script>window.history.go(-1);</script>";exit();
			}else {
				$trans_id = $this->input->post('transaction_id');
				$duplicateCheck = $this->commission_model->get_all_details(VENDOR_PAYMENT,array('transaction_id'=>$trans_id));
				if ($duplicateCheck->num_rows()>0){
					$this->setErrorMessage('error','Transaction id already exists');
					echo "<script>window.history.go(-1);</script>";exit();
				}else {
					$excludeArr = array('balance_due');
					$this->commission_model->commonInsertUpdate(VENDOR_PAYMENT,'insert',$excludeArr,array());
					$this->setErrorMessage('success','Payment added successfully');
					redirect('admin/commission/view_paid_details/'.$this->input->post('vendor_id'));
				}
			}
		
		}
	}
	
	public function display_payment_success(){
		if ($this->checkLogin('A')!=''){
			$msg = $this->input->get('msg');
			if ($msg == 'success'){
				$key = 'team-fancyy-clone-tweaks';
				$randNumber = $this->encrypt->decode($this->input->get('trans'), $key);
				$seller_id = $this->encrypt->decode($this->input->get('sellId'),$key);
				$admin_id = $this->encrypt->decode($this->input->get('modeVal'),$key);
				if ($admin_id == $this->checkLogin('A')){
					$dataArr = array(
						'status'			=>	'success',
					);
					$this->commission_model->update_details(VENDOR_PAYMENT,$dataArr,array('transaction_id'=>$randNumber,'vendor_id'=>$seller_id));
					$this->data['heading'] = 'Payment Success';
					$this->load->view('admin/commission/payment_success',$this->data);
				}else {
					redirect('admin');
				}
			}
		}else {
			redirect('admin');
		}
	}
	
	public function display_payment_failed(){
		if ($this->checkLogin('A')!=''){
			$this->data['heading'] = 'Payment Failure';
			$this->load->view('admin/commission/payment_failed',$this->data);
		}else {
			redirect('admin');
		}
	}
	
	public function commission_pay(){
	}
}

/* End of file commission.php */
/* Location: ./application/controllers/admin/commission.php */