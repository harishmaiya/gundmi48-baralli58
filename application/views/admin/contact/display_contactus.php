<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/contact_us/change_contact_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6>CONTACT DETAILS</h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php 
						if ($allPrev == '1' || in_array('3', $Contact_Us)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
						
					</div>
					<div class="widget_content">
						<table class="display" id="language_tbl">
						<thead>
						<tr>
							<th class="center">                          
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">                               
							</th>
							<th class="tip_top" title="Click to sort">
								 Name
							</th>
                            <th class="tip_top" title="Click to sort">
								Email<!--<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">-->
							</th>
                            <th class="tip_top" title="Click to sort">
								Subject
							</th>							
							<th class="tip_top" title="Click to sort">
								 Message
							</th>
							<th class="tip_top" title="Click to sort">
							Date Added
							</th>
							<?php /*?></th>   
<th class="tip_top" title="Click to sort">
								Status
							</th>	*/?>						
							<th>
								 Action
							</th>  							
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($admin_contactus->num_rows() > 0){
							foreach ($admin_contactus->result() as $row){
						?>
						<tr>
                        	<td class="center tr_select ">
                             <?php if($row->lang_code != 'en') {?>
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
                                <?php } ?>
							</td>							
							<td class="center  tr_select">
								<?php echo $row->name;?>
							</td>
                            <td class="center  tr_select">
								<?php echo $row->email;?>
							</td>
							<td class="center  tr_select">
								<?php echo $row->subject;?>
							</td>
							<td class="center  tr_select">
								<?php echo $row->message;?>
							</td>
                            
                          <?php /*?>  <td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $multilang)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/multilanguage/change_language_status/<?php echo $row->status;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/multilanguage/change_language_status/<?php echo $row->status;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td> 
							
							<!--<td class="center">
							<?php 
							
							if ($allPrev == '1' || in_array('2', $multilang)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/newsletter/change_subscribers_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/newsletter/change_subscribers_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>-->*/?>
							<td class="center">
								<?php echo $row->dateAdded;?>
							</td>
							
							<td class="center">
								<?php if ($allPrev == '1' || in_array('2', $attribute)){?>
                            <span><a class="action-icons c-edit" href="admin/contact_us/replaymail/<?php echo $row->id; ?>" title="Reply">Reply</a></span>
							<?php }?>
							<?php if ($allPrev == '1' || in_array('3', $attribute)){?>	
							<span><a class="action-icons c-delete" href="admin/contact_us/change_contact_status/<?php echo $row->id; ?>" title="Delete">Delete</a></span>
							   <?php /*?><a class="action-icons c-delete" href="javascript:confirm_delete('admin/contact_us/display_contactus')" title="Delete">Delete</a></span>*/ ?>
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
								 Name
							</th>
							<th>
								Email<!--<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">-->
							</th>
                             <th>
								Subject
							</th>
							<th>
							Message
							</th>
							<th>
							Date Added
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