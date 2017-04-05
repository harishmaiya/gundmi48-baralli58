<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Shop related functions
 * @author dev Beetrut
 * 
 */

class Wishlists extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('product_model','shop');
		$this->load->model('city_model');
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->shop->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];
		
		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->shop->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];
		
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
			$this->data['WishlistUserDetails'] = $this->shop->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
	 	}
    }
	
    
	public function index(){
		if ($this->checkLogin ( 'U' ) != '') {
			$this->data['heading'] = 'Wish Lists';
			$this->data['WishListCat'] = $this->product_model->get_list_details_wishlist($this->data['loginCheck']);
			//echo '<pre>'; print_r($this->data['WishListCat']->result()); die;
			$this->load->view('site/user/wishlist-home',$this->data);
		} else {
			redirect('');
		}
    }
	
	/**
	 * 
	 * This function delete the wishlist record from db
	 */
	public function DeleteWishList(){
		if ($this->checkLogin('U') == ''){
			redirect(base_url());
		} else {
			$product_id = $this->input->post('pid');
			$id = $this->input->post('wid');
			$condition = array('id' => $id);
			$this->data['WishListCat'] = $this->product_model->get_all_details(LISTS_DETAILS,$condition);
			if($this->data['WishListCat']->row()->product_id !=''){
				$WishListCatArr = @explode(',',$this->data['WishListCat']->row()->product_id);
				$my_array = array_filter($WishListCatArr);
				$to_remove =(array)$product_id;
				$result = array_diff($my_array, $to_remove);
				$resultStr =implode(',',$result);
				if($resultStr!='')				{		
					$this->product_model->updateWishlistRentals(array('product_id' =>$resultStr),$condition);
					$res['result']='0';
				}else {
					$this->product_model->updateWishlistRentals(array('product_id' =>$resultStr),$condition);
					$res['result']='1';
				}
			}
		}
		echo json_encode($res);
	}
}
/*End of file cms.php */
/* Location: ./application/controllers/site/product.php */