<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**  
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Prefooter extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('prefooter_model');
		if ($this->checkPrivileges('Prefooter',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the users list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/prefooter/display_prefooter_list');
		}
	}
	
	/**
	 * 
	 * This function loads the users list page
	 */
	public function display_prefooter_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'prefooter List';
			$condition = array();
			$this->data['prefooterList'] = $this->prefooter_model->get_all_details(PREFOOTER,$condition);
			$this->load->view('admin/prefooter/display_prefooter',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the users dashboard
	 */
	public function display_user_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'prefooters Dashboard';
			$condition = 'order by `created` desc';
			$this->data['usersList'] = $this->prefooter_model->get_prefooter_details($condition);
			$this->load->view('admin/prefooter/display_prefooter_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new user form
	 */
	public function add_prefooter_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New prefooter';
			$this->load->view('admin/prefooter/add_prefooter',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditprefooter(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
		//prin_r($_POST);die
			$prefooter_id = $this->input->post('prefooter_id');
			$footer_title = $this->input->post('footer_title');
			
			if ($prefooter_id == ''){
				$condition = array('footer_title' => $footer_title);
				$duplicate_name = $this->prefooter_model->get_all_details(PREFOOTER,$condition);
				if ($duplicate_name->num_rows() > 3){
					$this->setErrorMessage('error','Footer title already exists');
					redirect('admin/prefooter/add_prefooter_form');
				}
			}
			$excludeArr = array("prefooter_id","image","status");
			$short_description="";
			//echo $this->input->post('short_desc_count');die;
			for($i=1;$i<=$this->input->post('short_desc_count');$i++)
			{
			array_push($excludeArr,'short_desc_count'.$i);
			
			$short_description .= $this->input->post('short_desc_count'.$i).'//';
			}
			//print_r(substr($excludeArr);die;
			//$inputArr['short_description']=substr($short_description,0,-2);
			if ($this->input->post('status') != ''){
				$prefooter_status = 'Active';
			}else {
				$prefooter_status = 'Inactive';
			}
			$inputArr = array('status' => $prefooter_status,'short_description'=>substr($short_description,0,-2));
			
			$datestring = "%Y-%m-%d";
			$time = time();
			//$config['encrypt_name'] = TRUE;
			 if(!is_dir($logoDirectory))
                       {
                               mkdir($logoDirectory,0777);
                       }
			$config['overwrite'] = FALSE;
	    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
		    $config['max_size'] = 2000;
		    $config['upload_path'] = './images/prefooter';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('image');
			$imgDetails = $this->upload->data();
			if($imgDetails['file_name']!=''){
		    	
				@copy('./images/prefooter/'.$imgDetails['file_name'],'./images/prefooter/thumb/'.$imgDetails['file_name']);
                       
					   if (!$this->imageResizeWithSpace(1600, 700, $imgDetails['file_name'], './images/prefooter/thumb/'))
                       {
                       
                               $error = array('error' => $this->upload->display_errors());
                       }
                       else
                       {
                               $prefooterUploadedData = array($this->upload->data());
                               
                               
                       }
				
				
				$inputArr['image'] = $imgDetails['file_name'];
			}
			//print_r($inputArr);die;
			$condition = array('id' => $prefooter_id);
			if ($prefooter_id == ''){
				$this->prefooter_model->commonInsertUpdate(PREFOOTER,'insert',$excludeArr,$inputArr,$condition);
				$this->setErrorMessage('success','prefooter added successfully');
			}else {
			
			
				$this->prefooter_model->commonInsertUpdate(PREFOOTER,'update',$excludeArr,$inputArr,$condition);
				$this->setErrorMessage('success','prefooter updated successfully');
			}
			redirect('admin/prefooter/display_prefooter_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_prefooter_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit prefooter';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['prefooter_details'] = $this->prefooter_model->get_all_details(PREFOOTER,$condition);
			if ($this->data['prefooter_details']->num_rows() == 1){
				$this->load->view('admin/prefooter/edit_prefooter',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 */
	public function change_prefooter_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->prefooter_model->update_details(PREFOOTER,$newdata,$condition);
			$this->setErrorMessage('success','prefooter Status Changed Successfully');
			redirect('admin/prefooter/display_prefooter_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_prefooter(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View prefooter';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['prefooter_details'] = $this->prefooter_model->get_all_details(PREFOOTER,$condition);
			if ($this->data['prefooter_details']->num_rows() == 1){
				$this->load->view('admin/prefooter/view_prefooter',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_prefooter(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->prefooter_model->commonDelete(PREFOOTER,$condition);
			$this->setErrorMessage('success','prefooter deleted successfully');
			redirect('admin/prefooter/display_prefooter_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_prefooter_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->prefooter_model->activeInactiveCommon(PREFOOTER,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','prefooter deleted successfully');
			}else {
				$this->setErrorMessage('success','prefooter status changed successfully');
			}
			redirect('admin/prefooter/display_prefooter_list');
		}
	}
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */