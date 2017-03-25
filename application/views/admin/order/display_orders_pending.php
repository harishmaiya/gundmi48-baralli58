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
                            <th class="tip_top" title="Click to sort">
								 S No
							</th>
							<th class="tip_top" title="Click to sort">
								 User Email
							</th>
                            <th class="tip_top" title="Click to sort">
								 Payment Date		
							</th>
							<th class="tip_top" title="Click to sort">
								 Booking No
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

						</tr>
						</thead>
						<tbody>
						<?php 
						if ($orderList->num_rows() > 0){ $i=1;
							foreach ($orderList->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
                            <td class="center">
								<?php //echo $row->id;
								      echo $i;
								?>
							</td>
							<td class="center">
								<?php echo $row->email;?>
							</td>
   							<td class="center">
								<?php echo $row->created;?>
							</td>

							<td class="center">
								<?php 
								//echo $row->dealCodeNumber;
								echo $row->bookingno;
								?>
							</td>
							<td class="center">
							 <?php echo $admin_currency_symbol.' '.$row->total;?>
							</td>
							<td class="center">
								 <?php echo ($row->payment_type=="Credit Cart")?"Credit Card":$row->payment_type;?>
							</td>
							<td class="center">
							<span class="badge_style b_pending"><?php echo $row->status;?></span>
							</td>
							
						</tr>
                        
						<?php 
							$i++; }
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
                            <th>
                            	S No
                            </th>
							<th>
								 User Email
                            </th>
							<th>
								 Payment Date
							</th>
							<th>
								 Booking No
							</th>
                            <th>
                            	Total
                            </th>
                            <th>
                            	Payment Type
                            </th>
                            <th>
								Status
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