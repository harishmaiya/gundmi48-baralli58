<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
//var_dump($listingvalues);die;
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/listings/change_list_types_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading; ?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php 
						if ($allPrev == '1' || in_array('3', $List)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display" id="action_tbl_view"> 
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							
							<th class="tip_top" title="Click to sort">
								  Name
							</th>

							<th class="tip_top" title="Click to sort">
								 Type
							</th>
							
							<!--<th class="tip_top" title="Click to sort">
								Label
							</th>-->

							<th class="tip_top" title="Click to sort">
								Status
							</th >
							<th class="tip_top" title="Click to sort"> Action</th>
							
							<!--<th>
								 Action
							</th>-->
						</tr>
						</thead>
						<tbody>
						<?php 
						//if ($listingvalues->num_rows() > 0){
							foreach ($listingvalues as $row){
								if (strtolower($row->name) != 'price')
								{
						?>
						<tr>
							<td class="center tr_select ">					<?php  							if($row->name != 'accommodates' && $row->name != 'can_policy'  && $row->name != 'minimum_stay') {?>
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">							<?php } ?>
							</td>
							<td class="center">
								<?php echo $row->name;?>
							</td>
							<td class="center">
								<?php echo $row->type;?>
							</td>
							
							<!--<td class="center">
								<?php echo $row->labelname;?>
							</td>-->

							<td class="center">
								<?php echo $row->status;?>
							</td>
							<td class="center">
							<?php //if($row->name !== accommodates && $row->name !== can_policy) {?>
							<?php //echo $row->name; 
							if($row->name != 'accommodates' && $row->name != 'can_policy'  && $row->name != 'minimum_stay') {?>
							<?php if ($allPrev == '1' || in_array('2', $List)){?>
								<span><a class="action-icons c-edit" href="admin/listings/add_new_attribute/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
							<?php if ($allPrev == '1' || in_array('3', $List)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/listings/delete_list/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php } }?>
							</td>
						</tr>
						<?php 
								}
							}
						//}
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
								 Type
							</th>
							
							
							<!--<th>
								Label
							</th>-->
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