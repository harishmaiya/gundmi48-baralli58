<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="commission_tbl">
						<thead>
						<tr>
							<th class="tip_top" title="Click to sort">
								SNo.
							</th>
							<th class="tip_top" title="Click to sort">
								Booking No
							</th>
							<th class="tip_top" title="Click to sort">
								Host email
							</th>
							<th class="tip_top" title="Click to sort">
								Total amount
							</th>
							<th class="tip_top" title="Click to sort">
								Discount amount
							</th>
							<th class="tip_top" title="Click to sort">
								Paid amount
							</th>
							<th class="tip_top" title="Click to sort">
								Guest Service amount
							</th>
							<th class="tip_top" title="Click to sort">
								Host Service amount
							</th>
							<th class="tip_top" title="Click to sort">
								Profit
							</th>
							<th class="tip_top" title="Click to sort">
								Amount to Host
							</th>
							<th class="tip_top" title="Click to sort">
								Paid
							</th>
							<th class="tip_top" title="Click to sort">
								Balance
							</th>
							<th>
								Options
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if (count($trackingDetails) > 0){
							$i=1;
							foreach ($trackingDetails as $key => $value){
							$details = $value;
						?>
						<tr>
							<td>
								<?php echo $i;?>
							</td>
							<td>
								<?php echo $key;?>
							</td>
							<td>
								<?php echo $details['email'];?>
							</td>
							<td>
								<?php echo $admin_currency_symbol.' '.$details['total_amount'];?>
							</td>
							<td>
								<?php if($details['discount_amount'] != 0.00) {
									$total_amount = str_replace(',','',$details['total_amount']);
									$discount_amount = str_replace(',','',$details['discount_amount']);
									echo $admin_currency_symbol.' '.number_format($total_amount-$discount_amount, 2);
								} else echo '-';?>
							</td>
							<td>
								<?php if($details['discount_amount'] != 0.00)echo $admin_currency_symbol.' '.$details['discount_amount'];else echo $admin_currency_symbol.' '.$details['total_amount'];?>
							</td>
							<td>
								<?php echo $admin_currency_symbol.' '.$details['guest_fee'];?>
							</td>
							<td>
								<?php echo $admin_currency_symbol.' '.$details['host_fee'];?>
							</td>
							<td>
								<?php echo $admin_currency_symbol.' '.($details['guest_fee']+$details['host_fee']);?>
							</td>
							<td>
								<?php echo $admin_currency_symbol.' '.$details['payable_amount'];?>
							</td>
							<td>
								<?php 
								if( $details['paid_status'] =='yes' )
								  echo $admin_currency_symbol.' '.$details['payable_amount'];
								else
                                  echo 0.00;					
								?>
							</td>
							<td>
								<?php 
								if( $details['paid_status'] !='yes' )
								  echo $admin_currency_symbol.' '.$details['payable_amount'];
								else
                                  echo 0.00;								
								?>
							</td>
							<td>
								<?php if( $details['paid_status'] !='yes' ){?>
								<span class="action_link"><a class="p_approve tipTop" href="admin/commission/add_pay_form/<?php echo $details['id'];?>" title="Pay balance due">Pay</a></span>
								<?php }?>
							</td>
						</tr>
						<?php 
						$i++;
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th class="tip_top" title="Click to sort">
								SNo.
							</th>
							<th class="tip_top" title="Click to sort">
								Booking No
							</th>
							<th class="tip_top" title="Click to sort">
								Host email
							</th>
                            <th class="tip_top" title="Click to sort">
								Total amount
							</th>
                            <th class="tip_top" title="Click to sort">
								Discount amount
							</th>
                            <th class="tip_top" title="Click to sort">
								Paid amount
							</th>
							<th class="tip_top" title="Click to sort">
								Guest Service amount
							</th>
							<th class="tip_top" title="Click to sort">
								Host Service amount
							</th>
							<th class="tip_top" title="Click to sort">
								Profit
							</th>
							<th class="tip_top" title="Click to sort">
								Amount to Host
							</th>
							<th class="tip_top" title="Click to sort">
								Paid
							</th>
							<th class="tip_top" title="Click to sort">
								Balance
							</th>
							<th>
								Options
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>