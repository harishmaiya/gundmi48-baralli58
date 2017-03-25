<?php
ob_start();
if(session_id() == '') {
	session_start();
}
$con = @mysql_pconnect(trim($_GET['host_name']), trim($_GET['user_name']), trim($_GET['db_password'])) or die("Database Connection Failed<br>". mysql_error());
if($con){
 $dbcon = @mysql_select_db(trim($_GET['db_name']),$con) or die("Database Connection Failed<br>". mysql_error());
	if($dbcon){
		$file_name = 'databaseValues.php';
		$file_cnt = array( 
			'SiteUrl' => addslashes(trim($_GET['site_url'])),
			'hostName' => addslashes(trim($_GET['host_name'])),
			'dbUserName' => addslashes(trim($_GET['user_name'])),
			'dbPassword' => addslashes(trim($_GET['db_password'])),
			'databaseName' => addslashes(trim($_GET['db_name'])),
			'site_name' => addslashes(trim($_GET['site_name'])),
			'admin_name' => addslashes(trim($_GET['admin_name'])),
			'admin_password' => addslashes(trim($_GET['admin_password'])),
			'admin_email' => addslashes(trim($_GET['admin_email']))
		);
		$_SESSION['file_cnt'] = $file_cnt;
		
		$filename = 'db/renters.sql';
		// Temporary variable, used to store current query
		$templine = '';
		// Read in entire file
		$lines = file($filename);
		// Loop through each line
		foreach ($lines as $line)
		{
			// Skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == '' || substr($line, 0, 2) == '/*')
			    continue;
			
			// Add this line to the current segment 
			$templine .= $line;
			// If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';')
			{		
					while(substr(trim($templine), 0, 1) != 'C' && substr(trim($templine), 0, 1) != 'I' && substr(trim($templine), 0, 1) != 'S'){
						$templine = trim(substr($templine,1));
					}
					
					$trimmed = rtrim($file_cnt['SiteUrl'], "/");
					$templine = str_replace('http://192.168.1.253/renters-ins',$trimmed,$templine);
				    // Perform the query
			    	@mysql_query($templine) or die('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() .  '<br /><br />');
				    // Reset temp variable to empty
				    $templine = '';
			}
		}
		
		/*$tbl_query = array();
		foreach ($tbl_query as $tbl_query_str){
			@mysql_query($tbl_query_str);
		}*/
		header("location:".rtrim($file_cnt['SiteUrl'], "/")."/configure_site.php");
	}else {
		$_SESSION['errorMSG'] = 'Cannot able to select database';
		echo "<script>window.history.go(-1);</script>";
	}
//	if(@mysql_query("grant all privileges on *.* to 'root'@'localhost' identified by '';",$con)){echo 'query success';}else {echo mysql_error();}
}else{
	$_SESSION['errorMSG'] = 'Cannot able to connect database';
	echo "<script>window.history.go(-1);</script>";
};