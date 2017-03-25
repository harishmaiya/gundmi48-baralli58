<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add User language</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open(ADMIN_PATH.'/multilanguage/insertEditUserLang',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
							    <li>
								    <div class="form_grid_12">
									    <label class="field_title" for="language_name">Language Name <span class="req">*</span></label>
									    <div class="form_input">
										    <input name="language_name" style=" width:295px" id="language_name" type="text" tabindex="1" class="required tipTop" title="Please enter the language name"/>
									    </div>
								    </div>
								</li>
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