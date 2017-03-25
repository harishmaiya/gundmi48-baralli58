<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Banner Title</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open(ADMIN_PATH.'/banner/insertbanner',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
							
								<li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Type <span class="req">*</span></label>
									    <div class="form_input">
                                       <select name = "banner" style=" width:295px; height:30px;" title="Please Choose Type" class="tipTop">
										<option value="Banner-1" <?php if($helpList->row()->banner=='Banner-1') echo "selected='selected'";?>>Banner-1</option>
										<option value="Banner-2" <?php if($helpList->row()->banner=='Banner-2') echo "selected='selected'";?>>Banner-2</option>
										<option value="Banner-3"
										<?php if($helpList->row()->banner=='Banner-3') echo "selected='selected'";?>
										>Banner-3</option>
										</select
									    </div>
								    </div>
								</li>
								
								<input type="hidden" name="help_id" value="<?php echo $helpList->row()->id;?>"/>
								
                               <li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Title<span class="req">*</span></label>
									    <div class="form_input">
										 <input name="title_banner" style=" width:295px" id="currency_symbol" type="text" tabindex="1" class="required tipTop" title="Please enter the Title" value="<?php echo $helpList->row()->title;?>"/>   
									    </div>
								    </div>
								</li>
								 <li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Subtitle<span class="req">*</span></label>
									    <div class="form_input">
										 <input name="subtitle_banner" style=" width:295px" id="currency_symbol" type="text" tabindex="1" class="required tipTop" title="Please enter the Sub title" value="<?php echo $helpList->row()->subtitle;?>"/>   
									    </div>
								    </div>
								</li>
                                
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
                                        <input type="checkbox" name="status" <?php if ($helpList->row()->status == 'Active'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
                                
                            
                               
								<input type="hidden" name="help_id" value="<?php echo $helpList->row()->id;?>"/>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
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