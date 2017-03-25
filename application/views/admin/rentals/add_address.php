
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
              <li><a href="#tab3" >Amenities</a></li>
              <li><a href="#tab4" class="active_tab">Address & Availability Information</a></li>
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
          
          <div id="tab4">
            <ul id="AttributeView">
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="country">Country<span class="req">*</span></label>
                  <div class="form_input">
                    <select class="chzn-select required" onchange="javascript:loadCountryListValues(this);update_Country();" name="country" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the country name">
                      <?php foreach ($RentalCountry->result() as $row){ ?>
                      
                      <option value="<?php echo $row->id;?>" <?php if(!empty($product_details)) { if($row->id==$product_details->row()->country){ echo 'selected="selected"'; } }?>><?php echo $row->name;?></option>
                      <?php }?>
                    </select>
                    
                  </div>
                </div>
              </li>
<?php if(!empty($product_details) && $product_details->row()->state!=''){?>
<script type="text/javascript">
			  setTimeout(function update_Country(){
			  	$('.state_sel').val('<?php echo $product_details->row()->state; ?>');
			  },2000);
			  function update_Country(){
			  //alert("sss");
			  	$('.state_sel').val('<?php echo $product_details->row()->state; ?>');
			  }
			  
			  setTimeout(function update_State(){
			  	$('.city_sel').val('<?php echo $product_details->row()->city; ?>');
			  },4000);
			  function update_State(){
			 // alert("sss");
			  	$('.city_sel').val('<?php echo $product_details->row()->city; ?>');
			  }
			
</script>
<?php }else{?> 
<script type="text/javascript">

			setTimeout(function update_Country(){
			  	//$('.state_sel').val('1');
			  },2000);
			  function update_Country(){
			  //alert("sss");
			  	//$('.state_sel').val('1');
			  }
			  
			  setTimeout(function update_State(){
			  	//$('.city_sel').val('1');
			  },4000);
			  function update_State(){
			  //alert("sss");
			  	//$('.state_sel').val('1');
			  }

</script>
<?php } ?>  

    




           
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="state">State<span class="req">*</span></label>
                  <div class="form_input" id="listCountryCnt">
                    <select class="chzn-select required state_sel" name="state" onchange="javascript:loadStateListValues(this);update_State();" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the state name">
                      <option value=""></option>
                     
                      <?php foreach ($RentalState->result() as $row){ ?>
					 
                      
                      <option value="<?php echo $row->id;?>" ><?php echo $row->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </li>
              
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="city">City<span class="req">*</span></label>
                  <div class="form_input" id="listStateCnt">
                    <select class="chzn-select required city_sel" name="city" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the city name">
                       <option value="">Select City</option>
                      <?php foreach ($RentalCity->result() as $row){
											
											
											?>
                      <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="address">Street Address</label>
                  <div class="form_input">
                    <textarea type="text" name="address" id="address" tabindex="3" style="width:370px;" class="large tipTop" title="Enter address"><?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->address)); }?></textarea>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="address">Apt, Suite, Bldg.(optional)</label>
                  <div class="form_input">
                    <input type="text" name="apt" id="apt" tabindex="3" style="width:370px;" class="large tipTop" title="Enter address" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->apt)); }?>"/>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="post_code">Zip Code<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="post_code" id="post_code" tabindex="8" class="large tipTop" title="Please enter the post code" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->post_code)); }?>" />
                  </div>
                </div>
              </li>
              
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="neighborhood">Neighborhoods</label>
                  <div class="form_input">
<select class="chzn-select " name="neighborhood[]" multiple="multiple" tabindex="1" style="width: 375px;" data-placeholder="Please select the neighborhood ">
                                                <?php $NeiborArr=array();$NeiborArr=@explode(',',$product_details->row()->neighborhood); if($NeiborCity->num_rows() > 0){foreach ($NeiborCity->result() as $row){?>
                                                    <option value="<?php echo trim(stripslashes($row->seourl));?>" <?php if(in_array($row->seourl,$NeiborArr)){echo 'selected="selected"';} ?>> <?php echo $row->name;?></option>
                                                <?php }}?>
                                        </select>                  </div>
                </div>
              </li>
             
             
             
             <li>
              <h4>Available Information </h4></li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="datefrom">Availabe From: <span class="req">*</span></label>
                  <div class="form_input">
                    <input name="datefrom" id="datefrom" type="text" tabindex="5" class="required small tipTop datepicker" title="Please select the date" 
                    value="<?php if(!empty($product_details)){ echo $product_details->row()->DATEFROM; }?>"/>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="dateto">Available To: <span class="req">*</span></label>
                  <div class="form_input">
                    <input name="dateto" id="dateto" type="text" tabindex="6" class="required small tipTop datepicker" title="Please select the date" 
                    value="<?php if(!empty($product_details)){ echo $product_details->row()->DateTo; }?>"/>
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