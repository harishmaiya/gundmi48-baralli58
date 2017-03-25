<?php 
$this->load->view('site/templates/header');
?>
<?php 
		$Change_pwd=$this->user_model->get_all_details(USERS,array('id'=>$loginCheck));//echo '<pre>';print_r($Change_pwd->row());die;?>
<!---DASHBOARD-->
<div class="dashboard  yourlisting bgcolor account accountid1">
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
			</ul>
		</div>
	</div>
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
				<li  ><a href="<?php echo base_url();?>account-payout"><?php if($this->lang->line('PayoutPreferences') != '') { echo stripslashes($this->lang->line('PayoutPreferences')); } else echo "Payout Preferences";?></a></li>
				<li class="active"><a href="<?php echo base_url();?>account-trans"><?php if($this->lang->line('TransactionHistory') != '') { echo stripslashes($this->lang->line('TransactionHistory')); } else echo "Transaction History";?></a></li>
				<!-- <li><a href="<?php echo base_url();?>referrals">Referrals</a></li>-->
				<!--<li><a href="<?php echo base_url();?>account-privacy"><?php if($this->lang->line('Privacy') != '') { echo stripslashes($this->lang->line('Privacy')); } else echo "Privacy";?></a></li>-->
				<!--<?php if($Change_pwd->row()->loginUserType =='normal'){?>-->
				<li><a href="<?php echo base_url();?>account-security"><?php if($this->lang->line('Security') != '') { echo stripslashes($this->lang->line('Security')); } else echo "Security";?></a></li>
				<!--<?php }?>-->
				<li><a href="<?php echo base_url();?>account-setting"><?php if($this->lang->line('Settings') != '') { echo stripslashes($this->lang->line('Settings')); } else echo "Settings";?></a></li>       
			</ul>
			<div id="transaction_history">
				<div class="box" id="my_listings">
					<div class="middle">
						<div class="tabbable-panel">
							<div class="tabbable-line">
								<ul class="nav nav-tabs ">
									<li class="active">
										<a href="#tab_default_1" data-toggle="tab"><?php if($this->lang->line('CompletedTransactions') != '') { echo stripslashes($this->lang->line('CompletedTransactions')); } else echo "Completed Transactions";?></a>
									</li>
									<li>
										<a href="#tab_default_2" data-toggle="tab"><?php if($this->lang->line('FutureTransactions') != '') { echo stripslashes($this->lang->line('FutureTransactions')); } else echo "Future Transactions";?></a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_default_1">
									<?php //echo "<pre>";print_r($completed_transaction->result());
									if(count($completed_transaction->result()) >0 ) { ?>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" class="member_ship" id="productListTable">
											<thead>
												<tr height="40px">          
													<td width="10%" style="" ><strong><?php if($this->lang->line('Date') != '') { echo stripslashes($this->lang->line('Date')); } else echo "Date";?></strong></td>
													<td width="20%" style=""><strong><?php if($this->lang->line('Transaction_Method') != '') { echo stripslashes($this->lang->line('Transaction_Method')); } else echo "Transaction Method";?></strong></td>
													<td width="15%" style=""><strong><?php if($this->lang->line('TransactionId') != '') { echo stripslashes($this->lang->line('TransactionId')); } else echo "Transaction Id";?></strong></td>
													<td width="15%" style=""><strong><?php if($this->lang->line('BookingNo') != '') { echo stripslashes($this->lang->line('BookingNo')); } else echo "Booking No";?></strong></td>
													<td width="15%" style=""><strong><?php if($this->lang->line('Amount') != '') { echo stripslashes($this->lang->line('Amount')); } else echo "Amount";?></strong></td>
													</tr>
											</thead>
											<?php foreach($completed_transaction->result() as $row) { ?>
											<tbody>
												<td>
													<?php echo date('M d, Y',strtotime($row->dateAdded));?>
												</td>
												<td>
													<?php echo 'Via Bank';?>
												</td>
												<td>
													<?php echo $row->transaction_id;?>
												</td>
												<td>
													<?php echo $row->booking_no;?>
												</td>
												<td><?php echo strtoupper($currencySymbol)." ".USDtoCurrentCurrency($row->amount)."";?>
												
												
												<?php //echo $row->amount;?></td>
											</tbody>
											<?php } ?>
										</table>
										<?php } else{ ?>
										<h3 class="status-text"><strong><?php if($this->lang->line('NoTransactions') != '') { echo stripslashes($this->lang->line('NoTransactions')); } else echo "No Transactions";?></strong></h3><?php } ?>
									</div>
									<div class="tab-pane" id="tab_default_2">
										<?php if(count($featured_transaction->result()) >0)
										{ if($featured_transaction->row()->product_id != ""){?>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" class="member_ship" id="productListTable">
											<thead>
												<tr height="40px">          
													<td width="15%" style="" ><strong><?php if($this->lang->line('Date') != '') { echo stripslashes($this->lang->line('Date')); } else echo "Date";?></strong></td>
													<td width="35%" style=""><strong><?php if($this->lang->line('detail_list') != '') { echo stripslashes($this->lang->line('detail_list')); } else echo "Details";?></strong></td>
													<td width="30%" style=""><strong><?php if($this->lang->line('Amount') != '') { echo stripslashes($this->lang->line('Amount')); } else echo "Amount";?></strong></td>
												</tr>
											</thead>
											<?php 
											
											
											//echo "<pre>"; print_r($featured_transaction->result()); die;
											
											foreach($featured_transaction->result() as $row){?>
											<tbody>
												<td>
													<?php  echo date('M d, Y',strtotime($row->dateAdded)); ?>
												</td>
												<td class="paddgns newtees">
													<a target="_blank" href="users/show/<?php echo $row->GestId; ?>" style="float:left; "><?php echo $row->firstname;?></a><br><br /><?php echo "<a href='".base_url()."rental/".$row->product_id."'>".$row->product_title."</a><br>"; ?>
													<?php echo strtoupper($currencySymbol)." ".CurrencyValue($row->product_id ,$row->price );?> / <?php if($this->lang->line('per_night') != '') { echo stripslashes($this->lang->line('per_night')); } else echo "per night";?><br>
													<label style='font-weight:bold;'><?php if($this->lang->line('booking_no') != '') { echo stripslashes($this->lang->line('booking_no')); } else echo "Booking No";?> :</label><?php echo $row->Bookingno;?>
												</td>
												<td>
													<table class="transaction_inner_table">
														<tr>
															<td style="text-align:right;"><span style="color:red;"><?php if($this->lang->line('Total') != '') { echo stripslashes($this->lang->line('Total')); } else echo "Total";?> </span></td><td style="text-align:right;"><?php echo strtoupper($currencySymbol)."".CurrencyValue($row->product_id ,$row->totalAmt)."";?> 
															</td>
														</tr>
														<tr>
															<td style="text-align:right;"><span style="color:red;"><?php if($this->lang->line('ServiceFee') != '') { echo stripslashes($this->lang->line('ServiceFee')); } else echo "Service Fee";?> </span></td><td style="text-align:right;"><?php echo strtoupper($currencySymbol)."".CurrencyValue($row->product_id ,$row->guest_fee)."";?> </td>
														</tr>
														<tr>
															<td style="text-align:right;"><span style="color:red;"><?php if($this->lang->line('Host_Fee') != '') { echo stripslashes($this->lang->line('Host_Fee')); } else echo "Host Fee";?> </span></td><td style="text-align:right;"><?php echo strtoupper($currencySymbol)." ".CurrencyValue($row->product_id ,$row->host_fee)."";?> </td>
														</tr>
														<tr>
															<td style="text-align:right;"><span style="color:red;"><?php if($this->lang->line('Net_Amount') != '') { echo stripslashes($this->lang->line('Net_Amount')); } else echo "Net Amount";?> </span></td><td style="text-align:right;"><?php echo strtoupper($currencySymbol)."".CurrencyValue($row->product_id,$row->payable_amount)."";?> </td>
														</tr>
													</table>
												</td>
											</tbody>
											<?php } ?>
										</table>
										<?php }else { ?>
										<h3 class="status-text"><?php if($this->lang->line('NoTransactions') != '') { echo stripslashes($this->lang->line('NoTransactions')); } else echo "No Transactions";?>  </h3> 
										<?php } }else { ?>
										<h3 class="status-text"><?php if($this->lang->line('NoTransactions') != '') { echo stripslashes($this->lang->line('NoTransactions')); } else echo "No Transactions";?>  </h3>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<div class="show_all_reservations">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!---DASHBOARD-->
<!---FOOTER-->
<script type="text/javascript">
function redirect()
{
}
function transaction_change(elem,booking_status)
{
var cur_field=$(elem).attr('id');
var cur_value=$(elem).val();
cur_value= cur_value.replace(' ', '-');
if(cur_field !="" && cur_value !="")
{
window.location='<?php echo base_url()?>account-trans/'+cur_field+'/'+cur_value+'/'+booking_status;
}
else{
window.location='<?php echo base_url();?>account-trans/'+booking_status;
}

}

function gross_earning(elem)
{
var cur_field=$(elem).attr('id');
var cur_value=$(elem).val();
cur_value= cur_value.replace(' ', '-');
if(cur_field !="" && cur_value !="")
{
window.location='<?php echo base_url()?>gross-earning/'+cur_field+'/'+cur_value;
}
else{
window.location='<?php echo base_url()?>gross-earning/';
}
}
</script>
<?php 
$this->load->view('site/templates/footer');
?>