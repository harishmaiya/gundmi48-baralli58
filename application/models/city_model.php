<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author dev Beetrut
 *
 */
class City_model extends My_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function UpdateActiveStatus($table='',$data=''){
		$query =  $this->db->get_where($table,$data);
		return $result = $query->result_array();
	}
	
	public function SelectAllCountry(){
	//print_r($OrderAsc);die;

		$this->db->select('*');
		$this->db->from(STATE_TAX);
		//$this->db->where('status','Active');
		$this->db->order_by('id','asc');
		$query =  $this->db->get();
		
//echo $this->db->last_query();die;
		return $result = $query->result_array();
	}
	
	
	
	
	public function SelectAllPrimaryCities(){
		$this->db->select('id,name');
		$this->db->from(CITY);
		$this->db->where('status','Active');
		$this->db->where('featured','1');
		$this->db->order_by('id','asc');
		$query =  $this->db->get();
		
//echo $this->db->last_query();die;
		return $result = $query->result_array();
	}
	public function State_city(){
		$this->db->select('p.*,u.name,u.status,u.description,u.citylogo,u.citythumb,u.seourl as cityurl');
		$this->db->from(STATE_TAX.' as p');
		$this->db->join(CITY.' as u' , 'p.id = u.stateid');
		$this->db->group_by('p.id'); 
		$city = $this->db->get();
		
		//echo $this->db->last_query();
	//	return $result =$query->result_array();
		//echo "<pre>";print_r($result);die;
		return $city;
	}
	
	
	public function Featured_city(){
		$this->db->select('u.*,u.seourl as cityurl,count(u.id) as NCount');
		$this->db->from(CITY.' as u');
		$this->db->join(NEIGHBORHOOD.' as n' , 'u.id = n.neighborhoods','LEFT');
		$this->db->where('u.status','Active','u.featured','1');
		$this->db->where('u.featured','1');
		$this->db->group_by('u.id');
		$this->db->order_by('u.view_order');
		$city = $this->db->get();
		
		//echo $this->db->last_query();die;
	//	return $result =$query->result_array();
		//echo "<pre>";print_r($result);die;
		return $city;
	}
	
	
	public function Featured_city1(){
    	$this->db->select(CITY.'.*,'.CITY.'.seourl as cityurl');
		$this->db->from(CITY);
		//$this->db->where('u.status','Active','u.featured','1');
		//$this->db->where('u.featured','1');
		//$this->db->join(STATE_TAX,STATE_TAX.'.id = '.CITY.'.stateid');
	//	$this->db->join(COUNTRY_LIST,COUNTRY_LIST.'.id = '.STATE_TAX,STATE_TAX.'.id = '.CITY.'.stateid');

		//$this->db->where('.COUNTRY_LIST,COUNTRY_LIST.'.id NOT IN ('.STATE_TAX,STATE_TAX.'.id = '.CITY.'.stateid')', NULL, FALSE);
		
		$city = $this->db->get();
		
		//echo $this->db->last_query();
	//	return $result =$query->result_array();
		//echo "<pre>";print_r($result);die;
		return $city;
	}

	
	
	
	
	
	
	public function CityCountDisplay($SelValue='',$condition='',$dbname=''){
		$this->db->select($SelValue);
		$this->db->from($dbname);
		$this->db->group_by($condition); 
		$cityCount = $this->db->get();
		//echo $this->db->last_query();
		//echo "<pre>";print_r($result);die;
		return $cityCount;
		
	}
		
	
	
	
}