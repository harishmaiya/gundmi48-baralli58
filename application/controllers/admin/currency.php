<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency extends MY_Controller {

    function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('currency_model');
		$this->load->model('location_model');
		if ($this->checkPrivileges('Currency',$this->privStatus) == FALSE){
			redirect(ADMIN_PATH);
		}
    }
	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect(ADMIN_PATH);
		}else {
			redirect(ADMIN_PATH.'/currency/display_user_list');
		}
	}
	public function display_currency_list(){
		if ($this->checkLogin('A') == ''){
			redirect(ADMIN_PATH);
		}else {
			$this->data['heading'] = 'currency List';
			$condition = array();
			$this->data['currencyList'] = $this->currency_model->get_all_details(CURRENCY,$condition);
			$this->load->view('admin/currency/display_currency',$this->data);
		}
	}
	public function add_currency_form(){
		if ($this->checkLogin('A') == ''){
			redirect(ADMIN_PATH);
		}else {
		    $sortArr1 = array('field'=>'name','type'=>'asc');
		    $condition = array('status'=>'Active');
			$this->data['countryList'] = $this->currency_model->get_all_details(COUNTRY_LIST,$condition,array($sortArr1));
			$this->data['heading'] = 'Add New Currency';
			$this->load->view('admin/currency/add_currency',$this->data);
		}
	}
	public function insertEditCurrency(){
	
		if ($this->checkLogin('A') == ''){
			redirect(ADMIN_PATH);
		}else {
		    $currency_id = $this->input->post('currency_id');
		    $location_name = $this->input->post('country_name');
			$seourl = url_title($location_name, '-', TRUE);
			$excludeArr = array("status","currency_symbols","currency_id");
			if ($this->input->post('status') != ''){
				$location_status = 'Active';
			}else {
				$location_status = 'InActive';
			}
			$location_data=array();
			$this->load->helper('text');
			$inputArr = array('status' => $location_status,'seourl'=>$seourl,'currency_symbols'=>$this->input->post('currency_symbols'));
			$dataArr = array_merge($inputArr,$location_data);
			$condition = array('id' => $currency_id);
			
			if ($currency_id == ''){
			    // $currency_check = $this->currency_model->get_all_details(CURRENCY,array('status'=>'Active'));
			    $currency_check = $this->currency_model->get_all_details(CURRENCY,array());
                if($currency_check->num_rows() >0){
				  $currency = array();
			      foreach($currency_check->result() as $currency_ck){
				      $currency[] =   $currency_ck->currency_type;   
				  }
				  //print_r($currency); die;
			        if(in_array($this->input->post('currency_type'),$currency)){
			             $this->setErrorMessage('error','This Currency Type are Already Exists');
			              redirect(ADMIN_PATH.'/currency/add_currency_form');
			        }else{
				         $this->currency_model->commonInsertUpdate(CURRENCY,'insert',$excludeArr,$dataArr,$condition);
				         $this->setErrorMessage('success','Currency Added successfully');
				         redirect(ADMIN_PATH.'/currency/display_currency_list');
			       }}}else{
                         $this->currency_model->commonInsertUpdate(CURRENCY,'update',$excludeArr,$dataArr,$condition);
			             $this->location_model->saveCurrencySettings();
			             $this->setErrorMessage('success','Currency updated successfully');
			             redirect(ADMIN_PATH.'/currency/display_currency_list');
		            }
	     }}	
	public function edit_currency_form(){
		if ($this->checkLogin('A') == ''){
			redirect(ADMIN_PATH);
		}else {
			$this->data['heading'] = 'Edit Currency';
			$currency_id = $this->uri->segment(4,0);
			$condition = array('id' => $currency_id);
			$sortArr1 = array('field'=>'name','type'=>'asc');
			$this->data['countryList'] = $this->currency_model->get_all_details(COUNTRY_LIST,array('status'=>'Active'),array($sortArr1));
			$this->data['currency_details'] = $this->currency_model->get_all_details(CURRENCY,$condition);
			if ($this->data['currency_details']->num_rows() == 1){
				$this->load->view('admin/currency/edit_currency',$this->data);
			}else {
				redirect(ADMIN_PATH);
			}
		}
	}
		public function view_currency(){
		if ($this->checkLogin('A') == ''){
			redirect(ADMIN_PATH);
		}else {
			$this->data['heading'] = 'View Currency';
			$currency_id = $this->uri->segment(4,0);
			$condition = array('id' => $currency_id);
			$this->data['currency_details'] = $this->currency_model->get_all_details(CURRENCY,$condition);
			if ($this->data['currency_details']->num_rows() == 1){
				$this->load->view('admin/currency/view_currency',$this->data);
			}else {
				redirect(ADMIN_PATH);
			}
		}
	}
	public function delete_currency(){
	     
		 if ($this->checkLogin('A') == ''){
			redirect(ADMIN_PATH);
		}else {
			$currency_id = $this->uri->segment(4,0);
			$condition = array('id' => $currency_id);
			$this->currency_model->commonDelete(CURRENCY,$condition);
			$this->setErrorMessage('success','Currency deleted successfully');
			redirect(ADMIN_PATH.'/currency/display_currency_list');
		}
	}
	public function change_currency_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->user_model->activeInactiveCommon(CURRENCY,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','User records deleted successfully');
			}else {
				$this->setErrorMessage('success','User records status changed successfully');
			}
			redirect(ADMIN_PATH.'/currency/display_currency_list');
		}
	}
	public function change_currency_status(){
		if ($this->checkLogin('A') == ''){
			redirect(ADMIN_PATH);
		}else {
			$mode = $this->uri->segment(4,0);
			$id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			//echo $status; die;
			$newdata = array('status' => $status);
			$condition = array('id' => $id);
			$this->currency_model->update_details(CURRENCY,$newdata,$condition);
			$this->setErrorMessage('success','Currency Status Changed Successfully');
			redirect(ADMIN_PATH.'/currency/display_currency_list');
		}
	}
	
	public function make_default(){
		if ($this->checkLogin('A') == ''){
			redirect(ADMIN_PATH);
		}else {
			$id = $this->uri->segment(4,0);
			$newdata = array('default_currency' => 'No');
			$condition = array();
			$this->currency_model->update_details(CURRENCY,$newdata,$condition);
			$newdata = array('default_currency' => 'Yes', 'currency_rate' => '1.00');
			$condition = array('id' => $id);
			$this->currency_model->update_details(CURRENCY,$newdata,$condition);
			$defaultCurrencyQuery = $this->currency_model->get_all_details(CURRENCY,$condition);
			$defaultCurrency = $defaultCurrencyQuery->row()->currency_type;
			$this->db->query("ALTER TABLE  `fc_product` CHANGE  `currency`  `currency` VARCHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  '".$defaultCurrency."'");
			$this->setErrorMessage('success','Default Currency Changed Successfully');
			redirect(ADMIN_PATH.'/currency/display_currency_list');
		}
	}
}