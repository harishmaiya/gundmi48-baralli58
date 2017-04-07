<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Landing page functions
 * @author dev Beetrut
 *
 */
class Landing_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	function get_city_details($q){
	//$this->db->select('c.name,COUNT(p.id) as Rentals,states_list.name as 
		$this->db->select('c.name,states_list.name as State,country_list.country_code,country_list.name as country_name');
		$this->db->from(CITY.' as c');
		/* $this->db->join(PRODUCT_ADDRESS.' as pa',"pa.city=c.id","LEFT");
		$this->db->join(PRODUCT.' as p',"pa.product_id=p.id and p.status='Publish'","LEFT"); */
		$this->db->join(STATE_TAX.' as states_list',"states_list.id=c.stateid","LEFT");
		$this->db->join(COUNTRY_LIST.' as country_list',"country_list.id=states_list.countryid","LEFT");
		$this->db->where('country_list.status','Active');
		$this->db->like('states_list.name', $q);
		$this->db->or_like('c.name', $q);
		
		$this->db->limit(30);
		//$this->db->group_by('pa.city');
		$this->db->order_by('c.name',asc);
		$this->db->order_by('states_list.name',asc);
		
		$query = $this->db->get();
        //echo $this->db->last_query();  die;
		$autocomplete = $query->result_array();
		return $autocomplete; 
	}
	
	
	public function get_featured_lists()
	{
		$this->db->select('P.id,P.room_type,P.product_title, P.price,P.instantbook,P.description, P.accommodates, PP.product_image, PA.city, PA.state, PA.country,u.image,r.total_review,r.product_id,u.id as property_owner');
		$this->db->from(PRODUCT.' as P');
		$this->db->join(PRODUCT_PHOTOS.' as PP' , 'P.id = PP.product_id');
		$this->db->join(PRODUCT_ADDRESS_NEW.' as PA' , 'P.id = PA.productId');
		$this->db->join(USERS.' as u',"u.id=P.user_id","LEFT");
		$this->db->join(REVIEW.' as r',"r.product_id=P.id","LEFT");
		$this->db->where('P.status','Publish');
		$this->db->where('P.featured = "Featured"');
		$this->db->order_by("P.created", desc);
		$this->db->group_by("P.id"); 
		return $result = $this->db->get();
		//echo $this->db->last_query();die;
		/* $result = $this->db->get();
		echo '<pre>';print_r($result->result());die; */
	}
	
	/* Get Featured Cities Start*/
	
	public function get_featured_city(){
		$this->db->select('u.*,u.seourl as cityurl,count(u.id) as NCount, u.state_name');
		$this->db->from(CITY_NEW.' as u');
		$this->db->where('u.status','Active','u.featured','1');
		$this->db->where('u.featured','1');
		$this->db->group_by('u.id');
		$this->db->order_by('u.view_order');
		$city = $this->db->get();
		return $city;
	}
	
	/* Get Featured Cities End*/
}