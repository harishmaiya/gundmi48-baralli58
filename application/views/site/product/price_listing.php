<?php
$this->load->view('site/templates/header');
$this->load->view('site/templates/listing_head_side');
?>
<script src="js/site/addProperty.js"></script>
<script type="text/javascript">
function Visibility() {
	$('.price_text_links').css('display','none');
	document.getElementById('monthly').style.display = "block";
	return false;
}
</script>
<!--<script>

$(document).ready(function () {
  //called when key is pressed in textbox
  $("#price").keypress(function (e)
  
  {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeout("slow");
               return false;
    }
	else {
	  $("#errmsg").html("Digits Only").hide().fadeout("slow");
	}
   });
});
</script> -->     
      
<script>

$(document).ready(function () {
  //called when key is pressed in textbox
  $("#price_perweek").keypress(function (e)
  
  {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeout("slow");
               return false;
    }
	else {
	  $("#errmsg").html("Digits Only").hide().fadeout("slow");
	}
   });
});
</script> 
<script>

$(document).ready(function () {
  //called when key is pressed in textbox
  $("#price_permonth").keypress(function (e)
  
  {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeout("slow");
               return false;
    }
	else {
	  $("#errmsg").html("Digits Only").hide().fadeout("slow");
	}
   });
});
</script>           
  <div class="right_side lan-heit price-listing">
            
            <div class="dashboard_price_main">
            
            	<div class="dashboard_price">
            		<div style="float:right; color:#FF0000;" id="imgmsg_<?php echo $listDetail->row()->id; ?>"></div>
					 <span style="float:right; color:#FF0000;"id="errmsg" color="red"></span>
                        
                    <div class="dashboard_price_left">
                    
                    	<h3><?php if($this->lang->line('BasePrice') != '') { echo stripslashes($this->lang->line('BasePrice')); } else echo "Base Price";?></h3>
                        
                        <p><?php if($this->lang->line('Atitleandsummary') != '') { echo stripslashes($this->lang->line('Atitleandsummary')); } else echo "Set the default nightly price guests will see for your listing.";?> </p>
                    
                    </div>
                    <form id="pricelist" name="pricelist" action="site/product/savePriceList" method="post">
                    <div class="dashboard_price_right">
                    
                    	<label><?php if($this->lang->line('Pernight') != '') { echo stripslashes($this->lang->line('Pernight')); } else echo "Per night";?></label>
                        
                        <div class="amoutnt-container">
						<?php if($currentCurrency == '') { ?>
                        <span class="WebRupee"><?php echo $currencyDetail->row()->currency_symbols; ?></span>
                        <?php } else { ?>
						<span class="WebRupee"><?php echo $currentCurrency;?></span>
						<?php } ?>
                        	<input type="text" id="price" value="<?php if($listDetail->row()->price !='0.00'){echo $listDetail->row()->price;}?>" class="per_amount_scroll"  name="price" onkeypress="return onlyNumbersWithDot(event);" onchange="javascript:Detailview(this,<?php echo $listDetail->row()->id; ?>,'price');" />
							
                           
                            <input type="hidden" id="id" name="id" value="<?php echo $listDetail->row()->id; ?>" />
							
                        </div>
                        <div id="priceErr" style='color:red;width:100px;'></div>
                        <div class="dashboard_currency">
                        
                        	<label><?php if($this->lang->line('Currency') != '') { echo stripslashes($this->lang->line('Currency')); } else echo "Currency";?></label>
                            
                            <div class="select select-large select-block">
                            
                            	<select name="currency" id="currency" onchange="javascript:Detailview(this,<?php echo $listDetail->row()->id; ?>,'currency');get_currency_symbol(this)" >
								      <!--<option value="">select</option>-->
    
                                      <?php foreach($currencyDetail->result() as $currency) { ?>
                                      <option value="<?php echo $currency->currency_type;?>" <?php if($listDetail->row()->currency == $currency->currency_type) echo 'selected="selected"';?>><?php echo $currency->currency_type;?></option>
                                    <?php } ?>
                                    
                                  </select>
                            
                            
                            </div>
                        
                        
                        </div>
                   
                    
                    </div>
                   
                </form>



                </div>
                
                
                
            
            </div>
			<?php //echo $listDetail->row()->price_perweek; 
			if($listDetail->row()->price_perweek=='0.00'){ ?>
            <span class="onclk-text"><?php if($this->lang->line('Wanttooffer') != '') { echo stripslashes($this->lang->line('Wanttooffer')); } else echo "Want to offer a discount for longer stays?";$nbsb;?> 
			<span onclick="show_block_cate('1')" style="padding-left: 3px;"><?php if($this->lang->line('Youcan') != '') { echo stripslashes($this->lang->line('Youcan')); } else echo "You can also set weekly and monthly prices.";?> </span></span>
			
            
            <?php }
			
			$display = ($listDetail->row()->price_perweek==0) ? "none" : "block";
			
			
			
			 ?>
            <div class="dashboard_price_main" id="monthly" style="display:<?php echo $display; ?>" >
            
            	<div class="dashboard_price">
            
                    <div class="dashboard_price_left">
                    
                    	<h3><?php if($this->lang->line('LongTermPrices') != '') { echo stripslashes($this->lang->line('LongTermPrices')); } else echo "Long-Term Prices";?></h3>
                        
                        <p><?php if($this->lang->line('Atitleandsummary') != '') { echo stripslashes($this->lang->line('Atitleandsummary')); } else echo "A title and summary displayed on your public listing page.";?> </p>
                    
                    </div>
                    <form id="pricelist" name="pricelist" action="site/product/savePriceList" method="post">
                    <div class="dashboard_price_right">
                    
                    	<label><?php if($this->lang->line('PerWeek') != '') { echo stripslashes($this->lang->line('PerWeek')); } else echo "Per Week";?></label>
                        
                      <div class="amoutnt-container">
                        
                        <?php if($currentCurrency == '') {?>
                        <span class="WebRupee"><?php echo $currencyDetail->row()->currency_symbols; ?></span>
                        <?php } else {?>
						<span class="WebRupee"><?php echo $currentCurrency;?></span>
						<?php } ?>
                        <?php //echo $listDetail->row()->price_perweek;?>
                        	<input type="text" value="<?php if($listDetail->row()->price_perweek != '0.00')echo $listDetail->row()->price_perweek;?>" class="per_amount_scroll" id="price_perweek" name="price_perweek" onkeypress="return submitPrice(event);" onchange="javascript:Detailview(this,<?php echo $listDetail->row()->id; ?>,'price_perweek');" />
                            
                            <input type="hidden" id="id" name="id" value="<?php echo $listDetail->row()->id; ?>" />
                        
                        </div>
                        
                   
                        
                        
                        <label><?php if($this->lang->line('PerMonth') != '') { echo stripslashes($this->lang->line('PerMonth')); } else echo "Per Month";?></label>
                        
                        <div class="amoutnt-container">
                        
                        <?php if($currentCurrency == '') {?>
                        <span class="WebRupee"><?php echo $currencyDetail->row()->currency_symbols; ?></span>
                        <?php } else {?>
						<span class="WebRupee"><?php echo $currentCurrency;?></span>
						<?php } ?>
                        
                        	<input type="text" value="<?php if($listDetail->row()->price_permonth != '0.00')echo $listDetail->row()->price_permonth;?>" class="per_amount_scroll" id="price_permonth" name="price_permonth" onkeypress="return submitPrice(event);" onchange="javascript:Detailview(this,<?php echo $listDetail->row()->id; ?>,'price_permonth');" />
                            
                            <input type="hidden" id="id" name="id" value="<?php echo $listDetail->row()->id; ?>" />
                        
                        </div>
                    
                    
                    
                    </div>
                   
                </form>
                </div>
                
                
                
            
            </div>

            </div>
            
            
          
            
            
            
            
            
            <div class="calender_comments nwe">
            
            	<div class="calender_comment_content">
                
                	<!--<i class="calender_comment_content_icon"><img src="images/calender_available_icon.jpg" /></i>-->
                    
                    <div class="calender_comment_text">
                    
                    	<!--<h2><?php if($this->lang->line('Settingaprice') != '') { echo stripslashes($this->lang->line('Settingaprice')); } else echo "Setting a price";?></h2>-->
                    
                    	<!--<p><?php if($this->lang->line('Fornewlistings') != '') { echo stripslashes($this->lang->line('Fornewlistings')); } else echo "For new listings with no reviews, it's important to set a competitive price. Once you get your first booking and review, you can raise your price!";?></p>
                        
                        <p><b><?php if($this->lang->line('Thesuggestednightly') != '') { echo stripslashes($this->lang->line('Thesuggestednightly')); } else echo "The suggested nightly price tip is based on:";?></b></p>
                        
                        <ol class="calender_comment_text_list">
                        
                        	<li><?php if($this->lang->line('Seasonaltravel') != '') { echo stripslashes($this->lang->line('Seasonaltravel')); } else echo "Seasonal travel demand in your area.";?></li>
                            
                            <li><?php if($this->lang->line('Themediannightly') != '') { echo stripslashes($this->lang->line('Themediannightly')); } else echo "The median nightly price of recent bookings in your city.";?></li>
                            
                            <li><?php if($this->lang->line('Thedetailsof') != '') { echo stripslashes($this->lang->line('Thedetailsof')); } else echo "The details of your listing.";?></li>-->
                       
                        </ol>
                        
                    
                    </div>
                    
                    
                
                </div>
            
            </div>
        	
        
        </div>
        
    </div>

<!---DASHBOARD-->
<script type="text/javascript">
function get_currency_symbol(elem)
{
currency_type=$(elem).val();
$.ajax({
type:'POST',
data:{currency_type:currency_type},
dataType:'json',
url:'<?php echo base_url();?>site/product/get_currency_symbol',
success:function(response)
{
if(response['currency_symbol'] !='no')
{
$('.WebRupee').text(response['currency_symbol']);
}
}
});
}

function submitPrice(event)
{
//alert();
	var x = event.which || event.keyCode;
    if(x == 13)return false;
}

</script>

<script> 

function show_block_cate(columin_id)
{
  $(".onclk-text").css("display","none");
   $("#monthly").css("display","block");
  //$(".test-page-link"+columin_id).slideDown("slow");
}

$(window).load(function()
{
if('<?php echo  $listDetail->row()->currency;?>'=='')
{
$('#currency').val('USD');
}
});

$(function()
{
if($('.dashboard_price_main').css('display')=='block')
{
//$('.onclk-text').css('display','none');
}
});
</script>
<script language="Javascript" type="text/javascript">

        function onlyNumbersWithDot(e) {

			var enterCode = e.keyCode || e.which;
	if (enterCode === 13) { 
    //e.preventDefault();
    return false;
	}	
		
            var charCode;
			//alert(e.which); return false;
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 46)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

<?php
$this->load->view('site/templates/footer');
?>