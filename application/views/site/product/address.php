<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rental-ya::Amenities Listing</title>
<link rel="stylesheet" media="all" href="css/style.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/colorbox.css" media="all" />

<script type="text/javascript" src="js/jquery-1.5.1.min"></script>
<script type="text/javascript">
function showView(val){

	if($('.showlist'+val).css('display')=='block'){
		$('.showlist'+val).hide('');	
	}else{
		$('.showlist'+val).show('');
	}	
}
</script>
<script type="text/javascript">

function homeView(val){
	//alert(val);
	if($('#homelist'+val).css('display')=='block'){
		$('#homelist'+val).hide('');	
	}else{
		$('#homelist'+val).show('');
	}
}


function roomView(val){
	//alert(val);
	if($('#roomlist'+val).css('display')=='block'){
		$('#roomlist'+val).hide('');	
	}else{
		$('#roomlist'+val).show('');
	}
}

function cityView(val){
	//alert(val);
	if($('#citylist'+val).css('display')=='block'){
		$('#citylist'+val).hide('');	
	}else{
		$('#citylist'+val).show('');
	}
}

function otherView(val){
	//alert(val);
	if($('#otherlist'+val).css('display')=='block'){
		$('#otherlist'+val).hide('');	
	}else{
		$('#otherlist'+val).show('');
	}
}

function accommodatesView(val){
	//alert(val);
	if($('#accommodateslist'+val).css('display')=='block'){
		$('#accommodateslist'+val).hide('');	
	}else{
		$('#accommodateslist'+val).show('');
	}
}

</script>

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
    
    // var $sibs  = $active.siblings();
    // var rndNum = Math.floor(Math.random() * $sibs.length );
    // var $next  = $( $sibs[ rndNum ] );


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

<script type="text/javascript" src="js/jquery.colorbox.js"></script>
<script type="text/javascript">
$(document).ready(function(){

		$(".cboxClose1").click(function(){
			$("#cboxOverlay,#colorbox").hide();
			});
		
			$(".login-popup").colorbox({width:"365px", height:"480px", inline:true, href:"#inline_login"});
			
			$(".reg-popup").colorbox({width:"365px", height:"380px", inline:true, href:"#inline_reg"});
			
			$(".forgot-popup").colorbox({width:"365px", height:"310px", inline:true, href:"#inline_forgot"});
			
			$(".register-popup").colorbox({width:"365px", height:"630px", inline:true, href:"#inline_register"});
			
		
		//Example of preserving a JavaScript event for inline calls.
			$("#onLoad").click(function(){ 
				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});

});
</script>

<script src="js/core.js" type="text/javascript"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv/dist/html5shiv.js"></script>
<![endif]-->
</head>
<body>
<!-- Popup_signin_start -->
<div style='display:none'>

  <div id='inline_login' style='background:#fff;'>
  
  		<div class="popup_page">
  
  			<div class="popup_header">Log in</div>
            
            <div class="popup_detail">
            
            	<div class="banner_signup">
                            	
                                <a class="popup_facebook">Login with Facebook</a>
                                	
                                 <span class="popup_signup_or">OR</span>
                                 
                                 <input type="text" id="signin_email" value="Email Address" class="decorative-input" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
                                 
                                 <input type="password" value="Password" class="decorative-input1" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
                                 
                                 <span class="popup_stay"><input class="check" type="checkbox" />Remember Me</span>
                                 <a href="#" class="all-link1 forgot-popup">Forgot Password? </a>
                                 <button class="btn btn-block btn-primary large btn-large padded-btn-block" type="submit">Log In</button>
                                 <span class="popup_stay">Don't have an account?<a href="#" style="font-size:13px; margin:0 0 0 3px" class="all-link reg-popup">Sign Up</a></span>
                            </div>
                    
                    	
            </div>
        
        </div>
        
  </div>
  
</div>

<div style='display:none'>

  <div id='inline_reg' style='background:#fff;'>
  
  		<div class="popup_page">
  
  			<div class="popup_header"> Sign up </div>
            
            <div class="popup_detail">
            
            	<div class="banner_signup">
                            	
                                <a class="popup_facebook">Sign up with Facebook</a>
                                	
                                 <span class="popup_signup_or">OR</span>
                                 <button class="btn btn-block btn-primary large btn-large padded-btn-block register-popup" type="submit">Sign up with Email</button>
                                 <p style="font-size:11px; margin:10px 0">By clicking "Sign up with Facebook" you confirm that you accept the <a data-popup="true" href="#">Terms of Service</a> and <a data-popup="true" href="#">Privacy Policy</a>.</p>
                                 <span class="popup_stay">Already member?<a href="#" style="font-size:13px; margin:0 0 0 3px" class="all-link login-popup">Log in</a></span>
                            </div>
                    
                    	
            </div>
        
        </div>
        
  </div>
  
</div>

<div style='display:none'>

  <div id='inline_register' style='background:#fff;'>
  
  		<div class="popup_page">
  
  			<div class="popup_header"> Sign up </div>
            
            <div class="popup_detail">
            
            	<div class="banner_signup">
                            	
                                <a class="popup_facebook">Sign up with Facebook</a>
                                	
                                 <span class="popup_signup_or">OR</span>
                                 
                                 <input type="text" id="signin_email" value="First Name" class="decorative-input2" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
                                 <input type="text" id="signin_email"  value="Last Name" class="decorative-input2" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
                                 
                                 <input type="text" id="signin_email"  value="Email Address" class="decorative-input" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
                                 
                                 <input type="password" value="Password" class="decorative-input1" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
                                  <input type="password" value="Confirm Password" class="decorative-input1" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
                                  
                                 <div style="float:left; width:100%; margin:5px 0"> <input type="checkbox" style="float:left; width:auto; margin:0 5px 0 0px" /><label style="float:left">Tell me about Renters news </label></div>
                                 
                                 <p style="font-size:11px; text-align:left; margin:10px 0">By clicking "Sign up" you confirm that you accept the <a data-popup="true" href="#">Terms of Service</a> and <a data-popup="true" href="#">Privacy Policy</a>.</p>
                                 
                                 <button type="submit" class="btn btn-block btn-primary large btn-large padded-btn-block register-popup cboxElement">Sign up</button>
                                 <span class="popup_stay">Already member?<a href="#" style="font-size:13px; margin:0 0 0 3px" class="all-link login-popup">Log in</a></span>
                            </div>
                    
                    	
            </div>
        
        </div>
        
  </div>
  
</div>

<div style='display:none'>

  <div id='inline_forgot' style='background:#fff;'>
  
  		<div class="popup_page">
  
  			<div class="popup_header"> Reset Password </div>
            
            <div class="popup_detail">
            
            	<div class="banner_signup">
                            	<p style="font-size:12px; text-align:left; margin:10px 0">Enter the email address associated with your account, and we'll email you a link to reset your password.</p>
                                
                                 <input type="text" id="signin_email" value="Email Address" class="decorative-input" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
                                 
                              <button class="btn btn-primary" style="height:25px;" type="submit">Send Reset Link</button>
                               
                            </div>
                    
                    	
            </div>
        
        </div>
        
  </div>
  
</div>
<!-- Popup_signin_ends -->
<!---HEADER-->
<header>
	<div class="header">
    	<div class="wrapper">
			<div id="logo"><a href="index.html"><img src="images/logo.png" /></a></div>
            <div class="search">
            	<input type="text" class="search_txt" placeholder="Where are you going?" />
            </div>
           <div class="browse_div">
            	 <a href="javascript:showView('1');">BROWSE</a>              
                <ul class="showlist1" >
                   <li><a href="#">Neighborhoods</a></li>
                   <li><a href="#">Popular</a></li>
                </ul>
           </div>
           
           <div class="header_link">
           <ul class="login_links W34">           		
                <li><a href="#"><img src="images/mail.png" /></a></li>	
           </ul> 
           <div class="browse_div1">
            	 <a href="javascript:showView('3');"><img src="images/profile.png" style="float:left; margin:0 5px;" />Username</a>              
                <ul class="showlist3" >
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Your Listings</a></li>
                    <li><a href="#">Your Trips</a></li>
                    <li><a href="#">Wish Lists</a></li>
                    <li><a href="#">Edit Profile</a></li>
                    <li><a href="#">Account</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
           </div>
           <div class="browse_div1">
            	 <a href="javascript:showView('2');">HELP</a>              
                <ul class="showlist2" >
                    <li><a href="#">Need help on this page? </a></li>
                    <li><a href="#">Getting Started Guide</a></li>
                    <li><a href="#">How do I sign up?</a></li>
                    <li><a href="#">How do I host on Rental-ya?</a></li>
                    <li><a href="#">How do I travel on Rental-ya?</a></li>
                    <li><a href="#">Visit our Trust & Safety Center</a></li>
                    <li><a href="#">See all FAQs</a></li>
                </ul>
           </div>
           </div>
        </div>   
	</div>
</header>
<!---HEADER-->

<div class="sub_header">

	<ul class="sub_header_left">
    
    	<li><a class="view_listing" href="#">View your all Listings</a></li>
        
        <li class="write_title">Write a title</li>
        
        <li style="float:right;"><a class="preview_listing" href="#">Preview</a></li>
    
    </ul>

</div>

<!---DASHBOARD-->

	<div class="main_2">
    	
        <div class="manage_listing">
        
        	<div class="left_side">
            
            	<div class="left_side_top">
            
            	<h2>Brands</h2>
                
                <ul class="left_side_1">
                
                	<li><a href="manage-listing.html"><i class="left_side_icon left_icon-1"></i><span>Calendar</span><div class="new-section-icon"><i class="icon_plus"></i></div></a></li>
                    
                    <li><a href="pricing-listing.html"><i class="left_side_icon left_icon-2"></i><span>Pricing</span><div class="new-section-icon"><i class="icon_plus"></i></div></a></li>
                
                </ul>
                
                <h2>Description</h2>
                
                <ul class="left_side_1">
                
                	<li><a href="overview-listing.html"><i class="left_side_icon left_icon-3"></i><span>Overview</span><div class="new-section-icon"><i class="icon_plus"></i></div></a></li>
                    
                    <li><a href="photos-listing.html"><i class="left_side_icon left_icon-4"></i><span>Photos</span><div class="new-section-icon"><i class="icon_plus"></i></div></a></li>
                
                </ul>
                
                    <h2>Settings</h2>
                
                <ul class="left_side_1">
                
                	<li  class="active"><a href="#"><i class="left_side_icon left_icon-5"></i><span>Amenities</span><div class="new-section-icon"><i class="icon_plus"></i></div></a></li>
                    
                    <li><a href="address-listing.html"><i class="left_side_icon left_icon-6"></i><span>Address</span><div class="new-section-icon"><i class="icon_plus"></i></div></a></li>
                    
                    <li><a href="listing.html"><i class="left_side_icon left_icon-7"></i><span>Listing</span><div class="new-section-icon"><i class="icon_plus"></i></div></a></li>
                    
                </ul>
            
            </div>
            
            <div class="left_side_bottom">
            
            	<div class="left_side_bottom_content">Complete <strong>6 steps</strong> to list your space.</div>
            
            
            </div>
            
            </div>
            
            <div class="right_side">
            
            <div class="dashboard_price_main">
            
            	<div class="dashboard_price">
            
                    <div class="dashboard_price_left">
                    
                    	<h3>Most Common</h3>
                        
                        <p>Common amenities at most Renters listings. </p>
                    
                    </div>
                    
                    <div class="dashboard_price_right">
                    
                    	<ul class="facility_listed">
                        
                        	<li><input type="checkbox" class="checkbox_check" /><span>TV</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Cable TV</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Air Conditioning</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Heating</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Internet</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Kitchen</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Wireless Internet</span></li>
                            
                        </ul>
                    
                    
                    </div>
                
                </div>
                
                
                
            
            </div>
            
            <div class="dashboard_price_main">
            
            	<div class="dashboard_price">
            
                    <div class="dashboard_price_left">
                    
                    	<h3>Extras</h3>
                        
                        <p>Additional amenities your listing may offer. </p>
                    
                    </div>
                    
                    <div class="dashboard_price_right">
                    
                    	<ul class="facility_listed">
                        
                        	<li><input type="checkbox" class="checkbox_check" /><span>Hot Tub </span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Washer</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Pool</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Dryer</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Breakfast</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Free parking on premise</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Gym</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Elevator in Building</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Indoor Fireplace</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Buzzer/Wireless Intercom</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Doorman</span></li>
                                                        
                        </ul>
                    
                    
                    </div>
                
                </div>
                
                
                
            
            </div>
            
            <div class="dashboard_price_main">
            
            	<div class="dashboard_price">
            
                    <div class="dashboard_price_left">
                    
                    	<h3>Special Features</h3>
                        
                        <p>Features of your listing for guests with specific needs.</p>
                    
                    </div>
                    
                    <div class="dashboard_price_right">
                    
                    	<ul class="facility_listed">
                        
                        	<li><input type="checkbox" class="checkbox_check" /><span>Family/Kid Friendly</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Smoking Allowed</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Suitable for Events</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Pets Allowed</span></li>
                            
                            <li><input type="checkbox" class="checkbox_check" /><span>Handicap Accessible</span></li>
                            
                        </ul>
                    
                    
                    </div>
                
                </div>
                
                
                
            
            </div>
            
            
            </div>
            
        
        </div>
        
    </div>
    
<!---DASHBOARD-->
<!---FOOTER-->
<footer>
<div class="footer_inner">
	<div class="main_2">
    	
        <div class="footer_copyrights_links">
        	
        	<span>© Renters, Inc.</span>
        
        </div>
       			
        
        <div class="footer_inner_links">
        
        	<ul>
            
                <li><a href="#">About</a>|</li>
                <li><a href="#">Help</a>|</li>
                <li><a href="#">Safety</a>|</li>
                <li><a href="#">Responsible Hosting</a>|</li>
                <li><a href="#">Policies</a>|</li>
                <li><a href="#">Terms & Privacy</a></li>
                
        	</ul>
        
        </div>
        
        
                    <div class="language-curr-picker">
                   		 <div class="lang-selector btn-group btn-dropdown">
                      <button class="btn gray dropdown-toggle">
                        <i class="globe"></i>
                        <span class="value language">English </span> <span class="currency_arrow"><img src="images/drop_down_icon.png" /></span>
                      </button>
                          <ul class="dropdown-menu nav language-dropdown bottom-up">
                            <li class="nav-header">Choose language</li>
                            
                              <li><a href="#">Bahasa Indonesia</a></li>
                            
                              <li><a href="#">Bahasa Melayu</a></li>
                            
                              <li><a href="#">Dansk</a></li>
                            
                              <li><a href="#">Deutsch</a></li>
                            
                              <li><a href="#">English</a></li>
                            
                              <li><a href="#">Español</a></li>
                            
                              <li><a href="#">Eλληνικά</a></li>
                            
                              <li><a href="#">Français</a></li>
                            
                              <li><a href="#">Italiano</a></li>
                            
                              <li><a href="#">Magyar</a></li>
                            
                              <li><a href="#">Nederlands</a></li>
                            
                              <li><a href="#">Norsk</a></li>
                            
                              <li><a href="#">Polski</a></li>
                            
                              <li><a href="#">Português</a></li>
                            
                              <li><a href="#">Svenska</a></li>
                            
                          </ul>
                    </div>
          			</div>
        
    </div>
</div>
</footer>
<!---FOOTER-->
</body>
</html>