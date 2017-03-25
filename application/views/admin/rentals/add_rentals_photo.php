<?php
$this->load->view('admin/templates/header.php');
?>
<script type="text/javascript">
function ImageAddClick(){
var idval =$('#prdiii').val();
//alert(idval);
$(".dragndrop1").colorbox({width:"1000px", height:"500px", href:baseURL+"admin/rentals/dragimageuploadinsert/?id="+idval});
}
</script>
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
              <li><a href="#tab2"  class="active_tab">Images</a></li>
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
						echo form_open_multipart('admin/rentals/AddAmenities_form/'.$product_details->row()->id,$attributes)
						
					?>
                    <input type="hidden" name="prdiii" id="prdiii" value="<?php if(!empty($product_details)){ echo trim(stripslashes($product_details->row()->id)); } else { echo "0";}?>" />
          
          <div id="tab2">
            <ul>
              <li>
               
               
               <?php //include('img_upload.php'); ?>
               
                 <div class="form_grid_12">
                  <label class="field_title" for="product_image">Rental Image <span class="req">*</span></label>
              
                    
                    <div class="dragndrop1"><button onclick="ImageAddClick();">Choose Image</button></div>
                </div>
              </li>
              <li>
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
                        <td class="center "><img src="<?php echo base_url();?>server/php/rental/<?php echo $img->product_image; ?>"  height="80px" width="80px" /> </td>
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
                  <div class="form_input">
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
