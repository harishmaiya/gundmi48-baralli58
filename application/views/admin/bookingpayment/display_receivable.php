<?php 
//echo '<pre>';print_r($commissionTracking->result());die;
//echo '<pre>'; print_r($service_tax); die;
$this->load->view('admin/templates/header.php');
extract($privileges);
?>

<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/order/change_order_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="subadmin_tbl">
						<thead>
						<tr>
							<!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>-->
                            <th class="tip_top" title="Click to sort">
								S No
							</th>
							<th class="tip_top" title="Click to sort">
								Date
							</th>
                            <th class="tip_top" title="Click to sort">
								Booking No		
							</th>
							<th>
                            	Host Email 
                            </th>
							<th>
								Total Amount
							</th>
							<th>
								Discount
							</th>
							<th>
								Paid
							</th>
                            <th>
								Guest Service Fee
							</th>
							<th>
								Host Service Fee
                            </th>
							<th>
                            	Net Profit
                            </th>
                            <th>
                            	Amount to Host
                            </th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($commissionTracking->num_rows() > 0){
						$i=1;
					//	echo '<pre>';print_r($commissionTracking->result());die;
							foreach ($commissionTracking->result() as $row){
						?>
						<tr>
							<td class="center">
								<?php echo $i;?>
							</td>
							<td class="center">
								<?php echo date('d-m-Y',strtotime($row->dateAdded));?>
							</td>
   							<td class="center">
								<?php echo $row->booking_no;?>
							</td>

							<td class="center">
								 <?php echo $row->host_email;?>
							</td>
							
							<td class="center">
							<?php echo $admin_currency_symbol.' '.$row->pro_total_amount;?>
							</td>
							<td class="center">
							<?php if($row->pro_discount_amount != 0.00){
								$pro_total_amount = str_replace(',', '', $row->pro_total_amount);
								$pro_discount_amount = str_replace(',', '', $row->pro_discount_amount);
								echo $admin_currency_symbol.' '. ($pro_total_amount-$pro_discount_amount); 
							} else echo '-';?>
							</td>
							<td class="center">
							<?php if($row->pro_discount_amount != 0.00) echo $admin_currency_symbol.' '. $row->pro_discount_amount; else echo $admin_currency_symbol.' '. $row->pro_total_amount;?>
							</td>
							
							<td class="center">
							<?php echo $admin_currency_symbol.' '.$row->pro_guest_fee;?>
							</td>
							
							<td class="center">
							<?php echo $admin_currency_symbol.' '.$row->pro_host_fee;?>
							</td>
							
							<td class="center">
							<?php echo $admin_currency_symbol.' '; echo $row->pro_guest_fee+$row->pro_host_fee;?>
							</td>
							
							<td class="center">
							<?php //echo $admin_currency_symbol.' '.($row->pro_payable_amount - ($row->pro_total_amount-$row->pro_discount_amount) );?>
							<?php echo $admin_currency_symbol.' '.($row->pro_payable_amount);?>
							</td>
						
						</tr>
                        
						<?php 
							$i++; }
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>-->
                            <th class="tip_top" title="Click to sort">
								S No
							</th>
							<th class="tip_top" title="Click to sort">
								Date
							</th>
                            <th class="tip_top" title="Click to sort">
								Booking No		
							</th>
							<th>
                            	Host Email 
                            </th>
							<th>
								Total Amount
							</th>
							<th>
								Discount
							</th>
							<th>
								Paid
							</th>
							<th> 
								Guest Service Fee 
							</th>
							<th>
								Host Service Fee
                            </th>      
							<th>
                            	Net Profit
                            </th>
                            <th>
                            	Amount to Host
                            </th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
			<input type="hidden" name="SubAdminEmail" id="SubAdminEmail"/>
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>