<?php 
$this->load->view('site/templates/header');
?>

<link rel="stylesheet" type="text/css" href="css/colorbox.css" media="all" />
<link href="css/page_inner.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/my-account.css" type="text/css" media="all"/>
<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="js/site/jquery.timers-1.2.js"></script>
<script type="text/javascript" src="js/site/jquery.galleryview-3.0-dev.js"></script>
<!-- script added 14/05/2014 -->

<!-- script end -->

<!---DASHBOARD-->
<div class="dashboard  yourlisting bgcolor account profile">

  <div class="top-listing-head">
 <div class="main">   
            <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('Dashboard') != '') { echo stripslashes($this->lang->line('Dashboard')); } else echo "Dashboard";?></a></li>
                <li><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></li>
                <li class="active"><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
                <li><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul> </div></div>
	<div class="main">
    	<div id="command_center">
    
             <ul id="nav">
                <li><a href="<?php echo base_url();?>dashboard"><?php if($this->lang->line('Dashboard') != '') { echo stripslashes($this->lang->line('Dashboard')); } else echo "Dashboard";?></a></li>
                <li><a href="<?php echo base_url();?>inbox"><?php if($this->lang->line('Inbox') != '') { echo stripslashes($this->lang->line('Inbox')); } else echo "Inbox";?></a></li>
                <li><a href="<?php echo base_url();?>listing/all"><?php if($this->lang->line('YourListing') != '') { echo stripslashes($this->lang->line('YourListing')); } else echo "Your Listing";?></a></li>
                <li><a href="<?php echo base_url();?>trips/upcoming"><?php if($this->lang->line('YourTrips') != '') { echo stripslashes($this->lang->line('YourTrips')); } else echo "Your Trips";?></a></li>
                <li class="active"><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('Profile') != '') { echo stripslashes($this->lang->line('Profile')); } else echo "Profile";?></a></li>
                <li ><a href="<?php echo base_url();?>account"><?php if($this->lang->line('Account') != '') { echo stripslashes($this->lang->line('Account')); } else echo "Account";?></a></li>
                <li><a href="<?php echo base_url();?>plan"><?php if($this->lang->line('Plan') != '') { echo stripslashes($this->lang->line('Plan')); } else echo "Plan";?></a></li>
            </ul> 
            <ul class="subnav">
                <li><a href="<?php echo base_url();?>settings"><?php if($this->lang->line('EditProfile') != '') { echo stripslashes($this->lang->line('EditProfile')); } else echo "Edit Profile";?></a></li>
				<li><a href="<?php echo base_url();?>photo-video"><?php if($this->lang->line('Photos') != '') { echo stripslashes($this->lang->line('Photos')); } else echo "Photos";?></a></li>
				<li><a href="<?php echo base_url();?>verification"><?php if($this->lang->line('TrustandVerification') != '') { echo stripslashes($this->lang->line('TrustandVerification')); } else echo "Trust and Verification";?></a></li>
                <li class="active"><a href="<?php echo base_url();?>display-review"><?php if($this->lang->line('Reviews') != '') { echo stripslashes($this->lang->line('Reviews')); } else echo "Reviews";?></a></li>
	
                <a class="invitefrds" href="users/show/<?php echo $uId;?>"><?php if($this->lang->line('ViewProfile') != '') { echo stripslashes($this->lang->line('ViewProfile')); } else echo "View Profile";?></a>
            </ul>
            	<div id="account">
    <div class="box">
      <div class="middle">




       <div class="tabbable-panel">
      <div class="tabbable-line">
      <ul class="nav nav-tabs ">
      <li>
      <a href="<?php echo base_url();?>site/product/display_review"><?php if($this->lang->line('ReviewsAboutYou') != '') { echo stripslashes($this->lang->line('ReviewsAboutYou')); } else echo "Reviews About You";?></a>
      </li>
      <li class="active">
      <a href="<?php echo base_url();?>site/product/display_review1"><?php if($this->lang->line('ReviewsbyYou') != '') { echo stripslashes($this->lang->line('ReviewsbyYou')); } else echo "Reviews by You";?></a>
      </li>
      
      </ul>
      <div class="tab-content">
      <div id="tab_default_1" class="tab-pane active">
        <h2><?php if($this->lang->line('PastReview') != '') { echo stripslashes($this->lang->line('PastReview')); } else echo "Past Review";?></h2>
              <div class="section notification_section">
              <div class="notification_area">
                <ul class="reviw-loop">
				<?php 
				foreach($ReviewDetails->result() as $review){
				if($review->loginUserType == 'google')$useImg = $review->image;								else if($review->image == '') $useImg=base_url().'images/site/profile.png';				else $useImg=base_url().'images/users/'.$review->image;				?>				<li><div class="img-lefts"><img src="<?php echo $useImg; ?>" width="100" /></div>
				<div class="rigtf-lefts"><span class="revw-area"><?php echo $review->review; ?></span>
				<span class="by-area">by <?php echo $review->user_name; ?></span>
				<span class="by-area"> <?php echo $review->dateAdded; ?></span>

				<span class="review_img" ><img class="review_st" style="width:<?php echo $review->total_review * 20?>%"></span></div>
				</li>
				<?php } ?>
				</ul>
              </div>
              </div>
              

             
      
      
      </div>
<style>
.review_img
{
background: url(images/no-rating_star.png) repeat-x;
float: left;
height: 17px;
width: 86px;
}
.review_st {
background: url(images/rating_star.png) repeat-x;
float: left;
height: 17px;
position: relative;
}
</style>
      <div id="tab_default_2" class="tab-pane">
    <h2><?php if($this->lang->line('ReviewstoWrite') != '') { echo stripslashes($this->lang->line('ReviewstoWrite')); } else echo "Reviews to Write";?> </h2>
              <div class="section notification_section">
              <div class="notification_area">
                <p class="text-lead"> <?php if($this->lang->line('Nobodytoreview') != '') { echo stripslashes($this->lang->line('Nobodytoreview')); } else echo "Nobody to review right now. Looks like it's time for another trip!";?> </p>
             
              </div>
              </div>
              

             
      
      
      </div>
      </div>












         		<div style="float:left; width:100%; display:none">

             <h1> <?php if($this->lang->line('ReviewsByYou') != '') { echo stripslashes($this->lang->line('ReviewsByYou')); } else echo "Reviews By You";?> </h1>
             <div class="section notification_section" style="width:100%;">
				      <div class="reviews">		 
  	      
                         
                 				   <?php
								   
								 if($ReviewDetails->num_rows() >0){
								    foreach($ReviewDetails->result() as $row)
									    	{ ?>
                                    
                                        
                                <div class="media">
                                    <div class="pull-left">
                                      <a class="media-photo media-link row-space-1" href="rental/<?php echo $row->product_id; ?>"><img width="68" height="68" title="<?php echo $row->product_title; ?>" src="server/php/rental/<?php echo $row->product_image; ?>" class="lazy" alt="<?php echo $row->product_title; ?>" style="display: inline;"></a>
                                        <div class="text-center profile-name">
                                          <a href="rental/<?php echo $row->product_id; ?>"><?php echo substr($row->product_title, 0, 10); ?></a>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                      <div class="panel panel-quote panel-dark row-space-2">
                                        <div class="panel-body clearfix">
                                          <div class="comment-container truncate row-space-2">
                                            <p>
                                             <?php echo $row->review; ?>
                                            </p>
                                            <div class="more-trigger text-center">
                                              <i class="icon icon-chevron-down h3"></i>
                                            </div>
                                          </div>
                                            
                                          <div class="text-muted date"><?php echo $row->dateAdded; ?></div>
                                        </div>
                                      </div>

                                    </div>
                                  </div>
                                        	<?php	}}else{ ?>
                                            <?php if($this->lang->line('Noonehasreviewed') != '') { echo stripslashes($this->lang->line('Noonehasreviewed')); } else echo "No one has reviewed you yet.";?>
                                            <?php } ?>
                                       </div>
          </div>
          		<h1><?php if($this->lang->line('ReviewsAboutYou') != '') { echo stripslashes($this->lang->line('ReviewsAboutYou')); } else echo "Reviews About You";?></h1>
                
				<div class="section notification_section" style="width:100%;">
				<div class="reviews">		 
  	      
                         
                 				   <?php
								   if(isset($UReviewDetails)){
								 if($UReviewDetails->num_rows() >0){
								    foreach($UReviewDetails->result() as $row)
									    	{ ?>
                                    
                                        
                                <div class="media">
                                    <div class="pull-left">
                                      <a class="media-photo media-link row-space-1" href="rental/<?php echo $row->product_id; ?>"><img width="68" height="68" title="<?php echo $row->product_title; ?>" src="server/php/rental/<?php echo $row->product_image; ?>" class="lazy" alt="<?php echo $row->product_title; ?>" style="display: inline;"></a>
                                        <div class="text-center profile-name">
                                          <a href="rental/<?php echo $row->product_id; ?>"><?php echo substr($row->product_title, 0, 10); ?></a>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                      <div class="panel panel-quote panel-dark row-space-2">
                                        <div class="panel-body clearfix">
                                          <div class="comment-container truncate row-space-2">
                                            <p>
                                             <?php echo $row->review; ?>
                                            </p>
                                            <div class="more-trigger text-center">
                                              <i class="icon icon-chevron-down h3"></i>
                                            </div>
                                          </div>
                                            
                                          <div class="text-muted date"><?php echo $row->dateAdded; ?></div>
                                        </div>
                                      </div>

                                    </div>
                                  </div>
                                        	<?php	}}else{ ?>
                                            <?php if($this->lang->line('Nobodytoreview') != '') { echo stripslashes($this->lang->line('Nobodytoreview')); } else echo "Nobody to review right now. Looks like it's time for another trip!";?> 
								   <?php } } ?>
                                       </div>
          </div>
    <div class="clearfix"></div>
      </div>
    </div>
	 </div> </div>
  </div>
         
  </div>
    </div>
</div>
<!---DASHBOARD-->
<!---FOOTER-->

<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>jquery-ui-1.8.18.custom.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/site/<?php echo SITE_COMMON_DEFINE ?>jquery-ui-1.8.18.custom.css" />
<script type="text/javascript">
	/*jQuery(document).ready( function () {
		$(".datepicker").datepicker({ minDate:0, dateFormat: 'yy-mm-dd'});
	});*/
	
	
	

$(function() {
$( "#datefrom" ).datepicker({
defaultDate: "+1w",
changeMonth: true,
numberOfMonths: 1,
minDate:0,
onClose: function( selectedDate ) {
$( "#expiredate" ).datepicker( "option", "minDate", selectedDate );
}
});
$( "#expiredate" ).datepicker({
defaultDate: "+1w",
changeMonth: true,
numberOfMonths: 1,
minDate:0,
onClose: function( selectedDate ) {
$( "#datefrom" ).datepicker( "option", "maxDate", selectedDate );
}
});
});

/* $(function() {
$( "#datepicker" ).datepicker();
});*/
</script>



<?php 
$this->load->view('site/templates/footer');
?>