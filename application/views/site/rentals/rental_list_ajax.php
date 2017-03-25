<section id='ajax-search'></section>
<section id='normal-search'>

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<?php //echo $address; die; ?>
<script type="text/javascript">
jQuery(document).ready(function(){

initializeMap();
})
function showView(val){

  if($('.showlist'+val).css('display')=='block'){
    $('.showlist'+val).hide('');  
  }else{
    $('.showlist'+val).show('');
  } 
}
</script>
<script type="text/javascript">
function showView1(val){
  if($('.showlist'+val).css('display')=='list-item'){
    $('.showlist'+val).hide('');  
  }else{
    $('.showlist'+val).show('');
  } 
}
</script>
<!-- End show View more-->

<!-- price range-->
 <link rel="stylesheet" href="css/site/themes-smoothness-jquery-ui.css"  type="text/css"/>
<script>
    var currencyrate=$('#currencyrate').val(); 
    var GMaxPrice=$('#GMaxPrice').val() * currencyrate;
    var GMinPrice=$('#GMinPrice').val() * currencyrate;
    
    var SMaxPrice=$('#SMaxPrice').val() * currencyrate;
    var SMinPrice=$('#SMinPrice').val() * currencyrate;
    
    var currencysym=$('#currencysym').val();
    
    
    $(function() {
    
	var run = 0;
	$("#map-div").mousedown(function(){
	
	
	google.maps.event.addListener(map, 'bounds_changed', function() {
$("#map-div").mouseup(function(){

                           

			 
  if(run == 0){
   var zoom = map.getZoom();
  var bounds = new google.maps.LatLngBounds();
  bounds = map.getBounds();

		run++;
		mapAjax(bounds,zoom);
		}
		//return false;
		 //
           })
	

  }) 
  }) 
  
    $( "#slider-range" ).slider({
    range: true,
    min: GMinPrice,
    max: GMaxPrice,
    values: [ SMinPrice, SMaxPrice ],
    slide: function( event, ui ) {
    $( "#amount" ).val( currencysym + ui.values[ 0 ] + " - "+ currencysym + ui.values[ 1 ] );
    }
    });
    $( "#amount" ).val( currencysym + $( "#slider-range" ).slider( "values", 0 ) +
    " - "+ currencysym + $( "#slider-range" ).slider( "values", 1 ) );
    });
    
    $(function() {
    $( "#slider-price" ).slider({
    range: true,
    min: GMinPrice,
    max: GMaxPrice,
    values: [ SMinPrice, SMaxPrice ],
    slide: function( event, ui ) {
    $( "#amount" ).val( currencysym + ui.values[ 0 ] + " - "+ currencysym + ui.values[ 1 ] );
    }
    });
    $( "#amount" ).val( currencysym + $( "#slider-price" ).slider( "values", 0 ) +
    " - "+ currencysym + $( "#slider-price" ).slider( "values", 1 ) );
    });
    
    $(function() {
	
    $( "#slider-price" ).slider({
	
    range: true,
    min: GMinPrice,
    max: GMaxPrice,
    values: [ SMinPrice, SMaxPrice ],
    slide: function( event, ui ) {
   $( "#price" ).val( currencysym + ui.values[ 0 ] + " - "+ currencysym + ui.values[ 1 ] );
    
    $('#minPrice').val(Math.round(ui.values[ 0 ]));
    $('#maxPrice').val(Math.round(ui.values[ 1 ]));
    
    
    }
    });
    $( "#price" ).val( currencysym + $( "#slider-price" ).slider( "values", 0 ) +
    " - "+ currencysym + $( "#slider-price" ).slider( "values", 1 ) );
    });
    
    
    
</script>
<!-- End price range-->

<script type="text/javascript">

/*** 
    Simple jQuery Slideshow Script
    Released by Jon Raasch (jonraasch.com) under FreeBSD license: free to use or modify, not responsible for anything, etc.  Please link out to me if you like it :)
***/

function slideSwitch() {
    var $active = $('#slidebanner IMG.active');

    if ( $active.length == 0 ) $active = $('#slidebanner IMG:last');

    // use this to pull the images in the order they appear in the markup
    var $next =  $active.next().length ? $active.next()
        : $('#slidebanner IMG:first');

    // uncomment the 3 lines below to pull the images in random order
    
  $active.addClass('last-active');

    $next.css({opacity: 0.0})
        .addClass('active')
        .animate({opacity: 1.0}, 1000, function() {
            $active.removeClass('active last-active');
        });
}

$(function() {
			setInterval( "slideSwitch()", 5000 );
});
function searchAjax(){
							var check_in = $("#datepicker").val();
							var check_out = $("#datepicker1").val();
							var guests = $("#guests").val();
							var room_type= '' ;
							   $('.room_type:checked').each(function(){
							room_type += $(this).val()+',';
		
					});
				var property_type= '' ;
							   $('.property_type:checked').each(function(){
							property_type += $(this).val()+',';
		
					});
					property_type +='}';
					property_type = property_type.replace(",}", ""); 
					property_type = property_type.replace("}", "");
					
					room_type +='}';
					room_type = room_type.replace(",}", ""); 
					room_type = room_type.replace("}", ""); 
							var list_value = '';

		$.each($("input[name='listvalue[]']:checked"), function(){            
			list_value += $(this).val()+',';
		
					});
					list_value +='}';
					list_value = list_value.replace(",}", ""); 
					list_value= list_value.replace("}", "");
					
				//	alert(list_value);
					var pricemin = $("#minPrice").val();
					var pricemax = $("#maxPrice").val();
					var address = $("#GetCity").val();
					var search  = 'false';
				   $.ajax({
                                     url: '<?php echo base_url();?>site/rentals/ajax_mapview',
                                     type:"POST",
                                     dataType: 'Html',
                                    
									data:{search:search,check_in:check_in,check_out:check_out,property_type:property_type,guests:guests,room_type:room_type,listvalue:list_value,pricemin:pricemin,pricemax:pricemax,address:address},
                                     success:function(data){
                                         $("#normal-search").hide();
										 $("#ajax-search").html(data);
                                      }
                                 }); 
					
					
			
}

function mapAjax(latlong, zoom){
 
				var latlongvaues = latlong;

				var sw_lat = latlongvaues.getSouthWest().lat();
                var sw_lng = latlongvaues.getSouthWest().lng();
                var ne_lat = latlongvaues.getNorthEast().lat();
                var ne_lng = latlongvaues.getNorthEast().lng();
				var ce_lat = latlongvaues.getCenter().lat(); 
				var ce_lng = latlongvaues.getCenter().lng(); 
				
				var check_in = $("#datepicker").val();
				var check_out = $("#datepicker1").val();
				var guests = $("#guests").val();
				var room_type= '' ;
							 $.each($("input[name='room_type[]']:checked"), function(){
							room_type += $(this).val()+',';
		
					});
					room_type +='}';
					room_type = room_type.replace(",}", ""); 
					room_type = room_type.replace("}", ""); 
					
												var property_type= '' ;
							   $.each($("input[name='property_type[]']:checked"), function(){
							property_type += $(this).val()+',';
		
					});
					property_type +='}';
					property_type = property_type.replace(",}", ""); 
					property_type = property_type.replace("}", ""); 
					
					
							var list_value = '';

		$.each($("input[name='listvalue[]']:checked"), function(){            
					list_value += $(this).val()+',';
		
					});
					list_value +='}';
					list_value = list_value.replace(",}", ""); 
					list_value= list_value.replace("}", "");
					var pricemin = $("#minPrice").val();
					var pricemax = $("#maxPrice").val();
					var address = $("#GetCity").val();
					var search = 'true';
				  $.ajax({
                                     url: '<?php echo base_url();?>site/rentals/ajax_mapview',
                                     type:"POST",
                                     dataType: 'Html',
                                    
									data:{zoom:zoom,search:search,ce_lat:ce_lat,ce_lng:ce_lng,sw_lat:sw_lat,sw_lng:sw_lng,ne_lat:ne_lat,ne_lng:ne_lng,check_in:check_in,check_out:check_out,property_type:property_type,guests:guests,room_type:room_type,listvalue:list_value,pricemin:pricemin,pricemax:pricemax,address:address},
                                     success:function(data){
                                         $("#normal-search").hide();
										 $("#ajax-search").html(data);
                                      }
                                 });
					
					
			
}

</script>




<script type="text/javascript">
// When the DOM is ready, run this function
$(document).ready(function() {
  //Set the carousel options
  $('#quote-carousel').carousel({
    pause: true,
    interval: 4000,
    auto:false,
  });
});
</script>

<?php
//echo '<pre>';print_r($productList);die; 
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
<?php

//var_dump($PriceMaxMin->row()); 
//var_dump($productList->result());die;
$this->load->view('site/templates/header');
if($productList->num_rows() > 0){
 //echo $PriceMaxMin->row()->MaxPrice; die;
  if($PriceMaxMin->row()->MaxPrice==$PriceMaxMin->row()->MinPrice){
  $MinPrice='0.00';
  }else{
  $MinPrice=$PriceMaxMin->row()->MinPrice;
  }

  if($_GET['minPrice']=='' && $_GET['maxPrice']==''){
    if($SearchPriceMaxMin->row()->SMaxPrice==$SearchPriceMaxMin->row()->SMinPrice){
      $SMinPrice='0.00';
    }else{
      $SMinPrice=$SearchPriceMaxMin->row()->SMinPrice;
    }
    $SMaxPrice=$SearchPriceMaxMin->row()->SMaxPrice;
  }else{
    $SMinPrice=$_GET['minPrice']/$this->session->userdata('currency_r');
    $SMaxPrice=$_GET['maxPrice']/$this->session->userdata('currency_r');
  }

?>

<input type="hidden" value="<?php echo intval($PriceMaxMin->row()->MaxPrice); ?>" id="GMaxPrice" />
<input type="hidden" value="<?php echo intval($MinPrice); ?>" id="GMinPrice" />

<input type="hidden" value="<?php echo intval($SMaxPrice); ?>" id="SMaxPrice" />
<input type="hidden" value="<?php echo intval($SMinPrice); ?>" id="SMinPrice" />

<?php }else{?>
<input type="hidden" value="50000" id="GMaxPrice" />
<input type="hidden" value="0" id="GMinPrice" />

<input type="hidden" value="50000" id="SMaxPrice" />
<input type="hidden" value="0" id="SMinPrice" />

<?php } ?>
<input type="hidden" value="<?php echo $currencySymbol; ?>" id="currencysym" />
<input type="hidden" value="<?php echo $this->session->userdata('currency_r'); ?>" id="currencyrate" />

<!--<script type="text/javascript" src="js/site/list_page.js"></script>
 show View more-->

<script type="text/javascript" src="js/site/downloadxml.js"></script>
 
<style type="text/css">
html, body { height: 100%; } 
</style>
<script type="text/javascript"> 
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
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });
  
  google.maps.event.addListener(map, 'idle', function(event) {
  
    //alert('asdasd'); return false;
    //updMap(0);
    
  });
  

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
        });
        // Switch icon on marker mouseover and mouseout
        google.maps.event.addListener(marker, "mouseover", function() {
          marker.setIcon(gicons["yellow"]);
        });
        google.maps.event.addListener(marker, "mouseout", function() {
          marker.setIcon(gicons["blue"]);
        });
    gmarkers.push(marker);
    // add a line to the side_bar html
    var marker_num = gmarkers.length-1;
   //side_bar_html='<div class="map-areas"><ul class="similar-listing">'+side_bar_html;
   //side_bar_html=side_bar_html+'</ul></div>';
    side_bar_html += '<div onmouseover="gmarkers['+marker_num+'].setIcon(gicons.yellow)" onmouseout="gmarkers['+marker_num+'].setIcon(gicons.blue)">'+details+'</div>';
}

function initializeMap(){
// create the map

  var myOptions = {
  scrollwheel: false,
    zoom: <?php if($map_zoom !=''){ echo $map_zoom; } else echo "9"; ?>,
   zoomControl:true,
zoomControlOptions: {
  style:google.maps.ZoomControlStyle.SMALL
},
    center: new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $long; ?>),
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
 
  google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
        });
 
      downloadUrl();
    
    
}
 
 
// This function picks up the click and opens the corresponding info window
function myclick(i) {
  google.maps.event.trigger(gmarkers[i], "click");
}


 
 
function downloadUrl() {  

    //var xmlDoc = xmlParse(doc);
        //var xml = doc.responseXML;
    //var markers = xml.documentElement.getElementsByTagName("marker");
    var totalResults= '<?php echo count($productList->result()); ?>';
    
    if(totalResults > 0) {
    
    $("#side_bar").html("<img id='validationEr1r' align='middle' style='margin-left:200px; margin-top:20px;' src='images/ajax-loader.gif' />");
    <?php 
    
    if(count($productList->result()) > 0){$hoverlist='1';
      foreach($productList->result() as $Row_Rental){
        
        if($Row_Rental->userid!='' && $Row_Rental->userid!='0' ){
          $useId=base_url().'users/show/'.$Row_Rental->userid;
        }else{
          $useId='javascript:void(0);';
        }
        
        if($Row_Rental->userphoto!='' && $Row_Rental->userphoto!='0' ){
          $useImg=base_url().'images/users/'.$Row_Rental->userphoto;
        }else{
          $useImg=base_url().'images/users/user_thumb.png';
        }
      
      ?>
      
      var lat ='<?php echo $Row_Rental->latitude; ?>'; 
      var lng ='<?php echo $Row_Rental->longitude; ?>';
         
          var point = new google.maps.LatLng(lat,lng);
         // var html = markers[i].getAttribute("html");
      var html = '<div class="infoBox similar-listing" ><li><div class="img-top"><div class="figures-cobnt"><img src="<?php if($Row_Rental->product_image !=''){echo PRODUCTPATH.$Row_Rental->product_image;}else {echo PRODUCTPATH.'dummyProductImage.jpg';}  ?>"></div><div class="posi-abs"><a class="heart" href="rental/<?php echo $Row_Rental->id; ?>"></a><label class="pric-tag"><span class="rm-rate"><?php echo $currencySymbol; ?></span><?php echo $Row_Rental->price * $this->session->userdata('currency_r'); ?></label><a class="aurtors" href="<?php echo $useId; ?>"><img style="border-radius: 50%;height: 70px;width: 100px;" src="<?php echo $useImg; ?>"></a></div></div><div class="img-bottom"><span class="headlined"><a  href="rental/<?php echo $Row_Rental->id; ?>"><?php echo addslashes($Row_Rental->product_title); ?></a></span><p class="describ"><?phpif($Row_Rental->room_type > 0 ){
     $condition=array('id'=>$Row_Rental->room_type);
	  $listspace_values = $this->product_model->get_all_details(LISTSPACE_VALUES, $condition);
	  echo ucfirst($listspace_values->row()->list_value);
	  } else { 
	 echo ucfirst($Row_Rental->room_type); 
	 } ?>- <?php echo ucfirst($Row_Rental->city_name); ?></p></div></li></div>';
    
    var details='<li data-price="<?php echo $Row_Rental->price * $this->session->userdata('currency_r'); ?>"><div class="img-top">';
	<?php if($loginCheck==''){?>
	var details1='<a class="ajax cboxElement heart reg-popup1" href="site/rentals/AddWishListForm/<?php echo $Row_Rental->id;?>"></a>';
	<?php }else{ ?>
	var details1='<a class="ajax cboxElement heart" href="site/rentals/AddWishListForm/<?php echo $Row_Rental->id;?>"></a>';
	<?php } ?>
	
	var details2='<div class="figures-cobnt"><a href="rental/<?php echo $Row_Rental->id;?>"><img src="<?php if($Row_Rental->product_image !=''){echo PRODUCTPATH.$Row_Rental->product_image;}else {echo PRODUCTPATH.'dummyProductImage.jpg';} ?>"></a></div><div class="posi-abs"><label class="pric-tag"><span class="curSymbol"><?php echo $currencySymbol; ?></span><?php echo $Row_Rental->price * $this->session->userdata('currency_r'); ?></label><a class="aurtors" href="<?php echo $useId; ?>"><img style="border-radius: 50%;height: 70px;width: 100px;" src="<?php echo $useImg; ?>"></a></div></div><div class="img-bottom"><span class="headlined"><a  href="rental/<?php echo $Row_Rental->id; ?>"><?php echo addslashes($Row_Rental->product_title); ?></a></span><p class="describ"><?php if($Row_Rental->room_type > 0 ){
     $condition=array('id'=>$Row_Rental->room_type);
	  $listspace_values = $this->product_model->get_all_details(LISTSPACE_VALUES, $condition);
	  echo ucfirst($listspace_values->row()->list_value);
	  } else { 
	 echo ucfirst($Row_Rental->room_type); 
	 }?>- <?php echo ucfirst($Row_Rental->city_name); ?></p></div></li>';
    
      var label ='<?php echo trim(addslashes($Row_Rental->product_title));?>';
          // create the marker
          var marker = createMarker(point,label,html,"blue",details+details1+details2,'<?php echo $Row_Rental->id; ?>');
      <?php $hoverlist=$hoverlist+1;}
    } ?>
        
        // put the assembled side_bar_html contents into the side_bar div
        side_bar_html='<div class="map-areas"><ul class="similar-listing">'+side_bar_html;
        side_bar_html=side_bar_html+'</ul></div>';
        document.getElementById("side_bar").innerHTML = side_bar_html;
    
    }else{
    $("#side_bar").html("No rentals found..");
    }
} 
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
<!-- slidebox styling via external css -->
<link rel="stylesheet" href="css/site/<?php echo SITE_COMMON_DEFINE ?>jquery.mSimpleSlidebox.css">
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>jquery.mSimpleSlidebox.js"></script>
<!-- slidebox function call -->
<script type="text/javascript">
$(document).ready(function(){
  $(".mSlidebox").mSlidebox({
    autoPlayTime:4000,
    controlsPosition:{
      buttonsPosition:"outside"
    }
  });
  $("#mSlidebox_3").mSlidebox({
    easeType:"easeInOutCirc",
    numberedThumbnails:true,
    pauseOnHover:false
  });
});
</script>

  <script>
  $(function() {
    $( "#datepicker" ).datepicker({
	
	minDate: 0,
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#datepicker1" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#datepicker1" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#datepicker" ).datepicker( "option", "maxDate", selectedDate );
		var fromDate = $("#datepicker").val();
		if(fromDate ==''){
		$("#datepicker").val(selectedDate);
		
		}
		searchAjax();
      }
    });
  });
  </script>
  
<!--  <script type="text/javascript">
//$.getScript("<?php echo base_url();?>js/site/bootstrap-datepicker.js", function(){

var startDate = '<?php echo date('m/d/Y');?>';
var FromEndDate = new Date();
var ToEndDate = new Date();

ToEndDate.setDate(ToEndDate.getDate()+365);

$('#datepicker').datepicker({
    
    weekStart: 1,
    startDate: '<?php echo date('m/d/Y');?>',
    //endDate: FromEndDate, 
    autoclose: true
})
    .on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#datepicker1').datepicker('setStartDate', startDate);
    }); 
$('#datepicker1').datepicker({
        
        weekStart: 1,
        startDate: startDate,
        endDate: ToEndDate,
        autoclose: true
    })
    .on('changeDate', function(selected)
	{
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('#datepicker').datepicker('setEndDate', FromEndDate);
    }); 
});
</script>-->
  
  
<div class="map-search">
<div>
  <div class="sidebar">
    <div class="filters filters-collapse">
        <ul class="filter-list unstyled">
 <form class="form-horizontal trip-form" action="property?city=<?php echo str_replace("+", " ", $address) ?>" method="POST" >

    <li data-tooltip-position="left" rel="tooltip" class="intro-filter clearfix" title="Trip">

      <h6 class="span2 filter-label"><?php if($this->lang->line('dates') != '') { echo stripslashes($this->lang->line('dates')); } else echo "Dates";?></h6>


          <div class="control-group">
            <input type="text" placeholder="<?php if($this->lang->line('check_in') != '') { echo stripslashes($this->lang->line('check_in')); } else echo "Check in";?>" value="<?php echo $_POST['checkin']; ?>" id="datepicker" name="checkin">
			
             <input type="hidden" name="pricemin"  value="<?php echo $pricemin; ?>" id="minPrice" /><input  name="pricemax" type="hidden" value="<?php echo $pricemax; ?>" id="maxPrice" />

            <input type="text" placeholder="<?php if($this->lang->line('check_out') != '') { echo stripslashes($this->lang->line('check_out')); } else echo "Check out";?>"  id="datepicker1" value="<?php echo $_POST['checkout']; ?>" name="checkout">
			
<select data-prefill="" class="guest-select input-medium" name="guests" id="guests" onchange = "searchAjax()">
<option value = "0"><?php if($this->lang->line('select') != '') { echo stripslashes($this->lang->line('select')); } else echo "Select";?></option>
<?php foreach($accommodates as $accommodate) {
if($accommodate==1){
?>
<option value="<?php echo $accommodate;?>" <?php if($_POST['guests']==$accommodate){?>selected="selected"<?php }?>><?php echo $accommodate.' Guest'?></option>
<?php } else {?>
<option value="<?php echo $accommodate;?>" <?php if($_POST['guests']==$accommodate){?>selected="selected"<?php }?>>
<?php echo $accommodate.' Guests';?></option>
<?php }?>
<?php }?>
						 
						 


            </select>
          </div>
       

    </li>
	<?php //print_r($_POST['property_type']); ?>
    <?php $propertyTypes = $this->product_model->get_all_details(LISTSPACE_VALUES,array('listspace_id'=>9), array(array('field'=>'other', 'type'=>'asc'))); 
	$roomType = $this->product_model->get_all_details(LISTSPACE_VALUES,array('listspace_id'=>10), array(array('field'=>'other', 'type'=>'asc')));
	//echo '<pre>';print_r($propertyTypes->result_array());
	?>

			
			
	
    <?php //print_r($_POST['room_type']); ?>
    <li data-tooltip-position="left" rel="tooltip" class="clearfix room-type-group intro-filter showlist5" title="Room Type" onchange = "searchAjax()">
    
      <h6 class="span2 filter-label linedpads2"><?php if($this->lang->line('room_type') != '') { echo stripslashes($this->lang->line('room_type')); } else echo "Room Types";?> <a href="javascript:void(0);" style="background-position: -121px -123px;width:20px;height:20px;background-image: url('./img/glyphicons-halflings.png');" class="icon icon-question-sign" title="
Entire Place
Listings where you have the whole place to yourself.
		
Private Room
Listings where you have your own room but share some common spaces.

Shared Room
Listings where you'll share your room or your room may be a common space."></a></h6>
     <!-- <div for="home" data-name="Entire home/apt" class="filter-primary-item span2">
      <input type="checkbox"  name="room_type[]" value="Entire home/apt" class='room_type' <?php $check_roome_type = explode(',',$_POST['room_type']); foreach( $check_roome_type as $room){ if($room =='Entire home/apt') echo 'checked="checked"'; }?> />
        <i class="icon icon-entire-place"></i>
        <h5><?php if($this->lang->line('entire_place') != '') { echo stripslashes($this->lang->line('entire_place')); } else echo "Entire Place";?></h5>
      </div>

      <div for="private" data-name="Private room" class="filter-primary-item span2">
      <input type="checkbox"  name="room_type[]" value="private room" class='room_type' <?php $check_roome_type = explode(',',$_POST['room_type']); foreach( $check_roome_type as $room){ if($room =='private room') echo 'checked="checked"';} ?> />
        <i class="icon-private-room"></i>
        <h5><?php if($this->lang->line('private_room') != '') { echo stripslashes($this->lang->line('private_room')); } else echo "Private Room";?></h5>
      </div>

      <div for="shared" data-name="Shared room" class="filter-primary-item span2">
      <input type="checkbox"  name="room_type[]" value="Shared room" class='room_type' <?php $check_roome_type = explode(',',$_POST['room_type']); foreach( $check_roome_type as $room){ if($room == 'Shared room') echo 'checked="checked"';} ?>/>
        <i class="icon-shared-room"></i>
        <h5><?php if($this->lang->line('shared_room') != '') { echo stripslashes($this->lang->line('shared_room')); } else echo "Shared Room";?></h5>
      </div> -->
      	  				<div class="right-arel onclk-hide">

      <?php
				$room_count=0;
				$check_roome_type = $room_type;
				foreach($roomType->result() as $room_data)
				{
				if($room_count < 3 ){?>
					<label>
						<input type="checkbox" name="room_type[]" class='room_type'  value="<?php echo trim($room_data->list_value);?>" <?php foreach($check_roome_type as $property_type) { if( trim($property_type) == trim($room_data->list_value) ){ ?> checked="checked" <?php } } ?>/>
						<span><?php echo $room_data->list_value;?></span>
					</label>
				<?php if($room_count == 2){?></div><?php }?>
				<?php } else { ?>
				<?php if($room_count == 3){ ?><div class="drop4btn"><i class="caret"></i></div>
				<div class="right-arel"><?php }?>
					<label>
						<input type="checkbox" name="room_type[]"  value="<?php echo trim($room_data->list_value);?>" <?php foreach($check_roome_type as $property_type) { if( trim($property_type) == trim($room_data->list_value)){ ?> checked="checked" <?php } } ?>/>
						<span><?php echo $room_data->list_value;?></span>
					</label>
				<?php } $room_count++;} 
				if($room_count > 3) {
				?>
				</div>
				<?php } ?>

      
    </li>

    <li data-tooltip-position="left" rel="tooltip" class="clearfix intro-filter pricefil" title="Price">
      <h6 class="span2 filter-label linedpad3"><?php if($this->lang->line('price_range') != '') { echo stripslashes($this->lang->line('price_range')); } else echo "Price Range";?></h6>
    <!--<div class="price_slider">
              <div class="price_text"><input type="text" id="price" value="100"  class="rating_input" /></div>
              <div class="rating_slider">
               
                  <div id="slider-price"></div>
                
              </div>
        </div>-->
    <div class="price_slider">
      <div id="slider-range"></div></div>
      <input type="text" value="<?php echo $currencySymbol.$SMinPrice;?>" style="color: rgb(94, 85, 90); text-align:right; font-weight: normal; font-family: OpenSansSemibold; background:none; border: medium none; box-shadow: none; margin: -11px 0px 0px 0px;position: relative;top: 20px;width: 34%;  text-align: left;" id="amount_pricefilter1" readonly>
      <input type="text" value="<?php echo $currencySymbol.$SMaxPrice;?>" style="color: rgb(94, 85, 90); text-align:right; font-weight: normal; font-family: OpenSansSemibold; border: medium none; box-shadow: none; margin: -11px 0px 0px 0px;position: relative;top: 20px;width: 34%; background:none;" id="amount_pricefilter2" readonly>
     
    </li>
  
	<div class="filter-reald">
		<a href="javascript:showView1('5');" class="filter-btn" style="margin:10px 0 0 20px;"><?php if($this->lang->line('more_filters') != '') { echo stripslashes($this->lang->line('more_filters')); } else echo "More Filters";?><i class="fa fa-plus"></i></a>
		<a href="javascript:showView('6');" class="filter-btn" style="margin:10px 0 0 20px;"><?php if($this->lang->line('more_filters') != '') { echo stripslashes($this->lang->line('more_filters')); } else echo "More Filters";?> <i class="fa fa-plus fa-minus"></i></a>
    </div>
		<li title="" data-tooltip-position="left" rel="tooltip" class="clearfix showlist5" >
				<h6 class="span2 filter-label  left-widt"><?php if($this->lang->line('property_type') != '') { echo stripslashes($this->lang->line('property_type')); } else echo "Property Type";?></h6>
				<div class="right-arel onclk-hide">
				<?php
				$i=0;
				$check_property_type = $property_type_checked;
				foreach($propertyTypes->result() as $tmp)
				{
				if($i < 3 ){?>
					<label>
						<input type="checkbox" name="property_type[]" class='property_type' value="<?php echo trim($tmp->list_value);?>" <?php foreach($check_property_type as $property_type) { if($property_type == trim($tmp->list_value)){ ?> checked="checked" <?php } } ?>/>
						<span><?php echo $tmp->list_value;?></span>
					</label>
				<?php if($i == 2){?></div><?php }?>
				<?php } else {?>
				<?php if($i == 3){?><div class="drop4btn"><i class="caret"></i></div>
				<div class="right-arel"><?php }?>
					<label>
						<input type="checkbox" name="property_type[]" class='property_type'  value="<?php echo trim($tmp->list_value);?>" <?php foreach($check_property_type as $property_type) { if($property_type == trim($tmp->list_value)){ ?> checked="checked" <?php } } ?>/>
						<span><?php echo $tmp->list_value;?></span>
					</label>
			<?php } $i++;} 
			if($i > 3) {
			?>
			</div>
			<?php } ?>
	</li>
	<!---Size Values Starts
		<li title="Size" data-tooltip-position="left" rel="tooltip" class="clearfix showlist5">
			<h6 class="span2 filter-label linedpads4"><?php if($this->lang->line('size') != '') { echo stripslashes($this->lang->line('size')); } else echo "Size";?></h6>
			<div class="control-group span6">
					<div class="row">

					<select name="min_bedrooms" class="span2">
						<option value="" <?php if($_POST['min_bedrooms']==''){echo 'selected="selected"';} ?>>
							<?php if($this->lang->line('bedrooms') != '') { echo stripslashes($this->lang->line('bedrooms')); } else echo "Bedrooms";?>
						</option>
						<?php 
						if($bedrooms!=""){ 
							$bedroomsArr=@explode(',',$bedrooms);
							foreach($bedroomsArr as $row){
						?>
							<option value="<?php echo $row; ?>" <?php if($_POST['min_bedrooms']==$row){echo 'selected="selected"';} ?>>
								<?php echo $row; ?> <?php if($this->lang->line('bedrooms') != '') { echo stripslashes($this->lang->line('bedrooms')); } else echo "Bedrooms";?>
							</option>
						<?php 
							}
						} 
						?>
					</select>

					<select name="min_bathrooms"  class="span2">
						<option value="" <?php if($_POST['min_bathrooms']==''){echo 'selected="selected"';} ?>>
							<?php if($this->lang->line('bathrooms') != '') { echo stripslashes($this->lang->line('bathrooms')); } else echo "Bathrooms";?>
						</option>
						<?php 
						if($bathrooms!=""){ 
							$bathroomsArr=@explode(',',$bathrooms);
							foreach($bathroomsArr as $row){
						?>
							<option value="<?php echo $row; ?>" <?php if($_POST['min_bathrooms']==$row){echo 'selected="selected"';} ?>>
								<?php echo $row; ?>
							</option>
						<?php 
							}
						} 
						?>
					</select>

					<select name="min_beds" class="span2">
						<option value="" <?php if($_POST['min_beds']==''){echo 'selected="selected"';} ?>>
							<?php if($this->lang->line('beds') != '') { echo stripslashes($this->lang->line('beds')); } else echo "Beds";?>
						</option>
						<?php 
						if($beds!=""){ 
							$bedsArr=@explode(',',$beds);
							foreach($bedsArr as $row){
						?>
							<option value="<?php echo $row; ?>" <?php if($_POST['min_beds']==$row){echo 'selected="selected"';} ?>>
								<?php echo $row; ?> <?php if($this->lang->line('beds') != '') { echo stripslashes($this->lang->line('beds')); } else echo "Beds";?>
							</option>
						<?php 
							}
						} 
						?>
				  </select>
				  
				  <select name="min_bedtype"  class="span2">
						<option value="" <?php if($_POST['min_bedtype']==''){echo 'selected="selected"';} ?>>
							<?php if($this->lang->line('bedtype') != '') { echo stripslashes($this->lang->line('bedtype')); } else echo "Bed Type";?>
						</option>
						<?php 
						if($bedtype!=""){ 
							$bedtypeArr=@explode(',',$bedtype);
							foreach($bedtypeArr as $row){
						?>
							<option value="<?php echo $row; ?>" <?php if($_POST['min_bedtype']==$row){echo 'selected="selected"';} ?>>
								<?php echo $row; ?>
							</option>
						<?php 
							}
						} 
						?>
				  </select>
				  
				  <select name="min_noofbathrooms"  class="span2">
						<option value="" <?php if($_POST['min_noofbathrooms']==''){echo 'selected="selected"';} ?>>
							<?php if($this->lang->line('noofbathrooms') != '') { echo stripslashes($this->lang->line('noofbathrooms')); } else echo "Number of Bathroom";?>
						</option>
						<?php 
						if($noofbathrooms!=""){ 
							$noofbathroomsArr=@explode(',',$noofbathrooms);
							foreach($noofbathroomsArr as $row){
						?>
							<option value="<?php echo $row; ?>" <?php if($_POST['min_noofbathrooms']==$row){echo 'selected="selected"';} ?>>
								<?php echo $row; ?>
							</option>
						<?php 
							}
						} 
						?>
				  </select>
				  
				  <select name="min_min_stay"  class="span2">
						<option value="" <?php if($_POST['min_min_stay']==''){echo 'selected="selected"';} ?>>
							<?php if($this->lang->line('min_stay') != '') { echo stripslashes($this->lang->line('min_stay')); } else echo "Minimum Stay";?>
						</option>
						<?php 
						if($min_stay!=""){ 
							$min_stayArr=@explode(',',$min_stay);
							foreach($min_stayArr as $row){
						?>
							<option value="<?php echo $row; ?>" <?php if($_POST['min_min_stay']==$row){echo 'selected="selected"';} ?>>
								<?php echo $row; ?>
							</option>
						<?php 
							}
						} 
						?>
				  </select>

				</div>
			</div>
		</li>
	<!---Size Values Ends
	<!---List Values Starts-->
		<?php
		$list_value_loop=1;
//echo "<pre>"; print_r($listvalue_checked);
		foreach($main_cat as $category) {
			$sec_categ_loop_count=count($sec_category[$category->id]);
			if($sec_categ_loop_count!=0 && $category->id != 12){
			//$chek_list_value = explode(',',$_POST['listvalue']);
			 
		?>
			<li title="<?php echo $category->attribute_name;?>" data-tooltip-position="left" rel="tooltip" class="clearfix showlist5">
				<h6 class="span2 filter-label  left-widt"><?php echo $category->attribute_name;?></h6>
				<?php
				for($i=0;$i<3;$i++){
					if($i==0){
					echo '<div class="right-arel onclk-hide">';
					}
				if($sec_category[$category->id][$i]['list_value'] != '') {
				?>
				<label>
					<input type="checkbox" name="listvalue[]" class='list_value'  value="<?php echo $sec_category[$category->id][$i]['id'];?>" <?php foreach( $listvalue_checked as $listId) { if($listId ==$sec_category[$category->id][$i]['id']){ ?> checked="checked" <?php } } ?> />
					<span> <?php echo $sec_category[$category->id][$i]['list_value'];?></span>
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
					<input type="checkbox" name="listvalue[]" class='list_value'  value="<?php echo $sec_category[$category->id][$j]['id'];?>" <?php foreach($listvalue_checked as $listid) { if($listid ==$sec_category[$category->id][$j]['id']){ echo 'checked="checked"'; } } ?> />
					<span> <?php echo $sec_category[$category->id][$j]['list_value'];?></span>
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

      <div class="showlisting clearfix showlist5">
        <a class="show-btn23"><input style="width: 100%; background: none repeat scroll 0 0 rgba(0, 0, 0, 0); border: medium none; box-shadow: none; color: #fff; font-family: opensanssemibold; font-size: 17px; padding: 0;" type="submit" value="<?php if($this->lang->line('show_listing') != '') { echo stripslashes($this->lang->line('show_listing')); } else echo "Show Listing";?>" /></a>
      </div>
     </form>

  </ul>

     
    </div>
     

      
   <div class="sidebar-header-placeholder"></div>
    <?php echo $newpaginationLink; ?>
    <div class="search-results">
<div class="listings-loading clearfix">
      <div id="side_bar">
      </div>
 </div>
      
    </div>
  </div>

  <div class="map" id="map-div" >
   <div id="map_canvas" style="width: 100%; height: 100%;"></div>
  </div>
  

</div>
<?php if(isset($PriceMaxMin)){ ?><input type="hidden" id="min_price_start" value="<?php echo $PriceMaxMin->row()->MinPrice*$this->session->userdata('currency_r');?>"><?php } ?>
<input type="hidden" id="GetCity" value="<?php echo str_replace(' ','+',$address); ?>"  />

<style>
.filter-primary-item input[type="checkbox"] {
    display: none;
}

input[type="checkbox"]:checked + i {
    border: 1px solid red;
}
</style>
<script type="text/javascript">
jQuery.fn.extend({
 propAttr: $.fn.prop || $.fn.attr
});
$(function() { 
$( "#datepicker" ).datepicker({
defaultDate: "+1w",
changeMonth: true,
numberOfMonths: 1,
minDate:0,
onClose: function( selectedDate ) {
  if($( "#datepicker1" ).val()==''){
    $( "#datepicker1" ).datepicker( "option", "maxDate", selectedDate ).focus();
  }else{
    $( "#datepicker1" ).datepicker( "option", "maxDate", selectedDate );
  }
}
});
$( "#datepicker1" ).datepicker({
defaultDate: "+1w",
changeMonth: true,
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

});

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
$(function() {var min_price_start = $("#min_price_start").val() * 1;
    var options = {
        range: true,
        min: min_price_start,
        max: '<?php echo $PriceMaxMin->row()->MaxPrice*$this->session->userdata('currency_r');?>',
        values: [0, '<?php echo $PriceMaxMin->row()->MaxPrice*$this->session->userdata('currency_r');?>'],
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

    $("#amount").val("<?php echo $this->session->userdata('currency_s');?>" + min + " - <?php echo $this->session->userdata('currency_s');?>" + max);

    showProducts(min, max);
	
	$('#autocomplete').val('<?php echo $address;?>');
  
});
<?php }?>
</script>
<script>
//gangatahran

function showProducts(minPrice, maxPrice) {
    $(".similar-listing li").hide().filter(function() {
        var price = parseInt($(this).data("price"), 10);
        return price >= minPrice && price <= maxPrice;
    }).show();
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
  .ui-icon-circle-triangle-w {
  
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

.gm-style img { max-width: none; }
.gm-style label { width: auto; display: inline; }

.guest-select.input-medium{
	height: 34px;
	padding: 5px 9px;
	margin-top:0px;
}


</style>

<?php 
//$this->load->view('site/templates/footer');
?>
</section>