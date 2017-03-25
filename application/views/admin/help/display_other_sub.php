<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/cms/change_cms_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="cms_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 Page Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Type
							</th>
							<th class="tip_top" title="Click to sort">
								 Language
							</th>
							<th class="tip_top" title="Click to sort">
								Status
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($lang_detail->num_rows() > 0){
							foreach ($lang_detail->result() as $row){
							if($row->lang != 'dan') {
							$lang = $this->help_model->get_all_details(LANGUAGES,array('lang_code'=>$row->lang));
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $row->name;?>
							</td>
							<td class="center">
								<?php echo $row->type;?>
							</td>
							<td class="center">
								<?php echo $lang->row()->name;?>
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $Pages)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/help/change_other_sub_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/help/change_other_sub_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $Listspace)){?>
								<span><a class="action-icons c-edit" href="admin/help/edit_sub_menu/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
								

							<?php if ($allPrev == '1' || in_array('3', $Listspace)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/help/delete_sub_menu/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
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
								 Page Name
							</th>
							<th>
								Type
							</th>
							<th>
								Language
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