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
								Total amount
							</th>
							<th class="tip_top" title="Click to sort">
								Guest Service Fee
							</th>
							<th class="tip_top" title="Click to sort">
								Sub admin amount
							</th>
							<th class="tip_top" title="Click to sort">
								 Paid Transaction Id
							</th>
							<th>
								Options
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($booking_details->num_rows() > 0){
							$i=1;
							//echo "<pre>"; print_r($booking_details->result()); die;
							foreach ($booking_details->result() as  $value){
							$details = $value;
						?>
						<tr>
							<td class="center">
								<?php echo $i;?>
							</td >
							<td class="center">
								<?php echo $value->Bookingno;?>
							</td>
							
							<td class="center">
								<?php echo $admin_currency_symbol.' '.AdminCurrencyValue($value->prd_id,$value->totalAmt);?>
							</td>
							<td class="center">
								<?php echo $admin_currency_symbol.' '.AdminCurrencyValue($value->prd_id,$value->serviceFee);?>
							</td>
							<td class="center">
								<?php echo $admin_currency_symbol.' '.AdminCurrencyValue($value->prd_id,$value->sub_admin_fee); ?>
							</td>
							<td class="center">
								<?php 
								if($value->sub_paid_txt_id != '')
									echo $value->sub_paid_txt_id;
								else
									echo "-";
								?>
							</td>
							
							<td class="center">
								<?php if( $value->sub_paid_status !='Paid' ){?>
								<span class="action_link"><a class="p_approve tipTop" href="admin/subadmin/pay_subadmin/<?php echo $value->Bookingno;?>" title="Pay balance due">Pay</a></span>
								<?php }else{ ?>
								<span class="action_link">Paid</span>
								<?php } ?>
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
								Total amount
							</th>
							<th class="tip_top" title="Click to sort">
								Guest Service Fee
							</th>
							<th class="tip_top" title="Click to sort">
								Sub admin amount
							</th>
							<th class="tip_top" title="Click to sort">
								 Paid Transaction Id
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