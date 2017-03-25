<div class="col-md-12">
	<label for="exampleInputEmail1"><?php if($this->lang->line('price') != '') { echo stripslashes($this->lang->line('price')); } else{ echo "price"; }?></label>
	<input type="hidden" name="bookingNo" value="<?php echo $bookingNo;?>" />
	<input type="hidden" name="checkIn" value="<?php echo $checkIn;?>" id="check_in_hidden"/>
	<input type="hidden" name="checkOut" value="<?php echo $checkOut;?>" id="check_out_hidden" />
	<input type="hidden" name="productId" value="<?php echo $productId;?>" />
	<input type="hidden" name="productPrice" value="<?php echo $productPrice;?>" />
	<input type="hidden" name="noOfNyts" value="<?php echo $noOfNyts;?>" />
	<input type="hidden" name="noOfGuests" value="<?php echo $noOfGuests;?>" />
	<input type="hidden" name="service_fee" value="<?php echo $service_tax;?>" />
	<div class="new_spl_offer_price">
		<span class="input-group-addon"><?php echo productSymbol($productId);?></span>
		<!--<input type="text" name="totalPrice" value="<?php echo round($totalNetPrice*$this->session->userdata('currency_r'), 2);?>" class="form-control"/>-->
		<input type="text" name="totalPrice" id="totalPrice" value="<?php echo $totalNetPrice;?>" class="form-control"/> 
		<label for="exampleInputEmail1" class="example_additional">+ Service fee apply</label>
	</div>
	
</div>