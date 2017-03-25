<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Earning</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'editcommission_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/earnings/insertEditCommission',$attributes) 
					?>
	 						<ul>
	 							
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="promotion_type">Promotion Type <span class="req">*</span></label>
									<div class="form_input">
										<select name="promotion_type" style="width:295px" id="promotion_type" />
										<option value="">Select</option>
										
										<option value="flat" <?php if($commission_details->row()->promotion_type=='flat'){?>selected="selected"<?php }?>>Flat</option>
										<?php if($commission_details->row()->id !='1'){?>
                                      <option value="percentage" <?php if($commission_details->row()->promotion_type=='percentage'){?>selected="selected"<?php }?>>Percentage</option>
										<?php }?>
										</select>
										<span id="promotion_type_warn" class="error"></span>
									</div>
								</div>
								</li>
								
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="commission_type">Commission Type <span class="req">*</span></label>
									<div class="form_input">
										<input name="commission_type" style=" width:295px" id="commission_type" value="<?php echo $commission_details->row()->commission_type;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the user Commission Type"/>
										<span id="commission_type_warn" class="error"></span>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="commission_percentage">Commission Percentage or Amount<span class="req">*</span></label>
									<div class="form_input">
										<input name="commission_percentage" style=" width:295px" id="commission_percentage" value="<?php echo $commission_details->row()->commission_percentage;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the Commission Percentage or Amount"/>
									    <span id="commission_percentage_warn" class="error"></span>
									</div>
								</div>
								</li>
                               <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" name="status" <?php if ($commission_details->row()->status == 'Active'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								<input type="hidden" name="commission_id" value="<?php echo $commission_details->row()->id;?>"/>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="button" id="editcommission_form_button" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
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
<script type="text/javascript">
$('#editcommission_form_button').click(function()
{

$('#commission_type_warn').html('');
$('#commission_percentage_warn').html('');

var commission_type=$('#commission_type').val();
var commission_percentage=$('#commission_percentage').val();
if(commission_type =='')
{
$('#commission_type_warn').html('Please Enter Commission Type');
$('#commission_type').focus();
}
else if(commission_percentage =='')
{
$('#commission_percentage_warn').html('Please Enter Commission Percentage');
$('#commission_percentage').focus();
}
else if(isNaN(commission_percentage))
{
$('#commission_percentage_warn').html('Please Percentage Should be Number');
$('#commission_percentage').focus();
}
else{
$('#editcommission_form').submit();
}
});
</script>
<style>
.error
{
color:red;
}
</style>
<?php 
$this->load->view('admin/templates/footer.php');
?>