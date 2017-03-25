<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to cms management 
 * @author Teamtweaks
 *
 */

class Cms extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('cms_model');
		if ($this->checkPrivileges('Pages',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the cms list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/cms/display_cms');
		}
	}
	
	/**
	 * 
	 * This function loads the cms list page
	 */
	public function display_cms(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Manage Static Pages';
			$condition = array('lang_code'=>'en');
			$this->data['cmsList'] = $this->cms_model->get_all_details(CMS,$condition);
			$this->load->view('admin/cms/display_cms',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new cms form
	 */
	public function add_cms_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Main Page';
			$this->load->view('admin/cms/add_cms',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new subpage form
	 */
	public function add_subpage_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Sub Page';
			$condition = array('category' => 'Main');
			$this->data['cms_details'] = $this->cms_model->get_all_details(CMS,$condition);
			if ($this->data['cms_details']->num_rows() > 0){
				$this->load->view('admin/cms/add_sub_page',$this->data);
			}else {
				$this->setErrorMessage('error','You must add a main page first');
				redirect('admin/cms/display_cms');
			}
		}
	}
	
	public function add_lang_page(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Language Page';
			$this->data['cms_details'] = $this->cms_model->get_all_details(CMS,array('lang_code'=>'en'));
			$this->data['lang_details'] = $this->cms_model->get_all_details(LANGUAGES,array('status'=>'Active'));
			$this->load->view('admin/cms/add_lang_page',$this->data);
			}
		}
	
	/**
	 * 
	 * This function insert and edit a cms page
	 */
	public function insertEditCms(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$cms_id = $this->input->post('cms_id');
			$parent_id = $this->input->post('parent');
			$page_name = $this->input->post('page_name');
			$subpage = $this->input->post('subpage');
			if ($subpage == 'subpage'){
				if ($parent_id == ''){
					$this->setErrorMessage('error','Select a main page');
					echo "<script>window.history.go(-1)</script>";exit();
				}
			}
			if ($page_name == ''){
				$this->setErrorMessage('error','Page name required');
				echo "<script>window.history.go(-1)</script>";exit();
			}
			$parent = '0';
			$category = 'Main';
			if ($parent_id != ''){
				$parent = $parent_id;
				$category = 'Sub';
			}
			if ($cms_id == ''){
				$condition = array('page_name' => $page_name);
			}else {
				$condition = array('page_name' => $page_name,'id !=' => $cms_id);
			}
			$duplicate_name = $this->cms_model->get_all_details(CMS,$condition);
			if ($duplicate_name->num_rows() > 0){
				$this->setErrorMessage('error','Page name already exists');
				redirect('admin/cms/display_cms');
			}
			$excludeArr = array("cms_id","hidden_page","subpage");
			$datestring = "%Y-%m-%d";
			$time = time();
			if ($cms_id == ''){
				$hidden_page = $this->input->post('hidden_page');
				if ($hidden_page == 'on'){
					$hidden_page = 'Yes';
				}else {
					$hidden_page = 'No';
				}
				$seourl = url_title($page_name, '-', TRUE);
				$dataArr = array(
					'status' => 'Publish',
					'seourl' => $seourl,
					'hidden_page' => $hidden_page,
					'parent' => $parent,
					'lang_code' => 'en',
					'category' => $category
				);
			}else {
				$dataArr = array('parent' => $parent);
			}
			$condition = array('id' => $cms_id);
			if ($cms_id == ''){
				$this->cms_model->commonInsertUpdate(CMS,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Page added successfully');
				if ($seourl == ''){
					$cms_id = $this->cms_model->get_last_insert_id();
					$seourl = $cms_id.'/'.str_replace(' ','',$page_name);
					$this->cms_model->update_details(CMS,array('seourl'=>$seourl),array('id'=>$cms_id));
				}
			}else {
				$this->cms_model->commonInsertUpdate(CMS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Page updated successfully');
			}
			redirect('admin/cms/display_cms');
		}
	}
	
	
	public function insert_lang_Cms(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
		//echo '<pre>';print_r($_POST);
			$cms_id = $this->input->post('cms_id');
			
			$parent_id = $this->input->post('parent');
			$page_name = $this->input->post('page_name');
			$id = $this->input->post('seourl');
			$seourl_name = $this->cms_model->get_all_details(CMS,array('id'=>$id));
			$url_name=$seourl_name->row()->seourl;
			
			if ($page_name == ''){
				$this->setErrorMessage('error','Main Page name required');
				echo "<script>window.history.go(-1)</script>";exit();
			}
			$parent = '0';
			$category = 'Main';
			if ($parent_id != ''){
				$parent = $parent_id;
				$category = 'Sub';
			}
			if ($cms_id == ''){
				$condition = array('page_name' => $page_name);
			}else {
				$condition = array('page_name' => $page_name,'id !=' => $cms_id);
			}
			$duplicate_name = $this->cms_model->get_all_details(CMS,$condition);
			if ($duplicate_name->num_rows() > 0){
				$this->setErrorMessage('error','Page name already exists');
				redirect('admin/cms/display_cms');
			}
			$excludeArr = array("cms_id","hidden_page","subpage");
			$datestring = "%Y-%m-%d";
			$time = time();
			if ($cms_id == ''){
				$hidden_page = $this->input->post('hidden_page');
				if ($hidden_page == 'on'){
					$hidden_page = 'Yes';
				}else {
					$hidden_page = 'No';
				}
				$seourl = url_title($url_name, '-', TRUE);
				$dataArr = array(
					'status' => 'Publish',
					'seourl' => $url_name,
					'hidden_page' => $hidden_page,
					'parent' => $parent,
					'lang_code' => $this->input->post('lang_code'),
					'toId' =>$id,
					'category' => $category
				);
				//echo '<pre>';print_r($dataArr);die;
			}else {
				$dataArr = array('parent' => $parent);
			}
			$condition = array('id' => $cms_id);
			if ($cms_id == ''){
				$this->cms_model->commonInsertUpdate(CMS,'insert',$excludeArr,$dataArr,$condition);
				
				$this->setErrorMessage('success','Page added successfully');
				if ($url_name == ''){
					$cms_id = $this->cms_model->get_last_insert_id();
					$seourl = $cms_id.'/'.str_replace(' ','',$page_name);
					$this->cms_model->update_details(CMS,array('seourl'=>$url_name),array('id'=>$cms_id));
				}
			}else {
				$this->cms_model->commonInsertUpdate(CMS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Page updated successfully');
			}
			redirect('admin/cms/display_cms');
		}
	}
	
	public function insert_lang_Cms_old(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$cms_id = $this->input->post('cms_id');
			$parent_id = $this->input->post('parent');
			$page_name = $this->input->post('page_name');
			$seourl = $this->input->post('seourl');
			
			if ($page_name == ''){
				$this->setErrorMessage('error','Main Page name required');
				echo "<script>window.history.go(-1)</script>";exit();
			}
			$parent = '0';
			$category = 'Main';
			if ($parent_id != ''){
				$parent = $parent_id;
				$category = 'Sub';
			}
			if ($cms_id == ''){
				$condition = array('page_name' => $page_name);
			}else {
				$condition = array('page_name' => $page_name,'id !=' => $cms_id);
			}
			$duplicate_name = $this->cms_model->get_all_details(CMS,$condition);
			if ($duplicate_name->num_rows() > 0){
				$this->setErrorMessage('error','Page name already exists');
				redirect('admin/cms/display_cms');
			}
			$excludeArr = array("cms_id","hidden_page","subpage");
			$datestring = "%Y-%m-%d";
			$time = time();
			if ($cms_id == ''){
				$hidden_page = $this->input->post('hidden_page');
				if ($hidden_page == 'on'){
					$hidden_page = 'Yes';
				}else {
					$hidden_page = 'No';
				}
				$seourl = url_title($seourl, '-', TRUE);
				$dataArr = array(
					'status' => 'Publish',
					'seourl' => $seourl,
					'hidden_page' => $hidden_page,
					'parent' => $parent,
					'lang_code' => $this->input->post('lang_code'),
					'category' => $category
				);
			}else {
				$dataArr = array('parent' => $parent);
			}
			$condition = array('id' => $cms_id);
			if ($cms_id == ''){
				$this->cms_model->commonInsertUpdate(CMS,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Page added successfully');
				if ($seourl == ''){
					$cms_id = $this->cms_model->get_last_insert_id();
					$seourl = $cms_id.'/'.str_replace(' ','',$page_name);
					$this->cms_model->update_details(CMS,array('seourl'=>$seourl),array('id'=>$cms_id));
				}
			}else {
				$this->cms_model->commonInsertUpdate(CMS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Page updated successfully');
			}
			redirect('admin/cms/display_cms');
		}
	}
	
	/**
	 * 
	 * This function loads the edit cms form
	 */
	public function edit_cms_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Page';
			$cms_id = $this->uri->segment(4,0);
			$condition = array('id' => $cms_id);
			$this->data['cms_details'] = $this->cms_model->get_all_details(CMS,$condition);
			if ($this->data['cms_details']->num_rows() == 1){
				$condition = array('category' => 'Main');
				$this->data['cms_main_details'] = $this->cms_model->get_all_details(CMS,$condition);
				$this->load->view('admin/cms/edit_cms',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function change the cms page status
	 */
	public function change_cms_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$cms_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Unpublish':'Publish';
			$newdata = array('status' => $status);
			$condition = array('id' => $cms_id);
			$this->cms_model->update_details(CMS,$newdata,$condition);
			$this->setErrorMessage('success','Page Status Changed Successfully');
			redirect('admin/cms/display_cms');
		}
	}
	
	/**
	 * 
	 * This function change the cms page display mode
	 */
	public function change_cms_mode(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$cms_id = $this->uri->segment(5,0);
			$newdata = array('hidden_page' => $mode);
			$condition = array('id' => $cms_id);
			$this->cms_model->update_details(CMS,$newdata,$condition);
			$this->setErrorMessage('success','Page Hidden Mode Changed Successfully');
			redirect('admin/cms/display_cms');
		}
	}
	
	/**
	 * 
	 * This function delete the cms page from db
	 */
	public function delete_cms(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$cms_id = $this->uri->segment(4,0);
			$condition = array('id' => $cms_id);
			$this->cms_model->commonDelete(CMS,$condition);
			$this->setErrorMessage('success','Page deleted successfully');
			redirect('admin/cms/display_cms');
		}
	}
	
	/**
	 * 
	 * This function change the cms pages status
	 */
	public function change_cms_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->cms_model->activeInactiveCommon(CMS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Pages deleted successfully');
			}else {
				$this->setErrorMessage('success','Pages status changed successfully');
			}
			redirect('admin/cms/display_cms');
		}
	}
	public function main_page(){
		if ($this->checkLogin('A') == ''){
				redirect('admin');
			}else {
				$id = $this->input->post('seourl');
				
					$condition= array('status'=>'Active');
					$lang_detail 	= $this->cms_model->get_all_details(LANGUAGES, $condition);
					$select .= '<select name="lang_code">';
					$select .= '<option>Choose Language</option>';
					foreach($lang_detail->result() as $lang){
						$condition= array('toId'=>$id, 'lang_code'=>$lang->lang_code);
						$checkNum= $this->cms_model->get_all_details(CMS, $condition);
						if($checkNum->num_rows() == 0){
							$select				   .= '<option value="'.$lang->lang_code.'">'.$lang->name.'</option>';
						}
					}
					$select .= '</select>';
					echo $select;
				
					
			}
	}
	
	public function main_page1(){
		$seourl = $this->input->post('seourl');
		$this->data['lang_detail'] = $this->cms_model->get_all_details(LANGUAGES,array('status'=>'Active'));
		$this->data['cms_detail'] = $this->cms_model->get_all_details(CMS,array('seourl'=>$seourl,'lang_code'=>'en'));
		$select .= '<select name="lang_code">';
		$select .= '<option >Please Choose Language</option>';
		foreach($this->data['lang_detail']->result() as $lang) {
			foreach($this->data['cms_detail']->result() as $cms ) {
				if($cms->lang_code != $lang->lang_code){
					$select .='<option value="'.$lang->lang_code.'">'.$lang->name.'</option>'; 
				}
			}
		
		}
		$select .= '</select>';
		echo $select;
	}
	public function display_other_lang(){
		$seourl = $this->uri->segment(4);
		$this->data['lang_detail'] = $this->cms_model->get_all_details(CMS,array('seourl'=>$seourl));
		
		$this->load->view('admin/cms/display_lang_page',$this->data);
	}
}

/* End of file cms.php */
/* Location: ./application/controllers/admin/cms.php */