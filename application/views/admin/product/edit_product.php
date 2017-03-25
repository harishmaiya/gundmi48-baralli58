<?php
$this->load->view('admin/templates/header.php');
?><head>


<script type="text/javascript">
function ImageAddClick(){
var idval =$('#productID').val();
//alert(idval);
$(".dragndrop1").colorbox({width:"1000px", height:"500px", href:baseURL+"admin/product/dragimageuploadinsert/"+idval});
}
</script>




	<script type="text/javascript">
		function updateDatabase(newLat, newLng)
		{//alert(newLat+'-----'+newLng);
		$('#latitude').val(newLat);
		$('#longitude').val(newLng);
			// make an ajax request to a PHP file
			// on our site that will update the database
			// pass in our lat/lng as parameters
		}
	</script>
	<?php  echo $map['js']; ?>
</head>

<style>
#map_canvas{

width:50% !important;}
</style>
<script type="text/javascript">
$(document).ready(function(){
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
<script type="text/javascript">
		function delimage(val){
		$('#row'+val).remove();
		}
		 $(function() {
			
		
		/* product Add images dynamically */
	var i = 1;
	
	
	$('#add').click(function() {
	
			$('<div class="control-group field" id="row'+i+'"><input type="text" class="small tipTop" name="imgtitle[]"  maxlength="25"  placeholder="Caption" /> <input class="small tipTop"  placeholder="Priority" name="imgPriority[]" type="text"><div class="uploader" id="uniform-productImage" style=""><input type="file" class="large tipTop" name="product_image[]" id="product_image" onchange="Test.UpdatePreview(this,'+i+')" style="opacity: 0;"><span class="filename" style="-moz-user-select: none;">No file selected</span><span class="action" style="-moz-user-select: none;">Choose File</span></div><img class="img'+i+'" style="display: inline-block; margin: 0 10px; position: relative;top: 13px;" width="150" height="150" alt="" src="images/noimage.jpg"><a href="javascript:void(0);" onclick="return delimage('+i+');"><div class="rmv_btn">Remove</div></a></div></div>').fadeIn('slow').appendTo('.imageAdd');
			i++;
		});
	
			Test = {
        UpdatePreview: function(obj,ival){
          // if IE < 10 doesn't support FileReader
          if(!window.FileReader){
             // don't know how to proceed to assign src to image tag
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
			$('#add').show();
			i=0;
		
		
		});
		
		$('#add').click(function() {
		if(i > 15) {
			$('#add').hide();
		
		}
		});
		});
	/* end */

		
		
	</script>

<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_top"> <span class="h_icon list"></span>
          <h6>Edit Property</h6>
          <div id="widget_tab">
            <ul>
              <li><a href="#tab1" class="active_tab">Property General Information</a></li>
              <li><a href="#tab2">Images</a></li>
              <li><a href="#tab3">Amenities</a></li>
              <li><a href="#tab4">Address & Availability Information</a></li>
              <li><a href="#tab5">Listing</a></li>
              <li><a href="#tab6">SEO</a></li>
            </ul>
          </div>
        </div>
        <div class="widget_content">
          <?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addproduct_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/product/insertEditProduct',$attributes) ;
/*						$optionsArr = unserialize($product_details->row()->option);
						if (is_array($optionsArr) && count($optionsArr)>0){
							$options = 'available';
							$attNameArr = $optionsArr['attribute_name'];
							$attValArr = $optionsArr['attribute_val'];
							$attWeightArr = $optionsArr['attribute_weight'];
							$attPriceArr = $optionsArr['attribute_price'];
						}else {
*/							$options = '';
//						}
						$list_names = $product_details->row()->list_name;
						$list_names_arr = explode(',', $list_names);
						$list_values = $product_details->row()->list_value;
						$list_values_arr = explode(',', $list_values);
//						$listsArr = array_combine($list_names_arr,$list_values_arr);
//						echo "<pre>";print_r($list_names_arr);print_r($list_values_arr);print_r($listsArr);die;
						$imgArr = explode(',', $product_details->row()->image);
					?>
                    <input type="hidden" name="latitude" id="latitude" value="<?php echo trim(stripslashes($product_details->row()->latitude));?>" />
                    <input type="hidden" name="longitude" id="longitude" value="<?php echo trim(stripslashes($product_details->row()->longitude));?>" />
          <div id="tab1">
            <ul>
            <li>
                <div class="form_grid_12">
                  <label class="field_title" for="user_id">Rental Owner Name <span class="req">*</span></label>
                  <div class="form_input">
                  <?php 
				  if(!empty($userdetails)){ echo '<select name="user_id" >';
				  	foreach($userdetails->result() as $user_details){
				  
				  
				  ?>
                 
                  <option value="<?php echo $user_details->id;?>" <?php if($product_details->row()->OwnerId==$user_details->id){echo 'selected="selected"';} ?>><?php echo ucfirst($user_details->firstname).' '.ucfirst($user_details->lastname);?></option>
                  
                 <?php  
				 	} echo '</select>';
				 } ?>
                    
                    
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="product_name">Rental Name <span class="req">*</span></label>
                  <div class="form_input">
                    <input name="product_name" id="product_name" value="<?php echo trim(stripslashes($product_details->row()->product_title));?>" type="text" tabindex="1" class="required large tipTop" title="Please enter the product name"/>
                  </div>
                </div>
              </li>
             <!-- <li>
                <div class="form_grid_12">
                  <label class="field_title" for="product_title">Rental Title <span class="req">*</span></label>
                  <div class="form_input">
                    <input name="product_title" id="product_title" type="text" tabindex="1" value="<?php echo trim(stripslashes($product_details->row()->product_title));?>" class="required large tipTop" title="Please enter the product title"/>
                  </div>
                </div>
              </li>-->
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="description">Description<span class="req">*</span></label>
                  <div class="form_input">
                    <textarea name="description" id="description" tabindex="2" style="width:370px;" class="tipTop mceEditor" title="Please enter the product description"><?php echo $product_details->row()->description;?></textarea>
                  </div>
                </div>
              </li>
             <!-- <li>
                <div class="form_grid_12">
                  <label class="field_title" for="description">Excerpt</label>
                  <div class="form_input">
                    <textarea name="excerpt" id="excerpt" tabindex="3" style="width:370px;" class="large tipTop" title="Please enter the product Excerpt"><?php echo $product_details->row()->excerpt;?></textarea>
                  </div>
                </div>
              </li>-->
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Rent / Price<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="price" id="price" value="<?php echo trim(stripslashes($product_details->row()->price));?>" tabindex="9" class="required large tipTop" title="Please enter the product price" /> &nbsp;&nbsp;Per Night
                    <input type="text" name="price_perweek" id="price_perweek" value="<?php echo trim(stripslashes($product_details->row()->price_perweek));?>" tabindex="10" class="required large tipTop" title="Please enter the product price Per Week" /> &nbsp;&nbsp;Per Week
                    <input type="text" name="price_permonth" id="price_permonth" value="<?php echo trim(stripslashes($product_details->row()->price_permonth));?>" tabindex="11" class="required large tipTop" title="Please enter the product price Per Month" /> &nbsp;&nbsp;Per Month
                    <select name="currency" id="currency">
                             <option value="ARS" <?php if($product_details->row()->currency == 'ARS') echo 'selected="selected"';?>>ARS</option>
                                    
                             <option value="AUD" <?php if($product_details->row()->currency == 'AUD') echo 'selected="selected"';?>>AUD</option>
                                    
                             <option value="BRL" <?php if($product_details->row()->currency == 'BRL') echo 'selected="selected"';?>>BRL</option>
                                    
                             <option value="CAD" <?php if($product_details->row()->currency == 'CAD') echo 'selected="selected"';?>>CAD</option>
                                    
                             <option value="CHF" <?php if($product_details->row()->currency == 'CHF') echo 'selected="selected"';?>>CHF</option>
                                    
                             <option value="CNY" <?php if($product_details->row()->currency == 'CNY') echo 'selected="selected"';?>>CNY</option>
                                    
                             <option value="CZK" <?php if($product_details->row()->currency == 'CZK') echo 'selected="selected"';?>>CZK</option>
                                    
                             <option value="DKK" <?php if($product_details->row()->currency == 'DKK') echo 'selected="selected"';?>>DKK</option>
                                    
                             <option value="EUR" <?php if($product_details->row()->currency == 'EUR') echo 'selected="selected"';?>>EUR</option>
                                    
                             <option value="GBP" <?php if($product_details->row()->currency == 'GBP') echo 'selected="selected"';?>>GBP</option>
                                    
                             <option value="HKD" <?php if($product_details->row()->currency == 'HKD') echo 'selected="selected"';?>>HKD</option>
                                    
                             <option value="HUF" <?php if($product_details->row()->currency == 'HUF') echo 'selected="selected"';?>>HUF</option>
                                    
                             <option value="IDR" <?php if($product_details->row()->currency == 'IDR') echo 'selected="selected"';?>>IDR</option>
                                    
                             <option value="ILS" <?php if($product_details->row()->currency == 'ILS') echo 'selected="selected"';?>>ILS</option>
                                   
                             <option value="INR" <?php if($product_details->row()->currency == 'INR') echo 'selected="selected"';?>>INR</option>
                                    
                             <option value="JPY" <?php if($product_details->row()->currency == 'JPY') echo 'selected="selected"';?>>JPY</option>
                                    
                             <option value="KRW" <?php if($product_details->row()->currency == 'KRW') echo 'selected="selected"';?>>KRW</option>
                                    
                             <option value="MYR" <?php if($product_details->row()->currency == 'MYR') echo 'selected="selected"';?>>MYR</option>
                                    
                             <option value="MXN" <?php if($product_details->row()->currency == 'MXN') echo 'selected="selected"';?>>MXN</option>
                                    
                             <option value="NOK" <?php if($product_details->row()->currency == 'NOK') echo 'selected="selected"';?>>NOK</option>
                                    
                             <option value="NZD" <?php if($product_details->row()->currency == 'NZD') echo 'selected="selected"';?>>NZD</option>
                                    
                             <option value="PHP" <?php if($product_details->row()->currency == 'PHP') echo 'selected="selected"';?>>PHP</option>
                                    
                             <option value="PLN" <?php if($product_details->row()->currency == 'PLN') echo 'selected="selected"';?>>PLN</option>
                                    
                             <option value="RUB" <?php if($product_details->row()->currency == 'RUB') echo 'selected="selected"';?>>RUB</option>
                                    
                             <option value="SEK" <?php if($product_details->row()->currency == 'SEK') echo 'selected="selected"';?>>SEK</option>
                                    
                             <option value="SGD" <?php if($product_details->row()->currency == 'SGD') echo 'selected="selected"';?>>SGD</option>
                                    
                             <option value="THB" <?php if($product_details->row()->currency == 'THB') echo 'selected="selected"';?>>THB</option>
                                    
                             <option value="TRY" <?php if($product_details->row()->currency == 'TRY') echo 'selected="selected"';?>>TRY</option>
                                    
                             <option value="TWD" <?php if($product_details->row()->currency == 'TWD') echo 'selected="selected"';?>>TWD</option>
                                    
                             <option value="USD" <?php if($product_details->row()->currency == 'USD') echo 'selected="selected"';?>>USD</option>
                                    
                             <option value="VND" <?php if($product_details->row()->currency == 'VND') echo 'selected="selected"';?>>VND</option>
                                    
                             <option value="ZAR" <?php if($product_details->row()->currency == 'ZAR') echo 'selected="selected"';?>>ZAR</option>
                        </select>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="admin_name">Status <span class="req">*</span></label>
                  <div class="form_input">
                    <div class="publish_unpublish">
                      <input type="checkbox" tabindex="11" name="status" <?php if ($product_details->row()->status == 'Publish'){ echo 'checked="checked"';}?> id="publish_unpublish_publish" class="publish_unpublish"/>
                    </div>
                  </div>
                </div>
              </li>
             <!-- <li>
                <div class="form_grid_12">
                  <label class="field_title" for="property_name">Property Name</label>
                  <div class="form_input">
                    <input type="text" name="property_name" id="property_name" value="<?php echo trim(stripslashes($product_details->row()->property_name));?>" tabindex="8" class="large tipTop" title="Please enter the property name" />
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="holding_no">Plot or Holding Number</label>
                  <div class="form_input">
                    <input type="text" name="holding_no" id="holding_no" value="<?php echo trim(stripslashes($product_details->row()->holding_no));?>" tabindex="8" class="large tipTop" title="Enter Plot / Holding Number of the property" />
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="accomodate">Accomodates</label>
                  <div class="form_input">
                 <select name="accomodate" id="accomodate" title="Enter Accomodation number">
               
                                <?php foreach($product_accomodate->result() as $accomodateValue){?>
                                <option value="<?php echo $accomodateValue->accomodate?>" <?php if($accomodateValue->accomodate==$product_details->row()->accomodate){ ?>selected="selected" <?php } ?>><?php echo $accomodateValue->accomodate?></option>
                                <?php } ?>
                                
                  
                  <option value="1" >1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    </select>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="no_of_star">Number of Stars (1-5 in number)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="no_of_star" id="no_of_star" value="<?php echo trim(stripslashes($product_details->row()->no_of_star));?>" tabindex="8" class="large tipTop" title="Type the Number of starts to be given for this Vacation Rental. Not more then 05" />
                  </div>
                </div>
              </li>-->
              
              
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <button type="submit" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>
                  </div>
                </div>
              </li>
              
            </ul>
            
           
            
            
            
            
          </div>
          
          <div id="tab2">
            <ul>
              <li>
                <!--<div class="form_grid_12">
                  <label class="field_title" for="product_image">Rental Image</label>
                  <div class="form_input">
                    <input name="product_image[]" id="product_image" type="file" tabindex="7" class="large multi tipTop" title="Please select product image"/>
                    <span class="input_instruction green">You Can Upload Multiple Images</span> </div>
                </div>-->
                
                <div class="form_grid_12">
                  <label class="field_title" for="product_image">Rental Image (Image Size 630px X 420px)</label>
                 <!-- <div class="form_input controls imageAdd">
                
                    <div id="addRemoveResetProd"  class="product-add-remove">
                       <span id="add" style="cursor: pointer;" class="icon32 icon-add" title="Add Image"><div class="btn_30_light">
									<a href="javascript:void(0);"><span class="icon add_co"></span><span class="btn_link">Add</span></a>
								</div></span>
                       <span id="remove" class="icon32 icon-cross" title="Remove"><div class="btn_30_light">
									<a href="javascript:void(0);"><span class="icon cancel_co"></span><span class="btn_link" >Remove</span></a>
								</div></span>                       
                       
                </div>
                    <span class="input_instruction green">Note: Image Minimum Size : 600 X 600 pixels</span> </div>-->
                    <div class="dragndrop1"><button onclick="ImageAddClick();">Choose Image</button></div>
                </div>
              </li>
              <li>
                <div class="widget_content">
                  <table class="display display_tbl" id="image_tbl">
                    <thead>
                      <tr>
                        <th class="center"> Sno </th>
                        <th> Image </th>
                        <th> Position </th>
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
							if (count($imgArr)>0){
								$i=0;$j=1;
								$this->session->set_userdata(array('product_image_'.$product_details->row()->id => $product_details->row()->image));
								foreach ($imgDetail->result() as $img){
									if ($img != ''){
							?>
                      <tr id="img_<?php echo $i ?>">
                        <td class="center tr_select "><input type="hidden" name="imaged[]" value="<?php echo $img->product_image; ?>"/>
                          <?php echo $j;?> </td>
                        <td class="center"><img src="<?php echo base_url();?>server/php/rental/<?php echo $img->product_image; ?>"  height="80px" width="80px" /> </td>
                        <td class="center"><span>
                          <input type="text" style="width: 15%;" name="changeorder[]" value="<?php echo $i; ?>" size="3" />
                          </span> </td>
                        <td class="center"><ul class="action_list" style="background:none;border-top:none;">
                            <li style="width:100%;"><a class="p_del tipTop" href="javascript:void(0)" onclick="editPictureProducts(<?php echo $i; ?>,<?php echo $product_details->row()->id;?>);" title="Delete this image">Remove</a></li>
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
                      <tr>
                        <th class="center"> Sno </th>
                        <th> Image </th>
                        <th> Position </th>
                        <th> Action </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <button type="submit" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div id="tab3">
            <ul id="AttributeView">
              <li><?php echo $listCountryValue; ?>
               <button type="submit" style="margin-top: 20px;" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>
              </li>
            </ul>
          </div>
          <div id="tab4">
            <ul id="AttributeView">
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="country">Country<span class="req">*</span></label>
                  <div class="form_input">
                    <select class="chzn-select required" onchange="javascript:loadCountryListValues(this)" name="country" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the country name">
                      <?php foreach ($RentalCountry->result() as $row){
						if($row->id==$product_details->row()->country){					
						echo '<option value="'.$row->id.'">'.$row->name.'</option>';					
						}					?>
                      <option value="<?php echo $row->id;?>" <?php if($row->id==$product_details->row()->country){ echo 'selected="selected"'; } ?>><?php echo $row->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="state">State<span class="req">*</span></label>
                  <div class="form_input">
                  <select class="chzn-select required" name="state" onchange="javascript:loadStateListValues(this)" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the state name">
                      <option value=""></option>
                      <?php foreach ($RentalState->result() as $row){
					  if($row->id==$product_details->row()->state){					
						echo '<option value="'.$row->id.'">'.$row->name.'</option>';					
						}	
					   ?>
							<option value="<?php echo $row->id;?>"<?php if($row->id==$product_details->row()->state){ echo 'selected="selected"'; } ?>><?php echo $row->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="city">City<span class="req">*</span></label>
                  <div class="form_input">
                  	<select class="chzn-select required" name="city" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the city name">
                      <option value=""></option>
                      <?php foreach ($RentalCity->result() as $row){?>
                      		<option value="<?php echo $row->id;?>"<?php if($row->id==$product_details->row()->city){ echo 'selected="selected"'; } ?>><?php echo $row->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="post_code">Post Code<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="post_code" id="post_code" value="<?php echo trim(stripslashes($product_details->row()->post_code));?>" tabindex="8" class="large tipTop" title="Please enter the post code" />
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="apt">Apt, Suite, Bldg.(optional)</label>
                  <div class="form_input">
                    <input type="text" name="apt" id="apt" value="<?php echo trim(stripslashes($product_details->row()->apt));?>" tabindex="8" class="large tipTop" title="Please enter the apt name(optional)" />
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="address">Address</label>
                  <div class="form_input">
                    <textarea type="text" name="address" id="address" tabindex="3" style="width:370px;" class="large tipTop" title="Enter address"><?php echo trim(stripslashes($product_details->row()->address));?></textarea>
                  </div>
                </div>
              </li>
     <!--         <li>
                <div class="form_grid_12">
                  <label class="field_title" for="address">Set location Map</label>
                  <div class="form_input">
                    <?php echo $map['html']; ?>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="feature">Feature Information</label>
                  <div class="form_input">
                    <textarea name="feature" id="feature" tabindex="5" style="width:370px;" class="tipTop mceEditor" title="Please enter the product feature"><?php echo $product_details->row()->feature;?></textarea>
                  </div>
                </div>
              </li>-->
              <h4>Available Information </h4>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="datefrom">Availabe From: <span class="req">*</span></label>
                  <div class="form_input">
                    <input name="datefrom" id="datefrom" value="<?php echo $product_details->row()->datefrom;?>" type="text" tabindex="5" class="required small tipTop datepicker" title="Please select the date"/>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="dateto">Available To: <span class="req">*</span></label>
                  <div class="form_input">
                    <input name="dateto" id="dateto" value="<?php echo $product_details->row()->dateto;?>" type="text" tabindex="6" class="required small tipTop datepicker" title="Please select the date"/>
                  </div>
                </div>
              </li>
              <!--<li>
                <div class="form_grid_12">
                  <label class="field_title" for="expiredate">Expire Date: <span class="req">*</span></label>
                  <div class="form_input">
                    <input name="expiredate" id="expiredate" value="<?php echo $product_details->row()->expiredate;?>" type="text" tabindex="6" class="required small tipTop datepicker" title="Please select the date"/>
                  </div>
                </div>
              </li>
              <h4>Others Information</h4>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="google_map">Google Map: </label>
                  <div class="form_input">
                    <textarea name="google_map" id="google_map" tabindex="5" style="width:370px;" class="tipTop" title="Please enter the google map "><?php echo $product_details->row()->google_map;?></textarea>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="add_feature">Additional Feature: </label>
                  <div class="form_input">
                    <textarea name="add_feature" id="add_feature" tabindex="5" style="width:370px;" class="tipTop" title="Please enter the additional feature "><?php echo $product_details->row()->add_feature;?></textarea>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="rentals_policy">Rentals Policy: </label>
                  <div class="form_input">
                    <textarea name="rentals_policy" id="rentals_policy" tabindex="5" style="width:370px;" class="tipTop" title="Please enter the product "><?php echo $product_details->row()->rentals_policy;?></textarea>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="trams_condition">Trams and condition : </label>
                  <div class="form_input">
                    <textarea name="trams_condition" id="trams_condition" tabindex="5" style="width:370px;" class="tipTop" title="Please enter the product "><?php echo $product_details->row()->trams_condition;?></textarea>
                  </div>
                </div>
              </li>-->
                <button type="submit" style="margin-top: 20px;" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>
              </li>
            </ul>
          </div>
          <div id="tab5">
            <ul>
              
                <h4>  <label class="field_title" for="confirm_email">Listing Info:</label></h4>
                
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="confirm_email">Home Type</label>
                  <div class="form_input">
                    
					<select name="home_type" id="home_type">
                    	  <option value="apartment" <?php if($product_details->row()->home_type == 'apartment') echo 'selected="selected"'; ?>>Apartment</option>
                          <option value="house" <?php if($product_details->row()->home_type == 'house') echo 'selected="selected"'; ?>>House</option>
                          <option value="bed breakfast"<?php if($product_details->row()->home_type == 'bed breakfast') echo 'selected="selected"'; ?>>Bed &amp; Breakfast</option>
                          <option value="loft"<?php if($product_details->row()->home_type == 'loft') echo 'selected="selected"'; ?>>Loft</option>
                          <option value="cabin"<?php if($product_details->row()->home_type == 'cabin') echo 'selected="selected"'; ?>>Cabin</option>
                                      
                                      <option value="villa"<?php if($product_details->row()->home_type == 'villa') echo 'selected="selected"'; ?>>Villa</option>
                                      
                                      <option value="castle"<?php if($product_details->row()->home_type == 'castle') echo 'selected="selected"'; ?>>Castle</option>
                                      
                                      <option value="dorm"<?php if($product_details->row()->home_type == 'dorm') echo 'selected="selected"'; ?>>Dorm</option>
                                      
                                      <option value="treehouse"<?php if($product_details->row()->home_type == 'treehouse') echo 'selected="selected"'; ?>>Treehouse</option>
                                      
                                      <option value="boat"<?php if($product_details->row()->home_type == 'boat') echo 'selected="selected"'; ?>>Boat</option>
                                      
                                      <option value="plane"<?php if($product_details->row()->home_type == 'plane') echo 'selected="selected"'; ?>>Plane</option>
                                      
                                      <option value="parking space"<?php if($product_details->row()->home_type == 'parking space') echo 'selected="selected"'; ?>>Parking Space</option>
                                      
                                      <option value="car"<?php if($product_details->row()->home_type == 'car') echo 'selected="selected"'; ?>>Car</option>
                                      
                                      <option value="van"<?php if($product_details->row()->home_type == 'van') echo 'selected="selected"'; ?>>Van</option>
                                      
                                      <option value="camper/rv"<?php if($product_details->row()->home_type == 'camper/rv') echo 'selected="selected"'; ?>>Camper/RV</option>
                                      
                                      <option value="igloo"<?php if($product_details->row()->home_type == 'igloo') echo 'selected="selected"'; ?>>Igloo</option>
                                      
                                      <option value="lighthouse"<?php if($product_details->row()->home_type == 'lighthouse') echo 'selected="selected"'; ?>>Lighthouse</option>
                                      
                                      <option value="yurt"<?php if($product_details->row()->home_type == 'yurt') echo 'selected="selected"'; ?>>Yurt</option>
                                      
                                      <option value="tipi"<?php if($product_details->row()->home_type == 'tipi') echo 'selected="selected"'; ?>>Tipi</option>
                                      
                                      <option value="cave"<?php if($product_details->row()->home_type == 'cave') echo 'selected="selected"'; ?>>Cave</option>
                                      
                                      <option value="island"<?php if($product_details->row()->home_type == 'island') echo 'selected="selected"'; ?>>Island</option>
                                      
                                      <option value="chalet"<?php if($product_details->row()->home_type == 'chalet') echo 'selected="selected"'; ?>>Chalet</option>
                                      
                                      <option value="earth house"<?php if($product_details->row()->home_type == 'earth house') echo 'selected="selected"'; ?>>Earth House</option>
                                      
                                      <option value="hut"<?php if($product_details->row()->home_type == 'hut') echo 'selected="selected"'; ?>>Hut</option>
                                      
                                      <option value="train"<?php if($product_details->row()->home_type == 'train') echo 'selected="selected"'; ?>>Train</option>
                                      
                                      <option value="tent"<?php if($product_details->row()->home_type == 'tent') echo 'selected="selected"'; ?>>Tent</option>
                                      
                                      <option value="other"<?php if($product_details->row()->home_type == 'other') echo 'selected="selected"'; ?>>Other</option>
                     </select>
                    
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="confirm_email">Room Type</label>
                  <div class="form_input">
                    <?php $type = $product_details->row()->room_type;?>
					<select name="room_type" id="room_type">
                    	<option <?php if($type == 'entire home/apt') echo 'selected="selected"' ; ?> value="entire home/apt">Entire home/apt</option>
                        <option <?php if($type == 'private room') echo 'selected="selected"' ; ?> value="private room">Private room</option>
                        <option <?php if($type == 'shared room') echo 'selected="selected"' ; ?> value="shared room">Shared room</option>
                    </select>
                   
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="confirm_email">Accommodates</label>
                  <div class="form_input">
                    
					<select name="accommodates" id="accommodates">
                    	  <option value="1" <?php if($product_details->row()->accommodates == 1) echo 'selected="selected"'; ?>>1</option>
                                      
                                      <option value="2"<?php if($product_details->row()->accommodates == 2) echo 'selected="selected"'; ?>>2</option>
                                      
                                      <option value="3"<?php if($product_details->row()->accommodates == 3) echo 'selected="selected"'; ?>>3</option>
                                      
                                      <option value="4"<?php if($product_details->row()->accommodates == 4) echo 'selected="selected"'; ?>>4</option>
                                      
                                      <option value="5"<?php if($product_details->row()->accommodates == 5) echo 'selected="selected"'; ?>>5</option>
                                      
                                      <option value="6"<?php if($product_details->row()->accommodates == 6) echo 'selected="selected"'; ?>>6</option>
                                      
                                      <option value="7"<?php if($product_details->row()->accommodates == 7) echo 'selected="selected"'; ?>>7</option>
                                      
                                      <option value="8"<?php if($product_details->row()->accommodates == 8) echo 'selected="selected"'; ?>>8</option>
                                      
                                      <option value="9"<?php if($product_details->row()->accommodates == 9) echo 'selected="selected"'; ?>>9</option>
                                      
                                      <option value="10"<?php if($product_details->row()->accommodates == 10) echo 'selected="selected"'; ?>>10</option>
                                      
                                      <option value="11"<?php if($product_details->row()->accommodates == 11) echo 'selected="selected"'; ?>>11</option>
                                      
                                      <option value="12"<?php if($product_details->row()->accommodates == 12) echo 'selected="selected"'; ?>>12</option>
                                      
                                      <option value="13"<?php if($product_details->row()->accommodates == 13) echo 'selected="selected"'; ?>>13</option>
                                      
                                      <option value="14"<?php if($product_details->row()->accommodates == 14) echo 'selected="selected"'; ?>>14</option>
                                      
                                      <option value="15" <?php if($product_details->row()->accommodates == 15) echo 'selected="selected"'; ?>>15</option>
                                      
                                      <option value="16"<?php if($product_details->row()->accommodates == "16") echo 'selected="selected"'; ?>>16+</option>
                    </select>
                   
                  </div>
                </div>
              </li>
             	<h4>Rooms and beds:</h4>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="confirm_email">Bedrooms</label>
                  <div class="form_input">
                    
					<select name="bedrooms" id="bedrooms">
                    	 <option value="studio" <?php if($product_details->row()->bedrooms == "studio") echo 'selected="selected"'; ?>>Studio</option>
                         <option value="1" <?php if($product_details->row()->bedrooms == 1) echo 'selected="selected"'; ?>>1</option>
                         <option value="2" <?php if($product_details->row()->bedrooms == 2) echo 'selected="selected"'; ?>>2</option>
                         <option value="3" <?php if($product_details->row()->bedrooms == 3) echo 'selected="selected"'; ?>>3</option>
                         <option value="4" <?php if($product_details->row()->bedrooms == 4) echo 'selected="selected"'; ?>>4</option>
                         <option value="5" <?php if($product_details->row()->bedrooms == 5) echo 'selected="selected"'; ?>>5</option>
                         <option value="6" <?php if($product_details->row()->bedrooms == 6) echo 'selected="selected"'; ?>>6</option>
                         <option value="7" <?php if($product_details->row()->bedrooms == 7) echo 'selected="selected"'; ?>>7</option>
                         <option value="8" <?php if($product_details->row()->bedrooms == 8) echo 'selected="selected"'; ?>>8</option>
                         <option value="9" <?php if($product_details->row()->bedrooms == 9) echo 'selected="selected"'; ?>>9</option>
                         <option value="10" <?php if($product_details->row()->bedrooms == 10) echo 'selected="selected"'; ?>>10</option>
                     </select>
                    
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="confirm_email">Beds</label>
                  <div class="form_input">
                    
					<select name="beds" id="beds">
                    	 <option value="1" <?php if($product_details->row()->beds == 1) echo 'selected="selected"'; ?>>1</option>
                         <option value="2" <?php if($product_details->row()->beds == 2) echo 'selected="selected"'; ?>>2</option>
                       	 <option value="3" <?php if($product_details->row()->beds == 3) echo 'selected="selected"'; ?>>3</option>
                       	 <option value="4" <?php if($product_details->row()->beds == 4) echo 'selected="selected"'; ?>>4</option>
                       	 <option value="5" <?php if($product_details->row()->beds == 5) echo 'selected="selected"'; ?>>5</option>
                      	 <option value="6" <?php if($product_details->row()->beds == 6) echo 'selected="selected"'; ?>>6</option>
                       	 <option value="7" <?php if($product_details->row()->beds == 7) echo 'selected="selected"'; ?>>7</option>
                      	 <option value="8" <?php if($product_details->row()->beds == 8) echo 'selected="selected"'; ?>>8</option>
                         <option value="9" <?php if($product_details->row()->beds == 9) echo 'selected="selected"'; ?>>9</option>
                       	 <option value="10" <?php if($product_details->row()->beds == 10) echo 'selected="selected"'; ?>>10</option>
                         <option value="11" <?php if($product_details->row()->beds == 11) echo 'selected="selected"'; ?>>11</option>
                       	 <option value="12" <?php if($product_details->row()->beds == 12) echo 'selected="selected"'; ?>>12</option>
                       	 <option value="13" <?php if($product_details->row()->beds == 13) echo 'selected="selected"'; ?>>13</option>
                       	 <option value="14" <?php if($product_details->row()->beds == 14) echo 'selected="selected"'; ?>>14</option>
                         <option value="15" <?php if($product_details->row()->beds == 15) echo 'selected="selected"'; ?>>15</option>
                      	 <option value="16" <?php if($product_details->row()->beds == "16") echo 'selected="selected"'; ?>>16+</option>
                                       
                    </select>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="confirm_email">Bed type</label>
                  <div class="form_input">
                    
					<select name="bed_type" id="bed_type">
                    	<option value="airbed" <?php if($product_details->row()->bed_type == "airbed") echo 'selected="selected"'; ?>>Airbed</option>
                     	<option value="futon" <?php if($product_details->row()->bed_type == "futon") echo 'selected="selected"'; ?>>Futon</option>
                        <option value="pull-out sofa" <?php if($product_details->row()->bed_type == "pull-out sofa") echo 'selected="selected"'; ?>>Pull-out sofa</option>
                       	<option value="couch" <?php if($product_details->row()->bed_type == "couch") echo 'selected="selected"'; ?>>Couch</option>
                       	<option value="real bed" <?php if($product_details->row()->bed_type == "real bed") echo 'selected="selected"'; ?>>Real bed</option>
                     </select>
                    
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="confirm_email">Bathrooms</label>
                  <div class="form_input">
                    
					<select name="bathrooms" id="bathrroms">
                    	 <option value="0" <?php if($product_details->row()->bathrooms == 0) echo 'selected="selected"'; ?>>0</option>
                         <option value="0.5" <?php if($product_details->row()->bathrooms == "0.5") echo 'selected="selected"'; ?>>0.5</option>
                         <option value="1" <?php if($product_details->row()->bathrooms == 1) echo 'selected="selected"'; ?>>1</option>
                         <option value="1.5" <?php if($product_details->row()->bathrooms == "1.5") echo 'selected="selected"'; ?>>1.5</option>
                         <option value="2" <?php if($product_details->row()->bathrooms == 2) echo 'selected="selected"'; ?>>2</option>
                   		 <option value="2.5" <?php if($product_details->row()->bathrooms == "2.5") echo 'selected="selected"'; ?>>2.5</option>
                       	 <option value="3" <?php if($product_details->row()->bathrooms == 3) echo 'selected="selected"'; ?>>3</option>
                       	 <option value="3.5" <?php if($product_details->row()->bathrooms == "3.5") echo 'selected="selected"'; ?>>3.5</option>
                       	 <option value="4" <?php if($product_details->row()->bathrooms == 4) echo 'selected="selected"'; ?>>4</option>
                       	 <option value="4.5" <?php if($product_details->row()->bathrooms == "4.5") echo 'selected="selected"'; ?>>4.5</option>
                       	 <option value="5" <?php if($product_details->row()->bathrooms == 5) echo 'selected="selected"'; ?>>5</option>
                       	 <option value="5.5" <?php if($product_details->row()->bathrooms == "5.5") echo 'selected="selected"'; ?>>5.5</option>
                       	 <option value="6" <?php if($product_details->row()->bathrooms == 6) echo 'selected="selected"'; ?>>6</option>
                      	 <option value="6.5" <?php if($product_details->row()->bathrooms == "6.5") echo 'selected="selected"'; ?>>6.5</option>
                       	 <option value="7" <?php if($product_details->row()->bathrooms == 7) echo 'selected="selected"'; ?>>7</option>
                      	 <option value="7.5" <?php if($product_details->row()->bathrooms == "7.5") echo 'selected="selected"'; ?>>7.5</option>
                         <option value="8" <?php if($product_details->row()->bathrooms == "8") echo 'selected="selected"'; ?>>8+</option>
                    </select>
                   
                  </div>
                </div>
              </li>
              </ul>
            <ul>
              <li>
                <div class="form_grid_12">
                  <div class="form_input" style="margin:0px;width:100%;">
                    <?php /*?><input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                    <input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/><?php */?>
                     <button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div id="tab6">
            <ul>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="meta_title">Meta Title</label>
                  <div class="form_input">
                    <input name="meta_title" id="meta_title" value="<?php echo $product_details->row()->meta_title;?>" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="meta_tag">Meta Keyword</label>
                  <div class="form_input">
                    <textarea name="meta_keyword" id="meta_keyword"  tabindex="2" class="large tipTop" title="Please enter the page meta keyword"><?php echo $product_details->row()->meta_keyword;?></textarea>
                  </div>
                </div>
              </li>	
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="meta_description">Meta Description</label>
                  <div class="form_input">
                    <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"><?php echo $product_details->row()->meta_description;?></textarea>
                  </div>
                </div>
              </li>
            </ul>
            <ul>
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <input type="hidden" name="productID" id="productID" value="<?php echo $product_details->row()->id;?>"/>
          </form>
        </div>
      </div>
    </div>
  </div>
  <span class="clear"></span> </div>
</div>
<script>
$(document).ready(function(){
	var i = 1;
	
	$('#add').click(function() { 
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
		
});


</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>
