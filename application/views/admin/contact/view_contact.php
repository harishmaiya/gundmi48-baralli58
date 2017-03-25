<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Contact</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>
	 						<ul>
                            	<li>
								<div class="form_grid_12">
									<label class="field_title" for="firstname">User Name <span class="req">*</span></label>
									<div class="form_input">
                                    <?php echo ucfirst($contact_details->row()->firstname).' '.ucfirst($contact_details->row()->lastname);?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="email"> E-mail Address<span class="req">*</span></label>
									<div class="form_input">
                                    <?php echo $contact_details->row()->email;?>
									</div>
								</div>
								</li><li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_symbol">Phone No<span class="req">*</span></label>
									<div class="form_input">
                                    <?php echo $contact_details->row()->phone_no;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_type">Arrival Date<span class="req">*</span></label>
									<div class="form_input">
                                   <?php echo $contact_details->row()->checkin;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_type">Departure Date<span class="req">*</span></label>
									<div class="form_input">
                                   <?php echo $contact_details->row()->checkout;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_type">No of Guest</label>
									<div class="form_input">
                                   <?php echo $contact_details->row()->NoofGuest;?>
									</div>
								</div>
								</li>
                                <!--<li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_type">Children</label>
									<div class="form_input">
                                   <?php echo $contact_details->row()->children;?>
									</div>
								</div>
								</li>-->
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_type">Enquiry </label>
									<div class="form_input">
                                   <?php echo $contact_details->row()->Enquiry;?>
									</div>
								</div>
								</li>
	 							
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/contact/display_contact_list" class="tipLeft" title="Go to contact list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
							</ul>
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