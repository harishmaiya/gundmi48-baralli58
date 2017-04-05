<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** *  * Landing page functions * @author dev Beetrut * */

class Landing extends MY_Controller 
{	
	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form','email','text'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->library( 'jquery_stars' );
		$this->load->model(array('landing_model'));
		$this->data['loginCheck'] = $this->checkLogin('U');
	}
	
	/* Landing Page Start */
	public function index(){
		$this->data['heading'] = '';
	 	$this->data['CityDetails'] = $this->landing_model->get_featured_city();
		$this->data['sliderList'] = $this->landing_model->get_all_details(SLIDER,array('status'=>'Active'));
		$condition=array('id'=>1);
		$listValues = $this->landing_model->get_all_details(LISTINGS,array('id'=>1));
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
		$enableRslt = $this->landing_model->get_all_details(ADMIN_SETTINGS,$condition);
		$this->data['featuredLists'] = $this->landing_model->get_featured_lists();
		$this->data['adminList'] = $enableRslt->row();
		$this->load->view('site/landing/landing',$this->data);
	}		
	
	/* Landing Page End*/
	
	function fbLogin()	
	{		
		$rUrl = $this->input->post('rUrl');
		$userdata = array('rUrl'=>$rUrl);
		$this->session->set_userdata($userdata);
	}
}
/* End of file landing.php */
/* Location: ./application/controllers/site/landing.php */