<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Review_model extends My_Model
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
		$this->db->select('c.*,p.product_name,u.full_name,u.user_name');
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
		//return $result =$query->result_array();
		//echo "<pre>";print_r($result);die;
	}
	
	function get_contactAll_details($contactgorup='',$contactorder=''){

	//echo "<pre>";print_r($contactorder);die;
		$this->db->select('c.*,p.product_name,u.full_name,u.user_name,u.contact_count,p.contact_count as rental_count');
		$this->db->from(CONTACT.' as c');
		$this->db->join(PRODUCT.' as p',"c.rental_id=p.id","LEFT");
		$this->db->join(USERS.' as u',"c.renter_id=u.id","LEFT");
		$this->db->where('c.status','Active');
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
	
	function get_all_review_details()
		{
			$this->db->select('r.*, p.id as product_id, p.product_title');
			$this->db->from(REVIEW.' as r');
			$this->db->join(PRODUCT.' as p',"r.product_id=p.id","LEFT");
			$this->db->order_by('r.dateAdded','desc');
			return $query = $this->db->get();
		}
		
	function get_review_details($review_id='')
		{
			$this->db->select('r.*,p.product_title,u.user_name');
			$this->db->from(REVIEW.' as r');
			$this->db->join(PRODUCT.' as p',"r.product_id=p.id","LEFT");
			$this->db->join(USERS.' as u',"r.email=u.email","LEFT");
			$this->db->where('r.id',$review_id);
			return $query = $this->db->get_where();
		}
	function get_productreview_byyou($user_id='')
		{
			$this->db->select('r.*,p.product_title,u.image,u.user_name');
			$this->db->from(REVIEW.' as r');
			$this->db->where('r.reviewer_id', $user_id);
			$this->db->join(PRODUCT.' as p',"r.product_id=p.id");
			$this->db->join(USERS.' as u',"u.id=r.reviewer_id", "LEFT");
			return $query = $this->db->get_where();
		}
	
	function get_productreview_aboutyou($user_id='')
		{
			$this->db->select('r.*,p.product_title,u.image,u.user_name');
			$this->db->from(REVIEW.' as r');
			$this->db->where('r.user_id', $user_id);
			$this->db->join(PRODUCT.' as p',"r.product_id=p.id");
			$this->db->join(USERS.' as u',"u.id=r.reviewer_id", "LEFT");
			$this->db->where('r.status','Active');
			return $query = $this->db->get_where();
		}
	
	function get_productreview_details1($user_id='')
		{
			//echo $user_id; die;
			$this->db->select('r.*,p.product_title,pp.product_image');
			$this->db->from(REVIEW.' as r');
			$this->db->join(PRODUCT.' as p',"r.product_id=p.id");
			$this->db->join(PRODUCT_PHOTOS.' as pp',"pp.product_id=r.product_id","LEFT");
			//$this->db->where('u.id',$user_id);
			//$this->db->select('r.*,p.product_title,u.thumbnail,pp.product_image');
			//$this->db->from(REVIEW.' as r');
			//$this->db->join(PRODUCT.' as p',"r.product_id=p.id");
			//$this->db->join(PRODUCT_PHOTOS.' as pp',"pp.product_id=r.product_id","LEFT");
			//$this->db->join(USERS.' as u',"u.id=r.reviewer_id");
			//$this->db->where('u.id',$user_id);
			return $query = $this->db->get_where();
			//echo $this->db->last_query(); die;
			
		}
		
		function get_productreview_details($user_id='')
		{
		//echo $user_id; die;
		$this->db->select('r.*,p.product_title,pp.product_image');
		$this->db->from(REVIEW.' as r');
		$this->db->join(PRODUCT.' as p',"r.product_id=p.id");
		$this->db->join(PRODUCT_PHOTOS.' as pp',"pp.product_id=r.product_id","LEFT");
		$this->db->join(USERS.' as u',"u.id=r.reviewer_id");
			//$this->db->where('u.id',$user_id);
			// $this->db->select('r.*,p.product_title,u.thumbnail,pp.product_image');
			// $this->db->from(REVIEW.' as r');
			// $this->db->join(PRODUCT.' as p',"r.product_id=p.id");
			// $this->db->join(PRODUCT_PHOTOS.' as pp',"pp.product_id=r.product_id","LEFT");
			// $this->db->join(USERS.' as u',"u.id=r.reviewer_id");
			$this->db->where('u.id',$user_id);
			return $query = $this->db->get_where();
			//echo $this->db->last_query(); die;
			
		}
		
		
	function get_yourproductreview_details($user_id='')
		{
			$this->db->select('r.*,p.product_title,u.thumbnail,pp.product_image');
			$this->db->from(REVIEW.' as r');
			$this->db->join(PRODUCT.' as p',"r.product_id=p.id");
			$this->db->join(PRODUCT_PHOTOS.' as pp',"pp.product_id=r.product_id","LEFT");
			$this->db->join(USERS.' as u',"u.id=r.user_id");
			$this->db->where('u.id',$user_id);
			$this->db->where('r.status','Active');
			$this->db->group_by('r.id');
			return $query = $this->db->get_where();
			//echo $this->db->last_query();die;
			
		}
		
	function get_phone_number_verified($user_id='')
		{	
	
			$this->db->select('*');
			$this->db->from(REQUIREMENTS);
			$this->db->where('id',$user_id);
			
			return $query = $this->db->get_where();
		
			
		}
	
}