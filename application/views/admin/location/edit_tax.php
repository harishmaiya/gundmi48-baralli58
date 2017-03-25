<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit State</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 <li><a href="#tab2">SEO</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm','enctype' => 'multipart/form-data');
						echo form_open('admin/location/insertEditTax',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
                            	<li>
                                  <div class="form_grid_12">
                                    <label class="field_title" for="countryid">Country Name <span class="req">*</span></label>
                                    <div class="form_input">
                                      <select class="chzn-select required" name="countryid" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the country name">
                                            
                                            <?php foreach ($countryDisplay as $countryrow){
											
											
											?>
                                            <option value="<?php echo $countryrow['id'];?>" <?php if($tax_details->row()->countryid==$countryrow['id']){echo 'selected="selected"';} ?> ><?php echo $countryrow['name'];?></option>
                                            <?php }?>
                                      </select>
                                    </div>
                                  </div>
                                </li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="name">State Name <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="name" style=" width:295px" id="name" value="<?php echo $tax_details->row()->name;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the state name" onblur="javascript:showAddress(this);"/>
									</div>
								</div>
								</li>
								<li>
									<div class="form_grid_12">
										<input type="hidden" name="latitude" id="latitude" value="<?php echo $tax_details->row()->latitude;?>"/>
										<input type="hidden" name="longitude" id="longitude" value="<?php echo $tax_details->row()->longitude;?>"/>
										<div id="map" style="width:1050px; height:250px"></div>
										 <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChTQ15FyJxzDEjH7I1bMRcp3pRImZOV-g"></script> --> 
										 <script src='http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $this->config->item('google_map_api');?>'></script> 
										<!-- <script type="text/javascript" src="js/map_google_load.js"></script> -->
										<script>
										  function load() {
											  oldlat = '<?php echo $tax_details->row()->latitude;?>';
											  oldlng = '<?php echo $tax_details->row()->longitude;?>';
											  if(oldlat == '') oldlat='37.77264';
											  if(oldlng == '') oldlng='-122.40992';
										      if (GBrowserIsCompatible()) {
										        var map = new GMap2(document.getElementById("map"));
										        map.addControl(new GSmallMapControl());
										        map.addControl(new GMapTypeControl());
										        var center = new GLatLng(oldlat,oldlng);
										        map.setCenter(center, 6);
										        geocoder = new GClientGeocoder();
										        var marker = new GMarker(center, {draggable: true});  
										        map.addOverlay(marker);
										         $("#latitude").val(center.lat().toFixed(5));
										        $("#longitude").val(center.lng().toFixed(5)); 
										
											  GEvent.addListener(marker, "dragend", function() {
										       var point = marker.getPoint();
											      map.panTo(point);
										        $("#latitude").val(point.lat().toFixed(5));
										       $("#longitude").val(point.lng().toFixed(5)); 
										
										        });
										
										      }
											}
											load();
											function showAddress(evt) {
												var country = $(evt).parents('li').prev().find('select option:selected').text();
												var state = $(evt).val();
												address = state+','+country;
											   var map = new GMap2(document.getElementById("map"));
										       map.addControl(new GSmallMapControl());
										       map.addControl(new GMapTypeControl());
										       if (geocoder) {
										        geocoder.getLatLng(
										          address,
										          function(point) {
										            if (!point) {
										              alert("Address "+address + " not found");
										              return false;
										            } else {
										            	$("#latitude").val(point.lat().toFixed(5));
										            	$("#longitude").val(point.lng().toFixed(5));
										            	 map.clearOverlays()
										     			map.setCenter(point, 6);
										        var marker = new GMarker(point, {draggable: true});  
										     		 map.addOverlay(marker);

										     		GEvent.addListener(marker, "dragend", function() {
										           var pt = marker.getPoint();
										     	     map.panTo(pt);
										     	    $("#latitude").val(pt.lat().toFixed(5));
									            	$("#longitude").val(pt.lng().toFixed(5));
										             });


										     	/*  GEvent.addListener(map, "moveend", function() {
										     		  map.clearOverlays();
										         var center = map.getCenter();
										     		  var marker = new GMarker(center, {draggable: true});
										     		  map.addOverlay(marker);
										     	  $("#latitude").val(center.lat().toFixed(5));
									            	$("#longitude").val(center.lng().toFixed(5));

										     	 GEvent.addListener(marker, "dragend", function() {
										          var pt = marker.getPoint();
										     	    map.panTo(pt);
										     	  $("#latitude").val(pt.lat().toFixed(5));
									            	$("#longitude").val(pt.lng().toFixed(5));
										             });
										      
										             }); */
										            }
										          }
										        );
										      }
										    }
											</script>
									</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="state_code">State Code<span class="req">*</span></label>
									<div class="form_input">
                                    <input name="state_code" style=" width:295px" id="state_code" value="<?php echo $tax_details->row()->state_code;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the state code"/>
									</div>
								</div>
								</li>
                                 <!--<li>
								<div class="form_grid_12">
									<label class="field_title" for="statelogo">Logo<span class="req">*</span></label>
									<div class="form_input">
                                    <input name="statelogo" id="statelogo" type="file" tabindex="5" class="large tipTop" title="Please select the logo image"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Logo Image</label>
									<div class="form_input">
                                    <img src="images/state/<?php echo $tax_details->row()->statelogo;?>" width="50px" height="50px"  />
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="statethumb">image<span class="req">*</span></label>
									<div class="form_input">
                                   <input name="statethumb" id="statethumb" type="file" tabindex="5" class="large tipTop" title="Please select the thumb image"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">image image</label>
									<div class="form_input">
                                    <img src="images/state/<?php echo $tax_details->row()->statethumb;?>" width="50px" height="50px"  />
									</div>
								</div>
								</li>
                                <li>
                                  <div class="form_grid_12">
                                    <label class="field_title" for="description">Description</label>
                                    <div class="form_input">
                                      <textarea name="description" id="description" class="large tipTop mceEditor" title="Please enter the description"><?php echo $tax_details->row()->description;?></textarea>
                                    </div>
                                  </div>
                                </li>-->
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="7" name="status" id="active_inactive_active" class="active_inactive" <?php if ($tax_details->row()->status == 'Active'){echo 'checked="checked"';}?>  />
										</div>
									</div>
								</div>
								</li>
								<input type="hidden" name="tax_id" value="<?php echo $tax_details->row()->id;?>"/>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
									</div>
								</div>
								</li>
							</ul>
                        </div>
                        <div id="tab2">
              <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <input name="meta_title" id="meta_title" value="<?php echo $tax_details->row()->meta_title;?>" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <textarea name="meta_keyword" id="meta_keyword" tabindex="2" class="large tipTop" title="Please enter the page meta keyword"><?php echo $tax_details->row()->meta_keyword;?></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"><?php echo $tax_details->row()->meta_description;?></textarea>
                    </div>
                  </div>
                </li>
              </ul>
             <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
				</div>
			</div></li></ul>
			</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>