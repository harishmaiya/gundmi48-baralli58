<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to Attribute management 
 * Attribute mentioned as 'List'
 * @author dev Beetrut
 *
 */ 

class Download extends MY_Controller {
 
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('attribute_model');
		if ($this->checkPrivileges('attribute',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the attribute list page
     */
   	public function index(){	
		
	}
	
	public function display_download(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Download Details';
			$this->load->view('admin/download/download_file',$this->data);
		}
	}
	
}

/* End of file attribute.php */
/* Location: ./application/controllers/admin/attribute.php */