<?php 
$this->load->view('site/templates/header');
?>
<div class="dashboard yourlisting yourlistinghome">

<div class="top-listing-head">
 <div class="main">   
            <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('Dashboard') != '') { echo stripslashes($this->lang->line('Dashboard')); } else echo "Dashboard";?></a></li>
                <li><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li class="active"><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></li>
                <li><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
                <li><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul> </div></div>
	<div class="main">
    	<div id="command_center">
      <div class="dashboard-sidemenu">
            <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('Dashboard') != '') { echo stripslashes($this->lang->line('Dashboard')); } else echo "Dashboard";?></a></li>
                <li><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li class="active"><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></li>
                <li><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
                <li><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul> 
            <ul class="subnav">
                <li class="active"><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('ManageListings') != '') { echo stripslashes($this->lang->line('ManageListings')); } else echo "Manage Listings";?></a></li>
                <li><a href="<?php echo base_url();?>listing-reservation"><?php if($this->lang->line('YourReservations') != '') { echo stripslashes($this->lang->line('YourReservations')); } else echo "Your Reservations";?>  </a></li>
               <!-- <li><a href="<?php echo base_url();?>listing-requirement"><?php if($this->lang->line('ReservationRequirements') != '') { echo stripslashes($this->lang->line('ReservationRequirements')); } else echo "Reservation Requirements";?></a></li>-->
                <!--<li><a href="<?php echo base_url();?>listing-booking">Booking</a></li>
                <li><a href="<?php echo base_url();?>listing_enquiry">Enquiry</a></li>-->
            </ul>

          </div>
            

            <div class="listiong-areas">
            <div class="box">
      <div class="middle">
	  <?php $listing = $this->uri->segment(2); ?>
	  <?php if(count($rentalDetail)>0){ ?>
        <div class="sort-header clearfix">
          <span id="listings-filter" class="btn-group btn-dropdown all">
          	<a href="javascript:void(0);">
            <button class="btn gray mini dropdown-toggle display-filter">
              <span class="none always">Show:</span>
              <span class="none" <?php if($listing == 'all'){echo "style=display:block";}else{echo "style=display:none";}?>>
               <?php if($this->lang->line('alllistings') != '') { echo stripslashes($this->lang->line('alllistings')); } else echo "all listings";?> 
               
              </span>
              <span class="active" <?php if($listing == 'Publish'){echo "style=display:block";}else{echo "style=display:none";}?>>
                <span class="dot dot-green"></span>
                <?php if($this->lang->line('activelistings') != '') { echo stripslashes($this->lang->line('activelistings')); } else echo "active listings";?>
              </span>
              <span class="inactive" <?php if($listing == 'UnPublish'){echo "style=display:block";}else{echo "style=display:none";}?>>
                <span class="dot dot-red"></span>
               <?php if($this->lang->line('hiddenlistings') != '') { echo stripslashes($this->lang->line('hiddenlistings')); } else echo "hidden listings";?> 
              </span>
              <i class="iconars"></i>
            </button></a>
            <ul class="dropdown-menu toggle-filter showlist4">
              <li>
                <a href="<?php echo base_url();?>listing/all">
                 <?php if($this->lang->line('Showalllistings') != '') { echo stripslashes($this->lang->line('Showalllistings')); } else echo "Show all listings";?> 
</a>              </li>
              <li>
                <a href="<?php echo base_url();?>listing/Publish">
                  <span class="dot dot-green"></span>
                 <?php if($this->lang->line('Showactive') != '') { echo stripslashes($this->lang->line('Showactive')); } else echo "Show active";?> 
</a>              </li>
              <li>
                <a href="<?php echo base_url();?>listing/UnPublish">
                  <span class="dot dot-red"></span>
                  <?php if($this->lang->line('Showhidden') != '') { echo stripslashes($this->lang->line('Showhidden')); } else echo "Show hidden";?>
</a>              </li>
            </ul>
          </span>
        </div>
		
        <?php //echo "<pre>";print_r($rentalDetail);die;
		
		foreach($rentalDetail as $row){ 
				
		?>
        <div id="listings-container">
          <ul class="listings unstyled">
            <li data-hosting-id="1898630" class="listing clearfix">
              <div class="image"><a href="<?php echo base_url()."rental/".$row->id;?>"><img src="<?php if($row->product_image == ''){ echo base_url(). PRODUCTPATH.'dummyProductImage.jpg';  } else { if(strpos($row->product_image, 's3.amazonaws.com') > 1){ echo $row->product_image; }else {  if($row->product_image!= '' && file_exists('./server/php/rental/thumbnail/'.$row->product_image)){ echo base_url()."server/php/rental/thumbnail/".$row->product_image; } else {echo base_url()."server/php/rental/".$row->product_image;} } } ?>" alt="Room_no_photos"></a></div>
                  <div class="listing-criteria-header activation-notification">
  <div class="listing-criteria-header-message">
<?php $total_steps=8;
if($row->product_title !="")
{
$total_steps--;
}
if($row->price !="0.00")
{
$total_steps--;
}
if($row->calendar_checked !="")
{
$total_steps--;
}
if($row->product_image !="")
{
$total_steps--;
}
if($row->list_name !="")
{
$total_steps--;
}
if(!empty($row->latitude))
{
	$check = substr($row->latitude,0,1);
	if(!empty($check)){
		
		$total_steps--;
	}

}
if($row->listings !="")
{
$total_steps--;
}
if($row->cancellation_policy !="")
{
$total_steps--;
}
	if($total_steps != 0 ){ ?>
	<a class="btn blue" href="<?php echo base_url()."manage_listing/".$row->id;?>"><?php echo $total_steps;?> <?php if($this->lang->line('stepstolist') != '') { echo stripslashes($this->lang->line('stepstolist')); } else echo "steps to list";?></a>
	<?php } else {?>
		<?php if($row->status == 'Publish' && $total_steps == 0){?>
		<span class="blue"><?php if($this->lang->line('Listed') != '') { echo stripslashes($this->lang->line('Listed')); } else echo "Listed";?></span>
		<?php } elseif($row->status != 'Publish' && $total_steps == 0 && $hosting_commission_status =='Inactive'){?>
		<span class="blue"><?php if($this->lang->line('Pending') != '') { echo stripslashes($this->lang->line('Pending')); } else echo "Pending";?></span>
		<?php } elseif($row->status == 'UnPublish' && $total_steps == 0 && $hosting_commission_status == 'Active' && $row->payment_status == 'paid'){?>
		<span class="blue"><?php if($this->lang->line('Pending') != '') { echo stripslashes($this->lang->line('Pending')); } else echo "Pending";?></span>
		<?php } elseif($row->status == 'UnPublish' && $total_steps == 0 && $hosting_commission_status == 'Active') { ?>
		<a class="btn blue" href="site/product/redirect_base/payment/<?php echo $row->id;?>">Pay</a>
		<?php } ?>
	<?php }?>
		 
  </div>
</div>

 
                <div class="listing-info">
               



            <div class="manage-center-detail">
              <span class="managing-list"><a href="<?php echo base_url()."rental/".$row->id;?>"><?php echo $row->product_title;?></a></span>
              <span class="views-list"><a href="<?php echo base_url()."manage_listing/".$row->id;?>"><?php if($this->lang->line('ManageListingand') != '') { echo stripslashes($this->lang->line('ManageListingand')); } else echo "Manage Listing and Calendar";?> </a></span>
            </div>



                  <div class="actions">
                    <a class="btn gray mini" href="<?php echo base_url()."manage_listing/".$row->id;?>">

                      <i class="icon-pencil"></i>
                      <?php if($this->lang->line('Managelisting') != '') { echo stripslashes($this->lang->line('Managelisting')); } else echo "Manage listing";?>
</a>
                    <a class="btn gray mini" href="<?php echo base_url()."rental/".$row->id;?>">
                      <i class="icon icon-eye-open"></i>
                      <?php if($this->lang->line('Viewlisting') != '') { echo stripslashes($this->lang->line('Viewlisting')); } else echo "View listing";?>
</a>
                    <!--<a class="btn gray mini" href="<?php echo base_url()."manage_listing/".$row->id;?>"><a name="calendar" style="cursor:pointer;" class="btn gray mini ajax cboxElement" href="site/product/edit_calendar/<?php echo $row->id; ?>?pid=<?php echo $row->id; ?>&price=<?php echo $row->price; ?>">-->
                    <a name="calendar" style="cursor:pointer;" class="btn gray mini example16" data-pid="<?php echo $row->id; ?>" data-price="<?php echo $row->price; ?>" href="javascript:void(0);">
                      <i class="icon icon-calendar"></i>
                      <?php if($this->lang->line('Viewcalendar') != '') { echo stripslashes($this->lang->line('Viewcalendar')); } else echo "View calendar";?>
</a>   


                                
                  </div>
                   
                </div>
                
              </li>
          </ul>
        </div>
        <?php }  } else {?>

        <div class="no-listing">
		<h2><?php if($this->lang->line('Youdonthave') != '') { echo stripslashes($this->lang->line('Youdonthave')); } else echo "You don't have any listings!";?></h2>
    <p>		<?php if($this->lang->line('Listingyourspace') != '') { echo stripslashes($this->lang->line('Listingyourspace')); } else echo "Listing your space on Renters is an easy way to monetize any extra space you have.";?></p>
		<p> <?php if($this->lang->line('Youllalso') != '') { echo stripslashes($this->lang->line('Youllalso')); } else echo "You will also get to meet interesting travelers from around the world!";?></p>
		<a class="list_spaceds" href="list_space"><?php if($this->lang->line('Postanew') != '') { echo stripslashes($this->lang->line('Postanew')); } else echo "Post a new listing";?></a>
		<?php }?>
      </div></div>
    </div> </div>
           
  </div>
    </div>
</div>
<!---DASHBOARD-->
<!---FOOTER-->

<script type="text/javascript">
$('.example16').click(function(){

	$('#inline_example11 .popup_page').html('<div class="cnt_load"><img src="images/ajax-loader.gif"/></div>');
	
	var pid = $(this).data('pid');
	var price = $(this).data('price');
	var pname = $(this).text();
	var purl = baseURL+$(this).attr('href');
	$.ajax({
		type:'get',
		// url:baseURL+'site/product/viewMemberCalendar/'+pid,
		url:baseURL+'site/product/edit_calendar/'+pid,

		data:{'pid':pid,'price':price},
		dataType:'html',
		success:function(data){ 
			swal(data);
			// window.history.pushState({"html":data,"pageTitle":pname},"", purl);
			$('#inline_example11 .popup_page').html(data);
		}
	});
});
</script>


<!-----------popup for listing------>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
jQuery.noConflict();
jQuery(function()
{
jQuery('.ui-button-text').text('Ok');
});
</script>
<style>
.ui-draggable-handle{
	display:none !important;
}
.listing-down-creat {
    font-size: 20px !important;
}

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
}
</style>
<!-----------End popup for listing------>
<?php if($this->session->userdata('enable_complete_popup'))
{
$this->session->unset_userdata('enable_complete_popup');
}
$this->load->view('site/product/front_calendar',$this->data);
$this->load->view('site/templates/footer');
?>