<?php
$this->load->view('admin/templates/header.php');
?>
<script>
function main_page(val1){
$.ajax(
     {
			type: 'POST',
			url:'<?php echo base_url(); ?>admin/help/main_help',
			data:{'id':val1},
			success: function(data) 
			{
			$('#lang_warn').html(data);
			}
	 });
}
</script>
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
						echo form_open(ADMIN_PATH.'/help/insert_main_lang',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
							    <li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Type <span class="req">*</span></label>
									    <div class="form_input">
										<select name = "type" style=" width:295px; height:30px;" title="Please Choose Type" class="tipTop">
										<option value="Both">Both</option>
										<option value="User">Guest</option>
										<option value="Host">Host</option>
										</select
									    </div>
								    </div>
								</li>
								<li>
								  <div class="form_grid_12">
									<label class="field_title" for="page_name">Choose Main Menu <span class="req">*</span></label>
									<div class="form_input">
									  <select name="seourl" onchange="main_page(this.value)" id="page_name" tabindex="1" class="required large tipTop" title="Choose the Main page">
									  <option>Please Choose Main Menu</option>
									  <?php  foreach($cms_details->result() as $page) { ?>
									  <option value="<?php echo $page->id; ?>"><?php echo $page->name; ?></option>
									  <?php } ?>
									  </select>
									</div>
								  </div>
								</li>
								 <li>
								  <div class="form_grid_12">
									<label class="field_title" for="page_name">Choose Language <span class="req">*</span></label>
									<div class="form_input">
									
									   <select id="lang_warn" name="lang_code"  tabindex="1" class="required large tipTop" title="Choose the Language">
									  <option>Please Choose Language</option>
									  </select>
									</div>
								  </div>
								</li>
								<li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Menu Name <span class="req">*</span></label>
									    <div class="form_input">
										 <input name="help_name" style=" width:295px" id="currency_symbol" type="text" tabindex="1" class="required tipTop" title="Please enter the Page Name"/>   
									    </div>
								    </div>
								</li>
								 
                                
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
                                        <input type="checkbox" name="status" checked="checked" id="active_inactive_active" class="active_inactive"/>
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