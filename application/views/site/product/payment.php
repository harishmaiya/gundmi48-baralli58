<?php 
$this->load->view('site/templates/header');
$product=$ProductDetail->row();
?>
<?php $commission=$hosting_payment_details->row()->commission_percentage;
if($hosting_payment_details->row()->promotion_type=='percentage'){
	$hosting_price=($product->price/100)*$commission;
} else{
	$hosting_price=$commission;
}
define("StripeDetails",$this->config->item('payment_1'));
$StripeValDet = unserialize(StripeDetails); 
$StripeVal = $StripeValDet['status'];
$StripeValDet1=unserialize($StripeValDet['settings']);
define("creditcard",$this->config->item('payment_2'));
$creditcard = unserialize(creditcard);
$creditCard_payment = $creditcard['status'];
define("paypal",$this->config->item('payment_0'));
$paypal = unserialize(paypal); 
$paypalVal = $paypal['status'];
?>
<input type="hidden" id="rental_id" value="<?php echo $product->id; ?>" />
<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>
<script type="text/javascript" src="javascript/autocomplete/jquery-ui-1.8.2.custom.min.js"></script> 
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
Stripe.setPublishableKey('<?php echo $StripeValDet1['publishable_key']; ?>');
</script>
<script>
jQuery(function($) {
	$('#auth-pay-button').click(function(event) {
		var terms = document.getElementById("terms").checked;
		if(terms == true)
		{
			var cardNumber = $('#cardNumber').val();
			var cvv = $('#payment-card-security').val();
			if(cardNumber == ''){
				$('#cardNumber').focus();
				return false;
			}
			if(cvv == ''){
				$('#payment-card-security').focus();
				return false;
			}
			
			$('#credit_card_forms').submit();
		}
		else
		{
			$('#terms_warn').html('<p style="color:#F00; margin-right:3px;">This field is required</p> ');
			$('#terms_warn').show().delay('3000').fadeOut();
			return false;
		}
	});
	$('#stripe-pay-button').click(function(event) {
		var terms = document.getElementById("terms").checked;
		if(terms == true)
		{
			$('#error').fadeOut();
			var $form = $("#credit_card_forms_stripe");
			$form.find('.loading').text('Please wait your transaction on process');
			$('#loading').fadeIn;
			$form.find('button').prop('disabled', true);
			Stripe.createToken($form, stripeResponseHandler);
			return false;
		}
		else
		{
			$('#terms_warn').html('<p style="color:#F00; margin-right:3px;">This field is required</p> ');
			$('#terms_warn').show().delay('3000').fadeOut();
			return false;
		}
	});
});
var stripeResponseHandler = function(status, response) {
	$('#loading').fadeOut();
	var $form = $('#credit_card_forms_stripe');
	if (response.error) {
		$form.find('.payment-errors').text('Sorry! please check '+response.error.message);
		$('#error').fadeIn();
		setTimeout(function(){
		$('#error').fadeout();
		},3000);
		$form.find('button').prop('disabled', false);
	} else {
		var token = response.id;
		$form.append($('<input type="hidden" name="stripeToken" />').val(token));
		$form.get(0).submit();
	}
};
</script>
<div class="dashboard">
	<div class="main">
        <div class="payment_main">
            <div class="payment_user">
                <div class="payment_box">
					<h1>Payment options </h1>
					<div id="TabbedPanels1" class="TabbedPanels">
						<ul class="TabbedPanelsTabGroup">
							<?php if($creditCard_payment !='Disable') { ?>
							<li class="TabbedPanelsTab " tabindex="0" onclick="return submit_button0();">Credit Card</li>
							<?php } if($StripeVal != 'Disable') { ?>
							<li class="TabbedPanelsTab " tabindex="0" onclick="return submit_button1();">Stripe</li>
							<?php } if($paypalVal != 'Disable') { ?>
							<li class="TabbedPanelsTab " tabindex="0" onclick="return submit_button2();">PayPal</li>
							<?php } ?>
						</ul>
						<div class="TabbedPanelsContentGroup">
							<?php if($creditCard_payment !='Disable') { ?>
							<div class="payment_detail_method">
								<form method="post" action="site/product/HostPaymentCreditCard" id="credit_card_forms">
									<input type="hidden" value="authorize" name="creditvalue" />
									<input type="hidden" value="<?php echo $product->id; ?>" name="booking_rental_id" />
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
											<input  id="cardNumber" name="cardNumber" type="text" value="" style="width:222px; margin-top:5px;" autocomplete="off" maxlength="16"/>
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
										<label><?php if($this->lang->line('checkout_security_code') != '') { echo stripslashes($this->lang->line('checkout_security_code')); } else echo "Security Code"; ?></label>
										<input id="payment-card-security" name="creditCardIdentifier" type="password" style="width:84px;" value="" maxlength="3" autocomplete="off" />
										<div style="position:relative;">
											<label>This payment transacts in 
												<span style="font-weight:bold;" >
												<?php echo $currencySymbol.' '.USDtoCurrentCurrency($hosting_price); ?>
												</span>
											</label>
										</div>
									</div>
								</form>
							</div>
							<?php } if($StripeVal !='Disable') { ?>
							<div class="payment_detail_method">
								<form method="post" action="site/product/HostPaymentCredit" id="credit_card_forms_stripe">
									<div class="payment_left">
										<input type="hidden" name="stripe_mode" id="stripe_mode" value="<?php echo $StripeValDet1['mode']; ?>"  />
										<input type="hidden" name="stripe_key" id="stripe_key" value="<?php echo $StripeValDet1['secret_key']; ?>"  />
										<input type="hidden" name="stripe_publish_key" id="stripe_publish_key" value="<?php echo $StripeValDet1['publishable_key']; ?>"  />
										<label>First Name</label>
										<input type="text" value="<?php echo $BookingUser->firstname; ?>" id="firstname" name="firstname" style="width:138px;" size="30"  />
										<label>Last Name</label>
										<input type="text" value="<?php echo $BookingUser->lastname; ?>" id="lastname" name="lastname" style="width:138px;" size="30"  />
										<label>Street Address</label>
										<input type="text" value="<?php echo $BookingUser->UserAddress; ?>" size="30" id="address" name="address"  />
										<label>Apt, Suite, Bldg (optional)</label>
										<input type="text" id="suite" name="suite" size="30"  />
										<label>City</label>
										<input type="text" id="city" name="city" value="<?php echo $BookingUser->UserCity; ?>" style="width:151px;" size="30"  />
										<label>State</label>
										<input type="text" id="state" name="state" value="<?php echo $BookingUser->UserState; ?>" style="width:40px;" size="30"  />
										<label>Postal Code</label>
										<input type="text" id="postal_code" name="postal_code" value="" style="width:75px;" size="30"  /><span style="margin-left:10px;"><b></b></span>
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
											<input  id="cardNumber" name="cardNumber" type="text" style="width:222px; margin-top:5px;" autocomplete="off" data-stripe="number" maxlength="16"/>
										</div>
										<label><?php if($this->lang->line('checkout_exp_date') != '') { echo stripslashes($this->lang->line('checkout_exp_date')); } else echo "Expiration Date"; ?></label>
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
										<select id="CCExpMnth" name="CCExpMnth" style="width:100px;" class="select-round select-white select-date selectBox required" data-stripe="exp-year">
										<?php for($i=date('Y');$i< (date('Y') + 30);$i++){ ?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php } ?>
										</select>
										
										<input type="hidden" value="stripe" name="creditvalue" />
										<input type="hidden" value="<?php echo $hosting_price; ?>" name="total_price" />
										<input type="hidden" value="<?php echo $product->id; ?>" name="booking_rental_id" />
										<label><?php if($this->lang->line('checkout_security_code') != '') { echo stripslashes($this->lang->line('checkout_security_code')); } else echo "Security Code"; ?></label>
										<input id="payment-card-security" name="creditCardIdentifier" type="password" style="width:84px;" size="4" autocomplete="off" maxlength="3"/>
										<div style="position:relative;">
											<label>This payment transacts in 
												<span style="font-weight:bold;" >
												<?php echo $currencySymbol.' '.USDtoCurrentCurrency($hosting_price); ?>
												</span>
											</label>
										</div>
										<div id="error" style="color:red;" class="payment-errors"></div>
										<div id="loading" style="color:green;" class="loading"></div>
									</div>
								</form>
							</div>
							<?php } if($paypalVal !='Disable') { ?>
							<div class="TabbedPanelsContent">
								<div class="currency_alert">This payment transacts in <?php echo $currencySymbol.' '.USDtoCurrentCurrency($hosting_price); ?></div>
								<p class="payment_method_paypal"><span style="font-weight:bold;">Instructions:</span><br>After clicking "Book it" you will be redirected to PayPal to authorize the payment.<span style="font-weight:bold;">You must complete the process or the transaction will not occur.</span></p>
							</div>
							<?php } ?>
							<script type="text/javascript">
								var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
							</script>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="payment_agree" style="padding-bottom:10px;">
					<p>
					<input type="hidden" value="<?php echo $hosting_price;?>" id="totprice">
                    <input type="checkbox" style="float:left; width:25px;" id="terms" />
					<label for="agrees_to_terms">I agree to the <a target="_blank" class="terms_link" href="<?php echo base_url();?>pages/terms-of-service">terms of service</a>.<span id="terms_warn"></span></label></p>
					<?php $set = 0; if($creditCard_payment !='Disable') { ?>
					<div id="auth_but"><input type="submit" style="margin:10px 0 0 10px;" id="auth-pay-button" value="Book it using Credit Card"  class="btn large green"></span></div>
					<?php $set = 1;} if($StripeVal !='Disable') { ?>
					<div id="stripe_but" <?php if($set == 1)echo "style='display:none'";?>><input type="submit" style="margin:10px 0 0 10px;" id="stripe-pay-button" value="Book it using Credit Card"  class="btn large green"></span></div>
					<?php $set = 1; } if($paypalVal !='Disable') { ?>
					<div id="paypal_but" <?php if($set == 1)echo "style='display:none'";?>><input type="submit" id="paypal" style="margin:10px 0 0 10px;" onclick="paypal_form();" value="Book it using Paypal"  class="btn large green"></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="dashboard_bottom">
		<div class="main">
			<ul class="dashboard_links">
				<li class="center">
					<div class="trust_box"><img src="images/site/trust.jpg" /></div>
					<h3>Trust & Safety</h3>
					<p>World-class security & communications features mean you never have to accept a booking unless you're 100% comfortable.</p>
				</li>
				<li class="center">
					<div class="trust_box trust_shadow"><img src="images/host_guarantee.png" width="98" height="98" /></div>
					<h3>$1,000,000 Host Guarantee</h3>
					<p>Your peace of mind is priceless. So we don't charge for it. Every single booking on Rental-ya is covered by our Host Guarantee - at no cost to you.</p>
				</li>
				<li class="center">
					<div class="trust_box"><img src="<?php echo base_url(); ?>images/site/host_couple.jpg" /></div>
                    <h3>Secure Payments</h3>
					<p>Our fast, flexible payment system puts money in your bank account 24 hours after guests check in.</p>
				</li>
			</ul>
		</div>
	</div>
</div>
<!---DASHBOARD-->
<input type="hidden" value="<?php echo $product->price * $product->numofdates;?>" id="totprice" />
<script type="text/javascript">
$(document).ready(function() {
    $("#cardNumber").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
function credit_card_form_func()
{ 

	var caltophone=jQuery("input:radio[name=caltophone]:checked").val();
	var terms = document.getElementById("terms").checked;
	
	
	if($('#phone_no').val()==''){
		$('#terms_warn').html('<p style="color:#F00; margin-right:3px;">Please Enter Contact Phone Number.</p> ');
		return false;
	}else if(terms == true)
		{
			document.getElementById("credit_card_form").submit();
		}
	else
		{
			$('#terms_warn').html('<p style="color:#F00; margin-right:3px;">This field is required</p> ');
			$('#terms_warn').show().delay('3000').fadeOut();
			return false;
		}
}

function paypal_form() 
{

	var caltophone=jQuery("input:radio[name=caltophone]:checked").val();
	var terms = document.getElementById("terms").checked;
	var product = <?php echo $this->uri->segment(5);?>;
	var amount = $('#totprice').val();
	if(terms == true){
		window.location = BaseURL+"site/product/HostPayment/"+product;
	} else {
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
		//alert(json.val);
			//return;
		}
	});
}

function submit_button0()
{
	$('#auth_but').hide();
	$('#stripe_but').hide();
	$('#paypal_but').hide();
	$('#auth_but').show();
}
function submit_button1()
{
	$('#auth_but').hide();
	$('#stripe_but').hide();
	$('#paypal_but').hide();
	$('#stripe_but').show();
}function submit_button2()
{
	$('#auth_but').hide();
	$('#stripe_but').hide();
	$('#paypal_but').hide();
	$('#paypal_but').show();
}

</script>
<style>
select{
	padding: 6px 9px;
}
</style>
<script type="text/javascript" src="js/1.8-jquery-ui-min.js"></script>
<link rel="stylesheet" type="text/css" href="javascript/autocomplete/jquery-ui-1.8.2.custom.css" media="all" />
<script type="text/javascript" src="javascript/autocomplete/jquery-ui-1.8.2.custom.min.js"></script> 
<?php
$this->load->view('site/templates/footer');
?>