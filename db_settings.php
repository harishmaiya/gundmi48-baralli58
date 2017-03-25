<?php 
ob_start();
if(session_id() == '') {
	session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INSTALLATION</title>
<style>
@font-face {
    font-family: 'gibson-regular';
    src: url('fonts/gibson-regular.eot');
    src: url('fonts/gibson-regular.eot') format('embedded-opentype'),
         url('fonts/gibson-regular.woff') format('woff'),
         url('fonts/gibson-regular.ttf') format('truetype'),
         url('fonts/gibson-regular.svg#gibson-regular') format('svg');
}

body{
	margin:0;
	padding:0;
	background:#f2f2f2;
}
.main
{
	width:940px;
	margin:0 auto
}
.install_form
{
	float:left;
	width:100%;
}
.form_box{
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	border-radius:5px;
	padding:40px 25px;
	background:#FFFFFF;
	border:1px solid #c9c9c9;
	box-shadow:2px 1px 8px 2px #e9e9e6;
	-moz-box-shadow:2px 1px 8px 2px #e9e9e6;
	-webkit-box-shadow:2px 1px 8px 2px #e9e9e6;
	margin-bottom: 10px;
}
.form_field
{
	display: inline-block;
    margin: 0 0 20px;
    text-align: center;
    width: 100%;
}
.form_field label
{
	color:#373D48;
	font-size:18px;
	font-family: 'gibson-regular';
	width:18%;
	display:inline-block;
	float: left;
	text-align: left;
	margin-left: 25%;
	line-height:33px;
}
.instal_text
{
	border: 1px solid #DFDFDF;
   border-radius: 3px 3px 3px 3px;
   font-family: sans-serif;
   font-size: 15px;
   line-height: 20px;
   padding:5px 2px;
 	width:30%;
	display:inline-block;
	float: left;
	margin-bottom: 20px;	
}
.instal_text:hover{
	box-shadow:2px 1px 8px 2px #e9e9e6 inset;
	-moz-box-shadow:2px 1px 8px 2px #e9e9e6 inset;
	-webkit-box-shadow:2px 1px 8px 2px #e9e9e6 inset;
}
.instal_btn
{
	display:inline-block;
	width:150px;
	border-radius:4px;
	background:#373D48;
	color:#FFF;
	font-family: 'gibson-regular';
	border:none;
	padding:10px 0;
	cursor:pointer;
	font-size:14px;
	font-weight:bold;
	box-shadow:0 0 5px #000000;
	-moz-box-shadow:0 0 5px #000000;
	-webkit-box-shadow:0 0 5px #000000;
	letter-spacing:1px;
	margin-left:27px;
}
.instal_btn:hover
{
	color:#FFF;
	background:#000;
}
.form_field span
{
	display:inline-block;
	font-size:12px;
	font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;
	float: left;
	font-style: italic;
	font-size: 11px;
	margin-left: 5px;
	color: green;
}
.form_field span.error_msg{
	color: red;
	font-weight: bold;
	display:none;
}
.clear{
	clear:both;
}
.errorCon{
	float: left;
	width: 100%;
	text-align: center;
	color: red;
	font-weight: bold;
	font-size: 17px;
}
</style>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
function hideErrDiv(){
	$('.errorCon').hide();
}
</script>
</head>
<body style="margin:0; padding:0">
	<div class="main">
    	<div  style="text-align:center; width:940px; margin:50px 0 20px 0;background-color: black;margin-bottom: 0px;">
        	<a href="#" style="margin:10px 0 0;"><img src="<?php echo base_url();?>images/logo/admin_logo.png" /></a>
        </div>
	<div class="main">
    	<div class="install_form">
    	<?php 
    	if (isset($_SESSION['errorMSG']) && $_SESSION['errorMSG']!=''){
    	?> 
    		<div class="errorCon">
    			<p><?php echo $_SESSION['errorMSG'];?></p>
    			<script>setTimeout(hideErrDiv,5000);</script>
    		</div>
		<?php 
    		unset($_SESSION['errorMSG']);
    	}
    	
		?>    		
            
		
        <div class="form_box">
    		<form action="check_db_connect.php" method="get" onsubmit="return validate_db_form();">
            <div class="form_field">
            	<label>Site Url: </label>
                <input type="text" name="site_url" class="instal_text site_url" />
                <span>The url of your website</span>
                <span class="error_msg">This field is required</span>
            </div>
        	<div class="form_field">
            	<label>DB Host Name : </label>
                <input type="text" name="host_name" class="instal_text host_name" />
                <span>The host name of your database</span>
                <span class="error_msg">This field is required</span>
            </div>
            <div class="form_field">
            	<label>DB User Name : </label>
                <input type="text" name="user_name" class="instal_text user_name" />
                <span>The user name of your database</span>
                <span class="error_msg">This field is required</span>
            </div>
        	<div class="form_field">
            	<label>DB Password : </label>
                <input type="password" name="db_password" class="instal_text db_password" />
                <span>The password of your database</span>
                <span class="error_msg">This field is required</span>
            </div>
            <div class="form_field">
            	<label>Database Name : </label>
                <input type="text" name="db_name" class="instal_text db_name" />
                <span>The name of your database</span>
                <span class="error_msg">This field is required</span>
            </div>
            <div class="form_field">
            	<label>Website Name : </label>
                <input type="text" name="site_name" class="instal_text site_name" />
                <span>The name of your website</span>
                <span class="error_msg">This field is required</span>
            </div>
             <div class="form_field">
            	<label>Admin Name : </label>
                <input type="text" name="admin_name" class="instal_text admin_name" />
                <span>The username of your admin panel</span>
                <span class="error_msg">This field is required</span>
            </div>
        	<div class="form_field">
            	<label>Admin Password : </label>
                <input type="password" name="admin_password" class="instal_text admin_password" />
                <span>The password of your admin panel</span>
                <span class="error_msg">This field is required</span>
            </div>
            <div class="form_field">
            	<label>Admin Email : </label>
                <input type="text" name="admin_email" class="instal_text admin_email" />
                <span>The email of super admin</span>
                <span class="error_msg">This field is required</span>
            </div>
            <div class="clear"></div>
            <div class="form_field">
                <input type="submit" class="instal_btn" value="SUBMIT"/>
            </div>
            </form>
           </div>
        
        </div>
    </div>
    </div>
<script type="text/javascript">
function validate_db_form(){
	$('.error_msg').hide();
	var site_url = $('.site_url').val();
	var hostname = $('.host_name').val();
	var username = $('.user_name').val();
	var pwd = $('.db_password').val();
	var dbname = $('.db_name').val();
	var site_name = $('.site_name').val();
	var admin_name = $('.admin_name').val();
	var admin_pwd = $('.admin_password').val();
	var admin_email = $('.admin_email').val();
	
	if(site_url==''){
		$('.site_url').focus().next().next().show();
		return false;
	}else if(hostname==''){
		$('.host_name').focus().next().next().show();
		return false;
	}else if(username==''){
		$('.user_name').focus().next().next().show();
		return false;
	}else if(dbname==''){
		$('.db_name').focus().next().next().show();
		return false;
	}else if(site_name==''){
		$('.site_name').focus().next().next().show();
		return false;
	}else if(admin_name==''){
		$('.admin_name').focus().next().next().show();
		return false;
	}else if(admin_pwd==''){
		$('.admin_password').focus().next().next().show();
		return false;
	}else if(admin_email==''){
		$('.admin_email').focus().next().next().show();
		return false;
	}
}

</script>    
</body>
</html>
