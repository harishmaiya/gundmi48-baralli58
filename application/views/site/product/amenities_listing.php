<?php
$this->load->view('site/templates/header');
$this->load->view('site/templates/listing_head_side');
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js" /></script>
<script type="text/javascript">
function list_amenities(evt)
{
if($(evt).is(":checked")){
	var am = $(evt).val();
	//$(".dashboard_price_right ul li").append('<li><a>Message Center</a></li>');
	$.ajax({
        type: 'POST',
        url: baseURL+'site/product/get_sublist_values',
        data: {"list_value_id":am},
        dataType:'json',
        success: function(response)
		{
       	 	//alert("cccccc");
       		$(evt).parents('li').append(response.amenities);
		}
        });
}
else 
{
//	alert("UNchecked");
	$(evt).parents('li').find('ul').remove();
}
}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('input[name="all"]').bind('click', function(){
			var status = $(this).is(':checked');
			$('input[type="checkbox"]', $(this).parent('li')).attr('checked', status);
		});
	});
</script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<div class="right_side amitie-rights">
	<form name="amenities" method="post" action="site/product/saveAmenitieslist">
		<?php 
		if($listItems->num_rows()>0) {
			foreach($listItems->result() as $list){
		?>   
            <div class="dashboard_price_main">
            	<div class="dashboard_price">
                    <div class="dashboard_price_left">
                    	<h3><?php echo $list->attribute_name; ?></h3>
                        <p><?php echo $list->attribute_title; ?> </p>
                    </div>
                    <div class="dashboard_price_right amitie-right">
                        <ul class="facility_listed">
						<?php /* <input type="checkbox" name="all" id="all" /> <label for='all'>All</label> */ ?>
                        <?php
                        $list_name = $listDetail->row()->list_name;
                        $facility = (explode(",", $list_name));
						$listValues = $this->product_model->get_all_details(LIST_VALUES,array('list_id'=>$list->id));
						if($listValues->num_rows()>0){	
							foreach($listValues->result() as $details){
						?>
                        <li>
							<input type="checkbox" class="checkbox_check"  name="list_name[]" onclick="saveAmenitieslist();" id="amenities-<?php echo $details->id; ?>"   <?php if(in_array($details->id,$facility)) { ?> checked="checked" <?php } ?>value="<?php echo $details->id; ?>"/>
							<span><?php echo $details->list_value; ?></span>
						</li>
                        <?php
							}
						}
                        ?>
                     </ul>
                    </div>
                </div>
            </div>
		<?php 
			}
		}
		?>
		<input type="hidden" name="id" id="property_id" value="<?php echo $listDetail->row()->id;?>" />
        <!--<input type="submit" value="<?php if($this->lang->line('Save') != '') { echo stripslashes($this->lang->line('Save')); } else echo "Save"; ?>" class="newline-btn" />-->
	</form>
</div>
<?php
$this->load->view('site/templates/footer');
?>
<script>
function saveAmenitieslist()
{
	var str='';
	var id=$('#property_id').val();
	$("input[type=checkbox]").each(function() {
		if($(this).is(':checked')) {
			if($(this).val() != 'on')
			{
				str = str+','+$(this).val();
			}
		}
	});
	$.ajax(
	{
		type: 'POST',
		url: baseURL+'site/product/saveAmenitieslist_ajax',
		data:{'string':str,'id':id},
		success: function(data) 
		{
			
		}
		
	});
}
</script>