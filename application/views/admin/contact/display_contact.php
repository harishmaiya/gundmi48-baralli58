<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>

<?php //print_r($contactList); ?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/contact/change_contact_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $contact)){?>
							<!--<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active','<?php //echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('InActive','<?php //echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">InActive</span></a>
							</div>-->
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $ContactUs)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display" id="contact_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">							</th>
							<th class="tip_top" title="Click to sort">User Name</th>
							<th class="tip_top" title="Click to sort">Rental Name</th>
							<th class="tip_top" title="Click to sort">
							Enquiry							</th>
							<th class="center" title="Click to sort">
                           Check In Date							</th>
                            <th class="center" title="Click to sort">
                            Check Out Date							</th>
                            
							<th class="center" title="Click to sort">Added Date</th>
							<th>
							Action							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if (count($contactList->num_rows()) > 0){
							foreach ($contactList->result() as $row){
						?>
						<tr>
							<td>
                            <input name="checkbox_id[]" type="checkbox"  value="<?php echo $row->id;?>" />                            </td>
							<td class="center  tr_select"><?php echo ucfirst($row->firstname).' '.ucfirst($row->lastname);?></td>
							<td class="center  tr_select"><?php echo $row->product_title; ?></td>
							<td class="center  tr_select">
								<?php echo $row->Enquiry;?>							</td>
							
                            <td class="center tr_select ">
                                <?php echo $row->checkin;?>							</td>
                             <td class="center tr_select ">
                                <?php echo $row->checkout;?>							</td>
                           
                           
							
							 <td class="center tr_select "><?php echo $row->dateAdded;?></td>
						    <td class="center">
							<?php if ($allPrev == '1' || in_array('2', $ContactUs)){?>
								<!--<span><a class="action-icons c-edit" href="admin/city/addEdit_city_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>-->
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/contact/view_contact/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $ContactUs)){
							
							if($row->status!='Active'){
							
							?>
                            	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/contact/delete_contact/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php } }?>							</td>
						</tr>
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">							</th>
							<th>User Name</th>
							<th>Rental Name</th>
							<th>
							User Name							</th>
							<th class="center">
                            Check In Date                            </th>
				     		<th>
                            Check Out Date                            </th>
                     		
							<th>Added Date</th>
							<th>
							Action							</th>
						</tr>
                        </tfoot>
						</table>
				  </div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
		</form>	
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>