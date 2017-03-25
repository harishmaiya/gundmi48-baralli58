<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6><?php echo $heading;?></h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'edituser_form');
						echo form_open('admin/couponcards/insertEditCouponcard',$attributes) 
					?>
	 				<ul>
					
					
					   <li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">Coupon Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="coupon_name" id="coupon_name" type="text" tabindex="1" class="required small tipTop" title="Please Enter the Coupon Code" value="<?php echo $couponcard_details->row()->coupon_name;?>"/>
									</div>
								</div>
								</li>
                      	<li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">Coupon code <span class="req">*</span></label>
									<div class="form_input">
										<input name="code" id="code" type="text" tabindex="2" class="required small tipTop" title="Please Enter the Coupon Code" value="<?php echo $couponcard_details->row()->code;?>"/>
									</div>
								</div>
								</li>
                      	<li>
								<div class="form_grid_12">
									<label class="field_title" for="group">Max No. of Coupons <span class="req">*</span></label>
									<div class="form_input">
										<input name="quantity" id="quantity" type="text" tabindex="3" class="required small tipTop" title="Please enter the quantity" value="<?php echo $couponcard_details->row()->quantity;?>"/>
									</div>
								</div>
								</li>
						<li>
								<div class="form_grid_12">
									<label class="field_title" for="datefrom">Coupon Valid From<span class="req">*</span></label>
									<div class="form_input">
										<input name="datefrom" id="datefrom" type="text" tabindex="5" class="required small tipTop datepicker" title="Please select the date" value="<?php echo $couponcard_details->row()->datefrom;?>" />
									</div>
								</div>
								</li>
						<li>
								<div class="form_grid_12">
									<label class="field_title" for="dateto">Coupon Valid Till<span class="req">*</span></label>
									<div class="form_input">
										<input name="dateto" id="dateto" type="text" tabindex="6" class="required small tipTop datepicker" title="Please select the date" value="<?php echo $couponcard_details->row()->dateto;?>" />
									</div>
								</div>
								</li>        

	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="full_name">Discount Type <span class="req">*</span></label>
									<div class="form_input">
										<div class="flat_percentage">
											<input type="checkbox" tabindex="1" name="price_type" class="Flat_Percentage" <?php if ($couponcard_details->row()->price_type == '1'){echo 'checked="checked"';}?>/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">Price Value <span class="req">*</span></label>
									<div class="form_input">
										<input name="price_value" id="price_value" type="text" tabindex="2" class="required small tipTop" title="Please enter the price value" value="<?php echo $couponcard_details->row()->price_value;?>"/>
									</div>
								</div>
								</li>

	 							
									
								
	 							<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
							<input type="hidden" name="coupon_id" value="<?php echo $couponcard_details->row()->id?>"/>
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