<!--<script type="text/javascript" src="js/site/jquery-1.9.1.min.js"></script>-->

<script src="js/validation.js" type="text/javascript"></script>
<script type="text/javascript">
		var baseURL = '<?php echo base_url();?>';
		var BaseURL = '<?php echo base_url();?>';
</script>
<style type="text/css">
.intro{
display:none !important;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$("#broswe_box4").click(function() {
		
		if($('#broswe_box_li').css('display')=='block'){
			$("#broswe_box_li").hide();
			$("#broswe_box_li").addClass("intro");
			$("#broswe_box4").toggleClass("broswe_selected");
		}else{
			$("#broswe_box_li").show();
			$("#broswe_box_li").removeClass("intro");
			$("#broswe_box4").toggleClass("");
		}
	});
	
	$("#broswe_box5").click(function() {
		if($('#broswe_box5_li').css('display')=='block'){
			$("#broswe_box5_li").hide();
			$("#broswe_box5_li").addClass("intro");
			$("#broswe_box5").toggleClass("broswe_selected");
		}else{

			$("#broswe_box5_li").show();
			$("#broswe_box5_li").removeClass("intro");
			$("#broswe_box5").toggleClass("");
		}
	});
});

function showView(val){

	if($('.showlist'+val).css('display')=='block'){
		$('.showlist'+val).hide('');	
	}else{
		$('.showlist'+val).show('');
	}	
}
</script>

<script type="text/javascript">



function slideSwitch() {
    var $active = $('#slidebanner IMG.active');

    if ( $active.length == 0 ) $active = $('#slidebanner IMG:last');


    var $next =  $active.next().length ? $active.next()
        : $('#slidebanner IMG:first');



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

</script>

<!--<script src="js/site/core.js" type="text/javascript"></script>-->

<script src="js/site/jquery.colorbox.js"></script>

<script>
$(document).ready(function(){

	var boxpostwindowsize = $(window).width();

		$(".cboxClose1").click(function(){
			$("#cboxOverlay,#colorbox").hide();
			});
		
		
		if (boxpostwindowsize > 559) {
	
			$(".rental-contactme").colorbox({width:"665px", height:"630px", inline:true, href:"#inline_contactme"});
			
			$(".rental-wishlist").colorbox({width:"665px", height:"630px", inline:true, href:"#inline_wishlist"});
			
			$(".create").colorbox({width:"665px", height:"630px", inline:true, href:"#create_wishlist"});
			
			$(".login-popup").colorbox({width:"365px", height:"480px", inline:true, href:"#inline_login"});
			
			$(".reg-popup").colorbox({width:"380px", height:"450px", inline:true, href:"#inline_reg"});
			
			
			$(".forgot-popup").colorbox({width:"365px", height:"310px", inline:true, href:"#inline_forgot"});
			
			$(".register-popup").colorbox({width:"365px", height:"630px", inline:true, href:"#inline_register"});
			
			$(".add-address").colorbox({width:"550px", height:"680px", inline:true, href:"#inline_mapaddress"});
			$(".example16").colorbox({width:"800px", height:"600px", inline:true, href:"#inline_example11"});
		
			
			} else {
		
		
			$(".login-popup").colorbox({width:"310px", inline:true, href:"#inline_login"});
			
			$(".reg-popup").colorbox({width:"310px", height:"380px", inline:true, href:"#inline_reg"});
			
			$(".rental-contactme").colorbox({width:"310px", height:"630px", inline:true, href:"#inline_contactme"});
			
			$(".rental-wishlist").colorbox({width:"310px", height:"630px", inline:true, href:"#inline_wishlist"});
			
			$(".create").colorbox({width:"310px", height:"630px", inline:true, href:"#create_wishlist"});
		
			$(".forgot-popup").colorbox({width:"310px", height:"310px", inline:true, href:"#inline_forgot"});
			
			$(".register-popup").colorbox({width:"310px", height:"630px", inline:true, href:"#inline_register"});
			
			$(".add-address").colorbox({width:"310px", height:"680px", inline:true, href:"#inline_mapaddress"});
			
			$(".example16").colorbox({width:"310px", height:"600px", inline:true, href:"#inline_example11"});
			
			
			}
		
			$("#onLoad").click(function(){ 
				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});
			

			
		

});
var boxpostwindowsize1 = $(window).width();
$(document).on('click', '.login-popup' , function() {
if (boxpostwindowsize1 > 559) {
  $.colorbox({width:"365px", height:"480px", inline:true, href:"#inline_login"});
}else{
  $.colorbox({width:"310px", inline:true, href:"#inline_login"});
}
});
function loginpopupopen(){
$(".login-popup").colorbox({width:"365px", height:"480px", open:true, href:"#inline_login"});
}
function loginpopupsignin(){
$(".register-popup").colorbox({width:"365px", height:"630px", open:true, href:"#inline_register"});
}
</script>






<!--[if lt IE 9]>
<script src="js/html5shiv/dist/html5shiv.js"></script>
<![endif]-->