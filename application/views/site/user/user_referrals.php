<?php
$this->load->view('site/templates/header');
?>
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
                <li class="active"><a href="<?php echo base_url();?>account">Account</a></li>
                <li><a href="<?php echo base_url();?>plan">Plan</a></li>
            </ul> 
            <ul class="subnav">
                <li><a href="<?php echo base_url();?>account">Notifications</a></li>
                <li><a href="<?php echo base_url();?>account-payout">Payout Preferences</a></li>
                <li><a href="<?php echo base_url();?>account-trans">Transaction History</a></li>
                <li class="active"><a href="<?php echo base_url();?>referrals">Referrals</a></li>
                <li><a href="<?php echo base_url();?>account-privacy">Privacy</a></li>
				<li><a href="<?php echo base_url();?>account-security">Security</a></li> 
                <li><a href="<?php echo base_url();?>account-setting">Settings</a></li>            
            </ul>
            	<div id="account">
    <div class="box">
      <div class="middle">
			
		<?php 
                if(!empty($getReferalList)){
    //            	echo "<pre>";print_r($purchasesList->result());
                ?>	
                <div class=" section gifts">
            <h3><?php if($this->lang->line('referrals_history') != '') { echo stripslashes($this->lang->line('referrals_history')); } else echo "Your referrals history."; ?></h3>
                	<div class="chart-wrap">
            <table class="chart">
                <thead>
                    <tr>
                        <th><?php if($this->lang->line('referrals_image') != '') { echo stripslashes($this->lang->line('referrals_image')); } else echo "image"; ?></th>
                        <th><?php if($this->lang->line('signup_full_name') != '') { echo stripslashes($this->lang->line('signup_full_name')); } else echo "Full Name"; ?></th>
                        <th><?php if($this->lang->line('signup_user_name') != '') { echo stripslashes($this->lang->line('signup_user_name')); } else echo "Username"; ?></th>
                        <th><?php if($this->lang->line('referrals_email') != '') { echo stripslashes($this->lang->line('referrals_email')); } else echo "Email"; ?></th>                       
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getReferalList as $referalList){
                    	$img = 'user-thumb1.png';
                    	if ($referalList['image'] != ''){
                    		$img = $referalList['image'];
                    	}
                    ?>
                    <tr>
                        <td><img src="images/users/<?php echo $img;?>" width="50px"/></td>
                        <td><?php echo $referalList['full_name'];?></td>
                        <td><?php echo $referalList['user_name'];?></td>                        
                        <td><?php echo $referalList['email'];?></td>
                        
                    </tr>
                    <?php }?>
                    
                </tbody>
            </table>
            
			</div>
             <?php echo $paginationLink; ?>
			</div>
           
                <?php	
                }else {
                ?>
               <div class="section referral no-data">
            <span class="icon"><i class="ic-referral"></i></span>
            <p><?php if($this->lang->line('referrals_not_invite') != '') { echo stripslashes($this->lang->line('referrals_not_invite')); } else echo "You haven't invited anyone yet."; ?><br><!-- <a href="#">Invite Friends</a>--></p>
        </div>
                <?php 
                }
                ?>
      </div>
    </div>
  </div>
         
  </div>
    </div>
</div>
<!---DASHBOARD-->
<?php 
$this->load->view('site/templates/content_above_footer');
$this->load->view('site/templates/footer');
?>