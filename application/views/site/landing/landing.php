<?php $this->load->view('site/templates/header'); ?>

<style>
table.table-condensed {
    background-color: transparent;
    max-width: 100%;
    float: left;
    width: 100%;
}

table.table-condensed td {
	border-top:1px solid #ccc; 
	border-right: 1px solid #ccc;
}

div.datepicker.datepicker-dropdown.dropdown-menu {
	padding: 0
}

.datepicker-days {
	height: 227px;
}
.datepicker.datepicker-dropdown.dropdown-menu {
    min-height: 179px;
    overflow: hidden !important;
    padding: 4px 0 0 8px;
    width: 220px !important;
    border-radius: 0;
}

.datepicker th{font-weight: normal; color: #aaa;}
.datepicker td, .datepicker th{width: 30px; height: 30px;}
.datepicker.datepicker-dropdown.dropdown-menu{min-height: 225px;}
.datepicker tr:first-child th{height: 20px;}
.datepicker td, .datepicker th {
    height: 30px !important;
    width: 33px !important;
}

div.datepicker thead tr:first-child th, div.datepicker tfoot tr:first-child th {
    border-radius: 0;
    cursor: pointer;
    height: 24px !important;
}

.table-condensed > thead > tr > th, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > tbody > tr > td, .table-condensed > tfoot > tr > td {
    padding: 8.3px 5px !important;
}

@media screen (max-width: 567px){
	.datepicker.datepicker-dropdown.dropdown-menu {
		min-height: 200px;
		overflow: hidden !important;
		padding: 4px 0 0 8px;
		width: 226px !important;
		left: 25% !important;
		right: 25% !important;
	}
}

@media screen (max-width: 375px){
	.datepicker.datepicker-dropdown.dropdown-menu {
		left: auto !important;

		right: 10px !important;
	}
}

header {
    position: absolute;
    z-index: 999;
}
header {
    position: absolute;
    z-index: 9999 !important;
}

.header {
    padding: 7px 0 0 !important;
    transition-duration: 0.3s;
    z-index: 999;
	background:none;
	position: relative;
	 border: none;
}

.navbar .nav > li > a{	
	color: #fff;
}

.browse{
	color: #fff;
}

.caret{
	border-top: 4px solid #fff;
}

.text-center{
	z-index: 99;
}

.logo a img {
    float: left;
    /* margin: -21px 6px 0 0; */
    width: 100%;
}

.brows-loop{
	margin: 0 0 0 100px;
}

.user-name{
	 color: #fff;
}

</style>
<link rel="stylesheet" href="css/site/datepicker.css" type="text/css">
<script type="text/javascript">
	var tag = document.createElement('script');
	tag.src = "//www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	var player;
	function onYouTubeIframeAPIReady() {
		player = new YT.Player('ytplayer', {
			events: {
				'onReady': onPlayerReady
			}
		});
	}
	function onPlayerReady() {
		player.playVideo();
		// Mute!
		player.mute();
	}
</script>
<script type="text/javascript">
$.getScript("<?php echo base_url();?>js/site/bootstrap-datepicker.js", function(){
	var startDate = '<?php echo date('m/d/Y');?>';
	var FromEndDate = new Date();
	var ToEndDate = new Date();
	ToEndDate.setDate(ToEndDate.getDate()+730);
	$('.from_date').datepicker({
		weekStart: 0,
		startDate: '<?php echo date('m/d/Y');?>',
		autoclose: true
	}).on('changeDate', function(selected){
		startDate = new Date(selected.date.valueOf());
		startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())) + 1);
		
		$('.to_date').datepicker('setStartDate', startDate);
	}); 
	
	$('.to_date').datepicker({
		weekStart: 0,
		startDate: startDate,
		endDate: ToEndDate,
		autoclose: true
	}).on('changeDate', function(selected){
		FromEndDate = new Date(selected.date.valueOf());
		FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())) + 1);
		
		$('.from_date').datepicker('setEndDate', FromEndDate);
	});
});
</script>

<section>
	<div class="banner-container">
		<div class="banner-container-bg"></div>
		<div class="row">
			<div class="col-md-12">
			<?php if($adminList->slider == "on") {?>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<ul class="carousel-inner">
						<?php $slider_loop=1;
						foreach ($sliderList->result() as $Slider)
						{ 
							if($Slider->image !='')
							{
								$ImgSrc=$Slider->image;
							}else{
								$ImgSrc='dummyProductImage.jpg';
							} ?>
							<li class="item <?php if($slider_loop==1){ $slider_loop=2;?>active<?php }?>">
								<a href="<?php echo $Slider->slider_link;?>"><img src="images/slider/thumb/<?php echo $ImgSrc;?>" alt="<?php echo $Slider->slider_title; ?>"></a>
							</li>
						<?php }?> 
					</ul>
				</div>
				<?php } else { ?>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<ul class="carousel-inner">
						<li class="item active" style="height: 600px;">
							<section class="content-section video-section" style="position: relative; height: 600px;">
								<div class="pattern-overlay">
									<iframe width="100%" height="130%" id="ytplayer" type="text/html" src="<?php echo $adminList->videoUrl;?>?playlist=DjxwLr6TjHs&start=60&rel=0&autoplay=1&controls=0&showinfo=0&loop=1&iv_load_policy=3&enablejsapi=1" frameborder="0" allowfullscreen></iframe>
								</div>
							</section>
						</li>
					</ul>
				</div>
				<?php }?>
				<div class="main-text hidden-xs">
					<div class="col-md-12 text-center">
						<div class="container">
							<h1><?php if($adminList->home_title_1 != ''){
								echo $adminList->home_title_1;
							}else{
								if($this->lang->line('WELCOMEHOME') != '') { echo stripslashes($this->lang->line('WELCOMEHOME')); } else echo "Host your next party";
							} ?></h1>
							<h3><?php if($adminList->home_title_2 != ''){
								echo $adminList->home_title_2;
							}else{
								if($this->lang->line('Rentuniqueplacestostay') != '') { echo stripslashes($this->lang->line('Rentuniqueplacestostay')); } else echo "Find a perfect venue. Get artist entertainers";
							} ?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="push"></div>
</section>

<section>
	<div class="relative-holder">
		<div class="searching-section">
			<div class="container">
				<!--This is for mobile view  doesnot disply in normal view only for mobil -->
				<!-- WILL DISPLAY ONLY ON MOBILE FOR RESPONSIVE STATIC START-->
				<div class="searct-sechs mobile-display ">
					<a class="mobile-selecbox" href="#success" data-toggle="modal">
						<input class="search-text" placeholder="Where..." type="text">
						<input class="sbt-btn" value="Submit" type="submit">
					</a>
					<!-- Modal -->
					<div class="modal fade banerpop" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header modal-header-success">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<form  class="mobilform" method="get" action="property" id="property_search_form_mobile" >
										<input name="city" id="autocompleteNewMoblie" class="where" placeholder="<?php if($this->lang->line('search_where') != '') { echo stripslashes($this->lang->line('search_where')); } else echo "Where"; ?>"  type="text"  >
										<input  name="datefrom" class="chek from_date" placeholder="<?php if($this->lang->line('check_in') != '') { echo stripslashes($this->lang->line('check_in')); } else echo "When"; ?>" type="text" contenteditable="false">
										<?php if($accommodates !='' && count($accommodates)){ ?>
										<select name="guests" class="home_select" id="guest">
											<!--<option value=""><?php if($this->lang->line('guest') != '') { echo stripslashes($this->lang->line('guest')); } else echo "Guest";?></option>-->
											<?php foreach($accommodates as $accommodate) {
												if($accommodate==1){?>
												<option value="<?php echo $accommodate;?>"><?php echo $accommodate.' Guest'?></option>
												<?php } else { ?>
												<option value="<?php echo $accommodate;?>">
												<?php echo $accommodate.' Guests';?></option>
												<?php } }?>
										</select>
										<?php } ?>
										<input class="fom-subm" id="fom-subm" value="<?php if($this->lang->line('Submit') != '') { echo stripslashes($this->lang->line('Submit')); } else echo "Search"; ?>" type="submit" >
									</form>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				</div>
				<!-- WILL DISPLAY ONLY ON MOBILE FOR RESPONSIVE END-->
				<!--This is for mobile view  END -->
				<form  class="webform" method="get" action="property" id= "property_search_form">
					<input name="city" id="autocompleteNew1" class="where" placeholder="<?php if($this->lang->line('search_where') != '') { echo stripslashes($this->lang->line('search_where')); } else echo "Where"; ?>"  type="text"  >
					<input  name="datefrom" class="chek from_date" placeholder="<?php if($this->lang->line('check_in') != '') { echo stripslashes($this->lang->line('check_in')); } else echo "When"; ?>" id="check_in"type="text" contenteditable="false">
					<?php if($accommodates !='' && count($accommodates)){ ?>
					<select name="guests" class="home_select" id="guest">
						<!--<option value=""><?php if($this->lang->line('guest') != '') { echo stripslashes($this->lang->line('guest')); } else echo "Guest";?></option>-->
						<?php foreach($accommodates as $accommodate) {
							if($accommodate==1){?>
							<option value="<?php echo $accommodate;?>"><?php echo $accommodate.' Guest'?></option>
							<?php } else { ?>
							<option value="<?php echo $accommodate;?>">
							<?php echo $accommodate.' Guests';?></option>
						<?php } }?>
					</select>
					<?php } ?>
					<input class="fom-subm" id = "fom-subm" value="<?php if($this->lang->line('Submit') != '') { echo stripslashes($this->lang->line('Submit')); } else echo "Submit"; ?>" type="submit" >
				</form>
				<span id="city_warn"></span>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="center-page">
		<div class="container">
			<div class="top-title-structure">
				<h2 class="find-a-place">
				<?php if($adminList->home_title_3 != ''){
					echo $adminList->home_title_3;
				}else{
					if($this->lang->line('ExploretheWorld') != '') { echo stripslashes($this->lang->line('ExploretheWorld')); } else echo ""; } ?>
				</h2>
				<span class="discover-place">
				<?php if($adminList->home_title_4 != ''){
					echo $adminList->home_title_4;
				}else{
					if($this->lang->line('Seewherepeoplearetraveling') != '') { echo stripslashes($this->lang->line('Seewherepeoplearetraveling')); } else echo "Venue checked. Balloons tied"; } ?>
				</span>
			</div>
			<ul class="hme-container">
			<?php if($CityDetails->result() > 0){ 
				$i = 1;
				foreach($CityDetails->result() as $CityRows){
				$Cityname=str_replace(' ','+',$CityRows->name);?>
				<li class="col-md-<?php if ($i%10 == 1 || $i%10 == 7)echo "8"; else echo "4"; ?>">
					<a href="property?city=<?php echo $Cityname; ?>">
						<div class="image-container">
							<img src="images/city/<?php if ($i%10 == 1 || $i%10 == 7)echo 'thumb/';?><?php echo trim(stripslashes($CityRows->citythumb)); ?>">
						</div>
						<div class="overlay-text">
							<span><?php echo trim(ucfirst(stripslashes($CityRows->name))); ?></span>
						</div>
					</a>
				</li>
			<?php $i++; } }?>
			</ul>
		</div>
	</div>
</section>

<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#property_search_form").validate({
		// Specify the validation rules
		rules: {
			city: "required",
			agree: "required",
			datefrom: "required",
			dateto:"required",
			//guests:"required"
		},
		// Specify the validation error messages
		messages: {
			city: "",
			agree: "Please accept our policy",
			datefrom:'',
			dateto:'',
			//guests:''
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
	$("#property_search_form_mobile").validate({
		// Specify the validation rules
		rules: {
			city: "required",
			agree: "required",
			datefrom: "required",
			dateto:"required",
			//guests:"required"
		},
		// Specify the validation error messages
		messages: {
			city: '',
			agree: "Please accept our policy",
			datefrom:'',
			dateto:'',
			//guests:''
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
</script>
<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&signed_in=true"></script>-->
<!--<script type="text/javascript" src="js/markerwithlabel.js"></script>
<script type="text/javascript" src="js/markerwithlabel_packed.js"></script>-->
<script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};
function initializeMap() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocompleteNew1')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var data = $("#autocompleteNew1").serialize();
	//findLocationAuto(data);
	return false;
  });
}

function initializeMapMobile() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocompleteNewMoblie')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var data = $("#autocompleteNewMoblie").serialize();
	//findLocationAuto(data);
	return false;
  });
}





// [START region_fillform]
function fillInAddress() {

  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
}

function findLocation1(event)
{

	var x = event.which || event.keyCode;
	if(x == 13)window.location='<?php echo base_url()?>property?city='+$('#autocompleteNew1').val();
}

function findLocationAuto1(loc)
{
	window.location='<?php echo base_url()?>property?'+loc;
}
// [END region_geolocation]
</script>
<script>
function Form_Validation(){
var autocompletenew1=$("autocompleteNew1").val();
var check_in = $("#check_in").val();
var check_out = $("#check_out").val();
if(check_in==""){
$("#check_in").focus();
return false;
}
if(autocompletenew1==""){
$("autocompleteNew1").focus();
alert('Please enter the city name');
return false;
}
 if(check_out==""){
$("#check_out").focus();
return false;
}
}
</script>

<script type="text/javascript">
	$('document').ready(function(){
	$('.new_additional_list').click(function(){
	$('.new_list_loader_div').css('display', 'block');
	});
	$('.fom-subm').click(function () {
	    var autocompletenew1=$("#autocompleteNew1").val();
		if(autocompletenew1 == ""){
			$("#autocompleteNew1").focus();
			swal('Oops', 'Please enter the city name', 'error');
			return false;
		}
    });
	})

$(function(){
 
	$('#autocompleteNew12').keyup(function()
	{
		var yourInput = $(this).val();
		re = /[`~!@#$%^&*()_|+\-=?;:'".<>\{\}\[\]\\\/]/gi;
		var isSplChar = re.test(yourInput);
		if(isSplChar)
		{
			var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'".<>\{\}\[\]\\\/]/gi, '');
			$(this).val(no_spl_char);
		}
	});
 
});
</script>
<style>
.buttonBar{opacity:0};
.main-text {
    color: #fff;
    position: absolute;
    top: 60%;
    width: 99.667%;
}
.modal-backdrop.fade.in{z-index: 99}

.new_list_loader_div {
        position: absolute;
    z-index: 999;
    background: rgba(233, 233, 233, 0.68);
    width: 100%;
    height: 100%;
    text-align: center;
    bottom: 0px;
    top: 0px;
    left: 0px;
    right: 0px;
}
.new_list_loader_div img, .lod-icon img {
    width: 60px;
}
</style>


<!-------------------------datepicker-------------------------->

<style>

.datepicker table tr td.active:hover, .datepicker table tr td.active:hover:hover, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled:hover:hover, .datepicker table tr td.active:active, .datepicker table tr td.active:hover:active, .datepicker table tr td.active.disabled:active, .datepicker table tr td.active.disabled:hover:active, .datepicker table tr td.active.active, .datepicker table tr td.active.active:hover, .datepicker table tr td.active.disabled.active, .datepicker table tr td.active.disabled.active:hover, .datepicker table tr td.active.disabled, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled.disabled, .datepicker table tr td.active.disabled.disabled:hover, .datepicker table tr td.active[disabled], .datepicker table tr td.active[disabled]:hover, .datepicker table tr td.active.disabled[disabled], .datepicker table tr td.active.disabled[disabled]:hover {
    background-color: #ff5a5f;
    border-radius: 0;
}

table.table-condensed {
    background-color: transparent;
    max-width: 100%;
    float: left;
    width: 95%;
}
table.table-condensed td {
	border-top:1px solid #ccc; 
	border-right: 1px solid #ccc;
	  font-family: opensanssemibold;
}
div.datepicker.datepicker-dropdown.dropdown-menu {
   padding: 18px 0 0 15px;
}

.datepicker-days {
    height: 273px;
    overflow: hidden;
    width: 256px;
}

.table-condensed .prev {
    background-position:  6px 9px;
}

body .datepicker table tr td.old, .datepicker table tr td.new {
    color: #c9c9c9;
}

.datepicker thead tr:first-child th.next:hover{
    background: rgba(0, 0, 0, 0) url("images/nxts.png") no-repeat scroll 6px 9px;

}


.datepicker thead tr:first-child th.prev:hover{
    background: rgba(0, 0, 0, 0) url("images/pv.png") no-repeat scroll 6px 9px;
}
div.datepicker thead tr:first-child th.prev, div.datepicker tfoot tr:first-child th.next {
    background-color: inherit; visibility: visible !important;}

    div.datepicker thead tr:first-child th.prev:hover, div.datepicker tfoot tr:first-child th.next:hover {
    background-color: inherit;}


    div.datepicker thead tr:first-child th, div.datepicker tfoot tr:first-child th {
    background-color: inherit;}

.datepicker.datepicker-dropdown.dropdown-menu {
    border-radius: 0;
    min-height: 305px;
    overflow: hidden !important;
    padding: 4px 0 0 8px;
    width: 289px !important;
}
.datepicker th{font-weight: normal; color: #aaa;}
.datepicker td, .datepicker th{width: 30px; height: 30px;}
.datepicker tr:first-child th{height: 20px;}
.datepicker td, .datepicker th {
    height: 30px !important;
    width: 33px !important;
}
div.datepicker thead tr:first-child th, div.datepicker tfoot tr:first-child th {
    border-radius: 0;
    color: #000;
    cursor: pointer;
    font-size: 18px;
    height: 24px !important;
}
.table-condensed > thead > tr > th, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > tbody > tr > td, .table-condensed > tfoot > tr > td {
    padding: 9.3px 9px !important;
}
div.datepicker tbody{
    border-bottom: 1px solid #ccc;
    border-left: 2px solid #ccc;
}


.datepicker table tr td.active:hover, .datepicker table tr td.active:hover:hover, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled:hover:hover, .datepicker table tr td.active:active, .datepicker table tr td.active:hover:active, .datepicker table tr td.active.disabled:active, .datepicker table tr td.active.disabled:hover:active, .datepicker table tr td.active.active, .datepicker table tr td.active.active:hover, .datepicker table tr td.active.disabled.active, .datepicker table tr td.active.disabled.active:hover, .datepicker table tr td.active.disabled, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled.disabled, .datepicker table tr td.active.disabled.disabled:hover, .datepicker table tr td.active[disabled], .datepicker table tr td.active[disabled]:hover, .datepicker table tr td.active.disabled[disabled], .datepicker table tr td.active.disabled[disabled]:hover{
	background: #0196E7 !important;
}


		.datepicker table tr td span.active:hover,
		.datepicker table tr td span.active:hover:hover,
		.datepicker table tr td span.active.disabled:hover,
		.datepicker table tr td span.active.disabled:hover:hover,
		.datepicker table tr td span.active:active,
		.datepicker table tr td span.active:hover:active,
		.datepicker table tr td span.active.disabled:active, 
		.datepicker table tr td span.active.disabled:hover:active,
		.datepicker table tr td span.active.active,
		.datepicker table tr td span.active.active:hover,
		.datepicker table tr td span.active.disabled.active,
		.datepicker table tr td span.active.disabled.active:hover,
		.datepicker table tr td span.active.disabled,
		.datepicker table tr td span.active.disabled:hover, 
		.datepicker table tr td span.active.disabled.disabled,
		.datepicker table tr td span.active.disabled.disabled:hover,
		.datepicker table tr td span.active[disabled],
		.datepicker table tr td span.active[disabled]:hover, 
		.datepicker table tr td span.active.disabled[disabled],
		.datepicker table tr td span.active.disabled[disabled]:hover{
		background: #0196E7 !important;
		}



.datepicker table tr td span{border-radius: 0}
@media screen (max-width: 567px){
	.datepicker.datepicker-dropdown.dropdown-menu {
		min-height: 200px;
		overflow: hidden !important;
		padding: 4px 0 0 8px;
		width: 226px !important;
		left: 25% !important;
		right: 25% !important;
	}
}
@media screen (max-width: 375px){
	.datepicker.datepicker-dropdown.dropdown-menu {
		left: auto !important;

		right: 10px !important;
	}
}
header {
    position: absolute;
    z-index: 999;
}
.header {
    padding: 7px 0 0 !important;
    transition-duration: 0.3s;
    z-index: 999;
	background:none;
	position: relative;
	 border: none;
}
.navbar .nav > li > a{	
	color: #fff;
}
.browse{
	color: #fff;
}
.caret{
	border-top: 4px solid #fff;
}
.text-center{
	z-index: 99;
}
.logo a img {
    float: left;
    /* margin: -21px 6px 0 0; */
    width: 100%;
}
.brows-loop{
	margin: 0 0 0 100px;
}
.user-name{
	 color: #fff;
}

.datepicker.datepicker-dropdown.dropdown-menu .datepicker-days .table-condensed thead tr:first-child{background: #0196e7; color:#fff; }


.datepicker.datepicker-dropdown.dropdown-menu .datepicker-days .table-condensed thead tr:first-child th{color: #fff}

.table-condensed > thead > tr > th.prev{
	padding: 9px 9px !important;
}

.datepicker thead tr:first-child th:hover, .datepicker tfoot tr:first-child th:hover{background-color: #0196E7 !important;}

.datepicker thead th i {
    margin-top: 5px;
}

.table-condensed > thead > tr > th, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > tbody > tr > td, .table-condensed > tfoot > tr > td {
    padding: 9.3px 9px !important;
}

</style>



<?php 
$this->load->view('site/templates/content_above_footer');
$this->load->view('site/templates/footer');
?>