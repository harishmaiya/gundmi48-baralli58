<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Help Page</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open(ADMIN_PATH.'/help/inserthelppage',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
							
								<li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Type <span class="req">*</span></label>
									    <div class="form_input">
										<select name = "type" style=" width:295px; height:30px;" title="Please Choose Type">
										<option value="Both" <?php if( $helpList->row()->type == 'Both')echo 'selected="selected"'?>>Both</option>
										<option value="User" <?php if( $helpList->row()->type == 'User')echo 'selected="selected"'?>>Guest</option>
										<option value="Host" <?php if( $helpList->row()->type == 'Host')echo 'selected="selected"'?>>Host</option>
										
										</select
									    </div>
								    </div>
								</li>
								
								
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="country_name">Page Name <span class="req">*</span></label>
								 <input name="help_name" style=" width:295px" id="currency_symbols" value="<?php echo $helpList->row()->name;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the currency name"/>	
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