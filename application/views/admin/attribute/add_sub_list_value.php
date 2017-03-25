<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add List Value</h6>
                        
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addlistvalue_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/attribute/insertEditSubListValue',$attributes) 
					?>
                    
						<ul>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="list_id">Select List<span class="req">*</span></label>
							<div class="form_input">
		                      <select onchange="list_amenities(this)" class="required" name="list_id" tabindex="-1" style="width: 375px;" data-placeholder="Select List" id="select1">
		                      		<option value="">select</option>
		                      		<?php 
		                      		foreach ($list_details->result() as $row){
		                      			if ($row->attribute_name!='price'){
		                      		?>
		                      		<option  value="<?php echo $row->id;?>"><?php echo $row->attribute_name;?></option>
		                      		<?php }}?>
		                      </select>
		                    </div>
							</div>
							</li>
	 							
							<li>
							<div class="form_grid_12">
							<input type="hidden" value"" id="amenities"/>
							<label class="field_title" for="list_value">List Value<span class="req">*</span></label>
							<div class="form_input">
                              <select class="required" name="list_value_id" tabindex="-1" style="width: 375px; " data-placeholder="Select List" id="select2">
		                      		<option value=""></option>
		                      		<?php 
		                      		foreach ($sub_list_details->result() as $row){
		                      		if ($row->attribute_name!='price'){
		                      		?>
		                      		<option value="<?php echo $row->id;?>"><?php echo $row->list_value;?></option>
		                      		<?php }}?>
		                      </select>
							</div>
							</div>
							</li>
							
							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="list_value">Sub List Value<span class="req">*</span></label>
							<div class="form_input">
								<input name="sub_list_value" id="sub_list_value" type="text" tabindex="1" class="required large tipTop" title="Please enter the sub list value"/>
							</div>
							</div>
							</li>
							
						   <li>
							<div class="form_grid_12">
							<label class="field_title" for="image">Sub List Icon</label>
							<div class="form_input">
							<input name="image" id="image" type="file" tabindex="7" class="large tipTop" title="Please select user image"/>
							</div>
                            </div>
							</li>
                        	
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="2"><span>Submit</span></button>
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
<script>
$(document).ready(function(){
	$("#image").rules("add", {
        accept: "jpg|jpeg|png|ico|bmp"
    });
});
function list_amenities(evt)
{
	var am = $(evt).val();
	$.ajax({
        type: 'POST',
        url: baseURL+'admin/attribute/add_sub_list_value_form_frm',
        data: {"list_id":am},
        dataType:'json',
        success: function(response)
		{
        $(evt).parents('li').next().remove();
       	$(evt).parents('li').after(response.amenities);
		}
        });
}

$('#addlistvalue_form').validate();


</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>