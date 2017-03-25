<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/multilanguage/change_multi_language_user_details',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading;?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('1', $multilang)){?>
							<div class="btn_30_light" style="height: 29px; text-align:left;">
								<a href="admin/multilanguage/add_user_language" class="tipTop" title="Click here to add new language"><span class="icon add_co"></span><span class="btn_link">Add New</span></a>
							</div>
						<?php } ?>
						<?php if ($allPrev == '1' || in_array('3', $multilang)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
				
						
						</div>
						
					</div>
					<div class="widget_content">
						<table class="display" id="user_language_tbl">
						<thead>
						<tr>
							<th class="center">                          
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">                               
							</th>
							<th class="tip_top" title="Click to sort">
								 Language Name
							</th>
                            <?php /* <th class="tip_top" title="Click to sort">
								language Code
							</th> */ ?>
                            <th>
								 Action
							</th>                            
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($language_list->num_rows() > 0){
							foreach ($language_list->result() as $row){
						?>
						<tr>
                        	<td class="center tr_select ">
                             <?php if($row->lang_code != 'en') {?>
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
                                <?php } ?>
							</td>							
							<td class="center  tr_select">
								<?php echo $row->language_name;?>
							</td>
                           <?php  /* <td class="center  tr_select">
								<?php echo $row->language_code;?>
							</td> */ ?>
                            
                            <td class="center">
                           
							<?php if ($allPrev == '1' || in_array('2', $Language)){?>
								<span><a class="action-icons c-edit" href="admin/multilanguage/edit_user_language/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>								 
							<?php if ($allPrev == '1' || in_array('3', $Language)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/multilanguage/delete_user_language/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
																
							<?php } ?>
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
								 Language Name
							</th>
							<?php /* <th>
								language Code
							</th> */ ?>
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