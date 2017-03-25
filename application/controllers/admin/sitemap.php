<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to sitemap management 
 * @author Teamtweaks
 *
 */

class Sitemap extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('cms_model');
    }
    
    /**
     * 
     * This function loads the cms list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}
	}
	
	/**
	 * 
	 * This function loads the cms list page
	 */
	public function create_sitemap(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Sitemap Creation';
			$this->load->view('admin/sitemap/add_sitemap',$this->data);
		}
	}
	
	
	public function insertsitemap(){
		
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {

			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = TRUE;
			$config['allowed_types'] = 'xml';
			$config['max_size'] = 1000000;
			$config['upload_path'] = './';
			$this->load->library('upload', $config);
			//echo '<pre>'; print_r($_FILES);die;
			if (move_uploaded_file($_FILES['sitemap_file']['tmp_name'],'./'.$_FILES['sitemap_file']['name'])){
				//$logoDetails = $this->upload->data();
			}else{
				$logoDetails = $this->upload->display_errors();
				$this->setErrorMessage('error',strip_tags($logoDetails));
				redirect('admin/sitemap/create_sitemap');
			}
			
			$this->setErrorMessage('success','Sitemap Uploaded Successfully');
			redirect('admin/sitemap/create_sitemap');
		}
			
		}
	
}

/* End of file sitemap.php */
/* Location: ./application/controllers/admin/sitemap.php */