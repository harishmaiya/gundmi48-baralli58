<?php
require_once '../databaseValues.php';
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
require_once 'google-api-php-client/src/contrib/Google_Oauth2Service.php';
   // var_dump(parse_url($url));
   $get_request_url = explode('dbbackup', $_SERVER['REQUEST_URI']);
   $return_site_rul =  $_SERVER['SERVER_NAME'].''.$get_request_url[0]."admin";
//echo  $return_site_rul; die;
$client = new Google_Client();
$authUrl = $client->createAuthUrl();
$con=mysql_connect($hostName,$dbUserName,$dbPassword,$databaseName);
mysql_select_db($databaseName,$con);
$credet=mysql_query("select * from `fc_admin_settings` ",$con)or die ('Error updating database: '.mysql_error());
if($credet){
$row=mysql_fetch_array($credet);
$googleclientid=$row['google_client_id'];
$googleclientsecret=$row['google_client_secret'];
} else {
echo "No result";
}
//echo $row[0]; die;
//var_dump($this->config); die;
if($googleclientid=='' || $googleclientsecret==''){
echo "<script>alert('Error! Please Add Google Credentials In Admin Settings');window.location=\"http://$return_site_rul\";</script>";
//exit;
}
// Get your credentials from the console
$client->setClientId($googleclientid);
$client->setClientSecret($googleclientsecret);
$client->setRedirectUri($_SERVER['SERVER_NAME'].''.$get_request_url[0].'dbbackup/fileUpload.php');
$client->setScopes(array('https://www.googleapis.com/auth/drive'));
$service = new Google_DriveService($client);
$authUrl = $client->createAuthUrl();
if (isset($_GET['code']))
{
$authCode = trim($_GET['code']);

// Exchange authorization code for access token
$accessToken = $client->authenticate($authCode);
$client->setAccessToken($accessToken);

//Insert a file
$file = new Google_DriveFile();
$file->setTitle('DB_'.date('m-d-Y', time()));
$file->setDescription('A test document');
$file->setMimeType('text/plain');

$data = file_get_contents('backupdb.sql');

$createdFile = $service->files->insert($file, array(
      'data' => $data,
      'mimeType' => 'text/plain',
    ));

if($createdFile)echo "<script>alert(\"Database exported into Google Drive successfully\");
window.location=\"http://$return_site_rul\";</script>";
else 
	echo "<script>alert(\'Error! while uploading file\');window.location=\"http://$return_site_rul\";</script>";
}
else
{
echo "<script>window.location.href='".$authUrl."';</script>";
}

?>