<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/earnings/change_commission_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						if ($allPrev == '1' || in_array('3', $Commission)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
					
						<?php }?>
						
							
						</div>
					</div>
					<div class="widget_content">
						<table class="display" id="userListTbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 Commission Type
							</th>
							<th class="tip_top" title="Click to sort">
								 Commission Fees
							</th>
							
 							<th class="tip_top" title="Click to sort">
								Created Date
							</th>
 							
							<th class="tip_top" title="Click to sort">
								Status
							</th>
							<th width="12%">
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($commissionList->num_rows() > 0){
							foreach ($commissionList->result() as $row){
							if($row->commission_type!='Host Accept The Reservation Request'){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center" style="text-transform:capitalize;">
								<?php echo $row->commission_type;?>
							</td>
							<td class="center" style="text-transform:capitalize;">
								<?php echo $row->commission_percentage; if($row->promotion_type=='percentage'){echo '%';}?>
							</td>
							
						<td class="center">
								 <?php echo date("Y-m-d",strtotime($row->created));?>
							</td>
                            
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $Commission)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/earnings/change_commission_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/earnings/change_commission_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $Commission)){?>
								<span><a class="action-icons c-edit" href="admin/earnings/edit_earning_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
								
							</td>
						</tr>
						<?php 
							}
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th>
								 Commission Type
							</th>
							<th>
								 Commission Fees
							</th>
							
 							<th>
							  Created Date
							</th>
 							
							<th>
								Status
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