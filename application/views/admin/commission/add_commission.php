<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Commission</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addcommission_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/commission/insertEditCommission',$attributes) 
					?>
	 						<ul>
							
							    <li>
								<div class="form_grid_12">
									<label class="field_title" for="promotion_type">Promotion Type <span class="req">*</span></label>
									<div class="form_input">
										<select name="promotion_type" style="width:295px" id="promotion_type" />
										<option value="">Select</option>
										<option value="flat">Flat</option>
										<option value="percentage">Percentage</option>
										</select>
										<span id="promotion_type_warn" class="error"></span>
									</div>
								</div>
								</li>
								
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="commission_type">Commission Type <span class="req">*</span></label>
									<div class="form_input">
										<input name="commission_type" id="commission_type" type="text" tabindex="1" class="required large tipTop" title="Please enter the user Commission Type"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="commission_percentage">Commission Percentage or Amount<span class="req">*</span></label>
									<div class="form_input">
										<input name="commission_percentage" id="commission_percentage" type="text" tabindex="1" class="required large tipTop" title="Please enter the Commission Percentage or Amount"/>
									</div>
								</div>
								</li>
                              <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="8" name="status" checked="checked" id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="9"><span>Submit</span></button>
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