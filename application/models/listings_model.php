<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to listings management
 * @author dev Beetrut
 *
 */
class Listings_model extends My_Model{
	public function __construct(){
		parent::__construct();
	}
	public function get_all_values()
	{
	$this->db->select('*');
	$this->db->from(LISTINGS);
	$query = $this->db->get();
	return $query->result();
	//echo $this->db->last_query();die;
	}
	public function get_all_data()
	{
	$this->db->select('*');
	$this->db->from(LISTING_TYPES);
	$query = $this->db->get();
	return $query->result();
	//echo $this->db->last_query();die;
	}
	public function simple_updates($condition,$id)
	{
	
	$this->db->where('id',$id);
	$this->db->update(LISTING_TYPES,$condition); 

	}
	public function delete_listing($id)
	{
	$this->db->where('id',$id);
	return $this->db->delete(LISTING_TYPES);
	//echo $this->db->last_query();die;
}
public function get_all_datas($id)
	{
	$this->db->select('*');
	$this->db->from(LISTING_TYPES);
	$this->db->where('id',$id);
	$query = $this->db->get();
	return $query->result();
	//echo $this->db->last_query();die;
	}
}