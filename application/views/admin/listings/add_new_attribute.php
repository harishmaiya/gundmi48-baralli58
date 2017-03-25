<?php
$this->load->view('admin/templates/header.php');
/* var_dump($details->result());die; */
?>


<?php if(isset($details)){ ?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				
				
				<div class="widget_wrap">
					<div class="widget_top">
					<span class="h_icon list"></span>
					<h6>Edit Attribute</h6>
                        
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addattribute_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/listings/insert_attribute',$attributes) 
					?>
					
                    
						<ul>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">Listing Name <span class="req">*</span></label>
							<div class="form_input">
							
							
								<input name="attribute_name" id="attribute_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the list name"        value="<?php echo $details->row()->name; ?>"/>
								
		
							</div>
							</div>
							</li>
							
							<input type="hidden" name="id" value="<?php echo $this->uri->segment(4,0); ?>">
							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">Type <span class="req">*</span></label>
							<div class="form_input">
							
							    <input type="radio" name="type" value="option" <?php echo ($details->row()->type=='option')?'checked':''; ?>>option
							    <input type="radio" name="type" value="text" <?php echo ($details->row()->type=='text')?'checked':''; ?>>text
								
		
							</div>
							</div>
							</li>
							
							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">label <span class="req">*</span></label>
							<div class="form_input">
							
							
								<input name="label_name" id="label_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the list name"        value="<?php echo $details->row()->labelname; ?>"/>
								
		
							</div>
							</div>
							</li>
							
						
                        	
							<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="11" name="status" checked="checked" id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li> 
								<li> 
								
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue " tabindex="9"><span>Submit</span></button>
									</div>
								</div>
								</li>
							</ul>
                    
						</form>
					</div>
				</div>
				</div>
				</div>
				</div>
				<?php } else { ?>
		<div id="content">		
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Attribute</h6>
                        
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addattribute_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/listings/insert_attribute',$attributes) 
					?>
					
                    
						<ul>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">Listing Name <span class="req">*</span></label>
							<div class="form_input">
							
							
								<input name="attribute_name" id="attribute_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the list name"        value=""/>
								
		
							</div>
							</div>
							</li>
							
							<input type="hidden" name="id" value="">
							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">Type <span class="req">*</span></label>
							<div class="form_input">
							
							    <input type="radio" name="type" value="option">option
							    <input type="radio" name="type" value="text">text
								
		
							</div>
							</div>
							</li>
							
							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">label <span class="req">*</span></label>
							<div class="form_input">
							
							
								<input name="label_name" id="label_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the list name"        value=""/>
								
		
							</div>
							</div>
							</li>
							
						
                        	
							<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <!--<span class="req">*</span>--></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="11" name="status" checked="checked" id="active_inactive_active" class="active_inactive" />
										</div>
									</div>
								</div>
								</li> 
								<li> 
								
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue " tabindex="9"><span>Submit</span></button>
									</div>
								</div>
								</li>
							</ul>
                    
						</form>
					</div>
				</div>
				
			</div>
		</div>
		</div>
		<?php } ?>
		<span class="clear"></span>
	
</div>
<script>
$(".active_inactive").on("click", function (e) {
    var checkbox = $(this);
    if (checkbox.is(":checked") {
        // do the confirmation thing here
        e.preventDefault();
        return false;
    }
});
</script>
<script type="text/javascript">
$('#attribute_name').bind('input', function() {
  $(this).val($(this).val().replace(/[^a-z0-9_ ]/gi, ''));
});
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>