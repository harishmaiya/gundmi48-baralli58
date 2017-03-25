<?php 
$this->load->view('site/templates/header');
?>

<link rel="stylesheet" type="text/css" href="css/colorbox.css" media="all" />
<link href="css/page_inner.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/my-account.css" type="text/css" media="all"/>
<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>

<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/site/jquery.timers-1.2.js"></script>
<script type="text/javascript" src="js/site/jquery.galleryview-3.0-dev.js"></script>
<!-- script added 14/05/2014 -->

<!-- script end -->

<!---DASHBOARD-->
<div class="dashboard yourlisting bgcolor profile-edit">

<div class="top-listing-head">
 <div class="main">   
            <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('header_dashboard') != '') { echo stripslashes($this->lang->line('header_dashboard')); } else echo "Dashboard";?></a></li>
                <li><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></a></li>
                <li class="active"><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
                <li><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul> </div></div>
	<div class="main">
    	<div id="command_center">
        <div class="dashboard-sidemenu">
             <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('Dashboard') != '') { echo stripslashes($this->lang->line('Dashboard')); } else echo "Dashboard";?></a></li>
                <li><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></a></li>
                <li class="active"><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
                <li ><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul> 
            <ul class="subnav">
                <li class="active"><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('EditProfile') != '') { echo stripslashes($this->lang->line('EditProfile')); } else echo "Edit Profile";?></a></li>
				<li ><a href="<?php echo base_url();?>photo-video"><?php if($this->lang->line('photos') != '') { echo stripslashes($this->lang->line('photos')); } else echo "Photos";?></a></li>
				<li ><a href="<?php echo base_url();?>verification"><?php if($this->lang->line('TrustandVerification') != '') { echo stripslashes($this->lang->line('TrustandVerification')); } else echo "Trust and Verification";?></a></li>
                <li ><a href="<?php echo base_url();?>display-review"><?php if($this->lang->line('Reviews') != '') { echo stripslashes($this->lang->line('Reviews')); } else echo "Reviews";?></a></li>
                
				 <a class="invitefrds" href="users/show/<?php echo $userDetails->row()->id; ?>"><?php if($this->lang->line('ViewProfile') != '') { echo stripslashes($this->lang->line('ViewProfile')); } else echo "View Profile";?></a> 
				 
				 
                          
            </ul>
			</div>
			<div class="listiong-areas">
            	<div id="account">
    <div class="box">
	
	
	<?php //echo "<pre>"; print_r($userDetails);die;   ?>
      <div class="middle">
			

         <!-- <h1>Mobile Notifications / Text Messages</h1>-->
         
  				<h1><?php if($this->lang->line('Required') != '') { echo stripslashes($this->lang->line('Required')); } else echo "Required";?></h1>
               <!-- <form name="email_settings" method="post" action="site/user/update_notifications">-->
                 <div class="section notification_section" style="width:100%;">
					 
  	       <div id="div-form" style="border:1px solid #000;">
  		<form class="myform" name="myform" id="profile_settings_form" method="post" action="site/user_settings/changePhoto" enctype="multipart/form-data" onSubmit="return profileUpdate();">
          <ul>
            <li>
		  <label for="user"><?php if($this->lang->line('signup_full_name') != '') { echo stripslashes($this->lang->line('signup_full_name')); } else echo "First Name";?>:</label>
            <input type="text" onkeypress="return onlyAlphabets(event,this);" name="firstname" id="firstname" value="<?php if(!empty($userDetails)) echo $userDetails->row()->firstname; ?>" />
			
           </li> 
		   
		   <li>
            <label for="emailaddress"><?php if($this->lang->line('signup_user_name') != '') { echo stripslashes($this->lang->line('signup_user_name')); } else echo "Last Name:";?>:</label>
            <input type="text" name="lastname" onkeypress="return onlyAlphabets(event,this);" value="<?php if(!empty($userDetails)) echo $userDetails->row()->lastname; ?>" /><br />
            <span class="tips-text"><?php if($this->lang->line('Thisisonlyshared') != '') { echo stripslashes($this->lang->line('Thisisonlyshared')); } else echo "This is only shared once you have a confirmed booking with another user.";?></span>
			</li> 
           
               <li>
            <label for="emailaddress"><?php if($this->lang->line('IAm') != '') { echo stripslashes($this->lang->line('IAm')); } else echo "I Am";?>:<i class="lock"></i></label>
            <select class="gends" id="gender" name="gender">
			<option value="Male" <?php if(!empty($userDetails)){if($userDetails->row()->gender=='Male'){echo 'selected="selected"';}}?>>Male</option>
			<option value="Female" <?php if(!empty($userDetails)){if($userDetails->row()->gender=='Female'){echo 'selected="selected"';}}?>>Female</option>
			<option value="Unspecified" <?php if(!empty($userDetails)){if($userDetails->row()->gender=='Unspecified'){echo 'selected="selected"';}}?>>Unspecified</option>
			</select><br />
            <span class="tips-text"><?php if($this->lang->line('Weusethisdata') != '') { echo stripslashes($this->lang->line('Weusethisdata')); } else echo "We use this data for analysis and never share it with other users.";?></span>
			</li>              
			 <li>
            <label for="emailaddress"><?php if($this->lang->line('BirthDate') != '') { echo stripslashes($this->lang->line('BirthDate')); } else echo "Birth Date";?>:<i class="lock"></i></label>
            <select class="mnths" name="dob_month" id="user_birthdate_2i" class="valid">
<option value="1" <?php if(!empty($userDetails)){if($userDetails->row()->dob_month=='1'){echo 'selected="selected"';}}?> >January</option>
<option value="2" <?php if(!empty($userDetails)){if($userDetails->row()->dob_month=='2'){echo 'selected="selected"';}}?>>February</option>
<option value="3" <?php if(!empty($userDetails)){if($userDetails->row()->dob_month=='3'){echo 'selected="selected"';}}?>>March</option>
<option value="4" <?php if(!empty($userDetails)){if($userDetails->row()->dob_month=='4'){echo 'selected="selected"';}}?>>April</option>
<option value="5" <?php if(!empty($userDetails)){if($userDetails->row()->dob_month=='5'){echo 'selected="selected"';}}?>>May</option>
<option value="6" <?php if(!empty($userDetails)){if($userDetails->row()->dob_month=='6'){echo 'selected="selected"';}}?>>June</option>
<option value="7" <?php if(!empty($userDetails)){if($userDetails->row()->dob_month=='7'){echo 'selected="selected"';}}?>>July</option>
<option value="8" <?php if(!empty($userDetails)){if($userDetails->row()->dob_month=='8'){echo 'selected="selected"';}}?>>August</option>
<option value="9" <?php if(!empty($userDetails)){if($userDetails->row()->dob_month=='9'){echo 'selected="selected"';}}?>>September</option>
<option value="10" <?php if(!empty($userDetails)){if($userDetails->row()->dob_month=='10'){echo 'selected="selected"';}}?>>October</option>
<option value="11" <?php if(!empty($userDetails)){if($userDetails->row()->dob_month=='11'){echo 'selected="selected"';}}?>>November</option>
<option value="12" <?php if(!empty($userDetails)){if($userDetails->row()->dob_month=='12'){echo 'selected="selected"';}}?>>December</option>
</select>


<select class="mnths2" name="dob_date" id="user_birthdate_3i">
<?php
for($i=1;$i<=31;$i++){

echo '<option value="'.$i.'"'; 
if(!empty($userDetails)){if($userDetails->row()->dob_date==$i){echo 'selected="selected"';}}

echo '>'.$i.'</option>';
}


 ?>
</select>

 

<select class="dob21" name="dob_year" id="user_birthdate_1i" class="valid">
<?php 
$current_year=date('Y')-15;
for($i=$current_year;$i > 1920;$i--){

echo '<option value="'.$i.'"'; 
if(!empty($userDetails)){if($userDetails->row()->dob_year==$i){echo 'selected="selected"';}}

echo '>'.$i.'</option>';
}
?>
</select>
<span class="tips-text"><?php if($this->lang->line('Themagicaldayou') != '') { echo stripslashes($this->lang->line('Themagicaldayou')); } else echo "The magical day you were dropped from the sky by a stork. We use this data for analysis and never share it with other users.";?></span>
     </li>          
            
           <!-- <input type="text" placeholder="mm/dd/yyyy" name="datefrom" id="datefrom" class="checkin ui-datepicker-target">-->
            
            <li>
             <label for="emailaddress"><?php if($this->lang->line('signup_emailaddrs') != '') { echo stripslashes($this->lang->line('signup_emailaddrs')); } else echo "Email Address";?>:<i class="lock"></i></label>
            <input type="text" readonly="readonly" name="email" id="email" value="<?php if(!empty($userDetails)) echo $userDetails->row()->email; ?>" /><br />
           <span class="tips-text"><?php if($this->lang->line('Thisisonlyshared') != '') { echo stripslashes($this->lang->line('Thisisonlyshared')); } else echo "This is only shared once you have a confirmed booking with another user.";?></span>
		   </li> 
			
			
			 <li>
			 <label for="emailaddress"><?php if($this->lang->line('PhoneNumber') != '') { echo stripslashes($this->lang->line('PhoneNumber')); } else echo "Phone Number";?>:<i class="lock"></i></label>
			 <?php if($userDetails->row()->ph_verified=='Yes'){?>
				<span class="tips-text">
				<?php if($this->lang->line('PhoneNumberisVerified.') != '') { echo stripslashes($this->lang->line('PhoneNumberisVerified')); } else echo "Phone Number is Verified.";?>
				</span>
				

			 <?php } else { 
			 if($userDetails->row()->phone_no =='') { ?>
            
			<span class="no-numbr"></span>
			
			<?php } } ?>
			
			<div class="phone-number-verify-widget" style="display: block;">
				<div class="pnaw-step1">
					<div id="phone-number-input-widget-64e0b448" class="phone-number-input-widget">
					<label for="phone_country"><?php if($this->lang->line('Chooseacountry') != '') { echo stripslashes($this->lang->line('Chooseacountry')); } else echo "Choose a country";?>:</label>
						<div class="select">
						<select id="phone_country" name="phone_country" onchange="get_mobile_code(this.value)">
						<option value="" >Select</option>
						<?php foreach($active_countries->result() as $active_country) :?>
						<option value="<?php echo $active_country->id;?>" <?php if($userDetails->row()->ph_country == $active_country->id ){ echo "selected";} ?> ><?php echo $active_country->name;?></option>
						<?php endforeach;?>
						</select>
						</div>
						<label for="phone_number"><?php if($this->lang->line('Addaphonenumber') != '') { echo stripslashes($this->lang->line('Addaphonenumber')); } else echo "Add a phone number";?>:</label>
						<div class="pniw-number-container clearfix">
						<div class="pniw-number-prefix">+91</div>
						<input id="phone_number" name="phone_no" class="pniw-number" type="text" maxlength="10" value="<?php if(!empty($userDetails)) echo $userDetails->row()->phone_no; ?>" onkeypress="return isNumber(event)" >
						</div>
					</div>
					<div class="pnaw-verify-container">
						<a class="btn btn-primary" rel="sms" href="javascript:void(0);" id="verify_sms"><?php if($this->lang->line('VerifyviaSMS') != '') { echo stripslashes($this->lang->line('VerifyviaSMS')); } else echo "Verify via SMS";?></a>
						<div id="loading_signup_image" style="text-align:center;display:none;"><img src="images/ajax-loader/ajax-loader(4).gif"></div>
						<a class="why-verify" target="_blank" href="pages/why-verify" style="display:none;"><?php if($this->lang->line('WhyVerify') != '') { echo stripslashes($this->lang->line('WhyVerify')); } else echo "Why Verify?";?></a>
					</div>
				</div>
			</div>

			<div class="phone-number-verify-widget verification_div" style="display: none;">
				<p class="message message_sent"></p>
				<label for="phone_number_verification"><?php if($this->lang->line('Pleaseenterthe') != '') { echo stripslashes($this->lang->line('Pleaseenterthe')); } else echo "Please enter the 6-digit code";?>:</label>
				<input type="text" id="mobile_verification_code">
				<a href="javascript:void(0);" onclick="check_phpone_verification()" rel="verify">
				<?php if($this->lang->line('Verify') != '') { echo stripslashes($this->lang->line('Verify')); } else echo "Verify";?>
				</a>
				<a href="javascript:void(0);" onclick="cancel_verification();">
				<?php if($this->lang->line('Cancel') != '') { echo stripslashes($this->lang->line('Cancel')); } else echo "Cancel";?> 
				</a>

				<p class="arrive"><?php if($this->lang->line('Ifitdoesnt') != '') { echo stripslashes($this->lang->line('Ifitdoesnt')); } else echo "If it doesn't arrive, click cancel and try call verification instead.";?></p>

			</div>
			
			
			
			
			
			
			
			
           
           <span class="tips-text"><?php if($this->lang->line('Thisisonlysharedonce') != '') { echo stripslashes($this->lang->line('Thisisonlysharedonce')); } else echo "This is only shared once you have a confirmed booking with another user. This is how we can all get in touch.";?></span>
		   
		   </li> 
			
			
			
			 <li>
            <label for="emailaddress"><?php if($this->lang->line('WhereYouLive') != '') { echo stripslashes($this->lang->line('WhereYouLive')); } else echo "Where You Live";?>:</label>
            <input type="text"onkeypress="return onlyAlphabets(event,this);" name="s_city" value="<?php if(!empty($userDetails)) echo $userDetails->row()->s_city; ?>" /><br />
            </li> 
			
			
			 <li>
            <label for="comments"><?php if($this->lang->line('DescribeYourself') != '') { echo stripslashes($this->lang->line('DescribeYourself')); } else echo "DescribeYourself";?>:</label>
			<textarea name="description" onkeypress="return onlyAlphabets(event,this);" style="width:500px"><?php if(!empty($userDetails)) echo $userDetails->row()->description; ?></textarea><br />
			<span class="tips-text"><div class="text-muted row-space-top-1">
<?php if($this->lang->line('Weisbuiltonrelationships') != '') { echo stripslashes($this->lang->line('Weisbuiltonrelationships')); } else echo "We is built on relationships. Help other people get to know you.";?>
<br>
<br>
<?php if($this->lang->line('Tellthemabout') != '') { echo stripslashes($this->lang->line('Tellthemabout')); } else echo "Tell them about the things you like: What are 5 things you can’t live without? Share your favorite travel destinations, books, movies, shows, music, food.";?>
<br>
<br>
<?php if($this->lang->line('Tellthemwhat') != '') { echo stripslashes($this->lang->line('Tellthemwhat')); } else echo "Tell them what it’s like to have you as a guest or host: What’s your style of traveling? Of hosting?";?>
<br>
<br>
<?php if($this->lang->line('Dyouhave') != '') { echo stripslashes($this->lang->line('Dyouhave')); } else echo "Tell them about you: Do you have a life motto?";?>
</div></span>
            </li> 
			
			
			
        
        </div> <!-- form befor div closed -->
					
  	       
  			 
          </div>
				   
    <div class="clearfix"></div>
      </div>
    </div>
	
	
	
	
	
	 <div class="box">
	
	
	
      <div class="middle">
			

         <!-- <h1>Mobile Notifications / Text Messages</h1>-->
         
  				<h1><?php if($this->lang->line('Optional') != '') { echo stripslashes($this->lang->line('Optional')); } else echo "Optional";?></h1>
               <!-- <form name="email_settings" method="post" action="site/user/update_notifications">-->
                 <div class="section notification_section" style="width:100%;">
					 
  	       <div id="div-form" style="border:1px solid #000;">
  		
          <ul>
          
			
			
			
			 <li>
            <label for="school"><?php if($this->lang->line('School') != '') { echo stripslashes($this->lang->line('School')); } else echo "School";?>:</label>
			<input type="text" onkeypress="return onlyAlphabets(event,this);" name="school" value="<?php if(!empty($userDetails)) echo $userDetails->row()->school; ?>" /><br />
            
			</li>
			
			
			<li>
            <label for="work"><?php if($this->lang->line('Work') != '') { echo stripslashes($this->lang->line('Work')); } else echo "Work";?>:</label>
			<input type="text" onkeypress="return onlyAlphabets(event,this);" name="work" value="<?php if(!empty($userDetails)) echo $userDetails->row()->work; ?>" /><br />
            </li> 
			
			
			<li>
<label for="timezone" ><?php if($this->lang->line('TimeZone') != '') { echo stripslashes($this->lang->line('TimeZone')); } else echo "Time Zone";?>:</label>
<select name="timezone"  id="user_preference_time_zone">
<option value="">Select</option>
<option value="Pacific/Kwajalein" <?php if($userDetails->row()->timezone=='Pacific/Kwajalein'){?>selected="selected"<?php }?>>(GMT-12:00) International Date Line West</option>
<option value="Pacific/Midway" <?php if($userDetails->row()->timezone=='Pacific/Midway'){?>selected="selected"<?php }?>>(GMT-11:00) Midway Island</option>
<option value="Pacific/Apia" <?php if($userDetails->row()->timezone=='Pacific/Apia'){?>selected="selected"<?php }?>>(GMT-11:00) Samoa</option>
<option value="Pacific/Honolulu" <?php if($userDetails->row()->timezone=='Pacific/Honolulu'){?>selected="selected"<?php }?>>(GMT-10:00) Hawaii</option>
<option value="America/Anchorage" <?php if($userDetails->row()->timezone=='America/Anchorage'){?>selected="selected"<?php }?>>(GMT-09:00) Alaska</option>
<option value="America/Los_Angeles" <?php if($userDetails->row()->timezone=='America/Los_Angeles'){?>selected="selected"<?php }?>>(GMT-08:00) Pacific Time (US & Canada)</option>
<option value="America/Tijuana" <?php if($userDetails->row()->timezone=='America/Tijuana'){?>selected="selected"<?php }?>>(GMT-08:00) Tijuana</option>
<option value="America/Phoenix" <?php if($userDetails->row()->timezone=='America/Phoenix'){?>selected="selected"<?php }?>>(GMT-07:00) Arizona</option>
<option value="America/Chihuahua" <?php if($userDetails->row()->timezone=='America/Chihuahua'){?>selected="selected"<?php }?>>(GMT-07:00) Chihuahua</option>
<option value="America/Mazatlan" <?php if($userDetails->row()->timezone=='America/Mazatlan'){?>selected="selected"<?php }?>>(GMT-07:00) Mazatlan</option>
<option value="America/Denver" <?php if($userDetails->row()->timezone=='America/Denver'){?>selected="selected"<?php }?>>(GMT-07:00) Mountain Time (US & Canada)</option>
<option value="America/Managua" <?php if($userDetails->row()->timezone=='America/Managua'){?>selected="selected"<?php }?>>(GMT-06:00) Central America</option>
<option value="America/Chicago" <?php if($userDetails->row()->timezone=='America/Chicago'){?>selected="selected"<?php }?>>(GMT-06:00) Central Time (US & Canada)</option>
<option value="America/Mexico_City" <?php if($userDetails->row()->timezone=='America/Mexico_City'){?>selected="selected"<?php }?>>(GMT-06:00) Guadalajara</option>
<option value="America/Mexico_City" <?php if($userDetails->row()->timezone=='America/Mexico_City'){?>selected="selected"<?php }?>>(GMT-06:00) Mexico City</option>
<option value="America/Monterrey" <?php if($userDetails->row()->timezone=='America/Monterrey'){?>selected="selected"<?php }?>>(GMT-06:00) Monterrey</option>
<option value="America/Regina" <?php if($userDetails->row()->timezone=='America/Regina'){?>selected="selected"<?php }?>>(GMT-06:00) Saskatchewan</option>
<option value="America/New_York" <?php if($userDetails->row()->timezone=='America/New_York'){?>selected="selected"<?php }?>>(GMT-05:00) Eastern Time (US & Canada)</option>
<option value="America/Indiana/Indianapolis" <?php if($userDetails->row()->timezone=='America/Indiana/Indianapolis'){?>selected="selected"<?php }?>>(GMT-05:00) Indiana (East)</option>
<option value="America/Bogota" <?php if($userDetails->row()->timezone=='America/Bogota'){?>selected="selected"<?php }?>>(GMT-05:00) Bogota</option>
<option value="America/Lima" <?php if($userDetails->row()->timezone=='America/Lima'){?>selected="selected"<?php }?>>(GMT-05:00) Lima</option>
<option value="America/Bogota" <?php if($userDetails->row()->timezone=='America/Bogota'){?>selected="selected"<?php }?>>(GMT-05:00) Quito</option>
<option value="America/Caracas" <?php if($userDetails->row()->timezone=='America/Caracas'){?>selected="selected"<?php }?>>(GMT-04:00) Caracas</option>
<option value="America/Halifax" <?php if($userDetails->row()->timezone=='America/Halifax'){?>selected="selected"<?php }?>>(GMT-04:00) Atlantic Time (Canada)</option>
<option value="Georgetown" <?php if($userDetails->row()->timezone=='Georgetown'){?>selected="selected"<?php }?>>(GMT-04:00) Georgetown</option>
<option value="America/La_Paz" <?php if($userDetails->row()->timezone=='America/La_Paz'){?>selected="selected"<?php }?>>(GMT-04:00) La Paz</option>
<option value="America/Santiago" <?php if($userDetails->row()->timezone=='America/Santiago'){?>selected="selected"<?php }?>>(GMT-04:00) Santiago</option>
<option value="America/St_Johns" <?php if($userDetails->row()->timezone=='America/St_Johns'){?>selected="selected"<?php }?>>(GMT-03:30) Newfoundland</option>
<option value="America/Sao_Paulo" <?php if($userDetails->row()->timezone=='America/Sao_Paulo'){?>selected="selected"<?php }?>>(GMT-03:00) Brasilia</option>
<option value="America/Argentina/Buenos_Aires" <?php if($userDetails->row()->timezone=='America/Argentina/Buenos_Aires'){?>selected="selected"<?php }?>>(GMT-03:00) Buenos Aires</option>
<option value="America/Godthab" <?php if($userDetails->row()->timezone=='America/Godthab'){?>selected="selected"<?php }?>>(GMT-03:00) Greenland</option>
<option value="America/Noronha" <?php if($userDetails->row()->timezone=='America/Noronha'){?>selected="selected"<?php }?>>(GMT-02:00) Mid-Atlantic</option>
<option value="Atlantic/Azores" <?php if($userDetails->row()->timezone=='Atlantic/Azores'){?>selected="selected"<?php }?>>(GMT-01:00) Azores</option>
<option value="Atlantic/Cape_Verde" <?php if($userDetails->row()->timezone=='Atlantic/Cape_Verde'){?>selected="selected"<?php }?>>(GMT-01:00) Cape Verde Is.</option>
<option value="Africa/Casablanca" <?php if($userDetails->row()->timezone=='Africa/Casablanca'){?>selected="selected"<?php }?>>(GMT+00:00) Casablanca</option>
<option value="Europe/London" <?php if($userDetails->row()->timezone=='Europe/London'){?>selected="selected"<?php }?>>(GMT+00:00) Dublin</option>
<option value="Europe/London" <?php if($userDetails->row()->timezone=='Europe/London'){?>selected="selected"<?php }?>>(GMT+00:00) Edinburgh</option>
<option value="Europe/Lisbon" <?php if($userDetails->row()->timezone=='Europe/Lisbon'){?>selected="selected"<?php }?>>(GMT+00:00) Lisbon</option>
<option value="Europe/London" <?php if($userDetails->row()->timezone=='Europe/London'){?>selected="selected"<?php }?>>(GMT+00:00) London</option>
<option value="Africa/Monrovia" <?php if($userDetails->row()->timezone=='Africa/Monrovia'){?>selected="selected"<?php }?>>(GMT+00:00) Monrovia</option>
<option value="Europe/Amsterdam" <?php if($userDetails->row()->timezone=='Europe/Amsterdam'){?>selected="selected"<?php }?>>(GMT+01:00) Amsterdam</option>
<option value="Europe/Belgrade" <?php if($userDetails->row()->timezone=='Europe/Belgrade'){?>selected="selected"<?php }?>>(GMT+01:00) Belgrade</option>
<option value="Europe/Berlin" <?php if($userDetails->row()->timezone=='Europe/Berlin'){?>selected="selected"<?php }?>>(GMT+01:00) Berlin</option>
<option value="Europe/Berlin" <?php if($userDetails->row()->timezone=='Europe/Berlin'){?>selected="selected"<?php }?>>(GMT+01:00) Bern</option>
<option value="Europe/Bratislava" <?php if($userDetails->row()->timezone=='Europe/Bratislava'){?>selected="selected"<?php }?>>(GMT+01:00) Bratislava</option>
<option value="Europe/Brussels" <?php if($userDetails->row()->timezone=='Europe/Brussels'){?>selected="selected"<?php }?>>(GMT+01:00) Brussels</option>
<option value="Europe/Budapest" <?php if($userDetails->row()->timezone=='Europe/Budapest'){?>selected="selected"<?php }?>>(GMT+01:00) Budapest</option>
<option value="Europe/Copenhagen" <?php if($userDetails->row()->timezone=='Europe/Copenhagen'){?>selected="selected"<?php }?>>(GMT+01:00) Copenhagen</option>
<option value="Europe/Ljubljana" <?php if($userDetails->row()->timezone=='Europe/Ljubljana'){?>selected="selected"<?php }?>>(GMT+01:00) Ljubljana</option>
<option value="Europe/Madrid" <?php if($userDetails->row()->timezone=='Europe/Madrid'){?>selected="selected"<?php }?>>(GMT+01:00) Madrid</option>
<option value="Europe/Paris" <?php if($userDetails->row()->timezone=='Europe/Paris'){?>selected="selected"<?php }?>>(GMT+01:00) Paris</option>
<option value="Europe/Prague" <?php if($userDetails->row()->timezone=='Europe/Prague'){?>selected="selected"<?php }?>>(GMT+01:00) Prague</option>
<option value="Europe/Rome" <?php if($userDetails->row()->timezone=='Europe/Rome'){?>selected="selected"<?php }?>>(GMT+01:00) Rome</option>
<option value="Europe/Sarajevo" <?php if($userDetails->row()->timezone=='Europe/Sarajevo'){?>selected="selected"<?php }?>>(GMT+01:00) Sarajevo</option>
<option value="Europe/Skopje" <?php if($userDetails->row()->timezone=='Europe/Skopje'){?>selected="selected"<?php }?>>(GMT+01:00) Skopje</option>
<option value="Europe/Stockholm" <?php if($userDetails->row()->timezone=='Europe/Stockholm'){?>selected="selected"<?php }?>>(GMT+01:00) Stockholm</option>
<option value="Europe/Vienna" <?php if($userDetails->row()->timezone=='Europe/Vienna'){?>selected="selected"<?php }?>>(GMT+01:00) Vienna</option>
<option value="Europe/Warsaw" <?php if($userDetails->row()->timezone=='Europe/Warsaw'){?>selected="selected"<?php }?>>(GMT+01:00) Warsaw</option>
<option value="Africa/Lagos" <?php if($userDetails->row()->timezone=='Africa/Lagos'){?>selected="selected"<?php }?>>(GMT+01:00) West Central Africa</option>
<option value="Europe/Zagreb" <?php if($userDetails->row()->timezone=='Europe/Zagreb'){?>selected="selected"<?php }?>>(GMT+01:00) Zagreb</option>
<option value="Europe/Athens" <?php if($userDetails->row()->timezone=='Europe/Athens'){?>selected="selected"<?php }?>>(GMT+02:00) Athens</option>
<option value="Europe/Bucharest" <?php if($userDetails->row()->timezone=='Europe/Bucharest'){?>selected="selected"<?php }?>>(GMT+02:00) Bucharest</option>
<option value="Africa/Cairo" <?php if($userDetails->row()->timezone=='Africa/Cairo'){?>selected="selected"<?php }?>>(GMT+02:00) Cairo</option>
<option value="Africa/Harare" <?php if($userDetails->row()->timezone=='Africa/Harare'){?>selected="selected"<?php }?>>(GMT+02:00) Harare</option>
<option value="Europe/Helsinki" <?php if($userDetails->row()->timezone=='Europe/Helsinki'){?>selected="selected"<?php }?>>(GMT+02:00) Helsinki</option>
<option value="Europe/Istanbul" <?php if($userDetails->row()->timezone=='Europe/Istanbul'){?>selected="selected"<?php }?>>(GMT+02:00) Istanbul</option>
<option value="Asia/Jerusalem" <?php if($userDetails->row()->timezone=='Asia/Jerusalem'){?>selected="selected"<?php }?>>(GMT+02:00) Jerusalem</option>
<option value="Europe/Kiev" <?php if($userDetails->row()->timezone=='Europe/Kiev'){?>selected="selected"<?php }?>>(GMT+02:00) Kyev</option>
<option value="Europe/Minsk" <?php if($userDetails->row()->timezone=='Europe/Minsk'){?>selected="selected"<?php }?>>(GMT+02:00) Minsk</option>
<option value="Africa/Johannesburg" <?php if($userDetails->row()->timezone=='Africa/Johannesburg'){?>selected="selected"<?php }?>>(GMT+02:00) Pretoria</option>
<option value="Europe/Riga" <?php if($userDetails->row()->timezone=='Europe/Riga'){?>selected="selected"<?php }?>>(GMT+02:00) Riga</option>
<option value="Europe/Sofia" <?php if($userDetails->row()->timezone=='Europe/Sofia'){?>selected="selected"<?php }?>>(GMT+02:00) Sofia</option>
<option value="Europe/Tallinn" <?php if($userDetails->row()->timezone=='Europe/Tallinn'){?>selected="selected"<?php }?>>(GMT+02:00) Tallinn</option>
<option value="Europe/Vilnius" <?php if($userDetails->row()->timezone=='Europe/Vilnius'){?>selected="selected"<?php }?>>(GMT+02:00) Vilnius</option>
<option value="Asia/Baghdad" <?php if($userDetails->row()->timezone=='Asia/Baghdad'){?>selected="selected"<?php }?>>(GMT+03:00) Baghdad</option>
<option value="Asia/Kuwait" <?php if($userDetails->row()->timezone=='Asia/Kuwait'){?>selected="selected"<?php }?>>(GMT+03:00) Kuwait</option>
<option value="Europe/Moscow" <?php if($userDetails->row()->timezone=='Europe/Moscow'){?>selected="selected"<?php }?>>(GMT+03:00) Moscow</option>
<option value="Africa/Nairobi" <?php if($userDetails->row()->timezone=='Africa/Nairobi'){?>selected="selected"<?php }?>>(GMT+03:00) Nairobi</option>
<option value="Asia/Riyadh" <?php if($userDetails->row()->timezone=='Asia/Riyadh'){?>selected="selected"<?php }?>>(GMT+03:00) Riyadh</option>
<option value="Europe/Moscow" <?php if($userDetails->row()->timezone=='Europe/Moscow'){?>selected="selected"<?php }?>>(GMT+03:00) St. Petersburg</option>
<option value="Europe/Volgograd" <?php if($userDetails->row()->timezone=='Europe/Volgograd'){?>selected="selected"<?php }?>>(GMT+03:00) Volgograd</option>

<option value="Asia/Tehran" <?php if($userDetails->row()->timezone=='Asia/Tehran'){?>selected="selected"<?php }?>>(GMT+03:30) Tehran</option>
<option value="Asia/Muscat" <?php if($userDetails->row()->timezone=='Asia/Muscat'){?>selected="selected"<?php }?>>(GMT+04:00) Abu Dhabi</option>
<option value="Asia/Baku" <?php if($userDetails->row()->timezone=='Asia/Baku'){?>selected="selected"<?php }?>>(GMT+04:00) Baku</option>
<option value="Asia/Muscat" <?php if($userDetails->row()->timezone=='Asia/Muscat'){?>selected="selected"<?php }?>>(GMT+04:00) Muscat</option>
<option value="Asia/Tbilisi" <?php if($userDetails->row()->timezone=='Asia/Tbilisi'){?>selected="selected"<?php }?>>(GMT+04:00) Tbilisi</option>
<option value="Asia/Yerevan" <?php if($userDetails->row()->timezone=='Asia/Yerevan'){?>selected="selected"<?php }?>>(GMT+04:00) Yerevan</option>
<option value="Asia/Kabul" <?php if($userDetails->row()->timezone=='Asia/Kabul'){?>selected="selected"<?php }?>>(GMT+04:30) Kabul</option>
<option value="Asia/Yekaterinburg" <?php if($userDetails->row()->timezone=='Asia/Yekaterinburg'){?>selected="selected"<?php }?>>(GMT+05:00) Ekaterinburg</option>
<option value="Asia/Karachi" <?php if($userDetails->row()->timezone=='Asia/Karachi'){?>selected="selected"<?php }?>>(GMT+05:00) Islamabad</option>
<option value="Asia/Karachi" <?php if($userDetails->row()->timezone=='Asia/Karachi'){?>selected="selected"<?php }?>>(GMT+05:00) Karachi</option>
<option value="Asia/Tashkent" <?php if($userDetails->row()->timezone=='Asia/Tashkent'){?>selected="selected"<?php }?>>(GMT+05:00) Tashkent</option>
<option value="Asia/Kolkata" <?php if($userDetails->row()->timezone=='Asia/Kolkata'){?>selected="selected"<?php }?>>(GMT+05:30) Chennai</option>
<option value="Asia/Kolkata" <?php if($userDetails->row()->timezone=='Asia/Kolkata'){?>selected="selected"<?php }?>>(GMT+05:30) Kolkata</option>
<option value="Asia/Kolkata" <?php if($userDetails->row()->timezone=='Asia/Kolkata'){?>selected="selected"<?php }?>>(GMT+05:30) Mumbai</option>
<option value="Asia/Kolkata" <?php if($userDetails->row()->timezone=='Asia/Kolkata'){?>selected="selected"<?php }?>>(GMT+05:30) New Delhi</option>

<option value="Asia/Kathmandu" <?php if($userDetails->row()->timezone=='Asia/Kathmandu'){?>selected="selected"<?php }?>>(GMT+05:45) Kathmandu</option>
<option value="Asia/Almaty" <?php if($userDetails->row()->timezone=='Asia/Almaty'){?>selected="selected"<?php }?>>(GMT+06:00) Almaty</option>
<option value="Asia/Dhaka" <?php if($userDetails->row()->timezone=='Asia/Dhaka'){?>selected="selected"<?php }?>>(GMT+06:00) Astana</option>
<option value="Asia/Dhaka" <?php if($userDetails->row()->timezone=='Asia/Dhaka'){?>selected="selected"<?php }?>>(GMT+06:00) Dhaka</option>
<option value="Asia/Novosibirsk" <?php if($userDetails->row()->timezone=='Asia/Novosibirsk'){?>selected="selected"<?php }?>>(GMT+06:00) Novosibirsk</option>
<option value="Asia/Colombo" <?php if($userDetails->row()->timezone=='Asia/Colombo'){?>selected="selected"<?php }?>>(GMT+06:00) Sri Jayawardenepura</option>
<option value="Asia/Rangoon" <?php if($userDetails->row()->timezone=='Asia/Rangoon'){?>selected="selected"<?php }?>>(GMT+06:30) Rangoon</option>
<option value="Asia/Bangkok" <?php if($userDetails->row()->timezone=='Asia/Bangkok'){?>selected="selected"<?php }?>>(GMT+07:00) Bangkok</option>
<option value="Asia/Bangkok" <?php if($userDetails->row()->timezone=='Asia/Bangkok'){?>selected="selected"<?php }?>>(GMT+07:00) Hanoi</option>
<option value="Asia/Jakarta" <?php if($userDetails->row()->timezone=='Asia/Jakarta'){?>selected="selected"<?php }?>>(GMT+07:00) Jakarta</option>

<option value="Asia/Krasnoyarsk" <?php if($userDetails->row()->timezone=='Asia/Krasnoyarsk'){?>selected="selected"<?php }?>>(GMT+07:00) Krasnoyarsk</option>
<option value="Asia/Hong_Kong" <?php if($userDetails->row()->timezone=='Asia/Hong_Kong'){?>selected="selected"<?php }?>>(GMT+08:00) Beijing</option>
<option value="Asia/Chongqing" <?php if($userDetails->row()->timezone=='Asia/Chongqing'){?>selected="selected"<?php }?>>(GMT+08:00) Chongqing</option>
<option value="Asia/Hong_Kong" <?php if($userDetails->row()->timezone=='Asia/Hong_Kong'){?>selected="selected"<?php }?>>(GMT+08:00) Hong Kong</option>
<option value="Asia/Irkutsk" <?php if($userDetails->row()->timezone=='Asia/Irkutsk'){?>selected="selected"<?php }?>>(GMT+08:00) Irkutsk</option>
<option value="Asia/Kuala_Lumpur" <?php if($userDetails->row()->timezone=='Asia/Kuala_Lumpur'){?>selected="selected"<?php }?>>(GMT+08:00) Kuala Lumpur</option>
<option value="Australia/Perth" <?php if($userDetails->row()->timezone=='Australia/Perth'){?>selected="selected"<?php }?>>(GMT+08:00) Perth</option>
<option value="Asia/Singapore" <?php if($userDetails->row()->timezone=='Asia/Singapore'){?>selected="selected"<?php }?>>(GMT+08:00) Singapore</option>
<option value="Asia/Taipei" <?php if($userDetails->row()->timezone=='Asia/Taipei'){?>selected="selected"<?php }?>>(GMT+08:00) Taipei</option>
<option value="Asia/Irkutsk" <?php if($userDetails->row()->timezone=='Asia/Irkutsk'){?>selected="selected"<?php }?>>(GMT+08:00) Ulaan Bataar</option>
<option value="Asia/Urumqi" <?php if($userDetails->row()->timezone=='Asia/Urumqi'){?>selected="selected"<?php }?>>(GMT+08:00) Urumqi</option>

<option value="Asia/Tokyo" <?php if($userDetails->row()->timezone=='Asia/Tokyo'){?>selected="selected"<?php }?>>(GMT+09:00) Osaka</option>
<option value="Asia/Tokyo" <?php if($userDetails->row()->timezone=='Asia/Tokyo'){?>selected="selected"<?php }?>>(GMT+09:00) Sapporo</option>
<option value="Asia/Seoul" <?php if($userDetails->row()->timezone=='Asia/Seoul'){?>selected="selected"<?php }?>>(GMT+09:00) Seoul</option>
<option value="Asia/Tokyo" <?php if($userDetails->row()->timezone=='Asia/Tokyo'){?>selected="selected"<?php }?>>(GMT+09:00) Tokyo</option>
<option value="Asia/Yakutsk" <?php if($userDetails->row()->timezone=='Asia/Yakutsk'){?>selected="selected"<?php }?>>(GMT+09:00) Yakutsk</option>
<option value="Australia/Adelaide" <?php if($userDetails->row()->timezone=='Australia/Adelaide'){?>selected="selected"<?php }?>>(GMT+09:30) Adelaide</option>
<option value="Australia/Darwin" <?php if($userDetails->row()->timezone=='Australia/Darwin'){?>selected="selected"<?php }?>>(GMT+09:30) Darwin</option>
<option value="Australia/Brisbane" <?php if($userDetails->row()->timezone=='Australia/Brisbane'){?>selected="selected"<?php }?>>(GMT+10:00) Brisbane</option>
<option value="Australia/Sydney" <?php if($userDetails->row()->timezone=='Australia/Sydney'){?>selected="selected"<?php }?>>(GMT+10:00) Canberra</option>
<option value="Pacific/Guam" <?php if($userDetails->row()->timezone=='Pacific/Guam'){?>selected="selected"<?php }?>>(GMT+10:00) Guam</option>
<option value="Australia/Hobart" <?php if($userDetails->row()->timezone=='Australia/Hobart'){?>selected="selected"<?php }?>>(GMT+10:00) Hobart</option>
<option value="Australia/Melbourne" <?php if($userDetails->row()->timezone=='Australia/Melbourne'){?>selected="selected"<?php }?>>(GMT+10:00) Melbourne</option>
<option value="Pacific/Port_Moresby" <?php if($userDetails->row()->timezone=='Pacific/Port_Moresby'){?>selected="selected"<?php }?>>(GMT+10:00) Port Moresby</option>
<option value="Australia/Sydney" <?php if($userDetails->row()->timezone=='Australia/Sydney'){?>selected="selected"<?php }?>>(GMT+10:00) Sydney</option>
<option value="Asia/Vladivostok" <?php if($userDetails->row()->timezone=='Asia/Vladivostok'){?>selected="selected"<?php }?>>(GMT+110:00) Vladivostok</option>
<option value="Asia/Magadan" <?php if($userDetails->row()->timezone=='Asia/Magadan'){?>selected="selected"<?php }?>>(GMT+11:00) Magadan</option>
<option value="Asia/Magadan" <?php if($userDetails->row()->timezone=='Asia/Magadan'){?>selected="selected"<?php }?>>(GMT+11:00) New Caledonia</option>
<option value="Asia/Magadan" <?php if($userDetails->row()->timezone=='Asia/Magadan'){?>selected="selected"<?php }?>>(GMT+11:00) Solomon Is.</option>


<option value="Pacific/Auckland" <?php if($userDetails->row()->timezone=='Pacific/Auckland'){?>selected="selected"<?php }?>>(GMT+12:00) Auckland</option>
<option value="Pacific/Fiji" <?php if($userDetails->row()->timezone=='Pacific/Fiji'){?>selected="selected"<?php }?>>(GMT+12:00) Fiji</option>
<option value="Asia/Kamchatka" <?php if($userDetails->row()->timezone=='Asia/Kamchatka'){?>selected="selected"<?php }?>>(GMT+12:00) Kamchatka</option>
<option value="Pacific/Fiji" <?php if($userDetails->row()->timezone=='Pacific/Fiji'){?>selected="selected"<?php }?>>(GMT+12:00) Marshall Is.</option>

<option value="Pacific/Auckland" <?php if($userDetails->row()->timezone=='Pacific/Auckland'){?>selected="selected"<?php }?>>(GMT+12:00) Wellington</option>
<option value="Pacific/Tongatapu" <?php if($userDetails->row()->timezone=="Pacific/Tongatapu"){?>selected="selected"<?php }?>>(GMT+13:00) Nuku'alofa</option></select>

<span class="tips-text"><?php if($this->lang->line('Yourhometime') != '') { echo stripslashes($this->lang->line('Yourhometime')); } else echo "Your home time zone.";?></span>

</li>

<li>
<label for="emailaddress"><?php if($this->lang->line('Language') != '') { echo stripslashes($this->lang->line('Language')); } else echo "Language";?></label>
<span class="no-numbr">
<?php $languages_known_user=explode(',',$userDetails->row()->languages_known); 
//print_r($languages_known_user); die;
	if($languages_known_user[0] != ''){
		$lancount=count($languages_known_user).' languages';
	} else {
		$lancount="None" ;
	}

?>
<ul>

<li id="countLan"><?php echo $lancount;?> </li>
<li><a  data-toggle="modal" href="#myModal"  class="multiselect-add-more"><i class="icon icon-add"></i><?php if($this->lang->line('AddMore') != '') { echo stripslashes($this->lang->line('AddMore')); } else echo "Add More";?></a></li>
<li><span style="width:100%" class="tips-text"><?php if($this->lang->line('Addlanguages') != '') { echo stripslashes($this->lang->line('Addlanguages')); } else echo "Add languages you speak.";?></span></li>
</ul>

</span>
<?php 
$languages_known_user=explode(',',$userDetails->row()->languages_known);
if(count($languages_known_user)>0)
{ ?>
<ul class="inner_language">
<?php
foreach($languages_known->result() as $language){
if(in_array($language->language_code,$languages_known_user)) {?>
<li id="<?php echo $language->language_code;?>"><?php echo $language->language_name;?><small>
<a class="text-normal" href="javascript:void(0);" onclick="delete_languages(this,'<?php echo $language->language_code;?>')">x</a>
</small></li>
<?php } }?>
</ul>
<?php }?>
</li>


<li>
<button class="btn btn-primary blue" type="submit"><?php if($this->lang->line('Save') != '') { echo stripslashes($this->lang->line('Save')); } else echo "Save";?> </button>
</li>
		
  	       
  			 
          </div>
				</form>    
    <div class="clearfix"></div>
      </div>
    </div>
	
	
  </div>
         
  </div>
   </div>
    </div>
</div>
<!---DASHBOARD-->
<!---FOOTER-->

<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>jquery-ui-1.8.18.custom.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/site/<?php echo SITE_COMMON_DEFINE ?>jquery-ui-1.8.18.custom.css" />
<script type="text/javascript">
	/*jQuery(document).ready( function () {
		$(".datepicker").datepicker({ minDate:0, dateFormat: 'yy-mm-dd'});
	});*/
	
	
	

$(function() {
$( "#datefrom" ).datepicker({
defaultDate: "+1w",
changeMonth: true,
numberOfMonths: 1,
minDate:0,
onClose: function( selectedDate ) {
$( "#expiredate" ).datepicker( "option", "minDate", selectedDate );
}
});
$( "#expiredate" ).datepicker({
defaultDate: "+1w",
changeMonth: true,
numberOfMonths: 1,
minDate:0,
onClose: function( selectedDate ) {
$( "#datefrom" ).datepicker( "option", "maxDate", selectedDate );
}
});
});

/* $(function() {
$( "#datepicker" ).datepicker();
});*/
</script>


		<div id="myModal" class="modal fade in profilepage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		      
		<div class="panel-header">
		<a class="close" aria-hidden="true" data-dismiss="modal" type="button">×</a>
		<?php if($this->lang->line('SpokenLanguages') != '') { echo stripslashes($this->lang->line('SpokenLanguages')); } else echo "Spoken Languages";?>
		</div>
		<div class="panel-body">
		<p><?php if($this->lang->line('Whatlanguages') != '') { echo stripslashes($this->lang->line('Whatlanguages')); } else echo "What languages can you speak fluently? We have many international travelers who appreciate hosts who can speak their language.";?></p>
	<?php //echo '<pre>';print_r($languages_known->result());die;
	//$condition1=array('id'=>'');
	//$get_lang=$this->user_model->get_all_details(USERS,array());
	//echo '<pre>';print_r($get_lang->row());die;?>
		<div class="row-fluid row">
		<div class="span6 col-6" id="ajax_lang">
		<?php $languages_knowns=explode(',',$userDetails->row()->languages_known);?>
	
		<?php $i = 1;foreach($languages_known->result() as $language){ if($i%2 == 1) {?>
          <li>
            <input type="checkbox" <?php if(in_array($language->language_code,$languages_knowns)) {?> checked="checked" <?php }?> name="languages[]" value="<?php echo $language->language_code;?>"
			alt="<?php echo $language->language_name;?>">
           <label><?php echo $language->language_name;?></label>
          </li>
		  <?php //echo '<pre>';print_r($language->languages_known);?>
		  <?php } $i++; } ?>
        </div>
		<div class="span6 col-6" id="ajax_lang1">
		<?php $languages_knowns=explode(',',$userDetails->row()->languages_known);?>
		<?php $i = 1;foreach($languages_known->result() as $language){ if($i%2 == 0) {?>
          <li>
            <input type="checkbox" <?php if(in_array($language->language_code,$languages_knowns)) {?> checked="checked" <?php }?> name="languages[]" value="<?php echo $language->language_code?>"
			alt="<?php echo $language->language_name?>">
           <label><?php echo $language->language_name?></label>
          </li>
		  <?php } $i++; } ?>
        </div>
		</div>
		</div>
		<div class="panel-footer">
		
		<button class="btn btn-primary" data-dismiss="modal" type="button" id="language_ajax"> Save </button>
		<a class="btn btn-default pull-left" data-dismiss="modal" type="button">Close</a>
		
		</div>
		
		
</div><!-- /.modal -->
<script type="text/javascript">

function get_mobile_code(country_id)
{

 $.ajax({
type:'POST',
url:'<?php echo base_url();?>site/twilio/get_mobile_code',
data:{country_id:country_id},
dataType:'json',
success:function(response)
{
$('.pniw-number-prefix').text(response['country_mobile_code']);
//alert(response);
}
});
}
$('.toggle').click(function()
{
$('.emergncy-hide').slideToggle('slow');
});

$('#verify_sms').click(function()
{
var mobile_code=$('.pniw-number-prefix').text();
var phone_number=$('#phone_number').val();
var phone_country=$('#phone_country').val();
$('#verify_sms').hide();
$('#loading_signup_image').show();
if(phone_country =='')
{
sweetAlert("Oops...", "Please choose country", "error");
$('#loading_signup_image').hide();
$('#verify_sms').show();
}
else if(phone_number =='')
{
sweetAlert("Oops...", "Please Enter Phone Number", "error");
$('#loading_signup_image').hide();
$('#verify_sms').show();
}
else if(isNaN(phone_number) || phone_number.length < 9)
{
sweetAlert("Oops...", "Phone Number Should be 10 Digit Number", "error");
$('#loading_signup_image').hide();
$('#verify_sms').show();
}
else{
$.ajax({
type:'POST',
url:'<?php echo base_url();?>site/twilio/product_verification',
data:{phone_no:phone_number,mobile_code:mobile_code,ph_country:phone_country},
success:function(response)
{
	if(response=='success')
	{
		$('#loading_signup_image').hide();
		$('#verify_sms').show();
		sweetAlert("Wow, Great!", "We Have Sent Verification Code to Your Mobile Please Enter Verification Code", "success");
		$('.message_sent').text('We sent a verification code to '+phone_number);
		$('.verification_div').css('display','block');
	}
	else if(response == 'already_verified')
	{
		sweetAlert("Oops...", "Your number already verified", "error");
		$('#loading_signup_image').hide();
		$('#verify_sms').show();
	}
	else if(response == 'your_session_expired')
	{
		sweetAlert("Oops...", "Your session expired", "error");
		$('#loading_signup_image').hide();
		$('#verify_sms').show();
	}
}
});
}
});

function cancel_verification()
{
$('.verification_div').css('display','none');
}

function check_phpone_verification()
{
 mobile_verification_code=$('#mobile_verification_code').val();
$.ajax({
type:'POST',
url:'<?php echo base_url()?>site/product/check_phone_verification',
data:{mobile_verification_code:mobile_verification_code},
success:function(response)
{ 
if(response=='success')
{
sweetAlert("Wow, Great!", "Your Phone Number Verified Successfully.", "success");
window.location.reload(true);
}
else{
sweetAlert("Oops...", "Verification Code Does not match Please enter Correct Code'", "error");
}

}
}); 

}


$(function()
{

$('#language_ajax').click(function()
{

var languages=document.getElementsByName('languages[]');

var languages_known=new Array();
for(var i=0;i<languages.length;i++)
{
if($(languages[i]).is(':checked'))
{
languages_known.push(languages[i].value);
}
}

if(languages_known.length>0)
{

$.ajax({
type:'POST',
url:'<?php echo base_url()?>site/user_settings/update_languages',
data:{languages_known:languages_known},
dataType:'json',

success:function(response)
{
document.getElementById('countLan').innerHTML=response['counts']+' languages';

	$('.inner_language').html(response['value']);
}
});

}
})
});

function delete_languages(elem,language_code)
{
$.ajax({
type:'POST',
url:'<?php echo base_url()?>site/user_settings/delete_languages',
data:{language_code:language_code},
dataType:'json',
success:function(response)
{
if(response['status_code']==1)
{
document.getElementById('countLan').innerHTML=response['counts']+' languages';
$(elem).closest('li').remove();
$('#ajax_lang').html(response['values']);
$('#ajax_lang1').html(response['values1']);
//window.location.reload(true);
}
}
});
}
window.onload=function(){
var country_id = $('#phone_country').val();
if(country_id !='')
{
get_mobile_code(country_id)
}
}
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>  
 
 <!-------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">

$('#phone_number') .bind("keydown", function (event) {
             
    if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
         // Allow: Ctrl+A
        (event.keyCode == 65 && event.ctrlKey === true) || 
         
        // Allow: Ctrl+C
        (event.keyCode == 67 && event.ctrlKey === true) || 
         
        // Allow: Ctrl+V
        (event.keyCode == 86 && event.ctrlKey === true) || 
         
        // Allow: home, end, left, right
        (event.keyCode >= 35 && event.keyCode <= 39)) {
          // let it happen, don't do anything
          return;
    } else {
        // Ensure that it is a number and stop the keypress
        if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
            event.preventDefault(); 
        }   
    }
});
</script>
<script>
//$(document).ready(function(){
	function onlyAlphabets(e, t) {
       try {
           if (window.event) {
               var charCode = window.event.keyCode;
           }
           else if (e) {
               var charCode = e.which;
           }
           else { return true; }
        
           if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 32 || charCode == 9 || charCode == 8 || charCode == 190)
               return true;
           else
               return false;
       }
       catch (err) {
           sweetAlert("Oops...", "err.Description", "error");
       }
   	}
 $(function() {
// Setup form validation on the #register-form element
    $("#profile_settings_form").validate({
 
        // Specify the validation rules
        rules: {
           
            email: {
                required: true,
                email: true
            },
			
        },
 
        // Specify the validation error messages
        messages: {
            
			//email: "Please enter a valid email address",
           
        },
 
        submitHandler: function(form) {
            form.submit();
        }
    });
 
  });
  </script>

 <!-------------------------------------------------------------------------------------------------------------->
<?php 
$this->load->view('site/templates/footer');
?>