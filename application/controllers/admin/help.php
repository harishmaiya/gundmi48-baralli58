<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to couponcards management 
 * @author dev Beetrut
 *
 */

class Help extends MY_Controller
{
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('help_model','currency_model','location_model'));
		if ($this->checkPrivileges('Language',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }

    public function index()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            redirect('admin/help/display_help_list');
        }
    }
    public function display_help_list()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $this->data['heading']  = 'Help List';
            $condition              = array();
            $this->data['helpList'] = $this->help_model->get_all_details('fc_help_page', $condition);
            $this->load->view('admin/help/display_help_list', $this->data);
        }
    }
    
    public function display_sub_menu()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $this->data['heading']  = 'Sub Menu';
            $condition = array('fc_help_sub.lang'=>'en');
            $this->data['helpList'] = $this->help_model->get_all_submenu('fc_help_sub', $condition);
            $this->load->view('admin/help/display_sub_menu', $this->data);
        }
    }
    
	
	public function question_and_ans()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $this->data['heading']  = 'Question & Answer';
            $condition = array('fc_help_question.lang'=>'en');
            $this->data['helpList'] = $this->help_model->getallquestion('HELP_QUESTION', $condition);
            $this->load->view('admin/help/question_answer', $this->data);
        }
    }
	public function display_main_menu(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Main Menu';
			$condition = array('lang'=>'en');
			$this->data['mainmenu'] = $this->help_model->get_all_main(fc_help_main,$condition);
			$this->load->view('admin/help/display_main_menu',$this->data);
		}
	}
	
	public function display_other_main(){
		$id = $this->uri->segment(4);
		$this->data['lang_detail'] = $this->help_model->get_all_details(HELP_MAIN,array('toId'=>$id));
		$this->load->view('admin/help/display_other_main',$this->data);
	}
	
	public function display_other_question(){
		$id = $this->uri->segment(4);
		$this->data['heading']  = 'Question & Answer';
		$condition = array('fc_help_question.lang <>'=>'en', 'fc_help_question.toId'=>$id);
		$this->data['helpList'] = $this->help_model->getallquestion('HELP_QUESTION', $condition);
		$this->load->view('admin/help/display_other_question',$this->data);
	}
	
	public function display_other_sub(){
		$id = $this->uri->segment(4);
		$this->data['lang_detail'] = $this->help_model->get_all_details(HELP_SUB,array('toId'=>$id));
		$this->load->view('admin/help/display_other_sub',$this->data);
	}
	
	public function change_other_main_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$cms_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $cms_id);
			$this->help_model->update_details(HELP_MAIN,$newdata,$condition);
			$toIdQuery = $this->help_model->get_all_details(HELP_MAIN,$condition);
			$this->setErrorMessage('success','Status Changed Successfully');
			redirect('admin/help/display_other_main/'.$toIdQuery->row()->toId);
		}
	}
	
	public function change_other_sub_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$cms_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $cms_id);
			$this->help_model->update_details(HELP_SUB,$newdata,$condition);
			$toIdQuery = $this->help_model->get_all_details(HELP_SUB,$condition);
			$this->setErrorMessage('success','Status Changed Successfully');
			redirect('admin/help/display_other_sub/'.$toIdQuery->row()->toId);
		}
	}
	
    public function change_help_list_status()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $mode         = $this->uri->segment(4, 0);
            $attribute_id = $this->uri->segment(5, 0);
            $status       = ($mode == '0') ? '0' : '1';
            $newdata      = array(
                'status' => $status
            );
            $condition    = array(
                'id' => $attribute_id
            );
            $this->help_model->update_details('fc_help_page', $newdata, $condition);
            $this->setErrorMessage('success', 'List Status Changed Successfully');
            redirect('admin/help/display_help_list');
        }
    }
    
	public function change_question_menu_status()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $mode         = $this->uri->segment(4, 0);
            $attribute_id = $this->uri->segment(5, 0);
            $status       = ($mode == '0') ? '0' : '1';
            $newdata      = array(
                'status' => $status
            );
            $condition    = array(
                'id' => $attribute_id
            );
            $this->help_model->update_details('fc_help_question', $newdata, $condition);
            $this->setErrorMessage('success', 'List Status Changed Successfully');
            redirect('admin/help/question_and_ans');
        }
    }
	
    public function change_sub_menu_status()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $mode         = $this->uri->segment(4, 0);
            $attribute_id = $this->uri->segment(5, 0);
            $status       = ($mode == '0') ? '0' : '1';
            $newdata      = array(
                'status' => $status
            );
            $condition    = array(
                'id' => $attribute_id
            );
            $this->help_model->update_details('fc_help_sub', $newdata, $condition);
            $this->setErrorMessage('success', 'List Status Changed Successfully');
            redirect('admin/help/display_sub_menu');
        }
    }
    public function change_main_menu_status()
	{
	
	if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $mode         = $this->uri->segment(4, 0);
            $attribute_id = $this->uri->segment(5, 0);
            $status       = ($mode == '0') ? '0' : '1';
            $newdata      = array(
                'status' => $status
            );
            $condition    = array(
                'id' => $attribute_id
            );
            $this->help_model->update_details('fc_help_main', $newdata, $condition);
            $this->setErrorMessage('success', 'List Status Changed Successfully');
            redirect('admin/help/display_main_menu');
        }
	
	}
    public function change_status_sub_menu(){
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
           
            $mode         = $this->uri->segment(4, 0);
            $attribute_id = $this->uri->segment(5, 0);
            $status       = ($mode == '0') ? '0' : '1';
            $newdata      = array(
                'status' => $status
            );
            $condition    = array(
                'id' => $attribute_id
            );
            $this->help_model->update_details('fc_help_sub_menu', $newdata, $condition);
            $this->setErrorMessage('success', 'List Status Changed Successfully');
            redirect('admin/help/display_sub_menu');
        }
    }
    
	
    public function add_help_page()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $sortArr1              = array(
                'field' => 'name',
                'type' => 'asc'
            );
            $condition             = array(
                'status' => 'Active'
            );
            //$this->data['countryList'] = $this->currency_model->get_all_details(COUNTRY_LIST,$condition,array($sortArr1));
            $this->data['heading'] = 'Add New Help page';
            $this->load->view('admin/help/add_help_page', $this->data);
        }
    }
    
    public function add_lang_help()
	{
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Help Multi-Language';
			$this->data['cms_details'] = $this->help_model->get_all_details(HELP_MAIN,array('lang'=>'en'));
			$this->data['lang_details'] = $this->help_model->get_all_details(LANGUAGES,array('status'=>'Active'));
			$this->load->view('admin/help/add_lang_help',$this->data);
		}
	}
	
	public function add_lang_sub()
	{
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Help Multi-Language';
			$this->data['cms_details'] = $this->help_model->get_all_details(HELP_SUB,array('lang'=>'en'));
			$this->data['lang_details'] = $this->help_model->get_all_details(LANGUAGES,array('status'=>'Active'));
			$this->load->view('admin/help/add_lang_sub',$this->data);
		}
	}
	
	public function add_lang_questionans()
	{
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Help Multi-Language';
			$this->data['cms_details'] = $this->help_model->get_all_details(HELP_QUESTION,array('lang'=>'en'));
			$this->data['lang_details'] = $this->help_model->get_all_details(LANGUAGES,array('status'=>'Active'));
			$this->load->view('admin/help/add_lang_questionans',$this->data);
		}
	}
	
	public function main_help(){
		$seourl = $this->input->post('id');
		$this->data['lang_detail'] = $this->help_model->get_all_details(LANGUAGES,array('status'=>'Active'));
		$select .= '<select name="lang_code">';
		$select .= '<option >Please Choose Language</option>';
		foreach($this->data['lang_detail']->result() as $lang) {
			$checkNum = $this->help_model->get_all_details(HELP_MAIN,array('toId'=>$seourl,'lang'=>$lang->lang_code));
			if($checkNum->num_rows() == 0){
				$select .='<option value="'.$lang->lang_code.'">'.$lang->name.'</option>'; 
			}
		}
		$select .= '</select>';
		echo $select;
	}
	
	public function sub_help(){
		$seourl = $this->input->post('id');
		$this->data['lang_detail'] = $this->help_model->get_all_details(LANGUAGES,array('status'=>'Active'));
		$select .= '<select name="lang_code">';
		$select .= '<option >Please Choose Language</option>';
		foreach($this->data['lang_detail']->result() as $lang) {
			$checkNum = $this->help_model->get_all_details(HELP_SUB,array('toId'=>$seourl,'lang'=>$lang->lang_code));
			if($checkNum->num_rows() == 0){
				$select .='<option value="'.$lang->lang_code.'">'.$lang->name.'</option>'; 
			}
		}
		$select .= '</select>';
		echo $select;
	}
	
	public function question_help(){
		$seourl = $this->input->post('id');
		$this->data['lang_detail'] = $this->help_model->get_all_details(LANGUAGES,array('status'=>'Active'));
		$select .= '<select name="lang_code">';
		$select .= '<option >Please Choose Language</option>';
		foreach($this->data['lang_detail']->result() as $lang) {
			$checkNum = $this->help_model->get_all_details(HELP_QUESTION,array('toId'=>$seourl,'lang'=>$lang->lang_code));
			//echo $this->db->last_query();die;
			if($checkNum->num_rows() == 0){
				$select .='<option value="'.$lang->lang_code.'">'.$lang->name.'</option>'; 
			}
		}
		$select .= '</select>';
		echo $select;
	}
	
    public function insert_main_lang()
	{
		if ($this->checkLogin('A') == '') {
		redirect('admin');
		} else {
		//echo '<pre>';print_r($_POST);die;
		$type = $this->input->post('type');
		$name = $this->input->post('help_name');
		$help_id = $this->input->post('help_id');
		$lang = $this->input->post('lang_code');
		$toId = $this->input->post('seourl');


		if ($this->input->post('status') != '') {
		$location_status = 'Active';
		} else {
		$location_status = 'Inactive';
		}
		
		$getSeo = $this->help_model->get_all_details(HELP_MAIN, array('id'=>$toId));
		$seo = $getSeo->row()->seo;

		$inputArr = array(
		'type' => $type,
		'name' => $name,
		'status' => $location_status,
		'lang' => $lang,
		'toId' => $toId,
		'seo' => $seo
		);

		

		if ($this->input->post('help_name') == "") {
		$this->setErrorMessage('error', 'This Help name required');
		redirect('admin/help/add_lang_help');
		} else {
		if($help_id != '')
		{
			$condition = array('id' => $help_id);
			$this->help_model->update_details(HELP_MAIN, $inputArr, $condition);
		}
		else 
		{
			$this->help_model->simple_insert(HELP_MAIN, $inputArr);
		}
		$this->setErrorMessage('success', 'Added');
		redirect('admin/help/display_main_menu');
		}
		}
	}

	public function insert_sub_lang()
	{
		if ($this->checkLogin('A') == '') {
		redirect('admin');
		} else {
		//echo '<pre>';print_r($_POST);die;
		$type = $this->input->post('type');
		$name = $this->input->post('help_name');
		$help_id = $this->input->post('help_id');
		$lang = $this->input->post('lang_code');
		$toId = $this->input->post('seourl');
		$mainCheck = $this->help_model->get_all_details(HELP_SUB, array('id'=>$toId));
		$main = $mainCheck->row()->main;
		if ($this->input->post('status') != '') {
		$location_status = 'Active';
		} else {
		$location_status = 'Inactive';
		}
		$getSeo = $this->help_model->get_all_details(HELP_SUB, array('id'=>$toId));
		$seo = $getSeo->row()->seo;


		$inputArr = array(
		'main' => $main,
		'type' => $type,
		'name' => $name,
		'status' => $location_status,
		'lang' => $lang,
		'toId' => $toId,
		'seo' => $seo
		);

		

		if ($this->input->post('help_name') == "") {
		$this->setErrorMessage('error', 'This Help name required');
		redirect('admin/help/add_lang_help');
		} else {
		if($help_id != '')
		{
			$condition = array('id' => $help_id);
			$this->help_model->update_details(HELP_SUB, $inputArr, $condition);
		}
		else 
		{
			$this->help_model->simple_insert(HELP_SUB, $inputArr);
		}
		$this->setErrorMessage('success', 'Added');
		redirect('admin/help/display_sub_menu');
		}
		}
	}
	
	public function insert_que_lang()
	{
		if ($this->checkLogin('A') == '') {
		redirect('admin');
		} else {
		//echo '<pre>';print_r($_POST);die;
		$name = $this->input->post('help_name');
		$help_id = $this->input->post('help_id');
		$lang = $this->input->post('lang_code');
		$question = $this->input->post('question');
		$answer = $this->input->post('answer');
		$toId = $this->input->post('seourl');
		$mainCheck = $this->help_model->get_all_details(HELP_QUESTION, array('id'=>$toId));
		$main = $mainCheck->row()->main;
		$sub = $mainCheck->row()->sub;
		if ($this->input->post('status') != '') {
		$location_status = 'Active';
		} else {
		$location_status = 'Inactive';
		}
		$getSeo = $this->help_model->get_all_details(HELP_QUESTION, array('id'=>$toId));
		$seo = $getSeo->row()->seo;


		$inputArr = array(
		'main' => $main,
		'sub' => $sub,
		'question' => $question,
		'answer' => $answer,
		'status' => $location_status,
		'lang' => $lang,
		'toId' => $toId,
		'seo' => $seo
		);

		//echo '<pre>';print_r($inputArr);die;

		if ($this->input->post('question') == "") {
		$this->setErrorMessage('error', 'This Help name required');
		redirect('admin/help/add_lang_help');
		} else {
		if($help_id != '')
		{
			$condition = array('id' => $help_id);
			$this->help_model->update_details(HELP_QUESTION, $inputArr, $condition);
		}
		else 
		{
			$this->help_model->simple_insert(HELP_QUESTION, $inputArr);
		}
		$this->setErrorMessage('success', 'Added');
		redirect('admin/help/question_and_ans');
		}
		}
	}
	
	public function add_sub_menu()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $condition = array(
                'status' => 'Active',
				'lang' => 'en'
            );
            $this->data['heading']  = 'Add Sub page';
            $this->data['helpList'] = $this->help_model->get_all_details(HELP_MAIN, $condition);
			$this->load->view('admin/help/add_sub_menu', $this->data);
        }
    }
	public function ajaxsubmenu()
	{
	
	$this->data['ajaxsub']=$this->help_model->submenuhelp();
	
	$str='';
	
	$returnStr['states_list'] = $this->load->view('admin/help/subemenudropdown',$this->data,true);
	
	echo json_encode($returnStr);
	}
	public function add_questionans_menu()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $condition = array(
                'status' => 'Active',
				'lang' => 'en'
            );
            
			$this->data['heading']  = 'Add Question Answer';
            $this->data['helpList'] = $this->help_model->get_all_details(HELP_MAIN, $condition);
			$this->load->view('admin/help/add_quest_ans', $this->data);
        }
    }
	
    public function inserthelppage()
    {
        
		if ($this->checkLogin('A') == '') {
		redirect('admin');
		} else {
		
		$type = $this->input->post('type');
		$name = $this->input->post('help_name');
		$help_id = $this->input->post('help_id');


		if ($this->input->post('status') != '') {
		$location_status = 'Active';
		} else {
		$location_status = 'Inactive';
		}


		$inputArr = array(
		'type' => $type,
		'name' => $name,
		'status' => $location_status
		);

		

		if ($this->input->post('help_name') == "") {
		$this->setErrorMessage('error', 'This Help name required');
		redirect('admin/help/add_help_page');
		} else {
		if($help_id != '')
		{
			$condition = array('id' => $help_id);
			$this->help_model->update_details(HELP_MAIN, $inputArr, $condition);
		}
		else 
		{
			$seo = strtolower($name);
			$seo = mysql_real_escape_string($seo);
			$seo = trim($seo);
			$seo = str_replace("'","",$seo);
			$seo = str_replace("&","",$seo);
			$seo = str_replace("'","",$seo);
			$seo = @ereg_replace("[^A-Za-z0-9]", " ", $seo);
			$seo = preg_replace( "/\s+/", " ", $seo);
			$seo = str_replace(" ","-", $seo);
			$inputArr['seo']=$seo;
			$this->help_model->simple_insert(HELP_MAIN, $inputArr);
			$getInsertId=$this->help_model->get_last_insert_id();
			$this->help_model->update_details(HELP_MAIN,array('toID'=>$getInsertId),array('id'=>$getInsertId));
		}
		
		$this->setErrorMessage('success', 'Added');
		redirect('admin/help/display_main_menu');
		}
		}
    }
    
    public function edit_helplist_form()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $this->data['heading']  = 'Edit Help';
            $help_id                = $this->uri->segment(4, 0);
            $condition              = array(
                'id' => $help_id
            );
            //$sortArr1 = array('field'=>'name','type'=>'asc');
            $this->data['helpList'] = $this->help_model->get_all_details(HELP_MAIN, $condition);
            
            //$this->data['currency_details'] = $this->currency_model->get_all_details(CURRENCY,$condition);
            if ($this->data['helpList']->num_rows() == 1) {
                $this->load->view('admin/help/edit_help_list', $this->data);
            } else {
                redirect('admin');
            }
        }
    }
    
    public function edit_sub_menu()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $this->data['heading']  = 'Edit Submenu';
            $help_id                = $this->uri->segment(4, 0);
            $condition              = array(
                'id' => $help_id
            );
			
			$this->data['helpList'] = $this->help_model->get_all_details(HELP_SUB, $condition);
            
			$condition             = array(
                'status' => 'Active'
            );
			
			$this->data['main']     = $this->help_model->get_all_details(HELP_MAIN, $condition);
            
			$this->data['id']       = $help_id;
            
            
            
            if ($this->data['helpList']->num_rows() == 1) {
                $this->load->view('admin/help/edit_sub_menu', $this->data);
            } else {
                redirect('admin');
            }
        }
    }
    
	public function edit_question_menu()
    {
     
            $this->data['heading']  = 'Edit Question and Answer';
            $help_id                = $this->uri->segment(4, 0);
            $condition              = array(
                'id' => $help_id
            );
			
			 $this->data['helpList'] = $this->help_model->get_all_mainmenu(fc_help_main);
			 
			 $this->data['subhelp'] = $this->help_model->get_all_submainmenu(fc_help_sub);
			 
			 $this->data['values']=$this->help_model->get_all_main(fc_help_question,$condition);
            
			
			
			
            //print_r($this->data['helpList']);
			//exit;
			
            
            
            
            
                $this->load->view('admin/help/edit_question_ans', $this->data);
            
        
    }
	
	public function updatequestion()
	{
	
	
	
	if ($this->input->post('status') != '') {
			$location_status = 'Active';
			} else {
			$location_status = 'Inactive';
			}
			$inputArr = array(
			'main' => $this->input->post('main'),
			'sub' => $this->input->post('submenu'),
			'question' => $this->input->post('question'),
			'answer' => $this->input->post('answer'),
			'feature'=>$this->input->post('feature'),
			
			'status' => $location_status
			);
	 $conditionn = array(
                'id' => $this->input->post('question_id')
            );
	
	 $this->help_model->update_details('fc_help_question', $inputArr, $conditionn);
	 
	 redirect("admin/help/question_and_ans");
	}
    public function insertquestion()
	{
	if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
		
		if($this->input->post('main') == "")
			{
				$this->setErrorMessage('error', 'Please Select Main Menu');
				redirect('admin/help/add_questionans_menu/');
			}
			else if($this->input->post('submenu') == "")
			{
				$this->setErrorMessage('error', 'Please Select Sub Menu');
				redirect('admin/help/add_questionans_menu');
			}
		}
		
		if ($this->input->post('status') != '') {
			$location_status = 'Active';
			} else {
			$location_status = 'Inactive';
			}
			$inputArr = array(
			'main' => $this->input->post('main'),
			'sub' => $this->input->post('submenu'),
			'question' => $this->input->post('question'),
			'answer' => $this->input->post('answer'),
			'feature'=>$this->input->post('feature'),
			
			'status' => $location_status
			);
			$seo = strtolower($this->input->post('question'));
			$seo = mysql_real_escape_string($seo);
			$seo = trim($seo);
			$seo = str_replace("'","",$seo);
			$seo = str_replace("&","",$seo);
			$seo = str_replace("'","",$seo);
			$seo = @ereg_replace("[^A-Za-z0-9]", " ", $seo);
			$seo = preg_replace( "/\s+/", " ", $seo);
			$seo = str_replace(" ","-", $seo);
			$inputArr['seo']=$seo;
			$this->help_model->simple_insert(HELP_QUESTION, $inputArr);
			$getInsertId=$this->help_model->get_last_insert_id();
			$this->help_model->update_details(HELP_QUESTION,array('toID'=>$getInsertId),array('id'=>$getInsertId));
			
			redirect('admin/help/question_and_ans');
	}
    public function insertsubmenu()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
		//echo '<pre>';print_r($_POST);die;
			$help_id = $this->input->post('help_id');
			if($this->input->post('main') == "" && $help_id != '')
			{
				$this->setErrorMessage('error', 'Please Select Main Menu');
				redirect('admin/help/edit_sub_menu/'.$help_id);
			}
			else if($this->input->post('main') == "")
			{
				$this->setErrorMessage('error', 'Please Select Main Menu');
				redirect('admin/help/add_sub_menu');
			}
			$name = $this->input->post('help_name');
			$main = $this->input->post('main');
			$type=$this->input->post('type');
			if ($this->input->post('status') != '') {
			$location_status = 'Active';
			} else {
			$location_status = 'Inactive';
			}
			$inputArr = array(
			'main' => $main,
			'name' => $name,
			'status' => $location_status,
			'type'=>$type
			);

			if ($this->input->post('status') != '') {
			$location_status = 'Active';
			} else {
			$location_status = 'Inactive';
			}
			if($help_id != '')
			{
				$condition = array('id' => $help_id);
				$this->help_model->update_details(HELP_SUB, $inputArr, $condition);
				redirect('admin/help/display_sub_menu');
			}
			else 
			{
				$seo = strtolower($name);
				$seo = mysql_real_escape_string($seo);
				$seo = trim($seo);
				$seo = str_replace("'","",$seo);
				$seo = str_replace("&","",$seo);
				$seo = str_replace("'","",$seo);
				$seo = @ereg_replace("[^A-Za-z0-9]", " ", $seo);
				$seo = preg_replace( "/\s+/", " ", $seo);
				$seo = str_replace(" ","-", $seo);
				$inputArr['seo']=$seo;
				$this->help_model->simple_insert(HELP_SUB, $inputArr);
				$getInsertId=$this->help_model->get_last_insert_id();
				$this->help_model->update_details(HELP_SUB,array('toID'=>$getInsertId),array('id'=>$getInsertId));
				redirect('admin/help/display_sub_menu');
			}
			
        }
    }
    
    public function updatesubmenu()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            
            $help_id   = $this->uri->segment(4, 0);
            $condition = array(
                'id' => $this->input->post('parent')
            );
            $row       = $this->help_model->get_all_details('fc_help_page', $condition);
            
            $gname = $row->row()->name;
            
            $conditionn = array(
                'id' => $this->input->post('id')
            );
            
            $description = $this->input->post('description');
            $name        = $this->input->post('page_name');
            if ($this->input->post('status') != '') {
                $location_status = '1';
            } else {
                $location_status = '0';
            }
            
            
            
            
            
            
            $inputArr = array(
                'name' => $name,
                'description' => $description,
                'group_id' => trim($this->input->post('parent')),
                'group_name' => $gname,
                'status' => $location_status
            );
            $this->help_model->update_details('fc_help_sub_menu', $inputArr, $conditionn);
            
            
            
            redirect('admin/help/display_sub_menu');
            //if ($this->data['help_details']->num_rows() == 1){
            //$this->load->view('admin/help/add_sub_menu',$this->data);
            //}else {
            redirect('admin');
            //}
        }
    }
    public function delete_help_list()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $help_id    = $this->uri->segment(4, 0);
            $condition  = array(
                'id' => $help_id
            );
            //$conditionn = array(
               // 'group_id' => $help_id
           // );
            $this->help_model->deleterel($help_id);
            //$this->currency_model->commonDelete('fc_help_sub', $conditionn);
            $this->setErrorMessage('success', 'deleted successfully');
            redirect('admin/help/display_main_menu');
        }
    }
    public function delete_sub_menu()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $help_id   = $this->uri->segment(4, 0);
            $condition = array(
                'id' => $help_id
            );
            
            $this->currency_model->commonDelete('fc_help_sub', $condition);
            $this->setErrorMessage('success', 'deleted successfully');
            redirect('admin/help/display_sub_menu');
        }
    }
	
	public function delete_question_menu()
    {
        if ($this->checkLogin('A') == '') {
            redirect('admin');
        } else {
            $help_id   = $this->uri->segment(4, 0);
            $condition = array(
                'id' => $help_id
            );
            
            $this->currency_model->commonDelete('fc_help_question', $condition);
            $this->setErrorMessage('success', 'deleted successfully');
            redirect('admin/help/question_and_ans');
        }
    }
    
} 