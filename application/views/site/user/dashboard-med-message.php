<?php 
$this->load->view('site/templates/header');
?>
<script type="text/javascript"  src="js/validation.js"></script>
<div class="dashboard yourlisting inbox bgcolor">
	<div class="top-listing-head">
		<div class="main">   
			<ul id="nav">
				<li><a href="<?php echo base_url();?>dashboard">Dashboard</a></li>
				<li class="active"><a href="<?php echo base_url();?>inbox">Inbox</a></li>
				<li><a href="<?php echo base_url();?>listing/all">Your Listing</a></li>
				<li><a href="<?php echo base_url();?>trips/upcoming">Your Trips</a></li>
				<li><a href="<?php echo base_url();?>settings">Profile</a></li>
				<li><a href="<?php echo base_url();?>account">Account</a></li>
				<li><a href="<?php echo base_url();?>plan">Plan</a></li>
			</ul> 
		</div>
	</div>

	<style>
	.msg_unread td {
		font-weight:bold !important;
	}
	</style>

	<div class="main">
		<div style="display:none" class="page-top-duplt">
			<div class="page-top-duplt-top">
				<select><option>All message(3)</option></select>
			</div>
			<table class="table inbx-table">
				<tr>
					<td style="text-align: center; width: 12%;">
					<img class="aimg" src="http://192.168.1.253/muthukrishnang/holidan/images/users/Chrysanthemum.jpg">
					</td>
					<td class="name-art" style="width: 12%;">
					<span>Vimal</span><span>4:39 AM</span>  
					</td>
					<td style="width: 57%; color: rgb(140, 140, 140);"> Hi Muhammed.. is it for the whole month? . Where are you from?...</td>
					<td><b style="color:#565A5C">Declined</b></td>
					<td><span class="thread-unstar"> Unstar </span></td>
				</tr>
			</table>
		</div>
		<div style="min-height: 270px;" id="command_center">
			<div id="page-wrap">
				<div id="example-two">
					<div class="list-wrap">
						<div id="tab_inbox">
							<div class="box" id="inbox">
								<div class="middle clearfix">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" class="member_ship datatable" id="productListTable">
										<thead>
											<tr>
												<td width="5%" ><strong>Sno</strong></td>
												<td width="13%" ><strong>Date</strong></td>
												<td width="17%" ><strong>Subject</strong></td>
												<td width="10%" ><strong>Action</strong></td>
											</tr>
										</thead>
									<tbody>
										<?php 
										$i=1;
										if($med_messages->num_rows() > 0){ 
										foreach($med_messages->result() as $med_message){ 
										$this->db->select('*');
										$this->db->from(MED_MESSAGE);
										$this->db->where('receiverId', $med_message->receiverId);
										$this->db->where('msg_read','No');
										$this->db->where('bookingNo',$med_message->bookingNo);
										$result = $this->db->get()->num_rows();?>
										<tr <?php if($result > 0)echo 'class="msg_unread"';?>>
											<td><?php echo $i; $i++;?></td>
											<td><?php  if($userDetails->row()->timezone==""){
											$currenttimezone = date_default_timezone_get();
											}else{
											$currenttimezone = $userDetails->row()->timezone;
											}
											$dt = new DateTime($med_message->dateAdded,new DateTimeZone('GMT'));
											$dt->setTimezone(new DateTimeZone($currenttimezone));
											echo $dt->format("Y-m-d, g:i a");

?></td>
											<td><?php echo $med_message->subject;?></td>
											<td><div class="edit"><a href="new_conversation/<?php echo $med_message->bookingNo;?>">View Message</a></div></td>
										</tr>
										<?php } } else{
											echo '<tr><td colspan="4"><center>There is no message(s) in inbox</center> </td></tr>';										
										} ?>
									</tbody>
									</table>
								<?php echo $links;?>                            
								</div>
							</div>  
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!---DASHBOARD-->
<?php 
$this->load->view('site/templates/footer');
?>