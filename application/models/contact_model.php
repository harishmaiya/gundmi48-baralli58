<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Contact_model extends My_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function UpdateActiveStatus($table='',$data=''){
		$query =  $this->db->get_where($table,$data);
		return $result = $query->result_array();
	}
	
	function Display_ContactInfo($condition='')
	{
		$this->db->select('c.*,p.product_name,u.firstname,u.lastname');
		$this->db->from(CONTACT.' as c');
		$this->db->join(PRODUCT.' as p',"c.rental_id=p.id","LEFT");
		$this->db->join(USERS.' as u',"c.renter_id=u.id","LEFT");
		if(!empty($condition)){
			$this->db->where('p.id',$condition);
			$this->db->order_by('c.id','desc');
		}else{
			$this->db->where('c.id !=','');
			$this->db->order_by('c.id','desc');
		}
		//$this->db->where('p.status','Publish');
		return $query = $this->db->get();
		//echo $this->db->last_query();
	//	return $result =$query->result_array();
		//echo "<pre>";print_r($result);die;
	}
	
	
	/** Get Contact Details **/
	
	public function SelectAllContactInfo(){
	//print_r($OrderAsc);die;

		$this->db->select('*');
		$this->db->from(RENTALENQUIRY);
		//$this->db->where('status','Active');
		//$this->db->order_by('name','asc');
		$query =  $this->db->get();
		return $result = $query->result_array();
	}
	
	
	
	function insert_contact_info($inputArr=''){
	
		$dataArr = array(
			'firstname'		=>	$this->input->post('first_name'),
			'lastname'		=>	$this->input->post('last_name'),
			'adults'		=>	$this->input->post('Adult'),
			'children'		=>	$this->input->post('Children'),
			'email'			=>	$this->input->post('email_address'),
			'mobile_no'		=>	$this->input->post('ph_no'),
			'message'		=>	$this->input->post('Message'),
			'arrival_date'	=>	$this->input->post('Arr_date'),
			'departure_date' =>  $this->input->post('Dep_date'),
			'renter_id'		=>	$this->input->post('renter_id'),
			'enquiry_timezone'		=>	$this->input->post('enquiry_timezone'),
			'rental_id'		=>	$this->input->post('rental_id'),
			'read_staus'		=>	'UnRead',
			'user_read_status'		=>	'UnRead',
			'customer_id'	=>	$this->input->post('customer_id')
		);
		
		$finalArr = array_merge($dataArr,$inputArr);
		
		//echo '<pre>';print_r($finalArr);die;
		$Query = $this->db->insert(CONTACT,$finalArr);
		//echo $this->db->last_query();die;
		return $Query;
	}
	function get_contactAll_details($contactgorup='',$contactorder=''){

	//echo "<pre>";print_r($contactorder);die;
		$this->db->select('c.*,p.product_name,u.firstname,u.lastname,u.contact_count,p.contact_count as rental_count');
		$this->db->from(RENTALENQUIRY.' as c');
		$this->db->join(PRODUCT.' as p',"c.prd_id=p.id","LEFT");
		$this->db->join(USERS.' as u',"c.renter_id=u.id","LEFT");
		$this->db->where('p.status','Publish');
		$this->db->group_by($contactgorup);
		foreach($contactorder as $conkey=>$conVal) {
			$this->db->order_by($conkey,$conVal);
		}
		$this->db->limit('5');
		//$this->db->get();
		//echo $this->db->last_query();die;
		//echo "<pre>";print_r($result);die;
		return $query = $this->db->get();
	}
	function get_contactViewAll_details($contactgorup=''){

		$this->db->select('c.*,p.product_title,u.firstname,u.lastname,u.email');
		$this->db->from(RENTALENQUIRY.' as c');
		$this->db->join(PRODUCT.' as p',"c.prd_id=p.id","LEFT");
		$this->db->join(USERS.' as u',"c.renter_id=u.id","LEFT");
		//$this->db->group_by($contactgorup);
		
		//$this->db->get();
		//echo $this->db->last_query();die;
		//echo "<pre>";print_r($result);die;
		return $query = $this->db->get();
	}
	
	function get_contactView_details($contactgorup=''){

		$this->db->select('c.*,p.product_title,u.firstname,u.lastname,u.email');
		$this->db->from(RENTALENQUIRY.' as c');
		$this->db->join(PRODUCT.' as p',"c.prd_id=p.id","LEFT");
		$this->db->join(USERS.' as u',"c.renter_id=u.id","LEFT");
		$this->db->where('c.id',$contactgorup);
		//$this->db->group_by($contactgorup);
		
		//$this->db->get();
		//echo $this->db->last_query();die;
		//echo "<pre>";print_r($result);die;
		return $query = $this->db->get();
	}
	
}