<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to admin management
 * @author Teamtweaks
 *
 */
class Admin_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	public function add_edit_subadmin($dataArr='',$condition=''){
		if ($condition['id'] != ''){
			$this->db->where($condition);
			$this->db->update(ADMIN,$dataArr);
		}else {
			$this->db->insert(ADMIN,$dataArr);
		}
	}
	
	/**
    * 
    * This function save the admin details in a file
    */
   public function saveAdminSettings(){
		$getAdminSettingsDetails = $this->getAdminSettings();
		$config = '<?php ';
		foreach($getAdminSettingsDetails->row() as $key => $val){
			$value = addslashes($val);
			$config .= "\n\$config['$key'] = '$value'; ";
		}
		$config .= "\n\$config['message_pagination_per_page'] = '10'; ";
		$config .= "\n\$config['base_url'] = '".base_url()."'; ";
		$config .= ' ?>';
		$file = 'commonsettings/fc_admin_settings.php';
		file_put_contents($file, $config);
   }
}