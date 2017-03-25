<?php 
$this->load->view('site/templates/header');
?>

 <?php //echo '<pre>'; print_r($this->data['verifyid']->result_array());  ?>
 <link rel="stylesheet" type="text/css" media="all" href="css/site/owl.carousel.css" />
<section>
  <div class="profile-page">
  <div class="container">


    <div class="col-sm-3">
      <div class="profile-left">
        <div class="profilr-img">
		<?php 
			$new_image = $this->data['user_Details']->row()->image; 
			if (strpos($new_image, 'https:') !== false) {
			    $req_image = "1";
			}
			else
			{
				$req_image = "";	
			}
		?>
	<!---	<img title="<?php echo $this->data['user_Details']->row()->firstname;?>" src="<?php if($req_image==""){?>images/site/<?php }?><?php if($this->data['user_Details']->row()->loginUserType == 'google'){ echo $this->data['user_Details']->row()->image;} elseif($this->data['user_Details']->row()->image==''){ ?>profile.png <?php } else { echo $this->data['user_Details']->row()->image;} ?>" alt="<?php echo $this->data['user_Details']->firstname;?>">----->
	
	
		<img title="<?php echo $this->data['user_Details']->row()->firstname;?>" src="<?php if(strpos($this->data['user_Details']->row()->image, 'googleusercontent') > 1){ echo $this->data['user_Details']->row()->image;} elseif($this->data['user_Details']->row()->image==''){ ?>images/users/user_pic-225x225.png <?php } else { echo 'images/users/'.$this->data['user_Details']->row()->image;} ?>" alt="<?php echo $this->data['user_Details']->firstname;?> ">
		<?php //$ImageName =($this->data['user_Details']->row()->image=='')?'images/users/user_pic-225x225.png':'images/users/'.$this->data['user_Details']->row()->image; ?>
          <!--<img src="<?php echo $ImageName; ?>">-->
        </div>

        <div class="verifierid">
          <h2 class="profile-heads"><?php if($this->lang->line('verification') != '') { echo stripslashes($this->lang->line('verification')); } else echo "Verification"; ?></h2>
          <ul class="virify-method">
         
		 
		 
		 <li><i class="<?php if($this->data['user_Details']->row()->id_verified == 'Yes') echo 'icon-ok-text';else echo 'icon-notok-text';?>"></i>
          <div class="media-area">
          <span class="emaild-text"> <?php if($this->lang->line('email_address') != '') { echo stripslashes($this->lang->line('email_address')); } else echo "Email address"; ?></span>
		  
		  <!--<?php if($this->data['user_Details']->row()->is_verified == 'Yes') { ?>
          <label class="text-muted"> Verified </label>
		   <?php } else{?> <label class="text-muted"> Not Verified </label> <?php }?>-->
          </div></li> 
		   <li><i class="<?php if($verifyid->row()->ph_verified =='Yes') echo 'icon-ok-text';else echo 'icon-notok-text';?>"></i>
          <div class="media-area">
          <span class="emaild-text"> <?php if($this->lang->line('ph_no') != '') { echo stripslashes($this->lang->line('ph_no')); } else echo "Phone Number"; ?> </span>
          <!-- <?php if($verifyid->row()->ph_verified =='Yes') { ?>
          <label class="text-muted"> Verified </label>
		   <?php } else{?> <label class="text-muted"> Not Verified </label> <?php }?>-->
          </div></li>
		  
		  <!----<li><i class="<?php if($verifyid->row()->id_verified =='Yes') echo 'icon-ok-text';else echo 'icon-notok-text';?>"></i>
          <div class="media-area">
          <span class="emaild-text"> Verified ID </span>
         <!--  <?php if($verifyid->row()->is_verified =='Yes') { ?>
          <label class="text-muted"> Verified </label>
		   <?php } else{?> <label class="text-muted"> Not Verified </label> <?php }?>
          </div></li>-->
        </ul>
        </div>


          <div class="verifierid">
          <h2 class="profile-heads"><?php if($this->lang->line('about_me') != '') { echo stripslashes($this->lang->line('about_me')); } else echo "About Me"; ?></h2>
          <ul class="virify-method about-me">

          <li>
          <span class="emaild-text"> <b><?php if($this->lang->line('work') != '') { echo stripslashes($this->lang->line('work')); } else echo "Work"; ?> :</b> 
           <?php   if($this->data['user_Details']->row()->work !=''){echo ucfirst($this->data['user_Details']->row()->work);}else if($this->lang->line('not_specified') != '') { echo stripslashes($this->lang->line('not_specified')); } else echo "Not Specified"; ?> </span>
          </li>
		  
		  <li>
          <span class="emaild-text"> <b><?php if($this->lang->line('School') != '') { echo stripslashes($this->lang->line('School')); } else echo "Company"; ?> :</b> <?php   if($this->data['user_Details']->row()->school !=''){echo ucfirst($this->data['user_Details']->row()->school);}else if($this->lang->line('not_specified') != '') { echo stripslashes($this->lang->line('not_specified')); } else echo "Not Specified"; ?> </span>
          </li>

           <li>
		 <?php  
		//echo "<pre>";print_r($languages->result()) ;
		 $languages_known=explode(',',$this->data['user_Details']->row()->languages_known);
		 $languages_known_text='';
		foreach($languages->result() as $language)
		{
			if(in_array($language->language_code,$languages_known))
			{
			$languages_known_text .=$language->language_name.', ';
			}
		}
 ucfirst(substr($languages_known_text,0,-1));
	if($languages_known_text ==''){
	$languages_known_text= 'None Selected';
	}
	?>
          <span class="emaild-text" title="<?php echo $languages_known_text;?>"> <b><?php if($this->lang->line('languages') != '') { echo stripslashes($this->lang->line('languages')); } else echo "Languages"; ?> :</b> 
		  <?php 
			if($languages_known_text=='None Selected'){
				if($this->lang->line('none_selcted') != '') { echo stripslashes($this->lang->line('none_selected')); } else echo "None Selected";
			}else{
				echo $languages_known_text;
			}
			
		  ?>
  </span>
          </li>
 </ul>
        </div>
         </div>
          </div>

      <div class="col-sm-9">
        <div class="profile-right">
          <div class="profile-name-section">
            <label class="namd-space"><?php echo $this->data['user_Details']->row()->firstname.' '.$this->data['user_Details']->row()->lastname; ?></label>
                <label ><?php echo $this->data['user_Details']->row()->thumbnail; ?></label>
                
            <ul class="riw-title">
            <!-- <li>
              <i class="hodt1co hodtco1"></i>
              <span>Super script</span>
            </li> -->

               <li style="display:none">
            <label class="revd-text"><?php echo $ReviewDetails->num_rows(); ?></label>
              <span>Reviews</span>
            </li>

             <li>
			 <?php 
			 if($this->data['verifyid']->row()->is_verified == 'Yes'){
			 ?>
             <a href="javascript:void(0);"> <i class="hodt1co hodtco2"></i>
              <span>Verified Id</span> </a>
			  <?php }?>
            </li>
            </ul>

          </div>


          <div class="profile-place">
          <span class="plece-nme"><?php echo $this->data['user_Details']->row()->description; ?>
           </p>

          </div>

          <div class="listiong-places">
            <label class="list-areas-text"><?php if($this->lang->line('listings') != '') { echo stripslashes($this->lang->line('listings')); } else echo "Listings"; ?> (<?php echo $rentalDetail->num_rows(); ?>)</label>
           

		   <ul class="listig-areasli">
		   
		   <?php 
		   
		 // echo '<pre>'; print_r($WishListCat->result_array()); 
		 $i = 1;
	if($rentalDetail->num_rows() > 0){
		foreach($rentalDetail->result_array() as $wlist){  ?>
			
			
			
			  <?php  /* $ImageName =($wlist['product_image']=='')?'':'server/php/rental/'.$wlist['product_image']; */
			   $ImageName = PRODUCTPATH.'dummyProductImage.jpg';

	  if($wlist['product_image']!= '' && file_exists('./server/php/rental/thumbnail/'.$wlist['product_image'])){ 
	  $ImageName = PRODUCTPATH.'thumbnail/'.$wlist['product_image'];
	  }
	  else if($wlist['product_image']!= '' && file_exists('./server/php/rental/'.$wlist['product_image'])){ 
	  $ImageName = PRODUCTPATH.$wlist['product_image'];	  
	  }
	  else if($wlist['product_image']!= '' && strpos($wlist['product_image'], 's3.amazonaws.com') > 1)$ImageName=$wlist['product_image'];
			  
			  ?>
			   
				<li <?php if($i > 3) { ?> style="display:none;" class="hidden_lists_list" <?php }?>><a class="lin-img2" href="rental/<?php echo $wlist['id']; ?>"><img src="<?php echo $ImageName; ?>">
                <div class="top-posd">
                  <span><?php echo ucfirst($wlist['product_title']); ?></span>
                  <!-- <span><?php echo $wlist['product_title']; ?></span> -->
                </div>
              </a></li>
				 
              
			  
			  <?php 
			  $i++;
			  }  } ?>

             
             <?php if($i > 4 ) { ?>  <a class="view-texts" id="view_hidden_lists_list" href="javascript:void(0);" onClick="show_hidden_lists('list');">View All Listings</a> <?php } ?>
            </ul>

			</div>







          <div class="riwiew-container reviwprofile">
          <h2 class="reviw-count"><?php if($this->lang->line('review') != '') { echo stripslashes($this->lang->line('review')); } else echo "Review"; ?><?php echo $user_Details->id; ;?> (<?php echo $ReviewDetails->num_rows(); ?>) </h2>
		  <?php foreach($ReviewDetails->result() as $reviews){?>
		  <?php $tot_review=$tot_review+$reviews->total_review;
			 } $count=$ReviewDetails->num_rows();
			 $all_count=$tot_review/$count;
			 
			 ?>
		  <label class="lik-btn"> <img src="<?php echo base_url() ?>images/review/star_rating_<?php if(empty($all_count)) echo 0; else echo floor($all_count); ?>.png" /></label>
		  
          <div class="review-summary">
		  <?php if($ReviewDetails->num_rows() > 0) { ?>
          <span class="summar-text">Summary</span>
          <ul class="list-paging">
		  <?php 
		  $i = 1;
		  foreach($ReviewDetails->result_array() as $review) { ?>
		  
		  
          <li <?php if($i > 3) { ?> style="display:none;" class="hidden_lists_review" <?php }?>>
		  <?php 
		  $reviewuser = $this->user_model->get_all_details(USERS,array('id'=>$review['reviewer_id']));
		  if($reviewuser->row()->loginUserType == 'google')
		  $ImageName = ($reviewuser->row()->image=='')?"images/user_unknown.jpg":$reviewuser->row()->image; 
		  else
		  $ImageName = ($reviewuser->row()->image=='')?"images/user_unknown.jpg":"images/users/".$reviewuser->row()->image; 
		  ?>
          <div class="peps">
          <figure class="peps-area">
		  
          <a href="users/show/<?php echo $review['reviewer_id']; ?>"><img src="<?php echo $ImageName; ?>"></a>
          </figure>
          <span class="johns"><?php echo ucfirst($reviewuser->row()->user_name);  ?></span>
          </div>
          <div class="listd-right">
          <p><?php echo $review['review'];  ?></p>

          <div class="dated-link">
            <span style="text-decoration:none;" class="date-year">
			<?php echo date('F Y',strtotime($review['dateAdded'])); ?>
			</span>
          <a href="rental/<?php echo $review['product_id'];?>" class="bedrom-flat"><?php echo $review['product_title'];  ?></a>
          </div>
          </div>

          </li>
		  <?php 
		  $i++;
		 } ?>

		  <?php if($i > 4 ) { ?>  <a class="view-texts" id="view_hidden_lists_review" href="javascript:void(0);" onClick="show_hidden_lists('review');">see more</a> <?php } ?>
		  
          </ul>
		  <?php } ?>
          </div>
		  </div>
		 
			
			<div class="listiong-places">
			<?php if($login_user==$user_id ) { ?>
            <label class="list-areas-text"><?php if($this->lang->line('wish_list') != '') { echo stripslashes($this->lang->line('wish_list')); } else echo "Wishlist"; ?> (<?php echo $WishListCat->num_rows(); ?>)</label>
           <?php } else { 
			$count=0;
			foreach($WishListCat->result_array() as $wlist){ 
					if($login_user!=$user_id && $wlist['whocansee']!='Only me'){
					$count++;
				}
			}
				
		  if($count!=0) { ?>		
				   <label class="list-areas-text"><?php if($this->lang->line('wish_list') != '') { echo stripslashes($this->lang->line('wish_list')); } else echo "Wishlist"; ?> (<?php echo $count; ?>)</label>
			<?php } }?> 
		   <ul class="listig-areasli">
		   
		   <?php 
		   
		 //echo '<pre>'; print_r($WishListCat->result_array());  die;
		 $i = 1;
		
	if($WishListCat->num_rows() > 0){
		foreach($WishListCat->result_array() as $wlist){ 
			$products=explode(',',$wlist['product_id']);
			$productsNotEmy=array_filter($products);
			//print_r($productsNotEmy);
			shuffle($productsNotEmy);
			$CountProduct=count($productsNotEmy); ?>
			<div <?php if($i > 2) { ?> style="display:none;"  <?php }?> class="wish-list-slider">
				<div <?php if($CountProduct > 1) { ?>class="owl-carousel1" <?php } ?>>
				<?php foreach($productsNotEmy as $wlistlist){
					$bgImage = $this->product_model->get_all_details ( PRODUCT_PHOTOS, array ('product_id' => $wlistlist) );
					if($bgImage->row()->product_image != ''){
						$bgImg = base_url().'server/php/rental/'.$bgImage->row()->product_image;
					}else{
						$bgImg = base_url().'server/php/rental/dummyProductImage.jpg';
					}
				?>
				<div  class="item">
					<a href="rental/<?php echo $wlistlist; ?>">
						<div class="wish-slider-inner">
							<img src="<?php echo $bgImg;?>" <?php if($CountProduct == 1) { ?>style="height:185px; width:100%" <?php } ?>>
							<div class="wish-slider-hover">
								<h2><?php echo ucfirst($wlist['name']); ?></h2>
							</div>
						</div>
					</a>
				</div>
				<?php } ?>
				</div>
			</div>
			<?php  $i++; } } ?>

             
             <?php if($i > 3 ) { ?>  <a class="view-texts" id="view_hidden_wish_list"
            onClick="show_hidden_wishlist('list');owlSlider();"	 href="javascript:void(0);">View All Wishlists</a> <?php } ?>
            </ul>
        
			</div>
	
        </div>
    <div>



  </div>
  </div>


</section>

<script>
function show_hidden_lists(id)
{
	$('.hidden_lists_'+id).show();
	$('#view_hidden_lists_'+id).hide();
}
function show_hidden_wishlist(id)
{
	$('.wish-list-slider').css('display','block');
	$('.owl-item').css('width','367px');

	//$(".wish-list-slider").removeAttr("style").show();
	//$('.wish-list-slider').css('display','block');
	$('#view_hidden_wish_'+id).remove();
}
</script>
<style>
.lik-btn {
    float: left;
    font-size: 12px;
    font-weight: normal;
}
</style>

<script src="js/site/owl.carousel.js" type="text/javascript"></script>
<script type="text/javascript">

 $('.owl-carousel').owlCarousel({

    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:false
        }
    }

	}); 

$(document).ready(function(){
 $('.owl-carousel1').owlCarousel({
 
			        autoplay:false,
		    autoplayTimeout:1000,
		    autoplayHoverPause:true,
			    responsiveClass:true,

    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:true
        }
    }
});
})
function owlSlider(){

 $('.owl-carousel1').owlCarousel({
 
			        autoplay:false,
		    autoplayTimeout:1000,
		    autoplayHoverPause:true,
			    responsiveClass:true,

    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:false
        }
    }
});
}

/* function addnewclass(){
 document.getElementById("new_carousel").className = "owl-carousel1";
} */


  		

/*  $('.owl-carousel').owlCarousel({
 


    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:false
        }
    }
});
 */
 


</script>
<script>

/*  $('#view_hidden_wish_list').click(function(){
  		setTimeout(function(){
  			console.log('dfsdf')
			 show_hidden_wishlist('list');
  			owlSlider();
  		},0);
  });  */

</script>
<style>
/*.owl-stage
{
	width:100% !important;
}
.owl-item
{
	width:100% !important;
}*/

</style>

<?php 
$this->load->view('site/templates/footer');
?>

<?php /*
$this->load->view('site/templates/header');
?>

<!---DASHBOARD-->


<div class="dashboard">
	<div class="main">
    	
    

<div id="command">


          <div class="clearfix" id="dashboard">
              <div id="left">
                <div class="box" id="user_box">
                  <div class="middle">
                    <div id="user_pic">
                      <div class="_pm_container">
          <div class="_pm_shadow r"></div>
          <div class="_pm_shadow l"></div>
          <div class="_pm">
            <div class="_pm_inner clearfix">
              <div class="_pm_shadow_inner r"></div>
              <div class="_pm_shadow_inner l"></div>
              <div class="_pm_shadow_inner t"></div>
              <div class="_pm_shadow_inner b"></div>
              
                        <img width="209" height="209" title="<?php echo $user_Details->row()->firstname;?>" src="images/users/<?php if($user_Details->row()->image==''){ ?>user_pic-225x225.png <?php } else { echo $user_Details->row()->image;} ?>" alt="<?php echo $user_Details->row()->firstname;?>">
        
            </div>
          </div>
        </div>            </div>
		
		
		
		
		<!--/*popup content*/
       /* <div class="modal fade" id="contact" style="display:none !important;" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="panel panel-primary">
<form id="new_message" class="new_message" method="post" data-remote="true" action="site/user/inbox1" accept-charset="UTF-8">



<div style="margin:0;padding:0;display:inline">
<div style="width:95%" class="modal-header">
<a id="message_modal_close" class="close" data-dismiss="modal">×</a>
<h3> Send a Message </h3>
</div>
<div class="modal-body">

<div class="row-fluid">
<input type="text" name="user_id" id="user_id" value="<?php echo $loginCheck; ?>" />
<input type="text" name="guide_id" id="guide_id" value="<?php echo $user_Details->row()->id; ?>" />

<div class="avatar">
<?php 	$ImageName = ($user_Details->row()->image=="") ? "images/site/avatar_unknown.png" :"images/users/".$user_Details->row()->image;?>
<img class="popup-avtr" style="height:150px;width:150px;" src="<?php echo $ImageName; ?>"  />

</div>
<div class="display-content">

<textarea id="message" name="message" rows="2" placeholder="Have a question? Send <?php echo $user_Details->row()->user_name; ?> a message!" name="message" cols="45" style="width:350px;height:80px;"></textarea>












</div>
</div>
</div>
<div class="modal-footer">

<input id="message_submit" class="btn btn-info " type="submit" value="Send Message" >


</div>
</form>
</div>
                    
                    </div>
                </div>
            </div>
            
 <!--/*popup content*/
		
		
		
		
		
                  /*  <h2>
                      <?php echo ucfirst($user_Details->row()->firstname); ?>
                    </h2>
                    <?php if($user_Details->row()->id==$loginCheck){ ?>
                    <p>
                      <a href="settings">Edit Profile</a>
                    </p>
                    <?php } ?>
                  </div>
                </div>
        
                <div id="verifications-box" class="box">
                  <div class="middle">
                   <!-- <a href="#" class="add_more">Add More</a>-->
				   
                    <h3 class="box-header">Verifications</h3>
                  <ul class="unstyled verifications-list">
            <li class="verifications-list-item">
              <i class="icon icon-envelope-alt"></i>
              <h5>Email Address</h5>
              <?php if($user_Details->row()->is_verified =='Yes') echo "<h6>Verified</h6>"; else echo "<h6>Not Verified</h6>"; ?>
              
            </li>
        </ul>
        
		    <a class="btn btn-info btn-smal edits" data-toggle="modal" data-target="#contact" data-original-title>Contact </a>
		
                  </div>
                </div>
        
               
              <div class="clear"></div>
            </div>
            
            
            
            
            <h3> <?php echo "Hey, I'm ".stripslashes($user_Details->row()->firstname)."!"; ?> </h3>
            <span style="font-size:14px; padding-top:8px;">
                        <span style="line-height:16px; padding:6px 0 10px 0; display:block;"><?php echo ucfirst($user_Details->row()->description);?> </span>
                      </span>
        
            <div class="reviews">		 
  	       
                         
                 				   <?php
								   
								 	if($ReviewDetails->num_rows() > 0){
									echo '<h2>Reviews('.$ReviewDetails->num_rows().')</h2>';
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
                                        	<?php	}
											
											
											} ?>
                                       </div>
            
            
            
  </div>
    </div>
</div>
</div>

<!---DASHBOARD-->
<!---FOOTER-->
<?php 
$this->load->view('site/templates/footer');
*/?>
