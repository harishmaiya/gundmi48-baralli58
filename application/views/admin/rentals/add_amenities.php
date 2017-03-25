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
              <li><a href="#tab1">Rental General Information</a></li>
              <li><a href="#tab2"  >Images</a></li>
              <li><a href="#tab3" class="active_tab">Amenities</a></li>
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
						echo form_open_multipart('admin/rentals/addAmenities/',$attributes)
						
					?>
                    <input type="hidden" name="prdiii" id="prdiii" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->id)); } else { echo "0";}?>" />
          
          <div id="tab3">
            <!--<ul id="AttributeView">
              <li><?php //echo $product_details; ?></li>-->
              
              <?php  
			            if(!empty($product_details)) {
                         $list_name = $product_details->row()->list_name;						  
						 $facility = (explode(",", $list_name));  
						} 
						   
				         ?> 
              <ul>
              <h3>COMMON FACILITY</h3>
              
               <?php  
					    foreach($getCommonFacilityDetails as $details) : if($current_col == "0")echo "<tr>";?>
                         <li>
                         <input type="checkbox" class="checkbox_check" name="list_name[]" id="mostcommon"   <?php if(in_array($details['list_value'],$facility)) { ?> checked="checked" <?php } ?>value="<?php echo $details['list_value']; ?>"/><span><?php echo $details['list_value']; ?></span></li>
                        <?php 
                       
                        endforeach;                       
                         ?>                    
                         </li>
                        <?php  
                        // $list_name = $listDetail->row()->list_name;						  
						 //$facility = (explode(",", $list_name));  
						   
				         ?> 
                    
                        <h3>Extras</h3>
                        <p>Additional amenities your listing may offer. </p>
                        <?php
					    
					    foreach($getExtraFacilityDetails as $details) : if($current_col == "0")echo "<tr>";?>
                        <li><input type="checkbox" class="checkbox_check" name="list_name[]" <?php if(in_array($details['list_value'],$facility)) { ?> checked="checked" <?php } ?> value="<?php echo $details['list_value']; ?>"/><span><?php echo $details['list_value']; ?> </span></li>
                     
                        <?php 
                       
                        endforeach;
                       
                         ?> 
                         
                       <h3>Special Features</h3>
                        
                        <p>Features of your listing for guests with specific needs.</p>
                      <?php  
                        // $list_name = $listDetail->row()->list_name;						  
						 //$facility = (explode(",", $list_name));  
						   
				         ?> 
                    
                        
                      <?php
					   
					    foreach($getSpecialFeatureFacilityDetails as $details) : if($current_col == "0")echo "<tr>";?>
                        
                        
                       <li><input type="checkbox" class="checkbox_check" name="list_name[]"  <?php if(in_array($details['list_value'],$facility)) { ?> checked="checked" <?php } ?>
                         value="<?php echo $details['list_value']; ?>"/><span><?php echo $details['list_value']; ?></span></li>
                        <?php 
                       
                        endforeach;
                       
                         ?>   
                       
                         
                         
                       <h3>Home Safety</h3>
                        
                        
                      <?php  
                        // $list_name = $listDetail->row()->list_name;						  
						 //$facility = (explode(",", $list_name));  
						   
				         ?> 
                    
                        
                      <?php
					   
					    foreach($getHomeSafetyFacilityDetails as $details) : if($current_col == "0")echo "<tr>";?>
                        
                        
                       <li><input type="checkbox" class="checkbox_check" name="list_name[]"  <?php if(in_array($details['list_value'],$facility)) { ?> checked="checked" <?php } ?>
                         value="<?php echo $details['list_value']; ?>"/><span><?php echo $details['list_value']; ?></span></li>
                        <?php 
                       
                        endforeach;
                       
                         ?>  
                         
                         
                         
                            
              <li>
                <div class="form_grid_12">
                  <div class="form_input" style="margin:0px;width:100%;">
                    <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                    <input type="submit" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
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
