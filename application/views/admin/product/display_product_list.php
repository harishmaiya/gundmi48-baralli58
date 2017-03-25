<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/product/change_product_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
		
						
						<?php if ($allPrev == '1' || in_array('2', $Properties)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Publish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Publish</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('UnPublish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">UnPublish</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $Properties)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="productlist_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 S.No
							</th>
							<th class="tip_top" title="Click to sort">
								 Property Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Property Id
							</th>
							<th class="tip_top" title="Click to sort">
								Price
							</th>
							<th class="tip_top" title="Click to sort">
								Added By
							</th>
							<th class="tip_top" title="Click to sort">
								Status
							</th>
							<th class="tip_top" title="Click to sort">
								Created On
							</th>
							<th class="tip_top" title="Click to sort">
								Property Link
							</th>
							<th width="15%">
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$i = 0;
						if ($productList->num_rows() > 0){
							foreach ($productList->result() as $row){
								$i++;
								$img = 'dummyProductImage.jpg';
								$imgArr = explode(',', $row->PImg);
								if (count($imgArr)>0){
									foreach ($imgArr as $imgRow){
										if ($imgRow != ''){
											$img = $imgRow;
											break;
										}
									}
								}
								
								
								
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $i;
								  
								?>
							</td>
							<td class="center">
								<?php echo ucfirst($row->product_title);
								  
								?>
							</td>
							<td class="center">
						 		
								 <?php echo $row->id;?>
								
							</td>
							<td class="center">
								<?php echo $admin_currency_symbol.' '.AdminCurrencyValue($row->id ,$row->price);?>
							</td>
							<td class="center">
								<?php 
								if ($row->firstname != ''){
									echo '<b>'.$row->firstname.'</b> ('.$row->lastname.')';
								}else {
									echo 'Admin';
								}
								?>
							</td>
						
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $Properties)){
								$mode = ($row->status == 'Publish')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/product/change_product_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/product/change_product_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center">
								<?php echo $row->created;?>
							</td>
							<td class="center">
							
								
								<a href="<?php echo base_url();?>rental/<?php echo $row->id;?>" target="_blank" >Click here</a>
								
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $Properties)){?>
								<span><a class="action-icons c-edit" href="admin/product/add_product_form/<?php echo $row->id;?>/edit" title="Edit">Edit</a></span>
								<span><a class='iframe' href="<?php echo base_url();?>admin/product/view_calendar/<?php echo $row->id;?>"><span style="margin-bottom:-10px;" class="action-icons1 c1-edit1 tipTop" title="Calender"></span></a></span>                         
                                
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/product/view_product/<?php echo $row->id;?>" title="View">View</a></span>
                                <span>
                                <a class="iframe cboxElement action-icons c-search" href="https://maps.google.com/?q=<?php echo $row->latitude;?>,<?php echo $row->longitude;?>&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=<?php echo $row->latitude;?>,<?php echo $row->longitude;?>&amp;output=embed" title="Map">Map</a>
                                </span>
							<?php if ($allPrev == '1' || in_array('3', $Properties)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/product/delete_product/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php }?>
                             <?php  if ($allPrev == '1' || in_array('2', $Properties)){?>
                            <?php if($row->featured=='UnFeatured'){ ?>
                            <span id="feature_<?php echo $row->id;?>"><a class="c-unfeatured" href="javascript:ChangeFeatured('Featured','<?php echo $row->id;?>')" title="Click To Featured">Un-Featured</a></span>
                            <?php }else{ ?>
                            <span id="feature_<?php echo $row->id;?>"><a class="c-featured" href="javascript:ChangeFeatured('UnFeatured','<?php echo $row->id;?>')" title="Click To Un-Featured" >Featured</a></span>
                            <?php } ?>
                           
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
								 S.No
							</th>
							<th>
								 Property Name
							</th>
							<th><span class="tip_top">Property Id</span></th>
					  <th>
								Price
							</th>
							<th>
								Added By
							</th>
<!--							<th>
								Order
							</th>
 							<th>
								Comments
							</th>
 -->							<th>
								Status
							</th>
							<th>
								Created On
							</th>
							<th>
								Property Link
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

<script type="text/javascript">     
function search_category()
{
	
	var city = $('#search_city').val();
	var status = $('#search_status').val();
	var checkin = $('#search_checkin').val();
	var checkout = $('#search_checkout').val();
	var id = $('#search_renters').val();
	window.location.href = "<?php echo base_url();?>admin/product/display_product_list?status="+status+"&city="+city+"&checkin="+checkin+"&checkout="+checkout+"&id="+id;
	$_GET['status'],$_GET['city'],$_GET['checkin'],$_GET['checkout'],$_GET['id']
}
</script>

<?php 
$this->load->view('admin/templates/footer.php');
?>




