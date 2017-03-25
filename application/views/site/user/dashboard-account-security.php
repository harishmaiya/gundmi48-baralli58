<?php 
$this->load->view('site/templates/header');
?>
<?php 
		//$Change_pwd=$this->user_model->get_all_details(USERS,array('id'=>$loginCheck));
		//echo '<pre>';print_r($Change_pwd->row()->loginUserType);die;
//echo $loginCheck; die;?>
<!---DASHBOARD-->
<div class="dashboard  yourlisting bgcolor account acc-security">

  <div class="top-listing-head">
 <div class="main">   
            <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('Dashboard') != '') { echo stripslashes($this->lang->line('Dashboard')); } else echo "Dashboard";?></a></li>
                <li><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></li>
                <li><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
                <li class="active"><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul> </div></div>
	<div class="main">
    	<div id="command_center">
    
              <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('Dashboard') != '') { echo stripslashes($this->lang->line('Dashboard')); } else echo "Dashboard";?></a></li>
                <li><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></li>
                <li><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
                <li class="active"><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul>  
            <ul class="subnav">
                <li><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Notifications') != '') { echo stripslashes($this->lang->line('Notifications')); } else echo "Notifications";?></a></li>
				<li><a href="<?php echo base_url();?>account-payout"><?php if($this->lang->line('PayoutPreferences') != '') { echo stripslashes($this->lang->line('PayoutPreferences')); } else echo "Payout Preferences";?></a></li>
				<li><a href="<?php echo base_url();?>account-trans"><?php if($this->lang->line('TransactionHistory') != '') { echo stripslashes($this->lang->line('TransactionHistory')); } else echo "Transaction History";?></a></li>
                <!-- <li><a href="<?php echo base_url();?>referrals">Referrals</a></li>-->
                <!--<li><a href="<?php echo base_url();?>account-privacy"><?php if($this->lang->line('Privacy') != '') { echo stripslashes($this->lang->line('Privacy')); } else echo "Privacy";?></a></li>-->
				<li class="active"><a href="<?php echo base_url();?>account-security"><?php if($this->lang->line('Security') != '') { echo stripslashes($this->lang->line('Security')); } else echo "Security";?></a></li>
				<li><a href="<?php echo base_url();?>account-setting"><?php if($this->lang->line('Settings') != '') { echo stripslashes($this->lang->line('Settings')); } else echo "Settings";?></a></li>            
            

            <a class="invitefrds" href="#" style="display:none"><?php if($this->lang->line('InviteFriendspage') != '') { echo stripslashes($this->lang->line('InviteFriendspage')); } else echo "Invite Friends page";?></a>

            
          </ul>
            	<div id="account">
    <div class="box">
      <div class="middle">
        <form method="post" action="site/user/change_password1" accept-charset="UTF-8" id="changePassword1" autocomplete="off" ><div style="margin:0;padding:0;display:inline"></div>
          <h2><?php if($this->lang->line('ChangeYourPassword') != '') { echo stripslashes($this->lang->line('ChangeYourPassword')); } else echo "Change Your Password";?></h2>
          <div class="section notification_section">
            <div class="notification_area">
            
              <div class="notification_action">


                <input type="hidden" value="<?php echo $userDetails->row()->email;?>" name="id" id="id">
               
                <table class="password-fields">
                    <tbody>
					
					<tr>
					
					<td width=200><?php if($this->lang->line('OldPassword') != '') { echo stripslashes($this->lang->line('OldPassword')); } else echo "Old Password";?>:<span style="color:#FF0000">*</span></td>
					
					<td><input autocomplete="off" type="password" style="width:150px;margin:3px;" name="old_password" id="old_password" class="space_restric">
                    </td>
					
					
					
					</tr>
								  
				  <tr style="margin-top:0px;">
					<td></td>
					<td><div id="old_password_warn"  style="float:right; color:#FF0000; line-height: 30px; margin: 0 0 0 16px;"></div></td>
				  </tr>
				  
				  <tr>
				  
				  <td><?php if($this->lang->line('NewPassword') != '') { echo stripslashes($this->lang->line('NewPassword')); } else echo "New Password";?>:<span style="color:#FF0000">*</span></td>
				  
				  <td><input autocomplete="off" type="password" style="width:150px;margin:3px;" size="30" name="new_password" id="new_password" onkeyup="return CheckPasswordStrength(this.value);" class="space_restric" >
				  
                   
				   </td>

				   
				   </tr>
				   
				   
				   <tr style="margin-top:0px;">
					<td></td>
					<td><div id="new_password_warn1" style="float:right; color:#FF0000; line-height: 30px; margin: 0px 0 0 16px;"></div></td>
				  </tr>
				  
				  <tr style="margin-top:0px;">
					<td></td>
					<td><div id="new_password_warn"  style="float:right; color:#FF0000; line-height: 30px; margin: 0px 0 0 16px;"></div></td>
				  </tr>
				   
				   
                  <tr>
				  
				  <td><?php if($this->lang->line('change_conf_pwd') != '') { echo stripslashes($this->lang->line('change_conf_pwd')); } else echo "Confirm Password";?>:<span style="color:#FF0000">*</span></td>
				  
				  <td><input autocomplete="off" type="password" style="width:150px;margin:3px;" size="30" name="confirm_password" id="confirm_password" class="space_restric">
                   </td>
				   
				   
				   
				   </tr>
				   
				   <tr style="margin-top:0px;">
					<td></td>
					<td><div id="confirm_password_warn"  style="float:right;color:#FF0000; line-height: 30px; margin: 0 0 0 16px;"></div></td>
				  </tr>
				   
                </tbody>
				
				</table>
              </div>
            </div>
            <div class="buttons">
              <input type="submit" value="<?php if($this->lang->line('UpdatePassword') != '') { echo stripslashes($this->lang->line('UpdatePassword')); } else echo "Update Password";?>" onclick="return ChangePassword();" name="commit" class="updatepaswd">
            </div>
          </div>
</form>
       

        <div class="clearfix"></div>
      </div>
    </div>
  </div>
         
  </div>
    </div>
</div>



<script type="text/javascript">
     $(document).on('keydown', '.space_restric', function(e) {
            if (e.keyCode == 32) return false;
                });	

function CheckPasswordStrength(password) { 
        var password_strength = document.getElementById("new_password_warn1");
 $('#new_password_warn').html('');
        //TextBox left blank.
        if (password.length == 0) {
            password_strength.innerHTML = "";
            return;
        }
 
        //Regular Expressions.
        var regex = new Array();
        regex.push("[A-Z]"); //Uppercase Alphabet.
        regex.push("[a-z]"); //Lowercase Alphabet.
        regex.push("[0-9]"); //Digit.
        regex.push("[$@$!%*#?&]"); //Special Character.
 
        var passed = 0;
 
        //Validate for each Regular Expression.
        for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(password)) {
                passed++;
            }
        }
 
        //Validate for length of Password.
        if (passed > 2 && password.length > 8) {
            passed++;
        }
 
        //Display status.
        var color = "";
        var strength = ""; 
        switch (passed) {
            case 0:
            case 1:
                strength = "Weak";
                color = "red";
                break;
            case 2:
                strength = "Good";
                color = "darkorange";
                break;
            case 3:
            case 4:
                strength = "Strong";
                color = "green";
                break;
            case 5:
                strength = "Very Strong";
                color = "darkgreen";
                break;
        }
        /*  $("#new_password_warn").html(strength);  
        $("#new_password_warn").css('color',color);  */
		password_strength.innerHTML = strength;
        password_strength.style.color = color;
		 
    }
				
</script>
<!---DASHBOARD-->
<!---FOOTER-->
<?php 

$this->load->view('site/templates/footer');
?>