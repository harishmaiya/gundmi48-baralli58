<?php 
$this->load->view('site/templates/header');	
?>

<!---DASHBOARD-->
<div class="dashboard yourlisting dash-home bgcolor">

<div class="top-listing-head">
 <div class="main">   
            <ul id="nav">
                <li class="active"><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('Dashboard') != '') { echo stripslashes($this->lang->line('Dashboard')); } else echo "Dashboard";?></a></li>
                <li><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></li>
                <li><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
          <!-- <li><a href="<?php echo base_url();?>user/<?php echo $userDetails->row()->id; ?>/wishlists">Wishlists</a></li> -->      
                <li><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul> </div></div>
  <div class="main">
      <div id="command_center">
    
            <ul id="nav">
                <li class="active"><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('Dashboard') != '') { echo stripslashes($this->lang->line('Dashboard')); } else echo "Dashboard";?></a></li>
                <li><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
               <?php /*?><li><a href="<?php echo base_url();?>rental/<?php echo $userDetails->row()->id;?>">Your Listing</a></li><?php */?>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></li>
                <li><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
                <li><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul>
<div class="clearfix" id="dashboard">
              <div id="left">


                <div class="box" id="user_box">
                  <div class="middle">
                    <div id="user_pic">
                      <div class="_pm_container">
        
       
              
                        <a title="View Profile" href="users/show/<?php echo $userDetails->row()->id; ?>"><img width="209" height="209" title="<?php echo $userDetails->row()->firstname; echo $userDetails->row()->loginUserType?> " src="<?php if($userDetails->row()->loginUserType == 'google'){ echo $userDetails->row()->image;} elseif($userDetails->row()->image == '' ){ echo base_url();?>images/site/profile.png<?php } else { echo base_url().'images/users/'.$userDetails->row()->image;}?>" alt="<?php echo $userDetails->row()->firstname;?>"></a>
                      <a href="photo-video" class="upload-photo"><i></i><span><?php if($this->lang->line('uploadprofilephoto') != '') { echo stripslashes($this->lang->line('uploadprofilephoto')); } else echo "upload profile photo";?></span></a>
        
        </div>            </div>
                    <h2>
                      <label style="cursor:text"><?php echo ucfirst($userDetails->row()->firstname);?></label>
                       <!--<a href="users/show/<?php echo $userDetails->row()->id; ?>"><?php echo ucfirst($userDetails->row()->firstname);?></a>-->
                    </h2>
                    <p>
                      <a href="users/show/<?php echo $userDetails->row()->id;?>"><?php if($this->lang->line('ViewProfile') != '') { echo stripslashes($this->lang->line('ViewProfile')); } else echo "View Profile";?></a>
                    </p>

                    <div class="bulid-prof"><a href="settings"><?php if($this->lang->line('buildyourprofile') != '') { echo stripslashes($this->lang->line('buildyourprofile')); } else echo "build your profile";?></a></div>
                  </div>
                </div>
        
              
        
                <div class="box" id="quick_links">
                  <div class="middle">
                    <h3 class="box-header"><?php if($this->lang->line('QuickLinks') != '') { echo stripslashes($this->lang->line('QuickLinks')); } else echo "Quick Links";?></h3>
                    <ul class="unstyled">
                        <li><a href="<?php echo base_url()."listing/all";?>"><?php if($this->lang->line('View_ManageListing') != '') { echo stripslashes($this->lang->line('View_ManageListing')); } else echo "View/Manage Listing";?></a></li>
                        <li><a href="<?php echo base_url()."listing-reservation";?>"><?php if($this->lang->line('Reservations') != '') { echo stripslashes($this->lang->line('Reservations')); } else echo "Reservations";?></a></li>
                        <li><a href="display-review"><?php if($this->lang->line('Reviews') != '') { echo stripslashes($this->lang->line('Reviews')); } else echo "Reviews";?></a></li>
                    </ul>
                  </div>
                </div>
        
                  <div class="box" id="snapshot">
                    <div class="middle">
                      <h3 class="box-header">Snapshot</h3>
                      <ul class="unstyled">
                        <li class="clearfix">
                        <div class="stat_name">All Page Views</div>
                        <div class="stat_value">
                          0
                        </div>
                        </li>
                      </ul>
                    </div>
                  </div>
        
              </div>
        
              <div class="dashboard-right" id="main">





               








              <div id="account">
			  <?php if($userDetails->row()->paypal_email == '' || $userDetails->row()->id_verified =='No'){ ?>
              <div class="box">
              <div class="middle">
             
              <h2><?php if($this->lang->line('Alerts') != '') { echo stripslashes($this->lang->line('Alerts')); } else echo "Alerts";?></h2>
              <div class="section notification_section">
              <div class="notification_area">
              <div class="notification_action" >
              <?php if($userDetails->row()->paypal_email == ''){?>
			  <a target="_blank" class="dashboard_alert_link" href="account-payout"><?php if($this->lang->line('Pleasetellus') != '') { echo stripslashes($this->lang->line('Pleasetellus')); } else echo "Please tell us how to pay you.";?><i class="icon icon-caret-right"></i></a>
				<?php } ?>
              <div class="conformation-mail"  <?php if($userDetails->row()->paypal_email != ''){?> style="border:none !important;" <?php } ?>>
			   <?php
			 // echo $userDetails->row()->is_verified;
			  if($userDetails->row()->id_verified =='No'){ ?>
              <?php if($this->lang->line('Pleaseconfirm') != '') { echo stripslashes($this->lang->line('Pleaseconfirm')); } else echo "Please confirm your email address by clicking on the link we just emailed you. If you cannot find the email, you can";?>
			 
			  <a href="site/user/dashboard_resend_confirm_mail"><?php if($this->lang->line('requestanew') != '') { echo stripslashes($this->lang->line('requestanew')); } else echo "request a new confirmation email";?></a>
        or
			
          <a href="settings"><?php if($this->lang->line('changeyouremailaddress') != '') { echo stripslashes($this->lang->line('changeyouremailaddress')); } else echo "change your email address";?></a>.
		  <?php  }
			  ?>
        
			</div>

              </div>
              </div>
              </div>
             
             
              </div>
              </div>
			  <?php } ?>









            <div class="box" style="display:none">
              <div class="middle">
              
              
              <div class="section notification_section nwli">
              <div class="notification_area">
              <div class="notification_action">
              <div class="noti-left">

                
                <p class="invote-text"><?php if($this->lang->line('Invitefriendsearn') != '') { echo stripslashes($this->lang->line('Invitefriendsearn')); } else echo "Invite friends, earn travel credit!";?>  </p>
                <p> Earn up to $6,151 for everyone you invite. </p>

              </div>
                <div class="noti-right">
                   <a class="invite-frd-btn" href="invite-friends"><?php if($this->lang->line('InviteFriends') != '') { echo stripslashes($this->lang->line('InviteFriends')); } else echo "Invite Friends";?></a>


                </div>

    

              </div>
              </div>
              </div>
              
             
              </div>
              </div>


<?php 
				 $result = 0;
				 if($userDetails->row()->id != '') {
				 $this->db->select('*');
				 $this->db->from(MED_MESSAGE);
				 $this->db->where('receiverId',$userDetails->row()->id);
				 $this->db->where('msg_read','No');
                 $this->db->group_by('bookingNo');
				 $result = $this->db->get()->num_rows();
				 //echo $this->db->last_query();die;
				 }?>





              <div class="box">
              <div class="middle">
            
              <h2><?php if($this->lang->line('Messages') != '') { echo stripslashes($this->lang->line('Messages')); } else echo " New Messages";?> (<?php echo $result;?>)</h2>
              <div class="section notification_section">
              <div class="notification_area">
              <div class="notification_action">
			  <?php if ($result > 0 ) {?>
              <table>
			  <tr height="25"><th style="color:red; font-size:14px;"><?php if($this->lang->line('Youhavereceived') != '') { echo stripslashes($this->lang->line('Youhavereceived')); } else echo "You have Received";?> <?php echo $result; ?> <?php if($this->lang->line('newmessages') != '') { echo stripslashes($this->lang->line('newmessages')); } else echo "New Message(s)";?> --> <a href="<?php echo base_url().'inbox';?>"><?php if($this->lang->line('viewmessage') != '') { echo stripslashes($this->lang->line('viewmessage')); } else echo "view message";?></a></th></tr>
			  </table>
			  <?php }
			  else
			  {?>
			  <p><?php if($this->lang->line('Nomessagesto') != '') { echo stripslashes($this->lang->line('Nomessagesto')); } else echo "No New Messages to show";?></p>
			  <?php }?>
			  </div>
              </div>
              </div>
             
             
              </div>
              </div>

                  







                      <div class="box">
              <div class="middle">
             
              <h2 class="verifi-text"><?php if($this->lang->line('Verifications') != '') { echo stripslashes($this->lang->line('Verifications')); } else echo "Verifications";?> <i class="questn"><span class="verifi"><?php if($this->lang->line('Verificationshelp') != '') { echo stripslashes($this->lang->line('Verificationshelp')); } else echo "Verifications help build trust between guests and hosts and can make booking easier.";?> <i class="arsd-ico rot"></i><a href="#"><?php if($this->lang->line('Learnmore') != '') { echo stripslashes($this->lang->line('Learnmore')); } else echo "Learn more";?> »</a></span></i></h2>
              <div class="section notification_section">
              <div class="notification_area">
              <div class="notification_action viewd">
              
              <p class="nothing"> 

 
                   
              <h5><?php if($this->lang->line('EmailAddressVerification') != '') { echo stripslashes($this->lang->line('EmailAddressVerification')); } else echo "Email Address Verification";?></h5>
			  
         <?php
			 // echo $userDetails->row()->is_verified;
			  if($userDetails->row()->id_verified =='No'){ ?>
          <?php if($this->lang->line('Pleaseverifyyour') != '') { echo stripslashes($this->lang->line('Pleaseverifyyour')); } else echo "Please verify your email address by clicking the link in the message we just sent to:";?> <?php echo $userDetails->row()->email; ?>

<?php if($this->lang->line('Cantfind') != '') { echo stripslashes($this->lang->line('Cantfind')); } else echo "Can’t find our message? Check your spam folder or resend the confirmation email.";?>
<?php }?>

<?php //echo '<pre>'; print_r($user_verified_status->row()->id_verified);

   $verified_id = ($userDetails->row()->id_verified =='No')?"No verifications yet":"Verified";  ?>
 <br />
              <?php echo $verified_id;  ?>
              
      
            
           
        </p>

        <div class="no-veri">
       <!--<span>No verifications yet</span>-->
       <a href="verification"><?php if($this->lang->line('AddMore') != '') { echo stripslashes($this->lang->line('AddMore')); } else echo "Add More";?> </a>

        </div>

             

              </div>
              </div>
              </div>
             
             
              </div>
              </div>




              </div>

  </div>
              <div class="clear"></div>
            </div>
  </div>
    </div>
</div>
<!---DASHBOARD-->

<!---FOOTER-->
<?php

$this->load->view('site/templates/footer');
?>

