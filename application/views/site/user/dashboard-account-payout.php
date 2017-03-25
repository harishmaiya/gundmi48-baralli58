<?php 
$this->load->view('site/templates/header');
?>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>jquery-1.5.1.min"></script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>jquery.colorbox.js"></script>
<script type="text/javascript">
$(document).ready(function(){
			$(".paypal-popup").colorbox({width:"365px", height:"500px", inline:true, href:"#dddddinline_paypal"}); 
      // $("#accno").keydown(function (event) {        
      //   if (!(event.keyCode == 8  || event.keyCode == 9 || event.keyCode == 17 || event.keyCode == 46  || (event.keyCode >= 35 && event.keyCode <= 40) || (event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || (event.keyCode == 65 && prevKey == 17 && prevControl == event.currentTarget.id))) { 
      //     event.preventDefault(); 
      //   } 
      // });
});



        

</script>
<?php 
		$Change_pwd=$this->user_model->get_all_details(USERS,array('id'=>$loginCheck));//echo '<pre>';print_r($Change_pwd->row());die;?>
<div style='display:none'>

<div id='dddddinline_paypal' style='background:#fff;'>
  
  		<div class="popup_page" >
        <img src="<?php echo base_url().'images/site/paypal.png' ?>"  style="margin-top:20px;">
        
       
       <table>
        <tr><td><label> Full Name</label></td></tr>
        <tr><td><input type="text" name="bank_name" id="bank_name" value="<?php echo $userpay->row()->bank_name; ?>" /></td></tr> 
        <tr><td><label> Account Number</label></td></tr>
        <tr><td><input type="text" name="bank_no" id="bank_no" value="<?php echo $userpay->row()->bank_no; ?>" /></td></tr> 
        <tr><td><label> Bank Code</label></td></tr>
        <tr><td><input type="text" name="bank_code" id="bank_code" value="<?php echo $userpay->row()->bank_code; ?>" /></td></tr>
        <tr><td><label> Paypal Email</label></td></tr>
        <tr><td><input type="text" name="paypal_email" id="paypal_email" value="<?php echo $userpay->row()->paypal_email; ?>" /></td></tr>
        <tr><td>
        <button class="btn btn-block btn-primary large btn-large padded-btn-block" type="submit" onclick="javascript:paypaldetail();" >Submit</button>
        
        </td></tr>
       </table>
       
       
        </div>
        
  </div>
  
</div>
<!---DASHBOARD-->
<div class="dashboard  yourlisting bgcolor account acc-payout">

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
                 <li  class="active"><a href="<?php echo base_url();?>account-payout"><?php if($this->lang->line('PayoutPreferences') != '') { echo stripslashes($this->lang->line('PayoutPreferences')); } else echo "Payout Preferences";?></a></li>
                <li><a href="<?php echo base_url();?>account-trans"><?php if($this->lang->line('TransactionHistory') != '') { echo stripslashes($this->lang->line('TransactionHistory')); } else echo "Transaction History";?></a></li>
                <!-- <li><a href="<?php echo base_url();?>referrals">Referrals</a></li>-->
                <!--<li><a href="<?php echo base_url();?>account-privacy"><?php if($this->lang->line('Privacy') != '') { echo stripslashes($this->lang->line('Privacy')); } else echo "Privacy";?></a></li>-->
				<?php if($Change_pwd->row()->loginUserType =='normal'){?>
                <li><a href="<?php echo base_url();?>account-security"><?php if($this->lang->line('Security') != '') { echo stripslashes($this->lang->line('Security')); } else echo "Security";?></a></li>
				<?php }?>
                <li><a href="<?php echo base_url();?>account-setting"><?php if($this->lang->line('Settings') != '') { echo stripslashes($this->lang->line('Settings')); } else echo "Settings";?></a></li>            
            

            <a class="invitefrds" href="#" style="display:none"><?php if($this->lang->line('InviteFriendspage') != '') { echo stripslashes($this->lang->line('InviteFriendspage')); } else echo "Invite Friends page";?></a>

            
          </ul>
            	<div id="account">
    <div class="box">
      <div class="middle">

        <div id="payout_setup">
          
            <h2><?php if($this->lang->line('PayoutMethods') != '') { echo stripslashes($this->lang->line('PayoutMethods')); } else echo "Payout Methods";?></h2>
            
              <a data-toggle="modal" href="#myModal" class="btn btn paypal-popup2 cboxElement2" href="#">
			  <?php if($userpay->row()->paypal_email == ''){ ?>
			  <?php if($this->lang->line('add_payout_method') != '') { echo stripslashes($this->lang->line('add_payout_method')); } else echo "Add Payout Method";?>
			  <?php }else{ ?> 
			   <?php if($this->lang->line('view_payout_method') != '') { echo stripslashes($this->lang->line('view_payout_method')); } else echo "View Payout Method";?>
			  <?php } ?></a>
          
        </div>
        <div id="taxes"></div>
        </div>
      </div> 
    </div>
         
  </div>
    </div>
</div>











<div id="myModal" class="modal fade in payoutprefer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
 
                <div class="modal-header">
                    <a class="" data-dismiss="modal"><span class="">X</span></a>
                    <h4 class="modal-title" id="myModalLabel"><?php if($this->lang->line('AddPayoutDetails') != '') { echo stripslashes($this->lang->line('AddPayoutDetails')); } else echo "Add Payout Details";?></h4>
                </div>
				<form id="payoutform" action="<?php echo base_url(); ?>site/user/account_update" method="post">
				
				<input type="hidden" name="hid" id="hid" value="<?php echo $userpay->row()->id;?>" />
                <div class="modal-body">
                   <table>
                  <tbody>
				   <tr>
                  <td>
                  <label><?php if($this->lang->line('PayPalEmailId') != '') { echo stripslashes($this->lang->line('PayPalEmailId')); } else echo "Paypal E-mail Id";?><span class="req1">*</span></label>
                  </td>
                  </tr>
				  <tr>
                  <td>
                  <input id="paypalemail" type="text" value="<?php echo $userpay->row()->paypal_email;?>" name="paypal_email"class="required email large tipTop"title="Please enter the user email address">
                  </br></br></br><span id="paypal_email_warn"style="color:red;font-size:15px;"></span>
                  <span id="paypal_email_warn2"style="color:red;font-size:15px;"></span>
				  </td>
                  </tr>
				  
                  <tr>
                  <td>
                  <label><?php if($this->lang->line('AccountName') != '') { echo stripslashes($this->lang->line('AccountName')); } else echo "Account Name";?><span class="req1">*</span></label>
                  </td>
                  </tr>
                  <tr>
                  <td>
                  <input id="accname" onkeypress="return CheckIsCharacter(event);" type="text" value="<?php echo $userpay->row()->accname;?>" name="accname">
				  <span id="accname_warn"style="color:red;font-size:15px;"></span>
                  </td>
                  </tr>
                  <tr>
                  <td>
                  <label><?php if($this->lang->line('AccountNumber') != '') { echo stripslashes($this->lang->line('AccountNumber')); } else echo "Account Number";?><span class="req1">*</span></label>
                  </td>
                  </tr>
                  <tr>
                  <td>
                  <input id="accno" type="text" value="<?php echo $userpay->row()->accno;?>" name="accno" onkeypress="return blockSpecialChar(event);">
                   <span id="accno_warn"style="color:red;font-size:15px;"></span>
				  </td>
                  </tr>
                  <tr>
                  <td>
                  <label><?php if($this->lang->line('BankName') != '') { echo stripslashes($this->lang->line('BankName')); } else echo "Bank Name";?><span class="req1">*</span></label>
                  </td>
                  </tr>
                  <tr>
                  <td>
                  <input id="bankname" type="text" name="bankname" value="<?php echo $userpay->row()->bankname;?>">
				   <span id="bankname_warn"style="color:red;font-size:15px;"></span>
                  </td>
                  </tr>
				  
				  
				  
				  
				   <tr>
                  <td>
                  <button style=" margin: 10px 0 0;"  class="btn btn-block btn-primary large btn-large padded-btn-block"  type="button" onclick="validation();"><?php if($this->lang->line('Submit') != '') { echo stripslashes($this->lang->line('Submit')); } else echo "Submit";?></button>
                  </td>
                  </tr>
                  </tbody>
                  </table>
                </div>
				<script type="text/javascript">
          function CheckIsCharacter(objEvt) {
            var charCode = (objEvt.which) ? objEvt.which : event.keyCode;
            if ((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122)) {
                return true;
            }
            else {
                sweetAlert("Oops...", "Enter only alphabets values", "error");
                return false;
            }
          }
          function blockSpecialChar(objEvt) {
             var k = (objEvt.which) ? objEvt.which : event.keyCode;
            if((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8   || (k >= 48 && k <= 57)){
              return true;
            }
            else
              return false; 
        }
				function validation()
				{
				
					var payemail=$('#paypalemail').val();
					var accname=$('#accname').val();
					var bankname=$('#bankname').val();
					var accno=$('#accno').val();
					
					$('#paypal_email_warn').html('');
					$('#accname_warn').html('');
					$('#accno_warn').html('');
					$('#bankname_warn').html('');
					
					if(payemail=='')
					{
					$('#paypal_email_warn').html('Email is required');
					$('#paypalemail').focus();
					return false;
					}
					else if(!IsEmail(payemail))
					{
					$('#paypal_email_warn').html('Enter Valid Email...');
					$('#paypalemail').focus();
					return false;
					}
					else if(accname=='')
					{
					$('#accname_warn').html('account name is required');
					$('#accname').focus();
					return false;
					}
					else if(accno=='')
					{
					$('#accno_warn').html('Account No name is required');
					$('#accno').focus();
					return false;
					}
					else if(bankname=='')
					{
					$('#bankname_warn').html('bankname name is required');
					$('#bankname').focus();
					return false;
					}
					else
					{
					$('#payoutform').submit();
					}
				
				}
				function IsEmail(email) {
				  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				   return regex.test(email);
				}
				
				</script>
                </form>

                </div>
 
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dalog -->
</div><!-- /.modal -->

<style>
    .req1{
	color: red !important;
    padding: 5px;
	}
</style>    

<!---DASHBOARD-->
<!---FOOTER-->
<?php 
$this->load->view('site/templates/footer');
?>