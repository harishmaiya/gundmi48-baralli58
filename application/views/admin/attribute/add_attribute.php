<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New List</h6>
                        
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addattribute_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/attribute/insertAttribute',$attributes) 
					?>
                    <div id="tab1">
						<ul>
	 							
							<li>
								<div class="form_grid_12">
									<label class="field_title" for="attribute_name">List Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="attribute_name" id="attribute_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the list name"/>
									</div>
								</div>
							</li>
							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_title">List Title <span class="req">*</span></label>
							<div class="form_input">
								<input name="attribute_title" id="attribute_title" type="text" tabindex="1" class="required large tipTop" title="Please enter the list Title"/>
							</div>
							</div>
							</li>
						
                        	
							<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status<!--hogan <span class="req">*</span>--></label>
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
										<button type="submit" class="btn_small btn_blue" tabindex="9"><span>Submit</span></button>
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
<script type="text/javascript">
        function blockSpecialChar(e) {
          var k = e.keyCode;
          return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8   || (k >= 48 && k <= 57));
        }
    </script>
<?php 
$this->load->view('admin/templates/footer.php');
?>