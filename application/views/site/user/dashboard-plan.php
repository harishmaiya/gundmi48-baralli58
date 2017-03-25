<?php 
$this->load->view('site/templates/header');
?>

<script>
function freePackage() {
        
		if(document.getElementById('member_pakage').value.charAt(0) ==3){
		sweetAlert("Oops...", "Amount Not in zero", "error");
		return false; }
		
		else {
		return true; }
}


</script>




<!---DASHBOARD-->
<div class="dashboard">
	<div class="main">
    	<div id="command_center">
    
             <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard">Dashboard</a></li>
                <li><a href="<?php echo base_url();?>inbox">Inbox</a></li>
                <li><a href="<?php echo base_url();?>listing/all">Your Listing</a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming">Your Trips</a></li>
                <li><a href="<?php echo base_url();?>settings">Profile</a></li>
                 <li><a href="<?php echo base_url();?>account">Account</a></li>
                <li  class="active"><a href="#">Plan</a></li>
            </ul> 
           <!-- <ul class="subnav">
                <li class="active"><a href="<?php echo base_url();?>account">Notifications</a></li>
                <li><a href="<?php echo base_url();?>account-payout">Payout Preferences</a></li>
                <li><a href="<?php echo base_url();?>account-trans">Transaction History</a></li>
                <li><a href="<?php echo base_url();?>referrals">Referrals</a></li>
                <li><a href="<?php echo base_url();?>account-privacy">Privacy</a></li>
                <li><a href="<?php echo base_url();?>account-settings">Settings</a></li>            
            </ul>-->
            	<div id="account">
    <div class="box">
      <div class="middle">
			

         <!-- <h1>Mobile Notifications / Text Messages</h1>-->
         <!-- <div class="section notification_section">

        
             <form name="mobile_settings" method="post" action="site/user/update_notifications_mobile">
            <div class="notification_area">
              <div class="notification_header">
               <?php 
                $noty = explode(',', $userDetails->row()->notifications);
                if (is_array($noty)){
                	$notifications = $noty;
                }
                ?>
                <h3>Notify me when:</h3>
                <h4>Applies to both text messages &amp; push notifications.</h4>
              </div>
             
              <div class="notification_action">
                <ul class="unstyled">
                  <li>
                  <input type="checkbox" name="message_another_person" id="message_another_person" <?php if (in_array('message_another_person', $notifications)){echo 'checked="checked"';}?>> 
                  <label for="message_another_person">I receive a message from another person on .</label>
                  </li>
                  <li>
                  <input type="checkbox" name="guest_reservation" id="guest_reservation" <?php if (in_array('guest_reservation', $notifications)){echo 'checked="checked"';}?>> 
                  <label for="guest_reservation">My outstanding reservation request is accepted or declined.</label></li>
                  <li>
                  <input type="checkbox" name="reservation_request" id="reservation_request" <?php if (in_array('reservation_request', $notifications)){echo 'checked="checked"';}?>> 
                  <label for="reservation_request">I receive a reservation request.</label>
                  </li>
                </ul>
              </div>
           
            </div>

            <div class="buttons">
              <input type="hidden" name="user_id" value="<?php $Details->row()->id;?>" />
              <input type="submit" value="Save Mobile Settings" name="commit" class="btn green">
            </div>
          </div>-->
				   <form id="member_paln" name="member_plan" action="site/user/memberPackagePayment" method="post" onsubmit="return freePackage()">
                   <?php if($membershipDetails->row()->name!=''){?>
				   <div>
                   <h1>Plan Information</h1>
               		<h3>Now you are active in <?php echo $membershipDetails->row()->name; ?></h3>
                    <h3>Price <?php echo $currencySymbol.$membershipDetails->row()->price * $this->session->userdata('currency_r'); ?></h3>
                    <h3>Valid until(Month) <?php echo $membershipDetails->row()->valid_date; ?></h3>
                    <h3><?php  $expval ='+'.$membershipDetails->row()->valid_date . " months"; ?></h3>
                    <h3>Purchase Date <?php echo $membershipDetails->row()->member_purchase_date; ?> Expiry Date : <?php echo  date('Y-m-d',
					 strtotime($expval, strtotime($membershipDetails->row()->member_purchase_date))); ?> </h3>
                    </div>  
				  <? }else{?>
				  <h1>Plan Information</h1>
               		<h3>Now you are active in free plan</h3>
				  
				 <? }?>
  				 
               <p>Buy a new plan</p>
               <select id="member_pakage" name="member_pakage"   tabindex="6"  title="Select the Membership" 
               onchange="document.getElementById('plan').value=this.options[this.selectedIndex].text">
			   
			                 
			
                                <option value="">select</option>
		                      		<?php 
		                      		foreach ($membershipplan->result() as $details){
									
		                              ?>
		                      		<option value="<?php echo $details->id;?>"><?php echo $details->name;?>(<?php echo $details->price ;?>)</option>
		                      		<?php }?>
		                           </select>
								
								
								
								
                                <input type="submit" id="planpay" name="planpay" value="PayNow" /> 
                                <input type="hidden" name="plan" id="plan" value="" />
                                <input type="hidden" name="user_id" value="<?php echo $Details->row()->id;?>" />
                                
								
								
								
								
								
								
								
                                </form>
    <div class="clearfix"></div>
   
    </div>
  </div>
         
  </div>
    </div>
</div>
<!---DASHBOARD-->
<!---FOOTER-->
<?php 
$this->load->view('site/templates/content_above_footer');
$this->load->view('site/templates/footer');
?>