<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to Order management 
 * @author dev Beetrut
 *
 */ 

class Bookingpayment extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));				
		$this->load->model('account_model');
		$this->load->model('order_model');
		$this->load->model('bookingpayment_model');
		if ($this->checkPrivileges('Accounts',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the order list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/accounts/display_newbooking');
		}
	}
	
	/**
	 * 
	 * This function loads the order list page
	 */
	public function display_receivable(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
		
		
			$this->data['heading'] = 'Receivable and Payable Payment';
			$this->data['newbookingList'] = $this->bookingpayment_model->view_newbooking_details();
			$condition = array('status' => 'Active', 'seo_tag'=>'host-listing');
			$service_tax_host=$this->product_model->get_all_details(COMMISSION, $condition);
			$this->data['host_tax_type'] = $service_tax_host->row()->promotion_type;
			$this->data['host_tax_value'] = $service_tax_host->row()->commission_percentage;
			$condition = array('status' => 'Active', 'seo_tag'=>'guest-booking');
			$service_tax_guest=$this->product_model->get_all_details(COMMISSION, $condition);
			$this->data['guest_tax_type'] = $service_tax_guest->row()->promotion_type;
			$this->data['guest_tax_value'] = $service_tax_guest->row()->commission_percentage;
			$this->data['commissionTracking'] = $this->bookingpayment_model->get_all_commission_tracking();
			//echo '<pre>'; print_r($this->data['commissionTracking']->result()); die;
			$this->load->view('admin/bookingpayment/display_receivable',$this->data);
		}
	}
	
	
	public function display_payable(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Payable Payment';
			$this->data['newbookingList'] = $this->bookingpayment_model->view_newbooking_details();
			$condition = array('status' => 'Active', 'seo_tag'=>'host-listing');
			$service_tax_host=$this->product_model->get_all_details(COMMISSION, $condition);
			$this->data['host_tax_type'] = $service_tax_host->row()->promotion_type;
			$this->data['host_tax_value'] = $service_tax_host->row()->commission_percentage;
			$condition = array('status' => 'Active', 'seo_tag'=>'guest-booking');
			$service_tax_guest=$this->product_model->get_all_details(COMMISSION, $condition);
			$this->data['guest_tax_type'] = $service_tax_guest->row()->promotion_type;
			$this->data['guest_tax_value'] = $service_tax_guest->row()->commission_percentage;
			$this->load->view('admin/bookingpayment/display_payable',$this->data);
		}
	}
	
	public function customerExcelExportReceivable() 
	{
        if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Receivable and Payable Payment';
			$this->data['newbookingList'] = $this->bookingpayment_model->view_newbooking_details();
			$condition = array('status' => 'Active', 'seo_tag'=>'host-listing');
			$service_tax_host=$this->product_model->get_all_details(COMMISSION, $condition);
			$this->data['host_tax_type'] = $service_tax_host->row()->promotion_type;
			$this->data['host_tax_value'] = $service_tax_host->row()->commission_percentage;
			$condition = array('status' => 'Active', 'seo_tag'=>'guest-booking');
			$service_tax_guest=$this->product_model->get_all_details(COMMISSION, $condition);
			$this->data['guest_tax_type'] = $service_tax_guest->row()->promotion_type;
			$this->data['guest_tax_value'] = $service_tax_guest->row()->commission_percentage;
			$this->data['commissionTracking'] = $this->bookingpayment_model->get_all_commission_tracking();
			$this->load->view('admin/bookingpayment/customerExcelExportReceivable', $this->data);
		}
	}
	
	public function customerExcelExportPayable() 
	{
        if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Payable Payment';
			$this->data['newbookingList'] = $this->bookingpayment_model->view_newbooking_details('Booked');
			$service_tax_query='SELECT * FROM '.COMMISSION.' WHERE status="Active"';
			$this->data['service_tax']=$this->product_model->ExecuteQuery($service_tax_query)->result_array();
			//echo '<pre>'; print_r($this->data['newbookingList']->result_array()); die;
			$this->load->view('admin/bookingpayment/customerExcelExportPayable',$this->data);
		}
	}
	
	
	public function display_book_confirmed(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Confirm Booking List';
			$this->data['newbookingList'] = $this->account_model->view_newbooking_details('Booked');
			//echo '<pre>'; print_r($this->data['newbookingList']->result_array()); die;
			$this->load->view('admin/accounts/display_book_confirmed',$this->data);
		}
	}
	
	
	
	public function display_book_expired(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Expired Booking List';
			$this->data['newbookingList'] = $this->account_model->view_newbooking_detailsexp('Booked');
			//echo '<pre>'; print_r($this->data['newbookingList']->result_array()); die;
			$this->load->view('admin/accounts/display_book_expired',$this->data);
		}
	}
	
	public function display_order_pending(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Order List';
			$this->data['orderList'] = $this->order_model->view_order_details('Pending');
			$this->load->view('admin/order/display_orders_pending',$this->data);
		}
	}
	
	public function customerExcelExportNewBooking() 
	{
        $status=$this->uri->segment(4);	
		$condition = array();
		$UserDetails = $this->account_model->view_newbooking_details(ucfirst($status));
		$data['getCustomerDetails'] = $UserDetails->result_array();
		if($status=="booked") {
		$status ="Completed";
		}
		$data['title'] =ucfirst($this->config->item('email_title'))." ".ucfirst($status);
	    $data['status']= ucfirst($status);		
		$this->load->view('admin/accounts/customerExportExcelNewBooking',$data);
	}	
	
	public function customerExcelExportExpired() 
	{
	//echo '<pre>';print_r($_POST);die;
        $status="Expired booking";
		$condition = array();
		$UserDetails = $this->account_model->view_newbooking_detailsexp('Booked');
		$data['getCustomerDetails'] = $UserDetails->result_array();
		//echo '<pre>';print_r($data['getCustomerDetails']->result());die;
		$data['title'] =ucfirst($this->config->item('email_title'))." ".ucfirst($status);
	    $data['status']= $status;		
		$this->load->view('admin/accounts/customerExportExcelexpired',$data);
	}	
	
	
	public function hostpayable() {
	 
	 
	 //VENDOR_PAYMENT
	   $checkVendorBooking  = $this->account_model->get_all_details(VENDOR_PAYMENT,array('bookingId'=>$this->input->post('BookNo')));
	   $checkBooking  = $this->account_model->get_all_details(HOSTPAYMENT,array('bookingId'=>$this->input->post('BookNo')));
	  // echo '<pre>'; print_r($checkBooking->result_array());
	   
	   $excludeArr = array('bookingId','product_id','host_id','amount','txn_id','txt_date','txn_type', 'payment_status');
		$condition = array();
		$dataArr = array(
		'bookingId'=>$this->input->post('BookNo'),
		'product_id'=>$this->input->post('Prdid'),
		'host_id'=>$this->input->post('hostid'), 
		'amount'=>$this->input->post('netamt'),
		'txn_id'=>$this->input->post('transid'),
		'txt_date'=>$this->input->post('transdate'),
		'txn_type'=>$this->input->post(transtype),
		'payment_status'=>'Paid'
		);
		$vendorDataArr = array(
		'transaction_id'=>$this->input->post('transid'),
		'date'=>$this->input->post('transdate'),
		'payment_type'=>$this->input->post(transtype),
		'amount'=>$this->input->post('netamt'),
		'vendor_id'=>$this->input->post('hostid'),
		'bookingId'=>$this->input->post('BookNo'),
		'status'=>'success'
		);
	   if( $checkVendorBooking->num_rows() == 0 ){
		   $this->account_model->simple_insert(VENDOR_PAYMENT,$vendorDataArr);
	   }
	   else{
		 $this->account_model->update_details(VENDOR_PAYMENT,$vendorDataArr,array('bookingId'=>$this->input->post('BookNo')));
	   }
		if($checkBooking->num_rows() == 0) {
		$this->account_model->simple_insert(HOSTPAYMENT,$dataArr);
	    echo json_encode('Transaction has been completed');
		}
		else {
		$this->account_model->update_details(HOSTPAYMENT,$dataArr,array('bookingId'=>$this->input->post('BookNo')));
		//echo $this->db->last_query();
		 echo json_encode('Transaction has been updated');
		}
	   
	}
	
	
}

/* End of file order.php */
/* Location: ./application/controllers/admin/bookingpayment.php */