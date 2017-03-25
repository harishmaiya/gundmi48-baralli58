<?php 
//echo '<pre>';print_r($hosting_payment_details->result());die;
$this->load->view('site/templates/header');
$product=$ProductDetail->row();
?>
<input type="hidden" id="rental_id" value="<?php echo $product->id; ?>" />
<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>
<script type="text/javascript" src="javascript/autocomplete/jquery-ui-1.8.2.custom.min.js"></script> 
<!---DASHBOARD-->
<div class="dashboard">

	<div class="main">
    	
        <div class="payment_main">
        
        	
            
            <div class="payment_user">
                      
                   <div class="payment_box">
                
                        <h1>Payment options 
                         
                         </h1>
                         
                         
                         <div id="TabbedPanels1" class="TabbedPanels">
           
                                <ul class="TabbedPanelsTabGroup">
                                  <li class="TabbedPanelsTab " tabindex="0" onclick="return submit_button1();">Credit Card</li>
                                  <li class="TabbedPanelsTab " tabindex="0" onclick="return submit_button2();">PayPal</li>
                                </ul>
            
                                    <div class="TabbedPanelsContentGroup">
                                    
                                      <div class="TabbedPanelsContent ">
                                         <form method="post" action="site/checkout/PaymentCredit" id="credit_card_form">
                                      		<div class="payment_detail_method">
                                           <div class="payment_left" style="display:none">
                                              
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
                                                <input type="text" id="postal_code" name="postal_code" value="<?php echo $BookingUser->UserPostCode; ?>" style="width:75px;" size="30"  /><span style="margin-left:10px;"><b><?php echo $BookingUser->UserCountry; ?></b></span>
                                        
                                              </div>
                                              
                                        
                                              <div  class="payment_right">
                                              
                                                <label><?php if($this->lang->line('checkout_card_type') != '') { echo stripslashes($this->lang->line('checkout_card_type')); } else echo "Card Type"; ?></label>
                                                	<select id="cardType" name="cardType">
                                                   		<option value="visa">Visa</option>
                                                        <option value="mastercard">MasterCard</option>
                                                        <option value="american_express">American Express</option>
                                                        <option value="discover">Discover</option>
                                                        <option value="jcb">JCB</option>
                                                    </select>
                                        
                                                <div style="position:relative;">
                                                
                                                  <label><?php if($this->lang->line('checkout_card_no') != '') { echo stripslashes($this->lang->line('checkout_card_no')); } else echo "Credit Card Number"; ?></label>
                                                  <input  id="cardNumber" name="cardNumber" type="text" style="width:222px; margin-top:5px;" autocomplete="off" />
                                                  
                                                  </div>
                                        
                                                <label><?php if($this->lang->line('checkout_exp_date') != '') { echo stripslashes($this->lang->line('checkout_exp_date')); } else echo "Expiration Date"; ?></label>
                                                
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
                                                
                                        		<input type="hidden" value="<?php echo $product->price; ?>" name="total_price" />
                                                <input type="hidden" value="<?php echo $product->id; ?>" name="booking_rental_id" />
                                                <label><?php if($this->lang->line('checkout_security_code') != '') { echo stripslashes($this->lang->line('checkout_security_code')); } else echo "Security Code"; ?></label>
                                                <input id="payment-card-security" name="creditCardIdentifier" type="password" style="width:84px;" size="4" autocomplete="off" />
                                                
                                              </div>
                                                                                    
                                            </div>
                                         </form>
                                            
                                      </div>
                                      <div class="TabbedPanelsContent">
                                      <?php 
										$commission=$hosting_payment_details->row()->commission_percentage;
										if($hosting_payment_details->row()->promotion_type=='percentage')
										{
										$hosting_price=($product->price/100)*$commission;
										}
										else{
										$hosting_price=$commission;
										}
										?>
                                      <div class="currency_alert">This payment transacts in
                                               <?php echo $currencySymbol.' '.$hosting_price; ?>.  Your total charge is <?php echo $currencySymbol.' '.$hosting_price; ?>.
                                            </div>
                                        
                                            <p class="payment_method_paypal">
                                                <span style="font-weight:bold;">Instructions:</span>
                                                <br>
                                                After clicking "Book it" you will be redirected to PayPal to authorize the payment.
                                                <span style="font-weight:bold;">
                                                  You must complete the process or the transaction will not occur.
                                                </span>
                                            </p>
                                        
                                      </div>
                                      
                                      
                                 <script type="text/javascript">
                                    <!--
                                    var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
                                    //-->
                                    </script>
                                    
                                    </div>
            
           					<div class="clear"></div>
           
          				</div>
                        
                      </div>

                   
                         

                          <div class="payment_agree" style="padding-bottom:10px;">
                            <p>
							
                            <input type="hidden" value="<?php echo $hosting_price;?>" id="totprice">
                            <input type="checkbox" style="float:left; width:25px;" id="terms" />
                            
                            <label for="agrees_to_terms">I agree to the <a target="_blank" class="terms_link" href="<?php echo base_url();?>pages/privacy-policy">terms of service</a>.<span id="terms_warn"></span></label></p>                            
                    
                            <input type="submit" id="card" style="margin:10px 0 0 10px;" onclick="return credit_card_form_func();" value="Book it using Credit Card"  class="btn large green"></span>
                            <div id="paypal_but" style="display:none"><input type="submit" id="paypal" style="margin:10px 0 0 10px;" onclick="paypal_form();" value="Book it using Paypal"  class="btn large green"></div>
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
function credit_card_form_func()
{ 

	var caltophone=jQuery("input:radio[name=caltophone]:checked").val();
	var terms = document.getElementById("terms").checked;
	
	
	if($('#phone_no').val()==''){
		$('#terms_warn').html('<p style="color:#F00; margin-right:3px;">Please Enter Contact Phone Number.</p> ');
		return false;
	}else if(terms == true)
		{
			
			$.ajax({
			type:'POST',
			url:'site/product/edit_enquiry_details',
			data:{'rental_id':$('#rental_id').val(),'Enquiry':$('#Enquiry').val(),'caltophone':caltophone,'phone_no':$('#phone_no').val(),'enquiry_timezone':$('#enquiry_timezone').val()},
			dataType:'json',
			success:function(json){
			document.getElementById("credit_card_form").submit();
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

function paypal_form()
{

	var caltophone=jQuery("input:radio[name=caltophone]:checked").val();
	var terms = document.getElementById("terms").checked;
	var product = <?php echo $this->uri->segment(5);?>;
	var amount = $('#totprice').val();
	 if(terms == true)
		{//alert("sdds");
			$.ajax({
			type:'POST',
			url:'site/product/edit_enquiry_details',
			data:{'rental_id':$('#rental_id').val(),'Enquiry':$('#Enquiry').val(),'caltophone':caltophone,'phone_no':$('#phone_no').val(),'enquiry_timezone':$('#enquiry_timezone').val()},
			dataType:'json',
			success:function(json){
			//alert(json);
				window.location = BaseURL+"site/product/HostPayment/"+product+"/"+amount;
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
			//alert(json.val);
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

</script>

<script type="text/javascript" src="js/1.8-jquery-ui-min.js"></script>
<link rel="stylesheet" type="text/css" href="javascript/autocomplete/jquery-ui-1.8.2.custom.css" media="all" />
<script type="text/javascript" src="javascript/autocomplete/jquery-ui-1.8.2.custom.min.js"></script> 
<?php
$this->load->view('site/templates/footer');
?>