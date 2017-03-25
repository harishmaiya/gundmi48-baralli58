<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Space</h6>
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
									    <label class="field_title" for="location_name">Title<span class="req">*</span></label>
									    <div class="form_input">
										
				<input type="text" original-title="Please enter the title" name="title" id="title" tabindex="1" class="required large tipTop" value="<?php echo $helpList->row()->title;?>">
                            
									    </div>
								    </div>
								</li>
								
								<li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Description<span class="req">*</span></label>
									    <div class="form_input">
										<textarea original-title="Please enter the Description" name="description" id="description" rows="5" cols="5" class="required small tipTop mceEditor" tabindex="4"><?php echo $helpList->row()->description;?></textarea>  
									    </div>
								    </div>
								</li>
								 
								
                                
								
								  
								<input type="hidden" name="help_id" value="<?php echo $helpList->row()->id;?>"/>
								<!--<input type="hidden" name="location_id" value=""/>-->
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