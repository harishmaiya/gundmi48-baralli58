<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to Order management 
 * @author Teamtweaks
 *
 */ 

class Backup extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));				
		$this->load->model('account_model');
		$this->load->model('order_model');
		if ($this->checkPrivileges('Backup',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/backup/dbBackup');
		}
	}
	public function dbBackup(){
		
		/* $host = DBB_HOST;
		$user = DBB_USER;
		$pass = DBB_PASS;
		$name = DBB_NAME; */
		
		$tables = '*';
		{
			//$con = mysql_connect($host,$user,$pass);
			//mysql_select_db($name,$con);
			if($tables == '*')
			{
				$tables = array();
				$result = mysql_query('SHOW TABLES');
				while($row = mysql_fetch_row($result))
				{
					$tables[] = $row[0];
				}
			}
			else
			{
				$tables = is_array($tables) ? $tables : explode(',',$tables);
			}
			$return = "";
			foreach($tables as $table)
			{
				$result = mysql_query('SELECT * FROM '.$table);
				$num_fields = mysql_num_fields($result);
				//$return.= 'DROP TABLE '.$table.';';
				$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
				$return.= $row2[1].";";

				while($row = mysql_fetch_row($result))
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++)
					{
						$row[$j] = addslashes($row[$j]);
						//$row[$j] = preg_replace("#n#","n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");";
				}
				$return.="";
			}

			$fileName = 'dbbackup/backupdb.sql';
			$handle = fopen($fileName,'w+');
			fwrite($handle,$return);
			fclose($handle);
		}
		if (glob("*.sql") != false)
		{
			$filecount = count(glob("*.sql"));
			$arr_file = glob("*.sql");
		}


		$path = dirname($_SERVER['PHP_SELF']);
		$position = strrpos($path,'/') + 1;
		$folder_name = substr($path,$position);


		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("../$folder_name/"));	
		//echo base_url()."dbbackup/fileUpload.php";die;
		//echo $_SERVER['SERVER_NAME'];die;
		header('Location: '.base_url().'dbbackup/fileUpload.php');
		//echo "<script>window.location='".base_url()."dbbackup/fileUpload.php';</script>";

	
	}
}

/* End of file order.php */
/* Location: ./application/controllers/admin/backup.php */