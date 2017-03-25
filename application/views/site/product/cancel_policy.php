<?php 

$this->load->view('site/templates/header');

$this->load->view('site/templates/listing_head_side');



	$can_policy="";

	$roombedVal=json_decode($listValues->row()->rooms_bed);

	$can_policy=$roombedVal->can_policy;
	//print_r($listDetail->result()); die;
?>
<script type="text/javascript">
        var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        function IsNumeric(e) {
		
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1 || keyCode == 9);
            document.getElementById("error").style.display = ret ? "none" : "inline";
            return ret;
        }
    </script>

<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>addProperty.js"></script>

         

            <div class="right_side cancelation">

            
			<form method="post" action="cancel_policy_save/<?php echo $listDetail->row()->id;?>">
            <div class="dashboard_price_main">

			<?php if($this->lang->line('Pleaseselectyour') != '') { echo stripslashes($this->lang->line('Pleaseselectyour')); } else echo "Please select your cancellation policy. You can read more about the cancellation policy"; ?> <a target="_blank" href="<?php echo 'pages/'.$cancellation_policy->row()->seourl;?>"><?php if($this->lang->line('here') != '') { echo stripslashes($this->lang->line('here')); } else echo "here"; ?> </a>.

           <?php //echo stripslashes($cancellation_policy->row()->description);?>

            </div>

			<div class="cancelation-text dashboard_price_main">

			<label><?php if($this->lang->line('CancellationPolicy') != '') { echo stripslashes($this->lang->line('CancellationPolicy')); } else echo "Cancellation Policy"; ?></label>

			<?php  //echo $listDetail->row()->cancellation_policy;?>

			<select name="cancellation_policy" onchange="javascript:Detailview(this,<?php echo $listDetail->row()->id; ?>,'cancellation_policy');">

			<option value = ""><?php if($this->lang->line('Select') != '') { echo stripslashes($this->lang->line('Select')); } else echo "Select"; ?></option>

			

			<?php

									  if($can_policy!=""){ 

										$can_policyArr=@explode(',',$can_policy);

										foreach($can_policyArr as $rows){

									  ?>

									

									 <option value="<?php echo $rows; ?>"<?php if($listDetail->row()->cancellation_policy == $rows) {echo 'selected="selected"';} ?>>

											<?php echo $rows; ?>

										</option>

									  <?php 

										}

									  } 

									?>

			</select><br>

			<label><?php if($this->lang->line('SecurityDeposit') != '') { echo stripslashes($this->lang->line('SecurityDeposit')); } else echo "Security Deposit"; ?></label>

			<?php if($listDetail->row()->currency != ''){

						$currency_type=$listDetail->row()->currency;

						$currency_symbol_query='SELECT * FROM '.CURRENCY.' WHERE currency_type="'.$currency_type.'"';

						$currency_symbol=$this->product_model->ExecuteQuery($currency_symbol_query);

	

						if($currency_symbol->num_rows() > 0)

						{

							$currency_sym = $currency_symbol->row()->currency_symbols;

						}

						else{

							$currency_sym = '$';

						}

						?>

						

							<span class="WebRupee"><?php echo $currency_sym; ?></span>

						<?php } else { ?>

							<span class="WebRupee">$</span>

						<?php } ?>

			<input type="text" value="<?php echo $listDetail->row()->security_deposit;?>" class="per_amount_scroll"  name="security_deposit" onchange="javascript:Detailview(this,<?php echo $listDetail->row()->id; ?>,'security_deposit');" onkeypress="return IsNumeric(event);" 
			onpaste="return false;" ondrop = "return false;"/>
			<span id="error" style="color: Red; display: none" >* Input digits (0 - 9)</span>

			</div>
			<span class="onclk-text"><?php if($this->lang->line('add_seo') != '') { echo stripslashes($this->lang->line('add_seo')); } else echo "Want to add SEO tags?"; ?>&nbsp;<span onclick="show_block_cate('1')"><?php if($this->lang->line('youcanadd') != '') { echo stripslashes($this->lang->line('youcanadd')); } else echo "You can add."; ?></span></span>
			
			<div class="dashboard_price_main" id="monthly" style="display:none" >

				<div class="overview_title">
                        
                        	<label><?php if($this->lang->line('meta_title') != '') { echo stripslashes($this->lang->line('meta_title')); } else echo "Meta Title";?></label>
                        
                        	<input type="text" id="meta_name" value="<?php echo $listDetail->row()->meta_title;?>" placeholder="<?php if($this->lang->line('meta_title') != '') { echo stripslashes($this->lang->line('meta_title')); } else echo "Meta Title";?>" class="title_overview" 
                           onchange="javascript:Detailview(this,<?php echo $listDetail->row()->id; ?>,'meta_title');" name="meta_title" style="color:#000 !important;" />
                            
                            <input type="hidden" id="id" name="id" value="<?php echo $listDetail->row()->id; ?>" />
                            
                            <!--<span>35 characters left</span>-->
                        
                        </div>
                        
                        
                        <div class="overview_title">
                        
                        	<label><?php if($this->lang->line('keywords') != '') { echo stripslashes($this->lang->line('keywords')); } else echo "Keywords";?></label>
                            
                            <textarea class="title_overview"  placeholder="<?php if($this->lang->line('Maximum150words') != '') { echo stripslashes($this->lang->line('Maximum150words')); } else echo "Maximum 150 words";?>" rows="8"  onchange="javascript:Detailview(this,<?php echo $listDetail->row()->id; ?>,'meta_keyword');"  name="meta_keyword" id="meta_keyword" style="color:#000 !important;"><?php echo strip_tags($listDetail->row()->meta_keyword);?></textarea>
                        </div>
						
						<div class="overview_title">
                        
                        	<label><?php if($this->lang->line('MetaDescription') != '') { echo stripslashes($this->lang->line('MetaDescription')); } else echo "Meta Description";?></label>
                            
                            <textarea class="title_overview" placeholder="<?php if($this->lang->line('Maximum150words') != '') { echo stripslashes($this->lang->line('Maximum150words')); } else echo "Maximum 150 words";?>" rows="8"  onchange="javascript:Detailview(this,<?php echo $listDetail->row()->id; ?>,'meta_description');"  name="meta_description" id="meta_description" style="color:#000 !important;"><?php echo strip_tags($listDetail->row()->meta_description);?></textarea>
                        </div>

			</div>
			 <input type="submit"  value="<?php if($this->lang->line('save') != '') { echo stripslashes($this->lang->line('save')); } else echo "Save"; ?>" class="newline-btn" /> 
			 <!-- <input type="button"  class="prev btn-primary btn-sm" name="prev" id="prev"  value="Previous" >  -->
	</form>
          </div>

           

        </div>

        

    </div>

<script type="text/javascript">

function DeleteListYoutProperty(val){

	//$('#delete_profile_image').disable();

	var res = window.confirm('Are you sure?');

	if(res){

		window.location.href = 'site/product/delete_property_details/'+val;

	}else{

		//$('#delete_profile_image').removeAttr('disabled');

		return false;

	}

}
$(document).ready(function(){
var meta_name=$('#meta_name').val();
var meta_description=$('#meta_description').val();
var meta_keyword=$('#meta_keyword').val();
if((meta_name=='')||(meta_description=='')||(meta_keyword=='')){

$(".onclk-text").css("display","block");

   $("#monthly").css("display","none");
}
else{
$(".onclk-text").css("display","none");

   $("#monthly").css("display","block");
}
});
function show_block_cate(columin_id)

{

  $(".onclk-text").css("display","none");

   $("#monthly").css("display","block");  

}


</script> 

<!--<script language="Javascript" type="text/javascript">

       function onlyNumbersWithDot(e) {           
            var charCode;
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
    </script>-->
<script>
	
	$(".prev").click(function(){
				window.location='<?php echo base_url()?>address_listing/<?php echo $this->uri->segment(2,0); ?>';
		});
	</script>	

<!---DASHBOARD--> 

<?php

$this->load->view('site/templates/footer');

?>