<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New page</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open(ADMIN_PATH.'/space/insertspace',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
							    <li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Price<span class="req">*</span></label>
									    <div class="form_input">
										<textarea original-title="Please enter the price" name="price" id="Answer" rows="5" cols="5" class="required small tipTop" tabindex="4"></textarea>
									    </div>
								    </div>
								</li>
								
								<li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Calendar<span class="req">*</span></label>
									    <div class="form_input">
										<textarea original-title="Please enter the Calendar" name="calendar" id="calendar" rows="5" cols="5" class="required small tipTop" tabindex="4"></textarea>  
									    </div>
								    </div>
								</li>
								 <li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Picture<span class="req">*</span></label>
									    <div class="form_input">
										<textarea original-title="Please enter the Picture" name="picture" id="picture" rows="5" cols="5" class="required small tipTop" tabindex="4"></textarea>   
									    </div>
								    </div>
								</li>
								
                                
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Settings<span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
                                        <textarea original-title="Please enter the settings" name="settings" id="settings" rows="5" cols="5" class="required small tipTop" tabindex="4"></textarea>   
										</div>
									</div>
								</div>
								</li>
								<!--<input type="hidden" name="location_id" value=""/>-->
								<li>
								    <div class="form_grid_12">
									    <div class="form_input">
										    <button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
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