<?php
$imageUpload = $this->uri->segment(5,0);
$this->load->view('admin/templates/header.php');
foreach ($listDetail->result() as $product_listing){
	$product_list_values = $product_listing->listings;
}
foreach ($listValues->result() as $result){
	$values = $result->listing_values;
}
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&signed_in=true&key=<?php echo $this->config->item ( 'google_map_api' );?>"></script>
<?php 
if(!empty($product_details)){ 
	$address = trim(stripslashes($product_details->row()->address));
} else { 
	$address = "";
}
$street = '';
$street1 = '';
$area = '';
$location = '';
$city = '';
$state = '';
$country = '';
$lat = '';
$long = '';
$zip = '';
$address = str_replace(" ", "+", $address);
$google_map_api=$this->config->item('google_map_api');
$json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=$google_map_api");
$json = json_decode($json);
//echo '<pre>';print_r($json);die;
$newAddress = $json->{'results'}[0]->{'address_components'};
foreach($newAddress as $nA)
{
	if($nA->{'types'}[0] == 'route')$street = $nA->{'long_name'};
	if($nA->{'types'}[0] == 'sublocality_level_2')$street1 = $nA->{'long_name'};
	if($nA->{'types'}[0] == 'sublocality_level_1')$area = $nA->{'long_name'};
	if($nA->{'types'}[0] == 'locality')$location = $nA->{'long_name'};
	if($nA->{'types'}[0] == 'administrative_area_level_2')$city = $nA->{'long_name'};
	if($nA->{'types'}[0] == 'administrative_area_level_1')$state = $nA->{'long_name'};
	if($nA->{'types'}[0] == 'country')$country = $nA->{'long_name'};
	if($nA->{'types'}[0] == 'postal_code')$zip = $nA->{'long_name'};
}
if($city == '')
$city = $location;
$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
$lang = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
$bedrooms="";
$beds="";
$bedtype="";
$bathrooms="";
$noofbathrooms="";
$min_stay="";
$accommodates="";
$can_policy="";
if($listValues->num_rows()==1){
	$roombedVal=json_decode($listValues->row()->rooms_bed);
	$bedrooms=$roombedVal->bedrooms;
	$beds=$roombedVal->beds;
	$bedtype=$roombedVal->bedtype;
	$bathrooms=$roombedVal->bathrooms;
	$noofbathrooms=$roombedVal->noofbathrooms;
	$min_stay=$roombedVal->min_stay;
	$accommodates=$roombedVal->accommodates;
	$can_policy=$roombedVal->can_policy;
} 

									  
?>
<script type="text/javascript" src="js/map_find.js"></script>      
<script>
	var myLatlng;
	var citymap = {};
	function initializeMapCircle() {
		var cityCircle;
		var mapOptions = {
			zoom: 12,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById('map'), mapOptions);

		for (var city in citymap) {
			var populationOptions = {
				strokeColor: '#FF0000',
				strokeOpacity: 0.8,
				strokeWeight: 2,
				fillColor: '#FF0000',
				fillOpacity: 0.35,
				map: map,
				center: citymap[city].center,
				radius: Math.sqrt(citymap[city].population) * 100
			};
			// Add the circle for this city to the map.
			cityCircle = new google.maps.Circle(populationOptions);
		}
	}
</script>
<?php if( $lat != 0.00 && $lang != 0.00) { ?> 
<script>
$(function() { load_NewMap();});
var myLatlng = new google.maps.LatLng(<?php echo $lat;?>,<?php echo $lang;?>);
function load_NewMap() 
{ 
	var mapOptions = {
		zoom: 15,
		center: myLatlng,
		draggable:true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	var map = new google.maps.Map(document.getElementById('map'),
		mapOptions);

	var marker = new google.maps.Marker({
			position: myLatlng,
			draggable:true,
			map: map
		});
	google.maps.event.addListener(marker, 'dragend', function() { 
		var newLatitude = this.position.lat();
		var newLongitude = this.position.lng();
		var pos=marker.getPosition();		
		geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			latLng: pos
		},
		function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {	
				var address=results[0].formatted_address;
				$('#autocomplete-admin').val(address);
				getAddressDetails_only();
			}
		});
	});
	
	$('#yes4').click(function(){
		var myLatlng = map.getCenter();
		google.maps.event.trigger(map,'resize',{});
		map.setCenter(myLatlng);
	});

}
	
</script>
<?php } ?>
      
<script type="text/javascript">
function list_amenities(evt){
	if($(evt).is(":checked")){
		var am = $(evt).val();
		$.ajax({
			type: 'POST',
			url: baseURL+'admin/product/get_sublist_values',
			data: {"list_value_id":am},
			dataType:'json',
			success: function(response){
				$(evt).parents('li').append(response.amenities);
			}
		});
	} else {
		$(evt).parents('li').find('ul').remove();
	}
}


function ImageAddClick(){
	var idval =$('#prdiii').val();
	if(idval==0){
		var idval = window.location.hash.substr(1);
	}
	if(idval == 0 || idval == ''){
		alert('Please fill up the product tile!');
	}else {
		$(".dragndrop1").colorbox({width:"1000px", height:"500px", href:baseURL+"admin/product/dragimageuploadinsert/?id="+idval});
	}
}
</script>



<script type="text/javascript">
function delimage(val){
	$('#row'+val).remove();
}
		
$(function() {
	var i = 1;
	$('#add').click(function() {
		$('<div id="row'+i+'" class="control-group field"><input type="text" class="small tipTop" name="imgtitle[]"  maxlength="25"  placeholder="Caption" /> <input class="small tipTop"  placeholder="Priority" name="imgPriority[]" type="text"><div class="uploader" id="uniform-productImage" style=""><input type="file" class="large tipTop" name="product_image[]" id="product_image" onchange="Test.UpdatePreview(this,'+i+')" style="opacity: 0;"><span class="filename" style="-moz-user-select: none;">No file selected</span><span class="action" style="-moz-user-select: none;">Choose File</span></div><img style="display: inline-block; margin: 0 10px; position: relative;top: 13px;" class="img'+i+'" width="150" height="150" alt="" src="images/noimage.jpg"><a href="javascript:void(0);" onclick="return delimage('+i+');"><div class="rmv_btn">Remove</div></a></div></div><br />').fadeIn('slow').appendTo('.imageAdd');
		i++;
	});
	
	Test = { UpdatePreview: function(obj,ival){
          if(!window.FileReader){
          } else {
             var reader = new FileReader();
             var target = null;
             
             reader.onload = function(e) {
              target =  e.target || e.srcElement;
			 
               $(".img"+ival).prop("src", target.result);
             };
              reader.readAsDataURL(obj.files[0]);
          }
        }
    };					 
		
	$('#remove').click(function() {
								
	if(i > 0) {
		$('.field:last').remove();
		i--; 
	}
	});
	
	$('#reset').click(function() {
	
		$('.field').remove();
		$('.field').remove();
		$('#add').show();
		i=0;
	
	
	});
	
	$('#add').click(function() {
		if(i > 15) {
			$('#add').hide();
		
		}
	});
});
</script>
<script type="text/javascript">
function updateDatabase(newLat, newLng){
	$('#latitude').val(newLat);
	$('#longitude').val(newLng);
}
</script>
</head>

<style>
.form_container ul li {
    position: static;
}
#map_canvas{

width:50% !important;}
</style>
<script>
$(document).ready(function(){
	$('.nxtTab').click(function(){
		var cur = $(this).parent().parent().parent().parent().parent();
		cur.hide();
		cur.next().show();
		var tab = cur.parent().parent().prev();
		tab.find('a.active_tab').removeClass('active_tab').parent().next().find('a').addClass('active_tab');
	});
	$('.prvTab').click(function(){
		var cur = $(this).parent().parent().parent().parent().parent();
		cur.hide();
		cur.prev().show();
		var tab = cur.parent().parent().prev();
		tab.find('a.active_tab').removeClass('active_tab').parent().prev().find('a').addClass('active_tab');
	});
	$('#tab2 input[type="checkbox"]').click(function(){
		var cat = $(this).parent().attr('class');
		var curCat = cat;
		var catPos = '';
		var added = '';
		var curPos = curCat.substring(3);
		var newspan = $(this).parent().prev();
		if($(this).is(':checked')){
			while(cat != 'cat1'){
				cat = newspan.attr('class');
				catPos = cat.substring(3);
				if(cat != curCat && catPos<curPos){
					if (jQuery.inArray(catPos, added.replace(/,\s+/g, ',').split(',')) >= 0) {
					    //Found it!
					}else{
						newspan.find('input[type="checkbox"]').attr('checked','checked');
						added += catPos+',';
					}
				}
				newspan = newspan.prev(); 
			}
		}else{
			var newspan = $(this).parent().next();
			if(newspan.get(0)){
				var cat = newspan.attr('class');
				var catPos = cat.substring(3);
			}
			while(newspan.get(0) && cat != curCat && catPos>curPos){
				newspan.find('input[type="checkbox"]').attr('checked',this.checked);	
				newspan = newspan.next(); 	
				cat = newspan.attr('class');
				catPos = cat.substring(3);
			}
		}
	});
	
	$('#addproduct_form1111').validate({ignore: ""});
	$('#addproduct_form1111').validate().settings.ignore = [];
	<?php if($imageUpload != '0' && $imageUpload == 'image'){?>
	$('#nextImage').click();	
	<?php } ?>
});
</script>
<script language="javascript">
function viewAttributes(Val){

	if(Val == 'show'){
		document.getElementById('AttributeView').style.display = 'block';
	}else{
		document.getElementById('AttributeView').style.display = 'none';
	}

}
</script>
<script>
$(document).ready(function(){
	initializeMap();
	//loadMap();
	var i = 1;
	
	var idval = window.location.hash.substr(1);
	if(idval != ''){
		$('#prdiii').val(idval);
	}

	$('#add').click(function() { 
//<!--		$('<div style="float: left; margin: 12px 10px 10px; width:85%;" class="field"><div class="image_text" style="float: left;margin: 5px;margin-right:50px;"><span>Attribute:</span><select name="attribute_name[]" style="width:200px;color:gray;width:206px;" class="chzn-select"><?php //foreach ($atrributeValue->result() as $attrRow){ ?><option value="<?php //echo $attrRow->attribute_name;; ?>"><?php //echo $attrRow->attribute_name; ?></option> <?php //} ?></select></div><div class="attribute_box attrInput" style="float: left;margin: 5px;width: 20%;" ><span>Value :</span><input type="text" style="width:100px;"  name="attribute_val[]" ></div><div class="image_price attrInput" style="float: left;margin: 5px;width: 20%;"><span>Weight :</span><input type="text" style="width:100px;" name="attribute_weight[]" ></div><div class="image_price attrInput" style="float: left;margin: 5px;width: 20%;"><span>Price :</span><input type="text" style="width:100px;" name="attribute_price[]" ></div></div>').fadeIn('slow').appendTo('.inputs');-->
		$('<div style="float: left; margin: 12px 10px 10px; width:85%;" class="field">'+
				'<div class="image_text" style="float: left;margin: 5px;margin-right:50px;">'+
					'<span>List Name:</span>&nbsp;'+
					'<select name="attribute_name[]" onchange="javascript:loadListValues(this)" style="width:200px;color:gray;width:206px;" class="chzn-select">'+
						'<option value="">--Select--</option>'+
						<?php foreach ($atrributeValue->result() as $attrRow){ 
							if (strtolower($attrRow->attribute_name) != 'price'){
						?>
						'<option value="<?php echo $attrRow->id; ?>"><?php echo $attrRow->attribute_name; ?></option>'+
						<?php }} ?>
					 '</select>'+
				'</div>'+
				'<div class="attribute_box attrInput" style="float: left;margin: 5px;" >'+
					 '<span>List Value :</span>&nbsp;'+
					 '<select name="attribute_val[]" style="width:200px;color:gray;width:206px;" class="chzn-select">'+
					 '<option value="">--Select--</option>'+
					 '</select>'+
				'</div>'+
		'</div>').fadeIn('slow').appendTo('.inputs');
		i++;
	});
	
	$('#remove').click(function() {
		$('.field:last').remove();
	});
	
	$('#reset').click(function() {
		$('.field').remove();
		$('#add').show();
		i=0;
	
	
	});
	
	
	var j = 1;
	$('#addAttr').click(function() { 
		$('<div style="float: left; margin: 12px 10px 10px; width:85%;" class="field">'+
				'<div class="image_text" style="float: left;margin: 5px;margin-right:50px;">'+
					'<span>Attribute Name:</span>&nbsp;'+
					'<select name="product_attribute_name[]" style="width:200px;color:gray;width:206px;" class="chzn-select">'+
						'<option value="">--Select--</option>'+
						<?php foreach ($PrdattrVal->result() as $prdattrRow){ ?>
						'<option value="<?php echo $prdattrRow->id; ?>"><?php echo $prdattrRow->attr_name; ?></option>'+
						<?php } ?>
					 '</select>'+
				'</div>'+
				'<div class="attribute_box attrInput" style="float: left;margin: 5px;" >'+
					 '<span>Attribute Price :</span>&nbsp;'+
					 '<input type="text" name="product_attribute_val[]" style="width:75px;color:gray;" class="chzn-select" />'+
				'</div>'+
		'</div>').fadeIn('slow').appendTo('.inputss');
		j++;
	});
	
	$('#removeAttr').click(function() {
		$('.field:last').remove();
	});
	
	
	

});
</script>

<script>

function onlyLetter(input){
   $(input).keypress(function(ev) {
		var keyCode = window.event ? ev.keyCode : ev.which;
   });
}

</script>






<script src="js/site/addProperty.js"></script>

<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_top"> <span class="h_icon list"></span>

          <h6><?php echo $heading; ?></h6>
          <!--<a class="inline cboxElement" href="#inline_content">Inline HTML</a>-->
          <div id="widget_tab">
            <ul>
              <li><a href="#tab1" class="active_tab">Property General Information</a></li>
              <li><a href="#tab2">Images</a></li>
              <li><a href="#tab3">Amenities</a></li>
              <li><a id="yes4" href="#tab4">Address & Availability Information</a></li>
              <li><a href="#tab5">Listing</a></li>
              <li><a href="#tab6">Detailed description</a></li>
              <li><a href="#tab7">SEO</a></li>
            </ul>
          </div>
        </div>
        <div class="widget_content">        

					<form class = 'form_container left_label' id = 'addproduct_form1111', enctype = 'multipart/form-data' action="admin/product/UpdateProduct" onkeypress="return event.keyCode != 13;" method="post">
                    <input type="hidden" name="latitude" id="latitude" value="<?php if($productOldAddress->row()->latitude != '')echo $productOldAddress->row()->latitude; else echo $lat;?>" />
                    <input type="hidden" name="longitude" id="longitude" value="<?php if($productOldAddress->row()->longitude != '')echo $productOldAddress->row()->longitude; echo $lang;?>" />
                    <input type="hidden" name="prdiii" id="prdiii" value="<?php echo $id=$this->uri->segment(4,0); ?>" /> 
					<input type="hidden" name="new_product_id" id="new_product_id"  />
          <div id="tab1">
            <ul class="tab-areas1">
            	<li>
                <div class="form_grid_12">
                  <label class="field_title" for="user_id">Property Owner Name <span class="req">*</span></label>
                  <div class="form_input">
                  <?php 
				  if(!empty($userdetails)){ 
				  echo '<select id="user_ids" name="user_id" >';
				  	foreach($userdetails->result() as $user_details){
				  
				  
				  ?>
                 
                  <option value="<?php echo $user_details->id;?>" <?php if(!empty($product_details)){ if($user_details->id==$product_details->row()->OwnerId){echo 'selected="selected"';} } ?>><?php echo ucfirst($user_details->firstname).' '.ucfirst($user_details->lastname);?></option>
                  
                 <?php  
				 	} echo '</select>';
				 } ?>
                    
                    
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="product_title">Title <span class="req">*</span></label>
                 <div class="form_input">
                  <?php if(!empty($product_details)){  $Valid = trim(stripslashes($product_details->row()->id)); } else {  $Valid=0;}?>
                    <input name="product_title" id="product_title" type="text" tabindex="1" class="required large tipTop" title="Please enter the Property name" onchange="javascript:AdminDetailview(this,document.getElementById('prdiii').value,'title');"  onkeypress="return onlyLetter(this);"  onkeydown = "return (event.keyCode!=13);"
                    value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->product_title)); }?>"/>
                    
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="description">Summary</label>
                  <div class="form_input">
                    <textarea name="description" id="description" tabindex="2" style="width:370px;" class="tipTop mceEditor" title="Please enter the property description"><?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->description)); }?></textarea>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Price per night<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text"  onkeypress="return isNumber(event)" name="price" id="price" tabindex="9" class="required large tipTop" title="Please enter the property price" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->price)); }?>"  onchange="javascript:PriceInsert(this.value,document.getElementById('prdiii').value,'price');"/>
                      
                        
                  </div>
                </div>
              </li>
              
              
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price_perweek">Long-Term Prices </label>
                  <div class="form_input">
                    
                    <input name="price_perweek" onkeypress="return isNumber(event)" id="price_perweek" type="text" tabindex="10" class="large tipTop" title="Please enter the property Price Per Week" placeholder="Per Week" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->price_perweek)); }?>" onchange="javascript:PriceInsert(this.value,document.getElementById('prdiii').value,'price_perweek');"/>
                    <input name="price_permonth" onkeypress="return isNumber(event)" id="price_permonth" type="text" tabindex="11" class="large tipTop" title="Please enter the property Price Per Month" placeholder="Per Month" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->price_permonth)); }?>" onchange="javascript:PriceInsert(this.value,document.getElementById('prdiii').value,'price_permonth');"/>
                  </div>
                </div>
              </li>
			  
			  
			  
			   <li>
                <div class="form_grid_12">
                  <label class="field_title" for="user_id">Deposit Amount</label>
                  <div class="form_input">
                  <input type="text" onkeypress="return IsNumeric(event)" name="security_deposit" id="security_deposit" style="  width: 379px;"     onpaste="return false;" ondrop = "return false;" value="<?php if(!empty($product_details)){ if($product_details->row()->security_deposit!= ''){echo$product_details->row()->security_deposit;} } ?>">
                   <span id="error" style="color: Red; display: none" >* Input digits (0 - 9)</span>
                  </div>
                </div>
              </li>
			  <!--<li>
					<div class="form_grid_12">
						<label class="field_title" for="user_id">Instant Booking</label>
						<div class="form_input">
							<select class="gends" id="instantbook" name="instantbook">
								<option value="yes" <?php if(!empty($product_details)){ if($product_details->row()->instantbook=='yes'){echo 'selected="selected"';}}?>>Yes</option>
								<option value="no" <?php if(!empty($product_details)){ if($product_details->row()->instantbook=='no'){echo 'selected="selected"';}}?>>No</option>
							</select>
						</div>
					</div>
				</li>-->
			  <li>
                <div class="form_grid_12">
                  <label class="field_title" for="user_id">Cancellation Policy</label>
                  <div class="form_input">
                  <select class="gends" id="cancellation_policy" name="cancellation_policy">
				  
				  
					<option value="Flexible" <?php if(!empty($product_details)){ if($product_details->row()->cancellation_policy=='Flexible'){echo 'selected="selected"';}}?>>Flexible</option>
					<option value="Moderate" <?php if(!empty($product_details)){ if($product_details->row()->cancellation_policy=='Moderate'){echo 'selected="selected"';}}?>>Moderate</option>
				<option value="Strict" <?php if(!empty($product_details)){ if($product_details->row()->cancellation_policy=='Strict'){echo 'selected="selected"';}}?>>Strict</option>
				</select>
                    
                  </div>
                </div>
              </li>
			  
			  

			  
			  
			  
			  
			  
              
              
              
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="admin_name">Status <span class="req">*</span></label>
                  <div class="form_input">
                    <div class="publish_unpublish">
                     <input type="checkbox" tabindex="11" name="status" <?php 
					  if(!empty($product_details)){ if(!empty($product_details->row()->status)){if($product_details->row()->status !="UnPublish"){ echo 'checked="checked"'; }}else { echo 'checked="checked"'; } } ?> id="publish_unpublish_publish" class="publish_unpublish"/>
                    </div>
                  </div>
                </div>
              </li>
              
            
              
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue nxtTab" id="nextImage" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div id="tab2">
            <ul class="tab-areas2">
              <li>
               
               
               <?php //include('img_upload.php'); ?>
               
                 <div class="form_grid_12">
                  <label class="field_title" for="product_image">Rental Image <span class="req"></span></label>
              
                    
                    <div class="dragndrop1"><a href="javascript:void(0);" onclick="ImageAddClick();">Choose Image</a></div>
                </div>
              </li >
              <li id="imageUploadList">
                <div class="widget_content">
                  <table class="display display_tbl" id="image_tbl">
                    <thead>
                      <tr align="center">
                        <th > Sno </th>
                        <th> Image </th>
                        <!--<th> Position </th>-->
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
					      // echo "<pre>";print_r($imgDetail->result_array());
							if (!empty($imgDetail) && !empty($product_details)){
								$i=0;$j=1;
								$this->session->set_userdata(array('product_image_'.$product_details->row()->id => $product_details->row()->image));
								foreach ($imgDetail->result() as $img){
									if ($img != ''){
							?>
                      <tr id="img_<?php echo $img->id ?>">
                        <td class="center tr_select "><input type="hidden" name="imaged[]" value="<?php echo $img->product_image; ?>"/>
                          <?php echo $j;?> </td>
                        <td class="center "><img src="<?php if(($img->product_image!='') &&(file_exists('./server/php/rental/thumbnail/'.$img->product_image)))
           { echo base_url();?>server/php/rental/thumbnail/<?php echo $img->product_image; } else { echo base_url();?>server/php/rental/<?php echo $img->product_image; } ?>"  height="80px" width="80px" /> </td>
<!--                        <td class="center"><span>
                          <input type="text" style="width: 15%;" name="changeorder[]" value="<?php echo $i; ?>" size="3" />
                          </span> </td>
-->                        <td class="center tr_select"><ul class="action_list" style="background:none;border-top:none;">
                            <li style="width:100%;"><a class="p_del tipTop" href="javascript:void(0)" onClick="javascript:DeleteProductImage(<?php echo $img->id; ?>,<?php echo $product_details->row()->id; ?>);" title="Delete this image">Remove</a></li>
                          </ul></td>
                      </tr>
                      <?php 
							$j++;
									}
									$i++;
								}
							}
							?>
                    </tbody>
                    <tfoot>
                      <tr align="center">
                        <th> Sno </th>
                        <th> Image </th>
                        <!--<th> Position </th>-->
                        <th> Action </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </li>
			  <li>
                <div class="form_grid_12">
                  <label class="field_title" for="admin_name">Enter Youtube Embed video URL<span class="req"></span></label>
                  <div class="form_input">
                    <div class="publish_unpublish">
                      <input type="text"  name="video_url" id="video_url" onchange="return checkyoutubeurl();"   class="large tipTop"  value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->video_url)); }?>"  />
                    </div>
					<span style="color: red;float: left;font-size: smaller;margin:0 0 10px 0;padding-top: 6px;">Note*:Enter Youtube Embed video URL Ex:(https://www.youtube.com/embed/I4545575)</span>
                  </div>

                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                    <input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          
			<div id="tab3">
				<?php  
					if(!empty($product_details)) {
                         $list_name = $product_details->row()->list_name;						  
						 $facility = (explode(",", $list_name));  
					}    
				?> 
				<?php if($listNameCnt->num_rows()>0){ ?>
				<ul  class="tab-areas3">
					<?php 
					foreach($listNameCnt->result() as $listVals){
					$listValues = $this->product_model->get_all_details(LIST_VALUES,array('list_id'=>$listVals->id));
					?>
					<h3><?php echo $listVals->attribute_name; ?></h3>
					<h6><?php echo $listVals->attribute_title; ?> </h6>
					<?php  
					//if($listValues->num_rows()>0){	
						foreach($listValues->result() as $details){
					?>
                    <li>
						<input type="checkbox" class="checkbox_check" name="list_name[]" id="mostcommon<?php echo $details->id; ?>"  <?php if(in_array($details->id,$facility)) { ?> checked="checked" <?php } ?> value="<?php echo $details->id; ?>"/>
						<span><?php echo $details->list_value; ?></span>
                    </li>
                    <?php 
							}
						//}
					}					
                    ?>      
					<li class="btnsa">
						<div class="form_grid_12">
							<div class="form_input" style="margin:0px;width:100%;">
								<input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
								<input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
							</div>
						</div>
					</li>
				</ul>
			<?php } ?>
			</div>
         
       
          
           <div id="tab4">
            <ul id="AttributeView">
			<li>
                <div class="form_grid_12">
                  <label class="field_title" for="address">Location</label>
                  <div class="form_input">
                    <input id="autocomplete-admin" name="address" onblur="getAddressDetails();" placeholder="Enter your Location" type="text" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->address)); }?>" style="width:370px;" class="required large tipTop" title="Enter your Location">
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="country">Country<span class="req">*</span></label>
                  <div class="form_input">
                    <input placeholder="Enter Country Name"  id="country" name="country" type="text" value="<?php if(!empty($product_details))echo $productAddressData->row()->country; //echo $country;?>" style="width:370px;" class="required large tipTop" title="Enter Country Name">
                  </div>
                </div>
              </li>
           
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="state">State<span class="req">*</span></label>
                  <div class="form_input" id="listCountryCnt">
                    <input placeholder="Enter State Name" id="state" name="state" type="text" value="<?php if(!empty($product_details))echo $productAddressData->row()->state; //echo $state;?>" style="width:370px;" class="required large tipTop" title="Enter State Name">
                  </div>
                </div>
              </li>
              
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="city">City<span class="req">*</span></label>
                  <div class="form_input" id="listStateCnt">
                    <input placeholder="Enter City Name"  id="city" name="city" type="text" value="<?php if(!empty($product_details))echo $productAddressData->row()->city; 
					//echo $city;?>" style="width:370px;" class="required large tipTop" title="Enter City Name">
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="requiredfield_title" for="post_code">Zip Code<span class="req">*</span></label>
                  <div class="form_input">
				  <?php // echo "<pre>"; print_r($productAddressData->result()); ?>
                    <input type="text" name="post_code" id="post_code" tabindex="8" class="required large tipTop" title="Please enter the post code" value="<?php  if(!empty($product_details)) echo $productAddressData->row()->zip; // echo $zip;?>" />
                  </div>
				  <div style="margin-left:30%;margin-top:10px;">
				  <?php if(!empty($product_details)){ $in_address = trim(stripslashes($product_details->row()->address)); ?>
			<!--<img id='map-image' border="0" alt="Greenwich, England" src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $in_address; ?>&zoom=13&size=600x300&maptype=roadmap&sensor=false&format=png&visual_refresh=true&markers=size:mid%7Ccolor:red%7C<?php echo $in_address; ?>">-->
				<!--<img id='map-image' border="0" alt="Greenwich, England" src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $in_address; ?>&zoom=13&size=600x300&maptype=roadmap&sensor=false&format=png&visual_refresh=true&markers=size:mid%7Ccolor:red%7C<?php echo $in_address; ?>"> 
				<img id='map-image' border="0" alt="Greenwich, England" src="http://maps.googleapis.com/maps/api/staticmap?center=Albany,+NY&zoom=13&scale=false&size=600x300&maptype=roadmap&sensor=false&format=png&visual_refresh=true&markers=size:mid%7Ccolor:red%7CAlbany,+NY" alt="Google Map of Albany, NY">-->
					  <?php }?>
					 <!--<div  align="center" id="map-new" style="width: 600px; height: 300px; display:none"><p id='map-text' style="margin-top:150px;">Map will be displayed here</p></div>-->
                  <div id="map" style="width:500px; height:482px"></div>
				  </div>
                </div>
              </li>
              
              
             </ul>
            <ul>
              <li>
                <div class="form_grid_12">
                  <div class="form_input" style="margin:0px;width:100%;">
                    <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                    <input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          
      
          <div id="tab5">
            <ul>
            
              <h4>Listing Info:</h4>
			  
			  
                
				<?php
				
			//$product_info = $product_details->row();
					 foreach ($listSpace->result() as $listresult)
						{
						
				//			echo "<pre>"; echo trim(strtolower($listvalues->list_value))."==". trim(strtolower($product_info->room_type));
					        $name = $listresult->attribute_name;
					         $id = $listresult->id;
						 ?>
				<li>
			<div class="form_grid_12">
				
                  <label class="field_title" for="confirm_email"><?php echo $name; ?></label>
                 <div class="form_input">
                    
					 <?php if($product_details->num_rows != 0 ){ ?>
				<select  name="<?php if($listresult->attribute_seourl == 'propertytype')echo 'home_type';else if($listresult->attribute_seourl == 'roomtype') echo 'room_type';?>"  onchange="javascript:adminlistingview(this,<?php echo $product_details->row()->id; ?>,'<?php if($listresult->attribute_seourl == 'propertytype')echo 'home_type';else if($listresult->attribute_seourl == 'roomtype') echo 'room_type';?>');" autocomplete="off">
						
						
                     <option value="">select</option>
                           <?php
                           $sql = 'SELECT * FROM fc_listspace_values WHERE listspace_id = '.$id;
							$inner = $this->db->query($sql);
							//echo "<pre>"; print_r($inner->result());
							foreach($inner->result() as $listvalues)
						 { 
						 
						 if($pcount == 0){
						 ?>  
							  <option  <?php if((trim($listvalues->list_value) == trim($product_details->row()->home_type) && $id==9) || trim($listvalues->list_value) == trim($product_details->row()->room_type)) echo 'selected="selected"'; ?> ><?php echo $listvalues->list_value; ?></option>
							  <?php } else{  ?>
							   <option  <?php if((trim(strtolower($listvalues->list_value)) == trim(strtolower($product_details->row()->home_type)) && $id==9) || trim(strtolower($listvalues->list_value)) == trim(strtolower($product_details->row()->room_type))) echo 'selected="selected"'; ?> ><?php echo $listvalues->list_value; ?></option>
                                 
						<?php
						
						}
						  
						} ?>
                         </select>
                   <?php } else {


				?>
				<select  name="<?php if($listresult->attribute_seourl == 'propertytype')echo 'home_type';else if($listresult->attribute_seourl == 'roomtype') echo 'room_type';?>"  onchange="javascript:adminlistingview(this,document.getElementById('prdiii').value,'<?php if($listresult->attribute_seourl == 'propertytype')echo 'home_type';else if($listresult->attribute_seourl == 'roomtype') echo 'room_type';?>');" autocomplete="off">
						 <option value="">Select</option>
                           <?php
                           $sql = 'SELECT * FROM fc_listspace_values WHERE listspace_id = '.$id;
							$inner = $this->db->query($sql);
							//echo "<pre>"; print_r($inner->result());
							foreach($inner->result() as $listvalues)
						 { 
						 if($pcount == 0){
						 ?>  
							  <option><?php echo $listvalues->list_value; ?></option>
							  <?php }else{  ?>
							   <option><?php echo $listvalues->list_value; ?></option>
                                 
						<?php
						
						}
						  
						} ?>
                         </select>
						<?php } ?>
					
                  </div>
				  </div>
				   </li>
				  <?php } ?>
                
             
			  
			  
			   
			  
			  
			   <?php		
					$product_list_decode = json_decode($listDetail->row()->listings);
					
						foreach($product_list_decode as $product_list_name => $product_list_values)
						{
						 $product_list_data[$product_list_name] = $product_list_values;
						}
										$roombedVal=json_decode($values);
					
					
						  foreach ($roombedVal as $key => $value){ 			
						$listing_keys[$key] = $key;
						$listing_values[$key] = $value;
						}
						
						 foreach ($listTypeValues->result() as $keys => $finals)
						{
							 $name = $finals->name; 
						if($name != 'can_policy'){
									$list_type = $finals->type;  
					?>
					<li>
                <div class="form_grid_12">
				<label class="field_title" for="confirm_email"><?php echo str_replace('_',' ',$name); ?></label>
                  <div class="form_input">
				  <?php 
				
                             if($list_type == 'option' ) { 
									  
									  ?>
									
					
                   <select name="" id="home_type" class="valid" onchange="javascript:DetaillistValues(this,document.getElementById('prdiii').value,'<?php echo $name; ?>');">
				   <option value="">Select</option>
					     <?php 
						$valuesArr=@explode(',',$listing_values[$name]);
								
									  foreach($valuesArr as $value){
									?>
									
							   <option value="<?php echo $value; ?>" <?php   if($name == 'minimum_stay'){ if($listDetail->row()->minimum_stay == $value){echo 'selected="selected"'; }} else if($product_list_data[$name] == $value){ echo 'selected="selected"'; }   ?> >
											<?php echo $value; ?>
										</option>
							    
							  <?php }?>
							                           
                     </select>
					
					  <?php     } else {  ?>
                            
							 <input type="text"  value="<?php echo  $product_list_data[$name]; ?>" class="text_size" onchange="javascript:DetaillistValues(this,document.getElementById('prdiii').value,'<?php echo $name; ?>');">
							<?php } ?>
					
                  </div>
				  </div>
              </li>
             
               
				<?php }    } ?>
			    
				
              
              <li>
                <div class="form_grid_12">
                  <div class="form_input" style="margin:0px;width:100%;">
                    <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                    <input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
            </ul>
          </div>
         
          <div id="tab6">
            <ul>
            <h3>Details</h3><p>A description of your space displayed on your public listing page. </p>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="space">The Space</label>
                  <div class="form_input">
                                 <textarea name="space" id="space" tabindex="13" style="width:370px;height:100px;" class="large tipTop" title="what makes  your listing unique ?"><?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->space)); }?></textarea>
                    </div>  

                  </div>
                
              </li>
             
              <h3>Extra Details</h3><p>Other information you wish to share on your public  page. </p>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="other_thingnote">Other Things to Note</label>
                  <div class="form_input">
                                 <textarea name="other_thingnote" id="other_thingnote" tabindex="13" style="width:370px;height:100px;" class="large tipTop" title="Are there any other details you’d like to share ?"><?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->other_thingnote)); }?></textarea>
                    </div>  
                  </div>
               
              </li>
              
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="house_rules">House Rules</label>
                  <div class="form_input">
                                 <textarea name="house_rules" id="house_rules" tabindex="13" style="width:370px;height:100px;" class="large tipTop" title="How do you expect your guests to behave ?"><?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->house_rules)); }?></textarea>
                    </div>  
                  </div>
               
              </li>
              
              
            </ul>
            <ul>
              <li>
                <div class="form_grid_12">
                  <div class="form_input" style="margin:0px;width:100%;">
                    <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                    <input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          
          <div id="tab7">
            <ul>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="meta_title">Meta Title</label>
                  <div class="form_input">
                    <input name="meta_title" id="meta_title" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->meta_title)); }?>"/>
                  </div>
                </div>
              </li>
              
                                  <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Keywords</label>
								<div class="form_input">
								   
                                <textarea name="meta_keyword" id="meta_keywords" tabindex="13" style="width:370px;height:150px;" class=" large tipTop" title="Please enter the Address"><?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->meta_keyword)); }?></textarea>
								</div>
								</div>
							</li>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Meta Description</label>
								<div class="form_input">
								<textarea name="meta_description" id="meta_description" tabindex="13" style="width:370px;height:150px;" class=" large tipTop" title="Please enter the Address"> <?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->meta_description)); }?></textarea>
								</div>
								</div>
							</li>

              
              
            </ul>
            <ul>
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                    <button type="submit" onclick="return getProductId();" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <input type="hidden" name="userID" value="<?php if ($loginID != ''){echo $loginID;}else {echo '0';}?>"/>
           
          </form>
        </div>
      </div>
    </div>
  </div>
  <span class="clear"></span> </div>

<style>
.text_size
{
  width: 188px !important;
}
</style>
<script type="text/javascript">


function  getProductId(){
	var idval = window.location.hash.substr(1);
	$('#new_product_id').val(idval);
	return true;
}
        function checkyoutubeurl()
		 {
		 var url=$('#video_url').val();
		 var videourl = matchYoutubeUrl(url);
		 if(videourl!=false){
		     
			}else{
				$('#video_url').val('');
			}
		 }
		 function matchYoutubeUrl(url) {
			var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
			if(url.match(p)){
				return url.match(p)[1];
			}
			return false;
		}
function DealPriceInsert(value,title)
{
var pid=document.getElementById('prdiii').value;

 $.ajax({
type:'POST',
url:'<?php echo base_url()?>admin/product/DealPriceInsert',
data:{val:value,product_id:pid,title:title},
success:function(msg)
{
}
})
}
</script>

<script>
		// This example displays an address form, using the autocomplete feature
		// of the Google Places API to help users fill in the information.

		var placeSearch, autocomplete;
		var componentForm = {
		  street_number: 'short_name',
		  route: 'long_name',
		  locality: 'long_name',
		  administrative_area_level_1: 'short_name',
		  country: 'long_name',
		  postal_code: 'short_name'
		};


		function initializeMap() { 
		  // Create the autocomplete object, restricting the search
		  // to geographical location types.
		  
		  autocomplete = new google.maps.places.Autocomplete(
			  /** @type {HTMLInputElement} */(document.getElementById('autocomplete-admin')),
			  { types: ['geocode'] });
		  // When the user selects an address from the dropdown,
		  // populate the address fields in the form.
		  google.maps.event.addListener(autocomplete, 'place_changed', function() {
			//fillInAddress();
		  });
		}

		// [START region_fillform]
		function fillInAddress() {
		  // Get the place details from the autocomplete object.
		  var place = autocomplete.getPlace();

		  for (var component in componentForm) {
			document.getElementById(component).value = '';
			document.getElementById(component).disabled = false;
		  }

		  // Get each component of the address from the place details
		  // and fill the corresponding field on the form.
		  for (var i = 0; i < place.address_components.length; i++) {
			var addressType = place.address_components[i].types[0];
			if (componentForm[addressType]) {
			  var val = place.address_components[i][componentForm[addressType]];
			  document.getElementById(addressType).value = val;
			}
		  }
		}
		// [END region_fillform]

		// [START region_geolocation]
		// Bias the autocomplete object to the user's geographical location,
		// as supplied by the browser's 'navigator.geolocation' object.


		// [END region_geolocation]

	
	function getAddressDetails_only(){
		var address = $('#autocomplete-admin').val();
			
		$.ajax({
			type: 'POST',
			url: baseURL+'site/product/get_location',
			data: {"address":address},
			dataType:'json',
			success: function(json){
				$('#country').val(json.country);
				$('#state').val(json.state);
				$('#city').val(json.city);
				$('#post_code').val(json.zip);
				$('#apt').val(json.area);
				$('#latitude').val(json.lat);
				$('#longitude').val(json.lang);
			}
		});
	}
	
	function getAddressDetails()
		{
			var address = $('#autocomplete-admin').val();
			
			$.ajax({
				type: 'POST',
				url: baseURL+'site/product/get_location',
				data: {"address":address},
				dataType:'json',
				success: function(json){
					$('#country').val(json.country);
					$('#state').val(json.state);
					$('#city').val(json.city);
					$('#post_code').val(json.zip);
					$('#apt').val(json.area);
					$('#latitude').val(json.lat);
					$('#longitude').val(json.lang);
					
					var mapOptions = {
						zoom: 15,
						center: myLatlng,
						draggable:true,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};

					var map = new google.maps.Map(document.getElementById('map'),
						mapOptions);
						var marker = new google.maps.Marker({
							position: myLatlng,
							draggable:true,
							map: map
						});
					google.maps.event.addListener(marker, 'dragend', function() { 
						var newLatitude = this.position.lat();
						var newLongitude = this.position.lng();
						var pos=marker.getPosition();		
						geocoder = new google.maps.Geocoder();
						geocoder.geocode({
							latLng: pos
						},
						function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {	
								var address=results[0].formatted_address;
								$('#autocomplete-admin').val(address);
								getAddressDetails_only();
							}
						});
					});

				}
			});
			
		}
		function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 45 || charCode > 57)) {
        return false;
    }
    return true;
}
	$('#product_title1').bind('input', function() {
  $(this).val($(this).val().replace(/[^a-z0-9\s]/gi, ''));
});	


function adminlistingview(evt,catID,chk){

	var title = evt.value;

	//alert(chk);

		$.ajax({

			type:'post',

			url:baseURL+'admin/product/saveDetailPage',

			data:{'catID':catID,'title':title,'chk':chk},

			

			success:function(){

				$('#imgmsg_'+catID).hide();

				$('#imgmsg_'+catID).show().text('Saved');

			}

		});

}
	 </script>
	<script type="text/javascript">
        var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        function IsNumeric(e) {
		
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            document.getElementById("error").style.display = ret ? "none" : "inline";
            return ret;
        }
    </script>

<?php 
$this->load->view('admin/templates/footer.php');
?>
