<script src="js/site/core.js" type="text/javascript"></script>
<script type="text/javascript">

function homeView(val){
	if($('#homelist'+val).css('display')=='block'){
		$('#homelist'+val).hide('');	
	}else{
		$('#homelist'+val).show('');
	}
}


function roomView(val){
	if($('#roomlist'+val).css('display')=='block'){
		$('#roomlist'+val).hide('');	
	}else{
		$('#roomlist'+val).show('');
	}
}

function cityView(val){
	if($('#citylist'+val).css('display')=='block'){
		$('#citylist'+val).hide('');	
	}else{
		$('#citylist'+val).show('');
	}
}

function otherView(val){
	if($('#otherlist'+val).css('display')=='block'){
		$('#otherlist'+val).hide('');	
	}else{
		$('#otherlist'+val).show('');
	}
}

function accommodatesView(val){
	if($('#accommodateslist'+val).css('display')=='block'){
		$('#accommodateslist'+val).hide('');	
	}else{
		$('#accommodateslist'+val).show('');
	}
}

function calenderView(val){
	if($('#calenderlist'+val).css('display')=='block'){
		$('#calenderlist'+val).hide('');	
	}else{
		$('#calenderlist'+val).show('');
	}
}

</script>
<?php $url = $this->uri->segment(1);?>
<div class="sub_header">
	<ul class="sub_header_left">
		<li><a class="view_listingarw" href="<?php echo base_url()."listing/all";?>"><img src="images/arw.png" style="width: 66px; padding: 8px 20px 0px 27px;"></a><div class="tools"><i class="arsd-ico"></i><span><?php if($this->lang->line('list_listingwillbe') != '') { echo stripslashes($this->lang->line('list_listingwillbe')); } else echo "The listing will be previewed after activating it in the admin."; ?></span></div></li>
		<li class="write_title"><?php if($listDetail->row()->product_title == '') echo $listDetail->row()->room_type.' in '.$listDetail->row()->city; else echo $listDetail->row()->product_title;?></li>
        <li class="prevwli" style="display:none"><a class="pre-li" href="#">Preview</a><div class="tools"><i class="arsd-ico"></i><span><?php if($this->lang->line('list_intheadmin') != '') { echo stripslashes($this->lang->line('list_intheadmin')); } else echo "The listing will be previewed after activating it in the admin."; ?></span></div></li>
    </ul>
</div>
<div class="main_2">
	<div class="manage_listing">
        <div class="left_side">
			<div class="left_side_top">
				<h2><?php if($this->lang->line('list_Basics') != '') { echo stripslashes($this->lang->line('list_Basics')); } else echo "Basics"; ?></h2>
                <ul class="left_side_1">
                	<li <?php if($url == 'manage_listing') echo 'class="active"';?>><a href="<?php echo base_url()."manage_listing/".$listDetail->row()->id;?>"><i class="left_side_icon left_icon-1"></i><span><?php if($this->lang->line('list_Calendar') != '') { echo stripslashes($this->lang->line('list_Calendar')); } else echo "Calendar"; ?></span><div class="new-section-icon"><i <?php if($listDetail->row()->calendar_checked==''){ echo 'class="icon_plus"'; }else{ echo 'class="icon_plus_active"';}?>></i></div></a></li>
                    <li <?php if($url == 'price_listing') echo 'class="active"';?>><a href="<?php echo base_url()."price_listing/".$listDetail->row()->id;?>"><i class="left_side_icon left_icon-2"></i><span><?php if($this->lang->line('list_Pricing') != '') { echo stripslashes($this->lang->line('list_Pricing')); } else echo "Pricing"; ?></span><div class="new-section-icon"><i <?php if($Steps_count2=='1'){ echo 'class="icon_plus"'; }else{ echo 'class="icon_plus_active"';}?>></i></div></a></li>
                </ul>
                <h2><?php if($this->lang->line('list_Description') != '') { echo stripslashes($this->lang->line('list_Description')); } else echo "Description"; ?></h2>
                <ul class="left_side_1">
                	<li <?php if($url == 'overview_listing') echo 'class="active"';?>><a href="<?php echo base_url()."overview_listing/".$listDetail->row()->id;?>"><i class="left_side_icon left_icon-3"></i><span><?php if($this->lang->line('list_Overview') != '') { echo stripslashes($this->lang->line('list_Overview')); } else echo "Overview"; ?></span><div class="new-section-icon"><i <?php if($Steps_count1=='1'){ echo 'class="icon_plus"'; }else{ echo 'class="icon_plus_active"';}?>></i></div></a></li>
					<?php if($listDetail->row()->space !="" || $listDetail->row()->guest_access !="" || $listDetail->row()->interact_guest !="" || $listDetail->row()->neighbor_overview !="" || $listDetail->row()->neighbor_around !="" || $listDetail->row()->house_rules !="" || $url == 'detail_list'){?>
					<li <?php if($url == 'detail_list') echo 'class="active"';?>><a href="<?php echo base_url()."detail_list/".$listDetail->row()->id;?>"><i class="left_side_icon left_icon-3"></i><span><?php if($this->lang->line('list_Details') != '') { echo stripslashes($this->lang->line('list_Details')); } else echo "Details"; ?></span><div class="new-section-icon"><i <?php if($listDetail->row()->space !="" || $listDetail->row()->guest_access !="" || $listDetail->row()->interact_guest !="" || $listDetail->row()->neighbor_overview !="" || $listDetail->row()->neighbor_around !="" || $listDetail->row()->house_rules !=""){ echo 'class="icon_plus_active"'; }else{ echo 'class="icon_plus"';}?>></i></div></a></li>
                    <?php }?>
                    <li <?php if($url == 'photos_listing') echo 'class="active"';?>><a href="<?php echo base_url()."photos_listing/".$listDetail->row()->id;?>"><i class="left_side_icon left_icon-4"></i><span><?php if($this->lang->line('list_Photos') != '') { echo stripslashes($this->lang->line('list_Photos')); } else echo "Photos"; ?></span><div class="new-section-icon"><i <?php if($Steps_count4=='1'){ echo 'class="icon_plus"'; }else{ echo 'class="icon_plus_active"';}?>></i></div></a></li>
                </ul>
                    <h2><?php if($this->lang->line('list_Settings') != '') { echo stripslashes($this->lang->line('list_Settings')); } else echo "Settings"; ?></h2>
                <ul class="left_side_1">
                	<li <?php if($url == 'amenities_listing') echo 'class="active"';?>><a href="<?php echo base_url()."amenities_listing/".$listDetail->row()->id;?>"><i class="left_side_icon left_icon-5"></i><span><?php if($this->lang->line('list_Amenities') != '') { echo stripslashes($this->lang->line('list_Amenities')); } else echo "Amenities"; ?></span><div class="new-section-icon"><i <?php if($Steps_count5=='1'){ echo 'class="icon_plus"'; }else{ echo 'class="icon_plus_active"';}?>></i></div></a></li>
					<li <?php if($url == 'space_listing') echo 'class="active"';?>><a href="<?php echo base_url()."space_listing/".$listDetail->row()->id; ?>"><i class="left_side_icon left_icon-7"></i><span><?php if($this->lang->line('list_Listing') != '') { echo stripslashes($this->lang->line('list_Listing')); } else echo "Listing"; ?></span><div class="new-section-icon"><i <?php if($Steps_count7=='1'){ echo 'class="icon_plus"'; }else{ echo 'class="icon_plus_active"';}?>></i></div></a></li>
                    <li <?php if($url == 'address_listing') echo 'class="active"';?>><a href="<?php echo base_url()."address_listing/".$listDetail->row()->id;?>"><i class="left_side_icon left_icon-6"></i><span><?php if($this->lang->line('list_Location') != '') { echo stripslashes($this->lang->line('list_Location')); } else echo "Location"; ?></span><div class="new-section-icon"><i <?php if($Steps_count6=='1'){ echo 'class="icon_plus"'; }else{ echo 'class="icon_plus_active"';}?>></i></div></a></li>
					<li <?php if($url == 'cancel_policy') echo 'class="active"';?>><a href="<?php echo base_url()."cancel_policy/".$listDetail->row()->id; ?>"><i class="left_side_icon left_icon-7"></i><span><?php if($this->lang->line('list_Cancellation') != '') { echo stripslashes($this->lang->line('list_Cancellation')); } else echo "Cancellation Policy"; ?></span><div class="new-section-icon"><i <?php if($Steps_count8=='1'){ echo 'class="icon_plus"'; }else{ echo 'class="icon_plus_active"';}?>></i></div></a></li>
			   </ul>
            </div>
            <div class="left_side_bottom">
				<?php if($Steps_tot==0 || ($Steps_tot==1 && $Steps_count3 == 1)) {
					if($hosting_commission_status->row()->status =='Inactive')
					{
						$payment_url=base_url().'site/product/redirect_base/completed/'.$listDetail->row()->id;
					} else {
						$payment_url=base_url().'site/product/redirect_base/payment/'.$listDetail->row()->id;
					}
				?>
				
				<?php 
				if($listDetail->row()->status !='Publish' && $host_payment->row()->payment_status!='paid' && $hosting_commission_status->row()->status =='Active' ){
					?><a href="<?php if($listDetail->row()->status!='Publish' && $host_payment->row()->payment_status!='paid' ){ echo $payment_url;} else {echo 'javascript:void(0);';}?> "><?php 
					echo 'Pay';
					?></a><?php 
				} else if($listDetail->row()->status !='Publish' && $host_payment->row()->payment_status=='paid' ){
					?><span class="blue"><?php 
					echo 'PENDING';
					?></span><?php 
				} else if($listDetail->row()->status !='Publish' && $hosting_commission_status->row()->status =='Inactive'){
					?><a href="<?php if($listDetail->row()->status!='Publish' && $host_payment->row()->payment_status!='paid' ){ echo $payment_url;} else {echo 'javascript:void(0);';}?> "><?php 
					echo 'LIST SPACE'; 
					?></a><?php 
				} else {
					?><span class="blue" title="Your property is Listed and its available in search page"><?php 
					if($this->lang->line('Listed') != '') {
						echo stripslashes($this->lang->line('Listed')); 
					} 
					else echo 'Listed'; 
					?></span><?php 
				} ?>
				<?php } else { ?>
				<div class="left_side_bottom_content"></div>
				<?php }?>
            </div>
		</div>
<style>
.blue {
	background-color: #007a87;
    background-image: inherit;
    border-color: #007a87 #007a87 #004f58;
    border-radius: 0 !important;
    color: #fff;
    cursor: default;
    display: inline-block;
    font-weight: bold;
    line-height: 1.43;
    margin-bottom: 0;
    padding: 7px 21px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
	margin-left: 45px;
}
</style>