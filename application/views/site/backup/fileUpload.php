<?php
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
require_once 'google-api-php-client/src/contrib/Google_Oauth2Service.php';

$client = new Google_Client();
// Get your credentials from the console
$client->setClientId('1076903159369-5nv7tblb6nnlks5qbl588qhhoff894r0.apps.googleusercontent.com');
$client->setClientSecret('oRCdkRIqRQ53SlTyKIelJLMV');
$client->setRedirectUri('https://www.staynest.com/'.'dbbackup/fileUpload.php');
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
$file->setTitle('My document - '.date('m-d-Y', time()));
$file->setDescription('A test document');
$file->setMimeType('text/plain');

$data = file_get_contents('backupdb.sql');

$createdFile = $service->files->insert($file, array(
      'data' => $data,
      'mimeType' => 'text/plain',
    ));

if($createdFile)echo "<script>alert('Database exported into Google Drive successfully');window.location='http://www.staynest.com/admin';</script>";
else echo "<script>alert('Error! while uploading file');window.location='http://www.staynest.com/admin';</script>";
}
else
{
echo "<script>window.location.href='".$authUrl."';</script>";
}

?>