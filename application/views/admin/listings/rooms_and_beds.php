<?php
$this->load->view('admin/templates/header.php');
//var_dump($finalVal);die;
/* 	$bedrooms="";
	$beds="";
	$bedtype="";
	$bathrooms="";
	$noofbathrooms="";
	$min_stay="";
	$accommodates="";
	$can_policy="";
if($listDetail->num_rows()==1){
	$roombedVal=json_decode($listDetail->row()->rooms_bed);
	$bedrooms=$roombedVal->bedrooms;
	$beds=$roombedVal->beds;
	$bedtype=$roombedVal->bedtype;
	$bathrooms=$roombedVal->bathrooms;
	$noofbathrooms=$roombedVal->noofbathrooms;
	$min_stay=$roombedVal->min_stay;
	$accommodates=$roombedVal->accommodates;
	$can_policy=$roombedVal->can_policy;
}*/
//if($listDetail->num_rows()==1){
//$roombedVal=json_decode($listDetail->row()->rooms_bed);
//var_dump($listDetail);die;

 //}
 ?>
<link href="css/attribute/jquery.tagit.css" rel="stylesheet" type="text/css">
<link href="css/attribute/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
   
<script src="js/attribute/tag-it.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validate.js"></script>
<script>$(document).ready(function(){$("#addroomsandbed_form").validate(); });</script>
<script>
        $(function(){
		<?php foreach($listDetail as $attrib) { ?>
            var sampleTags = [];
			//alert('#list_con');
            $('#<?php echo $attrib->name;?>_con').tagit({
                availableTags: sampleTags,
                singleField: true,
                singleFieldNode: $('#<?php echo $attrib->name;?>')
            });
        <?php } ?>   
        });
 </script>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Listings Values </h6>
                        
					</div>
					<div class="widget_content">
						<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addroomsandbed_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/listings/insertlistings_roomsandbed',$attributes) 
						?>
							<ul>
							
								<?php foreach($finalVal as $name => $value)
									{
									$data[$name] = $value;									
									}
								foreach($listDetail as $attrib) {
									$listName = $attrib->name;
									?>
								
								
								<li>
									<div class="form_grid_12">
										<label class="field_title" for="<?php echo $attrib->labelname; ?>"><?php echo str_replace('_',' ',$attrib->labelname); ?><!--<span class="req">*</span>--></label>
										<div class="form_input">
										<?php if($attrib->type != 'text'){?>
										<input name="<?php echo $attrib->name;?>" type="hidden" id="<?php echo $attrib->name;  ?>" value="<?php echo $data[$attrib->name]; ?>" />     
												
										<ul id="<?php echo $attrib->name; ?>_con"></ul>
										<?php } else
										{?>
										<input name="<?php echo $attrib->name; ?>" type="hidden" id="<?php echo $attrib->name; ?>" value="<?php echo $data[$attrib->name]; ?>" />    
											<?php }?>										
										</div>
									</div>
								</li>
								<?php  }  ?>
								<!--<li>
									<div class="form_grid_12">
										<label class="field_title" for="bedrooms">Bedrooms <span class="req">*</span></label>
										<div class="form_input">
											<input name="bedrooms" type="hidden" id="bedrooms" value="<?php echo $bedrooms; ?>" />           
											<ul id="bedrooms_con"></ul>
										</div>
									</div>
								</li>
								
								<li>
									<div class="form_grid_12">
										<label class="field_title" for="beds">Beds <span class="req">*</span></label>
										<div class="form_input">
											<input name="beds" type="hidden" id="beds" value="<?php echo $beds; ?>" />           
											<ul id="beds_con"></ul>
										</div>
									</div>
								</li>
								<li>
									<div class="form_grid_12">
										<label class="field_title" for="bedtype">Bed Type <span class="req">*</span></label>
										<div class="form_input">
											<input name="bedtype" type="hidden" id="bedtype" value="<?php echo $bedtype; ?>" />           
											<ul id="bedtype_con"></ul>
										</div>
									</div>
								</li>
								<li>
									<div class="form_grid_12">
										<label class="field_title" for="bathrooms">Bathrooms <span class="req">*</span></label>
										<div class="form_input">
											<input name="bathrooms" type="hidden" id="bathrooms" value="<?php echo $bathrooms; ?>" />           
											<ul id="bathrooms_con"></ul>
										</div>
									</div>
								</li>
								<li>
									<div class="form_grid_12">
										<label class="field_title" for="noofbathrooms">Number of Bathrooms <span class="req">*</span></label>
										<div class="form_input">
											<input name="noofbathrooms" type="hidden" id="noofbathrooms" value="<?php echo $noofbathrooms; ?>" />           
											<ul id="noofbathrooms_con"></ul>
										</div>
									</div>
								</li>
								<li>
									<div class="form_grid_12">
										<label class="field_title" for="min_stay">Minimum Stay <span class="req">*</span></label>
										<div class="form_input">
											<input name="min_stay" type="hidden" id="min_stay" value="<?php echo $min_stay; ?>" />           
											<ul id="min_stay_con"></ul>
										</div>
									</div>
								</li>
								
								<li>
									<div class="form_grid_12">
										<label class="field_title" for="min_stay">Accommodates<span class="req">*</span></label>
										<div class="form_input">
											<input name="accommodates" type="hidden" id="accommodates" value="<?php echo $accommodates; ?>" />           
											<ul id="accommodates_con"></ul>
										</div>
									</div>
								</li>
								<li>
									<div class="form_grid_12">
										<label class="field_title" for="can_policy">Cancellation Policy<span class="req">*</span></label>
										<div class="form_input">
											<input name="can_policy" type="hidden" id="can_policy" value="<?php echo $can_policy; ?>" />           
											<ul id="can_policy_con"></ul>
										</div>
									</div>
								</li>-->
								
								  
								<li>
									<div class="form_grid_12">
										<div class="form_input">
											<button type="submit" class="btn_small btn_blue" tabindex="9"><span>Submit</span></button>
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
<style>
.widget_content .form_container ul li {
    width: 94% !important;
}
.left_label ul li .form_input {
    width: 64% !important;
}
ul.tagit {
    background: none repeat scroll 0 0 #fff;
	margin-left: 0;
}
</style>
<?php 
$this->load->view('admin/templates/footer.php');
?>