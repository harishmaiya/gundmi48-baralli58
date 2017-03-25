<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Slider</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addslider_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/slider/insertEditSlider',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="slider_name">Slider Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="slider_name" id="slider_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the slider name"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="slider_title">Slider Title </label>
									<div class="form_input">
										<input name="slider_title" id="slider_title" type="text" tabindex="2" class="large tipTop" title="Please enter the slider title"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="slider_link">Slider Link <span class="req">*</span></label>
									<div class="form_input">
										<input name="slider_link" id="slider_link" type="text" tabindex="2" class="required large tipTop" title="Please enter the slider link"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="slider_desc">Slider Description </label>
									<div class="form_input">
										<textarea name="slider_desc" id="slider_desc" class="large tipTop" title="Please enter the slider link"></textarea>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="image">Slider Image<span class="req">*</span></label>
									<div class="form_input">
										<input name="image" id="image" type="file" tabindex="7" class="required large tipTop" title="Please select slider image"/>
									<br><span style="color:red;">Upload the Image Size 1349 X 484 or Above</span>
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
<script>
$(document).ready(function(){
	$('#addslider_form').validate();
	$("#image").rules("add", {
        accept: "jpg|jpeg|png|ico|bmp"
    });
});
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>