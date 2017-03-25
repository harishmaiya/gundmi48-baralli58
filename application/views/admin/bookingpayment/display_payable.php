<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>


<script>
function saveTrans(bookval,i) {
var BookNo = bookval;
var netamt =  document.getElementById('netamt-'+i).value;
var transid = document.getElementById('transid-'+i).value;
var transdate  = document.getElementById('transdate-'+i).value;
var transtype =document.getElementById('transtype-'+i).value;
var Prdid =document.getElementById('Prdid-'+i).value;
var hostid =document.getElementById('hostid-'+i).value;
//alert(transtype);

$.ajax({
			type:'post',
			url:baseURL+'admin/bookingpayment/hostpayable',
			data:{'BookNo':BookNo,'netamt':netamt,'transid':transid,'transdate':transdate,'transtype':transtype,'hostid':hostid,'Prdid':Prdid},
			dataType:'json',
			success:function(json){
				alert(json);
				//$('#prdiii').val(json.resultval);
				
				//window.location.hash=json.resultval;
				
			}
		});


}
</script>

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
								Booking No		
							</th>
							<th class="tip_top" title="Click to sort">
								Property ID 
							</th>
							<!--<th>
								Guest Email
							</th>
                            <th>
                            	Guest Contact
                            </th>-->
							<th>
                            	Check In 
                            </th>
							<th>
								Check Out
							</th>
							<th>
                            	Amount
                            </th>
                            <th>
                            	Transaction Id
                            </th>
							<th>
                            	Transaction Date
                            </th>
							<th>
                            	Transaction Method
                            </th>
							<th>
                            	Action
                            </th>
                            
                            
						</tr>
						</thead>
						<tbody>
						<?php 
						//echo '<pre>'; print_r($newbookingList->result_array());
						if ($newbookingList->num_rows() > 0){
						$i=1;
							foreach ($newbookingList->result() as $row){
						?>
						<tr>
							<!--<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>-->
                            <td class="center">
								<?php echo $i;?>
							</td>
							<td class="center">
								<?php echo $row->Bookingno;?>
							</td>

							<td class="center">
								<?php echo $row->prd_id;?>
							</td>
							
							<td class="center">
								<?php echo date('d-m-Y',strtotime($row->checkin));?>
							</td>
							
							<td class="center">
								<?php echo date('d-m-Y',strtotime($row->checkout));?>
							</td>
							
							<?php
							//$totalAmount = ($row->numofdates*$row->price);
							$totalAmount = $row->totalAmt - $row->serviceFee;;
							
							if($guest_tax_type == 'flat'){
										$gCommision = $guest_tax_value;
							}else{
									$gCommision = number_format(($totalAmount*$guest_tax_value)/100,2);
							}
							
							if($host_tax_type == 'flat'){
										$hCommision = $host_tax_value;
							}else{
									$hCommision = number_format(($totalAmount*$host_tax_value)/100,2);
							}
							
							$netamout = number_format($row->totalAmt-($gCommision+$hCommision),2)
							?>
							<td class="center">
								<?php echo number_format($row->totalAmt-($gCommision+$hCommision),2);?>
							</td>
							
							
							<?php 
							
							$hostpaiddetail = $this->account_model->get_all_details(HOSTPAYMENT,array('bookingId'=>$row->Bookingno));
							//echo '<pre>'; print_r($hostpaiddetail->result_array()); 
							?>
							
							
							<td class="center">
								<?php //echo $row->transaction_id;?>
								<input type="text" name="transid" id="transid-<?php echo $i;?>" value="<?php echo ($hostpaiddetail->row()->txn_id!='')?$hostpaiddetail->row()->txn_id:""; ?>" />
							</td>
							
							<td class="center">
								<?php //echo date('d-m-Y',strtotime($row->transaction_date));?>
								<input type="text" name="transdate" id="transdate-<?php echo $i;?>" value="<?php echo ($hostpaiddetail->row()->txt_date!='')?$hostpaiddetail->row()->txt_date:""; ?>" />
							</td>
							
							<td class="center">
								<!-- Paypal -->
								<input type="text" name="transtype" id="transtype-<?php echo $i;?>" value="<?php echo ($hostpaiddetail->row()->txn_type!='')?$hostpaiddetail->row()->txn_type:""; ?>" />
								<input type="hidden" name="netamt" id="netamt-<?php echo $i;?>" value="<?php echo $netamout; ?>" />
								<input type="hidden" name="hostid" id="hostid-<?php echo $i;?>" value="<?php echo $row->sell_id; ?>" />
								<input type="hidden" name="Prdid" id="Prdid-<?php echo $i;?>" value="<?php echo $row->PrdID; ?>" />
							</td>
							
							<td class="center">
								<!-- Paypal -->
								<a style="cursor:pointer" onclick="saveTrans('<?php echo $row->Bookingno; ?>','<?php echo $i;?>');">Save</a> 
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
								Booking No		
							</th>
							<th class="tip_top" title="Click to sort">
								Property ID 
							</th>
							<!--<th>
								Guest Email
							</th>
                            <th>
                            	Guest Contact
                            </th>-->
							<th>
                            	Check In 
                            </th>
							<th>
								Check Out
							</th>
							 <th>
                            	Amount
                            </th>
                            <th>
                            	Transaction Id
                            </th>
							<th>
                            	Transaction Date
                            </th>
							<th>
                            	Transaction Method
                            </th>
							<th>
                            	Action
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