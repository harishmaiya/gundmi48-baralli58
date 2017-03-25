<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New State</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 <li><a href="#tab2">SEO</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open('admin/location/insertEditTax',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
                            	<li>
                                  <div class="form_grid_12">
                                    <label class="field_title" for="country_id">Country Name <span class="req">*</span></label>
                                    <div class="form_input">
                                      <select class="chzn-select required" name="country_id" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the country name">
                                            <option value=""></option>
                                            <?php foreach ($countryDisplay as $row){
											
											
											?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                            <?php }?>
                                      </select>
                                    </div>
                                  </div>
                                </li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="state_name">State Name <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="state_name" style=" width:295px" id="state_name" value="" type="text" tabindex="1" class="required tipTop" title="Please enter the state name" onblur="javascript:showAddress(this);"/>
									</div>
								</div>
								</li>
								<li>
									<div class="form_grid_12">
										<input type="hidden" name="latitude" id="latitude" value=""/>
										<input type="hidden" name="longitude" id="longitude" value=""/>
										<div id="map" style="width:1050px; height:250px"></div>
										<script src='http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $this->config->item('google_map_api');?>'></script> 
										<!-- <script type="text/javascript" src="js/map_google_load.js"></script> -->
										<script>
										  function load() {
											  oldlat = '';
											  oldlng = '';
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
                                    <input name="state_code" style=" width:295px" id="state_code" type="text" tabindex="1" class="required tipTop" title="Please enter the state code"/>
									</div>
								</div>
								</li>
                                <!--<li>
								<div class="form_grid_12">
									<label class="field_title" for="state_tax">State Tax (%)<span class="req">*</span></label>
									<div class="form_input">
                                    <input name="state_tax" style=" width:295px" id="state_tax" type="text" tabindex="1" class="required tipTop" title="Please enter the state tax"/>
									</div>
								</div>
								</li>-->
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="8" name="status" checked="checked" id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
                               
								<input type="hidden" name="tax_id" value=""/>
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
                      <input name="meta_title" id="meta_title" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <textarea name="meta_keyword" id="meta_keyword"  tabindex="2" class="large tipTop" title="Please enter the page meta keyword"></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"></textarea>
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