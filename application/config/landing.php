<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** *  * Landing page functions * @author Teamtweaks * */

class Landing extends MY_Controller 
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('cookie','date','form','email','text'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->library( 'jquery_stars' );
		$this->load->model(array('product_model','city_model','admin_model','cms_model','landing_model','slider_model'));
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->product_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];
		if($_SESSION['sColorLists'] == ''){
			
		}		
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
			$this->data['likedProducts'] = $this->product_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
	 	}
	}   	
	public function index()
	{
		$this->data['heading'] = '';
	 	$this->data['totalProducts'] = $this->product_model->get_total_records(PRODUCT);
		$this->data['CityDetails'] = $this->city_model->Featured_city();
		$this->data['CityCountDetails'] = $this->city_model->CityCountDisplay('neighborhoods,count(neighborhoods) as CityCountVal','neighborhoods',NEIGHBORHOOD);
		$this->data['SliderList'] = $this->slider_model->get_slider_details('WHERE status="Active"');
		$this->data['sliderList'] = $this->slider_model->get_all_details(SLIDER,$condition);
		$condition=array('id'=>1);
		$listValues = $this->product_model->get_all_details(LISTINGS,array('id'=>1));
		foreach ($listValues->result() as $result){	
			$values = $result->listing_values;
		}
		$roombedVal=json_decode($values);
		foreach ($roombedVal as $key => $values)		
		{
			$listing_values[$key] = $values;
		}
		if($listing_values['accommodates'] != ''){
			$accommodates= explode(',',$listing_values['accommodates']);
		}
		else{
			$accommodates= '';
		}
		$this->data['accommodates'] = $accommodates;
		$condition = array('id'=>'1');
		$enableRslt = $this->slider_model->get_all_details(ADMIN_SETTINGS,$condition);
		$this->data['adminList'] = $enableRslt->row();
		$this->load->view('site/landing/landing',$this->data);
	}		
	
	public function display_cms_trips($product_id,$reviewer_id)	
	{		
		$product_id = $this->input->post('product_id');
		$reviewer_id = $this->input->post('reviewer_id');
		$this->data['reviewData'] = $this->product_model->get_trip_review($product_id,$reviewer_id);
		$data = $this->load->view('site/cms/rating',$this->data);
		if($this->data['reviewData']->num_rows>0)		
		{
			$res['count']='1';
			$res['data']=$data;
		}
		else {
			$res['count']='0';
		}
		echo json_encode($res);
	}

	public function display_product_detail($seourl)	
	{
		$where1 = array('p.status'=>'Publish','p.id'=>$seourl);
		$where_or = array('p.status'=>'Publish') ;
		$where2 = array('p.status'=>'Publish','p.id'=>$seourl);
		$this->load->model('admin_model');
		$this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
		$this->data['productDetails'] = $this->product_model->view_product_details_site_one($where1,$where_or,$where2);
		if($this->data['productDetails']->row()->id==''){
			$this->setErrorMessage('error','List details not available');
			redirect(base_url());
		}
		$this->data['productImages'] = $this->product_model->get_images($this->data['productDetails']->row()->id);
		$this->data['reviewData'] = $this->product_model->get_review($this->data['productDetails']->row()->id);
		if($this->checkLogin('U') != '')		
		{
			$this->data['user_reviewData'] = $this->product_model->get_review($this->data['productDetails']->row()->id,$this->checkLogin('U'));
			$this->data['reviewData'] = $this->product_model->get_review_other($this->data['productDetails']->row()->id,$this->checkLogin('U'));
		}
		$this->data['reviewTotal'] = $this->product_model->get_review_tot($this->data['productDetails']->row()->id);
		$product_id = $this->data['productDetails']->row()->id;
		$this->data['product_details'] = $this->product_model->view_product1($product_id);
		$this->data['RatePackage']='';
		$this->data['heading'] = $this->data['productDetails']->row()->meta_title;
		if ($this->data['productDetails']->row()->meta_title != '')
		{	
			$this->data['meta_title'] = $this->data['productDetails']->row()->meta_title;
		}
		if ($this->data['productDetails']->row()->meta_keyword != '')
		{	    	
			$this->data['meta_keyword'] = $this->data['productDetails']->row()->meta_keyword;
		}
		if ($this->data['productDetails']->row()->meta_description != '')
		{	    	
			$this->data['meta_description'] = $this->data['productDetails']->row()->meta_description;
		}
		$this->data['listDetail'] = $this->product_model->get_all_details(PRODUCT,array('status'=>'Active'));
        $this->data['listNameCnt'] = $this->product_model->get_all_details(ATTRIBUTE,array('status'=>'Active'));
		$this->data['listValueCnt'] = $this->product_model->get_all_details(LIST_VALUES,array('status'=>'Active'));
		$this->data['listItems'] = $this->product_model->get_all_details(ATTRIBUTE,array('status'=>'Active'));
		$wishlists= $this->product_model->get_all_details(LISTS_DETAILS, array('user_id'=>$this->checkLogin ( 'U' )));
		$newArr = array();
		foreach($wishlists->result() as $wish)		
		{			
			$newArr = array_merge($newArr , explode(',', $wish->product_id));
		}
		$this->data ['newArr'] = $newArr;
		$this->data['SublistDetail'] = $this->product_model->get_all_details(LIST_SUB_VALUES,$contition);
		$rental_category_subcategory=$this->product_model->amenities_main_sub_category($this->data['product_details']->row()->list_name);
	    $this->data['subcategory']=$rental_category_subcategory;
        $listIdArr=array();
		foreach($this->data['listValueCnt']->result_array() as $listCountryValue)
		{
			$listIdArr[]=$listCountryValue['list_id'];
		}	
		$this->data['ChkWishlist']='0';
		if($this->checkLogin('U') > 0 )
		{
			$this->data['getWishList'] = $this->product_model->ChkWishlistProduct($this->data['productDetails']->row()->id,$this->checkLogin('U'));
			$this->data['ChkWishlist']=$this->data['getWishList']->num_rows();
		}		
		$this->data['DistanceQryArr'] = $this->product_model->view_product_details_distance_list($this->data['productDetails']->row()->latitude,$this->data['productDetails']->row()->longitude,' p.id <> '.$this->data['productDetails']->row()->id.' and  p.status="Publish" group by p.id order by p.id  DESC');
		$this->data['ConfigBooking'] = $this->product_model->get_all_details(BOOKINGCONFIG,array('cal_url'=>base_url()));
		if($this->data['ConfigBooking']->num_rows()=='')
		{			
			$this->product_model->update_details(BOOKINGCONFIG,array('cal_url'=>base_url()),array());
		}		/*-Muthu-*/		$this->data['CalendarBooking'] = $this->product_model->get_all_details(CALENDARBOOKING,array('PropId'=>$this->data['productDetails']->row()->id));
		if($this->data['CalendarBooking']->num_rows() > 0)
		{	
			foreach($this->data['CalendarBooking']->result()  as $CRow){
				$DisableCalDate .='"'.$CRow->the_date.'",';
			}
			$this->data['forbiddenCheckIn']='['.$DisableCalDate.']';
		}
		else
		{
			$this->data['forbiddenCheckIn']='[]';
			$this->data['forbiddenCheckOut']='[]';
		}
		$all_dates = array();
		$selected_dates = array();
		foreach($this->data['CalendarBooking']->result()  as $date)
		{	
			$all_dates[] = trim($date->the_date);
			$date1 = new DateTime(trim($date->the_date));
			$date2 = new DateTime($prev);
			$diff = $date2->diff($date1)->format("%a");
			if($diff == '1')
			{	
				$selected_dates[] = trim($date->the_date);
			}	
			$prev = trim($date->the_date);
			$DisableCalDate = '';
			foreach($all_dates as $CRow)
			{
				$DisableCalDate .= '"'.$CRow.'",';
			}	
			$this->data['forbiddenCheckIn']='['.$DisableCalDate.']';
			$DisableCalDate = '';
			foreach($selected_dates as $CRow)
			{
				$DisableCalDate .= '"'.$CRow.'",';
			}	
			$this->data['forbiddenCheckOut']='['.$DisableCalDate.']';
		}	
		/*Muthu*/	
		$service_tax_query='SELECT * FROM '.COMMISSION.' WHERE seo_tag="guest-booking" AND status="Active"';
		$this->data['service_tax']=$this->product_model->ExecuteQuery($service_tax_query);
		$this->data['ProductDealPrice']=$this->product_model->get_all_details(PRODUCT_DEALPRICE,array('product_id'=>$seourl));
		$this->load->view('site/rentals/product_detail',$this->data);
	}	
	
	function fbLogin()	
	{		
		$rUrl = $this->input->post('rUrl');
		$userdata = array('rUrl'=>$rUrl);
		$this->session->set_userdata($userdata);
	}
}
/* End of file landing.php */
/* Location: ./application/controllers/site/landing.php */