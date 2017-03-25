<?php 
$this->load->view('site/templates/header');
$product = $productList->row();
$BookingUser = $BookingUserDetails->row();
$servicetax = $service_tax->row();
$country = $countryList;
?>
<script type="text/javascript">
$(document).ready(function () {
	$('#credit_card_forms_stripe').hide();
    $('#credit_card_forms_stripe').hide();
    $('#pay-with-stripe').hide();
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
			<?php $ipayuser = $this->product_model->get_all_details(USERS,array('id'=>$BookingUserDetails->row()->userid)); ?>
			<div class="payment-section1" style="display:block;">
				<div class="payed-container">
					<article class="pay-head">
						<span><?php if($this->lang->line('Howwouldyou') != '') { echo stripslashes($this->lang->line('Howwouldyou')); } else echo "How would you like to pay?";?> </span>
						<span>Booking Amount : <?php  echo $currencySymbol." ". CurrencyValue($product->id,$datavalues->row()->totalAmt-$datavalues->row()->serviceFee);  ?> <br/><?php if($datavalues->row()->totalAmt != $datavalues->row()->b_totalAmt && 1==0){?>Special offer : <?php  echo $currencySymbol." ". CurrencyValue($product->id,($datavalues->row()->totalAmt - $datavalues->row()->serviceFee));  echo "</br>";}?> Service Fee: <?php  echo $currencySymbol." ". CurrencyValue($product->id,$datavalues->row()->serviceFee);  ?><br/> Total Amount: <?php  echo $currencySymbol." ". CurrencyValue($product->id,$datavalues->row()->totalAmt-$datavalues->row()->offer);  ?>  </span>
					</article>
					<div class="over-view-details">
						<ul class="coupn-list-cont">
							<li>
								<form id="myForm" name="myForm" onsubmit="return validateForm();" method="POST">
								<span class="heading copncode"><?php if($this->lang->line('Doyouhave') != '') { echo stripslashes($this->lang->line('Doyouhave')); } else echo "Do you have Coupon code?";?><span class="span1" style="float:right;">&#8744;</span></span>
								<div id="occ" class="pad"><br />
									<input type="text" name="couponcode" id="couponcode" placeholder="Coupon Code"  />&nbsp; &nbsp;
									<input type="hidden" id="huser_id" name="huser_id" value="<?php echo $product->user_id;?>">
									<input type="hidden" name="total" id="total" value="<?php echo $subtotal+$tax_price; ?>"/>
									<input type="button" value="Apply" onclick="mycoupon();">
									<br />
									<p id="totals"></p>
									<p id="disper"></p>
									<p id="disamount"></p>
								</div>
								</form>
							</li>
							<?php define("creditcard",$this->config->item('payment_2'));
							$creditcard = unserialize(creditcard);
							$creditCard_payment = $creditcard['status'];?>
							<?php if($creditCard_payment !='Disable') { ?>
							<li>
								<input type="radio" checked="checked" onclick="myFunction();"  name="pay"><span class="credit-card" style="text-transform: capitalize;">Credit card</span>
								<form method="post" action="site/checkout/PaymentCredit" id="credit_card_forms">
								<div style="display:none">
									<label>Street Address</label>
									<input type="hidden" value="chennai" size="30" id="address" name="address"  />
									<label>Apt, Suite, Bldg (optional)</label>
									<input type="hidden" id="suite" name="suite" size="30"  />
									<label>City</label>
									<input type="hidden" id="city" name="city" value="minjur" style="width:151px;" size="30"  />
									<label>State</label>
									<input type="hidden" id="state" name="state" value="tamilnadu" style="width:40px;" size="30"  />
									<label>Postal Code</label>
									<input type="hidden" id="postal_code" name="postal_code" value="<?php echo $BookingUser->UserPostCode; ?>" style="width:75px;" size="30"  /><span style="margin-left:10px;"><b><?php echo $BookingUser->UserCountry; ?></b></span>
								</div>
								<div  class="payment_right">
									<label><?php if($this->lang->line('checkout_card_type') != '') { echo stripslashes($this->lang->line('checkout_card_type')); } else echo "Card Type"; ?></label>
									<select id="cardType" name="cardType">
										<option value="visa">Visa</option>
										<option value="mastercard">MasterCard</option>
										<option value="american_express">American Express</option>
										<option value="discover">Discover</option>
									</select>
									<div style="position:relative;">
										<label><?php if($this->lang->line('checkout_card_no') != '') { echo stripslashes($this->lang->line('checkout_card_no')); } else echo "Credit Card Number"; ?></label>
										<input  id="cardNumber" name="cardNumber" type="text" value="" style="width:222px; margin-top:5px;" autocomplete="off" />
									</div>
									<label style="display: -webkit-box;"><?php if($this->lang->line('checkout_exp_date') != '') { echo stripslashes($this->lang->line('checkout_exp_date')); } else echo "Expiration Date"; ?></label>
									<select id="CCExpDay" name="CCExpDay" style="margin-right:5px; width:100px; float:left;">
										<?php for($i=1;$i<13;$i++)
										{
											echo '<option value="'.$i.'">'.$i.'</option>';
										}?>
									</select>
									<select id="CCExpMnth" name="CCExpMnth"  style="margin-right:5px; width:100px; float:left;">
										<?php for($i=date('Y');$i< (date('Y') + 25);$i++){ ?>	
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php } ?>    
									</select>
									<input type="hidden" value="authorize" name="creditvalue" />
									<input type="hidden" value="<?php  echo $datavalues->row()->totalAmt;  ?>" id="price_val_authorize" name="total_price" />
									<input type="hidden" value="<?php echo $product->id; ?>" name="booking_rental_id" />
									<label><?php if($this->lang->line('checkout_security_code') != '') { echo stripslashes($this->lang->line('checkout_security_code')); } else echo "Security Code"; ?></label>
									<input id="payment-card-security" name="creditCardIdentifier" type="password" style="width:84px;" value="" size="4" autocomplete="off" />
									<input type="hidden" name="enquiryid" value="<?php echo $this->uri->segment(4); ?>" />
								</div>
								</form>
							</li>
							<?php } 
							define("StripeDetails",$this->config->item('payment_1'));
							$StripeValDet = unserialize(StripeDetails); 
							$StripeVal = $StripeValDet['status'];
							$StripeValDet1=unserialize($StripeValDet['settings']);	
							if($StripeVal != 'Disable') { ?>
							<li>
								<input type="radio"  onclick="myFunctionstripe();"  name="pay">
								<span class="credit-card">Stripe</span>
								<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
								<script type="text/javascript">
								
								// This identifies your website in the createToken call below
								
								Stripe.setPublishableKey('<?php echo $StripeValDet1['publishable_key']; ?>');
								
								</script>
								<script>
								
								jQuery(function($) {
								
								$('#stripe-pay-button').click(function(event) {
								
								$('#error').fadeOut();
								
								var $form = $("#credit_card_forms_stripe");
								
								$form.find('.loading').text('Please wait your transaction on process');
								
								$('#loading').fadeIn;
								
								// Disable the submit button to prevent repeated clicks
								
								$form.find('button').prop('disabled', true);
								
								Stripe.createToken($form, stripeResponseHandler);
								
								// Prevent the form from submitting with the default action
								
								return false;
								
								});
								
								});
								
								var stripeResponseHandler = function(status, response) {
								
								$('#loading').fadeOut();
								
								var $form = $('#credit_card_forms_stripe');
								
								if (response.error) {
								
								// Show the errors on the form
								
								$form.find('.payment-errors').text('Sorry! please check '+response.error.message);
								
								$('#error').fadeIn();
								
								setTimeout(function(){
								
								$('#error').fadeout();
								
								},3000);
								
								$form.find('button').prop('disabled', false);
								} else {
								
								// token contains id, last4, and card type
								
								var token = response.id;
								
								// Insert the token into the form so it gets submitted to the server
								
								$form.append($('<input type="hidden" name="stripeToken" />').val(token));
								
								// and submit
								
								$form.get(0).submit();
								
								}
								
								};
								</script>
								<form method="post" action="site/checkout/UserPaymentCreditStripe" id="credit_card_forms_stripe">
								<div style="display:none">
									<input type="hidden" name="stripe_mode" id="stripe_mode" value="<?php echo $StripeValDet1['mode']; ?>"  />
									<input type="hidden" name="stripe_key" id="stripe_key" value="<?php echo $StripeValDet1['secret_key']; ?>"  />
									<input type="hidden" name="stripe_publish_key" id="stripe_publish_key" value="<?php echo $StripeValDet1['publishable_key']; ?>"  />                   
									<label>Street Address</label>
									<input type="hidden" value="chennai" size="30" id="address" name="address"  />
									<label>Apt, Suite, Bldg (optional)</label>
									<input type="hidden" id="suite" name="suite" size="30"  />
									<label>City</label>
									<input type="hidden" id="city" name="city" value="minjur" style="width:151px;" size="30"  />
									<label>State</label>
									<input type="hidden" id="state" name="state" value="tamilnadu" style="width:40px;" size="30"  />
									<label>Postal Code</label>
									<input type="hidden" id="postal_code" name="postal_code" value="<?php echo $BookingUser->UserPostCode; ?>" style="width:75px;" size="30"  /><span style="margin-left:10px;"><b><?php echo $BookingUser->UserCountry; ?></b></span>
								</div>
								<div  class="payment_right">
									<label><?php if($this->lang->line('checkout_card_type') != '') { echo stripslashes($this->lang->line('checkout_card_type')); } else echo "Card Type"; ?></label>
									<select id="cardType" name="cardType" class="select-round select-white select-country selectBox required">
										<option value="Visa"><?php if($this->lang->line('user_visa') != '') { echo stripslashes($this->lang->line('user_visa')); } else echo 'Visa'; ?></option>
										<option value="Amex"><?php if($this->lang->line('user_amrican_exp') != '') { echo stripslashes($this->lang->line('user_amrican_exp')); } else echo 'American Express'; ?></option>
										<option value="MasterCard"><?php if($this->lang->line('user_master_card') != '') { echo stripslashes($this->lang->line('user_master_card')); } else echo 'Master Card'; ?></option>
										<option value="Discover"><?php if($this->lang->line('user_discover') != '') { echo stripslashes($this->lang->line('user_discover')); } else echo 'Discover'; ?></option>
									</select>
									<div style="position:relative;">
										<label><?php if($this->lang->line('checkout_card_no') != '') { echo stripslashes($this->lang->line('checkout_card_no')); } else echo "Credit Card Number"; ?></label>
										<input  id="cardNumber" name="cardNumber" type="text" value="" style="width:222px; margin-top:5px;" autocomplete="off" data-stripe="number" />
									</div>
									<label><?php if($this->lang->line('checkout_exp_date') != '') { echo stripslashes($this->lang->line('checkout_exp_date')); } else echo "Expiration Date"; ?></label><br>                        
									<select id="CCExpDay" name="CCExpDay" style="width:70px;" class="select-round select-white select-date selectBox required" data-stripe="exp-month">
										<option value="01" <?php if(date('m')=='01'){ echo $Sel;} ?>>01</option>
										<option value="02" <?php if(date('m')=='02'){ echo $Sel;} ?>>02</option>
										<option value="03" <?php if(date('m')=='03'){ echo $Sel;} ?>>03</option>
										<option value="04" <?php if(date('m')=='04'){ echo $Sel;} ?>>04</option>
										<option value="05" <?php if(date('m')=='05'){ echo $Sel;} ?>>05</option>
										<option value="06" <?php if(date('m')=='06'){ echo $Sel;} ?>>06</option>
										<option value="07" <?php if(date('m')=='07'){ echo $Sel;} ?>>07</option>
										<option value="08" <?php if(date('m')=='08'){ echo $Sel;} ?>>08</option>
										<option value="09" <?php if(date('m')=='09'){ echo $Sel;} ?>>09</option>
										<option value="10" <?php if(date('m')=='10'){ echo $Sel;} ?>>10</option>
										<option value="11" <?php if(date('m')=='11'){ echo $Sel;} ?>>11</option>
										<option value="12" <?php if(date('m')=='12'){ echo $Sel;} ?>>12</option>
									</select>
									<select id="CCExpMnth" name="CCExpMnth" style="width:100px;"class="select-round select-white select-date selectBox required" data-stripe="exp-year">
										<?php for($i=date('Y');$i< (date('Y') + 30);$i++){ ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php } ?>
									</select>
									<input type="hidden" value="stripe" name="payment_type" />
									<input type="hidden" value="<?php echo $product->id; ?>" name="booking_rental_id" />
									<label><?php if($this->lang->line('checkout_security_code') != '') { echo stripslashes($this->lang->line('checkout_security_code')); } else echo "Security Code"; ?></label>
									<input id="payment-card-security" name="creditCardIdentifier" type="password" style="width:84px;" value="" size="4" autocomplete="off" data-stripe="cvc" />
									<input type="hidden" value="<?php echo $datavalues->row()->totalAmt  ?>" name="total_price" />
									<input type="hidden" value="<?php echo $product->id; ?>" name="booking_rental_id" />
									<input type="hidden" name="enquiryid" value="<?php echo $this->uri->segment(4); ?>" />
									<div id="error" style="color:red;" class="payment-errors"></div>
									<div id="loading" style="color:green;" class="loading"></div>
								</div>
								</form>
							</li>
							<?php } define("paypal",$this->config->item('payment_0'));
							$paypal = unserialize(paypal); 
							$paypalVal = $paypal['status'];
							if($paypalVal !='Disable'){?>
							<li>
								<input type="radio" name="pay" onclick="myFunction1();" ><span class="credit-card">Paypal</span>
								<img src="<?php echo base_url();?>images/visa2.png" />
							</li>
							<?php } ?>
						</ul>
						<span id="terms_warn" style="background:red;"></span>
						<div class="booknw-area">
							<INPUT type="button" onclick="pay_by_card();" value="Proceed with Payment Credit card" id="card" style="margin: 10px 0px 0px 10px; background: none repeat scroll 0 0 #ff7e00;color: #fff;padding: 13px 30px;">
							<INPUT type="submit"   value="Pay with Stripe" id="stripe-pay-button" style="margin-left: -40px;display: none;margin: 10px 0px 0px 10px; background: none repeat scroll 0 0 #ff7e00;color: #fff;padding: 13px 100px;">
							<div id="paypal_but" style="display:none">
							<?php $data=$datavalues->row();
								$coupon=$pay->row();
								$service_tax = $service_tax->row();
								$productprice = $this->user_model->get_all_details(PRODUCT,array('id'=>$data->prd_id));
								$pprice = $productprice->row()->price;
								$total = $pprice * $data->numofdates;
								$total1 = $stotal * $data->NoofGuest;
								if($service_tax->promotion_type == 'flat'){
									$total = $total + $service_tax->commission_percentage;
								}else{
									$tax = $service_tax->commission_percentage;
									$taxamt = ($total*$tax/100);
									$total = ($total+$taxamt);
									$total1 = ($total1+($total1*$tax/100));
								}
								?>
								<form name="paypal" method="POST" action="<?php echo base_url(); ?>site/checkout/PaymentProcess">
								<input type="hidden" name="product_id" value="<?php echo $data->prd_id; ?>" />
								<?php 
								$pricevalue = ($coupon->couponCode == '')?$datavalues->row()->totalAmt:$pay->row()->total_amt; ?>
								<input type="hidden" name="price" id="final_value_price" value="<?php echo $datavalues->row()->totalAmt; ?>" />
								<input type="hidden" name="sumtotal" id="final_value_sum"  value="<?php echo $datavalues->row()->totalAmt; ?>" />
								<input type="hidden" name="indtotal" id="final_value_ind"  value="<?php echo $datavalues->row()->totalAmt; ?>" />
								<input type="hidden" name="user_id" value="<?php echo $data->user_id; ?>" />
								<input type="hidden" name="sell_id" value="<?php echo $data->renter_id;?>" />
								<input type="hidden" name="tax" value="<?php echo $datavalues->row()->serviceFee; ?>" />
								<input type="hidden" name="dealCodeNumber" value="" />
								<input type="hidden" name="enquiryid" value="<?php echo $this->uri->segment(4); ?>" />
								<input type="submit" name="caltophone" style="margin:10px 0 0 10px;" value="Book Now(paypal)" id="paypal"  class="boks12">
								</form>
							</div>
							<label class="submtig-text" style="padding:9px;"><?php if($this->lang->line('Bysubmittinga') != '') { echo stripslashes($this->lang->line('Bysubmittinga')); } else echo "By submitting a booking request, you accept the Renters";?><a target="_blank" href="<?php echo base_url();?>pages/privacy-policy"><?php if($this->lang->line('termsandconditions1') != '') { echo stripslashes($this->lang->line('termsandconditions1')); } else echo "terms and conditions";?></a></label>
						</div>
						<div class="norto-areas">
							<a href="#"><img src="<?php echo base_url();?>images/veri1.png"></a>
							<a href="#"><img src="<?php echo base_url();?>images/veri2.png"></a>
							<a href="#"><img src="<?php echo base_url();?>images/veri3.png"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<input type="hidden" value="<?php echo $sub_tot_price_in_dollar+$tax_price_in_dollar;?>" id="totprice" />
<script type="text/javascript">
function ipay88() {
//alert("Welcome");

}

function credit_card_form_func()

{ 

  //alert("Welcome");



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

		//alert("erl");

			document.getElementById("ipay88").submit();

			// $.ajax({

			// type:'POST',

			// url:'site/product/edit_enquiry_details',

			// data:{'rental_id':$('#rental_id').val(),'Enquiry':$('#Enquiry').val(),'caltophone':caltophone,'phone_no':$('#phone_no').val(),'enquiry_timezone':$('#enquiry_timezone').val()},

			// dataType:'json',

			// success:function(json){

			// document.getElementById("credit_card_form").submit();

			// }

		// });

			

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

	$('#netbank').css('display', 'none');

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

<input type="hidden" id="ttotal" name="sumtotal" value="<?php echo $datavalues->row()->totalAmt; ?>" />

<input type="hidden" id="tuser_id" value="<?php echo $datavalues->row()->user_id; ?>" />





<script>

function myFunction() {

    $('#paypal').hide();

	$('#credit_card_forms_stripe').hide();

    $('#credit_card_forms').show();

    $('#stripe-pay-button').hide();

    $('#card').show();

}



function myFunctionstripe() {

    $('#card').hide();

    $('#credit_card_forms').hide();

    $('#stripe-pay-button').show();

    $('#credit_card_forms_stripe').show();

    $('#paypal_but').hide();

}

function myFunction1() {

    $('#card').hide();

	$('#paypal').show();

	$('#paypal_but').css('display', 'block');

    $('#stripe-pay-button').hide();

}

function pay_by_card() {



$('#credit_card_forms').submit();

   

}









function mycoupon()

{



    $.ajax({

			type:'POST',

			url:'<?php echo base_url();?>site/product/coupons',

			data:{'couponcode':$('#couponcode').val(),'total':$('#ttotal').val(),'user_id':$('#tuser_id').val(),'product_id':$("#rental_id").val()},

			dataType:'json',

			success: function(json){

			

			var test = json.split("-"); 

			if(test[0] == '' || test[0] == '0')

			{

			$('#totals').html('Invalid Coupon Code or Coupon Code may be Expired');

			document.getElementById("couponcode").value='';

			$('#disper').hide();

			$('#disamount').hide();

			$("#price_val_stripe").val('');

			$("#price_val_authorize").val('');

			$("#dcouponcode").val('');

			$("#disamounts").val('');

			$("#final_value_price").val('');

			$("#final_value_sum").val('');

			$("#final_value_ind").val('');

			$("distype").val('');

			$("#dval").val('');

				return false;

			}

	

			$('#totals').html('<p style="color:#0193e6; margin-right:3px;">'+'Total Amount : '+ test[8] +'</p> ');

			$('#totals').show();

			

	        $('#disper').html('<p style="color:#0193e6; margin-right:3px;">'+'Amount Discount : '+ test[6] +'</p> ');

			$('#disper').show();

		

			

			$('#disamount').html('<p style="color:#0193e6; margin-right:3px;">'+'Amount to be paid: '+ test[7] +'</p> ');

			//alert(test[2]);

			$('#disamount').show();

			$("#price_val_stripe").val(test[2]);

			$("#price_val_authorize").val(test[2]);

			//$("#ttotal").val(test[2]);

			

			$("#dcouponcode").val(test[0]);

			$("#disamounts").val(test[3]-test[2]);

			$("#final_value_price").val(test[2]);

			$("#final_value_sum").val(test[2]);

			$("#final_value_ind").val(test[2]);

			$("distype").val(test[4]);

			$("#dval").val(test[1]);

			return;

			}

			

		});  

	

}







</script>

 



<link rel="stylesheet" type="text/css" href="javascript/autocomplete/jquery-ui-1.8.2.custom.css" media="all" />

<script type="text/javascript" src="javascript/autocomplete/jquery-ui-1.8.2.custom.min.js"></script> 

<?php

$this->load->view('site/templates/footer');

?>