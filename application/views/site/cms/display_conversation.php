<?php
//echo '<pre>'; print_r($pageDetails->result());die;
$this->load->view('site/templates/header'); //var_dump($hostDetails->row());

$sender_id=$pageDetails->row()->sender_id;
$receiver_id=$pageDetails->row()->receiver_id;

if($UserId==$sender_id)
{
$tmp=$sender_id;
$sender_id=$receiver_id;
$receiver_id=$tmp;
}

if($sender_id==$this->data ['hostDetails']->row()->id)
{
$posted_by='host';
}
else{
$posted_by='customer';
}
//echo $pageDetails->row()->sender_id.'<br>';
//echo $receiver_id.'<br>';
//echo $posted_by;
//die;
?>


<div class="lang-en wider no-subnav thing signed-out winOS" >
 <div id="container-wrapper bg-gray" style="background:#f5f5f5">
	<div class="container ">
		<section>
	<div class="main3">
		<div class="middle_section color-white" id="content_text">
		<!-- / wrapper-content -->

				<?php 
            	if ($pageDetails->num_rows()>0){ 
				foreach($pageDetails->result() as $pageDetail){
				
				$userDetails = $this->product_model->get_all_details(USERS,array('id'=>$pageDetail->sender_id));?> 
				<?php echo '<b>'.$userDetails->row()->user_name.' : </b>';?>
		   <!--<?php echo $productDetails->row()->product_title; ?><br>
		   <img src="<?php echo base_url().'server/php/rental/'.$productDetails->row()->PImg; ?>" width="100" height="100"/>-->
           <?php echo $pageDetail->message; ?><br>
            	<?php }}
            	?>
		


	    	</div>
<div class="reply-msg">
<a data-toggle="modal" href="#inbox" onclick="return post_discussion(this)"
receiver_id="<?php echo $sender_id;?>" product_id="<?php echo $pageDetails->row()->rental_id;?>" reviewer_id="<?php  echo $receiver_id; ?>">Reply</a>&nbsp;<a href="<?php echo base_url().'inbox';?>">Back</a>
</div>			
</div>
</section>
	</div>
	<!-- / container -->
</div>

</div>

<!------------------pop up for inbox message--------------------->
<div id="inbox" class="modal in" style="overflow: hidden; display: none; " aria-hidden="false">
<div class="modal-header" style="background: none repeat scroll 0% 0% rgb(239, 239, 239); padding: 18px 10px 18px 40px;"><div ><b>Message</b><a style="float:right; padding-right: 30px;cursor: pointer;"; data-dismiss="modal"><span class="">X</span></a></div></div>
<?php if($loginCheck !=''){ echo form_open('site/product/add_reply',array('id'=>'add_discussion','style'=>'margin: 20px 40px 20px 40px'));?>
<input type="hidden" id="convId" name="convId" value="<?php echo $pageDetails->row()->convId;?>" />
<input type="hidden" id="rental_id" name="rental_id" value="" />
<input type="hidden" id="sender_id" name="sender_id" value="" />
<input type="hidden" id="receiver_id" name="receiver_id" value="" />
<input type="hidden" id="posted_by" name="posted_by" value="<?php echo $posted_by;?>" />
<input type="hidden" id="redirect" name="redirect" value="<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4);?>" />
<label></label>
<textarea  name="message" id="message" class="scroll_newdes" style="height:90px; width: 100%;" ></textarea>
<div id="message_warn"  style="float:left; color:#FF0000;"></div>
<div class="clear"></div>
<div class="field_login" style=" margin-top:10px;">
<input type="button" name="discussion" id="discussion" onclick = "return send_reply();"   style="float: right; background: none repeat scroll 0% 0% rgb(52, 129, 201); color: rgb(255, 255, 255); text-shadow: 0px 0px 0px rgb(255, 255, 255);padding: 7px 30px;" value="Send">
</div>
<?php echo form_close();}?>
</div>
<!------------------end popup for inbox message------------------->
<script type="text/javascript">
function post_discussion(evt)
{
/* alert(rental_id);
alert(sender_id);alert(receiver_id); */
$('#rental_id').val($(evt).attr('product_id'));
$('#sender_id').val($(evt).attr('reviewer_id'));
$('#receiver_id').val($(evt).attr('receiver_id'));

}

function send_reply(){
if($('#message').val()=='')
{
$('#message_warn').html('Please Enter Message');
}
else{
$('#add_discussion').submit();
}
}
</script>
<?php
$this->load->view('site/templates/footer');
?>