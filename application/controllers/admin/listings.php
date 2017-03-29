<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to listings management 
 * @author Teamtweaks
 *
 */

class Listings extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('listings_model');
		
		if ($this->checkPrivileges('Listing',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
	
	/*
	*Load contens for rooms and beds for listings
	*
	*/
	public function rooms_and_beds() {
		//$condition=array('id'=>1);
		$this->data['listDetail'] = $this->listings_model->get_all_data(LISTING_TYPES);	
		$this->data['listvalues'] = $this->listings_model->get_all_values(LISTING);
				foreach($this->data['listvalues'] as $result)
					{
						$data = $result->listing_values;	
					}
					$this->data['finalVal'] = json_decode($data);
					//var_dump($this->data);die;
								
		$this->load->view('admin/listings/rooms_and_beds',$this->data);
	}
	
	/*
	*Load contens for listings informations for listings
	*
	*/
	public function listings_info() {
		$condition=array('id'=>1);
		$this->data['listDetail'] = $this->listings_model->get_all_details(LISTINGS,$condition);	
		$this->load->view('admin/listings/listings_info',$this->data);
	}
	
	public function add_new_attribute()
	{
	if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$id=$this->uri->segment(4,0);
			
			if($id != ''){
			$this->data['heading'] = 'Edit Attribute';
			$this->data['details'] = $this->listings_model->get_all_details(LISTING_TYPES, array('id'=>$id));
/* echo "<pre>";	print_r($data->result()); */
			}
			else
			$this->data['heading'] = 'Add New Attribute';
			
			$this->load->view('admin/listings/add_new_attribute',$this->data);
		}
	
	}

	/*
	*Save rooms and beds for listings
	*
	*/
	 public function insertlistings_roomsandbed() {		
		$condition=array('id'=>1);
		if($this->input->post())
		{
		 
		$postValues = $this->input->post();
		
		foreach($postValues as $listName => $lsitValues ){
		
			$dataArr[$listName]= $lsitValues;
		}
			$finalVal=json_encode($dataArr);
			
			
		}
	
		$listvalues = $this->listings_model->get_all_details(LISTINGS,$condition);	
		$listArr=array('listing_values'=>$finalVal);
		//$this->listings_model->update_details(LISTINGS,$listArr,$condition);
		 if($listvalues->num_rows()==1){
			$this->listings_model->update_details(LISTINGS,$listArr,$condition);
		}else{
			$this->listings_model->simple_insert(LISTINGS,$listArr);
		} 
		
		redirect('admin/listings/rooms_and_beds');
	} 
	
 public function insert_attribute()
{ 
		$id=$this->input->post('id');
		//echo $id;die;
		
		$attribute_name = str_replace(' ','_',$this->input->post('attribute_name'));
		$type = $this->input->post('type');
		$label_name = $this->input->post('label_name');
		$status = $this->input->post('status');
		/*--Hogan--*/
		if($attribute_name ==''){
				$this->setErrorMessage('error','Please enter listing name');
				redirect('admin/listings/add_new_attribute/');
			}
		if($label_name ==''){
				$this->setErrorMessage('error','Please enter label name');
				redirect('admin/listings/add_new_attribute/');
			}
		if ($this->input->post('status') != ''){
				$status_value = 'Active';
			}else {
				$status_value = 'InActive';
			}
		/* if($status == 'on' || $status == 'off')
		{
		$status_value ="Active"; 
		} 
		
		
		--Hogan ends--
		*
		*/
		if($id !== '')
		{
		$condition = array('id'=>$id,'name'=>$attribute_name,'status'=>$status_value,'type'=>$type,'labelname'=>$label_name);
		
		$this->listings_model->simple_updates($condition,$id);
		redirect('admin/listings/attribute_values');
		
		}
		else
		{ 
		$condition = array('name'=>$attribute_name,'status'=>$status_value,'type'=>$type,'labelname'=>$label_name);
		$listing_values = $this->listings_model->get_all_details(LISTINGS,array('id'=>'1'));
		
		$listingEncodeValue = $listing_values->row()->listing_values;
		$listingDecodeValue = json_decode($listingEncodeValue);
		foreach($listingDecodeValue as $listName => $lsitValues ){
		
			$dataArr[$listName]= $lsitValues;
		}
		$dataArr[$attribute_name] = '';
			$finalVal=json_encode($dataArr);
		$this->listings_model->update_details(LISTINGS,array('listing_values'=>$finalVal),array('id'=>'1'));
		$this->listings_model->simple_insert(LISTING_TYPES,$condition);
		redirect('admin/listings/attribute_values');
		}
}

public function attribute_values()
{
		$this->data['heading'] = 'Listing Types';
		$this->data['listingvalues'] = $this->listings_model->get_all_data();
		//echo '<pre>';	print_r($this->data['listingvalues']); die;
		$this->load->view('admin/listings/listing_types',$this->data);

}
public function delete_list($id='')
{ 
		$id = $this->uri->segment(4,0);
		$listingValues = $this->listings_model->get_all_datas($id);
		foreach($listingValues as $result)	  
		{
		 $data = $result->name;
		}
		$listing_values = $this->listings_model->get_all_details(LISTINGS,array('id'=>'1'));
	foreach($listing_values->result() as $list)	  
		
		{
		 //echo $list->listing_values;
		 $restult_listing = $list->listing_values;
		 //echo $data;
		}
		$result_decode = json_decode($restult_listing);
		foreach($result_decode as $listName => $keyValues){
		
		if($data != $listName){
		//echo $listName;
		$finla_listing[$listName] = $keyValues;
		}
		
		}
		
		$this->listings_model->update_details(LISTINGS,array('listing_values'=>json_encode($finla_listing)),array('id'=>'1'));
		$this->listings_model->delete_listing($id);
		redirect('admin/listings/attribute_values');

	}
	
	public function change_list_types_status_global(){
	
		if(count($this->input->post('checkbox_id')) > 0 &&  $this->input->post('statusMode') != ''){
			$this->listings_model->activeInactiveCommon(LISTING_TYPES,'id');
			if (strtolower($this->input->post('statusMode')) == 'delete'){
				$this->setErrorMessage('success','List types deleted successfully');
			}
			redirect('admin/listings/attribute_values');
		}
	}
   
}



/* End of file listings.php */
/* Location: ./application/controllers/admin/listings.php */