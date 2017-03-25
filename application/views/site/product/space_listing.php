<?php 
$this->load->view('site/templates/header');
$this->load->view('site/templates/listing_head_side');
 
//echo "<pre>"; print_r($listspace->result() );die;

foreach ($listValues->result() as $result){

 $values = $result->listing_values;
 }
	$roombedVal=json_decode($values);
	
	$product_list_decode = json_decode($listDetail->row()->listings);
	foreach($product_list_decode as $product_list_name => $product_list_values)
	{
	 $product_list_data[$product_list_name] = $product_list_values;
	}
		
?>


<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>addProperty.js"></script>
         
            <div class="right_side space-listing">
			
			<div class="dashboard_price_main" style="border-bottom:none !important;">
            
              <div class="dashboard_price">
            
                    <div class="dashboard_price_left">
                    
                      <h3><?php if($this->lang->line('ListingInfo') != '') { echo stripslashes($this->lang->line('ListingInfo')); } else echo "Listing Info"; ?></h3>
                        
                        <p><?php if($this->lang->line('Basicinformationabout') != '') { echo stripslashes($this->lang->line('"Basicinformationabout')); } else echo "Basic information about your listing."; ?></p>
                    
                    </div>
					
					<?php 
					
					$listvalue = $this->product_model->get_all_details(LISTSPACE_VALUES,array('listspace_id'=>9));
					//echo '<pre>'; print_r($listDetail->result_array());
					//die ?>
					
                   <form name="space_listing" method="post" action="site/product/saveSpacelist">
                    <div class="dashboard_price_right">
                    <?php
					$pcount=0;
					foreach($listspace->result() as $value){
					  $id=$value->id;
					 ?>
                      <div class="dashboard_apart">
                        
                          <label><?php echo $value->attribute_name; ?></label>
                            <div class="select">
							<select  name="<?php if($value->attribute_seourl == 'propertytype')echo 'home_type';else if($value->attribute_seourl == 'roomtype') echo 'room_type';?>"  onchange="javascript:Detailview(this,<?php echo $listDetail->row()->id; ?>,'<?php if($value->attribute_seourl == 'propertytype')echo 'home_type';else if($value->attribute_seourl == 'roomtype') echo 'room_type';?>');">
								<option value="">select</option>
							<?php
                            $sql = 'SELECT * FROM fc_listspace_values WHERE listspace_id = '.$id;
							$inner = $this->db->query($sql);
							foreach($inner->result() as $listvalues)
						 {
						 if($pcount == 0){
						 ?>  
							  <option  <?php if(trim($listvalues->list_value) == trim($listDetail->row()->home_type) || trim($listvalues->list_value) == trim($listDetail->row()->room_type)) echo 'selected="selected"'; ?> ><?php echo $listvalues->list_value; ?></option>
							  <?php }else{  ?>
							   <option  <?php if(trim($listvalues->list_value) == trim($listDetail->row()->home_type) || trim($listvalues->list_value) == trim($listDetail->row()->room_type)) echo 'selected="selected"'; ?> ><?php echo $listvalues->list_value; ?></option>
                                 
						<?php
						
						}
						} ?>
						 </select>
                            </div>
                        </div>
						
						<?php 
						
						$pcount++;
						}
						?>						<div class="dashboard_apart width100">
						
						<?php 						foreach ($roombedVal as $key => $values){ 			
						$listing_keys[$key] = $key;
						$listing_values[$key] = $values;
						}
						//echo '<pre>';print_r($listTypeValues->result());die;
						foreach ($listTypeValues->result() as $keys => $finals)
									{
							
							 $name = $finals->name; 
							 //$id= $finals->id;
							// print_r($id);
						if( $name != 'can_policy'){
									 
									  $list_type = $finals->type;
									 
									  ?>
                        
                        	<label style="text-transform:capitalize;"><?php echo str_replace('_',' ',$name); ?></label>
                            
                            <div class="select">
                         <?php    if($list_type == 'option' ) { ?>
                   
                            	<select class="select_option" name="select_option" onchange="javascript:Detaillist(this,<?php echo $listDetail->row()->id; ?>,'<?php echo $name; ?>');">
    
                                      <option value="">Select</option>
									  
                                      <?php 
							$valuesArr=@explode(',',$listing_values[$name]);
									  foreach($valuesArr as $value){
									  
										
										?>
										<option value="<?php echo $value; ?>" <?php   if($product_list_data[$name] == $value){ echo 'selected="selected"'; }  ?> >
											<?php echo $value; ?>
										</option>
										
									  <?php } ?>
                                      
                                  </select>
                            <?php } else { //echo $listing_values[$name]; ?>
                            
							 <input type="text" value="<?php echo  $product_list_data[$name]; ?>" class="select_option" onchange="javascript:Detaillist(this,<?php echo $listDetail->row()->id; ?>,'<?php echo $name; ?>');">
							<?php } ?>
                            </div>
							<?php }    } ?>
                        
                        </div> 
						
                    
                    </div>
                
                </div>
            
            </div>
			
			<!---- -->
            
            
            
            <div class="dashboard_price_main">
            
            	<div class="dashboard_price">
            
                    <div class="dashboard_price_left">
                    
                    <!--	<h3><?php
						// if($this->lang->line('RoomsandBeds') != '') { echo stripslashes($this->lang->line('RoomsandBeds')); } else echo "Rooms and Beds"; ?></h3>
                        
                        <p><?php //if($this->lang->line('Thenumberof') != '') { echo stripslashes($this->lang->line('Thenumberof')); } else echo "The number of rooms and beds guests can access."; ?> </p>
                    -->
                    </div>
                    
                    <div class="dashboard_price_right">
					
                    	<!--<div class="dashboard_apart width100">
						
						<?php // echo '<pre>';print_r($product_list_data);die;
						
						
						  foreach ($roombedVal as $key => $values){ 			
						$listing_keys[$key] = $key;
						$listing_values[$key] = $values;
						}
					//print_r($listing_values); 
						 
						foreach ($listTypeValues->result() as $keys => $finals)
									{
							
							 $name = $finals->name; 
						if($name != 'can_policy'){
									 
									  $list_type = $finals->type;
									 
									  ?>
                        
                        	<label style="text-transform:capitalize;"><?php echo $name; ?></label>
                            
                            <div class="select">
                         <?php    if($list_type == 'option' ) { ?>
                            	<select class="select_option" name="select_option" onchange="javascript:Detaillist(this,<?php echo $listDetail->row()->id; ?>,'<?php echo $name; ?>');">
    
                                      <option value="">Select</option>
									  
                                      <?php 
										//print_r($valuesArr);die;
									  $valuesArr=@explode(',',$listing_values[$name]);
									  foreach($valuesArr as $value){
									  
										
										?>
										<option value="<?php echo $value; ?>" <?php   if($product_list_data[$name] == $value){ echo 'selected="selected"'; }  ?> >
											<?php echo $value; ?>
										</option>
										
									  <?php } ?>
                                      
                                  </select>
                            <?php } else { //echo $listing_values[$name]; ?>
                            
							 <input type="text" value="<?php echo  $product_list_data[$name]; ?>" class="select_option" onchange="javascript:Detaillist(this,<?php echo $listDetail->row()->id; ?>,'<?php echo $name;?>');">
							<?php } ?>
                            </div>
							<?php }    } ?>
                        
                        </div>  -->
						
						
                        
                        <input type="hidden" name="id" value="<?php echo $listDetail->row()->id;?>" />
                        </div>
                        
                    
                    </div>
                    
                </form>
                </div>


            
            
          <!--   <p class="price_text_links">If you wish, you can permanently <a href="javascript:void(0);" onclick="return DeleteListYoutProperty('<?php echo $listDetail->row()->id; ?>');">delete this listing.</a></p> -->
            
            </div>
            
        </div>
        
    </div>
<script type="text/javascript">
function DeleteListYoutProperty(val){
	//$('#delete_profile_image').disable();
	var res = window.confirm('Are you sure?');
	if(res){
		window.location.href = 'site/product/delete_property_details/'+val;
	}else{
		//$('#delete_profile_image').removeAttr('disabled');
		return false;
	}
}
</script>   
<!---DASHBOARD-->
<?php
$this->load->view('site/templates/footer');
?>