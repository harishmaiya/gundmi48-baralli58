<?php 
$this->load->view('site/templates/header'); ?>
<section id='ajax-search'></section>
<section id='normal-search'>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" media="all" href="css/site/style-responsive.css" type="text/css" />
<link rel="stylesheet" media="all" href="css/site/style-responsive-only.css" type="text/css" />
<script type="text/javascript">
var i = 0;
var markers = [];
function showView(val){
    $('.showlist'+val).toggle('');  
	if(val=='6'){
		if($("#minus_botton").css('display') == 'none'){
			$("#minus_botton").show();
			$("#plus_botton").hide();
		} else {
			$("#minus_botton").hide();
			$("#plus_botton").show();
		}
	}
}
</script>
<link rel="stylesheet" href="css/site/themes-smoothness-jquery-ui.css"  type="text/css"/>
<script>
    var currencyrate=$('#currencyrate').val(); 
    var GMaxPrice=$('#GMaxPrice').val() * currencyrate;
    var GMinPrice=$('#GMinPrice').val() * currencyrate;
    var SMaxPrice=$('#SMaxPrice').val() * currencyrate;
    var SMinPrice=$('#SMinPrice').val() * currencyrate;
    var currencysym=$('#currencysym').val();
</script>
<!-- End price range-->
<?php
if(isset($PriceMaxMin))
{
    $SMaxPrice = $PriceMaxMin->row()->MaxPrice;
    $SMinPrice = $PriceMaxMin->row()->MinPrice;
    /* echo "<pre>";print_r($PriceMaxMin->row()->MaxPrice);
    echo "<pre>";print_r($PriceMaxMin->row()->MinPrice);exit; */
}
$bedrooms="";
$beds="";
$bedtype="";
$bathrooms="";
$noofbathrooms="";
$min_stay="";
if($listDetail->num_rows()==1){
$roombedVal=json_decode($listDetail->row()->rooms_bed);
$bedrooms=$roombedVal->bedrooms;
$beds=$roombedVal->beds;
$bedtype=$roombedVal->bedtype;
$bathrooms=$roombedVal->bathrooms;
$noofbathrooms=$roombedVal->noofbathrooms;
$min_stay=$roombedVal->min_stay;
}
?>
<input type="hidden" value="50000" id="GMaxPrice" />
<input type="hidden" value="0" id="GMinPrice" />

<input type="hidden" value="50000" id="SMaxPrice" />
<input type="hidden" value="0" id="SMinPrice" />

<input type="hidden" value="<?php echo $currencySymbol; ?>" id="currencysym" />
<input type="hidden" value="<?php echo $this->session->userdata('currency_r'); ?>" id="currencyrate" />

<script type="text/javascript" src="js/site/downloadxml.js"></script>
 
<style type="text/css">
html, body { height: 100%; } 
.ui-slider .ui-slider-handle{
	width: 20px !important;
	height: 20px !important;
	border: none !important;
}
</style>

<script type="text/javascript">
	function initialize(){ 
		var myOptions = {
		scrollwheel: false,
		zoom: <?php if($zoom != '')echo $zoom; else echo '13'; ?>,
		zoomControl:true,
		zoomControlOptions: {
		style:google.maps.ZoomControlStyle.SMALL,
		 position: google.maps.ControlPosition.LEFT_TOP
		},
		center: new google.maps.LatLng(<?php if($zoom != '')echo $cLat;else echo $lat; ?>,<?php if($zoom != '')echo $cLong;else echo $long; ?>),
		mapTypeControl: true,
		mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
			navigationControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
		
		google.maps.event.addListener(map, 'click', function() {
			infowindow.close();
		});
		google.maps.event.addListener(map, 'dragend', function() { doAjax(); } );
		google.maps.event.addListener(map, 'zoom_changed', function() { doAjax(); });
		if($('#map-div').css('display') != 'none')
		{
			google.maps.event.addListener(map, "idle", function() {
				var sw = new google.maps.LatLng(<?php echo $minLat;?>, <?php echo $minLong;?>);
				var ne = new google.maps.LatLng(<?php echo $maxLat;?>, <?php echo $maxLong;?>);
				var bounds = new google.maps.LatLngBounds(sw, ne);
				<?php if($zoom == ''){ ?>
				if(i < 2)map.fitBounds(bounds);
				i++;
				<?php } else { ?>
				downloadUrl();
				<?php }?>
			});
		}
		else 
		{
			downloadUrl();
		}
	}
		
	//<![CDATA[
    // this variable will collect the html which will eventually be placed in the side_bar 
	var side_bar_html = ""; 
	var img='images/mapIcons/marker_red.png'; 
	var yimg='images/mapIcons/marker_yellow.png';
	// arrays to hold copies of the markers and html used by the side_bar 
	// because the function closure trick doesnt work there 
	var gmarkers = []; 
	var gicons = [];
	// global "map" variable
	var map = null;
	gicons["red"] = new google.maps.MarkerImage(img,
	// This marker is 20 pixels wide by 34 pixels tall.
	new google.maps.Size(20, 34),
	// The origin for this image is 0,0.
	new google.maps.Point(0,0),
	// The anchor for this image is at 9,34.
	new google.maps.Point(9, 34));
	// Marker sizes are expressed as a Size of X,Y
	// where the origin of the image (0,0) is located
	// in the top left of the image.

	// Origins, anchor positions and coordinates of the marker
	// increase in the X direction to the right and in
	// the Y direction down.

	var iconImage = new google.maps.MarkerImage(img,
	// This marker is 20 pixels wide by 34 pixels tall.
	new google.maps.Size(20, 34),
	// The origin for this image is 0,0.
	new google.maps.Point(0,0),
	// The anchor for this image is at 9,34.
	new google.maps.Point(9, 34));
	var iconShadow = new google.maps.MarkerImage('images/mapIcons/shadow50.png',
	// The shadow image is larger in the horizontal dimension
	// while the position and offset are the same as for the main image.
	new google.maps.Size(37, 34),
	new google.maps.Point(0,0),
	new google.maps.Point(9, 34));
	// Shapes define the clickable region of the icon.
	// The type defines an HTML &lt;area&gt; element 'poly' which
	// traces out a polygon as a series of X,Y points. The final
	// coordinate closes the poly by connecting to the first
	// coordinate.
	var iconShape = {
	  coord: [9,0,6,1,4,2,2,4,0,8,0,12,1,14,2,16,5,19,7,23,8,26,9,30,9,34,11,34,11,30,12,26,13,24,14,21,16,18,18,16,20,12,20,8,18,4,16,2,15,1,13,0],
	  type: 'poly'
	};

	function getMarkerImage(iconColor) {
		if ((typeof(iconColor)=="undefined") || (iconColor==null)) { 
			iconColor = "red"; 
		}
		if (!gicons[iconColor]) {
			gicons[iconColor] = new google.maps.MarkerImage("images/mapIcons/marker_"+iconColor+".png",
			// This marker is 20 pixels wide by 34 pixels tall.
			new google.maps.Size(27, 32),
			// The origin for this image is 0,0.
			new google.maps.Point(0,0),
			// The anchor for this image is at 6,20.
			new google.maps.Point(9, 34));
		} 
		return gicons[iconColor];
	}

	gicons["blue"] = getMarkerImage("blue");
	gicons["green"] = getMarkerImage("green");
	gicons["yelow"] = getMarkerImage("yellow");
	// A function to create the marker and set up the event window function 
	function createMarker(latlng,name,html,color,details,rid) {
		var contentString = html;
		var marker = new google.maps.Marker({
			position: latlng,
			icon: gicons[color],
			shadow: iconShadow,
			map: map,
			title: name,
			animation: google.maps.Animation.DROP,
			zIndex: 1
		});
  
		google.maps.event.addListener(map, 'idle', function(event) {});
	  

		google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(contentString); 
			infowindow.open(map,marker);
		});
		// Switch icon on marker mouseover and mouseout
		google.maps.event.addListener(marker, "mouseover", function() {
			  marker.setIcon(gicons["yellow"]);
			  marker.setZIndex(100);
		});
		google.maps.event.addListener(marker, "mouseout", function() {
			  marker.setIcon(gicons["blue"]);
			  marker.setZIndex(1);
		});
		markers.push(marker);
		gmarkers.push(marker);
		// add a line to the side_bar html
		var marker_num = gmarkers.length-1;
		//side_bar_html='<div class="map-areas"><ul class="similar-listing">'+side_bar_html;
		// side_bar_html=side_bar_html+'</ul></div>';
		side_bar_html += '<div onmouseover="gmarkers['+marker_num+'].setIcon(gicons.yellow);gmarkers['+marker_num+'].setZIndex(100);" onmouseout="gmarkers['+marker_num+'].setIcon(gicons.blue);gmarkers['+marker_num+'].setZIndex(1);">'+details+'</div>';
	}
 
 
	// This function picks up the click and opens the corresponding info window
	function myclick(i) {
		google.maps.event.trigger(gmarkers[i], "click");
	}

</script>
 
<div id="ajax_map">
<script type="text/javascript">

function downloadUrl() {  
    var totalResults= '<?php echo count($productList->result()); ?>';
    if(totalResults > 0) {
    $("#side_bar").html("<img id='validationEr1r' align='middle' style='margin-left:200px; margin-top:20px;' src='images/ajax-loader.gif' />");
    <?php 
	
    if(count($productList->result()) > 0){$hoverlist='1';
      foreach($productList->result() as $Row_Rental){
        
        if($Row_Rental->userid !='' && $Row_Rental->userid !='0' ){
          $useId=base_url().'users/show/'.$Row_Rental->userid;
        }else{
          $useId='javascript:void(0);';
        }
        
        if($Row_Rental->userphoto!='' && $Row_Rental->userphoto!='0' ){
		  if(strpos($Row_Rental->userphoto, 'googleusercontent') > 1)
		  $useImg=$Row_Rental->userphoto;
		  else 
          $useImg=base_url().'images/users/'.$Row_Rental->userphoto;
        }else{
          $useImg=base_url().'images/site/profile.png';
        }
      
      ?>
      
      var lat ='<?php echo $Row_Rental->latitude; ?>'; 
      var lng ='<?php echo $Row_Rental->longitude; ?>';
	  
      var point = new google.maps.LatLng(lat,lng);
	  
	  <?php 
	  $simg = PRODUCTPATH.'dummyProductImage.jpg';

	  if($Row_Rental->product_image!= '' && file_exists('./server/php/rental/thumbnail/'.$Row_Rental->product_image)){ 
	  $simg = PRODUCTPATH.'thumbnail/'.$Row_Rental->product_image;
	  }
	  else if($Row_Rental->product_image!= '' && file_exists('./server/php/rental/'.$Row_Rental->product_image)){ 
	  $simg = PRODUCTPATH.$Row_Rental->product_image;	  
	  }
	  else if($Row_Rental->product_image!= '' && strpos($Row_Rental->product_image, 's3.amazonaws.com') > 1)$simg=$Row_Rental->product_image;?>
	  
      var html = '<div class="infoBox similar-listing" ><li><div class="figures-cobnt"><img src="<?php echo $simg; ?>"></div><div class="posi-abs"><a class="heart" href="rental/<?php echo $Row_Rental->id; ?>" target="_blank"></a><label class="pric-tag"><span class="rm-rate"><?php echo $currencySymbol; ?></span><?php echo CurrencyValue($Row_Rental->id,$Row_Rental->price); ?></label><a class="aurtors" href="<?php echo $useId; ?>"><img style="border-radius: 50%;height: 70px !important; width: 100px;" src="<?php echo $useImg; ?>"></a></div><div class="img-bottom"><span class="headlined"><a  href="rental/<?php echo $Row_Rental->id; ?>"><?php echo addslashes($Row_Rental->product_title); ?></a></span><p class="describ"><?php if($Row_Rental->room_type > 0 ){
     $condition=array('id'=>$Row_Rental->room_type);
	  $listspace_values = $this->product_model->get_all_details(LISTSPACE_VALUES, $condition);
	  echo ucfirst($listspace_values->row()->list_value);
	  } else { 
	 echo ucfirst($Row_Rental->room_type); 
	 } ?>- <?php echo addslashes(ucfirst($Row_Rental->city_name)); ?></p></div></li></div>';
    
		var details='<li data-price="<?php echo CurrencyValue($Row_Rental->id ,$Row_Rental->price ); ?>"><div class="img-top">';
		<?php if($loginCheck==''){?>
		var details1='<a class="ajax cboxElement heart reg-popup1" href="site/rentals/AddWishListForm/<?php echo $Row_Rental->id;?>"></a>';
		<?php }else{ ?>
		var details1='<a class="ajax cboxElement <?php if(in_array($Row_Rental->id,$newArr))echo 'heart-exist'; else echo 'heart';?>" href="site/rentals/AddWishListForm/<?php echo $Row_Rental->id;?>"></a>';
		<?php } ?>
	
	var details2='<div class="figures-cobnt"><a href="rental/<?php echo $Row_Rental->id;?>" target="_blank"><img src="<?php echo $simg; ?>"></a></div><div class="posi-abs"><label class="pric-tag"><span class="curSymbol"><?php echo $currencySymbol; ?></span><?php echo CurrencyValue($Row_Rental->id ,$Row_Rental->price ); ?></label><a class="aurtors" href="<?php echo $useId; ?>"><img style="border-radius: 50%;height: 70px !important; width: 100px;" src="<?php echo $useImg; ?>"></a></div></div><div class="img-bottom"><span class="headlined"><a  href="rental/<?php echo $Row_Rental->id; ?>"><?php echo addslashes($Row_Rental->product_title); ?></a></span><p class="describ"><?php if($Row_Rental->room_type > 0 ){
     $condition=array('id'=>$Row_Rental->room_type);
	  $listspace_values = $this->product_model->get_all_details(LISTSPACE_VALUES, $condition);
	  echo ucfirst($listspace_values->row()->list_value);
	  } else { 
	 echo ucfirst($Row_Rental->room_type); 
	 } ?>- <?php echo addslashes(ucfirst($Row_Rental->city_name)); ?></p></div></li>';
    
      var label ='<?php echo trim(addslashes($Row_Rental->product_title));?>';
          // create the marker
          var marker = createMarker(point,label,html,"blue",details+details1+details2,'<?php echo $Row_Rental->id; ?>');
      <?php $hoverlist=$hoverlist+1;}
    } ?>
        
        // put the assembled side_bar_html contents into the side_bar div
        side_bar_html='<div class="map-areas"><ul class="similar-listing">'+side_bar_html;
        side_bar_html=side_bar_html+'</ul></div>';
		$("#side_bar").html(side_bar_html);
		side_bar_html = "";
    
    }else{
    $("#side_bar").html("<div class='map-areas'><ul class='similar-listing'><li></li></ul></div>");
    }
}

function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}
</script> 
</div>
<script>
var mapajax=0;
function doAjax(){
	if(mapajax==0 || mapajax==1)
	{
		city=$('#autocompleteNew').val();	
	}
	else
	{
		city='';
	}
	mapajax++;
	$(".similar-listing").css("opacity", "0.2");
	var paginationId = $("#paginationId").val();
	var pricemin = $("#minPrice").val();
	var pricemax = $("#maxPrice").val();
	var dateFrom = $("#txtFromDate").val();
	var dateTo = $("#txtToDate").val();
	var gueatsCount = $("#guests").val();
	var newRoom_type = [];
    $('.room_type:checked').each(function(i){
		newRoom_type[i] = $(this).val();
    });
	var newProperty_type = [];
    $('.property_type:checked').each(function(i){
		newProperty_type[i] = $(this).val();
    });
	var newListvalue = [];
    $('.list_value:checked').each(function(i){
		newListvalue[i] = $(this).val();
    });
	var zoom = map.getZoom();
	var bounds = map.getBounds();
	var minLat = bounds.getSouthWest().lat();
	var minLong = bounds.getSouthWest().lng();
	var maxLat = bounds.getNorthEast().lat();
	var maxLong = bounds.getNorthEast().lng();
	var cLat = bounds.getCenter().lat(); 
	var cLong = bounds.getCenter().lng(); 
		if(zoom != 13)
	{
		$("#zoom").val(zoom);
		$("#minLat").val(minLat);
		$("#minLong").val(minLong);
		$("#maxLat").val(maxLat);
		$("#maxLong").val(maxLong);
		$("#cLat").val(cLat);
		$("#cLong").val(cLong);
	}
	else
	{
		zoom = $("#zoom").val();
		minLat = $("#minLat").val();
		minLong = $("#minLong").val();
		maxLat = $("#maxLat").val();
		maxLong = $("#maxLong").val();
		cLat = $("#cLat").val();
		cLong = $("#cLong").val();
	}
	$.ajax({
		url: '<?php echo base_url();?>site/rentals/mapViewAjax',
		type:"POST",
		data:{"city":city,"paginationId":paginationId,"pricemin":pricemin,"pricemax":pricemax,"checkin":dateFrom,"checkout":dateTo,"guests":gueatsCount,"room_type":newRoom_type,"property_type":newProperty_type,"listvalue":newListvalue,"minLat":minLat,"minLong":minLong,"maxLat":maxLat,"maxLong":maxLong,"cLat":cLat,"cLong":cLong,'zoom':zoom},
		success:function(data){
			$("#ajax_map").html(data);
			setAllMap(null);
			markers = [];
			downloadUrl();
			$(".similar-listing").css("opacity", "none !important");
			
		}
	});
}
</script>
<script type="text/javascript">

var infowindow = new google.maps.InfoWindow(
  { 
    size: new google.maps.Size(150,150)
  });
    

    // This Javascript is based on code provided by the
    // Community Church Javascript Team
    // http://www.bisphamchurch.org.uk/   
    // http://econym.org.uk/gmap/
    // from the v2 tutorial page at:
    // http://econym.org.uk/gmap/basic3.htm 
//]]>
</script>
<script>
$(document).ready(function () {
   var seleced_date=$('#txtFromDate').val();
       seleced_date=seleced_date.split('/');
	   seleced_date[1]=parseInt(seleced_date[1])+1;
    var daysToAdd = 1;
    $("#txtFromDate").datepicker({
        minDate:0,
        onSelect: function (selected) {
            var dtMax = new Date(selected);
            dtMax.setDate(dtMax.getDate() + daysToAdd); 
            var dd = dtMax.getDate();
            var mm = dtMax.getMonth() + 1;
            var y = dtMax.getFullYear();
            var dtFormatted = mm + '/'+ dd + '/'+ y;
            $("#txtToDate").datepicker("option", "minDate", dtFormatted);
        }
    }); 
    if( seleced_date[2] == '' || seleced_date[2] == undefined ){
	 $("#txtToDate").datepicker({
	   
	   minDate:0,
	   onSelect: function (selected) {
            var dtMax = new Date(selected);
            dtMax.setDate(dtMax.getDate() - daysToAdd); 
            var dd = dtMax.getDate();
            var mm = dtMax.getMonth() + 1;
            var y = dtMax.getFullYear();
            var dtFormatted = mm + '/'+ dd + '/'+ y;
            $("#txtFromDate").datepicker("option", "maxDate", dtFormatted);
			doAjax();
        }
    });
	}else {
    $("#txtToDate").datepicker({
	   
	   
        minDate:new Date(seleced_date[2],seleced_date[0],seleced_date[1]) ,
		onSelect: function (selected) {
            var dtMax = new Date(selected);
            dtMax.setDate(dtMax.getDate() - daysToAdd); 
            var dd = dtMax.getDate();
            var mm = dtMax.getMonth() + 1;
            var y = dtMax.getFullYear();
            var dtFormatted = mm + '/'+ dd + '/'+ y;
            $("#txtFromDate").datepicker("option", "maxDate", dtFormatted);
			doAjax();
        }
    });
	}
});
 
 
 
function setPagination(id) {
	$('#paginationId').val(id);
	doAjax();
	//$('#search_result_form').submit();
}
$(document).ready(function() { 
if( $('#txtToDate').val() !='' ){

selectedDate1 = $("#txtFromDate").val();
$( "#txtToDate" ).datepicker( "option", "minDate", selectedDate1 );
} 
});


</script>
  
 
<div class="map-search">
<div>
  <div class="sidebar">
    <div class="filters filters-collapse">
		<form class="form-horizontal trip-form" action="property?city=<?php echo $_GET['city']; ?>" method="POST" id="search_result_form">
			<ul class="filter-list unstyled">
				<li data-tooltip-position="left" rel="tooltip" class="intro-filter clearfix" title="Trip"><h6 class="span2 filter-label"><?php if($this->lang->line('dates') != '') { echo stripslashes($this->lang->line('dates')); } else echo "Dates";?></h6>
				<div class="control-group">
				<input type="hidden" name="paginationId" id="paginationId" value="<?php if($paginationId!='')echo $paginationId;else echo '0';?>" />
				<input type="hidden" name="pricemin"  value="<?php echo $_POST['pricemin'];?>" id="minPrice" />
				<input type="hidden" name="pricemax" value="<?php echo $_POST['pricemax'];?>" id="maxPrice" />
				<input type="hidden" name="zoom"  value="<?php if($zoom != '')echo $zoom; else echo '13'; ?>" id="zoom" />
				<input type="hidden" name="minLat"  value="<?php echo $minLat; ?>" id="minLat" />
				<input type="hidden" name="minLong"  value="<?php echo $minLong; ?>" id="minLong" />
				<input type="hidden" name="maxLat"  value="<?php echo $maxLat; ?>" id="maxLat" />
				<input type="hidden" name="maxLong"  value="<?php echo $maxLong; ?>" id="maxLong" />
				<input type="hidden" name="cLat" value="<?php if($zoom != '')echo $cLat;else echo $lat;?>" id="cLat" />
				<input type="hidden" name="cLong"  value="<?php if($zoom != '')echo $cLong;else echo $long; ?>" id="cLong" />
				<input type="text" placeholder="<?php if($this->lang->line('check_in') != '') { echo stripslashes($this->lang->line('check_in')); } else echo "Check in";?>" value="<?php if($_GET['datefrom']!='')echo $_GET['datefrom'];else if($_POST['checkin'])echo $_POST['checkin']; ?>" id="txtFromDate" name="checkin">
				<input type="text" placeholder="<?php if($this->lang->line('check_out') != '') { echo stripslashes($this->lang->line('check_out')); } else echo "Check out";?>"  id="txtToDate" value="<?php if($_GET['dateto']!='')echo $_GET['dateto'];else if($_POST['checkout'])echo $_POST['checkout']; ?>" name="checkout" onchange="doAjax()">
				<select data-prefill="" class="guest-select input-medium" name="guests" id="guests" onchange = "doAjax()">
				<?php foreach($accommodates as $accommodate) { if($accommodate==1){?>
				<option value="<?php echo $accommodate;?>" <?php if($_GET['guests']==$accommodate){?>selected="selected"<?php }?>><?php echo $accommodate.' Guest'?></option>
				<?php } else {?>
				<option value="<?php echo $accommodate;?>" <?php if($_GET['guests']==$accommodate || $_POST['guests']==$accommodate){?>selected="selected"<?php }?>>
				<?php echo $accommodate.' Guests';?></option>
				<?php }?>
				<?php }?>
				</select>
				</div>
				</li>
				<?php $propertyTypes = $this->product_model->get_all_details(LISTSPACE_VALUES,array('listspace_id'=>9), array(array('field'=>'other', 'type'=>'asc'))); 
				$listRoomSpaceCondition['attribute_seourl']	=	'roomtype';
				$listRoomSpaceCondition['status']	=	'Active';
			
				$roomListSpace = $this->product_model->get_all_details(LISTSPACE,$listRoomSpaceCondition);
			
				if($roomListSpace->num_rows() != 0)
				{
				$roomTypeListSpace	=	$roomListSpace->row()->id;
			
				$roomType = $this->product_model->get_all_details(LISTSPACE_VALUES,array('listspace_id'=>$roomTypeListSpace), array(array('field'=>'other', 'type'=>'asc'))); 
				?>
				<li data-tooltip-position="left" rel="tooltip" class="clearfix room-type-group intro-filter showlist5" title="Room Type">
				<h6 class="span2 filter-label linedpads2"><?php echo $roomListSpace->row()->attribute_name;?></h6>
				<div class="right-arel onclk-hide">
				<?php $room_count=0;
				foreach($roomType->result() as $room_data)
				{
				if($room_count < 3 ){?>
				<label>
				<input type="checkbox" name="room_type[]" class='room_type' value="<?php echo $room_data->list_value;?>" <?php foreach($_POST['room_type'] as $property_type) { if($property_type == $room_data->list_value){ ?> checked="checked" <?php } } ?> onchange="doAjax()"/>
				<span><?php echo $room_data->list_value;?></span>
				</label>
				<?php if($room_count == 2){ ?></div><?php }?>
				<?php } else { ?>
				<?php if($room_count == 3){ ?><div class="drop4btn"><i class="caret"></i></div>
				<div class="right-arel"><?php }?>
				<label>
				<input type="checkbox" name="room_type[]" class='room_type' value="<?php echo $room_data->list_value;?>" <?php foreach($_POST['room_type'] as $property_type) { if($property_type ==trim($room_data->list_value)){ ?> checked="checked" <?php } } ?> onchange="doAjax()"/>
				<span><?php echo $room_data->list_value;?></span>
				</label>
				<?php } $room_count++;} ?>
				<?php if($room_count > 3){ ?>
				</div>
				<?php }?>

				</li>
				<?php } ?>
				<li data-tooltip-position="left" rel="tooltip" class="clearfix intro-filter pricefil" title="Price">
				<h6 class="span2 filter-label linedpad3"><?php if($this->lang->line('price_range') != '') { echo stripslashes($this->lang->line('price_range')); } else echo "Price Range";?></h6>
			<div class="sliderholder">	<div class="price_slider">
				<div id="slider-range"></div></div>
				<input type="text" value="<?php echo $currencySymbol;echo floor($this->session->userdata('currency_r')*$SMinPrice);?>" style="color: rgb(94, 85, 90); text-align:right; font-weight: normal; font-family: OpenSansSemibold; background:none; border: medium none; box-shadow: none; margin: -11px 0px 0px 0px;position: relative;top: 20px;width: 34%;  text-align: left;" id="amount_pricefilter1" readonly>
				<input type="text" value="<?php echo $currencySymbol;echo ceil($this->session->userdata('currency_r')*$SMaxPrice);?>" style="color: rgb(94, 85, 90); text-align:right; font-weight: normal; font-family: OpenSansSemibold; border: medium none; box-shadow: none; margin: -11px 0px 0px 0px;position: relative;top: 20px;width: 34%; background:none;" id="amount_pricefilter2" readonly>
</div>
				</li>
  
				<li><div class="filter-reald">
					<a href="javascript:showView('6');" class="filter-btn" id="plus_botton" style="margin:10px 0 0 20px;"><?php if($this->lang->line('more_filters') != '') { echo stripslashes($this->lang->line('more_filters')); } else echo "More Filters";?> <i class="fa fa-plus"></i></a>
					<a href="javascript:showView('6');" class="filter-btn" id="minus_botton" style="margin:10px 0 0 20px;display:none;"><?php if($this->lang->line('more_filters') != '') { echo stripslashes($this->lang->line('more_filters')); } else echo "More Filters";?> <i class="fa fa-minus"></i></a>
				</div></li>
	<?php 
	$listSpaceCondition['attribute_seourl']	=	'propertytype';
			$listSpaceCondition['status']	=	'Active';
			
			$carListSpace = $this->product_model->get_all_details(LISTSPACE,$listSpaceCondition);
			
			if($carListSpace->num_rows() != 0)
			{
			$carTypeListSpace	=	$carListSpace->row()->id;
		    $propertyTypes = $this->product_model->get_all_details(LISTSPACE_VALUES,array('listspace_id'=>$carTypeListSpace), array(array('field'=>'other', 'type'=>'asc'))); 
			
	?>
		<li title="" data-tooltip-position="left" rel="tooltip" class="clearfix showlist5 showlist6" >
				<h6 class="span2 filter-label  left-widt">
				<?php echo $carListSpace->row()->attribute_name;?></h6>
				<div class="right-arel onclk-hide">
				<?php
				$i=0;
				//echo "<pre>"; print_r($_POST['property_type']);
				foreach($propertyTypes->result() as $tmp)
				{
				if($i < 3 ){?>
					<label>
						<input type="checkbox" name="property_type[]" class='property_type'  onchange="doAjax()" value="<?php echo trim($tmp->list_value);?>" <?php foreach($_POST['property_type'] as $property_type) { if(trim($property_type) == trim($tmp->list_value)){ ?> checked="checked" <?php } } ?>/>
						<span><?php echo $tmp->list_value;?></span>
					</label>
				<?php if($i == 2){?>
				</div><?php }?>
				<?php } else {?>
				<?php if($i == 3){?><div class="drop4btn"><i class="caret"></i></div>
				<div class="right-arel"><?php }?>
					<label>
						<input type="checkbox" name="property_type[]" class='property_type' value="<?php echo trim($tmp->list_value);?>" <?php foreach($_POST['property_type'] as $property_type) { if(trim($property_type) == trim($tmp->list_value)){ ?> checked="checked" <?php } } ?>/>
						<span><?php echo $tmp->list_value;?></span>
					</label>
			<?php } $i++;} ?>
			<?php if($i > 3){ ?>
			</div>
			<?php }?>
	</li>
			<?php } 
		$list_value_loop=1;
		foreach($main_cat as $category) {
			$sec_categ_loop_count=count($sec_category[$category->id]);
			if($sec_categ_loop_count!=0 && $category->id != 12){
		?>
			<li title="<?php echo $category->attribute_name;?>" data-tooltip-position="left" rel="tooltip" class="clearfix showlist5 showlist6">
				<h6 class="span2 filter-label  left-widt"><?php echo $category->attribute_name;?></h6>
				<?php
				for($i=0;$i<3;$i++){
					if($i==0){
					echo '<div class="right-arel onclk-hide">';
					}
				if($sec_category[$category->id][$i]['list_value'] != '') {
				?>
				<label>
					<input type="checkbox" name="listvalue[]" class='list_value'  onchange="doAjax()"  value="<?php echo $sec_category[$category->id][$i]['id'];?>" <?php foreach($_POST['listvalue'] as $listid) { if($listid ==$sec_category[$category->id][$i]['id']){ ?> checked="checked" <?php } } ?> />
					<span title=" <?php echo $sec_category[$category->id][$i]['list_value'];?>"> <?php echo $sec_category[$category->id][$i]['list_value'];?></span>
				</label>
				<?php } else break;
					$list_value_loop++;
					if($i==2){
						echo '</div><div class="drop4btn"><i class="caret"></i></div>';
					}
				}
				for($j=3;$j<$sec_categ_loop_count;$j++){
					if($j==3){
						echo '<div class="right-arel">';
					}
				?>
				<label>
				<?php //print_r($_POST['listvalue']); die; ?>
					<input type="checkbox" name="listvalue[]" onchange="doAjax()" alt="<?php echo $sec_category[$category->id][$j]['list_value'];?>" class='list_value'  value="<?php echo $sec_category[$category->id][$j]['id'];?>" <?php foreach($_POST['listvalue'] as $listid) { if($listid ==$sec_category[$category->id][$j]['id']){ echo 'checked="checked"'; } } ?> />
					<span title=" <?php echo $sec_category[$category->id][$j]['list_value'];?>"> <?php echo $sec_category[$category->id][$j]['list_value'];?></span>
				</label>
				<?php
					$list_value_loop++;
					if($j==$sec_categ_loop_count){
						echo '</div>';
					}
				}
				?>
			</li>
		<?php 
			}
		}
		
		?> 

      <div class="showlisting clearfix showlist5 showlist6">
        <a class="show-btn23"><input class="" style="width: 100%; background: none repeat scroll 0 0 rgba(0, 0, 0, 0); border: medium none; box-shadow: none; color: #fff; font-family: opensanssemibold; font-size: 17px; padding: 0;" type="button" onclick = "doAjax();javascript:showView('6');" value="<?php if($this->lang->line('show_listing') != '') { echo stripslashes($this->lang->line('show_listing')); } else echo "Show Listing";?>" /></a>
      </div>
     

  </ul>
</form>
     
    </div>
     

      
   <div class="sidebar-header-placeholder"></div>
    <!--<div id="header_pagination"><?php //echo $newpaginationLink; ?></div>-->
    <div class="search-results">
		<div class="listings-loading clearfix">
			<div id="side_bar">
			</div>
		</div>
    </div>
	<div id="footer_pagination"><?php //echo $newpaginationLink; ?></div>
  </div>

  <div class="map" id="map-div" >
   <div id="map_canvas" style="width: 100%; height: 100%;"></div>
  </div>
  

</div>
<?php if(isset($PriceMaxMin)){ ?>
<input type="hidden" id="min_price_start" value="<?php if($PriceMaxMin->row()->MinPrice != $PriceMaxMin->row()->MaxPrice)echo $PriceMaxMin->row()->MinPrice*$this->session->userdata('currency_r'); else echo '0.00';?>">
<?php } ?>
<input type="hidden" id="GetCity" value="<?php echo addslashes(str_replace(' ','+',$_GET['city'])); ?>"  />

<style>
.filter-primary-item input[type="checkbox"] {
    display: none;
}

input[type="checkbox"]:checked + i {
    border: 1px solid red;
}
</style>

<script type="text/javascript">


 /* $(function() { 

$( "#datepicker" ).datepicker({
defaultDate: "+1w",
maxDate : '+1D',
changeMonth: true,
numberOfMonths: 1,
minDate:0,
onClose: function( selectedDate ) {
  if($( "#datepicker1" ).val()==''){
    $( "#datepicker1" ).datepicker( "option", "maxDate", selectedDate).focus();
  }else{
    $( "#datepicker1" ).datepicker( "option", "maxDate", selectedDate);
  }
}
});
$( "#datepicker1" ).datepicker({
defaultDate: "+1w",
changeMonth: true,
 maxDate : '+1D',
numberOfMonths: 1,
minDate:0,
onClose: function( selectedDate ) {
if($( "#datepicker" ).val()==''){
$( "#datepicker" ).datepicker( "option", "maxDate", selectedDate ).focus();
}else{
$( "#datepicker" ).datepicker( "option", "maxDate", selectedDate );
}
}
});

}); */



$(".filter-primary-item i").click(function(){
     $(this).prev().attr('checked',true);
   
});

$(function()
{
$('.drop4btn').click(function()
{
$(this).next().slideToggle();
});

$('.drop4btn').each(function()
{
$(this).next().css('display','none');
});

});





<?php 
if(isset($PriceMaxMin)){
?>
$(function() {
var min_price_start = $("#min_price_start").val() * 1;
	<?php if($_POST['pricemin'] != '' && $_POST['pricemax'] != '') {?>
	$("#amount_pricefilter1").val("<?php echo $this->session->userdata('currency_s');?> <?php echo $_POST['pricemin']*$this->session->userdata('currency_r');?>");
	$("#amount_pricefilter2").val("<?php echo $this->session->userdata('currency_s');?> <?php echo $_POST['pricemax']*$this->session->userdata('currency_r');?>");
	<?php } ?>
	var options = {
        range: true,
        min: Math.floor(min_price_start),
        max: Math.ceil('<?php echo $PriceMaxMin->row()->MaxPrice*$this->session->userdata('currency_r');?>'),
		
        values: ['<?php if($_POST['pricemin'] != '')echo $_POST['pricemin']*$this->session->userdata('currency_r');else echo 0;?>', '<?php if($_POST['pricemax'] != '')echo $_POST['pricemax']*$this->session->userdata('currency_r');else echo $PriceMaxMin->row()->MaxPrice*$this->session->userdata('currency_r');?>'],
		change: function( event, ui ) {doAjax();},
        slide: function(event, ui) {
            var min = ui.values[0],
                max = ui.values[1];

            $("#amount_pricefilter1").val("<?php echo $this->session->userdata('currency_s');?>" + min);
			$("#amount_pricefilter2").val("<?php echo $this->session->userdata('currency_s');?>" + max);
			
            showProducts(min, max);
        }
    }, min, max;

    $("#slider-range").slider(options);

    min = $("#slider-range").slider("values", 0);
    max = $("#slider-range").slider("values", 1);


	$('#autocomplete').val('<?php echo addslashes($_GET['city']);?>');
  
});
<?php }?>
</script>
<script>

function showProducts(minPrice, maxPrice) {
	<?php if($this->session->userdata('currency_r') != ''){?>
		var currency_r = <?php echo $this->session->userdata('currency_r');?>;
	<?php } ?>
	var newMin = Math.ceil(minPrice/currency_r);
	var newMax = Math.ceil(maxPrice/currency_r);
	$("#minPrice").val(newMin);
	$("#maxPrice").val(newMax);
	//doAjax();
}
</script>
<style>
.drop4btn{
    float: left;
    position: absolute;
    right: 62px;
    top: 30px;
	cursor:pointer;
}
.form-horizontal.trip-form .showlist5{position:relative}

.filter-primary-item{
	border: 1px solid #dce0e0;
	background:#edefed;
	padding:5px;
}

.ui-datepicker {  
    width: 216px;  
    height: auto;  
    margin: 5px auto 0;  
    font: 9pt Arial, sans-serif;  
    -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);  
    -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);  
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);  
} 

.dark-caret-right-top{display:none !important;}
.ui-datepicker-header {  
	background: url('images/dark_leather.png') repeat 0 0 #000;  
	color: #e0e0e0;  
	font-weight: bold;  
	-webkit-box-shadow: inset 0px 1px 1px 0px rgba(250, 250, 250, 2);  
	-moz-box-shadow: inset 0px 1px 1px 0px rgba(250, 250, 250, .2);  
	box-shadow: inset 0px 1px 1px 0px rgba(250, 250, 250, .2);  
	text-shadow: 1px -1px 0px #000;  
	filter: dropshadow(color=#000, offx=1, offy=-1);  
	line-height: 30px;  
	border-width: 1px 0 0 0;  
	border-style: solid;  
	border-color: #111;  
}  
.ui-datepicker thead {  
    background-color: #f7f7f7;  
    background-image: -moz-linear-gradient(top,  #f7f7f7 0%, #f1f1f1 100%);  
    background-image: -webkit-gradient(linear, left top, left bottombottom, color-stop(0%,#f7f7f7), color-stop(100%,#f1f1f1));  
    background-image: -webkit-linear-gradient(top,  #f7f7f7 0%,#f1f1f1 100%);  
    background-image: -o-linear-gradient(top,  #f7f7f7 0%,#f1f1f1 100%);  
    background-image: -ms-linear-gradient(top,  #f7f7f7 0%,#f1f1f1 100%);  
    background-image: linear-gradient(top,  #f7f7f7 0%,#f1f1f1 100%);  
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f7f7f7', endColorstr='#f1f1f1',GradientType=0 );  
    border-bottom: 1px solid #bbb;  
}
.ui-datepicker-prev {  
    float: left;  
}  
.ui-datepicker-next {  
    float: right;  
} 
    
  
.ui-datepicker-prev, .ui-datepicker-next {  
	display: inline-block;  
	width: 30px;  
	height: 30px;  
	text-align: center;  
	cursor: pointer;  
	line-height: 600%;  
	overflow: hidden;  
} 
.ui-state-disabled{
	opacity: 1 !important;
}
.ui-datepicker .ui-datepicker-prev span{
	display: inline-block;  
	text-align: center;  
	cursor: pointer;  
	line-height: 600%;  
	overflow: hidden;
}
.ui-datepicker th {  
	text-transform: uppercase;  
	font-size: 6pt;  
	padding: 5px 0;  
	color: #666666;  
	text-shadow: 1px 0px 0px #fff;  
	filter: dropshadow(color=#fff, offx=1, offy=0);  
}  
.ui-datepicker thead {  
	background-color: #f7f7f7;  
	background-image: -moz-linear-gradient(top,  #f7f7f7 0%, #f1f1f1 100%);  
	background-image: -webkit-gradient(linear, left top, left bottombottom, color-stop(0%,#f7f7f7), color-stop(100%,#f1f1f1));  
	background-image: -webkit-linear-gradient(top,  #f7f7f7 0%,#f1f1f1 100%);  
	background-image: -o-linear-gradient(top,  #f7f7f7 0%,#f1f1f1 100%);  
	background-image: -ms-linear-gradient(top,  #f7f7f7 0%,#f1f1f1 100%);  
	background-image: linear-gradient(top,  #f7f7f7 0%,#f1f1f1 100%);  
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f7f7f7', endColorstr='#f1f1f1',GradientType=0 );  
	border-bottom: 1px solid #bbb;  
}
  .ui-datepicker tbody td {  
    padding: 0;  
    border-right: 1px solid #bbb;  
} 
    .ui-datepicker tbody td:last-child {  
        border-right: 0px;  
    }  
      .ui-datepicker tbody tr {  
        border-bottom: 1px solid #bbb;  
    }  
    .ui-datepicker tbody tr:last-child {  
        border-bottom: 0px;  
    }  
  #ui-datepicker-div .ui-state-default{
   background:none;
  }
  #ui-datepicker-div .ui-state-focus ,#ui-datepicker-div .ui-state-highlight ,a .ui-state-hover{
   background:none;
  }
  
.infoBox:before {
    border-color: #FFFFFF transparent transparent;
    border-style: solid;
    border-width: 15px;
   
    position: absolute;
}
.infoBox .listing-img img{
position: inherit;

}
.gm-style-iw{

}

body{position: relative;}

</style>
</section>

<button class="hide-sm btn footer-toggle open">
<span class="open-content">
<i class="fa fa-globe"></i>
Language and Currency
</span>
<span class="close-content">
<i class="fa fa-times"></i>
Close
</span>
</button>

<!---FOOTER-->
<footer class="map-footer">
<div class="footer-bg">
<div class="container">
<div class="container1">
<div class="col-md-4 inputfoot">
<div class="country-lop">
<script>
function changeLanguage(e)
{
  var strUser = e.options[e.selectedIndex].value;
  window.location.href = strUser;
}
</script>
<select onChange="changeLanguage(this);">
<?php 
$selectedLangCode = $this->session->userdata('language_code');
if ($selectedLangCode == ''){
  $selectedLangCode = $defaultLg[0]['lang_code'];
}
if (count($activeLgs)>0){
  foreach ($activeLgs as $activeLgsRow){?>              
  <option value="<?php echo base_url(); ?>lang/<?php echo $activeLgsRow['lang_code'];?>" <?php if ($selectedLangCode == $activeLgsRow['lang_code']){echo 'selected="selected"';}?>><?php echo $activeLgsRow['name'];?></option>
    <?php } } ?>
</select>
<!--<input class="country" id="selected_country" placeholder="English" type="text" style="text-transform:capitalize;">
<ul class="dropdn">
             <?php 
        $selectedLangCode = $this->session->userdata('language_code');
                if ($selectedLangCode == ''){
                  $selectedLangCode = $defaultLg[0]['lang_code'];
                }
                if (count($activeLgs)>0){
                  foreach ($activeLgs as $activeLgsRow){
                ?>              
                    <li><a href="lang/<?php echo $activeLgsRow['lang_code'];?>" <?php if ($selectedLangCode == $activeLgsRow['lang_code']){echo 'class="active"';}?>><?php echo $activeLgsRow['name'];?></a></li>
                <?php } } ?>

</ul>-->

</div>

<div class="country-lop">
<script>
function changeCurrency(e)
{
  var strUser = e.options[e.selectedIndex].value;
  window.location.href = strUser;
}
</script>
<select onChange="changeCurrency(this);">
<?php 
if($currency_setup->num_rows() >0){ 
foreach($currency_setup->result() as $currency_s){
  if($currency_s->currency_type==$this->session->userdata('currency_type')){
  $SelecTed='selected="selected"';
  }
  else{
  $SelecTed='';
  }?>             
  <option value="<?php echo base_url(); ?>change-currency/<?php echo $currency_s->id; ?>" <?php echo $SelecTed; ?>><?php echo $currency_s->currency_type; ?></option>
    <?php } } ?>
</select>
<!--<ul class="dropdn">



                 <?php 
          if($currency_setup->num_rows() >0){ 
            foreach($currency_setup->result() as $currency_s){
            if($currency_s->currency_type==$this->session->userdata('currency_type')){
            $SelecTed='selected="selected"';
            }else{
            $SelecTed='';
            }
            ?>
                      <li <?php echo $SelecTed; ?>><a href="change-currency/<?php echo $currency_s->id; ?>"><?php echo $currency_s->currency_type; ?></a></li>
                   <?php }
           }?> 
</ul>-->
<!-- $this->session->userdata('currency_type') -->
</div>
</div>


<div class="col-md-4">
<ul class="footer-list">

<li><span><?php if($this->lang->line('Company') != '') { echo stripslashes($this->lang->line('Company')); } else echo "Company"; ?></span></li>
<?php 
if ($cmsList->num_rows() > 0){
foreach ($cmsList->result() as $row){ ?> 
<li><a href="pages/<?php echo $row->seourl; ?>"><?php echo $row->page_name;?></a></li> 
<?php } }  ?>
</ul>

</div>


<div class="col-md-4">
<ul class="footer-list">
<a href="<?php echo base_url();?>"><img src="images/logo/<?php echo $this->config->item('logo_image');?>" alt=""></a>
</ul>

</div>





</div>

<div class="copy-txt col-md-12 footer-bottom">

  <span><?php if($this->lang->line('JoinUsOn') != '') { echo stripslashes($this->lang->line('JoinUsOn')); } else echo "Join Us On"; ?></span>
  <ul class="footer-list">
  <li></li>
<li><a target="_blank" href="<?php echo $this->config->item('facebook_link');?>" alt="<?php if($this->lang->line('signup_facebook') != '') { echo stripslashes($this->lang->line('signup_facebook')); } else echo "Facebook";?>"><i class="icon footer-icon icon-facebook"></i></a></li>
<li><a target="_blank" href="<?php echo $this->config->item('twitter_link');?>" alt="<?php if($this->lang->line('signup_twitter') != '') { echo stripslashes($this->lang->line('signup_twitter')); } else echo "Twitter";?>"><i class="icon footer-icon icon-twitter"></i></a></li>
<li><a target="_blank" href="<?php echo $this->config->item('googleplus_link');?>" alt="<?php if($this->lang->line('signup_google') != '') { echo stripslashes($this->lang->line('signup_google')); } else echo "Google+";?>"><i class="icon footer-icon icon-google-plus"></i></a></li>
<li><a target="_blank" href="<?php echo $this->config->item('youtube_link');?>" alt="<?php if($this->lang->line('signup_youtube') != '') { echo stripslashes($this->lang->line('signup_youtube')); } else echo "Youtube";?>"><i class="fa fa-youtube-play"></i></a></li>
<li><a target="_blank" href="<?php echo $this->config->item('pinterest');?>" alt="<?php if($this->lang->line('pinterest') != '') { echo stripslashes($this->lang->line('pinterest')); } else echo "Pinterest";?>"><i class="icon footer-icon icon-pinterest"></i></a></li>

</ul>

<p><?php echo stripslashes($this->config->item('footer_content'));?></p>

</div>

</div>

</div>
<link rel="stylesheet" media="all" href="css/site/style-responsive.css" type="text/css" />
<link rel="stylesheet" media="all" href="css/site/style-responsive-only.css" type="text/css" />
</footer>
<!---FOOTER-->

<script type="text/javascript">
$('.footer-toggle').click(function(){
	$(this).toggleClass('open');
  var className = $(this).attr('class');
  var res = className.split(" "); 

	if(res[3]=='open'){
		$('.map-footer').css('display','none');
	} else {
	$('.map-footer').css('display','block');
	}
	$('.map-footer').toggleClass('footerup');
  
});

</script>