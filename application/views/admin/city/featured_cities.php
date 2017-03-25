<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/city/change_city_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
					</div>
					<div class="widget_content">
						<table class="display" id="newsletter_tbl">
						<thead>
						<tr>
                        	
                            <th class="tip_top" title="Click to sort">
								City Name							
                            </th>
							<th class="tip_top" title="Click to sort">
								 State Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Country Name
							</th>
                            <th>
								Status
							</th>
							<th>
								View Order
							</th>
							<th>
								Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($cityList->num_rows() > 0){
							foreach ($cityList->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
                                <?php 
							     echo ucfirst($row->name);if($row->featured=='1'){echo '  <img src="images/checked.png" class="tip_top" title="Featured Neighborhood" />';}
								?>
							</td>
							<td class="center tr_select ">
                                <?php echo ucfirst($row->state_name); ?>
							</td>
							<td class="center tr_select ">
                                <?php 
							     echo ucfirst($row->country_name);
								?>
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $City)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/city/change_featured_city_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/city/change_featured_city_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center tr_select ">
                                <input type="number" onchange="save_order(this.value, <?php echo $row->id;?>);" onkeypress="check_click(event);" value="<?php echo $row->view_order;?>"/>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $City)){?>
								<span><a class="action-icons c-edit" href="admin/city/edit_city_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/city/view_city/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $City)){
							?>
                            	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/city/delete_city/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php  }?>
							</td>
						</tr>
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
							<tr>
                            
							<th >
								 City Name
							</th>
							<th>
								 State Name
							</th>
							<th>
								 Country Name
							</th>
                            <th>
								Status
							</th>
							<th>
								View Order
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
	</div>
</div>
<script>
function check_click(evt) {
	event.preventDefault();
}

function save_order(value, id) {
    $.ajax(
	{
		type: 'POST',
		url: baseURL+'admin/city/save_list_order',
		data:{'value':value,'id':id},
		success: function(data) 
		{
			
		}
	});
}
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>