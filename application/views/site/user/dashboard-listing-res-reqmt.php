<?php 
$this->load->view('site/templates/header');
//var_dump($RequestDetail->row());die;
?>



<!---DASHBOARD-->
<div class="dashboard yourlisting resr-req bgcolor">

<div class="top-listing-head">
 <div class="main">   
            <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('Dashboard') != '') { echo stripslashes($this->lang->line('Dashboard')); } else echo "Dashboard";?></a></li>
                <li><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li class="active"><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></li>
                <li><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
                <li><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul> </div></div>
	<div class="main">


    	<div id="command_center">

        <div class="dashboard-leftmenu">
    
            <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('Dashboard') != '') { echo stripslashes($this->lang->line('Dashboard')); } else echo "Dashboard";?></a></li>
                <li><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li class="active"><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></li>
                <li><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
                <li><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul>    
            <ul class="subnav">
                <li><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('ManageListings') != '') { echo stripslashes($this->lang->line('ManageListings')); } else echo "Manage Listings";?></a></li>
                <li><a href="<?php echo base_url();?>listing-reservation"><?php if($this->lang->line('YourReservations') != '') { echo stripslashes($this->lang->line('YourReservations')); } else echo "Your Reservations";?></a></li>
                <li class="active"><a href="<?php echo base_url();?>listing-requirement"><?php if($this->lang->line('ReservationRequirements') != '') { echo stripslashes($this->lang->line('ReservationRequirements')); } else echo "Reservation Requirements";?></a></li>
                <!--<li><a href="<?php echo base_url();?>listing-booking">Booking</a></li>
                <li><a href="<?php echo base_url();?>listing_enquiry">Enquiry</a></li>-->
            </ul>
          </div>
            

            <div class="dashboard-rightmenu">
            <div class="box" id="requirements">
      <div class="top">&nbsp;</div>
      <div class="middle">
        <h1><?php if($this->lang->line('VerifiedID') != '') { echo stripslashes($this->lang->line('VerifiedID')); } else echo "Verified ID";?></h1>
<form method="post" action="site/user/update_reservation_requirements" id="verification_form" accept-charset="UTF-8">

          <div class="panel-body">
          <input id="id" type="hidden" value="10042418" name="id">
          <p>
          <?php if($this->lang->line('Yourguestswillneed') != '') { echo stripslashes($this->lang->line('Yourguestswillneed')); } else echo "Your guests will need to verify their ID before booking with you.";?>
          <a target="_blank" href="pages/verify_id"> <?php if($this->lang->line('Learn_More') != '') { echo stripslashes($this->lang->line('Learn_More')); } else echo "Learn More";?> </a>
          </p>
          <p> <?php if($this->lang->line('Beforeyoucanrequire') != '') { echo stripslashes($this->lang->line('Beforeyoucanrequire')); } else echo "Before you can require guests to verify their ID, you'll need to verify yours! ";?></p>
		  <?php if($RequestDetail->row()->id_verified != 'yes	'){?>
          <p>
          <a href="verification"><?php if($this->lang->line('VerifyyourID') != '') { echo stripslashes($this->lang->line('VerifyyourID')); } else echo "Verify your ID";?></a>
          <?php if($this->lang->line('toenablethisrequirement') != '') { echo stripslashes($this->lang->line('toenablethisrequirement')); } else echo "to enable this requirement.";?>
          </p>
		  <?php }?>
          <label for="item">
          <input type="hidden" value="0" name="user_preference[require_guest_checkpoint]">
		  <input type="hidden" value="<?php echo $userDetail->row()->id;?>" name="user_id" id="id">
          <input name="verify_id" id="user_preference_require_guest_checkpoint" type="checkbox" value="yes" <?php if($RequestDetail->row()->id_verified=='yes'){ echo 'checked="checked"'; } if($userDetail->row()->is_verified == 'No') echo 'disabled="disabled"'; ?>>
          <?php if($this->lang->line('Requiregueststogo') != '') { echo stripslashes($this->lang->line('Requiregueststogo')); } else echo "Require guests to go through verification";?>
          </label>
          </div>

      <!--<div class="panel-footer">
      <input class="save-social" type="button" onclick="verification_form('<?php echo $RequestDetail->row()->id_verified;?>')" value="<?php if($this->lang->line('ReservationRequirements') != '') { echo stripslashes($this->lang->line('ReservationRequirements')); } else echo "Save Reservation Requirements";?>
      </div>-->
	  
	  </form>









       <!--- <form method="post" action="site/user/update_reservation_requirements" accept-charset="UTF-8">
        <div style="margin:0;padding:0;display:inline">
        </div>
          <div class="section notification_section">
            
              
            <div class="notification_area">
              <div class="notification_header">
                <h3>Verified ID <span class="label label-pink">New</span></h3>
                <h4>Your guests will need to verify their ID before booking with you. <a target="_blank" href="<?php base_url();?>pages/verified-id"> Learn More </a></h4>
              </div>
              <div class="notification_action">
                <label for="item">
                  <input type="checkbox" name="verify_id" id="verify_id" <?php if($RequestDetail->row()->id_verified=='yes'){ echo 'checked="checked"'; } if($userDetail->row()->is_verified == 'No') echo 'disabled="disabled"'; ?>>
                  Require guests to go through verification
                  <p></p>
                  <p>
                    Before you can require guests to verify their ID, you'll need to verify yours!
                    <br>
                    <a href="javascript:void(0);">Verify your ID</a> to enable this requirement.
                  </p>
                </label>
              </div>
            </div>
            <?php if($userDetail->row()->is_verified == 'Yes'){?>
              <div class="notification_area">
                <div class="notification_header">
                  <h3>Phone</h3>
                  <h4>Your guests will have to verify their phone number before booking with you.</h4>
                </div>
                <div class="notification_action">
                  <label for="item">
                  <input type="checkbox" <?php if($RequestDetail->row()->ph_verified=='yes'){ echo 'checked="checked"'; } ?>  name="verify_phone" id="verify_phone">Require guests to verify their phone number</label>
                </div>
              </div>
              <div class="notification_area">
                <div class="notification_header">
                  <h3>Profile Picture</h3>
                  <h4>Your guests will need a profile picture before booking with you.</h4>
                </div>
                <div class="notification_action">
                  <label for="item">
                  <input type="checkbox" <?php if($RequestDetail->row()->profile_picture=='yes'){ echo 'checked="checked"'; } ?> name="profilePicture" id="profilePicture">Require guests to have a profile picture</label>
                </div>
              </div>
              <div class="notification_area">
                <div class="notification_header">
                  <h3>Trip Description</h3>
                  <h4>Require your guests to describe why they are visiting.</h4>
                </div>
                <div class="notification_action">
                  <label for="item">
                  <input type="checkbox" name="tripDesc" <?php if($RequestDetail->row()->trip_description=='yes'){ echo 'checked="checked"'; } ?> id="tripDesc">Require guests to enter a trip description</label>
                </div>
              </div>
			<?php
				}?>
            <div class="buttons">
              <input type="submit" value="Save Reservation Requirements" name="commit" class="btn green">
            </div>
          </div>
</form> -->     </div>
      <div class="bottom">&nbsp;</div>
    </div>
    </div>
           
  </div>
    </div>
</div>
<!---DASHBOARD-->
<script type="text/javascript">
function verification_form(value)
{
if(value=='no')
{
sweetAlert("Oops...", "Please Proceed after Verifing Your Id", "error");
return false;
}
else
{
$('#verification_form').submit();
}

}
</script>
<!---FOOTER--> 
<?php 
$this->load->view('site/templates/footer');
?>