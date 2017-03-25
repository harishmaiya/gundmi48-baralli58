<?php
//print_r($list_value_details->result());die;
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
		                      <select class="chzn-select required" name="list_id" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Select List">
		                      		<option value=""></option>
		                      		<?php 
		                      		foreach ($list_details->result() as $row){
		                      			if ($row->attribute_name!='price'){
		                      		?>
		                      		<option <?php if ($sub_list_value_details->row()->list_id == $row->id){echo 'selected=""';}?> value="<?php echo $row->id;?>"><?php echo $row->attribute_name;?></option>
		                      		<?php }}?>
		                      </select>
		                    </div>
							</div>
							</li>
							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="list_value">List Value<span class="req">*</span></label>
							<div class="form_input">
                              <select class="chzn-select required" name="list_value_id" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Select List">
		                      		<option value=""></option>
		                      		<?php 
		                      		foreach ($list_value_details->result() as $row){
		                      			if ($row->attribute_name!='price'){
		                      		?>
		                      		<option <?php if ($sub_list_value_details->row()->list_value_id == $row->id){echo 'selected=""';}?> value="<?php echo $row->id;?>"><?php echo $row->list_value;?></option>
		                      		<?php }}?>
		                      </select>
							</div>
							</div>
							</li>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="sub_list_value">Sub List Value<span class="req">*</span></label>
							<div class="form_input">
								<input name="sub_list_value" value="<?php echo $sub_list_value_details->row()->sub_list_value;?>" id="list_value" type="text" tabindex="1" class="required large tipTop" title="Please enter the list value"/>
							</div>
							</div>
							</li>
							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="image">Sub List Icon</label>
							<div class="form_input">
							<input name="image" id="image" type="file" tabindex="7" class="large tipTop" title="Please select user image"/>
							</div>
							<div class="form_input"><img src="<?php if($sub_list_value_details->row()->image==''){ echo base_url().'images/users/user-thumb1.png';}else{ echo base_url();?>images/users/<?php echo $sub_list_value_details->row()->image;}?>" width="100px"/></div>
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
                    <input type="hidden" name="lvID" value="<?php echo $sub_list_value_details->row()->id;?>"/>
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
	$('#addlistvalue_form').validate();
	$("#image").rules("add", {
        accept: "jpg|jpeg|png|ico|bmp"
    });
});
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>