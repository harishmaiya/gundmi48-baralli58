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
								Host email
							</th>
							<th class="tip_top" title="Click to sort">
								Total orders
							</th>
							<th class="tip_top" title="Click to sort">
								Total amount
							</th>
							<th class="tip_top" title="Click to sort">
								Discounted amount
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
							//echo "<pre>"; print_r($trackingDetails); die;
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
								<?php echo $details['rowsCount'];?>
							</td>
							<td>
								<?php echo $admin_currency_symbol.' '.number_format($details['total_amount'], 2);?>
							</td>
							<td>
								<?php if($details['discount_amount'] != 0.00) {
									$total_amount = str_replace(',','',$details['total_amount']);
									$discount_amount = str_replace(',','',$details['discount_amount']);
									echo $admin_currency_symbol.' '.number_format($total_amount-$discount_amount, 2);
								} else echo '-';?>
							</td>
							<td>
								<?php if($details['discount_amount'] != 0.00)echo $admin_currency_symbol.' '.number_format($details['discount_amount'], 2);else echo $admin_currency_symbol.' '.number_format($details['total_amount'], 2);?>
							</td>
							<td>
								<?php echo $admin_currency_symbol.' '.number_format($details['guest_fee'], 2);?>
							</td>
							<td>
								<?php echo $admin_currency_symbol.' '.number_format($details['host_fee'], 2);?>
							</td>
							<td>
								<?php echo $admin_currency_symbol.' '.number_format($details['guest_fee']+$details['host_fee'], 2);?>
							</td>
							<td>
								<?php echo $admin_currency_symbol.' '.number_format($details['payable_amount'], 2);?>
							</td>
							<td>
								<?php echo $admin_currency_symbol.' '.number_format($value['paid'], 2);?>
							</td>
							<td>
								<?php echo $admin_currency_symbol.' '.number_format($details['payable_amount']-$value['paid'], 2);?>
							</td>
							<td>
								<?php if(number_format($details['payable_amount']-$value['paid'], 2) >  0.00){?>
								<span class="action_link"><a class="p_approve tipTop" target="_blank" href="admin/commission/display_commission_lists/<?php echo $details['id'];?>" title="Pay balance due">Pay</a></span>
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
								Host email
							</th>
							<th class="tip_top" title="Click to sort">
								Total orders
							</th>
							<th class="tip_top" title="Click to sort">
								Total amount
							</th>
							<th class="tip_top" title="Click to sort">
								Discounted amount
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