<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open(ADMIN_PATH.'/currency/change_currency_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<!--<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $Currency)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $Currency)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>-->
					</div>
					<div class="widget_content">
						<table class="display" id="currency_tbl">
						<thead>
						<tr>
							
							<th class="tip_top" title="Click to sort">
								 Country Name
							</th>
                            <th class="tip_top" title="Click to sort">
								Currency Symbol
							</th> 
                            <th class="tip_top" title="Click to sort">
								Currency Rate
							</th> 
                            <th class="tip_top" title="Click to sort">
								Currency Type
							</th>
                            <th>
								Status
							</th>
							<th>
								Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($currencyList->num_rows() > 0){
							foreach ($currencyList->result() as $row){
						?>
						<tr>
							
							<td class="center  tr_select">
								<?php echo $row->country_name;?>
							</td>
                             <td class="center tr_select ">
                                <?php echo $row->currency_symbols;?>
							</td>
                            <td class="center tr_select ">
                                <?php echo $row->currency_rate;?>
							</td>
                            <td class="center"> 
                                <?php echo $row->currency_type;?>
							</td>
							<?php if($row->default_currency == 'Yes'){?>
							<td></td><td></td>
							<?php } else {?>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $Currency)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to InActive" class="tip_top" href="javascript:confirm_status('<?php echo ADMIN_PATH;?>/currency/change_currency_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to Active" class="tip_top" href="javascript:confirm_status('<?php echo ADMIN_PATH;?>/currency/change_currency_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $Currency)){?>
								<span><a class="action-icons c-edit" href="<?php echo ADMIN_PATH;?>/currency/edit_currency_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="<?php echo ADMIN_PATH;?>/currency/view_currency/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $Currency)){
							
							if($row->status!='Active'){
						
							?>
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('<?php echo ADMIN_PATH;?>/currency/delete_currency/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php } }?>
							</td>
							<?php } ?>
						</tr>
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							
							<th class="tip_top" title="Click to sort">
								 Country Name
							</th>
                            <th class="center" title="Click to sort">
								Currency Symbol
							</th> 
                            <th class="center" title="Click to sort">
								Currency Rate
							</th> 
                            <th>
								Currency Type
							</th>
                            <th>
								Status
							</th>
							<th>
								Action
							</th>
						</tr></tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
		</form>	
			
		</div>
		<span class="clear"></span>
	</div></div>
	<script type="text/javascript">
$('#currency_tbl').dataTable({   
	"aoColumnDefs": [
	                 { "bSortable": false, "aTargets": [5] }
	                 ],
	                 "aaSorting": [[3, 'desc']],
	                 "sPaginationType": "full_numbers",
	                 "iDisplayLength": 100,
	                 "oLanguage": {
	                	 "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
	                 },
	                 "sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
	                	 
});
</script>
<style>
#currency_tbl tr td,#currency_tbl tr th{
	border-right:#ccc 1px solid;
}
</style>

<?php 
$this->load->view('admin/templates/footer.php');
?>