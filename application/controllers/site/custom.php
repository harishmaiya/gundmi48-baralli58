<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Shop related functions
 * @author Teamtweaks
 * 
 */

class Custom extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('cms_model');
    }
   
	public function get_pro_type()
	{
		$resArr = $this->cms_model->get_all_details(PRODUCT, array());
		foreach($resArr->result() as $res)
		{
			echo '</br>|'.$res->home_type.'|';
			$home_type = trim($res->home_type);
			echo '</br>|'.$home_type.'|';
			$newdata = array('home_type' => $home_type);
			$condition = array('id' => $res->id);
			$this->cms_model->update_details(PRODUCT,$newdata,$condition);
		}
	}
	
}
/*End of file custom.php */
/* Location: ./application/controllers/site/custom.php */