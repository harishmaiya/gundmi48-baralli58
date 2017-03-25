<?php
$this->load->view('admin/templates/header.php');
?>


<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Coupon Code</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'adduser_form');
						echo form_open('admin/couponcards/insertEditCouponcard',$attributes) 
					?>
	 						<ul>
							
							   <li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">Coupon Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="coupon_name" id="coupon_name" type="text" tabindex="1" class="required small tipTop" title="Please Enter the Coupon Code" value=""/>
									</div>
								</div>
								</li>
                            
                               <li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">Coupon code <span class="req">*</span></label>
									<div class="form_input">
										<input name="code" id="code" type="text" tabindex="2" class="required small tipTop" title="Please Enter the Coupon Code" value=""/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="group">Max No. of Coupons <span class="req">*</span></label>
									<div class="form_input">
										<input name="quantity" id="quantity" type="text" tabindex="3" class="required small tipTop" title="Please enter the quantity"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="datefrom">Coupon Valid From<span class="req">*</span></label>
									<div class="form_input">
										<input name="datefrom" id="datefrom" type="text" tabindex="5" class="required small tipTop datepicker" title="Please select the date"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="dateto">Coupon Valid Till<span class="req">*</span></label>
									<div class="form_input">
										<input name="dateto" id="dateto" type="text" tabindex="6" class="required small tipTop datepicker" title="Please select the date"/>
									</div>
								</div>
								</li>
                            
                                
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="full_name">Discount Type <span class="req">*</span></label>
									<div class="form_input">
										<div class="flat_percentage">
											<input type="checkbox" tabindex="1" name="price_type" checked="checked" class="Flat_Percentage"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">Price Value <span class="req">*</span></label>
									<div class="form_input">
										<input name="price_value" id="price_value" type="text" tabindex="2" class="required small tipTop" title="Please enter the price value"/>
									</div>
								</div>
								</li>
                                
   
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="8"><span>Submit</span></button>
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
<script type="text/javascript">
$('#quantity') .bind("keydown", function (event) {
             
    if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
         // Allow: Ctrl+A
        (event.keyCode == 65 && event.ctrlKey === true) || 
         
        // Allow: Ctrl+C
        (event.keyCode == 67 && event.ctrlKey === true) || 
         
        // Allow: Ctrl+V
        (event.keyCode == 86 && event.ctrlKey === true) || 
         
        // Allow: home, end, left, right
        (event.keyCode >= 35 && event.keyCode <= 39)) {
          // let it happen, don't do anything
          return;
    } else {
        // Ensure that it is a number and stop the keypress
        if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
            event.preventDefault(); 
        }   
    }
});
</script>
<script type="text/javascript">
$('#price_value').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/^[A-Za-z]*$/g,'') ); }
);
</script>