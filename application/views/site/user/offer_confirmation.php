<div class="accepted-level-1">
</div>
<div class="accepted-level-2">
	<?php if($specialBookingDetails->row()->offer_approval == 'Accept') { ?>
	<h1><?php if($this->lang->line('spl_offer_accepted') != '') { echo stripslashes($this->lang->line('spl_offer_accepted')); } else{ echo "Special Offer Accepted"; }?> <span style="color:#37a86c;"><?php echo $specialBookingDetails->row()->product_title;?></span></h1>
	<?php } else if($specialBookingDetails->row()->offer_approval == 'Decline'){ ?>
	<h1><?php if($this->lang->line('spl_offer_rejected') != '') { echo stripslashes($this->lang->line('spl_offer_rejected')); } else{ echo "Special Offer Rejected"; }?> <span style="color:#37a86c;"><?php echo $specialBookingDetails->row()->product_title;?></span></h1>
	<?php } ?>
	<p><?php  if(date('Y', strtotime($specialBookingDetails->row()->checkout)) == date('Y', strtotime($specialBookingDetails->row()->checkin))){ echo date('M d', strtotime($specialBookingDetails->row()->checkin));} else {echo date('M d, Y', strtotime($specialBookingDetails->row()->checkin));}?> - <?php if(date('M', strtotime($specialBookingDetails->row()->checkout)) != date('M', strtotime($specialBookingDetails->row()->checkin))) { echo date('M d, Y', strtotime($specialBookingDetails->row()->checkout)); } else { echo date('d, Y', strtotime($specialBookingDetails->row()->checkout)); } ?>. <?php echo $specialBookingDetails->row()->NoofGuest;echo ($specialBookingDetails->row()->NoofGuest > 1)?' Guests':' Guest';?></p>
</div>
<div class="accepted-level-3">
	<h1><?php echo $this->session->userdata('currency_s');?><?php echo CurrencyValue($specialBookingDetails->row()->id, $specialBookingDetails->row()->b_totalAmt);?></h1>
</div>