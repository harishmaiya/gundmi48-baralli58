<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open(ADMIN_PATH.'/help/change_help_status_sub_menu',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6 style="text-align: center;"><?php echo $heading?></h6>
						
						
					</div>
					<div class="widget_content">
						<table class="display" id="currency_tbl">
						<thead>
						<tr>
							
							<th class="tip_top" title="Click to sort">
								Page
							</th>
							
							<th class="tip_top" title="Click to sort">
								Title
							</th> 
							<th class="tip_top" title="Click to sort">
								Description
							</th>
							<th class="tip_top" title="Click to sort">
								Other Language
							</th>
												
                            <th class="tip_top" title="Click to sort">
								Action
							</th> 
                            
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($mainmenu->num_rows() > 0){
							foreach ($mainmenu->result() as $row){
						?>
						<tr>
							
							<td class="center  tr_select">
								<?php 
																
                           echo $row->page;?>
							</td>
							
							<td class="center  tr_select">
								<?php echo $row->title;?>
							</td>
							<td class="center  tr_select">
								<?php echo $row->description;?>
							</td>
                             <td class="center  tr_select">
								<a href="<?php echo base_url() ?>admin/space/display_lang_space/<?php echo $row->page;?>">View</a>
							</td>
                            
							<td align="center">
								
								<?php if ($allPrev == '1' || in_array('2', $Listspace)){?>
								<span><a class="action-icons c-edit" href="admin/space/edit_helplist_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
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
							
							<th class="tip_top" title="Click to sort">
								Page
							</th>
							<th class="tip_top" title="Click to sort">
								Title 
							</th>
                            
							<th class="tip_top" title="Click to sort">
								Description
							</th>
							<th class="tip_top" title="Click to sort">
								Other Language
							</th>							
                            
							<th class="tip_top" title="Click to sort">
								Action
							</th> 
                            
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
	</div></div>
	<script type="text/javascript">
$('#currency_tbl').dataTable({   
	"aoColumnDefs": [
	                 { "bSortable": false, "aTargets": [4] }
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