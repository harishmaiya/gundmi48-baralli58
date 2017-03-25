<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to seller requests
 * @author Teamtweaks
 *
 */
class Seller_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/**
    * 
    * Getting Sellers details
    * @param String $condition
    */
   public function get_sellers_details($condition=''){
   		$Query = " select * from ".USERS." ".$condition;
   		return $this->ExecuteQuery($Query);
   }
   
   public function get_all_seller_details_admin($userid){
		$this->db->select('u.*,b.user_id,b.id_verified');
		$this->db->from(USERS.' as u');
		$this->db->join(REQUIREMENTS.' as b',"u.id=b.user_id","left");
		$this->db->where('group','Seller');
		$this->db->order_by('u.id','desc');
		
		return $query = $this->db->get();
		
	}
	
}