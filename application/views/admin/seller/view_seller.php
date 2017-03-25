<?php
$this->load->view('admin/templates/header.php');
//echo "<pre>"; print_r($seller_details->result()); die;
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Host</h6>
						<div id="widget_tab">
			              <ul>
			                <li><a href="#tab1" class="active_tab">Host Details</a></li>
			                <li><a href="#tab2">Payout Details</a></li>
			              </ul>
			            </div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>
					<div id="tab1">
	 						<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">User Image</label>
									<div class="form_input">
									<?php if ( $seller_details->row()->image == ''){?>
										<img src="<?php echo base_url();?>images/users/user-thumb1.png" width="100px"/>
									<?php }else {?>
										<img src="<?php echo base_url();?>images/users/<?php echo $seller_details->row()->image;?>" width="100px"/>
									<?php }?>
									</div>
								</div>
								</li>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="full_name">First Name </label>
									<div class="form_input">
										<?php echo $seller_details->row()->firstname;?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="full_name">Last Name <span class="req">*</span></label>
									<div class="form_input">
										<?php echo $seller_details->row()->lastname;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="gender">I Am</label>
									<div class="form_input">
                                    <?php echo $seller_details->row()->gender;?>
									</div>
								</div>
								</li>
                                
                                
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="gender">Date of birth</label>
									<div class="form_input">
                                    <?php echo $seller_details->row()->dob_month.'/'.$seller_details->row()->dob_date.'/'.$seller_details->row()->dob_year;?>
                                  
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="phone_no">Phone no </label>
									<div class="form_input">
										<?php  echo $seller_details->row()->phone_no; ?>
									</div>
								</div>
								</li> 
								 <li>
								<div class="form_grid_12">
									<label class="field_title" for="email">Email Id </label>
									<div class="form_input">
										<?php  echo $seller_details->row()->email; ?>
									</div>
								</div>
								</li> 
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_city">Where You Live</label>
									<div class="form_input">
										<?php  echo $seller_details->row()->s_city; ?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="description">Describe Yourself</label>
									<div class="form_input">
										<?php  echo $seller_details->row()->description; ?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_city">School</label>
									<div class="form_input">
										<?php  echo $seller_details->row()->school; ?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="work">Work</label>
									<div class="form_input">
										<?php  echo $seller_details->row()->work; ?>
									</div>
								</div>
								</li>								
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Website</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->web_url == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->web_url;
										}
										?>
									</div>
								</div>
								</li>-->
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Commision</label>
									<div class="form_input">
										<?php echo $seller_details->row()->commision.' %';?>
									</div>
								</div>
								</li>-->
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status</label>
									<div class="form_input">
										<?php echo $seller_details->row()->status;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/seller/display_seller_<?php if ($seller_details->row()->request_status=='Pending'){echo 'requests';}else {echo 'list';}?>" class="tipLeft" title="Go to seller <?php if ($seller_details->row()->request_status=='Pending'){echo 'requests';}else {echo 'list';}?>"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
							</ul>
						</div>
						<div id="tab2">
							<ul>
							    <li>
								<div class="form_grid_12">
									<label class="field_title" for="">Paypal Email</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->paypal_email == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->paypal_email;
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="">Account Name</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->accname == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->accname;
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Account Number</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->accno == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->accno;
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Bank Name</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->bankname == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->bankname;
										}
										?>
									</div>
								</div>
								</li>
							<!--	<li>
								<div class="form_grid_12">
									<label class="field_title" for="paypal_email">Account Country</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->Acccountry == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->Acccountry;
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="paypal_email">Swift Code</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->swiftcode == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->swiftcode;
										}
										?>
									</div>
								</div>
								</li> -->
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/seller/display_seller_<?php if ($seller_details->row()->request_status=='Pending'){echo 'requests';}else {echo 'list';}?>" class="tipLeft" title="Go to seller <?php if ($seller_details->row()->request_status=='Pending'){echo 'requests';}else {echo 'list';}?>"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
							</ul>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>