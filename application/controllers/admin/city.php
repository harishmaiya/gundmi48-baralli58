<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * 
 * This controller contains the functions related to city management 
 * @author dev Beetrut
 *
 */

class City extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation','resizeimage'));		
		$this->load->model('city_model');
		
		if ($this->checkPrivileges('City',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the city list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/city/display_city_list');
		}
	}
	
	/**
	 * 
	 * This function loads the city list page
	 */
	public function display_city_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'City List';
			$condition = array();
			$this->data['cityList'] = $this->city_model->get_all_details(CITY_NEW,$condition);
			$this->load->view('admin/city/display_city',$this->data);
		}
	}
	
	public function display_featured_cities(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Featured Locations';
			$condition = array('featured'=>'1');
			$this->data['cityList'] = $this->city_model->get_all_details(CITY_NEW,$condition);
			$this->load->view('admin/city/featured_cities',$this->data);
		}
	}
	
	public function save_list_order(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$condition = array('id'=>$this->input->post('id'));
			$data = array('view_order'=>$this->input->post('value'));
			$this->city_model->update_details(CITY_NEW,$data,$condition);
		}
	}
	/**
	 * 
	 * This function loads the city list page
	 */
		
	/**
	 * 
	 * This function loads the add new city form
	 */
	public function add_city_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New city';
			$this->load->view('admin/city/add_city',$this->data);
		}
	}
	
	
	
	/**
	 * 
	 * This function insert and edit a city
	 */
	public function insertEditcity(){
	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$city_id = $this->input->post('city_id');
			$city_name = $this->input->post('name');
			
			$s_name =$this->input->post('stateid');
			$seourl = url_title($city_name, '-', TRUE);
			
			$seourl_state = url_title($state_name, '-', TRUE);
			
			if ($city_id == ''){
				$condition = array('name' => $city_name);
				$duplicate_name = $this->city_model->get_all_details(CITY_NEW,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','City name already exists');
					redirect('admin/city/add_city_form');
				}
			}
			$excludeArr = array("city_id","status","citylogo","citythumb","featured","neighborhoods");
			$excludeArr1 = array("city_id","status","citylogo","citythumb","featured","neighborhoods","get_around","known_for","stateid","tags","short_description","name");
			$inputArr['seourl']= $seourl;
			if ($this->input->post('status') != ''){
				$city_status = 'Active';
			}else {
				$city_status = 'InActive';
			}
			if ($this->input->post('featured') != ''){
				$featured = '1';
			}else {
				$featured = '0';
				
			}
			$city_data=array();
			$inputArr['status']= $city_status;
		
			$inputArr['featured']= $featured;
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['max_size'] = 10000;
			$config['upload_path'] = './images/city';
			$uploaddir = "images/city/";
			$uploaddirMobile = "images/city/mobile/";	//a directory inside
			$uploaddirResize = "images/city/thumb/";	//a directory inside
			$this->load->library('upload', $config);
			if ( $this->upload->do_upload('citythumb')){
				$imgDetails = $this->upload->data();
				@copy($uploaddir.$imgDetails['file_name'], $uploaddirResize.$imgDetails['file_name']);
				@copy($uploaddir.$imgDetails['file_name'], $uploaddirMobile.$imgDetails['file_name']);
				$this->ImageResizeWithCrop(690, 300, $imgDetails['file_name'], $uploaddirResize);
				$this->ImageResizeWithCrop(350, 300, $imgDetails['file_name'], $uploaddirMobile);
				$this->ImageResizeWithCrop(350, 300, $imgDetails['file_name'], $uploaddir);
		    	$inputArr['citythumb'] = $imgDetails['file_name'];
		    	$inputArr['citylogo'] = $imgDetails['file_name'];
			}
			$dataArr = array_merge($inputArr,$city_data);
			$condition = array('id' => $city_id);
			if ($city_id == ''){
				$this->city_model->commonInsertUpdate(CITY_NEW,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','City added successfully');
			}else {
				$this->city_model->commonInsertUpdate(CITY_NEW,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','City updated successfully');
			}
			redirect('admin/city/display_city_list');
		}
	}
	
	
	
	/**
	 * 
	 * This function loads the edit city form
	 */
	public function edit_city_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit city';
			$city_id = $this->uri->segment(4,0);
			$condition = array('id' => $city_id);
			$this->data['city_details'] = $this->city_model->get_all_details(CITY_NEW,$condition);
			if ($this->data['city_details']->num_rows() == 1){
			
				$this->load->view('admin/city/edit_city',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	
	/**
	 * 
	 * This function change the city status
	 */
	public function change_city_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->city_model->update_details(CITY_NEW,$newdata,$condition);
			$this->setErrorMessage('success','City Status Changed Successfully');
			redirect('admin/city/display_city_list');
		}
	}
	
	public function change_featured_city_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->city_model->update_details(CITY_NEW,$newdata,$condition);
			$this->setErrorMessage('success','City Status Changed Successfully');
			redirect('admin/city/display_featured_cities');
		}
	}
	
	/**
	 * 
	 * This function loads the city view page
	 */
	public function view_city(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View city';
			$city_id = $this->uri->segment(4,0);
			$condition = array('id' => $city_id);
			$this->data['city_details'] = $this->city_model->get_all_details(CITY_NEW,$condition);
			if ($this->data['city_details']->num_rows() == 1){
				$this->load->view('admin/city/view_city',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	
	
	/**
	 * 
	 * This function delete the city record from db
	 */
	public function delete_city(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$city_id = $this->uri->segment(4,0);
			$condition = array('id' => $city_id);
			$this->city_model->commonDelete(CITY_NEW,$condition);
			$this->setErrorMessage('success','City deleted successfully');
			redirect('admin/city/display_city_list');
		}
	}
	
	
	// get location added by siva (6-10-2015)
	public function get_location() {
		$address = $this->input->post('address');
		$retrnstr['location'] = '';
		$retrnstr['city'] = '';
		$retrnstr['state'] = '';
		$retrnstr['country'] = '';
		$retrnstr['lat'] = '';
		$retrnstr['long'] = '';
		$address = str_replace(" ", "+", $address);
		$json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=$google_map_api");
		$json = json_decode($json);
		$newAddress = $json->{'results'}[0]->{'address_components'};
		foreach($newAddress as $nA)
		{
			if($nA->{'types'}[0] == 'locality')$retrnstr['location'] = $nA->{'long_name'};
			if($nA->{'types'}[0] == 'administrative_area_level_2')$retrnstr['city'] = $nA->{'long_name'};
			if($nA->{'types'}[0] == 'administrative_area_level_1')$retrnstr['state'] = $nA->{'long_name'};
			if($nA->{'types'}[0] == 'country')$retrnstr['country'] = $nA->{'long_name'};
		}
		if($retrnstr['city'] == '')
		$retrnstr['city'] = $retrnstr['location'];$retrnstr['lat'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		$retrnstr['lang'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		
		echo json_encode($retrnstr);
	}
	
	public function change_city_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->city_model->activeInactiveCommon(CITY_NEW,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Cities deleted successfully');
			}else {
				$this->setErrorMessage('success','Cities status changed successfully');
			}
			redirect('admin/city/display_city_list');
		}
	}
	// end get address
}

/* End of file city.php */
/* city: ./application/controllers/admin/city.php */