<?php 
$this->load->view('site/templates/header');
//print_r($dashboardsent->result());die;

//print_r($user_details);die;
?>

<script type="text/javascript"  src="js/validation.js"></script>

<!---DASHBOARD-->
<div class="dashboard yourlisting inbox bgcolor">

<div class="top-listing-head">
 <div class="main">   
            <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('Dashboard') != '') { echo stripslashes($this->lang->line('Dashboard')); } else echo "Dashboard";?></a></li>
                <li class="active"><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></li>
                <li><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
                <li><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul> </div></div>
	<div class="main">
    	<div style="min-height: 270px;" id="command_center">
    
            <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('Dashboard') != '') { echo stripslashes($this->lang->line('Dashboard')); } else echo "Dashboard";?></a></li>
                <li class="active"><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></li>
                <li><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
                <li><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul>


            


            <div id="page-wrap">
			
 <div id="example-two">
          
        <ul class="nav">
                <li class="nav-one"><a href="<?php echo base_url().'inbox';?>" ><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li class="nav-two"><a href="<?php echo base_url().'sentbox';?>" class="current"><?php if($this->lang->line('Sent') != '') { echo stripslashes($this->lang->line('Sent')); } else echo "Sent";?></a></li>
        </ul>
        
        <div class="list-wrap">
        
          <div id="tab_inbox">
            <div class="box" id="inbox">
                <div class="middle clearfix">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="member_ship datatable" id="productListTable">
                     				  <thead>
 										 <tr><td width="5%" ><strong><?php if($this->lang->line('Sno') != '') { echo stripslashes($this->lang->line('Sno')); } else echo "Sno";?></strong></td>
   										 <td width="13%" ><strong><?php if($this->lang->line('Sender') != '') { echo stripslashes($this->lang->line('Sender')); } else echo "Sender";?></strong></td>
   										 <td width="17%" ><strong><?php if($this->lang->line('Subject') != '') { echo stripslashes($this->lang->line('Subject')); } else echo "Subject";?></strong></td>
   										 <td width="13%" ><strong><?php if($this->lang->line('Date') != '') { echo stripslashes($this->lang->line('Date')); } else echo "Date";?></strong></td>
   										 <td width="10%" ><strong><?php if($this->lang->line('Action') != '') { echo stripslashes($this->lang->line('Action')); } else echo "Action";?></strong></td>
   
 										 </tr>
										 </thead>
                                        <tbody>
                                        <?php 
										
										if($dashboardinbox->num_rows() > 0){
											$c_id=1;
											foreach($dashboardinbox->result() as $InboxStr){?>
											<tr>
                                            <td><?php  echo $c_id; ?></td>
											
											<?php 
									//echo $user_details[$c_id];
$this->data ['userdetail'] = $this->cms_model->get_all_details (USERS, array ('id' => $InboxStr->guide_id));

											?>
											
											
											
											
                                            <td><?php  echo $user_details[$InboxStr->sender_id]; ?></td>
                                            <td><?php echo $InboxStr->message; ?></td>
                                            <td><?php echo $InboxStr->date_created; ?></td>
                                            <td><div class="edit"><a href="site/user_settings/view_inquiry_details/<?php echo $InboxStr->id;?>"><?php if($this->lang->line('viewmessage') != '') { echo stripslashes($this->lang->line('viewmessage')); } else echo "view message";?></a>&nbsp;<a onclick="return confirm('Are you sure want to delete?');" href="site/user_settings/delete_inquiry_details/<?php echo $InboxStr->id;?>">Delete</a></div>
											
											</td>
                                            </tr>
											<?php $c_id=$c_id+1;}
										
										}else{ ?>
											<tr><td colspan="5"><center><?php if($this->lang->line('Nomessagesto') != '') { echo stripslashes($this->lang->line('Nomessagesto')); } else echo "There is no message(s) in inbox";?></center> </td></tr>										
										<?php } ?>
                                        </tbody>
                                        </table>
                                        
                                        
                                        </p>
                  <?php echo $links;?>                            
                              
          </div>
 			 </div>  
          </div>
		  
		   <div id="tab_sent" style="display:none;">
            <div class="box" id="inbox">
                <div class="middle clearfix">
                          <table width="99%" border="0" cellspacing="0" cellpadding="0" class="member_ship" id="productListTable">
                     				  <thead>
 										 <tr><td width="5%" ><strong>Sno</strong></td>
   										 <td width="13%" ><strong>Receiver</strong></td>
   										 <td width="17%" ><strong>Subject</strong></td>
   										 <td width="13%" ><strong>Date</strong></td>
   										 <td width="10%" ><strong>Action</strong></td>
   
 										 </tr>
										 </thead>
                                        <tbody>
                                        <?php 
										
										if($dashboardsent->num_rows() > 0){ 
											$c_id=1;
											foreach($dashboardsent->result() as $InboxStr){?>
											<tr>
                                            <td><?php  echo $c_id; ?></td>
											
											<?php 
											//echo $user_details[$c_id];
//$this->data ['userdetail'] = $this->cms_model->get_all_details (USERS, array ('id' => $InboxStr->guide_id));

											?>
											
											
											
											
                                            <td><?php echo $user_details[$InboxStr->receiver_id]; ?></td>
                                            <td><?php echo $InboxStr->message; ?></td>
                                            <td><?php echo $InboxStr->date_created; ?></td>
                                            <td><div class="edit"><a href="site/user_settings/view_inquiry_details/<?php echo $InboxStr->id;?>"><?php if($this->lang->line('viewmessage') != '') { echo stripslashes($this->lang->line('viewmessage')); } else echo "view message";?></a></div>
											
											</td>
                                            </tr>
											<?php $c_id=$c_id+1;}
										
										}else{
											echo '<tr><td colspan="5"><center>There is no message(s) in inbox</center> </td></tr>';										
										} ?>
                                        </tbody>
                                        </table>
                                        
                                        
                                        </p>
                                              
                    <?php echo $dashboardsent_links;?>          
          </div>
 			 </div>  
          </div>

             
         </div> <!-- END List Wrap -->
     
          </div>     </div> <!-- END Organic Tabs (Example One) -->



 </div>
    </div>
</div>
<!---DASHBOARD-->
<script type="text/javascript">
										
function show_inbox_sent(tab_id)
{

if(tab_id=='tab_inbox')
{
$('#tab_sent').removeClass('hide');
}
else{
$('#tab_inbox').removeClass('hide');
}
};
</script>
<?php 

$this->load->view('site/templates/footer');
?>