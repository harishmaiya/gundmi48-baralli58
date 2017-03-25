<?php
$this->load->view('admin/templates/header.php');
?>
</head>
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
		
});
</script>


<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_top"> <span class="h_icon list"></span>
          <h6>Add New Rental</h6>
          <!--<a class="inline cboxElement" href="#inline_content">Inline HTML</a>-->
          <div id="widget_tab">
            <ul>
              <li><a href="#tab1" class="active_tab">Rental General Information</a></li>
              <li><a href="#tab2">Images</a></li>
              <li><a href="#tab3">Amenities</a></li>
              <li><a href="#tab4">Address & Availability Information</a></li>
              <li><a href="#tab5">Listing</a></li>
              <li><a href="#tab6">Detailed description</a></li>
              <li><a href="#tab7">SEO</a></li>
            </ul>
          </div>
        </div>
        <div class="widget_content">        
          <?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addproduct_form1111', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/rentals/insert_general_info',$attributes)
						
					?>
                    
                    <input type="hidden" name="rental_id" id="rental_id" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->id)); } else { echo "0";}?>" />
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
                    <input name="product_title" id="product_title" type="text" tabindex="1" class="required large tipTop" title="Please enter the product name" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->product_title)); }?>"/>
                    
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="description">Summary</label>
                  <div class="form_input">
                    <textarea name="description" id="description" tabindex="2" style="width:370px;" class="tipTop mceEditor" title="Please enter the product description"><?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->description)); }?></textarea>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Price per night<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="price" id="price" tabindex="9" class="required large tipTop" title="Please enter the product price" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->price)); }?>"  />
                  </div>
                </div>
              </li>
              
              
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price_perweek">Long-Term Prices </label>
                  <div class="form_input">
                    
                    <input name="price_perweek" id="price_perweek" type="text" tabindex="10" class="large tipTop" title="Please enter the product Price Per Week" placeholder="Per Week" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->price_perweek)); }?>" />
                    <input name="price_permonth" id="price_permonth" type="text" tabindex="11" class="large tipTop" title="Please enter the product Price Per Month" placeholder="Per Month" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->price_permonth)); }?>" />
                  </div>
                </div>
              </li>
              
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="admin_name">Status <span class="req">*</span></label>
                  <div class="form_input">
                    <div class="publish_unpublish">
                      <input type="checkbox" tabindex="11" name="status" checked="checked" id="publish_unpublish_publish" class="publish_unpublish"/>
                    </div>
                  </div>
                </div>
              </li>
              
            
              
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <!--<input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>-->
                    <button type="submit" class="btn_small btn_blue" tabindex="9"><span>Next</span></button>
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
  <span class="clear"></span> </div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>
