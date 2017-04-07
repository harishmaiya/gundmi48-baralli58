<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
      session_start(); 

/**
 * 
 * This controller contains the functions related to Product management 
 * @author dev Beetrut
 *
 */ 

class Rentals extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation','image_lib'));		
		$this->load->model('product_model');
		if ($this->checkPrivileges('rental',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the product list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/rentals/display_product_list');
		}
	}
	
	/**
	 * 
	 * This function loads the selling product list page
	 */
	public function display_product_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Rentals List';
			$this->data['productList'] = $this->product_model->view_product_details('  where u.status="Active" or p.user_id=0 group by p.id order by p.created desc');
			$this->load->view('admin/rentals/display_product_list',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new product form
	 */
	public function add_product_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Rental';
			$product_id=$this->data['Product_id'] = $this->uri->segment(4,0);
			
		
		
			
		
			
			
			
			
		
			
		
		/*edit form code added 29/05/2014 */
		
		 $id=$this->uri->segment(4,0);
		 $hotel_id = $this->uri->segment(4);
		
			
			if($hotel_id!='') {
				$condition=array('id'=>$hotel_id);
				$condition = array(TOUR.'.id' => $hotel_id);
				//$this->data['product_details']=$this->tour_model->display_tour_list($condition);
				$this->data['product_details'] = $this->product_model->view_product1($hotel_id);
				
			}
		} 	
			$this->load->view('admin/rentals/add_product',$this->data);
		
	}
	
	public function UpdateProduct(){}
	
	/** 
	* 
	*  Inserr the Product using Ajax added 26/05/2014 */
	
	 public function insert_general_info()
		{ 
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		} else {
					$condition='';
					$catID = $this->input->post('rental_id');	
					$title = $this->input->post('product_title');
					$seourl = url_title($title, '-', TRUE);
					$checkSeo = $this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl));
					$seo_count = 1;
					while ($checkSeo->num_rows()>0){
						$seourl = $seourl.$seo_count;
						$seo_count++;
						$checkSeo = $this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl));
					}
					
					$dataArr = array( 'user_id' => $this->input->post('user_id'),'product_name' => $title,'product_title' => $title,'seourl' => $seourl);
					$excludeArr =array( 'product_title','catID','chk','rental_id','user_id');
					if($catID==0) {			
						$this->product_model->commonInsertUpdate(PRODUCT,'insert',$excludeArr,$dataArr,$condition);	
						$returnArr['resultval']=$insert_id = $this->db->insert_id();	
						$inputArr = array('product_id' =>$insert_id);
						$this->product_model->simple_insert(PRODUCT_ADDRESS,$inputArr);
						$this->product_model->simple_insert(PRODUCT_BOOKING,$inputArr);
						$this->product_model->simple_insert(SCHEDULE,array('id'=>$insert_id));
						redirect('admin/rentals/add_rental_photo/'.$insert_id);
					}else { 
						$condition=array('id'=>$this->input->post('rental_id'));
						$this->product_model->commonInsertUpdate(PRODUCT,'update',$excludeArr,$dataArr,$condition);	
						redirect('admin/rentals/add_rental_photo/'.$catID);
					}
						
					
				}
		}
		
	public function dragimageuploadinsert()
		{
			$val = $this->uri->segment(4,0);
			$this->data['prod_id']=$val;
			
			$this->load->view('admin/rentals/dragndrop',$this->data);
			//$this->load->view('site/product/photos_listing');
		}
		
	/** image upload */
	 public function InsertProductImage1($prd_id) {
	    $prd_id = $this->input->post('prdiii');
		$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
		$max_file_size = 1024*10000; //100 kb
		$path = "server/php/rental/"; // Upload directory
		$count = 0;
		
		if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
			// Loop $_FILES to execute all files
			foreach ($_FILES['files']['name'] as $f => $name) {     
				if ($_FILES['files']['error'][$f] == 4) {
					continue; // Skip file if any error found
				}	       
				if ($_FILES['files']['error'][$f] == 0) {	           
					if ($_FILES['files']['size'][$f] > $max_file_size) {
						$message[] = "$name is too large!.";
						//redirect('admin/product/add_product_form/'.$prd_id);
						
						continue; // Skip large files
						
					}
					elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
						$message[] = "$name is not a valid format";
						continue; // Skip invalid file formats
					}
					else{ // No error found! Move uploaded files 
						if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name)) {
							$filename[] =$_FILES["files"]["name"][$f];
							$count++; // Number of successfully uploaded files
						}
					}
				}
			}
		}
		for($i=0;$i<count($filename);$i++) {	
			   if(!empty($filename[$i])) {
			   // print_r($img_name[$i]);
				$filePRoductUploadData = array('product_id'=>$prd_id,'product_image'=>$filename[$i]);
			    $this->product_model->simple_insert(PRODUCT_PHOTOS,$filePRoductUploadData);
				
				
			   } 
			   else {
			    print_r("File is empty");
				$this->setErrorMessage('error','You cannot choose image');
				
				
			   }
			   
		}
		redirect('admin/rentals/add_rental_photo/'.$prd_id);
		return true;
	 
		}
		
		public function AddAmenities_form(){
			///////////////////
		if ($this->checkLogin('A') == ''){
			redirect('admin');	redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Rental';
			$product_id = $this->uri->segment(4,0);
			
			$condition = array('id' => $product_id);
			$this->data['product_details'] = $this->product_model->view_product1($product_id);
			$this->data['getCommonFacilityDetails'] = $this->product_model->getCommonFacilityDetails();
			$this->data['getCommonFacilityDetails'] = $this->product_model->getCommonFacilityDetails();
			$this->data['getExtraFacilityDetails'] = $this->product_model->getExtraFacilityDetails();
			$this->data['getSpecialFeatureFacilityDetails'] = $this->product_model->getSpecialFeatureFacilityDetails();
			$this->data['getHomeSafetyFacilityDetails'] = $this->product_model->getHomeSafetyFacilityDetails();
		}
			/////////////////////
			$this->load->view('admin/rentals/add_amenities',$this->data);
		}
	public function addAmenities()
		{
			
			$listname = $this->input->post('list_name');
			$id = $this->input->post('prdiii');	
			$condition=array('id'=>$id);
			$facility = @implode(',',$this->input->post('list_name'));		
			$facility_list = array('list_name' => $facility);
			$this->product_model->edit_product($facility_list,$condition);	
			redirect('admin/rentals/AddaddressForm/'.$id);
			//$this->load->view('site/product/photos_listing');
		}
			
		public function AddaddressForm()
		{
			$this->data['heading'] = 'Edit Rental';
			$product_id = $this->uri->segment(4,0);
			$this->data['product_details'] = $this->product_model->view_product1($product_id);
			
			$this->data['RentalCountry'] = $this->product_model->get_all_details(COUNTRY_LIST,array('status'=>'Active'));
				$this->data['RentalState'] = $this->product_model->get_all_details(STATE_TAX,array('status'=>'Active'));
				$this->data['RentalCity'] =  $this->product_model->get_all_details(CITY,array('status'=>'Active'));
				
				$this->data['listNameCnt'] = $this->product_model->get_all_details(ATTRIBUTE,array('status'=>'Active'));
				$this->data['listValueCnt'] = $this->product_model->get_all_details(LIST_VALUES,array('status'=>'Active'));
				$list_valueArr=explode(',',$this->data['product_details']->row()->list_value);
				$listIdArr=array();
			redirect('admin/rentals/AddaddressForm/'.$id);
			//$this->load->view('site/product/photos_listing');
		}	
		/**
	 * 
	 * This function loads the add new product form
	 */
	public function add_rental_general_info_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Rental';
			$product_id=$this->data['Product_id'] = $this->uri->segment(4,0);
			$this->data['userdetails'] =  $this->product_model->get_selected_fields_records('id,firstname,lastname',USERS,'where status="Active"');
		 	$id=$this->uri->segment(4,0);
			if($id!='') {
				$this->data['product_details'] = $this->product_model->view_product1($id);
				
			}
			$this->load->view('admin/rentals/add_product',$this->data);
		
		}
	}
	
	public function add_rental_photo(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Rental';
		 	$id=$this->uri->segment(4,0);
			if($id!='') {
				$this->data['product_details'] = $this->product_model->view_product1($id);
				if ($this->data['product_details']->num_rows() == 1){
					$this->data['imgDetail'] = $this->product_model->get_images($id);
				}
			}
			$this->load->view('admin/rentals/add_rentals_photo',$this->data);
		}
	}
}

/* End of file product.php */
/* Location: ./application/controllers/admin/product.php */