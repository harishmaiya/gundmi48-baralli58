<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to user management
 * 
 * @author dev Beetrut
 *        
 */
class Contact extends MY_Controller {
	function __construct() {
// 		echo 's';die;
		parent::__construct ();
		$this->load->helper ( array (
				'cookie',
				'date',
				'form' 
		) );
		$this->load->library ( array (
				'encrypt',
				'form_validation' 
		) );
		$this->load->model ( 'contact_model' );
		if ($this->checkPrivileges ( 'contact', $this->privStatus ) == FALSE) {
			redirect ( 'admin' );
		}
	}
	
	/**
	 * This function loads the contact list page
	 */
	public function index() {
		if ($this->checkLogin ( 'A' ) == '') {
			redirect ( 'admin' );
		} else {
			redirect ( 'admin/contact/display_user_list' );
		}
	}
	
	/**
	 * This function loads the contact list page
	 */
	public function display_contact_list() {
		if ($this->checkLogin ( 'A' ) == '') {
			redirect ( 'admin' );
		} else {
			$this->data ['heading'] = 'Contact List';
			
			// $this->data['contactList'] = $this->contact_model->SelectAllContactInfo();
			$this->data ['contactList'] = $this->contact_model->get_contactViewAll_details ();
			// echo "<pre>"; print_r($this->data['contactList']);
			
			$this->load->view ( 'admin/contact/display_contact', $this->data );
		}
	}
	
	/**
	 * This function loads the contact dashboard
	 */
	public function display_contact_dashboard() {
		if ($this->checkLogin ( 'A' ) == '') {
			redirect ( 'admin' );
		} else {
			$this->data ['heading'] = 'Contact Dashboard';
			$condition = array ();
			$groupcontact = array (
					'c.renter_id' 
			);
			$grouporder = array (
					'u.contact_count' => 'DESC' 
			);
			
			$this->data ['contactList'] = $this->contact_model->get_contactAll_details ( $groupcontact, $grouporder );
			$groupcontact = array (
					'c.rental_id' 
			);
			$grouporder = array (
					'p.contact_count' => 'DESC' 
			);
			$this->data ['TopRentalList'] = $this->contact_model->get_contactAll_details ( $groupcontact, $grouporder );
			
			$this->load->view ( 'admin/contact/display_contact_dashboard', $this->data );
		}
	}
/*	public function change_contact_status()
	{
		if(count($this->input->post('checkbox_id')) > 0 &&  $this->input->post('statusMode') != ''){
				
			$this->attribute_model->activeInactiveCommon(ATTRIBUTE,'id');
			if (strtolower($this->input->post('statusMode')) == 'delete'){
				$this->setErrorMessage('success','Attribute records deleted successfully');
			}else {
				$this->setErrorMessage('success','Attribute records status changed successfully');
			}
		
			redirect('admin/contact/display_contactus');
		}
	}
	public function display_contactus() {
		
		if ($this->checkLogin ( 'A' ) == '') {
			redirect ( 'admin' );
		} else {
			$this->data ['admin_contactus'] = $this->contact_model->get_all_details ( CONTACTUS, array () );
			$this->load->view ( 'admin/contact/display_contactus', $this->data );
		}
	}*/
	/**
	 * This function loads the add new contact form
	 */
	public function add_contact_form() {
		if ($this->checkLogin ( 'A' ) == '') {
			redirect ( 'admin' );
		} else {
			$this->data ['heading'] = 'Add New Contact';
			$this->load->view ( 'admin/contact/add_contact', $this->data );
		}
	}
	/**
	 * This function insert and edit a user
	 */
	public function insertEditContact() {
		if ($this->checkLogin ( 'A' ) == '') {
			redirect ( 'admin' );
		} else {
			$contact_id = $this->input->post ( 'contact_id' );
			$contact_name = $this->input->post ( 'contact_name' );
			$seourl = url_title ( $contact_name, '-', TRUE );
			if ($contact_id == '') {
				$condition = array (
						'contact_name' => $contact_name 
				);
				$duplicate_name = $this->contact_model->get_all_details ( CONTACT, $condition );
				if ($duplicate_name->num_rows () > 0) {
					$this->setErrorMessage ( 'error', 'Contact name already exists' );
					redirect ( 'admin/contact/add_contact_form' );
				}
			}
			$excludeArr = array (
					"contact_id",
					"status" 
			);
			
			if ($this->input->post ( 'status' ) != '') {
				$contact_status = 'Active';
			} else {
				$contact_status = 'InActive';
			}
			$contact_data = array ();
			
			$inputArr = array (
					'status' => $contact_status,
					'seourl' => $seourl 
			);
			$datestring = "%Y-%m-%d %H:%M:%S";
			$time = time ();
			if ($contact_id == '') {
				$contact_data = array (
						'dateAdded' => mdate ( $datestring, $time ) 
				);
			}
			$dataArr = array_merge ( $inputArr, $contact_data );
			$condition = array (
					'id' => $contact_id 
			);
			if ($contact_id == '') {
				$this->contact_model->commonInsertUpdate ( CONTACT, 'insert', $excludeArr, $dataArr, $condition );
				$this->setErrorMessage ( 'success', 'Contact added successfully' );
			} else {
				if ($contact_status == 'Active') {
					$dataArr1 = array (
							'status' => 'InActive' 
					);
					$conditionArr = array (
							'id !=' => $contact_id 
					);
					$this->contact_model->update_details ( CONTACT, $dataArr1, $conditionArr );
				}
				$this->contact_model->commonInsertUpdate ( CONTACT, 'update', $excludeArr, $dataArr, $condition );
				$this->setErrorMessage ( 'success', 'Contact updated successfully' );
			}
			redirect ( 'admin/contact/display_contact_list' );
		}
	}
	
	/**
	 * This function loads the edit user form
	 */
	public function edit_contact_form() {
		if ($this->checkLogin ( 'A' ) == '') {
			redirect ( 'admin' );
		} else {
			$this->data ['heading'] = 'Edit Contact';
			$contact_id = $this->uri->segment ( 4, 0 );
			$condition = array (
					'id' => $contact_id 
			);
			$this->data ['contact_details'] = $this->contact_model->get_all_details ( CONTACT, $condition );
			if ($this->data ['contact_details']->num_rows () == 1) {
				$this->load->view ( 'admin/contact/edit_contact', $this->data );
			} else {
				redirect ( 'admin' );
			}
		}
	}
	
	/**
	 * This function change the user status
	 */
	public function change_contact_status() {
		if ($this->checkLogin ( 'A' ) == '') {
			redirect ( 'admin' );
		} else {
			$mode = $this->uri->segment ( 4, 0 );
			$user_id = $this->uri->segment ( 5, 0 );
			$status = ($mode == '0') ? 'InActive' : 'Active';
			$newdata = array (
					'status' => $status 
			);
			$condition = array (
					'id' => $user_id 
			);
			$this->contact_model->update_details ( RENTALENQUIRY, $newdata, $condition );
			$this->setErrorMessage ( 'success', 'Contact Status Changed Successfully' );
			redirect ( 'admin/contact/display_contact_list' );
		}
	}
	
	/**
	 * This function loads the user view page
	 */
	public function view_contact() {
		if ($this->checkLogin ( 'A' ) == '') {
			redirect ( 'admin' );
		} else {
			$this->data ['heading'] = 'View Contact';
			$contact_id = $this->uri->segment ( 4, 0 );
			$condition = array (
					'id' => $contact_id 
			);
			$this->data ['contact_details'] = $this->contact_model->get_contactView_details ( $contact_id );
			if ($this->data ['contact_details']->num_rows () == 1) {
				$this->load->view ( 'admin/contact/view_contact', $this->data );
			} else {
				redirect ( 'admin' );
			}
		}
	}
	
	/**
	 * This function delete the user record from db
	 */
	public function delete_contact() {
		if ($this->checkLogin ( 'A' ) == '') {
			redirect ( 'admin' );
		} else {
			$contact_id = $this->uri->segment ( 4, 0 );
			$condition = array (
					'id' => $contact_id 
			);
			$this->contact_model->commonDelete ( RENTALENQUIRY, $condition );
			$this->setErrorMessage ( 'success', 'Contact deleted successfully' );
			redirect ( 'admin/contact/display_contact_list' );
		}
	}
	
	/**
	 * This function change the user status, delete the user record
	 */
	public function change_contact_status_global() {
		
		// print_r($_POST);
		if (count ( $_POST ['checkbox_id'] ) > 0 && $_POST ['statusMode'] != '') {
			$this->contact_model->activeInactiveCommon ( RENTALENQUIRY, 'id' );
			if (strtolower ( $_POST ['statusMode'] ) == 'delete') {
				$this->setErrorMessage ( 'success', 'Contact records deleted successfully' );
			} else {
				$this->setErrorMessage ( 'success', 'Contact records status changed successfully' );
			}
			redirect ( 'admin/contact/display_contact_list' );
		}
	}
	
	/* Export Excel function */
	public function customerExcelExport() {
		$sortArr = array (
				'field' => 'id',
				'type' => 'desc' 
		);
		$condition = array ();
		
		$UserDetails = $this->contact_model->get_contactViewAll_details ();
		$data ['getCustomerDetails'] = $UserDetails->result_array ();
		// echo '<pre>';print_r($data['getCustomerDetails']);die;
		$this->load->view ( 'admin/contact/customerExportExcel', $data );
	}
}

/* End of file contact.php */
/* Contact: ./application/controllers/admin/contact.php */
