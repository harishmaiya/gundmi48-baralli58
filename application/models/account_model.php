<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to Cart Page
 * @author Teamtweaks
 *
 */
class Account_model extends My_Model
{
	
	
	public function view_newbooking_details(){
		$this->db->select('rq.*,u.email,u.firstname,u.phone_no,u.address,rq.caltophone,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID');
		$this->db->from(RENTALENQUIRY.' as rq');
		$this->db->join(USERS.' as u' , 'rq.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = rq.prd_id');
		//$this->db->where('rq.booking_status = "'.$status.'"');	
		$this->db->order_by("rq.dateAdded", "desc"); 
		$PrdList = $this->db->get();
		//echo '<pre>'; print_r($PrdList->result()); die;
		return $PrdList;
	}
	
	
	
	
	
	public function view_newbooking_details_confirmed(){
		$this->db->select('rq.*,u.email,u.firstname,u.address,rq.caltophone,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,Py.status as status');
		$this->db->from(RENTALENQUIRY.' as rq');
		$this->db->join(USERS.' as u' , 'rq.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = rq.prd_id');
		$this->db->join(PAYMENT.' as Py' , 'Py.EnquiryId = rq.id');
		$this->db->where('Py.status = "Paid"');	
		$this->db->order_by("rq.dateAdded", "desc"); 
		$PrdList = $this->db->get();
		
		#echo '<pre>'; print_r($PrdList->result()); die;
		return $PrdList;
	}
	
	
	public function view_newbooking_detailsexp_new($status){
$today =  date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s', strtotime("-1 days"))));
$this->db->select('rq.*,u.email,u.firstname,u.address,rq.caltophone,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID');
		$this->db->from(RENTALENQUIRY.' as rq');
		$this->db->join(USERS.' as u' , 'rq.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = rq.prd_id');		
		$this->db->where('rq.approval = "'.$status.'"');	
                $this->db->where("rq.checkin <",$today);			
		/* $today = date('Y-m-d'); 
		$today =  date('Y-m-d',strtotime(date('Y-m-d', strtotime("-6 days"))));
		$minvalue = $today.' 00:00:00';
		$maxvalue = $today.' 23:59:59';
		$this->db->where("rq.dateAdded =",$today);
		$this->db->where( "rq.dateAdded BETWEEN '$minvalue' AND '$maxvalue'", NULL, FALSE); */
		$PrdList = $this->db->get();
		//echo $this->db->last_query(); die;
		
		//echo '<pre>'; print_r($PrdList->result()); die;
		return $PrdList;

}
	
	
	
	
	public function view_newbooking_detailsexp($status){
		$this->db->select('rq.*,u.email,u.firstname,u.address,rq.caltophone,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID');
		$this->db->from(RENTALENQUIRY.' as rq');
		$this->db->join(USERS.' as u' , 'rq.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = rq.prd_id');		
		$this->db->where('rq.approval = "'.$status.'"');				
		/* $today = date('Y-m-d'); 
		$today =  date('Y-m-d',strtotime(date('Y-m-d', strtotime("-6 days"))));
		$minvalue = $today.' 00:00:00';
		$maxvalue = $today.' 23:59:59';
		$this->db->where("rq.dateAdded =",$today);
		$this->db->where( "rq.dateAdded BETWEEN '$minvalue' AND '$maxvalue'", NULL, FALSE); */
		$PrdList = $this->db->get();
		//print_r($PrdList);die;
		//echo $this->db->last_query(); die;
		
		//echo '<pre>'; print_r($PrdList->result()); die;
		return $PrdList;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

?>