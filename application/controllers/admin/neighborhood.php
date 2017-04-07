<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * 
 * This controller contains the functions related to neighborhood management 
 * @author dev Beetrut
 *
 */

class Neighborhood extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('neighborhood_model');$this->load->model('city_model');
		if ($this->checkPrivileges('neighborhood',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the neighborhood list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/neighborhood/display_neighborhood_list');
		}
	}
	
	/**
	 * 
	 * This function loads the neighborhood list page
	 */
	public function display_neighborhood_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Neighborhood List';
			$condition = array();
			$this->data['cityList'] = $this->neighborhood_model->get_all_detailsNeighborhood();
			//$condition1 = array('id' => $this->data['cityList']->row()->neighborhood);
			//$this->data['StateList'] = $this->neighborhood_model->get_all_details(CITY,array('status'=>''));
			
			
			
			$this->load->view('admin/neighborhood/display_neighborhood',$this->data);
		}
	}
	/**
	 * 
	 * This function loads the neighborhood list page
	 */
	public function display_neighborhood_statelist(){ 
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'State neighborhood List';
			$stateneighborhood_id = $this->uri->segment(4,0);
			$condition = array('country_id' => $stateneighborhood_id);
			$this->data['neighborhoodList'] = $this->neighborhood_model->get_all_details(CITY,$condition);
			$this->load->view('admin/neighborhood/display_neighborhood',$this->data);
		}
	}
	
	
	/**
	 * 
	 * This function loads the add new neighborhood form
	 */
	public function add_neighborhood_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New neighborhood';
			$this->data['PrimaryNhDisplay'] = $this->city_model->SelectAllPrimaryCities();
			$this->data['categoryArr'] = $this->neighborhood_model->get_all_details(PRODUCT_ATTRIBUTE,array('status' =>'Active'));
			$this->data['stateDisplay'] = $this->neighborhood_model->SelectAllCountry();
			$this->load->view('admin/neighborhood/add_neighborhood',$this->data);
		}
	}
	/**
	 * 
	 * This function insert and edit a neighborhood
	 */
	public function insertEditneighborhood(){
	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$neighborhood_id = $this->input->post('city_id');
			$neighborhood_name = $this->input->post('name');
			//$tags = $this->input->post('tags');
			$seourl = url_title($neighborhood_name, '-', TRUE);
			if ($neighborhood_id == ''){
				$condition = array('name' => $neighborhood_name);
				$duplicate_name = $this->neighborhood_model->get_all_details(NEIGHBORHOOD,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','Neighborhood name already exists');
					redirect('admin/neighborhood/add_neighborhood_form');
				}
			}
			$excludeArr = array("city_id","status","citylogo","citythumb","neighborhoods","featured");
			
			if ($this->input->post('featured') != ''){
				$featured = '1';
			}else {
				$featured = '0';
				
			}
			$inputArr['featured']= $featured;
			$inputArr['seourl']= $seourl;
			if ($this->input->post('status') != ''){
				$neighborhood_status = 'Active';
			}else {
				$neighborhood_status = 'InActive';
			}
			
			$inputArr['neighborhoods']='';
			
			
				$inputArr['neighborhoods']=$_POST['neighborhoods'];
			
			
			$inputArr['category']='';
			
			if(!empty($_POST['category'])){
				$inputArr['category']=implode(',',$_POST['category']);
			}
			//print_r($this->input->post('neighborhoods'));die;
			//echo $this->input->post('neighborhoods');
					  // $add = str_replace(" ","-",$neighborhood_name);

                       	/*$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$seourl.'&sensor=false');
                       	$output= json_decode($geocode);
                       
                      
						$inputArr['latitude'] = $output->results[0]->geometry->location->lat;
                        $inputArr['longitude'] = $output->results[0]->geometry->location->lng;
						
            
                       	$this->load->library('googlemaps');
 						$this->googlemaps->initialize($config);*/
			
			
			$neighborhood_data=array();
			$inputArr['status']= $neighborhood_status;
		
			//$inputArr['featured']= $featured;
			/*$datestring = "%Y-%m-%d %H:%M:%S";
			$time = time();
			if ($neighborhood_id == ''){
				$neighborhood_data = array(
					'dateAdded'	=>	mdate($datestring,$time),
				);
			}*/
			$config['overwrite'] = FALSE;
		    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
			    $config['max_size'] = 2000;
			    $config['upload_path'] = './images/city';
			    $this->load->library('upload', $config);
				if ( $this->upload->do_upload('citylogo')){
			    	$logoDetails = $this->upload->data();
					$logoDetails['file_name'];
					$this->imageResizeWithSpaceCity(1300, 700, $logoDetails['file_name'], './images/city/');
					
			    	$inputArr['citylogo'] = $logoDetails['file_name'];
				}
				if ( $this->upload->do_upload('citythumb')){
					$feviconDetails = $this->upload->data();
			    	$inputArr['citythumb'] = $feviconDetails['file_name'];
				}
			$dataArr = array_merge($inputArr,$neighborhood_data);

			$condition = array('id' => $neighborhood_id);
			
			//print_r($dataArr);die;
			
			if ($neighborhood_id == ''){
				$this->neighborhood_model->commonInsertUpdate(NEIGHBORHOOD,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Neighborhood added successfully');
			}else {
				$this->neighborhood_model->commonInsertUpdate(NEIGHBORHOOD,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Neighborhood updated successfully');
			}
			redirect('admin/neighborhood/display_neighborhood_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit neighborhood form
	 */
	public function edit_neighborhood_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit neighborhood';
			$neighborhood_id = $this->uri->segment(4,0);
			$condition = array('id' => $neighborhood_id);
			$this->data['PrimaryNhDisplay'] = $this->city_model->SelectAllPrimaryCities();
			//$this->data['stateDisplay'] = $this->neighborhood_model->SelectAllCountry();
			$this->data['categoryArr'] = $this->neighborhood_model->get_all_details(PRODUCT_ATTRIBUTE,array('status' =>'Active'));
			$this->data['city_details'] = $this->neighborhood_model->get_all_details(NEIGHBORHOOD,$condition);
			if ($this->data['city_details']->num_rows() == 1){
			
				$this->load->view('admin/neighborhood/edit_neighborhood',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function change the neighborhood status
	 */
	public function change_neighborhood_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->neighborhood_model->update_details(CITY,$newdata,$condition);
			$this->setErrorMessage('success','Neighborhood Status Changed Successfully');
			redirect('admin/neighborhood/display_neighborhood_list');
		}
	}
	
	/**
	 * 
	 * This function loads the neighborhood view page
	 */
	public function view_neighborhood(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View neighborhood';
			$neighborhood_id = $this->uri->segment(4,0);
			$condition = array('id' => $neighborhood_id);
			$this->data['PrimaryNhDisplay'] = $this->city_model->SelectAllPrimaryCities();
			//$this->data['stateDisplay'] = $this->neighborhood_model->SelectAllCountry();
			$this->data['categoryArr'] = $this->neighborhood_model->get_all_details(PRODUCT_ATTRIBUTE,array('status' =>'Active'));
			$this->data['city_details'] = $this->neighborhood_model->get_all_details(NEIGHBORHOOD,$condition);
			if ($this->data['city_details']->num_rows() == 1){
			
				$this->load->view('admin/neighborhood/view_neighborhood',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the neighborhood record from db
	 */
	public function delete_neighborhood(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$neighborhood_id = $this->uri->segment(4,0);
			$condition = array('id' => $neighborhood_id);
			$this->neighborhood_model->commonDelete(NEIGHBORHOOD,$condition);
			$this->setErrorMessage('success','Neighborhood deleted successfully');
			redirect('admin/neighborhood/display_neighborhood_list');
		}
	}
	
}

/* End of file city.php */
/* city: ./application/controllers/admin/city.php */