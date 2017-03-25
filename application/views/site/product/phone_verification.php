<?php 
$this->load->view('site/templates/header');
$this->load->view('site/templates/listing_head_side');
?>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>addProperty.js"></script>
         
            <div class="right_side">
			<div class="verify-phones23"><a href="javascript:;" onclick="phone_verfication()">Verify via sms</a></div>
			<div id="verification_div" style="display:none;">
			<input type="text" value="" name="mobile_verification_code" id="mobile_verification_code">
			<input type="button" onclick="check_phpone_verification()" value="Verify">
			</div>
			
			
            </div>
            </div>
</div>
<script type="text/javascript">
function DeleteListYoutProperty(val){
	
	var res = window.confirm('Are you sure?');
	if(res){
		window.location.href = 'site/product/delete_property_details/'+val;
	}else{
		
		return false;
	}
}
function phone_verfication()
{
/*  $.ajax({
type:'POST',
url:'<?php echo base_url()?>site/twilio/product_verification',
success:function(response)
{
if(response=='success')
{
alert('We Have Sent Verification Code to Your Mobile Please Enter Verification Code');
 $('#verification_div').css('display','block');
}
}
});  */

if('<?php echo $hosting_commission_status->row()->status?>'=='Inactive')
{
window.location='<?php echo base_url()?>site/product/redirect_base/completed';
}
else{
window.location='<?php echo base_url()?>site/product/redirect_base/payment/<?php echo $listDetail->row()->id;?>';
}

}

function check_phpone_verification()
{
 mobile_verification_code=$('#mobile_verification_code').val();
$.ajax({
type:'POST',
url:'<?php echo base_url()?>site/product/check_phpone_verification',
data:{product_id:'<?php echo $listDetail->row()->id;?>',mobile_verification_code:mobile_verification_code},
success:function(response)
{ 
if(response=='success')
{
window.location='<?php echo base_url()?>site/product/redirect_base/payment/<?php echo $listDetail->row()->id;?>';
 }
else{
sweetAlert("Oops...", "Verification Code Does not match Please enter Correct Code", "error");
}

}
}); 

}
</script>   
<!---DASHBOARD-->
<?php
//$this->load->view('site/templates/listing_footer');
 $this->load->view('site/templates/footer');
?>