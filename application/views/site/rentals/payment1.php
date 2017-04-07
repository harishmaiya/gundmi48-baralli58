<?php 
$this->load->view('site/templates/header');
$product = $productList->row();
$BookingUser = $BookingUserDetails->row();
$servicetax = $service_tax->row();
$country = $countryList; 
?>
<style>
input[type="text"] {
color:#000 !important;
}
</style>
<script type="text/javascript">
$(document).ready(function () {
    $('.pad').hide();
    $('.heading').click(function () {
        $(this).next('.pad').slideToggle();
        if($(this).find('.span1').attr('id') == 'yes') {
            $(this).find('.span1').attr('id', '').html('&#8744;');
        } else {
            $(this).find('.span1').attr('id', 'yes').html('&#8743;');
        }
    });
});
</script>
<script type="text/javascript">
$(document).ready(function () {
    $('.pad1').hide();
    $('.heading1').click(function () {
        $(this).next('.pad1').slideToggle();
        if($(this).find('.span2').attr('id') == 'yes') {
            $(this).find('.span2').attr('id', '').html('&#8744;');
        } else {
            $(this).find('.span2').attr('id', 'yes').html('&#8743;');
        }
    });
});
</script>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).attr("value")=="red"){
                $(".red").toggle();
            }
        });
    });
</script>




<input type="hidden" id="rental_id" value="<?php echo $product->id; ?>" />
<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>

<section>
<div class="payment-container">
<div class="container">


<div class="payment-section1">
			<div class="payed-container">
            <article class="pay-head">
            <span> <?php echo $product->product_title;?></span>
            <a class="bak-tooffer" href="<?php echo base_url(); ?>rental/<?php echo $product->id;?>"><i class="arow-keyd"></i>Back</a>
            </article>

            <div class="over-view-details">
            <div class="over-view-details-left">
			<img src="<?php if(strpos($product->product_image, 's3.amazonaws.com') > 1)echo $product->product_image;else echo base_url()."server/php/rental/".$product->product_image; ?>" />
			</div>
            <div class="over-view-details-right">
               

                    <ul class="checkin-details-left cheks-status">
                        <li>
                            <label>When:</label>
                            <span><?php echo date('Y-m-d',strtotime($product->checkin)); ?></span>
                        </li>

                         <li>
                            <label>Check out:</label>
                            <span><?php echo date('Y-m-d',strtotime($product->checkout)); ?></span>
                        </li>


                         <li>
                            <label>You Stay:</label>
                            <span><?php if($product->numofdates > 1) echo $product->numofdates." Nights"; ?></span>
                            <span><?php if($product->numofdates == 1) echo $product->numofdates." Night"; ?></span>
                        </li>

                        <li>
                            <label>Guests:</label>
							<span><?php if($product->NoofGuest > 1) echo $product->NoofGuest." Guests"; ?></span>
                            <span><?php if($product->NoofGuest == 1) echo $product->NoofGuest." Guest"; ?></span>
                        </li>
                    </ul>

                     <ul class="checkin-details-right cheks-status">
                        <li>
						
							<?php
							$commission = $product->serviceFee;
							
							$pricePerNight = ($product->totalAmt-$commission)/$product->numofdates;
							$pricePerNight = $pricePerNight;
							?>
                            <label>Price for per night:</label>
                            <span> <?php echo $currencySymbol."  ".CurrencyValue($product->id,$pricePerNight); ?></span>
                        </li>
							<?php if($commission!='0.00') { ?>
                         <li>
                            <label>Service fees</label>
                            <span>
							<?php
								echo $currencySymbol."  ".CurrencyValue($product->id,$commission);
				
							?>
						</span>
                        </li>
						<?php } ?>


                         <li>
                            <label>Total:</label>
                            <span><?php
									echo $currencySymbol."  ".CurrencyValue($product->id,$product->totalAmt);
									?>
						</span>
                        </li>



  	<li>
                    <span class="bookind-smap">Booking No</span>
                    <input type="text" name ="Bookingno" id="Bookingno" readonly="true"  value="<?php echo $product->Bookingno;?>" >
					<input type="hidden" id="user_id" name="user_id"  value="<?php echo $BookingUser->userid;?>"/>
                </li>
     
                    </ul>


                        <?php if($instant == 'Yes'){?>
			<form method="post" action="site/user/booking_confirm_instant/<?php echo $this->uri->segment(2); ?>" id="credit_card_form" onsubmit="return validate();" >
			<?php } else {?>
			<form method="post" action="site/user/booking_confirm/<?php echo $this->uri->segment(2); ?>" id="credit_card_form" ><?php } ?>
			<input type="hidden" name="Bookingno"  value="<?php echo $product->Bookingno;?>"/>
                <ul class="login-list-cont">
             	<input type="hidden" name = "email_id" id = "email_id" value="<?php echo $BookingUser->email;?>" onblur="updateUserEmail();" readonly >
				<input type="hidden" id="user_id" name="user_id"  value="<?php echo $BookingUser->userid;?>" required />
			
				<li>
                    <span>Message</span>
                    <textarea class="hiost-mesg" id="message" name = "message" value=""  placeholder="Message your host.."></textarea>
                </li>





<div align="center">

<input type="submit" id="bookbtn" onclick="return Validate();" name="bookbtn" value="<?php if($instant == 'Yes'){?>PAY and BOOK <?php } else { ?>BOOK NOW<?php }?>" />
</div>

</form>


</div>





                    




<div class="notify-profile">
    <div class="thick-area"><img src="images/thick.png"></div>
    <div class="thick-infos"><span class="choise">Great Choice! You are Just 1 minute away from booking. </span><p>Fill in your details below to complete the booking. Once you submit your booking, it will be confirmed immediately and you will receive an email with the host’s contact details and the exact address of the property.</p></div>
</div>
</div>
</div>
</div>


<?php 
$ipayuser = $this->product_model->get_all_details(USERS,array('id'=>$BookingUserDetails->row()->userid));
?>


<div class="payment-section1">
<div class="payed-container">
         

            <div class="over-view-details">
			

</div>

</div>



</div>
</div>
</div>
</section>


<?php 
$sub_tot_price_in_dollar=$product->price*$product->numofdates;
   if($tax->row()->promotion_type=='flat')
      {
	$tax_price_in_dollar=$tax->row()->commission_percentage;
	 }
	else{
	 $tax_price_in_dollar=($product->price * $product->numofdates*$BookingUserDetails->row()->NoofGuest)*$tax->row()->commission_percentage/100;
	}


?>
<input type="hidden" value="<?php echo $sub_tot_price_in_dollar+$tax_price_in_dollar;?>" id="totprice" />
<script>
function checkNum()
{
 
if ((event.keyCode > 64 && event.keyCode < 91) || (event.keyCode > 96 && event.keyCode < 123) || event.keyCode == 8)
   return true;
else
   {
       sweetAlert("Oops...", "Please enter only character", "error");
       return false;
   }
 
}
</script>
<script type="text/javascript">
function Validate()
{

	var message_content = $('#message').val();
	var message_content_check = message_content.toLowerCase();
	var phoneno = /\d{3}/g;
	var emailPat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var Url = "^[A-Za-z]+://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$";
   
	if( phoneno.test(message_content_check) )
	{
	sweetAlert("Oops...", "Your Message contains an phone number! please remove ..", "error");
	document.body.style.cursor='default'; 
	return false;
	}
	if(message_content_check == '')
	{
		sweetAlert("Oops...", "'Message is required!", "error");
		document.body.style.cursor='default'; 
		return false;
	}
	else if( phoneno.test(message_content_check) )
	{
	sweetAlert("Oops...", "Your Message contains an phone number! please remove ..", "error");
	document.body.style.cursor='default'; 
	return false;
	}else if (message_content_check.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi))
	{
	sweetAlert("Oops...", "Your Message contains an email! please remove ..", "error");
	document.body.style.cursor='default'; 
	return false;
	}
	else if (message_content_check.match(Url)) {
       sweetAlert("Oops...", ""Your Message Contains a URL! please remove ..", "error");
	   document.body.style.cursor='default'; 
       return false;
    }
	else if ( message_content_check.match('fb') || message_content_check.match('facebook') || message_content_check.match('FB') || message_content_check.match('FACEBOOK') || message_content_check.match('Fb') ) {
       sweetAlert("Oops...", "Your Message Contains facebook related information! please remove ..", "error");
	   document.body.style.cursor='default'; 
       return false;
    }
	else if ( message_content_check.match('skype') || message_content_check.match('skp') ) {
       sweetAlert("Oops...", "Your Message Contains skype related information! please remove ..", "error");
	   document.body.style.cursor='default'; 
       return false;
    }
	else if ( message_content_check.match('id') || message_content_check.match('Id') || message_content_check.match('ID') ) {
       sweetAlert("Oops...", "Your Message Contains contact related information! please remove ..", "error");
	   document.body.style.cursor='default'; 
       return false;
    }  
	
}

$(function(){
   
   $('#message').bind('keypress', function(e) { 
        console.log( e.which );
		if($('#message').val().length == 0){
			var k = e.which;
			var ok = k >= 65 && k <= 90 || // A-Z
				k >= 97 && k <= 122 || // a-z
				k >= 48 && k <= 57; // 0-9
			
				if (!ok){
					e.preventDefault();
				}
		}
    }); 
	
});
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>												
<script type="text/javascript">

function credit_card_form_func()
{ 
  

	var caltophone=jQuery("input:radio[name=caltophone]:checked").val();
	var terms = document.getElementById("credit").checked;
	var dis = parseInt($('#disamounts').val());
	if( dis == ""){
	var amount = parseInt($('#totprice').val());
	}else{
	var amount =  parseInt($('#disamounts').val());
	}
	if($('#phone_no').val()==''){
		$('#terms_warn').html('<p style="color:#F00; margin-right:3px;">Please Enter Contact Phone Number.</p> ');
		return false;
	}else if(terms == true)
		{

			document.getElementById("ipay88").submit();
		
		}
	else
		{
			$('#terms_warn').html('<p style="color:#F00; margin:6px;padding:3px;">Please choose your <b>payment mode<b></p> ');
			$('#terms_warn').show().delay('3000').fadeOut();
			return false;
		}
}

function paypal_form()
{

	var caltophone=jQuery("input:radio[name=caltophone]:checked").val();
	var product = <?php echo $product->id;?>;
	var dis = parseInt($('#disamounts').val());
	if( dis == ""){
	var amount = parseInt($('#totprice').val());
	}else{
	var amount =  parseInt($('#disamounts').val());
	}
    
	//alert(amount);
	
	
	if(jQuery($('#phone_no').val())==''){
		$('#terms_warn').html('<p style="color:#F00; margin-right:3px;">Please Enter Contact Phone Number.</p>');
		return false;
	}else if(true == true)
		{
			$.ajax({
			type:'POST',
			url:'site/product/edit_enquiry_details',
			data:{'rental_id':$('#rental_id').val(),'Enquiry':$('#Enquiry').val(),'caltophone':caltophone,'phone_no':$('#phone_no').val(),'enquiry_timezone':$('#enquiry_timezone').val(),'guide_id':$('#guide_id').val()},
			dataType:'json',
			success:function(json){
            window.location = BaseURL+"site/checkout/PaymentProcess/"+product+"/"+amount;
			}
		});
			
		}
	else
		{
			$('#terms_warn').html('<p style="color:#F00; margin-right:3px;">This field is required</p> ');
			$('#terms_warn').show().delay('3000').fadeOut();
			return false;
		}
}
function updateenqueryDetails(){
		$.ajax({
			type:'POST',
			url:'site/product/edit_enquiry_details',
			data:{'rental_id':$('#rental_id').val(),'Enquiry':$('#Enquiry').val(),'enquiry_timezone':$('#enquiry_timezone').val()},
			dataType:'json',
			success:function(json){ 
				//return;
			}
		});
		
		
}
function submit_button1()
{
	$('#paypal').hide();
	$('#card').show();
	
}

function submit_button2()
{
	$('#card').hide();
	$('#paypal').show();
	$('#paypal_but').css('display', 'block');
}

function coupon_codes()
{
 var totalamount = parseInt($('#totprice').val());
$.ajax({
			type:'POST',
			url:'<?php echo base_url();?>site/product/coupons',
			data:{'couponcode':$('#couponcode').val(),'total':$('#total').val()},
			dataType:'json',
			success: function(json){
			//alert(json);
			
			var test = json.split("-"); 
			$('#totals').html('<p style="color:#F00; margin-right:3px;">'+'Total Amount :'+ test[3] +'</p> ');
			$('#totals').show();
			
			
			if(test[4] == 1){
			$('#disper').html('<p style="color:#F00; margin-right:3px;">'+'Flat Discount Amount :'+ test[1] +'</p> ');
			$('#disper').show();
			}else{
			$('#disper').html('<p style="color:#F00; margin-right:3px;">'+'Discount Percentage :'+ test[1] +'</p> ');
			$('#disper').show();
			
			}
			$('#disamount').html('<p style="color:#F00; margin-right:3px;">'+'Discounted Amount :'+ test[2] +'</p> ');
			$('#disamount').show();
			document.getElementById("dcouponcode").value=test[0];
			document.getElementById("disamounts").value=test[2];
			document.getElementById("distype").value=test[4];
			document.getElementById("dval").value=test[1];
			//alert(totalamount);
				return;
			}
			
		});  
		
}


function updateUserEmail()
{
	$.ajax({
			type:'POST',
			url:'site/product/edit_user_email',
			data:{'email_id':$('#email_id').val(),'user_id':$('#user_id').val()},
			dataType:'json',
			success:function(json){ 
				//return;
			}
		});
}


function get_mobile_code(country_id)
{

 $.ajax({
type:'POST',
url:'<?php echo base_url();?>site/user/get_mobile_code',
data:{country_id:country_id},
dataType:'json',
success:function(response)
{
$('.pniw-number-prefix').text(response['country_mobile_code']);
//alert(response);
}
});
}

</script>

<script type="text/javascript" src="js/1.8-jquery-ui-min.js"></script>
<link rel="stylesheet" type="text/css" href="javascript/autocomplete/jquery-ui-1.8.2.custom.css" media="all" />
<script type="text/javascript" src="javascript/autocomplete/jquery-ui-1.8.2.custom.min.js"></script> 
<?php
$this->load->view('site/templates/footer');
?>