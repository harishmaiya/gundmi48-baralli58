<?php if($requestType == 'booking_request') {?><div class="service-copmity">
<ul>
		<li>
			<span id="bookingdate">
			<?php //echo $total_value;?>
			<?php echo  "Booking for"; ?> <?php echo $total_nights;?> <?php if($total_nights == 1){echo 'Night';} else {if($this->lang->line('night') != '') { echo stripslashes($this->lang->line('night')); } else echo "Nights"; }?><?php if($longTermString != '')echo "</br>(".$longTermString.")";?></span>
			<label class="price"><?php echo $this->session->userdata('currency_s'); ?></label>
			<label id="bookingsubtot"><?php echo $total_value;?>
			</label>
		</li>
		<?php if($taxString!='No Tax' && $taxValue!='0.00') { ?>
		<li>
			<span><?php if($this->lang->line('service_fee') != '') { echo stripslashes($this->lang->line('service_fee')); } else echo "Service Fee"; ?></span>
			<label class="price"><?php echo $this->session->userdata('currency_s'); ?></label>
			<label class="table-cell-price" id="service_tax" >
				<center><p style="font-size:14px"><?php echo CurrencyValue($product_id,$taxString);?></p></center>
			</label>
		</li>
		<?php } ?>
		<p id="servicetax"  style="display:none;"><?php echo $commissionType; ?></p>
		<p id="taxtype" name="taxtype" style="display:none;"><?php echo $commissionValue; ?></p>
		<li>
			<span><?php if($this->lang->line('total') != '') { echo stripslashes($this->lang->line('total')); } else echo "Total"; ?></span>
			<label class="price"> <?php echo $this->session->userdata('currency_s'); ?></label>
			<label  class="table-cell-price"><?php echo $net_total_string;?></label>
			<input id="bookingtot" type="hidden" value="<?php echo $net_total_value;?>" />
			<input id="subTotal" type="hidden" value="<?php echo $subTotal;?>" />
			<input id="stax" type="hidden" value="<?php echo $taxValue;?>" />
		</li>
	</ul>
</div>
<div class="submit-link">
	  <?php if($loginCheck==''){?>

              <a class="booking-btn login-popup"  href="javascript:void(0);"><?php if($this->lang->line('book_now') != '') { echo stripslashes($this->lang->line('book_now')); } else echo "Book Now"; ?></a>

              <?php }else{ ?>

             <a class="booking-btn" onclick="return  BookingIt_new();" href="javascript:void(0);"><?php 
		if($this->lang->line('book_now') != '') {
		echo stripslashes($this->lang->line('book_now')); 
		} 
		else 
		echo "Book Now"; ?></a>
          <?php } ?>
		
</div>

<?php } else if($requestType == 'contact_host') { ?>
	<input id="bookingtotContact" type="hidden" value="<?php echo $net_total_value;?>" />
	<input id="subTotal" type="hidden" value="<?php echo $subTotal;?>" />
	<input id="staxContact" type="hidden" value="<?php echo $taxValue;?>" />
<?php }?>