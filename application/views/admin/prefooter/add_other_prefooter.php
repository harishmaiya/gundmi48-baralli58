<?php
$this->load->view('admin/templates/header.php');
?>
<script>
function main_page(val1){
$.ajax(
     {
			type: 'POST',
			url:'<?php echo base_url(); ?>admin/prefooter/main_news',
			data:{'id':val1},
			success: function(data) 
			{
			$('#lang').html(data);
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
						<h6>Add Other Prefooter language</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addslider_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/prefooter/addAnotherprefooter',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="footer_title">Prefooter Title <span class="req">*</span></label>
									<div class="form_input">
									<select name="toId" onchange="main_page(this.value)" class="required">
										<option value="">Please Choose Prefooter Title</option>
										<?php  foreach($prefooter_title->result() as $title) { ?>
										<option value="<?php echo $title->id; ?>"><?php echo $title->footer_title; ?></option>
										<?php } ?>
									</select>
										<input name="footer_title" id="footer_title" type="hidden" tabindex="1" class="required large tipTop" title="Please enter the prefooter name"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="template">Choose Language <span class="req">*</span></label>
									<div class="form_input">
                                    <select name="lang" id="lang" class="required">
										<option value="">Please Choose Language</option>
									</select>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="prefooter_name">prefooter Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="footer_title" id="footer_title" type="text" tabindex="1" class="required large tipTop" title="Please enter the prefooter name"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="short_desc_count">Prefooter Excerpt Count </label>
									<div class="form_input">
										<input name="short_desc_count" id="short_desc_count" type="text" tabindex="2" class="large tipTop" title="Please excerpt count" value="<?php echo $prefooter_title->row()->short_desc_count;?>" disabled="disabled">
										<input name="short_desc_count" id="short_desc_count" type="hidden" tabindex="2" class="large tipTop" title="Please excerpt count" value="<?php echo $prefooter_title->row()->short_desc_count;?>">
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="prefooter_link">prefooter Link <span class="req">*</span></label>
									<div class="form_input">
										<input name="footer_link" id="footer_link" type="text" tabindex="2" class="required large tipTop" title="Please enter the prefooter link"/>
									</div>
								</div>
								</li>
								
							<li>
								<div class="form_grid_12">
									<label class="field_title" for="prefooter_link">Prefooter Short Description <span class="req">*</span></label>
									<?php $short_descs=explode('//',$prefooter_title->row()->short_description);
									for($i=1;$i<=count($short_descs);$i++){?>
									<div class="form_input">
										<input name="short_desc_count<?php echo $i;?>"  type="text" tabindex="2" class="required large tipTop" title="Please enter the prefooter link" value="">
									</div>
									<?php }?>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="image">prefooter Image<span class="req">*</span></label>
									<div class="form_input">
										<input name="image" id="image" type="file" tabindex="7" class="required large tipTop" title="Please select prefooter image"/>
										<span style="color:red" id="result1"></span>
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
										<button type="submit" class="btn_small btn_blue"  tabindex="9"><span>Submit</span></button>
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

/* function checkUrl()
{
		if( document.getElementById("image").files.length == 0 ){
		$('#result1').text('Image is not loaded!');
		return false;
		}	
	
} */

function short_description(elm)
{
var count=$(elm).val();
//alert(cou);
if(isNaN(count))
{
alert('Prefooter Except Count Should be Number');
$(elm).val("");
}
else
{
next_id=$(elm).closest('li').next().find('input').attr('id');
var short_description='<li><div class="form_grid_12"><label class="field_title" for="short_desc_count">Prefooter Short Description</label>';
for(var i=1;i<=count;i++)
{
short_desc_count='short_desc_count'+i;
count1=count;
short_description=short_description+'<div class="form_input"><input type="text"  class="required  large tipTop" tabindex="'+count1+'" name="'+short_desc_count+'" original-title="Please excerpt count"></div>';
}
short_description=short_description+'</div></li>';
if(next_id=='footer_link')
{
$(elm).closest('li').after(short_description);
}
else{
$(elm).closest('li').next('li').remove();
$(elm).closest('li').after(short_description);
}
//$(short_description).insertAfter('.left_label ul:li:eq(1)');
//alert(short_description);
}
}
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>