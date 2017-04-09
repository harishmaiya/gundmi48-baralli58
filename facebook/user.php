<?php
require 'src/facebook.php';
include('../commonsettings/fc_admin_settings.php');


$basepathurl = $config['base_url'];
$callback_website_url=$config['base_url'].'googlelogin/facebookRedirect';
$app_id = $config['facebook_app_id'];

$app_secret = $config['facebook_app_secret'];

$my_url = $basepathurl.'facebook/user.php'; 
session_start(); 

if(isset($_REQUEST["code"]))
{
 $code = $_REQUEST["code"];
}
else
{
	 $code = 0;
}

  
   if(empty($code)) {
     $_SESSION['state'] = md5(uniqid(rand(), TRUE)); // CSRF protection
     $dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
       . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
       . $_SESSION['state'] . "&scope=email";

     echo("<script> top.location.href='" . $dialog_url . "'</script>");
   }

   
   if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
     $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
       . "&client_secret=" . $app_secret . "&code=" . $code;
	   
			$URL = $token_url;
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$URL);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
			$pageContent = curl_exec($curl_handle);
			curl_close($curl_handle);



     $response = $pageContent;
	 //echo "<pre>";print_r($response);//die;
     $params = null;
     /*parse_str($response, $params);*/
	 $params = (array)json_decode($response);

     $_SESSION['access_token'] = $params['access_token'];

     $graph_url = "https://graph.facebook.com/me?access_token=" 
       . $params['access_token']."&fields=id,email,first_name,last_name";

	$FBlogout='https://www.facebook.com/logout.php?next='.$basepathurl.'user/logout.html%3Fsecret%3D&access_token='.$params['access_token'];


			$URL1 = $graph_url;
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$URL1);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
			$pageContent1 = curl_exec($curl_handle);
			curl_close($curl_handle);



     $user = json_decode($pageContent1);
	 if(!empty($user))
	 {
		$_SESSION['email']=$user->email;
		$_SESSION['first_name']=$user->first_name;
		$_SESSION['last_name']=$user->last_name;
		
		$picturtmp_name = 'fb-'.time().str_replace('','-',$user->first_name);
		$_SESSION['fb_user_id'] = $user->id;
		$profile_Image = 'http://graph.facebook.com/'.$user->id.'/picture?width=200&height=200';
		$_SESSION['fb_image_name'] = $picturtmp_name.'.jpg'; // insert $userImage in db table field.
		$userImage = $_SESSION['fb_image_name'];
		$savepath = '../images/users/';
		$thumb_image = file_get_contents($profile_Image);
		$thumb_file = $savepath . $userImage;
		file_put_contents($thumb_file, $thumb_image);
		
		header('Location: '.$callback_website_url);
		 
		}
		else
		{
			header('Location: '.$basepathurl);
		}
   
   }
   
   
			
	