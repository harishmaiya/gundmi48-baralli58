<?php
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
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
                         <!--   <th class="tip_top" title="Click to sort">
								 PaymentID
							</th> -->
							<th class="tip_top" title="Click to sort">
								 Host Email
							</th>
							
							<th class="tip_top" title="Click to sort">
								 Property title
							</th>
                            <th class="tip_top" title="Click to sort">
								 Payment Date		
							</th>
							<th class="tip_top" title="Click to sort">
								 Transaction ID
							</th>
							<th>
								Total
							</th>
                            <th>
                            	Payment Type
                            </th>
                            
   							<th class="tip_top" title="Click to sort">
								Status
							</th>

						<!--	<th>
								 Action
							</th> -->
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($listingorderList->num_rows() > 0){
							foreach ($listingorderList->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
                           <!-- <td class="center">
								<?php echo $row->id;?>
							</td> -->
							<td class="center">
								<?php echo $row->email;?>
							</td>
							<td class="center">
								<?php echo $row->prd_name;?>
							</td>
							
							
							
   							<td class="center">
								<?php echo date('d-m-Y',strtotime($row->created));?>
							</td>

							<td class="center">
								<?php echo $row->txn_id;?>
							</td>
							<td class="center">
								 <?php echo $admin_currency_symbol.' '.$row->amount;?>
							</td>
							<td class="center">
								 <?php echo $row->payment_type;?>
							</td>
							<td class="center">
							<span class="badge_style b_done"><?php echo $row->payment_status;?></span>
							</td>
						<!--	<td class="center">	                            
                           		<a href="order-review/<?php echo $row->paypal_txn_id;?>" class="tipTop" title="View Comments"><span class="action-icons c-suspend" style="cursor:pointer;"></span></a>

							</td> -->
						</tr>
                        
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
                         <!--   <th class="tip_top" title="Click to sort">
								 PaymentID
							</th> -->
							<th class="tip_top" title="Click to sort">
								 Host Email
							</th>
							
							<th class="tip_top" title="Click to sort">
								 Property title
							</th>
                            <th class="tip_top" title="Click to sort">
								 Payment Date		
							</th>
							<th class="tip_top" title="Click to sort">
								 Transaction ID
							</th>
							<th>
								Total
							</th>
                            <th>
                            	Payment Type
                            </th>
                            
   							<th class="tip_top" title="Click to sort">
								Status
							</th>

							<!-- <th>
								 Action
							</th> -->
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