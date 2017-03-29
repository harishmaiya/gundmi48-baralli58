<?php
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
require_once 'google-api-php-client/src/contrib/Google_Oauth2Service.php';
require_once '../commonsettings/fc_admin_settings.php'; 
   // var_dump(parse_url($url));
   $get_request_url = explode('dbbackup', $_SERVER['REQUEST_URI']);
   $return_site_rul =  $_SERVER['SERVER_NAME'].''.$get_request_url[0]."admin";
//echo  $return_site_rul; die;
$client = new Google_Client();
$authUrl = $client->createAuthUrl();

// Get your credentials from the console
$client->setClientId($config['google_client_id']);
$client->setClientSecret($config['google_client_secret']);
$client->setRedirectUri($config['base_url'].'dbbackup/fileUpload.php');
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