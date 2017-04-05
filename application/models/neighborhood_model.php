<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * 
 * This model contains all db functions related to user management
 * @author dev Beetrut
 *
 */
class Neighborhood_model extends My_Model
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
	
	
	public function get_all_detailsNeighborhood(){
		$this->db->select('p.*,c.name as cityname');
		$this->db->from(NEIGHBORHOOD.' as p');
		$this->db->join(CITY.' as c' , 'p.neighborhoods = c.id');
		$this->db->group_by('p.id'); 
		$city = $this->db->get();
		
		return $city;
	}
	public function CityCountDisplay($SelValue='',$condition='',$dbname=''){
		$this->db->select($SelValue);
		$this->db->from($dbname);
		$this->db->group_by($condition); 
		$cityCount = $this->db->get();
		return $cityCount;
		
	}
		
}