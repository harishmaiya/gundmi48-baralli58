<?php 
$this->load->view('site/templates/header');
?>
<link rel="stylesheet" href="<?php echo base_url();?>css/site/datepicker.css" type="text/css">
<?php $count = 0; ?>
<script>
<?php if($unread_count != 0 ){ ?>
var unread = "<?php echo $unread_count; ?>";
$(".unread-icon").text(unread);

<?php } ?>
function sendMessage()
{    

   document.body.style.cursor='wait'; 
	var sender_id = $('#sender_id').val();
	var receiver_id = $('#receiver_id').val();
	var booking_id = $('#bookingno').val();
	var pageURL = $('#pageURL').val();
	var product_id = $('#product_id').val();
	var message_content = $('#message_content').val();
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
		sweetAlert("Oops...", "Message is required!", "error");
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
       sweetAlert("Oops...", "Your Message Contains a URL! please remove ..", "error");
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
    }else{   	
	
	var subject = $('#subject').val();
	$.ajax(
		{
			type: 'POST',
			url: "<?php echo base_url();?>site/user/send_message",
			data: {'sender_id':sender_id, 'receiver_id':receiver_id, 'booking_id':booking_id, 'product_id':product_id, 'message':message_content,'subject':subject},
			success: function(data) 
			{	
				window.location.reload();
			}
		}); 
	}	
}

$(function(){
   
   $('#message_content').bind('keypress', function(e) { 
        console.log( e.which );
		if($('#message_content').val().length == 0){
			var k = e.which;
			var ok = k >= 65 && k <= 90 || // A-Z
				k >= 97 && k <= 122 || // a-z
				k >= 48 && k <= 57; // 0-9
			
				if (!ok){
					e.preventDefault();
				}
		}
    }); 
	
	
	$('#decline-message').bind('keypress', function(e) { 
        console.log( e.which );
		if($('#decline-message').val().length == 0){
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

function confirmation(id, status)
{   document.body.style.cursor='wait';

   
	var pageURL = $('#pageURL').val();
	var booking_id = $('#bookingno').val();
	var sender_id = $('#sender_id').val();
	var receiver_id = $('#receiver_id').val();
	var booking_id = $('#bookingno').val();
	var product_id = $('#product_id').val();
	var subject = $('#subject').val();

	if(status == 'Accept' )
	{
		var message = $('#approve-message').val();
	}
	else if(status == 'Decline')
	{
		var message = $('#decline-message').val();
	}
	
    var message_content = message;
	var message_content_check = message_content.toLowerCase();
	var phoneno = /\d{3}/g;
	var emailPat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var Url = "^[A-Za-z]+://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$";
   
	if(message_content_check == '')
	{
		sweetAlert("Oops...", "Message is required!", "error");
		document.body.style.cursor='default'; 
		return false;
	}else if( phoneno.test(message_content_check) )
	{
		sweetAlert("Oops...", "Your Message contains an phone number! please remove ..", "error");
		document.body.style.cursor='default'; 
		return false;
	}else if( phoneno.test(message_content_check) )
	{
		sweetAlert("Oops...", "Your Message contains an phone number! please remove ..", "error");
		document.body.style.cursor='default'; 
		return false;
	}else if (message_content_check.match(emailPat))
	{
		sweetAlert("Oops...", "Your Message contains an email! please remove ..", "error");
		document.body.style.cursor='default'; 
		return false;
	}
	else if (message_content_check.match(Url)) {
       sweetAlert("Oops...", "Message", "error");
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
	

	if(status != 'Accept' && status != 'Decline'){
		sweetAlert("Oops...", "Select approval!", "error");
		return false;
	}
	if(status == 'Accept' )
	{
		$.ajax(
		{
			type: 'POST',
			url: "<?php echo base_url();?>site/cms/confirm_booking",
			data: {'sender_id':sender_id, 'receiver_id':receiver_id, 'booking_id':booking_id, 'product_id':product_id, 'message':message,'subject':subject, 'status':status},
			success: function(data) 
			{	
			    window.location.reload();
			}
		});
	}
	else if(status == 'Decline')
	{
		$.ajax(
		{
			type: 'POST',
			url: "<?php echo base_url();?>site/cms/confirm_booking",
			data: {'sender_id':sender_id, 'receiver_id':receiver_id, 'booking_id':booking_id, 'product_id':product_id, 'message':message,'subject':subject, 'status':status},
			success: function(data) 
			{		
				window.location.reload();
			}
		});
	}
}
</script>

<script typ="text/javascript">
	$.getScript("<?php echo base_url();?>js/site/bootstrap-datepicker.js",function(){
		var startDate = '<?php echo date('m/d/Y');?>';
		var FromEndDate = new Date();
		var ToEndDate = new Date();
		var forbiddenCheckIn=<?php echo $forbiddenCheckIn;?>;
		var forbiddenCheckOut=<?php echo $forbiddenCheckOut;?>;
		ToEndDate.setDate(ToEndDate.getDate()+365);
		$('#home_date_from').datepicker({
			beforeShowDay : function(Date){var curr_date = Date.toJSON().substring(0,10);
			if (forbiddenCheckIn.indexOf(curr_date)>-1) return false;},
			weekStart: 0,
			todayHighlight : true,
			startDate: '<?php echo date('m/d/Y');?>',
			autoclose: true
		}).on('changeDate', function(selected){
			startDate = new Date(selected.date.valueOf());
			startDate.setDate(startDate.getDate(new Date(selected.date.valueOf()))+1);
			$("#check_in_hidden").val(startDate);
			$('#home_date_to').datepicker('setStartDate', startDate);
			var startselect = $('#home_date_from').val();$("#check_in_hidden").val(startselect);
		}); 

		$('#home_date_to').datepicker({
			beforeShowDay : function(Date){var curr_date = Date.toJSON().substring(0,10);
			if (forbiddenCheckOut.indexOf(curr_date)>-1) return false;},
			weekStart: 0,
			todayHighlight : true,
			startDate: '<?php echo date('m/d/Y');?>',
			autoclose: true
		}).on('changeDate', function(selected){
			FromEndDate = new Date(selected.date.valueOf());
			FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
			$('#home_date_from').datepicker('setEndDate', FromEndDate);
			var from_select = $('#home_date_to').val();$("#check_out_hidden").val(from_select);
		});
	});
</script>
<div class="dashboard yourlisting yourlistinghome">
	<div class="top-listing-head">
		<div class="main">   
            <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard">Dashboard</a></li>
                <li class="active"><a href="<?php echo base_url();?>inbox">Inbox</a></li>
                <li><a href="<?php echo base_url();?>listing/all">Your Listing</a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming">Your Trips</a></li>
                <li><a href="<?php echo base_url();?>settings">Profile</a></li>
                <li><a href="<?php echo base_url();?>account">Account</a></li>
                <li><a href="<?php echo base_url();?>plan">Plan</a></li>
            </ul> 
		</div>
	</div>
				<?php 
				$pageURL = 'http';
				if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
				$pageURL .= "://";
				if ($_SERVER["SERVER_PORT"] != "80") {
				$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
				} else {
				$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
				}
				?>
	<div class="conversation-box">
		<div class="main">
			<h2 class="convrs">Conversation with <?php echo $receiverDetails->row()->firstname;?></h2>
			<?php if($bookingDetails->row()->renter_id != $userId && $conversationDetails->row()->status == 'Decline'){ ?>
			<div class="top-section">
            <p class="rd-color">Declined </p>
            <p>Sorry to say that your inquiry for <?php echo $bookingDetails->row()->product_title;?> was declined by the host. </p>
			<p>But don't stop now- try searching again and message a few more hosts!</p>
            <a class="rd-color" href="<?php echo base_url();?>property?city=<?php echo $bookingDetails->row()->address;?>">View Similar Listings</a>

			</div>
			<?php } else if($bookingDetails->row()->renter_id == $userId && $conversationDetails->row()->status == 'Decline'){ ?>
			<div class="top-section">
            <p class="rd-color">Declined </p>
            <p>You have declined the guest for this booking.</p>
            <p>Please make sure that your calendar and rates are up to date.</p>
            </div>
			<?php }else if($bookingDetails->row()->renter_id != $userId && $conversationDetails->row()->status == 'Accept'){ ?>
			<div class="top-section">
            <p class="gr-color">Accepted </p>
            <p>Your request for this property was accepted by Host.</p>
            <p>Kindly make a payment and contact Host through this conversation.</p>
			<?php if($bookingDetails->row()->booking_status == 'Booked') { ?>
            <a class="rd-color" href="<?php echo base_url();?>property?city=<?php echo $bookingDetails->row()->address;?>">View Similar Listings</a>
			<?php } else { ?>
			<?php } ?>
			<a class="rd-color" href="<?php echo base_url();?>site/user/confirmbooking/<?php echo $bookingDetails->row()->id;?>"><strong>Make Payment</strong></a>
			</div>
			<?php } else if($bookingDetails->row()->renter_id == $userId && $conversationDetails->row()->status == 'Accept'){ ?>
			<div class="top-section">
            <p class="gr-color">Accepted </p>
            <p>You have accepted the guest for this booking.</p>
            <p>Kindly respond to the guest to give guidance.</p>
            </div>
			<?php }?>

			<div class="col-md-8">
				<div class="top-area-convers">
					<div class="dic-area">
						<textarea id="message_content" class="fstlin-txt" placeholder="Add a Personal message here..." ></textarea>
		
						<div class="botom-botm">
							<input type="hidden" id="sender_id" value="<?php echo $sender_id;?>" />
							<input type="hidden" id="receiver_id" value="<?php echo $receiver_id;?>" />
							<input type="hidden" id="bookingno" value="<?php echo $bookingNo;?>" />
							<input type="hidden" id="product_id" value="<?php echo $productId;?>" />
							<input type="hidden" id="subject" value="<?php echo $conversationDetails->row()->subject;?>" />
							<input type="hidden" id="pageURL" value="<?php echo $pageURL;?>" />
							<input type="hidden" id="baseURL" value="<?php echo base_url();?>" />
							
							<button class="Send-message" onClick="sendMessage();">Send Message</button>
							<?php if($bookingDetails->row()->renter_id == $userId && $conversationDetails->row()->status == 'Pending' && $specialOfferCheck == 0){ ?><button  onclick="slidings()" class="Send-decline" >Pre-approve / Decline</button> <?php } 
							if($conversationDetails->row()->status != 'Pending'){$status = ($conversationDetails->row()->status == 'Accept')?'Accepted':'Declined';}?>
						</div>

						<div class="full-hat-app">
								<div class="full-hat-app-header">
                                   <div class="full-hat-app-left">
                                   	<span class="red-ares"><?php echo $bookingDetails->row()->product_title;?></span>
                                   	<span class="date-plac"><?php echo date('M d', strtotime($bookingDetails->row()->checkin));?> - <?php echo date('d, Y', strtotime($bookingDetails->row()->checkout));?>. <?php echo $bookingDetails->row()->NoofGuest;echo ($bookingDetails->row()->NoofGuest > 1)?'&nbsp;Guests':'&nbsp;Guest';?></span>


								</div>
				

								<div class="full-hat-app-right">
                                     <span class="cls-dolar"><?php echo $this->session->userdata('currency_s').' '.CurrencyValue($productId,$bookingDetails->row()->b_totalAmt); ?></span>
									 <span class="new_inclusive_tax">(Inclusive all fee)</span>

								</div>

								</div>

								<div class="aloe-div">
                               <span onclick="alowdsliding()" class="alow-thebook">Allow the guest to book</span>
                               <div class="aloe-div-opens">
                               <label>Pre-approve Booking</label>
                               <textarea class="incd-text" id="approve-message" required placeholder="Enter message.."></textarea>
                               

                               <button class="Send-message" onClick="confirmation('<?php echo $bookingDetails->row()->id;?>', 'Accept')">Pre-Approve</button>

								</div>
								</div>

						
                                   
								<div class="aloe-div">
                               <span onclick="alowdsliding2()"  class="alow-thebook">Send Offer</span>
                               <div class="aloe-div-opens2">
                               	<p class="sploffertxt">The guest will automatically be able to book your home for the chosen period and price.</p>
                               
							     <div class="form-group">
                                 	<div class="col-md-12">
											 <label for="exampleInputEmail1">Property</label>
											 <select class="form-control" id="productId_Select" onchange="ajaxDateCalculation();">
												<option value="0"><?php if($this->lang->line('pre_approve_holidan_home_select') != '') { echo stripslashes($this->lang->line('pre_approve_holidan_home_select')); } else{ echo "Select HoliDan Home"; }?></option>
												<?php foreach($products->result() as $product) { ?>
												<option <?php if($bookingDetailsSpl->row()->id == $product->id)echo 'selected="selected"';?>value="<?php echo $product->id;?>"><?php echo $product->product_title;?></option>
												<?php } ?>
											 </select>
										 </div>
									 </div>
						

									<input type="hidden" id="special_bookingNo" value="<?php echo $bookingNo;?>" />
									<input type="hidden" id="productId" value="<?php echo $productDetails->row()->id;?>" />
									<input type="hidden" id="productPrice" value="<?php echo $productDetails->row()->price;?>" />
                                     <div class="form-group">
										   <div class="col-md-4">
										 <label for="exampleInputEmail1">Check In</label>
										 <input type="text" placeholder="<?php if($this->lang->line('check_in') != '') { echo stripslashes($this->lang->line('check_in')); } else{ echo "Check-in"; }?>" id="home_date_from" onchange="ajaxDateCalculation()" class="form-control" value="<?php if($this->session->userdata ( 'specialCheckin' )) echo $this->session->userdata ( 'specialCheckin' ); ?>">
									 </div>

									   <div class="col-md-4">
										 <label for="exampleInputEmail1">Check Out</label>
										 <input type="text" placeholder="<?php if($this->lang->line('check_out') != '') { echo stripslashes($this->lang->line('check_out')); } else{ echo "Check-out"; }?>" id="home_date_to" onchange="ajaxDateCalculation()" class="form-control" value="<?php if($this->session->userdata ( 'specialCheckout' )) echo $this->session->userdata ( 'specialCheckout' ); ?>">
									 </div>


									   <div class="col-md-4">
										 <label for="exampleInputEmail1">Guest</label>
										 <select class="form-control" id="no_of_guests" onchange="ajaxDateCalculation()">
											<?php for( $i = 1; $i <= $productDetails->row()->accommodates; $i++ ) { ?>
											<option <?php if($this->session->userdata ( 'specialNoofGuest' ) && $this->session->userdata ( 'specialNoofGuest' ) == $i) echo 'selected="selected"'; ?> value="<?php echo $i;?>"><?php echo $i;?></option>
											<?php } ?>
										</select>
									 </div>
								 </div>


									<form action = "<?php echo base_url();?>site/rentals/special_booking" method="POST" id="special_booking">
									<div class="form-group" id="loadSpecialPrice">
									   
									</div>

									<div class="form-group">
									   <div class="col-md-12">
											
											  <textarea name="special_message" class="form-control" required id="offer_message" placeholder="Hey, check with this cool offer!"></textarea>
										 </div>

								   
									 </div>
									
									</form>
									<input type="hidden" value=" <?php echo number_format($bookingDetails->row()->b_totalAmt - $bookingDetails->row()->b_serviceFee , 2); ?> " id="actual_amount" />
									<button class="Send-message" id="send_offer" type="button" onclick="sendOffer( <?php echo $section_id; ?>);">Send Offer</button>
									
								</div></div>
								
								<div class="aloe-div">
                               <span onclick="alowdsliding3()"  class="alow-thebook">Tell the Guest your listing is Unavailable</span>
                                    <div class="aloe-div-opens3">
                               <label>Decline Booking</label>
                               <textarea class="incd-text" id="decline-message" required placeholder="Sorry, the list was unavailable right moment"></textarea>

                               <button class="Send-message" onClick="confirmation('<?php echo $bookingDetails->row()->id;?>','Decline')">Decline</button>

								</div></div>



						</div>
					</div> 
				</div>
				<ul class="coveraread">
				
				<?php 
				$total = $conversationDetails->num_rows();
				foreach($conversationDetails->result() as  $coversation) {
				$count++;
				if($coversation->point == '1') { ?>
				<li class="booking_msg">
				<label class="line-mesg">	Property <p> <?php echo $bookingDetails->row()->product_title;?></p> was <?php echo ($coversation->status == 'Accept')?'Accepted':'Declined';?><p> on <?php echo date('d/m/Y', strtotime($coversation->dateAdded));?></p></label>
				<span class="line-let">
					<?php  if(date('Y', strtotime($bookingDetails->row()->checkout)) == date('Y', strtotime($bookingDetails->row()->checkin))){ echo date('M d', strtotime($bookingDetails->row()->checkin));} else {echo date('M d, Y', strtotime($bookingDetails->row()->checkin));}?> - <?php if(date('M', strtotime($bookingDetails->row()->checkout)) != date('M', strtotime($bookingDetails->row()->checkin))) { echo date('M d, Y', strtotime($bookingDetails->row()->checkout)); } else { echo date('d, Y', strtotime($bookingDetails->row()->checkout)); } ?>. <?php echo $bookingDetails->row()->NoofGuest;echo ($bookingDetails->row()->NoofGuest > 1)?'Guests':'Guest';?>
					</span></li>
				<?php } if($coversation->point == '2') { 
					$this->db->select('P.id, P.product_title, P.price, MM.b_checkin, MM.b_checkout, MM.b_totalAmt, MM.b_NoofGuest, MM.b_numofdates, MM.b_serviceFee, MM.offer_accept, RQ.checkin, RQ.checkout, RQ.totalAmt, RQ.b_totalAmt as rqb_totalAmt, RQ.b_serviceFee as rqb_serviceFee, RQ.b_numofdates as rqb_numofdates, RQ.NoofGuest, RQ.offer_approval, RQ.approval');
					$this->db->from(MED_MESSAGE.' as MM');
					$this->db->join(RENTALENQUIRY.' as RQ', 'RQ.Bookingno = MM.special_booking', 'LEFT');
					$this->db->join(PRODUCT.' as P', 'P.id = MM.b_prd_id', 'LEFT');
					$this->db->where('MM.id', $coversation->id);
					$specialBookingDetails = $this->db->get();
			//	echo "<pre>";	print_r($specialBookingDetails->result());  //$specialBookingDetails->row()->offer_accept != 'Pending'
					?><?php if($userId != $coversation->senderId) { ?>
						<div class="accepted-level" id="offer_accept_level_<?php echo $coversation->id;?>">
							<?php if($specialBookingDetails->row()->offer_accept == 'Pending') { ?>
								<div class="accepted-level-msg">
									<div class="topsectionsd"><h1 class="tiledtext"><?php if($this->lang->line('special_offer') != '') { echo stripslashes($this->lang->line('special_offer')); } else echo "Special offer";?> <a href="<?php echo base_url();?>rental/<?php echo $specialBookingDetails->row()->id;?>"><span class="blscolor"><?php echo $specialBookingDetails->row()->product_title;?></span></a></h1>
									<p class="spldtext"><?php  if(date('Y', strtotime($specialBookingDetails->row()->b_checkout)) == date('Y', strtotime($specialBookingDetails->row()->b_checkin))){ echo date('F d', strtotime($specialBookingDetails->row()->b_checkin));} else {echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkin));}?> - <?php if(date('M', strtotime($specialBookingDetails->row()->b_checkout)) != date('M', strtotime($specialBookingDetails->row()->b_checkin))) { echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkout)); } else { echo date('d, Y', strtotime($specialBookingDetails->row()->b_checkout)); } ?>. <?php echo $specialBookingDetails->row()->b_NoofGuest; echo "&nbsp;";
									if($specialBookingDetails->row()->b_NoofGuest > 1){ if($this->lang->line('persons') != '') { echo stripslashes($this->lang->line('persons')); } else echo "Guests"; } else { if($this->lang->line('person') != '') { echo stripslashes($this->lang->line('person')); } else echo "Guest"; }
									?></p></div>
									
										<div class="check-in check-in-new">
										<ul>
										<li>
										<span class="check-in-txt"><?php if($this->lang->line('check_in') != '') { echo stripslashes($this->lang->line('check_in')); } else echo "Check-in";?>:</span>
										<span class="check-in-date"><?php echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkin)); ?></span>
										</li>
										<li>
										<span class="check-in-txt"><?php if($this->lang->line('check_out') != '') { echo stripslashes($this->lang->line('check_out')); } else echo "Check-out";?>:</span>
										<span class="check-in-date"><?php echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkout));?> </span>
										</li>
										<li>
										<span class="check-in-txt"><?php if($this->lang->line('nof_of_guest_only') != '') { echo stripslashes($this->lang->line('nof_of_guest_only')); } else echo "Number of guest";?>:</span>
										<span class="check-in-date"><?php echo $specialBookingDetails->row()->b_NoofGuest;?></span>
										</li>
										<li>
										<span class="check-in-txt"><p><?php echo $coversation->message;?></p></span>
										<!--<span class="check-in-date"><div class="check-rate"><?php echo $this->session->userdata('currency_s');?><?php echo round($specialBookingDetails->row()->b_totalAmt+$message->extraPrice*$this->session->userdata('currency_r'), 2);?></div></span>-->
										</li>
										</ul>

										<div class="accept-btn">

							<a class="request-trip btn2" href="javascript:void(0);" onclick="offer_confirmation('Accept','<?php echo $coversation->special_booking;?>','<?php echo $coversation->id;?>');"><?php if($this->lang->line('accept_offer') != '') { echo stripslashes($this->lang->line('accept_offer')); } else echo "Accept offer";?></a>


							<a class="deny-offer btn2" href="javascript:void(0);" onclick="offer_confirmation('Decline','<?php echo $coversation->special_booking;?>','<?php echo $coversation->id;?>');"><?php if($this->lang->line('deny_offer') != '') { echo stripslashes($this->lang->line('deny_offer')); } else echo "Deny offer";?></a>
								

										</div>
										</div>
								
								
								
								
						
								
								
							</div>	
							<div class="accepted-level-new">

								<div class="topsectionsd accepted-level-msg accepted-level-msg-1">
								<h1 class="tiledtext"><?php if($this->lang->line('request_regarding') != '') { echo stripslashes($this->lang->line('request_regarding')); } else echo "Request Regarding";?>  <a href="<?php echo base_url();?>rental/<?php echo $specialBookingDetails->row()->id;?>"><span  class="blscolor"><?php echo $specialBookingDetails->row()->product_title;?></span></a></h1>
								<p class="spldtext"><?php  if(date('Y', strtotime($specialBookingDetails->row()->b_checkout)) == date('Y', strtotime($specialBookingDetails->row()->b_checkin))){ echo date('F d', strtotime($specialBookingDetails->row()->b_checkin));} else {echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkin));}?> - <?php if(date('M', strtotime($specialBookingDetails->row()->b_checkout)) != date('M', strtotime($specialBookingDetails->row()->b_checkin))) { echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkout)); } else { echo date('d, Y', strtotime($specialBookingDetails->row()->b_checkout)); } ?>. <?php echo $specialBookingDetails->row()->b_NoofGuest;
															echo "&nbsp;";
															if($specialBookingDetails->row()->b_NoofGuest > 1){ if($this->lang->line('persons') != '') { echo stripslashes($this->lang->line('persons')); } else echo "Guests"; } else { if($this->lang->line('person') != '') { echo stripslashes($this->lang->line('person')); } else echo "Guest"; }
															?></p>
								</div>

										
										
											
								<div class="check-in check-in-new">
								<ul>
								<li>
								
								<?php if($bookingDetails->row()->totalAmt != $bookingDetails->row()->b_totalAmt || 1==1) {
								?>
								<span class="check-in-txt"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, (($specialBookingDetails->row()->rqb_totalAmt-$specialBookingDetails->row()->rqb_serviceFee)/$specialBookingDetails->row()->rqb_numofdates));?> x <?php echo $specialBookingDetails->row()->b_numofdates;?> <?php if($this->lang->line('nights') != '') { echo stripslashes($this->lang->line('nights')); } else echo "nights";?>  
									</span><span class="check-in-date" style="text-decoration: line-through;"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, ($specialBookingDetails->row()->rqb_totalAmt-$specialBookingDetails->row()->rqb_serviceFee));?> 
								</span>
								</li>
							
								<li>	<span class="check-in-txt"><?php if($this->lang->line('discount_price') != '') { echo stripslashes($this->lang->line('discount_price')); } else echo "Discount Price";?></span>
								<span class="check-in-date"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, ($specialBookingDetails->row()->b_totalAmt - $specialBookingDetails->row()->b_serviceFee));?>
								</span></li>
								<?php } else { ?>
									<li><span class="check-in-txt"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, $bookingDetails->row()->price);?> x <?php echo $bookingDetails->row()->numofdates;?> <?php if($this->lang->line('nights') != '') { echo stripslashes($this->lang->line('nights')); } else echo "nights";?>  </span>
										<span class="check-in-date"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, ($bookingDetails->row()->totalAmt - $bookingDetails->row()->serviceFee));?></span> 
									
									</li>
									<?php }?>
									<li><span class="check-in-txt"><?php if($this->lang->line('service_fee') != '') { echo stripslashes($this->lang->line('service_fee')); } else echo "Service fee";?>  </span> 
											<span class="check-in-date"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, $specialBookingDetails->row()->b_serviceFee);?>
										</span>
									</li>
									<li class="bdrtxt"><span class="check-in-txt"><?php if($this->lang->line('total') != '') { echo stripslashes($this->lang->line('total')); } else echo "Total";?>	</span> 
										<span class="check-in-date"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, $specialBookingDetails->row()->b_totalAmt+$message->extraPrice);?>
										</span>
									</li>
								</ul>
								</div>
							</div>
					
							<?php } else if($specialBookingDetails->row()->offer_accept == 'Accept' || $specialBookingDetails->row()->offer_accept == 'Decline'){ ?>
							<div class="accepted-level-1">
							
							</div>
							<div class="accepted-level-2">
								<?php if($specialBookingDetails->row()->offer_accept == 'Accept') { ?>
								<h1><?php if($this->lang->line('spl_offer_accepted') != '') { echo stripslashes($this->lang->line('spl_offer_accepted')); } else echo "Special Offer Accepted";?> <a href="<?php echo base_url();?>rental/<?php echo $specialBookingDetails->row()->id;?>"><span class="blscolor"><?php echo $specialBookingDetails->row()->product_title;?></span></a></h1>
								<?php } else if($specialBookingDetails->row()->offer_accept == 'Decline'){ ?>
								<h1><?php if($this->lang->line('spl_offer_rejected') != '') { echo stripslashes($this->lang->line('spl_offer_rejected')); } else echo "Special Offer Rejected";?> <a href="<?php echo base_url();?>rental/<?php echo $specialBookingDetails->row()->id;?>"><span class="blscolor"><?php echo $specialBookingDetails->row()->product_title;?></span></a/></h1>
								<?php } ?>
								<p><?php  if(date('Y', strtotime($specialBookingDetails->row()->b_checkout)) == date('Y', strtotime($specialBookingDetails->row()->b_checkin))){ echo date('F d', strtotime($specialBookingDetails->row()->b_checkin));} else {echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkin));}?> - <?php if(date('M', strtotime($specialBookingDetails->row()->b_checkout)) != date('M', strtotime($specialBookingDetails->row()->b_checkin))) { echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkout)); } else { echo date('d, Y', strtotime($specialBookingDetails->row()->b_checkout)); } ?>. <?php echo $specialBookingDetails->row()->b_NoofGuest;echo "&nbsp;";
								if($specialBookingDetails->row()->b_NoofGuest > 1){ if($this->lang->line('persons') != '') { echo stripslashes($this->lang->line('persons')); } else echo "Guests"; } else { if($this->lang->line('person') != '') { echo stripslashes($this->lang->line('person')); } else echo "Guest"; }
								?></p>
							</div>
							<div class="accepted-level-3">
								<h1><?php echo $this->session->userdata('currency_s');?><?php echo CurrencyValue($bookingDetails->row()->prd_id, $specialBookingDetails->row()->b_totalAmt+$message->extraPrice);?></h1>
							</div>
							
							<?php } ?>
							
							
							
							<p> </p>
							
							
							
						</div>
					<?php } if( $userId == $coversation->senderId ) { ?>
						<div class="accepted-level" id="delete_special_offer" >
							<?php if($specialBookingDetails->row()->offer_accept == 'Pending') { ?>
							<div class="accepted-level-msg">
								<h1><?php if($this->lang->line('special_offer') != '') { echo stripslashes($this->lang->line('special_offer')); } else echo "Special offer";?> <a href="<?php echo base_url();?>rental/<?php echo $specialBookingDetails->row()->id;?>"><span  class="blscolor"><?php echo $specialBookingDetails->row()->product_title;?></span></a></h1>
								<p><?php  if(date('Y', strtotime($specialBookingDetails->row()->b_checkout)) == date('Y', strtotime($specialBookingDetails->row()->b_checkin))){ echo date('F d', strtotime($specialBookingDetails->row()->b_checkin));} else {echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkin));}?> - <?php if(date('M', strtotime($specialBookingDetails->row()->b_checkout)) != date('M', strtotime($specialBookingDetails->row()->b_checkin))) { echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkout)); } else { echo date('d, Y', strtotime($specialBookingDetails->row()->b_checkout)); } ?>. <?php echo $specialBookingDetails->row()->b_NoofGuest; echo "&nbsp;";
								if($specialBookingDetails->row()->b_NoofGuest > 1){ if($this->lang->line('persons') != '') { echo stripslashes($this->lang->line('persons')); } else echo "Guests"; } else { if($this->lang->line('person') != '') { echo stripslashes($this->lang->line('person')); } else echo "Guest"; }
								?></p>
								
								<div class="check-in check-in-new">
									<ul>
									<li>
									<span class="check-in-txt"><?php if($this->lang->line('check_in') != '') { echo stripslashes($this->lang->line('check_in')); } else echo "Check-in";?>:</span>
									<span class="check-in-date"><?php echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkin)); ?></span>
									</li>
									<li>
									<span class="check-in-txt"><?php if($this->lang->line('check_out') != '') { echo stripslashes($this->lang->line('check_out')); } else echo "Check-out";?>:</span>
									<span class="check-in-date"><?php echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkout));?> </span>
									</li>
									<li>
									<span class="check-in-txt"><?php if($this->lang->line('nof_of_guest_only') != '') { echo stripslashes($this->lang->line('nof_of_guest_only')); } else echo "Number of guest";?>:</span>
									<span class="check-in-date"><?php echo $specialBookingDetails->row()->b_NoofGuest;?></span>
									</li>
								</div>
								<span class="check-in-txt"><p><?php echo $coversation->message;?></p></span>
								<!--<span class="check-in-date"><div class="check-rate"><?php echo $this->session->userdata('currency_s');?><?php echo round($specialBookingDetails->row()->b_totalAmt+$message->extraPrice*$this->session->userdata('currency_r'), 2);?></div></span>-->
								
								<?php if($bookingDetails->row()->booking_status != 'Booked') { ?>
								<div class="accept-btn " style="padding: 15px 0px;">
									<a class="request-trip btn2" href="javascript:void(0);" onclick="delete_special_offer('<?php echo $coversation->bookingNo;?>', '<?php echo $coversation->id;?>');"><?php if($this->lang->line('delete') != '') { echo stripslashes($this->lang->line('delete')); } else echo "Delete";?></a>
								</div>
								<?php } ?>
							</div>

							<div class="accepted-level-new">
				
					
								<div class="accepted-level-msg accepted-level-msg-1">
									<div class="accepted-level-msg">
										<div class="topsectionsd">
											<h1 class="tiledtext"><?php if($this->lang->line('request_regarding') != '') { echo stripslashes($this->lang->line('request_regarding')); } else echo "Request Regarding";?>  <a href="<?php echo base_url();?>rental/<?php echo $specialBookingDetails->row()->id;?>"><span class="blscolor"><?php echo $specialBookingDetails->row()->product_title;?></span></a></h1>
											<p class="spldtext"><?php  if(date('Y', strtotime($specialBookingDetails->row()->b_checkout)) == date('Y', strtotime($specialBookingDetails->row()->b_checkin))){ echo date('F d', strtotime($specialBookingDetails->row()->b_checkin));} else {echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkin));}?> - <?php if(date('M', strtotime($specialBookingDetails->row()->b_checkout)) != date('M', strtotime($specialBookingDetails->row()->b_checkin))) { echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkout)); } else { echo date('d, Y', strtotime($specialBookingDetails->row()->b_checkout)); } ?>. <?php echo $specialBookingDetails->row()->b_NoofGuest;
											echo "&nbsp;";
											if($specialBookingDetails->row()->b_NoofGuest > 1){ if($this->lang->line('persons') != '') { echo stripslashes($this->lang->line('persons')); } else echo "Guests"; } else { if($this->lang->line('person') != '') { echo stripslashes($this->lang->line('person')); } else echo "Guest"; }
											?></p>
										</div>
									</div>
								
									
								
								
									<div class="check-in check-in-new">					
										<?php if($bookingDetails->row()->totalAmt != $bookingDetails->row()->b_totalAmt || 1==1) { ?>
										<ul>
										<li>
											<span class="check-in-txt"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, (($specialBookingDetails->row()->rqb_totalAmt-$specialBookingDetails->row()->rqb_serviceFee)/$specialBookingDetails->row()->rqb_numofdates));?> x <?php echo $specialBookingDetails->row()->b_numofdates;?> <?php if($this->lang->line('nights') != '') { echo stripslashes($this->lang->line('nights')); } else echo "nights";?>  </span>
											<span class="check-in-date" style="text-decoration: line-through;"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, ($specialBookingDetails->row()->rqb_totalAmt-$specialBookingDetails->row()->rqb_serviceFee));?></span> 
										</li>
										
										<li>
											<span class="check-in-txt"><?php if($this->lang->line('discount_price') != '') { echo stripslashes($this->lang->line('discount_price')); } else echo "Discount Price";?>
											</span>
											<span class="check-in-date"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, ($specialBookingDetails->row()->b_totalAmt - $specialBookingDetails->row()->b_serviceFee));?></span>
										</li>
										<?php } else { ?>
										<li>
											<span class="check-in-txt"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, $bookingDetails->row()->price);?> x <?php echo $bookingDetails->row()->numofdates;?> <?php if($this->lang->line('nights') != '') { echo stripslashes($this->lang->line('nights')); } else echo "nights";?> 
											</span> 
											<span class="check-in-date"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, ($bookingDetails->row()->totalAmt - $bookingDetails->row()->serviceFee));?></span> 
										</li>
										<?php }?>
										<li>
											<span class="check-in-txt"><?php if($this->lang->line('service_fee') != '') { echo stripslashes($this->lang->line('service_fee')); } else echo "Service fee";?></span>  
											<span class="check-in-date"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, $specialBookingDetails->row()->b_serviceFee);?></span> 
										</li>
										
										<li>
											<span class="check-in-txt"><?php if($this->lang->line('total') != '') { echo stripslashes($this->lang->line('total')); } else echo "Total";?>	</span>
											<span class="check-in-date"><?php echo $this->session->userdata('currency_s');?> <?php echo CurrencyValue($bookingDetails->row()->prd_id, $specialBookingDetails->row()->b_totalAmt+$message->extraPrice);?></span> 
										</li>
									</div>
								</div>
							</div>
						<?php } else { ?>
							<div class="accepted-level-1">
							
							</div>
							<div class="accepted-level-2">
								<?php if($specialBookingDetails->row()->offer_accept == 'Accept') { ?>
								<h1><?php if($this->lang->line('spl_offer_accepted') != '') { echo stripslashes($this->lang->line('spl_offer_accepted')); } else echo "Special Offer Accepted";?> <a href="<?php echo base_url();?>rental/<?php echo $specialBookingDetails->row()->id;?>"><span class="blscolor"><?php echo $specialBookingDetails->row()->product_title;?></span></a></h1>
								<?php } else if($specialBookingDetails->row()->offer_accept == 'Decline'){ ?>
								<h1><?php if($this->lang->line('spl_offer_rejected') != '') { echo stripslashes($this->lang->line('spl_offer_rejected')); } else echo "Special Offer Rejected";?> <a href="<?php echo base_url();?>rental/<?php echo $specialBookingDetails->row()->id;?>"><span class="blscolor"><?php echo $specialBookingDetails->row()->product_title;?></span></a/></h1>
								<?php } ?>
								<p><?php  if(date('Y', strtotime($specialBookingDetails->row()->b_checkout)) == date('Y', strtotime($specialBookingDetails->row()->b_checkin))){ echo date('F d', strtotime($specialBookingDetails->row()->b_checkin));} else {echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkin));}?> - <?php if(date('M', strtotime($specialBookingDetails->row()->b_checkout)) != date('M', strtotime($specialBookingDetails->row()->b_checkin))) { echo date('F d, Y', strtotime($specialBookingDetails->row()->b_checkout)); } else { echo date('d, Y', strtotime($specialBookingDetails->row()->b_checkout)); } ?>. <?php echo $specialBookingDetails->row()->b_NoofGuest;echo "&nbsp;";
								if($specialBookingDetails->row()->b_NoofGuest > 1){ if($this->lang->line('persons') != '') { echo stripslashes($this->lang->line('persons')); } else echo "Guests"; } else { if($this->lang->line('person') != '') { echo stripslashes($this->lang->line('person')); } else echo "Guest"; }
								?></p>
							</div>
							<div class="accepted-level-3">
								<h1><?php echo $this->session->userdata('currency_s');?><?php echo CurrencyValue($bookingDetails->row()->prd_id, $specialBookingDetails->row()->b_totalAmt+$message->extraPrice);?></h1>
							</div>
						<?php } ?>
					</div>
					<?php } } else if($sender_id == $coversation->senderId){   ?>
					<li>
						<div class="col-xs-1"><a class="aurtors" href="<?php echo base_url();?>users/show/<?php echo $senderDetails->row()->id?>">
						<img style="border-radius: 50%; width: 32px; height: 33px;" src="<?php if($senderDetails->row()->loginUserType == 'google'){ echo $senderDetails->row()->image;} elseif($senderDetails->row()->image == '' ){ echo base_url();?>images/site/profile.png<?php } else { echo base_url().'images/users/'.$senderDetails->row()->image;}?>"></a></div>
						<div class="col-xs-11">

						
						<div class="conversation">
						<span class="ardsleft"></span>
						<span><?php echo $coversation->message;?></span>

						</div>

						<span class="span-left-area"><?php echo date('d/m/Y', strtotime($coversation->dateAdded));?> via the <label>web</label>


						</span>

						</div>
      
					</li>
					<?php } else { 
					
					if($total == $count) { ?>
					<li class="booking_msg">
				<label class="line-mesg">	Inquiry about<p> <?php echo $bookingDetails->row()->product_title;?></p></label>
				<span class="line-let">
					<?php  if(date('Y', strtotime($bookingDetails->row()->b_checkout)) == date('Y', strtotime($bookingDetails->row()->b_checkin))){ echo date('M d', strtotime($bookingDetails->row()->b_checkin));} else {echo date('M d, Y', strtotime($bookingDetails->row()->b_checkin));}?> - <?php if(date('M', strtotime($bookingDetails->row()->b_checkout)) != date('M', strtotime($bookingDetails->row()->b_checkin))) { echo date('M d, Y', strtotime($bookingDetails->row()->b_checkout)); } else { echo date('d, Y', strtotime($bookingDetails->row()->b_checkout)); } ?>. <?php echo $bookingDetails->row()->b_NoofGuest;echo ($bookingDetails->row()->b_NoofGuest > 1)?'Guests':'Guest';?>
					</span></li>
					<?php $first = 1; } ?>

					<li class="evenli">
     
						<div class="col-xs-11">

						<div class="conversation">
						<span class="ardsleft"></span>
						<span><?php echo $coversation->message;?></span>

						</div>

						<span class="span-left-area"><?php echo date('d/m/Y', strtotime($coversation->dateAdded));?> via the <label>web</label>


						</span>

						</div>
      
						<div class="col-xs-1"><a class="aurtors" href="<?php echo base_url();?>users/show/<?php echo $receiverDetails->row()->id?>">
						<img style="border-radius: 50%; width: 32px; height: 33px;" src="<?php if($receiverDetails->row()->loginUserType == 'google'){ echo $receiverDetails->row()->image;} elseif($receiverDetails->row()->image == '' ){ echo base_url();?>images/site/profile.png<?php } else { echo base_url().'images/users/'.$receiverDetails->row()->image;}?>"></a></div>
   
					</li>
					<?php } }?>
				</ul>
			</div>


    <div class="col-md-4">
    	<div class="right-artrs">
          <div class="profile-topd">
          <div class="profile-topd-left">
        <img src="<?php if($receiverDetails->row()->loginUserType == 'google'){ echo $receiverDetails->row()->image;} elseif($receiverDetails->row()->image == '' ){ echo base_url();?>images/site/profile.png<?php } else { echo base_url().'images/users/'.$receiverDetails->row()->image;}?>">
           </div>

           <div class="profile-topd-right">

           	<span><?php echo $receiverDetails->row()->firstname;?></span>
           	
           	<address><?php echo $receiverDetails->row()->address?></br> Member since <?php echo date('Y', strtotime($receiverDetails->row()->created));?></address>

           </div>

           <div class="profile-topd-middle">
           	<span>Verifications<?php //echo $receiverDetails->row()->is_verified;?></span>
           	 <ul class="verid">
			 
				
				<?php if($receiverDetails->row()->id_verified == 'Yes') {?>
           	 	<li class="verified">
					  <p>Email Address</p>
					  <label>Verified</label>
           	 	</li>
				<?php } else { ?>
           	 	<li class="not-verified">
					  <p>Email Address</p>
					  <label>Not Verified</label>
           	 	</li>
				<?php } ?>
				
				<?php if($receiverDetails->row()->ph_verified == 'Yes') {?>
           	 	<li class="verified">
					  <p>Phone number</p>
					  <label>Verified</label>
           	 	</li>
				<?php } else { ?>
           	 	<li class="not-verified">
					  <p>Phone number</p>
					  <label>Not Verified</label>
           	 	</li>
				<?php } ?>
				
				<?php if($receiverDetails->row()->is_verified == 'Yes') {?>
           	 	<li class="verified">
					  <p>Verified ID</p>
					  <label>Yes</label>
           	 	</li>
				<?php } else { ?>
           	 	<li class="not-verified">
					  <p>Verified ID</p>
					  <label>No</label>
           	 	</li>
				<?php } ?>
				
				<?php if($reviewCount > 0) {?>
           	 	<li class="verified">
				<?php } else { ?>
				<li class="not-verified">
				<?php } ?>
					  <p>Review</p>
					  <label><?php echo $reviewCount;?> review</label>
           	 	</li>


           	</ul>
           </div>

          </div>
</div>
         

    </div>


	</div>

</div>

</div>

<style>
.gr-color{
	color: rgba(0,152,0,1);
	font-weight: bold;
}

.conversation-box ul li.booking_msg{
    background: none repeat scroll 0 0 #edefed;
    border: 1px solid #ccc;
    font-size: 14px;
    padding: 12px 10px;
}

.conversation-box ul li.booking_msg span span{
    color: #acacac;
    float: left;
    width: 100%;
}
.line-mesg {
    color: #9c9c9c;
    float: left;
    font-size: 15px;
    font-weight: bold;
    margin: 0 0 9px;
    width: 100%;
}

.fstlin-txt{border:none; box-shadow:none;}

.fstlin-txt:focus{border:none; box-shadow:none;}


.line-mesg p{
    color: #ff5a5f;
    display: inline-block;
    margin: 0 0 0 8px;
}

.Send-decline {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 1px solid #bcbcbc;
    float: right;
    font-size: 14px;
    margin: 21px 10px 0 10px;
    padding: 8px;
}

.botm-radio{
    border-top: 1px solid #eeeeee;
    float: left;
    padding: 20px 0 0;
    width: 100%;
}

.botm-radio{display:none;}

.conversation-box ul.botm-radio li{float:left; width:100%; padding:0; margin:0;}

.conversation-box ul.botm-radio li input[type="radio"]{
    display: inline-block;
    margin: 0 4px;
}

.conversation-box ul.botm-radio li button{margin:0}
.conversation-box ul.botm-radio li label{display: inline-block;}

.full-hat-app{display:none;}

.loading-bar{
padding: 20px;
border: 1px solid green;


}

</style>

<script>

function slidings(){

$(".botom-botm").hide();
$(".fstlin-txt").hide();
$(".dic-area").css('padding','0');
$(".full-hat-app").slideDown();
};

function alowdsliding(){
$(".aloe-div-opens").slideToggle();
$(".aloe-div-opens2").hide();
$(".aloe-div-opens3").hide();

}


function alowdsliding2(){
$(".aloe-div-opens").hide();
$(".aloe-div-opens2").slideToggle();
$(".aloe-div-opens3").hide();

}

function alowdsliding3(){
$(".aloe-div-opens").hide();
$(".aloe-div-opens2").hide();
$(".aloe-div-opens3").slideToggle();

}

<?php if($this->session->userdata ( 'specialCheckin' ) != '' && $this->session->userdata ( 'specialCheckout' ) != ''){ ?>
$(function(){
	ajaxDateCalculation();
});
<?php } ?>

function ajaxDateCalculation()
{
	var productId = $("#productId_Select").val();
	
	if(productId == 0)
	{
		$("#productId_Select").focus();
		return false;
	}
	if($("#home_date_from").val() == '')
	{
		$("#home_date_from").focus();
		return false;
	}
	else{
		var date = $("#home_date_from").val();
	}
	
	if($("#home_date_to").val() == '')
	{
		$("#home_date_to").focus();
		return false;
	}
	else{
		var start = $("#home_date_to").val();
	}
	if($('#no_of_guests option:selected').val() == '0')
	{
		$('#no_of_guests').focus();
		return false;
	}
	
	var bookingNo = $("#special_bookingNo").val();
	var productPrice = $("#productPrice").val();
	var dateFrom = $("#home_date_from").val();
	var dateTo = $("#home_date_to").val();
	var noOfGuests = $('#no_of_guests option:selected').val();
	
	$.ajax({
		type: 'POST',
		url: baseURL+'site/rentals/ajaxDateCalculation_special',
		data:{"productId":productId,"dateFrom":dateFrom,"dateTo":dateTo,"noOfGuests":noOfGuests,"productPrice":productPrice,"bookingNo":bookingNo},
		success: function(data) 
		{
			$('#loadSpecialPrice').html(data); 
		}
	});
	
	$.ajax({
		type: 'POST',
		url: baseURL+'site/rentals/ajaxDateCalculation_specialprice',
		data:{"productId":productId,"dateFrom":dateFrom,"dateTo":dateTo,"noOfGuests":noOfGuests,"productPrice":productPrice,"bookingNo":bookingNo},
		success: function(data) 
		{

		if(data=="min_say"){

		$("#send_offer").attr("disabled", true);
		
		}else{
		$("#send_offer").attr("disabled", false);
		}

		}
	});
	
}

function sendOffer()
{
	if($('#totalPrice').length){
		//alert($('#actual_amount').val()+' + '+$('#totalPrice').val() );
		if($('#totalPrice').val() == ''){
			$('#totalPrice').focus();
			return false;
		} else if($('#offer_message').val() == ''){
			$('#offer_message').focus();
			return false;
		}else if($.trim($('#actual_amount').val()) == $.trim($('#totalPrice').val())){
			sweetAlert("Oops...", "Without change anything, the special offer won't be sent", "error");
			return false;
		} else {
			$('#special_booking').submit();
		}
	} else {
		sweetAlert("Oops...", "Kindly select valid dates", "error");
		return false;
	}
}
</script>

<?php
$this->load->view('site/templates/footer');
?>

