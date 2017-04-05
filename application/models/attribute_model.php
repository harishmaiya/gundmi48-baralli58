<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to attribute management
 * @author dev Beetrut
 *
 */
class Attribute_model extends My_Model
{
	
	public function add_attribute($dataArr=''){
			$this->db->insert(ATTRIBUTE,$dataArr);
	}
	
	public function addlist_attribute($dataArr=''){
			$this->db->insert(LISTSPACE,$dataArr);
	}


	public function edit_attribute($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(ATTRIBUTE,$dataArr);
	}
	
	public function edit_listattribute($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(LISTSPACE,$dataArr);
	}
	
	
	public function view_attribute($condition=''){
			return $this->db->get_where(ATTRIBUTE,$condition);
			
	}
	
	public function view_listattribute($condition=''){
			return $this->db->get_where(LISTSPACE,$condition);
			
	}
	
	
	public function view_attribute_details(){
	
		$select_qry = "select * from ".ATTRIBUTE."";
		$attributeList = $this->ExecuteQuery($select_qry);
		return $attributeList;
			
	}
	
	public function view_listattribute_details(){
	
		$select_qry = "select * from ".LISTSPACE."";
		$attributeList = $this->ExecuteQuery($select_qry);
		return $attributeList;
			
	}
	
	
	
	public function get_list_values($lid='all'){
		if ($lid == 'all'){
			$where = '';
		}else {
			$where = 'and lv.list_id = '.$lid;
		}
		$Query = 'select lv.*,l.attribute_name from '.LIST_VALUES.' lv
					JOIN '.ATTRIBUTE.' l on l.id=lv.list_id where l.status = "Active" '.$where;
		return $this->ExecuteQuery($Query);
	}
	
		public function get_listspace_values($lid='all'){
		if ($lid == 'all'){
			$where = '';
		}else {
			$where = 'and lv.listspace_id = '.$lid;
		}
		$Query = 'select lv.*,l.attribute_name from '.LISTSPACE_VALUES.' lv
					JOIN '.LISTSPACE.' l on l.id=lv.listspace_id where l.status = "Active" '.$where;
		return $this->ExecuteQuery($Query);
	}
	
	public function get_sub_list_values($lid='all'){
		if ($lid == 'all'){
			$where = '';
		}else {
			$where = 'and lv.list_id = '.$lid;
		}
		/*$Query = 'select lv.*,l.attribute_name from '.LIST_VALUES.' lv
					JOIN '.ATTRIBUTE.' l on l.id=lv.list_id where l.status = "Active" '.$where; */
					
				$Query='SELECT lsv.*,lv.list_value,a.attribute_name FROM '.LIST_SUB_VALUES.' lsv JOIN '.LIST_VALUES.' lv on  lv.id=lsv.list_value_id JOIN '.ATTRIBUTE.' a on a.id=lv.list_id where a.status = "Active" '.$where;	
		//echo $Query;die;
		return $this->ExecuteQuery($Query);
	}
	
}

?>