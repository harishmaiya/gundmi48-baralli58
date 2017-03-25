<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if($this->config->item('google_verification')){ echo stripslashes($this->config->item('google_verification')); }if ($heading == ''){?>
<title><?php echo $title;?></title>
<?php }else {?>
<title><?php echo $heading;?></title>
<?php }?>
<?php 
if(isset($productDetails) && isset($productImages)) {
$product = $productDetails->row();
$imgArr1 = $productImages->result_array();
if($product!='')
{ 
	?>
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@ZoplayCom" />
<meta name="twitter:creator" content="@ZoplayCom"/>
<meta name="twitter:widgets:csp" content="on">
<meta name="twitter:url" content="<?php echo base_url();?>rental/<?php echo $product->id; ?>">
<meta name="twitter:image" content="<?php echo base_url() ?>server/php/rental/<?php echo $imgArr1[0]['product_image'] ?>">
<meta name="twitter:title" content="<?php echo ucfirst($product->product_title); ?>">
<meta name="twitter:description" content="<?php echo strip_tags(str_replace('"','',$product->description)); ?>" />
<meta property="og:title" content="<?php echo ucfirst($product->product_title); ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php echo base_url();?>rental/<?php echo $product->id; ?>" />
<meta property="og:image" content="<?php echo base_url() ?>server/php/rental/<?php echo $imgArr1[0]['product_image'] ?>" />
<meta property="og:site_name" content="<?php echo base_url();?>" />
<meta property="og:description" content="<?php echo strip_tags(str_replace('"','',$product->description)); ?>" />
<?php if($product->meta_title!=''){ ?>
<meta name="title" content="<?php echo ucfirst($product->meta_title); ?>" />
<meta name="keywords" content="<?php echo $product->meta_keyword; ?>" />
<meta name="description" content=<?php echo strip_tags(str_replace('"','',$product->meta_description)); ?> />
<?php } }  ?>

<?php  } else { ?>
<meta name="title" content="<?php echo $meta_title; ?>" />
<meta name="keywords" content="<?php echo $meta_keyword; ?>" />
<meta name="description" content="<?php echo $meta_description; ?>" />
<meta property="og:title" content="<?php echo $meta_title; ?>" />
<meta property="og:url" content="<?php echo base_url();?>" />
<meta property="og:description" content="<?php echo $meta_description; ?>" />
<meta property="og:image" content="<?php echo base_url(); ?>images/logo/<?php echo $this->config->item('logo_image');?>"/>
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@ZoplayCom" />
<meta name="twitter:creator" content="@ZoplayCom"/>
<meta name="twitter:widgets:csp" content="on">
<meta name="twitter:url" content="<?php echo base_url();?>">
<meta name="twitter:image" content="<?php echo base_url(); ?>images/logo/<?php echo $this->config->item('logo_image');?>" />
<meta name="twitter:title" content="<?php echo $meta_title; ?>">
<meta name="twitter:description" content="<?php echo $meta_description; ?>" />
<?php } ?>
<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="shortcut icon" type="image/x-icon" href="images/logo/<?php echo $this->config->item('fevicon_image'); ?>">
<base href="<?php echo base_url(); ?>" /><?php 	$by_creating_accnt = str_replace("{SITENAME}",$siteTitle);	$this->load->view('site/templates/css_files',$this->data); ?>
<script type="text/javascript" src="js/site/1.10.min.js"></script>
<script type="text/javascript" src="js/site/bootstrap.min.js"></script>
<script type="text/javascript" src="js/site/bootstrap.js"></script>
<script type="text/javascript" src="js/site/jquery.colorbox.js"></script>
<script type="text/javascript" src="js/site/jquery-ui.js"></script>
<script src="<?php echo base_url();?>js/sweetalert-dev.js"></script>
<?php	$this->load->view('site/templates/script_files',$this->data);?>
<link rel="stylesheet" type="text/css" href="css/site/twitter-bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/site/bootstrap-min.css">
<link rel="stylesheet" media="all" href="css/main.css" type="text/css" />
<link rel="stylesheet" media="all" href="css/style.css" type="text/css" />
<link rel="stylesheet" media="all" href="css/font-awesome.css" type="text/css" />
<link rel="stylesheet" media="all" href="css/font-awesome.css" type="text/css" />
<link rel="stylesheet" media="all" href="css/font-awesome.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>css/sweetalert.css">
<link rel="stylesheet" href="css/style_common.css">
<link rel="stylesheet" href="css/style7.css">

<link rel="stylesheet" media="all" href="css/help-style.css" type="text/css" />

<!--[if lt IE 8]>
<script type="text/javascript" src="js/html5shiv/dist/html5shiv.js"></script>
<![endif]-->


<style type="text/css">.popup_header {
    background-color: #EFEFEF;
    border-bottom: 1px solid #DBDBDB;
    font-size: 15px;
    font-weight: bold;
	font-family:Arial, Helvetica, sans-serif;
	color:#393C3D;
    padding: 10px 15px;
}
.popup_sub_header {
    font-size: 13px;
    font-weight: normal;
	font-family:Arial, Helvetica, sans-serif;
	color:#393C3D;
    padding: 8px 0px;
}
.banner_signup {
    text-align:center;
	margin:20px;
}
.popup_facebook {
    background: url("images/facebook.png") no-repeat;
    color: #FFFFFF;
    cursor: pointer;
    display: inline-block;
    font-family:Arial, Helvetica, sans-serif;
    font-size: 14px;
    font-weight: bold !important;
    line-height: 37px;
    margin: 0;
    padding:0 35px 0 80px;
    text-indent: initial;
}

.popup_facebook:hover{
	 background: url("images/facebook.png") no-repeat;
	text-decoration:none;
}

.popup_signup_or {
    display: inline-block;
    margin: 10px 0;
    text-align: center;
    width: 100%;
}
.popup_page {
    background: none repeat scroll 0 0 #ffffff;
    overflow: hidden;
}
.popup_signup_or {
    display: inline-block;
    margin: 10px 0;
    text-align: center;
    width: 100%;
}

.btn.large {
    font-size: 16px;
}
.mail-btn {
    background: url("images/mail-bg.png") repeat-x scroll 0 0 rgba(0, 0, 0, 0) !important;
    border: 1px solid #1689c7 !important;
    border-radius: 2px !important;
    color: #fff;
    font-size: 14px !important;
    line-height: 17px !important;
    padding: 8px 0 !important;
    text-shadow: none !important;
    text-transform: capitalize;
    width: 275px;
}
.btn {
    -moz-user-select: none;
    border-radius: 2px;
    cursor: pointer;
    display: inline-block;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-weight: normal;
    line-height: 1.6;
    margin-bottom: 0;
    text-align: center;
    text-transform: none;
    vertical-align: middle;
    white-space: nowrap;
}
.btn {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #018fe1;
    background-image: -moz-linear-gradient(center top , #018fe1, #00aeff);
    background-repeat: repeat-x;
    border-color: #0195eb #0083c7 #0175b8;
    border-image: none;
    border-radius: 5px !important;
    border-style: solid;
    border-width: 1px;
    box-shadow: 0 0 0.2em rgba(255, 255, 255, 0.2) inset, 0 1px 2px rgba(0, 0, 0, 0.2), 0 0 0 #000;
    box-sizing: border-box;
    color: #ffffff;
    display: inline-block;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 12px;
    font-weight: bold;
    line-height: 16px;
    margin-bottom: 0;
    padding: 0.4em 1.8em;
    text-align: center;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2);
    text-transform: uppercase;
    vertical-align: middle;
}
.btn-primary {
    background-color: #2badf3;
    background-image: -moz-linear-gradient(center top , #2badf3, #2492db);
    background-repeat: repeat-x;
    border: 1px solid #106fa9;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.18), 0 0 1px 1px rgba(255, 255, 255, 0.09) inset;
    color: #ffffff;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2);
}
.btn-large {
    font-size: 15px;
    padding: 9px 18px;
}
.btn-block {
    display: block;
    white-space: normal;
    width: 100%;
}
button, input[type="button"], input[type="reset"], input[type="submit"] {
    cursor: pointer;
}
button, input, select, textarea {
    font-size: 100%;
    margin: 0;
    vertical-align: middle;
}
button, input {
    line-height: normal;
}
label, input, button, select, textarea {
    font-size: 13px;
    font-weight: normal;
    line-height: 18px;
}
input, button, select, textarea {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}
.popup_page p {
    text-align: left !important;
}

.popup_stay {
    border-top: 1px solid #dbdbdb;
    color: #393c3d;
    display: inline-block;
    float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 13px;
    margin: 0;
    padding: 10px 0 12px 20px !important;
    width: 100%;
}
.all-link {
    color: #00b0ff;
    font-size: 15px;
}
p {
    margin: 0;
    padding: 0;
}
a {
    outline: medium none;
}

.decorative-input {
    background-image: url("images/site/EMAIL.png");
    background-position: right 5px;
    background-repeat: no-repeat;
    box-sizing: border-box;
    display: block;
    font-size: 15px;
    height: 40px;
    line-height: 30px;
    padding: 0 10px;
    width: 95% !important;
}
input, textarea, select, .uneditable-input {
    background-color: #fff;
    border: 1px solid #cdcdcd;
    border-radius: 3px;
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.08) inset, 0 1px 0 0 #fff;
    color: #959595;
    display: inline-block;
    font-size: 13px;
    margin-bottom: 9px;
    padding: 10px 9px;
    width: 210px;
}
input, select, textarea {
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    transition: border 0.2s linear 0s, box-shadow 0.2s linear 0s;
}
button, input, select, textarea {
    font-size: 100%;
    margin: 0;
    vertical-align: middle;
}
button, input {
    line-height: normal;
}
label, input, button, select, textarea {
    font-size: 13px;
    font-weight: normal;
    line-height: 18px;
}
input, button, select, textarea {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}
input, textarea, select, .uneditable-input {
    border: 1px solid #f29b39;
    border-radius: 3px;
    color: #5a5a5a;
    display: inline-block;
    font-size: 13px;
    line-height: 18px;
    margin-bottom: 9px;
    padding: 4px;
    width: 210px;
}
.decorative-input1 {
    background-image: url("images/site/lock.png");
    background-position: right 5px;
    background-repeat: no-repeat;
    box-sizing: border-box;
    display: block;
    font-size: 15px;
    height: 40px;
    line-height: 30px;
    padding: 0 10px;
    width: 95% !important;
}
.all-link1 {
    color: #00b0ff;
    float: right;
    font-size: 13px;
    margin: 10px 0;
}
button, input {
    line-height: normal;
}

input, textarea, select, .uneditable-input {
    background-color: #fff;
    border: 1px solid #cdcdcd;
    border-radius: 3px;
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.08) inset, 0 1px 0 0 #fff;
    color: #959595;
    display: inline-block;
    font-size: 13px;
    margin-bottom: 9px;
    padding: 10px 9px;
    width: 210px;
}


#cboxClose {
  right: -4px;
     top: 3px;}
</style>


<link rel="stylesheet" media="all" href="css/bug-fixed.css" type="text/css" />

<!-- Autosuggestion Script End-->

<script> // for remember login.......temp storage password username added by siva (23-10-2015)
	$(function() {

		if (localStorage.chkbx && localStorage.chkbx != '') {
			$('#remember').attr('checked', 'checked');
			$('#signin_email_address').val(localStorage.signin_email_address);
			$('#signin_password').val(localStorage.signin_password);
		} else {
			$('#remember').removeAttr('checked');
			$('#signin_email_address').val('');
			$('#signin_password').val('');
		}

		$('#remember').click(function() {

			if ($('#remember').is(':checked')) {
				// save username and password
				localStorage.signin_email_address = $('#signin_email_address').val();
				localStorage.signin_password = $('#signin_password').val();
				localStorage.chkbx = $('#remember').val();
			} else {
				localStorage.signin_email_address = '';
				localStorage.signin_password = '';
				localStorage.chkbx = '';
			}
		});
	});

</script>
</head>

<body <?php if($this->uri->segment(1) == 'property' ){echo 'onload="initialize();"'; } else {echo 'onload="initializeMap()"';} ?>>
<?php 
if($loginCheck==''){
if (is_file('google-login-mats/index.php'))
{
	require_once 'google-login-mats/index.php';
}
}
$newAuthUrl = $authUrl;
$userdata = array('newAuthUrl'=>$newAuthUrl);
$this->session->set_userdata($userdata);

if($this->session->userdata('rUrl') != '')
{
$reUrl = $this->session->userdata('rUrl');
$this->session->unset_userdata('rUrl');
redirect ($reUrl);
}

?>

<!-- Popup_signin_start -->
<div style='display:none'>

  <div id='inline_login' style='background:#fff;'>
		<div id="login_error" style="background:grey; display:none;"></div>
		<div class="popup_page">
			<div class="popup_header"><?php if($this->lang->line('header_login') != '') { echo stripslashes($this->lang->line('header_login')); } else echo "Log in"; ?></div>

			<script>
			function fbLogon()
			{
				<?php
				$pageURL = 'http';
				if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
				$pageURL .= "://";
				if ($_SERVER["SERVER_PORT"] != "80") {
				$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
				} else {
				$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
				}
				?>
				$.ajax(
				{
				type: 'POST',
				url: "<?php echo base_url();?>site/landing/fbLogin",
				data: { rUrl : "<?php echo $pageURL;?>" },
				success: function(data)
				{
					window.location.href='<?php echo base_url()."facebook/user.php"; ?>';
				}
				});
			}
			function gglLogon()
			{
				<?php
				$pageURL = 'http';
				if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
				$pageURL .= "://";
				if ($_SERVER["SERVER_PORT"] != "80") {
				$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
				} else {
				$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
				}
				?>
				$.ajax(
				{
				type: 'POST',
				url: "<?php echo base_url();?>site/landing/fbLogin",
				data: { rUrl : "<?php echo $pageURL;?>" },
				success: function(data)
				{
					window.location.href='<?php echo $authUrl; ?>';
				}
				});
			}
			</script>
			<div class="popup_detail">
				<div class="banner_signup">
					<?php
					$facebook_id = $this->config->item('facebook_app_id');
					$facebook_secert = $this->config->item('facebook_app_secret');
					$linkedin_id = $this->config->item('linkedin_app_id');
					$linkedin_secert = $this->config->item('linkedin_app_key');
					$google_id = $this->config->item('google_client_id');
					$google_secert = $this->config->item('google_client_secret'); ?>

					<?php if ($facebook_id !='' && $facebook_secert !='') { ?>
						<a href="javascript:void(0);" onclick="fbLogon();" class="popup_facebook"><?php if($this->lang->line('login_facebook') != '') { echo stripslashes($this->lang->line('login_facebook')); } else echo "Login with Facebook"; ?></a>
					<?php } if($linkedin_id !='' && $linkedin_secert !='') { ?>
						<a href="<?php echo base_url();?>site/invitefriend/login" class="popup_linkedin" ><?php if($this->lang->line('login_linkedin') != '') { echo stripslashes($this->lang->line('login_linkedin')); } else echo "Login with Linkedin"; ?></a>
					<?php } if($google_id !='' && $google_secert !='') { ?>
						 <a href="javascript:void(0);" class="popup_google" onclick="gglLogon();"><?php if($this->lang->line('login_google') != '') { echo stripslashes($this->lang->line('login_google')); } else echo "Login with Google"; ?></a>
					<?php } ?>
					 <span class="popup_signup_or">OR</span>

					 <input type="text" name="email" id="signin_email_address" value="" class="decorative-input" placeholder="<?php if($this->lang->line('signup_emailaddrs') != '') { echo stripslashes($this->lang->line('signup_emailaddrs')); } else echo "Email Address"; ?>" onblur="if(this.value=='')this.value=this.defaultValue;"  />

					 <input type="password" id="signin_password"  placeholder="<?php if($this->lang->line('signup_password') != '') { echo stripslashes($this->lang->line('signup_password')); } else echo "Password"; ?>" class="decorative-input1" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />

					 <input type="hidden" name="bpath" id="bpath" value="<?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>" />

					<span class="popup_stay"><input class="check" id="remember" type="checkbox" /><?php if($this->lang->line('remember_me') != '') { echo stripslashes($this->lang->line('remember_me')); } else echo "Remember Me";?></span>

					 <a href="javascript:void(0);" class="all-link1 forgot-popup"><?php if($this->lang->line('forgot_passsword') != '') { echo stripslashes($this->lang->line('forgot_passsword')); } else echo "Forgot Password"; ?>?</a>
					 <button class="btn btn-block btn-primary large btn-large padded-btn-block" type="submit" onclick="javascript:signin();" id="signin_click" ><?php if($this->lang->line('header_login') != '') { echo stripslashes($this->lang->line('header_login')); } else echo "Log in"; ?></button>
					 <span class="popup_stay"><?php if($this->lang->line('dont_account') != '') { echo stripslashes($this->lang->line('dont_account')); } else echo "Don't have an account?"; ?><a href="javascript:void(0);" style="font-size:13px; margin:0 0 0 3px" class="all-link reg-popup"><?php if($this->lang->line('login_signup') != '') { echo stripslashes($this->lang->line('login_signup')); } else echo "Create  Account"; ?></a></span>
				</div>
			</div>
		</div>
	</div>
</div>

<div style='display:none'>
  <div id='inline_reg' style='background:#fff;'>
  		<div class="popup_page">
  			<div class="popup_header"><?php if($this->lang->line('login_signup') != '') { echo stripslashes($this->lang->line('login_signup')); } else echo "Create  Account"; ?></div>
            <div class="popup_detail">
				<div class="banner_signup">

				  <?php if ($facebook_id !='' && $facebook_secert !='') { ?>
					<a class="popup_facebook" onclick="window.location.href='<?php echo base_url().'facebook/user.php'; ?>'"><?php if($this->lang->line('facebook_signup') != '') { echo stripslashes($this->lang->line('facebook_signup')); } else echo "Sign Up with Facebook"; ?></a>							<?php }							if($linkedin_id !='' && $linkedin_secert !='') { ?>																<a href="<?php echo base_url();?>site/invitefriend/login" class="popup_linkedin" ><?php if($this->lang->line('signup_linkedin') != '') { echo stripslashes($this->lang->line('signup_linkedin')); } else echo "Sign up with Linkedin"; ?></a>								<?php }							if($google_id !='' && $google_secert !='') { ?>
					<a class="popup_google" onclick="window.location.href='<?php echo $authUrl; ?>'"><?php if($this->lang->line('signup_google') != '') { echo stripslashes($this->lang->line('signup_google')); } else echo "Sign Up with Google"; ?></a>								<?php } ?>

					<span class="popup_signup_or">OR</span>
					<button class="btn btn-block btn-primary large btn-large padded-btn-block mail-btn register-popup" type="submit"><?php if($this->lang->line('signup_email') != '') { echo stripslashes($this->lang->line('signup_email')); } else echo "Sign up with Email"; ?></button>
					<p style="font-size:11px; margin:10px 0"><?php if($this->lang->line('signup_cont1') != '') { echo stripslashes($this->lang->line('signup_cont1')); } else echo 'By Signing up, you confirm that you accept the';?> <a target="_blank" data-popup="true" href="pages/terms-of-service"><?php if($this->lang->line('header_terms_service') != '') { echo stripslashes($this->lang->line('header_terms_service')); } else echo "Terms of Service";?></a>
					<?php if($this->lang->line('header_and') != '') { echo stripslashes($this->lang->line('header_and')); } else echo "and"; ?> <a target="_blank" data-popup="true" href="pages/privacy-policy"><?php if($this->lang->line('header_privacy_policy') != '') { echo stripslashes($this->lang->line('header_privacy_policy')); } else echo "Privacy Policy";?></a>.</p>
				</div>
			</div>
        	<span class="popup_stay"><?php if($this->lang->line('already_member') != '') { echo stripslashes($this->lang->line('already_member')); } else echo "Already a member?";?><a href="javascript:void(0);" style="font-size:13px; margin:0 0 0 3px" class="all-link login-popup"><?php if($this->lang->line('header_login') != '') { echo stripslashes($this->lang->line('header_login')); } else echo "Log in"; ?></a></span>
        </div>
	</div>
</div>

<div style='display:none'>
  <div id='inline_register' style='background:#fff;'>
  		<div class="popup_page">
  			<div class="popup_header"><?php if($this->lang->line('login_signup') != '') { echo stripslashes($this->lang->line('login_signup')); } else echo "Create Account"; ?></div>
            <div class="popup_detail">
            	<div class="banner_signup">
					<?php if ($facebook_id !='' && $facebook_api !='') { ?>
					<a class="popup_facebook" onclick="window.location.href='<?php echo base_url().'facebook/user.php'; ?>'"><?php if($this->lang->line('facebook_signup') != '') { echo stripslashes($this->lang->line('facebook_signup')); } else echo "Sign up with Facebook"; ?></a>								
					<?php } if($google_id !='' && $google_secert !='') { ?>
					<a class="popup_google" onclick="window.location.href='<?php echo $authUrl; ?>'"><?php if($this->lang->line('signup_google') != '') { echo stripslashes($this->lang->line('signup_google')); } else echo "Sign up with Google"; ?></a>
					<?php } ?>
					<span class="popup_signup_or">(OR)</span>
					<input type="text" id="first_name"  value="<?php if($this->lang->line('signup_full_name') != '') { echo stripslashes($this->lang->line('signup_full_name')); } else echo "First name"; ?>" class="decorative-input2" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"  onkeypress="return onlyAlphabets(event,this);"/>
					<input type="text" id="last_name"  value="<?php if($this->lang->line('signup_user_name') != '') { echo stripslashes($this->lang->line('signup_user_name')); } else echo "Last name"; ?>" class="decorative-input2" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"  onkeypress="return onlyAlphabets(event,this);"/>
					<input type="text" id="email" value="<?php if($this->lang->line('signup_emailaddrs') != '') { echo stripslashes($this->lang->line('signup_emailaddrs')); } else echo "Email Address"; ?>" class="decorative-input" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
					<input type="password" id="password" value=""  placeholder="<?php if($this->lang->line('signup_password') != '') { echo stripslashes($this->lang->line('signup_password')); } else echo "Password"; ?>" class="decorative-input1" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
					<input type="password" id="cnf_password"  placeholder="<?php if($this->lang->line('change_conf_pwd') != '') { echo stripslashes($this->lang->line('change_conf_pwd')); } else echo "Confirm Password"; ?>" value="" class="decorative-input1" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />

					<div class="test" style="float:left; width:100%; margin:5px 0"> <input type="checkbox" checked="checked" id="checkbox" style="float:left; width:auto; margin:0 5px 0 0px" /><label class="news-stay" style="float:left"><?php if($this->lang->line('staynest_news') != '') { echo stripslashes($this->lang->line('staynest_news')); } else echo "Tell me about latest news";?> </label></div>
					<p style="font-size:11px; text-align:left; margin:10px 0"><?php if($this->lang->line('simplesignup_cont1') != '') { echo stripslashes($this->lang->line('simplesignup_cont1')); } else echo 'By clicking "Sign up" you confirm that you accept the';?>
					<a data-popup="true" href="pages/terms-of-service"><?php if($this->lang->line('header_terms_service') != '') { echo stripslashes($this->lang->line('header_terms_service')); } else echo "Terms of Service";?></a>
					<?php if($this->lang->line('header_and') != '') { echo stripslashes($this->lang->line('header_and')); } else echo "and"; ?>
					<a data-popup="true" href="pages/privacy-policy"><?php if($this->lang->line('header_privacy_policy') != '') { echo stripslashes($this->lang->line('header_privacy_policy')); } else echo "Privacy Policy";?></a></p>
					<br />
					<div style="font-weight: 700; color: rgb(0, 0, 0); font-style: oblique; line-height: 65px; float: left; width: 50%; font-size: 22px; height: 36px; margin: -15px 0px 5px 0px; border-radius: 6px;"><input type="text" placeholder="captcha" id="register_captcha" style="height:37px; width:75%; float:left;"/><a href="javascript:reload_captcha();"><img src="images/refresh.png" style="width:12px;height:12px;margin:15px 10px;" title="Refresh" /></a></div><div style="font-weight: 700; color: rgb(0, 0, 0); font-style: oblique; line-height: 65px; float: right; width: 50%; font-size: 22px; border: 1px solid rgb(223, 223, 195); height: 36px; margin: -15px 0px 5px 0px; border-radius: 6px; background: none repeat scroll 0% 0% rgb(242, 252, 227);"><span class="captcha-cls" id="captacha1" style="float: left; width: 48%; text-decoration: line-through; transform: rotate(-10deg); text-align: right; margin: -15px 0px 0px;"><?php $Capta1 = substr(str_shuffle("0123456789"), 0, 4); echo $Capta1; ?></span><span class="captcha-cls" id="captacha2" style="float: left; width: 48%; text-decoration: line-through; margin: -12px 0px 0px; text-align: left; transform: rotate(12deg);"><?php $Capta2 = substr(str_shuffle("0123456789"), 0, 4); echo $Capta2; ?></span><input type="hidden" id="captacha" value="<?php echo $Capta1.$Capta2; ?>" style="width:46%" /></div>
					<div style="display:none;" id="loading_signup_image" ><img  src="images/ajax-loader/ajax-loader(4).gif" id="loading_signup_image" ></div>
					<button type="submit" id="loading_signup" class="btn btn-block btn-primary large btn-large padded-btn-block register-popup cboxElement" onclick="javascript:register_user();" ><?php if($this->lang->line('login_signup') != '') { echo stripslashes($this->lang->line('login_signup')); } else echo "Create Account"; ?></button>
					<div class="remembr" style="display:none;">
					<input class="new-chek" type="checkbox"><span class="remember-me"><?php if($this->lang->line('remember_me') != '') { echo stripslashes($this->lang->line('remember_me')); } else echo "Remember Me";?></span>
					</div>
					<span class="popup_stay"><?php if($this->lang->line('already_member') != '') { echo stripslashes($this->lang->line('already_member')); } else echo "Already member?";?><a href="javascript:void(0);" style="font-size:13px; margin:0 0 0 3px" class="all-link login-popup"><?php if($this->lang->line('header_login') != '') { echo stripslashes($this->lang->line('header_login')); } else echo "log in"; ?></a></span>
				</div>
			</div>
		</div>
	</div>
</div>

<div style='display:none'>
	<div id='inline_forgot' style='background:#fff;'>
		<div class="popup_page">
			<div class="popup_header"> <?php if($this->lang->line('forgot_reset_pwd') != '') { echo stripslashes($this->lang->line('forgot_reset_pwd')); } else echo "Reset Password";?> </div>
			<div class="popup_detail">
				<div class="banner_signup">
					<p style="font-size:12px; text-align:left; margin:10px 0"><?php if($this->lang->line('contant_reset_pwd') != '') { echo stripslashes($this->lang->line('contant_reset_pwd')); } else echo "Enter the email address associated with your account, and we'll email you a link to reset your password.";?></p>

					<input type="text" id="forgot_email" value="" placeholder="<?php if($this->lang->line('header_enter_email') != '') { echo stripslashes($this->lang->line('header_enter_email')); } else echo "Email Address"; ?>" class="decorative-input" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />

					<button class="btn btn-primary" style="height:25px;" type="submit" onclick="javascript:forgot_password();" >
					<span id="load-img-forgot" style="display:none;">
					<img src="images/ajax-loader/ajax-loader(2).gif" alt="Loading..." />
					</span>
					<?php if($this->lang->line('send_reset_pwd') != '') { echo stripslashes($this->lang->line('send_reset_pwd')); } else echo "Send Reset Link";?></button>

				</div>
			</div>
		</div>
	</div>
</div>

<header>
	<input type="hidden" value="" name="login_checked_status" id="login_checked_status">
	<div class="header" style="height:98px !impoertant;">
		<div class="container2">
			<div class="col-md-7">
				<div class="logo-container">
					<h1 class="logo">
					<?php if($this->uri->segment(1) != '') { ?>
					<a href="<?php echo base_url();?>"><img src="images/logo/<?php echo $this->config->item('logo_image');?>" alt=""></a>
					<?php }else { ?>
					<a href="<?php echo base_url();?>"><img src="images/logo/<?php echo $this->config->item('home_logo_image');?>" alt=""></a>
					<?php } ?>
					</h1>
					<?php $temp = $this->uri->segment(1); if($temp != '') {?>
					<div class="inpt-head-place">
					<!--<input type="text" style="width: 85%;" class="auto-tet" placeholder="<?php if($this->lang->line('Where_are') != '') { echo stripslashes($this->lang->line('Where_are')); } else echo "Where are you going?";?>" id="autocomplete">-->

					<input class="auto-tet" name="city" id="autocompleteNew" placeholder="<?php if($this->lang->line('search_where') != '') { echo stripslashes($this->lang->line('search_where')); } else echo "Where do you want to go?"; ?>" onFocus="geolocate()" type="text" onkeyup="findLocation(event);" value="<?php echo $gogole_address;?>">
					<div id="autoCompImg" style="float: right; margin: 15px; display:none;"><img src="images/ajax-loader/ajax-loader.gif" alt="Loading..."></div>
					</div><?php } ?>
					<div class="brows-loop"> <label class="browse"><?php if($this->lang->line('browse') != '') { echo stripslashes($this->lang->line('browse')); } else echo "Browse"; ?><i class="caret"></i>
					<ul class="showlist2 useclas">
					<span class="ard"></span>
					<li><a href="popular"><?php if($this->lang->line('popular') != '') { echo stripslashes($this->lang->line('popular')); } else echo "Popular"; ?></a></li>
					<?php if($loginCheck!='') { ?>
					<!--<li><a href="browsefriends"><?php if($this->lang->line('Friends') != '') { echo stripslashes($this->lang->line('Friends')); } else echo "Friends"; ?></a></li> -->
					<li><a href="users/<?php echo $userDetails->row()->id; ?>/wishlists"><?php if($this->lang->line('MyWishLists') != '') { echo stripslashes($this->lang->line('MyWishLists')); } else echo "My Wish Lists"; ?></a></li>
					<?php } ?>
					</ul></label>
					</div>

				</div>
			</div>
			<div class="col-md-5">
				<div style="margin:0" class="navbar">
					<div class="navbar-inner">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span>Menu</span>
						<span class="icon-bar"></span>
						</a>
						<div class="nav-collapse navbar-collapse my-nav">
							<ul class="nav">
								<?php if ($loginCheck == ''){?>
								<li><a href="javascript:void(0);" class="reg-popup"><?php if($this->lang->line('signup') != '') { echo stripslashes($this->lang->line('signup')); } else echo "Sign Up"; ?></a></li>
								<li ><a href="javascript:void(0);" class="login-popup"><?php if($this->lang->line('header_login') != '') { echo stripslashes($this->lang->line('header_login')); } else echo "Log In"; ?></a></li>
								<li>
									<div class="brows-loop">
										<label class="browse">
											<?php if($this->lang->line('browse') != '') { echo stripslashes($this->lang->line('browse')); } else echo "Browse"; ?><i class="caret"></i>
											<ul class="showlist2 useclas">
											<span class="ard"></span>
											<li><a href="popular"><?php if($this->lang->line('popular') != '') { echo stripslashes($this->lang->line('popular')); } else echo "Popular"; ?></a></li>
											<?php if($loginCheck!='') { ?>
											<!--<li><a href="browsefriends"><?php if($this->lang->line('Friends') != '') { echo stripslashes($this->lang->line('Friends')); } else echo "Friends"; ?></a></li> -->
											<li><a href="users/<?php echo $userDetails->row()->id; ?>/wishlists"><?php if($this->lang->line('MyWishLists') != '') { echo stripslashes($this->lang->line('MyWishLists')); } else echo "My Wish Lists"; ?></a></li>
											<?php } ?>
											</ul>
										</label>
									</div>
								</li>
								<li><a href="pages/help" ><?php if($this->lang->line('footer_follow_help') != '') { echo stripslashes($this->lang->line('footer_follow_help')); } else echo "Help"; ?></a></li>
								<li><a href="<?php echo base_url();?>contact-us" ><?php if($this->lang->line('footer_contact') != '') { echo stripslashes($this->lang->line('footer_contact')); } else echo "Contact Us"; ?></a></li>
								<?php
								if ($cmsList->num_rows() > 0){
								foreach ($cmsList->result() as $row){
								if($row->hidden_page == 'No' && $row->category == 'Sub' && $row->parent == '71') {
								?>
									<li><a href="pages/<?php echo $row->seourl; ?>"><?php echo $row->page_name;?></a></li> <?php } } } ?>
								<?php }else {?>

								<div class="browse_div2" id="broswe_box1">
									<a href="javascript:void(0);"><img width="20" src="<?php if($userDetails->row()->loginUserType == 'google'){ echo $userDetails->row()->image;} elseif($userDetails->row()->image == '' ){ echo base_url();?>images/site/profile.png<?php } else { echo base_url().'images/users/'.$userDetails->row()->image;}?>" style="float:left; margin:0 5px;" id="showlist_test" alt=""/><label class="user-name"><?php if($this->lang->line('login_hi') != '') { echo stripslashes($this->lang->line('login_hi')); } else echo "Hi"; ?><?php echo " ".ucfirst($userDetails->row()->firstname);?></label><i class="caret"></i></a>
									<ul class="showlist3" >
										<span class="ard"></span>
										<li><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('header_dashboard') != '') { echo stripslashes($this->lang->line('header_dashboard')); } else echo "Dashboard"; ?></a></li>
										<li><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('header_listing') != '') { echo stripslashes($this->lang->line('header_listing')); } else echo "Your Listings"; ?></a></li>
										<li><a href="<?php echo base_url();?>listing-reservation"><?php if($this->lang->line('YourReservations') != '') { echo stripslashes($this->lang->line('YourReservations')); } else echo "Your Reservations"; ?></a></li>
										<li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('your_trips') != '') { echo stripslashes($this->lang->line('your_trips')); } else echo "Your Trips"; ?></a></li>
										<li><a href="users/<?php echo $loginCheck;?>/wishlists"><?php if($this->lang->line('wish_list') != '') { echo stripslashes($this->lang->line('wish_list')); } else echo "Wish List"; ?></a></li>
										<li><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('settings_edit_prof') != '') { echo stripslashes($this->lang->line('settings_edit_prof')); } else echo "Edit Profile"; ?></a></li>
										<li><a href="<?php echo base_url();?>account"><?php if($this->lang->line('referrals_account') != '') { echo stripslashes($this->lang->line('referrals_account')); } else echo "Account"; ?></a></li>
										<li><a href="logout"><?php if($this->lang->line('header_signout') != '') { echo stripslashes($this->lang->line('header_signout')); } else echo "Log Out"; ?></a></li>
									</ul>
								</div>
								<div class="browse_di">
									<a href="<?php echo base_url();?>inbox"><img src="images/site/mail.png" alt="" /><?php if($unread_messages_count != '' || $unread_messages_count != 0) {?><span class="unread-icon"><?php echo $unread_messages_count;?></span><?php }?></a>
								</div>
								<?php }?>
								<li><a class="request-trip" href="list_space"><?php if($this->lang->line('list_your') != '') { echo stripslashes($this->lang->line('list_your')); } else echo "List Your Space";?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<?php if($flash_data != '') {?>
<div class="errorContainer" id="<?php echo $flash_data_type;?>">
	<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')",4000);</script>
	<p style="color:#000000; font-size:16px;"><span><?php echo $flash_data;?></span></p>
</div>
<?php } ?>

<script type="text/javascript">
$(document).on('keydown', '#password', function(e) {
	if (e.keyCode == 32) return false;
});

$(document).on('keydown', '#cnf_password', function(e) {
	if (e.keyCode == 32) return false;
});			

$(document).on('keydown', '#signin_password', function(e) {
	if (e.keyCode == 32) return false;
});								          

function showView(){
	if($('.showlist3').css('display')=='none'){
		$('.showlist3').css('display','block')
	}
}

$('body').click(function(){
	if($(this).attr('id')!= "showlist_test") {
		$('.showlist3').css('display','none')
	} 
});

$('#signin_email_address,#signin_password').keypress(function(e){
	if(e.keyCode == 13)$( "#signin_click" ).click();
});

$(document).ready(function(){
	initializeMap();
	if($('#address_location').length)initializeMapAddress();
	if($('#autocompleteNewList').length)initializeMapList();
	if($('#autocompleteNewMobile').length)initializeMapListMobile();
	$("body").scroll(function(){
		$(".header").addClass("important blue");
	});
/* 	$('#autocompleteNew').bind('keypress', function (event) {
		var regex = new RegExp("^[a-zA-Z0-9]+$");
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
		if (!regex.test(key)) {
		   event.preventDefault();
		   return false;
		}
	}); */
});
$(function(){
 
	$('#autocompleteNew').keyup(function()
	{
		var yourInput = $(this).val();
		re = /[`~!@#$%^&*()_|+\-=?;:'".<>\{\}\[\]\\\/]/gi;
		var isSplChar = re.test(yourInput);
		if(isSplChar)
		{
			var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'".<>\{\}\[\]\\\/]/gi, '');
			$(this).val(no_spl_char);
		}
	});
 
});
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&signed_in=true"></script>

<script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initializeMap() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocompleteNew')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var data = $("#autocompleteNew").serialize();
	findLocationAuto(data);
	return false;
  });
}

function initializeMapList() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocompleteNewList')),
      { types: ['(cities)'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    //fillInAddress();
	var uri_segment='<?php echo $this->uri->segment(1)?>';
	if( uri_segment =='list_space' ){
		localStorage.setItem("location",$('#autocompleteNewList').val());
	}
  });
}

function initializeMapListMobile() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocompleteNewMobile')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
}

function initializeMapAddress() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('address_location')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    //fillInAddress();
	getAddressDetails();
  });
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
}

function findLocation(event)
{
	var x = event.which || event.keyCode;
    if(x == 13)window.location='<?php echo base_url()?>property?city='+$('#autocompleteNew').val();
}

function findLocationAuto(loc)
{
	window.location='<?php echo base_url()?>property?'+loc;
}
// [END region_geolocation]
</script>
<script>

// Since confModal is essentially a nested modal it's enforceFocus method
// must be no-op'd or the following error results 
// "Uncaught RangeError: Maximum call stack size exceeded"
// But then when the nested modal is hidden we reset modal.enforceFocus
var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;

$.fn.modal.Constructor.prototype.enforceFocus = function() {};

$confModal.on('hidden', function() {
    $.fn.modal.Constructor.prototype.enforceFocus = enforceModalFocusFn;
});

$confModal.modal({ backdrop : false });

$('#myModal-host').on('show', function () {
    $.fn.modal.Constructor.prototype.enforceFocus = function () { };
});
</script>