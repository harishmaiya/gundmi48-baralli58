<?php
$this->load->view('admin/templates/header.php');
?>
<script>
$(document).ready(function(){

$('#mainmenu').change(function(){
id=$('#mainmenu').val();
//alert(id);
$.ajax({
   url: '<?php echo base_url();?>admin/help/ajaxsubmenu',
   data: {
      id:id
   },
   
   dataType:'json',
   success: function(json) {
   
     $('#submenudiv').html(json.states_list);
	 $(".chzn-select").chosen(); 
	
   },
   type: 'POST'
});
});
});
function choosenval(){
var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
}
 for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
}
</script>

<?php 
//echo "<pre>";
//print_r($values);

//exit;

?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Question & Answer</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open(ADMIN_PATH.'/help/updatequestion',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
								<li>
								  <div class="form_grid_12">
									<label class="field_title" for="mian">Select Main Menu <span class="req">*</span></label>
									<div class="form_input">
									  <select class="chzn-select required" name="main" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Select Main Page" id='mainmenu'>
											<option value=""></option>
											<?php foreach ($helpList->result() as $row){?>
											<option value="<?php echo $row->id;?>"
											
											<?php if($values->row()->main==$row->id) echo "selected='selected'";?>
											
											><?php echo $row->name;?></option>
											<?php }?>
									  </select>
									</div>
								  </div>
								</li>
								
							    <li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Sub Menu Name <span class="req">*</span></label>
									    <div class="form_input" id='submenudiv'>
										 <select class="chzn-select required" name="submenu" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Select Main Page" >
										<option value=""></option>
											<?php foreach ($subhelp->result() as $row){?>
											<option value="<?php echo $row->id;?>"
											
											<?php if($values->row()->sub==$row->id) echo "selected='selected'";?>
											
											><?php echo $row->name;?></option>
											<?php }?>	
											
									  </select>
									    </div>
								    </div>
								</li>
								 
                                <li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Question <span class="req">*</span></label>
									    <div class="form_input">
										<input type="text" class="required large tipTop" tabindex="1" id="question" name="question" original-title="Please enter the user Question" value='<?php echo $values->row()->question;?>'>
									    </div>
								    </div>
								</li>
								
								<li>
								    <div class="form_grid_12">
									    <label class="field_title" for="location_name">Answer<span class="req">*</span></label>
									    <div class="form_input">
										
										 <textarea name="answer" tabindex="3" class="large tipTop mceEditor" title="Please enter the page content"><?php echo $values->row()->answer;?></textarea>
									    </div>
								    </div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
                                        <input type="checkbox" name="status" <?php if ($values->row()->status == 'Active'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Featured <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
                                        <input type="radio" name="feature" <?php if ($values->row()->feature == 'yes'){echo 'checked="checked"';}?>  id="" class="active_inactive"/ value='yes'> Yes
										<input type="radio" name="feature"  id="" class="active_inactive" value="no"/ <?php if ($values->row()->feature == 'no'){echo 'checked="checked"';}?>> No
										</div>
									</div>
								</div>
								</li>
								
	<input type="hidden" name="question_id" value="<?php echo $values->row()->id; ?>"/>
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