<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/users/change_user_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $Members)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $Members)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						
						<div class="btn_30_light" style="height: 29px;">
								<a href="admin/users/export_user_details"  class="tipTop" title="Click Export All User Details"><span class="icon cross_co"></span><span class="btn_link">Export All User</span></a>
							</div>
							
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
								 First Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Last Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Email
							</th>
							
							<th class="tip_top" title="Click to sort">
								image
							</th>
							<th class="tip_top" title="Click to sort">
								Verify							</th>
 							<th class="tip_top" title="Click to sort">
								Created Date
							</th>
 							<?php /* <th class="tip_top" title="Click to sort">
								Last Login
							</th>
							<th class="tip_top" title="Click to sort">
								Last Login IP
							</th> */ ?>
							<th class="tip_top" title="Click to sort">
								Time Zone
							</th>
						
							<th class="tip_top" title="Click to sort">
								Status
							</th>
							<!---<th class="tip_top" title="Click to sort">
								Host
							</th>--->
							<th width="12%">
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($usersList->num_rows() > 0){
							//echo "<pre>"; print_r($usersList->result()); die;
							foreach ($usersList->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center" style="text-transform:capitalize;">
								<?php echo $row->firstname;?>
							</td>
							<td class="center" style="text-transform:capitalize;">
								<?php echo $row->lastname;?>
							</td>
							<td class="center">
								<?php echo $row->email; ?>
							</td>
							<td class="center">
							<div class="widget_thumb">
							<?php if($row->loginUserType == 'google'){ ?>
								<img class="rollovereff" width="40px" height="40px" src="<?php echo $row->image;?>" />
							<?php } else if ($row->image != ''){?>
								 <img class="rollovereff" width="40px" height="40px" src="<?php echo base_url();?>images/users/<?php echo $row->image;?>" />
							<?php }else {?>
								 <img class="rollovereff" width="40px" height="40px" src="<?php echo base_url();?>images/users/user-thumb1.png" />
							<?php }?>
							</div>
							</td>
							<td class="center">
								<!--<?php echo $row->name;?>-->
								<?php 
								
								//$modeid = (trim($row->is_verified) == 'Yes')?'0':'1';
								$modeid = ($row->is_verified == 'Yes')?'0':'1';
								if ($modeid == '0'){	
						
								?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/users/verify_user_status/<?php echo $modeid;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->is_verified;?>
								
								</span></a>
								<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/users/verify_user_status/<?php echo $modeid;?>/<?php echo $row->id;?>')"><span class="badge_style">No</span></a>
							<?php 
								}
							?>
							
							

								</td>
							<td class="center">
								 <?php echo date("Y-m-d",strtotime($row->created));?>
							</td>
                          <?php  /*  <td class="center">
								 <?php echo date("Y-m-d",strtotime($row->last_login_date));?>
							</td>
							<td class="center">
								<?php echo $row->last_login_ip;?>
							</td> */ ?>
							
							<td class="center">
								<?php echo $row->timezone;?>
							</td>
							
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $Members)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/users/change_user_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/users/change_user_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							
							<!---<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $Members)){
								$mode = ($row->host_status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/users/change_user_status1/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->host_status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/users/change_user_status1/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->host_status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->host_status;?></span>
							<?php }?>
							</td>--->
							
							
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $Members)){?>
								<span><a class="action-icons c-edit" href="admin/users/edit_user_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/users/view_user/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $Members)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/users/delete_user/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php }?>
							</td>
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
							<th>
								 First Name
							</th>
							<th>
								 Last Name
							</th>
							<th>
								 Email
							</th>
							<th>
								image
							</th>
							<th >
								Verify		
							</th>
							
 							<th>
								User Created Date
							</th>
 							<?php /* <th>
								Last Login Date
							</th>*/ ?>
							<th>
								Time Zone
							</th> 
							<th>
								Status
							</th>
							<!--<th>
								Host
							</th>-->
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