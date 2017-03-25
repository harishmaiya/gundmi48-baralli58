<?php
$this->load->view('admin/templates/header.php');
?>
<script>
function list_page(val){
$.ajax(
     {
			type: 'POST',
			url:'<?php echo base_url(); ?>admin/space/list_page',
			data:{'page':val},
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
						<h6>Add Language Space</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open(ADMIN_PATH.'/space/insert_lang_space',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
								<li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Page Name<span class="req">*</span></label>
									    <div class="form_input">
									 <select  name="page" onchange="list_page(this.value)" id="page_name" tabindex="1" class="required large tipTop" title="Choose the Main page">
										  <option>Please Choose Page Name</option>
										  <?php  foreach($page_details->result() as $page) { ?>
										  <option value="<?php echo $page->page; ?>"><?php echo $page->page; ?></option>
										  <?php } ?>
										  </select>
                            
									    </div>
								    </div>
								</li>
								
									<li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Language<span class="req">*</span></label>
									    <div class="form_input">
										
								 <select id="lang_warn"  name="lang"  tabindex="1" class="required large tipTop" title="Choose the Language">
								  <option >Please Choose Language</option>
								  <?php foreach($lang_details->result() as $lang) { ?>
								   <option value="<?php echo $lang->lang_code; ?>"><?php echo $lang->name; ?></option>
								  <?php } ?>
								  </select>
									    </div>
								    </div>
								</li>
							
							
							
							    <li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Title<span class="req">*</span></label>
									    <div class="form_input">
										
				<input type="text" original-title="Please enter the title" name="title" id="title" tabindex="1" class="required large tipTop" value="">
                            
									    </div>
								    </div>
								</li>
								
								<li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Description<span class="req">*</span></label>
									    <div class="form_input">
										<textarea original-title="Please enter the Description" name="description" id="description" rows="5" cols="5" class="required small tipTop mceEditor" tabindex="4"></textarea>  
									    </div>
								    </div>
								</li>
								 
								
                                
								
								  
								<input type="hidden" name="help_id" value=""/>
								<!--<input type="hidden" name="location_id" value=""/>-->
								<li>
								    <div class="form_grid_12">
									    <div class="form_input">
										    <button type="submit" class="btn_small btn_blue" tabindex="4"><span>ADD</span></button>
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