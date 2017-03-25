<?php
ob_start();
if(session_id() == '') {
	session_start();
}
$file_cnt = $_SESSION['file_cnt'];
if($con = @mysql_pconnect($file_cnt['hostName'], $file_cnt['dbUserName'], $file_cnt['dbPassword'])){
	if(@mysql_select_db($file_cnt['databaseName'],$con)){
		
		@mysql_query("UPDATE `fc_admin` SET `created`=now(),`modified`=now(), `admin_name`='".addslashes($file_cnt['admin_name'])."', `admin_password` = '".md5(addslashes($file_cnt['admin_password']))."', `email` = '".addslashes($file_cnt['admin_email'])."' where id='1'") or die(mysql_error());
		
		@mysql_query("UPDATE `fc_admin_settings` SET `site_contact_mail` = '".addslashes($file_cnt['admin_email'])."', `email_title` = '".addslashes($file_cnt['site_name'])."', `meta_title` = '".addslashes($file_cnt['site_name'])."',`meta_keyword` = '".addslashes($file_cnt['site_name'])."',`meta_description` = '".addslashes($file_cnt['site_name'])."' where id='1';")or die(mysql_error());
		
		
		
		
		
	   $file_content = "<?php \$hostName = '".addslashes($file_cnt['hostName'])."';
	   \$dbUserName = '".addslashes($file_cnt['dbUserName'])."';
	   \$dbPassword = '".addslashes($file_cnt['dbPassword'])."';
	   \$databaseName = '".addslashes($file_cnt['databaseName'])."';\n define('SITE_URL', '".addslashes($file_cnt['SiteUrl'])."');\n ?>";
		$file_name = 'databaseValues.php'; 
		@file_put_contents($file_name, $file_content);
		
		
		$config = "<?php \$config['site_contact_mail']='".addslashes($file_cnt['admin_email'])."';
		\$config['email_title']='".addslashes($file_cnt['site_name'])."';
		\$config['logo_image']='admin_logo.png';
		\$config['home_logo_image']='renters-landing-logo.png'; 
		\$config['background_image']='bg.jpg';
		\$config['under_construction_image']='coming-soon.jpg';
		\$config['meta_title']='".addslashes($file_cnt['site_name'])."';
		\$config['meta_keyword']='".addslashes($file_cnt['site_name'])."';
		\$config['meta_description']='".addslashes($file_cnt['site_name'])."';
		\$config['fevicon_image']= 'favicon.png';
		\$config['watermark']= 'favicon.png';
		\$config['admin_name']='".addslashes($file_cnt['admin_name'])."';
		\$config['email']='".addslashes($file_cnt['admin_email'])."';
		\$config['admin_type']='super';
		\$config['is_verified']='Yes';
		\$config['base_url']='".$file_cnt['SiteUrl']."';
		\$config['videoUrl']='https://www.youtube.com/embed/TuEOVr-HvGY';
		\$config['status']='Active';
		\$config['google_map_api']='AIzaSyCgA3-jFEYPX8S1WAK_ASubjxrq8lEEMws';
		\$config['message_pagination_per_page'] = '10';
		\$config['site_pagination_per_page'] = '10'; ?>";
		
		$file = 'commonsettings/fc_admin_settings.php';
		@file_put_contents($file, $config);
		unset($_SESSION['file_cnt']);
		@unlink('check_db_connect.php');
		@unlink('db_settings.php');
		@unlink('configure_site.php');
		session_regenerate_id();
		header('location:'.$file_cnt['SiteUrl']);
	}else {
		$_SESSION['errorMSG'] = 'Cannot able to select database';
		echo "<script>window.history.go(-1);</script>";
	}
}else {
	$_SESSION['errorMSG'] = 'Cannot able to connect database';
	echo "<script>window.history.go(-1);</script>";
}