<?php 
$this->load->view('admin/templates/header.php');
extract($privileges);

$base_id = $this->uri->segment(4);
$base_product_id = $this->product_model->get_all_details(BASE_PRODUCT,array('product_id'=>$base_id.','))->row();
//print_r($base_product_id); die;
$prd_res_id = explode(',',rtrim($base_product_id->product_id,','));
//echo $id.'asfdasfadsfsd'; die;
 $id = $prd_res_id[0];

				$this->data['Steps_title1'] = $this->product_model->get_selected_fields_records('id',PRODUCT,' where id='.$id.' and description =""');
				
				$this->data['Steps_price1'] = $this->product_model->get_selected_fields_records('id',PRODUCT,' where id='.$id.' and price ="0.00"');
				
				
				$this->data['Steps_calendar1'] = $this->product_model->get_selected_fields_records('id',PRODUCT,' where id='.$id.' and calendar_checked =""');
				$this->data['Steps_img'] = $this->product_model->get_selected_fields_records('id',PRODUCT_PHOTOS,' where product_id='.$id);
				$this->data['Steps_ament1'] = $this->product_model->get_selected_fields_records('id',PRODUCT,' where id='.$id.' and list_name =""');
				$this->data['Steps_address1'] = $this->product_model->get_selected_fields_records('id,lat',PRODUCT_ADDRESS_NEW,' where productId='.$id);
				
				$this->data['Steps_list1'] = $this->product_model->get_selected_fields_records('id',PRODUCT,' where id='.$id.' and listings =""');
				
				$this->data['Steps_cancel1'] = $this->product_model->get_selected_fields_records('id',PRODUCT,' where id='.$id.' and cancellation_policy ="" and security_deposit =""'); 
				
				$this->data['calendar_shedule'] = $this->product_model->get_selected_fields_records('data','schedule',' where id='.$id.'');
				
				if($this->data['Steps_title1']->num_rows() > 0){
					$this->data['Steps_count11']=1;
				}
				if($this->data['Steps_price1']->num_rows() > 0){
		
					$this->data['Steps_count21']=1;
				}
				if($this->data['Steps_calendar1']->num_rows() > 0){
					$this->data['Steps_count31']=1;
				}
				if($this->data['Steps_img']->num_rows() > 0){
				
				} else {
					$this->data['Steps_count41']=1;
				}
				if($this->data['Steps_ament1']->num_rows() > 0){
					$this->data['Steps_count51']=1;
				}
				if($this->data['Steps_address1']->num_rows() > 0 && $this->data['Steps_address1']->row()->lat != '0.00' && $this->data['Steps_address1']->row()->lang != '0.00'){
				} else {
				
					$this->data['Steps_count61']=1;
				}
				if($this->data['Steps_list1']->num_rows() > 0){
					$this->data['Steps_count71']=1;
				}
				if($this->data['Steps_cancel1']->num_rows() > 0){
					$this->data['Steps_count81']=1;
				}
				
				$this->data['Steps_tot_add']=$this->data['Steps_count11']+$this->data['Steps_count21']+$this->data['Steps_count31']+$this->data['Steps_count41']+$this->data['Steps_count51']+$this->data['Steps_count61']+$this->data['Steps_count71']+$this->data['Steps_count81'];
			
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/product/change_product_status_globalbase',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $Properties)){
						if($this->data['Steps_tot_add'] == 0) { ?>
						
							<!--<div class="btn_30_light" style="height: 29px;">
								<a href="admin/product/add_product_form_slip/<?php echo $this->uri->segment(4);?>"  class="tipTop" ><span class="icon accept_co"></span><span class="btn_link">Add New Property</span></a>
							</div>-->
							
						<?php 
						} } ?>
						
						<?php if ($allPrev == '1' || in_array('2', $Properties)){?>
							<!--<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Publish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Publish</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('UnPublish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">UnPublish</span></a>
							</div>-->
						<?php 
						}
/* 						$avl_rooms = $this->db->query('select sum(room_value) as room_value ,numof_rooms  from '.PRODUCT.' where base_id='.$base_id);
						$avl_rooms = $avl_rooms->row()->numof_rooms - $avl_rooms->row()->room_value; */
						if($product_count<$room_count) {?>
							<div class="btn_30_light" style="height: 29px;"><a href="javascript:void(0)" onclick="getproduct('<?php echo $base_id; ?>');" class="tipTop" title="Add Listing"><span class="icon accept_co"></span><span class="btn_link">Add Listing</span></a></div>
						<?php } else { ?><div class="btn_30_light" style="height: 29px;"><a href="javascript:void(0);" class="tipTop"><span class="icon accept_co"></span><span class="btn_link">No Listing to add</span></a></div> <?php } ?>
						<?php 
						if ($allPrev == '1' || in_array('3', $Properties)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="subadmin_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 Property  Name
							</th>
							<th class="tip_top" title="Click to sort">
								Property Type 
							</th>
							<!--<th class="tip_top" title="Click to sort">
								Price
							</th>-->
							<th class="tip_top" title="Click to sort">
								Added By
							</th>
<!--							<th class="tip_top" title="Click to sort">
								Order
							</th>
                             <th class="tip_top" title="Click to sort">
								comments
							</th>-->
							<th class="tip_top" title="Click to sort">
								Status
							</th> 
							<th class="tip_top" title="Click to sort">
								Created On
							</th>
							
							<!--<th class="tip_top" title="Click to sort">
								Slip Link
							</th>-->
							<th width="15%">
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($productList->num_rows() > 0){
							foreach ($productList->result() as $row){
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
								<?php echo ucfirst($row->hotel_name);
								  
								?>
							</td>
							<td class="center">
						 		
								 <?php echo ucfirst($row->room_type);?>
								
							<!--</td>
							<td class="center">
								<?php echo $row->price;?>
							</td>-->
							<td class="center">
								<?php
								$user_base = $this->uri->segment(4); 
								//$user_IDS = $this->product_model->get_all_details(BASE_PRODUCT,array('id'=>$user_base))->row();
								$user_IDS = $this->product_model->get_all_details(BASE_PRODUCT,array('product_id'=>$user_base.','))->row();
                               $user_details =  $this->product_model->get_all_details(USERS,array('id'=>$user_IDS->user_id))->row();								
								if ($user_details->firstname != ''){
									echo '<b>'.$user_details->firstname.'</b> ('.$user_details->lastname.')';
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
							
							<!--<td class="center">
							
								
								<a href="<?php echo base_url();?>rental/<?php echo $row->id;?>" target="_blank" >Click here</a>
								
							</td>-->
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $Properties)){?>
								<span><a class="action-icons c-edit" href="admin/product/add_product_form/<?php echo $row->id;?>/edit/<?php echo $row->base_id; ?>" title="Edit">Edit</a></span>
                                <!--<span><a class="action-icons1 c1-edit1" href="javascript:confirm_delete('admin/product/delete_product/<?php echo $row->id;?>')" title="Calender">Delete</a></span>-->
                                
       <span><a class='iframe' href="<?php echo base_url();?>admin/product/view_calendar/<?php echo $row->id;?>/<?php echo $row->price;?>"><span style="margin-bottom:-10px;" class="action-icons1 c1-edit1 tipTop" title="Calender"></span></a></span>                         
                                
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/product/view_product/<?php echo $row->id;?>" title="View">View</a></span>
                                <span>
                                <a class="iframe cboxElement action-icons c-search" href="https://maps.google.com/?q=<?php echo $row->latitude;?>,<?php echo $row->longitude;?>&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=<?php echo $row->latitude;?>,<?php echo $row->longitude;?>&amp;output=embed" title="Map">Map</a>
                                </span>
							<?php if ($allPrev == '1' || in_array('3', $Properties)){
							
							if($row->id!=$row->base_id) {?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/product/delete_sub_product/<?php echo $row->id.'/'.$row->base_id;?>')" title="Delete">Delete</a></span>
							<?php }
							}
							?>
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
								 Property Name
							</th>
							<th><span class="tip_top">Property Type</span></th>
					         <!-- <th>
								Price
							</th>-->
							<th>
								Added By
							</th>
<!--							<th>
								Order
							</th>
 							<th>
								Comments
							</th>
							<th>
								Status
							</th> -->
							<th>
								Created On
							</th>
							
							<!--<th>
								Slip Link
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
function getproduct(id)
{
var base_url = '<?php echo base_url(); ?>';
$.ajax({
		type: 'POST',
		url: base_url+'admin/product/check_base_product',
		data:{'id':id},
		success:function(data){
		 var obj = jQuery.parseJSON(data);
		//alert(JSON.stringify(data));
		if(obj.success==0)
		{
		alert(obj.message);
		window.location.href = "<?php echo base_url(); ?>admin/product/add_product_form/"+id+"/edit/"+id;
		}else{
		window.location.href = "<?php echo base_url(); ?>admin/product/add_another/"+id;
		}
		}
	});

}
</script>

<?php 
$this->load->view('admin/templates/footer.php');
?>




