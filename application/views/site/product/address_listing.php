<?php

$this->load->view('site/templates/header');

$this->load->view('site/templates/listing_head_side');

$address = $rental_address->row()->address;

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

?>

<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>addProperty.js"></script>



<div style='display:none'>



  <div id='inline_mapaddress' style='background:#fff;'>

  

  		<div class="popup_page">

  

  			<div class="popup_header"><?php if($this->lang->line('EnterAddress') != '') { echo stripslashes($this->lang->line('EnterAddress')); } else echo "Enter Address"; ?>

            	

                <div class="popup_sub_header"><?php if($this->lang->line('Whatisyour') != '') { echo stripslashes($this->lang->line('"Whatisyour')); } else echo "What is your listing's address?"; ?></div>

            

            </div>

            

            

            <div class="popup_detail">

            

            	<form name="rental_address" id="rental_address" method="post" action="site/product/insert_address">

            	<div class="banner_signup">

                

                		<ul class="popup_address">

                        

                        	<li>

                            	

                         

                         	<label>Location</label>

                            

                            <div class="select">

                            

                                <input type="text" class="title_overview" onblur="getAddressDetails();" name="address_location" placeholder="Please Enter the Location" id="address_location" value="<?php echo $rental_address->row()->address;?>" onFocus="geolocate()">

                            </div>

                         

                         

                         	</li>

							<li>

                            	

                         

                         	<label><?php if($this->lang->line('Country') != '') { echo stripslashes($this->lang->line('Country')); } else echo "Country"; ?></label>

                            

                            <div class="select">

                            

                                <input type="text" class="title_overview" name="country" placeholder="Please Enter the County" id="country" value="<?php echo $country;?>">

								

                            </div>

                         

                         

                         	</li>

                            <li>

                         

                         	<label><?php if($this->lang->line('State') != '') { echo stripslashes($this->lang->line('State')); } else echo "State"; ?></label>

                            <div class="select" id="listCountryCnt">

								<input type="text" class="title_overview" name="state" placeholder="Please Enter the State" id="state" value="<?php echo $state;?>">

                          </div>

                         </li>

                         

                          <li>

                         

                         	<label><?php if($this->lang->line('City') != '') { echo stripslashes($this->lang->line('City')); } else echo "City"; ?></label>

                            <div class="select" id="listStateCnt">

								<input type="text" class="title_overview" name="city" placeholder="Please Enter the City" id="city" value="<?php echo $city;?>">

                          </div>

                         </li>    

                         

                          <li>

                         

                         	<label><?php if($this->lang->line('StreetAddress') != '') { echo stripslashes($this->lang->line('StreetAddress')); } else echo "Street Address"; ?></label>

                            

                            <input name="address" id="address" type="text" value="<?php echo trim($street.' '.$street1);?>" class="title_overview" />

                         

                         </li>

                         

                         <li>

                         

                         	<label><?php if($this->lang->line('ZIPCode') != '') { echo stripslashes($this->lang->line('ZIPCode')); } else echo "ZIP Code"; ?></label>

                            

                            <input type="text" name="post_code" id="post_code" value=""  placeholder="e.g. 94103" class="title_overview" />

                         

                         </li>

                         

                         </ul>

                         

                         <div class="popup_address_bottom">

                         

                         	<input type="hidden" name="product_id" value="<?php echo $listDetail->row()->id; ?>" />

                         	<input type="hidden" name="latitude" id="latitude" value="<?php echo $rental_address->row()->lat; ?>" />

                         	<input type="hidden" name="longitude" id="longitude" value="<?php echo $rental_address->row()->lang; ?>" />

                         

                            <input type="submit" value="<?php if($this->lang->line('Submit') != '') { echo stripslashes($this->lang->line('Submit')); } else echo "Submit"; ?>" class="next_btn" onclick="return Address_Validation(this);" />

                            

                            <input type="reset" value="<?php if($this->lang->line('Cancel') != '') { echo stripslashes($this->lang->line('Cancel')); } else echo "Cancel"; ?>" class="cancel_btn" onclick="window.history.go();"/>

                         

                         </div>

                         

                                 

                     </div>

                    

                    </form>	

            </div>

        

        </div>

        

  </div>

  

</div>





            <div class="right_side address-left">

            

            <div class="dashboard_price_main" style="border-bottom:none;">

            

            	<div class="dashboard_price">

            

                    <div class="dashboard_price_left">

                    

                    	<h3><?php if($this->lang->line('Address') != '') { echo stripslashes($this->lang->line('Address')); } else echo "Address"; ?></h3>

                        

                        <p><?php if($this->lang->line('Yourexactaddress') != '') { echo stripslashes($this->lang->line('Yourexactaddress')); } else echo "Your exact address is private and only shared with guests after a reservation is confirmed.However the host are responsible to provide the exact road name of the accommodations in order for guest to be able to plan for their trip smoothly."; ?></p>

                    

                    </div>

                    

                    <div class="dashboard_price_right">

                    

						<div class="address_map_main">

                        <?php if($rental_address->row()->lat !='0.00' && $rental_address->row()->lang !='0.00'){?>

						

					

						<div id="map" style="width:323px; height:482px"></div>

  

						

						<?php }else{ ?>

						 <div id="map" style="display:none;width:323px; height:482px"></div>

                        	<div class="address_map"><img src="images/empty-map.png" width="375px" /></div>

                        	<div class="address_pointer"><img src="images/map-pin.png" /></div>

                         <?php } ?>  



						 <script>
							var myLatlng = new google.maps.LatLng(<?php echo $rental_address->row()->lat;?>,<?php echo $rental_address->row()->lang;?>);

							function load_NewMap() { 
							// Create the map.
							var mapOptions = {
							zoom: 15,
							center: myLatlng,
							mapTypeId: google.maps.MapTypeId.ROADMAP
							};

							var map = new google.maps.Map(document.getElementById('map'),
							mapOptions);

							var marker = new google.maps.Marker({
								position: myLatlng,
								draggable:true,
								map: map
							});

							google.maps.event.addListener(marker, 'dragend', function() 
							{
								var newLatitude = this.position.lat();
								var newLongitude = this.position.lng();
								console.log(newLatitude);
								console.log(newLongitude);
								var pos=marker.getPosition();		
								//console.log(pos.A);
								//console.log(pos.F);
								geocoder = new google.maps.Geocoder();
								geocoder.geocode
								({
									latLng: pos
								},
								function(results, status) 
									{
										if (status == google.maps.GeocoderStatus.OK) 
											{																		
												var address=results[0].formatted_address;
												var add1=results[0].address_components;	
												var street=add1[0].long_name
												var area=add1[1].long_name
												var location=add1[2].types[0];
												var city=add1[2].long_name
												var state=add1[3].long_name;
												var country=add1[4].long_name;	
												console.log(area);	
												console.log(street);	
												console.log(location);													
												console.log(address);	
												console.log(city);
												console.log(state);
												console.log(country);	
								$.ajax({

									type:'POST',

									url:'<?php echo base_url()?>site/product/save_lat_lng',

									data:{latitude:newLatitude,longitude:newLongitude,area:area,street:street,location:location,address:address,city:city,state:state,country:country,product_id:'<?php echo $listDetail->row()->id; ?>'},

									success:function(response)

									{
										window.location.reload();
										
									
									},
									    error: function (request, status, error) {
												//alert(request.responseText);
							    }

									

								});
												
											} 
										else 
											{
												console.log('Cannot determine address at this location.');
											}
										}
								);

							});
							

}

							
							</script>

	

	

	

                            <div class="address_add">

                            <?php if($rental_address->row()->lat =='' || $rental_address->row()->lang ==''){?>

                            <span class="this-list"><?php if($this->lang->line('Thislistinghas') != '') { echo stripslashes($this->lang->line('Thislistinghas')); } else echo "This listing has no address."; ?></span>

                                 <?php } ?>                           	

                            	

                                <div class="add_address_main"><a class="add_address_btn add-address" href="#"><?php if($this->lang->line('AddAddress') != '') { echo stripslashes($this->lang->line('AddAddress')); } else echo "Add Address"; ?></a></div>

                            

                            </div>

                        

                        

                        </div>

                    

                    </div>

                

                </div>

            

            </div>

            

            </div>

            

            <div class="calender_comments">

            

            	<div class="calender_comment_content">

                

                	<!--<i class="calender_comment_content_icon"><img src="images/calender_available_icon.jpg" /></i>

                    

                    <div class="calender_comment_text">

                    

                    	<h2><?php if($this->lang->line('YourAddressisPrivate') != '') { echo stripslashes($this->lang->line('YourAddressisPrivate')); } else echo "Your Address is Private"; ?></h2>

                    

                    	<p><?php if($this->lang->line('Itwillonly') != '') { echo stripslashes($this->lang->line('Itwillonly')); } else echo "It will only be shared with guests after a reservation is confirmed."; ?></p>

                        

                    

                    </div>-->

                    

                </div>

            

            </div>

        

        </div>

        

    </div>

    

 <script type="text/javascript">

 function Address_Validation(evt){

 	if(jQuery.trim($('#country').val())== ''){

		$('#country').focus();

		return false;

	}else if(jQuery.trim($('#state').val())== ''){

		$('#state').focus();

		return false;	

	}else if(jQuery.trim($('#city').val())== ''){

		$('#city').focus();

		return false;

	}else{

		showAddress(evt);

		return false;

		//$('#rental_address').submit();

		//return true;

	}

 

 }

 

 

function getAddressDetails()

	{

		var address = $('#address_location').val();

		$.ajax({

			type: 'POST',

			url: baseURL+'site/product/get_location',

			data: {"address":address},

			dataType:'json',

			success: function(json){

				$('#country').val(json.country);

				$('#state').val(json.state);

				$('#city').val(json.city);

				$('#address').val(json.street);

				$('#post_code').val(json.zip);

				$('#latitude').val(json.lat);

				$('#longitude').val(json.lang);

			}

		});

		

	}

$(function(){

	load_NewMap();

});

</script>   

<!---DASHBOARD-->

<?php

$this->load->view('site/templates/footer');

?>

<style>

#colorbox, #cboxOverlay, #cboxWrapper{

	z-index:999 !important;

}

</style>