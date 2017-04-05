<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to product management
 * @author dev Beetrut
 *
 */
class Product_model extends My_Model
{
	
	/**
	 *
	 *
	 common update code 
	 */
	
	
	
	
	/************* facility details ***************************/
	
	
	function getCommonFacilityDetails(){
   		$this->db->select(LIST_VALUES.'.*');
		$this->db->from(LIST_VALUES);
		$this->db->where(LIST_VALUES.'.status','Active');
		$this->db->where(LIST_VALUES.'.list_id','1');
        $query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
   } 
   
   function getPropertyType()
   {
   		$this->db->select(LIST_VALUES.'.*');
		$this->db->from(LIST_VALUES);
		$this->db->where(LIST_VALUES.'.status','Active');
		$this->db->where(LIST_VALUES.'.list_id','7');
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
   }



 function getExtraFacilityDetails()
   {
   		$this->db->select(LIST_VALUES.'.*');
		$this->db->from(LIST_VALUES);
		$this->db->where(LIST_VALUES.'.status','Active');
		$this->db->where(LIST_VALUES.'.list_id','4');
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
   }


 function getSpecialFeatureFacilityDetails()
   {
   		$this->db->select(LIST_VALUES.'.*');
		$this->db->from(LIST_VALUES);
		$this->db->where(LIST_VALUES.'.status','Active');
		$this->db->where(LIST_VALUES.'.list_id','5');
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
   }


 function getHomeSafetyFacilityDetails()
   {
   		$this->db->select(LIST_VALUES.'.*');
		$this->db->from(LIST_VALUES);
		$this->db->where(LIST_VALUES.'.status','Active');
		$this->db->where(LIST_VALUES.'.list_id','6');
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
   }
	
	
	
	
	function getrentalPhotoDetails($condition='')
	{
   		$this->db->select(LIST_VALUES.'.*');
		$this->db->from(LIST_VALUES);
		$this->db->where(LIST_VALUES.'.status','active');
		$this->db->where(LIST_VALUES.'.list_id','1');
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
	}
	
	public function coupondetails($condition='')
	{
		$this->db->select(LIST_VALUES.'.*');
		$this->db->from(LIST_VALUES);
		$this->db->where(LIST_VALUES.'code',$condition);
	}
	
	
	
	public function add_product($dataArr=''){
			$this->db->insert(PRODUCT,$dataArr);
	}
	
	public function add_subproduct_insert($dataArr=''){
			$this->db->insert(SUBPRODUCT,$dataArr);
	}


	public function edit_product($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(PRODUCT,$dataArr);
	}
	
	public function edit_subproduct_update($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(SUBPRODUCT,$dataArr);
	}
	

	public function view_product($condition=''){
			return $this->db->get_where(PRODUCT,$condition);
	}
	
	
public function get_allthe_details($status,$city,$checkin,$checkout,$id){

	
	/* $whereCond = '';
	
	if($status!=''){
		$whereCond = ' where p.status="'.$status.'" ';
	}
	
	if($city!=''){
		if ($whereCond!=''){
			$whereCond .= ' and ';
		}else {
			$whereCond = ' where ';
		}
		$whereCond .= ' pa.city= "'.$city.'" ';
	}
	
	if ($checkin!='' && $checkout!=''){
		if ($whereCond!=''){
			$whereCond .= ' and ';
		}else {
			$whereCond = ' where ';
		}
		//$whereCond .= ' p.awarded_date between "'.$checkin.'" and  "'.$checkout.'" ';
		$whereCond .= 'p.datefrom >="' .$checkin. '" AND p.dateto<="' .$checkout. '"';
	}elseif ($checkin!=''){
		if ($whereCond!=''){
			$whereCond .= ' and ';
		}else {
			$whereCond = ' where ';
		}
		$whereCond .= ' p.datefrom >= "'.$checkin.'" ';
	}elseif ($checkout!=''){
		if ($whereCond!=''){
			$whereCond .= ' and ';
		}else {
			$whereCond = ' where ';
		}
		$whereCond .= ' p.dateto <= "'.$checkout.'" ';
	}
	
	//$user_join = '';
	$groupby = '';
	if($id!=''){
		if ($whereCond!=''){
			$whereCond .= ' and ';
		}else {
			$whereCond = ' where ';
		}
		$whereCond .= ' p.user_id= "'.$id.'" ';
		//$user_join = 'JOIN '.TIMESHEET.' t on t.project_id=p.id ';
		
	}
	
		if ($whereCond!=''){
			$whereCond .= ' and u.status="Active" or p.user_id=0';
		}else {
			$whereCond = ' where u.status="Active" or p.user_id=0';
		} */
		//$whereCond .= 'u.status="Active" or p.user_id=0';
	//group by p.id 
	//order by p.created desc
		$groupby = 'group by p.id';
		$select_qry = "select p.*,pa.city as city_name,u.firstname,u.lastname,u.image as user_image,u.feature_product,u.phone_no,u.email,u.address,u.address2,u.city as addr3,pa.lat as latitude,pa.lang as longitude,p.featured from ".PRODUCT." p 
		LEFT JOIN ".PRODUCT_ADDRESS_NEW." pa on pa.productId=p.id
/* 		LEFT JOIN ".PRODUCT_BOOKING." pb on pb.product_id=p.id
		LEFT JOIN ".PRODUCT_PHOTOS." ph on p.id=ph.product_id */
		LEFT JOIN ".USERS." u on (u.id=p.user_id)
		".$whereCond." 
		".$groupby."  
		order by p.created desc";
		$productList =  $this->ExecuteQuery($select_qry);
		//echo "<pre>";print_r($productList->result());
		return $productList;
	}
	
	
	public function view_product_details($condition = ''){
		//$select_qry = "select p.*,u.firstname,u.lastname,u.image as user_image,u.feature_product,pa.latitude,pa.longitude,pb.datefrom,pb.dateto,ph.product_image as PImg,p.featured from ".PRODUCT." p
		$select_qry = "select p.*,cit.name as city_name,cit.id as ci_it,u.firstname,u.lastname,u.image as user_image,u.feature_product,u.user_name,u.phone_no,u.email,u.address,u.address2,u.city as addr3,pa.latitude,pa.longitude,pb.datefrom as book_datefrom,pb.dateto as book_dateto,ph.product_image as PImg,p.featured from ".PRODUCT." p 
		LEFT JOIN ".PRODUCT_ADDRESS." pa on pa.product_id=p.id
		LEFT JOIN ".PRODUCT_BOOKING." pb on pb.product_id=p.id
		LEFT JOIN ".PRODUCT_PHOTOS." ph on p.id=ph.product_id
		LEFT JOIN ".CITY." cit on pa.city = cit.id  
		LEFT JOIN ".USERS." u on (u.id=p.user_id) ".$condition;
		//echo $select_qry;die;
		$productList = $this->ExecuteQuery($select_qry); 
		return $productList;
		//echo "<pre>";print_r($productList->result()); 
		//echo $this->db->last_query(); die;
	}
	
	
	public function view_product_details1($condition = ''){
		$select_qry = "select p.*,u.firstname,u.lastname,u.image as user_image,u.feature_product,pa.latitude,pa.longitude,pb.datefrom,pb.dateto,ph.product_image as PImg,hs.payment_status,p.featured from ".PRODUCT." p 
		LEFT JOIN ".PRODUCT_ADDRESS." pa on pa.product_id=p.id
		LEFT JOIN ".PRODUCT_BOOKING." pb on pb.product_id=p.id
		LEFT JOIN ".PRODUCT_PHOTOS." ph on p.id=ph.product_id
		LEFT JOIN ".HOSTPAYMENT." as hs on hs.product_id=p.id

		LEFT JOIN ".USERS." u on (u.id=p.user_id) ".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		
		return $productList;
			
	}
	
	public function get_cancel_details($id='',$user_id=''){
	
		
		$select_qry="select p.*,hs.payment_status from ".PRODUCT." p
		LEFT JOIN ".HOSTPAYMENT." as hs on hs.product_id=p.id  where p.id= ".$id." AND p.user_id =".$user_id." ";
	
		$productList = $this->ExecuteQuery($select_qry);
		
		return $productList;
	}
	
	
	public function get_particular_details($fields='',$table='',$condition='',$sortArr=''){
		
				//echo "<pre>";print_r($condition); 
				$this->db->select($fields); 
			if ($sortArr != '' && is_array($sortArr)){
			foreach ($sortArr as $sortRow){
				if (is_array($sortRow)){
					$this->db->order_by($sortRow['field'],$sortRow['type']);
				}
			}
		}
		return $this->db->get_where($table,$condition);
	}
	
	
	public function get_search_options($condition)
	{
		
		//$select_qry = "select cit.name as city_name,cit.id as c_id from ".CITY." cit
		//LEFT JOIN ".PRODUCT_ADDRESS." pa on pa.city=cit.id
		//LEFT JOIN ".PRODUCT." p on p.id=pa.product_id".$condition;
		
		$select_qry = "select p.*,cit.name as city_name,cit.id as c_id,u.firstname,u.lastname from ".PRODUCT." p
		LEFT JOIN ".PRODUCT_ADDRESS." pa on pa.product_id=p.id
		LEFT JOIN ".CITY." cit on pa.city = cit.id
		LEFT JOIN ".USERS." u on (u.id=p.user_id)".$condition;
		$searchOption = $this->ExecuteQuery($select_qry); 
		return $searchOption;
		echo $this->db->last_query(); die;
		
		
		
	}
	
	public function view_product_details_distance_list($lat,$lon,$condition = ''){
		$aLong = $lon+0.05;
		$bLong = $lon-0.05;
		$aLat = $lat+0.05;
		$bLat = $lat-0.05;
		$whereNew = 'where (pa.lat < '.$aLat.' AND pa.lat > '.$bLat.' AND pa.lang < '.$aLong.' AND pa.lang >'.$bLong.') AND '.$condition;
		
		$select_qry = "select p.id, p.room_type, p.product_title, pa.city as city_name, pa.lat as latitude, pa.lang as longitude, u.firstname, u.lastname, u.image as user_image, u.id as userId, ph.product_image as PImg, p.price
        FROM ".PRODUCT." p 
		LEFT JOIN ".PRODUCT_ADDRESS_NEW." pa on pa.productId=p.id
		LEFT JOIN ".PRODUCT_PHOTOS." ph on p.id=ph.product_id
		LEFT JOIN ".USERS." u on u.id=p.user_id ".$whereNew;
		$distanceList = $this->ExecuteQuery($select_qry);
		return $distanceList;
		
		/* $select_qry = "select p.id,p.room_type,p.product_title,c.name as city_name,u.firstname,u.lastname,u.image as user_image,u.id as userId,ph.product_image as PImg,p.price,
		ROUND( 3963.0 * ACOS( SIN( '".$lat."' * PI( ) /180 ) * SIN( latitude * PI( ) /180 ) + COS( '".$lat."' * PI( ) /180 ) * COS( latitude * PI( ) /180 ) * COS( (longitude * PI( ) /180 ) - ( '".$lon."' * PI( ) /180 ) ) ) , 1) AS distance
		FROM ".PRODUCT." p 
		LEFT JOIN ".PRODUCT_ADDRESS." pa on pa.product_id=p.id
		LEFT JOIN ".CITY." c on c.id=pa.city
		LEFT JOIN ".PRODUCT_PHOTOS." ph on p.id=ph.product_id
		LEFT JOIN ".USERS." u on u.id=p.user_id ".$condition;
		$distanceList = $this->ExecuteQuery($select_qry);
		return $distanceList; */
			
	}
	
	public function get_featured_details($pid='0'){
		$Query = "select p.*,u.firstname,u.lastname,u.image,u.feature_product from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id=".$pid." and p.status='Publish'";
		$productList = $this->ExecuteQuery($Query);
		$productList->mode = 'sell_product';
		if ($productList->num_rows() != 1){
			$Query = "select p.*,u.firstname,u.lastname,u.image,u.feature_product from ".USER_PRODUCTS." p LEFT JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id=".$pid." and p.status='Publish'";
			$productList = $this->ExecuteQuery($Query);
			$productList->mode = 'user_product';
		} 
		return $productList;
	}
	
	public function get_wants_product($wantList){
		$productList = '';
		if ($wantList->num_rows() == 1){
			$productIds = array_filter(explode(',', $wantList->row()->product_id));
			$this->db->where_in('p.seller_product_id',$productIds);
			$this->db->where('p.status','Publish');
			$this->db->select('p.*,u.firstname,u.lastname,u.image,u.feature_product');
			$this->db->from(PRODUCT.' as p');
			$this->db->join(USERS.' as u','u.id=p.user_id');
			$productList = $this->db->get();
		} 
		return $productList;
	}
	
	public function get_notsell_wants_product($wantList){
		$productList = '';
		if ($wantList->num_rows() == 1){
			$productIds = array_filter(explode(',', $wantList->row()->product_id));
			$this->db->where_in('p.seller_product_id',$productIds);
			$this->db->where('p.status','Publish');
			$this->db->select('p.*,u.firstname,u.lastname,u.image,u.feature_product');
			$this->db->from(USER_PRODUCTS.' as p');
			$this->db->join(USERS.' as u','u.id=p.user_id');
			$productList = $this->db->get();
		} 
		return $productList;
	}
	
	public function view_notsell_product_details($condition = ''){
 		$select_qry = "select p.*,u.firstname,u.lastname,u.image,u.feature_product from ".USER_PRODUCTS." p LEFT JOIN ".USERS." u on u.id=p.user_id ".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}
	
	public function view_atrribute_details(){
		$select_qry = "select * from ".ATTRIBUTE." where status='Active'";
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
	
	public function view_subproduct_details($prdId=''){
		$select_qry = "select * from ".SUBPRODUCT." where product_id = '".$prdId."'";
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
	
	public function view_subproduct_details_join($prdId=''){
		$select_qry = "select a.*,b.attr_name from ".SUBPRODUCT." a join ".PRODUCT_ATTRIBUTE." b on a.attr_id = b.id where a.product_id = '".$prdId."'";
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
	
	public function view_product_atrribute_details(){
		$select_qry = "select * from ".PRODUCT_ATTRIBUTE." where status='Active'";
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
	
	public function view_category_details(){
	
		$select_qry = "select * from ".CATEGORY." where rootID=0";
		$categoryList = $this->ExecuteQuery($select_qry);
		$catView='';$Admpriv = 0;$SubPrivi = '';

		foreach ($categoryList->result() as $CatRow){
			
			$catView .= $this->view_category_list($CatRow,'1');		
			
			$sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."'  ";	
			$SubList = $this->ExecuteQuery($sel_qry);	
				
			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->view_category_list($SubCatRow,'2');	
					
				$sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."'  ";	
				$SubList1 = $this->ExecuteQuery($sel_qry1);	
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->view_category_list($SubCatRow1,'3');	
					
					$sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."'  ";	
					$SubList2 = $this->ExecuteQuery($sel_qry2);	
		
					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->view_category_list($SubCatRow2,'4');	

					}			
				}
			}
		}
					
		return $catView;
	}
	
	public function view_category_list($CatRow,$val){
	$SubcatView ='';
	$SubcatView .= '<span class="cat'.$val.'"><input name="category_id[]" class="checkbox" type="checkbox" value="'.$CatRow->id.'" tabindex="7"><strong>'.$CatRow->cat_name.' &nbsp;</strong></span>';
	return $SubcatView;					
	}

	public function get_category_details($catList=''){
		$catListArr = explode(',', $catList);
		$select_qry = "select * from ".CATEGORY." where rootID=0";
		$categoryList = $this->ExecuteQuery($select_qry);
		$catView='';$Admpriv = 0;$SubPrivi = '';

		foreach ($categoryList->result() as $CatRow){
			
			$catView .= $this->get_category_list($CatRow,'1',$catListArr);		
			
			$sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."'  ";	
			$SubList = $this->ExecuteQuery($sel_qry);	
				
			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->get_category_list($SubCatRow,'2',$catListArr);	
					
				$sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."'  ";	
				$SubList1 = $this->ExecuteQuery($sel_qry1);	
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->get_category_list($SubCatRow1,'3',$catListArr);	
					
					$sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."'  ";	
					$SubList2 = $this->ExecuteQuery($sel_qry2);	
		
					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->get_category_list($SubCatRow2,'4',$catListArr);	

					}			
				}
			}
		}
		return $catView;
	}
	
	public function get_category_list($CatRow,$val,$catListArr=''){
	$SubcatView ='';
	if (in_array($CatRow->id, $catListArr)){ 
		$checkStr = 'checked="checked"';
	}else {
		$checkStr = '';
	}
	$SubcatView .= '<span class="cat'.$val.'"><input name="category_id[]" '.$checkStr.' class="checkbox" type="checkbox" value="'.$CatRow->id.'" tabindex="7"><strong>'.$CatRow->cat_name.' &nbsp;</strong></span>';
	return $SubcatView;					
	}

	public function get_cat_list($ids=''){
		$this->db->where_in('id',explode(',', $ids));
		return $this->db->get(CATEGORY);
	}

	public function get_top_users_in_category($cat=''){
		$productArr = array();
		$userArr = array();
		$userCountArr = array();
		$condition = " where p.category_id like '".$cat.",%' AND p.status = 'Publish' OR p.category_id like '%,".$cat."' AND p.status = 'Publish' OR p.category_id like '%,".$cat.",%' AND p.status = 'Publish' OR p.category_id='".$cat."' AND p.status = 'Publish'";
		$productDetails = $this->view_product_details($condition);
		if ($productDetails->num_rows()>0){
			foreach ($productDetails->result() as $productRow){
				if (!in_array($productRow->id, $productArr)){
					array_push($productArr, $productRow->id);
					if ($productRow->user_id != ''){
						if (!in_array($productRow->user_id, $userArr)){
							array_push($userArr, $productRow->user_id);
							$userCountArr[$productRow->user_id] = 1;
						}else {
							$userCountArr[$productRow->user_id]++;
						}
					}
				}
			}
		}
		arsort($userCountArr);
		return $userCountArr;
	}
	
	public function get_recent_like_users($pid='',$limit='10',$sort='desc'){
		$Query = 'select pl.*, p.product_name, p.likes, u.firstname, u.lastname,u.image from '.PRODUCT_LIKES.' pl 
					JOIN '.PRODUCT.' p on p.seller_product_id=pl.product_id 
					JOIN '.USERS.' u on u.id=pl.user_id and u.status="Active"
					where pl.product_id="'.$pid.'" order by pl.id '.$sort.' limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	
	public function get_recent_user_likes($uid='',$pid='',$limit='3',$sort='desc'){
		$condition = '';
		if ($pid!=''){
			$condition = ' and pl.product_id != "'.$pid.'" ';
		}
		$Query = 'select pl.*,u.lastname,u.firstname,u.image,p.product_name,p.id as PID,p.created,p.sale_price,p.image from '.PRODUCT_LIKES.' pl
					JOIN '.USERS.' u on u.id=pl.user_id 
					JOIN '.PRODUCT.' p on p.seller_product_id=pl.product_id
					JOIN '.USERS.' u1 on u1.id=p.user_id and u1.group="Seller" and u1.status="Active"
					where pl.user_id = "'.$uid.'" '.$condition.' order by pl.id '.$sort.' limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	
	public function get_like_user_full_details($pid='0'){
		$Query = "select u.* from ".PRODUCT_LIKES.' p
					JOIN '.USERS.' u on u.id=p.user_id
					where p.product_id='.$pid;
		return $this->ExecuteQuery($Query);
	}
	
	public function getCategoryValues($selVal,$whereCond) {	
		$sel = 'select '.$selVal.' from '.CATEGORY.' c LEFT JOIN '.CATEGORY.' sbc ON c.id = sbc.rootID '.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}
	
	public function getCategoryResults($selVal,$whereCond) {	
		$sel = 'select '.$selVal.' from '.CATEGORY.' '.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}
	
	public function searchShopyByCategory($whereCond) {	
 		$sel = 'select p.* from '.PRODUCT.' p 
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id 
		 		'.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}
	
	public function add_user_product($uid=''){
		$seller_product_id = mktime();
		$checkId = $this->check_product_id($seller_product_id);
		while ($checkId->num_rows()>0){
			$seller_product_id = mktime();
			$checkId = $this->check_product_id($seller_product_id);
		}
		$dataArr = array(
			'product_name'	=>	$this->input->post('name'),
			'seourl'		=>	url_title($this->input->post('name'),'-'),
			'web_link'		=>	$this->input->post('link'),
			'category_id'	=>	$this->input->post('category'),
			'excerpt'		=>	$this->input->post('note'),
			'image'			=>	$this->input->post('image'),
			'user_id'		=>	$uid,
			'seller_product_id' => $seller_product_id
		);
		$this->simple_insert(USER_PRODUCTS,$dataArr);
		return $seller_product_id;
	}
	
	public function check_product_id($pid=''){
		$checkId = $this->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pid));
		if ($checkId->num_rows()==0){
			$checkId = $this->get_all_details(PRODUCT,array('seller_product_id'=>$pid));
		}
		return $checkId;
	}
	
	public function get_products_by_category($categoryid='',$sort='desc'){
		$Query = "select p.*,u.lastname,u.firstname,u.image from ".PRODUCT." p
			LEFT JOIN ".USERS." u on u.id=p.user_id
			where p.status='Publish' and FIND_IN_SET('".$categoryid."',p.category_id) order by p.`created` ".$sort;
		return $this->ExecuteQuery($Query);
	}
	
	public function view_product_comments_details($condition = ''){
		$select_qry = "select p.product_name,c.product_id,u.firstname,u.lastname,u.image,c.comments ,u.email,c.id,c.status,c.user_id as CUID
		from ".PRODUCT_COMMENTS." c 
		LEFT JOIN ".USERS." u on u.id=c.user_id 
		LEFT JOIN ".PRODUCT." p on p.seller_product_id=c.product_id ".$condition;
		$productComment = $this->ExecuteQuery($select_qry);
		return $productComment;
			
	}
	public function Update_Product_Comment_Count($product_id){
	
		$Query = "UPDATE ".PRODUCT." SET comment_count=(comment_count + 1) WHERE seller_product_id='".$product_id."'";
		$this->ExecuteQuery($Query);
	}
	public function Update_Product_Comment_Count_Reduce($product_id){
	
		$Query = "UPDATE ".PRODUCT." SET comment_count=(comment_count - 1) WHERE seller_product_id='".$product_id."'";
		return $this->ExecuteQuery($Query);
	}
	public function get_products_search_results($search_key='',$limit='5'){
		$Query = 'select p.* from '.PRODUCT.' p 
				LEFT JOIN '.USERS.' u on u.id=p.user_id
				where p.product_name like "%'.$search_key.'%" and p.status="Publish" and p.quantity>0 and u.status="Active" and u.group="Seller"
				or p.product_name like "%'.$search_key.'%" and p.status="Publish" and p.quantity>0 and p.user_id=0
				limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	public function get_user_search_results($search_key='',$limit='5'){
		$Query = 'select * from '.USERS.' where full_name like "%'.$search_key.'%" and status="Active" OR user_name like "%'.$search_key.'%" and status="Active" limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	
	public function get_product_full_details($pid='0'){
		$Query = "select p.*,u.firstname,u.lastname,u.image,u.feature_product,u.email,u.email_notifications,u.notifications from ".PRODUCT." p JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id='".$pid."'";
		$productDetails = $this->ExecuteQuery($Query);
		if ($productDetails->num_rows() == 0){
			$Query = "select p.*,u.firstname,u.lastname,u.image,u.feature_product,u.email,u.email_notifications,u.notifications from ".USER_PRODUCTS." p JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id='".$pid."'";
			$productDetails = $this->ExecuteQuery($Query);
			$productDetails->prodmode = 'user';
		}else {
			$productDetails->prodmode = 'seller';
		}
		return $productDetails;
	}
	
	public function get_user_created_lists($pid='0'){
		$Query = "select * from ".LISTS_DETAILS." where FIND_IN_SET('".$pid."',product_id)";
		return $this->ExecuteQuery($Query);
	}
	
	
	function view_product1($product_id='')
	{
		$this->db->select('p.*,u.id as OwnerId,pa.zip as post_code,pa.address,pa.lat as latitude,pa.lang as longitude,p.datefrom as DATEFROM,p.dateto as DateTo, pb.datefrom, pb.dateto, pb.expiredate, pa.city as cityname, pa.country as CountryName, pa.state as StateName');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(PRODUCT_ADDRESS_NEW.' as pa',"pa.productId=p.id","LEFT");
		$this->db->join(USERS.' as u',"u.id=p.user_id","LEFT");
		$this->db->join(PRODUCT_BOOKING.' as pb',"pb.product_id=p.id","LEFT");
		$this->db->where('p.id',$product_id);
		$this->db->group_by('p.id');
		return $query = $this->db->get();
	}
	
	/************Product Listing***************/
	public function view_product_details_site($condition = ''){
		$select_qry = "select p.product_name,p.product_title,p.id,p.seourl,p.price,p.price_range,p.description,p.user_id,p.list_name,p.list_value,p.comment_count,p.status,p.order,p.contact_count,
						u.id as userid,
						pa.latitude,pa.longitude,pa.city,
						c.name as city_name,c.meta_title,c.meta_keyword,c.meta_description,c.seourl as cityurl,
						
						s.name as statename,s.meta_title as statemtitle,s.meta_keyword as statemkey,s.meta_description as statemdesc,s.seourl as stateurl
						from ".PRODUCT." p 
						LEFT JOIN ".PRODUCT_ADDRESS." pa on pa.product_id=p.id
						LEFT JOIN ".CITY." c on c.id=pa.city
						LEFT JOIN ".STATE_TAX." s on s.id=pa.state
						LEFT JOIN ".PRODUCT_BOOKING." b on b.product_id=p.id
						
						LEFT JOIN ".USERS." u on (u.id=p.user_id) ".$condition;
						//pp.product_image ,LEFT JOIN ".PRODUCT_PHOTOS." pp on pp.product_id=p.id
		$productList = $this->ExecuteQuery($select_qry);
	//	echo $this->db->last_query(); die;
		return $productList;
	}
	public function product_details($Cont2)
	{
// 		echo($Cont2);die;
		$this->db->select('p.*,pp.product_image');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(PRODUCT_PHOTOS.' as pp',"pp.product_id=p.id","LEFT");
		if($Cont2!=''){
			$this->db->where('p.status',$Cont2);
		}
		$this->db->group_by('p.id');
		$this->db->order_by('p.id','desc');
			
		return $query = $this->db->get();
		/*//$product_qry = "select image from ".PRODUCT." ";
		//$product_qry1 = $this->ExecuteQuery($product_qry);
		//return $product_qry1->result();
		$this->db->select('p.*,pp.product_image,c.latitude,s.data as shedule');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(PRODUCT_ADDRESS.' as pa',"pa.product_id=p.id","LEFT");
		$this->db->join(PRODUCT_PHOTOS.' as pp',"pp.product_id=p.id","LEFT");
		$this->db->join(CITY.' as c',"c.id=pa.city","LEFT");
		$this->db->join('schedule as s',"s.id=p.id","LEFT");
		$this->db->where_in('p.user_id',$condition);
		if($Cont2!=''){
			$this->db->where('p.status',$Cont2);
		}
		$this->db->group_by('p.id');
		$this->db->order_by('p.id','desc');
			
		return $query = $this->db->get();*/
	}
	
	public function Display_product_image_details(){
		$select_qry = "select product_id,product_image from ".PRODUCT_PHOTOS." group by product_id order by imgPriority desc";
		return $attList = $this->ExecuteQuery($select_qry);
	}
	
	public function view_cities($text)
	{
		/*$select_qry = "select c.name,s.name as state_name,l.name as country_name from ".CITY." c 
				LEFT JOIN ".STATE_TAX." as s on s.id=c.stateid
				LEFT JOIN ".LOCATIONS." as l on l.id=c.countryid
				where c.name LIKE '".$text."%' order by c.name asc"; 
		$cityList = $this->ExecuteQuery($select_qry);
		return $cityList->result();*/
		$this->db->select('c.name,states_list.name as State,country_list.country_code,country_list.name as country_name');
		$this->db->from(CITY.' as c');
		/* $this->db->join(PRODUCT_ADDRESS.' as pa',"pa.city=c.id","LEFT");
		$this->db->join(PRODUCT.' as p',"pa.product_id=p.id and p.status='Publish'","LEFT"); */
		$this->db->join(STATE_TAX.' as states_list',"states_list.id=c.stateid","LEFT");
		$this->db->join(COUNTRY_LIST.' as country_list',"country_list.id=states_list.countryid","LEFT");
		$this->db->like('states_list.name', $text);
		$this->db->or_like('c.name', $text);
		
		$this->db->limit(30);
		$this->db->where('country_list.status','Active');
		//$this->db->group_by('pa.city');
		$this->db->order_by('c.name',asc);
		$this->db->order_by('states_list.name',asc);
		
		$query = $this->db->get();
        //echo $this->db->last_query();  die;
		$autocomplete = $query->result_array();
		return $autocomplete; 
	}
	function get_contactAll_details(){
			$Query = "SELECT p.product_title, count( pa.product_id ) AS productcount
			FROM ".PRODUCT." AS p, ".PAYMENT."  AS pa
			WHERE p.id = pa.product_id
			GROUP BY pa.product_id
			ORDER BY pa.id
			LIMIT 0 , 30";
		return $this->ExecuteQuery($Query);
	}
	function get_contactAllSeller_details(){
			$Query = "SELECT u.firstname,count( p.id ) AS productcount
			FROM ".PRODUCT." AS p, ".USERS."  AS u
			WHERE u.id = p.user_id and p.status='Publish' and u.status='Active'
			GROUP BY u.id
			ORDER BY productcount DESC
			LIMIT 0 , 30";
			
		return $this->ExecuteQuery($Query);
	}
	
	
	/************Product Listing***************/
	public function view_product_details_sitemapview($condition = ''){
	
		$select_qry = "select p.*,
						u.id as userid,u.user_name,u.loginUserType,u.feature_product,u.image as userphoto,
						pa.lat as latitude,pa.lang as longitude,pa.address,pa.zip as post_code,
						pa.city as city_name,
						pa.state as statename,
						pp.product_image from ".PRODUCT." p 
		LEFT JOIN ".PRODUCT_ADDRESS_NEW." pa on pa.productId=p.id
		LEFT JOIN ".PRODUCT_PHOTOS." pp on pp.product_id=p.id
		LEFT JOIN ".USERS." u on (u.id=p.user_id) ".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}
	
	
	/************Product Listing***************/
	public function view_product_details_booking($condition = ''){
	//u.firstname,u.lastname,u.address as UserAddress,u.city as UserCity,u.state as UserState,u.country as UserCountry,u.postal_code as UserPostCode,
		$select_qry = "select p.*,
						u.id as userid,u.user_name,u.email,u.phone_no,u.address,u.feature_product,u.image as userphoto,
						pa.latitude,pa.longitude,pa.address,pa.post_code,
						c.name as city_name,
						rq.checkin,rq.checkout,rq.NoofGuest,rq.numofdates,rq.serviceFee,rq.totalAmt,rq.Bookingno as Bookingno,
						s.name as statename,s.meta_title as statemtitle,s.meta_keyword as statemkey,s.meta_description as statemdesc,s.seourl as stateurl,
						pp.product_image from ".PRODUCT." p 
		LEFT JOIN ".PRODUCT_ADDRESS." pa on pa.product_id=p.id
		LEFT JOIN ".CITY." c on c.id=pa.city
		LEFT JOIN ".RENTALENQUIRY." rq on rq.prd_id=p.id
		LEFT JOIN ".STATE_TAX." s on s.id=pa.state
		LEFT JOIN ".PRODUCT_BOOKING." b on b.product_id=p.id
		LEFT JOIN ".PRODUCT_PHOTOS." pp on pp.product_id=p.id
		LEFT JOIN ".USERS." u on (u.id=p.user_id) ".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		//echo $this->db->last_query();
		//echo "<pre>";print_r($result); die;
		return $productList;
			
	}
	
	
	/************Booking User Details***************/
	public function view_user_details_booking($condition = ''){
		$select_qry = "select u.id as userid,u.user_name,u.email, u.phone_no, rq.NoofGuest,u.feature_product,u.image as userphoto,u.firstname,u.lastname,u.address as UserAddress,u.city as UserCity,u.state as UserState,u.country as UserCountry,u.postal_code as UserPostCode,rq.serviceFee,rq.totalAmt
						 from ".PRODUCT." p 
		LEFT JOIN ".RENTALENQUIRY." rq on rq.prd_id=p.id
		LEFT JOIN ".PRODUCT_BOOKING." b on b.product_id=p.id
		LEFT JOIN ".USERS." u on (u.id=rq.user_id) ".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		//echo $this->db->last_query();
		//echo "<pre>";print_r($productList->result()); die;
		return $productList;
			
	}
	
	public function Display_product_image_details_all(){
		$select_qry = "select product_id,count(product_image) as count_image from ".PRODUCT_PHOTOS." group by product_id order by imgPriority asc";
		return $attList = $this->ExecuteQuery($select_qry);
	}
	
	/*********Single Product details*********/
	function view_product_details_site_one($where1,$where_or,$where2)
	{
		$this->db->select('p.*,
		pa.country,pa.state,pa.city,pa.zip as post_code,pa.address,pa.lat as latitude,pa.lang as longitude,
		pb.datefrom,pb.dateto,pb.expiredate,u.firstname,u.created as user_created,u.response_rate,u.description as description1,u.phone_no,u.group,u.s_phone_no,u.about,u.email as RenterEmail,u.image as thumbnail, u.about, u.loginUserType, pa.country as Country_name, pa.state as State_name,
		pa.city as CityName');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(PRODUCT_ADDRESS_NEW.' as pa',"pa.productId=p.id","LEFT");
		$this->db->join(PRODUCT_BOOKING.' as pb',"pb.product_id=p.id","LEFT");
		$this->db->join(USERS.' as u',"u.id=p.user_id","LEFT");
		$this->db->where($where1);
		$this->db->or_where($where_or);
		$this->db->where($where2);
		$this->db->group_by('p.id');
		//$this->db->where('p.status','Publish');
		return $query = $this->db->get();
		//echo $this->db->last_query();
		//$result =$query->result_array();
		//echo "<pre>";print_r($result);die;
	}
	
	/**********For getting image*******/
	public function get_images($product_id)
	{
		$this->db->from(PRODUCT_PHOTOS);
		$this->db->where('product_id',$product_id);
		$this->db->order_by('cover','desc');
		return $query = $this->db->get();
	}
	
		public function get_images1($product_id)
		{
		$this->db->from(PRODUCT_PHOTOS);
		$this->db->where('product_id',$product_id);
		$this->db->order_by('id','desc');
		//echo $this->db->last_query(); 
		return $query = $this->db->get();
		}
	
	public function get_trip_review($bookingno='',$reviewer_id='')
	{
		$this->db->select('p.*,u.firstname,u.lastname,u.image');
		$this->db->from(REVIEW.' as p');
		$this->db->join(USERS.' as u',"u.id=p.reviewer_id","LEFT");
		$this->db->where('p.bookingno',$bookingno);
		if($reviewer_id !='')
		{
			$this->db->where('p.reviewer_id',$reviewer_id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function get_trip_review_all($reviewer_id='')
	{
		$this->db->select('p.*,u.firstname,u.lastname,u.image');
		$this->db->from(REVIEW.' as p');
		$this->db->join(USERS.' as u',"u.id=p.reviewer_id","LEFT");
		if($reviewer_id !='')
		{
			$this->db->where('p.reviewer_id',$reviewer_id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	
	public function get_review($product_id,$reviewer_id='')
	{
		
		$this->db->select('p.*,u.firstname,u.lastname,u.image');
		$this->db->from(REVIEW.' as p');
		$this->db->join(USERS.' as u',"u.id=p.reviewer_id","LEFT");
		$this->db->where('p.product_id',$product_id);
		if($reviewer_id !='')
		{
		$this->db->where('p.reviewer_id',$reviewer_id);
		}
		$this->db->where('p.status','Active');
		$this->db->order_by('p.dateAdded','desc');
		$query = $this->db->get();
		return $query;
		//echo $this->db->last_query();die;
	}
	
	
	public function get_review_other($product_id,$reviewer_id='')
	{
	
		$this->db->select('p.*,u.firstname,u.lastname,u.image');
		$this->db->from(REVIEW.' as p');
		$this->db->join(USERS.' as u',"u.id=p.reviewer_id","LEFT");
		$this->db->where('p.product_id',$product_id);
		if($reviewer_id !='')
		{
			$this->db->where('p.reviewer_id !=',$reviewer_id);
		}
		$this->db->where('p.status','Active');
		$this->db->order_by('p.dateAdded','desc');
		$query = $this->db->get();
		return $query;
		//echo $this->db->last_query();die;
	}
	

	public function get_review_tot($product_id)
	{
		$this->db->select('AVG( total_review ) as tot_tot, AVG( accuracy ) as tot_acc, AVG( communication ) as tot_com, AVG( cleanliness ) as tot_cln, AVG( location ) as tot_loc, AVG( checkin ) as tot_chk, AVG( value ) as tot_val');
		$this->db->from(REVIEW);
		$this->db->where('product_id',$product_id);
		$query = $this->db->get();
		return $query;
	}
	
	
	
	public function getRentalAttribute($uid){
		$select_qry = "SELECT a.id,a.list_value,b.attribute_name FROM `fc_list_values` a JOIN `fc_attribute` b on a.list_id = b.id WHERE FIND_IN_SET('".$uid."', a.products)";
		return $attList = $this->ExecuteQuery($select_qry);
	}
	
	public function get_total_records_CityCount($condition = ''){
		$select_qry = "select COUNT(p.id) as total from ".PRODUCT." p 
		JOIN ".PRODUCT_ADDRESS." c on c.product_id=p.id ".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}
	
	public function get_product_details_wishlist($condition = ''){
		$this->db->select('pa.city as name, p.product_name, pp.product_image, p.id, p.product_title, pa.country as Country_name,pa.state as State_name,pa.city as CityName');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(PRODUCT_ADDRESS_NEW.' as pa',"pa.productId=p.id","LEFT");
		$this->db->join(PRODUCT_PHOTOS.' as pp',"pp.product_id=p.id","LEFT");
		$this->db->where('p.id',$condition);
		$this->db->where('p.status','Publish');
		$this->db->order_by('pp.imgPriority','asc');
		return $query = $this->db->get();
			
	}
	
	public function get_notes_added($Rental_id,$user_id){
		$this->db->select('*');
		$this->db->from(NOTES);
		$this->db->where('product_id',$Rental_id);
		$this->db->where('user_id',$user_id);
		return $query = $this->db->get();
	}
	
	public function get_all_product_details(){
		$this->db->select('c.name,p.product_name,pp.product_image,p.id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(PRODUCT_ADDRESS.' as pa',"pa.product_id=p.id","LEFT");
		$this->db->join(PRODUCT_PHOTOS.' as pp',"pp.product_id=p.id","LEFT");
		$this->db->join(CITY.' as c',"c.id=pa.city","LEFT");
        $this->db->where('p.status','Publish');
		$this->db->order_by('pp.imgPriority','asc');
		return $query = $this->db->get();
			
	}
	
	public function get_review_rating($limit='',$limitstart)
	{
		$this->db->select('p.*,u.image as user_image,AVG(r.total_review ) as rate,rp.product_image as product_image');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(USERS.' as u',"u.id=p.user_id");
		$this->db->join(REVIEW.' as r',"r.product_id=p.id","LEFT");
		$this->db->join(PRODUCT_PHOTOS.' as rp',"rp.product_id=p.id","LEFT");
		$this->db->order_by('rate','desc'); 
		$this->db->group_by('p.id');
		$this->db->where('u.status','Active');
		$this->db->where('p.status','Publish'); 
		$this->db->where('p.featured','Featured'); 
		$this->db->order_by('p.featured_on','desc'); 
		if($limit!='') {
			$this->db->limit($limit,$limitstart);
		}
		return $query = $this->db->get();
	}
	public function get_wish_list_detail($condition = ''){
		
				$this->db->select('ls.id,ls.name,ls.product_id');
				$this->db->from(LISTS_DETAILS." as ls");
				$this->db->join(PRODUCT.' as p',"p.id=ls.product_id");
				$this->db->where('ls.user_id',$condition);
				$productList = $this->db->get();
				echo $this->db->last_query(); die;
				return $productList;

	}
	
	public function get_list_details_wishlist($condition = ''){
		
		$select_qry = "select id,name,product_id,whocansee from ".LISTS_DETAILS." where user_id=".$condition."  AND whocansee='Everyone'"; 
		$productList = $this->ExecuteQuery($select_qry);
		//echo $this->db->last_query(); die;
		return $productList;
	}
	public function get_popular_wishlist($limit='3'){
		
				
		$popular_list_qry = "select *  from ".LISTS_DETAILS." order by id desc limit ".$limit;
		$productList = $this->ExecuteQuery($popular_list_qry);
		return $productList;
			
			
	}
	public function get_popular_wishlistphoto($prod_id=''){
	//echo($prod_id);die;
		$popular_list_qry = "select *  from ".PRODUCT_PHOTOS." where product_id=".$prod_id;
		$productList = $this->ExecuteQuery($popular_list_qry);
		return $productList;			
	}
	
	public function add_wishlist_category($dataArr=''){
			$this->db->insert(LISTS_DETAILS,$dataArr);
			return $this->db->insert_id();
	}
	
	public function update_notes($dataArr='',$condition='')
	{
		if($condition=='')
		{
		$this->db->insert(NOTES,$dataArr);
		}
		//return $this->db->insert_id();
		else {
			$this->db->where($condition);
			$this->db->update(NOTES,$dataArr);
		}
	}
	
	public function update_wishlist($dataStr='',$condition1=''){
		$sel_qry = "select product_id,id from ".LISTS_DETAILS." where user_id=".$this->data['loginCheck']."";
		$ListVal = $this->ExecuteQuery($sel_qry);
		
		if($ListVal->num_rows() > 0){
			foreach($ListVal->result() as $wlist){
		
			$productArr=@explode(',',$wlist->product_id);
				if(!empty($productArr)){
					if(in_array($dataStr,$productArr)){
					$conditi = array('id' => $wlist->id);
						//$WishListCatArr = @explode(',',$this->data['WishListCat']->row()->product_id);
						$my_array = array_filter($productArr);
						$to_remove =(array)$dataStr;
						$result = array_diff($my_array, $to_remove);
						
						$resultStr =implode(',',$result);
						$this->updateWishlistRentals(array('product_id' =>$resultStr),$conditi);
					}
				}
			}
		}
		
		if(!empty($condition1)){
			foreach($condition1 as $wcont){
				$select_qry = "select product_id from ".LISTS_DETAILS." where id=".$wcont."";
				$productList = $this->ExecuteQuery($select_qry);
				$productIdArr=explode(',',$productList->row()->product_id);
		
				if(!empty($productIdArr)){
					if(!in_array($dataStr,$productIdArr)){
						$select_qry = "update ".LISTS_DETAILS." set product_id=concat(product_id,',".$dataStr."') where id=".$wcont."";
						$productList = $this->ExecuteQuery($select_qry);
					}
				}
			}
		}
	}
	
	public function get_product_details_wishlist_one_category($condition = '',$userid){
		$this->db->select('pa.city as name, p.product_name, p.product_title, p.room_type, p.accommodates, p.bedrooms,p.listings, p.bathrooms, p.price, n.id as nid, n.notes, p.id, pa.address, pa.zip as post_code');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(PRODUCT_ADDRESS_NEW.' as pa',"pa.productId=p.id","LEFT");
		$this->db->join(PRODUCT_PHOTOS.' as pp',"pp.product_id=p.id","LEFT");
		$this->db->join(NOTES.' as n',"n.product_id=p.id","LEFT");
		$this->db->where_in('p.id',$condition);
		$this->db->where('n.user_id',$userid);
		$this->db->group_by('p.id');
		$this->db->order_by('pp.imgPriority','asc');
		return $query = $this->db->get();
	}
	
		
	public function get_wishlistphoto($condition = '')
	{
		$this->db->select('product_image,product_id');
		$this->db->from(PRODUCT_PHOTOS);
		$this->db->where('product_id',$condition);
		return $query = $this->db->get();
	}
	
	public function updateWishlistRentals($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(LISTS_DETAILS,$dataArr);
	}
	public function alldeletewishlist_details($lid='')
	{
		$this->db->where('id', $lid);
		$this->db->delete(LISTS_DETAILS);
		//return $query = $this->db->get();
	}
	
	public function ChkWishlistProduct($productid='',$userid)
		{
			$select_qry = 'SELECT id FROM '.LISTS_DETAILS.' WHERE user_id = '.$userid.' AND FIND_IN_SET('.$productid.' , product_id)';
			return $rentalList = $this->ExecuteQuery($select_qry);
			
			//return $rentalList->result();
		}
		
	public function edit_rentalbooking($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(RENTALENQUIRY,$dataArr);
	}
	
	public function add_review($dataArr=''){
					return $this->db->insert(REVIEW,$dataArr);
					
	}
	
	public function get_RentalInQueryDetails($eqid){
		$this->db->select('r.*,p.product_title,u.firstname,u.lastname,u.email');
		$this->db->from(RENTALENQUIRY.' as r');
		$this->db->join(PRODUCT.' as p',"r.prd_id=p.id","LEFT");
		$this->db->join(USERS.' as u',"r.user_id=u.id","LEFT");
		$this->db->where('p.status','Publish');
		$this->db->where('r.id',$eqid);
		return $query = $this->db->get();
	}
	
	public function get_PriceMaxMin($condition = ''){
		// echo'<pre>';print_r($condition);exit;
		// $select_qry = ' select MAX(p.price) as MaxPrice,MIN(p.price) as MinPrice from '.PRODUCT.' p
		// LEFT JOIN '.PRODUCT_ADDRESS_NEW.' pa on pa.productId=p.id where '.$condition;
		$select_qry = ' select MAX(p.convertedPrice) as MaxPrice,MIN(p.convertedPrice) as MinPrice from '.PRODUCT.' p
		LEFT JOIN '.PRODUCT_ADDRESS_NEW.' pa on pa.productId=p.id where '.$condition.' and p.status = "Publish"';
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
	}
	
	public function get_PriceMaxMin_new(){
	
		// $select_qry = ' select MAX(p.price) as MaxPrice,MIN(p.price) as MinPrice from '.PRODUCT.' p WHERE p.status = "Publish"' ;
		$select_qry = ' select MAX(p.convertedPrice) as MaxPrice,MIN(p.convertedPrice) as MinPrice from '.PRODUCT.' p WHERE p.status = "Publish"' ;

		$productList = $this->ExecuteQuery($select_qry);
		//echo'<pre>';print_r($this->db->last_query());exit;
		return $productList;
	}
	
	/************Product Search price in rental list page***************/
	public function searchRentalPriceMaxMin($condition = ''){
		// $select_qry = "select MAX(p.price) as SMaxPrice,MIN(p.price) as SMinPrice from ".PRODUCT." p 
		// LEFT JOIN ".PRODUCT_ADDRESS_NEW." pa on pa.productId=p.id ".$condition;
		$select_qry = "select MAX(p.convertedPrice) as SMaxPrice,MIN(p.convertedPrice) as SMinPrice from ".PRODUCT." p 
		LEFT JOIN ".PRODUCT_ADDRESS_NEW." pa on pa.productId=p.id ".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}
	
	public function searchRentalPriceMaxMin_new(){
		// $select_qry = "select MAX(p.price) as SMaxPrice,MIN(p.price) as SMinPrice from ".PRODUCT." p WHERE p.status = 'Publish'";
		$select_qry = "select MAX(p.std_price) as SMaxPrice,MIN(p.std_price) as SMinPrice from ".PRODUCT." p WHERE p.status = 'Publish'";
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}
	
	public function get_membership_order_details($userid){
		$this->db->select('u.firstname,u.lastname,u.email,u.member_purchase_date,u.member_pakage');
		$this->db->from(USERS.' as u');
		$this->db->where('u.id',$userid);
		return $query = $this->db->get();
	}
	

	
	public function get_cat_subcat()
	{
	//$sec_category=array();
	$this->db->select('*');
	$this->db->from(ATTRIBUTE);
	$this->db->where('status','Active');
	#$this->db->where_in('attribute_seourl',array('amenities','propertytype'));
	$property_attributs=$this->db->get()->result();
	
	foreach($property_attributs as $property_attribute)
	{
	
	$this->db->select('*');
	$this->db->from(LIST_VALUES);
	$this->db->where('list_id',$property_attribute->id);
	$this->db->where('status','Active');
	$list_values=$this->db->get()->result_array();
	
	$sec_category[$property_attribute->id]=$list_values;
	
	/* foreach($list_values as $list_value)
	{
	$this->db->select('*');
	$this->db->from(LIST_SUB_VALUES);
	$this->db->where('list_value_id',$list_value->id);
	$this->db->where('status','Active');
	$list_sub_values=$this->db->get()->result();
	$third_category[$list_value->id]=$list_sub_values;
   } */
	
	}
	$data['main_cat']=$property_attributs;
	$data['sec_category']=$sec_category;
	//$data['third_category']=$third_category;
	return $data;
	
	}
	
	public function amenities_main_sub_category($list_name)
	{	
	
		$this->db->select('*');
		$this->db->from(ATTRIBUTE);
		$this->db->where('status','Active');
		//$this->db->where_in('id',array(1,4,5,6));
		$property_attributes=$this->db->get()->result();
		
		foreach($property_attributes as $property_attribute)
		{
		$this->db->select('*');
		$this->db->from(LIST_VALUES);
		$this->db->where_in('list_id',$property_attribute->id);
		$sub_category=$this->db->get();
		$data[$property_attribute->id]=$sub_category;
		//$data['subcategory']=$sub_category;
		
		}
		
		return $data;
	}
	
	/*code for getting country list - start*/
	
	public function get_country_list()
	{	
	
		$this->db->select('id, name, country_mobile_code as code');
		$this->db->from(LOCATIONS);
		
		$countryList = $this->db->get()->result();
			
		return $countryList;
	}

	/* after payment confirmation mail */


	public function view_payment_details($transId){
		$this->db->select('p.*,u.email,u.firstname,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,pd.product_title as prd_name');
		$this->db->from(HOSTPAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.host_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->where('p.txn_id = "'.$transId.'"');
		$this->db->where('p.payment_status = "Paid"');		
		$this->db->order_by("p.created", "desc"); 
		$PrdList = $this->db->get();
		
		//echo '<pre>'; print_r($PrdList->result()); die;
		return $PrdList;
	}

	
	 public function getCurrency() {
   		$this->db->select(CURRENCY.'.*');
		$this->db->from(CURRENCY);
		$this->db->where(CURRENCY.'.status','Active');
		$query = $this->db->get();
		//$resultContent = $query->result_array();
		return $query;
	 } 
	 
	 public function get_old_address($id) {
   		$this->db->select('p.address, p.latitude, p.longitude, c.name as cityName, s.name as stateName, cn.name as countryName');
		$this->db->from(PRODUCT_ADDRESS.' as p');
		$this->db->join(CITY.' as c',"c.id=p.city","LEFT");
		$this->db->join(STATE_TAX.' as s',"s.id=p.state","LEFT");
		$this->db->join(COUNTRY_LIST.' as cn',"cn.id=p.country","LEFT");
		$this->db->where('p.product_id',$id);
		return $query = $this->db->get();
	 }
	 public function get_all_values()
	{
	$this->db->select('*');
	$this->db->from(LISTINGS);
	$query = $this->db->get();
	return $query->result();
	}	 
	public function get_all_value()
	{
	$this->db->select('*');
	$this->db->from(LISTING_TYPES);
	$query = $this->db->get();
	return $query->result();
	}	
	public function update_all_datas($result,$catID)
	{
		$this->db->where('id',$catID);
		$this->db->update(PRODUCT,$result);


	}
	

	

	public function get_spl_offer_details($rental_enquiry_id)
	{
		$this->db->select(array('fc_rentalsenquiry.*','fc_users.firstname','fc_users.email','fc_product.product_title'));
		$this->db->where('fc_rentalsenquiry.Bookingno',$rental_enquiry_id);
		$this->db->join('fc_users','fc_users.id = fc_rentalsenquiry.user_id','left');
		$this->db->join('fc_product','fc_product.id = fc_rentalsenquiry.prd_id','left');
		$query = $this->db->get('fc_rentalsenquiry');
		return $query->row_array();
	}

	public function get_booking_details($rental_enquiry_id)
	{
		$this->db->select(array('fc_product.product_title'));
		$this->db->where('fc_rentalsenquiry.Bookingno',$rental_enquiry_id);
		$this->db->join('fc_product','fc_product.id = fc_rentalsenquiry.b_prd_id','left');
		$query = $this->db->get('fc_rentalsenquiry');
		return $query->row_array();
	}
	
	

	/*code for getting country list - end*/
	
	public function get_pre_approve_booking($bookingNo) {
		$this->db->select('P.id, P.product_title, RQ.checkin, RQ.checkout, RQ.NoofGuest, RQ.numofdates, RQ.totalAmt, RQ.serviceFee, RQ.renter_id');
		$this->db->from(RENTALENQUIRY.' as RQ');
		$this->db->join(PRODUCT.' as P' , 'P.id = RQ.prd_id',"LEFT");
		$this->db->where('RQ.Bookingno',$bookingNo);
		$result = $this->db->get();
		return $result;
	}
	
}



?>