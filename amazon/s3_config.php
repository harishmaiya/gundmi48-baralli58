<?php
// Bucket Name
$bucket = $s3_bucket_name;
if (!class_exists('S3'))require_once('S3.php');
			
//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', $s3_access_key);
if (!defined('awsSecretKey')) define('awsSecretKey', $s3_secret_key);
			
//instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);

$s3->putBucket($s3_bucket_name, S3::ACL_PUBLIC_READ);

?>