<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
 *
 * User related functions
 *
 * @author Teamtweaks
 *        
 *        
 */
class Rentals extends MY_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( array (
				'cookie',
				'date',
				'form',
				'email',
				'text',
				'html' 
		) );
		$this->load->library ( array (
				'encrypt',
				'form_validation' 
		) );
		$this->load->model ( array (
				'product_model',
				'user_model' 
		) );
		$this->load->library ( 'pagination' );
		
		if ($_SESSION ['sMainCategories'] == '') {
			$sortArr1 = array (
					'field' => 'cat_position',
					'type' => 'asc' 
			);
			$sortArr = array (
					$sortArr1 
			);
			$_SESSION ['sMainCategories'] = $this->product_model->get_all_details ( CATEGORY, array (
					'rootID' => '0',
					'status' => 'Active' 
			), $sortArr );
		}
		$this->data ['mainCategories'] = $_SESSION ['sMainCategories'];
		
		if ($_SESSION ['sColorLists'] == '') {
			$_SESSION ['sColorLists'] = $this->product_model->get_all_details ( LIST_VALUES, array (
					'list_id' => '1' 
			) );
		}
		$this->data ['mainColorLists'] = $_SESSION ['sColorLists'];
		
		$this->data ['loginCheck'] = $this->checkLogin ( 'U' );
		$this->data ['likedProducts'] = array ();
		
	}
	
	public function popular_list() { 
		$limit = ' 20';
		$limitstart=0;
		if($this->input->get('pg') != ''){
			$limitstart = $this->input->get('pg')*20;
		}
		$this->data ['product']= $product = $this->product_model->get_review_rating ($limit,$limitstart);
		
		//echo "<pre>";print_r($this->data ['product']->result());die;
		$wishlists= $this->product_model->get_all_details(LISTS_DETAILS, array('user_id'=>$this->checkLogin ( 'U' )));
		
		$newArr = array();
		foreach($wishlists->result() as $wish){
			$newArr = array_merge($newArr , explode(',', $wish->product_id));
		}
		$this->data ['newArr'] = $newArr;
		
		$newPage = $this->input->get('pg')+1;
		if ($this->data ['product']->num_rows() == 0){
			$qry_str = '';
			$paginationDisplay  = '';
		}else {
			$qry_str = '?pg='.$newPage;
			$paginationDisplay  = '<a title="'.$newPage.'" class="btn-more" href="'.base_url().'popular/'.$qry_str.'" style="display: none;" >See More Products</a>';
		}
		$this->data['paginationDisplay'] = $paginationDisplay;
		$this->data ['wishlist'] = $this->product_model->get_popular_wishlist ();
		$this->data ['popular_image'] = array ();
		foreach ( $this->data ['wishlist']->result_array () as $wishlist_image ) {
			if ($wishlist_image ['product_id'] != '') {
				$products = explode ( ',', $wishlist_image ['product_id'] );
				$this->data ['popular_image1'] [$wishlist_image ['id']] = 'dummyProductImage.jpg';
				if (count ( $products ) > 0) {
					foreach ( $products as $prod_id ) {
						if ($prod_id != '') {
							$popular_image = $this->product_model->get_popular_wishlistphoto ( $prod_id );
							if (($popular_image->num_rows () > 0) && ($popular_image->row ()->product_image != '') && (file_exists ( './server/php/rental/' . $popular_image->row ()->product_image ))) {
								$this->data ['popular_image1'] [$wishlist_image ['id']] = $popular_image->row ()->product_image;
								break;
							}
						}
					}
				}
			}
		}
		$this->load->view ( 'site/rentals/popular_list', $this->data );
	}

	/* map view */
	
	public function mapViewAjax() {
		$datefrom = $_POST['checkin'];
		$dateto = $_POST['checkout'];
		$guests = $_POST['guests'];
		$room_type = $_POST['room_type'];
		$property_type = $_POST['property_type'];
		$pricemin = $_POST['pricemin'];
		$pricemax = $_POST['pricemax'];
		$listvalue = $_POST['listvalue'];
		$this->data ['zoom'] = $_POST['zoom'];
		$this->data ['cLat'] = $_POST['cLat'];
		$this->data ['cLong'] = $_POST['cLong'];
		$minLat = $_POST['minLat'];
		$minLong = $_POST['minLong'];
		$maxLat = $_POST['maxLat'];
		$maxLong = $_POST['maxLong'];
		$search = '(1=1';
		$whereLat = '(pa.lat BETWEEN "'.$minLat.'" AND "'.$maxLat.'" ) AND (pa.lang BETWEEN "'.$minLong.'" AND "'.$maxLong.'" )';
		$search = $search.' AND '.$whereLat;
		
		if(($datefrom != '') && ($dateto != '')){
			$searchDetails = array('searchFrom' => $datefrom,'searchTo' => $dateto, 'searchGuest' => $guests);
			$this->session->set_userdata($searchDetails);
			$newDateStart = date("Y-m-d", strtotime($datefrom));
			$newDateEnd = date("Y-m-d", strtotime($dateto));
			$this->db->select('*');
			$this->db->from(CALENDARBOOKING);
			$this->db->where('the_date >=',$newDateStart);
			$this->db->where('the_date <=',$newDateEnd);
			$this->db->group_by('PropId');
			$restrick_booking_query = $this->db->get();
			if($restrick_booking_query->num_rows() != 0 ){
				$restrick_booking_result = $restrick_booking_query->result();
				foreach($restrick_booking_result as $restrick_data){
					$product_restrick_id .="'".$restrick_data->PropId."',";
				}
				$product_restrick_id .='}';
				$restrick_product_id =  str_replace(',}','',$product_restrick_id );
				$search .= " and p.id NOT IN(".$restrick_product_id.")";
			}
		} else{
			$searchDetails = array('searchFrom' => '','searchTo' => '', 'searchGuest' => '');
			$this->session->set_userdata($searchDetails);
		}
		if($guests != '' && $guests != '0'){
			if(strpos($guests,"+") != '') 
			{
				$guests = str_replace('+', '', $guests) ;
				$search .= " and p.accommodates =".$guests;
			}
			else
			{
				$search .= " and p.accommodates >=".$guests;
			}
		}
		if($pricemax != '' && $pricemin != ''){
		$search .= " and p.convertedPrice BETWEEN ".$pricemin." and ".$pricemax;
		}
		if(count($room_type) != 0){
			$room_values_count= 0;
			foreach($room_type as $room_checked_values){
				if($room_checked_values !=''){
					$room_values_count = 1;
					$room_checked_id .= "'".trim($room_checked_values)."',";
				}	
			}
			$room_checked_id .= "}";
			$room_check_id .= str_replace(",}","",$room_checked_id);
			if($room_values_count == 1)
			$search .= " and p.room_type IN (".$room_check_id.")";
		}
		if(count($property_type) != 0){
			$propertyCount = 0 ; 
			foreach($property_type as $property_checked_values){
				if($property_checked_values != ''){
					$propertyCount = 1;
					$property_checked_id .= "'".trim($property_checked_values)."',";
				}
			}
			$property_checked_id .= "}";
			$property_check_id .= str_replace(",}","",$property_checked_id);
			if($propertyCount == 1)
			$search .= " and p.home_type IN (".$property_check_id.")";
		} 
		$search .= ' ) and';
		if(count($listvalue) != 0){
		$find_in_set_categories .=  '(';
			foreach($listvalue as $list) {
				if($list != '')
				$find_in_set_categories .= ' FIND_IN_SET("' . $list . '", p.list_name) AND';
			}
		}
		if ($find_in_set_categories != '') {
			$find_in_set_categories = substr ( $find_in_set_categories, 0, - 3 );
			$search .= ' ' . $find_in_set_categories . ') and';
		}
		$this->data ['heading'] = '';
		if (count ( $_GET ) > 0)
		$config ['suffix'] = '?' . http_build_query ( $_GET, '', "&" );
		$this->data ['GetListUrl'] = $config ['first_url'] = base_url () . 'property?' . http_build_query ( $_GET );
		$searchPerPage = $this->config->item ( 'site_pagination_per_page' );
		$paginationNo = $_POST['paginationId'];
		if($paginationNo == '')$paginationNo = 0;
		$pageLimitStart = $paginationNo;
		$pageLimitEnd = $pageLimitStart + $searchPerPage;
		$get_ordered_list_count = $this->product_model->view_product_details_sitemapview ( '  where ' . $search . ' u.status="Active" and p.status="Publish" and pp.cover="Cover" group by p.id order by p.created desc' );
		$this->config->item ( 'site_pagination_per_page' );
		$config ['prev_link'] = 'Previous';
		$config ['next_link'] = 'Next';
		$config ['num_links'] = 2;
		$config ['base_url'] = base_url () . 'property/';
		$config ['total_rows'] = ($get_ordered_list_count->num_rows ());
		//$config ["per_page"] = $searchPerPage;
		$config ["per_page"] = 5;
		$config ["uri_segment"] = 2;
		$this->pagination->initialize ( $config );
		$this->data ['paginationLink'] = $data ['paginationLink'] = $this->pagination->create_links ();
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		
		if(substr($pageURL, 0, strpos($pageURL, '&')) == '')
		$mainURL = $pageURL;
		else
		$mainURL = substr($pageURL, 0, strpos($pageURL, '&'));
		
		if($get_ordered_list_count->num_rows() > $searchPerPage){
			$pagesL = '<div class="search_pagination" style="padding:7px;">';
			$prevV = $paginationNo-$searchPerPage;
			if($paginationNo != 0)
			{
				$pagesL .= '<a style="padding:3px;" href="javascript:setPagination('.$prevV.')">Previous</a>';
			}
			else
			{
				$pagesL .= '';
			}
			
			if($get_ordered_list_count->num_rows ()%$searchPerPage == 0)
			{
				$pages = $get_ordered_list_count->num_rows()/$searchPerPage;
			}
			else 
			{
				$pages = (round($get_ordered_list_count->num_rows()/$searchPerPage))+1;
			}
			
			$padeId = 0;
			
			for($i = 1; $i < $pages; $i++)
			{
				if($padeId != $paginationNo)
				{
					$pagesL .= '<a style="padding:3px;" href="javascript:setPagination('.$padeId.')">'.$i.'</a>';
					
				}
				else $pagesL .= '<span>'.$i.'</span>';
				$padeId = $padeId+$searchPerPage;
			}
			$nextV = $paginationNo+$searchPerPage;
			if($nextV < $get_ordered_list_count->num_rows())
			{
				$pagesL .= '<a style="padding:3px;" href="javascript:setPagination('.$nextV.')">Next</a>';
			}
			else
			{
				$pagesL .= '';
			}
			$pagesL .= '</div>';
		}
		$this->data ['newpaginationLink'] = $data ['newpaginationLink'] = $pagesL;
		$this->data ['get_ordered_list_count'] = $get_ordered_list_count->num_rows ();
		$cat_subcat = $this->product_model->get_cat_subcat ();
		$this->data ['main_cat'] = $cat_subcat ['main_cat'];
		$this->data ['sec_category'] = $cat_subcat ['sec_category'];
		$this->data ['productList'] = $this->product_model->view_product_details_sitemapview ( '  where ' . $search . ' u.status="Active" and  p.status="Publish" and pp.cover="Cover" group by p.id order by p.created desc limit ' . $pageLimitStart . ',' . $searchPerPage );
		//echo $this->db->last_query();
		$wishlists= $this->product_model->get_all_details(LISTS_DETAILS, array('user_id'=>$this->checkLogin ( 'U' )));
		$newArr = array();
		foreach($wishlists->result() as $wish){
			$newArr = array_merge($newArr , explode(',', $wish->product_id));
		}
		$this->data ['newArr'] = $newArr; 
		//echo '<p>';echo $this->db->last_query();echo '</p>';
		$this->load->view ( 'site/rentals/rental_list_map', $this->data );
	}
	
	public function mapview() {
		$city = '';
		$this->data ['Product_igggd'] = $this->uri->segment ( 3, 0 );
		$this->data ['statetag'] = $this->uri->segment ( 2, 0 );
		$datefrom = $_POST['checkin'];
		$dateto = $_POST['checkout'];
		$guests = $_POST['guests'];
		$room_type = $_POST['room_type'];
		$property_type = $_POST['property_type'];
		$pricemin = $_POST['pricemin'];
		$pricemax = $_POST['pricemax'];
		$min_bedrooms = $_POST['min_bedrooms'];
		$min_beds = $_POST['min_beds'];
		$min_bedtype = $_POST['min_bedtype'];
		$min_noofbathrooms = $_POST['min_noofbathrooms'];
		$min_min_stay = $_POST['min_min_stay'];
		$listvalue = $_POST['listvalue'];
		$keywords = $_POST['keywords'];
		$get_address = $_GET['city'];
		if(preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>\.\?\\\]/', $get_address)){
			$this->load->view ( 'site/landing/404', $this->data );die;
		}
		$get_address = strip_tags($_GET['city']);
		//echo $get_address; die;
		$cityDetails = $this->product_model->get_all_details (CITY_NEW, array('name'=> urldecode($get_address)));
		$googleAddress = $this->data ['gogole_address'] = $get_address;
		$googleAddress = str_replace(" ", "+", $googleAddress);
		$json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$googleAddress&sensor=false&key=$google_map_api"); 
		//echo '<pre>';print_r ($json);die; 
		$json = json_decode($json);
		//echo '<pre>';print_r ($json);die;
		$newAddress = $json->{'results'}[0]->{'address_components'};
		$this->data ['lat'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		$this->data ['long'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		foreach($newAddress as $nA)
		{
			if($nA->{'types'}[0] == 'locality')$location = $nA->{'long_name'};
			if($nA->{'types'}[0] == 'administrative_area_level_2')$city = $nA->{'long_name'};
			if($nA->{'types'}[0] == 'country')$country = $nA->{'long_name'};
		}
		if($city == '')
		$city = $location;
		$this->data ['minLat'] = $minLat = $json->{'results'}[0]->{'geometry'}->{'viewport'}->{'southwest'}->{'lat'};
		$this->data ['minLong'] = $minLong = $json->{'results'}[0]->{'geometry'}->{'viewport'}->{'southwest'}->{'lng'};
		$this->data ['maxLat'] = $maxLat = $json->{'results'}[0]->{'geometry'}->{'viewport'}->{'northeast'}->{'lat'};
		$this->data ['maxLong'] = $maxLong = $json->{'results'}[0]->{'geometry'}->{'viewport'}->{'northeast'}->{'lng'};
		
		if($_POST['zoom'] != '')
		{
			$this->data ['zoom'] = $_POST['zoom'];
			$this->data ['cLat'] = $_POST['cLat'];
			$this->data ['cLong'] = $_POST['cLong'];
			$this->data ['minLat'] = $minLat = $_POST['minLat'];
			$this->data ['minLong'] = $minLong = $_POST['minLong'];
			$this->data ['maxLat'] = $maxLat = $_POST['maxLat'];
			$this->data ['maxLong'] = $maxLong = $_POST['maxLong'];
			$search = '(1=1';
			$whereLat = '(pa.lat BETWEEN "'.$minLat.'" AND "'.$maxLat.'" ) AND (pa.lang BETWEEN "'.$minLong.'" AND "'.$maxLong.'" )';
			$search = $search.' AND '.$whereLat;
		}
		else
		{
			$search = '(1=1';
			$whereLat = '(pa.lat BETWEEN "'.$minLat.'" AND "'.$maxLat.'" ) AND (pa.lang BETWEEN "'.$minLong.'" AND "'.$maxLong.'" )';
		}
		
		$search = $whereLat;
		
		
		if(($datefrom != '') && ($dateto != '')){
			$newDateStart = date("Y-m-d", strtotime($datefrom));
			$newDateEnd = date("Y-m-d", strtotime($dateto));
			$this->db->select('*');
			$this->db->from(CALENDARBOOKING);
			$this->db->where('the_date >=',$newDateStart);
			$this->db->where('the_date <=',$newDateEnd);
			
			$this->db->group_by('PropId');
			$restrick_booking_query = $this->db->get();
			if($restrick_booking_query->num_rows() != 0 ){
			$restrick_booking_result = $restrick_booking_query->result();

			foreach($restrick_booking_result as $restrick_data){

			$product_restrick_id .="'".$restrick_data->PropId."',";
			}
			$product_restrick_id .='}';
			$restrick_product_id =  str_replace(',}','',$product_restrick_id );

		$search .= " and p.id NOT IN(".$restrick_product_id.")";
		}
		
		    $searchDetails = array('searchFrom' => $datefrom,'searchTo' =>$dateto, 'searchGuest' => $guests);
			$this->session->set_userdata($searchDetails);
		}
		else{
			$searchDetails = array('searchFrom' => '','searchTo' => '', 'searchGuest' => '');
			$this->session->unset_userdata($searchDetails);
		}
		if($guests != '' && $guests != '0'){
			if(strpos($guests,"+") != '') 
			{
				$guests = str_replace('+', '', $guests) ;
				$search .= " and p.accommodates =".$guests;
			}
			else
			{
				$search .= " and p.accommodates >=".$guests;
			}
		}
		if($pricemax != '' && $pricemin != ''){
		$search .= " and p.convertedPrice BETWEEN ".$pricemin." and ".$pricemax;
		}
		
		if(count($room_type) != 0){
	
		$room_values_count= 0;
		foreach($room_type as $room_checked_values){
		if($room_checked_values !='')
		{
		$room_values_count = 1;
		$room_checked_id .= "'".trim($room_checked_values)."',";
		}	
		}
		$room_checked_id .= "}";
		$room_check_id .= str_replace(",}","",$room_checked_id);
		if($room_values_count == 1)
		$search .= " and p.room_type IN (".$room_check_id.")";
		}
		
		if(count($property_type) != 0){
		$propertyCount = 0 ; 
		foreach($property_type as $property_checked_values){
		if($property_checked_values != '')
		{
		$propertyCount = 1;
		$property_checked_id .= "'".trim($property_checked_values)."',";
		
		}
		}
		$property_checked_id .= "}";
		$property_check_id .= str_replace(",}","",$property_checked_id);
		if($propertyCount == 1)
		$search .= " and p.home_type IN (".$property_check_id.")";
		} 
		$search .= '  and';
		if(count($listvalue) != 0){
		$find_in_set_categories .=  '(';
		foreach($listvalue as $list) {
		if($list != '')
		$find_in_set_categories .= ' FIND_IN_SET("' . $list . '", p.list_name) AND';
		}
		
		}
		if ($find_in_set_categories != '') {
			$find_in_set_categories = substr ( $find_in_set_categories, 0, - 3 );
			$search .= ' ' . $find_in_set_categories . ') and';
		}
		$this->data ['heading'] = '';
		
		if (count ( $_GET ) > 0)
		$config ['suffix'] = '?' . http_build_query ( $_GET, '', "&" );
		$this->data ['GetListUrl'] = $config ['first_url'] = base_url () . 'property?' . http_build_query ( $_GET );
		
		$searchPerPage = $this->config->item ( 'site_pagination_per_page' );
		//$searchPerPage = 2;
		$paginationNo = $_POST['paginationId'];
		$this->data ['paginationId'] = $_POST['paginationId'];
		if($paginationNo == '')$paginationNo = 0;
		$pageLimitStart = $paginationNo;
		$pageLimitEnd = $pageLimitStart + $searchPerPage;
		$get_ordered_list_count = $this->product_model->view_product_details_sitemapview ( '  where ' . $search . ' u.status="Active" and p.status="Publish"  group by p.id order by p.created desc' );
		$this->config->item ( 'site_pagination_per_page' );
		$config ['prev_link'] = 'Previous';
		$config ['next_link'] = 'Next';
		$config ['num_links'] = 2;
		$config ['base_url'] = base_url () . 'property/';
		$config ['total_rows'] = ($get_ordered_list_count->num_rows ());
		$config ["per_page"] = $searchPerPage;
		$config ["uri_segment"] = 2;
		$this->pagination->initialize ( $config );
		$this->data ['paginationLink'] = $data ['paginationLink'] = $this->pagination->create_links ();
		
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		
		if(substr($pageURL, 0, strpos($pageURL, '&')) == '')
		$mainURL = $pageURL;
		else
		$mainURL = substr($pageURL, 0, strpos($pageURL, '&'));
		
		if($get_ordered_list_count->num_rows() > $searchPerPage)
		{
		$pagesL = '<div style="padding:7px;">';
		$prevV = $paginationNo-$searchPerPage;
		if($paginationNo != 0)
		{
			$pagesL .= '<a style="padding:3px;" href="javascript:setPagination('.$prevV.')">Previous</a>';
		}
		else
		{
			$pagesL .= '';
		}
		
		if($get_ordered_list_count->num_rows ()%$searchPerPage == 0)
		{
			$pages = $get_ordered_list_count->num_rows()/$searchPerPage;
		}
		else 
		{
			$pages = (round($get_ordered_list_count->num_rows()/$searchPerPage))+1;
		}
		
		$padeId = 0;
		
		for($i = 1; $i < $pages; $i++)
		{
			if($padeId != $paginationNo)
			{
				$pagesL .= '<a style="padding:3px;" href="javascript:setPagination('.$padeId.')">'.$i.'</a>';
				
			}
			else $pagesL .= $i;
			$padeId = $padeId+$searchPerPage;
		}
		$nextV = $paginationNo+$searchPerPage;
		if($nextV < $get_ordered_list_count->num_rows())
		{
			$pagesL .= '<a style="padding:3px;" href="javascript:setPagination('.$nextV.')">Next</a>';
		}
		else
		{
			$pagesL .= '';
		}
		$pagesL .= '</div>';
		}
		$this->data ['newpaginationLink'] = $data ['newpaginationLink'] = $pagesL;
		
		
		$this->data ['get_ordered_list_count'] = $get_ordered_list_count->num_rows ();
		
		$cat_subcat = $this->product_model->get_cat_subcat ();
		$this->data ['main_cat'] = $cat_subcat ['main_cat'];
		$this->data ['sec_category'] = $cat_subcat ['sec_category'];
		
		$this->data ['productList'] = $this->product_model->view_product_details_sitemapview ( '  where ' . $search . '  p.status="Publish" and pp.cover="Cover" group by p.id order by p.created desc limit ' . $pageLimitStart . ',' . $searchPerPage );
		
	 
		//echo $this->db->last_query();die;

		$pieces = explode(",", $this->input->get('city'));
		$this->data ['heading'] = $city;
		if ($this->data ['productList']->row ()->meta_title != '') {
			$this->data ['meta_title'] = $this->data ['productList']->row ()->meta_title;
		}
		if ($this->data ['productList']->row ()->meta_keyword != '') {
			$this->data ['meta_keyword'] = $this->data ['productList']->row ()->meta_keyword;
		}
		if ($this->data ['productList']->row ()->meta_description != '') {
			$this->data ['meta_description'] = $this->data ['productList']->row ()->meta_description;
		}
		
		if($cityDetails->num_rows == 1){
			$this->data ['heading'] = $cityDetails->row ()->meta_title;
			$this->data ['meta_title'] = $cityDetails->row ()->meta_title;
			$this->data ['meta_keyword'] = $cityDetails->row ()->meta_keyword;
			$this->data ['meta_description'] = $cityDetails->row ()->meta_description;
		}
		
		$this->data ['product_image'] = $this->product_model->Display_product_image_details ();
		$this->data ['image_count'] = $this->product_model->Display_product_image_details_all ();
		
		$wishlists= $this->product_model->get_all_details(LISTS_DETAILS, array('user_id'=>$this->checkLogin ( 'U' )));
		
		$newArr = array();
		foreach($wishlists->result() as $wish)
		{
			$newArr = array_merge($newArr , explode(',', $wish->product_id));
		}
		$this->data ['newArr'] = $newArr; 
		$this->data ['PriceMaxMin'] = $this->product_model->get_PriceMaxMin_new();
		$this->data ['listDetail'] = $this->product_model->get_all_details(LISTINGS,array('id'=>1));	
		$this->data ['SearchPriceMaxMin'] = $this->product_model->searchRentalPriceMaxMin ( '  where ' . $search . '  p.status="Publish"');
		
		//echo $this->db->last_query(); die;
		
		$listValues = $this->product_model->get_all_details(LISTINGS,array('id'=>1));
		foreach ($listValues->result() as $result){
			$values = $result->listing_values;
		}
		$roombedVal=json_decode($values);
		foreach ($roombedVal as $key => $values)
		{ 			
			$listing_values[$key] = $values;
		}
		if($listing_values['accommodates'] != ''){
			$accommodates= explode(',',$listing_values['accommodates']);         
		}
		else{
			$accommodates= '';         
		}
		$this->data['accommodates'] = $accommodates;
        $this->load->view ( 'site/rentals/rental_list', $this->data );
	}
	
	/* map view */
	
	public function display_product_detail($seourl)	
	{
		$where1 = array('p.status'=>'Publish','p.id'=>$seourl);
		$where_or = array('p.status'=>'Publish') ;
		$where2 = array('p.status'=>'Publish','p.id'=>$seourl);
		$this->load->model('admin_model');
		$this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
		$this->data['productDetails'] = $this->product_model->view_product_details_site_one($where1,$where_or,$where2);
		if($this->data['productDetails']->row()->id==''){
			$this->setErrorMessage('error','List details not available');
			redirect(base_url());
		}
		$this->data['productImages'] = $this->product_model->get_images($this->data['productDetails']->row()->id);
		$this->data['reviewData'] = $this->product_model->get_review($this->data['productDetails']->row()->id);
		//echo '<pre>'; print_r($this->data['reviewData']->result()); die;
		if($this->checkLogin('U') != '')		
		{
			$this->data['user_reviewData'] = $this->product_model->get_review($this->data['productDetails']->row()->id,$this->checkLogin('U'));
			$this->data['reviewData'] = $this->product_model->get_review_other($this->data['productDetails']->row()->id,$this->checkLogin('U'));
		}

		$this->data['reviewTotal'] = $this->product_model->get_review_tot($this->data['productDetails']->row()->id);
				//echo '<pre>'; print_r($this->data['reviewTotal']->result()); die;
		$product_id = $this->data['productDetails']->row()->id;
		$this->data['product_details'] = $this->product_model->view_product1($product_id);
		$this->data['RatePackage']='';
		$this->data['heading'] = $this->data['productDetails']->row()->meta_title;
		if ($this->data['productDetails']->row()->meta_title != '')
		{	
			$this->data['meta_title'] = $this->data['productDetails']->row()->meta_title;
		}
		if ($this->data['productDetails']->row()->meta_keyword != '')
		{	    	
			$this->data['meta_keyword'] = $this->data['productDetails']->row()->meta_keyword;
		}
		if ($this->data['productDetails']->row()->meta_description != '')
		{	    	
			$this->data['meta_description'] = $this->data['productDetails']->row()->meta_description;
		}
		$this->data['listDetail'] = $this->product_model->get_all_details(PRODUCT,array('status'=>'Active'));
        $this->data['listNameCnt'] = $this->product_model->get_all_details(ATTRIBUTE,array('status'=>'Active'));
		$this->data['listValueCnt'] = $this->product_model->get_all_details(LIST_VALUES,array('status'=>'Active'));
		$this->data['listItems'] = $this->product_model->get_all_details(ATTRIBUTE,array('status'=>'Active'));
		$wishlists= $this->product_model->get_all_details(LISTS_DETAILS, array('user_id'=>$this->checkLogin ( 'U' )));
		$newArr = array();
		foreach($wishlists->result() as $wish)		
		{			
			$newArr = array_merge($newArr , explode(',', $wish->product_id));
		}
		$this->data ['newArr'] = $newArr;
		$this->data['SublistDetail'] = $this->product_model->get_all_details(LIST_SUB_VALUES,$contition);
		$rental_category_subcategory=$this->product_model->amenities_main_sub_category($this->data['product_details']->row()->list_name);
	    $this->data['subcategory']=$rental_category_subcategory;
        $listIdArr=array();
		foreach($this->data['listValueCnt']->result_array() as $listCountryValue)
		{
			$listIdArr[]=$listCountryValue['list_id'];
		}	
		$this->data['ChkWishlist']='0';
		if($this->checkLogin('U') > 0 )
		{
			$this->data['getWishList'] = $this->product_model->ChkWishlistProduct($this->data['productDetails']->row()->id,$this->checkLogin('U'));
			$this->data['ChkWishlist']=$this->data['getWishList']->num_rows();
		}		
		$this->data['DistanceQryArr'] = $this->product_model->view_product_details_distance_list($this->data['productDetails']->row()->latitude,$this->data['productDetails']->row()->longitude,' p.id <> '.$this->data['productDetails']->row()->id.' and  p.status="Publish" group by p.id order by p.id  DESC');
		$this->data['ConfigBooking'] = $this->product_model->get_all_details(BOOKINGCONFIG,array('cal_url'=>base_url()));
		if($this->data['ConfigBooking']->num_rows()=='')
		{			
			$this->product_model->update_details(BOOKINGCONFIG,array('cal_url'=>base_url()),array());
		}		
		/*-Muthu-*/		
		$this->data['CalendarBooking'] = $this->product_model->get_all_details(CALENDARBOOKING,array('PropId'=>$this->data['productDetails']->row()->id), array(array('field'=>'the_date', 'type' => 'asc')));
		if($this->data['CalendarBooking']->num_rows() > 0)
		{	
			foreach($this->data['CalendarBooking']->result()  as $CRow){
				$DisableCalDate .='"'.$CRow->the_date.'",';
			}
			$this->data['forbiddenCheckIn']='['.$DisableCalDate.']';
		}
		else
		{
			$this->data['forbiddenCheckIn']='[]';
			$this->data['forbiddenCheckOut']='[]';
		}
		$all_dates = array();
		$selected_dates = array();
		
		foreach($this->data['CalendarBooking']->result()  as $date)
		{	
			$all_dates[] = trim($date->the_date);
			$date1 = new DateTime(trim($date->the_date));
			$date2 = new DateTime($prev);
			$diff = $date2->diff($date1)->format("%a");
			if($diff == '1')
			{	
				$selected_dates[] = trim($date->the_date);
			}			
			$prev = trim($date->the_date);
			$DisableCalDate = '';
			foreach($all_dates as $CRow)
			{
				$DisableCalDate .= '"'.$CRow.'",';
			}	
			$this->data['forbiddenCheckIn']='['.$DisableCalDate.']';
			$DisableCalDate = '';
			foreach($selected_dates as $CRow)
			{
				$DisableCalDate .= '"'.$CRow.'",';
			}	
			
			$this->data['forbiddenCheckOut']='['.$DisableCalDate.']';
		}
		/*Muthu*/	
		$service_tax_query='SELECT * FROM '.COMMISSION.' WHERE seo_tag="guest-booking" AND status="Active"';
		$this->data['service_tax']=$this->product_model->ExecuteQuery($service_tax_query);
		$this->data['ProductDealPrice']=$this->product_model->get_all_details(PRODUCT_DEALPRICE,array('product_id'=>$seourl));
		$this->load->view('site/rentals/product_detail',$this->data);
	}

	public function rental_guest_booking() {
		$Rental_id = $this->uri->segment ( 2, 0 );
		$dataArr = array (
				'booking_status' => 'Pending' 
		);
		$this->data ['productList'] = $this->product_model->view_product_details_booking ( ' where p.id="' . $Rental_id . '" and rq.id="' . $this->session->userdata ( 'EnquiryId' ) . '" group by p.id order by p.created desc limit 0,1' );
		$this->data ['countryList'] = $this->product_model->get_country_list ();
		$this->data ['instant'] = $this->data ['productList']->row()->instantbook;
		$this->data ['BookingUserDetails'] = $this->product_model->view_user_details_booking ( ' where p.id="' . $Rental_id . '" and rq.id="' . $this->session->userdata ( 'EnquiryId' ) . '" group by p.id order by p.created desc limit 0,1' );
		$service_tax_query='SELECT * FROM '.COMMISSION.' WHERE commission_type="Guest Booking" AND status="Active"';
        $this->data['service_tax']=$this->product_model->ExecuteQuery($service_tax_query);
		if ($this->data ['productList']->row ()->meta_title != '') {
			$this->data ['meta_title'] = $this->data ['productList']->row ()->meta_title;
		}
		if ($this->data ['productList']->row ()->meta_keyword != '') {
			$this->data ['meta_keyword'] = $this->data ['productList']->row ()->meta_keyword;
		}
		if ($this->data ['productList']->row ()->meta_description != '') {
			$this->data ['meta_description'] = $this->data ['productList']->row ()->meta_description;
		}
		$tax_query = 'SELECT * FROM ' . COMMISSION . ' WHERE id=4';
		$this->data ['tax'] = $this->product_model->ExecuteQuery ( $tax_query );
		$this->load->view ( 'site/rentals/payment1', $this->data );
	}
	
	public function AddWishListForm() {
		if($this->checkLogin('U')!=''){
			$Rental_id = $this->uri->segment ( 4, 0);
			$this->data ['productList'] = $this->product_model->get_product_details_wishlist($Rental_id );
			$this->data ['WishListCat'] = $this->product_model->get_list_details_wishlist ( $this->data ['loginCheck']);
			$this->data ['notesAdded'] = $this->product_model->get_notes_added ( $Rental_id, $this->data ['loginCheck']);
			$this->load->view ( 'site/popup/list', $this->data );
		}else{
			if($this->lang->line("login_signup") != '') { $logins=stripslashes($this->lang->line("login_signup")); } else $logins="Create  Account";
			if($this->lang->line('facebook_signup') != '') { $facebookSign=stripslashes($this->lang->line('facebook_signup')); } else $facebookSign="Sign Up with Facebook";
			if($this->lang->line('signup_google') != '') { $googleSign=stripslashes($this->lang->line('signup_google')); } else $googleSign="Sign Up with Google";
			if($this->lang->line('signup_email') != '') { $SignMail=stripslashes($this->lang->line('signup_email')); } else $SignMail="Sign up with Email";
			if($this->lang->line('signup_cont1') != '') { $SignCont=stripslashes($this->lang->line('signup_cont1')); } else $SignCont='By Signing up, you confirm that you accept the';
			if($this->lang->line('header_terms_service') != '') { $TermServ=stripslashes($this->lang->line('header_terms_service')); } else $TermServ="Terms of Service";
			$faceLink = "window.location.href='".base_url()."facebook/user.php'";
			$googleLink = "window.location.href='".$this->session->userdata('newAuthUrl')."'";
			if($this->lang->line('header_and') != '') { $headEnd=stripslashes($this->lang->line('header_and')); } else $headEnd=" and";
			if($this->lang->line('header_privacy_policy') != '') { $priPoliy=stripslashes($this->lang->line('header_privacy_policy')); } else $priPoliy="Privacy Policy";
			if($this->lang->line('already_member') != '') { $AlrMem = stripslashes($this->lang->line('already_member')); } else $AlrMem="Already a member?";
			if($this->lang->line('header_login') != '') { $headLogin = stripslashes($this->lang->line('header_login')); } else $headLogin =  "Log in";
			echo '<div id="inline_reg" style="background:#fff;width:330px;"><div class="popup_page"><div class="popup_header">'.$logins.'</div><div class="popup_detail"><div class="banner_signup"><a class="popup_facebook" onclick="'.$faceLink.'">'.$facebookSign.'</a><a class="popup_google" onclick="'.$googleLink.'">'.$googleSign.'</a><span class="popup_signup_or">OR</span><button class="btn btn-block btn-primary large btn-large padded-btn-block mail-btn" type="submit" onclick="javascript:loginpopupsignin()">'.$SignMail.'</button><p style="font-size:11px; margin:10px 0">'.$SignCont.' <a target="_blank" data-popup="true" href="pages/privacy-policy">'.$TermServ.'</a> '.$headEnd.' <a target="_blank" data-popup="true" href="pages/policy">'.$priPoliy.'</a>.</p></div></div><span class="popup_stay">'.$AlrMem.'<a href="javascript:loginpopupopen()" style="font-size:13px; margin:0 0 0 3px" class="all-link login-popup">'.$headLogin.'</a></span></div></div>';
		}
	}
	
	public function edit_notes()
	{
		$id = $this->input->post ( 'nid' );
		$notes = $this->input->post ( 'notes' );
		$this->product_model->update_details (NOTES, array (
				'notes' => $notes
		), array ('id' => $id) );
		$res ['result'] = '1';
		echo json_encode ( $res );
	}
	
	public function AddToWishList() {
			if($this->checkLogin('U')!=''){
			$Rental_id = $this->input->post ('pid');
			$notes = $this->input->post ('add-notes');
			$user_id = $this->data ['loginCheck'];
			$note_id = $this->input->post ('nid');
			$wishlist_cat = $this->input->post ('wishlist_cat');
			if ($Rental_id != '') {
				$this->product_model->update_wishlist ( $Rental_id, $wishlist_cat );
				if ($note_id != '') {
					$this->product_model->update_notes ( array (
							'notes' => $notes 
					), array (
							'id' => $note_id 
					) );
				} else {
					$this->product_model->update_notes ( array (
						'product_id' => $Rental_id,
						'user_id' => $user_id,
						'notes' => $notes 
					));
				}
				$this->setErrorMessage ( 'success', 'Wish list added successfully.' );
			}
			echo '<script>window.history.go(-1);</script>';
		} else {
			if($this->lang->line("login_signup") != '') { $logins=stripslashes($this->lang->line("login_signup")); } else $logins="Create  Account";
			if($this->lang->line('facebook_signup') != '') { $facebookSign=stripslashes($this->lang->line('facebook_signup')); } else $facebookSign="Sign Up with Facebook";
			if($this->lang->line('signup_google') != '') { $googleSign=stripslashes($this->lang->line('signup_google')); } else $googleSign="Sign Up with Google";
			if($this->lang->line('signup_email') != '') { $SignMail=stripslashes($this->lang->line('signup_email')); } else $SignMail="Sign up with Email";
			if($this->lang->line('signup_cont1') != '') { $SignCont=stripslashes($this->lang->line('signup_cont1')); } else $SignCont='By Signing up, you confirm that you accept the';
			if($this->lang->line('header_terms_service') != '') { $TermServ=stripslashes($this->lang->line('header_terms_service')); } else $TermServ="Terms of Service";
			$faceLink = "window.location.href='".base_url()."facebook/user.php'";
			$googleLink = "window.location.href='".$this->session->userdata('newAuthUrl')."'";
			if($this->lang->line('header_and') != '') { $headEnd=stripslashes($this->lang->line('header_and')); } else $headEnd=" and";
			if($this->lang->line('header_privacy_policy') != '') { $priPoliy=stripslashes($this->lang->line('header_privacy_policy')); } else $priPoliy="Privacy Policy";
			if($this->lang->line('already_member') != '') { $AlrMem = stripslashes($this->lang->line('already_member')); } else $AlrMem="Already a member?";
			if($this->lang->line('header_login') != '') { $headLogin = stripslashes($this->lang->line('header_login')); } else $headLogin =  "Log in";
			echo '<div id="inline_reg" style="background:#fff;width:330px;"><div class="popup_page"><div class="popup_header">'.$logins.'</div><div class="popup_detail"><div class="banner_signup"><a class="popup_facebook" onclick="'.$faceLink.'">'.$facebookSign.'</a><a class="popup_google" onclick="'.$googleLink.'">'.$googleSign.'</a><span class="popup_signup_or">OR</span><button class="btn btn-block btn-primary large btn-large padded-btn-block mail-btn" type="submit" onclick="javascript:loginpopupsignin()">'.$SignMail.'</button><p style="font-size:11px; margin:10px 0">'.$SignCont.' <a target="_blank" data-popup="true" href="pages/privacy-policy">'.$TermServ.'</a> '.$headEnd.' <a target="_blank" data-popup="true" href="pages/policy">'.$priPoliy.'</a>.</p></div></div><span class="popup_stay">'.$AlrMem.'<a href="javascript:loginpopupopen()" style="font-size:13px; margin:0 0 0 3px" class="all-link login-popup">'.$headLogin.'</a></span></div></div>';
		}
	}
	
	public function rentalwishlistcategoryAdd() {
		$wishuser_id = $this->data ['loginCheck'];
		$wishcatname = $this->input->post ( 'list_name' );
		$val = $this->input->post ('whocansee');
		$list_id = $this->input->post('list_id');
		if($val=='0'){
			$whocansee = 'Everyone';
		} else {
			$whocansee = 'Only me';
		}
		if($list_id!=''){
			$this->data ['WishListCat'] = $this->product_model->get_all_details (LISTS_DETAILS, array (
				'user_id' => $wishuser_id,
				'name' => $wishcatname,
				'id !=' => $list_id
			));
			if ($this->data ['WishListCat']->num_rows () > 0) {
					$res ['result'] = '1';
			} else{
				$this->product_model->update_details (LISTS_DETAILS, array (
					'user_id' => $wishuser_id,
					'name' => ucfirst ( $wishcatname ),
					'whocansee' =>  $whocansee
				), array ('id' => $list_id) );
				$res ['result'] = '5';
			}
		} else{
			$this->data ['WishListCat'] = $this->product_model->get_all_details ( LISTS_DETAILS, array (
				'user_id' => $wishuser_id,
				'name' => $wishcatname 
			));
			if ($this->data ['WishListCat']->num_rows () > 0) {
				$res ['result'] = '1';
			} else {
				$res ['result'] = '0';
				$data = $this->product_model->add_wishlist_category ( array (
					'user_id' => $wishuser_id,
					'name' => ucfirst ( $wishcatname ),
					'whocansee' =>  $whocansee
				) );
				$res ['wlist'] = '<li><label><input type="checkbox" checked="checked" value="' . $data . '" name="wishlist_cat[]" id="wish_' . $data . '" />' . $wishcatname . '</label></li>';
			}
		}
		echo json_encode ( $res );
	}
	
	public function edit_inquiry_details($enqid) {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			$this->data ['heading'] = 'Edit Inquiry Details';
			$user = $this->product_model->get_all_details ( USERS, array (
					'id' => $this->checkLogin ( 'U' ) 
			) );
			// $this->load->model('contact_model');
			
			$this->data ['InquirieDisplay'] = $this->product_model->get_RentalInQueryDetails ( $enqid );
			// echo '<pre>';print_r($this->data['InquirieDisplay']->result()); die;
			
			// $this->data['ProductDisplay'] = $this->product_model->get_selected_fields_records('product_name,id',PRODUCT,array('status'=>'Publish','id'=>$this->data['InquirieDisplay']->row()->rental_id));
			$this->load->view ( 'site/user/edit_inquiry', $this->data );
		}
	}
	function getDatesFromRange($start, $end) {
		$dates = array (
				$start 
		);
		while ( end ( $dates ) < $end ) {
			$dates [] = date ( 'Y-m-d', strtotime ( end ( $dates ) . ' +1 day' ) );
		}
		
		return $dates;
	}
	public function contact_booking() {
		if ($this->checkLogin ( 'U' ) == '') {
			redirect ( base_url () );
		} else {
			$productId = $this->input->post ( 'rental_id' );
			$arrival = $this->input->post ( 'arrival_date' );
			$depature = $this->input->post ( 'depature_date' );
			$dates = $this->getDatesFromRange ( date ( 'Y-m-d', strtotime ( $arrival ) ), date ( 'Y-m-d', strtotime ( $depature ) ) );
			
			$dateCheck = $this->product_model->get_all_details ( CALENDARBOOKING, array (
					'PropId' => $productId 
			) );
			
			if ($dateCheck->num_rows () > 0) {
				foreach ( $dateCheck->result () as $dateCheckStr ) {
					if (in_array ( $dateCheckStr->the_date, $dates )) {
						
						$this->setErrorMessage ( "success", "Rental date already booked" );
						redirect ( base_url () . "listing-reservation" );
					}
				}
			}
			
			$i = 1;
			$dateMinus1 = count ( $dates ) - 1;
			
			foreach ( $dates as $date ) {
				if ($i <= $dateMinus1) {
					$BookingArr = $this->product_model->get_all_details ( CALENDARBOOKING, array (
							'PropId' => $productId,
							'id_state' => 1,
							'id_item' => 1,
							'the_date' => $date 
					) );
					if ($BookingArr->num_rows () > 0) {
					} else {
						$dataArr = array (
								'PropId' => $productId,
								'id_state' => 1,
								'id_item' => 1,
								'the_date' => $date 
						);
						$this->product_model->simple_insert ( CALENDARBOOKING, $dataArr );
					}
				}
				$i ++;
			}
			
			$this->product_model->update_details ( RENTALENQUIRY, array (
					'booking_status' => 'Booked',
					'checkin' => $arrival,
					'checkout' => $depature 
			), array (
					'id' => $this->input->post ( 'cntId' ) 
			) );
			
			// SCHEDULE calendar
			$DateArr = $this->product_model->get_all_details ( CALENDARBOOKING, array (
					'PropId' => $productId 
			) );
			$dateDispalyRowCount = 0;
			if ($DateArr->num_rows > 0) {
				$dateArrVAl .= '{';
				foreach ( $DateArr->result () as $dateDispalyRow ) {
					
					if ($dateDispalyRowCount == 0) {
						
						$dateArrVAl .= '"' . $dateDispalyRow->the_date . '":{"available":"1","bind":0,"info":"","notes":"","price":"' . $price . '","promo":"","status":"booked"}';
					} else {
						$dateArrVAl .= ',"' . $dateDispalyRow->the_date . '":{"available":"1","bind":0,"info":"","notes":"","price":"' . $price . '","promo":"","status":"booked"}';
					}
					$dateDispalyRowCount = $dateDispalyRowCount + 1;
				}
				$dateArrVAl .= '}';
			}
			
			$inputArr4 = array ();
			$inputArr4 = array (
					'id' => $productId,
					'data' => trim ( $dateArrVAl ) 
			);
			
			$this->product_model->update_details ( SCHEDULE, $inputArr4, array (
					'id' => $productId 
			) );
			
			// End SCHEDULE calendar
			
			$condition = array (
					'id' => $this->input->post ( 'renter_id' ) 
			);
			$condition1 = array (
					'id' => $this->input->post ( 'rental_id' ) 
			);
			$Renter_details = $this->product_model->get_all_details ( USERS, $condition );
			
			$Rental_details = $this->product_model->get_all_details ( PRODUCT, $condition1 );
			$Contact_details = $this->product_model->get_all_details ( RENTALENQUIRY, array (
					'id' => $this->input->post ( 'cntId' ) 
			) );
			$Rental_img = $this->product_model->get_all_details ( PRODUCT_PHOTOS, array (
					'product_id' => $this->input->post ( 'rental_id' ) 
			) );
			$User_details = $this->product_model->get_all_details ( USERS, array (
					'id' => $Contact_details->row ()->user_id 
			) );
			if ($Rental_img->row ()->product_image != '') {
				$rentalImage = base_url () . 'server/php/rental/thumbnail/' . $Rental_img->row ()->product_image;
			} else {
				$rentalImage = base_url () . 'images/product/dummyProductImage.jpg';
			}
			
			// ---------------email to user---------------------------
			$newsid = '1';
			$template_values = $this->product_model->get_newsletter_template_details ( $newsid );
			
			$subject = 'From: ' . $this->config->item ( 'email_title' ) . ' - ' . $template_values ['news_subject'];
			$adminnewstemplateArr = array (
					'email_title' => $this->config->item ( 'email_title' ),
					'logo' => $this->data ['logo'],
					'first_name' => $User_details->row ()->firstname,
					'last_name' => $User_details->row ()->lastname,
					'Guests' => $Contact_details->row ()->NoofGuest,
					'user_email' => $User_details->row ()->email,
					'ph_no' => $Contact_details->row ()->phone_no,
					'Message' => $Contact_details->row ()->Enquiry,
					'Arr_date' => $Contact_details->row ()->checkin,
					'Dep_date' => $Contact_details->row ()->checkout,
					'renter_id' => $this->input->post ( 'renter_id' ),
					'rental_id' => $this->input->post ( 'rental_id' ),
					'renter_fname' => $Renter_details->row ()->firstname,
					'renter_lname' => $Renter_details->row ()->lastname,
					'owner_email' => $Renter_details->row ()->email,
					'owner_phone' => $Renter_details->row ()->phone_no,
					'rental_image' => $rentalImage,
					'rental_name' => $Rental_details->row ()->product_title 
			);
			
			extract ( $adminnewstemplateArr );
			// $ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
			// $message .= 'Your inquiry for the rental '.$Rental_details->row()->product_name.' is booked';
			// $message .= 'Arrival date: '.$arrival.' Depature date: '.$depature;
			$header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
			
			$message .= '<!DOCTYPE HTML>
						<html>
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						<meta name="viewport" content="width=device-width"/><body>';
			
			include ('./newsletter/registeration' . $newsid . '.php');
			
			$message .= '</body>
						</html>';
			
			$sender_email = $this->data ['siteContactMail'];
			$sender_name = $this->data ['siteTitle'];
			
			$sender_name = ucfirst ( $Renter_details->row ()->firstname ) . ' ' . ucfirst ( $Renter_details->row ()->lastname );
			$sender_email = $Renter_details->row ()->email;
			// add inbox from mail
			$this->product_model->simple_insert ( INBOX, array (
					'sender_id' => $sender_email,
					'user_id' => $User_details->row ()->email,
					'mailsubject' => $template_values ['news_subject'],
					'description' => stripslashes ( $message ) 
			) );
			
			$email_values = array (
					'mail_type' => 'html',
					'from_mail_id' => $sender_email,
					'mail_name' => $sender_name,
					'to_mail_id' => $User_details->row ()->email,
					'subject_message' => $template_values ['news_subject'],
					'body_messages' => $message 
			);
			
			// echo '<pre>';print_r($email_values);die;
			$email_send_to_common = $this->product_model->common_email_send ( $email_values );
			
			// print_r($email_values); die;
			
			/**
			 * ************************************************************
			 */
			
			$this->setErrorMessage ( "success", "Rental booked" );
			redirect ( base_url () . "listing-reservation" );
		}
	}
	
	public function request_booking()
	{
	//echo "Inside the function";
	//die;
		$checkIn = date('Y-m-d H:i:s', strtotime($this->input->post ( 'checkIn' )));
		$checkOut = date('Y-m-d H:i:s', strtotime($this->input->post ( 'checkOut' )));
		$productId = $this->input->post ( 'productId' );
		$get_user_id = $this->product_model->get_all_details(PRODUCT, array('id' => $productId));	
		//print_r($get_user_id->result()); die;
		$renterId = $get_user_id->row()->user_id;
		$cancellation_policy = $get_user_id->row()->cancellation_policy;
		$noOfNyts = $this->input->post ( 'noOfNyts' );
		$productPrice = $this->input->post ( 'productPrice' );
		$serviceFee = trim($this->input->post ( 'service_fee' ));
		$totalPrice = $this->input->post ('totalPrice' );
		$noOfGuests = $this->input->post ( 'noOfGuests' );
		$msg = $this->input->post ( 'msg' );
		$subTotal = $totalPrice - $serviceFee;
		
		$dataArr = array(
			'checkin' => $checkIn,
			'b_checkin' => $checkIn,
			'checkout' => $checkOut,
			'b_checkout' => $checkOut,
			'numofdates' => $noOfNyts,
			'b_numofdates' => $noOfNyts,
			'serviceFee' => $serviceFee,
			'b_serviceFee' => $serviceFee,
			'subTotal' => $subTotal,
			'totalAmt' => $totalPrice,
			'b_totalAmt' => $totalPrice,
			'caltophone' => '',
			'enquiry_timezone' => '',
			'user_id' => $this->checkLogin ( 'U' ),
			'renter_id' => $renterId,
			'NoofGuest' => $noOfGuests,
			'b_NoofGuest' => $noOfGuests,
			'prd_id' => $productId,
			'b_prd_id' => $productId,
			'cancellation_policy' => $cancellation_policy			
		);	
			
		$booking_status = array (
			'booking_status' => 'Pending'
		);
			
		$dataArr = array_merge ( $dataArr, $booking_status );
		//print_r($dataArr); die;
	
		$this->product_model->simple_insert (RENTALENQUIRY, $dataArr );
		//echo $this->db->last_query();
		$insertid = $this->db->insert_id ();
	//	echo $insertid;die;

		$this->data['bookingno']=$this->user_model->get_all_details(RENTALENQUIRY,array('id'=>$insertid));

		if($this->data['bookingno']->row()->Bookingno=='' || $this->data['bookingno']->row()->Bookingno==NULL) 
		{
			$val = 10*$insertid+8;
			$val = 1500000+$val;

			$bookingno ="EN".$val;

			$newdata = array (
				'Bookingno' => $bookingno
				);
			$condition = array (
				'id' => $insertid
				);
			$this->user_model->update_details (RENTALENQUIRY,$newdata,$condition);
		}
			
		$dataArr = array(
			'productId' => $productId,
			'bookingNo' => $bookingno,
			'senderId' => $this->checkLogin ( 'U' ),
			'receiverId' => $renterId,
			'subject' => 'Booking Request : '.$bookingno,
			'message' => $msg
		);
	
		$this->user_model->simple_insert(MED_MESSAGE, $dataArr);
		
		//redirect('my-vocations');
	}
	
	public function insert_pay() {
	
	}
	
	public function ajaxDateCalculation_special()
	{
	
		$productId = $this->input->post ( 'productId' );
		$productPrice = $this->input->post ( 'productPrice' );
		$dateFrom = $this->input->post ( 'dateFrom' );
		$dateTo = $this->input->post ( 'dateTo' );
		if($dateFrom == $dateTo)
		{echo '<p>Same day check in and check out is not allowed</p>';die;}
		$noOfGuests = $this->input->post ( 'noOfGuests' );
		$this->data['bookingNo'] = $this->input->post ( 'bookingNo' );
		$this->data['bookingDetails'] = $this->user_model->get_booking_details($this->data['bookingNo']);
		$bookedDates = $this->product_model->get_all_details(CALENDARBOOKING,array('PropId'=>$productId));
		
		$product = $this->product_model->get_all_details(PRODUCT,array('id'=>$productId));
		$minimum_stay = $product->row()->minimum_stay;
		$productPrice = $product->row()->price;
		$commission = $this->product_model->get_all_details('fc_commission',array('status' => 'Active', 'seo_tag'=>'guest-booking'));
		
		foreach($bookedDates->result() as $booked)
		{
			$bookedArr[] = date('m/d/Y', strtotime($booked->the_date));
		}
		
		$start = strtotime($dateFrom);
		$end = strtotime($dateTo);
		$datediff = $end - $start;
		if($datediff > 0){
			$current = $dateFrom;
			do
			{
				$result[] = date("Y-m-d", strtotime($current));
				if(in_array($current,$bookedArr)){
					echo '<p>The selected dates are not available</p>';die;
				}
				$currentInr = strtotime("+1 day", strtotime($current));
				$current = date("m/d/Y", $currentInr);
			}while($current != $dateTo);
		}else {
			echo '<p>The selected dates are not available</p>';die;
		}
		$this->data['noOfNyts'] = ($datediff/(60*60*24));
		if($minimum_stay > $this->data['noOfNyts'])
		{
			if($this->lang->line('minimum_stay_alert') != '' && $this->lang->line('nights') != ''){
				echo "<p>".stripslashes($this->lang->line('minimum_stay_alert')).' '.$minimum_stay.' '.stripslashes($this->lang->line('nights'))."</p>";
			} else {
				echo "<p style='color:red;'>The minimum stay should be $minimum_stay nights</p>"; 
			}
			die;
		}
		
		
		$start = strtotime($dateFrom);
		$end = strtotime($dateTo);
		$datediff = $end - $start;
		$this->data['noOfNyts'] = ($datediff/(60*60*24));
		$this->data['productPrice'] = $productPrice;
		$this->data['productId'] = $productId;
		$this->data['checkIn'] = $dateFrom;
		$this->data['checkOut'] = $dateTo;
		$this->data['noOfGuests'] = $noOfGuests;
		$this->data['ScheduleDatePrice'] = $this->product_model->get_all_details(SCHEDULE,array('id'=>$productId));
		$DateCalCul = 0;
		if($this->data['ScheduleDatePrice']->row()->data !=''){ 
			$dateArr=json_decode($this->data['ScheduleDatePrice']->row()->data);
			$finaldateArr=(array)$dateArr;
			foreach($result as $Rows){
				if (array_key_exists($Rows, $finaldateArr)) {
					$DateCalCul= $DateCalCul+$finaldateArr[$Rows]->price;
				}else{
					$DateCalCul= $DateCalCul+$productPrice;
				}
			}
		}else{
			$DateCalCul = ($this->data['noOfNyts'] * $productPrice);
		}
		
		if(count($result) >= 7 && $product->row()->price_perweek != '0.00')
		{
			$weeks = floor(count($result)/7);
			$days = count($result)%7;
			$DateCalCul = $weeks*$product->row()->price_perweek;
			$DateCalCul = $DateCalCul+($days*$product->row()->price);
		}
		if(count($result) >= 30 && $product->row()->price_permonth != '0.00')
		{
			$months = floor(count($result)/30);
			$days = count($result)%30;
			$DateCalCul = $months*$product->row()->price_permonth;
			$DateCalCul = $DateCalCul+($days*$product->row()->price);
		}
		
		
		$this->data['totalPrice'] = $DateCalCul;
		$this->data['productPrice'] = round($DateCalCul/$this->data['noOfNyts'], 2);
		//$this->data['totalPrice'] = $productPrice*$this->data['noOfNyts'];
		$service_tax = 0;
		foreach($commission->result() as $row){
			if($row->promotion_type == "flat"){
			 $service_tax += $row->commission_percentage;
				// $service_tax += round($row->commission_percentage*$this->session->userdata('currency_r'), 2);
			 $this->data['service_tax_string'] = $this->session->userdata('currency_s').round($row->commission_percentage*$this->session->userdata('currency_r'), 2);
			}else{
			 $service_tax = $service_tax + ($this->data['totalPrice'] * $row->commission_percentage)/100;
			 $this->data['service_tax_string'] = $row->commission_percentage.'%';
			}
		}
		
		$this->data['totalNetPrice'] = str_replace(',', '', number_format($this->data['totalPrice'],2));
		$this->data['service_tax'] = str_replace(',', '', number_format($service_tax, 2));
		$this->data['totalPrice'] = str_replace(',', '', number_format($this->data['totalPrice'],2));
		
		
		if(trim($product->row()->user_id) == trim($this->checkLogin('U'))){
		$this->data['booking_alert'] = 'Failed';
		}else{
		$this->data['booking_alert'] = 'Success';
		}
		$this->load->view ( 'site/user/special_price', $this->data );
	}
	
	
		public function ajaxDateCalculation_specialprice()
	{
	
		$productId = $this->input->post ( 'productId' );
		$productPrice = $this->input->post ( 'productPrice' );
		$dateFrom = $this->input->post ( 'dateFrom' );
		$dateTo = $this->input->post ( 'dateTo' );
		if($dateFrom == $dateTo)
		{echo '<p>Same day check in and check out is not allowed</p>';die;}
		$noOfGuests = $this->input->post ( 'noOfGuests' );
		$this->data['bookingNo'] = $this->input->post ( 'bookingNo' );
		$this->data['bookingDetails'] = $this->user_model->get_booking_details($this->data['bookingNo']);
		$bookedDates = $this->product_model->get_all_details(CALENDARBOOKING,array('PropId'=>$productId));
		
		$product = $this->product_model->get_all_details(PRODUCT,array('id'=>$productId));
		$minimum_stay = $product->row()->minimum_stay;
		$productPrice = $product->row()->price;
		$commission = $this->product_model->get_all_details('fc_commission',array('status' => 'Active', 'seo_tag'=>'guest-booking'));
		
		foreach($bookedDates->result() as $booked)
		{
			$bookedArr[] = date('m/d/Y', strtotime($booked->the_date));
		}
		
		$start = strtotime($dateFrom);
		$end = strtotime($dateTo);
		$datediff = $end - $start;
		if($datediff > 0){
			$current = $dateFrom;
			do
			{
				$result[] = date("Y-m-d", strtotime($current));
				if(in_array($current,$bookedArr)){
					echo '<p>The selected dates are not available</p>';die;
				}
				$currentInr = strtotime("+1 day", strtotime($current));
				$current = date("m/d/Y", $currentInr);
			}while($current != $dateTo);
		}else {
			echo '<p>The selected dates are not available</p>';die;
		}
		$this->data['noOfNyts'] = ($datediff/(60*60*24));
		if($minimum_stay > $this->data['noOfNyts'])
		{
			if($this->lang->line('minimum_stay_alert') != '' && $this->lang->line('nights') != ''){
			echo "<p>".stripslashes($this->lang->line('minimum_stay_alert')).' '.$minimum_stay.' '.stripslashes($this->lang->line('nights'))."</p>";
			echo "min_say";
			} else {
			//echo json_encode(array('msg'=>"min_say"));
			echo "min_say";
			
			} 
		}
	}

	public function special_booking()
	{
	//	echo '<pre>';print_r($_POST);die;
		$oldBookingNo = $this->input->post ( 'bookingNo' );
		$oldBooking = $this->user_model->get_all_details(RENTALENQUIRY, array('Bookingno'=>$oldBookingNo));
		$oldUserId = $oldBooking->row()->user_id;
		$oldRenterId = $oldBooking->row()->renter_id;
		$oldProductId = $oldBooking->row()->prd_id;
		
		
		$checkIn = date('Y-m-d H:i:s', strtotime($this->input->post ( 'checkIn' )));
		$checkOut = date('Y-m-d H:i:s', strtotime($this->input->post ( 'checkOut' )));
		$productId = $this->input->post ( 'productId' );
		$get_user_id = $this->product_model->get_all_details(PRODUCT, array('id' => $productId));
		$renterId = $get_user_id->row()->user_id;
		$noOfNyts = $this->input->post ( 'noOfNyts' );
		$productPrice = $this->input->post ( 'productPrice' );
		$serviceFee = $this->input->post ( 'service_fee' );
		$totalPrice = $this->input->post ( 'totalPrice' );
		$totalPrice = str_replace(',', '', $totalPrice);
		
		$noOfGuests = $this->input->post ( 'noOfGuests' );
		$message = $this->input->post ( 'special_message' );
		
		$commission = $this->product_model->get_all_details('fc_commission',array('status' => 'Active', 'seo_tag'=>'guest-booking'));
		
		$service_tax = 0;
		
		foreach($commission->result() as $row){
			if($row->promotion_type == "flat"){
			 	$service_tax = $row->commission_percentage;
			}else{
				$service_tax = $service_tax + ($totalPrice  * $row->commission_percentage)/100;
			}
		}
		
		//$totalPrice = currentToProduct($productId, $totalPrice);
		$totalPrice =  $totalPrice;
		$totalPrice = str_replace(",", "", $totalPrice);
		
		//$serviceFee =  currentToProduct($productId, $service_tax);
		$serviceFee =  str_replace(",", "", $service_tax);
		$totalPrice = $totalPrice + $serviceFee;
		$dataArr = array(
			'checkin' => $checkIn,
			'checkout' => $checkOut,
			'numofdates' => $noOfNyts,
			'serviceFee' => $serviceFee,
			'totalAmt' => $totalPrice,
			'caltophone' => '',
			'enquiry_timezone' => '',
			'user_id' => $oldUserId,
			'renter_id' => $oldRenterId,
			'NoofGuest' => $noOfGuests,
			'prd_id' => $productId,
			'offer_approval'=>'Pending'
			);
		
		$condition = array ('Bookingno' => $oldBookingNo,);
		
		$this->user_model->update_details (RENTALENQUIRY,$dataArr,$condition);
		$rental_enquiry_id = $oldBookingNo;

		$dataArr = array(
			'productId' => $oldProductId,
			'bookingNo' => $oldBookingNo,
			'senderId' => $oldRenterId,
			'receiverId' => $oldUserId,
			'subject' => 'Booking Request : '.$oldBookingNo,
			'message' => $message,
			'point' => '2',
			'special_booking' => $oldBookingNo,
			'b_checkin' => $checkIn,
			'b_checkout' => $checkOut,
			'b_numofdates' => $noOfNyts,
			'b_NoofGuest' => $noOfGuests,
			'b_serviceFee' => $serviceFee,
			'b_totalAmt' => $totalPrice,
			'b_prd_id' => $productId 
		);
		
		$this->user_model->simple_insert(MED_MESSAGE, $dataArr);
		$messageId = $this->user_model->get_last_insert_id();
		$this->send_special_booking_notifications($messageId,$rental_enquiry_id);
		
		$senderDetails = $this->product_model->get_all_details(USERS,array('id'=>$oldRenterId));
		$receiverDetails = $this->product_model->get_all_details(USERS,array('id'=>$oldUserId));
		require_once('twilio/Services/Twilio.php');
		if($receiverDetails->row()->phone_no != '' && $receiverDetails->row()->country_code != '' && $receiverDetails->row()->ph_verified == 'Yes' && $receiverDetails->row()->mobile_notification == 'Yes'){
			$to = $receiverDetails->row()->country_code.$receiverDetails->row()->phone_no;
			$senderName = $senderDetails->row()->user_name;
			$receiverName = $receiverDetails->row()->user_name;
			$message = "Hi ".$receiverName.", You've received special booking offer(".$oldBookingNo.") from ".$senderName." for the property ".$get_user_id->row()->product_title." - from ".$this->config->item ( 'meta_title' );
			
			$account_sid = $this->config->item('twilio_account_sid'); 
			$auth_token = $this->config->item('twilio_account_token');
			$from=$this->config->item('twilio_phone_number');
			$client = new Services_Twilio($account_sid, $auth_token); 
			$client->account->messages->create(array( 
				'To' => $to,	
				'From' =>$from, 
				'Body' => $message,
			)); 
		}
		
		
		redirect('new_conversation/'.$oldBookingNo);
	}	

	public function send_special_booking_notifications($messageId,$rental_enquiry_id){
			
		$bookingDetails = $this->product_model->get_booking_details($rental_enquiry_id);
		$offerDetails = $this->product_model->get_spl_offer_details($rental_enquiry_id);
		$requestProduct = $this->product_model->get_all_details(PRODUCT, array('id'=>$offerDetails['b_prd_id']));
		
		$newsid = '50';
		$template_values = $this->product_model->get_newsletter_template_details ( $newsid );
		
		$subject = 'From: ' . $this->config->item ( 'email_title' ) . ' - ' . $template_values ['news_subject'];
		$adminnewstemplateArr = array (
			'email_title' => $this->config->item ( 'email_title' ),
			'logo' => $this->data ['logo'],
			'username' => $offerDetails['firstname'],
			'booking_no' => $offerDetails['Bookingno'],
			'propertyname' => $offerDetails['product_title'],
			'request_propertyname' => $requestProduct->row()->product_title,
			'req_amount' => $offerDetails['b_totalAmt'],
			'off_amount' => $offerDetails['totalAmt'],
			'req_service_fee' => $offerDetails['b_serviceFee'],
			'off_service_fee' => $offerDetails['serviceFee'],
			'req_checkin' => date('d-m-Y', strtotime($offerDetails['b_checkin'])),
			'off_checkin' => date('d-m-Y', strtotime($offerDetails['checkin'])),
			'req_checkout' => date('d-m-Y', strtotime($offerDetails['b_checkout'])),
			'off_checkout' => date('d-m-Y', strtotime($offerDetails['checkout'])),
			'currencySymbol' => '$'
		);
		//echo '<pre>';print_r($adminnewstemplateArr);die;
		extract ( $adminnewstemplateArr );
		$header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
		
		$message .= '<!DOCTYPE HTML>
					<html>
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<meta name="viewport" content="width=device-width"/><body>';
		
		include ('./newsletter/registeration' . $newsid . '.php');
		
		$message .= '</body>
					</html>';
		
		$sender_email = $this->data ['siteContactMail'];
		$sender_name = $this->data ['siteTitle'];
		
		$email_values = array (
				'mail_type' => 'html',
				'from_mail_id' => $sender_email,
				'mail_name' => $sender_name,
				'to_mail_id' => $offerDetails['email'],
				'subject_message' => $template_values ['news_subject'],
				'body_messages' => $message 
		);
		//echo stripslashes($message);die;
		
		$email_send_to_common = $this->product_model->common_email_send ( $email_values );
	}
	
	public function confirm_offer()
	{
		$action = $this->input->post('action');
		$bookingNo = $this->input->post('bookingNo');
		$id = $this->input->post('id');
		
		if($action == 'Accept') {
			$condition = array (
				'id' => $id
				);
			$productDetails=$this->product_model->get_all_details(MED_MESSAGE,$condition);
			
			$newdata = array (
				'prd_id' =>$productDetails->row()->b_prd_id,
				'checkin' =>$productDetails->row()->b_checkin,
				'checkout' =>$productDetails->row()->b_checkout,
				'NoofGuest' =>$productDetails->row()->b_NoofGuest,
				'numofdates' =>$productDetails->row()->b_numofdates,
				'totalAmt' =>$productDetails->row()->b_totalAmt,
				'subTotal' =>$productDetails->row()->b_totalAmt-$productDetails->row()->b_serviceFee,
				'pro_subTotal' =>  AdminCurrencyValue($productDetails->row()->b_prd_id,$productDetails->row()->b_totalAmt-$productDetails->row()->b_serviceFee),
				'pro_serviceFee' =>  AdminCurrencyValue($productDetails->row()->b_prd_id,$productDetails->row()->b_serviceFee),
				'pro_totalAmt' =>  AdminCurrencyValue($productDetails->row()->b_prd_id,$productDetails->row()->b_totalAmt ),
				'approval'=>'Accept'
				);
			$this->user_model->update_details (MED_MESSAGE,array('status'=>'Accept'),array('bookingNo'=>$bookingNo));
			
			$this->user_model->update_details (MED_MESSAGE,array('offer_accept'=>'Decline'),array('bookingNo'=>$bookingNo));
			
			$this->user_model->update_details (MED_MESSAGE,array('offer_accept'=>'Accept'),array('bookingNo'=>$bookingNo, 'id'=>$id));
			
			
		}else{
			$condition = array (
				'Bookingno' => $bookingNo
				);
			$productDetails=$this->product_model->get_all_details(RENTALENQUIRY,$condition);
			$newdata = array (
				'prd_id' =>$productDetails->row()->b_prd_id,
				'checkin' =>$productDetails->row()->b_checkin,
				'checkout' =>$productDetails->row()->b_checkout,
				'NoofGuest' =>$productDetails->row()->b_NoofGuest,
				'numofdates' =>$productDetails->row()->b_numofdates,
				'totalAmt' =>$productDetails->row()->b_totalAmt,
				'subTotal' =>$productDetails->row()->b_totalAmt-$productDetails->row()->b_serviceFee,
				'pro_subTotal' =>  AdminCurrencyValue($productDetails->row()->b_prd_id,$productDetails->row()->b_totalAmt-$productDetails->row()->b_serviceFee),
				'pro_serviceFee' =>  AdminCurrencyValue($productDetails->row()->b_prd_id,$productDetails->row()->b_serviceFee),
				'pro_totalAmt' =>  AdminCurrencyValue($productDetails->row()->b_prd_id,$productDetails->row()->b_totalAmt ),
				);
			$this->user_model->update_details (MED_MESSAGE,array('offer_accept'=>'Decline'),array('bookingNo'=>$bookingNo, 'id'=>$id));
		}
		$condition = array (
			'Bookingno' => $bookingNo
			);
		$this->user_model->update_details (RENTALENQUIRY,$newdata,$condition);
		$condition = array (
			'Bookingno' => $bookingNo,
			'senderId' => $this->checkLogin ( 'U' )
			);
		$chageReadStatus = $this->user_model->get_all_details(MED_MESSAGE,$condition,array(array('field'=>'id', 'type'=>'desc')));
		
		$this->send_special_confirmation($id, $action);
		
		if($action == 'Accept')
		$messageAction = 'Accepted';
		else 
		$messageAction = 'Declined';
		
		$this->user_model->update_details (MED_MESSAGE,array('msg_read'=>'No'),array('id'=>$chageReadStatus->row()->id));
		$condition = array ('Bookingno' => $bookingNo);
		$productDetails=$this->product_model->get_all_details(RENTALENQUIRY,$condition);
		$renterId = $productDetails->row()->renter_id;
		$senderDetails = $this->user_model->get_all_details ( USERS, array ('id' => $this->checkLogin ( 'U' )));
		$receiverDetails = $this->user_model->get_all_details ( USERS, array ('id' => $renterId));
		
		require_once('twilio/Services/Twilio.php');
		
		if($receiverDetails->row()->phone_no != '' && $receiverDetails->row()->country_code != '' && $receiverDetails->row()->ph_verified == 'Yes' && $receiverDetails->row()->mobile_notification == 'Yes'){
			$to = $receiverDetails->row()->country_code.$receiverDetails->row()->phone_no;
			$senderName = $senderDetails->row()->user_name;
			$receiverName = $receiverDetails->row()->user_name;
			$message = 'Hi '.$receiverName.', Special Booking Offer ('.$bookingNo.") was ".$messageAction." by ".$senderName." : - from ".$this->config->item ( 'meta_title' );
			
			$account_sid = $this->config->item('twilio_account_sid'); 
			$auth_token = $this->config->item('twilio_account_token');
			$from=$this->config->item('twilio_phone_number');
			$client = new Services_Twilio($account_sid, $auth_token); 
			$client->account->messages->create(array( 
				'To' => $to,	
				'From' =>$from, 
				'Body' => $message,
			)); 
		}
		
		$this->db->select('P.id, P.product_title, P.price, MM.b_checkin, MM.b_checkout, MM.b_totalAmt, MM.b_NoofGuest, MM.b_numofdates, MM.b_serviceFee, MM.offer_accept, RQ.checkin, RQ.checkout, RQ.totalAmt, RQ.NoofGuest, RQ.offer_approval, RQ.approval');
		$this->db->from(MED_MESSAGE.' as MM');
		$this->db->join(RENTALENQUIRY.' as RQ', 'RQ.Bookingno = MM.special_booking', 'LEFT');
		$this->db->join(PRODUCT.' as P', 'P.id = RQ.prd_id', 'LEFT');
		$this->db->where('RQ.Bookingno', $bookingNo);
		$this->data['specialBookingDetails']= $this->db->get();
		$this->load->view ( 'site/user/offer_confirmation', $this->data );
	}
	
	public function send_special_confirmation($id, $action){
		if($action == 'Accept')
		$messageAction = 'Accepted';
		else 
		$messageAction = 'Declined';
		$messageDetails = $this->user_model->get_all_details(MED_MESSAGE, array('id' => $id));
		$bookingDetails = $this->user_model->get_all_details(RENTALENQUIRY, array('Bookingno' => $messageDetails->row()->bookingNo));
		$productDetails = $this->user_model->get_all_details(PRODUCT, array('id' => $bookingDetails->row()->prd_id));
		$senderDetails = $this->user_model->get_all_details(USERS, array('id' => $messageDetails->row()->receiverId));
		$receiverDetails = $this->user_model->get_all_details(USERS, array('id' => $messageDetails->row()->senderId));
		$userName = $receiverDetails->row()->firstname.' '.$receiverDetails->row()->lastname;
		$travelername = $senderDetails->row()->firstname.' '.$senderDetails->row()->lastname;
		$email = $receiverDetails->row()->email;
		$newsid = 67;
		$template_values = $this->user_model->get_newsletter_template_details( $newsid );
		$adminnewstemplateArr = array (
			'logo' => $this->data ['logo'],
			'hostname'=>$userName,
			'bookingNo'=>$messageDetails->row()->bookingNo,
			'action'=>$messageAction,
			'travelername'=>$travelername
		);
		
		extract ( $adminnewstemplateArr );
		$header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
		
		$message .= '<body>';
		include ('./newsletter/registeration' . $newsid . '.php');
		$message .= '</body>';
		
		if ($template_values ['sender_name'] == '' && $template_values ['sender_email'] == '') {
			$sender_email = $this->data ['siteContactMail'];
			$sender_name = $this->data ['siteTitle'];
		} else {
			$sender_name = $template_values ['sender_name'];
			$sender_email = $template_values ['sender_email'];
		}
		
		
		$email_values = array (
				'mail_type' => 'html',
				'from_mail_id' => $sender_email,
				'mail_name' => $sender_name,
				'to_mail_id' => $email,
				'subject_message' => $template_values ['news_subject'],
				'body_messages' => trim($message)
		);
		//echo stripslashes($message);die;
		$email_send_to_common = $this->user_model->common_email_send ( $email_values );
		
	}
	
}

/*End of file rentals.php */
/* Location: ./application/controllers/site/rentals.php */