<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to Cart Page
 * @author Teamtweaks
 *
 */
class Checkout_model extends My_Model
{
	
	public function add_checkout($dataArr=''){
			$this->db->insert(PRODUCT,$dataArr);
	}

	public function edit_checkout($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(PRODUCT,$dataArr);
	}
	
	
	public function view_checkout($condition=''){
			return $this->db->get_where(PRODUCT,$condition);
			
	}
	
	
	
	
	/** paypal detail **/
	public function getPaypalDetails()
   {
   		$this->db->select(PAYMENT_GATEWAY.'.*');
		$this->db->from(PAYMENT_GATEWAY);
		$this->db->where(PAYMENT_GATEWAY.'.gateway_name','Paypal IPN');
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
	}

	public function view_checkout_details($condition = ''){
		$select_qry = "select p.*,u.firstname,u.lastname,u.image from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id ".$condition;
		$checkoutList = $this->ExecuteQuery($select_qry);
		return $checkoutList;
			
	}
	
	public function view_atrribute_details(){
		$select_qry = "select * from ".ATTRIBUTE." where status='Active'";
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
	
	
	
	
}

?>